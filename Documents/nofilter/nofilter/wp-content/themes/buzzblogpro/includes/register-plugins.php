<?php
require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'buzzblogpro_theme_register_required_plugins' );

function buzzblogpro_theme_register_required_plugins() {

	$plugins = array(
        array(
			'name'     				=> 'Redux Framework',
			'slug'     				=> 'redux-framework',
			'source'   				=> esc_url('https://buzzblogpro.hercules-design.com/buzzblogpro-plugins/redux-framework.zip'),
			'required' 				=> true,
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false, 
			'external_url' 			=> '',
			'image_url' => get_template_directory_uri() . '/inc/admin/assets/img/admin/plugins/redux-logo.png'
		),
				array( 
			'name'     				=> 'Hercules Core',
			'slug'     				=> 'hercules-core',
			'source'   				=> esc_url('https://buzzblogpro.hercules-design.com/buzzblogpro-plugins/hercules-core.zip'),
			'required' 				=> true,
			'version' 				=> '1.0', 
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false, 
			'external_url' 			=> '',
			'image_url' => get_template_directory_uri() . '/inc/admin/assets/img/admin/plugins/hercules-core.png'
		),
		array(
			'name'     				=> 'Contact Form 7',
			'slug'     				=> 'contact-form-7',
			'required' 				=> false,   
			'image_url' => get_template_directory_uri() . '/inc/admin/assets/img/admin/plugins/contact-form-7.png'
		),
		
		array(
			'name'     				=> 'Gridable',
			'slug'     				=> 'gridable',
			'source'   				=> esc_url('https://buzzblogpro.hercules-design.com/buzzblogpro-plugins/gridable.zip'),
			'required' 				=> false,
			'image_url' => get_template_directory_uri() . '/inc/admin/assets/img/admin/plugins/gridable.png'
		),
		array(
			'name'     => esc_html_x('Self-Hosted Google Fonts', 'Admin', 'cheerup'),
			'slug'     => 'selfhost-google-fonts',
			'required' => false,
			'image_url' => get_template_directory_uri() . '/inc/admin/assets/img/admin/plugins/google-fonts.png'
			),

	); 

	$config = array(
	    'id'           => 'buzzblogpro',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins', 
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}

add_action( 'vc_before_init', 'buzzblogpro_vcSetAsTheme' );
function buzzblogpro_vcSetAsTheme() {
    vc_set_as_theme();
}