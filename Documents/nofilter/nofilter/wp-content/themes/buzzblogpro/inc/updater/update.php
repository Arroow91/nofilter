<?php
add_action( 'admin_init', 'buzzblogpro_run_updater' );

if ( !function_exists( 'buzzblogpro_run_updater' ) ):
	function buzzblogpro_run_updater() {

		$user = buzzblogpro_getVariable( 'theme_update_username' );
		$apikey = buzzblogpro_getVariable( 'theme_update_apikey' );
		if ( !empty( $user ) && !empty( $apikey ) ) {
			include_once get_template_directory() .'/inc/updater/class-pixelentity-theme-update.php';
			PixelentityThemeUpdate::init( $user, $apikey );
		}
	}
endif;


add_action( 'admin_init', 'buzzblogpro_check_installation' );

if ( !function_exists( 'buzzblogpro_check_installation' ) ):
	function buzzblogpro_check_installation() {
		add_action( 'admin_notices', 'buzzblogpro_update_msg', 1 );
		//update_option( 'buzzblogpro_theme_version', BUZZBLOGPRO_THEME_VERSION );
	}
endif;

if ( !function_exists( 'buzzblogpro_update_msg' ) ):
	function buzzblogpro_update_msg() {
		//if ( get_option( 'buzzblogpro_welcome_box_displayed' ) ) {
			$prev_version = get_option( 'buzzblogpro_theme_version' );
			$cur_version = BUZZBLOGPRO_THEME_VERSION;
			if ( $prev_version === false ) { $prev_version = '0.0.0'; }
			if ( version_compare( $cur_version, $prev_version, '>' ) ) {
				include_once get_template_directory() .'/inc/updater/update-panel.php';
			}
		//}
	}
endif;

add_action('wp_ajax_buzzblogpro_update_version', 'buzzblogpro_update_version');

if(!function_exists('buzzblogpro_update_version')):
function buzzblogpro_update_version(){
	update_option('buzzblogpro_theme_version', BUZZBLOGPRO_THEME_VERSION);
	die();
}
endif;
?>