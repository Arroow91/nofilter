<?php
/* Define Theme Vars */
define( 'BUZZBLOGPRO_THEME_VERSION', '1.8' );

/* Define content width */
if ( !isset( $content_width ) ) {
	$content_width = 800;
}
/* Localization */
load_theme_textdomain( 'buzzblogpro', get_template_directory() . '/languages' );

	if ( !function_exists('buzzblogpro_theme_setup')) {
		function buzzblogpro_theme_setup() {
        add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'align-wide' );

	// Post Formats
	$buzzblogpro_formats = array( 
				'gallery', 
				'link', 
				'image', 
				'quote', 
				'audio',
				'video');
	add_theme_support( 'post-formats', $buzzblogpro_formats ); 
	add_post_type_support( 'post', 'post-formats' );
	/* Support for HTML5 */
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	/*  Post Thumbnails  */
	if ( function_exists( 'add_image_size' ) ) {
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'buzzblogpro-standard-large', 1900, '', false );
		add_image_size( 'buzzblogpro-standard-post', 1600, '' );
		add_image_size( 'buzzblogpro-gallery-post', 636, '' );
		add_image_size( 'buzzblogpro-post-gallery-tall', 600, 800 );
		add_image_size( 'buzzblogpro-nextprev-thumb', 140, 140, true);
		add_image_size( 'buzzblogpro-mini-thumb', 100, 100, true);	
	}
	// Disable activation notice for Self-hosted Google Fonts plugin
	add_filter('sgf/admin/active_notice', '__return_false');
}
}
add_action('after_setup_theme', 'buzzblogpro_theme_setup');


/* Load frontend scripts */
require_once get_template_directory() . '/includes/enqueue-scripts.php';
require_once get_template_directory() . '/includes/theme-function.php';
require_once get_template_directory() . '/includes/locals.php';
/* Sidebars */
require_once get_template_directory() . '/includes/sidebars.php';
/* Hooks and filters */
require_once get_template_directory() . '/includes/hooks.php';
/* Menu */
require_once get_template_directory() . '/includes/main-menu/class-mega-menu.php';
/* Ajax search */
require_once get_template_directory() . '/includes/ajax-search.php';
/* Image manager */
require_once get_template_directory() . '/includes/aq_resizer.php';

// Visual Composer add on
if ( function_exists( 'vc_map' ) ) {
include( trailingslashit( get_template_directory() ) . 'buzzblogpro_vc.php' );
}
// WooCommerce
if (class_exists( 'WooCommerce' )) {
	require_once get_template_directory() . '/woocommerce-scripts/woocommerce-scripts.php';
}
require_once get_template_directory() . '/admin-panel/options-init.php';
if( is_admin() ) {
/* Load admin scripts */
require_once get_template_directory() . '/includes/cmb2/init.php';
require_once get_template_directory() . '/includes/admin/enqueue-scripts.php';
require_once get_template_directory() . '/includes/register-plugins.php';
require_once get_template_directory() .'/inc/admin/welcome/welcome.php';
require_once get_template_directory() . '/includes/metaboxes.php';
require_once get_template_directory() . '/inc/updater/update.php';
}
?>