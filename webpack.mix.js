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

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

mix.js('resources/js/find-candidate.js', 'public/js')
    .js('resources/js/find-job.js', 'public/js')
    .js('resources/js/footer.js', 'public/js')
    .js('resources/js/index.js', 'public/js')
    .js('resources/js/navbar.js', 'public/js')
    .js('resources/js/pswmeter.min.js', 'public/js')
    .js('resources/js/signup.js', 'public/js')
    .css('resources/css/find-candidate.css', 'css')
    .css('resources/css/find-candidate-overview.css', 'css')
    .css('resources/css/find-job.css', 'css')
    .css('resources/css/find-job-overview.css', 'css')
    // .css('resources/css/font-awesome.min.css', 'css')
    .css('resources/css/footer.css', 'css')
    .css('resources/css/index.css', 'css')
    .css('resources/css/login.css', 'css')
    .css('resources/css/signup.css', 'css')
    .css('resources/css/tagify.css', 'css');



// mix.js('resources/js/app.js', 'js').sass('resources/sass/app.scss', 'css');
