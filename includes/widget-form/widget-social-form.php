<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-social-form
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
	<label for="<?php echo esc_attr( $this->get_field_id( 'social_description' ) ); ?>">
		<strong><?php _e( 'Description (optional) :', 'widget-bundle' ); ?></strong>
	</label>
	<textarea class="widefat" rows="3" cols="20" id="<?php echo esc_attr( $this->get_field_id('social_description') ); ?>" name="<?php echo esc_attr( $this->get_field_name('social_description') ); ?>"><?php echo esc_textarea( $instance['social_description'] ); ?></textarea>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'social_icon_size' ) ); ?>">
		<strong><?php _e( 'Icon Size :', 'widget-bundle' ); ?></strong>
	</label>
	<input id="<?php echo esc_attr( $this->get_field_id( 'social_icon_size' ) ); ?>" type="number" name="<?php echo esc_attr( $this->get_field_name( 'social_icon_size' ) ); ?>" value="<?php echo absint( $instance['social_icon_size'] ); ?>" class="widefat" step="1" min="10" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'social_icon_fontsize' ) ); ?>">
		<strong><?php _e( 'Icon Font Size :', 'widget-bundle' ); ?></strong>
	</label>
	<input id="<?php echo esc_attr( $this->get_field_id( 'social_icon_fontsize' ) ); ?>" type="number" name="<?php echo esc_attr( $this->get_field_name( 'social_icon_fontsize' ) ); ?>" value="<?php echo absint( $instance['social_icon_fontsize'] ); ?>" class="widefat" step="1" min="10" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'social_icon_shape' ) ); ?>">
		<strong><?php _e( 'Icon Shape :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social_icon_shape' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_icon_shape' ) ); ?>">
		<option value="square" <?php selected( $instance['social_icon_shape'], 'square'  ); ?>>
			<?php _e( 'Square', 'widget-bundle' ); ?>
		</option>
		<option value="rounded" <?php selected( $instance['social_icon_shape'], 'rounded' ); ?>>
			<?php _e( 'Rounded', 'widget-bundle' ); ?>
		</option>
		<option value='rounded-corner' <?php selected( $instance['social_icon_shape'], 'rounded-corner' ); ?> >		
			<?php _e( 'Rounded Corner', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'social_icon_target' ) ); ?>">
		<strong><?php _e( 'Open Link in :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social_icon_target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social_icon_target' ) ); ?>">
		<option value="_blank" <?php selected( $instance['social_icon_target'], '_blank' ); ?>>
			<?php _e( 'New Window', 'widget-bundle' ); ?>
		</option>
		<option value="_self" <?php selected( $instance['social_icon_target'], '_self' ); ?>>
			<?php _e( 'Current Window', 'widget-bundle' ); ?>
		</option>
	</select>
</p>
	
<ul id="social-icon-sortable" class="social_icon_container social-icon-sortable">
	<?php if( isset( $instance['social_icon_array'] ) && is_array( $instance['social_icon_array'] ) ) :
		foreach ( $instance['social_icon_array'] as $link ) : ?>
		<li class="social_icon_row"><?php $this->social_icon_html( $widget_default_social_icons, $link ); ?></li>
	<?php endforeach; endif; ?>
</ul>
	
<p>
	<button id="social_icon_add" class="social_icon_add button">						
		<?php _e( 'Add Social Icons', 'widget-bundle' ); ?>
	</button>
<p> 

<div id="social_icon_container_clone" class="social_icon_container_clone">
	<?php $this->social_icon_html( $widget_default_social_icons ); ?>
</div>