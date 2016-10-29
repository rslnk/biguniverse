// ## Globals
var gulp         = require('gulp');
var jadeToPHP    = require('gulp-jade-for-php');
var plumber      = require('gulp-plumber');

// ## Gulp tasks
// Run `gulp -T` for a task summary

// ### Templates
// `gulp templates` - Converts pug files to PHP templates
gulp.task('templates', function() {
  gulp.src([
    './assets/views/**/*.jade',
    '!./assets/views/**/includes/**/*.jade', // exclude jade templates in `includes/`
  ])
    .pipe(plumber())
    .pipe(jadeToPHP({
      "pretty": true
    }))
    .pipe(plumber.stop())
    .pipe(gulp.dest('./templates'));
});
