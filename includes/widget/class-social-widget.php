<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-social-widget
 */

/**
 * The main widget class.
 *
 *
 * @since      1.0.0
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-social-widget
 * @author     Devnath verma <devnathverma@gmail.com>
 */
if ( ! class_exists( 'WB4WP_Social_Widgets' ) ) {

	/**
	 * Social widget class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Social_Widgets extends WP_Widget {
		
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
				'classname'   => 'wb-social-widget',
				'description' => __( 'A widget that display social icons.', 'widget-bundle' ),
				'customize_selective_refresh' => true
			);
			
			// Control the width and height
			$control_options = array(
				'id_base' => 'wb-social-widget'
			);
			
			// Create the widget
			parent::__construct( 'wb-social-widget', 'WB Social', $widget_options, $control_options );
			add_action( 'admin_print_scripts', array( $this, 'widget_bundle_social_icon_scripts') );
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
			$widget_default_social_icons = $this->widget_default_social_icons();
	
			// Extract the array to allow easy use of variables.
			extract( $instance ); 
			
			include WB4WP_PLUGIN_INCLUDES . 'widget-form/widget-social-form.php';
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
				
				if ( isset( $instance['social_description'] ) && ! empty( $instance['social_description'] ) ) {
					
					$widget_html .= wpautop( $instance['social_description'] );
				}
				
				if( ! empty( $instance['social_icon_array'] ) && is_array( $instance['social_icon_array'] ) ) {
				
					$widget_html .= '<ul class="widget-bundle-social-icon wb4wp-icon-shape-'.$instance['social_icon_shape'].'">';
					  
					foreach ( $instance['social_icon_array'] as $social_icons ) {
						
						$widget_html .= '<li class="social-icon-' . $social_icons['social_icon_name'] . '">';
						
						$widget_html .= $this->widget_social_icon_html( $instance, $social_icons );
						
						$widget_html .= '</li>';
					}
				  
				  	$widget_html .= '</ul>';
				}
				
			$widget_html .= '</div>';
			
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
		 * @param array   $social_icons The social icons settings.
		 * @param array   $instance The widget instance settings.
		 * @return string HTML output.
		 */
		public function widget_social_icon_html( $instance, $social_icons ) {
			
			$social_icon_html = '';
			
			if ( isset( $social_icons['social_icon_url'] ) && ! empty( $social_icons['social_icon_url'] ) ) {
				
				$social_icon_url = esc_url( $social_icons['social_icon_url'] );
			
			} else {
				
				$social_icon_url = '#';
			}
			
			if ( isset( $instance['social_icon_target'] ) && ! empty( $instance['social_icon_target'] ) ) {
				
				$social_icon_target = $instance['social_icon_target'];
			}
			
			if ( isset( $social_icons['social_icon_name'] ) && ! empty( $social_icons['social_icon_name'] ) ) {
				
				$social_icon_name = $social_icons['social_icon_name'];
			}

			$social_icon_style = '';

			if ( isset( $instance['social_icon_size'] ) && $instance['social_icon_size'] ) {
				
				$sis = $instance['social_icon_size'] . 'px';
				$social_icon_style .= ' width:' . $sis . '; height:' . $sis . '; line-height: ' . $sis .';';
			}
			
			if ( isset( $instance['social_icon_fontsize'] ) && $instance['social_icon_fontsize'] ) {
				
				$social_icon_style .= ' font-size:' . $instance['social_icon_fontsize'] . 'px;';
			}

			if ( $social_icon_style ) { $social_icon_style = ' style="' . esc_attr( $social_icon_style ) . '"'; }
				
			$social_icon_html .= '<a href="' . $social_icon_url . '" target="' . $social_icon_target . '" title="' . $social_icon_name . '"' . $social_icon_style .'>';
			$social_icon_html .= '<span class="wb4wp-social-icon wb4wp-social-icon-' . $social_icon_name. '"></span>';
			$social_icon_html .= '<span class="screen-reader-text">' . $social_icon_name . '</span>';
			$social_icon_html .= '</a>';
			
			return $social_icon_html;
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
			$instance['social_description'] = isset( $new_instance['social_description'] ) ? strip_tags( $new_instance['social_description'] ) : '';
			$instance['social_icon_size'] 		= (int)( $new_instance['social_icon_size'] );
			$instance['social_icon_fontsize'] 	= (int)( $new_instance['social_icon_fontsize'] );
			$instance['social_icon_shape'] 		= strip_tags( $new_instance['social_icon_shape'] );
			$instance['social_icon_target'] 	= strip_tags( $new_instance['social_icon_target'] );
			
			if ( ! empty( $new_instance['social_icon_name'] ) ) {
					
				for ( $i=0; $i < ( count( $new_instance['social_icon_name'] ) - 1 ); $i++ ) {
					
					$social_icon_array[$new_instance['social_icon_name'][$i]] = array(
						'social_icon_name' => strip_tags( $new_instance['social_icon_name'][$i] ),
						'social_icon_url'  => esc_url( $new_instance['social_icon_url'][$i] )
					);
				}
			}
			
			$instance['social_icon_array'] = $social_icon_array;
			return $instance;
		}
		
		/**
		 * Generate the icons in backend.
		 *
		 * This is typically done in the widget() method, but moving it to a
		 * separate method allows for the routine to be easily overloaded by a class
		 * extending this one without having to reimplement all the caching and
		 * filtering, or resorting to adding a filter, calling the parent method,
		 * then removing the filter.
		 *
		 * @since 1.0.0
		 *
		 * @param array   $social_links The social icons.
		 * @param array   $selected icons name, icon url.
		 * @return string HTML output.
		 */
		public function social_icon_html( $social_links, $selected = array( 'social_icon_name' => '', 'social_icon_url' => '' ) ) { ?>

			<a id="social_icon_delete" class="social_icon_delete">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>delete-icon.png" class="social_icon_delete_image">
			</a>
			<?php if( $social_links ) : ?>
				<p>
					<label for="<?php echo $this->get_field_id( 'social_icon_name' ); ?>">
						<?php _e( 'Social Icon', 'widget-bundle' ); ?>
					</label>
					<select class="widefat" id="<?php echo $this->get_field_id( 'social_icon_name' ); ?>" name="<?php echo $this->get_field_name( 'social_icon_name' ); ?>[]">
						<?php foreach( $social_links as $icon_key => $icon_value ) : ?>
							<option value="<?php echo esc_attr( $icon_key ); ?>" <?php selected( $selected['social_icon_name'], $icon_key ); ?>>				<?php echo esc_attr( $icon_value ); ?>
							</option>
						<?php endforeach; ?>
					</select>
				</p>
			<?php endif; ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'social_icon_url' ) ); ?>">
					<?php _e( 'URL', 'widget-bundle' ); ?>
				</label>
				<input class="widefat" placeholder="<?php _e('http://', 'widget-bundle' ); ?>" id="<?php echo $this->get_field_id( 'social_icon_url' ); ?>" name="<?php echo $this->get_field_name( 'social_icon_url' ); ?>[]" type="text" value="<?php echo $selected['social_icon_url']; ?>">
			</p>

		<?php }
		
		/**
		 * @return array default values
		 *
		 * @since 1.0.0
		 */	
		public function widget_default_args( ) {
			
			$widget_defaults['title'] = esc_attr__( 'Follow US', 'widget-bundle' );
			$widget_defaults['social_description'] 		= '';
			$widget_defaults['social_icon_size'] 		= 40;
			$widget_defaults['social_icon_fontsize'] 	= 25;
			$widget_defaults['social_icon_shape'] 		= 'rounded';
			$widget_defaults['social_icon_target'] 		= '_blank';
			return $widget_defaults;
		}
		
		/**
		 * @return array social icons
		 *
		 * @since 1.0.0
		 */	
		public function widget_default_social_icons() {
			
			$widget_social_icons = array(
				'amazon' 		=> __( 'Amazon', 'widget-bundle' ),
				'email' 		=> __( 'Email', 'widget-bundle' ),
				'facebook' 		=> __( 'Facebook', 'widget-bundle' ),
				'google' 		=> __( 'Google', 'widget-bundle' ),
				'instagram' 	=> __( 'Instagram', 'widget-bundle' ),
				'linkedin' 		=> __( 'Linkedin', 'widget-bundle' ),
				'pinterest' 	=> __( 'Pinterest', 'widget-bundle' ),
				'reddit' 		=> __( 'Reddit', 'widget-bundle' ),
				'rss' 			=> __( 'RSS', 'widget-bundle' ),
				'share' 		=> __( 'Share', 'widget-bundle' ),
				'twitter' 		=> __( 'Twitter', 'widget-bundle' ),
				'whatsapp' 		=> __( 'WhatsApp', 'widget-bundle' ),
				'wordpress' 	=> __( 'WordPress', 'widget-bundle' ),
				'xing' 			=> __( 'Xing', 'widget-bundle' ),
				'youtube' 		=> __( 'YouTube', 'widget-bundle' )
			);
			
			return $widget_social_icons;
		}
		
		/**
		 * Register the scripts for the admin facing side of the site.
		 *
		 * @since 1.0.0
		 */
		public function widget_bundle_social_icon_scripts() {
			
			if( is_admin() ) { 
				
				wp_enqueue_script( 'widget-bundle-social', WB4WP_PLUGIN_JS . 'widget-bundle-social.js', array('jquery') );
			}
		}
	}
}