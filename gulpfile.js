'use strict';

// プラグインをロード
var gulp = require('gulp'),
	$ = require('gulp-load-plugins')({camelize: true}),
	browserSync = require('browser-sync'),
	psi = require('psi'),
	pjson = require('./package.json'),
	streamqueue = require('streamqueue');

// ブラウザのリロード
gulp.task('bs-reload', function () {
	browserSync.reload();
});

// browserSyncの設定
gulp.task('browserSync', function () {
	browserSync({
		notify: true,
		proxy: 'test.wordpress.com', // replace your domain
		ghostMode: {
			clicks: true,
			location: true,
			forms: true,
			scroll: true
		}
	});
});

// sassのコンパイル、プレフィックスの追加、minify
gulp.task('styles', function () {
	return gulp.src('assets/scss/main.scss')
		.pipe($.plumber())
		.pipe($.sass({
			style: 'expanded',
			precision: 10
		}))
		.pipe($.autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
		.pipe(gulp.dest('assets/css'))
		.pipe($.rename({suffix: '.min'}))
		.pipe($.minifyCss({keepBreaks: true}))
		.pipe(gulp.dest('assets/css'))
		.pipe($.notify({message: 'Styles task complete'}));
});

// theme-styles
gulp.task('theme-styles', function () {
	return gulp.src('assets/scss/themes/theme-blog.scss')
		.pipe($.plumber())
		.pipe($.sass({
			style: 'expanded',
			precision: 10
		}))
		.pipe($.autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
		.pipe(gulp.dest('assets/css'))
		.pipe($.rename({suffix: '.min'}))
		.pipe($.minifyCss({keepBreaks: true}))
		.pipe(gulp.dest('assets/css'))
		.pipe($.notify({message: 'Theme Styles task complete'}));
});

// js
gulp.task('plugins', function () {
	return gulp.src([
		'assets/js/plugins/*.js',
		'assets/js/components/modernizr/modernizr.js',
		'!assets/js/plugins.js'])
		.pipe($.plumber())
		.pipe($.concat('plugins.js'))
		.pipe(gulp.dest('assets/js/'))
		.pipe($.rename({suffix: '.min'}))
		.pipe($.uglify())
		.pipe(gulp.dest('assets/js'))
		.pipe($.notify({message: 'Plugins task complete'}))
});

// js
gulp.task('scripts', function () {
	return gulp.src(['assets/js/_*.js', '!assets/js/scripts.js'])
		.pipe($.plumber())
		.pipe($.jshint('.jshintrc'))
		.pipe($.jshint.reporter('default'))
		.pipe($.concat('scripts.js'))
		.pipe(gulp.dest('assets/js'))
		.pipe($.rename({suffix: '.min'}))
		.pipe($.uglify())
		.pipe(gulp.dest('assets/js'))
		.pipe($.notify({message: 'Scripts task complete'}))
});

// task "images"
gulp.task('images', function () {
	return gulp.src('assets/images/**/*')
		.pipe($.plumber())
		.pipe($.cache($.imagemin({optimizationLevel: 7, progressive: true, interlaced: true})))
		.pipe(gulp.dest('assets/images'))
		.pipe($.notify({message: 'Images task complete.'}))
		.pipe(reload({stream: true}));
});

// task "watch"
gulp.task('watch', ['browserSync'], function () {

	// sassファイルの監視
	gulp.watch(['assets/scss/**/*.scss', '!assets/scss/themes/*.scss'], ['styles','bs-reload']);
	gulp.watch('assets/scss/themes/*.scss', ['theme-styles']);

	// jsファイルの監視
	gulp.watch('assets/js/**/*.js', ['plugins', 'scripts','bs-reload']);

	// 画像ファイルの監視
	gulp.watch('assets/images/**/*', ['bs-reload']);

	// PHPファイルの監視
	//gulp.watch('./**/*.php', ['bs-reload']);

});
/**
 * テーマzipファイルを作成
 */
gulp.task("zip", function () {
	var date = new Date().toISOString().replace(/[^0-9]/g, ''),
		stream = streamqueue({objectMode: true});

	stream.queue(
		gulp.src(
			[
				"assets/**/*",
				"templates/**/*",
				"modules/**/*",
				"classes/**/*",
				"inc/**/*",
				"languages/**/*",
				".bowerrc",
				".editorconfig",
				".jshintrc",
				"404.php",
				"archive.php",
				"attachment.php",
				"base.php",
				"bower.json",
				"functions.php",
				"index.php",
				"page.php",
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
		.pipe(zip("epigone-" + pjson.version + ".zip"))
		.pipe(gulp.dest("src/"));
});


// Run PageSpeed Insights
gulp.task('pagespeed', psi.bind(null, {
	url: 'http://your-domain.dev',
	strategy: 'mobile'
}));

// Default task
gulp.task('default', ['styles', 'plugins', 'scripts', 'images']);

// Production
gulp.task('production', ['styles', 'plugins', 'scripts', 'images', 'zip']);
