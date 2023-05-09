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
            },
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms, typography],
};
