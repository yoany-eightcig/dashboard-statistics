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

mix.autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
        'popper.js/dist/umd/popper.js': ['Popper']
    })
	.js('resources/js/app.js', 'public/js')
	//.js('node_modules/fullcalendar/main.js', 'public/js/fullcalendar')
	//.styles('node_modules/fullcalendar/main.css', 'public/css/fullcalendar/main.css')
   	.sass('resources/sass/app.scss', 'public/css')
   	.version();	
