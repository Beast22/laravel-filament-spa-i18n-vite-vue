<script setup lang="ts">
    import useApi from '@/use/useApi'

    // Components
    import LoadingBlock from '@/components/LoadingBlock.vue'
    import ErrorBlock from '@/components/ErrorBlock.vue'

    // Api composable
    const { data, isLoading, isLoaded, errors, getApi, getImageUrl } = useApi()

    import { useSettingsStore } from '@/stores/settingsStore'

    // Settings store
    const settingsStore = useSettingsStore()

    // chose category from data
    const chooseCat = (arr, catId) =>{
        if(Array.isArray(arr)){
            const newArr = arr.filter(element => element.category_id == catId)
            return newArr
        }
    }

</script>  

<template>
    <div class="block categories-room-block">
        <h2>{{ $t('titles.categ_room') }}</h2>
        <div class="categories-room">
            <div v-for="category in chooseCat(settingsStore.rooms, 1)" :key="category.id" class="room-item">
                <RouterLink :to="{name: 'Buy', params: {slug: category.slug[$i18n.locale]}}" class="room-link"></RouterLink>
                <span class="room-title">{{ category.room[$i18n.locale] }}</span>
                <img 
                    :src="category.images.preview" 
                    :alt="category.room" 
                    class="room-img"
                >
            </div>
        </div>
    </div>
</template>

<style scoped>
.categories-room-block h2{
    text-align: center;
}
.categories-room{
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5em;
    width: 60%;
    margin: 0 auto;
}

@media only screen and (orientation: portrait) {
    .categories-room{
        width: 100%;
        padding: 0 3vw;
    }
}

.room-item {
    position: relative;
    flex: 0 0 23.6%;
    background: grey;
    border-radius: 0.25rem;
    height: 14em;
    margin-bottom: 1.2em;
    cursor: pointer;
    text-align: center;
    overflow: hidden;
}

@media only screen and (orientation: portrait) {
    .room-item {
        flex: 0 0 100%;
    }
}

.room-item:hover > .room-img{
    transform: scale(1.1);
}

.room-link{
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 3; 
}

.room-img{
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    transition: all 0.5s ease-in-out;
}

.room-title{
    display: inline-block;
    position: absolute;
    z-index: 2;
    top: 10%;
    left: 10%;
    color: var(--scheme-color-bg);
    font-size: 1em;
    text-transform: uppercase;
}

@media only screen and (orientation: portrait) {
    .room-item {
        font-size: 2em;
    }
}
</style>
