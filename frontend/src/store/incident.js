import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useIncidentStore = defineStore("incident",{
    state:()=>{
        return{
            incidentList:[],
            incident_types_picklist:[],
            incident_statuses_picklist:[],
            incident_priorities_picklist:[],
            id:0,
            loading:true,
            form:{
                incident_no:"",
                incident_types_picklist:"",
                incident_statuses_picklist:"",
                incident_priorities_picklist:"",
                time_of_incident:null,
                date_of_incident:null,
                remarks:"",
                location:"",
                street_name:"",
                nearest_landmark:"",
                incident_resolution:"",
                coordinates:"",
                assigned_team:[],
                response_team:"",
                assigned_by:"",
                caller_contact:"",
                caller_firstname:"",
                caller_lastname:""
            },
            data:[]
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
                const response = await this.axios.get('incidents');
                this.incidentList = response.data.data;
                this.loading = false;
            } catch (error) {
                
            }
        },
        async getItem(){
            this.loading = true;
            const response = await this.axios.get('incidents/'+this.id);
            const keys = Object.keys(this.form);
            const data = response.data.data;
            this.data = data;
            keys.map(item=>{
                if(item == "assigned_team"){
                    this.form[item] = JSON.parse(data[item]); 
                }
                else{
                    this.form[item] = response.data.data[item]; 
                }   
            })
            this.loading = false;
        },
        async save(){
            try {
                this.loading = true;
                if(this.id == ""){
                    const response = await this.axios.post("incidents",this.form);
                    this.id = response.data.data.id;
                }
                else{
                    await this.axios.put("incidents/"+this.id,this.form);
                }   
                this.loading = false;
                this.router.push({
                    name:"detail",
                    params:{
                        id:this.id,
                        module:"incidents"
                    }
                });
            } catch (error) {
                
            }
        },
        async del(id){
            try {
                this.loading = true;
                const response = await this.axios.delete("incidents/"+id);
                if(response.data.status == 200){
                    this.list();
                }
                this.loading = false;
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
        async get_incident_status(){
            try {
                const response = await this.axios.get("incident_status");
                this.incident_statuses_picklist = response.data.data;
            } catch (error) {
                
            }
        },
        async get_incident_priority(){
            try {
                const response = await this.axios.get("incident_priority");
                this.incident_priorities_picklist = response.data.data;
            } catch (error) {
                
            }
        },
        async generate_id(modules){
            try {   
                this.loading = true;
                const response = await this.axios.get('generate/id/'+modules);
                this.form.incident_no =  response.data;
                this.loading = false;
            } catch (error) {
                
            }
        }
    },
    persist:true
})