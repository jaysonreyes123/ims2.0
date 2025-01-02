import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useCallLogsStore = defineStore("call_logs",{
    state:()=>{
        return{
            loading:false,
            id:"",
            form:{
                assigned_to_picklist:"",
                date_and_time:"",
                time_answered:"",
                time_end:"",
                duration:"",
                from_no:"",
                to_no:"",
                call_id:""
            }
        }
    },
    actions:{
        clearField(){
            this.loading = true;
            const keys = Object.keys(this.form);
            keys.map(item=>{
                this.form[item] = "";
            })
            this.id = "";
            this.loading = false;
        },
        async list(){
            try {
                this.loading = true;
                const response = await this.axios.get('call_logs');
                this.ResourceList = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async getItem(){
            this.loading = true;
            const response = await this.axios.get('call_logs/'+this.id);
            const keys = Object.keys(this.form);
            const data = response.data.data;
            keys.map(item=>{
                this.form[item] = response.data.data[item];  
            })
            this.loading = false;
        },
        async save(){
            try {
                this.loading = true;
                if(this.id == ""){
                    const response = await this.axios.post("call_logs",this.form);
                    this.id = response.data.data.id;
                }
                else{
                    await this.axios.put("call_logs/"+this.id,this.form);
                }   
                this.loading = false;
                this.router.push({
                    name:"detail",
                    params:{
                        id:this.id,
                        module:"call_logs"
                    }
                });
            } catch (error) {
                
            }
        },
        async del(id){
            try {
                this.loading = true;
                const response = await this.axios.delete("call_logs/"+id);
                if(response.data.status == 200){
                    this.list();
                }
                this.loading = false;
            } catch (error) {
                
            }
        },
    },
    persist:true
})