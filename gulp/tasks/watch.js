import gulp from 'gulp';
import gulpLoadPlugin from 'gulp-load-plugins';
import sourcemaps from 'gulp-sourcemaps';
import globalConfig from '../config.js';

const src = globalConfig.watch.src;

// task "watch"
gulp.task('watch', ['browserSync'], function () {
	// sassファイルの監視
	gulp.watch( src.sass, ['sass','bs-reload']);

	// jsファイルの監視
	gulp.watch( src.js, ['js','bs-reload']);

	// 画像ファイルの監視
	gulp.watch( src.images, ['bs-reload']);

	gulp.watch( globalConfig.bowerConfigPath, ['wiredep']);

});
