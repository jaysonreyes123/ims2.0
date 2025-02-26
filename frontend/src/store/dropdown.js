
import { defineStore } from "pinia"; 
import { useToast } from "vue-toastification";
const toast = useToast();
export const useDropdownStore = defineStore('dropdown', {
    state: () => {
        return {
            dropdownlist_data:[],
            dropdownlist:[],
            assigned_to:[],
            dropdownloading:[]
        }
    },
    getters:{
        dropdpwn_list(state){
            state.dropdownlist_data.map(item => {
                return{
                    label:item.label,
                    value:item.name
                }
           })
        }
    },
    actions: {
        async get_dropdown(field){
            try {
                this.dropdownloading[field] = true;
                const response = await this.axios.get("module/get_dropdown/"+field);
                this.dropdownlist[field] = response.data.data;
                this.dropdownloading[field] = false;
            } catch (error) {
                
            }
        },
        async get_dropdown_list(field){
            try {
                const response = await this.axios.get("module/get_dropdown/"+field);
                const data = response.data.data;
                data.map(item=>{
                    this.dropdownlist_data.push({label:item.label,value:item.name});
                })
            } catch (error) {
                
            }
        },
        async get_assigned_to(){
            try {
                const response = await this.axios.get("dropdown/assigned_to");
                this.assigned_to = response.data;
                
            } catch (error) {
                
            }
        }
    },
    persist: true,
})