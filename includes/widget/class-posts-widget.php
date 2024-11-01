<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-posts-widget
 */

/**
 * The main widget class.
 *
 *
 * @since      1.0.0
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-posts-widget
 * @author     Devnath verma <devnathverma@gmail.com>
 */
if ( ! class_exists( 'WB4WP_Post_Widgets' ) ) {

	/**
	 * Posts widget class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Post_Widgets extends WP_Widget {
		
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
			
			// Set up the widget options
			$widget_options = array(
				'classname'   => 'wb-posts-widget',
				'description' => __( 'A widget that gives you total control over the output of your site Posts.', 'widget-bundle' ),
				'customize_selective_refresh' => true
			);
			
			// Control the width and height
			$control_options = array(
				'id_base' => 'wb-posts-widget'
			);
			
			// Create the widget
			parent::__construct( 'wb-posts-widget', 'WB Posts',	$widget_options, $control_options );
			add_action( 'admin_print_scripts', array( $this, 'widget_bundle_posts_scripts') );
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
			
			include WB4WP_PLUGIN_INCLUDES . 'widget-form/widget-posts-form.php';	
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
			$widget_recent_posts = $this->widget_recent_posts( $instance );
			
			// Output the theme's $before_widget wrapper.
			$widget_html .= $args['before_widget'];
			
			// If the title not empty, display it.
			if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) {
					
				$widget_html .= $args['before_title'] . $instance['title'] . $args['after_title'];
			}
			
			// If the posts not empty, display it.
			if ( $widget_recent_posts ) {
				
				$widget_html .= '<div class="wb4wp-container">';
				
				$widget_html .= $widget_recent_posts;
				
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
		public function widget_recent_posts( $instance ) {

			// Set up a default, empty variable.
			$posts_html = '';
		
			// Merge the input arguments and the defaults.
			$instance = wp_parse_args( (array) $instance, $this->widget_default_args() );
		
			// Extract the array to allow easy use of variables.
			extract( $instance );
		
			// Get the posts query.
			$query = array(
				'offset'              => $instance['post_offset'],
				'posts_per_page'      => $instance['post_limit'],
				'orderby'             => $instance['post_order_by'],
				'order'               => $instance['post_order'],
				'post_type'           => $instance['post_type'],
				'post_status'         => $instance['post_status'],
				'ignore_sticky_posts' => $instance['post_ignore_sticky'],
			);
		
			// Limit posts based on category.
			if ( ! empty( $instance['post_categories'] ) )
			$query['category__in'] = $instance['post_categories'];
		
			// Limit posts based on post tag.
			if ( ! empty( $instance['post_tags'] ) )
			$query['tag__in'] = $instance['post_tags'];
		
			// Perform the query.
			$widget_posts = new WP_Query( $query );
			
			if ( $widget_posts->have_posts() ) :
				
				while ( $widget_posts->have_posts() ) : $widget_posts->the_post();
					
					$posts_html .= '<div class="wb4wp-container-inner wb4wp-avatar-align-'.$instance['post_thumbnail_align'].' wb4wp-avatar-shape-'.$instance['post_thumbnail_shape'].'">';	
						
						if ( isset( $instance['post_thumbnail'] ) && $instance['post_thumbnail'] ) :
							if( get_the_post_thumbnail() ) :
								if ( isset( $instance['post_thumbnail_size'] ) && $instance['post_thumbnail_size'] == 'custom' ) :
									$posts_html .= get_the_post_thumbnail( get_the_ID(), array( $instance['post_thumbnail_width'], $instance['post_thumbnail_height'] ), array( 'class' => 'avatar' ) );
								else :
									$posts_html .= get_the_post_thumbnail( get_the_ID(), $instance['post_thumbnail_size'], array( 'class' => 'avatar' ) );		endif;
							else :
								$posts_html .= '';
							endif;
						endif;
						
						if ( isset( $instance['post_title'] ) && $instance['post_title'] ) :
							$posts_html .= '<'.$instance['post_title_tag'].' class="widget-bundle-title">';
							$posts_html .= '<a href="' . esc_url( get_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'widget-bundle' ), the_title_attribute( 'echo=0' ) ) . '">' . esc_attr( get_the_title() ) . '</a>';
							$posts_html .= '</'.$instance['post_title_tag'].'>';
						endif;
						
						if ( $instance['post_show_date'] || $instance['post_show_author'] ) :
							if ( isset( $instance['post_show_date'] ) && $instance['post_show_date'] ) :
								$posts_html .= '<span class="wb4wp-post-icon wb4wp-calendar">';
								$posts_html .= '<a href="'.get_permalink().'">'.get_the_date().'</a>'; 
								$posts_html .= '</span>';
							endif;
							
							if ( isset( $instance['post_show_author'] ) && $instance['post_show_author'] ) :
								$posts_html .= '<span class="wb4wp-post-icon wb4wp-user">';
								$posts_html .= '<a href="'.get_author_posts_url(get_the_author_meta('ID')).'">';
								$posts_html .= get_the_author();
								$posts_html .= '</a>';
								$posts_html .= '</span>';
							endif;
						endif;
								
						if ( isset( $instance['post_excerpt'] ) && $instance['post_excerpt'] ) :	
							$posts_html .= '<p class="description">'; 
								$posts_html .= wp_trim_words( get_the_excerpt(), absint( $instance['post_excerpt_length'] ), '&hellip;' );
								if ( isset( $instance['post_readmore'] ) && $instance['post_readmore'] ) :
									$posts_html .= '<a href="' . esc_url( get_permalink() ) . '">';
									$posts_html .= $instance['post_readmore_text'];
									$posts_html .= '</a>';
								endif;
							$posts_html .= '</p>'; 
						endif;
						
						if ( $instance['post_show_categories'] || $instance['post_show_tags'] || $instance['post_show_count'] ) :	
								
								if ( isset( $instance['post_show_categories'] ) && $instance['post_show_categories'] ) :
									$categories_list = get_the_category_list( __( ', ', 'widget-bundle' ) );
									if( $categories_list ) :
										$posts_html .= '<span class="wb4wp-post-icon wb4wp-categories">';
										$posts_html .= $categories_list;
										$posts_html .= '</span>';
									else :
										$posts_html .= '<span class="wb4wp-post-icon wb4wp-categories">';
										$posts_html .= '<a href="#">No Categories</a>';
										$posts_html .= '</span>';
									endif;	
								endif; // End if Categories list
								
								if ( isset( $instance['post_show_tags'] ) && $instance['post_show_tags'] ) :
									$tag_list = get_the_tag_list( '', __( ', ', 'widget-bundle' ) );
									if( $tag_list ) :
										$posts_html .= '<span class="wb4wp-post-icon wb4wp-tags">';
										$posts_html .= $tag_list;
										$posts_html .= '</span>';
									else :
										$posts_html .= '<span class="wb4wp-post-icon wb4wp-tags">';
										$posts_html .= '<a href="#">No Tags</a>';
										$posts_html .= '</span>';
									endif;
								endif; // End if Tag list
								
								if ( isset( $instance['post_show_count'] ) && $instance['post_show_count'] ) :
									if ( get_comments_number() == 0 )
										$comments = __( 'No Comments', 'widget-bundle' );
									elseif ( get_comments_number() > 1 )
										$comments = sprintf( __( '%s Comments', 'widget-bundle' ), get_comments_number() );
									else
										$comments = __( '1 Comment', 'widget-bundle' );
									
									$posts_html .= '<span class="wb4wp-post-icon wb4wp-comments">';
									$posts_html .= '<a href="' . get_comments_link() . '">' . $comments . '</a>';
									$posts_html .= '</span>';
								endif;
						endif;
						
					$posts_html .= '</div>';	
				endwhile;
			endif;
		
			wp_reset_postdata();
			return wp_kses_post( $posts_html );
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
			
			if( ! empty( $new_instance['post_type'] ) ) {
				
				foreach( $new_instance['post_type'] as $type ) {
					
					if ( in_array( $type, $name ) ) {
						
						$types[] = $type;
					}
				}
			}
			
			if ( empty( $types ) ) {
				
				$types[] = 'post';
			}
		
			$instance = $old_instance;
			$instance['title'] 			= isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['post_type'] 		= $types;
			$instance['post_status'] 	= strip_tags( $new_instance['post_status'] );
			$instance['post_title'] 	= isset( $new_instance['post_title'] ) ? (bool) $new_instance['post_title'] : false;
			$instance['post_title_tag'] = isset( $new_instance['post_title_tag'] ) ? strip_tags( $new_instance['post_title_tag'] ):'';			            $instance['post_thumbnail'] = isset( $new_instance['post_thumbnail'] ) ? (bool) $new_instance['post_thumbnail'] : false;
			$instance['post_thumbnail_size'] 	= strip_tags( $new_instance['post_thumbnail_size'] );
			$instance['post_thumbnail_width'] 	= (int)( $new_instance['post_thumbnail_width'] );
			$instance['post_thumbnail_height'] 	= (int)( $new_instance['post_thumbnail_height'] );
			$instance['post_thumbnail_align'] 	= strip_tags( $new_instance['post_thumbnail_align'] );
			$instance['post_thumbnail_shape'] 	= strip_tags( $new_instance['post_thumbnail_shape'] );
			$instance['post_excerpt'] 	= isset( $new_instance['post_excerpt'] ) ? (bool) $new_instance['post_excerpt'] : false;
			$instance['post_excerpt_length'] 	= (int)( $new_instance['post_excerpt_length'] );
			$instance['post_readmore'] 	= isset( $new_instance['post_readmore'] ) ? (bool) $new_instance['post_readmore'] : false;
			$instance['post_readmore_text']		= sanitize_text_field( $new_instance['post_readmore_text'] );
			$instance['post_order'] 	  = strip_tags( $new_instance['post_order'] );
			$instance['post_order_by'] 	  = strip_tags( $new_instance['post_order_by'] );
			$instance['post_limit']		  = (int)( $new_instance['post_limit'] );
			$instance['post_offset'] 	  = (int)( $new_instance['post_offset'] );
			$instance['post_categories']  = $new_instance['post_categories'];
			$instance['post_tags'] 		  = $new_instance['post_tags'];
			$instance['post_show_date']   = isset( $new_instance['post_show_date'] ) ? (bool) $new_instance['post_show_date'] : false;
			$instance['post_show_author'] = isset( $new_instance['post_show_author'] ) ? (bool) $new_instance['post_show_author'] : false;		$instance['post_show_categories'] = isset( $new_instance['post_show_categories'] ) ? (bool) $new_instance['post_show_categories'] : false;
			$instance['post_show_tags']  = isset( $new_instance['post_show_tags'] ) ? (bool) $new_instance['post_show_tags'] : false;
			$instance['post_show_count'] = isset( $new_instance['post_show_count'] ) ? (bool) $new_instance['post_show_count'] : false;
			$instance['post_ignore_sticky']	= isset( $new_instance['post_ignore_sticky'] ) ? (bool) $new_instance['post_ignore_sticky'] : false;	return $instance;
		}
		
		/**
		 * @return array default values
		 *
		 * @since 1.0.0
		 */
		public function widget_default_args() {
			
			$widget_defaults['title'] 					= esc_attr__( 'Recent Posts', 'widget-bundle' );
			$widget_defaults['post_type']        		= array( 'post' );
			$widget_defaults['post_status']      		= 'publish';
			$widget_defaults['post_title']    			= true;
			$widget_defaults['post_title_tag']		  	= 'h6';
			$widget_defaults['post_thumbnail']    		= true;
			$widget_defaults['post_thumbnail_size']    	= 'custom';
			$widget_defaults['post_thumbnail_width'] 	= 80;
			$widget_defaults['post_thumbnail_height'] 	= 80;
			$widget_defaults['post_thumbnail_align'] 	= 'left';
			$widget_defaults['post_thumbnail_shape'] 	= 'square';
			$widget_defaults['post_excerpt']     		= true;
			$widget_defaults['post_excerpt_length']   	= 10;
			$widget_defaults['post_readmore']         	= true;
			$widget_defaults['post_readmore_text']    	= __( 'Read More &raquo;', 'widget-bundle' );
			$widget_defaults['post_order']            	= 'DESC';
			$widget_defaults['post_order_by']          	= 'date';
			$widget_defaults['post_limit']            	= 10;
			$widget_defaults['post_offset']           	= 0;
			$widget_defaults['post_categories']        	= array();
			$widget_defaults['post_tags']              	= array();
			$widget_defaults['post_show_date']         	= true;
			$widget_defaults['post_show_author']       	= true;
			$widget_defaults['post_show_categories']   	= true;
			$widget_defaults['post_show_tags']         	= true;
			$widget_defaults['post_show_count']    		= true;
			$widget_defaults['post_ignore_sticky']    	= true;
			return $widget_defaults;
		}
		
		/**
		 * Register the scripts for the admin facing side of the site.
		 *
		 * @since 1.0.0
		 */
		public function widget_bundle_posts_scripts() {
			
			if( is_admin() ) { 
				
				wp_enqueue_script( 'widget-bundle-posts', WB4WP_PLUGIN_JS . 'widget-bundle-posts.js', array('jquery') );
			}
		}
	}
}	