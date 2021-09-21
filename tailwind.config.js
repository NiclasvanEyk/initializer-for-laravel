const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './domains/**/*.php',
    ],
    darkMode: 'media', // or 'media' or 'class'
    theme: {
        colors: {
            ...defaultTheme.colors,
            gray: {
                ...colors.gray,
                800: 'rgba(23,25,35)',
                900: '#12141c',
            },
        },
        extend: {
            // https://github.com/tailwindlabs/tailwindcss-typography/issues/69#issuecomment-752946920
            typography: (theme) => ({
                light: {
                    css: [
                        {
                            color: theme('colors.gray.400'),
                            '[class~="lead"]': {
                                color: theme('colors.gray.300'),
                            },
                            a: {
                                color: theme('colors.white'),
                            },
                            strong: {
                                color: theme('colors.white'),
                            },
                            'ol > li::before': {
                                color: theme('colors.gray.400'),
                            },
                            'ul > li::before': {
                                backgroundColor: theme('colors.gray.600'),
                            },
                            hr: {
                                borderColor: theme('colors.gray.200'),
                            },
                            blockquote: {
                                color: theme('colors.gray.200'),
                                borderLeftColor: theme('colors.gray.600'),
                            },
                            h1: {
                                color: theme('colors.white'),
                            },
                            h2: {
                                color: theme('colors.white'),
                            },
                            h3: {
                                color: theme('colors.white'),
                            },
                            h4: {
                                color: theme('colors.white'),
                            },
                            'figure figcaption': {
                                color: theme('colors.gray.400'),
                            },
                            code: {
                                color: theme('colors.white'),
                            },
                            'a code': {
                                color: theme('colors.white'),
                            },
                            pre: {
                                color: theme('colors.gray.200'),
                                backgroundColor: theme('colors.gray.800'),
                            },
                            thead: {
                                color: theme('colors.white'),
                                borderBottomColor: theme('colors.gray.400'),
                            },
                            'tbody tr': {
                                borderBottomColor: theme('colors.gray.600'),
                            },
                        },
                    ],
                },
            }),
        },
    },
    variants: {
        extend: {
            typography: ['dark'],
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
