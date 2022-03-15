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

mix.js('resources/js/admin/app.js', 'public/js')
    .js('resources/js/siswa/app.siswa.js', 'public/js')
    .vue()
    .css('resources/css/app.css', 'public/css')
    .css('resources/css/app.siswa.css', 'public/css');
    //.sass('resources/sass/app.scss', 'public/css');
