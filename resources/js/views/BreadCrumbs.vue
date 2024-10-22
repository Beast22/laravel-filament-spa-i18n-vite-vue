<script setup lang="ts">
    import { onMounted, ref, reactive, computed, watch } from 'vue'
    import useApi from '@/use/useApi'
    import { useI18n } from 'vue-i18n'
    import { useNotification } from 'naive-ui'
    import { useProductStore } from '@/stores/productStores'
    import { useSettingsStore } from '@/stores/settingsStore'

     // Stores
     const productStore = useProductStore()
     const settingsStore = useSettingsStore()

    // Api composable
    const { data, isLoading, isLoaded, errors, isSelected, getApi, } = useApi()

    // filter is_publisheds and favourites
    const chooseFav = (arr) =>{
        if(Array.isArray(arr)){
            const newArr = arr.filter(object => object.is_published === true && object.latest === true)
            return newArr
        }
    }

    // img hover    
    const imgs :any = ref([])
    
    function setImg (el :any, i :number){
        if(el){
            imgs.value[i] = el;
        }
    }

    function changeImg(idx: number){
        imgs.value[idx - 1].src = settingsStore.goods[idx - 1].images[1].preview      
    }
    
    function oldImg(idx: number){
        imgs.value[idx - 1].src = settingsStore.goods[idx - 1].images[0].preview      
    }

    // notification locale
    const notification = useNotification()
    const i18n = useI18n()

    const ToFavLocale = {
        en: 'added to favorites',
        ru: 'Добавлено в избранное',
    }
    const Favourites = {
        en: 'Favourites',
        ru: 'Избранное',
    }

     // select an object
    function selected(idx: number){

        if(!productStore.isJoined[idx]){
                productStore.isJoined[idx] = true
            notification.create({
                title: settingsStore.goods[idx - 1].title[i18n.locale.value],
                content: ToFavLocale[i18n.locale.value],
                duration: 3000,
            }) 

            let prodItem = { 
                    id: settingsStore.goods[idx - 1].id, 
                    img: settingsStore.goods[idx - 1].images[0].preview, 
                    title: settingsStore.goods[idx - 1].title[i18n.locale.value], 
                    price: settingsStore.goods[idx - 1].price,
                    sold: settingsStore.goods[idx - 1].sold,
            }
            
            // set product to store
            productStore.createNewItem(prodItem) 

        } else{
            productStore.isJoined[idx] = false
            // delete product from store
            productStore.deleteItem(idx)
        }

        productStore.isWishSelected = true
        productStore.isWishShown = true

        
        setTimeout(() => {
            productStore.isWishSelected = false
        }, 500)

        isSelected()
                
        // save wish icon
        localStorage.setItem('wish-icon', JSON.stringify(productStore.isWishShown))
   
        // save hearts 
        localStorage.setItem('hearts', JSON.stringify(productStore.isJoined))

    }
  
    onMounted(() => {
        isSelected()
    })


</script>  


<template>  
    <div class="block breadcrumbs">
        <h2>{{ $t('titles.latest') }}</h2>
        <div class="breadcrumbs-container" v-if="settingsStore.goods">
            <div v-for="(object, i,) in settingsStore.goods" 
                :key="object.id" 
                class="object-item" 
                @mouseover="changeImg(object.id)" 
                @mouseleave="oldImg(object.id)"
            >
                <div class="add-to-fav" 
                    :class="{ 'joined' : productStore.isJoined[object.id] }" 
                    @click="selected(object.id)"
                >
                    <svg 
                        class="heart"
                        viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 6.32647C20 11.4974 10.5 17 10.5 17C10.5 17 1 11.4974 1 6.32647C1 -0.694364 10.5 -0.599555 10.5 5.57947C10.5 -0.599555 20 -0.507124 20 6.32647Z" 
                            stroke="black" stroke-linejoin="round">
                        </path>
                    </svg>
                </div>
                <RouterLink :to="{ name: 'object', params: { slug: object.id } }" class="object-link"></RouterLink>
                <div class="object-img-wrapper" v-if="settingsStore.goods">
                    <img :src="object.images[1].preview" 
                         :alt="`object-${object.id}`" 
                         class="object-img" 
                         :ref="(el) => setImg(el, i)"
                    >
                </div>
                    <div class="object-info">
                        <span class="object-title">{{ object.title[$i18n.locale] }}</span>
                        <div class="object-appartments">
                            <span class="beds"> {{ $t('service_label.beds', Number(object.beds)) }} </span> |
                            <span class="bath">{{ $t('service_label.bath', Number(object.beds)) }}</span>  |
                            <span class="floor"> {{ $t('service_label.floor', Number(object.floor)) }} </span> 
                        </div>
                        <div class="price-square"> 
                            €<span class="price">{{ object.price }}</span>
                            <span class="pale">/
                                <span class="square">{{ object.square }}</span>м²
                            </span>
                        </div>        
                    </div> 
            </div>
        </div>
    </div>

</template>

<style scoped>

.breadcrumbs h2{
    text-align: center;
}
.breadcrumbs-container{
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5em;
    width: 60%;
    margin: 0 auto;
}

@media only screen and (orientation: portrait) {
    .breadcrumbs-container{
        width: 100%;
        padding: 0 3vw;
    }
}

</style>