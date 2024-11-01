<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-text-form
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
	<label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>">
		<strong><?php _e( 'Content :', 'widget-bundle' ); ?></strong>
	</label>
	<textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr( $this->get_field_id('content') ); ?>" name="<?php echo esc_attr( $this->get_field_name('content') ); ?>"><?php echo esc_textarea( $instance['content'] ); ?></textarea>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'add_paragraph' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'add_paragraph' ) ); ?>" type="checkbox" <?php checked( $instance['add_paragraph'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'add_paragraph' ) ); ?>">
		<strong><?php _e( 'Automatically add paragraphs to the content', 'widget-bundle' ); ?></strong>
	</label>
</p>		