'use strict';

// Load plugins
var gulp = require('gulp');
var plugins = require('gulp-load-plugins')({ camelize: true });
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var rev = require('gulp-wp-rev');

// Browser Sync
gulp.task('browserSync', function() {
    browserSync.init(null, {
        notify: true,
        proxy: {
            host: "easy-theme.dev", // replace your domain
            // port: 3333
        },
        ghostMode: {
          clicks: true,
          location: true,
          forms: true,
          scroll: false
        }
    });
});

// Styles
gulp.task('styles', function() {
  return gulp.src('assets/scss/main.scss')
  .pipe(plugins.rubySass({ style: 'expanded', compass: true , trace: true }))
  .pipe(plugins.autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
  .pipe(gulp.dest('assets/css'))
  .pipe(plugins.cssshrink())
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(gulp.dest('assets/css'))
  .pipe(reload({stream:true}))
  .pipe(plugins.notify({ message: 'Styles task complete' }));
});

// Gulp wp rev
gulp.task('rev', function () {
  gulp.src('inc/script.php')
  .pipe(rev({
    css: 'assets/css/main.min.css',
    cssHandle: "epigone_main",
    js: 'assets/js/scripts.min.js',
    jsHandle: "epigone_scripts"
  }))
  .pipe(gulp.dest('inc'));
});

// Vendor Plugin Scripts
gulp.task('plugins', function() {
  return gulp.src(['assets/js/_*.js', 'assets/js/bootstrap/*.js'])
  .pipe(plugins.concat('scripts.js'))
  .pipe(gulp.dest('assets/js/'))
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(plugins.uglify())
  .pipe(gulp.dest('assets/js'))
  .pipe(plugins.notify({ message: 'Scripts task complete' }))
  .pipe(reload( {stream:true} ));
});

// Site Scripts
gulp.task('scripts', function() {
  return gulp.src(['assets/js/_*.js', '!assets/js/scripts.js'])
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

// Images
gulp.task('images', function() {
  return gulp.src('assets/images/**/*')
  .pipe(plugins.cache(plugins.imagemin({ optimizationLevel: 7, progressive: true, interlaced: true })))
  .pipe(plugins.livereload(server))
  .pipe(gulp.dest('assets/images'))
  .pipe(plugins.notify({ message: 'Images task complete' }))
  .pipe(reload( {stream:true} ));
});

// Watch
gulp.task( 'watch',['browserSync'], function() {

  // Watch .scss files
  gulp.watch('assets/scss/**/*.scss', ['styles']);

  // Watch .js files
  gulp.watch('assets/js/**/*.js', ['plugins', 'scripts']);

  // Watch image files
  gulp.watch('assets/images/**/*', ['images']);


});

// Default task
gulp.task( 'default', ['styles', 'plugins', 'scripts', 'images', 'watch', 'rev'] );
