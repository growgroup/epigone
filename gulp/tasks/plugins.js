import gulp from 'gulp';
import gulpLoadPlugin from 'gulp-load-plugins';
import sourcemaps from 'gulp-sourcemaps';
import globalConfig from '../config.js';
import wiredep from 'wiredep';

const $ = gulpLoadPlugin();
const config = globalConfig.plugins;
//
gulp.task('plugins', function () {
	var files = wiredep({
		devDependencies: true,
		exclude: [
			'/jquery/',
			'/jquery-placeholder/',
			'/jquery.cookie/',
			'/modernizr/',
			'/fastclick/'
		]
	})['js'];

	Array.prototype.push.apply(config.src, files);
	return gulp.src(config.src)
		.pipe($.plumber())
		.pipe($.concat('plugins.js'))
		.pipe(gulp.dest(config.dest))
		.pipe($.rename({suffix: '.min'}))
		.pipe($.uglify())
		.pipe(gulp.dest(config.dest))
		.pipe($.notify({message: 'Plugins task complete'}))
		.pipe($.size({title: 'plugins'}));
});

