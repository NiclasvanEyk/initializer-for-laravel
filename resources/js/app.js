import Alpine from 'alpinejs'
import { share } from './shareable-url/shareable-url'

import { red, yellow, indigo } from "tailwindcss/colors";

window.Alpine = Alpine

window.Initializer = { share }

document.addEventListener('alpine:init', function () {
    Alpine.data('theme', () => ({
        theme: {
            name: 'laravel',
            palettes: {
                laravel: red,
                breeze: yellow,
                jetstream: indigo,
            }
        },
        themeRootElement: {
            ['x-bind:style']() {
                const palette = Object
                    .entries(this.theme.palettes[this.theme.name])
                    .map(([weight, rgb]) => [`--color-primary-${weight}`, rgb])

                const p = Object.fromEntries(palette)
                console.log(p)
                return p
            }
        }
    }))
});

console.log("Test")

Alpine.start()
