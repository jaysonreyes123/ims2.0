import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useIncidentStore = defineStore("incident",{
    state:()=>{
        return{
            form:{
                incident_id:"",
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
                phone:""
            }
        }
    }
})