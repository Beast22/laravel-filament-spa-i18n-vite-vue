<script setup lang="ts">
    import useApi from '@/use/useApi'
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
    <div class="block categories-city-block">
        <h2>{{ $t('titles.categ_city') }}</h2>
        <div class="categories-city">
            <div v-for="category in chooseCat(settingsStore.cities, 1)" 
                 :key="category.id" 
                 class="city-item">
                 
                <RouterLink :to="{name: 'Buy', params: {slug: category.slug[$i18n.locale]}}" class="city-link"></RouterLink>
                
                <span class="city-title">{{ category.city[$i18n.locale] }}</span>
                <div class="city-overlay"></div>
                <img 
                    :src="category.images.preview" 
                    :alt="category.slug[$i18n.locale]" 
                    class="city-img"               
                >
            </div>
        </div>       
    </div>
</template>

<style scoped>
    .categories-city-block h2{
        text-align: center;
    }
    .categories-city{
        display: flex;
        flex-flow: row wrap;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5em;
        width: 60%;
        margin: 0 auto;
    }

    @media only screen and (orientation: portrait) {
        .categories-city{
            width: 100%;
            padding: 0 3vw;
        }
    }

    .city-item {
        position: relative;
        flex: 0 0 49%;
        background: grey;
        border-radius: 0.25rem;
        height: 14em;
        margin-bottom: 1.2em;
        cursor: pointer;
        text-align: center;
    }

    @media only screen and (orientation: portrait) {
        .city-item{
            flex: 0 0 100%;
        }
    }

    .city-item:hover > .city-overlay{
        height: 20%;
    }

    .city-item:hover > .city-title{
        top: 90%;
    }

    .city-link{
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 3;
        border-radius: 0.25rem;
    }

    .city-img{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        border-radius: 0.25rem;
    }

    .city-overlay{
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        bottom: 0;
        background: var(--scheme-color-primary);
        border-radius: 0.25rem;
        width: 100%;
        height: 100%;
        z-index: 1;
        opacity: .4;
        transition: height 0.3s ease-in-out;
    }

    .city-title{
        display: inline-block;
        position: relative;
        transform: translateY(-50%);
        z-index: 2;
        top: 50%;
        color: var(--scheme-color-bg);
        font-size: 2em;
        text-transform: uppercase;
        transition: top 0.3s ease-in-out;
    }

</style>