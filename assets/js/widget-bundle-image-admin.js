/**
 * Widget Bundle general admin scripts for image widgets.
 *
 * @package widget-bundle
 *
 * @since   1.0.0
 *
 * @author  Devnath verma <devnathverma@gmail.com>
 */

(function($) {
	
	$(document).ready(function() {
	
		var widget_bundle_multiple_image_uploader;
		
		$(document).on( 'click', '.multiple_delete_image', function() {
					
			if( confirm( 'Are you sure you want to delete this image?' ) ) {
				
				$(this).parent().fadeOut('slow', function() { $(this).remove(); });
				
				$( document.getElementsByClassName( 'multiple_image_container' ) ).trigger( 'change' ); 
			}
			
			return false;
		});
		
		$(document).on( 'click', '.multiple_add_image', function() {
			
			event.preventDefault();
			
			if (widget_bundle_multiple_image_uploader) {
				widget_bundle_multiple_image_uploader.open();
				return;
			}
			
			widget_bundle_multiple_image_uploader = wp.media.frames.widget_bundle_multiple_image_uploader = wp.media({
				title: $(this).data('uploader_title'),
				library: { type: 'image' },
				button: { text: $(this).data('uploader_button_text') },
				multiple: true
			});
			
			widget_bundle_multiple_image_uploader.on('select', function() {
					
				var attachment = widget_bundle_multiple_image_uploader.state().get('selection').toJSON();
				
				for (var i = 0; i <(attachment.length); i++) {
					
					$.ajax({
						 type : 'post',
						 dataType : 'html',
						 url : WB4WP_AJAX.ajaxurl,
						 data : { action: 'multiple_image_thumbnail', attachment_id: attachment[i]['id'] },
						 success: function(response) {
							$('.multiple_image_container').append(response).trigger( 'change' ); 
						 }
					});
				}
			});
			
			widget_bundle_multiple_image_uploader.open();
	    });
		
		$(document).on( 'change', '.multiple_change_image_type', function() {
			
			var wid = $(this).attr('id');
			
			if ( $( document.getElementById( wid ) ).val() == 'slider' ) {
					
				$( document.getElementById( wid + 'wb4wp_custom_slider_settings' ) ).slideDown();
			
			} else {
				
				$( document.getElementById( wid + 'wb4wp_custom_slider_settings' ) ).slideUp();
			}			
		});
	});   
   
})(jQuery);