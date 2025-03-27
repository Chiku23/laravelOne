import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './public/js/customScripts/*.js',
    ],

    darkMode: 'class', // Enables dark mode using the 'dark' class

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            maxWidth: {
                '1200': '1200px',
            },
            colors: {
                primary: {
                    DEFAULT: '#ffffff', // White text for contrast
                    light: '#f3f4f6', // Light gray for hover effects
                    dark: '#d1d5db', // Slightly darker gray
                },
                secondary: {
                    DEFAULT: '#9ca3af', // Medium gray for secondary elements
                    light: '#d1d5db', // Lighter gray
                    dark: '#6b7280', // Darker gray
                },
                background: {
                    DEFAULT: '#111827', // Almost black background
                    dark: '#1f2937', // Slightly lighter dark gray
                    light: '#374151', // Medium-dark gray
                },
                foreground: {
                    DEFAULT: '#1f2937', // Dark gray foreground elements
                    light: '#374151', // Slightly lighter gray
                    dark: '#111827', // Deep black for contrast
                },
                border: '#4b5563', // Gray border
                text: '#e5e7eb', // Light text
                muted: '#9ca3af', // Muted gray text
                hover: '#374151', // Slightly lighter gray for hover effects
            },
        },
    },

    plugins: [forms],
};
