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
mix.js('resources/js/app.js', 'public/js').vue();
mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
mix.sass('resources/assets/sass/custom.scss', 'public/assets/css/style.css').version();
mix.copy('node_modules/intl-tel-input/build/css/intlTelInput.css',
    'public/assets/css/inttel/css/intlTelInput.css');
mix.copyDirectory('node_modules/intl-tel-input/build/img',
    'public/assets/css/inttel/img');
mix.babel('node_modules/intl-tel-input/build/js/intlTelInput.js',
    'public/assets/js/inttel/js/intlTelInput.min.js');
mix.babel('node_modules/intl-tel-input/build/js/utils.js',
    'public/assets/js/inttel/js/utils.min.js');

mix.js('resources/assets/js/student/student.js',
    'public/assets/js/student/student.js')
    .js('resources/assets/js/events/event.js',
        'public/assets/js/events/event.js')
    .js('resources/assets/js/notes/note.js',
        'public/assets/js/notes/note.js')
    .js('resources/assets/js/textbooks/textbook.js',
        'public/assets/js/textbooks/textbook.js')
    .js('resources/assets/js/streams/stream.js',
        'public/assets/js/streams/stream.js')
    .js('resources/assets/js/category/category.js',
        'public/assets/js/category/category.js')
    .js('resources/assets/js/cafeteria/cafeteria.js',
        'public/assets/js/cafeteria/cafeteria.js')
    .js('resources/assets/js/news/news.js',
        'public/assets/js/news/news.js')
    .js('resources/assets/js/fellowship/fellowship.js',
        'public/assets/js/fellowship/fellowship.js')
    .js('resources/assets/js/custom/custom.js',
        'public/assets/js/custom/custom.js')
    .js('resources/assets/js/custom/phone-number-country-code.js',
        'public/assets/js/custom/phone-number-country-code.js').version();
