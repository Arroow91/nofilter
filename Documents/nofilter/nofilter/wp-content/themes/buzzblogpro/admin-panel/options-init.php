<?php
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
	add_action( 'redux/construct', 'buzzblogpro_remove_as_plugin_flag' );

    function buzzblogpro_remove_as_plugin_flag() {
    ReduxFramework::$_as_plugin = false;
    }

function buzzblogpro_removeDemoModeLink() {
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
		add_action( 'admin_menu', 'buzzblogpro_remove_redux_menu',12 );
function buzzblogpro_remove_redux_menu() {
    remove_submenu_page('tools.php','redux-about');
}
    }
}
add_action('init', 'buzzblogpro_removeDemoModeLink');
add_action('admin_init', 'buzzblogpro_override_redux_message', 30);

function buzzblogpro_override_redux_message() {
    update_option( 'ReduxFrameworkPlugin_ACTIVATED_NOTICES', '');
}

if( is_admin() ) {
if ( !function_exists( 'buzzblogpro_sidgen_field_path' ) ):
function buzzblogpro_sidgen_field_path($field) {
    return get_template_directory() . '/admin-panel/options-custom-fields/sidgen/field_sidgen.php';
}
endif;

add_filter( "redux/buzzblogpro_options/field/class/sidgen", "buzzblogpro_sidgen_field_path" );
}
function buzzblogpro_OptionsPanel() {
$GLOBALS['redux_notice_check'] = false;
$GLOBALS['redux_update_check'] = false;

    $opt_name = "buzzblogpro_options";

$buzzblogpro_os_faces = array(
		"Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
            "Courier, monospace"                                   => "Courier, monospace",
            "Garamond, serif"                                      => "Garamond, serif",
            "Georgia, serif"                                       => "Georgia, serif",
            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
            "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
	);

	$customfonths = 'Palatino';
	$buzzblogpro_os_faces[$customfonths] = $customfonths;
   
   
   $theme = wp_get_theme();

    $args = array(
        'opt_name' => 'buzzblogpro_options',
        'use_cdn' => true,
        'display_name' => 'BuzzBlogPro',
		'display_version' => 'version '.$theme->get('Version'),
        'page_title' => 'Buzzblogpro',
        'update_notice' => false,
		'dev_mode' => false,
		'footer_credit'             => '<span id="footer-thankyou">' . esc_html__( 'HerculesDesign Options Panel', 'buzzblogpro' ) . '</span>',
        'menu_type' => 'submenu',
        'menu_title' => esc_html__( 'Theme Options', 'buzzblogpro' ),
        'allow_sub_menu' => TRUE,
        'page_parent' => 'themes.php',
        'page_parent_post_type' => 'your_post_type',
        'customizer' => true,
        'default_mark' => '',
		'google_update_weekly' => TRUE,
		'disable_tracking' => TRUE,
		'disable_save_warn' => TRUE,
        'google_api_key' => 'AIzaSyC_f_n9BpSQiBbwaJt_0lN1Ynk8tObUiUU',
        'class' => 'hercules',
        'hints' => array(
            'icon_position' => 'right',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => true,
    );



    Redux::setArgs( $opt_name, $args );

    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'General settings', 'buzzblogpro' ),
        'id'     => 'basic',
        'icon'   => 'el el-home',
        'fields' => array(

array(
                'id'            => 'hs_container_size',
                'type'          => 'slider',
                'title'         => esc_html__( 'Main container width', 'buzzblogpro' ),
                'subtitle'      => esc_html__( 'Choose the width of the website', 'buzzblogpro' ),
                'desc'          => esc_html__( 'Min: 900, max: 2000, step: 1, default value: 1170', 'buzzblogpro' ),
                'default'       => 1200,
                'min'           => 900,
                'step'          => 1,
                'max'           => 2000,
                'display_value' => 'text'
            ),
						            array(
                'id'       => 'main_layout',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Layout', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the layout', 'buzzblogpro' ),
                'options'  => array(
                    'wide' => esc_html__( 'Wide', 'buzzblogpro' ), 
                    'boxed' => esc_html__( 'Boxed', 'buzzblogpro' ) 
                ),
                'default'  => 'wide'
            ),
array(
                'id'       => 'body_background',
                'type'     => 'background',
                'title'    => esc_html__( 'Body styling', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the background style.', 'buzzblogpro' ),
                'default'  => array(
        'background-color' => '#ffffff',
				'background-image' => '',
		'background-repeat' => 'repeat'
    )
            ),
array(
                'id'       => 'hs_bodytext',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body Text', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your prefered font for body text.', 'buzzblogpro' ),
				'output'      => array( '.main-holder, .buzzblogpro-cookie-banner-wrap, .mfp-wrap, .social_label, .sidepanel' ),
                'google'   => true,
				'fonts' => $buzzblogpro_os_faces,
				'letter-spacing'=> true,
                'default'  => array(
                    'color'       => '#000000',
                    'font-size'   => '14px',
					'line-height'   => '26px',
					'letter-spacing'   => '0px',
                    'font-family' => 'Playfair Display',
                    'font-weight' => '400',
					'letter-spacing'=> '0px'
                ),
            ),
array(
                'id'          => 'h1_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'H1 Heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
                'output'      => array( 'h1' ),
				'fonts' => $buzzblogpro_os_faces,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for H1 heading and titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#222222',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'left',
                    'google'      => true,
                    'font-size'   => '54px',
                    'line-height' => '62px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
			array(
                'id'          => 'h2_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'H2 Heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
                'output'      => array( 'h2' ),
				'fonts' => $buzzblogpro_os_faces,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for H2 heading and titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#222222',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'inherit',
                    'google'      => true,
                    'font-size'   => '46px',
                    'line-height' => '48px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
			array(
                'id'          => 'h3_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'H3 Heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
                'output'      => array( 'h3' ),
				'fonts' => $buzzblogpro_os_faces,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for H3 heading and titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#222222',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'inherit',
                    'google'      => true,
                    'font-size'   => '44px',
                    'line-height' => '48px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
			array(
                'id'          => 'h4_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'H4 Heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
                'output'      => array( 'h4' ),
				'fonts' => $buzzblogpro_os_faces,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for H4 heading and titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#222222',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'inherit',
                    'google'      => true,
                    'font-size'   => '20px',
                    'line-height' => '30px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
			array(
                'id'          => 'h5_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'H5 Heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
                'output'      => array( 'h5' ),
				'fonts' => $buzzblogpro_os_faces,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for H5 heading and titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#222222',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'inherit',
                    'google'      => true,
                    'font-size'   => '18px',
                    'line-height' => '20px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
			array(
                'id'          => 'h6_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'H6 Heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
                'output'      => array( 'h6' ),
				'fonts' => $buzzblogpro_os_faces,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for H6 heading and titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#222222',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'inherit',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '22px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
        )
    ) );
	
	    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Translate', 'buzzblogpro' ),
        'id'         => 'hs-translate', 
		'icon'   => 'el el-flag',
        'fields'     => array(
														 array(
                'id'       => 'enable_translate',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable the translation panel.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or disable the translation panel available under the Buzzblogpro tab.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
							 array(
                'id'       => 'whatdoyouthink_text',
                'type'     => 'text',
                'title'    => esc_html__( 'What do you think?', 'buzzblogpro' ),
                'default'  => '',
            ),
										 array(
                'id'       => 'postcomment_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Post comment', 'buzzblogpro' ),
                'default'  => '',
            ),
													 array(
                'id'       => 'reply_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Reply', 'buzzblogpro' ),
                'default'  => '',
            ),
																 array(
                'id'       => 'upnext_text',
                'type'     => 'text',
                'title'    => esc_html__( 'up next', 'buzzblogpro' ),
                'default'  => '',
            ),															 array(
                'id'       => 'previously_text',
                'type'     => 'text',
                'title'    => esc_html__( 'previously', 'buzzblogpro' ),
                'default'  => '',
            ),
				 array(
                'id'       => 'continuereading_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Continue reading', 'buzzblogpro' ),
                'default'  => '',
            ),
				 array(
                'id'       => 'subscribe_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Subscribe', 'buzzblogpro' ),
                'default'  => '',
            ),
				 array(
                'id'       => 'youmightalsolike_text',
                'type'     => 'text',
                'title'    => esc_html__( 'You Might Also Like', 'buzzblogpro' ),
                'default'  => '',
            ),
				 array(
                'id'       => 'min_read_text',
                'type'     => 'text',
                'title'    => esc_html__( 'min read', 'buzzblogpro' ),
                'default'  => '',
            ),
				 array(
                'id'       => 'location_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Location:', 'buzzblogpro' ),
                'default'  => '',
            ),
							 array(
                'id'       => 'share_on_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Share', 'buzzblogpro' ),
                'default'  => '',
            ),
										 array(
                'id'       => 'before_author_text',
                'type'     => 'text',
                'title'    => esc_html__( 'By', 'buzzblogpro' ),
                'default'  => '',
            ),
										 array(
                'id'       => 'trending_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Trending this week', 'buzzblogpro' ),
                'default'  => '',
            ),
									array(
                'id'       => 'most_popular_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Most popular posts', 'buzzblogpro' ),
                'default'  => '',
            ),
												array(
                'id'       => 'views_text',
                'type'     => 'text',
                'title'    => esc_html__( 'views', 'buzzblogpro' ),
                'default'  => '',
            ),
			
			        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header styling', 'buzzblogpro' ),
        'id'         => 'hs-header-styling',
		'icon'   => 'el el-brush',
        'fields'     => array(
            		array(
                'id'       => 'header_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Header layout', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose a layout for heaader area.', 'buzzblogpro' ),
                'options'  => array(
                    'center' => array( 'title' => 'center menu below the logo', 'img' => get_template_directory_uri() . '/includes/images/headercenter.png' ),
                    'topcenter' => array( 'title' => 'center menu above the logo', 'img' => get_template_directory_uri() . '/includes/images/headertopcenter.png' ),
                    'topleftmenu' => array( 'title' => 'top left menu with widget', 'img' => get_template_directory_uri() . '/includes/images/headertopmenuleft.png' ),
					'bottomleftmenu' => array( 'title' => 'bottom left menu with widget', 'img' => get_template_directory_uri() . '/includes/images/headerbottommenuleft.png' ),
					'left' => array( 'title' => 'left logo with menu on the right', 'img' => get_template_directory_uri() . '/includes/images/headerleft.png' ),
					'leftad' => array( 'title' => 'left logo with banner and bottom menu', 'img' => get_template_directory_uri() . '/includes/images/headerad.png' ),
					'fullwidthleftright' => array( 'title' => 'Left and right widget in the menu and logo below', 'img' => get_template_directory_uri() . '/includes/images/fullwidthleftright.png' ),
					'fullwidthleftright-logo-below' => array( 'title' => 'Left and right widget in the menu and logo above', 'img' => get_template_directory_uri() . '/includes/images/fullwidthleftright-logo-below.png' ),
					'split' => array( 'title' => 'split menu', 'img' => get_template_directory_uri() . '/includes/images/headersplit.png' )
                ),
                'default'  => 'fullwidthleftright'
            ),
			
				 array(
                'id'       => 'split_menu_align_items',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Align the menu items', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Align the menu items to the sides of the screen ?', 'buzzblogpro' ),
				'required' => array( 'header_layout', '=', 'split' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
			
																				            array(
                'id'       => 'fullwidth_menu',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Full width header', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to enable the full width header content ?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																							            array(
                'id'       => 'remove_header_other_pages',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Remove the header from the other pages', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to keep the header along with the logo only on the home page?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
			array(
                'id'       => 'header_image',
                'type'     => 'background',
                'title'    => esc_html__( 'Header background image', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the header background image.', 'buzzblogpro' ),
				'output'   => array( '.headerstyler' ),
                'default'  => array(
        'background-color' => '#ffffff',
    )
            ),
			            array(
                'id'       => 'overlay_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header overlay', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the header overlay color.', 'buzzblogpro' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '0.6'
                ),
                'mode'     => 'background',
            ),
													 array(
                'id'       => 'enable_header_parallax',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable parallax for the header', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or disable parallax effect for the main header.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
																 array(
                'id'       => 'enable_video_home',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Home page video background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable header video background only for the home page ?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
													  array(
                'id'       => 'header_video_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Header video url', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter video url, for example: http://youtube.com/watch?v=3H8bnKdf654', 'buzzblogpro' ),
                'default'  => '',
            ),
																  array(
                'id'       => 'header_video_start',
                'type'     => 'text',
                'title'    => esc_html__( 'Header video start time', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter from which second the video should start.', 'buzzblogpro' ),
                'default'  => '7',
            ),
																			  array(
                'id'       => 'header_video_end',
                'type'     => 'text',
                'title'    => esc_html__( 'Header video end time', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter in which second the video should end.', 'buzzblogpro' ),
                'default'  => '25',
            ),
			array(
                'id'       => 'top_menu_typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'Top Menu Typography', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your preferred font for top menu.', 'buzzblogpro' ),
                'google'   => true,
				'fonts' => $buzzblogpro_os_faces,
				'color'       => false,
				'line-height'   => false,
				'letter-spacing'=> true,
				'text-transform'=> true,
				'output'      => array( '#top-menu a' ),
                'default'  => array(
                    'font-size'   => '10px',
					'letter-spacing'   => '1px',
                    'font-family' => 'Heebo',
                    'font-weight' => '400',
					'text-transform'=> 'uppercase'
                ),
            ),
					            array(
                'id'       => 'top-container-menu-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Top menu link color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the top menu link color.', 'buzzblogpro' ),
				'output'   => array( '#top-menu a' ),
                'default'  => array(
				    'regular' => '#000000',
                    'hover'   => '#989898',
                    'active'  => '#989898',
                )
            ),
								            array(
                'id'       => 'top-container-submenu-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Top menu sub menu link color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the top menu, sub menu links color.', 'buzzblogpro' ),
				'output'   => array( '#top-menu ul a, #top-menu .current_page_item ul a, #top-menu ul .current_page_item a, #top-menu .current-menu-item ul a, #top-menu ul .current-menu-item a, #top-menu li:hover > ul a, .before_the_blog_content .hs_recent_popular_tab_widget_content .tab_title.selected a' ),
                'default'  => array(
				    'regular' => '#989898',
                    'hover'   => '#c6c6c6',
                    'active'  => '#c6c6c6',
                )
            ),
			
									            array(
                'id'       => 'topmenu_submenu_bg_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Top menu dropdown background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the top menu dropdown background color.', 'buzzblogpro' ),
                'default'  => array(
                    'color' => '#f9f9f9',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),
			
								            array(
                'id'       => 'topmenu_submenu_button_border_bottom_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Top menu dropdown button border-bottom color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the top menu dropdown button border-bottom color.', 'buzzblogpro' ),
                'default'  => '#ffffff',
                'validate' => 'color',
            ),
									            array(
                'id'       => 'top-container-links_color',
                'type'     => 'link_color',
				'output'   => array( '.top-widget-left a, .top-widget-right a' ),
                'title'    => esc_html__( 'Top container links color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the top container links color.', 'buzzblogpro' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#ffffff',
                    'hover'   => '#989898',
                )
            ),
						         array(
                'id'       => 'top_container_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Top container background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the top container dropdown background color.', 'buzzblogpro' ),
                'default'  => '#000000',
                'validate' => 'color',
            ),
						array( 
    'id'       => 'top_container_border_color',
    'type'     => 'border',
    'title'    => esc_html__( 'Top container border color', 'buzzblogpro' ),
    'subtitle' => esc_html__( 'Change the top container bottom border color.', 'buzzblogpro' ),
	        'top'    => false, 
        'right'  => false, 
        'left'   => false,
		'bottom'   => true,
		'all' => false,
    'output'   => array('.top-border'),
    'default'  => array(
        'border-color'  => '#eeeeee', 
        'border-style'  => 'solid', 
        'border-bottom' => '0px'
    )
	),
				array(
                'id'       => 'top_container_typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'Top Container Typography', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your preferred font for top container.', 'buzzblogpro' ),
                'google'   => true,
				'fonts' => $buzzblogpro_os_faces,
				'line-height'   => false,
				'letter-spacing'=> true,
				'text-transform'=> true,
				'output'      => array( '.top-full, .top-left, .top-right, .top-full .widget_search input[type="text"], .top-left .widget_search input[type="text"], .top-left .widget_search input[type="text"], .mobile-top-panel' ),
                'default'  => array(
				'color'       => '#dddddd',
                    'font-size'   => '10px',
					'letter-spacing'   => '0px',
                    'font-family' => 'Heebo',
                    'font-weight' => '400',
					'text-transform'=> 'uppercase'
                ),
            ),
							array(
                'id'       => 'fullwidthleftright_widgets_typography',
                'type'     => 'typography',
                'title'    => esc_html__( '"fullwidthleftright" menu widgets typography', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your preferred font for the "fullwidthleftright" menu widgets.', 'buzzblogpro' ),
                'google'   => true,
				'fonts' => $buzzblogpro_os_faces,
				'line-height'   => false,
				'letter-spacing'=> true,
				'text-transform'=> true,
				'output'      => array( '.top-container-full .top-left, .top-container-full .top-right, .top-container-full .top-left .widget_search input[type="text"], .top-container-full .top-right .widget_search input[type="text"], .top-container-full .top-left a, .top-container-full .top-right a' ),
                'default'  => array(
				'color'       => '#dddddd',
                    'font-size'   => '10px',
					'letter-spacing'   => '0px',
                    'font-family' => 'Heebo',
                    'font-weight' => '400',
					'text-transform'=> 'uppercase'
                ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Theme styles', 'buzzblogpro' ),
        'id'         => 'hs-theme-styles',
		'icon'   => 'el el-adjust-alt',
        'fields'     => array(
            array(
                'id'       => 'global_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Accent color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the accent color.', 'buzzblogpro' ),
                'default'  => '#000000',
            ),
			            array(
                'id'       => 'links_color',
                'type'     => 'link_color',
				'output'   => array( 'a' ),
                'title'    => esc_html__( 'Links color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the links color.', 'buzzblogpro' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#c5b8a5',
                )
            ),
						            array(
                'id'       => 'links_color_post_page',
                'type'     => 'link_color',
				'output'   => array( '.single .post_content .post-inner a:not(.opengallery-link), home(.wpb-js-composer) .page .post-inner a:not(.btn)' ),
                'title'    => esc_html__( 'Links color on the single post and page', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the links color on the single post and page.', 'buzzblogpro' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#ffffff',
                )
            ),
																					            array(
                'id'       => 'links_underline_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Links underline color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the links underline color', 'buzzblogpro' ),
				'output'   => array( 'a.body-link:after, span.body-link a:after' ),
                'default'  => array(
                    'color' => '#c5b8a5',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),
				array(
                'id'       => 'links_underline_color_hover',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Links underline hover color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the links underline hover color', 'buzzblogpro' ),
				'active'   => false,
				'regular'   => false,
				'visited'   => false,
				'output'   => array( '.single .post_content .post-inner a:not(.opengallery-link).body-link, .page .post-inner a:not(.btn).body-link, .single .post_content .post-inner span.body-link a:not(.opengallery-link), .page .post-inner span.body-link a:not(.btn)' ),
                'default'  => array(   
                    'hover' => '#ffffff',
                )
            ),
												array(
                'id'          => 'buttons_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Readmore button font', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
				'color'       => false,
				'text-align' => false,
                'output'      => array( 'input[type="button"], input[type="reset"], input[type="submit"], a.btn' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for buttons.', 'buzzblogpro' ),
                'default'     => array(
					'font-weight'  => '400',
                    'font-family' => '',
                    'google'      => true,
                    'font-size'   => '12px',
                    'line-height' => '17px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
			 array(
                'id'       => 'buttons_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Buttons color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the buttons color.', 'buzzblogpro' ),
				'output'   => array( '#cart-wrap .but-cart, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .footer .instagram-footer .readmore-button a, a.btn, a.comment-reply-link, input[type="submit"], input[type="button"], .category-filter ul li a, .woocommerce #review_form #respond .form-submit input, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce div.product form.cart .button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#ffffff',
                    'hover'   => '#ffffff',
                )
            ),
			array(
                'id'       => 'buttons_border_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Buttons border color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the buttons border color.', 'buzzblogpro' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#c5b8a5',
                )
            ),
			array(
                'id'       => 'buttons_background_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Buttons background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the background color.', 'buzzblogpro' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#c5b8a5',
                )
            ),
			
																							            array(
                'id'       => 'buttons_radius',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Buttons radius', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want enable rounded buttons ?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
																																			 array(
                'id'       => 'content_around_shadow',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Shadow around the content.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display shadow around the content?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),

			            array(
                'id'       => 'custom_css',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom CSS code', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Want to add any custom CSS code? Put in here, and the rest is taken care of.', 'buzzblogpro' ),
                'mode'     => 'css',
                'theme'    => 'chrome',
                'default'  => ""
            ),

        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Logo', 'buzzblogpro' ),
        'id'         => 'hs-logo-favicon',
		'icon'   => 'el el-tag',
        'fields'     => array(
            array(
                'id'             => 'logo_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'output'      => array( '.home .logo' ),
                'right'         => false,
                'left'          => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Logo margin', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the top and bottom margin value for the home page.', 'buzzblogpro' ),
                'default'        => array(
                    'margin-top'    => '50px',
                    'margin-bottom' => '60px',
                )
            ),
			            array(
                'id'             => 'logo_margin_rest',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'output'      => array( 'body:not(.home) .logo' ),
                'right'         => false,
                'left'          => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Logo margin for the rest of the pages.', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the top and bottom logo margin value for the rest of the pages.', 'buzzblogpro' ),
                'default'        => array(
                    'margin-top'    => '50px',
                    'margin-bottom' => '60px',
                )
            ),
			            array(
                'id'             => 'footer_logo_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'output'      => array( '.footer .logo' ),
                'right'         => false,
                'left'          => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Footer Logo margin', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the top and bottom margin value.', 'buzzblogpro' ),
                'default'        => array(
                    'margin-top'    => '40px',
                    'margin-bottom' => '40px',
                )
            ),
		   array(
                'id'       => 'logo_type',
                'type'     => 'switch',
                'title'    => esc_html__( 'What kind of logo?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select whether you want your main logo to be an image or text. If you select "image" you can put in the image url in the next option, and if you select "text" your Site Title will be shown instead.', 'buzzblogpro' ),
                'default'  => 0,
                'on'       => 'Image Logo',
                'off'      => 'Text Logo',
            ),
array(
                'id'       => 'logo_typography',
                'type'     => 'typography',
				'required' => array( 'logo_type', '=', '0' ),
                'title'    => esc_html__( 'Logo Typography', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your preferred font for logo.', 'buzzblogpro' ),
                'google'   => true,
				'fonts' => $buzzblogpro_os_faces,
				'letter-spacing'=> true,
				'output'      => array( '.logo_h__txt, .logo_link' ),
                'default'  => array(
                    'color'       => '#000000',
                    'font-size'   => '125px',
					'line-height'   => '145px',
					'letter-spacing'   => '0px',
                    'font-family' => 'Mr De Haviland',
                    'font-weight' => '400',
                ),
            ),
            array(
                'id'       => 'logo_hover_color',
                'type'     => 'link_color',
				'required' => array( 'logo_type', '=', '0' ),
                'title'    => esc_html__( 'Logo hover color', 'buzzblogpro' ), 
                'subtitle' => esc_html__( 'Change the logo hover color.', 'buzzblogpro' ),
				'output'      => array( '.logo_h a:hover, .logo_h a' ),
                'regular'   => false,
                'default'  => array(
                    'hover'   => '#000000',
                    'active'  => '#000000',
                )
            ),
		array(
                'id'       => 'logo_url',
                'type'     => 'media',
				'required' => array( 'logo_type', '=', '1' ),
                'url'      => true,
                'title'    => esc_html__( 'Header Logo Image Path', 'buzzblogpro' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Click Upload or Enter the direct path to your logo image.', 'buzzblogpro' ),
                'default'  => array( 'url' => '' ),
            ),
							  array(
                'id'       => 'header_logo_width',
                'type'     => 'text',
				'required' => array( 'logo_type', '=', '1' ),
                'title'    => esc_html__( 'Header logo width.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the width of the header logo. If you want a logo that is 100px wide to look sharp on a Retina display, upload image twice as big to begin with, which means 200px and enter 100 in this field.', 'buzzblogpro' ),
                'default'  => '500',
            ),
				array(
                'id'       => 'footer_logo_url',
                'type'     => 'media',
				'required' => array( 'logo_type', '=', '1' ),
                'url'      => true,
                'title'    => esc_html__( 'Footer Logo Image Path', 'buzzblogpro' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Click Upload or Enter the direct path to your logo image.', 'buzzblogpro' ),
                'default'  => array( 'url' => '' ),
            ),
										  array(
                'id'       => 'footer_logo_width',
                'type'     => 'text',
				'required' => array( 'logo_type', '=', '1' ),
                'title'    => esc_html__( 'Footer logo width.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the width of the footer logo. If you want a logo that is 100px wide to look sharp on a Retina display, upload image twice as big to begin with, which means 200px and enter 100 in this field.', 'buzzblogpro' ),
                'default'  => '605',
            ),
				array(
                'id'       => 'logo_tagline',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display logo tagline?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display tagline under the logo?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
			
			array(
                'id'       => 'tagline_color',
                'type'     => 'typography',
                'title'    => esc_html__( 'Tagline typography', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your preferred font for tagline.', 'buzzblogpro' ),
                'google'   => true,
				'fonts' => $buzzblogpro_os_faces,
				'letter-spacing'=> true,
				'text-transform'=> true,
				'output'      => array( '.logo_tagline' ),
                'default'  => array(
                    'color'       => '#000000',
                    'font-size'   => '10px',
					'line-height'   => '10px',
					'letter-spacing'   => '6px',
                    'font-family' => 'Heebo',
                    'font-weight' => '400',
					'text-transform'=> 'uppercase'
                ),
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Navigation', 'buzzblogpro' ),
        'id'         => 'hs-navigation',
		'icon'   => 'el el-align-justify',
        'fields'     => array(
			            array(
                'id'       => 'header_position',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Menu type', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the main menu type (normal or sticky)', 'buzzblogpro' ),
                'options'  => array(
                    'stickyheader' => esc_html__( 'Sticky', 'buzzblogpro' ), 
                    'normalheader' => esc_html__( 'Normal', 'buzzblogpro' ) 
                ),
                'default'  => 'stickyheader'
            ),
			

														            array(
                'id'       => 'hamburger_menu',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Side panel', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to the show side panel only on mobile ?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
			
									array(
                'id'       => 'side_panel_bg_color',
                'type'     => 'background',
                'title'    => esc_html__( 'Side panel background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the background of the side panel.', 'buzzblogpro' ),
				'output'   => array( '.st-menu' ),
                'default'  => array(
        'background-color' => '#ffffff',
    )
            ),
												            array(
                'id'       => 'side_panel_bg_overlay_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Side panel overlay color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the side panel overlay color.', 'buzzblogpro' ),
				'output'      => array( '.st-menu:before' ),
                'default'  => array(
                    'color' => '#000000',
                    'alpha' => '.3'
                ),
                'mode'     => 'background',
            ),
			            array(
                'id'       => 'hamburger_menu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Hamburger menu color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the Hamburger icon color.', 'buzzblogpro' ),
                'default'  => '#ffffff',
                'validate' => 'color',
            ),
			
			array(
                'id'       => 'side_panel_typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'Side Panel Typography', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your preferred font for Side Panel.', 'buzzblogpro' ),
                'google'   => true,
				'fonts' => $buzzblogpro_os_faces,
				'letter-spacing'=> true,
				'text-transform'=> true,
				'output'      => array( '.menu-mobile ul li a, ul li.has-subnav .accordion-btn' ),
                'default'  => array(
                    'font-size'   => '23px',
					'line-height'   => '32px',
					'letter-spacing'   => '0px',
                    'font-family' => 'Prata',
                    'font-weight' => '400',
					'text-transform'=> 'none'
                ),
            ),
					            array(
                'id'       => 'side-panel-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Side Panel links color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the Side Panel links color.', 'buzzblogpro' ),
				'output'   => array( '.menu-mobile ul li a, ul li.has-subnav .accordion-btn' ),
                'default'  => array(
				    'regular' => '#ffffff',
                    'hover'   => '#d8d8d8',
					'active'   => '#d8d8d8'
                )
            ),
															array( 
    'id'       => 'side_panel_links_border_color',
    'type'     => 'border',
    'title'    => esc_html__( 'Side panel links border color', 'buzzblogpro' ),
    'subtitle' => esc_html__( 'Change the border of the submenu links.', 'buzzblogpro' ),
		'all' => false,
		'right'  => false, 
		'left'   => false,
		'bottom'   => false,
		'top'   => true,
    'output'   => array('.menu-mobile ul ul li'),
    'default'  => array(
        'border-color'  => '#888888', 
        'border-style'  => 'solid',  
        'border-top' => '1px'
    )
	),
			
								array(
                'id'       => 'logo_image',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display logo in the main menu', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display logo in the main menu?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
array(
                'id'       => 'logo_image_url',
                'type'     => 'media',
				'required' => array( 'logo_image', '=', 'yes' ),
                'url'      => true,
                'title'    => esc_html__( 'Menu Logo Image Path', 'buzzblogpro' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Click to upload your logo image.', 'buzzblogpro' ),
                'default'  => array( 'url' => '' ),
            ),
			
										 array(
                'id'       => 'megamenu_items_image_width',
                'type'     => 'text',
                'title'    => esc_html__( 'Megamenu items image width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image width value.', 'buzzblogpro' ),
                'default'  => '261', 
            ),
						 array(
                'id'       => 'megamenu_items_image_height',
                'type'     => 'text',
                'title'    => esc_html__( 'Megamenu items image height', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image height value.', 'buzzblogpro' ),
                'default'  => '360',
            ),
									 array(
                'id'       => 'megamenu_height',
                'type'     => 'text',
                'title'    => esc_html__( 'Megamenu minimum height', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the minimum height of the megamenu dropdown container.', 'buzzblogpro' ),
                'default'  => '476',
            ),
						            array(
                'id'       => 'megamenu_date_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Megamenu date color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the Megamenu date color.', 'buzzblogpro' ),
				'output'      => array( '.primary-menu .mega-menu-posts .post-date' ),
                'default'  => '#bbbbbb',
                'validate' => 'color',
            ),

array(
                'id'       => 'menu_typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'Menu Typography', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your preferred font for menu.', 'buzzblogpro' ),
                'google'   => true,
				'fonts' => $buzzblogpro_os_faces,
				'letter-spacing'=> true,
				'text-transform'=> true,
				'output'      => array( '.primary-menu > li > a, .mobile-top-panel a' ),
                'default'  => array(
                    'color'       => '#ffffff',
                    'font-size'   => '10px',
					'line-height'   => '20px',
					'letter-spacing'   => '1px',
                    'font-family' => 'Heebo',
                    'font-weight' => '400',
					'text-transform'=> 'uppercase'
                ),
            ),
            array(
                'id'             => 'menu_items_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'left' => true,
				'output'      => array( '.primary-menu a, .icon-menu a' ),
                'units'          => array( 'em', 'px', '%' ),
                'title'          => esc_html__( 'Menu items padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the padding of the main menu items.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '20px',
                    'padding-bottom' => '20px',
					'padding-left' => '12px',
					'padding-right' => '12px',
					'units'          => 'px', 
                )
            ),
array(
                'id'       => 'dropdown_menu_typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'Drop down menu typography', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your preferred font for drop down menu.', 'buzzblogpro' ),
                'google'   => true,
				'fonts' => $buzzblogpro_os_faces,
				'letter-spacing'=> true,
				'text-transform'=> true,
				'output'      => array( '.primary-menu li ul li:not(.buzzblogpro-widget-menu) a, .primary-menu .has-mega-column:not(.widget-in-menu) > .sub-menu a, .primary-menu .mega-menu-posts .post a:not(.reviewscore), .buzzblogpro-widget-menu .form-control' ),
                'default'  => array( 
                    'color'       => '#000000', 
                    'font-size'   => '9px',
					'line-height'   => '10px',
					'letter-spacing'   => '0px',
					'text-align' => 'left',
                    'font-family' => 'Heebo',
                    'font-weight' => '400',
					'text-transform'=> 'none'
                ),
            ),
			array(
                'id'       => 'dropdown_menu_column_heading',
                'type'     => 'typography',
                'title'    => esc_html__( 'Mega menu headings font', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your preferred font parameters for mega menu column headings.', 'buzzblogpro' ),
                'google'   => false,
				'font-family' => false,
				'letter-spacing'=> true,
				'text-transform'=> true,
				'output'      => array( '.primary-menu .has-mega-column > .sub-menu > .columns-sub-item > a, .primary-menu .buzzblogpro-mc-form h4' ),
                'default'  => array(
                    'color'       => '#000000', 
                    'font-size'   => '13px',
					'line-height'   => '20px',
					'letter-spacing'   => '0px',
                    'font-weight' => 'Bold',
                ),
            ),
						            array(
                'id'       => 'g_search_box_id',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display search icon?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display search icon in the main menu?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
            array(
                'id'       => 'mainmenu_current_button_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Hover / active main menu link color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the color of the hover/active main menu link.', 'buzzblogpro' ),
				'output'      => array( '.mobile-top-panel a' ),
                'regular'   => false,
                'default'  => array(
                    'hover'   => '#bababa',
                    'active'  => '#bababa',
                )
            ),
		            array(
                'id'       => 'mainmenu_button_bg_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Main menu link background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the color of the link background color', 'buzzblogpro' ),
                'default'  => array(
				    'regular' => '#000000',
                    'hover'   => '#000000',
                    'active'  => '#000000',
                )
            ),
															            array(
                'id'       => 'mainmenu_button_bg_color_transparent',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Main menu link background color transparency', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want Main menu link background color to be transparent? ', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
			            array(
                'id'       => 'mainmenu_button_active_border_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Main menu active/hover link top border color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the main menu active/hover link top border color.', 'buzzblogpro' ),
                'default'  => 'transparent',
                'validate' => 'color',
			
            ),
						            array(
                'id'       => 'mainmenu_between_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Line between the main menu items', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the color of the line between menu items.', 'buzzblogpro' ),
				'output'    => array('background-color' => '.primary-menu > li > a::after'),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '0.1'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'mainmenu_submenu_bg_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Dropdown background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the dropdown background color.', 'buzzblogpro' ),
				'output'    => array('.primary-menu .sub-menu, .primary-menu .has-mega-sub-menu .mega-sub-menu, .primary-menu .has-mega-column > .sub-menu, #cart-wrap'),
				    'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),
			            array(
                'id'             => 'dropdown_padding_value',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'left' => true,
				'output'      => array( '.primary-menu > li > ul, .primary-menu ul li:not(.buzzblogpro-widget-menu) > ul' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'Dropdown container padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the padding of the dropdown container.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '15px',
                    'padding-bottom' => '15px',
					'padding-left' => '20px',
					'padding-right' => '20px',
					'units'          => 'px', 
                )
            ),
						            array(
                'id'             => 'dropdown_menu_itmes_padding_value',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'left' => true,
				'output'      => array( '.primary-menu ul a' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'Dropdown menu itmes padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the padding of the dropdown menu itmes.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '14px',
                    'padding-bottom' => '14px',
					'padding-left' => '22px',
					'padding-right' => '22px',
					'units'          => 'px', 
                )
            ),

			array( 
    'id'       => 'mainmenu_submenu_border_color',
    'type'     => 'border',
    'title'    => esc_html__( 'Dropdown border color and width', 'buzzblogpro' ),
    'subtitle' => esc_html__( 'Change the dropdown border color and width.', 'buzzblogpro' ),
		'all' => false,
    'output'   => array('.primary-menu .has-mega-column > .sub-menu, .primary-menu .has-mega-sub-menu .mega-sub-menu, .primary-menu > li > ul, .primary-menu ul li:not(.buzzblogpro-widget-menu) > ul, #cart-wrap'),
    'default'  => array(
        'border-color'  => '#ffffff', 
        'border-style'  => 'solid', 
        'border-top'    => '0px', 
        'border-right'  => '0px', 
        'border-bottom' => '0px', 
        'border-left'   => '0px'
    )
	),
					            array(
                'id'       => 'mainmenu_submenu_link_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Dropdown link color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the dropdown link color.', 'buzzblogpro' ),
				'regular' => false,
                'default'  => array(
                    'hover'   => '#000000',
                    'active'  => '#000000',
                )
            ),
			
            array(
                'id'       => 'mainmenu_submenu_button_color_regular',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Dropdown background color - regular', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the dropdown background color for regular state.', 'buzzblogpro' ),
				'output'    => array('.primary-menu li:not(.widget-in-menu) ul li a, .primary-menu .has-mega-column:not(.widget-in-menu) > .sub-menu a'),
				    'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),
			            array(
                'id'       => 'mainmenu_submenu_button_color_hover',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Dropdown background color - hover', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the dropdown background color for hover state.', 'buzzblogpro' ),
				'output'    => array('.primary-menu ul li:hover > a, .primary-menu .has-mega-column:not(.widget-in-menu) > .sub-menu a:hover'),
				    'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),
						            array(
                'id'       => 'mainmenu_submenu_button_color_active',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Dropdown background color - active', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the dropdown background color for active state.', 'buzzblogpro' ),
				'output'    => array('.primary-menu ul li.current-menu-item > a, .primary-menu .has-mega-column > .sub-menu .current-menu-item > a'),
				    'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),
				
			            array(
                'id'       => 'mainmenu_submenu_button_border_bottom_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Dropdown button border-bottom color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the dropdown button border-bottom color.', 'buzzblogpro' ),
                'default'  => '#eeeeee',
                'validate' => 'color',
            ),
			
																		            array(
                'id'       => 'mainmenu_shadow_menu',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Shadow menu ', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to enable shadow under the menu?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
												            array(
                'id'       => 'bgmenu_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'The main menu background Color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the background color of the main menu.', 'buzzblogpro' ),
				'output'   => array( '.sticky-wrapper, #primary, .sticky-nav.navbar-fixed-top, .top-container-normal, .top-container-full-no-sticky, .shadow-menu, .mobile-top-panel' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),
															            array(
                'id'       => 'sticky_bgmenu_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Fixed main menu background Color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the background color of the fixed main menu.', 'buzzblogpro' ),
				'output'   => array( '.sticky-nav.navbar-fixed-top' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),
			
									            array(
                'id'       => 'lineabove_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Color of the line above the main menu', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the color of the line above the main menu.', 'buzzblogpro' ),
                'default'  => '#eeeeee',
                'validate' => 'color',
            ),
						            array(
                'id'            => 'lineabove_border_thick',
                'type'          => 'slider',
                'title'         => esc_html__( 'The thickness of the line above the main menu', 'buzzblogpro' ),
                'subtitle'      => esc_html__( 'Change the thickness of the line above the main menu.', 'buzzblogpro' ),
                'desc'          => esc_html__( 'Min: 0, max: 15, step: 1, default value: 0', 'buzzblogpro' ),
                'default'       => 0,
                'min'           => 0,
                'step'          => 1,
                'max'           => 15,
                'display_value' => 'text'
            ),
											            array(
                'id'       => 'linebelow_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Color of the line below the main menu', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the color of the line below the main menu.', 'buzzblogpro' ),
                'default'  => '#ededed',
                'validate' => 'color',
            ),
								            array(
                'id'            => 'linebelow_border_thick',
                'type'          => 'slider',
                'title'         => esc_html__( 'The thickness of the line below the main menu', 'buzzblogpro' ),
                'subtitle'      => esc_html__( 'Change the thickness of the line below the main menu.', 'buzzblogpro' ),
                'desc'          => esc_html__( 'Min: 0, max: 15, step: 0, default value: 0', 'buzzblogpro' ),
                'default'       => 0,
                'min'           => 0,
                'step'          => 1,
                'max'           => 15,
                'display_value' => 'text'
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'buzzblogpro' ),
        'id'         => 'hs-blog',
		'icon'   => 'el el-list',
        'fields'     => array(
            		array(
                'id'       => 'blog_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog layout', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose a blog layout.', 'buzzblogpro' ),
                'options'  => array(
                    'left' => array( 'title' => 'left sidebar', 'img' => get_template_directory_uri() . '/includes/images/2cl.png' ),
                    'right' => array( 'title' => 'right sidebar', 'img' => get_template_directory_uri() . '/includes/images/2cr.png' ),
                    'full' => array( 'title' => 'no sidebar', 'img' => get_template_directory_uri() . '/includes/images/1col.png' ),
					'masonry2' => array( 'title' => 'masonry 2 columns', 'img' => get_template_directory_uri() . '/includes/images/masonry2.png' ),
                    'masonry3' => array( 'title' => 'masonry 3 columns', 'img' => get_template_directory_uri() . '/includes/images/masonry3.png' ),
                    'masonry4' => array( 'title' => 'masonry 4 columns', 'img' => get_template_directory_uri() . '/includes/images/masonry4.png' ),
					'masonry2sideleft' => array( 'title' => 'masonry 2 columns sidebar left', 'img' => get_template_directory_uri() . '/includes/images/masonry2-leftsidebar.png' ),
                    'masonry2sideright' => array( 'title' => 'masonry 2 columns sidebar right', 'img' => get_template_directory_uri() . '/includes/images/masonry2-rightsidebar.png' ),
                    'listpostsideright' => array( 'title' => 'list view sidebar right', 'img' => get_template_directory_uri() . '/includes/images/listpost-rightsidebar.png' ),
					'listpostsideleft' => array( 'title' => 'list view sidebar left', 'img' => get_template_directory_uri() . '/includes/images/listpost-leftsidebar.png' ),
                    'listpostfullwidth' => array( 'title' => 'list view no sidebar', 'img' => get_template_directory_uri() . '/includes/images/listpost-fullwidth.png' ),
					'zigzagfullwidth' => array( 'title' => 'zigzag view no sidebar', 'img' => get_template_directory_uri() . '/includes/images/zigzag-fullwidth.png' ),
					'zigzagsideright' => array( 'title' => 'zigzag view right sidebar', 'img' => get_template_directory_uri() . '/includes/images/zigzag-right-sidebar.png' ),
					'zigzagsideleft' => array( 'title' => 'zigzag view left sidebar', 'img' => get_template_directory_uri() . '/includes/images/zigzag-left-sidebar.png' ),
					'metro' => array( 'title' => 'metro', 'img' => get_template_directory_uri() . '/includes/images/metro.png' ),
                ),
                'default'  => 'right'
            ),
			

			
																	            array(
                'id'       => 'lazyload_images',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Lazyload images', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to enable Lazyload images feature?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
																				            array(
                'id'       => 'ligtbox_images',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Ligtbox images', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to enable Ligtbox for posts images?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
			
						            array(
                'id'       => 'do_not_dublicate',
                'type'     => 'select',
                'data'     => 'posts',
                'args' => array('post_type'=>'post', 'posts_per_page' => -1),
                'multi'    => true,
				'sortable'  => true,
                'title'    => esc_html__( 'Exclude Posts by ID', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose posts you want to exclude from the main blog.', 'buzzblogpro' ),
            ),
			
			            array(
                'id'       => 'blog_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Blog page title', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter Your Blog Title used on Blog page.', 'buzzblogpro' ),
                'default'  => '',
            ),
						            array(
                'id'       => 'blog_sub',
                'type'     => 'text',
                'title'    => esc_html__( 'Blog page subtitle', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter Your Blog Subtitle used on Blog page.', 'buzzblogpro' ),
                'default'  => '',
            ),
						array(
                'id'          => 'single_post_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'H1 Single Post heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
                'output'      => array( 'h1.post-title' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for H1 single post title', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'center',
                    'google'      => true,
                    'font-size'   => '50px',
                    'line-height' => '62px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
			array(
                'id'          => 'post_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'H2 Post heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
                'output'      => array( '.post-header h2 a, h2.post-title' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for H2 heading and titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'center',
                    'google'      => true,
                    'font-size'   => '33px',
                    'line-height' => '38px',
					'letter-spacing'=> '-1px',
					'text-transform'=> 'none'
                ),
            ),
						array(
                'id'          => 'post_excerpt_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Post excerpt font', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
                'output'      => array( '.excerpt p' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for posts excerpt.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
					'font-weight'  => '400',
                    'font-family' => 'Playfair Display',
					'text-align' => 'left',
                    'google'      => true,
                    'font-size'   => '14px',
                    'line-height' => '26px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
									array(
                'id'          => 'post_meta_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Post meta font', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
                'output'      => array( '.meta-space-top, .meta-space-top a' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for posts meta.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#444444',
					'font-weight'  => '400',
                    'font-family' => 'Heebo',
					'text-align' => '',
                    'google'      => true,
                    'font-size'   => '10px',
                    'line-height' => '26px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'uppercase'
                ),
            ),
									array(
                'id'          => 'blockquote_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Blockquote font', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
                'output'      => array( 'blockquote, blockquote p, .excerpt blockquote p' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for blockquotes.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#424242',
					'font-weight'  => '400',
					'font-style'  => 'italic',
                    'font-family' => 'Playfair Display',
					'text-align' => 'center',
                    'google'      => true,
                    'font-size'   => '27px',
                    'line-height' => '30px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
						            array(
                'id'       => 'post_header_color',
                'type'     => 'link_color',
				'output'   => array( '.post-header h2 a' ),
				'active'  => false,
				'regular'  => false,
                'title'    => esc_html__( 'Post heading hover color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the posts heading hover color', 'buzzblogpro' ),
                'default'  => array(
                    'hover'   => '#bbbbbb'
                )
            ),
														            array(
                'id'       => 'meta_posts_alignment',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Meta posts alignment', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want meta posts to be aligned to the left?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
											            array(
                'id'       => 'post_author',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Author of the post', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display the author of the post?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
							  array(
                'id'       => 'post_author_box',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post author box', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Should the author box be displayed?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
						 array(
                'id'       => 'full_content',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable the full text content posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable the full text content posts.', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
			            array(
                'id'       => 'featured_images',
                'type'     => 'select',
                'title'    => esc_html__( 'Featured image', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable Featured images', 'buzzblogpro' ),
                'options'  => array(
                    'featured1' => 'Show Featured image on the main blog page and single blog page',
                    'featured2' => 'Show Featured image on the main blog page only',
                    'featured3' => 'Disable Featured images',
                ),
                'default'  => 'featured1'
            ),
								 array(
                'id'       => 'post_excerpt',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable excerpt for blog posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable excerpt for blog posts.', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
						            array(
                'id'            => 'blog_excerpt_count',
                'type'          => 'slider',
                'title'         => esc_html__( 'Excerpt words', 'buzzblogpro' ),
                'subtitle'      => esc_html__( 'Excerpt length (words).', 'buzzblogpro' ),
                'desc'          => esc_html__( 'Min: 0, max: 150, step: 1, default value: 16', 'buzzblogpro' ),
                'default'       => 16,
                'min'           => 0,
                'step'          => 1,
                'max'           => 150,
                'display_value' => 'text'
            ),
									            array(
                'id'       => 'blog_excerpt_allowed_tags',
                'type'     => 'text',
                'title'    => esc_html__( 'Excerpt allowed tags', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter allowed tags in posts excerpt separated by comma.', 'buzzblogpro' ),
                'default'  => ''
            ),

											 array(
                'id'       => 'post_date',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post publication date.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Should the post publication date be displayed?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
												            array(
                'id'             => 'standard_post_container_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'left' => true,
				'output'      => array( 'body:not(.single) .post__holder' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'Standard post container padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the standard post padding value.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '0px',
                    'padding-bottom' => '0px',
					'padding-left' => '0px',
					'padding-right' => '0px',
					'units'          => 'px', 
                )
            ),
															            array(
                'id'             => 'single_standard_post_container_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'left' => true,
				'output'      => array( '.single .isopad, .related-posts, .author .post-author-box' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'Single post container padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the single post padding value.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '0px',
                    'padding-bottom' => '0px',
					'padding-left' => '0px',
					'padding-right' => '0px',
					'units'          => 'px', 
                )
            ),
															            array(
                'id'             => 'post_header_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'top'            => true,
				'left'            => true,
				'bottom'            => true,
				'right'            => true,
				'output'      => array( '.post__holder .post-header' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'Post header margin', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the post header margin value.', 'buzzblogpro' ),
                'default'        => array(
				'margin-top' => '40px',
                'margin-bottom' => '40px',
				'margin-left' => '0px',
                'margin-right' => '0px',
					'units'          => 'px', 
                )
            ),
									array(
                'id'       => 'standard_post_container_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Standard post container background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the standard post container background.', 'buzzblogpro' ),
				'background-repeat' => false,
				'background-attachment' => false,
				'background-position' => false,
				'background-image' => false,
				'background-clip' => false,
				'background-origin' => false,
				'background-size' => false,
				'preview_media' => false,
				'preview' => false,
				'transparent' => true,
				'output'   => array( 'body:not(.single) .post__holder, .single .post__holder .isopad, .related-posts, .post-author .post-author-box' ),
                'default'  => array(
        'background-color' => '#ffffff',
    )
            ),
						            array(
                'id'       => 'date_format',
                'type'     => 'text',
                'title'    => esc_html__( 'Posts date format.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter posts date format. For more information go to http://codex.wordpress.org/Formatting_Date_and_Time - Formatting Date and Time website. For example, the format string: l, F j, Y creates a date that look like this: Friday, September 24, 2017', 'buzzblogpro' ),
                'default'  => 'F j, Y'
            ),
														 array(
                'id'       => 'pagination_type',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Page numbering', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose pagination type', 'buzzblogpro' ),
                'options'  => array(
                    'pagnum' => esc_html__( 'Links with page numbers', 'buzzblogpro' ),
                    'paglink' => esc_html__( 'Links only', 'buzzblogpro' ),
					'loadmore' => esc_html__( 'Load more button', 'buzzblogpro' ),
					'infinite' => esc_html__( 'Infinite scroll', 'buzzblogpro' ),
					'pagnone' => esc_html__( 'None', 'buzzblogpro' ),
                ),
                'default'  => 'pagnum'
            ),
			
			array(
                'id'       => 'pagnum_button_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Page numbers button color', 'buzzblogpro' ),
				'required' => array( 'pagination_type', '=', 'pagnum' ),
                'subtitle' => esc_html__( 'Change the Page numbers button color.', 'buzzblogpro' ),
				'output'   => array( '.page-numbers li a' ),
                'default'  => array(
                    'regular' => '#ffffff',
                    'hover'   => '#000000',
					'active'   => '#000000'
                )
            ),
			array(
                'id'       => 'pagnum_button_border_color',
                'type'     => 'link_color',
				'required' => array( 'pagination_type', '=', 'pagnum' ),
                'title'    => esc_html__( 'Page numbers button border color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the Page numbers button border color.', 'buzzblogpro' ),
                'default'  => array(
                    'regular' => '#ffffff',
                    'hover'   => '#000000',
					'active'   => '#000000'
                )
            ),
			array(
                'id'       => 'pagnum_button_background_color',
                'type'     => 'link_color',
				'required' => array( 'pagination_type', '=', 'pagnum' ),
                'title'    => esc_html__( 'Page numbers button background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the Page numbers button background color.', 'buzzblogpro' ),
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#ffffff',
					'active'   => '#ffffff'
                )
            ),
			
						array(
                'id'       => 'loadmore_offset',
                'type'     => 'text',
				'required' => array( 'pagination_type', '=', 'loadmore' ),
                'title'    => esc_html__( 'Offset', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'The number of pages which should load automatically. After that the trigger is shown for every subsequent page. For example: if you set the offset to 2, the pages 2 and 3 (page 1 is always shown) would load automatically and for every subsequent page the user has to press the trigger to load it.', 'buzzblogpro' ),
                'default'  => '0'
            ),
																	 array(
                'id'       => 'single_pagination_type',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Single post pagination', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose a single post pagination type', 'buzzblogpro' ),
                'options'  => array(
                    'paglinkimages' => esc_html__( 'Links with images', 'buzzblogpro' ),
					'fixednav' => esc_html__( 'Fixed navigation', 'buzzblogpro' ),
					'bothnav' => esc_html__( 'Both navigations - Links with images and Fixed navigation', 'buzzblogpro' ),
					'infinite' => esc_html__( 'Infinite scroll', 'buzzblogpro' ),
					'navnone' => esc_html__( 'None', 'buzzblogpro' ),
                ),
                'default'  => 'paglinkimages'
            ),
												            array(
                'id'       => 'pagination_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Page links color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the color of pagination links', 'buzzblogpro' ),
				'active'  => false,
				'output'      => array( '.paglink a, .paging a h5' ),
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#000000'
                )
            ),
														 array(
                'id'       => 'post_category',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post categories', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Should the post categories be displayed?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																	 array(
                'id'       => 'post_tag',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Tags', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Should the tags be displayed?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																				 array(
                'id'       => 'post_comment',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Number of comments', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Should the number of comments be displayed?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																							 array(
                'id'       => 'post_likes',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Likes', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want automatically add likes to your posts?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																										 array(
                'id'       => 'reading_time',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Reading time', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display reading time?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																													 array(
                'id'       => 'locations',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Location', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display location?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																													 array(
                'id'       => 'post_views',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post views', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display post views number?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																							 array(
                'id'       => 'related_post',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable related posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable related posts.', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
									            array(
                'id'            => 'numberof_related posts',
                'type'          => 'text',
                'title'         => esc_html__( 'The number of visible related posts on desktop.', 'buzzblogpro' ),
                'subtitle'      => esc_html__( 'How many posts will be visible on desktop in related posts carousel.', 'buzzblogpro' ),
                'default'       => '3',
            ),
																										 array(
                'id'       => 'related_post_single',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Related posts on single post page', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display related posts section, only on single post page?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
																										 array(
                'id'       => 'most-popular_post',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Most Popular posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable Most Popular posts.', 'buzzblogpro' ), 
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
																													 array(
                'id'       => 'enable_pinit_button',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Pinit button?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display Pinit button?', 'buzzblogpro' ), 
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
					array(
                'id'       => 'pinit_image',
                'type'     => 'media',
				'required' => array( 'enable_pinit_button', '=', 'yes' ),
                'url'      => true,
                'title'    => esc_html__( 'Pinit Image', 'buzzblogpro' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Click to upload your custom PinIt image', 'buzzblogpro' ),
                'default'  => array( 'url' => get_template_directory_uri() . '/images/pinit.png' ),
            ),
						array(
                'id'       => 'most_commented_image',
                'type'     => 'background',
                'title'    => esc_html__( 'Most popular image', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the most popular background image.', 'buzzblogpro' ),
				'output'   => array( '.most-commented' ),
                'default'  => array(
        'background-color' => '#ffffff',
    )
            ),
									            array(
                'id'       => 'related_post_header_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Related posts headings color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the color of related posts headings', 'buzzblogpro' ),
				'active'  => false,
				'output'      => array( '.related-posts h6 a' ),
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#999999'
                )
            ),
																										 array(
                'id'       => 'readmore_button',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable VIEW POST button?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable VIEW POST button', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
									array(
                'id'          => 'readmore_button_font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Readmore button font', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
				'color'       => false,
                'output'      => array( '.viewpost-button .button' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for the readmore button.', 'buzzblogpro' ),
                'default'     => array(
					'font-weight'  => '700',
                    'font-family' => 'Playfair Display',
					'text-align' => 'center',
                    'google'      => true,
                    'font-size'   => '10px',
                    'line-height' => '26px',
					'letter-spacing'=> '3px',
					'text-transform'=> 'none'
                ),
            ),
			array(
                'id'       => 'view_post_button_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'View post button color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the view post button color.', 'buzzblogpro' ),
				'output'   => array( '.viewpost-button a.button' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#ffffff',
                    'hover'   => '#000000',
                )
            ),
			array(
                'id'       => 'view_post_button_border_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'View post button border color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the view post button border color.', 'buzzblogpro' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#f9f9f9',
                )
            ),
			array(
                'id'       => 'view_post_button_background_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'View post button background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the view post button background color.', 'buzzblogpro' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#f9f9f9',
                )
            ),
			 array(
                'id'             => 'viewpost_button_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                //'all'            => true,
				'top'           => true,
                'right'         => true,    
                'bottom'        => true,    
				'left'        => true, 
				'output'      => array( '.viewpost-button a.button, .primary-menu li ul .buzzblogpro-widget-menu .viewpost-button a.button' ),
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'View post button padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the View post button padding value.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '6px',
                    'padding-right' => '16px',
					'padding-bottom' => '4px',
					'padding-left' => '16px',
                )
            ),
         array(
                'id'       => 'featured_badge_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'FEATURED BADGE text color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the FEATURED BADGE text color', 'buzzblogpro' ),
                'default'  => '#000000'
            ),
			         array(
                'id'       => 'featured_badge_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'FEATURED BADGE background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the FEATURED BADGE background color', 'buzzblogpro' ),
                'default'  => '#f9f9f9'
            ),
	array( 
    'id'       => 'featured_badge_border_colo',
    'type'     => 'border',
    'title'    => __('Featured badge border color', 'buzzblogpro'),
    'subtitle' => __('Change the Featured badge border color', 'buzzblogpro'),
    'output'   => array('.ribbon-featured'),
    'default'  => array(
        'border-color'  => '#f9f9f9', 
        'border-style'  => 'solid', 
        'border-top'    => '1px', 
        'border-right'  => '1px', 
        'border-bottom' => '1px', 
        'border-left'   => '1px'
    )
),
						            array(
                'id'       => 'post_overlay_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Modern Post Header overlay', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the modern post header overlay color.', 'buzzblogpro' ),
                'default'  => array(
                    'color' => '#000000',
                    'alpha' => '.22'
                ),
                'mode'     => 'background',
            ),
			         array(
                'id'       => 'modern_post_meta_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Modern post meta text color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the modern post meta text color', 'buzzblogpro' ),
                'default'  => '#ffffff'
            ),
			array(
                'id'       => 'modern_post_title_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Modern post title color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the modern post title color', 'buzzblogpro' ),
                'default'  => '#ffffff'
            ),
					array(
                'id'       => 'post_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Sidebar position', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select sidebar position', 'buzzblogpro' ),
                'options'  => array(
                    'left' => array( 'title' => 'left sidebar', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/post-side-left.png' ),
                    'right' => array( 'title' => 'right sidebar', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/post-side-right.png' ),
                    'none' => array( 'title' => 'no sidebar', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/post-side-none.png' )
                ),
                'default'  => 'right'
            ),
								array(
                'id'       => 'post_layout_options',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layout options', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select layout option', 'buzzblogpro' ),
                'options'  => array(
                    'layout1' => array( 'title' => 'layout1', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout1.png' ),
                    'layout2' => array( 'title' => 'layout2', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout2.png' ),
                    'layout3' => array( 'title' => 'layout3', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout3.png' ),
					'layout4' => array( 'title' => 'layout4', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout4.png' ),
					'layout5' => array( 'title' => 'layout5', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout5.png' ),
					'layout6' => array( 'title' => 'layout6', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout6.png' ),
					'layout7' => array( 'title' => 'layout7', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout7.png' ),
					'layout8' => array( 'title' => 'layout8', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout8.png' )
                ),
                'default'  => 'layout1'
            ),
        )
    ) );
	
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page options', 'buzzblogpro' ),
        'id'         => 'hs-page-options',
		'icon'   => 'el el-th-list',
        'fields'     => array(
					array(
                'id'          => 'h1_pagetitle',
                'type'        => 'typography',
                'title'       => esc_html__( 'Page title', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
                'output'      => array( '.title-section h1' ),
				'fonts' => $buzzblogpro_os_faces,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for page titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'center',
                    'google'      => true,
                    'font-size'   => '52px',
                    'line-height' => '52px',
					'letter-spacing'=> '-2px'
                ),
            ),
			array(
                'id'          => 'h2_pagetitle',
                'type'        => 'typography',
                'title'       => esc_html__( 'Page subtitle', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
                'output'      => array( '.title-section h2' ),
				'fonts' => $buzzblogpro_os_faces,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for page subtitle.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#999999',
					'font-weight'  => '400',
					'font-style'  => 'italic',
                    'font-family' => 'Playfair Display',
					'text-align' => 'center',
					'text-transform'=> 'inherit',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '26px',
					'letter-spacing'=> '2px'
                ),
            ),
							array(
                'id'       => 'page_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Sidebar position', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select sidebar position', 'buzzblogpro' ),
                'options'  => array(
                    'left' => array( 'title' => 'left sidebar', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/post-side-left.png' ),
                    'right' => array( 'title' => 'right sidebar', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/post-side-right.png' ),
                    'none' => array( 'title' => 'no sidebar', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/post-side-none.png' )
                ),
                'default'  => 'right'
            ),
								array(
                'id'       => 'page_layout_options',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layout options', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select layout option', 'buzzblogpro' ),
                'options'  => array(
                    'layout1' => array( 'title' => 'layout1', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout1.png' ),
                    'layout2' => array( 'title' => 'layout2', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout2.png' ),
                    'layout3' => array( 'title' => 'layout3', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout3.png' ),
					'layout4' => array( 'title' => 'layout4', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout4.png' ),
					'layout5' => array( 'title' => 'layout5', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout5.png' ),
					'layout6' => array( 'title' => 'layout6', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout6.png' ),
					'layout7' => array( 'title' => 'layout7', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout7.png' ),
					'layout8' => array( 'title' => 'layout8', 'img' => get_template_directory_uri() . '/includes/admin/posts-metabox-image/layout8.png' )
                ),
                'default'  => 'layout1'
            ),
			
			
																		            array(
                'id'             => 'page_container_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'left' => true,
				'output'      => array( '.page:not(.page-template-page-archives) .isopad' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'Page container padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the page padding value.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '0px',
                    'padding-bottom' => '0px',
					'padding-left' => '0px',
					'padding-right' => '0px',
					'units'          => 'px', 
                )
            ),
									array(
                'id'       => 'page_container_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Page container background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the page container background.', 'buzzblogpro' ),
				'background-repeat' => false,
				'background-attachment' => false,
				'background-position' => false,
				'background-image' => false,
				'background-clip' => false,
				'background-origin' => false,
				'background-size' => false,
				'preview_media' => false,
				'preview' => false,
				'transparent' => true,
				'output'   => array( '.page:not(.page-template-page-archives) .isopad' ),
                'default'  => array(
        'background-color' => '#ffffff',
    )
            ),
		
		        )
    ) );
			
			
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog categories', 'buzzblogpro' ),
        'id'         => 'hs-blog-categories',
		'icon'   => 'el el-th-list',
        'fields'     => array(
            		array(
                'id'       => 'blog_cat_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog categories layout', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose blog categories layout.', 'buzzblogpro' ),
                'options'  => array(
                    'left' => array( 'title' => 'left sidebar', 'img' => get_template_directory_uri() . '/includes/images/2cl.png' ),
                    'right' => array( 'title' => 'right sidebar', 'img' => get_template_directory_uri() . '/includes/images/2cr.png' ),
                    'full' => array( 'title' => 'no sidebar', 'img' => get_template_directory_uri() . '/includes/images/1col.png' ),
					'masonry2' => array( 'title' => 'masonry 2 columns', 'img' => get_template_directory_uri() . '/includes/images/masonry2.png' ),
                    'masonry3' => array( 'title' => 'masonry 3 columns', 'img' => get_template_directory_uri() . '/includes/images/masonry3.png' ),
                    'masonry4' => array( 'title' => 'masonry 4 columns', 'img' => get_template_directory_uri() . '/includes/images/masonry4.png' ),
					'masonry2sideleft' => array( 'title' => 'masonry 2 columns sidebar left', 'img' => get_template_directory_uri() . '/includes/images/masonry2-leftsidebar.png' ),
                    'masonry2sideright' => array( 'title' => 'masonry 2 columns sidebar right', 'img' => get_template_directory_uri() . '/includes/images/masonry2-rightsidebar.png' ),
                    'listpostsideright' => array( 'title' => 'list view sidebar right', 'img' => get_template_directory_uri() . '/includes/images/listpost-rightsidebar.png' ),
					'listpostsideleft' => array( 'title' => 'list view sidebar left', 'img' => get_template_directory_uri() . '/includes/images/listpost-leftsidebar.png' ),
                    'listpostfullwidth' => array( 'title' => 'list view no sidebar', 'img' => get_template_directory_uri() . '/includes/images/listpost-fullwidth.png' ),
					'zigzagfullwidth' => array( 'title' => 'zigzag view no sidebar', 'img' => get_template_directory_uri() . '/includes/images/zigzag-fullwidth.png' ),
					'zigzagsideright' => array( 'title' => 'zigzag view right sidebar', 'img' => get_template_directory_uri() . '/includes/images/zigzag-right-sidebar.png' ),
					'zigzagsideleft' => array( 'title' => 'zigzag view left sidebar', 'img' => get_template_directory_uri() . '/includes/images/zigzag-left-sidebar.png' ),
                ),
                'default'  => 'right'
            ),
							 array(
                'id'       => 'folio_filter',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Category menu', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Show additional category menu.', 'buzzblogpro' ),
                'options'  => array(
                    'cat' => 'Show',
                    'none' => 'Hide'
                ),
                'default'  => 'cat'
            ),
										 array(
                'id'       => 'category_name',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Category name', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display the name of the category?', 'buzzblogpro' ),
                'options'  => array(
              'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
													 array(
                'id'       => 'category_word',
                'type'     => 'button_set',
                'title'    => esc_html__( '"You are viewing" phrase', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to show "You are viewing" phrase?', 'buzzblogpro' ),
                'options'  => array(
              'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
									            array(
                'id'       => 'items_cat_count',
                'type'     => 'text',
                'title'    => esc_html__( 'Posts per archive page', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Number of posts per page in the category.', 'buzzblogpro' ),
                'default'  => '6'
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom signature', 'buzzblogpro' ),
        'id'         => 'hs-custom-signature',
		'icon'   => 'el el-user',
        'fields'     => array(
				array(
                'id'       => 'custom-signature-display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Custom signature', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display custom signature right under every post content?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
			array(
                'id'       => 'custom-signature-image',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Custom signature image', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Upload the custom signature image', 'buzzblogpro' ),
                'default'  => array( 'url' => '' ),
            ),
            array(
                'id'       => 'signature_text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Message', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter the custom signature message.', 'buzzblogpro' ),
                'default'  => 'XOXO',
            ),

        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Slideshow', 'buzzblogpro' ),
        'id'         => 'hs-slideshow',
		'icon'   => 'el el-play',
        'fields'     => array(
							 array(
                'id'       => 'slideshow_enable',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable slideshow', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or disable slideshow on main blog page.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
										 array(
                'id'       => 'woocommerce_slideshow_enable',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable woocommerce slideshow', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or disable woocommerce slideshow. Shop products will be displayed instead of the blog posts.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),

										 array(
                'id'       => 'blog_slideshow',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Slideshow type', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select the type of slideshow', 'buzzblogpro' ),
                'options'  => array(
              'fullwidth' => esc_html__( 'Full width slideshow', 'buzzblogpro' ),
              'boxed' => esc_html__( 'Boxed slideshow', 'buzzblogpro' ),
			  'inside' => esc_html__( 'Inside the blog content slideshow', 'buzzblogpro' )
                ),
                'default'  => 'fullwidth'
            ),
									array(
                'id'       => 'slideshow_container_width',
                'type'     => 'text',
				'required' => array( 'blog_slideshow', '=', 'boxed' ),
                'title'    => esc_html__( 'Slideshow container width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter the slideshow container width. Default is 1170. Enter a grater value, in order to have slideshow wider than the main container', 'buzzblogpro' ),
                'default'  => '1400'
            ),
			
									array(
                'id'       => 'slideshow_bg_color',
                'type'     => 'background',
                'title'    => esc_html__( 'Slideshow background', 'buzzblogpro' ),
				'required' => array( 'blog_slideshow', '=', 'boxed' ),
                'subtitle' => esc_html__( 'Change the background of the slideshow.', 'buzzblogpro' ),
				'output'   => array( '.slideshow-bg' ),
                'default'  => array(
        'background-color' => '#ffffff',
    )
            ),
			 
													 array(
                'id'       => 'slideshow_layout',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Slideshow layout', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select the slideshow layout', 'buzzblogpro' ),
                'options'  => array(
              'normal' => esc_html__( 'Normal', 'buzzblogpro' ),
              'grid' => esc_html__( 'Grid', 'buzzblogpro' )
                ),
                'default'  => 'normal'
            ),
																 array(
                'id'       => 'slideshow_caption_type',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Slideshow captions type', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select the type of captions', 'buzzblogpro' ),
                'options'  => array(
              'middle' => esc_html__( 'In the middle', 'buzzblogpro' ),
              'bottom' => esc_html__( 'Bottom left', 'buzzblogpro' ),
			  'middle-boxed' => esc_html__( 'Middle boxed', 'buzzblogpro' ),
			  'bottom-centered' => esc_html__( 'Bottom centered', 'buzzblogpro' ),
			  'underneath' => esc_html__( 'Underneath', 'buzzblogpro' ),
			  'middle-square' => esc_html__( 'Middle square', 'buzzblogpro' )
                ),
                'default'  => 'underneath'
            ),
										 array(
                'id'       => 'enable_parallax',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable parallax', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or disable parallax effect.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
													 array(
                'id'       => 'enable_video',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable video', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or disable automatic video playback.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																			  array(
                'id'       => 'slide_video_start',
                'type'     => 'text',
				'required' => array( 'enable_video', '=', 'yes' ),
                'title'    => esc_html__( 'Slide video start time', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter from which second the video should start.', 'buzzblogpro' ),
                'default'  => '0',
            ),
																			  array(
                'id'       => 'slide_video_end',
                'type'     => 'text',
				'required' => array( 'enable_video', '=', 'yes' ),
                'title'    => esc_html__( 'Slide video end time', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter in which second the video should end.', 'buzzblogpro' ),
                'default'  => '12',
            ),
																 array(
                'id'       => 'enable_center_mode',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable center mode', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or disable center mode.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
			            array(
                'id'             => 'top_slideshow_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'output'      => array( '.slideshow-inside .top-slideshow, .slideshow-bg' ),
                'top'           => true,
                'right'         => false,
                'bottom'        => true,
                'left'          => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Slideshow margin', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the top and bottom margin value.', 'buzzblogpro' ),
                'default'        => array(
                    'margin-top'    => '30px',
                    'margin-bottom' => '0px',
                )
            ),
						            array(
                'id'             => 'top_slideshow_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'output'      => array( '.slideshow-inside .top-slideshow, .slideshow-bg' ),
                'top'           => true,
                'right'         => false,
                'bottom'        => true,
                'left'          => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Slideshow padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the top and bottom padding value.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '0px',
                    'padding-bottom' => '0px',
                )
            ),
			            array(
                'id'       => 'posts_by_id',
                'type'     => 'select',
                'data'     => 'posts',
				'required' => array( 'woocommerce_slideshow_enable', '=', 'no' ),
                'args' => array('post_type'=>'post', 'posts_per_page' => 70),
                'multi'    => true,
				'sortable'  => true,
                'title'    => esc_html__( 'Show Posts by ID', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose posts you want to appear on slideshow. Leave it blank if you would like to pull all posts', 'buzzblogpro' ),
            ),
			
						            array(
                'id'       => 'products_by_id',
                'type'     => 'select',
                'data'     => 'posts',
				'required' => array( 'woocommerce_slideshow_enable', '=', 'yes' ),
                'args' => array('post_type'=>'product', 'posts_per_page' => 30, 'orderby' => 'menu_order'),
                'multi'    => true,
				'sortable'  => true,
                'title'    => esc_html__( 'Show Products by ID', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose products you want to appear on slideshow. Leave it blank if you would like to pull all products', 'buzzblogpro' ),
            ),
			
            array(
                'id'       => 'posts_by_cat',
                'type'     => 'select',
                'data'     => 'categories',
                'multi'    => true,
				'sortable'  => true,
                'title'    => esc_html__( 'Which category to pull from?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select a categories you would like to pull slides from. Leave it blank if you would like to pull from all categories', 'buzzblogpro' ),
            ),
												            array(
                'id'       => 'howmany_slides',
                'type'     => 'text',
                'title'    => esc_html__( 'How many posts to show?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'This is how many recent posts will be displayed.', 'buzzblogpro' ),
                'default'  => '6',
            ),
				 array(
                'id'       => 'howmany_desktop',
                'type'     => 'text',
                'title'    => esc_html__( 'The number of visible posts on desktop.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'How many posts will be visible on desktop in carousel.', 'buzzblogpro' ),
                'default'  => '3',
            ),
				array(
                'id'       => 'howmany_tablet',
                'type'     => 'text',
                'title'    => esc_html__( 'The number of visible posts on tablet device.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'How many posts will be visible on tablet device in carousel.', 'buzzblogpro' ),
                'default'  => '2',
            ),
				array(
                'id'       => 'howmany_mobile',
                'type'     => 'text',
                'title'    => esc_html__( 'The number of visible posts on phone.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'How many posts will be visible on phone in carousel.', 'buzzblogpro' ),
                'default'  => '1',
            ),
										  array(
                'id'       => 'slideshow_thumbwidth',
                'type'     => 'text',
                'title'    => esc_html__( 'Slideshow image width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the width of the slideshow image.', 'buzzblogpro' ),
                'default'  => '827',
            ),
							  array(
                'id'       => 'slideshow_thumbheight',
                'type'     => 'text',
                'title'    => esc_html__( 'Slideshow image height', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the height of the slideshow image.', 'buzzblogpro' ),
                'default'  => '600',
            ),
										  array(
                'id'       => 'slideshow_margin',
                'type'     => 'text',
                'title'    => esc_html__( 'Item margin(px)', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the margin value of the featured image.', 'buzzblogpro' ),
                'default'  => '32',
            ),
										 array(
                'id'       => 'slideshow_date',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable or disable post date.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display post date?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),

																 array(
                'id'       => 'slideshow_cat_name',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display the category name.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display the category name?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																			 array(
                'id'       => 'slideshow_viewpost',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display the VIEW POST button.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display the VIEW POST button ?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
						array(
                'id'       => 'view_post_slideshow_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'View post button color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the view post button color.', 'buzzblogpro' ),
				'output'   => array( 'a.slideshow-btn' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#ffffff',
                    'hover'   => '#000000',
                )
            ),
			array(
                'id'       => 'view_post_slideshow_border_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'View post button border color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the view post button border color.', 'buzzblogpro' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#ffffff',
                )
            ),
			array(
                'id'       => 'view_post_slideshow_background_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'View post button background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the view post button background color.', 'buzzblogpro' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#ffffff',
                )
            ),
			 array(
                'id'             => 'view_post_slideshow_button_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                //'all'            => true,
				'top'           => true,
                'right'         => true,    
                'bottom'        => true,    
				'left'        => true, 
				'output'      => array( 'a.slideshow-btn' ),
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'View post button padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the View post button padding value.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '8px',
                    'padding-right' => '20px',
					'padding-bottom' => '8px',
					'padding-left' => '20px',
                )
            ),
									            array(
                'id'            => 'slideshow_excerpt_words',
                'type'          => 'slider',
                'title'         => esc_html__( 'The number of words in the excerpt', 'buzzblogpro' ),
                'subtitle'      => esc_html__( 'How many words will be disapled in the post excerpt', 'buzzblogpro' ),
                'desc'          => esc_html__( 'Min: 0, max: 150, step: 1, default value: 0', 'buzzblogpro' ),
                'default'       => 0,
                'min'           => 0,
                'step'          => 1,
                'max'           => 150,
                'display_value' => 'text'
            ),
																			 array(
                'id'       => 'slideshow_autoplay',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable autoplay funtion', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'If you want to disable autoplay function choose No', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
													  array(
                'id'       => 'slideshow_pause',
                'type'     => 'text',
                'title'    => esc_html__( 'Pause between slides', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Pause between slides in milliseconds. Example: 5000 is a 5 seconds.', 'buzzblogpro' ),
                'default'  => '7000',
            ),
				array(
                'id'       => 'slideshow_displaynavs',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Next and prev navigation', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display next and prev navigation.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
							array(
                'id'       => 'slideshow_displaypagination',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Pagination', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display pagination buttons.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
										array(
                'id'       => 'slideshow_overlay_link',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Slideshow overlay link', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to enable slideshow overlay link?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
						            array(
                'id'       => 'slideshow_overlay_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Slideshow overlay', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the slideshow overlay color.', 'buzzblogpro' ),
                'default'  => array(
                    'color' => '',
                    'alpha' => '.01'
                ),
                'mode'     => 'background',
            ),
													array(
                'id'       => 'slideshow_overlay_gradient',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Slideshow overlay gradient', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to enable slideshow overlay gradient type?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
									            array(
                'id'       => 'slideshow_caption_bg_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Caption bg color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the caption bg color.', 'buzzblogpro' ),
				'output'      => array( '.top-slideshow .cover-content' ),
                'default'  => array(
                    'color' => '',
                    'alpha' => '.01'
                ),
                'mode'     => 'background',
            ),
									array(
                'id'          => 'slideshow_heading_text_color',
                'type'        => 'typography',
                'title'       => esc_html__( 'Slideshow heading text', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
                'output'      => array( '.carousel-wrap h2' ),
				'fonts' => $buzzblogpro_os_faces,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Change the slideshow heading color and font.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'center',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '22px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
			array(
                'id'       => 'slideshow_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Slideshow texts color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the slideshow texts color', 'buzzblogpro' ),
				'output'      => array( '.slideshow .meta-space-top, .slideshow .meta-space-top a, .slideshow .excerpt p' ),
                'default'  => '#8c8c8c'
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Trending slideshow', 'buzzblogpro' ),
        'id'         => 'hs-trending-slideshow',
		'icon'   => 'el el-adjust-alt',
        'fields'     => array(
														            array(
                'id'       => 'trending_slideshow',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Trending posts', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display trending posts slideshow?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
										 array(
                'id'       => 'trending_slideshow_type',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Trending Slideshow Type', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select a slideshow type', 'buzzblogpro' ),
                'options'  => array(
              'alltime' => esc_html__( 'All Time', 'buzzblogpro' ),
              'onceweekly' => esc_html__( 'Once Weekly', 'buzzblogpro' ),
			  'oncemonth' => esc_html__( 'Once a Month', 'buzzblogpro' )
                ),
                'default'  => 'alltime'
            ),
						array(
                'id'          => 'trending_slideshow_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'Trending Slideshow Heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
                'output'      => array( '.trending-posts h6.trending-title' ),
				'fonts' => $buzzblogpro_os_faces,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for trending slideshow heading.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'center',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '22px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
							 array(
                'id'       => 'trending_slideshow_image_width',
                'type'     => 'text',
                'title'    => esc_html__( 'Image width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image width value.', 'buzzblogpro' ),
                'default'  => '336', 
            ),
						 array(
                'id'       => 'trending_slideshow_image_height',
                'type'     => 'text',
                'title'    => esc_html__( 'Image height', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image height value.', 'buzzblogpro' ),
                'default'  => '420',
            ),
												array( 
    'id'       => 'trending_slideshow_border_color',
    'type'     => 'border',
    'title'    => esc_html__( 'Trending slideshow border color and width', 'buzzblogpro' ),
    'subtitle' => esc_html__( 'Change the trending slideshow border color and width.', 'buzzblogpro' ),
		'all' => false,
		'right'  => false, 
		'left'   => false,
    'output'   => array('.trending-posts'),
    'default'  => array(
        'border-color'  => '#eeeeee', 
        'border-style'  => 'solid', 
        'border-top'    => '0px',  
        'border-bottom' => '1px'
    )
	),
				array(
                'id'       => 'trending_bg_color',
                'type'     => 'background',
                'title'    => esc_html__( 'Trending slideshow background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the tTrending slideshow background.', 'buzzblogpro' ),
				'output'   => array( '.trending-posts' ),
                'default'  => array(
        'background-color' => '#ffffff',
    )
            ),
			array(
                'id'             => 'trending_slideshow_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'output'      => array( '.trending-posts' ),
                'top'           => true,
                'right'         => false,
                'bottom'        => true,
                'left'          => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Trending slideshow margin', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the top and bottom margin value.', 'buzzblogpro' ),
                'default'        => array(
                    'margin-top'    => '0px',
                    'margin-bottom' => '64px',
                )
            ),
						            array(
                'id'             => 'trending_slideshow_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'output'      => array( '.trending-posts' ),
                'top'           => true,
                'right'         => true,
                'bottom'        => true,
                'left'          => true,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Trending slideshow padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the top and bottom padding value.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '0px',
                    'padding-bottom' => '20px',
					'padding-left' => '0px',
					'padding-right' => '0px',
                )
            ),
											            array(
                'id'       => 'trending_howmany_slides',
                'type'     => 'text',
                'title'    => esc_html__( 'How many posts to show?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'This is how many posts will be displayed.', 'buzzblogpro' ),
                'default'  => '3',
            ),
				 array(
                'id'       => 'trending_howmany_desktop',
                'type'     => 'text',
                'title'    => esc_html__( 'The number of visible posts on desktop.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'How many posts will be visible on desktop in carousel.', 'buzzblogpro' ),
                'default'  => '3',
            ),
				array(
                'id'       => 'trending_howmany_tablet',
                'type'     => 'text',
                'title'    => esc_html__( 'The number of visible posts on tablet device.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'How many posts will be visible on tablet device in carousel.', 'buzzblogpro' ),
                'default'  => '2',
            ),
				array(
                'id'       => 'trending_howmany_mobile',
                'type'     => 'text',
                'title'    => esc_html__( 'The number of visible posts on phone.', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'How many posts will be visible on phone in carousel.', 'buzzblogpro' ),
                'default'  => '1',
            ),
			array(
                'id'       => 'trending_slideshow_margin_items',
                'type'     => 'text',
                'title'    => esc_html__( 'Item margin(px)', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the margin value of the featured image.', 'buzzblogpro' ),
                'default'  => '64',
            ),
				array(
                'id'       => 'trending_slideshow_autoplay',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable autoplay funtion', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'If you want to disable autoplay function choose No', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
        )
    ) );
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Promo area', 'buzzblogpro' ),
        'id'         => 'promo-slides',
        'icon'   => 'el el-share',
        'fields'     => array(
									 array(
                'id'       => 'promotion_enable',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable promotion area', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or disable promotion area on main blog page.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
						array( 
    'id'       => 'promotion_border_color',
    'type'     => 'border',
    'title'    => esc_html__( 'Promo inner border color and width', 'buzzblogpro' ),
    'subtitle' => esc_html__( 'Change the inner border color and width.', 'buzzblogpro' ),
		'all' => false,
    'output'   => array('.slideshow.promo .cover-wrapper::before'),
    'default'  => array(
        'border-color'  => '#ffffff', 
        'border-style'  => 'solid', 
        'border-top'    => '0px', 
        'border-right'  => '0px', 
        'border-bottom' => '0px', 
        'border-left'   => '0px'
    )
	),
							            array(
                'id'       => 'promotion_overlay_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Promo items overlay', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the promo items overlay color.', 'buzzblogpro' ),
				'output'      => array( '.promo .cover:before' ),
                'default'  => array(
                    'color' => '#000000',
                    'alpha' => '.02'
                ),
                'mode'     => 'background', 
            ),
				array(
                'id'             => 'promotion_slideshow_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'output'      => array( '.slideshow.promo' ),
                'top'           => true,
                'right'         => false,
                'bottom'        => true,
                'left'          => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Promotion slideshow margin', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the top and bottom margin value.', 'buzzblogpro' ),
                'default'        => array(
                    'margin-top'    => '0px',
                    'margin-bottom' => '0px',
                )
            ),
				array(
                'id'       => 'promotion_slideshow_margin_items',
                'type'     => 'text',
                'title'    => esc_html__( 'Item margin(px)', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the margin value of the promo items.', 'buzzblogpro' ),
                'default'  => '64',
            ),
							 array(
                'id'       => 'promo_image_width',
                'type'     => 'text',
                'title'    => esc_html__( 'Image width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image width value.', 'buzzblogpro' ),
                'default'  => '360', 
            ),
						 array(
                'id'       => 'promo_image_height',
                'type'     => 'text',
                'title'    => esc_html__( 'Image height', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image height value.', 'buzzblogpro' ),
                'default'  => '230',
            ),
            array(
                'id'          => 'promo-areaslides',
                'type'        => 'slides',
                'title'       => esc_html__( 'Promo items', 'buzzblogpro' ),
                'subtitle'    => esc_html__( 'Add promo items.', 'buzzblogpro' ),
			       'show' => array(
                    'title' => true,
                    'description' => false,
                    'url' => true,
                ),
				'content_title' => esc_html__( 'Promo Item', 'buzzblogpro' ),
                'placeholder' => array(
                    'title'       => esc_html__( 'Title', 'buzzblogpro' ),
                    'url'         => esc_html__( 'Link', 'buzzblogpro' ),
                ),
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Posts Social Networks', 'buzzblogpro' ),
        'id'         => 'hs-social',
		'icon'   => 'el el-share',
        'fields'     => array(
							 array(
                'id'       => 'social_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Social sharing for blog posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable Social sharing for blog posts.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
								 array(
                'id'       => 'shareon',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display Share on text', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Should Share on text be displayed?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' ) 
                ),
                'default'  => 'yes'
            ),
											 array(
                'id'       => 'facebook_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Facebook sharing for blog posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable Facebook sharing for blog posts.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
														 array(
                'id'       => 'twitter_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Twitter sharing for blog posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable Twitter sharing for blog posts.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
					 array(
                'id'       => 'hs_twitter_username',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter username', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter your Twitter username.', 'buzzblogpro' ),
                'default'  => 'envato',
            ),
																	 array(
                'id'       => 'gplus_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Google Plus sharing for blog posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable Google Plus sharing for blog posts.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																				 array(
                'id'       => 'linkedin_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable LinkedIn sharing for blog posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable LinkedIn sharing for blog posts.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
																				 array(
                'id'       => 'pinterest_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Pinterest sharing for blog posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable Pinterest sharing for blog posts.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																							 array(
                'id'       => 'tumblr_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Tumblr sharing for blog posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable Tumblr sharing for blog posts.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
																										 array(
                'id'       => 'vkontakte_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable vkontakte sharing for blog posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable vkontakte sharing for blog posts.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
																																		 array(
                'id'       => 'whatsapp_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable whatsapp sharing for blog posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable whatsapp sharing for blog posts.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																													 array(
                'id'       => 'email_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Email sharing for blog posts?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable Email sharing for blog posts.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
														            array(
                'id'       => 'post_author_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Author of the post', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display the author of the post in the share section?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																	            array(
                'id'       => 'post_comments_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Number of comments', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display the number of comments in the share section?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
						            array(
                'id'       => 'share_links_color',
                'type'     => 'link_color',
				'output'   => array( 'article .hs-icon, .author-social .hs-icon, .list_post_content .hs-icon' ),
                'title'    => esc_html__( 'Share Links Color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the share links color.', 'buzzblogpro' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#bbbbbb',
                )
            ),
				array( 
    'id'       => 'share_links_border_color',
    'type'     => 'border',
    'title'    => esc_html__('Share links border color', 'buzzblogpro'),
    'subtitle' => esc_html__('Change the share links border color', 'buzzblogpro'),
    'output'   => array('.bottom-meta'),
	'all' => false,
    'default'  => array(
        'border-color'  => '#eeeeee', 
        'border-style'  => 'solid', 
        'border-top'    => '0px', 
        'border-right'  => '0px', 
        'border-bottom' => '1px', 
        'border-left'   => '0px'
    )
),
			array(
                'id'             => 'share_links_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'output'      => array( '.bottom-meta' ),
                'top'           => true,
                'right'         => false,
                'bottom'        => true,
                'left'          => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Share links margin', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the top and bottom margin value.', 'buzzblogpro' ),
                'default'        => array(
                    'margin-top'    => '20px',
                    'margin-bottom' => '20px',
                )
            ),
						            array(
                'id'             => 'share_links_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'output'      => array( '.bottom-meta' ),
                'top'           => true,
                'right'         => false,
                'bottom'        => true,
                'left'          => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Share links padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the top and bottom padding value.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '20px',
                    'padding-bottom' => '25px',
                )
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Fixed Social Networks Bar', 'buzzblogpro' ),
        'id'         => 'hs-fixed-social',
		'icon'   => 'el el-share',
        'fields'     => array(
														 array(
                'id'       => 'fixed_social_share',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable Fixed Social Networks', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or Disable Fixed Social Networks', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
								 array(
                'id'       => 'fixed_facebook_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook URL', 'buzzblogpro' ),
                'default'  => '',
            ),
					 array(
                'id'       => 'fixed_twitter_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter URL', 'buzzblogpro' ),
                'default'  => '',
            ),
			array(
                'id'       => 'fixed_pinterest_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest URL', 'buzzblogpro' ),
                'default'  => '',
            ),
			array(
                'id'       => 'fixed_instagram_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram URL', 'buzzblogpro' ),
                'default'  => '',
            ),
			array(
                'id'       => 'fixed_bloglovin_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Bloglovin URL', 'buzzblogpro' ),
                'default'  => '',
            ),
			array(
                'id'       => 'fixed_youtube_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Youtube URL', 'buzzblogpro' ),
                'default'  => '',
            ),
						array(
                'id'       => 'fixed_liketoknow_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Liketoknow URL', 'buzzblogpro' ),
                'default'  => '',
            ),
			
						array(
                'id'       => 'fixed_rss_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Rss Feed URL', 'buzzblogpro' ),
                'default'  => '',
            ),	
						            array(
                'id'       => 'fixed_links_color',
                'type'     => 'link_color',
				'output'   => array( '.social-side-fixed a' ),
                'title'    => esc_html__( 'Fixed Share Links Color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the share links color.', 'buzzblogpro' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#ffffff',
                )
            ),
															            array(
                'id'       => 'fixed_links_bg_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Fixed Share Links background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the background color of the Fixed Share Links.', 'buzzblogpro' ),
				'output'   => array( '.social-side-fixed a' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),	
															            array(
                'id'       => 'fixed_links_hover_bg_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Fixed Share Links hover background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the hover background color of the Fixed Share Links.', 'buzzblogpro' ),
				'output'   => array( '.social-side-fixed a:hover' ),
                'default'  => array(
                    'color' => '#000000',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),			
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog grid', 'buzzblogpro' ),
        'id'         => 'hs-bloggrid',
		'icon'   => 'el el-th',
        'fields'     => array(
									array(
                'id'          => 'grid_post_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'H2 Grid Post heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
                'output'      => array( '.grid .grid-item .post-header h2 a, .grid .grid-item  h2.post-title, .post-grid-block h2.grid-post-title a, .post-grid-block h2.grid-post-title' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for H2 grid post titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'center',
                    'google'      => true,
                    'font-size'   => '22px',
                    'line-height' => '24px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
						            array(
                'id'       => 'grid_post_header_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Grid posts heading hover color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the hover color of the the grid posts heading', 'buzzblogpro' ),
				'output'      => array( '.grid .post-header h2 a' ),
				'active' => false,
				'regular' => false,
                'default'  => array(
                    'hover'   => '#444444',
                )
            ),
																	            array(
                'id'       => 'blog_grid_special_post',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Special post full width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to have every third, fourth or fifth post full width depending on the selected grid blog layout ?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
																				            array(
                'id'       => 'shop_the_post',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Shop the post', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display Shop the post section ?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
						 array(
                'id'       => 'blog_grid_image_width',
                'type'     => 'text',
                'title'    => esc_html__( 'Image width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image width value.', 'buzzblogpro' ),
                'default'  => '600', 
            ),
						 array(
                'id'       => 'blog_grid_image_height',
                'type'     => 'text',
                'title'    => esc_html__( 'Image height', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image height value.', 'buzzblogpro' ),
                'default'  => '800',
            ),
																				            array(
                'id'       => 'blog_grid_crop_images',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Crop images', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to crop images ?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																							            array(
                'id'       => 'blog_grid_gif_images',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Gif images', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to enable animated gif images ?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
																										            array(
                'id'       => 'blog_grid_skip_excerpt',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Skip excerpt field', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to skip the text from the excerpt field?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
									            array(
                'id'             => 'grid_container_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'left' => true,
				'output'      => array( '.grid .grid-block article, .zoom-gallery .post-header' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'Grid post container padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the padding of the grid post container.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '30px',
                    'padding-bottom' => '0px',
					'padding-left' => '0px',
					'padding-right' => '0px',
					'units'          => 'px', 
                )
            ),
												            array(
                'id'             => 'grid_container_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'top'            => false,
				'left'            => false,
				'bottom'            => true,
				'right'            => false,
				'output'      => array( '.grid .grid-item, .zoom-gallery .grid-block' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'Grid post container bottom margin', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the grid post container bottom margin value.', 'buzzblogpro' ),
                'default'        => array(
                    'margin-bottom' => '64px',
					'units'          => 'px', 
                )
            ),
									array(
                'id'       => 'grid_post_container_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Grid post container background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the grid post container background.', 'buzzblogpro' ),
				'background-repeat' => false,
				'background-attachment' => false,
				'background-position' => false,
				'background-image' => false,
				'background-clip' => false,
				'background-origin' => false,
				'background-size' => false,
				'preview_media' => false,
				'preview' => false,
				'transparent' => true,
				'output'   => array( '.grid .grid-block' ),
                'default'  => array(
        'background-color' => '#ffffff',
    )
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'List Blog', 'buzzblogpro' ),
        'id'         => 'hs-bloglist',
		'icon'   => 'el el-th-list',
        'fields'     => array(
									array(
                'id'          => 'list_post_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'H2 List Post heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
                'output'      => array( '.list-post h2.list-post-title a, .list-post h2.list-post-title' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for H2 list post titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'left',
                    'google'      => true,
                    'font-size'   => '34px',
                    'line-height' => '37px',
					'letter-spacing'=> '-1px',
					'text-transform'=> 'none'
                ),
            ),
						            array(
                'id'       => 'list_post_header_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'List posts heading hover color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the hover color of the the list posts heading', 'buzzblogpro' ),
				'output'      => array( '.list-post h2.list-post-title a' ),
				'active' => false,
				'regular' => false,
                'default'  => array(
                    'hover'   => '#444444',
                )
            ),
			
																				            array(
                'id'       => 'blog_list_special_post',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Special post full width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to have every third post full width ?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
									 array(
                'id'       => 'blog_list_image_width',
                'type'     => 'text',
                'title'    => esc_html__( 'Image width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image width value.', 'buzzblogpro' ),
                'default'  => '361', 
            ),
						 array(
                'id'       => 'blog_list_image_height',
                'type'     => 'text',
                'title'    => esc_html__( 'Image height', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image height value.', 'buzzblogpro' ),
                'default'  => '462',
            ),
																							            array(
                'id'       => 'blog_list_image_left',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Image side', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Would you like to have a photo on the left hand side?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																										            array(
                'id'       => 'blog_list_gif_images',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Gif images', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to enable animated gif images ?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
																													            array(
                'id'       => 'blog_list_skip_excerpt',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Skip excerpt field', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to skip the text from the excerpt field?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
						            array(
                'id'             => 'list_container_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'left' => true,
				'output'      => array( '.list-post .block .post_content' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'List post container padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the padding of the post container.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '0px',
                    'padding-bottom' => '34px',
					'padding-left' => '0px',
					'padding-right' => '0px',
					'units'          => 'px', 
                )
            ),
																		            array(
                'id'             => 'list_container_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'top'            => false,
				'left'            => false,
				'bottom'            => true,
				'right'            => false,
				'output'      => array( '.list-post .block' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'List post post container bottom margin', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the List post post container bottom margin value.', 'buzzblogpro' ),
                'default'        => array(
                    'margin-bottom' => '32px',
					'units'          => 'px', 
                )
            ),
												array(
                'id'       => 'list_post_container_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'List post container background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the list post container background.', 'buzzblogpro' ),
				'background-repeat' => false,
				'background-attachment' => false,
				'background-position' => false,
				'background-image' => false,
				'background-clip' => false,
				'background-origin' => false,
				'background-size' => false,
				'preview_media' => false,
				'preview' => false,
				'transparent' => true,
				'output'   => array( '.list-post .list-post-container .post_content' ),
                'default'  => array(
        'background-color' => '#ffffff',
    )
            ),
																																            array(
                'id'       => 'blog_list_proportions',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post layout ratio', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select post layout ratio', 'buzzblogpro' ),
                'options'  => array(
                    '70' => esc_html__( '30/70%', 'buzzblogpro' ),
					'50' => esc_html__( '50/50%', 'buzzblogpro' ),
                ),
                'default'  => '70'
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'ZigZag Blog', 'buzzblogpro' ),
        'id'         => 'hs-blogzigzag',
		'icon'   => 'el el-tasks',
        'fields'     => array(
									array(
                'id'          => 'zigzag_post_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'H2 Zigzag Post heading', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
                'output'      => array( '.zigazg h2.list-post-title a, .zigazg h2.list-post-title' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for H2 list post titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'center',
                    'google'      => true,
                    'font-size'   => '30px',
                    'line-height' => '36px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'none'
                ),
            ),
						            array(
                'id'       => 'zigzag_post_header_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Zigzag posts heading hover color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the hover color of the the list posts heading', 'buzzblogpro' ),
				'output'      => array( '.zigazg h2.list-post-title a' ),
				'active' => false,
				'regular' => false,
                'default'  => array(
                    'hover'   => '#444444',
                )
            ),
			
									 array(
                'id'       => 'blog_zigzag_image_width',
                'type'     => 'text',
                'title'    => esc_html__( 'Image width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image width value.', 'buzzblogpro' ),
                'default'  => '436', 
            ),
						 array(
                'id'       => 'blog_zigzag_image_height',
                'type'     => 'text',
                'title'    => esc_html__( 'Image height', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image height value.', 'buzzblogpro' ),
                'default'  => '470',
            ),
									            array(
                'id'             => 'zigzag_container_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'top' => true,
				'left' => true,
				'bottom' => true,
				'right' => true,
				'output'      => array( '.list-post .block .list_post_content.zigazg' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'Zigzag post container padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the padding of the post container.', 'buzzblogpro' ),
                'default'        => array(
					'padding-left' => '0px',
					'padding-right' => '0px',
					'padding-top' => '0px',
					'padding-bottom' => '0px',
					'units'          => 'px', 
                )
            ),
															            array(
                'id'             => 'zigzag_container_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'top'            => false,
				'left'            => false,
				'bottom'            => true,
				'right'            => false,
				'output'      => array( '.zigzag.list-post .block' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'Zigzag post container bottom margin', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the zigzag post container bottom margin value.', 'buzzblogpro' ),
                'default'        => array(
                    'margin-bottom' => '64px',
					'units'          => 'px', 
                )
            ),
																													            array(
                'id'       => 'blog_zigzag_proportions',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post layout ratio', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Select post layout ratio', 'buzzblogpro' ),
                'options'  => array(
                    '70' => esc_html__( '30/70%', 'buzzblogpro' ),
					'50' => esc_html__( '50/50%', 'buzzblogpro' ),
                ),
                'default'  => '70'
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Gallery', 'buzzblogpro' ),
        'id'         => 'hs-gallery',
		'icon'   => 'el el-picture',
        'fields'     => array(
								            array(
                'id'       => 'gallery_layout',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Gallery Layout', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the gallery layout', 'buzzblogpro' ),
                'options'  => array(
                    'wide' => esc_html__( 'Wide', 'buzzblogpro' ), 
                    'boxed' => esc_html__( 'Boxed', 'buzzblogpro' ) 
                ),
                'default'  => 'boxed'
            ),
    array(
                'id'       => 'gallery_columns',
                'type'     => 'select',
                'title'    => esc_html__( 'Number of columns', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose the number of columns (2, 3, or 4)', 'buzzblogpro' ),
                'options'  => array(
                    '2' => '2 columns',
                    '3' => '3 columns',
                    '4' => '4 columns',
                ),
                'default'  => '3'
            ),
 array(
                'id'       => 'images_per_page',
                'type'     => 'text',
                'title'    => esc_html__( 'Images per page', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set number of thumbnail images per gallery page.', 'buzzblogpro' ),
                'default'  => '6',
            ),
			array(
                'id'          => 'hs_gallery_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'Image titles font', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
                'output'      => array( 'h3.gall-title' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for gallery image titles.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-style'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'center',
                    'google'      => true,
					'text-transform'=> 'none',
                    'font-size'   => '21px',
                    'line-height' => '26px',
					'letter-spacing'=> '0px'
                ),
            ),
			array(
                'id'       => 'gallery_cat_filter',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Category filter', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display category filter', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
array(
                'id'       => 'gallery_title',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Image titles', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display image titles', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
			 array(
                'id'       => 'gallery_image_width',
                'type'     => 'text',
                'title'    => esc_html__( 'Image width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image width value.', 'buzzblogpro' ),
                'default'  => '336',
            ),
						 array(
                'id'       => 'gallery_image_height',
                'type'     => 'text',
                'title'    => esc_html__( 'Image height', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Set the image height value.', 'buzzblogpro' ),
                'default'  => '500',
            ),
array(
                'id'       => 'gallery_category',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Image category', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display image category', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
array(
                'id'       => 'gallery_description',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Image description', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display image description', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
									            array(
                'id'            => 'gallery_excerpt_count',
                'type'          => 'slider',
                'title'         => esc_html__( 'Excerpt words', 'buzzblogpro' ),
                'subtitle'      => esc_html__( 'Excerpt length (words).', 'buzzblogpro' ),
                'desc'          => esc_html__( 'Min: 0, max: 150, step: 1, default value: 11', 'buzzblogpro' ),
                'default'       => 11,
                'min'           => 0,
                'step'          => 1,
                'max'           => 150,
                'display_value' => 'text'
            ),
						array(
                'id'          => 'hs_gallery_meta_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'Meta headings font', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
				'fonts' => $buzzblogpro_os_faces,
                'all_styles'  => true,
                'output'      => array( '.gallery-meta-line, .gallery-meta-line h4' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for gallery meta headings.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-style'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'left',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '20px',
					'letter-spacing'=> '0px',
					'text-transform'=> 'uppercase'
                ),
            ),
        )
    ) );
	
/* Sidebars */
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Sidebar', 'buzzblogpro' ),
        'id'         => 'hs-sidebar',
		'icon'   => 'el el-indent-right',
        'fields'     => array(
		
		array(
                'id'        => 'sidebars',
                'type'      => 'sidgen',
                'title'     => esc_html__( 'Sidebar generator', 'buzzblogpro' ),
				'subtitle' => wp_kses( sprintf( __( 'Use this feature to generate additional sidebars. You can manage sidebars content in the <a href="%s">Apperance -> Widgets</a> settings.', 'buzzblogpro' ), admin_url( 'widgets.php' ) ), wp_kses_allowed_html( 'post' ) ),
            ),
			
							            array(
                'id'       => 'sidebar_width',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sidebar width', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the sidebar width', 'buzzblogpro' ),
                'options'  => array(
                    'smaller' => esc_html__( 'Smaller', 'buzzblogpro' ), 
                    'bigger' => esc_html__( 'Bigger', 'buzzblogpro' ) 
                ),
                'default'  => 'smaller'
            ),
						            array(
                'id'             => 'sidebar_widget_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'left' => true,
				'output'      => array( '.sidebar .widget, .wpb_widgetised_column .widget' ),
                'units'          => array( 'em', 'px', '%' ),
                'title'          => esc_html__( 'Sidebar widgets padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the padding of the sidebar widgets.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '0px',
                    'padding-bottom' => '20px',
					'padding-left' => '0px',
					'padding-right' => '0px',
					'units'          => 'px', 
                )
            ),
						array( 
    'id'       => 'sidebar_widgets_border_color',
    'type'     => 'border',
    'title'    => esc_html__( 'Sidebar widgets border color and width', 'buzzblogpro' ),
    'subtitle' => esc_html__( 'Change the sidebar widgets border color and width.', 'buzzblogpro' ),
		'all' => false,
    'output'   => array('.sidebar .widget, .wpb_widgetised_column .widget'),
    'default'  => array(
        'border-color'  => '#eeeeee', 
        'border-style'  => 'solid', 
        'border-top'    => '0px', 
        'border-right'  => '0px', 
        'border-bottom' => '0px', 
        'border-left'   => '0px'
    )
	),
					            array(
                'id'       => 'sidebar_sticky',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Sidebar type', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the sidebar type (normal or sticky)', 'buzzblogpro' ),
                'options'  => array(
                    'stickysidebar' => esc_html__( 'Sticky', 'buzzblogpro' ), 
                    'normalsidebar' => esc_html__( 'Normal', 'buzzblogpro' ) 
                ),
                'default'  => 'normalsidebar'
            ),
					array(
                'id'          => 'h4_sidebar_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'Sidebar heading font', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
				'fonts' => $buzzblogpro_os_faces,
                'output'      => array( '.widget-content h4.subtitle, .widget-content h4.subtitle a, .sidebar .instagram_footer_heading h4 span' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for sidebar H4 headings.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-weight'  => '400',
                    'font-family' => 'Heebo',
					'text-align' => 'center',
                    'google'      => true,
                    'font-size'   => '10px',
                    'line-height' => '24px',
					'letter-spacing'=> '2px',
					'text-transform'=> 'uppercase'
                ),
            ),
						            array(
                'id'             => 'sidebar_heading_margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
				'output'      => array( '.widget-content h4.subtitle' ),
                'top'           => true,
                'right'         => false,
                'bottom'        => true,
                'left'          => false,
                'units'          => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'title'          => esc_html__( 'Sidebar heading margin', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Enter the top and bottom sidebar heading margin.', 'buzzblogpro' ),
                'default'        => array(
                    'margin-top'    => '0px',
                    'margin-bottom' => '26px',
                )
            ),
			            array(
                'id'             => 'sidebar_heading_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'left' => true,
				'output'      => array( '.widget-content h4.subtitle' ),
                'units'          => array( 'em', 'px', '%' ),
                'title'          => esc_html__( 'Sidebar heading padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the padding of the sidebar heading.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '14px',
                    'padding-bottom' => '14px',
					'padding-left' => '0px',
					'padding-right' => '0px',
					'units'          => 'px', 
                )
            ),
						array( 
    'id'       => 'sidebar_heading_border_color',
    'type'     => 'border',
    'title'    => esc_html__( 'Sidebar heading border color and width', 'buzzblogpro' ),
    'subtitle' => esc_html__( 'Change the sidebar heading border color and width.', 'buzzblogpro' ),
		'all' => false,
    'output'   => array('.widget-content h4.subtitle'),
    'default'  => array(
        'border-color'  => '#000000', 
        'border-style'  => 'solid', 
        'border-top'    => '1px', 
        'border-right'  => '1px', 
        'border-bottom' => '1px', 
        'border-left'   => '1px'
    )
	),
							            array(
                'id'       => 'sidebar_heading_bgcolor',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sidebar heading bg color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the background color of the sidebar heading.', 'buzzblogpro' ),
				'output'    => array('background-color' => '.widget-content h4.subtitle'),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1'
                ),
                'mode'     => 'background',
            ),
												 array(
                'id'       => 'sidebar_heading_arrow_enable',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Enable the arrow below the sidebar heading', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display the arrow below the sidebar heading ?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
						            array(
                'id'       => 'sidebar_post_header_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Recent News widget posts heading colour', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the colour of the the Recent News posts heading', 'buzzblogpro' ),
				'output'   => array( '.my_posts_type_widget h4 a' ),
				'active'  => false,
                'default'  => array(
                    'regular' => '#000000',
                    'hover'   => '#dddddd',
                )
            ),
								array(
                'id'          => 'h4_sidebar_post_post_list_heading',
                'type'        => 'typography',
                'title'       => esc_html__( 'Sidebar recent news font', 'buzzblogpro' ),
                'font-backup' => false,
                'letter-spacing'=> true,
				'text-transform'=> true,
                'all_styles'  => true,
				'fonts' => $buzzblogpro_os_faces,
                'output'      => array( '.post-list_h h4 a, .post-list_h h4' ),
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Choose your preferred font for recent news headings.', 'buzzblogpro' ),
                'default'     => array(
                    'color'       => '#000000',
                    'font-weight'  => '400',
                    'font-family' => 'Prata',
					'text-align' => 'center',
					'text-transform'=> 'none',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '20px',
					'letter-spacing'=> '0px'
                ),
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer', 'buzzblogpro' ),
        'id'         => 'hs-footer',
		'icon'   => 'el el-chevron-down',
        'fields'     => array(
            array(
                'id'       => 'footer_text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Footer copyright text', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter text used in the right side of the footer. HTML tags are allowed.', 'buzzblogpro' ),
                'default'  => 'Copyrights &copy; 2018 BUZZBLOGPRO. All Rights Reserved.',
				'allowed_html' => array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
		'div' => array(),
		'p' => array(),
		'span' => array()
    )
            ),
			 array(
                'id'       => 'feed_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Feedburner URL', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website.', 'buzzblogpro' ),
                'default'  => '',
            ),
			array(
                'id'       => 'bottom_layout',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Bottom widgets layout', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose Bottom widgets area layout', 'buzzblogpro' ),
                'options'  => array(
            'onecolumn' => 'One column',
                    'threecols' => 'Three columns'
                ),
                'default'  => 'threecols'
            ),
						array(
                'id'       => 'bottom_widgets_bg_color',
                'type'     => 'background',
                'title'    => esc_html__( 'Bottom widgets background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the background of the Bottom widgets area.', 'buzzblogpro' ),
				'output'   => array( '.bottom-widgets-column' ),
                'default'  => array(
        'background-color' => '#f9f9f9',
    )
            ),
			
												            array(
                'id'             => 'bottom_widgets_container_padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
				'left' => false,
				'right' => false,
				'output'      => array( '.bottom-widgets-column .container' ),
                'units'          => array( 'px' ),
                'title'          => esc_html__( 'Bottom widgets container padding', 'buzzblogpro' ),
                'subtitle'       => esc_html__( 'Change the padding of the bottom widgets container.', 'buzzblogpro' ),
                'default'        => array(
                    'padding-top'    => '45px',
                    'padding-bottom' => '60px',
					'units'          => 'px', 
                )
            ),
					            array(
                'id'       => 'footer_layout_order',
                'type'     => 'sorter',
                'title'    => esc_html__( 'Footer sections order', 'buzzblogpro' ),
                'desc'     => esc_html__( 'Organize how you want the footer to appear', 'buzzblogpro' ),
                'compiler' => 'true',
                'options'  => array(
                    'enabled'  => array(
                        'bottom'   => esc_html__( 'Bottom 1, 2, 3 area', 'buzzblogpro' ),
						'instagram' => esc_html__( 'Instagram area', 'buzzblogpro' )
                    ),
                ),
            ),
		array(
                'id'       => 'footer_menu',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display Footer Menu?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display footer menu?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
		array(
                'id'       => 'footer_logo',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display Footer Logo?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display logo in the footer?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
		array(
                'id'       => 'footer_lowest',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display the lowest Footer Section?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display the lowest footer section?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																							            array(
                'id'       => 'footer_lowest_fullwidth',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Full width lowest footer', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to enable the full width lowest footer ?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
array(
                'id'       => 'footer_menu_typography',
                'type'     => 'typography',
                'title'    => esc_html__( 'Footer Menu Typography', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your prefered font for menu.', 'buzzblogpro' ),
                'google'   => true,
				'fonts' => $buzzblogpro_os_faces,
				'letter-spacing'=> true,
				'output'      => array( '.nav.footer-nav a' ),
                'default'  => array(
                    'color'       => '#000000',
                    'font-size'   => '12px',
					'line-height'   => '22px',
					'letter-spacing'   => '0px',
                    'font-family' => '',
                    'font-weight' => '400',
                ),
            ),
            array(
                'id'       => 'footer_menu_hover_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Hover / active footer menu link color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the footer menu hover/active link color.', 'buzzblogpro' ),
                'regular'   => false,
				'active'  => false,
				'output'   => array( '.nav.footer-nav ul li a' ),
                'default'  => array(
                    'hover'   => '#bbbbbb',
                )
            ),
		            array(
                'id'       => 'footer_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer text color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the footer text color.', 'buzzblogpro' ),
				'output'   => array( '.footer-text, .footer .social__list_both .social_label' ),
                'default'  => '#000000',
                'validate' => 'color',
            ),
		            array(
                'id'       => 'footer_logo_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Footer logo color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the footer logo color.', 'buzzblogpro' ),
				'output'   => array( '.footer .logo a' ),
				'active'   => false,
                'default'  => array(
				    'regular' => '#000000',
                    'hover'   => '#000000',
                )
            ),
		            array(
                'id'       => 'footer_logo_tagline_color', 
                'type'     => 'color',
                'title'    => esc_html__( 'Footer tagline color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the footer tagline color.', 'buzzblogpro' ),
				'output'   => array( '.footer .logo_tagline' ),
                'default'  => '#000000',
                'validate' => 'color',
            ),
array(
                'id'       => 'footer_bg_color',
                'type'     => 'background',
                'title'    => esc_html__( 'Footer background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the footer background.', 'buzzblogpro' ),
				'output'   => array( '.footer' ),
                'default'  => array(
        'background-color' => '#ffffff',
    )
            ),
									array( 
    'id'       => 'footer_border_color',
    'type'     => 'border',
    'title'    => esc_html__( 'Footer border color and width', 'buzzblogpro' ),
    'subtitle' => esc_html__( 'Change the footer border color and width.', 'buzzblogpro' ),
		'all' => false,
		'right'  => false, 
		'left'   => false,
    'output'   => array('.footer'),
    'default'  => array(
        'border-color'  => '#eeeeee', 
        'border-style'  => 'solid', 
        'border-top'    => '0px',  
        'border-bottom' => '0px'
    )
	),
		            array(
                'id'       => 'footer_links_color', 
                'type'     => 'link_color',
                'title'    => esc_html__( 'Footer links color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the footer links color.', 'buzzblogpro' ),
				'output'   => array( '.footer a' ),
				'active'   => false,
                'default'  => array(
				    'regular' => '#000000',
                    'hover'   => '#c5b8a5',
                )
            ),
												            array(
                'id'       => 'footerline_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Color of the line above the Copyrights section', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the color of the line above the Copyrights section.', 'buzzblogpro' ),
                'default'  => '#ffffff',
                'validate' => 'color',
				'transparent' => true,
            ),
			array(
                'id'       => 'copyright_bg_color',
                'type'     => 'background',
                'title'    => esc_html__( 'Copyright background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the copyright section background.', 'buzzblogpro' ),
				'output'   => array( '.lowestfooter' ),
                'default'  => array(
        'background-color' => '#ffffff',
    )
            ),
															            array(
                'id'       => 'instagram_footer_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Instagram footer text color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the color of the Instagram footer text', 'buzzblogpro' ),
                'default'  => '#ffffff',
                'validate' => 'color',
				'output'   => array( '.footer .instagram_footer_heading h4, .footer .instagram_footer_heading a' ),
				'transparent' => true,
            ),
						array(
                'id'       => 'instagram_bg_color',
                'type'     => 'background',
                'title'    => esc_html__( 'Footer Instagram background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change background color of the Instagram section.', 'buzzblogpro' ),
				'output'   => array( '.footer .instagram-footer' ),
                'default'  => array(
        'background-color' => '#000000',
    )
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Cookie banner', 'buzzblogpro' ),
        'id'         => 'hs-cookie-banner',
		'icon'   => 'el el-chevron-down',
        'fields'     => array(
				array(
                'id'       => 'cookie_banner',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Cookie banner', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display Cookie Banner?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
											            array(
                'id'       => 'cookie_more_info_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Enter more info url', 'buzzblogpro' ),
                'default'  => '',
            ),
			
			
            array(
                'id'       => 'cookie_text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Message', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter the cookie banner message.', 'buzzblogpro' ),
                'default'  => 'Cookies help to deliver content on this website. By continuing to use the website, you agree to the use of cookies.',
            ),

        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Newsletter', 'buzzblogpro' ),
        'id'         => 'hs-newsletter',
		'icon'   => 'el el-envelope',
        'fields'     => array(
			
					array(
                'id'       => 'newsletter_image_url',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Newsletter Image', 'buzzblogpro' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload Newsletter Image.', 'buzzblogpro' ),
                'default'  => array( 'url' => '' ),
            ),
								            array(
                'id'       => 'mailchimp_apikey',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp Api Key', 'buzzblogpro' ),
                'default'  => '',
            ),
		array(
                'id'       => 'hs_newsletter_display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display SUBSCRIBE link?', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Display SUBSCRIBE link in the main menu?', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
					array(
                'id'       => 'newsletter-cookie-onload',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Newsletter onload', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display Newsletter popup window on page load ? Pop up will show up only once. It will appear again after 15 days, unless you delete the cookies files.', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Login Form', 'buzzblogpro' ),
        'id'         => 'hs-login-form',
		'icon'   => 'el el-user',
        'fields'     => array(
		array(
                'id'       => 'login_form_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Login Form logo', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Upload the login form logo image. The maximum dimensions of the photo are: 350px x 84px', 'buzzblogpro' ),
                'default'  => array( 'url' => '' ),
            ),
array(
                'id'       => 'login_form_image_bg',
                'type'     => 'media',
				'url'      => true,
                'title'    => esc_html__( 'Login Form background', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the Login Form background image', 'buzzblogpro' ),
				'default'  => array( 'url' => '' ),
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Woocommerce', 'buzzblogpro' ),
        'id'         => 'hs-woocommerce',
		'icon'   => 'el el-shopping-cart',
        'fields'     => array(
					            array(
                'id'       => 'woocommerce_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Shop page title', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter Your Shop Title.', 'buzzblogpro' ),
                'default'  => 'Welcome to BuzzBlogPro store',
            ),
						            array(
                'id'       => 'woocommerce_subtitle',
                'type'     => 'text',
                'title'    => esc_html__( 'Blog page subtitle', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enter Your Shop Subtitle.', 'buzzblogpro' ),
                'default'  => 'Shirts & Shorts to Complete any outfit',
            ),
		array(
                'id'       => 'woocommerce_sidebar_pos',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Default woocommerce page layout', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Choose your default woocommerce page layout.', 'buzzblogpro' ),
                'options'  => array(
                    'left' => array( 'title' => 'left sidebar', 'img' => get_template_directory_uri() . '/includes/images/2cl.png' ),
                    'right' => array( 'title' => 'right sidebar', 'img' => get_template_directory_uri() . '/includes/images/2cr.png' ),
                    'full' => array( 'title' => 'no sidebar', 'img' => get_template_directory_uri() . '/includes/images/1col.png' )
                ),
                'default'  => 'right'
            ),
												            array(
                'id'       => 'woocommerce_items_per_page',
                'type'     => 'text',
                'title'    => esc_html__( 'Products per page', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Number of products per page.', 'buzzblogpro' ),
                'default'  => '6'
            ),
																			 array(
                'id'       => 'woocommerce_cart_icon',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Cart icon', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or disable Cart icon in the main menu', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'yes'
            ),
																 array(
                'id'       => 'woocommerce_slideshow_disable',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Disable woocommerce slideshow on the shop page', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Enable or disable woocommerce slideshow on the shop page', 'buzzblogpro' ),
                'options'  => array(
            'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Twitter settings', 'buzzblogpro' ),
        'id'         => 'hs-twitter-settings',
		'icon'   => 'el el-twitter',
        'fields'     => array(
		array(
    'id'   => 'info_normal',
    'type' => 'info',
    'desc' => esc_html__('Twitter access is required for Twitter widget. Open the documentation and read Twitter API chapter.', 'buzzblogpro')
),
					            array(
                'id'       => 'twitter_consumer_key',
                'type'     => 'text',
                'title'    => esc_html__( 'Consumer Key', 'buzzblogpro' ),
                'default'  => '',
            ),
						            array(
                'id'       => 'twitter_consumer_secret',
                'type'     => 'text',
                'title'    => esc_html__( 'Consumer Secret', 'buzzblogpro' ),
                'default'  => '',
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Google Analytics', 'buzzblogpro' ),
        'id'         => 'hs-google-analytics',
		'icon'   => 'el el-googleplus',
        'fields'     => array(
			            array(
                'id'       => 'google_analytics',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Google Analytics', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Want to add Google Analytics code or any custom js code? Put in here, and the rest is taken care of.', 'buzzblogpro' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => ""
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Ads', 'buzzblogpro' ),
        'id'         => 'hs-ads',
		'icon'   => 'el el-googleplus',
        'fields'     => array(
			            array(
                'id'       => 'ads_before_post_content',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Ads before single post content', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Put here you ads code. Ads will be displayed above the post content.', 'buzzblogpro' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => ""
            ),
						            array(
                'id'       => 'ads_after_post_content',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Ads after single post content', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Put here you ads code. Ads will be displayed below the post content.', 'buzzblogpro' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => ""
            ),
        )
    ) );
Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Review', 'buzzblogpro' ),
        'id'         => 'hs-review',
		'icon'   => 'el el-list',
        'fields'     => array(																	           
				array(
                'id'       => 'review_system',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Review system', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to enable review system?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
			       															           
				array(
                'id'       => 'enable_score',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Review score', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Do you want to display review score on the images?', 'buzzblogpro' ),
                'options'  => array(
                    'yes' => esc_html__( 'Yes', 'buzzblogpro' ),
                    'no' => esc_html__( 'No', 'buzzblogpro' )
                ),
                'default'  => 'no'
            ),
															            array(
                'id'       => 'review_bar_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'The review bar background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the background color of the review bar.', 'buzzblogpro' ),
				'output'   => array( '.review-box .progress.active .bar' ),
                'default'  => array(
                    'color' => '#c5b8a5',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),
																		            array(
                'id'       => 'overallscore_bg_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'The overall score background color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the background color of the overall score badge.', 'buzzblogpro' ),
				'output'   => array( '.review-box .review-score, .thumbnail .review' ),
                'default'  => array(
                    'color' => '#c5b8a5',
                    'alpha' => 1
                ),
                'mode'     => 'background',
            ),
																					            array(
                'id'       => 'overallscore_text_color_value',
                'type'     => 'color',
                'title'    => esc_html__( 'The overall score text color', 'buzzblogpro' ),
                'subtitle' => esc_html__( 'Change the overall score text color.', 'buzzblogpro' ),
				'output'   => array( '.review-box .review-score, .thumbnail .review span, .thumbnail .review span a, .thumbnail .review span a:hover' ),
                'default'  => '#ffffff',
                
            ),
        )
    ) );
	Redux::setSection( $opt_name, array (
		'title' => esc_html__('Custom fonts', 'buzzblogpro'),
		'icon' => 'dashicons dashicons-editor-customchar',
		'fields' => array (
			array (
				'type' => 'custom_font',
				'id' => 'custom_font',
				'validate'=>'font_load',
				'title' => esc_html__('Font-face list:', 'buzzblogpro'),
				'subtitle' => esc_html__('Upload .zip archive with font-face files.', 'buzzblogpro').'<br>(<a target="_blank" href="http://www.fontsquirrel.com/tools/webfont-generator">'.esc_html__('Create your font-face package','buzzblogpro').'</a>)',
				'desc' => '<span style="color:#F09191">'.esc_html__('Note','buzzblogpro').':</span> '.esc_html__('You have to download the font-face.zip archive.','buzzblogpro').' <br>'.__('Pay your attention, that the archive has to contain the font-face files itself, and not the subfolders','buzzblogpro').'<br> ('.esc_html__('E.g.: font-face.zip/your-font-face.ttf, font-face.zip/your-font-face.eot, font-face.zip/your-font-face.woff etc','buzzblogpro').')',
				'placeholder' => array (
					'title' => esc_html__('This is a title', 'buzzblogpro'),
					'description' => esc_html__('Description Here', 'buzzblogpro'),
					'url' => esc_html__('Give us a link!', 'buzzblogpro'),
				),
			),
		)
	));
Redux::setSection( $opt_name, array(
        'icon'      => 'el-icon-time',
        'title' => esc_html__( 'Updater', 'buzzblogpro' ),
        'desc' => wp_kses( sprintf( __( 'Specify your ThemeForest username and API Key to enable theme update notification. When there is a new version of the theme, it will appear on your <a href="%s">updates screen</a>.', 'buzzblogpro' ), admin_url( 'update-core.php' ) ), wp_kses_allowed_html( 'post' ) ),
        'fields' => array(

            array(
                'id' => 'theme_update_username',
                'type' => 'text',
                'title' => esc_html__( 'Your ThemeForest Username', 'buzzblogpro' ),
                'default' => ''
            ),

            array(
                'id' => 'theme_update_apikey',
                'type' => 'text',
                'title' => esc_html__( 'Your ThemeForest API Key', 'buzzblogpro' ),
                'desc' => wp_kses( sprintf( __( 'Where can I find my %s?', 'buzzblogpro' ), '<a href="http://themeforest.net/help/api" target="_blank">API key</a>' ), wp_kses_allowed_html( 'post' ) ),
                'default' => ''
            )
        ) )
);
}
buzzblogpro_OptionsPanel();