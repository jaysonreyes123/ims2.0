import { defineStore } from "pinia";
import Swal from 'sweetalert2';
export const useUserStore = defineStore('users',{
    state:()=>{
        return{
            id:"",
            loading:false,
            data:[]
        }
    },
    getters:{
    },
    actions:{
        async get_data(){
            try {
                this.loading = true;
                const response = await this.axios.get("users/"+this.id);
                this.data = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        }
    },
    persist:true
})