const ReplaceInFileWebpackPlugin = require('replace-in-file-webpack-plugin');

const configProd = {
  plugins: [
    new ReplaceInFileWebpackPlugin([
      {
        dir: '../../app/config',
        files: ['base.php'],
        rules: [
          {
            search: new RegExp("'vertion' => '[0-9a-zA-Z]+'"),
            replace: function(match){
              return `'vertion' => '${Date.now()}'`
            }
          }
        ]
      }
    ]),
  ]
};

module.exports = configProd;
