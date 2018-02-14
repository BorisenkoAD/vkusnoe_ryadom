var gulp          = require('gulp'),
		gutil         = require('gulp-util' ),
		sass          = require('gulp-sass'),
		browsersync   = require('browser-sync'),
		concat        = require('gulp-concat'),
		uglify        = require('gulp-uglify'),
		cleancss      = require('gulp-clean-css'),
		rename        = require('gulp-rename'),
		autoprefixer  = require('gulp-autoprefixer'),
		notify        = require("gulp-notify"),
		rsync         = require('gulp-rsync'),
		ftp 		  = require( 'vinyl-ftp' );

// Scripts concat & minify

gulp.task('js', function() {
	return gulp.src([
		'app/libs/jquery/dist/jquery.min.js',
		'app/libs/popper.js/dist/umd/popper.min.js',
	//	'app/libs/popper.js/dist/popper-utils.js',
		'app/libs/holderjs/holder.min.js',
		'app/libs/bootstrap/dist/js/bootstrap.min.js',
	//	'app/libs/bootstrap/js/dist/util.js',
		'app/libs/magnific-popup/dist/jquery.magnific-popup.min.js',
		'app/js/common.js', // Always at the end
		])
	.pipe(concat('scripts.min.js'))
	// .pipe(uglify()) // Mifify js (opt.)
	.pipe(gulp.dest('app/js'))
	.pipe(browsersync.reload({ stream: true }))
});

gulp.task('browser-sync', function() {
	browsersync({
		server: {
			baseDir: 'app'
		},
		notify: false,
		// tunnel: true,
		// tunnel: "projectmane", //Demonstration page: http://projectmane.localtunnel.me
	})
});

gulp.task('sass', function() {
	return gulp.src('app/sass/**/*.sass')
	.pipe(sass({ outputStyle: 'expand' }).on("error", notify.onError()))
	.pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(autoprefixer(['last 15 versions']))
	.pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
	.pipe(gulp.dest('app/css'))
	.pipe(browsersync.reload( {stream: true} ))
});

gulp.task('watch', ['sass', 'js', 'browser-sync'], function() {
	gulp.watch('app/sass/**/*.sass', ['sass']);
	gulp.watch(['libs/**/*.js', 'app/js/common.js'], ['js']);
	gulp.watch('app/*.html', browsersync.reload)
});

gulp.task('rsync', function() {
	return gulp.src('app/**')
	.pipe(rsync({
		root: 'app/',
		hostname: 'root@77.244.220.168',
		destination: '77.244.220.168/html',
	//	include: ['*.htaccess'], // Includes files to deploy
	//	exclude: ['**/Thumbs.db', '**/*.DS_Store'], // Excludes files from deploy
	//	recursive: true,
		archive: true,
		silent: false,
		compress: true
	}))
});

gulp.task( 'deploy', function () {
 
    var conn = ftp.create( {
        host:     '77.244.220.168',
        user:     'dvr',
        password: 'hCmR2ARr',
        parallel: 1,
        log:      gutil.log
    });

    var globs = [
        'app/img/**',
        'app/css/**',
        'app/js/**',
        'app/fonts/**',
        'app/index.html'
    ];

    return gulp.src( globs, { base: '.', buffer: false } )
        .pipe( conn.newer( '/var/www/html' ) ) // only upload newer files
        .pipe( conn.dest( '/var/www/html' ) );
 
} );

gulp.task('default', ['watch']);
