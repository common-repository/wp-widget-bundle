<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-button-widget
 */

/**
 * The main widget class.
 *
 *
 * @since      1.0.0
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-button-widget
 * @author     Devnath verma <devnathverma@gmail.com>
 */
if ( ! class_exists( 'WB4WP_Button_Widgets' ) ) {

	/**
	 * Button widget class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Button_Widgets extends WP_Widget {
		
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
				'classname'   => 'wb-button-widget',
				'description' => __( 'A widget that display the button.', 'widget-bundle' ),
				'customize_selective_refresh' => true
			);
			
			// Control the width and height
			$control_options = array(
				'id_base' => 'wb-button-widget'
			);
			
			// Create the widget
			parent::__construct( 'wb-button-widget', 'WB Button', $widget_options, $control_options );
			add_action( 'admin_print_scripts', array( $this, 'widget_bundle_button_scripts') );
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
			
			include WB4WP_PLUGIN_INCLUDES . 'widget-form/widget-button-form.php';
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
			$button_inline_style = '';
			extract( $args );
			$instance['title'] 	 = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'] );
			
			// Output the theme's $args['before_widget'] wrapper.
			$widget_html .= $args['before_widget'];
			
			// If the title not empty, display it.
			if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) {
					
				$widget_html .= $args['before_title'] . $instance['title'] . $args['after_title'];
			}
			
			if ( ! empty( $instance['button_background_color'] ) ) {
				
				$button_inline_style .= ' background-color: ' . $instance['button_background_color'] . ';';
			}
			
			if ( ! empty( $instance['button_border_width'] ) ) {
				
				$button_inline_style .= ' border-width: ' . $instance['button_border_width'] . 'px;';
			}
			
			if ( ! empty( $instance['button_border_style'] ) ) {
				
				$button_inline_style .= ' border-style: ' . $instance['button_border_style'] . ';';
			}
			
			if ( ! empty( $instance['button_border_color'] ) ) {
				
				$button_inline_style .= ' border-color: ' . $instance['button_border_color'] . ';';
			}
			
			if ( ! empty( $instance['button_text_size'] ) ) {
				
				$button_inline_style .= ' font-size: ' . $instance['button_text_size'] . 'px;';
			}
			
			if ( ! empty( $instance['button_text_color'] ) ) {
				
				$button_inline_style .= ' color: ' . $instance['button_text_color'] . ';';
			}
			
			if ( isset( $instance['button_text_bold'] ) && $instance['button_text_bold'] ) {
				
				$button_inline_style .= ' font-weight: bold;';
			}
			
			if ( isset( $instance['button_text_italic'] ) && $instance['button_text_italic'] ) {
				
				$button_inline_style .= ' font-style: italic;';
			}
			
			if ( isset( $instance['button_text_underline'] ) && $instance['button_text_underline'] ) {
				
				$button_inline_style .= ' text-decoration: underline;';
			}
			
			if ( ! empty( $instance['button_padding_top'] ) ) {
				
				$button_inline_style .= ' padding-top: ' . $instance['button_padding_top'] . 'px;';
			}
			
			if ( ! empty( $instance['button_padding_right'] ) ) {
				
				$button_inline_style .= ' padding-right: ' . $instance['button_padding_right'] . 'px;';
			}
			
			if ( ! empty( $instance['button_padding_bottom'] ) ) {
				
				$button_inline_style .= ' padding-bottom: ' . $instance['button_padding_bottom'] . 'px;';
			}
			
			if ( ! empty( $instance['button_padding_left'] ) ) {
				
				$button_inline_style .= ' padding-left: ' . $instance['button_padding_left'] . 'px;';
			}
			
			if ( ! empty ( $instance['button_link'] ) ) {
				
				$button_link = $instance['button_link'];
			
			} else {
				
				$button_link = '#';
			}
			
			// If the content not empty, display it.
			$widget_html .= '<div class="wb4wp-container">';
			
			$widget_html .= '<div class="wb4wp-container-inner wb4wp-widget-button">';
			
			if ( ! empty( $instance['button_text'] ) ) {
			
				$widget_html .= '<a href="'. $button_link.'" target="'.$instance['button_target'].'">'; 
			
				$widget_html .= $instance['button_text'];
			
				$widget_html .= '</a>';
			}
			
			$widget_html .= '</div>';
			
			$widget_html .= '</div>';
			
			// Close the theme's $args['after_widget'] wrapper.
			$widget_html .= $args['after_widget'];
			
			if ( ! empty( $button_inline_style ) ) {
				
				$button_inline_style = ' div.wb4wp-container div.wb4wp-widget-button a { ' . $button_inline_style . ' } ';
				wp_register_style( 'wb4wp_style_inline-' . $this->id, false );
				wp_enqueue_style( 'wb4wp_style_inline-' . $this->id );
				wp_add_inline_style( 'wb4wp_style_inline-' . $this->id, $button_inline_style );
			}
			
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
			$instance['title'] 			= isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['button_text'] 	= isset( $new_instance['button_text'] ) ? strip_tags( $new_instance['button_text'] ) : '';
			$instance['button_text_size'] 	= (int)( $new_instance['button_text_size'] );
			$instance['button_text_color'] 	= strip_tags( $new_instance['button_text_color'] );
			$instance['button_text_bold'] 	= isset( $new_instance['button_text_bold'] ) ? (bool) $new_instance['button_text_bold'] : false;		$instance['button_text_italic'] = isset( $new_instance['button_text_italic'] ) ? (bool) $new_instance['button_text_italic'] : false;	$instance['button_text_underline'] = isset( $new_instance['button_text_underline'] ) ? (bool) $new_instance['button_text_underline'] : false;
			$instance['button_link'] 	= isset( $new_instance['button_link'] ) ? strip_tags( $new_instance['button_link'] ) : '';
			$instance['button_target'] 	= strip_tags( $new_instance['button_target'] );
			$instance['button_shape'] 	= strip_tags( $new_instance['button_shape'] );
			$instance['button_background_color'] = strip_tags( $new_instance['button_background_color'] );
			$instance['button_border_width'] 	 = (int)( $new_instance['button_border_width'] );
			$instance['button_border_style'] 	 = strip_tags( $new_instance['button_border_style'] );
			$instance['button_border_color'] 	 = strip_tags( $new_instance['button_border_color'] );
			$instance['button_padding_top'] 	 = (int)( $new_instance['button_padding_top'] );
			$instance['button_padding_right'] 	 = (int)( $new_instance['button_padding_right'] );
			$instance['button_padding_bottom'] 	 = (int)( $new_instance['button_padding_bottom'] );
			$instance['button_padding_left'] 	 = (int)( $new_instance['button_padding_left'] );
			return $instance;
		}
		
		/**
		 * @return array default values
		 *
		 * @since 1.0.0
		 */		
		public function widget_default_args( ) {
			
			$widget_defaults['title'] 	= esc_attr__( 'Button Widget', 'widget-bundle' );
			$widget_defaults['button_text'] 			= '';
			$widget_defaults['button_text_size'] 		= 20;
			$widget_defaults['button_text_color'] 		= '#ffffff';
			$widget_defaults['button_text_bold'] 		= false;
			$widget_defaults['button_text_italic'] 		= false;
			$widget_defaults['button_text_underline'] 	= false;
			$widget_defaults['button_link'] 			= '';
			$widget_defaults['button_target'] 			= '_blank';
			$widget_defaults['button_shape'] 			= 'rounded';
			$widget_defaults['button_background_color'] = '#3498db';
			$widget_defaults['button_border_width'] 	= 1;
			$widget_defaults['button_border_style'] 	= 'solid';
			$widget_defaults['button_border_color'] 	= '#0071a1';
			$widget_defaults['button_padding_top'] 		= 10;
			$widget_defaults['button_padding_right'] 	= 15;
			$widget_defaults['button_padding_bottom'] 	= 10;
			$widget_defaults['button_padding_left'] 	= 15;
			return $widget_defaults;
		}
		
		/**
		 * Register the scripts for the admin facing side of the site.
		 *
		 * @since 1.0.0
		 */
		public function widget_bundle_button_scripts() {
			
			if( is_admin() ) { 
				
				global $wp_version;
				
				if ( 3.5 <= $wp_version ) {
				
					wp_enqueue_style( 'wp-color-picker' );
					wp_enqueue_script( 'wp-color-picker' );
				
				} else {
				
					wp_enqueue_style( 'farbtastic' );
					wp_enqueue_script( 'farbtastic' );
				}
				
				wp_enqueue_script( 'widget-bundle-button', WB4WP_PLUGIN_JS . 'widget-bundle-button.js', array('jquery') );
			}
		}
	}
}