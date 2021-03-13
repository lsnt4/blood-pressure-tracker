const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: {
        content: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        ],
        options: {
            safelist: [
                'bg-red-700',
                'bg-green-700',
                'bg-yellow-400',
                'bg-yellow-500',
                'bg-yellow-600',
            ],
        },
    },

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
