// config

// ここにURLを入力
var url = "http://example.com";

var sass = {
	src: "assets/scss/main.scss",
	dest : "assets/css",
}

var js = {
	src : ['assets/js/_*.js', '!assets/js/scripts.js','!assets/js/scripts.min.js'],
	dest: "assets/js",
}

var plugins = {
	src : [],
	dest: "assets/js",
}

var images = {
	src: "assets/_images/**/*",
	dest: "assets/images",
};

module.exports = {
	bowerPath : "bower_components",
	bowerConfigPath : "bower.json",
	/**
	 * browserSync config
	 * @todo rewrite "proxy" setting
	 **/
	browserSync : {
		proxy:  url,
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
		src : sass.src,
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

	plugins: {
		src: plugins.src,
		dest: plugins.dest,
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
			sass : ['assets/scss/**/*.scss','!assets/scss/themes/*.scss'],
			js : ["assets/js/**/*.js"],
			plugins : ["bower_components/**/*.js"],
			images : ['assets/images/**/*']
		},
	}
}
