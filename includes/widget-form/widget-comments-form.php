<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-comments-form
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
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_post_type' ) ); ?>">
		<strong><?php _e( 'Post Types :', 'widget-bundle' ); ?></strong>
	</label><br/>
	<?php 

	$post_types = get_post_types( array( 'public' => true ), 'objects' );
	// remove attachment from the list
	unset( $post_types['attachment'] );
	
	foreach ( $post_types as $type ) { ?>
	
	<input type="checkbox" value="<?php echo esc_attr( $type->name ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'comment_post_type' ) ) . '-' . $type->name; ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_post_type' ) ); ?>[]" <?php checked( is_array( $instance['comment_post_type'] ) && in_array( $type->name, $instance['comment_post_type'] ) ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_post_type' ) ) . '-' . $type->name; ?>">
		<?php echo esc_html( $type->labels->name ); ?>
	</label><br/>
	
	<?php } ?>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'comment_show_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_show_title' ) ); ?>" type="checkbox" <?php checked( $instance['comment_show_title'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_show_title' ) ); ?>">
		<strong><?php _e( 'Display Title', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'comment_title_tag' ); ?>">
		<?php _e( 'Title Tag :', 'widget-bundle' ); ?>
	</label>
	<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'comment_title_tag' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'comment_title_tag' ) ); ?>">
		<option value='h1'<?php selected( $instance['comment_title_tag'], 'h1' ); ?>>
			<?php _e( 'h1', 'widget-bundle' ); ?>
		</option>
		<option value='h2'<?php selected( $instance['comment_title_tag'], 'h2' ); ?>>
			<?php _e( 'h2', 'widget-bundle' ); ?>
		</option>
		<option value='h3'<?php selected( $instance['comment_title_tag'], 'h3' ); ?>>
			<?php _e( 'h3', 'widget-bundle' ); ?>
		</option>
		<option value='h4'<?php selected( $instance['comment_title_tag'], 'h4' ); ?>>
			<?php _e( 'h4', 'widget-bundle' ); ?>
		</option>
		<option value='h5'<?php selected( $instance['comment_title_tag'], 'h5' ); ?>>
			<?php _e( 'h5', 'widget-bundle' ); ?>
		</option>
		<option value='h6'<?php selected( $instance['comment_title_tag'], 'h6' ); ?>>
			<?php _e( 'h6', 'widget-bundle' ); ?>
		</option>		
	</select>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'comment_avatar' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_avatar' ) ); ?>" type="checkbox" <?php checked( $instance['comment_avatar'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_avatar' ) ); ?>">
		<strong><?php _e( 'Display Avatar', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_avatar_size' ) ); ?>">
		<?php _e( 'Avatar Size :', 'widget-bundle' ); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'comment_avatar_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_avatar_size' ) ); ?>" type="number" step="1" min="-1" value="<?php echo (int)( $instance['comment_avatar_size'] ); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_avatar_align' ) ); ?>">
		<?php _e( 'Avatar Align :', 'widget-bundle' ); ?>
	</label>	
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'comment_avatar_align' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_avatar_align' ) ); ?>">
		<option value="left" <?php selected( $instance['comment_avatar_align'], 'left' ); ?>>
			<?php _e( 'Left', 'widget-bundle' ) ?>
		</option>
		<option value="right" <?php selected( $instance['comment_avatar_align'], 'right' ); ?>>
			<?php _e( 'Right', 'widget-bundle' ) ?>
		</option>
		<option value="center" <?php selected( $instance['comment_avatar_align'], 'center' ); ?>>
			<?php _e( 'Center', 'widget-bundle' ) ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_avatar_shape' ) ); ?>">
		<?php _e( 'Avatar Shape :', 'widget-bundle' ); ?>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'comment_avatar_shape' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_avatar_shape' ) ); ?>">
		<option value='square' <?php selected( $instance['comment_avatar_shape'], 'square' ); ?> >
			<?php _e( 'Square', 'widget-bundle' ); ?>
		</option>
		<option value='rounded' <?php selected( $instance['comment_avatar_shape'], 'rounded' ); ?> >		
			<?php _e( 'Rounded', 'widget-bundle' ); ?>
		</option>
		<option value='rounded-corner' <?php selected( $instance['comment_avatar_shape'], 'rounded-corner' ); ?> >		
			<?php _e( 'Rounded Corner', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'comment_excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_excerpt' ) ); ?>" type="checkbox" <?php checked( $instance['comment_excerpt'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_excerpt' ) ); ?>">
		<strong><?php _e( 'Display Excerpt', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_excerpt_length' ) ); ?>">
		<?php _e( 'Excerpt Length :', 'widget-bundle' ); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'comment_excerpt_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_excerpt_length' ) ); ?>" type="number" step="1" min="0" value="<?php echo $instance['comment_excerpt_length']; ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_limit' ) ); ?>">
		<strong><?php _e( 'Limit of Comments', 'widget-bundle' ); ?></strong>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'comment_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_limit' ) ); ?>" type="number" step="1" min="-1" value="<?php echo $instance['comment_limit']; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'comment_offset' ); ?>">
		<strong><?php _e( 'Offset :', 'widget-bundle' ); ?></strong>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'comment_offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_offset' ) ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['comment_offset'] ); ?>" />
	<span class="description"><?php _e( 'The number of comments to skip', 'widget-bundle' ); ?></span>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_status' ) ); ?>">
		<strong><?php _e( 'Comment Status :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'comment_status' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_status' ) ); ?>">
		<option value="approve"<?php selected( $instance['comment_status'], 'approve' ); ?>>
			<?php _e( 'Approve', 'widget-bundle' ); ?>
		</option>
		<option value="hold"<?php selected( $instance['comment_status'], 'hold' ); ?>>
			<?php _e( 'Unapprove', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_order' ) ); ?>">
		<strong><?php _e( 'Order :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'comment_order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_order' ) ); ?>">
		<option value="ASC"<?php selected( $instance['comment_order'], 'ASC' ); ?>>
			<?php _e( 'Ascending', 'widget-bundle' ); ?>
		</option>
		<option value="DESC"<?php selected( $instance['comment_order'], 'DESC' ); ?>>
			<?php _e( 'Descending', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'comment_order_by' ) ); ?>">
		<strong><?php _e( 'Order By :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'comment_order_by' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_order_by' ) ); ?>">
		<option value="">
			<?php _e( 'None', 'widget-bundle' ); ?>
		</option>
		<option value="comment_agent"<?php selected( $instance['comment_order_by'], 'comment_agent' ); ?>>
			<?php _e( 'Comment Agent', 'widget-bundle' ); ?>
		</option>
		<option value="comment_approved"<?php selected( $instance['comment_order_by'], 'comment_approved' ); ?>>
			<?php _e( 'Comment Approved', 'widget-bundle' ); ?>
		</option>	
		<option value="comment_author"<?php selected( $instance['comment_order_by'], 'comment_author' ); ?>>
			<?php _e( 'Comment Author', 'widget-bundle' ); ?>
		</option>
		<option value="comment_author_email"<?php selected( $instance['comment_order_by'], 'comment_author_email' ); ?>>
			<?php _e( 'Comment Author Email', 'widget-bundle' ); ?>
		</option>
		<option value="comment_author_url"<?php selected( $instance['comment_order_by'], 'comment_author_url' ); ?>>
			<?php _e( 'Comment Author URL', 'widget-bundle' ); ?>
		</option>
		<option value="comment_content"<?php selected( $instance['comment_order_by'], 'comment_content' ); ?>>
			<?php _e( 'Comment Content', 'widget-bundle' ); ?>
		</option>
		<option value="comment_date"<?php selected( $instance['comment_order_by'], 'comment_date' ); ?>>
			<?php _e( 'Comment Date', 'widget-bundle' ); ?>
		</option>
		<option value="comment_date_gmt"<?php selected( $instance['comment_order_by'], 'comment_date_gmt' ); ?>>
			<?php _e( 'Comment Date GMT', 'widget-bundle' ); ?>
		</option>
		<option value="comment_ID"<?php selected( $instance['comment_order_by'], 'comment_ID' ); ?>>
			<?php _e( 'Comment ID', 'widget-bundle' ); ?>
		</option>
		<option value="comment_karma"<?php selected( $instance['comment_order_by'], 'comment_karma' ); ?>>
			<?php _e( 'Comment Karma', 'widget-bundle' ); ?>
		</option>
		<option value="comment_parent"<?php selected( $instance['comment_order_by'], 'comment_parent' ); ?>>
			<?php _e( 'Comment Parent', 'widget-bundle' ); ?>
		</option>
		<option value="comment_post_ID"<?php selected( $instance['comment_order_by'], 'comment_post_ID' ); ?>>
			<?php _e( 'Comment Post ID', 'widget-bundle' ); ?>
		</option>
		<option value="comment_type"<?php selected( $instance['comment_order_by'], 'comment_type' ); ?>>
			<?php _e( 'Comment Type', 'widget-bundle' ); ?>
		</option>
		<option value="user_id"<?php selected( $instance['comment_order_by'], 'user_id' ); ?>>
			<?php _e( 'User ID', 'widget-bundle' ); ?>
		</option>
	</select>
</p>