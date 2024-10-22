<script setup lang="ts">
import { useNotification } from 'naive-ui'
import { useI18n } from 'vue-i18n'

const locale = defineProps({
    title: {
        type: String
    }
})

const notification = useNotification()

// notification locale
const i18n = useI18n()

const ToFavLocale = {
        en: 'added to favorites',
        ru: 'Добавлено в избранное',
}

notification.create({
        title: locale.title,
        content: ToFavLocale[i18n.locale.value],
        duration: 3000,
}) 

</script>
<template>

</template>  