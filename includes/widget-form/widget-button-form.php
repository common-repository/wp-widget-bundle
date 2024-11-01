<?php
/**
 * Display the widget setting options in admin area.
 *
 * @since      1.0.0
 *
 * @package    widget-bundle
 * @subpackage widget-bundle/includes/widget-form/widget-button-form
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
	<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>">
		<strong><?php _e( 'Button Text :', 'widget-bundle' ); ?></strong>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo $instance['button_text']; ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'button_text_size' ) ); ?>">
		<strong><?php _e( 'Text Size :', 'widget-bundle' ); ?></strong>
	</label>
	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text_size' ) ); ?>" type="number" step="1" min="10" value="<?php echo $instance['button_text_size']; ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'button_text_color' ) ); ?>">
		<strong><?php _e( 'Text Color :', 'widget-bundle' ); ?></strong>
	</label>
	<br />
	<input type="text" class="wb4wp-color-field" id="<?php echo esc_attr( $this->get_field_id( 'button_text_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text_color' ) ); ?>" value="<?php echo $instance['button_text_color']; ?>"/>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'button_text_bold' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text_bold' ) ); ?>" type="checkbox" <?php checked( $instance['button_text_bold'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'button_text_bold' ) ); ?>">
		<strong><?php _e( 'Text Bold', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'button_text_italic' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text_italic' ) ); ?>" type="checkbox" <?php checked( $instance['button_text_italic'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'button_text_italic' ) ); ?>">
		<strong><?php _e( 'Text Italic', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<input id="<?php echo esc_attr( $this->get_field_id( 'button_text_underline' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text_underline' ) ); ?>" type="checkbox" <?php checked( $instance['button_text_underline'] ); ?> />
	<label for="<?php echo esc_attr( $this->get_field_id( 'button_text_underline' ) ); ?>">
		<strong><?php _e( 'Text Underline', 'widget-bundle' ); ?></strong>
	</label>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'button_link' ) ); ?>">
		<strong><?php _e( 'Button Link :', 'widget-bundle' ); ?></strong>
	</label>
	<input class="widefat" placeholder="<?php _e('http://', 'widget-bundle' ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_link' ) ); ?>" type="text" value="<?php echo $instance['button_link']; ?>" />
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'button_target' ) ); ?>">
		<strong><?php _e( 'Link Target :', 'widget-bundle' ); ?></strong>
	</label>
	<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_target' ) ); ?>">
		<option value='_self' <?php selected( $instance['button_target'], '_self' ); ?>>
			<?php _e( 'Current Window', 'widget-bundle' ); ?>
		</option>
		<option value='_blank' <?php selected( $instance['button_target'], '_blank' ); ?>>				                
			<?php _e( 'New Window', 'widget-bundle' ); ?>
		</option>
	</select>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'button_background_color' ) ); ?>">
		<strong><?php _e( 'Button Background Color :', 'widget-bundle' ); ?></strong>
	</label>
	<br />
	<input type="text" class="wb4wp-color-field" id="<?php echo esc_attr( $this->get_field_id( 'button_background_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_background_color' ) ); ?>" value="<?php echo $instance['button_background_color']; ?>"/>
</p>
		
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'button_border' ) ); ?>">
		<strong><?php _e( 'Button Border ( Width, Style, Color ) :', 'widget-bundle' ); ?></strong>
	</label>
	<br />
	<select class="small-input" id="<?php echo esc_attr( $this->get_field_id( 'button_border_width' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_border_width' ) ); ?>">
		<option value='1' <?php selected( $instance['button_border_width'], '1' ); ?>>
			<?php _e( '1', 'widget-bundle' ); ?>
		</option>
		<option value='2' <?php selected( $instance['button_border_width'], '2' ); ?>>
			<?php _e( '2', 'widget-bundle' ); ?>
		</option>
		<option value='3' <?php selected( $instance['button_border_width'], '3' ); ?>>
			<?php _e( '3', 'widget-bundle' ); ?>
		</option>
		<option value='4' <?php selected( $instance['button_border_width'], '4' ); ?>>
			<?php _e( '4', 'widget-bundle' ); ?>
		</option>
		<option value='5' <?php selected( $instance['button_border_width'], '5' ); ?>>
			<?php _e( '5', 'widget-bundle' ); ?>
		</option>
		<option value='6' <?php selected( $instance['button_border_width'], '6' ); ?>>
			<?php _e( '6', 'widget-bundle' ); ?>
		</option>
		<option value='7' <?php selected( $instance['button_border_width'], '7' ); ?>>
			<?php _e( '7', 'widget-bundle' ); ?>
		</option>
		<option value='8' <?php selected( $instance['button_border_width'], '8' ); ?>>
			<?php _e( '8', 'widget-bundle' ); ?>
		</option>
		<option value='9' <?php selected( $instance['button_border_width'], '9' ); ?>>
			<?php _e( '9', 'widget-bundle' ); ?>
		</option>
		<option value='10' <?php selected( $instance['button_border_width'], '10' ); ?>>
			<?php _e( '10', 'widget-bundle' ); ?>
		</option>
	</select>&nbsp;px&nbsp;
	<select class="small-input" id="<?php echo esc_attr( $this->get_field_id( 'button_border_style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_border_style' ) ); ?>">
		<option value='none' <?php selected( $instance['button_border_style'], 'none' ); ?>>
			<?php _e( 'None', 'widget-bundle' ); ?>
		</option>
		<option value='medium' <?php selected( $instance['button_border_style'], 'medium' ); ?>>
			<?php _e( 'Medium', 'widget-bundle' ); ?>
		</option>
		<option value='thin' <?php selected( $instance['button_border_style'], 'thin' ); ?>>
			<?php _e( 'Thin', 'widget-bundle' ); ?>
		</option>
		<option value='thik' <?php selected( $instance['button_border_style'], 'thik' ); ?>>
			<?php _e( 'Thik', 'widget-bundle' ); ?>
		</option>
		<option value='dashed' <?php selected( $instance['button_border_style'], 'dashed' ); ?>>
			<?php _e( 'Dashed', 'widget-bundle' ); ?>
		</option>
		<option value='dotted' <?php selected( $instance['button_border_style'], 'dotted' ); ?>>
			<?php _e( 'Dotted', 'widget-bundle' ); ?>
		</option>
		<option value='double' <?php selected( $instance['button_border_style'], 'double' ); ?>>
			<?php _e( 'Double', 'widget-bundle' ); ?>
		</option>
		<option value='groove' <?php selected( $instance['button_border_style'], 'groove' ); ?>>
			<?php _e( 'Groove', 'widget-bundle' ); ?>
		</option>
		<option value='outset' <?php selected( $instance['button_border_style'], 'outset' ); ?>>
			<?php _e( 'Outset', 'widget-bundle' ); ?>
		</option>
		<option value='solid' <?php selected( $instance['button_border_style'], 'solid' ); ?>>
			<?php _e( 'Solid', 'widget-bundle' ); ?>
		</option>
	</select>&nbsp;
	<input type="text" class="wb4wp-color-field" id="<?php echo esc_attr( $this->get_field_id( 'button_border_color' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_border_color' ) ); ?>" value="<?php echo $instance['button_border_color']; ?>"/>
</p>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'button_padding' ) ); ?>">
		<strong><?php _e( 'Button Padding ( Top, Right, Bottom, Left ) :', 'widget-bundle' ); ?></strong>
	</label>
	<br />
	<input class="widget-button-small-input" id="<?php echo esc_attr( $this->get_field_id( 'button_padding_top' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_padding_top' ) ); ?>" value="<?php echo $instance['button_padding_top']; ?>" type="number" step="1" min="1"/>&nbsp;px
	<input class="widget-button-small-input" id="<?php echo esc_attr( $this->get_field_id( 'button_padding_right' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_padding_right' ) ); ?>" value="<?php echo $instance['button_padding_right']; ?>" type="number" step="1" min="1"/>&nbsp;px
	<input class="widget-button-small-input" id="<?php echo esc_attr( $this->get_field_id( 'button_padding_bottom' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_padding_bottom' ) ); ?>" value="<?php echo $instance['button_padding_bottom']; ?>" type="number" step="1" min="1"/>&nbsp;px
	<input class="widget-button-small-input" id="<?php echo esc_attr( $this->get_field_id( 'button_padding_left' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_padding_left' ) ); ?>" value="<?php echo $instance['button_padding_left']; ?>" type="number" step="1" min="1"/>&nbsp;px
</p>