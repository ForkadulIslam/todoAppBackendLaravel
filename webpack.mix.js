const mix = require('laravel-mix');

mix.js('vue-app/dist/js/app.js', 'public/js')
    .sass('vue-app/dist/css/app.css', 'public/css');
