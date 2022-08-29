const gulp = require( 'gulp' );
const plumber = require( 'gulp-plumber' );
const sass = require( 'gulp-sass' );
const sassGlob = require( 'gulp-sass-glob' );
const postcss = require( 'gulp-postcss' );
const autoprefixer = require( 'autoprefixer' );
const rename = require( 'gulp-rename' );
const uglify = require( 'gulp-uglify' );
const webpack = require( 'webpack-stream' );
const bs = require( 'browser-sync' );

const path = require( 'path' );
const sourcemaps = require( 'gulp-sourcemaps' );

const config = {
	bs: {
		proxy: 'http://pbz.test/',
	},
	sassEntry: {
		src: path.join( __dirname, 'library/scss/style.scss' ),
		dist: path.join( __dirname, 'library/css' ),
	},
	editorEntry: {
		src: path.join( __dirname, 'library/scss/editor-style.scss' ),
		dist: path.join( __dirname, 'library/css' ),
	},
	js: {
		src: path.join( __dirname, 'library/js/scripts.js' ),
		dest: path.join( __dirname, 'library/dist' ),
	},
	filesToWatch: {
		js: [ 'library/js/**/*.js', '!/library/dist/*.js' ],
		sass: [
			'library/scss/*.scss',
			'library/scss/**/*.scss',
			'library/scss/**/**/*.scss',
			'library/scss/**/**/**/*.scss',
		],
		global: [
			'library/*.php',
			'*.php',
			'*/*.php',
			'**/**/*.php',
			'library/js/**/*.js',
		],
	},
};

// Compile JS
gulp.task( 'scripts', () => {
	return gulp
		.src( config.js.src )
		.pipe(
			webpack( {
				mode: 'production',
				output: {
					filename: 'master.js',
				},
				module: {
					rules: [
						{
							test: /\.(js|jsx)$/,
							use: [ 'babel-loader' ],
							exclude: /node_modules/,
						},
					],
				},
			} )
		)
		.pipe( sourcemaps.init() )
		.pipe( uglify() )
		.pipe( rename( { extname: '.min.js' } ) )
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( config.js.dest ) )
		.pipe( bs.stream() );
} );

//Compile scss
gulp.task( 'sass', () => {
	return gulp
		.src( config.sassEntry.src )
		.pipe( sassGlob() )
		.pipe( sourcemaps.init() )
		.pipe( plumber() )
		.pipe(
			sass( {
				outputStyle: 'compressed',
			} ).on( 'error', sass.logError )
		)
		.pipe(
			postcss( [
				autoprefixer( {
					browsers: [ 'last 2 versions' ],
					cascade: false,
					grid: true,
				} ),
			] )
		)
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( config.sassEntry.dist ) )
		.pipe( bs.stream() );
} );

//Compile editor scss
gulp.task( 'editor', () => {
	return gulp
		.src( config.editorEntry.src )
		.pipe( sassGlob() )
		.pipe( sourcemaps.init() )
		.pipe( plumber() )
		.pipe(
			sass( {
				outputStyle: 'compressed',
			} ).on( 'error', sass.logError )
		)
		.pipe(
			postcss( [
				autoprefixer( {
					browsers: [ 'last 2 versions' ],
					cascade: false,
					grid: true,
				} ),
			] )
		)
		.pipe( sourcemaps.write( '.' ) )
		.pipe( gulp.dest( config.editorEntry.dist ) );
} );

// Watch all files for compiling
gulp.task( 'init', () => {
	bs.init( {
		proxy: config.bs.proxy,
		injectChanges: true,
		files: config.filesToWatch.global,
	} );
	gulp.watch( config.filesToWatch.sass, gulp.series( 'sass' ) );
	gulp.watch( config.editorEntry.src, gulp.series( 'editor' ) );
	gulp.watch( config.filesToWatch.js, gulp.series( 'scripts' ) );
} );

gulp.task( 'build', gulp.series( 'sass', 'scripts' ) );

// Start the process
gulp.task( 'default', gulp.series( 'build', 'init' ) );
