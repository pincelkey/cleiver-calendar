import config from '../config';

const webpack = require('webpack')
const yargs = require('yargs')

const env = yargs.argv.env
const mode = yargs.argv.env

const configDev = require('./webpack.dev')
const configProd = require('./webpack.prod')
const VueLoaderPlugin = require('vue-loader/lib/plugin')

const baseConfig = {
  mode: env,
  output: {
    filename: '[name].bundle.js',
    chunkFilename: '[name].bundle.js',
    publicPath: (env == 'development' || mode == 'staging')
      ? `/wp-content/themes/${ config.theme }/${ config.publicPath }/temp/js/`
      : `/wp-content/themes/${ config.theme }/${ config.publicPath }/js/`,
  },

  optimization: {
    splitChunks: {
      cacheGroups: {
        commons: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendors',
          chunks: 'all'
        }
      }
    }
  },

  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: ['babel-loader']
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      },
    ]
  },

  target: 'web',

  resolve: {
    extensions: ['.js', '.vue'],
    alias: {
      'vue$': 'vue/dist/vue.esm.js'
    }
  },

  plugins: [
    new webpack.ProvidePlugin({
      $: "jquery",
      jQuery: "jquery",
      "window.jQuery": "jquery"
    }),
    new VueLoaderPlugin()
  ],
};

if( env === 'development' ) {
  module.exports = {
    ...baseConfig,
    ...configDev
  }
}

if ( env === 'production' ) {
  module.exports = {
    ...baseConfig,
    ...configProd,
    plugins: [...baseConfig.plugins, ...configProd.plugins]
  }
}
