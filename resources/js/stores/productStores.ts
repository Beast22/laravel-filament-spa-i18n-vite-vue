import { defineStore } from 'pinia'

export type prodStoreType = {
    prodList: any[],
    isWishShown: boolean,
    isWishSelected: boolean,
    isDrawerShown: boolean,
    isJoined: {},
}

const getStoredProducts = () => {
    const storedProd = localStorage.getItem('products')
  
    return storedProd ? JSON.parse(storedProd) : []
}
const getJoinedProducts = () => {
    const storedHeart = localStorage.getItem('hearts')
  
    return storedHeart ? JSON.parse(storedHeart) : {}
}

export const useProductStore = defineStore('products', {
    // state
    state: () => ({
        prodList: getStoredProducts(),
        isJoined: getJoinedProducts(),
        isWishShown: localStorage.getItem('wish-icon') || false,
        isWishSelected: false,
        isDrawerShown: false,
    } as prodStoreType),

    // actions
    actions: {
        createNewItem(item: any) {
            if (!item) return

            this.prodList.push(item)

            const duplicates = this.prodList.filter((item, index) => this.prodList.indexOf(item) !== index)
            
            localStorage.setItem('products', JSON.stringify(this.prodList))
        },

        deleteItem(id: number) {
            const index = this.prodList.findIndex(_element => _element.id === id)
   
            if (index === -1) return
      
            this.prodList.splice(index, 1)

            localStorage.setItem('products', JSON.stringify(this.prodList))
        },
    },
    
})