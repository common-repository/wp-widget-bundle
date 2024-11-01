<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-links-widget
 */

/**
 * The main widget class.
 *
 *
 * @since      1.0.0
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-links-widget
 * @author     Devnath verma <devnathverma@gmail.com>
 */
if ( ! class_exists( 'WB4WP_Links_Widgets' ) ) {

	/**
	 * Links widget class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Links_Widgets extends WP_Widget {
		
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
				'classname'   => 'wb-link-widget',
				'description' => __( 'A widget that displays list of links.', 'widget-bundle' ),
				'customize_selective_refresh' => true
			);
			
			// Control the width and height
			$control_options = array(
				'id_base' => 'wb-link-widget'
			);
			
			// Create the widget
			parent::__construct( 'wb-link-widget', 'WB Links', $widget_options, $control_options );	
			add_action( 'admin_print_scripts', array( $this, 'widget_bundle_links_scripts') );
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
			
			$instance = wp_parse_args( (array) $instance, $this->widget_default_args() );
	
			// Extract the array to allow easy use of variables.
			extract( $instance );
			
			include WB4WP_PLUGIN_INCLUDES . 'widget-form/widget-links-form.php';  
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
			$widget_recent_links = $this->widget_recent_links( $instance );
			
			// Output the theme's $before_widget wrapper.
			$widget_html .= $args['before_widget'];
			
			// If the title not empty, display it.
			if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) {
					
				$widget_html .= $args['before_title'] . $instance['title'] . $args['after_title'];
			}
			
			// If the links not empty, display it.
			if ( $widget_recent_links ) {
				
				$widget_html .= '<div class="wb4wp-container">';
				
				$widget_html .= $widget_recent_links;
				
				$widget_html .= '</div>';
			}
			
			// Close the theme's widget wrapper.
			$widget_html .= $args['after_widget'];
			
			echo $widget_html;
		}
		
		/**
		 * Generate the widget output.
		 *
		 * This is typically done in the widget() method, but moving it to a
		 * separate method allows for the routine to be easily overloaded by a class
		 * extending this one without having to reimplement all the caching and
		 * filtering, or resorting to adding a filter, calling the parent method,
		 * then removing the filter.
		 *
		 * @since 1.0.0
		 *
		 * @param array   $instance The widget instance settings.
		 * @return string HTML output.
		 */
		public function widget_recent_links( $args = array() ) {

			// Set up a default, empty variable.
			$links_html = '';
		
			// Merge the input arguments and the defaults.
			$args = wp_parse_args( $args, $this->widget_default_args() );
		
			// Extract the array to allow easy use of variables.
			extract( $args );
		
			// Get the posts query.
			$query = array(
				'order'    => $args['link_order'],
				'orderby'  => $args['link_order_by'],
				'limit'    => $args['link_limit']
			);
			
			// Limit posts based on category.
			if ( ! empty( $args['link_categories'] ) )
			$query['category'] = $args['link_categories'];
						
			// Perform the query.
			$get_links = get_bookmarks( $query );
			
			if ( ! empty( $get_links ) ) :
				
				foreach ( $get_links as $get_link ) :
					
					$links_html .= '<div class="wb4wp-container-inner wb4wp-avatar-align-'.$args['link_image_align'].' wb4wp-avatar-shape-'.$args['link_image_shape'].'">';	
						
						if ( isset( $args['link_image'] ) && $args['link_image'] ) :
							$image_id = get_post_meta( $get_link->link_id, 'widget_bundle_link_image_id', true );
							if ( isset( $image_id ) && ! empty( $image_id ) ) :
								if ( isset( $args['link_image_size'] ) && $args['link_image_size'] == 'custom' ) :
									$links_html .= wp_get_attachment_image( $image_id, array( $args['link_image_width'], $args['link_image_height'] ), '', array( 'class' => 'avatar' ) );
								else :
									$links_html .= wp_get_attachment_image( $image_id, $args['link_image_size'], '', array( 'class' => 'avatar' ) );						endif;
							else :
								$links_html .= '';
							endif;
						endif;
						
						if ( isset( $args['link_title'] ) && $args['link_title'] ) :
							$links_html .= '<'.$args['link_title_tag'].' class="widget-bundle-title">';
							$links_html .= '<a href="' . esc_url( $get_link->link_url ) . '" target="' . esc_url( $get_link->link_target ) . '" rel="' . esc_url( $get_link->link_rel ) . '" title="' . esc_attr( $get_link->link_name ) . '">' . esc_attr( $get_link->link_name ) . '</a>';
							if( isset( $args['link_rating'] ) && $args['link_rating'] ) :
							$links_html .= '&nbsp;(&nbsp;'. $get_link->link_rating . '&nbsp;)&nbsp;';
							endif; 
							$links_html .= '</'.$args['link_title_tag'].'>';
						endif;
						
						if ( isset( $args['link_description'] ) && $args['link_description'] ) :	
							$links_html .= '<p class="description">'; 
							$links_html .= wp_trim_words( $get_link->link_description, absint( $args['link_description_length'] ), '&hellip;' );				$links_html .= '</p>';
						endif;
							
					$links_html .= '</div>';
				endforeach;
			endif;
		
			wp_reset_postdata();
			return wp_kses_post( $links_html );
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
			$instance['title'] 				= isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['link_title'] 		= isset( $new_instance['link_title'] ) ? (bool) $new_instance['link_title'] : false;
			$instance['link_title_tag'] 	= isset( $new_instance['link_title_tag'] ) ? strip_tags( $new_instance['link_title_tag'] ) : '';		$instance['link_rating'] 		= isset( $new_instance['link_rating'] ) ? (bool) $new_instance['link_rating'] : false;
			$instance['link_description'] 	= isset( $new_instance['link_description'] ) ? (bool) $new_instance['link_description'] : false;		$instance['link_description_length'] = (int)( $new_instance['link_description_length'] );
			$instance['link_image'] 		= isset( $new_instance['link_image'] ) ? (bool) $new_instance['link_image'] : false;
			$instance['link_image_size'] 	= strip_tags( $new_instance['link_image_size'] );
			$instance['link_image_width'] 	= (int)( $new_instance['link_image_width'] );
			$instance['link_image_height'] 	= (int)( $new_instance['link_image_height'] );
			$instance['link_image_align'] 	= strip_tags( $new_instance['link_image_align'] );
			$instance['link_image_shape'] 	= strip_tags( $new_instance['link_image_shape'] );
			$instance['link_order'] 		= strip_tags( $new_instance['link_order'] );
			$instance['link_order_by'] 		= strip_tags( $new_instance['link_order_by'] );
			$instance['link_limit'] 		= (int)( $new_instance['link_limit'] );
			$instance['link_categories'] 	= $new_instance['link_categories'];
			return $instance;
		}
		
		/**
		 * @return array default values
		 *
		 * @since 1.0.0
		 */			
		public function widget_default_args() {
			
			$widget_defaults['title'] 			  		= esc_attr__( 'Recents Links', 'widget-bundle' );
			$widget_defaults['link_title']		  		= true;
			$widget_defaults['link_title_tag']		  	= 'h6';
			$widget_defaults['link_rating']    	  		= false;
			$widget_defaults['link_description']  		= true;
			$widget_defaults['link_description_length'] = 10;
			$widget_defaults['link_image']        		= true;
			$widget_defaults['link_image_size']   		= 'custom';
			$widget_defaults['link_image_width']  		= 75;
			$widget_defaults['link_image_height'] 		= 75;
			$widget_defaults['link_image_align']  		= 'left';
			$widget_defaults['link_image_shape']  		= 'square';
			$widget_defaults['link_order']        		= 'DESC';
			$widget_defaults['link_order_by']     		= 'name';
			$widget_defaults['link_limit']     	  		= 10;
			$widget_defaults['link_categories']   		= array();
			return $widget_defaults;
		}
		
		/**
		 * Register the scripts for the admin facing side of the site.
		 *
		 * @since 1.0.0
		 */
		public function widget_bundle_links_scripts() {
			
			if( is_admin() ) { 
				
				wp_enqueue_script( 'widget-bundle-links', WB4WP_PLUGIN_JS . 'widget-bundle-links.js', array('jquery') );
			}
		}
	}
}