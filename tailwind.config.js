const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                cairo: ['Cairo', 'sans-serif']
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwindcss-rtl'),
        require('@tailwindcss/line-clamp'),
    ],
};
