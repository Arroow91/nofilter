<?php
class HERCULES_WP_Translate_Activator {

	public static function activate() {

		// First time using the plugin - set some defaults
		if ( false == get_option( 'herculestwp_translations' ) ) {

			update_option(
				'herculestwp_translations',
				array(
					'themes' => array(),
					'strings_per_page' => 60
				)
			);
		}
	}

}
