<script setup lang="ts">
    import { useSettingsStore } from '@/stores/settingsStore'

    // Settings store
    const settingsStore = useSettingsStore()

</script>

<template>
    <div class="block message-block" id="about">
        <h2>{{ $t('titles.why_we') }}</h2>
        <div class="message-inner">
            <div class="message-img">
                <img src="../../about.png" alt="about">
            </div>           
            <div v-if="settingsStore.info" class="message-text-wrap" >
                <div v-html="settingsStore.info[0].site_message[$i18n.locale]" class="message-text"></div> 
            </div>
        </div>
    </div>
             
</template>

<style scoped>
    
    .message-block h2{
        text-align: center;
    }
    @media only screen and (orientation: portrait) {
        .message-block{
            padding: 0 3vw;
        }
    }
    .message-inner {
        display: flex;
        flex-flow: row wrap;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5em;
        width: 60%;
        margin: 0 auto;
    }

    @media only screen and (orientation: portrait) {
        .message-inner{
            width: 100%;
        }
    }

    .message-img{
        flex: 0 0 49%;
        position: relative;
        height: 20em;
    }

    @media only screen and (orientation: portrait) {
        .message-img{
            flex: 0 0 100%;
            margin-bottom: 2em;
        }
    }

    .message-img img{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        border-radius: 0.25rem;
    }
    
    .message-text-wrap{
        flex: 0 0 49%;
        font-size: .9em;
        align-self: flex-start;
    }

    
    @media only screen and (orientation: portrait) {
        .message-text-wrap{
            flex: 0 0 100%;
        }
    }
    ::v-deep .message-text p{
        margin: 0 0 .8em 0;
    }
    .message-text span:last-of-type {
        margin-bottom: 0;
    }

</style>
