<?php
/**
 * Plugin Name: Hercules Core 
 * Plugin URI: http://www.hercules-design.com
 * Description: This plugin adds Gallery, FAQ custom post types, shortcodes and demo importer.
 * Version: 1.5
 * Author: Hercules
 * Author URI: 
 * License: GPL2
 */
 // Blocking direct access
if( ! function_exists( 'hercules_block_direct_access' ) ) {
	function hercules_block_direct_access() {
		if( ! defined( 'ABSPATH' ) ) {
			exit( 'Direct access denied.' );
		}
	}
}
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateCheckerplugin = Puc_v4_Factory::buildUpdateChecker(
    'https://buzzblogpro.hercules-design.com/buzzblogpro-plugins/metadata.json',
    __FILE__,
    'hercules-core'
);

global $buzzblogpro_options;
//Loading widgets
function buzzblogpro_register_widgets() {
  $buzzblogpro_widgets = array(
    'hs-recent-popular-tab-widget'         => 'hs_recent_popular_tab_widget',
    'buzzblogpro_aboutme'      => 'buzzblogpro_aboutmebox',
    'buzzblogpro-125-banner'       => 'buzzblogpro_Ad_125_125_Widget',
    'buzzblogpro-banner'         => 'buzzblogpro_banner_widget',
    'buzzblogpro-comment-widget'        => 'buzzblogpro_CommentWidget',
    'buzzblogpro-facebook-widget'     => 'buzzblogpro_Facebook_Widget',
	'buzzblogpro-flickr-widget'     => 'buzzblogpro_FlickrWidget',
	'buzzblogpro-instagram-widget'     => 'buzzblogpro_InstagramWidget',
	'buzzblogpro-twitter-class-widget'     => 'buzzblogpro_Twitter',
	'buzzblogpro-recent-news-widget'     => 'buzzblogpro_RecentNewsWidget',
	'pinterest-widget'     => 'Buzzblogpro_Pinterest_Widget',
	'mailchimp_widget' => 'Buzzblogpro_mailchimp_widget',
	'buzzblogpro-category-banner' => 'buzzblogpro_CategoryBanner',
	'widget-social-follow' => 'Buzzblogpro_SocialFollow_Widget',
	'buzzblogpro-latest-posts-widget' => 'buzzblogpro_LatestPostsWidget',
	'buzzblogpro-posts-block1-widget' => 'buzzblogpro_PostsBlock1',
	'buzzblogpro-posts-block2-widget' => 'buzzblogpro_PostsBlock2',
	'buzzblogpro-posts-block3-widget' => 'buzzblogpro_PostsBlock3',
  );
  foreach ( $buzzblogpro_widgets as $key => $value ) {
    require_once plugin_dir_path( __FILE__ ) . '/widgets/'. sanitize_key( $key ) .'.php';
    register_widget( $value );
  }
}

add_action( 'widgets_init', 'buzzblogpro_register_widgets' );

//Shortcodes
	require_once plugin_dir_path( __FILE__ ) . '/theme_shortcodes/columns.php';
	require_once plugin_dir_path( __FILE__ ) . '/theme_shortcodes/shortcodes.php';
	require_once plugin_dir_path( __FILE__ ) . '/theme_shortcodes/posts_grid.php';
	require_once plugin_dir_path( __FILE__ ) . '/theme_shortcodes/tabs.php';
	require_once plugin_dir_path( __FILE__ ) . '/theme_shortcodes/toggle.php';
	require_once plugin_dir_path( __FILE__ ) . '/theme_shortcodes/html.php';
	require_once plugin_dir_path( __FILE__ ) . '/theme_shortcodes/progressbar.php';
	require_once plugin_dir_path( __FILE__ ) . '/theme_shortcodes/skills.php';
	require_once plugin_dir_path( __FILE__ ) . '/theme_shortcodes/table.php';
	require_once plugin_dir_path( __FILE__ ) . '/theme_shortcodes/review.php';
//tinyMCE includes
	include(plugin_dir_path( __FILE__ ) . '/theme_shortcodes/tinymce/tinymce_shortcodes.php');
/* Gallery */
function buzzblogpro_post_type_gallery() {
$labels = array(
		'name'               => esc_html__( 'Gallery', 'post type general name', 'buzzblogpro' ),
		'singular_name'      => esc_html__( 'Gallery', 'post type singular name', 'buzzblogpro' ),
		'menu_name'          => esc_html__( 'Gallery', 'admin menu', 'buzzblogpro' ),
		'name_admin_bar'     => esc_html__( 'Gallery', 'add new on admin bar', 'buzzblogpro' ),
		'add_new'            => esc_html__( 'Add New Image', 'image', 'buzzblogpro' ),
		'add_new_item'       => esc_html__( 'Add New Image', 'buzzblogpro' ),
		'new_item'           => esc_html__( 'New Image', 'buzzblogpro' ),
		'edit_item'          => esc_html__( 'Edit Image', 'buzzblogpro' ),
		'view_item'          => esc_html__( 'View Image', 'buzzblogpro' ),
		'all_items'          => esc_html__( 'All Images', 'buzzblogpro' ),
		'search_items'       => esc_html__( 'Search Images', 'buzzblogpro' ),
		'parent_item_colon'  => esc_html__( 'Parent Images:', 'buzzblogpro' ),
		'not_found'          => esc_html__( 'No image found.', 'buzzblogpro' ),
		'not_found_in_trash' => esc_html__( 'No images found in Trash.', 'buzzblogpro' ),
		 'featured_image' => esc_html__( 'Image', 'buzzblogpro' ),
'set_featured_image' => esc_html__( 'Set image', 'buzzblogpro' ),
'remove_featured_image' => esc_html__( 'Remove image', 'buzzblogpro' ),
'use_featured_image' => esc_html__( 'Use image', 'buzzblogpro' )
	);
	register_post_type( 'gallery',
		array( 
				'labels'             => $labels,
				'singular_label'    => esc_html__( 'Gallery', 'buzzblogpro' ),
				'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
	'show_in_admin_bar'   => true,
		'query_var'          => true,
		'has_archive'        => true,
		'show_admin_column' => true,
		'hierarchical'       => true,
		//'exclude_from_search' => true,
		'menu_position'      => null,
		'register_meta_box_cb' => 'buzzblogpro_add_box_gallery',
				'capability_type'   => 'post',
				'rewrite'           => array(
					'slug'       => 'gallery-view',
					'pages' => true,
				),
				'supports' => array(
						'title',
						'editor',
						'thumbnail', 'comments')
					) 
				);
	register_taxonomy('gallery-categories', array( 'gallery'), array('hierarchical' => true, 'labels' => array(
                'name' => esc_html__( 'Gallery Categories', 'buzzblogpro' ),
                'add_new_item' => esc_html__( 'Add New Gallery Category', 'buzzblogpro' ),
                'new_item_name' => esc_html__( 'New Gallery Category', 'buzzblogpro' ),
            ), 'rewrite' => array( 'slug' => 'gallery-categories' ), 'query_var' => true, 'show_admin_column' => true));
	
}
add_action('init', 'buzzblogpro_post_type_gallery', 0);
/* Featured Image position */


function buzzblogpro_move_meta_box(){
   remove_meta_box( 'postimagediv', 'gallery', 'side' );
    add_meta_box('postimagediv', esc_html__( 'Image', 'buzzblogpro' ), 'post_thumbnail_meta_box', 'gallery', 'normal', 'high');
	}
add_action('do_meta_boxes', 'buzzblogpro_move_meta_box');
/* FAQs */
function buzzblogpro_post_type_faq() {
	register_post_type('faq', 
				array(
				'label' => esc_html__('FAQs', 'buzzblogpro'),
				'singular_label' => esc_html__('FAQ', 'buzzblogpro'),
				'public' => true,
				'show_ui' => true,
				'_builtin' => false, // It's a custom post type, not built in
				'_edit_link' => 'post.php?post=%d',
				'capability_type' => 'post',
				'hierarchical' => false,
				'show_admin_column' => true,
				'rewrite' => array("slug" => "faq"), // Permalinks
				'query_var' => "faq", // This goes to the WP_Query schema
				'supports' => array('title','author','editor'),
				'menu_position' => 5,
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				));
	register_taxonomy(
        'faq_categories',
        'faq',
        array(
            'labels' => array(
                'name' => 'FAQ Categories',
                'add_new_item' => esc_html__('Add New FAQ Category', 'buzzblogpro' ),
                'new_item_name' => esc_html__('New FAQ Category', 'buzzblogpro' )
            ),
            'show_ui' => true,
            'hierarchical' => true,
            'hasArchive' => true,
			'show_admin_column' => true
        )
    );
	
}
add_action('init', 'buzzblogpro_post_type_faq');

/*-----------------------------------------------------------------------------------
	Metaboxes for gallery
-----------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------*/
/*	Define Metabox Fields
/*-----------------------------------------------------------------------------------*/

$hr_prefix = 'buzzblogpro_';
 
$hercules_meta_box_gallery_page = array(
	'id' => 'my-meta-box-gallery',
	'title' =>  esc_html__('Options', 'buzzblogpro'),
	'page' => 'gallery',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
    	   'name' => esc_html__('Our role', 'buzzblogpro'),
    	   'desc' => '',
    	   'id' => $hr_prefix . 'gallery_role',
    	   'type' => 'text',
    	   'std' => ''
    	),
		array(
    	   'name' => esc_html__('Year', 'buzzblogpro'),
    	   'desc' => '',
    	   'id' => $hr_prefix . 'gallery_year',
    	   'type' => 'text',
    	   'std' => ''
    	),	
		array(
    	   'name' => esc_html__('Client', 'buzzblogpro'),
    	   'desc' => '',
    	   'id' => $hr_prefix . 'gallery_client',
    	   'type' => 'text',
    	   'std' => ''
    	),
				array(
    	   'name' => esc_html__('Technology', 'buzzblogpro'),
    	   'desc' => '',
    	   'id' => $hr_prefix . 'gallery_technology',
    	   'type' => 'text',
    	   'std' => ''
    	),
		array(
    	   'name' => esc_html__('URL', 'buzzblogpro'),
    	   'desc' => '',
    	   'id' => $hr_prefix . 'gallery_url',
    	   'type' => 'text',
    	   'std' => ''
    	),
		array( "name" => esc_html__('URL target','buzzblogpro'),
				"desc" => '',
				"id" => $hr_prefix . 'gallery_target',
				"type" => "select",
				"std" => esc_html__('blank','buzzblogpro'),
				"options" => array(esc_html__('blank','buzzblogpro'),esc_html__('self','buzzblogpro'))
			),
		array( "name" => esc_html__('When you click the thumbnail image, do you want to url led to a separate page?','buzzblogpro'),
				"desc" => '',
				"id" => $hr_prefix . 'url_separate_window',
				"type" => "select",
				"std" => esc_html__('no','buzzblogpro'),
				"options" => array(esc_html__('no','buzzblogpro'),esc_html__('yes','buzzblogpro'))
			)				
	)
);

add_action('admin_menu', 'buzzblogpro_add_box_gallery');


/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/
 
function buzzblogpro_add_box_gallery() {
	global $hercules_meta_box_gallery_page;
	add_meta_box($hercules_meta_box_gallery_page['id'], $hercules_meta_box_gallery_page['title'], 'buzzblogpro_show_box_gallery_core', $hercules_meta_box_gallery_page['page'], $hercules_meta_box_gallery_page['context'], $hercules_meta_box_gallery_page['priority']);

}

/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function buzzblogpro_show_box_gallery_core() {
	global $hercules_meta_box_gallery_page, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.esc_html__('Please fill additional fields. ', 'buzzblogpro').'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="buzzblogpro_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($hercules_meta_box_gallery_page['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;
			
			//If Select	
			case 'select':
			
				echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select id="' . $field['id'] . '" name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';
			
			break; 
			
		}

	}
 
	echo '</table>';
}

 
add_action('save_post', 'buzzblogpro_save_data_gallery');

/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function buzzblogpro_save_data_gallery($post_id) {
	global $hercules_meta_box_gallery_page;
 
	// verify nonce
	if (!isset($_POST['buzzblogpro_meta_box_nonce']) || !wp_verify_nonce($_POST['buzzblogpro_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($hercules_meta_box_gallery_page['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
}

 // Load Redux extensions
   if(!function_exists('buzzblogpro_redux_register_custom_extension_loader')) :
	function buzzblogpro_redux_register_custom_extension_loader($ReduxFramework) {
		$path = plugin_dir_path( __FILE__ ) . '/extensions/';
		$folders = scandir( $path, 1 );		   
		foreach($folders as $folder) {
			if ($folder === '.' or $folder === '..' or !is_dir($path . $folder) ) {
				continue;	
			} 
			$extension_class = 'ReduxFramework_Extension_' . $folder;
			if( !class_exists( $extension_class ) ) {
				// In case you wanted override your override, hah.
				$class_file = $path . $folder . '/extension_' . $folder . '.php';
				$class_file = apply_filters( 'redux/extension/'.$ReduxFramework->args['opt_name'].'/'.$folder, $class_file );
				if( $class_file ) {
					require_once( $class_file );
					$extension = new $extension_class( $ReduxFramework );
				}
			}
		}
	}
	// Modify {$redux_opt_name} to match your opt_name
	add_action("redux/extensions/buzzblogpro_options/before", 'buzzblogpro_redux_register_custom_extension_loader', 0);
endif;
add_filter('the_excerpt', 'do_shortcode');
add_filter('widget_text','do_shortcode');
add_filter('the_content', 'buzzblogpro_shortcode_empty_paragraph_fix', 10);
function buzzblogpro_shortcode_empty_paragraph_fix($content) {
	$array = array (
			'<p>['    => '[', 
			']</p>'   => ']', 
			']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}

function remove_empty_p( $content ) {
$content = force_balance_tags( $content );
$content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
$content = preg_replace( '~\s?<p>(\s| )+</p>\s?~', '', $content );
return $content;
}
add_filter('the_content', 'remove_empty_p', 9, 1);
		
add_filter( 'the_content', 'buzzblogpro_remove_empty_p', 20, 1 );
function buzzblogpro_remove_empty_p( $content ){
if( is_singular() && is_main_query() ) {
	// clean up p tags around block elements
	$content = preg_replace( array(
		'#<p>\s*<(div|aside|section|article|header|footer)#',
		'#</(div|aside|section|article|header|footer)>\s*</p>#',
		'#</(div|aside|section|article|header|footer)>\s*<br ?/?>#',
		'#<(div|aside|section|article|header|footer)(.*?)>\s*</p>#',
		'#<p>\s*</(div|aside|section|article|header|footer)#',
	), array(
		'<$1',
		'</$1>',
		'</$1>',
		'<$1$2>',
		'</$1',
	), $content );

	return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
	}
	return $content;
}

// AUTHOR SOCIAL LINKS
function buzzblogpro_contactmethods( $contactmethods ) {

	$contactmethods['twitter']   = esc_html__('Twitter URL', 'buzzblogpro');
	$contactmethods['facebook']  = esc_html__('Facebook URL', 'buzzblogpro');
	$contactmethods['google']    = esc_html__('Google Plus URL', 'buzzblogpro');
	$contactmethods['tumblr']    = esc_html__('Tumblr URL', 'buzzblogpro');
	$contactmethods['instagram'] = esc_html__('Instagram URL', 'buzzblogpro');
	$contactmethods['pinterest'] = esc_html__('Pinterest URL', 'buzzblogpro');
	$contactmethods['snapchat'] = esc_html__('Snapchat URL', 'buzzblogpro');

	return $contactmethods;
}
add_filter('user_contactmethods','buzzblogpro_contactmethods',10,1);

//google analytics

function buzzblogpro_google_analytics() {
global $buzzblogpro_options;
if(isset($buzzblogpro_options['google_analytics'])){	
    echo $buzzblogpro_options['google_analytics']; 
}
}
add_action('wp_head', 'buzzblogpro_google_analytics');

include_once plugin_dir_path( __FILE__ ) . '/widgets-visibility/widgets-visibility.php';
require_once plugin_dir_path( __FILE__ ) . '/slideshow/slideshow.php';
require_once plugin_dir_path( __FILE__ ) . '/custom-login-scripts/login.php';
require_once plugin_dir_path( __FILE__ ) . '/cmb2-tabs/cmb2-tabs.php';


if( ! class_exists( 'Hercules_Likes' ) && $buzzblogpro_options['post_likes'] !='no' ) {
require_once plugin_dir_path( __FILE__ ) . '/hercules-likes/class-hercules-likes.php';
}

add_action( 'wp_loaded', 'buzzblogpro_run_translaton' );
function buzzblogpro_run_translaton() {
global $buzzblogpro_options;
if(isset($buzzblogpro_options['enable_translate']) && $buzzblogpro_options['enable_translate']=='yes'){
require_once plugin_dir_path( __FILE__ ) . '/translate/translate-panel.php';
}
}
add_action( 'plugins_loaded', 'buzzblogpro_seo_override' );

function buzzblogpro_seo_override() {
$buzzblogpro_using_jetpack_publicize = ( class_exists( 'Jetpack' ) && in_array( 'publicize', Jetpack::get_active_modules()) ) ? true : false;
if ( !defined('WPSEO_VERSION') && !class_exists('NY_OG_Admin') && $buzzblogpro_using_jetpack_publicize == false) {

function buzzblogpro_add_opengraph() {
	global $post; 

	if (is_singular()) { // If we are on a blog post/page

		echo '<meta property="og:locale" content="'. get_locale() .'" />'; 
	    echo '<meta property="og:site_name" content="'. get_bloginfo('name') .'" />'; 
	    echo '<meta property="og:url" content="' . get_permalink() . '" />'; 
        echo '<meta property="og:title" content="' . get_the_title() . '" />'; 
        echo '<meta property="og:type" content="article" />';
		
    } elseif(is_front_page() or is_home()) { 
	
	
	    echo '<meta property="og:locale" content="'. get_locale() .'" />'; 
	    echo '<meta property="og:site_name" content="'. get_bloginfo('name') .'" />'; 
	    echo '<meta property="og:url" content="' . get_bloginfo('url') . '" />'; 
    	echo '<meta property="og:title" content="' . get_bloginfo("name") . '" />'; 
		echo '<meta property="og:description" content="' . get_bloginfo("description") . '" />'; 
    	echo '<meta property="og:type" content="website" />';
    }

	if(has_post_thumbnail() && is_singular()) { 
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
		echo '<meta property="og:image" content="' . esc_url( $thumbnail[0] ) . '" />'; 
		echo '<meta property="og:image:width" content="' . esc_attr( $thumbnail[1] ) . '" />'; 
       echo '<meta property="og:image:height" content="' . esc_attr( $thumbnail[2] ) . '" />';
	} 
}

add_action( 'wp_head', 'buzzblogpro_add_opengraph', 5 );

  }  
}

add_filter('upload_mimes', 'buzzblogpro_custom_upload_mimes');
function buzzblogpro_custom_upload_mimes ( $existing_mimes=array() ) {
    // add your extension to the mimes array as below
    $existing_mimes['zip'] = 'application/zip';
    $existing_mimes['gz'] = 'application/x-gzip';
	$existing_mimes['otf'] = 'application/x-font-otf';
  	$existing_mimes['woff'] = 'application/x-font-woff';
  	$existing_mimes['ttf'] = 'application/x-font-ttf';
  	$existing_mimes['svg'] = 'image/svg+xml';
  	$existing_mimes['eot'] = 'application/vnd.ms-fontobject';
    return $existing_mimes;
}

if ( !function_exists( 'wbc_extended_example' ) ) {
	function wbc_extended_example( $demo_active_import , $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );



		/************************************************************************
		* Setting Menus
		*************************************************************************/

		// If it's demo1 - demo6
		$wbc_menu_array = array( 'lifestyle', 'fashion' );

		//if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			
			$main_menu = get_term_by( 'name', 'Main menu', 'nav_menu' );
            $top_menu = get_term_by( 'name', 'Top menu', 'nav_menu' );
			$split_menu = get_term_by( 'name', 'Split right menu', 'nav_menu' );
			$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
			
			if ( isset( $main_menu->term_id ) ) {
			
			$locations['primary-menu'] = $main_menu->term_id;
			$locations['mobile_menu'] = $main_menu->term_id;
			
			} 
			if (isset( $top_menu->term_id )) {
			$locations['top-menu'] = $top_menu->term_id;
			} 
			
			if (isset( $split_menu->term_id )) {
			$locations['split-right-menu'] = $split_menu->term_id;
			}
			
			if (isset( $footer_menu->term_id )) {
			$locations['footer_menu'] = $footer_menu->term_id;
			}
			

         	set_theme_mod( 'nav_menu_locations', $locations);
				
		//}

// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'sophisticated' => 'Homepage',
			'feminine' => 'Homepage',
		);
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}

	}


	
	add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 11, 3 );
}


?>