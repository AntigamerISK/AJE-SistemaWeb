(function ($) {
  "use strict";

	$(document).on('groginShopPageInit', function () {
		groginThemeModule.hoverslider();
	});

	groginThemeModule.hoverslider = function() {
		const container = document.querySelectorAll('.product-gallery');
		  if (container !== null) {
			for( var i = 0; i < container.length; i++ ) {
			  const self = container[i];

			  const HoverGallerySlider = new HoverGallery({
				selector: self,
				duration: 0.3,
				resetHover: true // Mouse leave goes to the first item
			  });
			}
		}
	}
	
	$(document).ready(function() {
		groginThemeModule.hoverslider();
	});

})(jQuery);