const mix = require('laravel-mix');
const path = require('path');

require('laravel-mix-tailwind');

mix.alias({
    '@': path.join(__dirname, 'resources/js'),
    'styles': path.join(__dirname, 'resources/css')
});

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
        require('autoprefixer')
    ])
    .tailwind()
    .webpackConfig({
        plugins: [
            require('unplugin-icons/webpack')({autoInstall: true})
        ]
    });
