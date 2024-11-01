<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-contact-form
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
	<label for="<?php echo esc_attr( $this->get_field_id( 'contact_company_name' ) ); ?>">
		<strong><?php _e( 'Company Name :', 'widget-bundle' ); ?></strong>
	</label> 
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_company_name' ) ); ?>" name="<?php echo esc_attr($this->get_field_name( 'contact_company_name' ) ); ?>" type="text" value="<?php echo $instance['contact_company_name']; ?>">
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'contact_address' ) ); ?>">
		<strong><?php _e( 'Address :', 'widget-bundle' ); ?></strong>
	</label> 
	<textarea class="widefat" rows="3" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'contact_address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_address' ) ); ?>"><?php echo $instance['contact_address']; ?></textarea>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'contact_email' ) ); ?>">
		<strong><?php _e( 'Email ID :', 'widget-bundle' ); ?></strong>
	</label> 
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_email' ) ); ?>" type="email" value="<?php echo $instance['contact_email']; ?>">
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'contact_phone' ) ); ?>">
		<strong><?php _e( 'Phone No :', 'widget-bundle' ); ?></strong>
	</label> 
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_phone' ) ); ?>" type="text" value="<?php echo $instance['contact_phone']; ?>">
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'contact_mobile' ) ); ?>">
		<strong><?php _e( 'Mobile No :', 'widget-bundle' ); ?></strong>
	</label> 
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_mobile' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_mobile' ) ); ?>" type="text" value="<?php echo $instance['contact_mobile']; ?>">
</p>

<p class="text fax"> 
	<label for="<?php echo esc_attr( $this->get_field_id( 'contact_fax' ) ); ?>">
		<strong><?php _e( 'Fax :', 'widget-bundle' ); ?></strong>
	</label> 
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_fax' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_fax' ) ); ?>" type="text" value="<?php echo $instance['contact_fax']; ?>">
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'contact_website' ) ); ?>">
		<strong><?php _e( 'Website :', 'widget-bundle' ); ?></strong>
	</label> 
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_website' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_website' ) ); ?>" type="text" value="<?php echo $instance['contact_website']; ?>">
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'contact_icon_label' ) ); ?>">
		<strong><?php _e( 'Icon / Label :', 'widget-bundle' ); ?></strong>
	</label>	
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_icon_label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_icon_label' ) ); ?>">
		<option value="icon" <?php selected( $instance['contact_icon_label'], 'icon' ); ?>>
			<?php _e( 'Icon', 'widget-bundle' ) ?>
		</option>
		<option value="label" <?php selected( $instance['contact_icon_label'], 'label' ); ?>>
			<?php _e( 'Label', 'widget-bundle' ) ?>
		</option>
	</select>
</p>