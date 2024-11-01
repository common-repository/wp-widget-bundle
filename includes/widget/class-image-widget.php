<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-image-widget
 */

/**
 * The main widget class.
 *
 *
 * @since      1.0.0
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-image-widget
 * @author     Devnath verma <devnathverma@gmail.com>
 */
if ( ! class_exists( 'WB4WP_Image_Widgets' ) ) {

	/**
	 * Image widget class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Image_Widgets extends WP_Widget {
		
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
				'classname'   => 'wb-multiple-image-widget',
				'description' => __( 'A widget that display the multiple images.', 'widget-bundle' ),
				'customize_selective_refresh' => true
			);
			
			// Control the width and height
			$control_options = array(
				'id_base' => 'wb-multiple-image-widget'
			);
			
			// Create the widget
			parent::__construct( 'wb-multiple-image-widget', 'WB Images', $widget_options, $control_options );
			add_action( 'admin_print_scripts', array( $this, 'widget_bundle_multiple_image_admin_scripts') );
			add_action( 'wp_enqueue_scripts', array( $this, 'widget_bundle_multiple_image_public_scripts' ) );
			add_action( 'wp_ajax_nopriv_multiple_image_thumbnail', array( $this, 'ajax_multiple_image_thumbnail' ) );
			add_action( 'wp_ajax_multiple_image_thumbnail', array( $this, 'ajax_multiple_image_thumbnail' ) );
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
			
			include WB4WP_PLUGIN_INCLUDES . 'widget-form/widget-image-form.php';
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
			
			if ( isset( $instance['multiple_image_type'] ) && $instance['multiple_image_type'] == 'slider' ) {
				
				$widget_html .= '<div id="wb4wp-container" class="wb4wp-container">'; 
				
					$widget_html .= '<div id="wb4wp-owl-carousel" class="owl-carousel owl-theme wb4wp-owl-carousel">';
						
					if( isset( $instance['mid'] ) && is_array( $instance['mid'] ) ) {
	
						foreach( $instance['mid'] as $instance_mid ) { 
							
							$widget_html .= $this->widget_image_html( $instance_mid, 'slider' );
						}
					}	
					
					$widget_html .= '</div>';
					
				$widget_html .= '</div>';
				
			} else {
				 
				$widget_html .= '<div id="wb4wp-container" class="wb4wp-container">';
					
					if( isset( $instance['mid'] ) && is_array( $instance['mid'] ) ) {

						foreach( $instance['mid'] as $instance_mid ) {
							
							$widget_html .= $this->widget_image_html( $instance_mid, 'simple' );
						}
					}	
							
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
		public function widget_image_html( $instance, $image_type = 'simple' ) {
			
			$image_html = '';
			
			if ( isset( $instance['multiple_image_id'] ) && ! empty( $instance['multiple_image_id'] ) ) {
				
				$image_html .= ($image_type == 'simple') ? '<div class="wb4wp-container-inner">' : '<div class="item">';
			}
				
			if ( isset( $instance['multiple_image_link'] ) && ! empty( $instance['multiple_image_link'] ) ) {
	
				$attr = array(
					'href'   => isset( $instance['multiple_image_link'] ) ? strip_tags( $instance['multiple_image_link'] ) : '',
					'target' => isset( $instance['multiple_image_target'] ) ? strip_tags( $instance['multiple_image_target'] ) : '',
					'title'  => isset( $instance['multiple_image_title'] ) ? strip_tags( $instance['multiple_image_title'] ) : ''
				);
	
				$image_html .= '<a';
	
				foreach( $attr as $name => $value ) {
					
					if ( ! empty( $value ) ) {
						
						$image_html .= sprintf( ' %s="%s"', $name, $value );
					}
				}
				
				$image_html .= '>';
			}
			
			if ( isset( $instance['multiple_image_id'] ) && ! empty( $instance['multiple_image_id'] ) ) {
				
				$image_html .= wp_get_attachment_image( $instance['multiple_image_id'], 'full', '', array( 'alt' => isset( $instance['multiple_image_alt_text'] ) ? strip_tags( $instance['multiple_image_alt_text'] ) : '' ) );
			}
			
			if ( isset( $instance['multiple_image_link'] ) && ! empty( $instance['multiple_image_link'] ) ) {
				
				$image_html .= '</a>';
			}
			
			if( isset( $instance['multiple_image_caption'] ) && ! empty ( $instance['multiple_image_caption'] ) ) {
		
				$image_html .= '<p class="wb4wp-caption">'.$instance['multiple_image_caption'].'</p>';
			}
			
			if ( isset( $instance['multiple_image_id'] ) && ! empty( $instance['multiple_image_id'] ) ) {
				
				$image_html .= ($image_type == 'simple') ? '</div>' : '</div>';
			}
			
			return $image_html;
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
			$instance['multiple_image_type'] 		= strip_tags( $new_instance['multiple_image_type'] );
			$instance['multiple_image_autoplay']	= isset( $new_instance['multiple_image_autoplay'] ) ? strip_tags( $new_instance['multiple_image_autoplay'] ) : 'no';
			$instance['multiple_image_pagination']	= isset( $new_instance['multiple_image_pagination'] ) ? strip_tags( $new_instance['multiple_image_pagination'] ) : 'no';
			$instance['multiple_image_navigation']	= isset( $new_instance['multiple_image_navigation'] ) ? strip_tags( $new_instance['multiple_image_navigation'] ) : 'no';
			
			if( isset( $_POST['multiple_image_id'] ) ) {
				
				$multiple_image_ids = count( $_POST['multiple_image_id'] );
				
				if( $multiple_image_ids ) {
					
					for( $i=0; $i < $multiple_image_ids; $i++ ) {
						
						$multiple_image_id[$_POST['multiple_image_id'][$i]] = array(
							'multiple_image_id' 		=> strip_tags( $_POST['multiple_image_id'][$i] ),
							'multiple_image_title'		=> strip_tags( $_POST['multiple_image_title'][$i] ),
							'multiple_image_alt_text' 	=> strip_tags( $_POST['multiple_image_alt_text'][$i] ),
							'multiple_image_caption' 	=> strip_tags( $_POST['multiple_image_caption'][$i] ),
							'multiple_image_link' 		=> strip_tags( $_POST['multiple_image_link'][$i] ),
							'multiple_image_target' 	=> strip_tags( $_POST['multiple_image_target'][$i] )
						);
					}
				}
			}
			
			$instance['mid'] = $multiple_image_id;
			return $instance;
		}
		
		/**
		 * @return array default values
		 *
		 * @since 1.0.0
		 */
		public function widget_default_args( ) {
			
			$widget_defaults['title']	= esc_attr__( 'Images', 'widget-bundle' );
			$widget_defaults['multiple_image_type']			= 'simple';
			$widget_defaults['multiple_image_autoplay']		= 'yes';
			$widget_defaults['multiple_image_pagination']	= 'yes';
			$widget_defaults['multiple_image_navigation']	= 'yes';
			$widget_defaults['mid']	= '';
			return $widget_defaults;
		}
		
		/**
		 * Return the image html output using ajax.
		 *
		 * @since 1.0.0
		 *
		 * @return string image html
		 */
		public function ajax_multiple_image_thumbnail() {
			
			$attachment_id 			= $_POST['attachment_id'];
			$attachment_data 		= get_post( $attachment_id );
			$attachment_title 		= $attachment_data->post_title;
			$attachment_alt_text 	= get_post_meta( $attachment_data->ID, '_wp_attachment_image_alt', true );
			$attachment_caption 	= $attachment_data->post_excerpt;
			$attachment_link 		= get_permalink( $attachment_data->ID ); ?>
			
			<div id="<?php echo $attachment_id; ?>" class="multiple_image_container_inner">
				
				<a id="multiple_delete_image" class="multiple_delete_image">
					<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>delete-icon.png" class="multiple_delete_image_icon">
				</a>
					
				<input type="hidden" name="multiple_image_id[]" id="<?php echo $this->get_field_id( 'multiple_image_id' ); ?>" class="widefat" value="<?php echo $attachment_id; ?>" />

				<p id="multiple_image_preview_<?php echo $attachment_id; ?>">
					<?php echo wp_get_attachment_image( $attachment_id, 'medium' ); ?>
				</p>
					
				<p id="multiple_image_title_<?php echo $attachment_id; ?>">
					<label for="<?php echo esc_attr( $this->get_field_id( 'multiple_image_title' ) ); ?>">
						<?php _e( 'Title', 'widget-bundle'  ); ?>
					</label>
					<input type="text" name="multiple_image_title[]" value="<?php echo $attachment_title; ?>" placeholder="<?php _e('Enter Image Title Here', 'widget-bundle' ); ?>" class="widefat">
				</p>
				
				<p id="multiple_image_alt_text_<?php echo $attachment_id; ?>">
					<label for="<?php echo esc_attr( $this->get_field_id( 'multiple_image_alt_text' ) ); ?>">
						<?php _e( 'Alternate Text', 'widget-bundle' ); ?>
					</label>
					<input class="widefat" placeholder="<?php _e('Enter Image Alternate Text Here', 'widget-bundle' ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'multiple_image_alt_text' ) ); ?>" name="multiple_image_alt_text[]" type="text" value="<?php echo $attachment_alt_text; ?>" />
				</p>
				
				<p id="multiple_image_caption_<?php echo $attachment_id; ?>">
					<label for="<?php echo esc_attr( $this->get_field_id( 'multiple_image_caption' ) ); ?>">
						<?php _e( 'Caption', 'widget-bundle' ); ?>
					</label>
					<textarea class="widefat" placeholder="<?php _e('Enter Image Caption Text Here', 'widget-bundle' ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'multiple_image_caption' ) ); ?>" name="multiple_image_caption[]" type="text"><?php echo $attachment_caption; ?></textarea>
				</p>
				
				<p id="multiple_image_link_<?php echo $attachment_id; ?>">
					<label for="<?php echo esc_attr( $this->get_field_id( 'multiple_image_link' ) ); ?>">
						<?php _e( 'Link', 'widget-bundle' ); ?>
					</label>
					<input class="widefat" placeholder="<?php _e('http://', 'widget-bundle' ); ?>" id="<?php echo $this->get_field_id( 'multiple_image_link' ); ?>" name="multiple_image_link[]" type="text" value="<?php echo $attachment_link; ?>">
				</p>
				
				<p id="multiple_image_target_<?php echo $attachment_id; ?>">
					<label for="<?php echo $this->get_field_id( 'multiple_image_target' ); ?>">
						<?php _e( 'Open Link in:', 'widget-bundle' ); ?>
					</label>
					<select class="widefat" id="<?php echo $this->get_field_id( 'multiple_image_target' ); ?>" name="multiple_image_target[]">
						<option value="_self">
							<?php _e( 'Current Window', 'widget-bundle' ); ?>
						</option>
						<option value="_blank">				                            	
							<?php _e( 'New Window', 'widget-bundle' ); ?>
						</option>
					</select>
				</p>
				
			</div>
			
		<?php die; }
		
		/**
		 * Register the scripts for the admin facing side of the site.
		 *
		 * @since 1.0.0
		 */
		public function widget_bundle_multiple_image_admin_scripts() {
			
			if( is_admin() ) { 
				
				wp_enqueue_media();
				wp_register_script( 'widget-bundle-image-admin', WB4WP_PLUGIN_JS . 'widget-bundle-image-admin.js', array('jquery') );
				wp_localize_script( 'widget-bundle-image-admin', 'WB4WP_AJAX', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
				wp_enqueue_script( 'widget-bundle-image-admin' );
			}
		}
		
		/**
		 * Register the scripts for the public facing side of the site.
		 *
		 * @since 1.0.0
		 */
		public function widget_bundle_multiple_image_public_scripts() {
			
			global $wp_registered_widgets;
			wp_enqueue_script( 'widget-bundle-image-carousel', WB4WP_PLUGIN_JS . 'widget-bundle-image-carousel.js', array('jquery') );
			wp_enqueue_script( 'widget-bundle-image-public', WB4WP_PLUGIN_JS . 'widget-bundle-image-public.js', array('jquery') );
			
			if( isset( $this->id ) ) {
				
				$registered_widgets_instance = $wp_registered_widgets[$this->id]['callback'][0];
				$multiple_image_instance = $registered_widgets_instance->get_settings();
				
				if( ! empty( $multiple_image_instance ) && is_array( $multiple_image_instance ) ) {
					
					foreach( $multiple_image_instance as $image_instance ) {
						
						wp_localize_script( 
							'widget-bundle-image-public', 
							'widget_bundle_image_public', 
							array(
								'autoplay'	 => isset( $image_instance['multiple_image_autoplay'] ) ? strip_tags( $image_instance['multiple_image_autoplay'] ) : 'no',
								'pagination' => isset( $image_instance['multiple_image_pagination'] ) ? strip_tags( $image_instance['multiple_image_pagination'] ) : 'no',
								'navigation' => isset( $image_instance['multiple_image_navigation'] ) ? strip_tags( $image_instance['multiple_image_navigation'] ) : 'no'	
							)
						);
					}
				}
			}
		}
	}
}