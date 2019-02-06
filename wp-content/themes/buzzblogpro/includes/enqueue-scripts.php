<?php

/*	Register styles andjavascript
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'buzzblogpro_print_script_footer');

function buzzblogpro_print_script_footer() {
//bootstrap framework
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/bootstrap/bootstrap.min.css' ), array(), null );
// Theme stylesheet.
	wp_enqueue_style( 'buzzblogpro-style', get_stylesheet_uri() );
//WooCommerce custom style
    if (class_exists( 'WooCommerce' )) {
	wp_enqueue_style( 'buzzblogpro-woocommerce', get_theme_file_uri( '/hs-woocommerce.css' ), array( 'buzzblogpro-style' ), '1.0' );
	wp_register_script( 'buzzblogpro-menucart', get_template_directory_uri() . '/woocommerce-scripts/js/woocommerce-buzzblogpro.js', array() , '1.0', 'all');
	
	
			wp_localize_script( 'buzzblogpro-menucart', 'buzzblogproShop', apply_filters(
				'buzzblogpro_shop_js_vars',
				array(
					'cartUrl' => wc_get_cart_url(),
					'redirect'=> false,
					'theme_url'=>get_template_directory_uri(),
					'version'=> wp_get_theme()->display( 'Version' )
				)
			)
		);
	
	wp_enqueue_script( 'buzzblogpro-menucart' );
	}
wp_enqueue_script( 'buzzblogpro-plugins', get_theme_file_uri( '/js/jquery.plugins.js' ), array( 'jquery' ), '1.0', true );
wp_enqueue_script( 'buzzblogpro-global', get_theme_file_uri( '/js/jquery.custom.js' ), array( 'jquery' ), '1.0', true );

global $buzzblogpro_options;
if (empty($buzzblogpro_options) or ! class_exists( 'Redux' )) {
function buzzblogpro_fonts_without_redux() {
$fonts_url = '';
$playfair = esc_html_x( 'on', 'Playfair Display font: on or off', 'buzzblogpro' );
$heebo = esc_html_x( 'on', 'Heebo font: on or off', 'buzzblogpro' );
$haviland = esc_html_x( 'on', 'Mr De Haviland font: on or off', 'buzzblogpro' );
$prata = esc_html_x( 'on', 'Prata: on or off', 'buzzblogpro' );

if ( 'off' !== $playfair || 'off' !== $heebo || 'off' !== $haviland || 'off' !== $prata ) {
$font_families = array();
 
if ( 'off' !== $playfair ) {
$font_families[] = 'Playfair Display:400,400italic;';
}
 
if ( 'off' !== $heebo ) {
$font_families[] = 'Heebo:400';
}

if ( 'off' !== $haviland ) {
$font_families[] = 'Mr De Haviland:400';
}

if ( 'off' !== $prata ) {
$font_families[] = 'Prata:400';
}

$query_args = array(
'family' => urlencode( implode( '|', $font_families ) ),
'subset' => urlencode( 'latin,latin-ext' ),
);
 
$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
}
 
return esc_url_raw( $fonts_url );
}
wp_enqueue_style( 'buzzblogpro-fonts-without-redux', buzzblogpro_fonts_without_redux(), array(), null );
wp_enqueue_style( 'buzzblogpro-reset', get_theme_file_uri( '/reset.css' ), array( 'buzzblogpro-style' ), '1.0' );
}
// Localize the infinitescroll with new data
	if( is_single() ) {$issingle = 'true';}else{$issingle = 'false';}
$buzzblogpro_infinitescroll_data = array(
	'load_more' => esc_html__('Load more', 'buzzblogpro'),
    'you_reached_the_end' => esc_html__('No more items to load.', 'buzzblogpro'),
	'offset' => isset($buzzblogpro_options['loadmore_offset']) ? $buzzblogpro_options['loadmore_offset'] : '0', 
	'pagination_type' => isset($buzzblogpro_options['pagination_type']) ? $buzzblogpro_options['pagination_type'] : 'pagnum',
	'single_pagination_type' => isset($buzzblogpro_options['single_pagination_type']) ? $buzzblogpro_options['single_pagination_type'] : '',
    'issingle' => $issingle,
);
wp_localize_script( 'buzzblogpro-global', 'inf_var', $buzzblogpro_infinitescroll_data );

if (buzzblogpro_getVariable('header_position')== 'stickyheader') { 
wp_enqueue_script( 'buzzblogpro-animatedHeader', get_theme_file_uri( '/js/AnimatedHeader.js' ), array( 'jquery' ), '1.0', true );
}
if (buzzblogpro_getVariable('blog_sidebar_pos')=='masonry2' or buzzblogpro_getVariable('blog_sidebar_pos')=='masonry3' or buzzblogpro_getVariable('blog_sidebar_pos')=='masonry4' or buzzblogpro_getVariable('blog_sidebar_pos')=='masonry2sideright' or buzzblogpro_getVariable('blog_sidebar_pos')=='masonry2sideleft' or is_page_template( 'page-gallery.php' ) or is_tax('gallery-categories') or buzzblogpro_getVariable('blog_cat_sidebar_pos')=='masonry2' or buzzblogpro_getVariable('blog_cat_sidebar_pos')=='masonry3' or buzzblogpro_getVariable('blog_cat_sidebar_pos')=='masonry4' or is_page_template( 'page-archives.php' ) or buzzblogpro_getVariable('blog_cat_sidebar_pos')=='masonry2sideright' or buzzblogpro_getVariable('blog_cat_sidebar_pos')=='masonry2sideleft' or is_category()  ) {
wp_enqueue_script('masonry');
}





wp_enqueue_script( 'buzzblogpro-theme-script',	get_theme_file_uri( '/includes/main-menu/js/buzzblogpro.mega-menu.js' ), array( 'jquery' ), '1.0', true );
		// Inject variable values in gallery script
		wp_localize_script( 'buzzblogpro-theme-script', 'buzzblogproScript',
			array(
				'fixedHeader' 	=> 'fixed-header',
				'ajax_nonce'   	=> wp_create_nonce('ajax_nonce'),
				'ajax_url'	   	=> admin_url( 'admin-ajax.php' ),
				'events'		=> buzzblogpro_is_touch() ? 'click' : 'mouseenter',
				'top_nav_side'  => is_rtl() ? 'right' : 'left',
				'main_nav_side' => is_rtl() ? 'left' : 'right', 
				'wait' => '',
		        'must_fill' => esc_html__( 'Enter email address', 'buzzblogpro' )
			)
		);
buzzblogpro_admin_css();

buzzblogpro_hero_images();
	# Remove Query Strings From Static Resources ----------
	if ( ! is_admin() ){
		add_filter( 'script_loader_src', 'buzzblogpro_remove_query_strings_1', 15, 1 );
		add_filter( 'style_loader_src',  'buzzblogpro_remove_query_strings_1', 15, 1 );
		add_filter( 'script_loader_src', 'buzzblogpro_remove_query_strings_2', 15, 1 );
		add_filter( 'style_loader_src',  'buzzblogpro_remove_query_strings_2', 15, 1 );
	}
}






//hero image
if ( ! function_exists( 'buzzblogpro_hero_images' ) ) {
  function buzzblogpro_hero_images() {
global $post;
$buzzblogpro_standard_modern_layout = get_post_meta(get_the_ID(), '_buzzblogpro_standard_layout_format', true);
$buzzblogpro_page_modern_layout = get_post_meta(get_the_ID(), '_buzzblogpro_standard_layout_format_page', true);
if(is_single() && has_post_thumbnail() && $buzzblogpro_standard_modern_layout == esc_html__('layout6','buzzblogpro')){
$buzzblogpro_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'buzzblogpro-standard-large');
$heroimage = $buzzblogpro_feat_image[0];
if ($heroimage) {
    $custom_css = ".hero-featured{background-image: url(\"{$heroimage}\");}";
    wp_add_inline_style( 'buzzblogpro-style', $custom_css );
	}
    }elseif(is_page() && has_post_thumbnail() && $buzzblogpro_page_modern_layout == esc_html__('layout6','buzzblogpro')){
$buzzblogpro_feat_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'buzzblogpro-standard-large');
$heroimage = $buzzblogpro_feat_image[0];
if ($heroimage) {
    $custom_css = ".hero-featured{background-image: url(\"{$heroimage}\");}";
    wp_add_inline_style( 'buzzblogpro-style', $custom_css );
	}
	}
  }
}

if ( ! function_exists('buzzblogpro_admin_css') ) {
function buzzblogpro_admin_css(){
ob_start();
ob_clean(); 
global $buzzblogpro_options;

 if(isset($buzzblogpro_options['hs_container_size'])) {
				echo '@media (min-width: 1200px) {.container{max-width: '.$buzzblogpro_options['hs_container_size'].'px;}.fullwidth-widget .form-inline {max-width: '.$buzzblogpro_options['hs_container_size'].'px;}}';
				}
if(isset($buzzblogpro_options['main_layout']) && isset($buzzblogpro_options['hs_container_size'])){
if($buzzblogpro_options['main_layout']== 'boxed'){
$val = intval($buzzblogpro_options['hs_container_size']) + 32;
echo '.boxed .main-holder, .boxed .buzzblogpro-cookie-banner-wrap {max-width: '.$val.'px;}';
}
}


if(isset($buzzblogpro_options['enable_center_mode']) && $buzzblogpro_options['enable_center_mode'] == 'yes'){ 
$val = intval($buzzblogpro_options['hs_container_size']) - 64;
echo '@media (min-width: 1200px) {.center-mode-on .cover-wrapper{width: '.$val.'px;max-width: '.$val.'px;}}';
}


if(isset($buzzblogpro_options['slideshow_layout']) && $buzzblogpro_options['slideshow_layout'] == 'grid'){ 
if($buzzblogpro_options['slideshow_margin']){
$val = $buzzblogpro_options['slideshow_margin'];
echo '.owl-slide .cover-wrapper.slide-sub-item-large {border-right-width: '.$val.'px;}';
$val_mr = $val / 2;
echo '.owl-slide .cover-wrapper.slide-sub-item-small.middle {border-bottom-width: '.$val_mr.'px;}';
echo '.owl-slide .cover-wrapper.slide-sub-item-small.last {border-top-width: '.$val_mr.'px;}';
}else{
echo '.owl-slide .cover-wrapper.slide-sub-item-large {border-right-width: 0px;}';
echo '.owl-slide .cover-wrapper.slide-sub-item-small.middle {border-bottom-width: 0px;}';
echo '.owl-slide .cover-wrapper.slide-sub-item-small.last {border-top-width: 0px;}';
}
if($buzzblogpro_options['slideshow_thumbheight']){
$thumb_height = $buzzblogpro_options['slideshow_thumbheight'];
$thumb_height_small = $thumb_height / 2;
echo '.owl-slide .cover-wrapper.slide-sub-item-large {height: '.$thumb_height.'px;}';
echo '.owl-slide .cover-wrapper.slide-sub-item-small {height: '.$thumb_height_small.'px;}';
}
}

if(isset($buzzblogpro_options['slideshow_layout']) && $buzzblogpro_options['slideshow_layout'] != 'grid'){
if($buzzblogpro_options['slideshow_thumbheight']){
$thumb_height = $buzzblogpro_options['slideshow_thumbheight'];

echo '@media(max-width:767px){.middle-boxed .owl-slide .cover-wrapper, .middle .owl-slide .cover-wrapper, .bottom .owl-slide .cover-wrapper, .normal-slideshow .cover-wrapper {height: '.($thumb_height / 2 - 100).'px!important;}}';

echo '@media only screen and (min-width:768px) and (max-width:991px) {.middle-boxed .owl-slide .cover-wrapper, .middle .owl-slide .cover-wrapper, .bottom .owl-slide .cover-wrapper, .normal-slideshow .cover-wrapper {height: '.($thumb_height / 2).'px!important;}}';
echo '@media(min-width:992px){.middle-boxed .owl-slide .cover-wrapper, .middle .owl-slide .cover-wrapper, .bottom .owl-slide .cover-wrapper, .normal-slideshow .cover-wrapper {height: '.($thumb_height / 2 + 150).'px!important;}}';
echo '@media(min-width:1200px){.middle-boxed .owl-slide .cover-wrapper, .middle .owl-slide .cover-wrapper, .bottom .owl-slide .cover-wrapper, .normal-slideshow .cover-wrapper {height: '.$thumb_height.'px!important;}}';
echo '@media(min-width:1367px){.middle-boxed .owl-slide .cover-wrapper, .middle .owl-slide .cover-wrapper, .bottom .owl-slide .cover-wrapper, .normal-slideshow .cover-wrapper {height: '.$thumb_height.'px!important;}}';
}
}
 if(isset($buzzblogpro_options['header_logo_width']) && $buzzblogpro_options['content_around_shadow'] == 'yes') {
echo '.home article.post, .blog article.post, .page article, .trending-posts, .archive article, body:not(.single-post) .post-author .post-author-box, .single article .isopad, .page:not(.page-template-page-archives) .isopad, .content-holder .widget, .list-post .list-post-container .post_content, .grid-block, .list-post .block .list_post_content, .related-posts, .comment-body, .slideshow:not(.underneath), .slideshow.underneath .cover-wrapper {-webkit-box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.05);-moz-box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.05);box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.05);}';
}

 if(isset($buzzblogpro_options['megamenu_height'])) {
				echo '.primary-menu .has-mega-sub-menu .mega-sub-menu {min-height:'.$buzzblogpro_options['megamenu_height'].'px;}';
				};

 if(isset($buzzblogpro_options['header_logo_width'])) {
				echo '.logo img {width:'.$buzzblogpro_options['header_logo_width'].'px;}';
				}else{echo '.logo img {width:400px;}';};
 if(isset($buzzblogpro_options['footer_logo_width'])) {
				echo '.footer-logo .logo img {width:'.$buzzblogpro_options['footer_logo_width'].'px;}';
				}else{echo '.footer-logo .logo img {width:400px;}';};
				
				 if(isset($buzzblogpro_options['lineabove_color'])) {
				echo '#primary {border-top-color:'.$buzzblogpro_options['lineabove_color'].'}';
				}else{echo '#primary {border-top-color:#eeeeee;}';}
 if(isset($buzzblogpro_options['linebelow_color'])) {
				echo '#primary {border-bottom-color:'.$buzzblogpro_options['linebelow_color'].'}';
				}else{echo '#primary {border-bottom-color:#eeeeee;}';}
 if(isset($buzzblogpro_options['lineabove_border_thick'])) {
				echo '#primary {border-top-width:'.$buzzblogpro_options['lineabove_border_thick'].'px;}';
				}else{echo '#primary {border-top-width:1px;}';}
 if(isset($buzzblogpro_options['linebelow_border_thick'])) {
				echo '#primary {border-bottom-width:'.$buzzblogpro_options['linebelow_border_thick'].'px;}';
				}else{echo '#primary {border-bottom-width:4px;}';}
				
				
				
 if(isset($buzzblogpro_options['footerline_color'])) {
				echo '.lowestfooter {border-top-color:'.$buzzblogpro_options['footerline_color'].'}';
				}else{echo '.lowestfooter {border-top-color:#eeeeee;}';}
			if(isset($buzzblogpro_options['overlay_color']['rgba'])) {
				echo '.header-overlay {background:'.$buzzblogpro_options['overlay_color']['rgba'].'}';
				}else{echo '.header-overlay {background: rgba(255,255,255,0.6);}';}
				if(isset($buzzblogpro_options['post_overlay_color']['rgba'])) {
				echo '.parallax-image .header-overlay, .parallax-image:before {background:'.$buzzblogpro_options['post_overlay_color']['rgba'].'}';
				}else{echo '.parallax-image .header-overlay, .parallax-image:before {background: rgba(0,0,0,0.19);}';}
				if(isset($buzzblogpro_options['mainmenu_submenu_border_color']['border-top'])) {
				echo '.primary-menu ul li:not(.buzzblogpro-widget-menu) > ul {top:-'.$buzzblogpro_options['mainmenu_submenu_border_color']['border-top'].'}';
				} 
				
				
				if(isset($buzzblogpro_options['slideshow_bg_color'])) {
				echo '.owl-slide .cover-wrapper.slide-sub-item-large {border-right-color: '.$buzzblogpro_options['slideshow_bg_color']['background-color'].';}';
				echo '.owl-slide .cover-wrapper.slide-sub-item-small.middle {border-bottom-color: '.$buzzblogpro_options['slideshow_bg_color']['background-color'].';}';
				echo '.owl-slide .cover-wrapper.slide-sub-item-small.last {border-top-color: '.$buzzblogpro_options['slideshow_bg_color']['background-color'].';}';
				}
								
								
						if(isset($buzzblogpro_options['slideshow_overlay_color']['rgba'])) {
						if($buzzblogpro_options['slideshow_overlay_gradient'] == 'yes') {
						echo '.top-slideshow .cover:before {background: linear-gradient(to bottom, transparent 40%, '.$buzzblogpro_options['slideshow_overlay_color']['color'].' 100%)} .top-slideshow .cover:before{opacity: '.$buzzblogpro_options['slideshow_overlay_color']['alpha'].';}';
						}else{
						
				echo '.top-slideshow .cover:before {background: '.$buzzblogpro_options['slideshow_overlay_color']['color'].'} .top-slideshow .cover:before{opacity: '.$buzzblogpro_options['slideshow_overlay_color']['alpha'].';}';
				}
				}else{echo '.top-slideshow .cover:before {background: rgba(0,0,0,0.15);}';}

			if (isset($buzzblogpro_options['body_background'])) {
			echo 'body { ';
				if (isset($buzzblogpro_options['body_background']['background-image']) && !empty($buzzblogpro_options['body_background']['background-image'])) {
					echo 'background-image:url("'.$buzzblogpro_options['body_background']['background-image']. '"); background-repeat:'.$buzzblogpro_options['body_background']['background-repeat'].'; background-position:'.$buzzblogpro_options['body_background']['background-position'].';  background-attachment:'.$buzzblogpro_options['body_background']['background-attachment'].'; background-size:'.$buzzblogpro_options['body_background']['background-size'].';';
				}
				if($buzzblogpro_options['body_background']['background-color'] != '') {
					echo 'background-color:'.$buzzblogpro_options['body_background']['background-color']. ';';
				}
				echo '}';
			}
if (isset($buzzblogpro_options['custom_css'])) {
		echo wp_kses_post( $buzzblogpro_options['custom_css']); 
}
if(isset($buzzblogpro_options['global_color'])) {
			if($buzzblogpro_options['global_color']) {
				echo '.post_category:after, .hs_aboutme_text span, .slide-category span, .widget-content h4.subtitle span, .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus, .title-section span, .heading-entrance span {border-top-color:'.$buzzblogpro_options['global_color'].'}';
				}else{echo '.post_category:after, .hs_aboutme_text span, .widget-content h4.subtitle span, .slide-category span, .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus, .title-section span, .heading-entrance span {border-top-color:#eeeeee}';};
				
			if($buzzblogpro_options['global_color']) {
				echo '.error404-holder_num, .twitter-list i, .hercules-likes:hover:before, .hercules-likes.active:before {color:'.$buzzblogpro_options['global_color'].'}';
				}else{echo '.error404-holder_num {color:#222222}';};
			
			if($buzzblogpro_options['global_color']) {
				echo '.icon-menu .icon-menu-count, .audioplayer-bar-played, .audioplayer-volume-adjust div div, #back-top a:hover span, .owl-carousel .owl-dots .owl-dot.active span, .owl-carousel .owl-dots .owl-dot:hover span, .link-image a .link-wrapper, .widget_calendar tbody a, .text-highlight, div.jp-play-bar, div.jp-volume-bar-value, .progress .bar, .buzzblogpro-cart .badge, .mobile-shopping-cart .badge, .share-buttons .heart span {background:'.$buzzblogpro_options['global_color'].'}';
				}else{echo '.icon-menu .icon-menu-count, .audioplayer-bar-played, .audioplayer-volume-adjust div div, #back-top a:hover span, .widget_calendar tbody a, .text-highlight, div.jp-play-bar, div.jp-volume-bar-value, .progress .bar, .share-buttons .heart span {background:#222222}';};
			
            if($buzzblogpro_options['global_color']) {
				echo '.hs_recent_popular_tab_widget_content .tab_title.selected a, .search-option-tab li:hover a,.search-option-tab li.active a {border-bottom: 1px solid '.$buzzblogpro_options['global_color'].'}';
				}else{echo '.hs_recent_popular_tab_widget_content .tab_title.selected a, .search-option-tab li:hover a,.search-option-tab li.active a {border-bottom: 1px solid #222222}';};				
}
 if(isset($buzzblogpro_options['mainmenu_submenu_link_color'])) {
if($buzzblogpro_options['mainmenu_submenu_link_color']['hover']) {
				echo '.primary-menu ul li:not(.buzzblogpro-widget-menu):hover > a, .primary-menu .has-mega-column:not(.widget-in-menu) > .sub-menu a:hover, .primary-menu .has-mega-column > .sub-menu > .columns-sub-item > a:hover { color:'.$buzzblogpro_options['mainmenu_submenu_link_color']['hover'].'}';
				}else{echo '.primary-menu ul li:not(.buzzblogpro-widget-menu):hover > a, .primary-menu .has-mega-column > .sub-menu a:hover, .primary-menu .has-mega-column:not(.widget-in-menu) > .sub-menu > .columns-sub-item > a:hover { color:#bbbbbb}';};

if($buzzblogpro_options['mainmenu_submenu_link_color']['active']) {
				echo '.primary-menu ul li.current-menu-item:not(.buzzblogpro-widget-menu) > a, .primary-menu .has-mega-column:not(.widget-in-menu) > .sub-menu .current-menu-item > a { color:'.$buzzblogpro_options['mainmenu_submenu_link_color']['active'].'}';
				}else{echo '.primary-menu ul li.current-menu-item > a, .primary-menu .has-mega-column > .sub-menu .current-menu-item > a { color:#bbbbbb}';};				
}
 if(isset($buzzblogpro_options['side-panel-link-color'])) { 
if($buzzblogpro_options['side-panel-link-color']['active']) {
				echo '.menu-mobile ul li.current-menu-item > a, .menu-mobile ul li.current-menu-ancestor > a { color:'.$buzzblogpro_options['side-panel-link-color']['active'].'}';
				}else{echo '.menu-mobile ul li.current-menu-item > a, .menu-mobile ul li.current-menu-ancestor > a { color:#000000}';};				
}

if(isset($buzzblogpro_options['mainmenu_current_button_color'])) {
if($buzzblogpro_options['mainmenu_current_button_color']['hover']) { 
				echo '.primary-menu > li > a:hover, .primary-menu > li.current-menu-item > a, .primary-menu > li.current-menu-ancestor > a, .primary-menu li:hover > a, .primary-menu .mega-menu-posts .post a:hover { color:'.$buzzblogpro_options['mainmenu_current_button_color']['hover'].'}';
				}else{echo '.primary-menu > li > a:hover, .primary-menu > li.current-menu-item > a, .primary-menu > li.current-menu-ancestor > a, .primary-menu li:hover > a, .primary-menu .mega-menu-posts .post a:hover { color:#bbbbbb;}';};		
				
if($buzzblogpro_options['mainmenu_current_button_color']['active']) {
				echo '.primary-menu > li.current-menu-item > a, .primary-menu > li.current-menu-ancestor > a { color:'.$buzzblogpro_options['mainmenu_current_button_color']['active'].'}';
				}else{echo '.primary-menu > li.current-menu-item > a, .primary-menu > li.current-menu-ancestor > a { color:#bbbbbb;}';};
				}
if(isset($buzzblogpro_options['mainmenu_button_bg_color'])) {
if($buzzblogpro_options['mainmenu_button_bg_color']['regular'] && $buzzblogpro_options['mainmenu_button_bg_color_transparent'] != 'yes') {
				echo '.primary-menu > li > a {background:'.$buzzblogpro_options['mainmenu_button_bg_color']['regular'].'}';
  }else{echo '.primary-menu > li > a {background:transparent;}';};
  
if($buzzblogpro_options['mainmenu_button_bg_color']['hover'] && $buzzblogpro_options['mainmenu_button_bg_color_transparent'] != 'yes') {
				echo '.primary-menu > li > a:hover, .primary-menu > li.current-menu-item > a, .primary-menu > li.current-menu-ancestor > a, .primary-menu li:hover > a { background:'.$buzzblogpro_options['mainmenu_button_bg_color']['hover'].'}';
				}else{echo '.primary-menu > li > a:hover, .primary-menu > li.current-menu-item > a, .primary-menu > li.current-menu-ancestor > a, .primary-menu li:hover > a { background:transparent;}';};	

if($buzzblogpro_options['mainmenu_button_bg_color']['active'] && $buzzblogpro_options['mainmenu_button_bg_color_transparent'] != 'yes') {
				echo '.primary-menu > li.current-menu-item > a, .primary-menu > li.current-menu-ancestor > a { background:'.$buzzblogpro_options['mainmenu_button_bg_color']['active'].'}';
				}else{echo '.primary-menu > li.current-menu-item > a, .primary-menu > li.current-menu-ancestor > a { background:transparent;}';};	
}

if(isset($buzzblogpro_options['mainmenu_button_active_border_color'])) {
				echo '.primary-menu > li.current-menu-ancestor, .primary-menu > li:hover, .primary-menu > li.current_page_item, .primary-menu > li.current-menu-item {border-top: 1px solid '.$buzzblogpro_options['mainmenu_button_active_border_color'].';}';
				}else{echo '.primary-menu > li.current-menu-ancestor, .primary-menu > li:hover, .primary-menu > li.current_page_item, .primary-menu > li.current-menu-item {border-top: 1px solid #000000;}';};
				
if(isset($buzzblogpro_options['mainmenu_submenu_button_border_bottom_color'])) {
				echo '.primary-menu ul li:not(.buzzblogpro-widget-menu) a, .primary-menu .has-mega-sub-menu .mega-sub-menu ul, .primary-menu .has-mega-column > .sub-menu > .columns-sub-item > a, #cart-wrap {border-color:'.$buzzblogpro_options['mainmenu_submenu_button_border_bottom_color'].'}';
				}else{echo '.primary-menu ul li:not(.buzzblogpro-widget-menu) a, .primary-menu .has-mega-sub-menu .mega-sub-menu ul, .primary-menu .has-mega-column > .sub-menu > .columns-sub-item > a, #cart-wrap {border-bottom-color:#eeeeee;}';};	

				if(isset($buzzblogpro_options['topmenu_submenu_bg_color']['rgba'])) {
				echo '#top-menu ul {background:'.$buzzblogpro_options['topmenu_submenu_bg_color']['rgba'].'}';
				}else{echo '#top-menu ul {background:#ffffff;}';};	
				
if(isset($buzzblogpro_options['topmenu_submenu_button_border_bottom_color'])) {
				echo '#top-menu ul a, #top-menu .current_page_item ul a, #top-menu ul .current_page_item a, #top-menu .current-menu-item ul a, #top-menu ul .current-menu-item a, #top-menu li:hover > ul a {border-color:'.$buzzblogpro_options['topmenu_submenu_button_border_bottom_color'].'}';
				}else{echo '#top-menu ul a, #top-menu .current_page_item ul a, #top-menu ul .current_page_item a, #top-menu .current-menu-item ul a, #top-menu ul .current-menu-item a, #top-menu li:hover > ul a {border-bottom-color:#eeeeee;}';};
if(isset($buzzblogpro_options['top_container_bg_color'])) {
				echo '.top-border {background:'.$buzzblogpro_options['top_container_bg_color'].'}';
				}else{echo '.top-border {background:#ffffff;}';};	

				if(isset($buzzblogpro_options['modern_post_meta_text_color'])) {
				echo '.modern-layout .meta-space-top a, .modern-layout .meta-space-top, .modern-layout .post_category a, .modern-layout .meta-space-top, .parallax-image .category-box span, .parallax-image .category-filter a, .parallax-image .cat-des, .parallax-image .title-section h2 {color:'.$buzzblogpro_options['modern_post_meta_text_color'].'}';
				}else{echo '.modern-layout .meta-space-top a, .modern-layout .meta-space-top, .modern-layout .post_category a, .modern-layout .meta-space-top, .parallax-image .category-box span, .parallax-image .category-filter a, .parallax-image .cat-des, .parallax-image .title-section h2 {color:#000000;}';};
 if(isset($buzzblogpro_options['modern_post_title_text_color'])) {
				echo '.modern-layout h1.post-title, .parallax-image .title-section h1 {color:'.$buzzblogpro_options['modern_post_title_text_color'].'}';
				}else{echo '.modern-layout h1.post-title, .parallax-image .title-section h1 {color:#000000;}';};

 if(isset($buzzblogpro_options['featured_badge_text_color'])) {
				echo '.ribbon-featured {color:'.$buzzblogpro_options['featured_badge_text_color'].'}';
				}else{echo '.ribbon-featured {color:#ffffff;}';};	
 if(isset($buzzblogpro_options['featured_badge_bg_color'])) {
				echo '.ribbon-featured {background:'.$buzzblogpro_options['featured_badge_bg_color'].'}';
				}else{echo '.ribbon-featured {background:#000000;}';};				

				
if (isset($buzzblogpro_options['buttons_radius'])) { 
if ($buzzblogpro_options['buttons_radius'] == 'yes' ) { 
			echo '.viewpost-button a.button, a.btn, a.slideshow-btn, .ribbon-featured, input[type="submit"], input[type="button"], a.comment-reply-link { border-radius: 35px!important;}';
			}}
				
if (isset($buzzblogpro_options['meta_posts_alignment'])) { 
if ($buzzblogpro_options['meta_posts_alignment'] == 'yes' ) { 
			echo '.post .post_category, .post .meta-space-top, .post .meta-space-top a, .viewpost-button, .grid .post-header h2 a, .grid h2.post-title, .post-grid-block h2.grid-post-title a, .post-grid-block h2.grid-post-title, .post-header h2 a, h2.post-title, .post-grid-block .post-header { text-align:left!important;}';
			}}	
				
				
				if (isset($buzzblogpro_options['buttons_color']) && $buzzblogpro_options['buttons_color']['hover']) { 
echo '.category-filter ul li.current-cat a { color: '.$buzzblogpro_options['buttons_color']['hover'].'}';
}
if (isset($buzzblogpro_options['buttons_color'])) {
if ($buzzblogpro_options['buttons_border_color']['regular']) { 
			echo '#cart-wrap .but-cart, .sidebar .social__list a, .footer .social__list a, .footer .social__list_both a, .sidebar .social__list_both a, .footer .instagram-footer .readmore-button a, a.btn, a.comment-reply-link, input[type="submit"], input[type="button"], .category-filter ul li a, .woocommerce #review_form #respond .form-submit input, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce div.product form.cart .button, .woocommerce #respond input#submit, .woocommerce #respond input#submit.alt, .woocommerce a.button, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button, .woocommerce input.button { border-color: '.$buzzblogpro_options['buttons_border_color']['regular'].'}';
			}else{echo '#cart-wrap .but-cart, .sidebar .social__list a, .footer .social__list a, .footer .social__list_both a, .sidebar .social__list_both a, .footer .instagram-footer .readmore-button a, a.btn, a.comment-reply-link, input[type="submit"], input[type="button"], .category-filter ul li a, .woocommerce #review_form #respond .form-submit input, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce div.product form.cart .button, .woocommerce #respond input#submit, .woocommerce #respond input#submit.alt, .woocommerce a.button, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button, .woocommerce input.button { border-color: #222222;}';}

if ($buzzblogpro_options['buttons_border_color']['hover']) { 
			echo '#cart-wrap .but-cart:hover, .footer .instagram-footer .readmore-button a:hover, a.comment-reply-link:hover, input[type="submit"]:hover, input[type="button"]:hover, .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open > .dropdown-toggle.btn-default, .category-filter ul li.current-cat a, .category-filter ul li a:hover, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce div.product form.cart .button:hover, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit.alt, .woocommerce a.button:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce button.button:hover, .woocommerce input.button:hover { border-color: '.$buzzblogpro_options['buttons_border_color']['hover'].'}';
			}else{echo '#cart-wrap .but-cart:hover, .footer .instagram-footer .readmore-button a:hover, a.comment-reply-link:hover, input[type="submit"]:hover, input[type="button"]:hover, .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open > .dropdown-toggle.btn-default, .category-filter ul li.current-cat a, .category-filter ul li a:hover, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce div.product form.cart .button:hover, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit.alt, .woocommerce a.button:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce button.button:hover, .woocommerce input.button:hover { border-color: #222222;}';}
			}
			
			if (isset($buzzblogpro_options['buttons_background_color'])) { 
if ($buzzblogpro_options['buttons_background_color']['regular']) { 
			echo '#cart-wrap .but-cart, .footer .instagram-footer .readmore-button a, a.btn, a.comment-reply-link, input[type="submit"], input[type="button"], .category-filter ul li a, .woocommerce #review_form #respond .form-submit input, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce div.product form.cart .button, .woocommerce #respond input#submit, .woocommerce #respond input#submit.alt, .woocommerce a.button, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button, .woocommerce input.button { background: '.$buzzblogpro_options['buttons_background_color']['regular'].'}';
			}else{echo '#cart-wrap .but-cart, .footer .instagram-footer .readmore-button a, a.btn, a.comment-reply-link, input[type="submit"], input[type="button"], .category-filter ul li a, .woocommerce #review_form #respond .form-submit input, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce div.product form.cart .button, .woocommerce #respond input#submit, .woocommerce #respond input#submit.alt, .woocommerce a.button, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button, .woocommerce input.button { background: #ffffff;}';}

if ($buzzblogpro_options['buttons_background_color']['hover']) { 
			echo '#cart-wrap .but-cart:hover, .footer .instagram-footer .readmore-button a:hover, a.comment-reply-link:hover, input[type="submit"]:hover, input[type="button"]:hover, .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open > .dropdown-toggle.btn-default, .category-filter ul li.current-cat a, .category-filter ul li a:hover, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce div.product form.cart .button:hover, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit.alt, .woocommerce a.button:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce button.button:hover, .woocommerce input.button:hover { background: '.$buzzblogpro_options['buttons_background_color']['hover'].'}';
			}else{echo '#cart-wrap .but-cart:hover, .footer .instagram-footer .readmore-button a:hover, a.comment-reply-link:hover, input[type="submit"]:hover, input[type="button"]:hover, .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open > .dropdown-toggle.btn-default, .category-filter ul li.current-cat a, .category-filter ul li a:hover, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce div.product form.cart .button:hover, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit.alt, .woocommerce a.button:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce button.button:hover, .woocommerce input.button:hover { background: #222222;}';}	
}	
if (isset($buzzblogpro_options['view_post_button_border_color'])) { 	
if ($buzzblogpro_options['view_post_button_border_color']['regular']) { 
			echo '.viewpost-button a.button { border-color: '.$buzzblogpro_options['view_post_button_border_color']['regular'].'}';
			}else{echo '.viewpost-button a.button { border-color: #ffffff;}';}
if ($buzzblogpro_options['view_post_button_border_color']['hover']) { 
			echo '.viewpost-button a.button:hover { border-color: '.$buzzblogpro_options['view_post_button_border_color']['hover'].'}';
			}else{echo '.viewpost-button a.button:hover { border-color: #ffffff;}';}}
if (isset($buzzblogpro_options['view_post_button_background_color'])) { 
if ($buzzblogpro_options['view_post_button_background_color']['regular']) { 
			echo '.viewpost-button a.button { background: '.$buzzblogpro_options['view_post_button_background_color']['regular'].'}';
			}else{echo '.viewpost-button a.button { background: #ffffff;}';}

if ($buzzblogpro_options['view_post_button_background_color']['hover']) { 
			echo '.viewpost-button a.button:hover { background: '.$buzzblogpro_options['view_post_button_background_color']['hover'].'}';
			}else{echo '.viewpost-button a.button:hover { background: #ffffff;}';}
			}
if (isset($buzzblogpro_options['view_post_slideshow_border_color'])) { 	
if ($buzzblogpro_options['view_post_slideshow_border_color']['regular']) { 
			echo 'a.slideshow-btn { border-color: '.$buzzblogpro_options['view_post_slideshow_border_color']['regular'].'}';
			}else{echo 'a.slideshow-btn { border-color: #ffffff;}';}
if ($buzzblogpro_options['view_post_slideshow_border_color']['hover']) { 
			echo 'a.slideshow-btn:hover { border-color: '.$buzzblogpro_options['view_post_slideshow_border_color']['hover'].'}';
			}else{echo 'a.slideshow-btn:hover { border-color: #ffffff;}';}}
if (isset($buzzblogpro_options['view_post_slideshow_background_color'])) { 
if ($buzzblogpro_options['view_post_slideshow_background_color']['regular']) { 
			echo 'a.slideshow-btn { background: '.$buzzblogpro_options['view_post_slideshow_background_color']['regular'].'}';
			}else{echo 'a.slideshow-btn { background: #ffffff;}';}

if ($buzzblogpro_options['view_post_slideshow_background_color']['hover']) { 
			echo 'a.slideshow-btn:hover { background: '.$buzzblogpro_options['view_post_slideshow_background_color']['hover'].'}';
			}else{echo 'a.slideshow-btn:hover { background: #ffffff;}';}
			}
if (isset($buzzblogpro_options['slideshow_overlay_link'])) { 
if ($buzzblogpro_options['slideshow_overlay_link'] == 'no' ) { 
			echo '.top-slideshow .cover .cover-link { display:none;}';
			}}
//page number links
if (isset($buzzblogpro_options['pagnum_button_border_color']['regular'])) { 
			echo '.page-numbers li a { border-color: '.$buzzblogpro_options['pagnum_button_border_color']['regular'].'}';
			}else{echo '.page-numbers li a { border-color: #ffffff;}';}
			
if (isset($buzzblogpro_options['pagnum_button_color']['active'])) { 
			echo '.page-numbers .current { color: '.$buzzblogpro_options['pagnum_button_color']['active'].'}';
			}else{echo '.page-numbers .current { color: #ffffff;}';}
			
if (isset($buzzblogpro_options['pagnum_button_border_color']['active'])) { 
			echo '.page-numbers .current { border-color: '.$buzzblogpro_options['pagnum_button_border_color']['active'].'}';
			}else{echo '.page-numbers .current { border-color: #ffffff;}';}
			
if (isset($buzzblogpro_options['pagnum_button_background_color']['active'])) { 
			echo '.page-numbers .current { background: '.$buzzblogpro_options['pagnum_button_background_color']['active'].'}';
			}else{echo '.page-numbers .current { background: #ffffff;}';}
			
if (isset($buzzblogpro_options['pagnum_button_border_color']['hover'])) { 
			echo '.page-numbers li a:hover { border-color: '.$buzzblogpro_options['pagnum_button_border_color']['hover'].'}';
			}else{echo '.page-numbers li a:hover { border-color: #ffffff;}';}
			
if (isset($buzzblogpro_options['pagnum_button_background_color']['regular'])) { 
			echo '.page-numbers li a { background: '.$buzzblogpro_options['pagnum_button_background_color']['regular'].'}';
			}else{echo '.page-numbers li a { background: #ffffff;}';}

if (isset($buzzblogpro_options['pagnum_button_background_color']['hover'])) { 
			echo '.page-numbers li a:hover { background: '.$buzzblogpro_options['pagnum_button_background_color']['hover'].'}';
			}else{echo '.page-numbers li a:hover { background: #ffffff;}';}		

if (isset($buzzblogpro_options['sidebar_heading_arrow_enable'])) { 
if ($buzzblogpro_options['sidebar_heading_border_color']['border-color'] && $buzzblogpro_options['sidebar_heading_arrow_enable'] == 'yes') { 
			echo '.widget-content h4.subtitle:before { border-top-color: '.$buzzblogpro_options['sidebar_heading_border_color']['border-color'].'}';
			}
if ($buzzblogpro_options['sidebar_heading_bgcolor']['color'] && $buzzblogpro_options['sidebar_heading_arrow_enable'] == 'yes') { 
			echo '.widget-content h4.subtitle:after { border-top-color: '.$buzzblogpro_options['sidebar_heading_bgcolor']['color'].'}';}
			}

if (isset($buzzblogpro_options['menu_typography']['line-height'])) { 
			echo '.icon-menu a { line-height: '.$buzzblogpro_options['menu_typography']['line-height'].';}';
			}
if (isset($buzzblogpro_options['hamburger_menu_color'])) { 
			echo '.icon-menu a { color: '.$buzzblogpro_options['hamburger_menu_color'].';}';
			echo '.nav-icon4 span, .nav-icon4 span:before, .nav-icon4 span:after { background-color: '.$buzzblogpro_options['hamburger_menu_color'].';}';
			
			}
			
			
$buzzblogpro_custom_generated_styles = ob_get_clean();
        
        wp_add_inline_style( 'buzzblogpro-style', $buzzblogpro_custom_generated_styles );
	 }
}
?>