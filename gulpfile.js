var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.styles([
        "bootstrap.css",
        "bootstrap.theme.css",
        "ie10-viewport-bug-workaround.css",
        "roboto.css",
        "sic.css"
    ]);

    mix.scripts([
        "jquery.js",
        "jquery.loader.js",
        "jquery.loadTemplate.js",
        "jquery.timeago.js",
        "notify.js",
        "bootstrap.js",
        "ie10-viewport-bug-workaround.js",
        "sic.js",
        "html5shiv.js",
        "respond.js",
    ]);

    mix.copy('resources/assets/images', 'public/build/images');

    mix.copy('resources/assets/templates', 'public/build/templates');

    mix.version(["css/all.css", "js/all.js"]);
});
