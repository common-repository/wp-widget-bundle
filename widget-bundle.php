<?php
/**
 * Widget_Bundle class file.
 *
 * @package widget-bundle
 * @author  Devnath verma <devnathverma@gmail.com>
 * @version 1.0.0
 */
 
 /*
 * Plugin Name:  Widget Bundle
 * Description:  A highly customizable wordPress widgets like: About ME, Button, Categories, Comments, Contact, Images, Links, Login and Register, Posts, Social, Text, Users and many more...
 * Version:      2.0.0
 * Author:       Devnath verma
 * Author Email: devnathverma@gmail.com
 * License:      GPLv2 or later
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  widget-bundle
 * Domain Path:  /languages/
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
 
/*----------------------------------------------------------------------------*
 * If this file is called directly, abort.
 *-----------------------------------------------------------------------------*/

if( ! defined( 'ABSPATH' ) ) {
	
	die( 'You are not allowed to call this page directly.' );
}

/**
 * Widget Bundle Plugin Define Constants.
 *
 * @since   1.0.0
 *
 * @package widget-bundle
 * @author  Devnath verma
 */
global $wpdb; 
define( 'WB4WP_PLUGIN_NAME', 'Widget Bundle' );
define( 'WB4WP_PHP_VERSION', '5.3' );
define( 'WB4WP_WP_VERSION', '4.8' );
define( 'WB4WP_PLUGIN_VERSION', '1.0.0' );	
define( 'WB4WP_PLUGIN_TEXTDOMAIN', 'widget-bundle' );	
define( 'WB4WP_PLUGIN_FOLDER', basename( dirname(__FILE__) ) );
define( 'WB4WP_PLUGIN_PATH', plugin_dir_path(__FILE__) );
define( 'WB4WP_PLUGIN_REL_PATH', dirname( plugin_basename( __FILE__ ) ) . '/' );
define( 'WB4WP_PLUGIN_ADMIN', WB4WP_PLUGIN_PATH.'admin'.'/' );
define( 'WB4WP_PLUGIN_PUBLIC', WB4WP_PLUGIN_PATH.'public'.'/' );	
define( 'WB4WP_PLUGIN_INCLUDES', WB4WP_PLUGIN_PATH.'includes'.'/' );
define( 'WB4WP_PLUGIN_MODULES', WB4WP_PLUGIN_INCLUDES.'modules'.'/' );	
define( 'WB4WP_PLUGIN_LANGUAGES', WB4WP_PLUGIN_PATH.'languages'.'/' );	
define( 'WB4WP_PLUGIN_URL', plugin_dir_url(WB4WP_PLUGIN_FOLDER).WB4WP_PLUGIN_FOLDER.'/' );
define( 'WB4WP_PLUGIN_CSS', WB4WP_PLUGIN_URL.'/assets/css'.'/' );
define( 'WB4WP_PLUGIN_JS', WB4WP_PLUGIN_URL.'/assets/js'.'/' );
define( 'WB4WP_PLUGIN_IMAGES', WB4WP_PLUGIN_URL.'/assets/images'.'/' );
define( 'WB4WP_PLUGIN_FONTS', WB4WP_PLUGIN_URL.'/assets/fonts'.'/' );

/**
 * The base-class of the plugin.
 * Defines the plugin, loads the text domain, holds the PHP function handling the Widget Bundle validation
 * enqueues the front-end specific stylesheet and JavaScript.
 *
 * @since   1.0.0
 *
 * @package widget-bundle
 * @author  Devnath verma
 */
if( ! class_exists('Widget_Bundle') ) {
	
	class Widget_Bundle {
		
		/**
		 * Instance of this class.
		 * @version  1.0.0
		 * @access   public
		 * @var      string $_widget_instance The plugin name to be used in the Widget Bundle Plugin.
		 */
		public static $_widget_instance;
		
		/**
		 * The options data to be used in the Widget Bundle Plugin.
		 * @version  1.0.0
		 * @access   public
		 * @var      string $widget_options The options data to be used in the Widget Bundle Plugin.
		 */
		public $widget_options;
		
		/**
		 * The settings class object to be used in the Widget Bundle Plugin.
		 * @version  1.0.0
		 * @access   public
		 * @var      string $widget_return_setting_object The settings class object to be used in the Widget Bundle Plugin.
		 */
		public $widget_setting_object;
		
		/**
		 * The class object to be used in the Widget Bundle Plugin.
		 * @since    1.0.0
		 * @access   public
		 * @var      string $widget_object The class object to be used in the Widget Bundle Plugin.
		 */
		public $widget_object;
	
		
		/**
		 * Return an instance of this class.
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @author  Devnath verma
		 */
		public static function widget_instance() {
			
			// If the single instance hasn't been set, set it now.
			if ( self::$_widget_instance === null )
			self::$_widget_instance = new self();
	
			return self::$_widget_instance;
		}
	
		/**
		 * Initialize the class and set its properties.
		 */
		public function __construct() {
	
			register_activation_hook( __FILE__, array( $this, 'widget_bundle_register_activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'widget_bundle_register_deactivation' ) );
			add_action( 'widgets_init' , array( $this, 'widget_bundle_register_init' ) );
			add_action( 'plugin_action_links', array( $this, 'widget_bundle_setting_links' ), 10, 2 );
			add_action( 'admin_print_styles', array( $this, 'widget_bundle_admin_styles') );
			add_action( 'wp_enqueue_scripts', array( $this, 'widget_bundle_public_styles' ) );
			$this->widget_bundle_internationalization_i18n();
			$this->widget_bundle_admin_hooks();
		}
		
		/**
		 * Register required widgets at wordpress admin area
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @author  Devnath verma
		 */
		public function widget_bundle_register_init() {
			
			if( isset( $this->widget_options['widget_options']['widget_types'] ) ) {
				
				if( $this->widget_options['widget_options']['widget_types']['widget_aboutme'] ) {
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-aboutme-widget.php';
					register_widget( 'WB4WP_Aboutme_Widgets' );		
				}
				
				if( $this->widget_options['widget_options']['widget_types']['widget_button'] ) {
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-button-widget.php';
					register_widget( 'WB4WP_Button_Widgets' );		
				}
				
				if( $this->widget_options['widget_options']['widget_types']['widget_categories'] ) {
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-categories-widget.php';
					register_widget( 'WB4WP_Categories_Widgets' );	
				}	
					
				if( $this->widget_options['widget_options']['widget_types']['widget_comments'] ) {
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-comments-widget.php';
					register_widget( 'WB4WP_Comments_Widgets' );
				}
				
				if( $this->widget_options['widget_options']['widget_types']['widget_contact'] ) {
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-contact-widget.php';
					register_widget( 'WB4WP_Contact_Widgets' );		
				}
				
				if( $this->widget_options['widget_options']['widget_types']['widget_image'] ) {
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-image-widget.php';
					register_widget( 'WB4WP_Image_Widgets' );
				}
				
				if( $this->widget_options['widget_options']['widget_types']['widget_links'] ) {
					add_filter( 'pre_option_link_manager_enabled', '__return_true' );
					add_action( 'load-link-add.php', array( $this, 'widget_bundle_load_link' ) );
        			add_action( 'load-link.php', array( $this, 'widget_bundle_load_link' ) );
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-links-widget.php';
					register_widget( 'WB4WP_Links_Widgets' );	
				}
				
				if( $this->widget_options['widget_options']['widget_types']['widget_login_register'] ) {
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-login-register-widget.php';
					register_widget( 'WB4WP_Login_Register_Widgets' );
				}
				
				if( $this->widget_options['widget_options']['widget_types']['widget_posts'] ) {
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-posts-widget.php';
					register_widget( 'WB4WP_Post_Widgets' );
				}	
				
				if( $this->widget_options['widget_options']['widget_types']['widget_social'] ) {
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-social-widget.php';
					register_widget( 'WB4WP_Social_Widgets' );		
				}
				
				if( $this->widget_options['widget_options']['widget_types']['widget_text'] ) {
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-text-widget.php';
					register_widget( 'WB4WP_Text_Widgets' );
				}	
				
				if( $this->widget_options['widget_options']['widget_types']['widget_users'] ) {
					include WB4WP_PLUGIN_INCLUDES . 'widget/class-users-widget.php';
					register_widget( 'WB4WP_Users_Widgets' );
				}
			}	
		}
		
		/**
	     * Required files includes for featured image
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @author  Devnath verma
	     */
		public function widget_bundle_load_link() { 
			
			include WB4WP_PLUGIN_INCLUDES . 'class-featured-image.php';
			new WB4WP_Featured_Link_Image();
		}
			
		/**
		 * Register all of the hooks related to the admin area functionality.
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @author  Devnath verma
		 */
		public function widget_bundle_admin_hooks() { 
			
			include WB4WP_PLUGIN_ADMIN . 'class-admin-settings.php';
			$this->widget_setting_object = new WB4WP_Admin_Settings( $this->widget_bundle_get_options() );
		}
	
		/**
		 * The code that runs during plugin activatation.
		 * This action is documented in includes/class-widget-activation.php
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @author  Devnath verma
		 */
		public function widget_bundle_register_activation() {
			
			if ( ! current_user_can( 'activate_plugins' ) ) return;
			include WB4WP_PLUGIN_INCLUDES . 'class-widget-activation.php';
			WB4WP_Register_Activator::widget_activate();
		}
	
		/**
		 * The code that runs during plugin deactivation.
		 * This action is documented in includes/class-widget-deactivation.php
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @author  Devnath verma
		 */
		public function widget_bundle_register_deactivation() {
			
			if ( ! current_user_can( 'activate_plugins' ) ) return;
			include WB4WP_PLUGIN_INCLUDES . 'class-widget-deactivation.php';
			WB4WP_Register_Dectivator::widget_dectivate();
		}
	
		/**
		 * Load the plugin text domain for translation.
		 * This action is documented in includes/class-widget-textdomain.php
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @author  Devnath verma
		 */
		public function widget_bundle_internationalization_i18n() {
			
			include WB4WP_PLUGIN_INCLUDES . 'class-widget-textdomain.php';
			WB4WP_Register_Textdomain::widget_textdomain();
		}
	
		/**
		 * Add links to settings page.
		 * @param array $widget_links
		 * @param string $widget_file
		 * @return array
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @author  Devnath verma
		 */
		public function widget_bundle_setting_links( $widget_links, $widget_file ) {
			
			if ( ! is_admin() || ! current_user_can( 'manage_options' ) )
			return $widget_links;
	
			static $plugin;
	
			$plugin = plugin_basename( __FILE__ );
	
			if ( $widget_file == $plugin ) {
				
				$settings_link = sprintf( '<a href="%s">%s</a>', admin_url( 'admin.php' ) . '?page=widget-bundle', __( 'Settings', 'widget-bundle' ) );
				array_unshift( $widget_links, $settings_link );
			}
	
			return $widget_links;
		}
				
		/**
		 * Register the scripts and stylesheets for the public-facing side of the site.
		 * This action is documented in assets/css/widget-bundle-public.css
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @author  Devnath verma
		 */
		public function widget_bundle_public_styles() {
			
			wp_enqueue_style( 'dashicons' );
			wp_enqueue_style( 'widget-bundle-public', WB4WP_PLUGIN_CSS . 'widget-bundle-public.css' );
		}
		
		/**
		 * Register the stylesheets for the admin-facing side of the site.
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @author  Devnath verma
		 */
		public function widget_bundle_admin_styles() {
			
			if( is_admin() ) { 
				
				wp_enqueue_style( 'widget-bundle-bootstrap', WB4WP_PLUGIN_CSS . 'widget-bundle-bootstrap.css' );
				wp_enqueue_style( 'widget-bundle-admin', WB4WP_PLUGIN_CSS . 'widget-bundle-admin.css' );
			}
		}
		
		/**
		 * Retrieve the options values number of the plugin.
		 *
		 * @since   1.0.0
		 *
		 * @package widget-bundle
		 * @author  Devnath verma
		 *
		 * @return    string    The options values of the plugin.
		 */
		public function widget_bundle_get_options() {
			
			if( get_option('widget_bundle_settings') )
			$this->widget_options = get_option('widget_bundle_settings');
			return $this->widget_options;
		}
	}
}	

/**
 * Checks if the system requirements are met
 * @return bool True if system requirements are met, false if not
 *
 * @since   1.0.0
 *
 * @package widget-bundle
 * @author  Devnath verma
 */
function widget_bundle_requirements() {
	
	global $wp_version;

	if ( version_compare( PHP_VERSION, WB4WP_PHP_VERSION, '<' ) ) {
		return false;
	}

	if ( version_compare( $wp_version, WB4WP_WP_VERSION, '<' ) ) {
		return false;
	}

	return true;
}

/**
 * Prints an error that the system requirements weren't met.
 *
 * @since   1.0.0
 *
 * @package widget-bundle
 * @author  Devnath verma
 */
function widget_bundle_requirements_error() {
	
	global $wp_version;
	
	include WB4WP_PLUGIN_INCLUDES . 'class-widget-requirements.php';
	WB4WP_Requirements_Error::widget_requirements();
}

/**
 * Check requirements and load main class
 * The main program needs to be in a separate file that only gets loaded if the plugin requirements are met. 
 * Otherwise older PHP installations could crash when trying to parse it.
 *
 * @since   1.0.0
 *
 * @package widget-bundle
 * @author  Devnath verma
 */
if ( widget_bundle_requirements() ) {
	
	/**
	 * The core plugin class that is used to define internationalization,
	 * admin-specific hooks, and public-facing site hooks.
	 *
	 * @since   1.0.0
	 *
	 * @package widget-bundle
	 * @author  Devnath verma
	 */	
	function Widget_Bundle() {
		
		static $widget_instance;

		//first call to widget_instance() initializes the plugin
		if ( $widget_instance === null || ! ($widget_instance instanceof WP_CAPTCHA) )
		$widget_instance = Widget_Bundle::widget_instance();
		
		return $widget_instance;
	}
	
	Widget_Bundle();
	
} else {
	
	// The action responsible for adding the admin notices when the plugin is first activated.
	add_action( 'admin_notices', 'widget_bundle_requirements_error' );
}