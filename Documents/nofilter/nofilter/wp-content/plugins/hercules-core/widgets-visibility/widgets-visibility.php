<?php
if( ! class_exists( 'Buzzblogpro_WidgetsVisibility' ) ) {
class Buzzblogpro_WidgetsVisibility{
	var $transient_name = 'buzzblogpro_widgets_visibility';
	var $checked = array();
	var $id_base = '';
	var $number = '';
    
	// pages on site
	var $pages = array();
    
	// custom post types
	var $cposts = array();
    
	// taxonomies
	var $taxes = array();
    
	// categories
	var $cats = array();
    
	// WPML languages
	var $langs = array();
    
	function __construct(){
		add_filter( 'widget_display_callback', array( &$this, 'show_widget' ) );
        
		// change the hook that triggers widget check
		$hook = apply_filters( 'hs_callback_trigger', 'wp_loaded' );
        
		add_action( $hook, array( &$this, 'trigger_widget_checks' ) );
		add_action( 'in_widget_form', array( &$this, 'hidden_widget_options'), 10, 3 );
		add_filter( 'widget_update_callback', array( &$this, 'update_widget_options' ), 10, 3 );
		add_action( 'wp_ajax_hs_show_widget', array( &$this, 'show_widget_options' ) );
		add_action( 'admin_footer', array( &$this, 'load_js' ) );
        
		// when a page is saved
		add_action( 'save_post_page', array( &$this, 'delete_transient' ) );
        
		// when a new category/taxonomy is created
		add_action( 'created_term', array( &$this, 'delete_transient' ) );
        
		// when a custom post type is added
		add_action( 'update_option_rewrite_rules', array( &$this, 'delete_transient' ) );

		// get custom Page Walker
		$this->page_list = new HS_Walker_Page_List();
	}
    
	function trigger_widget_checks() {
		add_filter( 'sidebars_widgets', array( &$this, 'sidebars_widgets' ) );
	}

	function show_widget( $instance ) {
		$instance['hs_logged'] = self::show_logged( $instance );
        
		// check logged in first
		if ( in_array( $instance['hs_logged'], array( 'in', 'out' ) ) ) {
			$user_ID = is_user_logged_in();
			if ( ( 'out' == $instance['hs_logged'] && $user_ID ) || ( 'in' == $instance['hs_logged'] && ! $user_ID ) ) {
				return false;
			}
		}
        
		$post_id = get_queried_object_id();
		$post_id = self::get_lang_id( $post_id, 'page' );

		if ( is_home() ) {
			$show = isset( $instance['page-home'] ) ? $instance['page-home'] : false;
			if ( ! $show && $post_id ) {
				$show = isset( $instance[ 'page-' . $post_id ] ) ? $instance[ 'page-' . $post_id ] : false;
			}
            
			// check if blog page is front page too
			if ( ! $show && is_front_page() && isset( $instance['page-front'] ) ) {
				$show = $instance['page-front'];
			}
		} else if ( is_front_page() ) {
			$show = isset( $instance['page-front'] ) ? $instance['page-front'] : false;
			if ( ! $show && $post_id ) {
				$show = isset( $instance[ 'page-' . $post_id ] ) ? $instance[ 'page-' . $post_id ] : false;
			}
		} else if ( is_category() ) {
			$show = isset( $instance['cat-all'] ) ? $instance['cat-all'] : false;

			if ( ! $show ) {
				$show = isset( $instance['cat-' . get_query_var('cat') ] ) ? $instance[ 'cat-' . get_query_var('cat') ] : false;
			}
		} else if ( is_tax() ) {
			$term = get_queried_object();
			$show = isset( $instance[ 'tax-' . $term->taxonomy ] ) ? $instance[ 'tax-'. $term->taxonomy] : false;
			unset( $term );
		} else if ( is_post_type_archive() ) {
			$type = get_post_type();
			$show = isset( $instance[ 'type-' . $type . '-archive' ] ) ? $instance[ 'type-' . $type . '-archive' ] : false;
		} else if ( is_archive() ) {
			$show = isset( $instance['page-archive'] ) ? $instance['page-archive'] : false;
		} else if ( is_single() ) {
			$type = get_post_type();
			if ( $type != 'page' && $type != 'post' ) {
				$show = isset( $instance[ 'type-' . $type ] ) ? $instance[ 'type-' . $type ] : false;
			}

			if ( ! isset( $show ) ) {
				$show = isset( $instance['page-single'] ) ? $instance['page-single'] : false;
			}

			if ( ! $show ) {
				$cats = get_the_category();
				foreach ( $cats as $cat ) {
					if ( $show ) {
						break;
					}
					$c_id = self::get_lang_id( $cat->cat_ID, 'category' );
					if ( isset( $instance[ 'cat-' . $c_id ] ) ) {
						$show = $instance[ 'cat-' . $c_id ];
					}
					unset( $c_id, $cat );
				}
			}
            
		} else if ( is_404() ) {
			$show = isset( $instance['page-404'] ) ? $instance['page-404'] : false;
		} else if ( is_search() ) {
			$show = isset( $instance['page-search'] ) ? $instance['page-search'] : false;
		} else if ( $post_id ) {
			$show = isset( $instance[ 'page-' . $post_id ] ) ? $instance[ 'page-' . $post_id ] : false;
		} else {
			$show = false;
		}

		if ( $post_id && ! $show && isset( $instance['other_ids'] ) && ! empty( $instance['other_ids'] ) ) {
			$other_ids = explode( ',', $instance['other_ids'] );
			foreach ( $other_ids as $other_id ) {
				if ( $post_id == (int) $other_id ) {
					$show = true;
				}
			}
		}

		$show = apply_filters( 'hs_instance_visibility', $show, $instance );
	
		if ( ! $show && defined( 'ICL_LANGUAGE_CODE' ) ) {
			// check for WPML widgets
			$show = isset( $instance[ 'lang-' . ICL_LANGUAGE_CODE ] ) ? $instance[ 'lang-' . ICL_LANGUAGE_CODE ] : false;
		}

		if ( ! isset( $show ) ) {
			$show = false;
		}

		$instance['hs_include'] = isset( $instance['hs_include'] ) ? $instance['hs_include'] : 0;
        
		if ( ( $instance['hs_include'] && false == $show ) || ( 0 == $instance['hs_include'] && $show ) ) {
			return false;
		} else if ( defined('ICL_LANGUAGE_CODE') && $instance['hs_include'] && $show && ! isset( $instance[ 'lang-' . ICL_LANGUAGE_CODE ] ) ) {
			//if the widget has to be visible here, but the current language has not been checked, return false
			return false;
		}
        
		return $instance;
	}

	function sidebars_widgets( $sidebars ) {
		if ( is_admin() ) {
			return $sidebars;
		}

		global $wp_registered_widgets;

		foreach ( $sidebars as $s => $sidebar ) {
			if ( $s == 'wp_inactive_widgets' || strpos( $s, 'orphaned_widgets' ) === 0 || empty( $sidebar ) ) {
				continue;
			}

			foreach ( $sidebar as $w => $widget ) {
				// $widget is the id of the widget
				if ( ! isset( $wp_registered_widgets[ $widget ] ) ) {
					continue;
				}

				if ( isset( $this->checked[ $widget ] ) ) {
					$show = $this->checked[ $widget ];
				} else {
					$opts = $wp_registered_widgets[ $widget ];
					$id_base = is_array( $opts['callback'] ) ? $opts['callback'][0]->id_base : $opts['callback'];

					if ( ! $id_base ) {
						continue;
					}

					$instance = get_option( 'widget_' . $id_base );

					if ( ! $instance || ! is_array( $instance ) ) {
						continue;
					}

					if ( isset( $instance['_multiwidget'] ) && $instance['_multiwidget'] ) {
						$number = $opts['params'][0]['number'];
						if ( ! isset( $instance[ $number ] ) ) {
							continue;
						}

						$instance = $instance[ $number ];
						unset( $number );
					}

					unset( $opts );

					$show = self::show_widget( $instance );

					$this->checked[ $widget ] = $show ? true : false;
				}

				if ( ! $show ) {
					unset( $sidebars[ $s ][ $w ] );
				}

				unset( $widget );
			}
			unset( $sidebar );
		}

		return $sidebars;
	}
    
	function hidden_widget_options( $widget, $return, $instance ) {
		if ( $_POST && isset( $_POST['id_base'] ) && $_POST['id_base'] == $widget->id_base ) {
			// widget was just saved so it's open
			self::show_hide_widget_options( $widget, $return, $instance );
			return;
		}
        
		self::register_globals();
        
		$instance['hs_include'] = isset( $instance['hs_include'] ) ? $instance['hs_include'] : 0;
		$instance['hs_logged'] = self::show_logged( $instance );
		$instance['other_ids'] = isset( $instance['other_ids'] ) ? $instance['other_ids'] : '';
?>
<div class="hs_opts">
	<input type="hidden" name="<?php echo esc_attr( $widget->get_field_name('hs_include') ); ?>" id="<?php echo esc_attr( $widget->get_field_id('hs_include') ); ?>" value="<?php echo esc_attr( $instance['hs_include'] ) ?>" />
	<input type="hidden" id="<?php echo esc_attr( $widget->get_field_id('hs_logged') ); ?>" name="<?php echo esc_attr( $widget->get_field_name('hs_logged') ); ?>" value="<?php echo esc_attr( $instance['hs_logged'] ) ?>" />
    
    <?php
	foreach ( $instance as $k => $v ) {
		if ( ! $v ) {
			continue;
		}
            
		if ( strpos( $k, 'page-' ) === 0 || strpos( $k, 'type-' ) === 0 || strpos( $k, 'cat-' ) === 0 || strpos( $k, 'tax-' ) === 0 || strpos( $k, 'lang-' ) === 0 ) {
    ?>
	<input type="hidden" id="<?php echo esc_attr( $widget->get_field_id( $k ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( $k ) ); ?>" value="<?php echo esc_attr( $v ) ?>"  />
    <?php
    	}
    } ?>
    
	<input type="hidden" name="<?php echo esc_attr( $widget->get_field_name('other_ids') ); ?>" id="<?php echo esc_attr( $widget->get_field_id('other_ids') ); ?>" value="<?php echo esc_attr( $instance['other_ids'] ) ?>" />
</div>
<?php
    }

    function show_widget_options() {
		$instance = htmlspecialchars_decode( nl2br( stripslashes( $_POST['opts'] ) ) );
        $instance = json_decode( $instance, true );
		$this->id_base = sanitize_text_field( $_POST['id_base'] );
		$this->number = sanitize_text_field( $_POST['widget_number'] );
        
        $new_instance = array();
        $prefix = 'widget-' . $this->id_base . '[' . $this->number . '][';
        foreach ( $instance as $k => $v ) {
            $n = str_replace( array( $prefix, ']'), '', $v['name'] );
            $new_instance[ $n ] = $v['value'];
        }

        self::show_hide_widget_options( $this, '', $new_instance );
        wp_die();
    }

	function show_hide_widget_options( $widget, $return, $instance ) {
		self::register_globals();
    
		$wp_page_types = self::page_types();
            
		$instance['hs_include'] = isset( $instance['hs_include'] ) ? $instance['hs_include'] : 0;
		$instance['hs_logged'] = self::show_logged( $instance );
		$instance['other_ids'] = isset( $instance['other_ids'] ) ? $instance['other_ids'] : '';
?>   
    <p>
        <label for="<?php echo esc_attr( $widget->get_field_id('hs_include') ); ?>"><?php esc_html_e( 'Show Widget for:', 'buzzblogpro' ) ?></label>
        <select name="<?php echo esc_attr( $widget->get_field_name('hs_logged') ); ?>" id="<?php echo esc_attr( $widget->get_field_id('hs_logged') ); ?>" class="widefat">
            <option value=""><?php esc_html_e( 'Everyone', 'buzzblogpro' ) ?></option>
            <option value="out" <?php echo selected( $instance['hs_logged'], 'out' ) ?>><?php esc_html_e( 'Logged-out users', 'buzzblogpro' ) ?></option>
            <option value="in" <?php echo selected( $instance['hs_logged'], 'in' ) ?>><?php esc_html_e( 'Logged-in users', 'buzzblogpro' ) ?></option>
        </select>
    </p>

     <p>
    	<select name="<?php echo esc_attr( $widget->get_field_name('hs_include') ); ?>" id="<?php echo esc_attr( $widget->get_field_id('hs_include') ); ?>" class="widefat">
            <option value="0"><?php esc_html_e( 'Hide on checked pages', 'buzzblogpro' ) ?></option>
            <option value="1" <?php echo selected( $instance['hs_include'], 1 ) ?>><?php esc_html_e( 'Show on checked pages', 'buzzblogpro' ) ?></option>
        </select>
    </p>    

<div style="height:150px; overflow:auto; border:1px solid #dfdfdf; padding:5px; margin-bottom:5px;">
    <h4 class="hs_toggle" style="cursor:pointer;margin-top:0;"><?php esc_html_e( 'Miscellaneous', 'buzzblogpro' ) ?> +/-</h4>
    <div class="hs_collapse">
    <?php
	foreach ( $wp_page_types as $key => $label ) {
		$instance['page-'. $key] = isset( $instance[ 'page-' . $key ] ) ? $instance[ 'page-' . $key ] : false;
    ?>
		<p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'page-' . $key ], true ); ?> id="<?php echo esc_attr( $widget->get_field_id('page-'. $key) ); ?>" name="<?php echo esc_attr( $widget->get_field_name('page-'. $key) ); ?>" />
        <label for="<?php echo esc_attr( $widget->get_field_id('page-'. $key) ); ?>"><?php echo esc_attr($label); ?></label></p>
    <?php
    } ?>
    </div>
    
    <h4 class="hs_toggle" style="cursor:pointer;"><?php esc_html_e( 'Pages', 'buzzblogpro') ?> +/-</h4>
    <div class="hs_collapse">
    <?php 
	foreach ( $this->pages as $page ) {
		$instance[ 'page-' . $page->ID ] = isset( $instance[ 'page-' . $page->ID ] ) ? $instance[ 'page-' . $page->ID ] : false;
	}

	// use custom Page Walker to build page list
	$args = array( 'instance' => $instance, 'widget' => $widget );
	$page_list = $this->page_list->walk( $this->pages, 0, $args );
	if ( $page_list ) {
		echo '<ul>' . $page_list . '</ul>';
	}
    ?>
    </div>
    
    <?php if ( ! empty( $this->cposts ) ) { ?>
    <h4 class="hs_toggle" style="cursor:pointer;"><?php esc_html_e( 'Custom Post Types', 'buzzblogpro' ) ?> +/-</h4>
    <div class="hs_collapse">
    <?php
		foreach ( $this->cposts as $post_key => $custom_post ) {
			$instance[ 'type-' . $post_key ] = isset( $instance[ 'type-' . $post_key ] ) ? $instance[ 'type-' . $post_key ] : false;
    ?>
		<p><input class="checkbox" type="checkbox" <?php checked( $instance['type-'. $post_key], true ); ?> id="<?php echo esc_attr( $widget->get_field_id('type-'. $post_key) ); ?>" name="<?php echo esc_attr( $widget->get_field_name('type-'. $post_key) ); ?>" />
		<label for="<?php echo esc_attr( $widget->get_field_id('type-'. $post_key) ); ?>"><?php echo stripslashes( $custom_post->labels->name ) ?></label></p>
    <?php
			unset( $post_key, $custom_post );
        } ?>
    </div>
    
    <h4 class="hs_toggle" style="cursor:pointer;"><?php esc_html_e( 'Custom Post Type Archives', 'buzzblogpro' ) ?> +/-</h4>
    <div class="hs_collapse">
	<?php
		foreach ( $this->cposts as $post_key => $custom_post ) {
			if ( ! $custom_post->has_archive ) {
				// don't give the option if there is no archive page
				continue;
			}
			$instance[ 'type-' . $post_key . '-archive' ] = isset( $instance[ 'type-' . $post_key . '-archive' ] ) ? $instance[ 'type-' . $post_key . '-archive' ] : false;
    ?>
		<p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'type-' . $post_key . '-archive' ], true ); ?> id="<?php echo esc_attr( $widget->get_field_id( 'type-'. $post_key . '-archive' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'type-' . $post_key . '-archive' ) ); ?>" />
		<label for="<?php echo esc_attr( $widget->get_field_id( 'type-' . $post_key . '-archive' ) ); ?>"><?php echo stripslashes( $custom_post->labels->name ) ?> <?php esc_html_e( 'Archive', 'buzzblogpro' ) ?></label></p>
    <?php } ?>
    </div>
    <?php } ?>
    
    <h4 class="hs_toggle" style="cursor:pointer;"><?php esc_html_e( 'Categories', 'buzzblogpro') ?> +/-</h4>
    <div class="hs_collapse">
		<?php $instance['cat-all'] = isset( $instance['cat-all'] ) ? $instance['cat-all'] : false; ?>
		<p><input class="checkbox" type="checkbox" <?php checked( $instance['cat-all'], true ); ?> id="<?php echo esc_attr( $widget->get_field_id('cat-all') ); ?>" name="<?php echo esc_attr( $widget->get_field_name('cat-all') ); ?>" />
        <label for="<?php echo esc_attr($widget->get_field_id('cat-all')); ?>"><?php esc_html_e( 'All Categories', 'buzzblogpro' ); ?></label></p>
    <?php
		foreach ( $this->cats as $cat ) {
        	$instance[ 'cat-' . $cat->cat_ID ] = isset( $instance[ 'cat-' . $cat->cat_ID ] ) ? $instance[ 'cat-' . $cat->cat_ID] : false;
    ?>
		<p><input class="checkbox" type="checkbox" <?php checked( $instance['cat-'. $cat->cat_ID], true ); ?> id="<?php echo esc_attr( $widget->get_field_id('cat-'. $cat->cat_ID) ); ?>" name="<?php echo esc_attr( $widget->get_field_name('cat-'. $cat->cat_ID) ); ?>" />
        <label for="<?php echo esc_attr($widget->get_field_id('cat-'. $cat->cat_ID)); ?>"><?php echo esc_attr($cat->cat_name); ?></label></p>
    <?php
			unset( $cat );
		}
    ?>
    </div>
    
    <?php if ( ! empty( $this->taxes ) ) { ?>
    <h4 class="hs_toggle" style="cursor:pointer;"><?php esc_html_e( 'Taxonomies', 'buzzblogpro' ) ?> +/-</h4>
    <div class="hs_collapse">
    <?php
		foreach ( $this->taxes as $tax => $taxname ) {
        	$instance[ 'tax-' . $tax ] = isset( $instance[ 'tax-' . $tax ] ) ? $instance[ 'tax-' . $tax ] : false;
    ?>
		<p><input class="checkbox" type="checkbox" <?php checked( $instance['tax-'. $tax], true ); ?> id="<?php echo esc_attr( $widget->get_field_id('tax-'. $tax) ); ?>" name="<?php echo esc_attr( $widget->get_field_name('tax-'. $tax) ); ?>" />
		<label for="<?php echo esc_attr( $widget->get_field_id('tax-'. $tax) ); ?>"><?php echo str_replace( array( '_','-' ), ' ', ucfirst( $taxname ) ) ?></label></p>
    <?php
			unset( $tax );
		}
    ?>
    </div>
    <?php } ?>
    
    <?php if ( ! empty( $this->langs ) ) { ?>
    <h4 class="hs_toggle" style="cursor:pointer;"><?php esc_html_e( 'Languages', 'buzzblogpro' ) ?> +/-</h4>
    <div class="hs_collapse">
    <?php
		foreach ( $this->langs as $lang ) {
			$key = $lang['language_code'];
			$instance[ 'lang-' . $key ] = isset( $instance[ 'lang-' . $key ] ) ? $instance[ 'lang-' . $key ] : false;
    ?>
        <p><input class="checkbox" type="checkbox" <?php checked( $instance[ 'lang-' . $key ], true ); ?> id="<?php echo esc_attr( $widget->get_field_id('lang-'. $key) ); ?>" name="<?php echo esc_attr( $widget->get_field_name('lang-'. $key) ); ?>" />
        <label for="<?php echo esc_attr( $widget->get_field_id('lang-'. $key) ); ?>"><?php echo esc_attr($lang['native_name']); ?></label></p>
       
    <?php 
			unset( $lang, $key );
		}
    ?>
    </div>
    <?php } ?>
    
	<p><label for="<?php echo esc_attr( $widget->get_field_id('other_ids') ); ?>"><?php esc_html_e( 'Comma Separated list of IDs of posts not listed above', 'buzzblogpro' ) ?>:</label>
	<input type="text" value="<?php echo esc_attr( $instance['other_ids'] ) ?>" name="<?php echo esc_attr( $widget->get_field_name('other_ids') ); ?>" id="<?php echo esc_attr( $widget->get_field_id('other_ids') ); ?>" />
    </p>
    </div>
<?php
    }

	function update_widget_options( $instance, $new_instance, $old_instance ) {
		self::register_globals();
    
		if ( ! empty( $this->pages ) ) {
			foreach ( $this->pages as $page ) {
				if ( isset( $new_instance[ 'page-' . $page->ID ] ) ) {
					$instance[ 'page-' . $page->ID ] = 1;
				} else if ( isset( $instance[ 'page-' . $page->ID ] ) ) {
					unset( $instance[ 'page-' . $page->ID ] );
				}
				unset( $page );
			}
		}

		if ( isset( $new_instance['cat-all'] ) ) {
			$instance['cat-all'] = 1;

			foreach ( $this->cats as $cat ) {
				if ( isset( $new_instance[ 'cat-' . $cat->cat_ID ] ) ) {
					unset( $instance['cat-' . $cat->cat_ID ] );
				}
			}
		} else {
			unset( $instance['cat-all'] );

			foreach ( $this->cats as $cat ) {
				if ( isset( $new_instance[ 'cat-' . $cat->cat_ID ] ) ) {
					$instance[ 'cat-' . $cat->cat_ID ] = 1;
				} else if ( isset( $instance[ 'cat-' . $cat->cat_ID ] ) ) {
					unset( $instance['cat-' . $cat->cat_ID ] );
				}
				unset( $cat );
			}
		}

		if ( ! empty( $this->cposts ) ) {
			foreach ( $this->cposts as $post_key => $custom_post ) {
				if ( isset( $new_instance[ 'type-' . $post_key ] ) ) {
					$instance['type-'. $post_key] = 1;
				} else if ( isset( $instance['type-' . $post_key ] ) ) {
					unset( $instance[ 'type-' . $post_key ] );
				}

				if ( isset( $new_instance['type-' . $post_key . '-archive' ] ) ) {
					$instance[ 'type-' . $post_key . '-archive' ] = 1;
				} else if ( isset( $instance[ 'type-' . $post_key . '-archive' ] ) ) {
					unset( $instance[ 'type-' . $post_key . '-archive' ] );
				}
                
				unset( $custom_post );
			}
		}

		if ( ! empty( $this->taxes ) ) {
			foreach ( $this->taxes as $tax => $taxname ) {
				if ( isset( $new_instance[ 'tax-' . $tax ] ) ) {
					$instance['tax-'. $tax] = 1;
				} else if ( isset( $instance[ 'tax-' . $tax ] ) ) {
					unset( $instance[ 'tax-' . $tax ] );
				}
				unset( $tax );
			}
		}

		if ( ! empty( $this->langs ) ) {
			foreach ( $this->langs as $lang ) {
				if ( isset( $new_instance[ 'lang-' . $lang['language_code'] ] ) ) {
					$instance[ 'lang-' . $lang['language_code'] ] = 1;
				} else if ( isset( $instance[ 'lang-'. $lang['language_code'] ] ) ) {
					unset( $instance[ 'lang-' . $lang['language_code'] ] ) ;
				}
				unset( $lang );
			}
		}

		$instance['hs_include'] = ( isset( $new_instance['hs_include'] ) && $new_instance['hs_include'] ) ? 1 : 0;
		$instance['hs_logged'] = ( isset( $new_instance['hs_logged'] ) && $new_instance['hs_logged'] ) ? $new_instance['hs_logged'] : '';
		$instance['other_ids'] = ( isset( $new_instance['other_ids'] ) && $new_instance['other_ids'] ) ? $new_instance['other_ids'] : '';
        
		$page_types = self::page_types();
		foreach ( array_keys( $page_types ) as $page ) {
			if ( isset( $new_instance[ 'page-'. $page ] ) ) {
				$instance[ 'page-' . $page ] = 1;
			} else if ( isset( $instance['page-' . $page ] ) ) {
				unset( $instance[ 'page-' . $page ] );
			}
		}
		unset( $page_types );

		return $instance;
	}
    
    function get_field_name( $field_name ) {
		return 'widget-' . $this->id_base . '[' . $this->number . '][' . $field_name . ']';
	}
    
	function get_field_id( $field_name ) {
		return 'widget-' . $this->id_base . '-' . $this->number . '-' . $field_name;
	}
    
    function load_js() {
        global $pagenow;
        
        if ( $pagenow != 'widgets.php' ) {
            //only load the js on the widgets page
            return;
        }
?>
<script type="text/javascript">
/*<![CDATA[*/
jQuery(document).ready(function($){
$('.widgets-holder-wrap').on('click', '.hs_toggle', hs_toggle);
});
jQuery(document.body).bind('click.widgets-toggle', hs_show_opts);
function hs_show_opts(e){
    var target = jQuery(e.target);
    var widget = target.closest('div.widget');
	var inside = widget.children('.widget-inside');
	var opts = inside.find('.hs_opts');
	if(opts.length == 0){
	    return;
	}
    
    jQuery.ajax({
		type:'POST',url:ajaxurl,
		data:{
		    'action':'hs_show_widget',
		    'opts':JSON.stringify(opts.children('input').serializeArray()),
		    'id_base':inside.find('input.id_base').val(),
		    'widget_number':(inside.find('input.multi_number').val() == '') ? inside.find('input.widget_number').val() : inside.find('input.multi_number').val()
		},
		success:function(html){ opts.replaceWith(html); }
	});
}
function hs_toggle(){jQuery(this).next('.hs_collapse').toggle();}
/*]]>*/
</script>
<?php
    }
    
    function show_logged( $instance ) {
        if ( isset( $instance['hs_logged'] ) ) {
            return $instance['hs_logged'];
        }
        
        if ( isset( $instance['hs_logout'] ) && $instance['hs_logout'] ) {
            $instance['hs_logged'] = 'out';
        } else if ( isset( $instance['hs_login'] ) && $instance['hs_login'] ) {
            $instance['hs_logged'] = 'in';
        } else {
            $instance['hs_logged'] = '';
        }
        
        return $instance['hs_logged'];
    }
    
    function page_types(){
        $page_types = array(
            'front'     => esc_html__( 'Front', 'buzzblogpro' ),
            'home'      => esc_html__( 'Blog', 'buzzblogpro' ),
            'archive'   => esc_html__( 'Archives', 'buzzblogpro'),
            'single'    => esc_html__( 'Single Post', 'buzzblogpro'),
            '404'       => '404',
            'search'    => esc_html__( 'Search', 'buzzblogpro'),
        );
        
        return apply_filters('hs_pages_types_register', $page_types);
    }

	function register_globals(){
		if ( ! empty( $this->checked ) ) {
			return;
		}
        
		$saved_details = get_transient( $this->transient_name );
		if ( $saved_details ) {
			foreach ( $saved_details as $k => $d ) {
				if ( empty( $this->{$k} ) ) {
					$this->{$k} = $d;
				}
                
				unset( $k, $d );
			}
		}
        
		if ( empty( $this->pages ) ) {
			$this->pages = get_posts( array(
				'post_type' => 'page', 'post_status' => 'publish',
				'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC',
				'fields' => array('ID', 'name'),
			));
		}
        
		if ( empty( $this->cats ) ) {
			$this->cats = get_categories( array(
				'hide_empty'    => false,
				//'fields'        => 'id=>name', //added in 3.8
			) );
		}
        
		if ( empty( $this->cposts ) ) {
			$this->cposts = get_post_types( array(
				'public' => true,
			), 'object');
            
			foreach ( array( 'revision', 'attachment', 'nav_menu_item' ) as $unset ) {
				unset( $this->cposts[ $unset ] );
			}
            
			foreach ( $this->cposts as $c => $type ) {
				$post_taxes = get_object_taxonomies( $c );
				foreach ( $post_taxes as $post_tax) {
					if ( in_array( $post_tax, array( 'category', 'post_format' ) ) ) {
						continue;
					}
                    
					$taxonomy = get_taxonomy( $post_tax );
					$name = $post_tax;

					if ( isset( $taxonomy->labels->name ) && ! empty( $taxonomy->labels->name ) ) {
						$name = $taxonomy->labels->name;
					}
                    
					$this->taxes[ $post_tax ] = $name;
				}
			}
		}
        
		if ( empty( $this->langs ) && function_exists('icl_get_languages') ) {
			$this->langs = icl_get_languages('skip_missing=0&orderby=code');
		}
        
		// save for one week
		set_transient( $this->transient_name, array(
			'pages'     => $this->pages,
			'cats'      => $this->cats,
			'cposts'    => $this->cposts,
			'taxes'     => $this->taxes,
		), 60*60*24*7 );

		if ( empty( $this->checked ) ) {
			$this->checked[] = true;
		}
	}
    
	function delete_transient() {
		delete_transient( $this->transient_name );
	}

	/* WPML support */
	function get_lang_id( $id, $type = 'page' ) {
		if ( function_exists('icl_object_id') ) {
			$id = icl_object_id( $id, $type, true );
		}
    
		return $id;
	}

}

/*
custom Page Walker class
*/
if( ! class_exists( 'HS_Walker_Page_List' ) ) {
class HS_Walker_Page_List extends Walker_Page {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n<ul class='children'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "</ul>\n";
	}

	function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		if ( $depth )
			$indent = str_repeat("&mdash; ", $depth);
		else
			$indent = '';

		// args: $instance, $widget
		extract( $args, EXTR_SKIP );
    

		if ( '' === $page->post_title ) {
			$page->post_title = sprintf( esc_html__( '#%d (no title)', 'buzzblogpro' ), $page->ID );
		}

		$output .= '<li>' . $indent;
		$output .= '<input class="checkbox" type="checkbox" ' . checked( $instance[ 'page-' . $page->ID ], true, false ) . ' id="' . esc_attr( $widget->get_field_id('page-'. $page->ID) ) . '" name="' . esc_attr( $widget->get_field_name('page-'. $page->ID) ) .'" />';

		$output .= '<label for="' . esc_attr( $widget->get_field_id('page-'. $page->ID) ) . '">' . apply_filters( 'the_title', $page->post_title, $page->ID ) . '</label>';
	}

	function end_el( &$output, $page, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}

}
}
new Buzzblogpro_WidgetsVisibility();

/*
custom Page Walker CSS
*/
function buzzblogpro_widgets_style() {
	echo '<style>';
	// use next line for normal indent instead of &mdash:
	// echo '.hs_collapse ul ul { padding-left: 1.5em; }';
	echo '.hs_collapse li { line-height: 1.5em; margin: 1em 0; }';
	echo '</style>';
}
add_action( 'admin_print_styles-widgets.php', 'buzzblogpro_widgets_style' );
}


//widget-attributes

class Hercules_Widget_Attributes {

	const VERSION = '0.2.2';

	public static function setup() {
		if ( is_admin() ) {
			// Add necessary input on widget configuration form
			add_action( 'in_widget_form', array( __CLASS__, '_input_fields' ), 10, 3 );

			// Save widget attributes
			add_filter( 'widget_update_callback', array( __CLASS__, '_save_attributes' ), 10, 4 );
		}
		else {
			// Insert attributes into widget markup
			add_filter( 'dynamic_sidebar_params', array( __CLASS__, '_insert_attributes' ) );
		}
	}

	public static function _input_fields( $widget, $return, $instance ) {
		$instance = self::_get_attributes( $instance );
		?>
			<p>
				<?php printf(
					'<label for="%s">%s</label>',
					esc_attr( $widget->get_field_id( 'widget-class' ) ),
					esc_html__( 'HTML Class(es)', 'widget-attributes' )
				) ?>
				
				
							<select id="<?php echo esc_attr( $widget->get_field_id( 'widget-class' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'widget-class' ) ); ?>" class="widefat categories" style="width:100%;">
				<option value='stylenone' <?php if ('stylenone' == $instance['widget-class']) echo 'selected="selected"'; ?>>default</option>
				<option value='style1' <?php if ('style1' == $instance['widget-class']) echo 'selected="selected"'; ?>>style1 - padding:30px;background: #f7f7f7;</option>
				<option value='style2' <?php if ('style2' == $instance['widget-class']) echo 'selected="selected"'; ?>>style2 - padding:30px;border:1px solid #f7f7f7;</option>
				<option value='style3' <?php if ('style3' == $instance['widget-class']) echo 'selected="selected"'; ?>>style3 - padding:30px;border:6px solid #222222;</option>
				<option value='style4' <?php if ('style4' == $instance['widget-class']) echo 'selected="selected"'; ?>>style4 - padding:30px;border:4px double #f7f7f7;</option>
				<option value='style5' <?php if ('style5' == $instance['widget-class']) echo 'selected="selected"'; ?>>style5 - padding:30px;background: #ffffff;</option>
				<option value='style6' <?php if ('style6' == $instance['widget-class']) echo 'selected="selected"'; ?>>style6 - padding:45px;background: #ffffff;</option>
				<option value='style7' <?php if ('style7' == $instance['widget-class']) echo 'selected="selected"'; ?>>style7 - padding:45px;background: #f7f7f7;</option>
				<option value='style8' <?php if ('style8' == $instance['widget-class']) echo 'selected="selected"'; ?>>style8 - margin-bottom:35px;border-bottom: 1px solid #eeeeee;</option>
				<option value='style9' <?php if ('style9' == $instance['widget-class']) echo 'selected="selected"'; ?>>style9 - margin-bottom:35px;</option>
				<option value='style10' <?php if ('style10' == $instance['widget-class']) echo 'selected="selected"'; ?>>style10 - margin-bottom:45px;</option>
				<option value='style11' <?php if ('style11' == $instance['widget-class']) echo 'selected="selected"'; ?>>style11 - margin-bottom:35px;padding:30px 30px;background: #ffffff;</option>
				<option value='style12' <?php if ('style12' == $instance['widget-class']) echo 'selected="selected"'; ?>>style12 - margin:0px;padding:45px;background: #f7f7f7;</option>
			</select>
			
			</p>
			
			<p>
				<?php printf(
					'<label for="%s">%s</label>',
					esc_attr( $widget->get_field_id( 'widget-custom-class' ) ),
					esc_html__( 'Custom css class', 'widget-attributes' )
				) ?>
				<?php printf(
					'<input type="text" class="widefat" id="%s" name="%s" value="%s" />',
					esc_attr( $widget->get_field_id( 'widget-custom-class' ) ),
					esc_attr( $widget->get_field_name( 'widget-custom-class' ) ),
					esc_attr( $instance['widget-custom-class'] )
				) ?>
			</p>
			
		<?php
		return null;
	}

	private static function _get_attributes( $instance ) {
		$instance = wp_parse_args(
			$instance,
			array(
				'widget-class' => '',
				'widget-custom-class' => '',
			)
		);

		return $instance;
	}

	public static function _save_attributes( $instance, $new_instance, $old_instance, $widget ) {
		$instance['widget-class'] = '';
        $instance['widget-custom-class'] = '';
		// Classes
		if ( !empty( $new_instance['widget-class'] ) ) {
			$instance['widget-class'] = $new_instance['widget-class'];

		}
		else {
			$instance['widget-class'] = '';
		}
		
				// Custom Classes
		if ( !empty( $new_instance['widget-custom-class'] ) ) {
			$instance['widget-custom-class'] = apply_filters(
				'widget_attribute_classes',
				implode(
					' ',
					array_map(
						'sanitize_html_class',
						explode( ' ', $new_instance['widget-custom-class'] )
					)
				)
			);
		}
		else {
			$instance['widget-custom-class'] = '';
		}

		return $instance;
	}

	public static function _insert_attributes( $params ) {
		global $wp_registered_widgets;

		$widget_id  = $params[0]['widget_id'];
		$widget_obj = $wp_registered_widgets[ $widget_id ];

		if (
			!isset( $widget_obj['callback'][0] )
			|| !is_object( $widget_obj['callback'][0] )
		) {
			return $params;
		}

		$widget_options = get_option( $widget_obj['callback'][0]->option_name );
		if ( empty( $widget_options ) )
			return $params;

		$widget_num	= $widget_obj['params'][0]['number'];
		if ( empty( $widget_options[ $widget_num ] ) )
			return $params;

		$instance = $widget_options[ $widget_num ];


		// Classes
		if ( ! empty( $instance['widget-class'] ) ) {
			$params[0]['before_widget'] = preg_replace(
				'/class="/',
				sprintf( 'class="%s ', $instance['widget-class']  ),
				$params[0]['before_widget'],
				1
			);
		}
		
				// Custom Classes
		if ( ! empty( $instance['widget-custom-class'] ) ) {
			$params[0]['before_widget'] = preg_replace(
				'/class="/',
				sprintf( 'class="%s ', $instance['widget-custom-class'] ),
				$params[0]['before_widget'],
				1
			);
		}

		return $params;
	}
}

add_action( 'widgets_init', array( 'Hercules_Widget_Attributes', 'setup' ) );



/*
	Plugin Name: Widget Output Cache
	Description: Caches widget output in WordPress object cache.
	Version: 0.5.2
	Plugin URI: https://wordpress.org/plugins/widget-output-cache/
	GitHub URI: https://github.com/kasparsd/widget-output-cache
	Author: Kaspars Dambis
	Author URI: http://kaspars.net
*/


WidgetOutputCache::instance();


class WidgetOutputCache {

	// Store IDs of widgets to exclude from cache
	private $excluded_ids = array();


	protected function __construct() {

		// Overwrite widget callback to cache the output
		add_filter( 'widget_display_callback', array( $this, 'widget_callback' ), 11, 3 );

		// Cache invalidation for widgets
		add_filter( 'widget_update_callback', array( $this, 'cache_bump' ) );

		// Allow widgets to be excluded from the cache
		add_action( 'in_widget_form', array( $this, 'widget_controls' ), 11, 3 );
		// Load widget cache exclude settings
		add_action( 'init', array( $this, 'init' ), 11 );

		// Save widget cache settings
		add_action( 'sidebar_admin_setup', array( $this, 'save_widget_controls' ) );
		
		add_action( 'customize_save', array( $this, 'cache_bump_custom' ) );

	}


	public static function instance() {

		static $instance;

		if ( ! $instance )
			$instance = new self();

		return $instance;

	}


	function init() {

		$this->excluded_ids = (array) get_option( 'cache-widgets-excluded', array() );

	}


	function widget_callback( $instance, $widget_object, $args ) {
if ( is_user_logged_in()) {return $instance;}

		// Don't return the widget
		if ( false === $instance || ! is_subclass_of( $widget_object, 'WP_Widget' ) )
			return $instance;

		if ( in_array( $widget_object->id, $this->excluded_ids ) )
			return $instance;

		$timer_start = microtime(true);

		$cache_key = sprintf(
				'cwdgt-%s',
				md5( $widget_object->id . get_option( 'cache-widgets-version', 1 ) )
			);

		$cached_widget = get_transient( $cache_key );

		if ( empty( $cached_widget ) ) {

			ob_start();
				$widget_object->widget( $args, $instance );
				$cached_widget = ob_get_contents();
			ob_end_clean();

			set_transient(
				$cache_key,
				$cached_widget,
				apply_filters( 'widget_output_cache_ttl', 60 * 12, $args )
			);

			printf(
				'%s <!-- Stored in widget cache in %s seconds (%s) -->',
				$cached_widget,
				round( microtime(true) - $timer_start, 4 ),
				$cache_key
			);

		} else {

			printf(
				'%s <!-- From widget cache in %s seconds (%s) -->',
				$cached_widget,
				round( microtime(true) - $timer_start, 4 ),
				$cache_key
			);

		}

		// We already echoed the widget, so return false
		return false;

	}
	function cache_bump_custom( $instance ) {


		update_option( 'cache-widgets-version', time() );

		return $instance;
		

	}

	function cache_bump( $instance ) {

	global $wp_customize;
if ( !isset( $wp_customize ) ) {
		update_option( 'cache-widgets-version', time() );

		return $instance;
		}
return $instance;
	}


	function widget_controls( $object, $return, $instance ) {

  
		$is_excluded = in_array( $object->id, $this->excluded_ids );

		printf(
			'<p>
				<label>
					<input type="checkbox" name="widget-cache-exclude" value="%s" %s />
					%s
				</label>
			</p>',
			esc_attr( $object->id ),
			checked( $is_excluded, true, false ),
			esc_html__( 'Exclude this widget from cache', 'widget-output-cache' )
		);

	}


	function save_widget_controls() {

		// current_user_can( 'edit_theme_options' ) is already being checked in widgets.php
		if ( empty( $_POST ) || ! isset( $_POST['widget-id'] ) )
			return;

		$widget_id = $_POST['widget-id'];
		$is_excluded = isset( $_POST['widget-cache-exclude'] );

		if ( ! isset($_POST['delete_widget']) && $is_excluded ) {

			// Wiget is being saved and it is being excluded too
			$this->excluded_ids[] = $widget_id;

		} elseif ( in_array( $widget_id, $this->excluded_ids ) ) {

			// Widget is being removed, remove it from exclusions too
			$exclude_pos_key = array_search( $widget_id, $this->excluded_ids );
			unset( $this->excluded_ids[ $exclude_pos_key ] );

		}

		$this->excluded_ids = array_unique( $this->excluded_ids );

		update_option( 'cache-widgets-excluded', $this->excluded_ids );

	}


}
