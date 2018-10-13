// Gulp.js configuration
'use strict';

const

  // Gulp and plugins
  gulp          = require('gulp'),
  gutil         = require('gulp-util'),
  newer         = require('gulp-newer'),
  sass          = require('gulp-sass'),
  postcss       = require('gulp-postcss'),
  deporder      = require('gulp-deporder'),
  stripdebug    = require('gulp-strip-debug'),

  // CSS related plugins.
  minifycss    = require('gulp-uglifycss'), // Minifies CSS files.
  autoprefixer = require('gulp-autoprefixer'), // Autoprefixing magic.
  mmq          = require('gulp-merge-media-queries'), // Combine matching media queries into one media query definition.

  // JS related plugins.
  concat       = require('gulp-concat'), // Concatenates JS files
  uglify       = require('gulp-uglify'), // Minifies JS files

  // Image realted plugins.
  imagemin     = require('gulp-imagemin'), // Minify PNG, JPEG, GIF and SVG images with imagemin.

  // Utility related plugins.
  rename       = require('gulp-rename'), // Renames files E.g. style.css -> style.min.css
  lineec       = require('gulp-line-ending-corrector'), // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings)
  filter       = require('gulp-filter'), // Enables you to work on a subset of the original files by filtering them using globbing.
  sourcemaps   = require('gulp-sourcemaps'), // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css)
  notify       = require('gulp-notify'), // Sends message notification to you
  browserSync  = require('browser-sync').create(), // Reloads browser and injects CSS. Time-saving synchronised browser testing.
  reload       = browserSync.reload, // For manual browser reload.
  wpPot        = require('gulp-wp-pot'), // For generating the .pot file.
  sort         = require('gulp-sort'), // Recommended to prevent unnecessary changes in pot-file.


  build     = './cosmo/', // Files that you want to package into a zip go here
  buildInclude  = [
        // include common file types
        '**/*.php',
        '**/*.html',
        '**/*.css',
        '**/*.js',
        '**/*.svg',
        '**/*.ttf',
        '**/*.otf',
        '**/*.eot',
        '**/*.woff',
        '**/*.woff2',

        // include specific files and folders
        'screenshot.png',
        'readme.txt',

        // exclude files and folders
        '!node_modules/**/*',
        '!style.css.map',
        '!assets/js/custom/*',
        '!assets/sass/*',
        '!gulpfile.js',
        '!assets/js'

];

// Browser-sync
var browsersync = false;


// START Editing Project Variables.
// Project related.
var project                 = 'cosmo'; // Project Name.
var projectURL              = 'new-collection.test'; // Local project URL of your already running WordPress site. Could be something like local.dev or localhost:8888.
var productURL              = './cosmo'; // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.


// Style related.
var styleSRC                = './assets/sass/style.scss'; // Path to main .scss file.
var styleDestination        = './'; // Path to place the compiled CSS file.
// Default set to root folder.

// JS Custom related.
var jsCustomSRC             = './assets/js/*.js'; // Path to JS custom scripts folder.
var jsCustomDestination     = './js'; // Path to place the compiled JS custom scripts file.
var jsCustomFile            = 'custom'; // Compiled JS custom file name.
// Default set to custom i.e. custom.js.

// Images related.
var imagesSRC               = './assets/img/raw/**/*.{png,jpg,gif,svg}'; // Source folder of images which should be optimized.
var imagesDestination       = './assets/img/'; // Destination folder of optimized images. Must be different from the imagesSRC folder.

// Watch files paths.
var styleWatchFiles         = './assets/sass/**/*.scss'; // Path to all *.scss files inside css folder and inside them.
//var vendorJSWatchFiles      = './assets/js/vendor/*.js'; // Path to all vendor JS files.
var customJSWatchFiles      = './assets/js/**/*.js'; // Path to all custom JS files.
var projectPHPWatchFiles    = './**/*.php'; // Path to all PHP files.

// Browsers you care about for autoprefixing.
// Browserlist https        ://github.com/ai/browserslist
const AUTOPREFIXER_BROWSERS = [
    'last 2 version',
    '> 1%',
    'ie >= 9',
    'ie_mob >= 10',
    'ff >= 30',
    'chrome >= 34',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4',
    'bb >= 10'
  ];


/**
 * Task: `styles`.
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source scss file
 *    2. Compiles Sass to CSS
 *    3. Writes Sourcemaps for it
 *    4. Autoprefixes it and generates style.css
 *    5. Renames the CSS file with suffix .min.css
 *    6. Minifies the CSS file and generates style.min.css
 *    7. Injects CSS or reloads the browser via browserSync
 */
 gulp.task('styles', function () {
    gulp.src( styleSRC )
    .pipe( sourcemaps.init() )
    .pipe( sass( {
      errLogToConsole: true,
      outputStyle: 'compact',
      // outputStyle: 'compressed',
      // outputStyle: 'nested',
      // outputStyle: 'expanded',
      precision: 10
    } ) )
    .on('error', console.error.bind(console))
    .pipe( sourcemaps.write( { includeContent: false } ) )
    .pipe( sourcemaps.init( { loadMaps: true } ) )
    .pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

    .pipe( sourcemaps.write ( styleDestination ) )
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( gulp.dest( styleDestination ) )

    .pipe( filter( '**/*.css' ) ) // Filtering stream to only css files
    .pipe( mmq( { log: true } ) ) // Merge Media Queries only for .min.css version.

    .pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.

    .pipe( rename( { suffix: '.min' } ) )
    .pipe( minifycss( {
      maxLineLen: 10
    }))
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( gulp.dest( styleDestination ) )

    .pipe( filter( '**/*.css' ) ) // Filtering stream to only css files
    .pipe( browserSync.stream() )// Reloads style.min.css if that is enqueued.
    .pipe( notify( { message: 'TASK: "styles" Completed! 💯', onLast: true } ) )
 });


 /**
  * Task: `customJS`.
  *
  * Concatenate and uglify custom JS scripts.
  *
  * This task does the following:
  *     1. Gets the source folder for JS custom files
  *     2. Concatenates all the files and generates custom.js
  *     3. Renames the JS file with suffix .min.js
  *     4. Uglifes/Minifies the JS file and generates custom.min.js
  */
 gulp.task( 'customJS', function() {
    gulp.src( jsCustomSRC )
    .pipe( concat( jsCustomFile + '.js' ) )
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( gulp.dest( jsCustomDestination ) )
    .pipe( rename( {
      basename: jsCustomFile,
      suffix: '.min'
    }))
    .pipe( uglify() )
    .on('error', function (err) { gutil.log(gutil.colors.red('[Error]'), err.toString()); })
    .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
    .pipe( gulp.dest( jsCustomDestination ) )
    .pipe( notify( { message: 'TASK: "customJs" Completed! 💯', onLast: true } ) );
 });

 /**
  * Task: `images`.
  *
  * Minifies PNG, JPEG, GIF and SVG images.
  *
  * This task does the following:
  *     1. Gets the source of images raw folder
  *     2. Minifies PNG, JPEG, GIF and SVG images
  *     3. Generates and saves the optimized images
  *
  * This task will run only once, if you want to run it
  * again, do it with the command `gulp images`.
  */
 gulp.task( 'images', function() {
  gulp.src( imagesSRC )
    .pipe( imagemin( {
          progressive: true,
          optimizationLevel: 3, // 0-7 low-high
          interlaced: true,
          svgoPlugins: [{removeViewBox: false}]
        } ) )
    .pipe(gulp.dest( imagesDestination ))
    .pipe( notify( { message: 'TASK: "images" Completed! 💯', onLast: true } ) );
});


// browser-sync task for starting the server.
gulp.task('browser-sync', function() {
    //watch files
    var files = [
    './*.php',
    '**/*.scss'
    ];
 
    //initialize browsersync
    browserSync.init(files, {
    //browsersync with a php server
    proxy: "http://new-collection.test/",
    port: 3020,
    notify: false
    });
});


/*
* Delete the 'dist' folder before each new build
*/
gulp.task('clean', function () {
  return del(['dist']);
});


/**
  * Build task that moves essential theme files for production-ready sites
  *
  * buildFiles copies all the files in buildInclude to build folder - check variable values at the top
  * buildImages copies all the images from img folder in assets while ignoring images inside raw folder if any
  */
  gulp.task('build', function() {
    return  gulp.src(buildInclude)
      .pipe(gulp.dest(build))
      .pipe(notify({ message: 'Copy from buildFiles complete', onLast: true }));
});


  /**
  * Watch Tasks.
  *
  * Watches for file changes and runs specific tasks.
  */
 gulp.task( 'default', ['styles', 'customJS', 'images', 'browser-sync'], function () {
  gulp.watch( projectPHPWatchFiles, reload ); // Reload on PHP file changes.
  gulp.watch( styleWatchFiles, [ 'styles', reload ] ); // Reload on SCSS file changes.
  gulp.watch( customJSWatchFiles, [ 'customJS', reload ] ); // Reload on customJS file changes.
});