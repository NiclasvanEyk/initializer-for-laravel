export const computeSharingUrl = ({ checkBoxes, keyValuePairs }) => {
    const query = [
        'no-defaults',
        ...keyValuePairs.map(([key, value]) => `${key}=${value}`),
        ...checkBoxes.map(([key, value]) => key),
    ].join('&');

    const { origin, pathname } = window.location

    return `${origin}${pathname}?${query}`
}
