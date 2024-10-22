<script setup lang="ts">
    import { onMounted, onBeforeUnmount, ref, watch, computed } from 'vue'
    import router from '@/router'
    import { useRoute } from 'vue-router';
    import { useI18n } from 'vue-i18n'
    import { useSettingsStore } from '@/stores/settingsStore'

    // Settings store
    const settingsStore = useSettingsStore()

    const isScrolled = ref<boolean>(false)

    // toggle menu style
    const isWhite = ref<boolean>(false)

    const route = useRoute()

    // navbar burger
    const navOpen = ref<boolean>(false)
    const isWishShown = ref<boolean>(false)

    let routeName = computed(() => {
      return route.name
    })

    let isWhiteComputed = computed(() => {
      return isWhite.value
    })

    watch(() => route.name, () => {
        switch(route.name){
            case 'Buy': isWhite.value = true
            break
            case 'Blog': isWhite.value = true
            break
            case 'Sold': isWhite.value = true
            break
            default: isWhite.value = false
        }

    })

    const isNavOpen = (urlName) =>{
        navOpen.value = !navOpen.value
        navOpen.value == true ? document.body.style.overflow = 'hidden' : document.body.style.overflow = ''
        if(navOpen.value == true){
            isWishShown.value = false
            localStorage.setItem('wish-icon', JSON.stringify(isWishShown.value))
        } else{
            isWishShown.value = true
            localStorage.setItem('wish-icon', JSON.stringify(isWishShown.value))
        }
        if(urlName == 'Buy' || route.name == 'Blog' || route.name == 'Sold' ){
            if (navOpen.value == false && window.scrollY < 100){
                isWhite.value = true
            } 
            if(navOpen.value == true) {
                isWhite.value = false
            }          
        } 

    }

    // change menu on scroll
    const menuScroll = () => {
        if(window.scrollY >= 100) {
            isScrolled.value = true
        } else{
            isScrolled.value = false
        }
    }

    const goF = (e) =>{
        if(window.screen.orientation.type == "portrait-primary"){
            if(e.target.tagName.toLowerCase() === 'a' &&  e.target.classList.contains("lang-link") == false){
                navOpen.value = false
            }
        }
    }

    onMounted(() => {
        window.addEventListener('scroll', menuScroll)
    })

    onBeforeUnmount(() => {
        window.removeEventListener('scroll', menuScroll)
    })

    // Locale switch function
    const i18n = useI18n({ useScope: 'global' })

    const languages = [
        {code: 'en', title: 'En'},
        {code: 'ru', title: 'Ru'},
    ]

    const switchLanguage = (newLang : string) => {

        i18n.locale.value = newLang

        document.documentElement.lang = newLang

        localStorage.setItem('locale', newLang)

        const currentPath = router.currentRoute.value.fullPath
        const splitPath = currentPath.split("/")
        splitPath[1] = newLang
        router.push(splitPath.join('/'))       
    }

</script>

<template>
    <nav :class="[{scrolled: isScrolled}, {white: isWhite} ]" id="main-nav">      
        <ul @click="goF($event)">
            <li class="logo-item">
                <RouterLink
                    to="/" 
                    class="logo-link">
                    <img class="logo" 
                        :src="settingsStore.logo ? `/storage/${settingsStore.logo}` : ''"
                    />                    
                </RouterLink>
            </li>
            <li class="main-item">
                <RouterLink 
                    :to="{name: 'Buy', hash: '#buy-rent', params: {locale: $i18n.locale, slug: 'buy'}}">
                        {{ $t('mainmenu.buy') }}
                </RouterLink>
            </li>
            <li class="main-item">
                <RouterLink
                    :to="{name: 'Buy', hash: '#buy-rent', params: {locale: $i18n.locale, slug: 'rent'}}">
                    {{ $t('mainmenu.rent') }}
                </RouterLink>
            </li>
            <li class="main-item">
                <RouterLink
                    to="/#service">
                    {{ $t('mainmenu.services') }}
                </RouterLink>
            </li>
            <li class="main-item">
                <RouterLink
                    to="/#about">
                    {{ $t('mainmenu.about') }}
                </RouterLink>
            </li>
            <li class="main-item">
                <RouterLink
                    :to="{name: 'Blog', hash: '#blog', params: {locale: $i18n.locale}}">
                    {{ $t('mainmenu.blog') }}
                </RouterLink>
            </li>
            <li class="main-item">
                <RouterLink 
                    to="/#contacts">
                    {{ $t('mainmenu.contacts') }}
                </RouterLink>
            </li>
            <li v-if="languages.length > 1" class="lang-block">
                <a href="#" v-for="l in languages" 
                    @click.prevent="switchLanguage(l.code)" 
                    :key="l.code" 
                    :class="{ active: l.code === $i18n.locale }"
                    class="lang-link"
                >
                        {{ l.title }}
                </a>
            </li>
            <div id="sidemenu">
                <button class="sidemenu__btn" @:click=isNavOpen(route.name) :class="{active:navOpen}">
                    <span class="top"></span>
                    <span class="mid"></span>
                    <span class="bottom"></span>
                </button>
                <transition name="translateX">
                  <nav v-show="navOpen">
                    <div class="sidemenu__wrapper">
                      <ul class="sidemenu__list">
                        <li class="sidemenu__item">
                            <RouterLink 
                                :to="{name: 'Buy', hash: '#buy-rent', params: {locale: $i18n.locale, slug: 'buy'}}">
                                {{ $t('mainmenu.buy') }}
                            </RouterLink>
                        </li>
                        <li class="sidemenu__item">
                            <RouterLink
                                :to="{name: 'Buy', hash: '#buy-rent', params: {locale: $i18n.locale, slug: 'rent'}}">
                                {{ $t('mainmenu.rent') }}
                            </RouterLink>
                        </li>
                        <li class="sidemenu__item">
                            <RouterLink
                                to="/#service">
                                {{ $t('mainmenu.services') }}
                            </RouterLink>
                        </li>
                        <li class="sidemenu__item">
                            <RouterLink
                                to="/#about">
                                {{ $t('mainmenu.about') }}
                            </RouterLink>
                        </li>
                        <li class="sidemenu__item">
                            <RouterLink
                                :to="{name: 'Blog', hash: '#blog', params: {locale: $i18n.locale}}">
                                {{ $t('mainmenu.blog') }}
                            </RouterLink>
                        </li>
                        <li class="sidemenu__item">
                            <RouterLink 
                                to="/#contacts">
                                {{ $t('mainmenu.contacts') }}
                            </RouterLink>
                        </li>
                      </ul>
                    </div>
                  </nav>
                </transition>
              </div>
        </ul>
    </nav>
</template>

<style scoped>
    #main-nav{
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 100;
    }
    #main-nav ul {
        display: flex;
        flex-flow: row nowrap;
        justify-content: flex-start;
        align-items: center;
        list-style: none;
        margin: 0;
        padding: 0 0 0 20%;
        position: relative;
        width: 80%;
    }
    #main-nav ul.sidemenu__list{
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        width: 100%;
        padding: 0 3vw;
        background: #fff;
        z-index: 10000;
        flex-direction: column;
    }
    @media only screen and (orientation: portrait) {
        #main-nav ul  {
            width: 100%;
            padding: 0 3vw;
        }

        #main-nav ul.sidemenu__list{
            padding-top: 14vw;
        }
    }
    #main-nav ul li {
        padding: 1.5em 0.5em;
    }
    #main-nav ul li:first-of-type {
        padding: 1em 0.5em;
        z-index: 100;
    }
    @media only screen and (orientation: portrait) {
        .main-item  {
           display: none;
        }

        #main-nav ul li:first-of-type {
            padding: 1em .5em 1em 0;
        }
    }
    #main-nav ul li a {
        position: relative;
        font-weight: bold;
        font-size: .9em;
        color: var(--scheme-color-text);
        margin: 0 1em;
        display: block;
        text-decoration: none;
        text-transform: uppercase;
        -webkit-transition: color 0.3s ease-in-out, opacity 0.3s ease-in-out;
        transition: color 0.3s ease-in-out, opacity 0.3s ease-in-out;
    }

    @media only screen and (orientation: portrait) {
        #main-nav ul li a {
            font-size: 3.2vw;
        }
    }

    #main-nav ul li.lang-block a{
        margin: 0 0.2em;
    }

    #main-nav.white ul li a {
        color: var(--scheme-color-bg);
    }
    #main-nav.white #sidemenu ul li a {
        color: var(--scheme-color-text);
    }

    #main-nav.white .logo{
        filter: brightness(0) invert(1);
    }

    #main-nav.scrolled.white .logo{
        filter: brightness(100%) invert(0);
    }

    #main-nav.scrolled.white ul li a {
        color: var(--scheme-color-text);
    }

    @media (orientation: portrait) {
        #main-nav.scrolled.white ul li a {
            color: var(--scheme-color-text);
        }
    }

    #main-nav ul li a::after{
        content: '';
        position: absolute;
        left: 0;
        bottom: 20%;
        opacity: 0;
        width: 100%;
        height: 100%;
        border-bottom: 1px solid #0071bc;
        -webkit-box-shadow: inset 0px -1px 0px 0px #0071bc;
        -moz-box-shadow: inset 0px -1px 0px 0px #0071bc;
        box-shadow: inset 0px -1px 0px 0px #0071bc;
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }
    @media only screen and (orientation: portrait) {
        #main-nav ul li a::after{
            display: none;
        }
    }

    #main-nav.white ul li a::after{
        border-bottom: 1px solid var(--scheme-color-bg);
    }

    #main-nav ul li a:hover::after{
        opacity: 1;
        bottom: 0;
    }
    #main-nav ul li a.router-link-active {
        opacity: .8;
    }
    #main-nav ul li a.logo-link.router-link-active{
        opacity: 1;
    }
    #main-nav ul li a.router-link-active::after {
        opacity: 0;
        bottom: 20%;
    }
    #main-nav ul li a.logo-link::after {
        opacity: 0;
        bottom: 20%;
    }    
    .logo-link{
        width: 6vw;
    }
    @media (orientation: portrait) {
        .logo-link{
            width: 17vw;
        }
        #main-nav ul li a.logo-link{
            margin: 0;
        }
    }
    .scrolled{
        background-color: #fff;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px;
    }

    .lang-block{
        display: flex;
        position: absolute;
        right: 0;
        z-index: 100;
    }

    @media (orientation: portrait) {
        #main-nav ul li.lang-block{
            padding: 0;
            right: 3vw;
        }
    }

    #sidemenu{
        display: none;
    }

    @media (orientation: portrait) {
        #sidemenu{
            display: block;
        }
    }

    #sidemenu nav {
        background: grey;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 99;
    }
    .sidemenu__btn{
        display: block;
        width: 10vw;
        height: 4.6vh;
        background: var(--scheme-color-text);
        border: none;
        position: relative;
        z-index: 100;
        appearance: none;
        cursor: pointer;
        outline: none;
    }

    .sidemenu__btn span{
        display: block;
        width: 6vw;
        height: 2px;
        margin: auto;
        background: white;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        transition: all .4s ease;
    }

    .sidemenu__btn .top{
        transform: translateY(-8px);
    }    
    .sidemenu__btn .bottom{
        transform: translateY(8px);
    }    
    .sidemenu__btn.active .top{
        transform: rotate(-45deg);
    }
    .sidemenu__btn.active .mid{
        transform: translateX(-20px) rotate(360deg);
        opacity: 0;
    }
    .sidemenu__btn.active .bottom{
        transform: rotate(45deg);
    }
    .sidemenu__btn.active 
    .sidemenu__wrapper{
        padding-top: 2em;
    }
    .sidemenu__item a{
        text-decoration: none;
        line-height: 1.6em;
        font-size: 1.6em;
        padding: .5em;
        display: block;
        color: white;
        transition: .4s ease;
    }

    .sidemenu__item a:hover{
        color: var(--scheme-color-text);
    }

    .translateX-enter{
        transform:translateX(-200px);
        opacity: 0;
    }
    
    .translateX-enter-active,.translateX-leave-active{
        transform-origin: top left 0;
        transition:.2s ease;
    }
    
    .translateX-leave-to{
        transform: translateX(-200px);
        opacity: 0;
    }

    #sidemenu ul li {
        padding: 0 .5em;
    }
    #sidemenu ul li:first-of-type {
        padding: 1.5em .5em 0;
    }
</style>