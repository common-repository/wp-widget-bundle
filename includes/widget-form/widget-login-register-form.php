<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-login-register-form
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
<input id="<?php echo esc_attr( $this->get_field_id( 'register_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'register_link' ) ); ?>" type="checkbox" <?php checked( $instance['register_link'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'register_link' ) ); ?>">
		<strong><?php _e('Display Registration Form', 'widget-bundle')?></strong>
	</label>
</p>

<h6><?php _e('Registration settings', 'widget-bundle')?></h6>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'first_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'first_name' ) ); ?>" type="checkbox" <?php checked( $instance['first_name'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'first_name' ) ); ?>">
		<?php _e( 'Please check to enable <strong>First Name</strong> field.', 'widget-bundle' ); ?>
	</label></br>
	<input id="<?php echo esc_attr( $this->get_field_id( 'last_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'last_name' ) ); ?>" type="checkbox" <?php checked( $instance['last_name'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'last_name' ) ); ?>">
		<?php _e( 'Please check to enable <strong>Last Name</strong> field.', 'widget-bundle' ); ?>
	</label></br>
	<input id="<?php echo esc_attr( $this->get_field_id( 'nick_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nick_name' ) ); ?>" type="checkbox" <?php checked( $instance['nick_name'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'nick_name' ) ); ?>">
		<?php _e( 'Please check to enable <strong>Nick Name</strong> field.', 'widget-bundle' ); ?>
	</label></br>
	<input id="<?php echo esc_attr( $this->get_field_id( 'website' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'website' ) ); ?>" type="checkbox" <?php checked( $instance['website'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'website' ) ); ?>">
		<?php _e( 'Please check to enable <strong>Website</strong> field.', 'widget-bundle' ); ?>
	</label></br>
	<input id="<?php echo esc_attr( $this->get_field_id( 'about_bio' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'about_bio' ) ); ?>" type="checkbox" <?php checked( $instance['about_bio'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'about_bio' ) ); ?>">
		<?php _e( 'Please check to enable <strong>About/Bio</strong> field.', 'widget-bundle' ); ?>
	</label>
</p>

<h6><?php _e('Login settings', 'widget-bundle')?></h6>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'forgot_password_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'forgot_password_link' ) ); ?>" type="checkbox" <?php checked( $instance['forgot_password_link'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'forgot_password_link' ) ); ?>">
		<?php _e( 'Please check to enable <strong>Forgot Password</strong> Link.', 'widget-bundle' ); ?>
	</label></br>
	<input id="<?php echo esc_attr( $this->get_field_id( 'remember_me' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'remember_me' ) ); ?>" type="checkbox" <?php checked( $instance['remember_me'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'remember_me' ) ); ?>">
		<?php _e( 'Please check to enable <strong>Remember me</strong> Link.', 'widget-bundle' ); ?>
	</label>
</p>

<p>	
	<input id="<?php echo esc_attr( $this->get_field_id( 'login_show_widget' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'login_show_widget' ) ); ?>" type="checkbox" <?php checked( $instance['login_show_widget'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'login_show_widget' ) ); ?>">
		<strong><?php _e( 'Logged-in Display Widget', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'login_title' ) ); ?>">
		<strong><?php _e( 'Logged-in Title :', 'widget-bundle' ); ?></strong>
	</label></br>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'login_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'login_title' ) ); ?>" type="text" value="<?php echo $instance['login_title']; ?>" />
	<span class="description">
		<?php _e( 'Please enter here logged in title. Default is "Welcome %username%".', 'widget-bundle' ); ?>
	</span>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'login_title_tag' ) ); ?>">
		<strong><?php _e( 'Title Tag :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'login_title_tag' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'login_title_tag' ) ); ?>">
		<option value='h1'<?php selected( $instance['login_title_tag'], 'h1' ); ?>>
			<?php _e( 'h1', 'widget-bundle' ); ?>
		</option>
		<option value='h2'<?php selected( $instance['login_title_tag'], 'h2' ); ?>>
			<?php _e( 'h2', 'widget-bundle' ); ?>
		</option>
		<option value='h3'<?php selected( $instance['login_title_tag'], 'h3' ); ?>>
			<?php _e( 'h3', 'widget-bundle' ); ?>
		</option>
		<option value='h4'<?php selected( $instance['login_title_tag'], 'h4' ); ?>>
			<?php _e( 'h4', 'widget-bundle' ); ?>
		</option>
		<option value='h5'<?php selected( $instance['login_title_tag'], 'h5' ); ?>>
			<?php _e( 'h5', 'widget-bundle' ); ?>
		</option>
		<option value='h6'<?php selected( $instance['login_title_tag'], 'h6' ); ?>>
			<?php _e( 'h6', 'widget-bundle' ); ?>
		</option>		
	</select>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'login_user_avatar' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'login_user_avatar' ) ); ?>" type="checkbox" <?php checked( $instance['login_user_avatar'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'login_user_avatar' ) ); ?>">
		<strong><?php _e( 'Logged-in Display Avatar', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'login_avatar_size' ) ); ?>">
		<?php _e( 'Avatar Size :', 'widget-bundle' ); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'login_avatar_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'login_avatar_size' ) ); ?>" type="number" step="1" min="-1" value="<?php echo (int)( $instance['login_avatar_size'] ); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'login_avatar_align' ) ); ?>">
		<?php _e( 'Avatar Align :', 'widget-bundle' ); ?>
	</label>	
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'login_avatar_align' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'login_avatar_align' ) ); ?>">
		<option value="left" <?php selected( $instance['login_avatar_align'], 'left' ); ?>>
			<?php _e( 'Left', 'widget-bundle' ) ?>
		</option>
		<option value="right" <?php selected( $instance['login_avatar_align'], 'right' ); ?>>
			<?php _e( 'Right', 'widget-bundle' ) ?>
		</option>
		<option value="center" <?php selected( $instance['login_avatar_align'], 'center' ); ?>>
			<?php _e( 'Center', 'widget-bundle' ) ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'login_avatar_shape' ) ); ?>">
		<?php _e( 'Avatar Shape :', 'widget-bundle' ); ?>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'login_avatar_shape' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'login_avatar_shape' ) ); ?>">
		<option value='square' <?php selected( $instance['login_avatar_shape'], 'square' ); ?> >
			<?php _e( 'Square', 'widget-bundle' ); ?>
		</option>
		<option value='rounded' <?php selected( $instance['login_avatar_shape'], 'rounded' ); ?> >		
			<?php _e( 'Rounded', 'widget-bundle' ); ?>
		</option>
		<option value='rounded-corner' <?php selected( $instance['login_avatar_shape'], 'rounded-corner' ); ?> >		
			<?php _e( 'Rounded Corner', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'login_redirect_url' ) ); ?>">
		<strong><?php _e( 'Login Redirect URL :', 'widget-bundle' ); ?></strong>
	</label></br>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'login_redirect_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'login_redirect_url' ) ); ?>" type="text" value="<?php echo $instance['login_redirect_url']; ?>" />
	<span class="description">
		<?php _e( 'Please enter here login redirect URL. Default is Current Page URL.', 'widget-bundle' ); ?>
	</span>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'logout_redirect_url' ) ); ?>">
		<strong><?php _e( 'Logout Redirect URL :', 'widget-bundle' ); ?></strong>
	</label></br>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'logout_redirect_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'logout_redirect_url' ) ); ?>" type="text" value="<?php echo $instance['logout_redirect_url']; ?>" />
	<span class="description">
		<?php _e( 'Please enter here logout redirect URL. Default is Current Page URL.', 'widget-bundle' ); ?>
	</span>
</p>