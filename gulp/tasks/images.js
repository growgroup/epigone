import gulp from 'gulp';
import gulpLoadPlugin from 'gulp-load-plugins';
import c from '../config';

const $ = gulpLoadPlugin({camelize: true});
const config = c.images;

// task "images"
gulp.task('images', () =>
	gulp.src(config.src)
		.pipe($.plumber())
		.pipe($.cache($.imagemin({optimizationLevel: 8, progressive: true, interlaced: true})))
		.pipe(gulp.dest(config.dest))
		.pipe($.notify({message: 'Images task complete.'}))
		.pipe($.size({title: 'images'}))
);
