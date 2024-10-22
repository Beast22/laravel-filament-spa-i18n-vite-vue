<script setup lang="ts">
    import { onMounted, ref, reactive, watch } from 'vue'
    import useApi from '@/use/useApi'
    import { useI18n } from 'vue-i18n'
    import { useRoute } from 'vue-router'
    import { useProductStore } from '@/stores/productStores'
    import { useSettingsStore } from '@/stores/settingsStore'
    import { useNotification } from 'naive-ui'

    // Stores
    const productStore = useProductStore()
    const settingsStore = useSettingsStore()

    // Api composable
    const { data, isLoading, isLoaded, errors, getImageUrl, getApiWithCache } = useApi()


    const back = ()=>{
        window.history.go(-1)
    }

    onMounted(() => {
        const route = useRoute()
        getApiWithCache('blog/' + route.params.slug, 300)
    })

</script>  


<template>
    <div v-if="isLoading && !isLoaded">
        <LoadingBlock />
    </div>
    <div v-if="errors && !isLoading">
        <ErrorBlock>{{ errors }}</ErrorBlock>
    </div>
    <div class="post-header">
        <a class="back-link"
            @click="back">
            <svg role="presentation" 
                class="back-button" 
                viewBox="0 0 11 20" fill="none" 
                xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L10 10L1 19" stroke="#000000" stroke-width="2"></path>
            </svg>
        </a>
        <div class="post-name">{{ $t('titles.post') }}</div>
    </div>
    <div v-if="data" class="block post-block">
        <h1 class="post-title">{{ data.title[$i18n.locale] }}</h1>
        <div class="post-img">
            <img
                :src="data.images.large" 
                :alt="`post-${data.id}`" 
            >
        </div>
        <div class="post-text">{{ data.text[$i18n.locale]}}</div>
        <div class="post-date">{{ data.created_at }}</div>
    </div>
</template>

<style scope>
    .post-header{
        display: flex;
        justify-content: center;
        text-align: center;
        width: 100%;
        align-items: center;
        position: fixed;
        z-index: 100;
        background: #fff;
        padding: 1em 1em;
        margin-top: -1em;
        border-top: 1px solid rgba(0,0,0,.2);
    }

    .back-link{
        display: inline-block;
        width: 0.7em;
        height: 1.2em;
        position: absolute;
        left: 3em;
        transform: rotate(180deg);
        cursor: pointer;
    }

    .post-name{
        color: #000;
        opacity: .8;
        font-size: .8em;
        font-weight: 600;
        line-height: 1.3;
    }

    .post-block{
        width: 40%;
        margin: 5em auto 0;
        padding-top: 3em;
    }

    .post-title{
        font-weight: 600;
        color: #000;
    }

    .post-img{
        margin-bottom: 1em;
    }

    .post-text{
        font-size: .9em;
        color: #000;
        margin-bottom: 1em;
    }

    .post-date{
        display: inline-block;
        vertical-align: middle;
        margin-right: 1em;
        font-size: .7em;
        letter-spacing: 1px;
        color: rgba(0,0,0,.5);
    }
</style>