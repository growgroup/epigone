import gulp from 'gulp';
import browserSync from 'browser-sync';
import configAll from '../config.js';

const config = configAll.browserSync;

// browserSync task
gulp.task('browserSync', () =>
	browserSync(config)
);

// reload
gulp.task('bs-reload', () =>
	browserSync.stream()
);
