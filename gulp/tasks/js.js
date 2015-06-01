var gulp = require('gulp');
var $ = require('gulp-load-plugins')({camelize: true});
var config = require('../config').js;

// js
gulp.task('js', function () {
	return gulp.src(config.src)
		.pipe($.plumber())
		.pipe($.jshint(config.jshintrc))
		.pipe($.jshint.reporter('default'))
		.pipe($.concat('scripts.js'))
		.pipe(gulp.dest(config.dest))
		.pipe($.rename({suffix: '.min'}))
		.pipe($.uglify())
		.pipe(gulp.dest(config.dest))
		.pipe($.notify({message: 'Scripts task complete'}))
});
