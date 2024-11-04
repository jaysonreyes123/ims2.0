import { defineStore } from "pinia";
import { useToast } from "vue-toastification";

const toast = useToast();

export const useEmailTemplate = defineStore("email_template",{
    state:()=>{
        return {
            moduleName:"Email Template",
            action:"add",
            loading:false,
            modal:false,
            emailTemplateList:[],
            email_template_id: 0,
            emailTemplateForm:{
                id:null,
                name:"",
                content:"",
                fields:[],
            }
        }   
    },
    getters:{
        getDropdown(state){
            return state.emailTemplateList.map(item =>{
                return {
                    label : item.name,
                    value: item.id
                }
            });
        },
        getSingleEmailTemplate(state){
            return state.emailTemplateList.find(item => item.id == this.email_template_id)
        }   
    },
    actions:{
        openModal() {
            this.modal = true;
        }, 
        closeModal(){
            this.modal = false;
        },
        resetForm(){
            this.emailTemplateForm.id = null;
            this.emailTemplateForm.name = "";
            this.emailTemplateForm.content = "";
            this.email_template_id =  "";
        },
        async load(){
            try {

                this.loading = true;
                let response = await this.axios.get("/email-template");
                this.emailTemplateList = response.data.data;
                this.loading = false;
                this.resetForm();
            } catch (err) {
                this.loading = false;
                toast.error("Error encountered, please try again!", {
                    timeout: 3000,
                }); 
            }
        },
        async save(){
            try {
                this.loading = true;
                if(this.emailTemplateForm.id != null){
                     await this.axios.put("/email-template/"+this.emailTemplateForm.id,this.emailTemplateForm);
                }
                else{
                     await this.axios.post("/email-template",this.emailTemplateForm);
                }
                
                this.loading = false;
                this.modal = false;
                this.load();
                toast.success("Successfully saved!", {
                    timeout: 3000,
                });
                
            } catch (err) {
                console.log(err.response.data.errors);
                this.loading = false;
                toast.error(JSON.stringify(err.response.data.errors), {
                    timeout: 3000,
                }); 
            }
        }
    },
    persist:true
})