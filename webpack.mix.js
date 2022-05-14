const mix = require('laravel-mix');
const path = require('path');
const Components = require('unplugin-vue-components/webpack');
const {ElementPlusResolver} = require('unplugin-vue-components/resolvers');

require('laravel-mix-tailwind');

mix.alias({
    '@': path.join(__dirname, 'resources/js'),
    'styles': path.join(__dirname, 'resources/css')
});

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sourceMaps()
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
        require('autoprefixer')
    ])
    .tailwind()
    .webpackConfig({
        plugins: [
            require('unplugin-icons/webpack')({autoInstall: true}),
            Components({
                resolvers: [ElementPlusResolver()],
                dts:  true,
                dirs: [
                    'resources/js/src/partials',
                    'resources/js/src/page-components',
                    'resources/js/src/components'
                ]
            })
        ]
    });