<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'init', 'buzzblogpro_register_menus' );

if( !function_exists( 'buzzblogpro_register_menus' ) ) :
    function buzzblogpro_register_menus() {
	    	register_nav_menus(
	  		array(
	  		  'primary-menu' => esc_html__( 'Primary Menu', 'buzzblogpro' ),
			  'split-right-menu' => esc_html__( 'Split right menu', 'buzzblogpro' ),
			  'top-menu' => esc_html__( 'Top Menu', 'buzzblogpro' ),
			  'mobile_menu' => esc_html__( 'Mobile Menu', 'buzzblogpro' ),
	  		  'footer_menu' => esc_html__( 'Footer Menu', 'buzzblogpro' )
	  		)
	  	);
    }
	
endif;


if( ! class_exists('Buzzblogpro_Mega_Menu_Walker') ) {

	class Buzzblogpro_Mega_Menu_Walker extends Walker_Nav_Menu {
		static $mega_open = false;

		function render_widget_menu( $item, $dropdown_wrapper, $class_names = '' ) {
			$output = '';
			if( $dropdown_wrapper ) {
				$title = apply_filters( 'the_title', $item->title, $item->ID );
				
				$output .= "<li id='menu-item-$item->ID' $class_names><a href='#'>" . $title . '</a><ul class="mega-sub-menu sub-menu">';
			}

			$menu_widget = Buzzblogpro_Widgets_Menu::get_instance()->get_widget_menu_class( $item );
			$output .= '<div class="mega-container buzzblogpro-widget-menu ">' . Buzzblogpro_Widgets_Menu::get_instance()->render_widget(
				$menu_widget,
				Buzzblogpro_Widgets_Menu::get_instance()->get_widget_options( $item->ID ),
				array(
					'widget_id' => $item->ID
				)
			) . '</div>';

			if( $dropdown_wrapper ) {
				$output .= '</ul>';
			}

			return $output;
		}

		function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {

			$classes = empty ( $item->classes ) ? array () : (array) $item->classes;
			$dropdown_columns = get_post_meta( $item->ID, '_buzzblogpro_dropdown_columns', true );
			if( ! empty( $dropdown_columns ) ) {
				$classes[] = 'widget-in-menu dropdown-columns-' . $dropdown_columns;
			}
			if( $dropdown_columns == 'widget-fullwidth' ) {
			$classes[] = 'has-sub-menu has-mega-column widget-in-menu';
}
			$class_names = join(' ', apply_filters(	'nav_menu_css_class', array_filter( $classes ), $item ));
			$class_names = !empty ( $class_names )? 'class="'.esc_attr( $class_names ).'"' : '';

			/* handle the display of widget menu items */
			if( Buzzblogpro_Widgets_Menu::get_instance()->is_menu_widget( $item ) ) {
				$output .= $this->render_widget_menu( $item, $depth == 0, $class_names );
				return $output;
			}

			$li_attributes = '';
			/* required for "mega" menu type which displays posts from a taxonomy term */
			if( $item->type == 'taxonomy' ) {
			
				$li_attributes .= 'data-termid="' . $item->object_id . '" data-tax="' . $item->object . '" data-itemid="' . $item->ID . '" ' ;
				if( !empty($item->classes) && is_array($item->classes) && in_array('no-sub-menu', $item->classes) ){
                $li_attributes .=  'data-nosubmenu="4"';
			}
			}

			$output .= "<li id='menu-item-$item->ID' $class_names $li_attributes>";

			$attributes  = !empty( $item->attr_title )? ' title="'  . esc_attr( $item->attr_title ) . '"': '';
			$attributes .= !empty( $item->target )    ? ' target="' . esc_attr( $item->target     ) . '"': '';
			$attributes .= !empty( $item->xfn )       ? ' rel="'    . esc_attr( $item->xfn        ) . '"': '';
			$attributes .= !empty( $item->url )       ? ' href="'   . esc_attr( $item->url        ) . '"': '';

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			$item_output = $args->before. "<a $attributes>" . $args->link_before . wp_kses_post($title) . '</a> ' . $args->link_after . $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			if( true == self::$mega_open ) return; 
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"sub-menu\">\n";
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
			if( true == self::$mega_open ) return;
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
		}

		function display_element( $item, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
			$id_field = $this->db_fields['id'];

			if ( ! empty( $children_elements[ $item->$id_field ] ) ) {
				$item->classes[] = 'has-sub-menu';
			}
			if ( ! empty( $children_elements[ $item->$id_field ] ) && count($children_elements[ $item->$id_field ]) === 1 ) {
				$item->classes[] = 'no-sub-menu';
			}
			
			if( ( (
					'taxonomy' == $item->type || 'custom' == $item->type || ( 'post_type' == $item->type && 'page' == $item->object )
				) && buzzblogpro_is_mega_menu_type( $item->ID, 'mega' ) )
				|| in_array( 'mega', $item->classes ) // backward compatibility
			) {
				$item->classes[] = 'mega';
				$item->classes[] = 'has-mega-sub-menu';
				if ( ! empty( $children_elements[ $item->$id_field ] ) ) {
					foreach( $children_elements[ $item->$id_field ] as $child ) {
						$child->classes[] = 'mega-sub-item';
					}
				}
			} elseif(
				(
					( 'custom' == $item->type && buzzblogpro_is_mega_menu_type( $item->$id_field, 'column' ) )
					||
					( 'post_type' == $item->type && 'page' == $item->object && buzzblogpro_is_mega_menu_type( $item->$id_field, 'column' ) )
				)
				|| in_array( 'columns', $item->classes ) // backwards compatibility
			) {
				$item->classes[] = 'has-mega-column';
				if ( ! empty( $children_elements[ $item->$id_field ] ) ) {
					foreach( $children_elements[ $item->$id_field ] as $child ) {
						$child->classes[] = 'columns-sub-item';
					}
				}
			} elseif( in_array( 'columns-sub-item', $item->classes ) ) {
				if ( ! empty( $children_elements[ $item->$id_field ] ) ) {
					foreach( $children_elements[ $item->$id_field ] as $child ) {
						$child->classes[] = 'columns-sub-item';
					}
				}
			}

			Walker_Nav_Menu::display_element( $item, $children_elements, $max_depth, $depth, $args, $output );
		}
	}
}

if( ! function_exists('buzzblogpro_theme_mega_get_posts') ) {

	function buzzblogpro_theme_mega_get_posts( $term_id, $taxonomy, $howmany, $itemid ) {
		$taxObject  = get_taxonomy( $taxonomy );
		
		if ( is_wp_error( $taxObject ) || empty( $taxObject ) ) {
			return '';
		}
		$mega_posts = '<article itemscope itemtype="http://schema.org/Article" class="post"><p class="post-title">'.esc_html__('Error loading posts.', 'buzzblogpro').'</p></article>';

		$term_query_args = apply_filters( 'buzzblogpro_mega_menu_query',
			array(
				'post_type' => $taxObject->object_type,
				'meta_key' => '_thumbnail_id',
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy,
						'field' => 'id',
						'terms' => $term_id
					)
				),
				'suppress_filters' => false,
				'posts_per_page' => $howmany
			)
		);
		
	
		$posts = new WP_query( $term_query_args );
		ob_start();
		echo '<div class="row">';
		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) {
		$posts->the_post();
			
			
			
				setup_postdata( $post );
				if($howmany == 3) {
			echo '<div class="col-xs-4 col-sm-4 col-md-4">';
			}else{
			
			echo '<div class="col-xs-3 col-sm-3 col-md-3">';
			}
				
				get_template_part( 'includes/main-menu/loop-megamenu', get_post_type() );
				echo '</div>';
			}
			
			wp_reset_postdata();
			}
			wp_reset_query();
			echo '</div>';
			$mega_posts = ob_get_clean();
			
		
		return $mega_posts;
	}
}

if( ! function_exists( 'buzzblogpro_theme_mega_posts' ) ) {

	/**
	 * Called with AJAX to return posts
	 * @since 1.0.0
	 */
	function buzzblogpro_theme_mega_posts() {
		$termid = isset( $_GET['termid'] )? $_GET['termid']: '';
		$itemid = isset( $_GET['itemid'] )? $_GET['itemid']: '';
		$taxonomy  = isset( $_GET['tax'] )? $_GET['tax']: 'category';
		$howmany = isset( $_GET['nosubmenu'] ) ? $_GET['nosubmenu'] : '3';
		echo buzzblogpro_theme_mega_get_posts( $termid, $taxonomy, $howmany, $itemid );
		die();
	}
}


add_action('wp_ajax_buzzblogpro_theme_mega_posts', 'buzzblogpro_theme_mega_posts');
add_action('wp_ajax_nopriv_buzzblogpro_theme_mega_posts', 'buzzblogpro_theme_mega_posts');

if ( ! function_exists( 'buzzblogpro_theme_maybe_do_mega_menu' ) ) {

	function buzzblogpro_theme_maybe_do_mega_menu() {
			return true;
	}
}


if ( ! function_exists( 'buzzblogpro_theme_main_menu' ) ) {

	function buzzblogpro_theme_main_menu($menuid = 'primary-menu', $menuclass = 'primary-menu') {
			

		$args = array(
			'theme_location' => $menuid,
			'fallback_cb'    => 'buzzblogpro_default_main_nav',
			'container'      => '',
			'menu_id'        => $menuid,
			'menu_class'     => $menuclass,
			'echo' => false
		);
		
		$queried_object = get_queried_object();
		$entry_id = isset( $queried_object->ID ) ? $queried_object->ID : 0;

		
		$args = wp_parse_args( $args, array(
			'theme_location' => $menuid,
			'fallback_cb' => 'buzzblogpro_default_main_nav',
			'container'   => '',
			'menu_id'     => $menuid,
			'menu_class'  => $menuclass,
			'echo' => false));

		
		$custom_menu = get_post_meta( $entry_id, 'custom_menu', true );
		if ( ! empty( $custom_menu ) ) {
			$args['menu'] = $custom_menu;
		}

		$menu_type = 'main';

		if( buzzblogpro_theme_maybe_do_mega_menu() ) {
			$args['walker'] = new Buzzblogpro_Mega_Menu_Walker;
			$menu_type = 'mega';
		}

		echo apply_filters( 'buzzblogpro_' . $menu_type . '_menu_html', wp_nav_menu( $args ), $args );
		
	}
}

function buzzblogpro_is_mega_menu_type( $item_id, $type = 'mega' ) {
	switch ( $type ) {
		case 'mega':
			if ( get_post_meta( $item_id, '_buzzblogpro_mega_menu_item', true ) == '1' ) {
				return true;
			}
			break;
		case 'column':
			if ( get_post_meta( $item_id, '_buzzblogpro_mega_menu_column', true ) == '1' ) {
				return true;
			}
			break;
		case 'dual':
			return get_post_meta( $item_id, '_buzzblogpro_mega_menu_dual', true );
			break;
	}
	return false;
}

function buzzblogpro_menu_mega_option( $item_id, $item, $depth, $args ) {
	$dropdown_columns = get_post_meta( $item_id, '_buzzblogpro_dropdown_columns', true );
	?>
	<p class="db-dropdown-columns-field description description-thin">
		<label for="edit-menu-item-db-dropdown-columns-<?php echo esc_attr( $item_id ); ?>">	
			<?php esc_html_e( 'Dropdown Columns', 'buzzblogpro' ) ?><br />
			<select name="menu-item-db-dropdown_columns[<?php echo esc_attr( $item_id ); ?>]" id="edit-menu-item-db-dropdown_columns-<?php echo esc_attr( $item_id ) ?>" class="edit-menu-item-db-dropdown_columns">
				<option value=""></option>
				<option value="2" <?php selected( 2, $dropdown_columns ) ?>>2</option>
				<option value="3" <?php selected( 3, $dropdown_columns ) ?>>3</option>
				<option value="4" <?php selected( 4, $dropdown_columns ) ?>>4</option>
				<option value="widget" <?php selected( 'widget', $dropdown_columns ) ?>>widget</option>
				<option value="widget-fullwidth" <?php selected( 'widget-fullwidth', $dropdown_columns ) ?>>widget-fullwidth</option>
			</select>
		</label>
	</p>

	<?php
	if ( $depth > 0 ) {
		return;
	}
	if ( 'taxonomy' == $item->type || 'custom' == $item->type || ( 'post_type' == $item->type && 'page' == $item->object ) ) {
		$is_mega = buzzblogpro_is_mega_menu_type( $item_id, 'mega' );
		$is_column = buzzblogpro_is_mega_menu_type( $item_id, 'column' );
		?>
		<p class="field-db-mega description description-thin">
			<label for="edit-menu-item-db-mega-<?php echo esc_attr( $item_id ); ?>">
				<?php esc_html_e( 'Mega Menu', 'buzzblogpro' ) ?><br />
				<select name="menu-item-db-mega[<?php echo esc_attr( $item_id ); ?>]" id="edit-menu-item-db-mega-<?php echo esc_attr( $item_id ) ?>" class="edit-menu-item-db-mega buzzblogpro_field_db-mega widefat"> 
					<option value=""></option>
					<option value="mega" <?php if( $is_mega ) echo 'selected';?>><?php esc_html_e( 'Mega Posts', 'buzzblogpro' ); ?></option>
					<option value="columns" <?php if( $is_column ) echo 'selected';?>><?php esc_html_e( 'Fullwidth Columns', 'buzzblogpro' ); ?></option>
				</select>
			</label>
		</p>
		<?php
	}
}
add_action( 'wp_nav_menu_item_custom_fields', 'buzzblogpro_menu_mega_option', 12, 4 );

function buzzblogpro_update_mega_menu_option( $menu_id, $menu_item_db_id, $args ) {
	$meta_keys = array(
		'_buzzblogpro_mega_menu_item_tax' => 'menu-item-db-mega_tax',
		'_buzzblogpro_dropdown_columns'   => 'menu-item-db-dropdown_columns',
		'_buzzblogpro_mega_menu_columns_layout'   => 'menu-item-db-mega-columns-layout',
	);

	/**
	 * save Mega Menu <select> option
	 * the Mega Menu option saves as two different custom fields, for backwards compatibility
	 */
	if( isset( $_POST['menu-item-db-mega'][$menu_item_db_id] ) ) {
		/* delete both keys first to ensure they are not both activated on a menu item at the same time */
		delete_post_meta( $menu_item_db_id, '_buzzblogpro_mega_menu_item' );
		delete_post_meta( $menu_item_db_id, '_buzzblogpro_mega_menu_column' );
		if( $_POST['menu-item-db-mega'][$menu_item_db_id] != '' ) {
			if( $_POST['menu-item-db-mega'][$menu_item_db_id] == 'mega' ) {
				update_post_meta( $menu_item_db_id, '_buzzblogpro_mega_menu_item', 1 );
			} else if( $_POST['menu-item-db-mega'][$menu_item_db_id] == 'columns' ) {
				update_post_meta( $menu_item_db_id, '_buzzblogpro_mega_menu_column', 1 );
			}
		}
	}

	foreach ( $meta_keys as $meta_key => $param_key ) {
		$new_meta_value = isset( $_POST[$param_key] ) && isset( $_POST[$param_key][$menu_item_db_id] ) ? $_POST[$param_key][$menu_item_db_id] : false;
		if ( $new_meta_value ) {
			update_post_meta( $menu_item_db_id, $meta_key, $new_meta_value );
		} else {
			delete_post_meta( $menu_item_db_id, $meta_key );
		}
	}
}
add_action( 'wp_update_nav_menu_item', 'buzzblogpro_update_mega_menu_option', 10, 3 );

function buzzblogpro_remove_mega_menu_meta( $post_id ) {
	if ( is_nav_menu_item( $post_id ) ) {
		delete_post_meta( $post_id, '_buzzblogpro_mega_menu_item' );
		delete_post_meta( $post_id, '_buzzblogpro_mega_menu_column' );
		delete_post_meta( $post_id, '_buzzblogpro_mega_menu_column_sub_item' );
		delete_post_meta( $post_id, '_buzzblogpro_mega_menu_dual' );
	}
}
add_action( 'delete_post', 'buzzblogpro_remove_mega_menu_meta', 1, 3 );


class Buzzblogpro_Widgets_Menu {

	private static $instance = null;
	var $meta_key = '_buzzblogpro_menu_widget';

	public static function get_instance() {
		return null == self::$instance ? self::$instance = new self : self::$instance;
	}

	private function __construct() {
		if( is_admin() ) {
			require_once( ABSPATH . 'wp-admin/includes/widgets.php' );
			add_action( 'admin_init', array( $this, 'add_menu_meta_box' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'nav_menu_script' ), 12 );
			add_action( 'admin_footer-nav-menus.php', array( $this, 'admin_footer' ) );
			add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'wp_nav_menu_item_custom_fields' ), 99, 4 );
			add_action( 'wp_update_nav_menu_item', array( $this, 'wp_update_nav_menu_item' ), 10, 3 );
		}
	}

	function add_menu_meta_box() {
		add_meta_box(
			'buzzblogpro-menu-widgets-meta',
			esc_html__( 'Widgets', 'buzzblogpro' ),
			array( $this, 'widgets_menu_meta_box' ),
			'nav-menus',
			'side',
			'high'
		);
	}

	function widgets_menu_meta_box() {
		global $wp_widget_factory;

		?>
		<div id="buzzblogpro-widget-section" class="posttypediv">
			<label for="buzzblogpro-menu-widgets"><?php esc_html_e( 'Widgets', 'buzzblogpro' ); ?>:</label>
			<select id="buzzblogpro-menu-widgets" class="widefat">
				<?php foreach( $wp_widget_factory->widgets as $widget ) : ?>
					<option value="<?php echo get_class( $widget ); ?>"><?php echo esc_attr($widget->name); ?> </option>
				<?php endforeach; ?>
			</select>

			<p class="button-controls">
				<span class="add-to-menu">
					<input type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_html_e( 'Add to Menu', 'buzzblogpro' ); ?>" name="add-post-type-menu-item" id="buzzblogpro-widget-menu-submit">
				</span>
			</p>
		</div>
		<?php
	}
	function wp_nav_menu_item_custom_fields( $item_id, $item, $depth, $args ) {
		if( $this->is_menu_widget( $item ) ) :
			global $wp_widget_factory;
			$class = $this->get_widget_menu_class( $item );


			/* Check widget availability */
			if ( ! isset( $wp_widget_factory->widgets[ $class ] ) )
				return;
			?>
			<input type="hidden" class="buzzblogpro-widget-menu-type" value="widget" />
			<div class="buzzblogpro-widget-options" style="clear: both;">
				<div class="widget-inside">
					<div class="form">
						<div class="widget-content">
							<?php echo $this->get_widget_form( $class, $item_id, $item ); ?>
						</div>
						<input type="hidden" class="id_base" name="id_base" value="<?php echo esc_attr( $wp_widget_factory->widgets[$class]->id_base ) ?>" />
						<input type="hidden" class="widget-id" name="widget-id" value="<?php echo time() ?>" />
					</div>
				</div>
			</div>
		<?php endif;
	}
	function wp_update_nav_menu_item( $menu_id, $menu_item_db_id, $args ) {
		if( isset( $_POST['menu-item-widget-options'] ) && isset( $_POST['menu-item-widget-options'][$menu_item_db_id] ) )
			$this->save_meta( $this->meta_key, $_POST['menu-item-widget-options'][$menu_item_db_id], $menu_item_db_id );
	}

	function nav_menu_script() {
		$screen = get_current_screen();
		if( 'nav-menus' != $screen->base )
			return;

		wp_enqueue_script( 'buzzblogpro-widgets-menu-admin', get_template_directory_uri() . '/includes/main-menu/admin/js/admin-nav-menu.js', array( 'jquery' ) );
		wp_enqueue_style( 'buzzblogpro-widgets-menu-admin', get_template_directory_uri() . '/includes/main-menu/admin/css/megamenu-admin.css' );

		do_action( 'buzzblogpro_widgets_menu_enqueue_admin_scripts' );
		remove_action( 'admin_enqueue_scripts', array( &$this, 'nav_menu_script' ), 12 );

		/* fire enqueue events for Widgets Manager in Menus screen */
		do_action( 'sidebar_admin_setup' );
		do_action( 'admin_enqueue_scripts', 'widgets.php' );
		do_action( "admin_print_styles-widgets.php" );
		do_action( "admin_print_scripts-widgets.php" );
	}

	function admin_footer() {
		do_action( 'admin_footer-widgets.php' );
	}
	/**
	 * Returns an array of all registered widget classes
	 *
	 * @return array
	 */
	function get_widget_types() {
		global $wp_widget_factory;

		return array_keys( (array) $wp_widget_factory->widgets );
	}

	/**
	 * Checks if the menu item is of "widget" type and returns the widget's base class name
	 *
	 * @return mixed string name of the base widget class, false otherwise
	 */
	function get_widget_menu_class( $item ) {
		$type = ltrim( $item->url, '#' );
		if( in_array( $type, $this->get_widget_types() ) ) {
			return $type;
		}

		return false;
	}

	function is_menu_widget( $item ) {
		if( $this->get_widget_menu_class( $item ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Generates the widget form required for widget menu types
	 *
	 * @return string
	 */
	function get_widget_form( $widget, $item_id, $item ) {
	global $wp_widget_factory;

		$options = $this->get_widget_options( $item_id );

		ob_start();
		$wp_widget_factory->widgets[$widget]->form( $options );
		do_action_ref_array( 'in_widget_form', array( $wp_widget_factory->widgets[$widget], null, $options ) );
		$form = ob_get_clean();
		$base_name = 'widget-' . $wp_widget_factory->widgets[$widget]->id_base . '\[' . $wp_widget_factory->widgets[$widget]->number . '\]';
		$form = preg_replace( "/{$base_name}/", 'menu-item-widget-options['. $item_id .']', $form );

		return $form;
	}


	/**
	 * Returns saved options for a widget menu type
	 *
	 * @return array
	 */
	function get_widget_options( $item_id ) {
		$options = get_post_meta( $item_id, $this->meta_key, true );
		if( ! is_array( $options ) ) {
			$options = array();
		}

		return $options; 
	}

	/**
	 * Helper method that performs proper action on a metadata based on user input
	 *
	 */
	public function save_meta( $meta_key, $new_meta_value, $post_id = null ) {
		global $post;

		if( ! $post_id )
			$post_id = $post->ID;
		$meta_value = get_post_meta( $post_id, $meta_key, true );
		if ( $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		elseif ( $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		elseif ( '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );
	}

	/**
	 * Renders a widget using the provided options
	 *
	 * @return string
	 */
	function render_widget( $widget, $instance, $args = array() ) {
		ob_start();
		
		$args = array(
		'before_widget' => '<div id="%1$s" class="menu-widget-content"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>'
	);

		the_widget( $widget, $instance, apply_filters( 'buzzblogpro_widget_menu_args', $args ) );
		return ob_get_clean();
	}
}
Buzzblogpro_Widgets_Menu::get_instance();