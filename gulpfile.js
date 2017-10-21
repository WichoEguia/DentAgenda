const gulp = require("gulp"),
      sass = require("gulp-sass"),
      autoprefixer = require("gulp-autoprefixer");

gulp.task('main_task', () =>
  gulp.src("./assets/scss/*.scss")
      .pipe(sass({
        outputStyle: "expanded"
      }))
      .pipe(autoprefixer({
        versions: ["last 3 browsers"]
      }))
      .pipe(gulp.dest("./assets/css"))
);

gulp.task("default", () =>
  gulp.watch("./assets/scss/*.scss", ["main_task"])
);
