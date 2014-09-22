"use strict";
/**
 * The main script of this theme.
 * After it has been compiled,
 * it will be converted into scripts.min.js.
 */

(function($){

	/**
	 * Responsice Navigation
	 * @see http://responsive-nav.com/
	 * @since 1.0.0
	 */
	if ( typeof responsiveNav ===  "function" ) {
		var ResponsiveNav = responsiveNav("#header-navbar-collapse",{
			animate: false,
			transition: 284,
			label: "<i class='fa fa-bars'></i>",
			insert: "before",
			customToggle: "",
			closeOnNavClick: false,
			openPos: "relative",
			navClass: "nav-collapse",
			navActiveClass: "js-nav-active",
			jsClass: "js",
		});
	};

	// Scroll Top Button
	var topBtn = $('#scroll-top');
	if ( topBtn ) {
		topBtn.hide();
		$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
						topBtn.fadeIn();
				} else {
						topBtn.fadeOut();
				}
		});
		topBtn.click(function () {
				$('body,html').animate({
						scrollTop: 0
				}, 500);
				return false;
		});
	};
	// /**
	//  * Header Background
	//  * @return {[type]} [description]
	//  */
	// function fader() {
	// 	var r = $('.header'),
	// 	wh = $(window).height(),
	// 	dt = $(document).scrollTop(),
	// 	elView, opacity;

	// 	// Loop elements with class "blurred"
	// 	r.each(function() {
	// 		elView = wh - ($(this).offset().top - dt + 180);
	// 		if (elView > 0) {
	// 			opacity = 1 / (wh + $(this).height()) * elView * 2;
	// 			if (opacity < 1) {
	// 				$(this).css('opacity', opacity);
	// 			};
	// 		};
	// 	});
	// };

	// $(document).bind('scroll', fader);

})(jQuery);
