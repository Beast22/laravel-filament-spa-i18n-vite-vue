import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createI18n } from 'vue-i18n'
import naive from 'naive-ui'
import PrimeVue from 'primevue/config'

import App from '@/App.vue'
import router from '@/router'

import { getInitialLocale, getDefaultLocale } from '@/utils/locale'

const app = createApp(App)
const pinia = createPinia()

// Translations
import en from '@/translations/en.json'
import ru from '@/translations/ru.json'

const messages = {
    en: en,
    ru: ru,
}

const i18n = createI18n({
    legacy: false,
    allowComposition: true,
    locale: getInitialLocale(),
    fallbackLocale: getDefaultLocale(),
    pluralRules: {
        ru: function (choice, choicesLength) {
          if (choice === 0) {
            return 0;
          }

          const teen = choice > 10 && choice < 20;
          const endsWithOne = choice % 10 === 1;

          if (choicesLength < 4) {
            return !teen && endsWithOne ? 1 : 2;
          }
          if (!teen && endsWithOne) {
            return 1;
          }
          if (!teen && choice % 10 >= 2 && choice % 10 <= 4) {
            return 2;
          }

          return choicesLength < 4 ? 2 : 3;
        s},
    },
    messages,
})


app.use(pinia)
app.use(router)
app.use(i18n)
app.use(naive)
app.use(PrimeVue)
app.mount('#app')
