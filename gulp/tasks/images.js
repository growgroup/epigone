var gulp = require('gulp');
var $ = require('gulp-load-plugins')({camelize: true});
var config = require('../config').images;

// task "images"
gulp.task('images', function () {
	return gulp.src(config.src)
		.pipe($.plumber())
		.pipe($.cache($.imagemin({optimizationLevel: 7, progressive: true, interlaced: true})))
		.pipe(gulp.dest(config.dest))
		.pipe($.notify({message: 'Images task complete.'}));
});
