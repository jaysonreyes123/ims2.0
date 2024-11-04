
import {defineStore} from "pinia"; 
import { useToast } from "vue-toastification";

const toast = useToast();

export const useSensorStore = defineStore('sensor',{
    state: ()=>{
        return { 
            loading: false,
            addmodal: false,
            titleModal: null, 
            sensorList: [],
            sensorTypeList:[],
            sensor_type: null,
            selectedTab: 0, 
            station_id : null
        }
    },
    getters:{
        getSensorList(state) {
            if(state.selectedTab === 0){
                return state.sensorList.filter(item => item.sensor_type == 1)    
            }else if(state.selectedTab === 1){
                return state.sensorList.filter(item => item.sensor_type == 2)    
            }else{
                return state.sensorList.filter(item => item.sensor_type != 1 && item.sensor_type != 2) 
            } 
        }, 
        getSensorDropDown(state){
                return state.sensorList.filter(item => item.station_id == state.station_id ).map(item => {
                    return {
                        label : item.sensor_description,
                        value: item.id
                    }
                })
        },
        getSensorDropDown2(state){
            return state.sensorList.filter(item => item.sensor_type != 3).map(item => {
                return {
                    label : item.station_name +" - "+ item.sensor_description,
                    value: item.id
                }
            })
    },
        getSelectedSensorType(state){
            return state.sensor_type;
        },
        getSelectedTab(state){
            return state.selectedTab;
        },
        getSensorType(state){
            return state.sensorTypeList.map(item =>{
                return{
                    label : item.name,
                    value : item.id
                }
            });
        }
    },
    actions:{ 
        openSensorAddModal(data) {
            this.titleModal = data.label;
            this.sensor_type = data.sensor_type;
            this.addmodal = true;
        },
        closeSensorAddModal() {
            this.addmodal = false;
            this.sensor_type = null;
        },
        setTabSelected(index){
            this.selectedTab = index;
            this.titleModal = this.selectedTab === 0 ? 'Add Rainfail Gauge' : 'Add Water Level';
        },
        async getSensorDetail(id){
            try {   
                let response = await this.axios.get('/sensor/'+ id);   
                this.addmodal = true;    
                console.log(response);    
            } catch (err) {   
                toast.error("Get Detail Error, please try again!", {
                    timeout: 3000,
                }); 
            }  
        },
        async loadSensorList(){
            try {  
                this.loading = true;
                let response = await this.axios.get('/sensor');       
                this.sensorList = response.data.data;   
                this.loading = false;
            } catch (err) {  
                this.loading = false;
                toast.error("Get Details Error, please try again!", {
                    timeout: 3000,
                }); 
            }  
        },
        async saveSensor(data){
            try {   
                this.loading = true;
                let response = await this.axios.post('/sensor', data);    
                this.addmodal = false;   
                this.loadSensorList(1);
            } catch (err) {  
                 this.loading = false;
                 toast.error("Save Sensor Error, please try again!", {
                    timeout: 3000,
                }); 
            } 
        },
        async loadSensorType(){
            try {   
                let response = await this.axios.get('/sensortype');    
                this.sensorTypeList = response.data.data;
            } catch (err) {  
                //  this.loading = false;
                //  toast.error("Save Sensor Error, please try again!", {
                //     timeout: 3000,
                // }); 
            } 
        }
    },
    persist: true, 
})