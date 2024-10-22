<script setup lang="ts">
    import { onMounted, ref, unref, computed } from 'vue'
    import useApi from '@/use/useApi'
    import { useProductStore } from '@/stores/productStores'
    import { useSettingsStore } from '@/stores/settingsStore'
    import ky from 'ky'

    // Components
    import LoadingBlock from '@/components/LoadingBlock.vue'
    import ErrorBlock from '@/components/ErrorBlock.vue'
    import DrawerView from '@/components/DrawerView.vue'
    import MainMenu from '@/components/MainMenu.vue'
    import FooterMenu from '@/components/FooterMenu.vue'

     // Stores
     const productStore = useProductStore()
     const settingsStore = useSettingsStore()

    // Api composable
    const { data, isLoading, isLoaded, errors, getApi} = useApi()

    // Load initial settings async function
    const loadInitialSettings = async () => {     
        await getApi('init')
        if (data.value.loaded === true) {
            settingsStore.storeSettings(unref(data))
        }
    }

    // phones without spaces
    const noSpace = (str) => {
       return str.replace(/\s/g, '')
    }

    // validation
    let uName = ref<string>('')
    let uTel = ref<any>()

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
    }

    // submit form
    const sendEmail = () =>{
        const formData = new FormData()
        formData.append('name', uName.value)
        formData.append('tel', uTel.value)

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
                ky.post('/api/send', { body: formData})
            })
            timerS = setTimeout(reset, 3000)

        } else{ isSucces.value = false }

    }

    onMounted(() => {
        loadInitialSettings()
        clearInterval(timerS)
    })

</script>

<template>
    <div v-if="isLoading && !isLoaded">
        <LoadingBlock />
    </div>
    <div v-if="errors && !isLoading">
        <ErrorBlock>{{ errors }}</ErrorBlock>
    </div>
    
    <header>
        <MainMenu />
    </header>
    <main role="main">
        <RouterView />
    </main>
    <div class="block send-block">
        <div class="send-block-inner">
            <h2 class="white-title">{{ $t('titles.send') }}</h2> 
            <form class="send-inputs" @submit.prevent="sendEmail" method="post">      
                <input type="text" :class="{ errored: isNameError }" v-model="uName" name="name" :placeholder="$t('service_label.placeholder')">
                <input type="tel" :class="{ errored: isTelError }" v-model.number="uTel" name="tel" placeholder="1234567890+">
                <button class="b-blue b-short">{{ $t('buttons.send') }}</button>

                <div v-if="isEmptyError" class="error">{{ $t('service_label.error') }}</div>
                <div v-else-if="incorName" class="error">{{ $t('service_label.errorName') }}</div>
                <div v-else-if="incorTel" class="error">{{ $t('service_label.errorTel') }}</div>
                <div v-if="isSucces" class="succes">{{ $t('service_label.succes') }}</div>
            </form> 
        </div>
    </div>
    <div class="block contact-block" id="contacts">
        <h2>{{ $t('titles.contacts') }}</h2>
        <div class="contact-inner">
            <div class="contact-info">
                <div v-if="settingsStore.info" class="contact-item">
                    <span>{{ settingsStore.info[0].site_slogan[$i18n.locale] }}</span>    
                    <span>{{ settingsStore.info[0].site_geo[$i18n.locale]}}</span> 
                </div>
                <div class="contact-item">
                    <a :href="`tel:${noSpace(settingsStore.phone)}`">{{ settingsStore.phone }}</a>
                    <a :href="`tel:${noSpace(settingsStore.phone2)}`">{{ settingsStore.phone2 }}</a>
                </div>
                <div class="contact-item">
                    <a :href="`mailto:${ settingsStore.email }`">{{ settingsStore.email }}</a>
                </div>
            </div>
            <div class="map-wrap">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3062.033573321126!2d20.00882667669727!3d39.873485871532026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x135b14f73ca8a661%3A0x1ecc5295832f41f1!2zU2jDq3RpdG9yamEgTmFpbSBGcmFzaMOrcmksIFNhcmFuZMOrLCDQkNC70LHQsNC90LjRjw!5e0!3m2!1sru!2sru!4v1690386349313!5m2!1sru!2sru" 
                    style="border:0;" 
                    allowfullscreen="false" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

    <FooterMenu />
    <DrawerView/>
</template>
   
<style scoped>

    .send-block{
        width: 60%;
        margin: 5em auto 0;
        border-radius: 0.25em;
        background-image: url('../multiple-buildings-w.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    @media only screen and (orientation: portrait) {
        .send-block{
            display: none;
        }
    }
    .send-block-inner{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 3em 2em 3.5em;
        border-radius: 0.25em;
        background-image: -webkit-linear-gradient(top, rgba(0,123,205,0.40), rgba(0,123,205,0.40));
    }

    .send-inputs{
        display: flex;
        flex-flow: wrap;
        justify-content: space-between;
        width: 65%;
    }

    .send-block input{
        font-size: .9em;
        padding: 0.375em 0.75em;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #fff;
        border-radius: 0.25em;
        transition: border 0.15s ease-in-out ease-in-out;
        margin-right: 1em;
    }
    .contact-block h2{
        text-align: center;
        margin-bottom: 1em;
    }

    .contact-inner{
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin: 0 auto;
        padding-bottom: 2em;
    }

    .send-block input.errored{
        border: 1px solid red;
    }
  
    @media only screen and (orientation: portrait) {
        .contact-inner{
            padding: 0 3vw;
            flex-direction: column;
        }
    }
    .contact-info{
        font-size: 1.3em;
        margin-left: 20%;
    }

    @media only screen and (orientation: portrait) {
        .contact-info{
            margin-left: 0;
            text-align: center;
            margin-bottom: 1em;
        }
    }

    .contact-info span{
        display: inline-block;
    }

    .map-wrap{
        margin-right: 10%;
        width: 30%;
    }

    @media only screen and (orientation: portrait) {
        .map-wrap{
            margin-right: 0;
            width: 100%;
        }
    }

    .map-wrap iframe {
        width: 100%;
        height: 100%;
        min-height: 20em;
    }

    .contact-info a{
        color: #0071bc;
        text-decoration: none;
    }

    .contact-item{
        margin-bottom: 1em;
        display: flex;
        flex-direction: column;
    }

    .contact-item:last-child{
        margin-bottom: 0;
    }

</style>



