var gulp = require('gulp');
var $ = require('gulp-load-plugins')({camelize: true});
var config = require('../config.js').watch;

// task "watch"
gulp.task('watch', ['browserSync'], function () {
	// sassファイルの監視
	gulp.watch( config.src.sass, ['sass','bs-reload']);

	// jsファイルの監視
	gulp.watch(config.src.js, ['js','bs-reload']);

	// 画像ファイルの監視
	gulp.watch(config.src.images, ['bs-reload']);

});
