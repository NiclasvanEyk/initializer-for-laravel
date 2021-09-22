import { computeSharingUrl } from './computeSharingUrl'
import { extractFormValues } from './extractFormValues'

export function share(formId) {
    const url = computeSharingUrl(extractFormValues(formId))

    if ('share' in navigator) {
        navigator.share({url})
    } else {
        window.location = url;
    }
}
