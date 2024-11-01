<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-users-form
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
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_roles' ) ); ?>">
		<strong><?php _e( 'Choose Roles :', 'widget-bundle' ); ?></strong>
	</label><br />
	
	<?php if( ! empty( $wp_roles->get_names() ) ) { foreach( $wp_roles->get_names() as $key => $user_role ) { ?>
	
		<input type="checkbox" value="<?php echo esc_attr( $user_role ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'users_roles' ) ) . '-' . $user_role; ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_roles' ) ); ?>[]" <?php checked( is_array( $instance['users_roles'] ) && in_array( $user_role, $instance['users_roles'] ) ); ?> />
		
		<label for="<?php echo esc_attr( $this->get_field_id( 'users_roles' ) ) . '-' . $user_role; ?>">
			<?php echo esc_html( $user_role ); ?>
		</label><br/>
	
	<?php } } ?>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'users_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_name' ) ); ?>" type="checkbox" <?php checked( $instance['users_name'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_name' ) ); ?>">
		<strong><?php _e( 'Display Name', 'widget-bundle' ); ?></strong>
	</label>
</p>
	
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_name_tag' ) ); ?>">
		<?php _e( 'Display Name in Tag :', 'widget-bundle' ); ?>
	</label>
	<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'users_name_tag' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'users_name_tag' ) ); ?>">
		<option value='h1'<?php selected( $instance['users_name_tag'], 'h1' ); ?>>
			<?php _e( 'h1', 'widget-bundle' ); ?>
		</option>
		<option value='h2'<?php selected( $instance['users_name_tag'], 'h2' ); ?>>
			<?php _e( 'h2', 'widget-bundle' ); ?>
		</option>
		<option value='h3'<?php selected( $instance['users_name_tag'], 'h3' ); ?>>
			<?php _e( 'h3', 'widget-bundle' ); ?>
		</option>
		<option value='h4'<?php selected( $instance['users_name_tag'], 'h4' ); ?>>
			<?php _e( 'h4', 'widget-bundle' ); ?>
		</option>
		<option value='h5'<?php selected( $instance['users_name_tag'], 'h5' ); ?>>
			<?php _e( 'h5', 'widget-bundle' ); ?>
		</option>
		<option value='h6'<?php selected( $instance['users_name_tag'], 'h6' ); ?>>
			<?php _e( 'h6', 'widget-bundle' ); ?>
		</option>		
	</select>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'users_avatar' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_avatar' ) ); ?>" type="checkbox" <?php checked( $instance['users_avatar'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_avatar' ) ); ?>">
		<strong><?php _e( 'Display Avatar', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_avatar_size' ) ); ?>">
		<?php _e( 'Avatar Size :', 'widget-bundle' ); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'users_avatar_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_avatar_size' ) ); ?>" type="number" step="1" min="-1" value="<?php echo (int)( $instance['users_avatar_size'] ); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_avatar_align' ) ); ?>">
		<?php _e( 'Avatar Align :', 'widget-bundle' ); ?>
	</label>	
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'users_avatar_align' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_avatar_align' ) ); ?>">
		<option value="left" <?php selected( $instance['users_avatar_align'], 'left' ); ?>>
			<?php _e( 'Left', 'widget-bundle' ) ?>
		</option>
		<option value="right" <?php selected( $instance['users_avatar_align'], 'right' ); ?>>
			<?php _e( 'Right', 'widget-bundle' ) ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_avatar_shape' ) ); ?>">
		<?php _e( 'Avatar Shape :', 'widget-bundle' ); ?>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'users_avatar_shape' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_avatar_shape' ) ); ?>">
		<option value='square' <?php selected( $instance['users_avatar_shape'], 'square' ); ?> >
			<?php _e( 'Square', 'widget-bundle' ); ?>
		</option>
		<option value='rounded' <?php selected( $instance['users_avatar_shape'], 'rounded' ); ?> >		
			<?php _e( 'Rounded', 'widget-bundle' ); ?>
		</option>
		<option value='rounded-corner' <?php selected( $instance['users_avatar_shape'], 'rounded-corner' ); ?> >		
			<?php _e( 'Rounded Corner', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'users_bio' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_bio' ) ); ?>" type="checkbox" <?php checked( $instance['users_bio'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_bio' ) ); ?>">
		<strong><?php _e( 'Display Bio', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_bio_length' ) ); ?>">
		<?php _e( 'Bio Length :', 'widget-bundle' ); ?>
	</label>
	<input type="number" step="1" min="0" name="<?php echo esc_attr( $this->get_field_name( 'users_bio_length' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'users_bio_length' ) ); ?>" class="widefat" value="<?php echo $instance['users_bio_length']; ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_order' ) ); ?>">
		<strong><?php _e( 'Order :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'users_order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_order' ) ); ?>">
		<option value="ASC"<?php selected( $instance['users_order'], 'ASC' ); ?>>
			<?php _e( 'Ascending', 'widget-bundle' ); ?>
		</option>
		<option value="DESC"<?php selected( $instance['users_order'], 'DESC' ); ?>>
			<?php _e( 'Descending', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_order_by' ) ); ?>">
		<strong><?php _e( 'Order By :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'users_order_by' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_order_by' ) ); ?>">
		<option value="ID"<?php selected( $instance['users_order_by'], 'ID' ); ?>>
			<?php _e( 'ID', 'widget-bundle' ); ?>
		</option>
		<option value="display_name"<?php selected( $instance['users_order_by'], 'display_name' ); ?>>		
			<?php _e( 'Display Name', 'widget-bundle' ); ?>
		</option>
		<option value="user_name"<?php selected( $instance['users_order_by'], 'user_name' ); ?>>		
			<?php _e( 'User Name', 'widget-bundle' ); ?>
		</option>
		<option value="user_login"<?php selected( $instance['users_order_by'], 'user_login' ); ?>>		
			<?php _e( 'User Login', 'widget-bundle' ); ?>
		</option>
		<option value="user_nicename"<?php selected( $instance['users_order_by'], 'user_nicename' ); ?>>	
			<?php _e( 'User Nicename', 'widget-bundle' ); ?>
		</option>
		<option value="user_email"<?php selected( $instance['users_order_by'], 'user_email' ); ?>>		
			<?php _e( 'User Email', 'widget-bundle' ); ?>
		</option>
		<option value="post_count"<?php selected( $instance['users_order_by'], 'post_count' ); ?>>		
			<?php _e( 'Post Count', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_limit' ) ); ?>">
		<strong><?php _e( 'Limit :', 'widget-bundle' ); ?></strong>
	</label>
	<input type="number" step="1" min="0" name="<?php echo esc_attr( $this->get_field_name( 'users_limit' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'users_limit' ) ); ?>" class="widefat" value="<?php echo (int)( $instance['users_limit'] ); ?>" />
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'users_email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_email' ) ); ?>" type="checkbox" <?php checked( $instance['users_email'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_email' ) ); ?>">
		<strong><?php _e( 'Display Email', 'widget-bundle' ); ?></strong>
	</label><br />
	<input id="<?php echo esc_attr( $this->get_field_id( 'users_website' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_website' ) ); ?>" type="checkbox" <?php checked( $instance['users_website'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_website' ) ); ?>">
		<strong><?php _e( 'Display Website', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'users_include_exclude' ) ); ?>">
		<strong><?php _e( 'Filter by users IDs :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'users_include_exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_include_exclude' ) ); ?>">
		<option value="">
			<?php _e( 'None', 'widget-bundle' ); ?>
		</option>	
		<option value="include" <?php selected( $instance['users_include_exclude'], 'include' ); ?>>
			<?php _e( 'Include', 'widget-bundle' ); ?>
		</option>
		<option value="exclude" <?php selected( $instance['users_include_exclude'], 'exclude' ); ?>>
			<?php _e( 'Exclude', 'widget-bundle' ); ?>
		</option>
	</select>
	<span class="description">
		<?php _e( 'Choose options for include or exclude users.', 'widget-bundle' ); ?>
	</span>
</p>

<p>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'users_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'users_id' ) ); ?>" type="text" value="<?php echo $instance['users_id']; ?>" />
	<span class="description">
		<?php _e( 'Ex: 11, 21, 30 (comma-separated list of users ids)', 'widget-bundle' ); ?>
	</span>
</p>	