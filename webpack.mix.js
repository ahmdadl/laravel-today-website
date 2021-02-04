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

const postcssPlugins = [
    require('postcss-import'),
    require('precss'),
    require('autoprefixer'),
];

mix.ts('resources/js/app.ts', 'public/js')
    .postCss(
        'resources/css/app.css',
        'public/css',
        postcssPlugins.concat([require('tailwindcss')('./tailwind.config.js')])
    )
    .postCss(
        'resources/css/admin.css',
        'public/css',
        postcssPlugins.concat([require('tailwindcss')('./adminTW.config.js')])
    )
    .webpackConfig(require('./webpack.config'))
    .version();
// .browserSync({
//     proxy: 'js.test',
//     ui: false,
//     files: [
//         'public/css/*.css',
//         'public/js/*.js',
//         'resources/views/**/*.blade.php',
//     ]
// });
