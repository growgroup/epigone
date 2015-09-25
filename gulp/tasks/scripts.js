import gulp from 'gulp';
import gulpLoadPlugin from 'gulp-load-plugins';
import sourcemaps from 'gulp-sourcemaps';
import globalConfig from '../config.js';

const $ = gulpLoadPlugin();
const config = globalConfig.js;
//
gulp.task('scripts', function () {
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
		.pipe($.size({title: 'js'}));
});

