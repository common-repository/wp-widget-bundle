<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-contact-widget
 */

/**
 * The main widget class.
 *
 *
 * @since      1.0.0
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-contact-widget
 * @author     Devnath verma <devnathverma@gmail.com>
 */
if ( ! class_exists( 'WB4WP_Contact_Widgets' ) ) {

	/**
	 * Contact widget class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Contact_Widgets extends WP_Widget {
		
		/**
		 * Setup widget options.
		 *
		 * Child classes may override the defaults.
		 *
		 * @since 1.0.0
		 * @see   WP_Widget::construct()
		 *
		 * @param string $id_base Optional Base ID for the widget, lower case, if
		 *     left empty a portion of the widget's class name will be used. Must be unique.
		 * @param string $name Name for the widget displayed on the configuration page.
		 * @param array  $widget_options {
		 *     Widget options. Passed to wp_register_sidebar_widget(). Optional.
		 *
		 *	   @type string $description Widget description. Shown on the configuration page.
		 *	   @type string $classname   HTML class.
		 * }
		 * @param array $control_options {
		 *     Passed to wp_register_widget_control(). Optional.
		 *
		 *	   @type int $width  Width of the widget edit form.
		 * )
		 */
		public function __construct() {
			
			// Set up the widget options.
			$widget_options = array(
				'classname'   => 'wb-contact-widget',
				'description' => __( 'A widget that display Contact.', 'widget-bundle' ),
				'customize_selective_refresh' => true
			);
			
			// Control the width and height
			$control_options = array(
				'id_base' => 'wb-contact-widget'
			);
			
			// Create the widget
			parent::__construct( 'wb-contact-widget', 'WB Contact US', $widget_options, $control_options );
		}
		
		/**
		 * Method is used to add setting fields to the widget which will be 
	 	 * displayed in the WordPress admin area
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance The widget settings.
		 */
		public function form( $instance ) {
			
			// Merge the user selected arguments with the defaults.
			$instance = wp_parse_args( (array) $instance, $this->widget_default_args() );
	
			// Extract the array to allow easy use of variables.
			extract( $instance ); 
			
			include WB4WP_PLUGIN_INCLUDES . 'widget-form/widget-contact-form.php';
		}
		
		/**
		 * Method to define the widget output that will be displayed on the site front end.
		 *
		 * Filters the instance data, fetches the output, displays it.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Registered sidebar arguments including before_title, after_title, before_widget, and after_widget.
		 * @param array $instance The widget instance settings.
		 */
		public function widget( $args, $instance ) {
			
			$widget_html = '';
			extract( $args );
			$instance['title'] 	 = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'] );
			
			// Output the theme's $args['before_widget'] wrapper.
			$widget_html .= $args['before_widget'];
			
			// If the title not empty, display it.
			if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) {
					
				$widget_html .= $args['before_title'] . $instance['title'] . $args['after_title'];
			}
			
			// If the content not empty, display it.
			$widget_html .= '<div class="wb4wp-container">';
			
				if ( isset( $instance['contact_company_name'] ) && ! empty( $instance['contact_company_name'] ) ) {
					
					$widget_html .= '<div class="wb4wp-contact-row">';
					
					if ( isset( $instance['contact_icon_label'] ) && $instance['contact_icon_label'] == 'icon' )
						$widget_html .= '<i class="wb4wp-contact-icon wb4wp-company"></i>';
					else
						$widget_html .= '<strong>' . __( 'Company : ', 'widget-bundle' ) . '</strong>';
					
					$widget_html .= $instance['contact_company_name'];
					$widget_html .= '</div>';
				}
				
				if ( isset( $instance['contact_address'] ) && ! empty( $instance['contact_address'] ) ) {
					
					$widget_html .= '<div class="wb4wp-contact-row">';
					
					if ( isset( $instance['contact_icon_label'] ) && $instance['contact_icon_label'] == 'icon' )
						$widget_html .= '<i class="wb4wp-contact-icon wb4wp-address"></i>';
					else
						$widget_html .= '<strong>' . __( 'Address : ', 'widget-bundle' ) . '</strong>';
					
					$widget_html .= stripslashes( $instance['contact_address'] );
					$widget_html .= '</div>';
				}
				
				if ( isset( $instance['contact_phone'] ) && ! empty( $instance['contact_phone'] ) ) {		
				
					$widget_html .= '<div class="wb4wp-contact-row">';
					
					if ( isset( $instance['contact_icon_label'] ) && $instance['contact_icon_label'] == 'icon' )
						$widget_html .= '<i class="wb4wp-contact-icon wb4wp-phone"></i>';
					else
						$widget_html .= '<strong>' . __( 'Phone : ', 'widget-bundle' ) . '</strong>';
					
					$widget_html .= '<a href="tel:'.$instance['contact_phone'].'" target="_blank">';
					$widget_html .= $instance['contact_phone'];
					$widget_html .= '</a>';
					$widget_html .= '</div>';
				}
				
				if ( isset( $instance['contact_mobile'] ) && ! empty( $instance['contact_mobile'] ) ) {		
				
					$widget_html .= '<div class="wb4wp-contact-row">';
					
					if ( isset( $instance['contact_icon_label'] ) && $instance['contact_icon_label'] == 'icon' )
						$widget_html .= '<i class="wb4wp-contact-icon wb4wp-mobile"></i>';
					else
						$widget_html .= '<strong>' . __( 'Mobile : ', 'widget-bundle' ) . '</strong>';
					
					$widget_html .= '<a href="tel:'.$instance['contact_mobile'].'" target="_blank">';
					$widget_html .= $instance['contact_mobile'];
					$widget_html .= '</a>';
					$widget_html .= '</div>';
				}
				
				if ( isset( $instance['contact_email'] ) && ! empty( $instance['contact_email'] ) ) {		
				
					$widget_html .= '<div class="wb4wp-contact-row">';
					
					if ( isset( $instance['contact_icon_label'] ) && $instance['contact_icon_label'] == 'icon' )
						$widget_html .= '<i class="wb4wp-contact-icon wb4wp-email"></i>';
					else
						$widget_html .= '<strong>' . __( 'Email : ', 'widget-bundle' ) . '</strong>';
					
					$widget_html .= '<a href="mailto:'.$instance['contact_email'].'" target="_blank">';
					$widget_html .= $instance['contact_email'];
					$widget_html .= '</a>';
					$widget_html .= '</div>';
				}
				
				if ( isset( $instance['contact_fax'] ) && ! empty( $instance['contact_fax'] ) ) {		
				
					$widget_html .= '<div class="wb4wp-contact-row">';
					
					if ( isset( $instance['contact_icon_label'] ) && $instance['contact_icon_label'] == 'icon' )
						$widget_html .= '<i class="wb4wp-contact-icon wb4wp-fax"></i>';
					else
						$widget_html .= '<strong>' . __( 'Fax : ', 'widget-bundle' ) . '</strong>';
					
					$widget_html .= $instance['contact_fax'];
					$widget_html .= '</div>';
				}
				
				if ( isset( $instance['contact_website'] ) && ! empty( $instance['contact_website'] ) ) {		
				
					$widget_html .= '<div class="wb4wp-contact-row">';
					
					if ( isset( $instance['contact_icon_label'] ) && $instance['contact_icon_label'] == 'icon' )
						$widget_html .= '<i class="wb4wp-contact-icon wb4wp-website"></i>';
					else
						$widget_html .= '<strong>' . __( 'Website : ', 'widget-bundle' ) . '</strong>';
					
					$widget_html .= '<a href="'.$instance['contact_website'].'" target="_blank">';
					$widget_html .= $instance['contact_website'];
					$widget_html .= '</a>';
					$widget_html .= '</div>';
				}	
												
			$widget_html .= '</div>';
			
		
			// Close the theme's $args['after_widget'] wrapper.
			$widget_html .= $args['after_widget'];
			
			echo $widget_html;
		}
		
		/**
		 * Method is used to update the widget settings in the WordPress database
		 *
		 * @since 1.0.0
		 *
		 * @param array  $new_instance New widget settings.
		 * @param array  $old_instance Previous widget settings.
		 * @return array Sanitized settings.
		 */
		public function update( $new_instance, $old_instance ) {
		
			$instance = $old_instance;
			$instance['title'] = isset($new_instance['title'])?strip_tags($new_instance['title']):'';
			$instance['contact_company_name'] = isset($new_instance['contact_company_name'])?strip_tags($new_instance['contact_company_name']):'';
			$instance['contact_address'] 	= isset($new_instance['contact_address'])?strip_tags($new_instance['contact_address']):'';
			$instance['contact_email'] 		= isset($new_instance['contact_email'])?strip_tags($new_instance['contact_email']):'';
			$instance['contact_fax'] 		= isset($new_instance['contact_fax'])?strip_tags($new_instance['contact_fax']):'';
			$instance['contact_phone'] 		= isset($new_instance['contact_phone'])?strip_tags($new_instance['contact_phone']):'';
			$instance['contact_mobile'] 	= isset($new_instance['contact_mobile'])?strip_tags($new_instance['contact_mobile']):'';				            $instance['contact_website'] 	= isset($new_instance['contact_website'])?strip_tags($new_instance['contact_website']):'';
			$instance['contact_icon_label'] = isset($new_instance['contact_icon_label'])?strip_tags($new_instance['contact_icon_label']):'';		return $instance;
		}
		
		/**
		 * @return array default values
		 *
		 * @since 1.0.0
		 */	
		public function widget_default_args( ) {
			
			$widget_defaults['title'] 	= esc_attr__( 'Contact US', 'widget-bundle' );
			$widget_defaults['contact_company_name'] 	= '';
			$widget_defaults['contact_address'] 		= '';
			$widget_defaults['contact_email'] 			= '';
			$widget_defaults['contact_phone'] 			= '';
			$widget_defaults['contact_mobile'] 			= '';
			$widget_defaults['contact_fax'] 			= '';
			$widget_defaults['contact_website'] 		= '';
			$widget_defaults['contact_icon_label'] 		= 'icon';
			return $widget_defaults;
		}
	}
}