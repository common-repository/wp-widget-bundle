/**
 * Widget Bundle general admin scripts for links featured image widgets.
 *
 * @package widget-bundle
 *
 * @since   1.0.0
 *
 * @author  Devnath verma <devnathverma@gmail.com>
 */
 
(function($) {
	
	$(document).ready(function() {
	
		var wid;
		var widget_bundle_feature_image_uploader;
		
		$(document).on( 'click', '#widget_bundle_link_image_upload', function() {
				
			wid = $(this);
			event.preventDefault();
		
			if ( typeof( widget_bundle_feature_image_uploader ) !== "undefined" ) {
				widget_bundle_feature_image_uploader.close();
			}
			
			widget_bundle_feature_image_uploader = wp.media({
				title: 'Choose an image',
				library: { type: 'image' },
				button: { text: 'Set featured image' },
				multiple: false
			});
	
			widget_bundle_feature_image_uploader.on('select', function() {
				var attachment = widget_bundle_feature_image_uploader.state().get('selection').first().toJSON();
				$( document.getElementById( 'widget_bundle_link_image_id' ) ).val( attachment.id ).trigger( 'change' );
				$( document.getElementById( 'widget_bundle_link_image_url' ) ).attr( 'src', attachment.url ).trigger( 'change' );
				$( document.getElementById( 'link_image' ) ).val( attachment.url ).trigger( 'change' );
				$( wid ).attr( 'id', 'widget_bundle_remove_link_image' );
				$( document.getElementById( 'widget_bundle_remove_link_image' ) ).text( 'Remove featured image' );
			});
	
			widget_bundle_feature_image_uploader.open();
		});
		
		$(document).on( 'click', '#widget_bundle_remove_link_image', function() {
			wid = $(this);
			event.preventDefault();
			$( document.getElementById( 'widget_bundle_link_image_id' ) ).val( '' ).trigger( 'change' );
			$( document.getElementById( 'widget_bundle_link_image_url' ) ).attr( 'src', '' ).trigger( 'change' );
			$( document.getElementById( 'widget_bundle_link_image_url' ) ).attr( 'srcset', '' ).trigger( 'change' );
			$( document.getElementById( 'link_image' ) ).val( '' ).trigger( 'change' );
			$( wid ).attr( 'id', 'widget_bundle_link_image_upload' );
			$( document.getElementById( 'widget_bundle_link_image_upload' ) ).text( 'Set featured image' );
		});	
	});   
   
})(jQuery);