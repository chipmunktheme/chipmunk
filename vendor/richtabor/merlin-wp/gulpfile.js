/**
* Gulpfile.
* Project Configuration for gulp tasks.
*/

const pkg                     = require('./package.json');

const project                 = pkg.name;
const {slug} = pkg;
const {version} = pkg;
const projectURL              = 'http://demo.merlinwp.dev/wp-admin/themes.php?page=merlin';

// Translations.
const text_domain             = '@@textdomain';
const destFile                = `${slug}.pot`;
const packageName             = project;
const bugReport               = pkg.author_uri;
const lastTranslator          = pkg.author;
const team                    = pkg.author_shop;
const translatePath           = `./languages/${  destFile}`;
const translatableFiles       = ['./**/*.php', '!merlin-config-sample.php', '!merlin-filters-sample.php' ];

// Styles.
const merlinStyleSRC          = './assets/scss/merlin.scss'; // Path to main .scss file.
const merlinStyleDestination  = './assets/css/'; // Path to place the compiled CSS file.
const merlinCssFiles          = './assets/css/**/*.css'; // Path to main .scss file.
const merlinStyleWatchFiles   = './assets/scss/**/*.scss'; // Path to all *.scss files inside css folder and inside them.

// Scripts.
const merlinScriptSRC         = './assets/js/merlin.js'; // Path to JS custom scripts folder.
const merlinScriptDestination = './assets/js/'; // Path to place the compiled JS custom scripts file.
const merlinScriptFile        = 'merlin'; // Compiled JS file name.
const merlinScriptWatchFiles  = './assets/js/*.js'; // Path to all *.scss files inside css folder and inside them.

// Watch files.
const projectPHPWatchFiles    = ['./**/*.php', '!_dist'];

// Build files.
const buildFiles              = ['./**', '!node_modules/**', '!dist/', '!demo/**', '!composer.json', '!composer.lock', '!.gitattributes', '!phpcs.xml', '!package.json', '!package-lock.json', '!gulpfile.js', '!LICENSE', '!README.md', '!assets/scss/**', '!merlin-config-sample.php', '!merlin-filters-sample.php', '!CODE_OF_CONDUCT.md' ];
const buildDestination        = './dist/merlin/';
const distributionFiles       = './dist/merlin/**/*';

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
const gulp         = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const browserSync  = require('browser-sync').create();
const cache        = require('gulp-cache');
const cleaner      = require('gulp-clean');
const copy         = require('gulp-copy');
const csscomb      = require('gulp-csscomb');
const filter       = require('gulp-filter');
const lineec       = require('gulp-line-ending-corrector');
const minifycss    = require('gulp-clean-css');
const notify       = require('gulp-notify');

const {reload} = browserSync;
const rename       = require('gulp-rename');
const replace      = require('gulp-replace-task');
const runSequence  = require('gulp-run-sequence');
const sass         = require('gulp-sass');
const sort         = require('gulp-sort');
const uglify       = require('gulp-uglify');
const wpPot        = require('gulp-wp-pot');
const zip          = require('gulp-zip');
const composer     = require('gulp-composer');

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
	gulp.src( merlinStyleSRC )

	.pipe( sass( {
		errLogToConsole: true,
		outputStyle: 'expanded',
		precision: 10
	} ) )

	.on( 'error', console.error.bind( console ) )

	.pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )

	.pipe( csscomb() )

	.pipe( gulp.dest( merlinStyleDestination ) )

	.pipe( browserSync.stream() )

	.pipe( rename( { suffix: '.min' } ) )

	.pipe( minifycss( {
		maxLineLen: 10
	}))

	.pipe( gulp.dest( merlinStyleDestination ) )

	.pipe( browserSync.stream() )
});

gulp.task( 'scripts', function() {
	gulp.src( merlinScriptSRC )
	.pipe( rename( {
		basename: merlinScriptFile,
		suffix: '.min'
	}))
	.pipe( uglify() )
	.pipe( lineec() )
	.pipe( gulp.dest( merlinScriptDestination ) )

});

gulp.task( 'default', ['clear', 'styles', 'scripts', 'browser_sync' ], function () {
	gulp.watch( projectPHPWatchFiles, reload );
	gulp.watch( merlinStyleWatchFiles, [ 'styles' ] );
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
		destFile,
		package       : project,
		bugReport,
		lastTranslator,
		team
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
    return gulp.src( `${buildDestination}/**` , { base: 'dist' } )
    .pipe( zip( 'merlin.zip' ) )
    .pipe( gulp.dest( './dist/' ) );
});

gulp.task( 'build-clean-after-zip', ['build-zip'], function () {
	return gulp.src( [ buildDestination, `!/dist/${  slug  }-wp.zip`] , { read: false } )
	.pipe(cleaner());
});

gulp.task( 'build-zip-and-clean', ['build-zip', 'build-clean-after-zip' ], function () { } );

gulp.task( 'build-notification', function () {
	return gulp.src( '' )
	.pipe( notify( { message: `Your build of ${  packageName  } is complete.`, onLast: true } ) );
});

gulp.task('build', function(callback) {
	runSequence( 'clear', 'build-clean', ['styles', 'scripts', 'build-translate'], 'build-clean-and-copy', 'build-variables', 'build-zip-and-clean', 'build-notification', callback);
});
