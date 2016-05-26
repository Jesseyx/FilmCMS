var gulp = require('gulp');
var less = require('gulp-less');
var autoPrefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
// var minifyCss = require('gulp-minify-css');
var cleanCss = require('gulp-clean-css');
var rename = require('gulp-rename');
var sourceMaps = require('gulp-sourcemaps');
// var clean = require('gulp-clean');
var del = require('del');
var imageMin = require('gulp-imagemin');

var NODE_MODULES_DIR = './node_modules';
var TEMP_DIR = './temp';
var SRC_DIR = './src';
var DEST_DIR = '../../public/assets';
var STYLE_MAPS_DIR = './maps';

gulp.task('style:vendor:bootstrap', function () {
    return gulp.src(NODE_MODULES_DIR + '/bootstrap/less/bootstrap.less')
        .pipe(sourceMaps.init())
        .pipe(less())
        .pipe(autoPrefixer())
        .pipe(cleanCss())
        .pipe(sourceMaps.write(STYLE_MAPS_DIR))
        .pipe(gulp.dest(TEMP_DIR + '/css'));
});

gulp.task('style:vendor:adminlte', function () {
    return gulp.src(NODE_MODULES_DIR + '/admin-lte/build/less/AdminLTE.less')
        .pipe(sourceMaps.init())
        .pipe(less())
        .pipe(autoPrefixer())
        .pipe(cleanCss())
        .pipe(sourceMaps.write(STYLE_MAPS_DIR))
        .pipe(gulp.dest(TEMP_DIR + '/css'));
});

gulp.task('style:vendor:adminlte-skin', function () {
    return gulp.src(NODE_MODULES_DIR + '/admin-lte/build/less/skins/skin-blue.less')
        .pipe(sourceMaps.init())
        .pipe(less())
        .pipe(autoPrefixer())
        .pipe(cleanCss())
        .pipe(sourceMaps.write(STYLE_MAPS_DIR))
        .pipe(gulp.dest(TEMP_DIR + '/css'));
});

gulp.task('style:vendor:icons', function () {
    return gulp.src([SRC_DIR + '/css/font-awesome.min.css', SRC_DIR + '/css/ionicons.min.css'])
        .pipe(gulp.dest(TEMP_DIR + '/css'));
});

gulp.task('build:style:vendor', ['style:vendor:bootstrap', 'style:vendor:adminlte', 'style:vendor:adminlte-skin', 'style:vendor:icons'], function () {
    return gulp.src(TEMP_DIR + '/css/*')
        .pipe(sourceMaps.init({ loadMaps: true }))
        .pipe(concat('vendor.css'))
        .pipe(sourceMaps.write(STYLE_MAPS_DIR))
        .pipe(gulp.dest(DEST_DIR + '/css'));
});

gulp.task('build:style:custom', function () {
    return gulp.src(SRC_DIR + '/css/main.scss')
        .pipe(sourceMaps.init())
        .pipe(sass())
        .pipe(autoPrefixer())
        .pipe(rename({ extname: '.min.css' }))
        .pipe(cleanCss())
        .pipe(sourceMaps.write(STYLE_MAPS_DIR))
        .pipe(gulp.dest(DEST_DIR + '/css'));
});

gulp.task('build:fonts', function () {
    return gulp.src('./src/fonts/*')
        .pipe(gulp.dest(DEST_DIR + '/fonts'));
});

gulp.task('build:img', function () {
    return gulp.src('./src/img/*')
        .pipe(imageMin())
        .pipe(gulp.dest(DEST_DIR + '/img'));
});

gulp.task('clean', function () {
    return del(DEST_DIR + '/*', { force: true });
});

gulp.task('init', ['build:style:vendor', 'build:style:custom', 'build:fonts', 'build:img'], function () {
    return del(TEMP_DIR);
});

gulp.task('default', ['build:style:vendor', 'build:style:custom'], function () {
    return del(TEMP_DIR);
});

// gulp.watch(SRC_DIR + '/css/main.scss', ['build:style:custom']);
