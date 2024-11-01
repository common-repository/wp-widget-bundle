<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-categories-widget
 */

/**
 * The main widget class.
 *
 *
 * @since      1.0.0
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widgets/class-categories-widget
 * @author     Devnath verma <devnathverma@gmail.com>
 */
if ( ! class_exists( 'WB4WP_Categories_Widgets' ) ) {

	/**
	 * Categories widget class.
	 *
	 * @package widget-bundle
	 *
	 * @since   1.0.0
	 */
	class WB4WP_Categories_Widgets extends WP_Widget {
		
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
				'classname'   => 'wb-categories-widget',
				'description' => __( 'A widget that display recent categories in list or dropdown.', 'widget-bundle' ),
				'customize_selective_refresh' => true
			);
			
			// Control the width and height
			$control_options = array(
				'id_base' => 'wb-categories-widget'
			);
			
			// Create the widget
			parent::__construct( 'wb-categories-widget', 'WB Categories',	$widget_options, $control_options );	
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
			
			$taxonomies = get_taxonomies( array( 'public'  => true, 'show_ui' => true, 'rewrite' => true ), 'objects', 'and' ); 
			
			// Merge the user selected arguments with the defaults.
			$instance = wp_parse_args( (array) $instance, $this->widget_default_args() );
			
			// Extract the array to allow easy use of variables.
			extract( $instance ); 
			
			include WB4WP_PLUGIN_INCLUDES . 'widget-form/widget-categories-form.php';
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
			
			extract( $args );
			$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'] );
			
			if( isset( $instance['categories_taxonomy'] ) && ! empty( $instance['categories_taxonomy'] ) ) {
				$widget_args['taxonomy'] = $instance['categories_taxonomy'];
			}
			
			if( isset( $instance['categories_include_exclude'] ) && $instance['categories_include_exclude'] == 'include' ) {
			
				if( ! empty( $instance['categories_id'] ) )
					$widget_args['include'] =  $instance['categories_id'];
				else
					$widget_args['include'] =  '';
			}
			
			if( isset( $instance['categories_include_exclude'] ) && $instance['categories_include_exclude'] == 'exclude' ) {
			
				if( ! empty( $instance['categories_id'] ) )
					$widget_args['exclude'] =  $instance['categories_id'];
				else
					$widget_args['exclude'] =  '';
			}
			
			if( isset( $instance['categories_posts_count'] ) && $instance['categories_posts_count'] )
				$widget_args['show_count']	= 1;
			else
				$widget_args['show_count'] = 0;
			
			if( isset( $instance['categories_hierarchy'] ) && $instance['categories_hierarchy'] )
				$widget_args['hierarchical'] = 1;
			else
				$widget_args['hierarchical'] = 0;
			
			$widget_args['number'] 	= 0;
			$widget_args['orderby'] = $instance['categories_order_by'];
			$widget_args['order'] 	= $instance['categories_order'];
			$widget_args['style'] 	= 'list';
			$widget_args['title_li' ] 	= '';
			$widget_args['hide_empty'] 	= $instance['categories_hide_empty'];
			$widget_args['depth'] = $instance['categories_depth'];
			
			// Output the theme's $before_widget wrapper.
			echo $args['before_widget'];
			
			// If the title not empty, display it.
			if ( isset( $instance['title'] ) && ! empty( $instance['title'] ) ) {
					
				echo $args['before_title'] . $instance['title'] . $args['after_title'];
			}
			
			echo '<div class="wb4wp-container">';
			
			if( isset( $instance['categories_format'] ) && $instance['categories_format'] == 'list' ) 
				wp_list_categories( $widget_args );
			else
				wp_dropdown_categories( $widget_args );
			
			echo '</div>';
			
			// Close the theme's widget wrapper.
			echo $args['after_widget'];
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
			$instance['categories_taxonomy']	= strip_tags( $new_instance['categories_taxonomy'] );
			$instance['categories_order'] 		= strip_tags( $new_instance['categories_order'] );		
			$instance['categories_order_by'] 	= strip_tags( $new_instance['categories_order_by'] );
			$instance['categories_format'] 		= strip_tags( $new_instance['categories_format'] );	
			$instance['categories_hide_empty'] 	= strip_tags( $new_instance['categories_hide_empty'] );
			$instance['categories_hierarchy'] 	= isset( $new_instance['categories_hierarchy'] ) ? (bool) $new_instance['categories_hierarchy'] : false;
			$instance['categories_posts_count'] = isset( $new_instance['categories_posts_count'] ) ? (bool) $new_instance['categories_posts_count'] : false;
			$instance['categories_depth'] = strip_tags( $new_instance['categories_depth'] );		
			$instance['categories_include_exclude'] = strip_tags( $new_instance['categories_include_exclude'] );
			$instance['categories_id'] = isset( $new_instance['categories_id'] ) ? strip_tags( $new_instance['categories_id'] ) : '';
			return $instance;
		}
		
		/**
		 * @return array default values
		 *
		 * @since 1.0.0
		 */	
		public function widget_default_args() {
			
			$widget_defaults['title'] 						= esc_attr__( 'Recent Categories', 'widget-bundle' );
			$widget_defaults['categories_taxonomy'] 		= 'category';
			$widget_defaults['categories_order'] 			= 'ASC';
			$widget_defaults['categories_order_by'] 		= 'ID';
			$widget_defaults['categories_format'] 			= 'list';
			$widget_defaults['categories_hide_empty'] 		= 0;
			$widget_defaults['categories_hierarchy']  		= true;
			$widget_defaults['categories_posts_count'] 		= true;
			$widget_defaults['categories_depth'] 			= 0;
			$widget_defaults['categories_include_exclude'] 	= '';
			$widget_defaults['categories_id'] 				= '';
			return $widget_defaults;
		}
	}	
}