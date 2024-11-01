<?php
/**
 * Fired during plugin activation.
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/class-widget-activation
 * @author     Devnath verma <devnathverma@gmail.com>
 */
class WB4WP_Register_Activator {
		
	/**
	 * On plugin activation "Saved" default settings.
	 *
	 * @since      1.0.0
	 *
	 * @package    widget-bundle
	 * @subpackage widget-bundle/includes/class-widget-activation
	 * @author     Devnath verma <devnathverma@gmail.com>
	 */
	public static function widget_activate() {
		
		$widget_bundle_settings['widget_options']['widget_types']['widget_aboutme']			=	false;
		$widget_bundle_settings['widget_options']['widget_types']['widget_button']			=	false;
		$widget_bundle_settings['widget_options']['widget_types']['widget_categories']		=	false;
		$widget_bundle_settings['widget_options']['widget_types']['widget_comments']		=	false;
		$widget_bundle_settings['widget_options']['widget_types']['widget_contact']			=	false;
		$widget_bundle_settings['widget_options']['widget_types']['widget_image']			=	false;
		$widget_bundle_settings['widget_options']['widget_types']['widget_links']			=	false;
		$widget_bundle_settings['widget_options']['widget_types']['widget_login_register']	=	false;
		$widget_bundle_settings['widget_options']['widget_types']['widget_posts']			=	false;
		$widget_bundle_settings['widget_options']['widget_types']['widget_social']			=	false;
		$widget_bundle_settings['widget_options']['widget_types']['widget_text']			=	false;
		$widget_bundle_settings['widget_options']['widget_types']['widget_users']			=	false;
		update_option( 'widget_bundle_settings', $widget_bundle_settings );
	}
}