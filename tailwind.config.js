const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    content: [
        './resources/**/*.{blade.php,js,vue}',
        './domains/**/*.php',
        './lib/**/*.php',
    ],
    theme: {
        extend: {
            colors: {
                ...defaultTheme.colors,
                gray: {
                    ...colors.gray,
                    // Less blue-ish colors for dark mode
                    800: 'rgba(23,25,35)',
                    900: '#12141c',
                },
            },
        }
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
