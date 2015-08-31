import gulp from 'gulp';
import gulpLoadPlugin from 'gulp-load-plugins';
import {stream as wiredep} from 'wiredep';
import globalConfig from '../config.js';

const src = globalConfig.watch.src;

// task "wiredep"
gulp.task('wiredep', () => {
	gulp.src(globalConfig.sass.src)
	.pipe(wiredep({
		ignorePath: /^(\.\.\/)+/
	}))
	.pipe(gulp.dest(globalConfig.sass.dest))
});
