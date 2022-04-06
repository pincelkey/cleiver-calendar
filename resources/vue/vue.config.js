/* eslint-disable */
const StyleLintPlugin = require('stylelint-webpack-plugin');

module.exports = {
  configureWebpack: {
    plugins: [
      new StyleLintPlugin({
        files: ['**/*.{css,sss,scss,sass}'],
      })
    ],
  },
  chainWebpack: (config) => {
    config
      .plugin('html')
      .tap((args) => {
        args[0].title = 'Panda WP';
        return args;
      });
  },
  publicPath: (process.env.NODE_ENV === 'production')
    ?
      (process.env.VUE_APP_MODE === 'staging')
        ? `/wp-content/themes/${process.env.VUE_APP_THEME}/app/static/public/temp`
        : `/wp-content/themes/${process.env.VUE_APP_THEME}/app/static/public`
    : '/',
  outputDir: (process.env.VUE_APP_MODE === 'staging') ? '../../app/static/public/temp' : '../../app/static/public',
  devServer: {
    host: process.env.VUE_APP_HOST,
    port: 3000
  },
};
