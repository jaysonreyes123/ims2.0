import {defineStore} from "pinia"; 
import { ref } from "vue";
import { useToast } from "vue-toastification"; 
import { useEmailTemplate } from "@/store/email_template";
const email_template = useEmailTemplate();
const toast = useToast(); 

export const useNoficationStore = defineStore('notification',{
    state:() =>{
        return {
            moduleName:"Notification",
            action:"add",
            loading:false,
            modal:false,
            notificationList:[],
            email_template_id:0,
            notificationForm:{
                id : null,
                sensor_id : null,
                name:'',
                body:'',
                recipient: []

            }
        }
    },
    getters:{
        getNotificationList(state){
            return state.notificationList;
        }
    },
    actions:{
        openModal(){
            this.modal = true;
        },
        closeModal(){
            this.modal = false;
        },
        resetForm(){
            this.notificationForm.id = null;
            this.notificationForm.sensor_id = null;
            this.notificationForm.name = '';
            this.notificationForm.body = '';
            this.notificationForm.recipient = [];
            email_template.email_template_id = "";
        },
        async save(){
            try{
                this.loading = true;
                if(this.notificationForm.id){
                    await this.axios.put("/notification/"+this.notificationForm.id,this.notificationForm);
                }
                else{
                    await this.axios.post("/notification",this.notificationForm);
                }
                this.loading=false;
                this.resetForm();
                this.load();
                this.modal=false;
                toast.success("Successfully saved!",{
                    timeout : 3000
                })
            }
            catch (err) {
                this.modal = false;
                toast.error("Error encountered, please try again!", {
                    timeout: 3000,
                })
            }
        },
        async load(){
            try {
                this.loading =true;
                let response = await this.axios.get("/notification");
                this.notificationList = response.data.data;
                this.loading = false;
                this.resetForm();
            } catch (err) {
                this.modal = false;
                toast.error("Error encountered, please try again!", {
                    timeout: 3000,
                })
            }
        },
        async delete(id){
            try {
                this.loading = true;
                await this.axios.delete("/notification/"+id);
                this.loading = false;
                this.load();
                toast.success("Successfully deleted!", { timeout: 3000 });
            } catch (err) { 
                this.loading = false;
                toast.error(JSON.stringify(err.response.data.errors), {
                    timeout: 3000,
                }); 
            }
        }
    },
    persist : true
})