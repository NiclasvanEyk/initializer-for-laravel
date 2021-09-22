const starterParameters = () => {
    return {
        'laravel': [],
        'breeze': ['breeze-frontend'],
        'jetstream': ['uses-jetstream-teams', 'jetstream-frontend'],
    }
}

/**
 * Filters non-relevant parameters based on the starter.
 *
 * E.g. uses-jetstream-teams is not relevant when initializing a breeze project.
 */
export const filterStarterParameter = starter => {
    let irrelevant = starterParameters()
    delete starterParameters[starter]
    irrelevant = Object.entries(irrelevant).flatMap(([starter, parameters]) => parameters)

    return ([key, value]) => !irrelevant.includes(key)
}

const ignoredKeys = ['project', 'description']
export const filterIgnoredKeys = ([key, value]) => !ignoredKeys.includes(key)

export const filterUncheckedBoxes = ([key, value]) => value !== 'off'
