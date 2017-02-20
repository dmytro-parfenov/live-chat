var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync').create(),
    rename = require('gulp-rename'),
    js = require('gulp-uglify');

gulp.task('serve', ['sass', 'js', 'sass-admin', 'js-admin'], function () {

    browserSync.init({
        proxy: "http://live-chat"
    });

    gulp.watch("resources/assets/frontend/sass/**/*.scss", ['sass']);
    gulp.watch("resources/assets/admin/sass/**/*.scss", ['sass-admin']);
    gulp.watch("resources/assets/frontend/js/**/*.js", ['js']);
    gulp.watch("resources/assets/admin/js/**/*.js", ['js-admin']);
    gulp.watch("resources/views/**/*.*.php").on('change', browserSync.reload);
    gulp.watch("app/**/*.php").on('change', browserSync.reload);

});

gulp.task('sass', function () {
    return gulp.src("resources/assets/frontend/sass/**/*.scss")
        .pipe(sass())
        .on('error', catchErr)
        .pipe(rename({dirname: ''}))
        .pipe(gulp.dest("public/frontend/css"))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(rename({suffix: '.min'}))
        .pipe(rename({dirname: ''}))
        .pipe(gulp.dest("public/frontend/css"))
        .pipe(browserSync.stream());
});

gulp.task('js', function() {
    return gulp.src("resources/assets/frontend/js/**/*.js")
        .pipe(js())
        .on('error', catchErr)
        .pipe(rename({suffix: '.min'}))
        .pipe(rename({dirname: ''}))
        .pipe(gulp.dest("public/frontend/js/"))
        .pipe(browserSync.stream());
});

gulp.task('sass-admin', function () {
    return gulp.src("resources/assets/admin/sass/**/*.scss")
        .pipe(sass())
        .on('error', catchErr)
        .pipe(rename({dirname: ''}))
        .pipe(gulp.dest("public/admin/css"))
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(rename({suffix: '.min'}))
        .pipe(rename({dirname: ''}))
        .pipe(gulp.dest("public/admin/css"))
        .pipe(browserSync.stream());
});

gulp.task('js-admin', function() {
    return gulp.src("resources/assets/admin/js/**/*.js")
        .pipe(js())
        .on('error', catchErr)
        .pipe(rename({suffix: '.min'}))
        .pipe(rename({dirname: ''}))
        .pipe(gulp.dest("public/admin/js/"))
        .pipe(browserSync.stream());
});

function catchErr(error) {
    console.log(error);
    this.emit('end');
}

gulp.task('start', ['serve']);