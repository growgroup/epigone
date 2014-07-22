'use strict';

// load plugins
var gulp = require('gulp');
var plugins = require('gulp-load-plugins')({ camelize: true });
var browserSync = require('browser-sync');
var reload = browserSync.reload;

// browser sync
gulp.task('browserSync', function() {
  browserSync.init( null, {
    notify: true,
    proxy: {
      host: "your-domain.dev", // replace your domain
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
  .pipe(plugins.rubySass({ style: 'expanded', compass: true , trace: true }))
  .pipe(plugins.autoprefixer('last 2 versions', 'ie 9', 'ios 6', 'android 4'))
  .pipe(gulp.dest('assets/css'))
  .pipe(plugins.cssshrink())
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(gulp.dest('assets/css'))
  .pipe(reload({stream:true}))
  .pipe(plugins.notify({ message: 'Styles task complete' }));
});

// Vendor Plugin Scripts
gulp.task('plugins', function() {
  return gulp.src(['assets/js/_*.js', 'assets/js/bootstrap/*.js'])
  .pipe(plugins.plumber())
  .pipe(plugins.concat('scripts.js'))
  .pipe(gulp.dest('assets/js/'))
  .pipe(plugins.rename({ suffix: '.min' }))
  .pipe(plugins.uglify())
  .pipe(gulp.dest('assets/js'))
  .pipe(plugins.notify({ message: 'Scripts task complete' }))
  .pipe(reload( {stream:true} ));
});

// task "javascript"
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
  .pipe(plugins.notify({ message: 'Images task complete' }))
  .pipe(reload( {stream:true} ));
});

// task "php"
gulp.task('php', function(){
  return gulp.src('./**/*.php')
  .pipe(reload({stream:true}));
});

// assets version
gulp.task('rev', function () {
  gulp.src('inc/script.php')
  .pipe(plugins.rev({
    css: 'assets/css/main.min.css',
    cssHandle: "epigone_main",
    js: 'assets/js/scripts.min.js',
    jsHandle: "epigone_scripts"
  }))
  .pipe(gulp.dest('inc'));
});

// task "watch"
gulp.task( 'watch', ['browserSync'], function() {

  // Watch .scss files
  gulp.watch('assets/scss/**/*.scss', ['styles']);

  // Watch .js files
  gulp.watch('assets/js/**/*.js', ['plugins', 'scripts']);

  // Watch image files
  gulp.watch('assets/images/**/*', ['images']);

  // watch php .php
  gulp.watch('./**/*.php', ['php']);

});

// Default task
gulp.task( 'default', ['styles', 'plugins', 'scripts', 'images', 'watch', 'rev'] );
