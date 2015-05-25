var gulp = require('gulp');
var concat = require('gulp-concat');
var sass = require('gulp-ruby-sass');



gulp.task('javascript', function () {
    return gulp.src('app/assets/js/*.js')
      .pipe(concat('application.js'))
      .pipe(gulp.dest('public/js'));
});


gulp.task('sass', function () {
    return sass('app/assets/sass')
      .on('error', function (err) {
          console.error('Error!', err.message);
      })
      .pipe(concat('application.css'))
      .pipe(gulp.dest('public/content/css'));
});

gulp.task('default', ['javascript', 'sass']);

gulp.task('build', function() {

  gulp.run('javascript');
  gulp.run('sass');

});