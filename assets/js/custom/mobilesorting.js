(function ($) {
  "use strict";

	$(document).on('groginShopPageInit', function () {
		groginThemeModule.mobilesorting();
	});

	groginThemeModule.mobilesorting = function() {
      const button = document.querySelector('.sorting-button');

      if (button !== null) {
        const wrapper = document.querySelector('.shop-sorting-wrapper');

        if (wrapper !== null) {
          button.addEventListener('click', (e) => {
            e.preventDefault();
            wrapper.classList.toggle('active');
          })
        }
      }
	}
	
	$(document).ready(function() {
		groginThemeModule.mobilesorting();
	});

})(jQuery);
