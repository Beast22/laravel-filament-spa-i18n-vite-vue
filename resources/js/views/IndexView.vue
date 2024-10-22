<script setup lang="ts">
import useApi from '@/use/useApi'

 // Components
 import CategoriesCityView from '@/components/CategoriesCityView.vue'
 import CategoriesRoomView from '@/components/CategoriesRoomView.vue'
 import CategoriesPriceView from '@/components/CategoriesPriceView.vue'
 import BreadCrumbs from '@/views/BreadCrumbs.vue'
 import ClientsView from '@/components/ClientsView.vue'
 import ServicesView from '@/components/ServicesView.vue'
 import Message from '@/components/Message.vue'

</script>

<template>
    <div class="header-block">
        <span class="subtitle">
            {{ $t('titles.main_subtitle') }}
        </span>
        <h1>
            <span class="bold main-title">{{ $t('titles.main_title') }}</span>
            <i18n-t keypath="titles.main_title_2" tag="div" scope="global">
                <template v-slot:br>
                  <br>
                </template>
            </i18n-t>

        </h1>
        <div class="buts">
            <router-link :to="{name: 'Buy', params: {slug: 'buy'}}" class="b-blue b-long">{{ $t('buttons.buy') }}</router-link>
            <router-link :to="{name: 'Buy', params: {slug: 'rent'}}" class="b-hollow b-long">{{ $t('buttons.rent') }}</router-link>
        </div>
    </div>
    
    <CategoriesCityView/>

    <CategoriesRoomView/>

    <CategoriesPriceView/>

    <n-notification-provider placement='bottom-right'>
        <BreadCrumbs/>
    </n-notification-provider>

    <Message/>

    <ClientsView/>

    <ServicesView/>
   

</template>

<style scoped>
    .header-block{
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding-left: 20%;
        min-height: 55em;
        background-image: url('../../page-bg/main-bg.jpg');
        background-position: center -7em;
        background-size: cover;
        background-attachment: fixed;
    }

    @media only screen and (orientation: portrait) {
        .header-block{
            padding: 0 3vw;
        }
    }

    .header-block .subtitle{
        display: inline-block;
        margin-bottom: 1em;
    }
    

    .header-block h1{
        width: 11em;
        line-height: 1.5;
    }

    @media only screen and (orientation: portrait) {
        .header-block h1{
            width: auto;
        }
    }
    @media only screen and (orientation: portrait) {
        .header-block div{
            line-height: 1em;
        }
    }


</style>