/**
 * Widget Bundle general admin scripts for posts widgets.
 *
 * @package widget-bundle
 *
 * @since   1.0.0
 *
 * @author  Devnath verma <devnathverma@gmail.com>
 */
 
(function($) {
	
	$(document).ready(function() {
	
		WB4WP_POSTS = {
			
			TPTSizes : function( wid ) {
				
				if ( $( document.getElementById( wid + 'post_thumbnail_size' ) ).val() == 'custom' ) {
					
					$( document.getElementById( wid + 'wb4wp_custom_post_thumbnail') ).slideDown();
				
				} else {
					
					$( document.getElementById( wid + 'wb4wp_custom_post_thumbnail') ).slideUp();
				}
			}
		};
	});   
   
})(jQuery);