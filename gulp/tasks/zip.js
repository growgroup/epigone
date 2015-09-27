import gulp from 'gulp';
import gulpLoadPlugin from 'gulp-load-plugins';
import zip from 'gulp-zip';
import streamqueue from 'streamqueue';
import globalConfig from '../config.js';
import pjson from '../../package.json';

const src = globalConfig.watch.src;

// task "wiredep"
gulp.task("zip", function () {
	var date = new Date().toISOString().replace(/[^0-9]/g, ''),
		stream = streamqueue({ objectMode: true });

	stream.queue(
		gulp.src(
			[
				"assets/css/*.css",
				"assets/js/*.js",
				"assets/images/*",
				"bower_components/**/*",
				"vendor/**/*",
				"templates/**/*",
				"modules/**/*",
				"classes/**/*",
				"inc/**/*",
				"languages/**/*",
				".bowerrc",
				".editorconfig",
				".jshintrc",
				"bower.json",
				"archive.php",
				"attachment.php",
				"base.php",
				"functions.php",
				"404.php",
				"home.php",
				"index.php",
				"page.php",
				"page-category-tile.php",
				"rtl.css",
				"screenshot.png",
				"search.php",
				"single.php",
				"style.css",
				"wrapper-template-one-column.php"
			],
			{base: "."})
	);

	// once preprocess ended, concat result into a real file
	return stream.done()
		.pipe(zip("epigone-" + pjson.version + "-" + date + ".zip"))
		.pipe(gulp.dest("dist/"));
});
