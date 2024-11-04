import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 

export const useRecipientStore = defineStore('recipient',{
    state:()=>{
        return{
            moduleName:'recipient',
            loading:true,
            modal:false,
            action:"Add",
            recipientList:[],
            recipientForm:{
                id:null,
                name:'',
                emails:[],
                mobile_nos:[],
                notify:[]
            },
            inputsEmail: [{ value: '' }],
            inputsMobile: [{ value: '' }]
        }
    },
    getters:{
        getRecipientList(state){
            return state.recipientList;
        },
        getDropdown(state){
            return state.recipientList.map(item => {
                return {
                    label : item.name,
                    value : item.id
                }
            });
        },
        getNotifyList(){
            return [
                { label:"email",value:"email" },
                { label:"sms",value:"sms" },
            ]
        },
        getEmail(state){
            return state.emails.map(item =>{

            })
        },
        getMobile(){

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
            this.recipientForm.id = null;
            this.recipientForm.name = '';
            this.recipientForm.emails = null;
            this.recipientForm.mobile_nos = null;
            this.recipientForm.notify = null;
        },
        async save(){
            try {
                this.loading = true;
                if(this.recipientForm.id){
                    await this.axios.put("/recipient/"+this.recipientForm.id,this.recipientForm);
                }
                else{
                    await this.axios.post("/recipient",this.recipientForm);
                }
                this.modal = false;
                this.load();
                toast.success("Successfully saved!",{
                    timeout : 3000
                })
            } catch (err) {
                this.modal = false;
                toast.error("Error encountered, please try again!", {
                    timeout: 3000,
                })
            }
        },
        async load(){
            try {
                this.loading = true;
                let response = await this.axios.get("/recipient");
                this.recipientList = response.data.data;
                this.loading = false;
                this.modal = false;
                this.resetForm();
            } catch (err) {
                this.modal = false;
                toast.error("Error encountered, please try again!", {
                    timeout: 3000,
                })
            }
        },
        async deleteRecipient(id){
            try {
                this.loading = true;
                await this.axios.delete("/recipient/"+id);
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
});