<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-image-form
 * @author     Devnath verma <devnathverma@gmail.com>
 */
?> 

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
		<strong><?php _e( 'Title :', 'widget-bundle' ); ?></strong>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
</p>
	  
<p>
	<label for="<?php echo esc_attr( $this->get_field_id('multiple_image_type') ); ?>">
		<strong><?php _e('Image Type :', 'widget-bundle' ); ?></strong>
	</label> 
	<select class="widefat multiple_change_image_type" id="<?php echo esc_attr( $this->get_field_id('') ); ?>" name="<?php echo esc_attr( $this->get_field_name('multiple_image_type') ); ?>">
		<option value="simple"<?php selected( $instance['multiple_image_type'], 'simple' ); ?>>
			<?php _e('Simple', 'widget-bundle'); ?>
		</option>
		<option value="slider"<?php selected( $instance['multiple_image_type'], 'slider' ); ?>>
			<?php _e('Slider', 'widget-bundle'); ?>
		</option>
	</select>    
</p> 

<div id="<?php echo esc_attr( $this->get_field_id( 'wb4wp_custom_slider_settings' ) ); ?>" <?php if ( empty( $instance['multiple_image_type'] ) || $instance['multiple_image_type'] != 'slider' ) { ?>style="display:none;"<?php } ?>>	
	
	<p>
		<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'multiple_image_autoplay' ) ); ?>" value="yes" name="<?php echo esc_attr( $this->get_field_name( 'multiple_image_autoplay' ) ); ?>" <?php checked( $instance['multiple_image_autoplay'], 'yes' ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'multiple_image_autoplay' ) ); ?>">
			<strong><?php _e( 'Auto Play', 'widget-bundle' ); ?></strong>
		</label><br/>
		
		<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'multiple_image_pagination' ) ); ?>" value="yes" name="<?php echo esc_attr( $this->get_field_name( 'multiple_image_pagination' ) ); ?>" <?php checked( $instance['multiple_image_pagination'], 'yes' ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'multiple_image_pagination' ) ); ?>">
			<strong><?php _e( 'Display Pagination', 'widget-bundle' ); ?></strong>
		</label><br/>
		<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'multiple_image_navigation' ) ); ?>" value="yes" name="<?php echo esc_attr( $this->get_field_name( 'multiple_image_navigation' ) ); ?>" <?php checked( $instance['multiple_image_navigation'], 'yes' ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'multiple_image_navigation' ) ); ?>">
			<strong><?php _e( 'Display Navigation', 'widget-bundle' ); ?></strong>
		</label>
	</p>
	
</div>

<div id="multiple_image_container" class="multiple_image_container">

<?php 
	
$i = 0;

if( isset( $instance['mid'] ) && is_array( $instance['mid'] ) ) {

	foreach( $instance['mid'] as $instance_mid ) { ?>

		<div id="<?php echo $instance_mid['multiple_image_id']; ?>" class="multiple_image_container_inner">
			
			<a id="multiple_delete_image" class="multiple_delete_image">			
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>delete-icon.png" class="multiple_delete_image_icon">
			</a>
				
			<input type="hidden" name="multiple_image_id[]" id="<?php echo esc_attr( $this->get_field_id( 'multiple_image_id' ) ); ?>" class="widefat" value="<?php echo $instance_mid['multiple_image_id']; ?>" />

			<p id="multiple_image_preview_<?php echo $instance_mid['multiple_image_id']; ?>">
				<?php echo wp_get_attachment_image( $instance_mid['multiple_image_id'], 'medium', '', array( 'class' => 'multiple_image_preview' ) ); ?>
			</p>
				
			<p id="multiple_image_title_<?php echo $instance_mid['multiple_image_id']; ?>">
				<label for="<?php echo esc_attr( esc_attr( $this->get_field_id( 'multiple_image_title' ) ) ); ?>">
					<?php _e( 'Title', 'widget-bundle'  ); ?>
				</label>
				<input type="text" name="multiple_image_title[]" value="<?php echo $instance_mid['multiple_image_title']; ?>" placeholder="<?php _e('Enter Image Title Here', 'widget-bundle' ); ?>" class="widefat">
			</p>
			
			<p id="multiple_image_alt_text_<?php echo $instance_mid['multiple_image_id']; ?>">
				<label for="<?php echo esc_attr( $this->get_field_id( 'multiple_image_alt_text' ) ); ?>">
					<?php _e( 'Alternate Text', 'widget-bundle' ); ?>
				</label>
				<input class="widefat" placeholder="<?php _e('Enter Image Alternate Text Here', 'widget-bundle' ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'multiple_image_alt_text' ) ); ?>" name="multiple_image_alt_text[]" type="text" value="<?php echo $instance_mid['multiple_image_alt_text']; ?>" />
			</p>
			
			<p id="multiple_image_caption_<?php echo $instance_mid['multiple_image_id']; ?>">
				<label for="<?php echo esc_attr( $this->get_field_id( 'multiple_image_caption' ) ); ?>">
					<?php _e( 'Caption', 'widget-bundle' ); ?>
				</label>
				<textarea class="widefat" placeholder="<?php _e('Enter Image Caption Text Here', 'widget-bundle' ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'multiple_image_caption' ) ); ?>" name="multiple_image_caption[]" type="text"><?php echo $instance_mid['multiple_image_caption']; ?></textarea>
			</p>
			
			<p id="multiple_image_link_<?php echo $instance_mid['multiple_image_id']; ?>">
				<label for="<?php echo esc_attr( $this->get_field_id( 'multiple_image_link' ) ); ?>">
					<?php _e( 'Link', 'widget-bundle' ); ?>
				</label>
				<input class="widefat" placeholder="<?php _e('http://', 'widget-bundle' ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'multiple_image_link' ) ); ?>" name="multiple_image_link[]" type="text" value="<?php echo $instance_mid['multiple_image_link']; ?>">
			</p>
			
			<p id="multiple_image_target_<?php echo $instance_mid['multiple_image_id']; ?>">
				<label for="<?php echo esc_attr( $this->get_field_id( 'multiple_image_target' ) ); ?>">
					<?php _e( 'Open Link in:', 'widget-bundle' ); ?>
				</label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'multiple_image_target' ) ); ?>" name="multiple_image_target[]">
					<option value="_self"<?php selected( $instance_mid['multiple_image_target'], '_self' ); ?>>
						<?php _e( 'Current Window', 'widget-bundle' ); ?>
					</option>
					<option value="_blank"<?php selected( $instance_mid['multiple_image_target'], '_blank' ); ?>>				                <?php _e( 'New Window', 'widget-bundle' ); ?>
					</option>
				</select>
			</p>
		</div>
		
		<?php $i++; 
	} 
}
?>

</div>

<p>
	<button id="multiple_add_image" class="multiple_add_image button" data-uploader_title="Upload Image" data-uploader_button_text="Select">						
		<?php _e( 'Add Images', 'widget-bundle' ); ?>
	</button>
<p> 