const elixir = require('laravel-elixir');
const vue = require('vue');
const browserify = require('laravel-elixir-browserify-official');

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
    mix.scripts([
        './bower_components/jquery/dist/jquery.js',
        './bower_components/tether/dist/js/tether.js',
        './bower_components/tether-drop/dist/js/drop.js',
        './bower_components/tether-tooltip/dist/js/tooltip.js',
        './bower_components/bootstrap/dist/js/bootstrap.js',
        './bower_components/summernote/dist/summernote.js',
        './bower_components/dropzone/dist/dropzone.js',
        './bower_components/vue/dist/vue.js',
        './bower_components/vue-resource/dist/vue-resource.js',
        './node_modules/vuetify/dist/vuetify.js',
        './node_modules/vee-validate/dist/vee-validate.js',
        './node_modules/v-tooltip/dist/v-tooltip.browser.js',
        './node_modules/pusher-js/dist/web/pusher.js',
        './bower_components/moment/moment.js'
    ], './public/js/vendor.js');
});

elixir(function(mix) {
    mix.sass([
        './bower_components/tether/src/css/tether.sass',
        './bower_components/tether/src/css/tether-theme-basic.sass',
        './bower_components/tether/src/css/tether-theme-arrows.sass',
        './bower_components/tether/src/css/tether-theme-arrows-dark.sass',
        './bower_components/bootstrap/scss/bootstrap-flex.scss',
        // './bower_components/bootstrap/scss/bootstrap-grid.scss',
        './bower_components/components-font-awesome/scss/font-awesome.scss',
    ], './public/css/vendor.css');
});


elixir(function(mix) {
    mix.sass([
        './resources/assets/sass/dashboard.scss',
    ], './public/css/dashboard.css');
});

elixir(function(mix) {
    mix.sass([
        './resources/assets/sass/frontend.scss',
    ], './public/css/frontend.css');
});

elixir(function(mix) {
    mix
    .copy('./bower_components/components-font-awesome/fonts/fontawesome-webfont.woff', './public/fonts/fontawesome-webfont.woff')
    .copy('./bower_components/components-font-awesome/fonts/fontawesome-webfont.woff2', './public/fonts/fontawesome-webfont.woff2')
    .copy('./bower_components/components-font-awesome/fonts/fontawesome-webfont.ttf', './public/fonts/fontawesome-webfont.ttf')
    .copy('./bower_components/components-font-awesome/fonts/fontawesome-webfont.svg', './public/fonts/fontawesome-webfont.svg')
    .copy('./node_modules/vuetify/dist/vuetify.min.css', './public/css/v.min.css')
});

elixir(function(mix) {
    mix.scripts([
        './resources/assets/scripts/dashboard.js'
    ], './public/js/dashboard.js');
});

elixir(function(mix) {
    mix.scripts([
        './resources/assets/scripts/front/**/*.js',
        './resources/assets/scripts/frontend.js',
    ], './public/js/frontend.js');
});

// elixir(function(mix) {
//     mix.version(['./public/js/vendor.js', './public/css/vendor.css', './public/css/dashboard.css']);
// });
