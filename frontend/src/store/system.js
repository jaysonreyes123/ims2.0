import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
import { useModuleStore } from "./module";
const module_store = useModuleStore();
const toast = useToast(); 
export const useSystemStore = defineStore('system',{
    state:()=>{
        return{
            loading:false,
            current_page:1,
            last_page:0,
            is_last_page:false,
            notification_current_page:1,
            logs:[],
            notifications:[],
            login_history:{
                logs:[],
                current:1,
                total:0,
                perpage:0,
                last:false
            }
        }
    },
    getters:{

    },
    actions:{
        async login_history_logs(){
            try {
                this.loading = true;
                const response = await this.axios.get("system/login_history?page="+this.login_history.current);
                const data = response.data;
                this.login_history.logs = data.data;
                this.login_history.current = data.meta.current_page;
                this.login_history.total = data.meta.total;
                this.login_history.perpage = data.meta.per_page;
                if(data.meta.total >= data.meta.current_page){
                    this.login_history.last = true;
                }
                this.loading = false;
                
            } catch (error) {
                
            }
        },
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
        async notification(){
            try {
                this.loading = true;
                const response = await this.axios.get('module/notification/get?page='+this.notification_current_page);
                this.notifications = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async notification_read(itemid,id,module,status){
            if(status == 1){
               const response = await this.axios.get("module/notification/read/"+itemid);
               this.notifications = response.data.data;
            }
            this.router.push(
                {
                    name:'view',
                    params:{
                        module:module,
                        id:id,
                        action:'detail'
                    }
                }
            )
        }
    },
    persist:true
})