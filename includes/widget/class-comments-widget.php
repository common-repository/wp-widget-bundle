<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-comments-widget
 */

/**
 * The main widget class.
 *
 *
 * @since      1.0.0
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-comments-widget
 * @author     Devnath verma <devnathverma@gmail.com>
 */
if ( ! class_exists( 'WB4WP_Comments_Widgets' ) ) {

	/**
	 * Comments widget class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Comments_Widgets extends WP_Widget {
		
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
				'classname'   => 'wb-comment-widget',
				'description' => __( 'A widget that displays recent comments widget with extra features.', 'widget-bundle' ),
				'customize_selective_refresh' => true
			);
			
			// Control the width and height
			$control_options = array(
				'id_base' => 'wb-comment-widget'
			);
			
			// Create the widget
			parent::__construct( 'wb-comment-widget', 'WB Comments', $widget_options, $control_options );	
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
			
			include WB4WP_PLUGIN_INCLUDES . 'widget-form/widget-comments-form.php';
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
			$widget_recent_comments = $this->widget_recent_comments( $instance );
			
			// Output the theme's $before_widget wrapper.
			$widget_html .= $args['before_widget'];
			
			// If the title not empty, display it.
			if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) {
					
				$widget_html .= $args['before_title'] . $instance['title'] . $args['after_title'];
			}
			
			// If the comments not empty, display it.
			if ( $widget_recent_comments ) {
				
				$widget_html .= '<div class="wb4wp-container">';
				
				$widget_html .= $widget_recent_comments;
				
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
		public function widget_recent_comments( $instance ) {

			// Set up a default, empty variable.
			$comments_html = '';
		
			// Merge the input arguments and the defaults.
			$instance = wp_parse_args( (array) $instance, $this->widget_default_args() );
		
			// Extract the array to allow easy use of variables.
			extract( $instance );
		
			$query = array(
				'number'      => $instance['comment_limit'],
				'offset'      => $instance['comment_offset'],
				'order'       => $instance['comment_order'],
				'orderby'     => $instance['comment_order_by'],
				'post_status' => 'publish',
				'post_type'   => $instance['comment_post_type'],
				'status'      => $instance['comment_status']
			);
			
			// Get the comments.
			$comments = get_comments( $query );
			
			if ( ! empty( $comments ) ) :
				
				foreach( $comments as $comment ) : 
				
					$comments_html .= '<div class="wb4wp-container-inner wb4wp-avatar-align-'.$instance['comment_avatar_align'].' wb4wp-avatar-shape-'.$instance['comment_avatar_shape'].'">';
						
						if ( isset( $instance['comment_avatar'] ) && $instance['comment_avatar'] ) :
							$comments_html .= get_avatar( $comment->comment_author_email, $instance['comment_avatar_size'] );
						endif;
						
						if ( isset( $instance['comment_show_title'] ) && $instance['comment_show_title'] ) :
								$comments_html .= '<'.$instance['comment_title_tag'].' class="widget-bundle-title">';
								$comments_html .= get_comment_author_link( $comment->comment_ID );
								$comments_html .= '<span>&nbsp;on&nbsp;</span>';
								$comments_html .= '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">';
								$comments_html .= get_the_title( $comment->comment_post_ID );
								$comments_html .= '</a>';
								$comments_html .= '</'.$instance['comment_title_tag'].'>';
						endif;
						
						if ( isset( $instance['comment_excerpt'] ) && $instance['comment_excerpt'] ) :
							$comments_html .= '<p class="description">' . wp_trim_words( $comment->comment_content, absint( $instance['comment_excerpt_length'] ), '&hellip;' ) . '</span>';
						endif;
						
					$comments_html .= '</div>';
				endforeach;
			endif;
		
			wp_reset_postdata();
			return wp_kses_post( $comments_html );
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
			
			$name = get_post_types( array( 'public' => true ), 'names' );
			$types = array();
			
			if( ! empty( $new_instance['comment_post_type'] ) ) {
				
				foreach( $new_instance['comment_post_type'] as $type ) {
					
					if ( in_array( $type, $name ) ) {
						
						$types[] = $type;
					}
				}
			}
			
			if ( empty( $types ) ) {
				
				$types[] = 'post';
			}
			
			$instance = $old_instance;
			$instance['title'] = isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['comment_post_type'] 	= $types;
			$instance['comment_show_title'] = isset( $new_instance['comment_show_title'] ) ? (bool) $new_instance['comment_show_title']: false;	$instance['comment_title_tag'] 	= isset( $new_instance['comment_title_tag'] ) ? strip_tags( $new_instance['comment_title_tag'] ) : '';		
			$instance['comment_excerpt'] = isset( $new_instance['comment_excerpt'] ) ? (bool) $new_instance['comment_excerpt'] : false;		            $instance['comment_excerpt_length'] = (int)( $new_instance['comment_excerpt_length'] );
			$instance['comment_limit'] 		= (int)( $new_instance['comment_limit'] );
			$instance['comment_offset'] 	= (int)( $new_instance['comment_offset'] );
			$instance['comment_status'] 	= strip_tags( $new_instance['comment_status'] );
			$instance['comment_order'] 		= strip_tags( $new_instance['comment_order'] );
			$instance['comment_order_by'] 	= strip_tags( $new_instance['comment_order_by'] );
			$instance['comment_avatar'] = isset( $new_instance['comment_avatar'] ) ? (bool) $new_instance['comment_avatar'] : false;
			$instance['comment_avatar_size'] 	= (int)( $new_instance['comment_avatar_size'] );
			$instance['comment_avatar_align'] 	= strip_tags( $new_instance['comment_avatar_align'] );
			$instance['comment_avatar_shape'] 	= strip_tags( $new_instance['comment_avatar_shape'] );
			return $instance;
		}
		
		/**
		 * @return array default values
		 *
		 * @since 1.0.0
		 */				
		public function widget_default_args() {
			
			$widget_defaults['title'] 					= esc_attr__( 'Recent Comments', 'widget-bundle' );
			$widget_defaults['comment_post_type'] 		= array( 'post' );
			$widget_defaults['comment_show_title']    	= true;
			$widget_defaults['comment_title_tag']    	= 'h6';
			$widget_defaults['comment_excerpt'] 		= true;
			$widget_defaults['comment_excerpt_length'] 	= 10;
			$widget_defaults['comment_limit'] 			= 10;
			$widget_defaults['comment_offset'] 			= 0;
			$widget_defaults['comment_status'] 			= 'approve';
			$widget_defaults['comment_order'] 			= 'DESC';
			$widget_defaults['comment_order_by'] 		= 'comment_date';
			$widget_defaults['comment_avatar']        	= true;
			$widget_defaults['comment_avatar_size']   	= 80;
			$widget_defaults['comment_avatar_align']   	= 'left';
			$widget_defaults['comment_avatar_shape']   	= 'square';
			return $widget_defaults;
		}
	}
}