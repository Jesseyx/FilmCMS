var gulp = require('gulp');
var less = require('gulp-less');
var autoPrefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var minifyCss = require('gulp-minify-css');
var rename = require('gulp-rename');
var sourceMaps = require('gulp-sourcemaps');
var clean = require('gulp-clean');

gulp.task('less:adminlte', function () {
   return gulp.src('./node_modules/admin-lte/build/less/AdminLTE.less')
       .pipe(less())
       .pipe(autoPrefixer())
       .pipe(gulp.dest('temp/css'));
});

gulp.task('less:adminlte-skin', function () {
   return gulp.src('./node_modules/admin-lte/build/less/skins/skin-blue.less')
       .pipe(less())
       .pipe(autoPrefixer())
       .pipe(gulp.dest('temp/css'));
});

gulp.task('sass:main', function () {
   return gulp.src('./src/css/main.scss')
       .pipe(sass())
       .pipe(autoPrefixer())
       .pipe(gulp.dest('temp/css'));
});

gulp.task('vendorCss:copy', function () {
   return gulp.src(['./src/css/font-awesome.min.css', './src/css/ionicons.min.css'])
       .pipe(gulp.dest('temp/css'));
})

gulp.task('css:concat', ['less:adminlte', 'less:adminlte-skin', 'sass:main', 'vendorCss:copy'], function () {
   return gulp.src('./temp/css/*.css')
       .pipe(concat('main.css'))
       .pipe(gulp.dest('./dist/css'));
});

gulp.task('css:minify', ['clean:before', 'css:concat'], function () {
   return gulp.src('./dist/css/*.css')
       .pipe(sourceMaps.init())
       .pipe(minifyCss())
       .pipe(rename({ extname:'.min.css' }))
       .pipe(sourceMaps.write('source_maps'))
       .pipe(gulp.dest('./dist/css'));
});

gulp.task('build:css',  ['css:minify']);

gulp.task('clean:before', function () {
   return gulp.src('./dist')
       .pipe(clean());
});

gulp.task('clean:after', ['build:css'], function () {
   return gulp.src('./temp')
       .pipe(clean());
});

gulp.task('default', ['build:css', 'clean:after']);