<script setup lang="ts">
    import { onMounted } from 'vue'
    import useApi from '@/use/useApi'

    // Components
    import LoadingBlock from '@/components/LoadingBlock.vue'
    import ErrorBlock from '@/components/ErrorBlock.vue'

    // Api composable
    const { data, isLoading, isLoaded, errors, getApi, getImageUrl, getApiWithCache } = useApi()

    onMounted(() => {
        getApiWithCache('blog', 300)
    })

</script>  

<template>
    <div v-if="isLoading && !isLoaded">
        <LoadingBlock />
    </div>
    <div v-if="errors && !isLoading">
        <ErrorBlock>{{ errors }}</ErrorBlock>
    </div>

    <div class="header-block-blog">
        <h1>
            <span class="bold main-title">{{ $t('titles.blog_title') }}</span>
            {{ $t('titles.blog_subtitle') }}
        </h1>
    </div>
    <div class="block blog-block" id="blog">
        <h2>{{ $t('titles.blog') }}</h2>
        <div class="blog-inner">
            <div v-for="post in data" 
                 :key="post.id" 
                 class="blog-item">
                 
                <RouterLink :to="{name: 'blogpost', params: { slug: post.id }}" class="blog-link"> </RouterLink>
                    <img 
                        :src="getImageUrl(post.images.preview)" 
                        :alt="`post-${post.id}`" 
                        class="post-img"
                    >
                    <div class="blog-info">
                        <h3 class="blog-title">{{ post.title[$i18n.locale] }}</h3>
                        <div class="blog-text">{{ post.text[$i18n.locale].substring(0, 200) }}</div>
                        <div class="blog-date">{{ post.created_at }}</div>
                    </div>    
            </div>
        </div>
    </div>
</template>

<style scoped>

.header-block-blog{
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding-left: 20%;
    min-height: 30em;
    background: url('../../page-bg/blog-bg.jpg') no-repeat;
    background-size: cover;
    background-position: center;
    position: relative;
}

.header-block-blog:after{
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-image: -webkit-linear-gradient(top, rgba(0, 123, 205, 0.8), rgba(0, 123, 205, 0));
}

.header-block-blog h1{
    color: var(--scheme-color-bg);
    width: 13em;
    line-height: 1.5;
    position: relative;
    z-index: 1;
}
.blog-block h2{
    text-align: center;
}
.blog-inner{
    display: flex;
    flex-flow: row wrap;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5em;
    width: 60%;
    margin: 0 auto;
}

.blog-item {
    position: relative;
    flex: 0 0 32%;
    border-radius: 0.25rem;
    min-height: 23em;
    margin-bottom: 3em;
    cursor: pointer;
    text-align: center;
}
.blog-link{
    position: absolute;
    display: block;
    width: 100%;
    height: 100%;  
    text-decoration: none;
}
.post-img{
    width: 100%;
    min-height: 14em;
    margin-bottom: 1em;
    border-radius: 0.25rem;
}

.blog-info{
    text-align: left;
}

.blog-text{
    font-size: .9em;
    color: #000;
    margin-bottom: 1em;
}

.blog-date{
    display: inline-block;
    vertical-align: middle;
    margin-right: 1em;
    font-size: .7em;
    letter-spacing: 1px;
    color: rgba(0,0,0,.5);
}
</style>