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

/*mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');*/

mix.styles([
    'public/frontend/css/jquery-ui.css',
    'public/frontend/css/owl.carousel.min.css',
    'public/frontend/css/owl.theme.default.min.css',
    'public/frontend/css/all.css',
    'public/frontend/css/animate.css',
    'public/frontend/css/normalize.css',
    'public/frontend/css/flaticons.css',
    'public/frontend/css/lightcase.css',
    'public/frontend/css/star-rating',
    'public/frontend/css/ionskin.css',
    'public/frontend/css/range.css',
], 'public/frontend/compiled-css/allstyle.css');
