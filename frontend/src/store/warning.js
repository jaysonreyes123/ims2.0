
import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
export const useWarningStore = defineStore('warning',{
    state: ()=>{
        return { 
            moduleName: "Warning", 
            loading: false, 
            loading2:false,
            loading3:false,
            loading4:false,
            modal: false,
            action: "Add",
        
            warningListData: [], 
            warningListTable:[],
            warningRgMap:[],
            warningWlMap:[],
            warningStatusList:[],
            map:[],
            warningForm: {
                id: null,
                station_id: null,
                sensor_id: null,
                sensor_thresholds: '',
                color: '' ,
                status:'',
                is_check:false,               
            }
        }
    },
    getters:{ 
        getWarningList(state){
            return state.warningListData;
        },
        getWarningListTable(state){
            return state.warningListTable;
        },
        getWarningStatusList(state){
            return state.warningStatusList.map(item =>{
                return{
                    label:item.name,
                    value:item.name
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
            this.warningForm.id = null; 
            this.warningForm.station_id = null; 
            this.warningForm.sensor_id = null; 
            this.warningForm.sensor_thresholds = ''; 
            this.warningForm.color = '#000000'; 
            this.warningForm.status = '';
            this.warningForm.is_check = false;
        },
        async delete(){
            this.loading = true;
            await this.axios.delete("/warning/"+this.warningForm.id);
            this.loading = false;
            this.load();
        },
        async save(){
            try {   
                this.loading = true;
                if(this.warningForm.id!=null){
                    await this.axios.put('/warning/' + this.warningForm.id, this.warningForm);    
                }else{
                    await this.axios.post('/warning', this.warningForm);    
                }                
                this.modal = false;   
                this.load();
                toast.success("Successfully saved!", {
                    timeout: 3000,
                }); 
            } catch (err) {  
                this.modal = false;  
                this.loading = false;
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // }); 
                console.log("error",err)
            } 
        },
        async load(){
            try {  
                this.loading = true;
                let response = await this.axios.get('/warning');       
                this.warningListData = response.data.data;   
                this.loading = false;
                this.resetForm();
            } catch (err) {  
                this.loading = false;
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // });
                console.log("error",err) 
            }  
        },
        async loadWarningTable(){
            try {  
                this.loading2 = true;
                let response = await this.axios.get('/table/get_table_for_warning');       
                this.warningListTable = response.data.data;   
                this.loading2 = false;

            } catch (err) {  
                this.loading2 = false;
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // }); 
                console.log("error",err)
            } 
        },
        async loadRgMap(){
            try {  
               this.loading3 = true;
                let response = await this.axios.post('/map/get_map',{type:"REG20000"});       
                this.warningRgMap = response.data.data;   
                this.loading3 = false;
           

            } catch (err) {  
                this.loading3 = false;
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // }); 
                console.log("error",err)
            } 
        },
        async loadWlMap(){
            try {  
                this.loading4 = true;
                let response = await this.axios.post('/map/get_map',{type:"REG20001"});       
                this.warningWlMap = response.data.data;   
                this.loading4 = false;
           

            } catch (err) {  
                this.loading4 = false;
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // }); 
                console.log("error",err)
            } 
        },
        async loadMap(){
            try {
                this.loading3 = true;
                let response = await this.axios.get("/map");
 
                this.map = response.data.data  
                this.loading3 = false;           
                 
             } catch (err) {
                 console.log(err);
                //  toast.error("Error encountered, please try again!", {
                //      timeout: 3000,
                //  })
             }
        },
        async loadWarningSensorStatus(){
            try {
                let response = await this.axios.get("/show_sensor/"+this.warningForm.sensor_id);
                this.warningStatusList = response.data.data;  
                console.log(response.data.data)
                 
             } catch (err) {
                 console.log(err);
                //  toast.error("Error encountered, please try again!", {
                //      timeout: 3000,
                //  })
             }
        },
    },
    persist: true, 
})