import Alpine from 'alpinejs'
import { share } from './shareable-url/shareable-url'

window.Alpine = Alpine

window.Initializer = { share }

Alpine.start()
