import { createI18n } from 'vue-i18n';

const i18n = createI18n({
    locale: 'en',
    fallbackLocale: 'en',
    messages: {
        en: {
            hello: 'hello!'
        },
        fa: {
            hello: 'سلام!'
        }
    },
})

export default i18n;
