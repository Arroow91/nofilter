<?php

/* Load admin scripts and styles */
add_action( 'admin_enqueue_scripts', 'buzzblogpro_load_admin_scripts' );


/**
 * Load scripts and styles in admin
 */

function buzzblogpro_load_admin_scripts() {
	buzzblogpro_load_admin_css();
}


/**
 * Load admin css files
 */

function buzzblogpro_load_admin_css() {
	
	global $pagenow, $typenow;

	if ( $typenow == 'post' || $typenow == 'page' ) {
	wp_enqueue_style('buzzblogpro-post-formats-ui', trailingslashit(get_template_directory_uri()).'includes/admin/css/admin.css', array(), '1.5', 'screen');
	}
}


function buzzblogpro_addPanelCSS() {
wp_register_style( 'redux-custom-css', trailingslashit(get_template_directory_uri()) . 'admin-panel/redux-style.css', array( 'redux-admin-css' ), '1.0', 'all' );	
wp_enqueue_style('redux-custom-css');
}
add_action( 'redux/page/buzzblogpro_options/enqueue', 'buzzblogpro_addPanelCSS' );


		/**
		 * Admin And editor styling
		 */
		if (is_admin()) {
			
			$styles = get_template_directory_uri() . '/includes/admin/css/editor-style.css';
						
			add_editor_style($styles);
		}
		
function buzzblogpro_mce_css( $mce_css ) {

global $buzzblogpro_options;

    // Check protocol
    $protocol = is_ssl() ? 'https' : 'http';
 
    if(isset($buzzblogpro_options['hs_bodytext']['font-family'])) {
        
        $body_font_string = $buzzblogpro_options['hs_bodytext']['font-family'];
		$body_font_style = $buzzblogpro_options['hs_bodytext']['font-weight'];
        $mce_css .= ', ' . $protocol . '://fonts.googleapis.com/css?family=' . $body_font_string.':'.$body_font_style;
    }
	if(isset($buzzblogpro_options['h1_heading']['font-family'])) {
        
        $h1_heading_font_string = $buzzblogpro_options['h1_heading']['font-family'];
		$h1_heading_font_style = $buzzblogpro_options['h1_heading']['font-weight'];
        $mce_css .= ', ' . $protocol . '://fonts.googleapis.com/css?family=' . $h1_heading_font_string.':'.$h1_heading_font_style;
    }

 
    return $mce_css;
}
add_filter( 'mce_css', 'buzzblogpro_mce_css' );


add_filter('tiny_mce_before_init','buzzblogpro_theme_editor_dynamic_styles');
function buzzblogpro_theme_editor_dynamic_styles( $mceInit ) {
global $buzzblogpro_options, $pagenow, $typenow;

$hs_container_size = $buzzblogpro_options['hs_container_size'] ? $buzzblogpro_options['hs_container_size'] : '1200';

if ( $typenow == 'post' ) {
$iswrap = get_post_meta( get_the_ID(), '_buzzblogpro_content_width', true ) == 'narrow' ? 454 : 0;
$sidebarpost = get_post_meta( get_the_ID(), '_buzzblogpro_sidebarposition', true ) == 'none' ? $hs_container_size - $iswrap  : '782';
}elseif ( $typenow == 'page' ) {
$iswrap = get_post_meta( get_the_ID(), '_buzzblogpro_content_width_page', true ) == 'narrow' ? 454 : 0;
$sidebarpost = get_post_meta( get_the_ID(), '_buzzblogpro_pagesidebarposition', true ) == 'none' ? $hs_container_size - $iswrap : '782';
}else{
$sidebarpost = '782';
}
$body_font_string = $buzzblogpro_options['hs_bodytext']['font-family'] ? $buzzblogpro_options['hs_bodytext']['font-family'] : 'inherit';
$body_font_size = $buzzblogpro_options['hs_bodytext']['font-size'] ? $buzzblogpro_options['hs_bodytext']['font-size'] : 'inherit';
$body_font_line = $buzzblogpro_options['hs_bodytext']['line-height'] ? $buzzblogpro_options['hs_bodytext']['line-height'] : 'inherit';
$body_font_color = $buzzblogpro_options['hs_bodytext']['color'] ? $buzzblogpro_options['hs_bodytext']['color'] : 'inherit';	
    $styles = 'body.mce-content-body { color:'.$body_font_color.';margin: 34px;max-width: '.$sidebarpost.'px;background: #fff;font-size:'.$body_font_size.';line-height:'.$body_font_line.'; font-family:' . $body_font_string . '}';
	 if(isset($buzzblogpro_options['links_color']['regular'])) {
	$styles .='body#tinymce.wp-editor a {color: ' . $buzzblogpro_options['links_color']['regular'] . ';}';
	$styles .='body#tinymce.wp-editor a:hover {color: ' . $buzzblogpro_options['links_color']['hover'] . ';}';
	}
$h1_heading_font_string = $buzzblogpro_options['h1_heading']['font-family'] ? $buzzblogpro_options['h1_heading']['font-family'] : 'inherit';

 $styles .= 'body.mce-content-body h1, body.mce-content-body h2, body.mce-content-body h3, body.mce-content-body h4, body.mce-content-body h5, body.mce-content-body h6 {font-family:' . $h1_heading_font_string . ';}';
 
    if ( isset( $mceInit['content_style'] ) ) {
        $mceInit['content_style'] .= ' ' . $styles . ' ';
    } else {
        $mceInit['content_style'] = $styles . ' ';
    }
	$mceInit['entity_encoding'] = 'raw';
    return $mceInit;
}
?>