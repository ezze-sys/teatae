import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gray: require('tailwindcss/colors').stone,
                'brand-red': '#C5A059', // Gold (Legacy)
                'brand-gold': '#C5A059', // Gold
                'brand-dark': '#1F1712', // Dark Coffee
                'brand-gray': '#4A3B32', // Medium Brown
                'brand-cream': '#F9F6EE', // Bone White (Updated)
                'brand-bone': '#F9F6EE', // Bone White
                'brand-tan': '#E6D2B5', // Tan
            },
        },
    },

    plugins: [forms],
};
