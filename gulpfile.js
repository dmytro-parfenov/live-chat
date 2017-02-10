var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync').create(),
    rename = require('gulp-rename'),
    js = require('gulp-uglify');

gulp.task('serve', ['sass', 'js'], function () {

    browserSync.init({
        proxy: "http://live-chat"
    });

    gulp.watch("resources/assets/sass/**/*.scss", ['sass']);
    gulp.watch("resources/assets/js/**/*.js", ['js']);
    gulp.watch("resources/views/**/*.*.php").on('change', browserSync.reload);
    gulp.watch("app/**/*.php").on('change', browserSync.reload);

});

gulp.task('sass', function () {
    return gulp.src("resources/assets/sass/**/*.scss")
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
    return gulp.src("resources/assets/js/**/*.js")
        .pipe(js())
        .on('error', catchErr)
        .pipe(rename({suffix: '.min'}))
        .pipe(rename({dirname: ''}))
        .pipe(gulp.dest("public/frontend/js/"))
        .pipe(browserSync.stream());
});

function catchErr(error) {
    console.log(error);
    this.emit('end');
}

gulp.task('start', ['serve']);