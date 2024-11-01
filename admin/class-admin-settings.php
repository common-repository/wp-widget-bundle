<?php
/**
 * This class defines all necessary settings for the plugin's.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/admin/class-admin-settings
 * @author     Devnath verma <devnathverma@gmail.com>
 */
 
class WB4WP_Admin_Settings {
	
	public $widget_options;
	public $widget_messages = '';
	public $widget_setting_messages;

	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct( $widget_options ) {
		
		add_action( 'admin_menu', array( $this, 'widget_bundle_register_menu' ) );
		$this->widget_options 	=  $widget_options;
		$this->widget_setting_messages = array(
			'save_settings'	 	=> 	__( 'Settings save successfully.', 'widget-bundle' ),
			'update_settings'	=> 	__( 'Settings restore successfully.', 'widget-bundle' )
		);
	}

	/**
	 * Create our " Widget Bundle " page as a Admin Menus page
 	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	public function widget_bundle_register_menu() {
		
		add_menu_page(
			__( 'Widget Bundle', 'widget-bundle' ), 
			__( 'Widget Bundle', 'widget-bundle' ), 
			'manage_options', 
			'widget-bundle', 
			array( &$this, 'widget_bundle_menu_page' ),
			'dashicons-archive'
		);
	}
	
	/**
	 * Render Widget Bundle options page.
 	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	public function widget_bundle_menu_page() { 
		
		$widget_messages = $this->widget_bundle_settings_validate( $this->widget_messages );
		include WB4WP_PLUGIN_ADMIN . 'view/class-admin-wizard.php';
		WB4WP_Admin_Wizard::wb4wp_wizard( Widget_Bundle()->widget_bundle_get_options(), $widget_messages );
	}
	
	/**
	 * The function widget_settings_validate() , " save " and " restore defaults " settings.
 	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	public function widget_bundle_settings_validate( $widget_messages ) {
		
		if ( isset( $_POST['widget_types_submit'] ) ) { 
			
			$widget_bundle_settings 	= 	array(
				'widget_options'	=> 	array(
					'widget_types' 	=>	array(
						'widget_aboutme'    	=>  isset( $_POST['widget_options']['widget_types']['widget_aboutme'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_aboutme'] : false,
						'widget_button'    		=>  isset( $_POST['widget_options']['widget_types']['widget_button'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_button'] : false,
						'widget_categories'  	=>  isset( $_POST['widget_options']['widget_types']['widget_categories'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_categories'] : false,
						'widget_comments'    	=>  isset( $_POST['widget_options']['widget_types']['widget_comments'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_comments'] : false,
						'widget_contact'    	=>  isset( $_POST['widget_options']['widget_types']['widget_contact'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_contact'] : false,
						'widget_image' 	  		=>  isset( $_POST['widget_options']['widget_types']['widget_image'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_image'] : false,
						'widget_links'    	  	=>  isset( $_POST['widget_options']['widget_types']['widget_links'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_links'] : false,
						'widget_login_register' =>  isset( $_POST['widget_options']['widget_types']['widget_login_register'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_login_register'] : false,
						'widget_posts' 			=>  isset( $_POST['widget_options']['widget_types']['widget_posts'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_posts'] : false,
						'widget_social'    		=>  isset( $_POST['widget_options']['widget_types']['widget_social'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_social'] : false,
						'widget_text'    	  	=>  isset( $_POST['widget_options']['widget_types']['widget_text'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_text'] : false,
						'widget_users'    		=>  isset( $_POST['widget_options']['widget_types']['widget_users'] ) ? (bool) $_POST['widget_options']['widget_types']['widget_users'] : false
					),
				),			
			);
			
            update_option( 'widget_bundle_settings', $widget_bundle_settings );
            return $widget_messages = $this->widget_setting_messages['save_settings'];
		}
	}
}