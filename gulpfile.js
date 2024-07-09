import gulp from 'gulp';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';
import autoprefixer from 'gulp-autoprefixer';
import imagemin from "gulp-imagemin";
import uglify from 'gulp-uglify';
import cache from 'gulp-cache';
import concat from 'gulp-concat';
import rename from 'gulp-rename';

const sass = gulpSass(dartSass);

gulp.task('sass', async function () {
    gulp.src('resources/scss/iulotka.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(rename('site.css'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('iulotka/web/css'));

    gulp.src('resources/scss/gazetki.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(sass({
            outputStyle: 'compressed'
        }))
        .pipe(rename('site.css'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('gazetki/web/css'));
});

gulp.task('js', async function () {
    return gulp.src([
            'resources/js/jquery.min.js',
            'resources/js/jquery.migrate.js',
            // 'resources/js/bootstrap.js',
            'resources/js/jquery.imagesloaded.min.js',
            'resources/js/jquery.isotope.min.js',
            'resources/js/lightgallery.min.js',
            'resources/js/lg-zoom.min.js',
            'resources/js/lg-hash.min.js',
            'resources/js/script.js',
        ])
        .pipe(concat('app.js'))
        .pipe(uglify())
        .pipe(gulp.dest('iulotka/web/js'))
        .pipe(gulp.dest('gazetki/web/js'));
});

gulp.task('images', function () {
    return gulp.src('resources/images/**/*.+(png|jpg|jpeg|gif|svg|webp)')
        .pipe(cache(imagemin({
            interlaced: true,
        })))
        .pipe(gulp.dest('iulotka/web/images'))
        .pipe(gulp.dest('gazetki/web/images'));
});

gulp.task('fonts', function () {
    return gulp.src('resources/fonts/**/*')
        .pipe(gulp.dest('iulotka/web/fonts'))
        .pipe(gulp.dest('gazetki/web/fonts'));
});

gulp.task('robots', () => {
    return gulp.src('resources/robots.txt')
        .pipe(gulp.dest('iulotka/web'))
        .pipe(gulp.dest('gazetki/web'));
});

gulp.task('build', gulp.series('sass', 'js', 'fonts', 'images', 'robots', function (done) {
    done();
}));