<script setup lang="ts">
    import {onMounted, onBeforeUnmount, ref} from 'vue'
    import useApi from '@/use/useApi'
    import { useSettingsStore } from '@/stores/settingsStore'

    // Components
    import LoadingBlock from '@/components/LoadingBlock.vue'
    import ErrorBlock from '@/components/ErrorBlock.vue'

    // Api composable
    const { data, isLoading, isLoaded, errors, getApi } = useApi()

    // Settings store
    const settingsStore = useSettingsStore()


</script>

<template>
    <div class="block clients-block">
        <h2>{{ $t('titles.clients') }}</h2>
        <div class="clients-inner">
            <div v-for="(item, index) in settingsStore.clients" :key="index" class="client-item">
                <div class="img-wrap">
                    <img :src="item.img" alt="item.name[$i18n.locale]" class="client-img">
                </div>
                <div class="client-name">{{ item.name[$i18n.locale] }}</div>
                <div class="client-review">
                    {{ item.descr[$i18n.locale] }}
                </div>
            </div>
        </div>
    </div>         
</template>

<style scoped>

    .clients-block h2{
        text-align: center;
        margin-bottom: 2em;
    }

    @media only screen and (orientation: portrait) {
        .clients-block{
            padding: 0 3vw;
        }
    }
    .clients-inner{
        display: flex;
        flex-flow: row wrap;
        justify-content: space-between;
        align-items: flex-start;
        width: 60%;
        margin: 0 auto;
    }

    @media only screen and (orientation: portrait) {
        .clients-inner{
            width: 100%;
        }
    }
    .client-item{
        padding: 4em 1.5em 1.5em;
        font-size: .9em;
        background-color: rgb(224, 243, 255);
        border-radius: 0.25rem;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        position: relative;
        flex: 0 0 23.6%;
    }

    @media only screen and (orientation: portrait) {
        .client-item{        
            flex: 0 0 100%;
            margin-bottom: 5em;
        }
        .client-item:last-of-type{        
            margin-bottom: 0;
        }
    }

    .img-wrap{
        width: 6em;
        height: 6em;
        border-radius: 100%;
        overflow: hidden;
        position: absolute;
        top: -3em;
        left: 50%;
        transform: translateX(-50%);
    }

    .client-name{
        font-weight: 700;
        margin-bottom: .5em;
    }
</style>