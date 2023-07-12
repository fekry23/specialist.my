const defaultTheme = require('tailwindcss/defaultTheme');
const forms = require('@tailwindcss/forms');

module.exports = {
    prefix: 'tw-',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        "./node_modules/flowbite/**/*.js",
        './resources/**/*.{blade.php,js,vue}',
        './src/**/*.{html,js}',
    ],


    theme: {
        extend: {
            colors: {
                specialist: '#8dc7ff',
                on_going: '#87CEFA', //Soft blue
                review: '#E6E6FA', //Pale purple
                pending: '#FFC0CB', //Light pink
                completed: '#98FB98' //Pale green
                // Add more custom colors if needed
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    // corePlugins: {
    //     preflight: false,
    // },
    plugins: [
        forms,
        require('flowbite/plugin')
    ],
    darkMode: "class"
};
