import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                // Note: I'm changing this back to Inter as per our design.
                // If you prefer Figtree, that's fine too.
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            // THE HEIGHT OBJECT GOES INSIDE THIS EXTEND BLOCK
            height: {
                '10.5': '2.625rem', // Creates h-10.5 (42px)
            },
        },
    },

    plugins: [forms],
};