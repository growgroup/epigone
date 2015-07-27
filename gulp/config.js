//
// Gulp config
//

var sass = {
		src: "assets/scss/main.scss",
		dest : "assets/css",
	},
	js = {
		src : ['assets/js/_*.js', '!assets/js/scripts.js'],
		dest: "assets/js",
	},
	images = {
		src: "assets/_images/**/*",
		dest: "assets/images",
	};

module.exports = {
	/**
	 * browserSync config
	 * @todo rewrite "proxy" setting
	 **/
	browserSync : {
		proxy:  "your url here",
		notify: true,
		open : true,
		ghostMode: {
			clicks: true,
			forms: true,
			scroll: false
		},
		tunnel: true,
	},

	/**
	 * Sass compile config
	 **/
	sass : {
		src :  sass.src,
		dest: sass.dest,
		options : {
		},
	},

	/**
	 * js compile config
	 **/
	js: {
		src: js.src,
		dest: js.dest,
		jshintrc: ".jshintrc",
		options: {
		},
	},

	/**
	 * js compile config
	 **/
	images: {
		src : images.src,
		dest: images.dest
	},

	/**
	 *  Watch config
	 */
	watch: {
		enhanced: ["sass","js"],
		src : {
			sass : ['assets/scss/**/*.scss','!../assets/scss/themes/*.scss'],
			js : ["../assets/js/**/*.js"],
			images : ['../assets/images/**/*']
		},
	}
}
