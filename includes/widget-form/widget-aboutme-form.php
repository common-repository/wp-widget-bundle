<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-aboutme-form
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
	<strong>
		<?php _e( 'Select a Administrator. The e-mail address of this account is used to display the Avatar image. If you do not have a Avatar, get it at : <a href="https://de.gravatar.com/">Gravatar.com</a>.', 'widget-bundle' ) ?>
	</strong>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'aboutme_administrator' ) ); ?>">
		<strong><?php _e( 'Select Administrator :', 'widget-bundle' ) ?></strong>
	</label><br />
	<?php wp_dropdown_users( array( 'who' => 'authors', 'name' => esc_attr( $this->get_field_name( 'aboutme_administrator' ) ), 'class' => 'widefat', 'selected' => $instance['aboutme_administrator'] ) ); ?>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'aboutme_title_tag' ) ); ?>">
		<strong><?php _e( 'Display Name in Tag :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'aboutme_title_tag' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'aboutme_title_tag' ) ); ?>">
		<option value='h1'<?php selected( $instance['aboutme_title_tag'], 'h1' ); ?>>
			<?php _e( 'h1', 'widget-bundle' ); ?>
		</option>
		<option value='h2'<?php selected( $instance['aboutme_title_tag'], 'h2' ); ?>>
			<?php _e( 'h2', 'widget-bundle' ); ?>
		</option>
		<option value='h3'<?php selected( $instance['aboutme_title_tag'], 'h3' ); ?>>
			<?php _e( 'h3', 'widget-bundle' ); ?>
		</option>
		<option value='h4'<?php selected( $instance['aboutme_title_tag'], 'h4' ); ?>>
			<?php _e( 'h4', 'widget-bundle' ); ?>
		</option>
		<option value='h5'<?php selected( $instance['aboutme_title_tag'], 'h5' ); ?>>
			<?php _e( 'h5', 'widget-bundle' ); ?>
		</option>
		<option value='h6'<?php selected( $instance['aboutme_title_tag'], 'h6' ); ?>>
			<?php _e( 'h6', 'widget-bundle' ); ?>
		</option>		
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'aboutme_avatar_size' ) ); ?>">
		<strong><?php _e( 'Avatar Size :', 'widget-bundle' ); ?></strong>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'aboutme_avatar_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'aboutme_avatar_size' ) ); ?>" type="number" step="1" min="-1" value="<?php echo (int)( $instance['aboutme_avatar_size'] ); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'aboutme_avatar_align' ) ); ?>">
		<strong><?php _e( 'Avatar Align :', 'widget-bundle' ); ?></strong>
	</label>	
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'aboutme_avatar_align' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'aboutme_avatar_align' ) ); ?>">
		<option value="left" <?php selected( $instance['aboutme_avatar_align'], 'left' ); ?>>
			<?php _e( 'Left', 'widget-bundle' ) ?>
		</option>
		<option value="right" <?php selected( $instance['aboutme_avatar_align'], 'right' ); ?>>
			<?php _e( 'Right', 'widget-bundle' ) ?>
		</option>
		<option value="center" <?php selected( $instance['aboutme_avatar_align'], 'center' ); ?>>
			<?php _e( 'Center', 'widget-bundle' ) ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'aboutme_avatar_shape' ) ); ?>">
		<strong><?php _e( 'Avatar Shape :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'aboutme_avatar_shape' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'aboutme_avatar_shape' ) ); ?>">
		<option value='square' <?php selected( $instance['aboutme_avatar_shape'], 'square' ); ?> >
			<?php _e( 'Square', 'widget-bundle' ); ?>
		</option>
		<option value='rounded' <?php selected( $instance['aboutme_avatar_shape'], 'rounded' ); ?> >		
			<?php _e( 'Rounded', 'widget-bundle' ); ?>
		</option>
		<option value='rounded-corner' <?php selected( $instance['aboutme_avatar_shape'], 'rounded-corner' ); ?> >		
			<?php _e( 'Rounded Corner', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'aboutme_avatar_description' ) ); ?>">
		<strong><?php _e( 'Select Description :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'aboutme_avatar_description' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'aboutme_avatar_description' ) ); ?>" onChange="WB4WP_ABOUTME.TDescription( '<?php echo $this->get_field_id( '' ); ?>' );">
		<option value='author_bio'<?php selected( $instance['aboutme_avatar_description'], 'author_bio' ); ?>>
			<?php _e( 'Author Bio', 'widget-bundle' ); ?>
		</option>
		<option value='custom_description'<?php selected( $instance['aboutme_avatar_description'], 'custom_description' ); ?>>						<?php _e( 'Custom Description', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<div id="<?php echo esc_attr( $this->get_field_id( 'wb4wp_custom_description' ) ); ?>" <?php if ( empty( $instance['aboutme_avatar_description'] ) || $instance['aboutme_avatar_description'] != 'custom_description' ) { ?>style="display:none;"<?php } ?>>				
	<p>
		<textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('aboutme_custom_description'); ?>" name="<?php echo $this->get_field_name('aboutme_custom_description'); ?>"><?php echo esc_textarea( $instance['aboutme_custom_description'] ); ?></textarea>
	</p>
</div>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'aboutme_extended_page' ) ); ?>">
		<strong><?php _e( 'Select your extended "About Me" page. This will be the page linked to at the end of your author description.', 'widget-bundle' ); ?></strong>
	</label>
	<?php wp_dropdown_pages( array(	'name' => esc_attr( $this->get_field_name( 'aboutme_extended_page' ) ), 'id' => esc_attr( $this->get_field_id( 'aboutme_extended_page' ) ), 'class' => 'widefat', 'show_option_none' => __( 'None', 'widget-bundle'), 'selected' => ( isset ( $instance['aboutme_extended_page'] ) ) ? esc_attr( $instance['aboutme_extended_page'] ) : '' ) ); ?>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'aboutme_readmore_text' ) ); ?>">
		<strong><?php _e( 'Extended Page Link Text:', 'widget-bundle' ) ?></strong>
	</label>
	<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'aboutme_readmore_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'aboutme_readmore_text' ) ); ?>" value="<?php echo esc_attr( $instance['aboutme_readmore_text'] ); ?>" />
</p>