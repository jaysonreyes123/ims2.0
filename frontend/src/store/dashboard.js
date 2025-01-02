import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useDashboardStore = defineStore("dashboard",{
    state:()=>{
        return{
            loading:false,
            id:"",
            incident_by_type_:[],
            incident_by_status_:[],
        }
    },
    actions:{
        async incident_by_type(){
            try {
                const response = await this.axios.get('dashboard/incident_by_type');
                this.incident_by_type_ = response.data.data;
                
            } catch (error) {
                
            }
        },
        async incident_by_status(){
            try {
                const response = await this.axios.get('dashboard/incident_by_status');
                this.incident_by_status_ = response.data.data;
                
            } catch (error) {
                
            }
        },
    },
    persist:true
})