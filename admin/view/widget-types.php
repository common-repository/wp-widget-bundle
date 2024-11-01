<?php
/**
 * This Files Prints Widgets Types HTML of Widget Bundle Plugin in admin Section.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/admin/view/widget-types
 * @author     Devnath verma <devnathverma@gmail.com>
 */	
?>

<div class="row form-group">
	<div class="col-md-3">
		<div class="wb4wp-checkbox">
			<input id="wb4wp_aboutme_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_aboutme]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_aboutme'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_aboutme'], true ); } ?> />
			<label for="wb4wp_aboutme_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>about-me.JPG" alt="aboutme-widget" class="wb4wp-image-default">
				<span class="wb4wp-label-text">
					<?php _e( 'A widget that display administrator profile with avatar.', 'widget-bundle' ); ?>
				</span>
			</label>
		</div>
	</div>
	<div class="col-md-3">	
		<div class="wb4wp-checkbox">
			<input id="wb4wp_button_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_button]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_button'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_button'], true ); } ?>/>
			<label for="wb4wp_button_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>button.JPG" alt="button-widget" class="wb4wp-image-default">
				<span class="wb4wp-label-text">
					<?php _e( 'A powerful yet simple button widget for your sidebars.', 'widget-bundle' ); ?>
				</span>
			</label>
		</div>
	</div>
	<div class="col-md-3">	
		<div class="wb4wp-checkbox">
			<input id="wb4wp_categories_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_categories]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_categories'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_categories'], true ); } ?> />
			<label for="wb4wp_categories_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>categories.JPG" alt="categories-widget" class="wb4wp-image-default">
				<span class="wb4wp-label-text">
					<?php _e( 'A widget that display recent categories in list or dropdown.', 'widget-bundle' ); ?>
				</span>
			</label>	
		</div>
	</div>	
	<div class="col-md-3">
		<div class="wb4wp-checkbox">
			<input id="wb4wp_comments_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_comments]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_comments'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_comments'], true ); } ?> />
			<label for="wb4wp_comments_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>comments.JPG" alt="comments-widget" class="wb4wp-image-default">
				<span class="wb4wp-label-text">
					<?php _e( 'A widget that displays recent comments widget with extra features.', 'widget-bundle' ); ?>
				</span>
			</label>	
		</div>
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		<div class="wb4wp-checkbox">
			<input id="wb4wp_contact_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_contact]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_contact'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_contact'], true ); } ?> />
			<label for="wb4wp_contact_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>contact.JPG" alt="contact-widget" class="wb4wp-image-default">
				<span class="wb4wp-label-text">
					<?php _e( 'A widget that displays contact information.', 'widget-bundle' ); ?>
				</span>
			</label>	
		</div>	
	</div>
	<div class="col-md-3">
		<div class="wb4wp-checkbox">
			<input id="wb4wp_image_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_image]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_image'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_image'], true ); } ?> />
			<label for="wb4wp_image_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>images.JPG" alt="images-widget" class="wb4wp-image-default">
				<span class="wb4wp-label-text">
					<?php _e( 'A widget that displays images with massive power.', 'widget-bundle' ); ?>
				</span>
			</label>	
		</div>	
	</div>
	<div class="col-md-3">
		<div class="wb4wp-checkbox">
			<input id="wb4wp_links_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_links]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_links'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_links'], true ); } ?> />
			<label for="wb4wp_links_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>links.JPG" alt="links-widget" class="wb4wp-image-default">
				<span class="wb4wp-label-text">
					<?php _e( 'A widget that displays list of links.', 'widget-bundle' ); ?>
				</span>
			</label>	
		</div>	
	</div>
	<div class="col-md-3">
		<div class="wb4wp-checkbox">
			<input id="wb4wp_login_register_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_login_register]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_login_register'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_login_register'], true ); } ?> />
			<label for="wb4wp_login_register_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>login-register.JPG" alt="login-register-widget" class="wb4wp-image-default">				<span class="wb4wp-label-text">
					<?php _e( 'A widget that display the login and register form.', 'widget-bundle' ); ?>
				</span>
			</label>	
		</div>	
	</div>
</div>

<div class="row form-group">
	<div class="col-md-3">
		<div class="wb4wp-checkbox">
			<input id="wb4wp_posts_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_posts]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_posts'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_posts'], true ); } ?>/>
			<label for="wb4wp_posts_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>posts.JPG" alt="posts-widget" class="wb4wp-image-default">
				<span class="wb4wp-label-text">
					<?php _e( 'A widget that gives you total control over the output of your site Posts.', 'widget-bundle' ); ?>
				</span>
			</label>	
		</div>	
	</div>
	<div class="col-md-3">
		<div class="wb4wp-checkbox">
			<input id="wb4wp_social_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_social]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_social'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_social'], true ); } ?> />
			<label for="wb4wp_social_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>social.JPG" alt="social-widget" class="wb4wp-image-default">
				<span class="wb4wp-label-text">
					<?php _e( 'A widget that gives customizable icons which link to all your social media profiles.', 'widget-bundle' ); ?>				</span>
			</label>	
		</div>	
	</div>
	<div class="col-md-3">
		<div class="wb4wp-checkbox">
			<input id="wb4wp_text_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_text]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_text'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_text'], true ); } ?> />
			<label for="wb4wp_text_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>text.JPG" alt="text-widget" class="wb4wp-image-default">
				<span class="wb4wp-label-text">
					<?php _e( 'A widget that display the html, php or text.', 'widget-bundle' ); ?>
				</span>
			</label>	
		</div>	
	</div>
	<div class="col-md-3">
		<div class="wb4wp-checkbox">
			<input id="wb4wp_users_widget" class="wb4wp-checkbox-input" type="checkbox" name="widget_options[widget_types][widget_users]" value="1" <?php if( isset( $widget_options['widget_options']['widget_types']['widget_users'] ) ) { checked( $widget_options['widget_options']['widget_types']['widget_users'], true ); } ?> />
			<label for="wb4wp_users_widget" class="wb4wp-checkbox-label">
				<img src="<?php echo WB4WP_PLUGIN_IMAGES; ?>users.JPG" alt="users-widget" class="wb4wp-image-default">
				<span class="wb4wp-label-text">
					<?php _e( 'A widget that display the users like: Administrators, Authors, Subscribers.', 'widget-bundle' ); ?>
				</span>
			</label>	
		</div>	
	</div>
</div>

<div class="row col-md-3">
	<input type="submit" name="widget_types_submit" class="action-button" value="Save" />
</div>