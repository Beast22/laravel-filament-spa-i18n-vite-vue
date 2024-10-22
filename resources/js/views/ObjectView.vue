<script setup lang="ts">
    import { onMounted, ref } from 'vue'
    import useApi from '@/use/useApi'
    import { useNotification } from 'naive-ui'
    import { useProductStore } from '@/stores/productStores'
    import { useSettingsStore } from '@/stores/settingsStore'
    import BuyNotification from '@/views/BuyNotification.vue'
    import { useRoute } from 'vue-router'
    import { useI18n } from 'vue-i18n'
    import ky from 'ky'

    // Components
    import LoadingBlock from '@/components/LoadingBlock.vue'
    import ErrorBlock from '@/components/ErrorBlock.vue'

     // Stores
     const productStore = useProductStore()
     const settingsStore = useSettingsStore()

    // Api composable
    const { data, isLoading, isLoaded, errors, getApi, isSelected, getImageUrl, getApiWithCache } = useApi()

    // set data for api
    const route = useRoute()

    let gotApi = ref<boolean>(false)
    let goodItem: any
    let goodName: any
    let goodPrice: any
    let goodIms: any

    // phones without spaces
    const noSpace = (str) => {
        return str.replace(/\s/g, '')
    } 

    // toggle text button
    const toggleText = ref(false)

    function toggleBut(){     
        if(!toggleText.value){
            toggleText.value = true
        } else{
            toggleText.value = false
        }
    }

    // Modal
    const showModalImg = ref<boolean>(false)

    const showModalVideo = ref<boolean>(false)

    const showModalAplic = ref<boolean>(false)

    const Photos = ref<boolean>(false)

    const Floor = ref<boolean>(false)

    const isDelete = ref<boolean>(true)

    const isDeleted = ref<boolean>(false)

    const paleBut = ref<boolean>(false)

    const portrait = window.matchMedia('(orientation: portrait)')

    // select an object
    const note = ref<boolean>(false)

    const goodTitle: any = ref('')

    // notification locale
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
    function selected(){

        if(!productStore.isJoined[goodItem.value.id]){
         
            productStore.isJoined[goodItem.value.id] = true

            note.value = true

            goodTitle.value = goodName
            let prodItem = {
                id: goodItem.value.id, 
                img: goodItem.value.images[0].preview, 
                title: goodTitle.value, 
                price: goodItem.value.price
            }
            
            // set product to store
            productStore.createNewItem(prodItem)      

        } else{
                productStore.isJoined[goodItem.value.id] = false

                note.value = false

                // delete product from store
                productStore.deleteItem(goodItem.value.id)
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

    const closeModal = () =>{
        Photos.value = false
        Floor.value = false
    }

    // send application
    let uName = ref<string>('')
    let uTel = ref<any>()
    let uCountry = ref<string>('')

    let isEmptyError = ref<boolean>(false)
    let isNameError = ref<boolean>(false)
    let isTelError = ref<boolean>(false)
    let incorTel = ref<boolean>(false)
    let incorName = ref<boolean>(false)
    let isSucces = ref<boolean>(false)
    let timerS

    const checkEmpty = (): any =>{ 
        if(uName.value.length == 0 ) {
            isNameError.value = true
        }  else{ 
            isNameError.value = false 
        }    
        if(uTel.value === "undefined" || uTel.value == null) {                  
            isTelError.value = true
        }  else{ isTelError.value = false }        
    }

    const checkName = (): boolean  =>{
        if(uName.value.length > 100 || uName.value.length == 0 ){
            incorName.value = true
            return false
        } else{
            incorName.value = false
            return true 
        }
    }

    const checkTel = (name): boolean =>{ 
        const re = /^\d|[-]|[+]|[()]$/
        if(re.test(name)){
            incorTel.value = false
            return true 
        } else{
            incorTel.value = true
            return false  
        }
    }

    const reset = () =>{
        isSucces.value = false
        uTel.value = null
        uName.value = ''
        uCountry.value = ''
    }

    const showApplication = () =>{
        // reset
            isSucces.value = false
            isEmptyError.value = false
            isNameError.value = false
            isTelError.value = false
            incorTel.value = false
            incorName.value = false
            uTel.value = null
            uName.value = '' 
            isDeleted.value = false
            isDelete.value = true
            paleBut.value = false

        showModalAplic.value = true
    }

    const delObj = () =>{
        isDelete.value = false
        isDeleted.value = true
        paleBut.value = true
        timerS = setTimeout(()=>{ showModalAplic.value = false }, 3000)
    }

    const sendApp = () =>{
        if(gotApi.value = true){
            const formData = new FormData()
            formData.append('name', uName.value)
            formData.append('tel', uTel.value)    
            if(uCountry.value){
                formData.append('country', uCountry.value) 
            }
            formData.append('object', goodName)

            checkEmpty()

            if(isTelError.value == true && isNameError.value == true){
                isEmptyError.value = true
            } else{
                isEmptyError.value = false
            }

            checkName()
            checkTel(uTel.value)

            if(checkName() && checkTel(uTel.value)){
                isSucces.value = true
                ky.get('sanctum/csrf-cookie').then(response=>{        
                    ky.post('/api/app', { body: formData})
                })
                timerS = setTimeout(reset, 3000)

            } else{ isSucces.value = false }
        } else{
            return
        }

    }

    onMounted(async() => {
        const route = useRoute()

        await getApiWithCache('object/' + route.params.slug, 300)

        // get data from api   
        goodItem = data
        goodName = goodItem.value.title[i18n.locale.value]

        gotApi.value = true

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
   <div class="card" v-if="data">
        <div class="card-header">
            <h1 class="card-title">{{ data.title[$i18n.locale] }}</h1>
            <div class="header-info">
                <div class="geo">{{ data.city[$i18n.locale] }}</div>
                <div class="square">{{ data.square }} м²</div>
            </div>
        </div>
        <div class="img-block">
            <div class="img-wrap">    
                <div 
                    v-for="(img, index) in data.images.slice(0,3)"
                    class="img-item"
                    :key="index"
                    :style="{ backgroundImage: `url(${getImageUrl(img.preview)})` }"
                    @click ="showModalImg = true, Photos = true"
                >
                </div>
                <div class="badges">
                    <div class="img-badge" @click ="showModalImg = true, Photos = true">
                        <img src="../../badges\icons8-compact-camer.png"
                            alt="photos" 
                            class="img-icon"
                         >
                           <span class="label"> {{ $t('service_label.photo', data.images.length) }}</span>
                           <span class="label-m"> {{ data.images.length }}</span>
                    </div>
                    <div class="img-badge" @click ="showModalImg = true, Floor = true">
                        <img src="../../badges\icons8-floor-plan-50.png"
                            alt="floorplants" 
                            class="img-icon"
                         >
                            <span class="label">{{ $t('service_label.floorplans', data.floorplants.length ) }}</span>
                            <span class="label-m"> {{ data.floorplants.length }}</span>
                    </div>
                    <div class="img-badge" @click ="showModalVideo = true">
                            <img src="../../badges\icons8-video-call-50.png"
                            alt="video" 
                            class="img-icon"
                         >
                          <span class="label">{{ $t('service_label.video', 1) }}</span> 
                          <span class="label-m"> {{ 1 }}</span>
                    </div>   
                </div>
            </div>

        </div>
        <div class="card-info">
            <div class="info-top">
                <div class="info-top-item">
                    <span class="object-price"> 
                        <span>€</span>
                        <span class="price-numb">{{ data.price }}                       
                    </span>              
                    <div class="add-to-fav add-to-fav__card" 
                        @click="selected()"
                        :class="{ 'joined' : productStore.isJoined[data.id] }" 
                    >
                        <svg 
                            class="heart"
                            viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 6.32647C20 11.4974 10.5 17 10.5 17C10.5 17 1 11.4974 1 6.32647C1 -0.694364 10.5 -0.599555 10.5 5.57947C10.5 -0.599555 20 -0.507124 20 6.32647Z" 
                                stroke="black" stroke-linejoin="round">
                            </path>
                        </svg>
                    </div>
                    </span>
                    <div class="object-appartments">
                        <span class="beds">{{ $t('service_label.beds', data.beds.length) }}</span>   |
                        <span class="bath">{{ $t('service_label.bath', data.bath.length)  }}</span>  |
                        <span class="floor">{{ $t('service_label.floor', data.floor.length)  }}</span>
                    </div>
                </div>
                <div class="info-top-item">
                    <div class="info-soical">
                        <a href="https://t.me/Hariomtsatsa" class="info-link"><img src="../../messangers\telegram_1.png" alt="telegram"></a>
                        <a href="https://api.whatsapp.com/send?phone=355694018883" class="info-link"><img src="../../messangers\whatsapp_1.png" alt="whatsapp"></a>
                    </div>
                    <div class="info-tel">
                        <a :href="`tel:${noSpace(settingsStore.phone)}`">{{ settingsStore.phone }}</a>
                    </div>
                </div>
            </div>
            <div class="text-wrap">               
                <div 
                    v-if="!toggleText && $i18n.locale == 'en'"
                    v-html="data.descr[$i18n.locale].substring(0, 640)" 
                    class="info-text"
                >
                </div>
                <div 
                    v-else-if="!toggleText && $i18n.locale == 'ru'"
                    v-html="data.descr[$i18n.locale].substring(0, 520)" 
                    class="info-text"
                >
                </div>
                <div 
                    v-else
                    v-html="data.descr[$i18n.locale]" 
                    class="info-text"
                >
                </div>
                <a 
                    @click="toggleBut" 
                    class="show-text">
                        {{ toggleText ? $t('service_label.hide') : $t('service_label.show') }}
                </a>
            </div>
            <div class="buts">
                <a href="#" @click="showApplication" class="b-blue b-long b-bordered">{{ $t('buttons.send_ap') }}</a>
                <a href="#" class="b-hollow-blue b-long">{{ $t('buttons.offer') }}</a>
            </div>
        </div>
    </div>
    <n-modal 
        v-model:show="showModalImg"
        class="images-card"
        :bordered="false"
        preset="card"
        :style="portrait.matches ? {'width': '100%'} : {'width': '35%'}"
        size="huge"
        :closable="true"
        :on-after-leave="closeModal"
     >   
        <n-carousel show-arrow autoplay>
            <div
                v-if="Photos"
                v-for="(img, index) in data.images"
                class="img-modal"
                :key="index"
                :style="{ backgroundImage: `url(${getImageUrl(img.preview)})` }"
            ></div>
            <div
                v-if="Floor"
                v-for="(img, index) in data.floorplants"
                class="img-modal"
                :key="index"
                :style="{ backgroundImage: `url(${getImageUrl(img.preview)})` }"
            ></div>
        </n-carousel>
        <div class="modal-info">
            <h3 class="modal-title">{{ data.title[$i18n.locale] }}</h3>
            <div class="modal-appartments">
                <span class="beds">{{ $t('service_label.beds', data.beds.length) }}</span>   |
                <span class="bath">{{ $t('service_label.bath', data.bath.length)  }}</span>  |
                <span class="floor">{{ $t('service_label.floor', data.floor.length)  }}</span>
            </div>
            <span class="modal-price"> 
                <span>€</span>
                <span class="price-numb">{{ data.price }}</span> 
            </span> 
        </div>
    </n-modal>

    <n-modal 
        v-model:show="showModalVideo"
        class="images-card"
        :bordered="false"
        preset="card"
        :style="portrait.matches ? {'width': '100%'} : {'width': '35%'}"
        size="huge"
        :closable="true"
    >  
        <iframe :src="data.video" class="video" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </n-modal>

    <n-modal 
        v-model:show="showModalAplic"
        class="images-card images-card_submit"
        :bordered="false"
        preset="card"
        :style="portrait.matches ? {'width': '100%'} : {'width': '25%'}"
        size="huge"
        :closable="true"
    >  
        <div class="modal-info">
            <h2>{{ $t('service_label.app') }}</h2>
            <div class="modal-product">
                <h3 v-if="isDelete" class="modal-title">{{ data.title[$i18n.locale] }}</h3>
                <span v-if="isDelete" class="modal-price"> 
                    <span>€</span>
                    <span class="price-numb">{{ data.price }}</span> 
                </span> 
                <div v-if="isDelete" class="close-but" @click="delObj">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="64" height="64" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve">
                        <g>
                            <line fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" x1="18.947" y1="17.153" x2="45.045" y2="43.056"/>
                        </g>
                        <g>
                            <line fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" x1="19.045" y1="43.153" x2="44.947" y2="17.056"/>
                        </g>
                        <g>
                            <circle fill="none" stroke="#000000" stroke-width="2" stroke-miterlimit="10" cx="32" cy="32" r="30.999"/>
                        </g>
                    </svg>
                </div>
                <div v-if="isDeleted" class="delete-mess">You deleted {{ data.title[$i18n.locale] }}</div>
            </div>
            <form class="send-app" @submit.prevent="sendApp" method="post">      
                <input type="text" :class="{ errored: isNameError } " v-model="uName" name="name" :placeholder="$t('service_label.placeholder')">
                <input type="tel" :class="{ errored: isTelError }" v-model.number="uTel" name="tel" placeholder="1234567890+">
                <input type="text" :class="{ errored: isNameError }" v-model="uCountry" name="country" :placeholder="$t('service_label.placeholder3')">
                <button class="b-blue b-long"
                        :class="{deleted: paleBut}">
                    {{ $t('buttons.send') }}
                </button>

                <div v-if="isEmptyError" class="error">{{ $t('service_label.error') }}</div>
                <div v-else-if="incorName" class="error">{{ $t('service_label.errorName') }}</div>
                <div v-else-if="incorTel" class="error">{{ $t('service_label.errorTel') }}</div>
                <div v-if="isSucces" class="succes">{{ $t('service_label.succes') }}</div>
            </form> 
        </div>
    </n-modal>
    
    <n-notification-provider placement='bottom-right'>
        <BuyNotification v-if="note" :title="goodTitle"/>
    </n-notification-provider>

</template>

<style scoped>
    .card{
        padding-top: 5em;
        width: 60%;
        margin: 0 auto;
    }

    @media only screen and (orientation: portrait) {
        .card{
            width: 100%;
            padding: 9em 3vw 0
        }
    }
    
    .card-header{
        display: flex;
        justify-content: space-between;
        align-items: flex-start; 
    }

    .card-title{
        width: 85%;
    }
    @media only screen and (orientation: portrait) {
        .card-header{
            flex-direction: column;
            margin-bottom: 2em;
        }
        .card-title{
            width: 100%;
            margin: 0 0 0.5em 0;
        }
    }

    .header-info{
        width: 50%;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }
    @media only screen and (orientation: portrait) {
        .header-info{
            align-items: flex-start;
        }
    }

    .square{
        font-size: 2em;
    }

    .geo{
        color: #787878;
    }

    @media only screen and (orientation: portrait) {
        .square, .geo{
            font-size: 5vw;
        }
    }

    .img-block{
        display: flex;
        flex-direction: column;
    }

    .img-wrap{
        position: relative;
        margin-bottom: 3em;
    }

    .img-wrap .img-item{
        width: 35%;
        min-height: 18.2em;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        border-radius: 0.25rem;
        cursor: pointer;
    }
    @media only screen and (orientation: portrait) {
        .img-wrap .img-item {
            width: 31vw;
            min-height: 13.5vh;
        }
    }
    
    .img-item:first-of-type{
        width: 63%;
        min-height: 37.5em;
    }
    @media only screen and (orientation: portrait) {
        .img-item[data-v-22d22ba6]:first-of-type {
            width: 60vw;
            min-height: 28vh;
        }
    }

    .img-item:nth-child(2),
    .img-item:nth-child(3){
        position: absolute;
        right: 0;
    }
    .img-item:nth-child(2){
        top: 0;
    }
    .img-item:nth-child(3){
        bottom: 0;
    }

    .info-top{
        display: flex;
        justify-content: space-between;
        margin-bottom: 1em;
    }

    @media only screen and (orientation: portrait) {
        .info-top{
            flex-direction: column;
        }
    }

    .info-top-item{
        position: relative;
    }

    .badges{
        display: flex;
        position: absolute;
        bottom: -1.2em;   left: 2em;
        color: #000000;
    }

    .label-m{
        display: none;
    }

    @media only screen and (orientation: portrait) {
        .badges{
            left: auto;
            right: 1vw;
        }
        .label{
            display: none;
        }
        .label-m{
            display: block;
        }
    }

    .img-icon{
        height: 1.5em;
        width: auto;
        margin-right: 0.5em;
    }

    .img-badge{
        display: flex;
        align-items: center;
        padding: 0.5em 1em;
        border-radius: 0.25em;
        background-color: #ffffff;
        margin-right: 1em;
        cursor: pointer;
        box-shadow: 0px 6px 4px 1px rgba(224,243,255,0.3);
        transition: all 0.5s ease-in-out;
    }

    .img-badge:last-of-type{
        margin-right: 0;
    }
    
    .img-badge:hover{
        background-color: #e0f3ff;

    }
    .card-info{
        width: 63%;
    }

    @media only screen and (orientation: portrait) {
        .card-info{
            width: 100%;
        }
    }

    .card .object-price{
        display: flex;
        align-items: center;
        font-size: 2.5em;
        line-height: 1em;
        margin-bottom: 0.5em;
    }

    .price-numb{
        display: inline-block;
        margin-right: 0.5em;
    }
    .heart{
        width: 100%;
        height: auto;
        cursor: pointer;
    }

    .add-to-fav__card{
        position: static;
        width: 0.7em;
        height: 0.7em;
    }
    @media only screen and (orientation: portrait) {
        .add-to-fav__card{
            width: 6vw;
            height: 3vh;   
        }
    }   

    .info-soical{
        display: flex;
        justify-content: flex-end;
        margin-bottom: 1em;
    }
    @media only screen and (orientation: portrait) {
        .info-soical{
            display: none;
        }
    }

    .info-link{
        display: flex;
        justify-content: center;
        align-items: center;
        height: 2.5em;
        width: 2.5em;
        padding: 0.2em;
        margin-right: .3em;
    }

    .info-link:last-of-type{
        margin-right: 0;

    }

    .info-tel a{
        color: var(--scheme-color-primary);
        font-size: 1.3em;
        text-decoration: none;
    }

    .card .object-appartments{
        font-size: 1.3em;
    }

    .info-text{
        font-size: .9em;
        color: #000;
    }

    .text-wrap{
        position: relative;
        margin-bottom: 3.5em;
    }

    .show-text{      
        font-size: .8em;
        cursor: pointer;
        position: absolute;
        right: 0;
    }

    .modal-title{
        color: var(--scheme-color-primary);
        font-weight: 600;
    }

    .modal-price{
        font-size: 1.5em;
        font-weight: 600;
        color: #000000;
    }

    .img-modal {
        width: 100%;
        height: 20em;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }
    .modal-info{
        padding: 3em 2em;
    }
    .video {
        width: 100%;
        height: 20em;
        margin: auto;
        display: block;
        border: none;
    }

    .images-card_submit h2{
        margin: 0 0 1.5em 0;
    }

    .modal-product{
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(0, 0, 0, .2);
        border-top: 1px solid rgba(0, 0, 0, .2);
        margin-bottom: 3em;
    }

    .modal-product .modal-title{
        color: #000;
        font-weight: 400;
        margin: 1em 0 1em 0;
    }
    .modal-product .modal-price{
        font-weight: 300;
        white-space: nowrap;
    }

    .send-app input{
        font-size: .9em;
        padding: 0.8em 2em;
        margin-bottom: 1em;
        color: var(--scheme-color-primary);
        background-color: #fff;
        background-clip: padding-box;
        border: 2px solid var(--scheme-color-primary);
        border-radius: 0.25em;
        transition: border 0.15s ease-in-out;
    }

    ::placeholder{
        color: var(--scheme-color-primary);
    }
    ::-webkit-input-placeholder{
        color: var(--scheme-color-primary);
    }
    .send-app{
        display: flex;
        flex-direction: column;
    }

    .send-app .b-blue:hover {
        border-color: var(--scheme-color-primary);
    }

    .send-app input.errored{
        border: 1px solid red;
    }

    .delete-mess{
        margin: 1em 0 1em 0;
    }

    .deleted{
        opacity: .5;
        pointer-events: none;
    }

</style>