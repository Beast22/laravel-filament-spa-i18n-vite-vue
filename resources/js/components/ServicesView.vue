<script setup lang="ts">
    import {onMounted, ref} from 'vue'
    import useApi from '@/use/useApi'

    // Components
    import LoadingBlock from '@/components/LoadingBlock.vue'
    import ErrorBlock from '@/components/ErrorBlock.vue'

    // Api composable
    const { data, isLoading, isLoaded, errors, getApi } = useApi()

    // Settings store
    import { useSettingsStore } from '@/stores/settingsStore'

    // Settings store
    const settingsStore = useSettingsStore()
</script>

<template>
    <div class="block serv-block" id="service">
        <h2>{{ $t('titles.service') }}</h2>
        <h3> 
            <span>{{ $t('titles.service_subtitle_1') }}</span>
            <span>{{ $t('titles.service_subtitle_2') }}</span>
        </h3>
        <div class="serv-inner">
            <div v-for="(item, index) in settingsStore.services" :key="index" class="serv-item">
                <div class="img-wrap">
                    <svg role="presentation" 
                        class="checkmark" 
                        width="100%"
                        height="100%"
                        fill="#0071bc" 
                        xmlns="http://www.w3.org/2000/svg" 
                        viewBox="0 0 100 100">
                        <path d="M50.2 1.9C23.5 1.9 1.7 23.7 1.7 50.4s21.8 48.5 48.5 48.5 48.4-21.8 48.5-48.5c0-26.7-21.8-48.5-48.5-48.5zm-7.3 71.4L22.7 53.2l4.2-4.3 15.8 15.7 32.1-35.4 4.4 4-36.3 40.1z"></path>
                        <path d="M50.2 1.9C23.5 1.9 1.7 23.7 1.7 50.4s21.8 48.5 48.5 48.5 48.4-21.8 48.5-48.5c0-26.7-21.8-48.5-48.5-48.5zm-7.3 71.4L22.7 53.2l4.2-4.3 15.8 15.7 32.1-35.4 4.4 4-36.3 40.1z"></path>
                    </svg>
                </div>
                <div class="serv-text">{{ item.text[$i18n.locale] }}</div>
            </div>
        </div>
    </div>         
</template>

<style scoped>
.serv-block h2 {
    text-align: center;
    margin-bottom: 1em;
}

@media only screen and (orientation: portrait) {
    .serv-block{
        padding: 0 3vw;
    }
}
.serv-block h3 {
    white-space: pre-wrap;
    max-width: 30%;
    margin: 0 auto 3em;
    text-align: center;
}
@media only screen and (orientation: portrait) {
    .serv-block h3{
        max-width: 100%;
    }
}

.serv-block h3 span{
    display: block;
}

.serv-inner {
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5em;
    width: 60%;
    margin: 0 auto;
}

@media only screen and (orientation: portrait) {
    .serv-inner{
        max-width: 100%;
    }
}

.serv-item {
    flex: 0 0 49%;
    font-size: .9em;
    display: flex;
    align-items: center;
    padding: 0 1em;
    margin-bottom: 2em;
}

@media only screen and (orientation: portrait) {
    .serv-item{
        flex: 0 0 100%;
    }
}

.img-wrap {
    margin-right: 1em;
    min-width: 1.5em;
    height: 1.5em;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>