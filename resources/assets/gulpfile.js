var gulp = require('gulp');
var less = require('gulp-less');
var autoPrefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var cleanCss = require('gulp-clean-css');
var rename = require('gulp-rename');
var sourceMaps = require('gulp-sourcemaps');
var del = require('del');
var imageMin = require('gulp-imagemin');
var webpack = require('webpack');
// var uglify = require('gulp-uglify');
var webpackConfig = require('./webpack.config');
var webpackCompiler = webpack(webpackConfig);

var NODE_MODULES_DIR = './node_modules';
var RESOURCE_DEST_DIR = './dist';
var SRC_DIR = './src';
var PUBLIC_DEST_DIR = '../../public/assets';
var RELATIVE_MAPS_DIR = './maps';

/******* 打包样式 start *******/
// 基本任务
gulp.task('style:vendor:bootstrap', function () {
    return gulp.src(SRC_DIR + '/vendor/less/bootstrap/less/bootstrap.less')
        .pipe(sourceMaps.init())
            .pipe(less())
            .pipe(autoPrefixer())
            .pipe(cleanCss())
        .pipe(sourceMaps.write(RELATIVE_MAPS_DIR))
        .pipe(gulp.dest(RESOURCE_DEST_DIR + '/css'));
});

gulp.task('style:vendor:adminlte', function () {
    return gulp.src(SRC_DIR + '/vendor/less/admin-lte/build/less/AdminLTE.less')
        .pipe(sourceMaps.init())
            .pipe(less())
            .pipe(autoPrefixer())
            .pipe(cleanCss())
        .pipe(sourceMaps.write(RELATIVE_MAPS_DIR))
        .pipe(gulp.dest(RESOURCE_DEST_DIR + '/css'));
});

gulp.task('style:vendor:adminlte-skin', function () {
    return gulp.src(SRC_DIR + '/vendor/less/admin-lte/build/less/skins/skin-blue.less')
        .pipe(sourceMaps.init())
            .pipe(less())
            .pipe(autoPrefixer())
            .pipe(cleanCss())
        .pipe(sourceMaps.write(RELATIVE_MAPS_DIR))
        .pipe(gulp.dest(RESOURCE_DEST_DIR + '/css'));
});

gulp.task('style:vendor:others', function () {
    return gulp.src(SRC_DIR + '/vendor/css/*.css')
        .pipe(sourceMaps.init())
            .pipe(concat('font-icons.css'))
        .pipe(sourceMaps.write(RELATIVE_MAPS_DIR))
        .pipe(gulp.dest(RESOURCE_DEST_DIR + '/css'));
});

gulp.task('style:custom', function () {
    return gulp.src(SRC_DIR + '/sass/*.scss')
        .pipe(sourceMaps.init())
            .pipe(sass())
            .pipe(autoPrefixer())
            .pipe(cleanCss())
        .pipe(sourceMaps.write(RELATIVE_MAPS_DIR))
        .pipe(gulp.dest(RESOURCE_DEST_DIR + '/css'));
});

// 测试环境打包，生成 map
gulp.task('build:dev:style:vendor', ['style:vendor:bootstrap', 'style:vendor:adminlte', 'style:vendor:adminlte-skin', 'style:vendor:others'], function () {
    // 指定合并顺序
    return gulp.src([
        RESOURCE_DEST_DIR + '/css/bootstrap.css',
        RESOURCE_DEST_DIR + '/css/AdminLTE.css',
        RESOURCE_DEST_DIR + '/css/skin-blue.css',
        RESOURCE_DEST_DIR + '/css/font-icons.css',
    ])
        .pipe(sourceMaps.init({ loadMaps: true }))
            .pipe(concat('vendor.css'))
        .pipe(sourceMaps.write(RELATIVE_MAPS_DIR))
        .pipe(gulp.dest(PUBLIC_DEST_DIR + '/css'));
});

gulp.task('build:dev:style:custom', ['style:custom'], function () {
    return gulp.src(RESOURCE_DEST_DIR + '/css/main.css')
        .pipe(sourceMaps.init({ loadMaps: true }))
            .pipe(rename('main.min.css'))
        .pipe(sourceMaps.write(RELATIVE_MAPS_DIR))
        .pipe(gulp.dest(PUBLIC_DEST_DIR + '/css'));
});

gulp.task('build:dev:styles', ['build:dev:style:vendor', 'build:dev:style:custom']);

// 生产环境打包，去掉 map
gulp.task('build:prod:style:vendor', ['style:vendor:bootstrap', 'style:vendor:adminlte', 'style:vendor:adminlte-skin', 'style:vendor:others'], function () {
    // 指定合并顺序
    return gulp.src([
            RESOURCE_DEST_DIR + '/css/bootstrap.css',
            RESOURCE_DEST_DIR + '/css/AdminLTE.css',
            RESOURCE_DEST_DIR + '/css/skin-blue.css',
            RESOURCE_DEST_DIR + '/css/font-icons.css',
        ])
        .pipe(concat('vendor.css'))
        .pipe(gulp.dest(PUBLIC_DEST_DIR + '/css'));
});

gulp.task('build:prod:style:custom', ['style:custom'], function () {
    return gulp.src(RESOURCE_DEST_DIR + '/css/main.css')
        .pipe(rename('main.min.css'))
        .pipe(gulp.dest(PUBLIC_DEST_DIR + '/css'));
});

gulp.task('build:prod:styles', ['build:prod:style:vendor', 'build:prod:style:custom']);
/******* 打包样式 end *******/

/******* 打包脚本 start *******/
// 测试环境
gulp.task('build:dev:scripts', function () {
    webpackCompiler.run(function (err, stat) {
        if (err) {
            console.log(err);
            return;
        }

        gulp.src(RESOURCE_DEST_DIR + '/js/**/*.js')
            .pipe(sourceMaps.init({ loadMaps: true }))
            .pipe(sourceMaps.write(RELATIVE_MAPS_DIR))
            .pipe(gulp.dest(PUBLIC_DEST_DIR + '/js'));
    });
});

// 生产环境
gulp.task('build:prod:scripts', function () {
    var prodConfig = Object.assign(webpackConfig);
    prodConfig.plugins = prodConfig.plugins.concat(
        new webpack.DefinePlugin({
            'process.env': {
                // This has effect on the react lib size
                NODE_ENV: JSON.stringify('production')
            }
        }),

        new webpack.optimize.DedupePlugin(),
        // 使用 webpack 压缩 js
        new webpack.optimize.UglifyJsPlugin()
    );

    webpack(prodConfig, function (err, stats) {
        if (err) {
            console.log(err);
            return;
        }

        gulp.src(RESOURCE_DEST_DIR + '/js/**/*.js')
            .pipe(gulp.dest(PUBLIC_DEST_DIR + '/js'));
    });
});
/******* 打包脚本 end *******/

/******* 打包其它资源 start *******/
gulp.task('build:fonts', function () {
    return gulp.src(SRC_DIR + '/fonts/*')
        .pipe(gulp.dest(PUBLIC_DEST_DIR + '/fonts'));
});

gulp.task('build:img', function () {
    return gulp.src(SRC_DIR + '/img/*')
        .pipe(imageMin())
        .pipe(gulp.dest(PUBLIC_DEST_DIR + '/img'));
});
/******* 打包其它资源 end *******/

gulp.task('clean', function () {
    return del([RESOURCE_DEST_DIR, PUBLIC_DEST_DIR + '/*'], { force: true });
});

gulp.task('build-dev', ['build:dev:styles', 'build:dev:scripts'], function () {
    gulp.watch(SRC_DIR + '/sass/*.scss', ['build:style:custom']);
    gulp.watch(SRC_DIR + '/js/**/*.js', ['build:scripts']);
});

// 测试环境需手动打包一下字体和图片
gulp.task('default', ['build-dev']);
gulp.task('build', ['build:prod:styles', 'build:prod:scripts', 'build:fonts', 'build:img']);
