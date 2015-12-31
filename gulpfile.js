var gulp = require('gulp');
var zip = require('gulp-zip');

gulp.task('zip', function () {
    return gulp.src(['code_snippet/**/*'], {base: "."})
        .pipe(zip('code_snippet.zip'))
        .pipe(gulp.dest('./build'));
});

gulp.task('default', ['zip']);