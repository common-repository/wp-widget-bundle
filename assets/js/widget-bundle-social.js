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
		
		$(document).on( 'click', '.social_icon_delete', function( event ) {
			
			event.preventDefault();
			
			if( confirm( 'Are you sure you want to delete this image?' ) ) {
				
				$(this).parent('li').fadeOut('slow', function() { $(this).remove(); });
				
				$( document.getElementsByClassName( 'social-icon-sortable' ) ).trigger( 'change' );
			}
		});
		
		$(document).on( 'click', '.social_icon_add', function( event ) {
			
			event.preventDefault();
			
			var social_icon_container = $(this).closest('.widget-inside');
			
			social_icon_container_clone = social_icon_container.find('.social_icon_container_clone');
			
			social_icon_container.find('.social_icon_container').append('<li class="social_icon_row">' + social_icon_container_clone.html() + '</li>').trigger( 'change' );
		});
	});   
   
})(jQuery);