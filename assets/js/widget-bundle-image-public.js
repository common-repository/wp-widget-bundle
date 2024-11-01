/**
 * Widget Bundle general public scripts for image widgets.
 *
 * @package widget-bundle
 *
 * @since   1.0.0
 *
 * @author  Devnath verma <devnathverma@gmail.com>
 */
 
(function($) {
	
	$(document).ready(function() {
		
		if( widget_bundle_image_public.autoplay === 'yes' )
			var autoplay	=	true;
		else
			var autoplay	=	false;	
			
		if( widget_bundle_image_public.pagination === 'yes' )
			var pagination	=	true;
		else
			var pagination	=	false;
		
		if( widget_bundle_image_public.navigation === 'yes' )
			var navigation	=	true;
		else
			var navigation	=	false;
			
		$('.wb4wp-owl-carousel').owlCarousel({
			singleItem	: true,
			slideSpeed	: 300,
			autoPlay	: autoplay,
			pagination	: pagination,
			navigation	: navigation,
		});
	});	
	
})(jQuery);