import {defineStore} from "pinia"; 
import { ref } from "vue";
import { useToast } from "vue-toastification"; 
const toast = useToast(); 

export const useDashboardStore = defineStore("dashboard",{
    state : ()=>{
        return {
            loading:false,
            id:1,
            id2:1,
            widgetList:[],
            rgChartList:[],
            wlChartList:[],
            rgMap:[],
            wlMap:[],
            rgChartList2:[],
            wlChartList2:[],
            incident:[],
            notification:[],
            loading1:false,
            loading2:false,
            loading3:false,
            loading4:false,
            loading5:false,
            map:[],
            station:[],
            station_name:"",
            incident_id:0,
          
        }
    },  
    getters:{
        getWidgetList(state){
            return state.widgetList;
        },
    },
    actions:{
        async loadWidget(){
            try {
               let response = await this.axios.get("/widget");
               this.widgetList = response.data.data;
                
            } catch (err) {
                console.log("error",err)
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // })
            }
        },
        async loadIncident(){
            try {
              this.loading4 = true;
               let response = await this.axios.get("/incident");
               this.incident = response.data.data;
               this.loading4 = false;
               
             
                
            } catch (err) {
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // })
                console.log("error",err)
            }
        },
        async loadChart1(index){
            try {
                this.loading1 = true;
               let response = await this.axios.post("/chart/get_chart_data",{"type":this.type[index]});

               if(index == 0){
                this.rgChartList = response.data.data;
               }
               else if(index == 1){
                this.wlChartList = response.data.data;
               }  
               
               this.loading1 = false;
                
            } catch (err) {
                console.log(err);
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // })
                console.log("error",err)
            }
        },
        async loadChart2(index){
            try {
                
                this.loading2 = true;
               if(index == 0){
                
                let response = await this.axios.post("/chart/get_single_chart",{"type":this.type[index],id:this.id,minute:5,unit:"minute"});
                this.rgChartList2 = response.data.data;
             
               }
               else if(index == 1){
              
                let response = await this.axios.post("/chart/get_single_chart",{"type":this.type[index],id:this.id2,minute:5,unit:"minute"});
                this.wlChartList2 = response.data.data;
               
               }      
               this.loading2 = false;
                
            } catch (err) {
                console.log(err);
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // })
            }
        },
        // async loadMap(index){
        //     try {
        //         this.loading3 = true;
        //         let response = await this.axios.post("/map/get_map",{"type":this.type[index]});
 
        //         if(index == 0){
        //          this.rgMap = response.data.data;
        //         }
        //         else if(index == 1){
        //          this.wlMap = response.data.data;
        //         }
        //         this.loading3 = false;               
                 
        //      } catch (err) {
        //          console.log(err);
        //          toast.error("Error encountered, please try again!", {
        //              timeout: 3000,
        //          })
        //      }
        // },
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
        async loadStation(){
            try {  
                this.loading = true;
                let response = await this.axios.get('/station');       
                this.station = response.data.data;  
                this.station_name = response.data.data[0].name;
                this.loading = false;
         
            } catch (err) {  
               
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // }); 
                console.log("error",err)
            }  
        },
        async updateIncident(){
            try {  
           
                let response = await this.axios.post('/incidentStatus',{id:this.incident_id});       
         
            } catch (err) {  
               
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // }); 
                console.log("error",err)
            }  
        }
    },
    persist : true
})