import { defineStore } from 'pinia'

export type settingsStoreType = {
    title: string,
    phone: string,
    phone2: string,
    email: string,
    logo: string,
    socials: any,
    cities: any,
    prices: any,
    rooms: any,
    goods: any,
    clients: any,
    services: any,
    info: any,
    pages: any,
    fmenu: any,
}

export const useSettingsStore = defineStore('settings', {
    state: () => ({
        title: "",
        phone: "",
        phone2: "",
        email: "",
        logo: "",
        socials: "",
        cities: "",
        prices: "",
        rooms: "",
        goods: "",
        clients: "",
        services: "",
        info: "",
        pages: "",
        fmenu: "",
    } as settingsStoreType),
    actions: {
        storeSettings(settings : object){
            Object.keys(settings).forEach(key => {
                if (key !== 'loaded' && typeof this[key as keyof typeof this] !== undefined) {
                    this[key as keyof typeof this] = settings[key as keyof typeof settings]
                }
            });
        },
    }

})