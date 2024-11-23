import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useIncidentStore = defineStore("incident",{
    state:()=>{
        return{
            incidentList:[],
            incidentType:[],
            incidentStatus:[],
            incidentPriority:[],
            id:0,
            loading:true,
            form:{
                incident_no:"",
                incident_type:"",
                time_of_incident:null,
                date_of_incident:null,
                incident_status:"",
                incident_priority:"",
                remarks:"",
                location:"",
                street_name:"",
                nearest_landmark:"",
                coordinates:"",
                assigned_team:[],
                response_team:"",
                assigned_by:"",
                caller_contact:"",
                caller_firstname:"",
                caller_lastname:""
            }
        }
    },
    getters:{
        getIncidentType(state){
            return state.incidentType.map(item=>{
                return{
                    label:item.name,
                    value:item.id
                }
            })
        },
        getSingleIncidentType(state){
            return (incident_type_id) => state.incidentType.find((incident_type) => incident_type.id === incident_type_id)
        },

        getIncidentStatus(state){
            return state.incidentStatus.map(item=>{
                return{
                    label:item.name,
                    value:item.id
                }
            })
        },
        getSingleIncidentStatus(state){
            return (incident_status_id) => state.incidentStatus.find((incident_status) => incident_status.id === incident_status_id)
        },

        getIncidentPriority(state){
            return state.incidentPriority.map(item=>{
                return{
                    label:item.name,
                    value:item.id
                }
            })
        },
        getSingleIncidentStatus(state){
            return (incident_priority_id) => state.incidentPriority.find((incident_priority) => incident_priority.id === incident_priority_id)
        },
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
            keys.map(item=>{
                if(item == "assigned_team"){
                    this.form[item] = JSON.parse(data[item]); 
                }
                // else if(item == "time_of_incident"){
                //     if(data[item] != null){
                //         const parse_time = data[item].split(":");
                //         this.form[item] = {hours:parseInt(parse_time[0]),minutes:parseInt(parse_time[1]),seconds:parseInt(parse_time[2])}
                //     }
                //     else{
                //         this.form[item] = "";
                //     }
                // }
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
                this.incidentType = response.data.data;
            } catch (error) {
                
            }
        },
        async get_incident_status(){
            try {
                const response = await this.axios.get("incident_status");
                this.incidentStatus = response.data.data;
            } catch (error) {
                
            }
        },
        async get_incident_priority(){
            try {
                const response = await this.axios.get("incident_priority");
                this.incidentPriority = response.data.data;
            } catch (error) {
                
            }
        }
    },
    persist:true
})