import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useSystemStore = defineStore('system',{
    state:()=>{
        return{
            loading:false,
            logs:[],
        }
    },
    getters:{

    },
    actions:{
        async activity_logs(modules,id){
            try {
                this.log = [];
                this.loading = true;
                const response = await this.axios.get('activity_logs/'+modules+"/"+id);
                this.logs = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        },
    },
    persist:true
})