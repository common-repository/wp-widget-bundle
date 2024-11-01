<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-users-widget
 */

/**
 * The main widget class.
 *
 *
 * @since      1.0.0
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-users-widget
 * @author     Devnath verma <devnathverma@gmail.com>
 */
if ( ! class_exists( 'WB4WP_Users_Widgets' ) ) {

	/**
	 * Users widget class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Users_Widgets extends WP_Widget {
		
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
				'classname'   => 'wb-users-widget',
				'description' => __( 'A widget that display the users.', 'widget-bundle' ),
				'customize_selective_refresh' => true
			);
			
			// Control the width and height
			$control_options = array(
				'id_base' => 'wb-users-widget'
			);
			
			// Create the widget
			parent::__construct( 'wb-users-widget', 'WB Users', $widget_options, $control_options );
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
			
			global $wp_roles;
			
			// Merge the user selected arguments with the defaults.
			$instance = wp_parse_args( (array) $instance, $this->widget_default_args() );
	
			// Extract the array to allow easy use of variables.
			extract( $instance ); 
			
			include WB4WP_PLUGIN_INCLUDES . 'widget-form/widget-users-form.php';
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
			$widget_recent_users = $this->widget_recent_users( $instance );
			
			// Output the theme's $args['before_widget'] wrapper.
			$widget_html .= $args['before_widget'];
			
			// If the title not empty, display it.
			if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) {
					
				$widget_html .= $args['before_title'] . $instance['title'] . $args['after_title'];
			}
			
			// If the users not empty, display it.
			if ( $widget_recent_users ) {
				
				$widget_html .= '<div class="wb4wp-container">';
				
				$widget_html .= $widget_recent_users;
				
				$widget_html .= '</div>';
			}
			
			// Close the theme's $args['after_widget'] wrapper.
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
		public function widget_recent_users( $instance ) {

			// Set up a default, empty variable.
			$users_html = '';
		
			// Merge the input arguments and the defaults.
			$instance = wp_parse_args( (array) $instance, $this->widget_default_args() );
		
			// Extract the array to allow easy use of variables.
			extract( $instance );
			
			if( isset( $instance['users_roles'] ) && is_array( $instance['users_roles'] ) ) {
		
				foreach ( $instance['users_roles'] as $users_role ) {
					
					$user_args['role'] 		= $users_role;
					$user_args['order']   	= $instance['users_order'];
					$user_args['orderby'] 	= $instance['users_order_by'];
					$user_args['number'] 	= $instance['users_limit']; 
					
					if( isset( $instance['users_include_exclude'] ) && $instance['users_include_exclude'] == 'include' ) {
				
						if( ! empty( $instance['users_id'] ) )
							$user_args['include'] = $instance['users_id'];
						else
							$user_args['include'] = '';
					}
					
					if( isset( $instance['users_include_exclude'] ) && $instance['users_include_exclude'] == 'exclude' ) {
						
						if( ! empty( $instance['users_id'] ) )
							$user_args['exclude'] = $instance['users_id'];
						else
							$user_args['exclude'] = '';
					}
					
					$user_query = new WP_User_Query( $user_args );
					
					if ( ! empty( $user_query->results ) ) {
						
						foreach ( $user_query->results as $user ) { 
							
							$users_html .= '<div class="wb4wp-container-inner wb4wp-avatar-align-'.$instance['users_avatar_align'].' wb4wp-avatar-shape-'.$instance['users_avatar_shape'].'">';
									
									if( isset( $instance['users_avatar'] ) && $instance['users_avatar'] ) :
										$users_html .= get_avatar( $user->ID, $instance['users_avatar_size'] );
									endif; 
										 
									if( isset( $instance['users_name'] ) && $instance['users_name'] ) : 
										$users_html .='<'.$instance['users_name_tag'].' class="widget-bundle-title">';  
										if( ! empty( get_the_author_meta( 'display_name', $user->ID ) ) ) :
										$users_html .= get_the_author_meta( 'display_name', $user->ID ); 
										endif;
										$users_html .='</'.$instance['users_name_tag'].'>';  
									endif; 
									
									if( isset( $instance['users_bio'] ) && $instance['users_bio'] ) :							
										$users_html .='<p class="description">';  
										if( ! empty( get_the_author_meta( 'description', $user->ID ) ) ) :
											$users_html .= wp_trim_words( get_the_author_meta( 'description', $user->ID ), absint( $instance['users_bio_length'] ), '&hellip;' ) ;
										endif;
										$users_html .='</p>'; 
									endif;
									
									if( isset( $instance['users_email'] ) && $instance['users_email'] ) :
										if( ! empty( get_the_author_meta( 'email', $user->ID ) ) ) :
										$users_html .= '<span class="wb4wp-email">';
										$users_html .= '<a href="mailto:'.get_the_author_meta('email',$user->ID ).'" target="_blank">';
										$users_html .= '&nbsp;' . get_the_author_meta( 'email', $user->ID ) .'<br />'; 
										$users_html .= '</a>'; 
										$users_html .= '</span>';
										endif;
									endif; 
									
									if( isset( $instance['users_website'] ) && $instance['users_website'] ) : 
										if( ! empty( get_the_author_meta( 'url', $user->ID ) ) ) :
										$users_html .= '<span class="wb4wp-website">';
										$users_html .= '<a href="'.get_the_author_meta( 'url', $user->ID ).'" target="_blank">';
										$users_html .= '&nbsp;' . get_the_author_meta( 'url', $user->ID ) .'<br />'; 
										$users_html .= '</a>';
										$users_html .= '</span>';
										endif;
									endif;
									
							$users_html .='</div>';
						}
					}
				}
			}		
		
			wp_reset_postdata();
			return wp_kses_post( $users_html );
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
			
			global $wp_roles;
			$users_name = $wp_roles->get_names();
			$users_roles = array();
			
			if( ! empty( $new_instance['users_roles'] ) ) {
				
				foreach( $new_instance['users_roles'] as $roles ) {
					
					if ( in_array( $roles, $users_name ) ) {
						
						$users_roles[] = $roles;
					}
				}
			}
			
			$instance = $old_instance;
			$instance['title'] 				= isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['users_roles'] 		= $users_roles;
			$instance['users_name'] 		= isset( $new_instance['users_name'] ) ? (bool) $new_instance['users_name'] : false;
			$instance['users_name_tag'] 	= isset($new_instance['users_name_tag'])?strip_tags($new_instance['users_name_tag']):'';			            $instance['users_avatar'] 		= isset( $new_instance['users_avatar'] ) ? (bool) $new_instance['users_avatar'] : false;
			$instance['users_avatar_size'] 	= (int)( $new_instance['users_avatar_size'] );
			$instance['users_avatar_align'] = strip_tags( $new_instance['users_avatar_align'] );
			$instance['users_avatar_shape'] = strip_tags( $new_instance['users_avatar_shape'] );
			$instance['users_bio'] 			= isset( $new_instance['users_bio'] ) ? (bool) $new_instance['users_bio'] : false;
			$instance['users_bio_length'] 	= (int)( $new_instance['users_bio_length'] );
			$instance['users_order'] 	  	= strip_tags( $new_instance['users_order'] );
			$instance['users_order_by'] 	= strip_tags( $new_instance['users_order_by'] );
			$instance['users_limit']		= (int)( $new_instance['users_limit'] );
			$instance['users_email']   		= isset( $new_instance['users_email'] ) ? (bool) $new_instance['users_email'] : false;
			$instance['users_website'] 		= isset( $new_instance['users_website'] ) ? (bool) $new_instance['users_website'] : false;		
			$instance['users_include_exclude']  = strip_tags( $new_instance['users_include_exclude'] );
			$instance['users_id']			= isset( $new_instance['users_id'] ) ? strip_tags( $new_instance['users_id'] ) : '';						            return $instance;
		}
		
		/**
		 * @return array default values
		 *
		 * @since 1.0.0
		 */			
		public function widget_default_args( ) {
			
			$widget_defaults['title'] 	= esc_attr__( 'Recent Users', 'widget-bundle' );
			$widget_defaults['users_roles']        		= array();
			$widget_defaults['users_name']      		= true;
			$widget_defaults['users_name_tag']		  	= 'h6';
			$widget_defaults['users_avatar']    		= true;
			$widget_defaults['users_avatar_size']    	= 80;
			$widget_defaults['users_avatar_align'] 		= 'left';
			$widget_defaults['users_avatar_shape'] 		= 'square';
			$widget_defaults['users_bio']     			= true;
			$widget_defaults['users_bio_length']   		= 10;
			$widget_defaults['users_order']            	= 'DESC';
			$widget_defaults['users_order_by']          = 'ID';
			$widget_defaults['users_limit']            	= 10;
			$widget_defaults['users_email']         	= true;
			$widget_defaults['users_website']       	= true;
			$widget_defaults['users_include_exclude'] 	= '';
			$widget_defaults['users_id'] 				= '';
			return $widget_defaults;
		}
	}
}