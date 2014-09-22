'use strict';

// load plugins
var gulp = require('gulp');
var plugins = require('gulp-load-plugins')({ camelize: true });
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var psi = require('psi');
var neat = require('node-neat').includePaths;
var zip = require('gulp-zip');
var pjson = require('./package.json');
var streamqueue = require('streamqueue');

// browser sync
gulp.task('browserSync', function() {
  browserSync.init( null, {
    notify: true,
    proxy: {
      host: 'your-domain.dev', // replace your domain
      //port: 3000
    },
    ghostMode: {
      clicks: true,
      location: true,
      forms: true,
      scroll: true
    }
  });
});

// styles
gulp.task('styles', function() {
  return gulp.src('assets/scss/main.scss')
  .pipe(plugins.plumber())
	.pipe(plugins.sass({
		includePaths: ['styles'].concat(neat)
		// sourceComments: 'map'
	}))
  .pipe(plugins.autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
  .pipe(gulp.dest('assets/css'))
  .pipe(plugins.cssshrink())
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(gulp.dest('assets/css'))
  .pipe(reload({stream:true}))
  .pipe(plugins.notify({ message: 'Styles task complete' }));
});

// theme-styles
gulp.task('theme-styles', function() {
  return gulp.src('assets/scss/themes/theme-blog.scss')
  .pipe(plugins.plumber())
	.pipe(plugins.sass({
		includePaths: ['styles'].concat(neat)
	}))
  .pipe(plugins.autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
  .pipe(gulp.dest('assets/css'))
  .pipe(plugins.cssshrink())
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(gulp.dest('assets/css'))
  .pipe(reload({stream:true}))
  .pipe(plugins.notify({ message: 'Theme Styles task complete' }));
});


// Vendor Plugin Scripts
gulp.task('plugins', function() {
  return gulp.src(['assets/js/plugins/*.js','!assets/js/plugins.js'])
  .pipe(plugins.plumber())
  .pipe(plugins.concat('plugins.js'))
  .pipe(gulp.dest('assets/js/'))
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(plugins.uglify())
  .pipe(gulp.dest('assets/js'))
  .pipe(plugins.notify({ message: 'Plugins task complete' }))
  .pipe(reload( {stream:true} ));
});

// task "scripts"
gulp.task('scripts', function() {
  return gulp.src(['assets/js/_*.js', '!assets/js/scripts.js'])
  .pipe(plugins.plumber())
  .pipe(plugins.jshint('.jshintrc'))
  .pipe(plugins.jshint.reporter('default'))
  .pipe(plugins.concat('scripts.js'))
  .pipe(gulp.dest('assets/js'))
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(plugins.uglify())
  .pipe(gulp.dest('assets/js'))
  .pipe(plugins.notify({ message: 'Scripts task complete' }))
  .pipe(reload( {stream:true} ));
});

// task "images"
gulp.task('images', function() {
  return gulp.src('assets/images/**/*')
  .pipe(plugins.plumber())
  .pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
  .pipe(gulp.dest('assets/images'))
  .pipe(plugins.notify({ message: 'Images task complete.' }))
  .pipe(reload( {stream:true} ));
});

// task "php"
gulp.task('php', function(){
  return gulp.src('./**/*.php')
  .pipe(reload({stream:true}));
});

// task "watch"
gulp.task( 'watch', ['browserSync'], function() {

  // Watch .scss files
  gulp.watch(['assets/scss/**/*.scss','!assets/scss/themes/*.scss' ], ['styles']);
  gulp.watch('assets/scss/themes/*.scss', ['theme-styles']);

  // Watch .js files
  gulp.watch('assets/js/**/*.js', ['plugins', 'scripts']);

  // Watch image files
  gulp.watch('assets/images/**/*', ['images']);

  // watch php .php
  // gulp.watch('./**/*.php', ['php']);

});


/**
 * Generate a zip package of the application
 */
gulp.task("zip", function () {
    var date = new Date().toISOString().replace(/[^0-9]/g, ''),
        stream = streamqueue({ objectMode: true });

    stream.queue(
        gulp.src(
            [
                "assets/**/*",
                "templates/**/*",
                "modules/**/*",
                "classes/**/*",
                "inc/**/*",
                "languages/**/*",
                "!views/layout.jade", // will use the built one
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
        .pipe(zip("package-" + pjson.version + "-" + date + ".zip"))
        .pipe(gulp.dest("src/"));
});


// Run PageSpeed Insights
gulp.task('pagespeed', psi.bind(null, {
	url: 'http://your-domain.dev',
	strategy: 'mobile'
}));

// Default task
gulp.task( 'default', ['styles', 'plugins', 'scripts', 'images'] );

// Production
gulp.task( 'production', ['styles', 'plugins', 'scripts', 'images', 'zip'] );
