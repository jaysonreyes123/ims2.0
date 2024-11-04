
import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useStationStore = defineStore('station',{
    state: ()=>{
        return { 
            moduleName: "Station", 
            loading: false, 
            modal: false,
            action: "Add",
            stationListData: [], 
            stationForm: {
                id: null,
                code:"",
                name: "",
                coordinates: "",
                location: "",
                river_bed :0,
                water_surface:0,
                status:0,
            }
        }
    },
    getters:{ 
        getStationList(state){
            return state.stationListData;
        },
        getDropdown(state){
            return state.stationListData.map(item =>{
                return {
                    label : item.name,
                    value: item.id
                }
            });
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
            this.stationForm.id = null;
            this.stationForm.name = "";
            this.stationForm.coordinates = "";
            this.stationForm.location = "";
            this.stationForm.river_bed = 0;
            this.stationForm.water_surface = 0;
            this.stationForm.code = "";
            this.stationForm.status = 0;
        },
        async save(){
            try {    
                    this.loading = true;
                    if(this.stationForm.id){
                        await this.axios.put('/station/' + this.stationForm.id, this.stationForm);    
                    }else{
                        await this.axios.post('/station', this.stationForm);    
                    }                
                    this.modal = false;   
                    this.load();
                    toast.success("Successfully saved!", {
                        timeout: 3000,
                    });
                //} 
            } catch (err) {  
                this.modal = false;  
                this.loading = false;
                toast.error("Error encountered, please try again!", {
                    timeout: 3000,
                }); 
            } 
        },
        async load(){
            try {  
                this.loading = true;
                let response = await this.axios.get('/station');       
                this.stationListData = response.data.data;   
                this.loading = false;
                this.resetForm();
            } catch (err) {  
                this.loading = false;
                toast.error("Error encountered, please try again!", {
                    timeout: 3000,
                }); 
            }  
        },
        async deleteStation(id){
            try {
                this.loading = true;
                await this.axios.delete("/station/"+id);
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
    persist: true, 
})