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
    ).copy(
        'resources/assets/css/icheck',
        'public/css/icheck'
    ).copy([
            'vendor/kartik-v/bootstrap-star-rating/css/star-rating.css',
            'vendor/kartik-v/bootstrap-star-rating/themes/krajee-fa/theme.css'
        ], 'resources/assets/css/bootstrap-star-rating'
    ).copy(
        'vendor/kartik-v/bootstrap-star-rating/img',
        'public/css/img'
    ).copy([
            'vendor/kartik-v/bootstrap-star-rating/js/star-rating.min.js',
            'vendor/kartik-v/bootstrap-star-rating/themes/krajee-fa/theme.min.js'
        ], 'resources/assets/js/bootstrap-star-rating'
    ).copy(
        'node_modules/bootstrap-sass/assets/fonts',
        'public/fonts'
    ).copy([
            'node_modules/jquery/dist/jquery.min.js',
            'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
            'node_modules/jquery-ui-dist/jquery-ui.min.js',
            'node_modules/bootstrap-select/dist/js/bootstrap-select.min.js'
        ], 'resources/assets/js'
    ).copy([
            'node_modules/bootstrap-select/dist/js/i18n/defaults-lt_LT.js'
        ], 'resources/assets/js/bootstrap-select/i18n'
    ).copy([
            'node_modules/froala-editor/js/froala_editor.min.js',
            'node_modules/froala-editor/js/froala_editor.pkgd.min.js',
        ], 'public/js/froala-editor'
    ).copy([
            'node_modules/froala-editor/js/plugins/code_view.min.js',
            'node_modules/froala-editor/js/plugins/code_beautifier.min.js',
            'node_modules/froala-editor/js/plugins/link.min.js',
            'node_modules/froala-editor/js/plugins/lists.min.js',
            'node_modules/froala-editor/js/plugins/table.min.js',
            'node_modules/froala-editor/js/plugins/colors.min.js',
        ], 'public/js/froala-editor/plugins'
    ).copy([
            'node_modules/froala-editor/css/froala_editor.min.css',
            'node_modules/froala-editor/css/froala_editor.pkgd.min.css',
            'node_modules/froala-editor/css/froala_style.min.css',
        ], 'public/css/froala-editor'
    ).copy([
            'node_modules/froala-editor/css/plugins/code_view.min.css',
            'node_modules/froala-editor/css/plugins/table.min.css',
            'node_modules/froala-editor/css/plugins/colors.min.css',
        ], 'public/css/froala-editor/plugins'
    );

    mix.sass([
        'app.scss'
    ]).styles([
            'bootstrap-star-rating/*.css'
        ], 'public/css/star-rating/star-rating.css'
    ).scripts([
            'bootstrap-star-rating/*.js'
        ], 'public/js/star-rating.js'
    ).scripts([
        'jquery.min.js',
        'bootstrap.min.js',
        'jquery-ui.min.js',
        'bootstrap-select.min.js',
        'bootstrap-select/i18n/defaults-lt_LT.js',
        'icheck.js',
        'app.js'
    ], 'public/js/app.js');
});
