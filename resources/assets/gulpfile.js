var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function () {
   gulp.src('./build/css/*.scss')
       .pipe(sass())
       .pipe(gulp.dest('dist/css'));
});

gulp.task('sass:watch', function () {
   gulp.watch('./build/css/*.scss');
});

gulp.task('default', ['sass']);