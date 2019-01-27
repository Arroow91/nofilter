<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function activate_my_wp_translate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hercules-wp-translate-activator.php';
	HERCULES_WP_Translate_Activator::activate();
}

function deactivate_my_wp_translate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-hercules-wp-translate-deactivator.php';
	HERCULES_WP_Translate_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_my_wp_translate' );
register_deactivation_hook( __FILE__, 'deactivate_my_wp_translate' );
require plugin_dir_path( __FILE__ ) . 'includes/class-hercules-wp-translate.php';

function run_my_wp_translate() {

	$plugin = new HERCULES_WP_Translate();
	$plugin->run();

}
run_my_wp_translate();
