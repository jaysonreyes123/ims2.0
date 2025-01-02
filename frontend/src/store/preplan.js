import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const usePreplanStore = defineStore("preplan",{
    state:()=>{
        return{
            loading:false,
            id:"",
            pre_plan_classifications_picklist:[],
            incident_types_picklist:[],
            form:{
                pre_plan_name:"",
                incident_types_picklist:"",
                pre_plan_classifications_picklist:"",
                initial_assessment:"",
                response_action:"",
                classification:"",
                incident_manager:"",
                incident_responder:"",
                support_staff:"",
                tools_and_equipment:"",
                personnel:""
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
                const response = await this.axios.get('preplans');
                this.ResourceList = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async getItem(){
            this.loading = true;
            const response = await this.axios.get('preplans/'+this.id);
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
                    const response = await this.axios.post("preplans",this.form);
                    this.id = response.data.data.id;
                }
                else{
                    await this.axios.put("preplans/"+this.id,this.form);
                }   
                this.loading = false;
                this.router.push({
                    name:"detail",
                    params:{
                        id:this.id,
                        module:"preplans"
                    }
                });
            } catch (error) {
                
            }
        },
        async del(id){
            try {
                this.loading = true;
                const response = await this.axios.delete("preplans/"+id);
                if(response.data.status == 200){
                    this.list();
                }
                this.loading = false;
            } catch (error) {
                
            }
        },
        async get_preplan_classification(){
            try {
                const response = await this.axios.get("get_preplan_classification");
                this.pre_plan_classifications_picklist = response.data.data;
            } catch (error) {
                
            }
        },
        async get_incident_type(){
            try {
                const response = await this.axios.get("incident_type");
                this.incident_types_picklist = response.data.data;
            } catch (error) {
                
            }
        },
    },
    persist:true
})