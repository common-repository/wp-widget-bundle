<?php
/**
 * Loads and defines the internationalization files for this plugin so that it is ready for translation.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/class-widget-textdomain
 * @author     Devnath verma <devnathverma@gmail.com>
 */ 
class WB4WP_Register_Textdomain {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since      1.0.0
	 *
	 * @package    widget-bundle
	 * @subpackage widget-bundle/includes/class-widget-textdomain
	 * @author     Devnath verma <devnathverma@gmail.com>
	 */
	public static function widget_textdomain() {
		
		load_plugin_textdomain(
			'widget-bundle',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages'
		);
	}
}