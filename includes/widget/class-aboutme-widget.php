<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-aboutme-widget
 */

/**
 * The main widget class.
 *
 *
 * @since      1.0.0
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-aboutme-widget
 * @author     Devnath verma <devnathverma@gmail.com>
 */
if ( ! class_exists( 'WB4WP_Aboutme_Widgets' ) ) {

	/**
	 * Aboutme widget class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Aboutme_Widgets extends WP_Widget {
		
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
				'classname'   => 'wb-aboutme-widget',
				'description' => __( 'A widget that display administrator profile with avatar.', 'widget-bundle' ),
				'customize_selective_refresh' => true
			);
			
			// Control the width and height
			$control_options = array(
				'id_base' => 'wb-aboutme-widget'
			);
			
			parent::__construct( 'wb-aboutme-widget', __( 'WB About Me', 'widget-bundle' ), $widget_options, $control_options );
			add_action( 'admin_print_scripts', array( $this, 'widget_bundle_aboutme_scripts') );
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
			
			include WB4WP_PLUGIN_INCLUDES . 'widget-form/widget-aboutme-form.php'; 
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
			$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'] );
	
			// Output the theme's $before_widget wrapper.
			$widget_html .= $args['before_widget'];
			
			// If the title not empty, display it.
			if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) {
					
				$widget_html .= $args['before_title'] . $instance['title'] . $args['after_title'];
			} 
			
			$widget_html .= '<div class="wb4wp-container">';
			$widget_html .= '<div class="wb4wp-avatar-align-'.$instance['aboutme_avatar_align'].' wb4wp-avatar-shape-'.$instance['aboutme_avatar_shape'].'">';
				
			$widget_html .= get_avatar( $instance['aboutme_administrator'], $instance['aboutme_avatar_size'] );
			
			$widget_html .= '<'.$instance['aboutme_title_tag'].' class="widget-bundle-title">';
			$userdata =	get_userdata( $instance['aboutme_administrator'] );
			$widget_html .= $userdata->display_name;
			$widget_html .= '</'.$instance['aboutme_title_tag'].'>';
					
			if( isset( $instance['aboutme_avatar_description'] ) && $instance['aboutme_avatar_description'] == 'custom_description' )
				$description = $instance['aboutme_custom_description'] ;
			else
				$description = get_the_author_meta( 'description', $instance['aboutme_administrator'] );
			
			$widget_html .= '<p class="description">';
			$widget_html .= $description; 
			if( isset( $instance['aboutme_extended_page'] ) && ! empty( $instance['aboutme_extended_page'] ) ) {
				$widget_html .= ' <a href="'. esc_url( get_permalink( $instance['aboutme_extended_page'] ) ) .'">';
				$widget_html .= $instance['aboutme_readmore_text'];
				$widget_html .= '</a>';
			} 
			$widget_html .= '</p>';
			
			$widget_html .= '</div>';
			$widget_html .= '</div>';
			
			// Close the theme's widget wrapper.
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
			$instance['title'] = isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['aboutme_administrator'] = strip_tags( $new_instance['aboutme_administrator'] );
			$instance['aboutme_title_tag'] 	= isset( $new_instance['aboutme_title_tag'] ) ? strip_tags( $new_instance['aboutme_title_tag'] ) : '';
			$instance['aboutme_avatar_size'] = (int)( $new_instance['aboutme_avatar_size'] );
			$instance['aboutme_avatar_align'] = strip_tags( $new_instance['aboutme_avatar_align'] );
			$instance['aboutme_avatar_shape'] = strip_tags( $new_instance['aboutme_avatar_shape'] );
			$instance['aboutme_avatar_description'] = strip_tags( $new_instance['aboutme_avatar_description'] );			 	            $instance['aboutme_custom_description'] = strip_tags( $new_instance['aboutme_custom_description'] );
			$instance['aboutme_extended_page'] = strip_tags( $new_instance['aboutme_extended_page'] );
			$instance['aboutme_readmore_text'] = strip_tags( $new_instance['aboutme_readmore_text'] );	
			return $instance;
		}
		
		/**
		 * @return array default values
		 *
		 * @since 1.0.0
		 */	
		public function widget_default_args() {
			
			$widget_defaults['title'] 						= esc_attr__( 'About Me', 'widget-bundle' );
			$widget_defaults['aboutme_administrator'] 		= '';
			$widget_defaults['aboutme_title_tag']		  	= 'h6';
			$widget_defaults['aboutme_avatar_size']   		= 75;
			$widget_defaults['aboutme_avatar_align']  		= 'left';
			$widget_defaults['aboutme_avatar_shape']  		= 'square';
			$widget_defaults['aboutme_avatar_description'] 	= 'author_bio';
			$widget_defaults['aboutme_custom_description'] 	= '';
			$widget_defaults['aboutme_extended_page'] 		= '';
			$widget_defaults['aboutme_readmore_text'] 		= __( 'Read More &raquo;', 'widget-bundle' );
			return $widget_defaults;
		}
		
		/**
		 * Register the scripts for the admin facing side of the site.
		 *
		 * @since 1.0.0
		 */
		public function widget_bundle_aboutme_scripts() {
			
			if( is_admin() ) { 
				
				wp_enqueue_script( 'widget-bundle-aboutme', WB4WP_PLUGIN_JS . 'widget-bundle-aboutme.js', array('jquery') );
			}
		}
	}
}