'use strict';
var gulp = require('gulp'),
    babel = require('gulp-babel'),
    autoprefixer = require('gulp-autoprefixer'),
    sass = require('gulp-sass'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename'),
    sourcemaps = require('gulp-sourcemaps'),
    notify = require("gulp-notify"),
    plumber = require('gulp-plumber')


var paths = {
  styles: {
    src: [
      "src/scss/*.scss"
    ],
    dest: "css"
  },
  scripts: {
    src: [
      "node_modules/jquery/dist/jquery.min.js",
      "node_modules/gsap/dist/gsap.min.js",
      "node_modules/swiper/swiper-bundle.min.js",
      "node_modules/gsap/dist/ScrollTrigger.min.js",
      //"node_modules/@fancyapps/fancybox/dist/jquery.fancybox.min.js",
      
      "node_modules/@fancyapps/ui/dist/fancybox.umd.js",
      "src/js/utils.js",
      "src/js/sliders.js",
      "src/js/app.js"
    ],
    dest: "js"
  }
};

var onError = function (err) {
    notify().write(err);
    this.emit('end');
};

function styles() {
  return gulp.src(paths.styles.src)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sourcemaps.init())
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(autoprefixer('last 4 versions'))
    .pipe(rename({
      basename: 'app'
    }))
    .pipe(sourcemaps.write(''))
    .pipe(gulp.dest(paths.styles.dest));
}

function scripts() {
  return gulp.src(paths.scripts.src, { sourcemaps: true })
    .pipe(plumber({ errorHandler: onError }))
    //.pipe(babel({presets: ['@babel/env']}))
    //.pipe(uglify())
    .pipe(concat('app.js'))
    .pipe(gulp.dest(paths.scripts.dest));
}

function watch() {
  gulp.watch(paths.scripts.src, scripts);
  gulp.watch(paths.styles.src, styles);
}


exports.styles = styles;
exports.scripts = scripts;
exports.watch = watch;

gulp.task('default', watch);