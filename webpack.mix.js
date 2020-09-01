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

const SentryWebpackPlugin = require("@sentry/webpack-plugin");

module.exports = {
    // other configuration
    configureWebpack: {
        plugins: [
            new SentryWebpackPlugin({
                include: ".",
                ignoreFile: ".sentrycliignore",
                ignore: ["node_modules", "webpack.config.js"],
                configFile: "sentry.properties",
            }),
        ],
    }
};

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false
    });

// dev settings
if (!mix.inProduction()) {
    mix.sourceMaps();
}

// production settings
if (mix.inProduction()) {
    mix.version();
    mix.disableNotifications();
}
