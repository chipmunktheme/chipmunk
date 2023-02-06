/**
* Gulpfile.
* Project Configuration for gulp tasks.
*/

var pkg                     = require('./package.json');
var project                 = pkg.name;
var slug                    = pkg.slug;
var version                 = pkg.version;
var projectURL              = 'http://demo.almondwp.dev/wp-admin/themes.php?page=almond';

// Translations.
var text_domain             = '@@textdomain';
var destFile                = slug+'.pot';
var packageName             = project;
var bugReport               = pkg.author_uri;
var lastTranslator          = pkg.author;
var team                    = pkg.author_shop;
var translatePath           = './languages/' + destFile;
var translatableFiles       = ['./**/*.php', '!almond-config-sample.php', '!almond-filters-sample.php' ];

// Styles.
var almondStyleSRC          = './assets/scss/almond.scss'; // Path to main .scss file.
var almondStyleDestination  = './assets/css/'; // Path to place the compiled CSS file.
var almondCssFiles          = './assets/css/**/*.css'; // Path to main .scss file.
var almondStyleWatchFiles   = './assets/scss/**/*.scss'; // Path to all *.scss files inside css folder and inside them.

// Scripts.
var almondScriptSRC         = './assets/js/almond.js'; // Path to JS custom scripts folder.
var almondScriptDestination = './assets/js/'; // Path to place the compiled JS custom scripts file.
var almondScriptFile        = 'almond'; // Compiled JS file name.
var almondScriptWatchFiles  = './assets/js/*.js'; // Path to all *.scss files inside css folder and inside them.

// Watch files.
var projectPHPWatchFiles    = ['./**/*.php', '!_dist'];

// Build files.
var buildFiles              = ['./**', '!node_modules/**', '!dist/', '!demo/**', '!composer.json', '!composer.lock', '!.gitattributes', '!phpcs.xml', '!package.json', '!package-lock.json', '!gulpfile.js', '!LICENSE', '!README.md', '!assets/scss/**', '!almond-config-sample.php', '!almond-filters-sample.php', '!CODE_OF_CONDUCT.md' ];
var buildDestination        = './dist/almond/';
var distributionFiles       = './dist/almond/**/*';

// Browsers you care about for autoprefixing. https://github.com/ai/browserslist
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
* Load Plugins.
*/
var gulp         = require('gulp');
var autoprefixer = require('gulp-autoprefixer');
var browserSync  = require('browser-sync').create();
var cache        = require('gulp-cache');
var cleaner      = require('gulp-clean');
var copy         = require('gulp-copy');
var csscomb      = require('gulp-csscomb');
var filter       = require('gulp-filter');
var lineec       = require('gulp-line-ending-corrector');
var minifycss    = require('gulp-clean-css');
var notify       = require('gulp-notify');
var reload       = browserSync.reload;
var rename       = require('gulp-rename');
var replace      = require('gulp-replace-task');
var runSequence  = require('gulp-run-sequence');
var sass         = require('gulp-sass');
var sort         = require('gulp-sort');
var uglify       = require('gulp-uglify');
var wpPot        = require('gulp-wp-pot');
var zip          = require('gulp-zip');
var composer     = require('gulp-composer');

/**
 * Development Tasks.
 */
gulp.task('clear', function () {
	cache.clearAll();
});

gulp.task( 'browser_sync', function() {
	browserSync.init( {

	// Project URL.
	proxy: projectURL,

	// `true` Automatically open the browser with BrowserSync live server.
	// `false` Stop the browser from automatically opening.
	open: true,

	// Inject CSS changes.
	injectChanges: true,

	});
});

gulp.task('styles', function () {
	gulp.src( almondStyleSRC )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on( 'error', console.error.bind( console ) )

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( csscomb() )

	.pipe( gulp.dest( almondStyleDestination ) )

	.pipe( browserSync.stream() )

	.pipe( rename( { suffix: '.min' } ) )

	.pipe( minifycss( {
		maxLineLen: 10
	}))

	.pipe( gulp.dest( almondStyleDestination ) )

	.pipe( browserSync.stream() )
});

gulp.task( 'scripts', function() {
	gulp.src( almondScriptSRC )
	.pipe( rename( {
		basename: almondScriptFile,
		suffix: '.min'
	}))
	.pipe( uglify() )
	.pipe( lineec() )
	.pipe( gulp.dest( almondScriptDestination ) )

});

gulp.task( 'default', ['clear', 'styles', 'scripts', 'browser_sync' ], function () {
	gulp.watch( projectPHPWatchFiles, reload );
	gulp.watch( almondStyleWatchFiles, [ 'styles' ] );
});

gulp.task("composer", function () {
	composer({ "async": false });
});

/**
 * Build Tasks.
 */

gulp.task( 'build-translate', function () {

	gulp.src( translatableFiles )

	.pipe( sort() )
	.pipe( wpPot( {
		domain        : text_domain,
		destFile      : destFile,
		package       : project,
		bugReport     : bugReport,
		lastTranslator: lastTranslator,
		team          : team
	} ))
	.pipe( gulp.dest( translatePath ) )

});

gulp.task( 'build-clean', function () {
	return gulp.src( ['./dist/*'] , { read: false } )
	.pipe(cleaner());
});

gulp.task( 'build-copy', ['build-clean', 'composer'], function() {
    return gulp.src( buildFiles )
    .pipe( copy( buildDestination ) );
});

gulp.task( 'build-clean-and-copy', ['build-clean', 'build-copy' ], function () { } );

gulp.task('build-variables', ['build-clean-and-copy'], function () {
	return gulp.src( distributionFiles )
	.pipe( replace( {
		patterns: [
		{
			match: 'pkg.version',
			replacement: version
		},
		{
			match: 'textdomain',
			replacement: pkg.textdomain
		}
		]
	}))
	.pipe( gulp.dest( buildDestination ) );
});

gulp.task( 'build-zip', ['build-variables'] , function() {
    return gulp.src( buildDestination+'/**' , { base: 'dist' } )
    .pipe( zip( 'almond.zip' ) )
    .pipe( gulp.dest( './dist/' ) );
});

gulp.task( 'build-clean-after-zip', ['build-zip'], function () {
	return gulp.src( [ buildDestination, '!/dist/' + slug + '-wp.zip'] , { read: false } )
	.pipe(cleaner());
});

gulp.task( 'build-zip-and-clean', ['build-zip', 'build-clean-after-zip' ], function () { } );

gulp.task( 'build-notification', function () {
	return gulp.src( '' )
	.pipe( notify( { message: 'Your build of ' + packageName + ' is complete.', onLast: true } ) );
});

gulp.task('build', function(callback) {
	runSequence( 'clear', 'build-clean', ['styles', 'scripts', 'build-translate'], 'build-clean-and-copy', 'build-variables', 'build-zip-and-clean', 'build-notification', callback);
});
