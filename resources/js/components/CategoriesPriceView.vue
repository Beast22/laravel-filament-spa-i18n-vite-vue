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
    <div class="block categories-price-block">
        <h2>{{ $t('titles.categ_price') }}</h2>
        <div class="categories-price">
            <div v-for="category in chooseCat(settingsStore.prices, 1)" :key="category.id" class="price-item">
                <RouterLink :to="{name: 'Buy', params: {slug: category.slug[$i18n.locale]}}" class="price-link"></RouterLink>
                <span class="price-title">{{ category.price[$i18n.locale]}} </span>
                <div class="price-overlay"></div>
                <img :src="category.images.preview" 
                     :alt="`price_${category.id}`" 
                      class="price-img"
                >
            </div>
        </div>
    </div>
</template>

<style scoped>
.categories-price-block h2{
    text-align: center;
}
.categories-price{
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5em;
    width: 60%;
    margin: 0 auto;
}

@media only screen and (orientation: portrait) {
    .categories-price{
        width: 100%;
        padding: 0 3vw;
    }
}

.price-item {
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
    .price-item {
        flex: 0 0 100%;
    }
}

.price-item:hover > .price-overlay{
    height: 20%;
}

.price-item:hover > .price-title{
    top: 90%;
}

.price-link{
    display: block;
    position: absolute;
    border-radius: 0.25rem;
    width: 100%;
    height: 100%;
    z-index: 3; 
}

.price-img{
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    border-radius: 0.25rem;
}

.price-overlay{
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

.price-title{
    display: inline-block;
    position: relative;
    transform: translateY(-50%);
    z-index: 2;
    top: 50%;
    color: var(--scheme-color-bg);
    font-size: 2em;
    transition: top 0.3s ease-in-out;
}
</style>