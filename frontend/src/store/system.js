import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useSystemStore = defineStore('system',{
    state:()=>{
        return{
            loading:false,
            current_page:1,
            last_page:0,
            is_last_page:false,
            logs:[],
        }
    },
    getters:{

    },
    actions:{
        async activity_logs(modules,id){
            try {
                this.loading = true;
                const response = await this.axios.get('activity_logs/'+modules+"/"+id+"?page="+this.current_page);
                this.logs.push(...response.data.data);
                this.last_page = response.data.meta.last_page;
                if(this.current_page < this.last_page){
                    this.is_last_page = false;
                }
                else{
                    this.is_last_page = true;
                }
                this.loading = false;
            } catch (error) {
                
            }
        },
    },
    persist:true
})