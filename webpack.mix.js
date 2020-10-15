const mix = require('laravel-mix');

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

mix.js('resources/js/front/app.js', 'public/js/front/')
    .sass('resources/sass/front/app.scss', 'public/css/front/')
    
    .js('resources/js/dashboard/app.js', 'public/js/dashboard/')
    .sass('resources/sass/dashboard/app.scss', 'public/css/dashboard/');
    