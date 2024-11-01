<?php
/**
 * Fired during plugin activation.
 * This class defines requirement error to run during the plugin's activation.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/class-widget-requirements
 * @author     Devnath verma <devnathverma@gmail.com>
 */
class WB4WP_Requirements_Error {
		
	/**
	 * Prints an error that the system requirements weren't met.
	 *
	 * @since      1.0.0
	 *
	 * @package    widget-bundle
	 * @subpackage widget-bundle/includes/class-widget-requirements
	 * @author     Devnath verma <devnathverma@gmail.com>
	 */
	public static function widget_requirements( ) {
		
		global $wp_version;
		$widget_requirements  = '';
		$widget_requirements .= '<div class="error">';
		$widget_requirements .= '<p><strong>'. WB4WP_PLUGIN_NAME .'</strong></p>';
		$widget_requirements .= '<ul class="ul-disc">';
		$widget_requirements .= '<li>';
		$widget_requirements .= '<strong>ERROR : </strong>';
		$widget_requirements .= '<em>Your environment doesn"t meet all of the system requirements listed below.</em>';
		$widget_requirements .= '</li>';
		$widget_requirements .= '<li>';
		$widget_requirements .= '<strong>PHP ' .WB4WP_PHP_VERSION. ' : </strong>';
		$widget_requirements .= '<em> You"re running version of PHP ' .PHP_VERSION. '</em>';
		$widget_requirements .= '</li>';
		$widget_requirements .= '<li>';
		$widget_requirements .= '<strong>WordPress ' .WB4WP_WP_VERSION. ' : </strong>';
		$widget_requirements .= '<em> You"re running version of WordPress ' .esc_html( $wp_version ). '</em>';
		$widget_requirements .= '</li>';
		$widget_requirements .= '</ul>';
		$widget_requirements .= '<p>If you need to upgrade your version of PHP you can ask your hosting company for assistance, and if you need help upgrading WordPress you can refer to <a href="http://codex.wordpress.org/Upgrading_WordPress">the Codex</a>.</p>';
		$widget_requirements .= '</div>';
		echo $widget_requirements;
	}
}