const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.js('resources/js/app.js', 'public/js')
   //  .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css/bootstrap')
    // copy files
    mix.copy('resources/assets', 'public')

    // watch specific assets
    // mix.postCss('resources/assets/css/admin/navbar.css', 'public/css/admin')
    // mix.postCss('resources/assets/css/navbar.css', 'public/css')
    
