<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-categories-form
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
	<label for="<?php echo esc_attr( $this->get_field_id( 'categories_taxonomy' ) ); ?>">
		<strong><?php _e( 'Select Taxonomy :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'categories_taxonomy' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories_taxonomy' ) ); ?>">
	<?php 
		if ( $taxonomies ) {
			foreach ( $taxonomies  as $taxonomy ) {
		?>
			<option value="<?php echo $taxonomy->name; ?>"<?php selected( $instance['categories_taxonomy'], $taxonomy->name); ?>>						<?php echo $taxonomy->labels->singular_name; ?>
			</option>
		<?php
			}
		}
	?>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'categories_order' ) ); ?>">
		<strong><?php _e( 'Order :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'categories_order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories_order' ) ); ?>">
		<option value="ASC" <?php selected( $instance['categories_order'], 'ASC' ); ?>>
			<?php _e( 'Ascending', 'widget-bundle' ); ?>
		</option>
		<option value="DESC" <?php selected( $instance['categories_order'], 'DESC' ); ?>>
			<?php _e( 'Descending', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'categories_order_by' ) ); ?>">
		<strong><?php _e( 'Order By :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'categories_order_by' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories_order_by' ) ); ?>">
		<option value="name"<?php selected( $instance['categories_order_by'], 'name' ); ?>>
			<?php _e( 'Name', 'widget-bundle' ); ?>
		</option>
		<option value="ID"<?php selected( $instance['categories_order_by'], 'ID' ); ?>>
			<?php _e( 'ID', 'widget-bundle' ); ?>
		</option>
		<option value="slug"<?php selected( $instance['categories_order_by'], 'slug' ); ?>>
			<?php _e( 'Slug', 'widget-bundle' ); ?>
		</option>
		<option value="count"<?php selected( $instance['categories_order_by'], 'count' ); ?>>
			<?php _e( 'Count', 'widget-bundle' ); ?>
		</option>
		<option value="term_group"<?php selected( $instance['categories_order_by'], 'term_group' ); ?>>
			<?php _e( 'Term Group', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'categories_format' ) ); ?>">
		<strong><?php _e( 'Display Categories as :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'categories_format' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories_format' ) ); ?>">
		<option value="list" <?php selected( $instance['categories_format'], 'list' ); ?>>
			<?php _e( 'List', 'widget-bundle' ); ?>
		</option>
		<option value="dropdown" <?php selected( $instance['categories_format'], 'dropdown' ); ?>>
			<?php _e( 'Dropdown', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'categories_hide_empty' ) ); ?>">
		<strong><?php _e( 'Display Empty Categories :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'categories_hide_empty' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories_hide_empty' ) ); ?>">
		<option value="0" <?php selected( $instance['categories_hide_empty'], '0' ); ?>>
			<?php _e( 'Yes', 'widget-bundle' ); ?>
		</option>
		<option value="1" <?php selected( $instance['categories_hide_empty'], '1' ); ?>>
			<?php _e( 'No', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'categories_hierarchy' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories_hierarchy' ) ); ?>" type="checkbox" <?php checked( $instance['categories_hierarchy'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'categories_hierarchy' ) ); ?>">
		<strong><?php _e( 'Display as hierarchy', 'widget-bundle' ); ?></strong>
	</label></br>
	<input id="<?php echo esc_attr( $this->get_field_id( 'categories_posts_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories_posts_count' ) ); ?>" type="checkbox" <?php checked( $instance['categories_posts_count'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'categories_posts_count' ) ); ?>">
		<strong><?php _e( 'Display Posts Count', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'categories_depth' ) ); ?>">
		<strong><?php _e( 'Levels in the hierarchy to show :', 'widget-bundle' ); ?></strong>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'categories_depth' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories_depth' ) ); ?>" type="number" step="1" min="-1" value="<?php echo $instance['categories_depth']; ?>" /></label><br />
	<strong><?php _e( '0 = All Categories and child Categories { Default }', 'widget-bundle' ); ?></strong><br />
	<strong><?php _e( '-1 = All Categories displayed in flat { no indent } form { overrides hierarchical }', 'widget-bundle' ); ?></strong><br />
	<strong><?php _e( '1 = Show only top level Categories', 'widget-bundle' ); ?></strong><br />
	<strong><?php _e( 'n = Value of n { some number } specifies the depth { or level } to descend in displaying Categories', 'widget-bundle' ); ?></strong>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'categories_include_exclude' ) ); ?>">
		<strong><?php _e( 'Filter by Category IDs :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'categories_include_exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories_include_exclude' ) ); ?>">
		<option value="">
			<?php _e( 'None', 'widget-bundle' ); ?>
		</option>	
		<option value="include" <?php selected( $instance['categories_include_exclude'], 'include' ); ?>>
			<?php _e( 'Include', 'widget-bundle' ); ?>
		</option>
		<option value="exclude" <?php selected( $instance['categories_include_exclude'], 'exclude' ); ?>>
			<?php _e( 'Exclude', 'widget-bundle' ); ?>
		</option>
	</select>
	<span class="description">
		<?php _e( 'Choose options for include or exclude Categories.', 'widget-bundle' ); ?>
	</span>
</p>

<p>	
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'categories_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'categories_id' ) ); ?>" type="text" value="<?php echo $instance['categories_id']; ?>" />
	<span class="description">
		<?php _e( 'Ex: 11, 21, 30 (comma-separated list of category ids)', 'widget-bundle' ); ?>
	</span>
</p>