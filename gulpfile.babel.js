"use strict";


// ===============================
// 01. IMPORT
// ===============================

import gulp from 'gulp';
import gulpLoadPlugin from 'gulp-load-plugins';

import browserify from "browserify";
import babelify from "babelify";
import stream from "vinyl-source-stream";
import buffer from "vinyl-buffer";
import browserSync from 'browser-sync';
import sourcemaps from 'gulp-sourcemaps';
import globbing from 'gulp-css-globbing';
import streamqueue from "streamqueue";
import zip from 'gulp-zip';
import pjson from './package.json';

// ===============================
// 02. SETTINGS
// - - -
// * 02-01: browserSync
// * 02-02: sass
// * 02-03: scripts
// * 02-04: images
// * 02-05: babel
// * 02-06: watch
// ===============================

const $ = gulpLoadPlugin({camelize: true});

var config = {

    bowerPath: "bower_components",
    bowerConfigPath: "bower.json",

    /**
     * browserSync config
     **/
    browserSync: {
        proxy: "http://example.com",
        notify: true,
        open: true,
        ghostMode: {
            clicks: true,
            forms: true,
            scroll: false
        },
        tunnel: false,
    },

    /**
     * Sass compile config
     **/
    sass: {
        src: "assets/scss/main.scss",
        dest: "assets/css",
        options: {},
    },

    /**
     * Javascript concat
     **/
    scripts: {
        src: ['assets/js/_*.js', '!assets/js/scripts.js', '!assets/js/scripts.min.js'],
        dest: "assets/js",
        jshintrc: ".jshintrc",
        options: {},
    },

    /**
     * Set of image optimization
     **/
    images: {
        src: "assets/_images/**/*",
        dest: "assets/images",
    },

    /**
     * Setting of Babel
     */
    babel: {
        src: ['assets/es6/index.es6'],
        dest: ["assets/js/"]
    },

    // Setting monitoring tasks
    watch: {
        enhanced: ["sass", "js"],
        src: {
            sass: ['assets/scss/**/*.scss', '!assets/scss/themes/*.scss'],
            scripts: ["assets/js/**/*.js"],
            babel: ["assets/es6/**/*.es6"],
            plugins: ["bower_components/**/*.js"],
            images: ['assets/images/**/*']
        },
    }
}


// ===============================
// 03. DEFINE THE TASK
// - - -
// * 03-01 : sass
// * 03-02 : scripts
// * 03-03 : babel
// * 03-04 : browserSync
// * 03-05 : images
// * 03-06 : watch
// * 03-07 : build
// * 03-08 : zip
// ===============================

/**
 * Sass Compiled task.
 */
gulp.task('sass', function () {

    return gulp.src(config.sass.src)
        .pipe($.plumber())
        .pipe(globbing({
            extensions: ['.scss']
        }))
        .pipe($.sass.sync(config.sass.options))
        .pipe(gulp.dest(config.sass.dest))

        .pipe($.rename({
            suffix: '.min'
        }))

        .pipe($.minifyCss({
            keepBreaks: false,
            advanced: true,
        }))

        .pipe(gulp.dest(config.sass.dest))
        .pipe($.notify({message: 'Styles task complete'}))
        .pipe(browserSync.stream())
        .pipe($.size({title: 'css'}))
});


/**
 * es6 compile & JavaScript concat task.
 */
gulp.task('scripts', function () {
    return gulp.src(config.scripts.src)
        .pipe($.plumber())
        .pipe($.jshint(config.scripts.jshintrc))
        .pipe($.jshint.reporter('default'))
        .pipe($.concat('scripts.js'))
        .pipe(gulp.dest(config.scripts.dest))
        .pipe($.rename({suffix: '.min'}))
        .pipe($.uglify())
        .pipe(gulp.dest(config.scripts.dest))
        .pipe($.notify({message: 'Scripts task complete'}))
        .pipe($.size({title: 'js'}));
});


/**
 * es6 compile & JavaScript concat task.
 */

gulp.task('babel', function () {
    browserify({
        entries: [config.babel.src]
    })
        .transform(babelify)
        .bundle()
        .on("error", function (err) {
            console.log("Error : " + err.message);
        })
        .pipe(stream('index.js'))
        .pipe(buffer())
        .pipe(gulp.dest(config.scripts.dest))
        .pipe($.notify({message: 'Babel task complete.'}));
});

/**
 * Browser Sync task.
 */
gulp.task('browserSync', ['sass'], () =>
    browserSync(config.browserSync)
);

// reload
gulp.task('bs-reload', () =>
    browserSync.stream()
);


/**
 * Image tasks.
 */

gulp.task('images', () =>
    gulp.src(config.images.src)
        .pipe($.plumber())
        .pipe($.cache($.imagemin({optimizationLevel: 8, progressive: true, interlaced: true})))
        .pipe(gulp.dest(config.images.dest))
        .pipe($.notify({message: 'Images task complete.'}))
        .pipe($.size({title: 'images'}))
);


/**
 * "Watch" tasks.
 */
gulp.task('watch', ['browserSync'], function () {

    gulp.watch(config.watch.src.sass, ['sass', 'bs-reload']);

    gulp.watch(config.watch.src.scripts, ['scripts', 'bs-reload']);

    gulp.watch(config.watch.src.babel, ['babel', 'bs-reload']);

    gulp.watch(config.watch.src.plugins, ['plugins', 'bs-reload']);

    gulp.watch(config.watch.src.images, ['bs-reload']);

});

/**
 * "Build" tasks.
 */
gulp.task('build', ['sass', 'babel', 'scripts', 'plugins', 'images']);


/**
 * "Zip" tasks.
 */
gulp.task("zip", function () {
    var date = new Date().toISOString().replace(/[^0-9]/g, ''),
        stream = streamqueue({objectMode: true});

    stream.queue(
        // to list the files to be stored in a zip file up
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



gulp.task('default',['watch']);
