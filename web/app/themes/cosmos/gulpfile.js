// ## Globals
var gulp         = require('gulp');
var async        = require('async');
var consolidate  = require('gulp-consolidate');
var jadeToPHP    = require('gulp-jade-php');
var iconfont     = require('gulp-iconfont');
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

// ### Iconfont
// `gulp iconfont` - Converts svg icons into font, generates .styl css objects
// and components classes. For svg icons optimization options
// see: https://www.npmjs.com/package/gulp-iconfont
gulp.task('iconfont', function(done){

  var fontName        = 'CosmosIcons';
  var fontPath        = '../fonts/';
  var objectsClass    = 'o-icon';
  var componentsClass = 'c-icon';

  var iconStream = gulp.src(['./assets/images/icons/*.svg'])
    .pipe(iconfont({
      fontName: fontName,
      formats: ['ttf', 'eot', 'woff', 'svg'],
      timestamp: Math.round(Date.now() / 1000),
      normalize: true,  /* fix possible icon height difference */
      fontHeight: 1001  /* fix possible icon convertion issues */
     }));
    async.parallel([
      // Generate icons CSS objects classes
      function GenerateIconCssObjects(cb) {
        iconStream.on('glyphs', function(glyphs, options) {
          gulp.src('./assets/styles/templates/_icon.styl') /* objects template */
            .pipe(consolidate('lodash', {
              glyphs: glyphs,
              fontName: fontName,
              fontPath: fontPath,
              objectsClass: objectsClass
            }))
            .pipe(gulp.dest('./assets/styles/objects/'))
            .on('finish', cb);
        });
      },
      // Generate icons CSS components classes
      function GenerateIconCssComponents(cb) {
        iconStream.on('glyphs', function(glyphs, options) {
          gulp.src('./assets/styles/templates/_icons.styl') /* components template */
            .pipe(consolidate('lodash', {
              glyphs: glyphs,
              objectsClass: objectsClass,
              componentsClass: componentsClass
            }))
            .pipe(gulp.dest('./assets/styles/components/common-ui'))
            .on('finish', cb);
        });
      },
      // Output web fonts
      function outputFonts(cb) {
        iconStream
          .pipe(gulp.dest('./assets/fonts/'))
          .on('finish', cb);
      }
    ], done);
});
