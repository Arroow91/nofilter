<?php
/**
 * Register sidebars
 */

add_action( 'widgets_init', 'buzzblogpro_elegance_widgets_init' );


function buzzblogpro_elegance_widgets_init() {
	
	register_sidebar(array(
		'name'					=> esc_html__( 'Sidebar', 'buzzblogpro'),
		'id' 					=> 'hs_main_sidebar',
		'description'   => esc_html__( 'Located at the right/left side of the pages.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="subtitle">',
		'after_title' => '</h4>',
	));
	
		register_sidebar(array(
		'name'					=> esc_html__( 'Under the first post', 'buzzblogpro'),
		'id' 					=> 'hs_under_first_post',
		'description'   => esc_html__( 'Located below the first post', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget under-post-widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="front-page-title below_the_post"><span>',
		'after_title' => '</span></h3>',
	));
		register_sidebar(array(
		'name'					=> esc_html__( 'Under the second post', 'buzzblogpro'),
		'id' 					=> 'hs_under_second_post',
		'description'   => esc_html__( 'Located below the second post', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget under-post-widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="front-page-title below_the_post"><span>',
		'after_title' => '</span></h3>',
	));
			register_sidebar(array(
		'name'					=> esc_html__( 'Under the third post', 'buzzblogpro'),
		'id' 					=> 'hs_under_third_post',
		'description'   => esc_html__( 'Located below the third post', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget under-post-widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="front-page-title below_the_post"><span>',
		'after_title' => '</span></h3>', 
	));
				register_sidebar(array(
		'name'					=> esc_html__( 'Under the fourth post', 'buzzblogpro'),
		'id' 					=> 'hs_under_fourth_post',
		'description'   => esc_html__( 'Located below the fourth post', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget under-post-widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="front-page-title below_the_post"><span>',
		'after_title' => '</span></h3>', 
	));
				register_sidebar(array(
		'name'					=> esc_html__( 'Under the fifth post', 'buzzblogpro'),
		'id' 					=> 'hs_under_fifth_post',
		'description'   => esc_html__( 'Located below the fifth post', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget under-post-widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="front-page-title below_the_post"><span>',
		'after_title' => '</span></h3>', 
	));
	
			register_sidebar(array(
		'name'					=> esc_html__( 'Front Page', 'buzzblogpro'),
		'id' 					=> 'hs_front_page_1',
		'description'   => esc_html__( 'Located before the blog content, full wide', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget front-page-widget %2$s"><div class="widget-content"><div class="container"><div class="row"><div class="col-md-12">',
		'after_widget' => '</div></div></div></div></div>',
		'before_title' => '<h3 class="front-page-title"><span>',
		'after_title' => '</span></h3>',
	));

	register_sidebar(array(
		'name'					=> esc_html__( 'Before the blog content', 'buzzblogpro'),
		'id' 					=> 'hs_before_blog',
		'description'   => esc_html__( 'Located before the blog content', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget before-blog-widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="before_blog_title">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name'					=> esc_html__( 'Top Instagram', 'buzzblogpro'),
		'id' 					=> 'hs_top_instagram',
		'description'   => esc_html__( 'Located at the top of the header.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="top-instagram-widget visible-md-block visible-lg-block %2$s">',
		'after_widget' => '</div>',
	));
	register_sidebar(array(
		'name'					=> esc_html__( 'Top 0', 'buzzblogpro'),
		'id' 					=> 'hs_top_0',
		'description'   => esc_html__( 'Located at the top of the header.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="top-widget-full %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="top_heading">',
		'after_title' => '</div>',
	));

	register_sidebar(array(
		'name'					=> esc_html__( 'Top 1', 'buzzblogpro'),
		'id' 					=> 'hs_top_1',
		'description'   => esc_html__( 'Located at the top left side of the header.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="top-widget-left %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="top_heading">',
		'after_title' => '</div>',
	));
	
	register_sidebar(array(
		'name'					=> esc_html__( 'Top 2', 'buzzblogpro'),
		'id' 					=> 'hs_top_2',
		'description'   => esc_html__( 'Located at the top right side of the header.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="top-widget-right %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="top_heading">',
		'after_title' => '</div>',
	));

	register_sidebar(array(
		'name'					=> esc_html__( 'Bottom 1', 'buzzblogpro'),
		'id' 					=> 'hs_bottom_1',
		'description'   => esc_html__( 'Located at the bottom of pages.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="hs_bottom_1 %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="footer_heading"><h4 class="before_blog_title">',
		'after_title' => '</h4></div>',
	));
	
	register_sidebar(array(
		'name'					=> esc_html__( 'Bottom 2', 'buzzblogpro'),
		'id' 					=> 'hs_bottom_2',
		'description'   => esc_html__( 'Located at the bottom of pages.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="hs_bottom_2 %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="footer_heading"><h4 class="before_blog_title">',
		'after_title' => '</h4></div>',
	));
	
	register_sidebar(array(
		'name'					=> esc_html__( 'Bottom 3', 'buzzblogpro'),
		'id' 					=> 'hs_bottom_3',
		'description'   => esc_html__( 'Located at the bottom of pages.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="hs_bottom_3 %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="footer_heading"><h4 class="before_blog_title">',
		'after_title' => '</h4></div>',
	));

	register_sidebar(array(
		'name'					=> esc_html__( 'Instagram', 'buzzblogpro'),
		'id' 					=> 'hs_instagram_area',
		'description'   => esc_html__( 'Located at the bottom of pages.', 'buzzblogpro'),
		'before_widget' => '<div class="instagram-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name'					=> esc_html__( 'Bottom 4', 'buzzblogpro'),
		'id' 					=> 'hs_bottom_4',
		'description'   => esc_html__( 'Located below instagram widget area.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="hs_bottom_4 %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="footer_heading"><h4 class="before_blog_title">',
		'after_title' => '</h4></div>',
	));

	register_sidebar(array(
		'name'					=> esc_html__( 'Under header', 'buzzblogpro'),
		'id' 					=> 'hs_under_header',
		'description'   => esc_html__( 'Located below the main menu.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget widget_underheader %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="before_blog_title">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'name'					=> esc_html__( 'Under header logo', 'buzzblogpro'),
		'id' 					=> 'hs_under_header_logo',
		'description'   => esc_html__( 'Located below the header logo.', 'buzzblogpro'),
		'before_widget' => '<div class="widget_underheaderlogo %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));
	
		register_sidebar(array(
		'name'					=> esc_html__( 'Left side header logo', 'buzzblogpro'),
		'id' 					=> 'hs_left_header_logo',
		'description'   => esc_html__( 'Located On the left side of the header logo.', 'buzzblogpro'),
		'before_widget' => '<div class="widget_leftheaderlogo %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));
			register_sidebar(array(
		'name'					=> esc_html__( 'Right side header logo', 'buzzblogpro'),
		'id' 					=> 'hs_right_header_logo',
		'description'   => esc_html__( 'Located On the right side of the header logo.', 'buzzblogpro'),
		'before_widget' => '<div class="widget_rightheaderlogo %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));

			register_sidebar(array(
		'name'					=> esc_html__( 'Left side fullwidthleftright menu', 'buzzblogpro'),
		'id' 					=> 'hs_left_fullwidthleftright_menu',
		'description'   => esc_html__( 'Located On the left side of the fullwidthleftright menu.', 'buzzblogpro'),
		'before_widget' => '<div class="widget_fullwidthleftrigh %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="top_heading">',
		'after_title' => '</div>',
	));
			register_sidebar(array(
		'name'					=> esc_html__( 'Right side fullwidthleftright menu', 'buzzblogpro'),
		'id' 					=> 'hs_right_fullwidthleftright_menu',
		'description'   => esc_html__( 'Located On the right side of the fullwidthleftright menu.', 'buzzblogpro'),
		'before_widget' => '<div class="widget_fullwidthleftrigh %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="top_heading">',
		'after_title' => '</div>',
	));
	
	register_sidebar(array(
		'name'					=> esc_html__( 'Under footer logo', 'buzzblogpro'),
		'id' 					=> 'hs_under_footer_logo',
		'description'   => esc_html__( 'Located below the footer logo.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget_underfooterlogo %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '',
		'after_title' => '',
	));

	register_sidebar(array(
		'name'					=> esc_html__( 'Side panel', 'buzzblogpro'),
		'id' 					=> 'hs_side_panel',
		'description'   => esc_html__( 'It is a hidden panel located at the left side of page.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="subtitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name'					=> esc_html__( 'Newsletter PopUp', 'buzzblogpro'),
		'id' 					=> 'hs_newsletter_popup',
		'description'   => esc_html__( 'Newsletter Pop Up', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="subtitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name'					=> esc_html__( 'Single Post Page', 'buzzblogpro'),
		'id' 					=> 'hs_single_post_widget',
		'description'   => esc_html__( 'Widget area on a single post page under the author box section.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="widget single-post-widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="subtitle">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name'					=> esc_html__( 'Mobile top panel', 'buzzblogpro'),
		'id' 					=> 'hs_mobile_top_panel',
		'description'   => esc_html__( 'Located On the left side of the mobile top panel.', 'buzzblogpro'),
		'before_widget' => '<div class="widget-mobile-top-panel %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="top_heading">',
		'after_title' => '</div>',
	));
	register_sidebar(array(
		'name'					=> esc_html__( 'Ads', 'buzzblogpro'),
		'id' 					=> 'hs_ads',
		'description'   => esc_html__( 'It is a ads widget area.', 'buzzblogpro'),
		'before_widget' => '<div class="ads-widget"><div class="widget-ads-content">',
		'after_widget' => '</div></div>',
		'before_title' => '',
		'after_title' => '',
	));
		if ( function_exists( 'is_woocommerce' ) ) {
	register_sidebar(array(
		'name'					=> esc_html__( 'Woocommerce Sidebar', 'buzzblogpro'),
		'id' 					=> 'hs_woocommerce_sidebar',
		'description'   => esc_html__( 'Located at the right side of pages.', 'buzzblogpro'),
		'before_widget' => '<div id="%1$s" class="woocommerce-widget widget %2$s"><div class="widget-content">',
		'after_widget' => '</div></div>',
		'before_title' => '<h4 class="subtitle">',
		'after_title' => '</h4>',
	));

}

		$buzzblogpro_options = get_option( 'buzzblogpro_options' );
	  
	    $custom_sidebars = isset($buzzblogpro_options['sidebars']) ? $buzzblogpro_options['sidebars'] : '' ;
	  
		if (!empty( $custom_sidebars ) ){
			foreach ( $custom_sidebars as $key => $title) {
				
				if ( is_numeric($key) ) {
					register_sidebar(
						array(
							'id' => 'buzzblogpro_sidebar_'.$key,
							'name' => $title,
							'description'   => esc_html__( 'Custom sidebar', 'buzzblogpro'),
							'before_widget' => '<div id="%1$s" class="widget buzzblogpro-sidebar %2$s"><div class="widget-content">',
							'after_widget' => '</div></div>',
							'before_title' => '<h4 class="subtitle">',
							'after_title' => '</h4>'
						)
					);
				}
			}
		}
		
}

?>