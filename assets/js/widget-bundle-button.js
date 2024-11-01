/**
 * Widget Bundle general admin scripts for button widgets.
 *
 * @package widget-bundle
 *
 * @since   1.0.0
 *
 * @author  Devnath verma <devnathverma@gmail.com>
 */

( function( $ ){
  
	function widget_init_color_picker( widget ) {
		
		widget.find( '.wb4wp-color-field' ).wpColorPicker( {
	  		
			change: _.throttle( function() { $(this).trigger( 'change' ); }, 3000 )
		});
  	}

  	function widget_form_update( event, widget ) {
		
		widget_init_color_picker( widget );
  	}

  	$( document ).on( 'widget-added widget-updated', widget_form_update );

  	$( document ).ready( function() {
		
		$( '#widgets-right .widget:has(.wb4wp-color-field)' ).each( function () {
			
			widget_init_color_picker( $( this ) );
		});
  	});
	
})( jQuery );