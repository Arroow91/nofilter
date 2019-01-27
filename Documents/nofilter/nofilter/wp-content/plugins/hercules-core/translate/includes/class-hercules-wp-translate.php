<?php
class HERCULES_WP_Translate {

	protected $loader;
	protected $plugin_name;
	protected $version;
	public function __construct() {

		$this->plugin_name = 'buzzblogpro-translate';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->define_admin_hooks();

	}

	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-hercules-wp-translate-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-hercules-wp-translate-po-parser.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-hercules-wp-translate-admin.php';

		$this->loader = new HERCULES_WP_Translate_Loader();

	}

	private function define_admin_hooks() {

		$plugin_admin = new HERCULES_WP_Translate_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu_page' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'settings_init' );

		//ajax for translation panel form
        $this->loader->add_action( 'wp_ajax_herculestwp_translation_panel', $plugin_admin, 'ajax_herculestwp_translation_panel' );
        $this->loader->add_action( 'wp_ajax_herculestwp_save_translation', $plugin_admin, 'ajax_herculestwp_save_translation' );
        $this->loader->add_action( 'wp_ajax_herculestwp_save_state', $plugin_admin, 'ajax_herculestwp_save_state' );
        $this->loader->add_action( 'wp_ajax_herculestwp_import_strings', $plugin_admin, 'ajax_herculestwp_import_strings' );
        $this->loader->add_action( 'wp_ajax_herculestwp_update_export_code', $plugin_admin, 'ajax_herculestwp_update_export_code' );
		
		$this->loader->add_action( 'after_setup_theme', $plugin_admin, 'mts_remove_theme_custom_translate' );
        $this->loader->add_filter( 'gettext', $plugin_admin, 'mts_custom_translate', 20, 3 );
        $this->loader->add_filter( 'nhp-opts-args', $plugin_admin, 'mts_disable_theme_options_panel_translate');

        $this->loader->add_action( 'plugins_loaded', $plugin_admin, 'get_po' );
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
