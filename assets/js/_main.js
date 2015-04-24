/**
 * The main script of this theme.
 * After it has been compiled,
 * it will be converted into scripts.min.js.
 */

"use strict";
(function($){

	/**
	 * Responsice Navigation
	 * @see http://responsive-nav.com/
	 * @since 1.0.0
	 */
	if (typeof responsiveNav ===  "function") {
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
	}

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
	}

	$("body").addClass($("#hero")[0] || $("#homeIntro")[0] ? "has-hero" : "no-hero");
	$(window).scroll(function() {
		var header = $("#masthead"),
		windowTop = $(this).scrollTop(),
		headerContainer = header.find(".container"),
		headerLogo = header.find(".header-logo"),
		e = Modernizr.prefixed("transform"),
		f = {},
		g = {},
		h = {},
		i = {};
			f[e] = "translate3d(0, -" + windowTop / 20 + "px, 0)",
			g[e] = "translate(0, -" + windowTop / 20 + "px)",
			h[e] = "translate3d(0, -" + windowTop / 2 + "px, 0)",
			i[e] = "translate(0, -" + windowTop / 2 + "px)",
			680 > windowTop && windowTop >= 340 ? (Modernizr.csstransitions ? headerLogo.addClass("fade-out") : headerLogo.fadeOut("slow"),headerContainer.css(Modernizr.csstransforms3d ? h : i)) : 340 > windowTop && (Modernizr.csstransitions ? headerLogo.removeClass("fade-out") : headerLogo.fadeIn("slow"),Modernizr.csstransforms3d ? (headerLogo.css(f), headerContainer.css(h)) : (headerLogo.css(g), headerContainer.css(i)));
    });


})(jQuery);
