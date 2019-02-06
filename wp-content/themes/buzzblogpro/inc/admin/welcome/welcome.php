<?php 
class Buzzblogpro_Theme_Admin {
	/**
	 *	Main instance
	 */
	private static $_instance;
	
	/**
	 *	Theme Name
	 */
	public static $buzzblogpro_theme_name;
	
	/**
	 *	Theme Version
	 */
	public static $buzzblogpro_theme_version;
	
	/**
	 *	Theme Slug
	 */
	public static $buzzblogpro_theme_slug;
	
	/**
	 *	Theme Directory
	 */
	public static $buzzblogpro_theme_directory;
	
	/**
	 *	Theme Directory URL
	 */
	public static $buzzblogpro_theme_directory_uri;
	
	/**
	 *	Theme Constructor executed only once per request
	 */
	public function __construct() {
		if ( self::$_instance ) {
			_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
		}
	}
	
	/**
	 * You cannot clone this class
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
	}

	/**
	 * You cannot unserialize instances of this class
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
	}
	
	public static function instance() {
		global $buzzblogpro_Theme_Admin;
		if ( ! self::$_instance ) {
			self::$_instance = new self();
			$buzzblogpro_Theme_Admin = self::$_instance;
			
			// Theme Variables
			$theme = wp_get_theme();
			self::$buzzblogpro_theme_name = $theme->get( 'Name' );
			self::$buzzblogpro_theme_version = $theme->parent() ? $theme->parent()->get( 'Version' ) : $theme->get( 'Version' );
			self::$buzzblogpro_theme_slug = $theme->template;
			self::$buzzblogpro_theme_directory = get_template_directory() . '/';
			self::$buzzblogpro_theme_directory_uri = get_template_directory_uri() . '/';
			
			
			// Setup Admin Menus
			if ( is_admin() ) {
				self::$_instance->initAdminPages();
			}
		}
		
		return self::$_instance;
	}
	/**
	 *	After Theme Setup
	 */
	
	
		public function buzzblogpro_plugins_install( $item ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$installed_plugins = get_plugins();

		$item['sanitized_plugin'] = $item['name'];

		// WordPress Repository
		if ( ! $item['version'] ) {
			$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
		}

		// Install Link
		if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
			$actions = array(
				'install' => sprintf(
					'<a href="%1$s" class="button" title="Install %2$s">Install Now</a>',
					esc_url( wp_nonce_url(
						add_query_arg(
							array(
								'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'        => urlencode( $item['slug'] ),
								'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
								'tgmpa-install' => 'install-plugin',
								'return_url'    => network_admin_url( 'admin.php?page=buzzblogpro-plugins' )
							),
							TGM_Plugin_Activation::$instance->get_tgmpa_url()
						),
						'tgmpa-install',
						'tgmpa-nonce'
					) ),
					$item['sanitized_plugin']
				),
			);
		}
		// Activate Link
		else if ( is_plugin_inactive( $item['file_path'] ) ) {
			$actions = array(
				'activate' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
					esc_url( add_query_arg(
						array(
							'plugin'               => urlencode( $item['slug'] ),
							'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
							'buzzblogpro-activate'       => 'activate-plugin',
							'buzzblogpro-activate-nonce' => wp_create_nonce( 'buzzblogpro-activate' ),
						),
						admin_url( 'admin.php?page=buzzblogpro-plugins' )
					) ),
					$item['sanitized_plugin']
				),
			);
		}
		// Update Link
		
		else if ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
			$actions = array(
				'update' => sprintf(
					'<a href="%1$s" class="button button-update" title="Install %2$s"><span class="dashicons dashicons-update"></span> Update</a>',
					wp_nonce_url(
						add_query_arg(
							array(
								'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'        => urlencode( $item['slug'] ),
								'tgmpa-update'  => 'update-plugin',
								'version'       => urlencode( $item['version'] ),
								'return_url'    => network_admin_url( 'admin.php?page=buzzblogpro-plugins' )
							),
							TGM_Plugin_Activation::$instance->get_tgmpa_url()
						),
						'tgmpa-update',
						'tgmpa-nonce'
					),
					$item['sanitized_plugin']
				),
			);
		} else if ( is_plugin_active( $item['file_path'] ) ) {
			$actions = array(
				'deactivate' => sprintf(
					'<a href="%1$s" class="button" title="Deactivate %2$s">Deactivate</a>',
					esc_url( add_query_arg(
						array(
							'plugin'                 => urlencode( $item['slug'] ),
							'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
							// 'plugin_source'          => urlencode( $item['source'] ),
							'buzzblogpro-deactivate'       => 'deactivate-plugin',
							'buzzblogpro-deactivate-nonce' => wp_create_nonce( 'buzzblogpro-deactivate' ),
						),
						admin_url( 'admin.php?page=buzzblogpro-plugins' )
					) ),
					$item['sanitized_plugin']
				),
			);
		}

		return $actions;
	}
	/**
	 *	Inintialize Admin Pages
	 */
	public function initAdminPages() {
		global $pagenow;
		
		// Script and styles
		add_action( 'admin_enqueue_scripts', array( & $this, 'adminPageEnqueue' ) );
		
		// Menu Pages
		add_action( 'admin_menu', array( & $this, 'adminSetupMenu' ), 1 );
		
		// Theme Options Redirect
		if ( 'admin.php' == $pagenow && 'buzzblogpro_options_options' == $_GET['page'] ) {
			wp_redirect( admin_url( "themes.php?page=buzzblogpro_options_options" ) );
			die();
		}
		
		// Redirect to Main Page
		add_action( 'after_switch_theme', array( & $this, 'buzzblogpro_activation_redirect' ) );
		
		// Plugin Update Nonce
		add_action( 'register_sidebar', array( & $this, 'buzzblogpro_theme_admin_init' ) );
	}

	public function buzzblogpro_theme_admin_init() {
	
		if ( isset( $_GET['buzzblogpro-deactivate'] ) && $_GET['buzzblogpro-deactivate'] == 'deactivate-plugin' ) {
			
			check_admin_referer( 'buzzblogpro-deactivate', 'buzzblogpro-deactivate-nonce' );

			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			$plugins = get_plugins();

			foreach ( $plugins as $plugin_name => $plugin ) {
				if ( $plugin['Name'] == $_GET['plugin_name'] ) {
						deactivate_plugins( $plugin_name );
				}
			}

		} 

		if ( isset( $_GET['buzzblogpro-activate'] ) && $_GET['buzzblogpro-activate'] == 'activate-plugin' ) {
			
			check_admin_referer( 'buzzblogpro-activate', 'buzzblogpro-activate-nonce' );

			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			$plugins = get_plugins();

			foreach ( $plugins as $plugin_name => $plugin ) {
				if ( $plugin['Name'] == $_GET['plugin_name'] ) {
					activate_plugin( $plugin_name );
				}
			}

		}

	}

	public function buzzblogpro_activation_redirect() {
		$buzzblogpro_installed = 'buzzblogpro_installed';
		
		if ( false == get_option( $buzzblogpro_installed, false ) ) {		
			update_option( $buzzblogpro_installed, true );
			wp_redirect( admin_url( 'admin.php?page=buzzblogpro-plugins' ) );
			die();
		} 
		
		delete_option( $buzzblogpro_installed );
	}
	public function adminPageEnqueue($hook) {
			if($hook == 'toplevel_page_buzzblogpro-plugins' or $hook == 'buzzblogpro-child_page_buzzblogpro-demo-import' or $hook == 'buzzblogpro_page_buzzblogpro-demo-import' or $hook == 'buzzblogpro_page_buzzblogpro-updates' ) {
	
		wp_enqueue_style("buzzblogpro-admin-css", Buzzblogpro_Theme_Admin::$buzzblogpro_theme_directory_uri . "inc/admin/assets/css/admin.css", null, esc_attr(self::$buzzblogpro_theme_version));
}
	}
	public function adminSetupMenu() {
		
		add_menu_page( Buzzblogpro_Theme_Admin::$buzzblogpro_theme_name, Buzzblogpro_Theme_Admin::$buzzblogpro_theme_name, 'edit_theme_options', 'buzzblogpro-plugins', array( & $this, 'buzzblogpro_Plugins' ), '', 3 );
		
		// Main Menu Item
		add_submenu_page( 'buzzblogpro-plugins', 'Plugins', 'Plugins', 'edit_theme_options', 'buzzblogpro-plugins', array( & $this, 'buzzblogpro_Plugins' ) );
		if ( class_exists( 'Redux' ) && function_exists( 'buzzblogpro_register_widgets' ) ) { 
		// Theme Options
		add_submenu_page( 'buzzblogpro-plugins', 'Theme Options', 'Theme Options', 'edit_theme_options', 'buzzblogpro_options_options', '__return_false' );
		
		}
	}
	public function buzzblogpro_Plugins() {
		get_template_part( 'inc/admin/welcome/pages/plugins' );
	}

}
// Main instance shortcut
function buzzblogpro_Theme_Admin() {
	global $buzzblogpro_Theme_Admin;
	return $buzzblogpro_Theme_Admin;
}
Buzzblogpro_Theme_Admin::instance();