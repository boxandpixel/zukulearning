const { src, dest, series, parallel, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const rtlcss = require('gulp-rtlcss');
const eslint = require('gulp-eslint');
const terser = require('gulp-terser');
const sourcemaps = require('gulp-sourcemaps');
const plumber = require('gulp-plumber');
const header = require('gulp-header');
const concat = require('gulp-concat');


// Paths
const paths = {
  styles: {
    src: 'src/styles/**/*.scss',
    dest: './'
  },
  scripts: {
    src: 'src/scripts/**/*.js',
    dest: './'
  }
};

// Theme header content
const themeHeader = `/*
Theme Name: zuku
Theme URI: https://underscores.me/
Author: Automattic
Author URI: https://automattic.com/
Description: Hi. I'm a starter theme called <code>_s</code>, or <em>underscores</em>, if you like. I'm a theme meant for hacking so don't use me as a <em>Parent Theme</em>. Instead try turning me into the next, most awesome, WordPress theme out there. That's what I'm here for.
Version: 1.0.0
Tested up to: 5.4
Requires PHP: 5.6
License: GNU General Public License v2 or later
License URI: LICENSE
Text Domain: zuku
Tags: custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready
*/\n\n`;

// Compile, autoprefix, minify SCSS
function styles() {
  return src(paths.styles.src)
    .pipe(plumber())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([autoprefixer()]))
    .pipe(cleanCSS())
    .pipe(header(themeHeader)) // Add theme header
    .pipe(rename('style.css'))
    .pipe(dest(paths.styles.dest))
    .pipe(rtlcss()) // create RTL version
    .pipe(rename('style-rtl.css'))
    .pipe(dest(paths.styles.dest));
}

// Lint, concat, minify, and sourcemap JS
function scripts() {
  return src(paths.scripts.src)
    .pipe(plumber())
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(sourcemaps.init())
    .pipe(concat('scripts.min.js')) // 👈 combine all scripts into one file
    .pipe(terser())
    .pipe(sourcemaps.write('.'))
    .pipe(dest(paths.scripts.dest));
}


// Watch styles and scripts
function watchFiles() {
  watch(paths.styles.src, styles);
  watch(paths.scripts.src, scripts);
}

// Public tasks
exports.styles = styles;
exports.scripts = scripts;
exports.watch = watchFiles;
exports.default = series(parallel(styles, scripts), watchFiles);
