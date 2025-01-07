import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useResponderStore = defineStore("responder",{
    state:()=>{
        return{
            loading:false,
            id:"",
            responder_types_picklist:[],
            responder_statuses_picklist:[],
            data:[],
            form:{
                responder_types_picklist:"",
                responder_statuses_picklist:"",
                assigned_to_picklist:"",
                firstname:"",
                lastname:"",
                contact_no:"",
                email_address:"",
                password:"",
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
                const response = await this.axios.get('responders');
                this.ResourceList = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async getItem(){
            this.loading = true;
            const response = await this.axios.get('responders/'+this.id);
            const keys = Object.keys(this.form);
            const data = response.data.data;
            keys.map(item=>{
                this.form[item] = response.data.data[item];  
            })
            this.data = data;
            this.loading = false;
        },
        async save(){
            try {
                this.loading = true;
                if(this.id == ""){
                    const response = await this.axios.post("responders",this.form);
                    this.id = response.data.data.id;
                }
                else{
                    await this.axios.put("responders/"+this.id,this.form);
                }   
                this.loading = false;
                this.router.push({
                    name:"detail",
                    params:{
                        id:this.id,
                        module:"responders"
                    }
                });
            } catch (error) {
                
            }
        },
        async del(id){
            try {
                this.loading = true;
                const response = await this.axios.delete("responders/"+id);
                if(response.data.status == 200){
                    this.list();
                }
                this.loading = false;
            } catch (error) {
                
            }
        },
        async get_responder_type(){
            try {
                const response = await this.axios.get("responder_type");
                this.responder_types_picklist = response.data.data;
            } catch (error) {
                
            }
        },
    },
    persist:true
})