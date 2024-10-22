<script setup lang="ts">
     import { useProductStore } from '@/stores/productStores'
     import router from '@/router'
     import { useRoute } from 'vue-router'
     import useApi from '@/use/useApi'

     // Stores
     const productStore = useProductStore()

    // Api composable
    const { isSelected } = useApi()

    // router
    const route = useRoute()

    // delete an object
    function delItem(idx: number){
        productStore.deleteItem(idx)
        productStore.isJoined[idx] = false

        isSelected()
    }
     
</script>
<template>
    <div 
    class="wishlist-icon"
    :class="[{'active': productStore.isWishShown}, {'wish-selected': productStore.isWishSelected}]"
    @click="productStore.isDrawerShown = true"
>
    <div class="wishlist-wrapper">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"> 
            <path d="M14.9997 13.982C16.6637 12.309 20.8247 15.236 14.9997 19C9.17474 15.236 13.3357 12.309 14.9997 13.982Z" fill="#3498DB"></path> 
            <path d="M15.7068 8.5C15.5193 8.31253 15.265 8.20721 14.9998 8.20721C14.7346 8.20721 14.4803 8.31253 14.2928 8.5L7.64579 15.146C7.55204 15.2399 7.49942 15.3672 7.49951 15.4999C7.49961 15.6325 7.5524 15.7597 7.64629 15.8535C7.74018 15.9473 7.86746 15.9999 8.00014 15.9998C8.13283 15.9997 8.26004 15.9469 8.35379 15.853L8.99979 15.207V20.5C8.99979 20.8978 9.15783 21.2794 9.43913 21.5607C9.72043 21.842 10.102 22 10.4998 22H19.4998C19.8976 22 20.2791 21.842 20.5605 21.5607C20.8418 21.2794 20.9998 20.8978 20.9998 20.5V15.207L21.6458 15.853C21.7395 15.9469 21.8668 15.9997 21.9994 15.9998C22.1321 15.9999 22.2594 15.9473 22.3533 15.8535C22.4472 15.7597 22.5 15.6325 22.5001 15.4999C22.5002 15.3672 22.4475 15.2399 22.3538 15.146L19.9998 12.793V9.5C19.9998 9.36739 19.9471 9.24022 19.8533 9.14645C19.7596 9.05268 19.6324 9 19.4998 9H18.4998C18.3672 9 18.24 9.05268 18.1462 9.14645C18.0525 9.24022 17.9998 9.36739 17.9998 9.5V10.793L15.7068 8.5ZM19.9998 14.207V20.5C19.9998 20.6326 19.9471 20.7598 19.8533 20.8536C19.7596 20.9473 19.6324 21 19.4998 21H10.4998C10.3672 21 10.24 20.9473 10.1462 20.8536C10.0525 20.7598 9.99979 20.6326 9.99979 20.5V14.207L14.9998 9.207L19.9998 14.207Z" fill="#3498DB"></path> 
        </svg> 
        <div class="wishlist-counter-js">{{ productStore.prodList.length }}</div>
    </div>          
</div>
    <n-drawer v-model:show="productStore.isDrawerShown" class="b-drawer">
        <n-drawer-content :title="`${$t('service_label.favourites')}`" closable>
            <div class="wl-wrapper">
                    <div 
                        v-for="(object, i) in productStore.prodList"
                        class="wl-item">
                            <div class="wl-img-wrap">
                                <img :src="object.img" 
                                     :alt="object.title"
                                >
                            </div>
                             <RouterLink 
                                @click="productStore.isDrawerShown = false"
                                :to="{ name: 'object', params: { slug: object.id } }" 
                                class="wl-title">
                                    {{ object.title }}
                            </RouterLink> 
                                <div class="wl-price">{{ object.price }} €</div>
                                <div class="close-but"
                                @click="delItem(object.id)"
                            >
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
                    </div>
            </div>    
        </n-drawer-content>
        </n-drawer>

</template>

