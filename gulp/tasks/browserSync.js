var gulp = require('gulp');
var browserSync = require('browser-sync');
var config = require('../config.js').browserSync;

// browserSync task
gulp.task('browserSync', function () {
	browserSync(config);
});

// ブラウザのリロード
gulp.task('bs-reload', function () {
	browserSync.reload();
});
