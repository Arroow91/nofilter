<?php
class HERCULES_WP_Translate_Admin {
	private $plugin_name;
	private $version;
	private $plugin_options_tabs_arr = array();

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles() {

		$screen = get_current_screen();
		$screen_id = $screen->id;

		if ( 'buzzblogpro_page_buzzblogpro-translate' === $screen_id or 'buzzblogpro-child_page_buzzblogpro-translate' === $screen_id ) {

			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/hercules-wp-translate-admin.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$screen = get_current_screen();
		$screen_id = $screen->id;

		if ( 'buzzblogpro_page_buzzblogpro-translate' === $screen_id or 'buzzblogpro-child_page_buzzblogpro-translate' === $screen_id ) {

			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/hercules-wp-translate-admin.js', array( 'jquery' ), $this->version, false );
			wp_localize_script(
				$this->plugin_name,
				'herculestwp',
				array(
					'confirm_remove'  => __( 'Are you sure you want to delete plugin translations?', $this->plugin_name ),
					'confirm_import'  => __( 'Please make sure that you have correct code and that you have the backup of current strings. Proceed?', $this->plugin_name ),
					'no_import_data'  => __( 'No data to import. Please paste the code in import field.', $this->plugin_name ),
					'updating_export' => __( 'Updating export code...', $this->plugin_name )
				)
			);
		}

	}

	/**
	 * Register the administration menu, attached to 'admin_menu'
	 *
	 * @since 1.0.0
	 */
	public function admin_menu_page() {


		
	add_submenu_page( 'buzzblogpro-plugins', 'Buzzblogpro translate', 'Buzzblogpro translate', 'edit_theme_options', 'buzzblogpro-translate', array( & $this, 'display_plugin_admin_page' ) );
	
	}

	/**
	 * Render the settings page.
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_admin_page() {

		$tab = 'herculestwp_theme_buzzblogpro';
		?>
		<div class="wrap">
			<div id="herculestwp-settings">
					<?php

					$herculestwp_translations = get_option( 'herculestwp_translations' );
					$herculestwp_translations_pl = isset( $herculestwp_translations['plugins'] ) ? $herculestwp_translations['plugins'] : array();
					
					?>
						<form method="post" action="options.php">
							<?php
							settings_fields( $tab );
							
							$opt = get_option($tab, array() );
							
							// here comes the translation panel
					        $translate_enabled = false;
					        if ( isset($opt['translate'])) {
					            $translate_enabled = true;
					        }
					        $translate_path = '/themes/buzzblogpro/languages/buzzblogpro.pot';
					        if ( isset( $opt['path'] ) ) {
					            $translate_path = $opt['path'];
					        }
					        $tr_options = get_option( 'herculestwp_translations' );
					        $per_page = isset($tr_options['strings_per_page']) ? $tr_options['strings_per_page'] : 60;
							
							 
					        echo '<div class="nhp-opts-field-wrapper">';
					            echo '<p id="herculestwp_translate_wrap"><label for="nhp-opts-translate"><input type="checkbox" name="'.$tab.'" id="nhp-opts-translate" value="1" '.checked($translate_enabled, true, false).' />'.__('Enable translation panel', $this->plugin_name ).'</label></p>';

					            echo '<div id="herculestwp_path_wrap" class="hidden">';
						        	echo '<p>'.__( "We couldn't find language file, please enter the path to your theme/plugin language file relative to wp-content folder.", $this->plugin_name ).'</p>';
						        	echo '<p><input type="text" id="herculestwp_path" name="'.$tab.'[path]" placeholder="/themes/buzzblogpro/languages/buzzblogpro.pot" value="'.esc_attr($translate_path).'"/></p>';
						        	submit_button();
						        echo '</div>';
					        echo '</div>';
					        
					        echo '<div class="nhp-opts-field-wrapper" id="translate_search_wrapper">';
					            echo '<p><input type="text" value="" id="translate_search" placeholder="'.__('Search Translations', $this->plugin_name ).'" />';
					        echo '</div>';

					        echo '<div class="nhp-opts-field-wrapper" id="translate_strings_per_page_wrapper">';
					            echo '<p><label>'.__('Strings Per Page:', $this->plugin_name ).'<input type="number" value="'.esc_attr( $per_page ).'" id="translate_strings_per_page" /></label>';
					        echo '</div>';
					        
					        echo '<div class="nhp-opts-field-wrapper translate-strings">';
					            // ajaxed content
					        echo '</div>';

					        $mts_translations = array();
					        $strings_opt_name = $tab.'_strings';
							$mts_translations_opt = get_option( $strings_opt_name);
							if ( $mts_translations_opt ) {

								$mts_translations = $mts_translations_opt;

							} else if ( false !== strpos( $tab, 'herculestwp_theme_mts_' ) || false !== strpos( $tab, 'herculestwp_theme_mts-' ) ) {

								$curr_tab = str_replace( array( 'mts_', 'mts-' ), '', $tab );
								$alt_mts_translations_opt = get_option( $curr_tab.'_strings' );
								$strings_opt_name = $curr_tab.'_strings';

								if ( $alt_mts_translations_opt ) {

									$mts_translations = $alt_mts_translations_opt;
								}
							}
							echo '<div class="translate-additional-options">';
								echo '<div class="translate-import-export-options">';
									echo '<a href="#" class="show-import-export button button-secondary">'.__('Toggle Import/Export Options', $this->plugin_name ).'</a>';

									echo '<div class="translate-import-export-wrap">';
										echo '<ul class="translate-import-export-tabs">';
											echo '<li><a href="#translate-import-wrap" class="import-export-tab import-tab active">'.__('Import Translated Strings', $this->plugin_name ).'</a></li>';
											echo '<li><a href="#translate-export-wrap" class="import-export-tab export-tab">'.__('Export Translated Strings', $this->plugin_name ).'</a></li>';
										echo '</ul>';

										$export_val = empty( $mts_translations ) ? '' : serialize( $mts_translations );
										echo '<div id="translate-import-wrap" class="translate-import-export-content active">';
											echo '<p>'.__('Paste your import/backup code and press "Import" button below.', $this->plugin_name ).'</p>';
							        		echo '<textarea id="herculestwp-import" cols="40" rows="10" data-opt-name="' . $strings_opt_name . '"></textarea>';
							        		echo '<button id="import-button" class="button button-primary">'.__('Import', $this->plugin_name ).'</button>';
							        	echo '</div>';
							        	
										echo '<div id="translate-export-wrap" class="translate-import-export-content">';
											echo '<p>'.__('Copy export/backup code and keep it safe.', $this->plugin_name ).'</p>';
							        		echo '<textarea id="herculestwp-export" cols="40" rows="10" data-opt-name="' . $strings_opt_name . '" onclick="this.focus();this.select()">' . $export_val . '</textarea>';
							        	echo '</div>';

							        echo '</div>';
						        echo '</div>';

						        echo '<div class="translate-download-wrap">';
						            echo '<a href="?page=' . $this->plugin_name . '&tab=' . $tab . '&download=1" class="translate-download button button-primary">'.__('Create and Download .po file', $this->plugin_name ).'</a>';
						        echo '</div>';
					        echo '</div>';
					        ?>
						</form>
					<?php
					
					
					?>
					
			</div>
		</div>
	<?php
	}

	/**
	 * Register settings for each tab.
	 *
	 * @since    1.0.0
	 */
	public function settings_init() {

		$theme = wp_get_theme();
		$theme_textdomain = $theme->get( 'TextDomain' );
		$theme_tab_key = 'herculestwp_theme_'.$theme_textdomain;

		if ( is_child_theme()  ) {
			$parent = wp_get_theme( get_template() );
			$theme_textdomain = $parent->get( 'TextDomain' );
			
			$theme_tab_key = 'herculestwp_theme_'.$theme_textdomain;
		}

		if ( 'mythemeshop' === $theme_textdomain || !$theme_textdomain ) {

			$theme_tab_key = 'herculestwp_theme_'.$theme->stylesheet;
		}
		
		$all_tr = get_option( 'herculestwp_translations' );

		if ( ! isset( $all_tr['themes'][ $theme_tab_key ] ) ) {
			$all_tr['themes'][ $theme_tab_key ] = array(
				'opt_name' => $theme_tab_key,
				'name' => $theme->get( 'Name' )
			);
			update_option( 'herculestwp_translations', $all_tr );
		}
		$all_tabs[ $theme_tab_key ] = $theme->get( 'Name' );

		register_setting( $theme_tab_key, $theme_tab_key );

		if ( isset( $all_tr['plugins'] ) ) {
			$active_valid_plugins = wp_get_active_and_valid_plugins();
			foreach ( $all_tr['plugins'] as $plugin_tab_key => $plugin_data ) {

				// Show only tabs of active plugins
				if ( is_plugin_active( plugin_basename( $plugin_data['plugin_path'] ) ) ) {

					register_setting( $plugin_tab_key, $plugin_tab_key );
					$all_tabs[ $plugin_tab_key ] = $plugin_data['name'];
				}
			}
		}


		$this->plugin_options_tabs_arr = $all_tabs;
	}

	/**
	 * Render options tabs.
	 *
	 * @since    1.0.0
	 */
	public function plugin_options_tabs() {
		$current_tab = 'herculestwp_theme_buzzblogpro';

		echo '<h2 class="nav-tab-wrapper">';
		foreach ( $this->plugin_options_tabs_arr as $tab_key => $tab_caption ) {
			$icon = 'herculestwp_add_new' === $tab_key ? '<span class="dashicons dashicons-plus"></span>' : '';
			$remove_icon = false !== strpos( $tab_key, 'herculestwp_plugin_' ) ? '<span class="herculestwp-remove-translation" data-tab="'.$tab_key.'"><span class="dashicons dashicons-no"></span></span>' : '';
			$active = $current_tab == $tab_key ? 'nav-tab-active' : '';
			echo '<a class="nav-tab ' . $active . '" href="?page=' . $this->plugin_name . '&tab=' . $tab_key . '">' . $icon . $tab_caption . $remove_icon . '</a>';
		}
		echo '</h2>';
	}

	/**
	 * Find lang file
	 *
	 * @since    1.0.0
	 */
	public function find_lang_file( $current_tab ) {

		$file = '';

		$slug = str_replace( array('herculestwp_theme_', 'herculestwp_plugin_') , '', $current_tab );
		$slug = str_replace( array( '_ffrree', '_pprroo' ) , '', $slug );
		if ( empty( $slug ) ) {
			return $file;
		}

		// Check if custom path value is there
		$herculestwp_path_opt = get_option( $current_tab );
		$herculestwp_path = isset( $herculestwp_path_opt['path'] ) ? $herculestwp_path_opt['path'] : '/themes/buzzblogpro/languages/buzzblogpro.pot';

		if ( empty( $herculestwp_path ) ) {

			// Try to find language .po or .pot file
			
			// Best chance to work
			$collect_opt = get_option('herculestwp_domains', array() );
			if ( array_key_exists( $slug, $collect_opt ) ) {

				if ( file_exists( $collect_opt[ $slug ].'.pot' ) ) {

					$file = $collect_opt[ $slug ].'.pot';

				} else if ( file_exists( $collect_opt[ $slug ].'.po' ) ) {

					$file = $collect_opt[ $slug ].'.po';

    			} else if ( file_exists( preg_replace( '#[^/]*$#', '', $collect_opt[ $slug ] ).'buzzblogpro.pot' ) ) {

					$file = preg_replace( '#[^/]*$#', '', $collect_opt[ $slug ] ).'buzzblogpro.pot';

    			} else if ( file_exists( preg_replace( '#[^/]*$#', '', $collect_opt[ $slug ] ).'buzzblogpro.po' ) ) {

					$file = preg_replace( '#[^/]*$#', '', $collect_opt[ $slug ] ).'buzzblogpro.po';
    			}

    		} else {

    			// Theme
		     

		        	$theme = 'buzzblogpro';

			        if ( file_exists( get_theme_root().'/'.$theme.'/language/buzzblogpro.po' ) ) {
			        	$file = get_theme_root().'/'.$theme.'/language/buzzblogpro.po';

			        } else if ( file_exists( get_theme_root().'/mts_'.$theme.'/language/buzzblogpro.po' ) ) {
			        	$file = get_theme_root().'/mts_'.$theme.'/language/buzzblogpro.po';
			        }

			    
    		}

	    } else {

	    	// Use user path if possible
	    	$extension = strtolower( pathinfo($herculestwp_path, PATHINFO_EXTENSION ) );
	    	// make sure there is .po/.pot at the end
	    	if ( 'po' === $extension || 'pot' === $extension ) {
	    		$herculestwp_full_path = trailingslashit( ABSPATH ). 'wp-content/'. untrailingslashit( ltrim( $herculestwp_path, '/' ) );
		    	if ( file_exists( $herculestwp_full_path ) ) {
					$file = $herculestwp_full_path;
				}
	    	}
		}

		return $file;
	}

	/**
	 * Display translation panel.
	 *
	 * @since    1.0.0
	 */
	public function ajax_herculestwp_translation_panel() {

		$current_tab = 'herculestwp_theme_buzzblogpro';

		if ( empty( $current_tab ) ) {
			echo 'no_tab';
			exit;
		}

		$file = $this->find_lang_file( $current_tab );

        if ( empty( $file ) ) {
			echo 'no_file';
			exit;
		}

		$mts_translations = array();
		$mts_translations_opt = get_option( $current_tab.'_strings' );
		if ( $mts_translations_opt ) {

			$mts_translations = $mts_translations_opt;

		} else if ( false !== strpos( $current_tab, 'herculestwp_theme_mts_' ) || false !== strpos( $current_tab, 'herculestwp_theme_mts-' ) ) {

			$curr_tab = str_replace( array( 'mts_', 'mts-' ), '', $current_tab );
			$alt_mts_translations_opt = get_option( $curr_tab.'_strings' );

			if ( $alt_mts_translations_opt ) {

				$mts_translations = $alt_mts_translations_opt;
			}
		}
	    //$mts_translations = $mts_translations_opt ? $mts_translations_opt : array();

		$poparser = new HERCULES_WP_Translate_Po_Parser();
        $entries = $poparser->read( $file );
        $i = 0;
        
        $page = (empty($_POST['page']) ? 1 : (int) $_POST['page']);
        $search_query = (empty($_POST['search']) ? '' : $_POST['search']);
        $strings_per_page =  (empty($_POST['per_page']) ? 60 : (int) $_POST['per_page']);
        
        $tr_options = get_option( 'herculestwp_translations' );
        $per_page = isset($tr_options['strings_per_page']) ? $tr_options['strings_per_page'] : 60;
        if ( $per_page !== $strings_per_page ) {
        	$tr_options['strings_per_page'] = $strings_per_page;
        	update_option( 'herculestwp_translations', $tr_options );
        }
        $strings_tmp = array();
        if ($search_query) {
            foreach ($entries as $string_id => $object) {
                $message = '';
                foreach ($object['msgid'] as $line) {
                    $message .= $line;
                }
                $value = (empty($mts_translations[$message]) ? '' : $mts_translations[$message]);
                if (stristr($value, $search_query) !== false || stristr($message, $search_query) !== false) {
                    $strings_tmp[$string_id] = $object;
                }
            }
            $entries = $strings_tmp;
        }
        $number = count($entries);
        $number_translated = 0;

        $this->mts_translation_pagination($number, $strings_per_page, $page);
        
        $form = '';
        foreach ($entries as $string_id => $object) {
            $i++;
            $message = '';
            foreach ($object['msgid'] as $line) {
                $message .= $line;
            }
            
            if (!empty($mts_translations[$message]))
                $number_translated++;
                
            if ($i > ($page-1)*$strings_per_page && $i <= $page*$strings_per_page) {
                
                $reference = '';
                if ( isset( $object['reference'] ) ) {

                	$reference = implode(' ', $object['reference']);
                	$reference = implode(', ', explode(' ', $reference));
                }
                
                $value = (empty($mts_translations[$message]) ? '' : $mts_translations[$message]);
                $form .= '<div class="translate-string-wrapper">';
                // debug
                //echo '<!-- '.print_r($object,1).' -->';
                $form .= '<label for="translate-string-'.$i.'">'.esc_html($message).' <span>('.$reference.')</span></label>';
                //echo '<input type="text" name="'.$this->args['opt_name'].'[translations]['._wp_specialchars( $message, ENT_QUOTES, false, true ).']" id="translate-string-'.$i.'" value="'._wp_specialchars( $value, ENT_QUOTES, false, true ).'">';
                $form .= '<textarea id="translate-string-'.$i.'" data-id="'._wp_specialchars( $message, ENT_QUOTES, false, true ).'" class="mts_translate_textarea">';
                    $form .= esc_textarea($value);
                $form .= '</textarea>';
                $form .= '</div>';
            }
        }
        
        echo $form;
        
        if ($number == 0) 
            $percent = 0;
        else
            $percent = $number_translated / $number * 100;
            
        echo '<div class="translation_info">'.sprintf(__('Translated <span class="translated">%1$d</span> strings out of <span class="total">%2$d</span> <span class="percent">(%3$.2f%%)</span>', $this->plugin_name ), $number_translated, $number, $percent).'</div>';
        
        exit; // required for AJAX in WP
    }
    
    /**
	 * Translation panel pagination.
	 *
	 * @since    1.0.0
	 */
    public function mts_translation_pagination( $items_number, $items_per_page, $current = 1 ) {
        $max_page = ceil($items_number / $items_per_page);
        echo '<div class="mts_translation_pagination">';
        echo '<span class="mts_translation_pagination_label">' . __( 'Page:', $this->plugin_name ) . '</span>';
        for ($i = 1; $i <= $max_page; $i++) {
            echo '<a href="#"'.($i == $current ? ' class="current"' : '').'>'.$i.'</a> ';
        }
        echo '</div>';
    }
    
    /**
	 * Save single translation instantly.
	 *
	 * @since    1.0.0
	 */
    public function ajax_herculestwp_save_translation() {
        $id = stripslashes($_POST['id']);
        $val = stripslashes($_POST['val']);
        $current_tab = 'herculestwp_theme_buzzblogpro';
        
        if ( empty( $id ) || ! is_string( $id ) || ! is_string( $val ) ) {
            echo 0;
            exit;
        }
        
        $mts_translations = array();
        $strings_opt_name = $current_tab.'_strings';
		$mts_translations_opt = get_option( $strings_opt_name);
		if ( $mts_translations_opt ) {

			$mts_translations = $mts_translations_opt;

		} else if ( false !== strpos( $current_tab, 'herculestwp_theme_mts_' ) || false !== strpos( $current_tab, 'herculestwp_theme_mts-' ) ) {

			$curr_tab = str_replace( array( 'mts_', 'mts-' ), '', $current_tab );
			$alt_mts_translations_opt = get_option( $curr_tab.'_strings' );
			$strings_opt_name = $curr_tab.'_strings';

			if ( $alt_mts_translations_opt ) {

				$mts_translations = $alt_mts_translations_opt;
			}
		}

        if ( empty( $val ) && isset( $mts_translations[ $id ] ) ) {

        	unset( $mts_translations[ $id ] );

        } else {

        	$mts_translations[ $id ] = $val;
        }

        update_option( $strings_opt_name, $mts_translations );
        echo 1;
        
        exit;
    }


    /**
	 * Save enabled/disabled state.
	 *
	 * @since    1.0.0
	 */
    public function ajax_herculestwp_save_state() {

        $tab = $_POST['tab'];

        $tab_option = get_option( $tab, array() );

        if ( isset( $tab_option['translate'] ) ) {

        	unset( $tab_option['translate'] );

        } else {

        	$tab_option['translate'] = '1';
        }

        update_option( $tab, $tab_option );

        die();
    }

    /**
	 * Import strings.
	 *
	 * @since    1.0.0
	 */
    public function ajax_herculestwp_import_strings() {

        $tab = $_POST['tab'];
        $strings_opt_name = $_POST['strings_opt_name'];
        $import_code = stripslashes( $_POST['import_code'] );

        if ( $this->isSerialized( $import_code ) ) {

        	$import_code_arr = unserialize( $import_code );
        	update_option( $strings_opt_name, $import_code_arr );
        	echo '1';

        } else {

        	echo '<p class="herculestwp-import-error">'.__( 'Something is wrong with import data. Please paste valid code and try again.', $this->plugin_name ).'</p>';
        }

        die();
    }

    /**
	 * Check/Validate import code.
	 *
	 * http://php.net/manual/en/function.unserialize.php#85097
	 *
	 * @since    1.0.0
	 */
    function isSerialized($str) {

    	return ( $str == serialize( false ) || @unserialize( $str ) !== false );
	}

    /**
	 * Update Export textarea code.
	 *
	 * @since    1.0.0
	 */
    public function ajax_herculestwp_update_export_code() {

        $tab = $_POST['tab'];
        $strings_opt_name = $_POST['strings_opt_name'];

        $mts_translations = get_option( $strings_opt_name, array() );
        $export_val = empty( $mts_translations ) ? '' : serialize( $mts_translations );

        echo $export_val;

        die();
    }


    /**
	 * Get .po file for download.
	 *
	 * @since    1.0.0
	 */
    public function get_po() {

        global $pagenow;

        if ( $pagenow == 'admin.php' && current_user_can('export') && isset( $_GET['page'] ) && $_GET['page'] == $this->plugin_name && isset( $_GET['download'] ) && $_GET['download'] == '1' ) {

        	header("Content-type: application/x-msdownload");
        	header("Content-Disposition: attachment; filename={$_GET['tab']}.po");
        	header("Pragma: no-cache");
        	header("Expires: 0");
        	echo $this->get_po_contents( $_GET['tab'] );
        	exit();
        }
    }

    /**
	 * Return contents of new po file.
	 *
	 * @since    1.0.0
	 */
    public function get_po_contents( $tab ) {

    	$file = $this->find_lang_file( $tab );
    	$output = '';
    	if ( empty( $file ) ) {
    		return $output;
    	}

    	$poparser = new HERCULES_WP_Translate_Po_Parser();

        $entries = $poparser->read( $file );

        $name = str_replace( array( 'mts_', 'mts-' ), '', $tab );
        $strings_to_update = get_option( $name.'_strings', array() );

        foreach ( $strings_to_update as $key => $value ) {

        	$poparser->update_entry( $key, $value );
        }

        $output = $poparser->output( $file );

        return $output;
    }

    /**
	 * Remove MyThemeShop themes string translation.
	 *
	 * @since    1.0.0
	 */
    public function mts_remove_theme_custom_translate() {

    	remove_filter( 'gettext', 'mts_custom_translate', 20, 3 );
    }

    /**
	 * Return translated string.
	 *
	 * @since    1.0.0
	 */
    public function mts_custom_translate( $translated_text, $text, $domain ) {

    	if ( 'mythemeshop' === $domain || 'nhp-opts' === $domain ) {

    		$theme = wp_get_theme();

    		$mts_theme_translate = get_option( 'herculestwp_theme_'.$theme->stylesheet, array() );
		    if ( !empty( $mts_theme_translate ) && isset( $mts_theme_translate['translate'] ) ) {

		    	$name = str_replace( array( 'mts_', 'mts-' ), '', $theme->stylesheet );

		    	$mts_theme_translations = get_option( 'herculestwp_theme_'.$name.'_strings', array() );

		    	if ( $mts_theme_translations && !empty( $mts_theme_translations[ $text ] ) ) {

		    		$translated_text = $mts_theme_translations[ $text ];
		        }
		    }
	    }

	    $herculestwp_theme_translate = get_option( 'herculestwp_theme_'.$domain, array() );
	    if ( !empty( $herculestwp_theme_translate ) && isset( $herculestwp_theme_translate['translate'] ) ) {

	    	$name = str_replace( array( 'mts_', 'mts-' ), '', $domain );

	    	$herculestwp_theme_translations = get_option( 'herculestwp_theme_'.$name.'_strings', array() );

	    	if ( !empty( $herculestwp_theme_translate ) && isset( $herculestwp_theme_translate['translate'] ) && !empty( $herculestwp_theme_translations ) && !empty( $herculestwp_theme_translations[ $text ] ) ) {

	    		$translated_text = $herculestwp_theme_translations[ $text ];
	        }
	    }

	    $herculestwp_theme_translate_alt = get_option( 'herculestwp_theme_mts_'.$domain, array() );
	    if ( !empty( $herculestwp_theme_translate_alt ) && isset( $herculestwp_theme_translate_alt['translate'] ) ) {

	    	$name = str_replace( array( 'mts_', 'mts-' ), '', $domain );

	    	$herculestwp_theme_translations = get_option( 'herculestwp_theme_'.$name.'_strings', array() );

	    	if ( !empty( $herculestwp_theme_translate_alt ) && isset( $herculestwp_theme_translate_alt['translate'] ) && !empty( $herculestwp_theme_translations ) && !empty( $herculestwp_theme_translations[ $text ] ) ) {

	    		$translated_text = $herculestwp_theme_translations[ $text ];
	        }
	    }


        return $translated_text;
    }

}
