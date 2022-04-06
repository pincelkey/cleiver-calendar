import { src, dest, watch, series, parallel } from 'gulp'

import sass from 'gulp-sass'
import sassGlob from 'gulp-sass-glob'
import cleanCss from 'gulp-clean-css'
import gulpif from 'gulp-if'
import postcss from 'gulp-postcss'
import sourcemaps from 'gulp-sourcemaps'
import gulpStylelint from 'gulp-stylelint'
import cssImport from 'gulp-cssimport'
import imagemin from 'gulp-imagemin'

import yargs from 'yargs'
import named from 'vinyl-named'
import autoprefixer from 'autoprefixer'
import del from 'del'
import webpack from 'webpack-stream'
import browserSync from "browser-sync";

import webpackConfig from './src/build/webpack.config'
import config from './src/config'

const env = yargs.argv.env
const mode = yargs.argv.mode

const publicPath = (folder = '') => {
  return (env == 'development' || mode == 'staging') ? `${config.publicPath}/temp/${folder}` : `${config.publicPath}/${folder}`;
}

/*
 * Server Live
 * */
const server = browserSync.create();
export const serve = done => {
  server.init({
    proxy: config.proxy,
    port: 4000
  });
  done();
};
export const reload = done => {
  server.reload();
  done();
};

/*
 * Styles
 * */
sass.compiler = require('node-sass')

export const styles = () => {
  const entryStyles = config.entry.styles;
  const options = {
    includePaths: ['node_modules']
  }

  return src(entryStyles)
    .pipe(gulpif(env === 'development', sourcemaps.init()))
    .pipe(sassGlob())
    .pipe(sass({includePaths: ['node_modules'], importCss: true}).on('error', sass.logError))
    .pipe(gulpif(env === 'production' || mode == 'staging', postcss([autoprefixer])))
    .pipe(gulpif(env === 'production' || mode == 'staging', cleanCss({inline: ['none'], compatibility:'ie8', })) )
    .pipe(gulpif(env === 'development', sourcemaps.write()))
    .pipe(cssImport(options))
    .pipe(dest(publicPath('css')))
    .pipe(server.stream());
}

export const lintCss = () => {
  return src(config.globalResources.styles)
    .pipe(gulpStylelint({
      failAfterError: true,
      reporters: [
        {formatter: 'verbose', console: true}
      ]
    }))
}

/*
 * Javascript
 * */
export const scripts = () => {
  return src(config.entry.js)
    .pipe(named())
    .pipe(webpack({
      config: webpackConfig
    }))
    .pipe(dest(publicPath('js')))
}

/*
 * Images
 * */
export const images = () => {
  return src(config.entry.images)
    .pipe(imagemin())
    .pipe(dest(publicPath('images')))
}

/*
 * Fonts
 * */
export const fonts = () => {
  return src(config.entry.fonts)
    .pipe(dest(publicPath('fonts')))
}

/*
 * Clean
 * */
export const clean = () => del( [publicPath('css'), publicPath('js'), publicPath('images'), publicPath('fonts')], {force: true} )

/*
 * Watch
 * */
export const watchForChanges = () => {
  watch(config.ignoreFoldersDevelopment, series(reload))
  watch([config.globalResources.styles], parallel(styles, lintCss))
  watch([config.globalResources.js], series(scripts, reload))
  watch([config.globalResources.vue], series(scripts, reload))
  watch([config.globalResources.images], series(images, reload));
  watch([config.globalResources.fonts], series(fonts, reload));
  watch([config.globalResources.php], reload);
  watch([config.globalResources.twig], reload);
}

/*
 * Compilation
 * */
export const dev = series(clean, parallel(styles, scripts, images, fonts), lintCss, serve, watchForChanges)
export const build = series(clean, parallel(styles, scripts, images, fonts))

export default dev
