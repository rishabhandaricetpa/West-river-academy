const mix = require('laravel-mix');
const CaseSensitivePathsPlugin = require('case-sensitive-paths-webpack-plugin');
const {CleanWebpackPlugin} = require('clean-webpack-plugin');

mix.options({
  terser: {
    extractComments: false,
    terserOptions: {
      compress: {
        drop_console: true,
      },
    },
  },
})

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .sourceMaps(false)
  .extract()
  .version()
  .disableNotifications()
  .webpackConfig({
    plugins: [
      new CaseSensitivePathsPlugin(),
      new CleanWebpackPlugin({
        cleanStaleWebpackAssets: false,
        cleanOnceBeforeBuildPatterns: [
          '!.gitignore',
          './css/',
          './fonts/',
          './mix-manifest.json',
        ],
        verbose: true,
      }),
    ],
  });
