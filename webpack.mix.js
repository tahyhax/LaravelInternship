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
    .version()
    
    .js('resources/js/cabinet/app.js', 'public/js/cabinet/')
    .sass('resources/sass/cabinet/app.scss', 'public/css/cabinet/')
    .version();
    