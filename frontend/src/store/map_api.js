import { defineStore } from "pinia";
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useImportStore = defineStore('import',{
    state:()=>{
        return{
            
        }
    },
    getters:{

    },
    actions:{
    },
    persist:true
});