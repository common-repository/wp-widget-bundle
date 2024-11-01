<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package widget-bundle
 * @since   1.0.0
 * @author  Devnath verma <devnathverma@gmail.com>
 */

/*----------------------------------------------------------------------------*
 * If uninstall not called from WordPress, then exit.
 *-----------------------------------------------------------------------------*/

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {

    exit;
}

/**
 * If it's a multisite, loop over all the blogs where the plugin is activated and delete the options from the DB.
 * @package widget-bundle
 * @since   1.0.0
 * @author  Devnath verma <devnathverma@gmail.com>
 * @uses 	delete_option()
 */
if ( is_multisite() ) {
    
	global $wpdb;
    $wb4wp_blogs = $wpdb->get_results( 'SELECT blog_id FROM {$wpdb->blogs}', ARRAY_A );

    if( ! empty( $wb4wp_blogs ) ) {
	
        foreach( $wb4wp_blogs as $wb4wp_blog ) {
		
            switch_to_blog( $wb4wp_blog['blog_id'] );
            delete_option( 'widget_bundle_settings' );
        }
	}

} else {

    delete_option( 'widget_bundle_settings' );
}