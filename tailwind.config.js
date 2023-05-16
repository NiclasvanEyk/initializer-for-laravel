import colors from "tailwindcss/colors";
import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

module.exports = {
    mode: "jit",
    content: ["./resources/**/*.{blade.php,js,vue}", "./domains/**/*.php"],
    theme: {
        extend: {
            colors: {
                ...defaultTheme.colors,
                gray: {
                    ...colors.gray,
                    // Less blue-ish colors for dark mode
                    800: "rgba(23,25,35)",
                    900: "#12141c",
                },
                primary: {
                    '50': 'var(--color-primary-50)',
                    '100': 'var(--color-primary-100)',
                    '200': 'var(--color-primary-200)',
                    '300': 'var(--color-primary-300)',
                    '400': 'var(--color-primary-400)',
                    '500': 'var(--color-primary-500)',
                    '600': 'var(--color-primary-600)',
                    '700': 'var(--color-primary-700)',
                    '800': 'var(--color-primary-800)',
                    '900': 'var(--color-primary-900)',
                    '950': 'var(--color-primary-950)',
                }
            },
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms, typography],
};
