
import { defineStore } from "pinia"; 
import { useToast } from "vue-toastification";
const toast = useToast();
export const useFilterStore = defineStore('filter', {
    state: () => {
        return {
            module:"",
            fields_list:[],
            filter_field:[
                {
                    field:"",
                    value:""
                },
            ]
        }
    },
    getters:{
        getDropdownFilter(state){
            return state.fields_list.map(item => {
                return {
                    label : item.label,
                    value: item.name,
                    type:item.type
                }
            })
    },
    },
    actions: {
        async get_fields(){
            try {
                const response = await this.axios.get("module/fields/"+this.module);
                this.fields_list = response.data.data;
           } catch (error) {
            
           }
        }
    },
    persist: true,
})