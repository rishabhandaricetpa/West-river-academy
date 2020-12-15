const mix = require('laravel-mix');
const CaseSensitivePathsPlugin = require('case-sensitive-paths-webpack-plugin');
const {CleanWebpackPlugin} = require('clean-webpack-plugin');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
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
    // .sourceMaps();
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