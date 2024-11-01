/**
 * Widget Bundle general admin scripts for about me widgets.
 *
 * @package widget-bundle
 *
 * @since   1.0.0
 *
 * @author  Devnath verma <devnathverma@gmail.com>
 */
 
(function($) {
	
	$(document).ready(function() {
	
		WB4WP_ABOUTME = {
			
			TDescription : function( wid ) {
				
				if ( $( document.getElementById( wid + 'aboutme_avatar_description' ) ).val() == 'custom_description' ) {
					
					$( document.getElementById( wid + 'wb4wp_custom_description') ).slideDown();
				
				} else {
					
					$( document.getElementById( wid + 'wb4wp_custom_description') ).slideUp();
				}
			}
		};
	});

})(jQuery);