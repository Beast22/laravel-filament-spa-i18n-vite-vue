<script setup lang="ts">
    import TextPage from '@/components/TextPage.vue'
    import { useRoute } from 'vue-router'

    const route = useRoute()
    const getApiQuery = 'pages/' + route.params.slug
</script>

<template>
    <article class="privacy">
        <TextPage :url="getApiQuery" :key="getApiQuery"></TextPage>
    </article>
</template>

<style scoped>
    .privacy{
        padding-top: 10em;
        padding-left: 20%;
    }
</style>