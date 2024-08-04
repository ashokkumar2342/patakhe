const { mix } = require('laravel-mix');

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

mix.js('resources/assets/front/js/app.js', 'public/js')
   .sass('resources/assets/front/sass/app.scss', 'public/css');
mix.js('resources/assets/seller/js/app.js', 'public/js/seller.js')
.sass('resources/assets/seller/sass/app.scss', 'public/css/seller.css');
mix.js('resources/assets/admin/js/app.js', 'public/js/admin.js')
.sass('resources/assets/admin/sass/app.scss', 'public/css/admin.css');
