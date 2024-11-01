<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-posts-form
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
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>">
		<strong><?php _e( 'Post Types :', 'widget-bundle' ); ?></strong>
	</label><br/>
	<?php 

	$post_types = get_post_types( array( 'public' => true ), 'objects' );
	// remove attachment from the list
	unset( $post_types['attachment'] );
	
	foreach ( $post_types as $type ) { ?>
	
	<input type="checkbox" value="<?php echo esc_attr( $type->name ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ) . '-' . $type->name; ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>[]" <?php checked( is_array( $instance['post_type'] ) && in_array( $type->name, $instance['post_type'] ) ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ) . '-' . $type->name; ?>">
		<?php echo esc_html( $type->labels->name ); ?>
	</label><br/>
	
	<?php } ?>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_status' ) ); ?>">
		<strong><?php _e( 'Post Status :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_status' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_status' ) ); ?>" style="width:100%;">
		<?php foreach ( get_available_post_statuses() as $status_value => $status_label ) { ?>
			<option value="<?php echo esc_attr( $status_label ); ?>" <?php selected( $instance['post_status'], $status_label ); ?>><?php echo esc_html( ucfirst( $status_label ) ); ?></option>
		<?php } ?>
	</select>
</p>

<p>	
<input id="<?php echo esc_attr( $this->get_field_id( 'post_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_title' ) ); ?>" type="checkbox" <?php checked( $instance['post_title'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_title' ) ); ?>">
		<strong><?php _e( 'Display Title', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_title_tag' ) ); ?>">
		<?php _e( 'Title Tag :', 'widget-bundle' ); ?>
	</label>
	<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'post_title_tag' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'post_title_tag' ) ); ?>">
		<option value='h1'<?php selected( $instance['post_title_tag'], 'h1' ); ?>>
			<?php _e( 'h1', 'widget-bundle' ); ?>
		</option>
		<option value='h2'<?php selected( $instance['post_title_tag'], 'h2' ); ?>>
			<?php _e( 'h2', 'widget-bundle' ); ?>
		</option>
		<option value='h3'<?php selected( $instance['post_title_tag'], 'h3' ); ?>>
			<?php _e( 'h3', 'widget-bundle' ); ?>
		</option>
		<option value='h4'<?php selected( $instance['post_title_tag'], 'h4' ); ?>>
			<?php _e( 'h4', 'widget-bundle' ); ?>
		</option>
		<option value='h5'<?php selected( $instance['post_title_tag'], 'h5' ); ?>>
			<?php _e( 'h5', 'widget-bundle' ); ?>
		</option>
		<option value='h6'<?php selected( $instance['post_title_tag'], 'h6' ); ?>>
			<?php _e( 'h6', 'widget-bundle' ); ?>
		</option>		
	</select>
</p>
	
<p>	
	<input id="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_thumbnail' ) ); ?>" type="checkbox" <?php checked( $instance['post_thumbnail'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail' ) ); ?>">
		<strong><?php _e( 'Display Thumbnails', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail_size' ) ); ?>">
		<?php _e( 'Size :', 'widget-bundle' ); ?>
	</label>
	<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'post_thumbnail_size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail_size' ) ); ?>" onChange="WB4WP_POSTS.TPTSizes( '<?php echo $this->get_field_id( '' ); ?>' );">
		<option value='thumbnail'<?php selected( $instance['post_thumbnail_size'], 'thumbnail' ); ?>>
			<?php _e( 'Thumbnail', 'widget-bundle' ); ?>
		</option>
		<option value='medium'<?php selected( $instance['post_thumbnail_size'], 'medium' ); ?>>
			<?php _e( 'Medium', 'widget-bundle' ); ?>
		</option>
		<option value='large'<?php selected( $instance['post_thumbnail_size'], 'large' ); ?>>
			<?php _e( 'Large', 'widget-bundle' ); ?>
		</option>
		<option value='full'<?php selected( $instance['post_thumbnail_size'], 'full' ); ?>>
			<?php _e( 'Full Size', 'widget-bundle' ); ?>
		</option>
		<option value='custom'<?php selected( $instance['post_thumbnail_size'], 'custom' ); ?>>
			<?php _e( 'Custom', 'widget-bundle' ); ?>
		</option>		
	</select>
</p>

<div id="<?php echo esc_attr( $this->get_field_id( 'wb4wp_custom_post_thumbnail' ) ); ?>" <?php if ( empty( $instance['post_thumbnail_size'] ) || $instance['post_thumbnail_size'] != 'custom' ) { ?>style="display:none;"<?php } ?>>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail_width' ) ); ?>">
			<?php _e( 'width :', 'widget-bundle' ); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_thumbnail_width' ) ); ?>" type="number" step="1" min="40" value="<?php echo (int)( $instance['post_thumbnail_width'] ); ?>" />
	</p>	
	
	<p>	
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail_height' ) ); ?>">
			<?php _e( 'Height :', 'widget-bundle' ); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail_height' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_thumbnail_height' ) ); ?>" type="number" step="1" min="40" value="<?php echo (int)( $instance['post_thumbnail_height'] ); ?>" />
	</p>
	
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail_align' ) ); ?>">
			<?php _e( 'Align :', 'widget-bundle' ); ?>
		</label>	
		<select class="small-input widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail_align' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_thumbnail_align' ) ); ?>">
			<option value="left" <?php selected( $instance['post_thumbnail_align'], 'left' ); ?>>
				<?php _e( 'Left', 'widget-bundle' ) ?>
			</option>
			<option value="right" <?php selected( $instance['post_thumbnail_align'], 'right' ); ?>>
				<?php _e( 'Right', 'widget-bundle' ) ?>
			</option>
		</select>
	</p>
	
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail_shape' ) ); ?>">
			<?php _e( 'Shape :', 'widget-bundle' ); ?>
		</label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_thumbnail_shape' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_thumbnail_shape' ) ); ?>">
			<option value='square' <?php selected( $instance['post_thumbnail_shape'], 'square' ); ?> >
				<?php _e( 'Square', 'widget-bundle' ); ?>
			</option>
			<option value='rounded' <?php selected( $instance['post_thumbnail_shape'], 'rounded' ); ?> >		
				<?php _e( 'Rounded', 'widget-bundle' ); ?>
			</option>
			<option value='rounded-corner' <?php selected( $instance['post_thumbnail_shape'], 'rounded-corner' ); ?> >		
				<?php _e( 'Rounded Corner', 'widget-bundle' ); ?>
			</option>
		</select>
	</p>
</div>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'post_excerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_excerpt' ) ); ?>" type="checkbox" <?php checked( $instance['post_excerpt'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_excerpt' ) ); ?>">
		<strong><?php _e( 'Display Excerpt', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_excerpt_length' ) ); ?>">
		<?php _e( 'Excerpt Length :', 'widget-bundle' ); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_excerpt_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_excerpt_length' ) ); ?>" type="number" step="1" min="0" value="<?php echo $instance['post_excerpt_length']; ?>" />
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'post_readmore' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_readmore' ) ); ?>" type="checkbox" <?php checked( $instance['post_readmore'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_readmore' ) ); ?>">
		<strong><?php _e( 'Display Readmore', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_readmore_text' ) ); ?>">
		<?php _e( 'Readmore Text', 'widget-bundle' ); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_readmore_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_readmore_text' ) ); ?>" type="text" value="<?php echo strip_tags( $instance['post_readmore_text'] ); ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_order' ) ); ?>">
		<strong><?php _e( 'Order :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_order' ) ); ?>">
		<option value="ASC" <?php selected( $instance['post_order'], 'ASC' ); ?>>
			<?php _e( 'Ascending', 'widget-bundle' ); ?>
		</option>
		<option value="DESC" <?php selected( $instance['post_order'], 'DESC' ); ?>>
			<?php _e( 'Descending', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_order_by' ) ); ?>">
		<strong><?php _e( 'Order By :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_order_by' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_order_by' ) ); ?>">
		<option value="ID" <?php selected( $instance['post_order_by'], 'ID' ); ?>>
			<?php _e( 'ID', 'widget-bundle' ) ?>
		</option>
		<option value="author" <?php selected( $instance['post_order_by'], 'author' ); ?>>
			<?php _e( 'Author', 'widget-bundle' ) ?>
		</option>
		<option value="title" <?php selected( $instance['post_order_by'], 'title' ); ?>>
			<?php _e( 'Title', 'widget-bundle' ) ?>
		</option>
		<option value="date" <?php selected( $instance['post_order_by'], 'date' ); ?>>
			<?php _e( 'Date', 'widget-bundle' ) ?>
		</option>
		<option value="modified" <?php selected( $instance['post_order_by'], 'modified' ); ?>>
			<?php _e( 'Modified', 'widget-bundle' ) ?>
		</option>
		<option value="rand" <?php selected( $instance['post_order_by'], 'rand' ); ?>>
			<?php _e( 'Random', 'widget-bundle' ) ?>
		</option>
		<option value="comment_count" <?php selected( $instance['post_order_by'], 'comment_count' ); ?>>
			<?php _e( 'Comment Count', 'widget-bundle' ) ?>
		</option>
		<option value="menu_order" <?php selected( $instance['post_order_by'], 'menu_order' ); ?>>
			<?php _e( 'Menu Order', 'widget-bundle' ) ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_limit' ) ); ?>">
		<strong><?php _e( 'Limit of Posts :', 'widget-bundle' ); ?></strong>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_limit' ) ); ?>" type="number" step="1" min="1" value="<?php echo $instance['post_limit']; ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_offset' ) ); ?>">
		<strong><?php _e( 'Offset :', 'widget-bundle' ); ?></strong>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_offset' ) ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['post_offset'] ); ?>" />
	<span class="description"><?php _e( 'The number of posts to skip.', 'widget-bundle' ); ?></span>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'post_show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_show_date' ) ); ?>" type="checkbox" <?php checked( $instance['post_show_date'], true ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_show_date' ) ); ?>">
		<strong><?php _e( 'Display Date', 'widget-bundle' ); ?></strong>
	</label></br>
	<input id="<?php echo esc_attr( $this->get_field_id( 'post_show_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_show_author' ) ); ?>" type="checkbox" <?php checked( $instance['post_show_author'], true ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_show_author' ) ); ?>">
		<strong><?php _e( 'Display Author', 'widget-bundle' ); ?></strong>
	</label></br>
	<input id="<?php echo esc_attr( $this->get_field_id( 'post_show_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_show_categories' ) ); ?>" type="checkbox" <?php checked( $instance['post_show_categories'], true ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_show_categories' ) ); ?>">
		<strong><?php _e( 'Display Categories', 'widget-bundle' ); ?></strong>
	</label></br>
	<input id="<?php echo esc_attr( $this->get_field_id( 'post_show_tags' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_show_tags' ) ); ?>" type="checkbox" <?php checked( $instance['post_show_tags'], true ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_show_tags' ) ); ?>">
		<strong><?php _e( 'Display Tags', 'widget-bundle' ); ?></strong>
	</label></br>
	<input id="<?php echo esc_attr( $this->get_field_id( 'post_show_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_show_count' ) ); ?>" type="checkbox" <?php checked( $instance['post_show_count'], true ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_show_count' ) ); ?>">
		<strong><?php _e( 'Display Comment Count', 'widget-bundle' ); ?></strong>
	</label></br>
	<input class="checkbox" type="checkbox" <?php checked( $instance['post_ignore_sticky'], true ); ?> id="<?php echo esc_attr( $this->get_field_id( 'post_ignore_sticky' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_ignore_sticky' ) ); ?>" />
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_ignore_sticky' ) ); ?>">
		<strong><?php _e( 'Ignore sticky posts', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_categories' ) ); ?>">
		<strong><?php _e( 'Filter by Categories :', 'widget-bundle' ); ?></strong>
	</label>
</p>	

<div class="wb4wp-multi-checkbox">
	<?php 
		if( get_terms( 'category' ) ) {
			foreach ( get_terms( 'category' ) as $category ) { 
		?>
		<input type="checkbox" value="<?php echo (int) $category->term_id; ?>" id="<?php echo esc_attr( $this->get_field_id( 'categories' ) ) . '-' . (int) $category->term_id; ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_categories' ) ); ?>[]" <?php checked( is_array( $instance['post_categories'] ) && in_array( $category->term_id, $instance['post_categories'] ) ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_categories' ) ) . '-' . (int) $category->term_id; ?>">
			<?php echo esc_html( $category->name ); ?>
		</label></br>
		<?php 
		} 
	}
	?>
</div>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'post_tags' ) ); ?>">
		<strong><?php _e( 'Filter by Tags :', 'widget-bundle' ); ?></strong>
	</label>
</p>

<div class="wb4wp-multi-checkbox">	
	<?php
		if( get_terms( 'post_tag' ) ) {
			foreach ( get_terms( 'post_tag' ) as $post_tag ) { 
		?>
		<input type="checkbox" value="<?php echo (int) $post_tag->term_id; ?>" id="<?php echo esc_attr( $this->get_field_id( 'post_tags' ) ) . '-' . (int) $post_tag->term_id; ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_tags' ) ); ?>[]" <?php checked( is_array( $instance['post_tags'] ) && in_array( $post_tag->term_id, $instance['post_tags'] ) ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'post_tags' ) ) . '-' . (int) $post_tag->term_id; ?>">
			<?php echo esc_html( $post_tag->name ); ?>
		</label></br>
		<?php 
		} 
	}
	?>
</div>