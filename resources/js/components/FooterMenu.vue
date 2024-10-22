<script setup lang="ts">
    import { useSettingsStore } from '@/stores/settingsStore'
    import { computed } from 'vue'

    // Settings store
    const settingsStore = useSettingsStore()

    // Arrange submenu items
    const buyRentItems = computed(()=>{
        if(settingsStore.fmenu)
        return settingsStore.fmenu.filter(i => i.item_index === 'buy-rent')
    })

    const cityItems = computed(()=>{
        if(settingsStore.fmenu)
        return settingsStore.fmenu.filter(i => i.item_index === 'city')
    })

    const roomItems = computed(()=>{
        if(settingsStore.fmenu)
        return settingsStore.fmenu.filter(i => i.item_index === 'room')
    })

    const infoItems = computed(()=>{
        if(settingsStore.fmenu)
        return settingsStore.fmenu.filter(i => i.item_index === 'info')
    })

</script>

<template>
    <footer>
        <div class="footer-inner">
            <RouterLink
                to="/" 
                class="logo-wrap">
                 <img class="logo" 
                 :src="settingsStore.logo ? `/storage/${settingsStore.logo}` : ''"
                 /> 
            </RouterLink>
            <ul v-if="settingsStore.pages">
                <li v-for="(elem,index) in settingsStore.pages" :key="index">
                    <RouterLink
                        v-if="elem.slug == 'privacy'" 
                        :to="{name: 'Private', params: {locale: $i18n.locale, slug: elem.slug}}" 
                        class="menu-item">
                            {{  elem.title[$i18n.locale] }} 
                    </RouterLink>
                </li>
            </ul>
            <div class="f-menu">
                <ul v-if="buyRentItems">
                    <li v-for="(elem,index) in buyRentItems" :key="index">
                        <RouterLink 
                            v-if="elem.url == 'sold'" 
                            :to="{name: 'Sold', hash: `#${elem.url}`, 
                            params: {locale: $i18n.locale}}"> 
                                {{ elem.item[$i18n.locale] }} 
                        </RouterLink>
                        <RouterLink 
                            v-else :to="{name: 'Buy', hash: `#${elem.url}`, 
                            params: {locale: $i18n.locale, slug: elem.item.en.toLowerCase()}}"> 
                                {{ elem.item[$i18n.locale] }} 
                        </RouterLink>                    
                    </li>
                </ul>
                <ul v-if="cityItems">
                    <li v-for="(elem,index) in cityItems" :key="index">
                        <RouterLink :to="{name: 'Buy', hash: '#buy-rent', params: {locale: $i18n.locale, slug:  elem.item.en.toLowerCase()}}"> 
                            {{ elem.item[$i18n.locale] }} 
                        </RouterLink>                  
                    </li>
                </ul>
                <ul v-if="roomItems">
                    <li v-for="(elem,index) in roomItems" :key="index">
                        <RouterLink :to="{name: 'Buy', hash: '#buy-rent', params: {locale: $i18n.locale, slug:  `room-${elem.id}`}}"> 
                            {{ elem.item[$i18n.locale] }} 
                        </RouterLink>
                     
                    </li>
                </ul>
                <ul v-if="infoItems">
                    <li v-for="(elem,index) in infoItems" :key="index">                     
                        <RouterLink v-if="elem.url == 'blog'" :to="{name: 'Blog', hash: '#blog', params: {locale: $i18n.locale}}"> 
                            {{ elem.item[$i18n.locale] }} 
                        </RouterLink>
                        <RouterLink v-else :to="`/${elem.url}`">
                            {{ elem.item[$i18n.locale] }} 
                        </RouterLink>                   
                    </li>
                </ul>
            </div>
            <div class="social">
                <a 
                    v-for="item in settingsStore.socials"
                     :key="item.id"
                     class="social-item"
                     :href="item.url">
                        <img :src="item.icon" :alt="`social-${item.id}`">
                </a>
            </div>
        </div>
    </footer>
</template>

<style scoped>

footer{
    background-color: var(--scheme-color-primary);
    padding: 5em 0;
}

@media only screen and (orientation: portrait) {
    footer{
        padding: 3em 3vw;
    }
}

.footer-inner {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    width: 60%;
    margin: 0 auto;
}

@media only screen and (orientation: portrait) {
    .footer-inner {
        width: 100%;
    }
}

.footer-inner .logo{
    filter: brightness(0) invert(1);
}

.f-menu{
    display: flex;
    justify-content: space-between;
    width: 60%;
}

@media only screen and (orientation: portrait) {
    .f-menu{
        justify-content: flex-start;
    }
}

.f-menu ul{
    padding: 0;
    margin: 0;
}

@media only screen and (orientation: portrait) {
    .f-menu ul:nth-child(3),
    .f-menu ul:nth-child(4){
        display: none;
    }
    .f-menu ul{
        margin: 0 3em 0 0;
    }
}

.f-menu ul li a{
    font-weight: 700;
    font-size: .9em;
    color: var(--scheme-color-bg);
    margin-bottom: .5em;
    display: block;
    text-decoration: none;
    transition: opacity 0.3s ease-in-out;
}

.menu-item{
    position: absolute;
    top: 3em;
    left: 0;
    font-size: .8em;
    font-weight: normal;
    color: var(--scheme-color-bg);
    margin-bottom: .5em;
    display: block;
    text-decoration: underline;
    transition: opacity 0.3s ease-in-out;
}

.f-menu ul li a:hover{
    opacity: .8;
}

.logo-wrap{
    width: 5em;
}

@media only screen and (orientation: portrait) {
    .logo-wrap{
        width: 17vw;
    }
}

.social{
    display: flex;
}

.social-item{
    display: block;
    width: 2em;
    margin-right: .5em;
}

@media only screen and (orientation: portrait) {
    .social-item{
        width: 8.5vw;
    }
}

.social-item:last-child{
    margin-right: 0;
}

</style>