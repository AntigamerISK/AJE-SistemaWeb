(function($) {

	groginThemeModule.ajaxLinks = '.widget_klb_product_categories a, .widget_product_status a, .remove-filter a, .widget_layered_nav a, .product-views-buttons a, .woocommerce-pagination a';

	groginThemeModule.ajaxFilters = function() {

		groginThemeModule.$document.pjax(groginThemeModule.ajaxLinks, '.main-content', {
			timeout       : 5000,
			scrollTo      : false,
			renderCallback: function(context, html, afterRender) {
				context.html(html);
				afterRender();
			}
		});

		groginThemeModule.$document.on('submit', '.widget_price_filter form', function(event) {
			$.pjax.submit(event, '.main-content');
			groginThemeModule.$document.trigger('groginShopPageInit');
		});

		groginThemeModule.$document.on('submit', '.widget_search_filter form', function(event) {
			$.pjax.submit(event, '.main-content');
			groginThemeModule.$document.trigger('groginShopPageInit');
		});

		groginThemeModule.$document.on('pjax:error', function(xhr, textStatus, error) {
			console.log('pjax error ' + error);
		});

		groginThemeModule.$document.on('pjax:start', function() {

			scrollToTop(false);

			var $siteContent = $('.main-content');

			$siteContent.removeClass('ajax-loaded');
			$siteContent.addClass('ajax-loading');
			$(".main-content .primary-column .products, nav.woocommerce-pagination").hide();
			$('.main-content .primary-column .products').before('<svg class="loader-image preloader" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"><circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle></svg></div>');

			$('body').removeClass('filtered-sidebar-active');
		});

		groginThemeModule.$document.on('pjax:complete', function() {

			$('.main-content').removeClass('ajax-loading');

			$('.loader-image.preloader').remove();
			
			groginThemeModule.$document.trigger('groginShopPageInit');
			
			$('.mobile-overlay').removeClass('active');
			$(".mobile-overlay").css({"opacity": "0", "visibility": "hidden"});

		});


		groginThemeModule.$document.on('pjax:end', function() {

			scrollToTop(false);

			var $siteContent = $('.main-content');

			$siteContent.removeClass('ajax-loading');
			$siteContent.addClass('ajax-loaded');
			
		});

		var scrollToTop = function(type) {
			if (grogin_settings.ajax_scroll === 'no' && type === false) {
				return false;
			}

			var $scrollTo = $(grogin_settings.ajax_scroll_class),
			    scrollTo  = $scrollTo.offset().top - grogin_settings.ajax_scroll_offset;

			$('html, body').stop().animate({
				scrollTop: scrollTo
			}, 400);
		};
	};

	$(document).ready(function() {
		groginThemeModule.ajaxFilters();
	});
})(jQuery);
