var gulp = require('gulp');
var $ = require('gulp-load-plugins')({camelize: true});
var config = require('../config.js').sass;

gulp.task('sass', function () {
	return gulp.src(config.src)
		.pipe($.plumber())
		.pipe($.sass(config.options))
		.pipe($.autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
		.pipe(gulp.dest(config.dest))
		.pipe($.rename({suffix: '.min'}))
		.pipe($.minifyCss({keepBreaks: true}))
		.pipe(gulp.dest(config.dest))
		.pipe($.notify({message: 'Styles task complete'}));
});
