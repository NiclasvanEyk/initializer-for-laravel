import { filterEmptyValues, filterIgnoredKeys, filterStarterParameter, filterUncheckedBoxes } from './filters'

export const extractFormValues = formId => {
    const form = document.getElementById(formId)
    const values = Object.fromEntries(Array.from(new FormData(form)))

    const checkBoxes = []
    const keyValuePairs = []

    for (const [key, value] of Object.entries(values)) {
        if (key.startsWith('uses-')) {
            checkBoxes.push([key, value])
        } else {
            keyValuePairs.push([key, value])
        }
    }

    return {
        checkBoxes: checkBoxes
            .filter(filterUncheckedBoxes)
            .filter(filterIgnoredKeys)
            .filter(filterEmptyValues)
            .filter(filterStarterParameter(keyValuePairs['starter'])),
        keyValuePairs: keyValuePairs
            .filter(filterUncheckedBoxes)
            .filter(filterIgnoredKeys)
            .filter(filterEmptyValues)
            .filter(filterStarterParameter(keyValuePairs['starter'])),
    }
}
