const mix = require("laravel-mix");

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
mix.disableNotifications();
mix.browserSync({
    proxy: process.env.MIX_SENTRY_DSN_PUBLIC,
});

mix.js("resources/js/app.js", "public/js")
    .css("resources/css/app.css", "public/css")
    .sass("resources/sass/app.scss", "public/css")
    .sourceMaps();

mix.css("resources/css/main.css", "public/css").sourceMaps();
