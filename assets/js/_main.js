"use strict";
/**
 * The main script of this theme.
 * After it has been compiled,
 * it will be converted into scripts.min.js.
 */

/**
 * Responsive Nav
 * ------------------
 * http://responsive-nav.com/
 *
 */
(function($){
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
})(jQuery);
