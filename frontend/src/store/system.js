import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useSystemStore = defineStore('system',{
    state:()=>{
        return{
            loading:false,
            logs:[],
            systemForm:{
                logo:"",
                site:""
            }
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
        async save(){
            try {
                if(this.systemForm.site == ""){
                    toast.error("Site title is required!", {
                        timeout: 3000,
                    });
                    return false;
                }
                if(this.systemForm.logo == ""){
                    toast.error("Logo is required!", {
                        timeout: 3000,
                    });
                    return false;
                }
                let response = await this.axios.post('/system',this.systemForm,{
                    headers:{
                        'Content-Type': 'multipart/form-data'
                    }
                });
                this.systemForm.logo = response.data.data[0].logo;
                this.systemForm.site = response.data.data[0].site;
                toast.success("Successfully saved!", {
                    timeout: 3000,
                });
            } catch (error) {
                console.log(error)
            }
        }
    },
    persist:true
})