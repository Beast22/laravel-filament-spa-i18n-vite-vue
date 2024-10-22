import { ref, unref} from 'vue'
import ky from 'ky'
import { useRoute } from 'vue-router'
import { useCacheResponseStore } from '@/stores/cacheResponseStore'
import { useCachePromiseStore } from '@/stores/cachePromiseStore'
import { useProductStore } from '@/stores/productStores'


const api = ky.extend({
    prefixUrl: '/api/'
});

export default function useApi(){

    const data : any = ref(false)
    const errors : any = ref(false)
    const isLoading = ref(false)
    const isLoaded = ref(false)

    // Request without cache
    const getApi = async (url : string) => {

        isLoading.value = true

        return new Promise(function (resolve, reject) {

            //Get data
            api.get(unref(url))
                .json()
                .then((newData : any) => {
                    data.value = newData.data
                    isLoading.value = false
                    isLoaded.value = true

                    resolve(newData.data)
                })
                .catch((err) => {
                    errors.value = err
                    isLoading.value = false
                    reject(err)
                })
            })

    }

    const getApiWithCache = async (url: string, seconds: number) =>{

        isLoading.value = true

        const cache = useCacheResponseStore()
        const promises = useCachePromiseStore()

        // Key for storages
         const cacheKey = unref(url)
         const cachedResponse = cache.getCachedResponse(cacheKey)

         if (!cachedResponse) {
            const cachedPromise = promises.getCachedPromise(cacheKey)
            if (cachedPromise !== false) {
                return cachedPromise
            }
        }

         const newPromise = new Promise(function(resolve, reject){

            if(cachedResponse){
                data.value = cachedResponse

                isLoading.value = false
                isLoaded.value = true

                resolve(cachedResponse)

            } else{
                api.get(unref(url))
                    .json()
                    .then( (newData: any) =>{
                        if (cacheKey !== undefined) {
                            cache.addCachedResponse(cacheKey, newData.data, seconds)
                        }

                        promises.removeCachedPromise(cacheKey)

                        data.value = newData.data
                        isLoading.value = false
                        isLoaded.value = true

                        resolve(newData.data)

                    })
                    .catch((err) => {
                        errors.value = err
                        isLoading.value = false
                        reject(err)
                    })
            }

         });

         if (!cachedResponse) {
            promises.addCachedPromise(cacheKey, newPromise)
        }
         return newPromise

    }

    // get absolute url
    function getImageUrl(name) {
        return new URL(name, import.meta.url).href
    }

    // select objects
    const isSelected = () =>{
        const productStore = useProductStore()

        if(productStore.prodList.length > 0){
            productStore.isWishShown = true
            localStorage.setItem('wish-icon', JSON.stringify(productStore.isWishShown))
        }
        else{
            productStore.isWishShown = false
            localStorage.setItem('wish-icon', JSON.stringify(productStore.isWishShown))
            productStore.isDrawerShown = false
        }
    }

    return {
        data,
        isLoading,
        isLoaded,
        errors,
        getApi,
        getImageUrl,
        isSelected,
        getApiWithCache,
    }

}
