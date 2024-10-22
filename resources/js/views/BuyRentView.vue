<script setup lang="ts">
    import { onMounted, ref, unref, reactive, computed, watch } from 'vue'
    import { useRoute } from 'vue-router'
    import { useRouter } from 'vue-router'
    import useApi from '@/use/useApi'
    import TabView from 'primevue/tabview'
    import TabPanel from 'primevue/tabpanel'
    import RadioButton from 'primevue/radiobutton'
    import Dropdown from 'primevue/dropdown'
    import Checkbox from 'primevue/checkbox'
    import Accordion from 'primevue/accordion'
    import AccordionTab from 'primevue/accordiontab'
    import "primevue/resources/themes/viva-light/theme.css"
    import BuyNotification from '@/views/BuyNotification.vue'
    import { useProductStore } from '@/stores/productStores'
    import { useNotification } from 'naive-ui'
    import { useI18n } from 'vue-i18n'
    

    // Components
    import LoadingBlock from '@/components/LoadingBlock.vue'
    import ErrorBlock from '@/components/ErrorBlock.vue'
    import { collapseTransitionRtl } from 'naive-ui/es/collapse-transition/styles'


    // Api composable
    const { data, isLoading, isLoaded, errors, getApi, isSelected, getImageUrl, getApiWithCache, } = useApi()

    // set data for api
    let dataG: any
    let catalogs: any
    let catalCities: any
    let catalRooms: any
    let catalPrices: any
    let allCatals: any
    let goods: any
    let goodsAr: any
    let result: any
    let actualCities: any
    let actualPrices: any
    let actualRooms: any
    let catArr: any
    let catArLength: any

    // Stores
    const productStore = useProductStore()


    // binding categories slugs and buttons  
    let activeTab = ref<number>(0)

    const showNote = ref<boolean>(false)

    const isNote = ref<boolean>(false)

    const isSelectedP = ref<boolean>(false)

    const note = ref<boolean>(false)

    const goodTitle = ref('')

    //  checkbox emits
    const emits = defineEmits(["update:activeIndex", "click", "change"])

    const route = useRoute()
    const router = useRouter()

    const state :any = reactive({  
        cities: [], 
        prices: [], 
        rooms: [],
        catsLength: computed(() => {
            return state.cities.length + state.prices.length + state.rooms.length
        }),
        catCities: [], 
        catRooms: [], 
        catPrices: [],
        goods: [], 
        chosen: [],
        selectedGoods: [] 
    })

    const actualCats = (catArr, goodsAr, catSubType) =>{

        const actualCatArr :any = []

        for (var i = 0; i < catArr.length; i++) { 
            for (var j = 0; j < goodsAr.length; j++) { 
                if(catArr[i][`category_${catSubType}_id`] === goodsAr[j][`category_${catSubType}_id`]){
                    actualCatArr.push(catArr[i])
                }
            }
        }
        const actualSet = new Set(actualCatArr)
        const uniqueCatsAr = Array.from(actualSet)

        return uniqueCatsAr
    }

    // chose category of goods from data
    const chooseCat = (arr, catId: number) =>{
        const newArr = arr.filter(element => element.category_id == catId)
        return newArr
    }

    // filter published
    const choosePublished = (arr) =>{
        const newArr = arr.filter(object => object.is_published === true)
        return newArr
    }

    // set slugs and default categories
    const setCategSlug = (buySlug, rentSlug) =>{
        const publGoods = choosePublished(goods)
        watch(() => [route.params.slug, state.catsLength, isSelectedP.value], () => {
            switch(route.params.slug){
                case buySlug: activeTab.value = 0
                if(state.catsLength == 0){
                    state.chosen = publGoods.filter(element => element[`category_city_id`] <= 4)
                }
                break
                case rentSlug: activeTab.value = 1
                if(state.catsLength == 0){
                    state.chosen = publGoods.filter(element => element[`category_city_id`] > 4)
                } 
                break
                default: activeTab.value = 0
                if(state.catsLength == 0){
                    state.chosen = publGoods.filter(element => element[`category_city_id`] <= 4)
                }
            }

        }, { immediate: true })
    }

    const setSubCategSlug = () =>{
        const allActualCats = state.catCities.concat(state.catRooms, state.catPrices)
        const buyArr = allActualCats.filter(element => element.category_id == 1)

        watch(()=> route.params.slug, ()=>{
            
             const needElem = buyArr.filter((element) => {
                return element.slug.en == route.params.slug
            }) 

            if (needElem.length > 0){
                if(needElem[0].hasOwnProperty('category_city_id')){
                    state.cities.push(needElem[0])
                    filterCity()
                } else if(needElem[0].hasOwnProperty('category_price_id')){
                    state.prices.push(needElem[0])
                    filterPrice()
                } else if(needElem[0].hasOwnProperty('category_room_id')){
                    state.rooms.push(needElem[0])
                    filterRoom()
                }
                 
                isNote.value = true
            }

        }, { immediate: true })
    }

    const setAllSlugs = (catArr) =>{
        watch(()=> route.params.slug, ()=>{
            for (const item in catArr) {
                const itemObj = catArr[item];
                for (const val in itemObj) {
                    const valObj = itemObj[val]
                    if(itemObj.slug.en = route.params.slug){
                        router.push({ name: 'Buy', params: { slug: itemObj.slug.en } })
                    }

                }
            }

        }, { immediate: true })
    }

    const switchTab = (one, another) =>{
        emits("update:activeIndex")
        state.cities = []
        state.rooms = []
        state.prices = []
        if(activeTab.value == 0){
            setSlug(one)
        } else if(activeTab.value == 1){
            setSlug(another)
        }
    }

    const setSlug = (slug: string) =>{
        router.push({ name: 'Buy', params: { slug: slug } })
    }
  
    const filterGoods = (cat, catTypeInd, catSubType, goods, index, e)=>{

        // chose published goods
        const publGoods = choosePublished(goods)

        // choose rent or buy from goods
        if(catTypeInd == 0) {
            catArr = publGoods.filter(element => element[`category_${catSubType}_id`] <= 4)
        }
        if(catTypeInd == 1) {
            catArr = publGoods.filter(element => element[`category_${catSubType}_id`] > 4  )
        }  

        if(e.target.checked == true){
            let result: any = catArr.filter(e => e[`category_${catSubType}_id`] === cat[`category_${catSubType}_id`])
                          
        } 
      
    }

    // show categories popup
    const watchCats = () =>{
        watch(
            () => state.catsLength,
            () => {
                if(state.catsLength > 0 ){
                    isNote.value = true 
                          
                } else{
                    isNote.value = false                     
                }
               
            },
            { immediate: true }
        )
        isSelectedP.value = true
    }

    // filter goods for cities
    const filterCity = () =>{
        watchCats()   

        const publGoods = choosePublished(goods)
        if( isSelectedP.value = true && state.catsLength > 0 ){
            state.chosen = []
        } 
        
        for (var i = 0; i < publGoods.length; i++) { 
            for (var j = 0; j < state.cities.length; j++) { 
                if(publGoods[i][`category_city_id`] === state.cities[j][`category_city_id`]){
                    if(state.chosen.indexOf(publGoods[i]) === -1) {
                        state.chosen.push(publGoods[i])
                    }     
                }
            }
        }

    }
    const filterPrice = () =>{
        watchCats()

        const publGoods = choosePublished(goods)
        if( isSelectedP.value = true && state.catsLength > 0){
            state.chosen = []
        } 
        for (var i = 0; i < publGoods.length; i++) { 
            for (var j = 0; j < state.prices.length; j++) { 
                if(publGoods[i][`category_price_id`] === state.prices[j][`category_price_id`]){
                    if(state.chosen.indexOf(publGoods[i]) === -1) {
                        state.chosen.push(publGoods[i])
                    }  
                }
            }
        }
    }
    const filterRoom = () =>{
        watchCats()

        const publGoods = choosePublished(goods)
        if( isSelectedP.value = true && state.catsLength > 0){
            state.chosen = []
        } 
        for (var i = 0; i < publGoods.length; i++) { 
            for (var j = 0; j < state.rooms.length; j++) { 
                if(publGoods[i][`category_room_id`] === state.rooms[j][`category_room_id`]){
                    if(state.chosen.indexOf(publGoods[i]) === -1) {
                        state.chosen.push(publGoods[i])
                    } 
                }
            }
        }
    }
    
    const clearAll = () =>{
        state.cities = []
        state.rooms = []
        state.prices = []
        state.chosen = []
        isNote.value = false
    }

    // inner locales
    const i18n = useI18n()

    const Favourites = {
        en: 'Favourites',
        ru: 'Избранное',
    }

    const Filtres = {
        en: 'Filtres',
        ru: 'Фильтры',
    }
    const Categories = {
        cities: {  en: 'City', ru: 'Город'},
        prices: {  en: 'Buy-rent price, €', ru: 'Цена на ренту-покупку, €'},
        rooms: {  en: 'Bedrooms', ru: 'Спальни'}
    }

    function selected(idx: number){

        if(!productStore.isJoined[idx]){

                productStore.isJoined[idx] = true

                note.value = true

                goodTitle.value = state.goods[idx - 1].title[i18n.locale.value]

                let prodItem = { 
                    id: state.goods[idx - 1].id, 
                    img: state.goods[idx - 1].images[0].preview, 
                    title: goodTitle.value, 
                    price: state.goods[idx - 1].price, 
                    sold: state.goods[idx - 1].sold,
                }
            
            // set product to store
            productStore.createNewItem(prodItem)      

        } else{
                productStore.isJoined[idx] = false

                note.value = false

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

    // mobile view
    const fOpen = ref<boolean>(false)

    const isFopen = () =>{
        fOpen.value = !fOpen.value
    }

    const disabled = (first, second) =>{
        const restArr = first.length + second.length

        if(restArr > 0) {
                return true
            } else{ return false}   
    }

    onMounted(async() => {
        await getApiWithCache('buy-rent', 300)

        // get data from api   
        dataG = data
        catalogs = dataG.value.categories
        catalCities = dataG.value.cities
        catalRooms = dataG.value.rooms
        catalPrices = dataG.value.prices
        goods = dataG.value.goods
        allCatals = [...catalCities, ...catalPrices, ...catalRooms]
        
        // put goods to state
        goods.forEach(function(item) {
            state.goods.push(item)
        })

        const actualCities = actualCats(catalCities, state.goods, 'city')

        const actualRooms = actualCats(catalRooms, state.goods, 'room')

        const actualPrices = actualCats(catalPrices, state.goods, 'price')

        // put categories to state
        catalCities.forEach(function(item) {
            state.catCities.push(item)
        })
        catalRooms.forEach(function(item) {
            state.catRooms.push(item)
        })
        catalPrices.forEach(function(item) {
            state.catPrices.push(item)
        })

        //  call functions
        setCategSlug(catalogs[0].slug, catalogs[1].slug)

        setSubCategSlug()

        isSelected()

    })

</script>

<template>
    <div v-if="isLoading && !isLoaded">
        <LoadingBlock />
    </div>
    <div v-if="errors && !isLoading">
        <ErrorBlock>{{ errors }}</ErrorBlock>
    </div>
    <div class="header-block-buy" id="buy-rent">
        <h1>
            <span class="bold main-title">{{ $t('titles.main_title') }}</span>
                {{ $t('titles.buy_title') }}
            <span class="bold">
                {{ $t('titles.bora') }}
            </span>
        </h1>
    </div>
    <div class="block block-buy">
        <div class="buy-tabs" v-if="data">
            <TabView v-model:activeIndex="activeTab" @update:activeIndex="switchTab(data.categories[0].slug, data.categories[1].slug)">
                <TabPanel v-for="(category, i) in data.categories" 
                    :key="category.id"
                    :header="category.title[$i18n.locale]"
                >
                    <div class="buy-rent-inner">
                        <div class="input-block">
                            <div class="input-category" v-if="data.cities">
                                <div class="cat-title">{{ $t('service_label.city') }}</div>
                                <div v-for="(category, i) in chooseCat(state.catCities, activeTab + 1)" 
                                    :key="category.id" 
                                    class="cat-item">
                                    <input 
                                        @change="filterGoods(category, activeTab, 'city', state.goods, i, $event), filterCity()"
                                        type="checkbox" 
                                        :id="category.city.en" 
                                        :value="category" 
                                        :disabled="disabled(state.prices, state.rooms)"
                                        v-model="state.cities"
                                        name="cities"
                                        class="cat-checkbox" 
                                        :class="{ disabled: state.prices.length + state.rooms.length }"
                                    >
                                    <label :for="category.city.en" class="cat-label">{{ category.city[$i18n.locale] }}</label>
                                </div>
                            </div>
                            <div class="input-category" v-if="data.prices">
                                <div class="cat-title">{{ $t('service_label.price') }}</div>
                                <div v-for="(category, i) in chooseCat(state.catPrices, activeTab + 1)" 
                                    :key="category.id" 
                                    class="cat-item">
                                    <input 
                                        @change="filterGoods(category, activeTab, 'price', state.goods, i, $event), filterPrice()"
                                        type="checkbox" 
                                        :id="category.price.en" 
                                        :value="category" 
                                        :disabled="disabled(state.cities, state.rooms)"
                                        v-model="state.prices"
                                        name="prices"
                                        class="cat-checkbox" 
                                        :class="{ disabled: state.cities.length + state.rooms.length }"
                                    >
                                    <label :for="category.price.en" class="cat-label">{{ category.price[$i18n.locale] }}</label>
                                </div>
                            </div>
                            <div class="input-category" v-if="data.rooms">
                                <div class="cat-title">{{ $t('service_label.bedrooms') }}</div>
                                <div v-for="(category, i) in chooseCat(state.catRooms, activeTab + 1)" 
                                    :key="category.id" 
                                    class="cat-item">   
                                    <input 
                                        @change="filterGoods(category, activeTab, 'room', state.goods, i, $event), filterRoom()"
                                        type="checkbox" 
                                        :id="category.room.en" 
                                        :value="category" 
                                        :disabled="disabled(state.cities, state.prices)"
                                        v-model="state.rooms"
                                        name="rooms"
                                        class="cat-checkbox" 
                                        :class="{ disabled: state.cities.length + state.prices.length }"
                                    >
                                    <label :for="category.room.en" class="cat-label">{{ category.room[$i18n.locale] }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="goods-block" v-if="data.goods">
                            <div v-for="(good, j) in state.chosen"
                                :key="good.id"
                                class="object-item object-item__br" 
                            >
                            <div class="add-to-fav" 
                                :class="{ 'joined' : productStore.isJoined[good.id] }" 
                                @click="selected(good.id)"
                            >
                                <svg 
                                    class="heart"
                                    viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 6.32647C20 11.4974 10.5 17 10.5 17C10.5 17 1 11.4974 1 6.32647C1 -0.694364 10.5 -0.599555 10.5 5.57947C10.5 -0.599555 20 -0.507124 20 6.32647Z" 
                                        stroke="black" stroke-linejoin="round">
                                    </path>
                                </svg>
                            </div>
                            <RouterLink :to="{ name: 'object', params: { slug: good.id } }" class="object-link"></RouterLink>
                            <div class="object-img-wrapper" v-if="data.goods">
                                <img :src="good.images[1].preview" 
                                     :alt="`object-${good.id}`" 
                                     class="object-img" 
                                     ref="imgs"
                                >
                            </div>
                                <div class="object-info">
                                    <span class="object-title">{{ good.title[$i18n.locale] }}</span>
                                    <div class="object-appartments">
                                        <span class="beds"> {{ $t('service_label.beds', Number(good.beds)) }} </span> |
                                        <span class="bath">{{ $t('service_label.bath', Number(good.beds)) }}</span>  |
                                        <span class="floor"> {{ $t('service_label.floor', Number(good.floor)) }} </span> 
                                    </div>
                                    <div class="price-square"> 
                                        €<span class="price">{{ good.price }}</span>
                                        <span class="pale">/
                                            <span class="square">{{ good.square }}</span>м²
                                        </span>
                                    </div>        
                                </div>    

                            </div>
                        </div>
                    </div>
                </TabPanel>
            </TabView>  
        </div>
        
        <div class="buy-drop" v-if="catalogs">
            <select v-model="activeTab" @change="switchTab(data.categories[0].slug, data.categories[1].slug)">
                <option v-for="cat in catalogs" :value="cat.id - 1">
                        {{  cat.title.en }}
                </option>
            </select>
            <div class="triangle">
                <svg width="13" class="triangle-icon" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.50274 9.00001L0.870498 0.752941L12.13 0.749549L6.50274 9.00001Z" fill="white"/>
                </svg>                
            </div>
            <div class="filters-but" @:click=isFopen()>
                <div class="f-icon">
                    <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg" class="filtres">
                        <path d="M1 6.96467H8.09C8.33361 8.35526 9.05975 9.61541 10.1407 10.5235C11.2217 11.4315 12.5882 11.9293 14 11.9293C15.4118 11.9293 16.7783 11.4315 17.8593 10.5235C18.9402 9.61541 19.6664 8.35526 19.91 6.96467H41C41.2652 6.96467 41.5196 6.85932 41.7071 6.67178C41.8946 6.48424 42 6.22989 42 5.96467C42 5.69946 41.8946 5.4451 41.7071 5.25757C41.5196 5.07003 41.2652 4.96467 41 4.96467H19.91C19.6664 3.57409 18.9402 2.31394 17.8593 1.40588C16.7783 0.497813 15.4118 0 14 0C12.5882 0 11.2217 0.497813 10.1407 1.40588C9.05975 2.31394 8.33361 3.57409 8.09 4.96467H1C0.734784 4.96467 0.48043 5.07003 0.292893 5.25757C0.105357 5.4451 0 5.69946 0 5.96467C0 6.22989 0.105357 6.48424 0.292893 6.67178C0.48043 6.85932 0.734784 6.96467 1 6.96467ZM14 1.96467C14.7911 1.96467 15.5645 2.19927 16.2223 2.6388C16.8801 3.07832 17.3928 3.70304 17.6955 4.43394C17.9983 5.16484 18.0775 5.96911 17.9231 6.74504C17.7688 7.52096 17.3878 8.23369 16.8284 8.7931C16.269 9.35251 15.5563 9.73347 14.7804 9.88782C14.0044 10.0422 13.2002 9.96294 12.4693 9.66019C11.7384 9.35744 11.1136 8.84475 10.6741 8.18695C10.2346 7.52916 10 6.7558 10 5.96467C10 4.90381 10.4214 3.88639 11.1716 3.13625C11.9217 2.3861 12.9391 1.96467 14 1.96467ZM41 19.9647H33.91C33.6664 18.5741 32.9402 17.3139 31.8593 16.4059C30.7783 15.4978 29.4118 15 28 15C26.5882 15 25.2217 15.4978 24.1407 16.4059C23.0598 17.3139 22.3336 18.5741 22.09 19.9647H1C0.734784 19.9647 0.48043 20.07 0.292893 20.2576C0.105357 20.4451 0 20.6995 0 20.9647C0 21.2299 0.105357 21.4842 0.292893 21.6718C0.48043 21.8593 0.734784 21.9647 1 21.9647H22.09C22.3336 23.3553 23.0598 24.6154 24.1407 25.5235C25.2217 26.4315 26.5882 26.9293 28 26.9293C29.4118 26.9293 30.7783 26.4315 31.8593 25.5235C32.9402 24.6154 33.6664 23.3553 33.91 21.9647H41C41.2652 21.9647 41.5196 21.8593 41.7071 21.6718C41.8946 21.4842 42 21.2299 42 20.9647C42 20.6995 41.8946 20.4451 41.7071 20.2576C41.5196 20.07 41.2652 19.9647 41 19.9647ZM28 24.9647C27.2089 24.9647 26.4355 24.7301 25.7777 24.2906C25.1199 23.851 24.6072 23.2263 24.3045 22.4954C24.0017 21.7645 23.9225 20.9602 24.0769 20.1843C24.2312 19.4084 24.6122 18.6957 25.1716 18.1362C25.731 17.5768 26.4437 17.1959 27.2196 17.0415C27.9956 16.8872 28.7998 16.9664 29.5307 17.2692C30.2616 17.5719 30.8864 18.0846 31.3259 18.7424C31.7654 19.4002 32 20.1735 32 20.9647C32 22.0255 31.5786 23.043 30.8284 23.7931C30.0783 24.5432 29.0609 24.9647 28 24.9647ZM41 34.9647H19.91C19.6664 33.5741 18.9402 32.3139 17.8593 31.4059C16.7783 30.4978 15.4118 30 14 30C12.5882 30 11.2217 30.4978 10.1407 31.4059C9.05975 32.3139 8.33361 33.5741 8.09 34.9647H1C0.734784 34.9647 0.48043 35.07 0.292893 35.2576C0.105357 35.4451 0 35.6995 0 35.9647C0 36.2299 0.105357 36.4842 0.292893 36.6718C0.48043 36.8593 0.734784 36.9647 1 36.9647H8.09C8.33361 38.3553 9.05975 39.6154 10.1407 40.5235C11.2217 41.4315 12.5882 41.9293 14 41.9293C15.4118 41.9293 16.7783 41.4315 17.8593 40.5235C18.9402 39.6154 19.6664 38.3553 19.91 36.9647H41C41.2652 36.9647 41.5196 36.8593 41.7071 36.6718C41.8946 36.4842 42 36.2299 42 35.9647C42 35.6995 41.8946 35.4451 41.7071 35.2576C41.5196 35.07 41.2652 34.9647 41 34.9647ZM14 39.9647C13.2089 39.9647 12.4355 39.7301 11.7777 39.2906C11.1199 38.851 10.6072 38.2263 10.3045 37.4954C10.0017 36.7645 9.92252 35.9602 10.0769 35.1843C10.2312 34.4084 10.6122 33.6957 11.1716 33.1362C11.731 32.5768 12.4437 32.1959 13.2196 32.0415C13.9956 31.8872 14.7998 31.9664 15.5307 32.2692C16.2616 32.5719 16.8864 33.0846 17.3259 33.7424C17.7654 34.4002 18 35.1736 18 35.9647C18 37.0255 17.5786 38.043 16.8284 38.7931C16.0783 39.5432 15.0609 39.9647 14 39.9647Z"/>
                    </svg>
                </div>
                <div> {{ Filtres[i18n.locale.value] }}</div>
            </div>
            <div class="modal-filtres" v-show="fOpen">
                <div class="input-category-m" v-if="data">
    
                    <Accordion :activeIndex="0">
                        <AccordionTab :header="`${Categories.cities[i18n.locale.value]}`">
                            <div class="cat-item"  v-for="(category, i) in chooseCat(state.catCities, activeTab + 1)">
                                <Checkbox  
                                    @change="filterGoods(category, activeTab, 'city', state.goods, i, $event), filterCity()"                
                                    v-model="state.cities"
                                    :value="category"
                                    class="m-checkbox" 
                                    :disabled="disabled(state.prices, state.rooms)"
                                />
                                <label :for="category.city.en" class="cat-label">{{ category.city[$i18n.locale] }}</label>
                            </div>
                        </AccordionTab>
                        <AccordionTab :header="`${Categories.prices[i18n.locale.value]}`">
                            <div class="cat-item"  v-for="(category, i) in chooseCat(state.catPrices, activeTab + 1)">
                                <Checkbox 
                                    @change="filterGoods(category, activeTab, 'price', state.goods, i, $event), filterPrice()"                 
                                    v-model="state.prices"
                                    :value="category"
                                    class="m-checkbox"
                                    :disabled="disabled(state.cities, state.rooms)"    
                                />
                                <label :for="category.price.en" class="cat-label">{{ category.price[$i18n.locale] }}</label>
                            </div>
                        </AccordionTab>
                        <AccordionTab :header="`${Categories.rooms[i18n.locale.value]}`">
                            <div class="cat-item"  v-for="(category, i) in chooseCat(state.catRooms, activeTab + 1)">
                                <Checkbox  
                                    @change="filterGoods(category, activeTab, 'room', state.goods, i, $event), filterRoom()"                 
                                    v-model="state.rooms"
                                    :value="category"
                                    class="m-checkbox"
                                    :disabled="disabled(state.cities, state.prices)"    
                                />
                                <label :for="category.room.en" class="cat-label">{{ category.room[$i18n.locale] }}</label>
                            </div>
                        </AccordionTab>
                    </Accordion>               
                </div>
        
                <div class="chosen-cats">
                    <div v-for="(category, i) in state.cities"
                        class="chosen-item">
                        {{ category["city"][$i18n.locale] }} 
                    </div>
                    <div v-for="(category, i) in state.prices"
                        class="chosen-item">
                        {{ category["price"][$i18n.locale] }} 
                    </div>
                    <div v-for="(category, i) in state.rooms"
                        class="chosen-item">
                        {{ category["room"][$i18n.locale] }} 
                    </div>
                    <a v-if="isNote" class="b-clear" @click="clearAll">{{ $t('service_label.clear') }}</a>
                </div>
                <div class="count-m">{{ $t('service_label.found') }}: <span class="p-quant">{{ state.chosen.length }}</span> </div>

                <div class="goods-block-m" v-if="data.goods">
                    <div v-for="(good, j) in state.chosen"
                        :key="good.id"
                        class="object-item" 
                    >
                    <div class="add-to-fav" 
                        :class="{ 'joined' : productStore.isJoined[good.id] }" 
                        @click="selected(good.id)"
                    >
                        <svg 
                            class="heart"
                            viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 6.32647C20 11.4974 10.5 17 10.5 17C10.5 17 1 11.4974 1 6.32647C1 -0.694364 10.5 -0.599555 10.5 5.57947C10.5 -0.599555 20 -0.507124 20 6.32647Z" 
                                stroke="black" stroke-linejoin="round">
                            </path>
                        </svg>
                    </div>
                    <RouterLink :to="{ name: 'object', params: { slug: good.id } }" class="object-link"></RouterLink>
                    <div class="object-img-wrapper" v-if="data.goods">
                        <img :src="good.images[1].preview" 
                            :alt="`object-${good.id}`" 
                            class="object-img" 
                            ref="imgs"
                        >
                    </div>
                        <div class="object-info">
                            <span class="object-title">{{ good.title[$i18n.locale] }}</span>
                            <div class="object-appartments">
                                <span class="beds"> {{ $t('service_label.beds', Number(good.beds)) }} </span> |
                                <span class="bath">{{ $t('service_label.bath', Number(good.beds)) }}</span>  |
                                <span class="floor"> {{ $t('service_label.floor', Number(good.floor)) }} </span> 
                            </div>
                            <div class="price-square"> 
                                €<span class="price">{{ good.price }}</span>
                                <span class="pale">/
                                    <span class="square">{{ good.square }}</span>м²
                                </span>
                            </div>        
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" v-if="isNote">
        <div class="modal-cont">
            <div class="modal-header">{{ $t('service_label.found') }}: <span class="p-quant">{{ state.chosen.length }}</span> </div>
            <div class="modal-inner">
                <div v-for="(category, i) in state.cities"
                    class="chosen-item">
                    {{ category["city"][$i18n.locale] }} 
                </div>
                <div v-for="(category, i) in state.prices"
                    class="chosen-item">
                    {{ category["price"][$i18n.locale] }} 
                </div>
                <div v-for="(category, i) in state.rooms"
                    class="chosen-item">
                    {{ category["room"][$i18n.locale] }} 
                </div>
            </div>
            <a class="b-clear" @click="clearAll">{{ $t('service_label.clear') }}</a>
        </div>  
    </div>

    <n-notification-provider placement='bottom-right'>
        <BuyNotification v-if="note" :title="goodTitle"/>
      </n-notification-provider>



</template>
<style scoped>
.header-block-buy{
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding-left: 20%;
    min-height: 30em;
    background: url('../../page-bg/buyrent-bg.jpg') no-repeat;
    background-size: cover;
}

@media only screen and (orientation: portrait) {
    .header-block-buy{
        padding: 0 3vw;
    }
}

.header-block-buy h1{
    color: var(--scheme-color-bg);
    width: 11em;
    line-height: 1.5;
}

@media only screen and (orientation: portrait) {
    .header-block-buy h1{
        max-width: 80vw;
        width: auto;
        margin: 0;
    }
}

.block-buy{
    text-align: center;
}
@media only screen and (orientation: portrait) {
    .block-buy{
        padding: 0 3vw;
    }
}

.p-tabview-nav{
    justify-content: center;
}
.buy-rent-inner{
    display: flex;
    justify-content: space-around;
    padding-left: 1.5em;
    padding-right: 1.5em;
    margin-top: 2em;
}

.input-block{
    width: 20%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin: 0 auto;
}

.goods-block{
    display: flex;
    flex-flow: row wrap;
    justify-content: flex-start;
    align-items: flex-start;
    margin-bottom: 1.5em;
    width: 50%;
    margin: 0 auto 0 0;
}

.cat-title{
    color: #000;
    font-size: .9em;
    line-height: 1.55;   
    font-weight: 600;
    margin-bottom: 1em;
}

.cat-item{
    color: #bababa;
    font-size: .9em;
    line-height: 1.55;
    font-weight: 300;
    margin-bottom: 1em;
}

@media only screen and (orientation: portrait) {
    .cat-item{
        display: flex;
        align-items: center;
    }
}

.input-category {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 1.5em;
}

.modal {
    position: fixed;
    bottom: 2em;
    left: 2em;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 1;
    border: 1px solid rgba(0,0,0,.1);
    box-shadow: 0 4px 10px 2px rgba(0,0,0,.1);
}

.modal-cont {
    text-align: center;
    padding: 1em;
    color: #000;
}

.modal-header{
    font-size: .8em;
    margin-bottom: 1em;
}

.count-m{
    text-align: left;
    margin-bottom: 2em;
}

.modal-inner{
    width: 12em;
    display: flex;
    flex-wrap: wrap;
}

.b-clear{
    color: #bababa;
    font-size: .9em;
    cursor: pointer;
    border-bottom: 1px dashed;
}

@media only screen and (orientation: portrait) {
    .b-clear{
        font-size: 3vw; 
    }
}

.chosen-item {
    position: relative;
    font-size: .9em;
    padding: 0 0.5em 0 1.2em;
    background-color: rgba(130,130,130,.2);
    margin: 0 0.5em 0.5em 0;
    white-space: nowrap;
    text-overflow: ellipsis;
    overflow: hidden;
    cursor: pointer;
    border-radius: 0.5em;
    color: rgba(0, 0, 0, .5);
}

.chosen-item:before{
    content: '✕';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0.8em;
    margin-top: auto;
    margin-bottom: auto;
    padding: 0;
    height: 1em;
    font-size: .6em;
    line-height: 1;
}
.cat-checkbox {
    position: absolute;
    z-index: -1;
    opacity: 0;
}

.cat-checkbox+label {
    display: inline-flex;
    align-items: center;
    user-select: none;
}

.cat-checkbox+label::before {
    content: '';
    display: inline-block;
    width: 1.5vw;
    height: 1.5vw;
    flex-shrink: 0;
    flex-grow: 0;
    border: 2px solid #adb5bd;
    border-radius: 0.25em;
    margin-right: 0.5em;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: 50% 50%;
    transition: all .5s;
    -webkit-transition: all .5s;
}

.cat-checkbox:checked+label::before {
    border-color: #0071bc;
    background-color: #0071bc;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3e%3c/svg%3e");
}

.cat-checkbox.disabled+label::before{
    border-color: #0071bc;
    background-color: #0071bc;
    opacity: .3;
}

input[type="checkbox"].disabled{
    pointer-events: none;
}

.object-item__br{
    flex: 0 0 30%;
    margin-bottom: 3em;
    margin-right: 1em;
}

.filters-but{
    display: none;
}

.buy-drop{
    display: none;
}

@media only screen and (orientation: portrait) {

    .buy-drop{
        display: block;
        position: relative;
    }
    .buy-tabs{
        display: none;
    }
    .buy-drop select{
        position: relative;
         -webkit-appearance:none;
         -moz-appearance:none;
         -ms-appearance:none;
        appearance: none;
        border: 0;
        outline: 0;
        width: 100%;
        font-size: 3.2vw;
        font-weight: bold;
        padding: 1rem 4rem 1rem 1rem;
        background-image: none;
        background: var(--scheme-color-link);
        color: white;
        border-radius: 0.25em;
        text-transform: uppercase;
        cursor: pointer;
        overflow: hidden;
    }
    .triangle {
        position: absolute;
        width: 6vw;
        background: var(--scheme-color-link);
        top: 1.9em;
        right: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
        pointer-events: none;
    }

    .filters-but{
        display: flex;
        justify-content: flex-start;
        align-items: center;
        font-size: 5vw;
        font-weight: 300;
        margin-top: 2em;
        color: #bababa;
    }
    .f-icon{
        width: 5vw;
        height: 6.3vw;
        margin-right: .3em;
    }
    .filtres{
        width: 100%;
        height: auto;
        fill: #bababa;
    }

    .modal-filtres{
        margin-top: 1em;
    }

    .checkbox{
        margin-right: 1em;
    }
}

.input-category-m{
    margin-bottom: 5em;
}

.input-category-m .cat-label{
    margin-left: 1em;
}

.goods-block-m{
    display: flex;
    flex-direction: column;
}
.chosen-cats{
    display: flex;
    flex-wrap: wrap;
}

.chosen-cats .chosen-item{
    max-width: 10em;
    font-size: 3vw;
    padding: 0 0.5em 0 1.5em;
}
.chosen-cats .chosen-item:before{
    left: 0.5em;
    height: 1em;
    font-size: 3vw;
    line-height: 1em;
    color: #000;
    bottom: -0.3em;
}

.p-checkbox-disabled{
    border-color: #0071bc;
    background-color: #0071bc;
    opacity: .3;
}

.p-accordion .p-accordion-header .p-accordion-header-link{
    font-weight: 300;
}

</style>