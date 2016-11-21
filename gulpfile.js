const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.copy(
        'node_modules/jquery-ui-dist/jquery-ui.min.css',
        'public/css'
    ).copy([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
        'node_modules/jquery-ui-dist/jquery-ui.min.js',
        'node_modules/bootstrap-select/dist/js/bootstrap-select.min.js',
    ],
        'resources/assets/js'
    );

    mix.sass([
        'app.scss'
    ]).scripts([
        'jquery.min.js',
        'bootstrap.min.js',
        'jquery-ui.min.js',
        'bootstrap-select.min.js',
        'app.js',
    ], 'public/js/app.js');
});
