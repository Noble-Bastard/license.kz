let mix = require('laravel-mix');

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

// mix.js('resources/js/messages.js', 'public/js')
//     .js('resources/js/app.js', 'public/js')
//     .extract(['jquery', 'bootstrap', 'lodash', 'popper.js'])
//     .js('resources/js/customScript.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .sass('resources/sass/button.scss', 'public/css')
//     .sass('resources/sass/media.scss', 'public/css')
//     .copy('node_modules/bootstrap/dist/css', 'public/libs/bootstrap/dist/css')
//     .version();

mix
  .js('resources/js/messages.js', 'public/js')
    .js('resources/js/app.js', 'public/js')
    .extract(['jquery', 'bootstrap', 'lodash', 'popper.js'])
  //   .sass('resources/sass/app_new.scss', 'public/css')
  //   .sass('resources/sass/app.scss', 'public/css')
  // .copy('resources/raw/app.js', 'public/js')
  // .copy('resources/raw/manifest.js', 'public/js')
  // .copy('resources/raw/messages.js', 'public/js')
  .copy('resources/raw/app.css', 'public/css/app_new.css')
  .copy('resources/raw/app.css', 'public/new/css/app.css')
  .copy('resources/raw/app_new.css', 'public/css')
    .sass('resources/sass/new/app_1.scss', 'public/new/css')
    .version();
