import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useContactsStore = defineStore("contacts",{
    state:()=>{
        return{
            loading:false,
            id:"",
            caller_types_picklist:[],
            created_by_picklist:[],
            municipalities_picklist:[],
            barangays_picklist:[],
            form:{
                firstname:"",
                lastname:"",
                mobile:"",
                landline:"",
                email:"",
                date_of_birth:"",
                created_by:"",
                caller_types_picklist:"",
                created_by:"",
                municipalities_picklist:"",
                barangays_picklist:""

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
                const response = await this.axios.get('contacts');
                this.ResourceList = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async getItem(){
            this.loading = true;
            console.log("Test");
            const response = await this.axios.get('contacts/'+this.id);
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
                    const response = await this.axios.post("contacts",this.form);
                    this.id = response.data.data.id;
                }
                else{
                    await this.axios.put("contacts/"+this.id,this.form);
                }   
                this.loading = false;
                this.router.push({
                    name:"detail",
                    params:{
                        id:this.id,
                        module:"contacts"
                    }
                });
            } catch (error) {
                
            }
        },
        async del(id){
            try {
                this.loading = true;
                const response = await this.axios.delete("contacts/"+id);
                if(response.data.status == 200){
                    this.list();
                }
                this.loading = false;
            } catch (error) {
                
            }
        },

        async get_caller_types(){
            try {
                const response = await this.axios.get("caller_types");
                this.caller_types_picklist = response.data.data;
            } catch (error) {
                
            }
        },
        async get_municipalities(){
            try {
                const response = await this.axios.get("municipalities");
                this.municipalities_picklist = response.data.data;
            } catch (error) {
                
            }
        },
        async get_barangay(){
            try {
                const response = await this.axios.get("barangay");
                this.barangays_picklist = response.data.data;
            } catch (error) {
                
            }
        }
    },
    persist:true
})