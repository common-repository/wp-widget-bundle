/**
 * Widget Bundle general admin scripts for links widgets.
 *
 * @package widget-bundle
 *
 * @since   1.0.0
 *
 * @author  Devnath verma <devnathverma@gmail.com>
 */
 
(function($) {
	
	$(document).ready(function() {
	
		WB4WP_LINKS = {
			
			TLISizes : function( wid ) {
				
				if ( $( document.getElementById( wid + 'link_image_size' ) ).val() == 'custom' ) {
					
					$( document.getElementById( wid + 'wb4wp_custom_link_image_size') ).slideDown();
				
				} else {
					
					$( document.getElementById( wid + 'wb4wp_custom_link_image_size') ).slideUp();
				}
			}
		};
	});   
   
})(jQuery);