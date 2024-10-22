const defaultLocale = 'en'
const availableLocales = ['en', 'ru']

export const getInitialLocale = () => {
    const currentQuery = window.location.pathname
    const splitQuery = currentQuery.split('/')
    if (splitQuery[1] && availableLocales.indexOf(splitQuery[1]) >= 0) {

        return  splitQuery[1]
    } else {

        const storedLocale = localStorage.getItem('locale')
        return storedLocale ? storedLocale : defaultLocale
    }
}

export const getDefaultLocale = () => {
    return defaultLocale
}

export const getAvailableLocales = () => {
    return availableLocales
}