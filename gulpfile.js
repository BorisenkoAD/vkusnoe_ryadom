var gulp          = require('gulp'),
		gutil         = require('gulp-util' ),
		sass          = require('gulp-sass'),
		browsersync   = require('browser-sync'),
		concat        = require('gulp-concat'),
		uglify        = require('gulp-uglify'),		
		htmlmin 	  = require('gulp-htmlmin'),
		del           = require('del'),
		imagemin      = require('gulp-imagemin'),
		pngquant 	  = require('imagemin-pngquant'),
		mozjpeg 	  = require('imagemin-mozjpeg'),
		cache         = require('gulp-cache'),		
		cleancss      = require('gulp-clean-css'),
		rename        = require('gulp-rename'),
		autoprefixer  = require('gulp-autoprefixer'),
		ftp           = require('vinyl-ftp'),
		notify        = require("gulp-notify"),
		rsync         = require('gulp-rsync');


// Scripts concat & minify

gulp.task('js', function() {
	return gulp.src([
		'app/libs/jquery/dist/jquery.min.js',
		'app/libs/popper.js/dist/umd/popper.min.js',
	//	'app/libs/popper.js/dist/popper-utils.js',
		'app/libs/bootstrap/dist/js/bootstrap.min.js',
		'app/libs/parallax.js/parallax.min.js',
	//	'app/libs/bootstrap/js/dist/util.js',
		'app/libs/magnific-popup/dist/jquery.magnific-popup.min.js',

		'app/js/common.js', // Always at the end
		])
	.pipe(concat('scripts.min.js'))
	.pipe(uglify()) // Mifify js (opt.)
	.pipe(gulp.dest('app/js'))
	.pipe(browsersync.reload({ stream: true }))
});

gulp.task('browser-sync', function() {
	browsersync({
		proxy: "vkusnoe-ryadom",
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


gulp.task('watch', ['sass', 'js', 'minify', 'browser-sync'], function() {
	gulp.watch('app/sass/**/*.sass', ['sass']);
	gulp.watch(['libs/**/*.js', 'app/js/common.js'], ['js']);
	gulp.watch('app/*.php', browsersync.reload);
	gulp.watch('app/*.html', browsersync.reload)
});

gulp.task('imagemin', function() {
	return gulp.src('app/img/**/*')
	.pipe(cache(imagemin())) // Cache Images
        .pipe(imagemin([
            pngquant(),
            mozjpeg({
                 progressive: true
            })
        ],{
            verbose: true
        }))	
	.pipe(gulp.dest('dist/img')); 
});

gulp.task('minify', function() {
	return gulp.src('app/*.html')
	.pipe(htmlmin({collapseWhitespace: true}))
	.pipe(gulp.dest('dist'));
});

gulp.task('build', ['removedist', 'imagemin', 'sass', 'js', 'minify'], function() {

	var buildFiles = gulp.src([
		'app/*.html',
		'app/*php',
		'app/.htaccess',
		]).pipe(gulp.dest('dist'));

	var buildCss = gulp.src([
		'app/css/main.min.css',
		]).pipe(gulp.dest('dist/css'));

	var buildJs = gulp.src([
		'app/js/scripts.min.js',
		]).pipe(gulp.dest('dist/js'));

	var buildFonts = gulp.src([
		'app/fonts/**/*',
		]).pipe(gulp.dest('dist/fonts'));

});

gulp.task('deploy', function() {

	var conn = ftp.create({
		host:      'hostname.com',
		user:      'username',
		password:  'userpassword',
		parallel:  10,
		log: gutil.log
	});

	var globs = [
	'dist/**',
	'dist/.htaccess',
	];
	return gulp.src(globs, {buffer: false})
	.pipe(conn.dest('/path/to/folder/on/server'));

});

gulp.task('rsync', function() {
	return gulp.src('dist/**')
	.pipe(rsync({
		root: 'dist/',
		hostname: 'username@yousite.com',
		destination: 'yousite/public_html/',
		// include: ['*.htaccess'], // Скрытые файлы, которые необходимо включить в деплой
		recursive: true,
		archive: true,
		silent: false,
		compress: true
	}));
});
gulp.task('removedist', function() { return del.sync('dist'); });
gulp.task('clearcache', function () { return cache.clearAll(); });

gulp.task('default', ['watch']);
