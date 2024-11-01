<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-links-form
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
	<input id="<?php echo esc_attr( $this->get_field_id( 'link_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_title' ) ); ?>" type="checkbox" <?php checked( $instance['link_title'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'link_title' ) ); ?>">
		<strong><?php _e( 'Display Title', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'link_title_tag' ) ); ?>">
		<strong><?php _e( 'Title Tag :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'link_title_tag' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'link_title_tag' ) ); ?>">
		<option value='h1'<?php selected( $instance['link_title_tag'], 'h1' ); ?>>
			<?php _e( 'h1', 'widget-bundle' ); ?>
		</option>
		<option value='h2'<?php selected( $instance['link_title_tag'], 'h2' ); ?>>
			<?php _e( 'h2', 'widget-bundle' ); ?>
		</option>
		<option value='h3'<?php selected( $instance['link_title_tag'], 'h3' ); ?>>
			<?php _e( 'h3', 'widget-bundle' ); ?>
		</option>
		<option value='h4'<?php selected( $instance['link_title_tag'], 'h4' ); ?>>
			<?php _e( 'h4', 'widget-bundle' ); ?>
		</option>
		<option value='h5'<?php selected( $instance['link_title_tag'], 'h5' ); ?>>
			<?php _e( 'h5', 'widget-bundle' ); ?>
		</option>
		<option value='h6'<?php selected( $instance['link_title_tag'], 'h6' ); ?>>
			<?php _e( 'h6', 'widget-bundle' ); ?>
		</option>		
	</select>
</p>

<p>	
	<input id="<?php echo esc_attr( $this->get_field_id( 'link_rating' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_rating' ) ); ?>" type="checkbox" <?php checked( $instance['link_rating'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'link_rating' ) ); ?>">
		<strong><?php _e( 'Display Rating', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'link_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_image' ) ); ?>" type="checkbox" <?php checked( $instance['link_image'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'link_image' ) ); ?>">
		<strong><?php _e( 'Display Image', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'link_image_size' ) ); ?>">
		<strong><?php _e( 'Size :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'link_image_size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'link_image_size' ) ); ?>" onChange="WB4WP_LINKS.TLISizes( '<?php echo $this->get_field_id( '' ); ?>' );">
		<option value='thumbnail'<?php selected( $instance['link_image_size'], 'thumbnail' ); ?>>
			<?php _e( 'Thumbnail', 'widget-bundle' ); ?>
		</option>
		<option value='medium'<?php selected( $instance['link_image_size'], 'medium' ); ?>>
			<?php _e( 'Medium', 'widget-bundle' ); ?>
		</option>
		<option value='large'<?php selected( $instance['link_image_size'], 'large' ); ?>>
			<?php _e( 'Large', 'widget-bundle' ); ?>
		</option>
		<option value='full'<?php selected( $instance['link_image_size'], 'full' ); ?>>
			<?php _e( 'Full Size', 'widget-bundle' ); ?>
		</option>
		<option value='custom'<?php selected( $instance['link_image_size'], 'custom' ); ?>>
			<?php _e( 'Custom', 'widget-bundle' ); ?>
		</option>		
	</select>
</p>

<div id="<?php echo esc_attr( $this->get_field_id( 'wb4wp_custom_link_image_size' ) ); ?>" <?php if ( empty( $instance['link_image_size'] ) || $instance['link_image_size'] != 'custom' ) { ?>style="display:none;"<?php } ?>>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'link_image_width' ) ); ?>">
			<?php _e( 'width :', 'widget-bundle' ); ?>
		</label>
		<input class="small-input widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_image_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_image_width' ) ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['link_image_width'] ); ?>"/>
	</p>	
	
	<p>	
		<label for="<?php echo $this->get_field_id( 'link_image_height' ); ?>">
			<?php _e( 'Height :', 'widget-bundle' ); ?>
		</label>
		<input class= "small-input widefat" id="<?php echo $this->get_field_id( 'link_image_height' ); ?>" name="<?php echo $this->get_field_name( 'link_image_height' ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['link_image_height'] ); ?>" />
	</p>
	
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'link_image_align' ) ); ?>">
			<?php _e( 'Align :', 'widget-bundle' ); ?>
		</label>	
		<select class="small-input widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_image_align' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_image_align' ) ); ?>">
			<option value="left" <?php selected( $instance['link_image_align'], 'left' ); ?>>
				<?php _e( 'Left', 'widget-bundle' ) ?>
			</option>
			<option value="right" <?php selected( $instance['link_image_align'], 'right' ); ?>>
				<?php _e( 'Right', 'widget-bundle' ) ?>
			</option>
		</select>
	</p>
	
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'link_image_shape' ) ); ?>">
			<?php _e( 'Shape :', 'widget-bundle' ); ?>
		</label>
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_image_shape' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_image_shape' ) ); ?>">
			<option value='square' <?php selected( $instance['link_image_shape'], 'square' ); ?> >
				<?php _e( 'Square', 'widget-bundle' ); ?>
			</option>
			<option value='rounded' <?php selected( $instance['link_image_shape'], 'rounded' ); ?> >		
				<?php _e( 'Rounded', 'widget-bundle' ); ?>
			</option>
			<option value='rounded-corner' <?php selected( $instance['link_image_shape'], 'rounded-corner' ); ?> >		
				<?php _e( 'Rounded Corner', 'widget-bundle' ); ?>
			</option>
		</select>
	</p>
</div>	

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'link_description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_description' ) ); ?>" type="checkbox" <?php checked( $instance['link_description'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'link_description' ) ); ?>">
		<strong><?php _e( 'Display Description', 'widget-bundle' ); ?></strong>
	</label></br>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'link_description_length' ) ); ?>">
		<?php _e( 'Description Length :', 'widget-bundle' ); ?>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_description_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_description_length' ) ); ?>" type="number" step="1" min="0" value="<?php echo $instance['link_description_length']; ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'link_order' ) ); ?>">
		<strong><?php _e( 'Order :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_order' ) ); ?>">
		<option value="ASC"<?php selected( $instance['link_order'], 'ASC' ); ?>>
			<?php _e( 'Ascending', 'widget-bundle' ); ?>
		</option>
		<option value="DESC"<?php selected( $instance['link_order'], 'DESC' ); ?>>
			<?php _e( 'Descending', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'link_order_by' ) ); ?>">
		<strong><?php _e( 'Order By :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_order_by' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_order_by' ) ); ?>">
		<option value="id"<?php selected( $instance['link_order_by'], 'id' ); ?>>
			<?php _e( 'ID', 'widget-bundle' ); ?>
		</option>
		<option value="name"<?php selected( $instance['link_order_by'], 'name' ); ?>>
			<?php _e( 'Name', 'widget-bundle' ); ?>
		</option>
		<option value="rand" <?php selected( $instance['link_order_by'], 'rand' ); ?>>
			<?php _e( 'Random', 'widget-bundle' ); ?>
		</option>
		<option value="date" <?php selected( $instance['link_order_by'], 'date' ); ?>>
			<?php _e( 'Date', 'widget-bundle' ); ?>
		</option>
		<option value="slug"<?php selected( $instance['link_order_by'], 'slug' ); ?>>
			<?php _e( 'Slug', 'widget-bundle' ); ?>
		</option>
		<option value="count"<?php selected( $instance['link_order_by'], 'count' ); ?>>
			<?php _e( 'Count', 'widget-bundle' ); ?>
		</option>
	</select>
</p>	

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'link_limit' ) ); ?>">
		<strong><?php _e( 'Limit of links :', 'widget-bundle' ); ?></strong>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_limit' ) ); ?>" type="number" step="1" min="-1" value="<?php echo $instance['link_limit']; ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'link_categories' ) ); ?>">
		<strong><?php _e( 'Filter by Categories :', 'widget-bundle' ); ?></strong>
	</label>
</p>

<div class="wb4wp-multi-checkbox">	
	<?php 
		if ( get_terms( 'link_category' ) ) {
			foreach ( get_terms( 'link_category' ) as $category ) {
		?>
		<input type="checkbox" value="<?php echo (int) $category->term_id; ?>" id="<?php echo esc_attr( $this->get_field_id( 'link_categories' ) ) . '-' . (int) $category->term_id; ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_categories' ) ); ?>[]" <?php checked( is_array( $instance['link_categories'] ) && in_array( $category->term_id, $instance['link_categories'] ) ); ?> />
		<label for="<?php echo esc_attr( $this->get_field_id( 'link_categories' ) ) . '-' . (int) $category->term_id; ?>">
			<?php echo esc_html( $category->name ); ?>
		</label></br>
		<?php
			}
		}
	?>
</div>