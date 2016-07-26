var gulp = require('gulp');
var sass = require("gulp-sass");
var minifyCss = require('gulp-minify-css');
var requirejsOptimize = require("gulp-requirejs-optimize");
var uglify = require('gulp-uglify');
var minifyHTML = require('gulp-minify-html');
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
});
