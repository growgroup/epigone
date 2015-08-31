import gulp from 'gulp';
import gulpLoadPlugin from 'gulp-load-plugins';
import sourcemaps from 'gulp-sourcemaps';
import globalConfig from '../config.js';

const $ = gulpLoadPlugin({camelize: true});
const config = globalConfig.sass;


gulp.task('sass', function () {
	return gulp.src(config.src)
		.pipe($.plumber())
		.pipe(sourcemaps.init())
		.pipe($.sass.sync(config.options).on('error', $.sass.logError))
		.pipe(gulp.dest(config.dest))
		.pipe($.rename({
			suffix: '.min'
		}))
		.pipe($.minifyCss({
			keepBreaks: false,
			advanced: true,
		}))
		.pipe($.sourcemaps.write('./'))
		.pipe(gulp.dest(config.dest))
		.pipe($.notify({message: 'Styles task complete'}))
		.pipe($.size({title: 'css'}))
});
