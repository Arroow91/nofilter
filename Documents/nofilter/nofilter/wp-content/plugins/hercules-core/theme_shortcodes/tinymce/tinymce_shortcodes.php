<?php
/**
 *
 * TinyMCE Shortcode Integration
 *
 */

class TinyMCE_Shortcodes_hercules {
		var $pluginname = 'HS_Shortcodes';
	var $path = '';
	var $internalVersion = 100;
	// Constructor
	
	function __construct() {
	
		//admin_init
		add_action( 'init', array( &$this, 'initbut' ) );
		
		//Only use wp_ajax if user is logged in
		add_action( 'wp_ajax_check_url_action', array( &$this, 'ajax_action_check_url' ) );
	
	}

	// Get everything started

	function initbut() {
	global $page_handle;
				if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) 
			return;
			
			// Add only in Rich Editor mode
			if ( get_user_option('rich_editing') == 'true') 
			{
		  	
		  	//Framework URL
		  	$hs_plugin_url = plugin_dir_url(__FILE__);
		  	
		  	//Pass URL to plugin's js file
		  	//$hs_name = 'BALLS';
   			//wp_localize_script( 'MyTheme', 'custom', array('name' => $hs_name));

		  	
		  	//TinyMCE plugin stuff
			add_filter( 'mce_buttons', array( &$this, 'filter_mce_buttons' ), 5 );
			add_filter( 'mce_external_plugins', array( &$this, 'filter_mce_external_plugins' ), 5 );
			
			//TinyMCE shortcode plugin CSS
			wp_register_style( 'tinymce-shortcodes', $hs_plugin_url.'layout/css/tinymce_shortcodes.css' );
			wp_enqueue_style( 'tinymce-shortcodes' );
			
		}
	
	}
	
	// Filter mce buttons
	
	function filter_mce_buttons( $buttons ) {
		
		array_push( $buttons, '|', $this->pluginname );
		
		return $buttons;
		
	}
	
	
function filter_mce_external_plugins($plugin_array) 
	{
		global $page_handle;
		global $post_id;
		
		if(isset($_GET['post'])) {
			$post_id = $_GET['post'];
		}
		$post = get_post($post_id);
		if(isset($post_type)) {
		$post_type = $post->post_type;
}
        $plugin_array[$this->pluginname] =  plugin_dir_url(__FILE__).'editor_plugin.js';
			
		return $plugin_array;
	}
	// Ajax Check
	
	function ajax_action_check_url() {
	
		$hadError = true;
	
		$url = isset( $_REQUEST['url'] ) ? $_REQUEST['url'] : '';
	
		if ( strlen( $url ) > 0  && function_exists( 'get_headers' ) ) {
				
			$file_headers = @get_headers( $url );
			$exists       = $file_headers && $file_headers[0] != 'HTTP/1.1 404 Not Found';
			$hadError     = false;
		}
	
		echo '{ "exists": '. ($exists ? '1' : '0') . ($hadError ? ', "error" : 1 ' : '') . ' }';
	
		die();
		
	}


} // end TinyMCE_Shortcodes class
function hs_wpshortcodes_tinymce() {
$mytheme_shortcode_tinymce = new TinyMCE_Shortcodes_hercules();
}
add_action( 'after_setup_theme', 'hs_wpshortcodes_tinymce' );
?>