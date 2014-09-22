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


})(jQuery);
