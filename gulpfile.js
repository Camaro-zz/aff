var gulp = require('gulp');
var sass = require("gulp-sass");
var minifyCss = require('gulp-minify-css');
var requirejsOptimize = require("gulp-requirejs-optimize");
var uglify = require('gulp-uglify');
var minifyHTML = require('gulp-minify-html');
var elixir = require('laravel-elixir');

elixir.extend('scss', function() {
    gulp.task('scss', function() {
        gulp.src('public/assets/sass/app.scss')
            .pipe(sass())
            .pipe(minifyCss())
            .pipe(gulp.dest('./public/css'));
    });
    return this.queueTask('scss');
});


elixir.extend('js', function() {
    gulp.task('js', function() {
        gulp.src('public/assets/js/libs/require.js')
            .pipe(uglify())
            .pipe(gulp.dest("public/js"));

        gulp.src('public/assets/js/core/global.js')
            .pipe(requirejsOptimize({
                name: 'core/global',
                mainConfigFile: "public/assets/js/config.js",
                baseUrl: 'public/assets/js',
                exclude: ['exclude']
            }))
            .pipe(gulp.dest("public/js"));

        gulp.src('public/assets/js/core/libs.js')
            .pipe(requirejsOptimize({
                name: 'core/libs',
                mainConfigFile: "public/assets/js/config.js",
                baseUrl: 'public/assets/js',
                exclude: ['core/global', 'exclude']
            }))
            .pipe(gulp.dest("public/js"));

        gulp.src('public/assets/js/bootstrap.js')
            .pipe(requirejsOptimize({
                name: 'bootstrap',
                optimize: 'none',
                mainConfigFile: "public/assets/js/config.js",
                baseUrl: 'public/assets/js',
                exclude: ['core/global', 'core/libs', 'exclude']
            }))
            .pipe(gulp.dest("public/js"));
    });
    return this.queueTask('js');
});

elixir(function(mix) {
    mix.sass('app.scss');
});
