import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#eff0fe',
                    100: '#e0e1fc',
                    200: '#c0c2fa',
                    300: '#a0a3f7',
                    400: '#8085f5',
                    500: '#4a4fe4',
                    600: '#3b40cc',
                    700: '#2d32b3',
                    800: '#1f2399',
                    900: '#121580',
                    950: '#0a0d66',
                },
                surface: {
                    DEFAULT: '#ffffff',
                    secondary: '#f9fafb',
                    tertiary: '#f3f4f6',
                },
            },
            borderRadius: {
                card: '1rem',
                button: '0.75rem',
            },
            animation: {
                'fade-in': 'fadeIn 0.3s ease-out',
                'slide-up': 'slideUp 0.3s ease-out',
                'scale-in': 'scaleIn 0.2s ease-out',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(8px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                scaleIn: {
                    '0%': { opacity: '0', transform: 'scale(0.95)' },
                    '100%': { opacity: '1', transform: 'scale(1)' },
                },
            },
        },
    },

    plugins: [forms],
};
