import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useAgencyStore = defineStore("agency",{
    state:()=>{
        return{
            loading:false,
            id:"",
            municipalities_picklist:[],
            barangays_picklist:[],
            form:{
                agency_name:"",
                contact_no_1:"",
                contact_no_2:"",
                email:"",
                contact_person:"",
                assigned_to_picklist:"",
                municipalities_picklist:"",
                barangays_picklist:"",
                street_name:"",

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
                const response = await this.axios.get('agencies');
                this.ResourceList = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async getItem(){
            this.loading = true;
            const response = await this.axios.get('agencies/'+this.id);
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
                    const response = await this.axios.post("agencies",this.form);
                    this.id = response.data.data.id;
                }
                else{
                    await this.axios.put("agencies/"+this.id,this.form);
                }   
                this.loading = false;
                this.router.push({
                    name:"detail",
                    params:{
                        id:this.id,
                        module:"agencies"
                    }
                });
            } catch (error) {
                
            }
        },
        async del(id){
            try {
                this.loading = true;
                const response = await this.axios.delete("agencies/"+id);
                if(response.data.status == 200){
                    this.list();
                }
                this.loading = false;
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