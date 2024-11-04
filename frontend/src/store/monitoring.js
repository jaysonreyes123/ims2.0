import {defineStore} from "pinia"; 
import { ref } from "vue";
import { useToast } from "vue-toastification"; 

const toast = useToast(); 

export const useMonitoringStore = defineStore("monitoring",{
    state : ()=>{
        return {
           options:[],
           series:[],
            selectedTab:0,
            selectRow:0,
            loading:false,
            loading2:false,
            loading3:true,
            loading4:true,
            RgTableList1:[],
            WlTableList1:[],
            RgTableList2:[],
            WlTableList2:[],
            RgchartList:[],
            WlchartList:[],
            warning_list:[],
            monitoringForm:{
                column:[],
                column2:[],
                type:0,
                date:"",
            },
        }
    },  
    getters:{
    },
    actions:{
        getSelectedTab(){
            if(this.selectedTab == 0){
                this.monitoringForm.column = [
                    {
                        label: 'TIME',
                        field: 'time',
                    },
                    {
                        label: 'STATION ID',
                        field: 'id',
                    },
                    {
                        label: 'STATION NAME',
                        field: 'name',
                    },
                    {
                        label: 'RF 1HR [mm]',
                        field: '1_hr',
                    },
                    {
                        label: 'RF 24HRS [mm]',
                        field: '24_hrs',
                    },
                ];
                this.monitoringForm.column2 = [
                    {
                        label:'TIME',
                        field:'time',
                    },
                    {
                        label:'5 MINS',
                        field:'current',
                    },
                    {
                        label:'DAILY SUM',
                        field:'24_hrs',
                    },
                ];
                this.monitoringForm.type = this.type[this.selectedTab];
            }
            else{
                this.monitoringForm.column = [
                    {
                        label: 'TIME',
                        field: 'time',
                    },
                    {
                        label: 'STATION ID',
                        field: 'id',
                    },
                    {
                        label: 'STATION NAME',
                        field: 'name',
                    },
                    {
                        label: 'CURRENT [m]',
                        field: 'current',
                    },
                    {
                        label: 'Normal [m]',
                        field: 'normal',
                    },
                    {
                        label: 'ALERT [m]',
                        field: 'alert',
                    },
                    {
                        label: 'ALARM [m]',
                        field: 'alarm',
                    },
                    {
                        label: 'CRITICAL [m]',
                        field: 'critical',
                    },
                ];
                this.monitoringForm.column2 = [
                    {
                        label:'TIME',
                        field:'time',
                    },
                    {
                        label:'5 MINS',
                        field:'current',
                    },
                    {
                        label:'+/- CHANGES',
                        field:'24_hrs',
                    },
                ];
                this.monitoringForm.type = this.type[this.selectedTab];
            }
       },
        async loadTable1(){
            try {
                
               this.loading = true;
               let response = await this.axios.post("/table/get_table_data",this.monitoringForm);
        
               if(this.selectedTab == 0){
                    this.RgTableList1 = response.data.data;
                    
                    this.selectRow = this.RgTableList1.length > 0 ? this.RgTableList1[0].id : null;
                    setTimeout(()=>{
                        document.querySelector(".row-id"+this.RgTableList1[0].id).classList.add('row-active')
                    },1000)
               }
               else{
                    this.WlTableList1 = response.data.data;
                    this.selectRow = this.WlTableList1.length > 0 ? this.WlTableList1[0].id : null;
                    setTimeout(()=>{
                        document.querySelector(".row-id"+this.WlTableList1[0].id).classList.add('row-active')
                    },1000)
               }
               this.loading = false;
               this.loadChart();
               this.loadTable2();
                
            } catch (err) {
                console.log(err);
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // })
            }
        },
        async loadTable2(){
            try {
              this.loading2 = true;
               let response = await this.axios.post("/table/get_table_interval",{id:this.selectRow,type:this.monitoringForm.type,column:this.monitoringForm.column2,date:this.monitoringForm.date});
               if(this.selectedTab == 0){
                this.RgTableList2 = response.data.data;
               }
               else{
                this.WlTableList2 = response.data.data;
               }
               this.loading2 = false;
                
            } catch (err) {
                console.log(err);
                // toast.error("Error encountered, please try again!", {
                //     timeout: 3000,
                // })
            }
        },
        async loadChart(){
            try {
               
                if(this.selectedTab == 0){
                    this.loading3 = true;
                    let response = await this.axios.post("/chart/get_single_chart",{id:this.selectRow,type:this.monitoringForm.type,date:this.monitoringForm.date});
                    this.RgchartList = response.data.data;
                    this.loading3 = false;
                 }
                else{
                    this.loading4 = true;
                    let response = await this.axios.post("/chart/get_single_chart",{id:this.selectRow,type:this.monitoringForm.type,date:this.monitoringForm.date});
                    this.WlchartList = response.data.data;
                    this.loading4 = false;
                }
                
                  
              } catch (err) {
                  console.log(err);
                //   toast.error("Error encountered, please try again!", {
                //       timeout: 3000,
                //   })
              }
        },
        async loadWarningList(){
            try {
        
                   let response = await this.axios.get("/warning_list");
                    this.warning_list = response.data.data;
                    
                } catch (err) {
                    console.log(err);
                    // toast.error("Error encountered, please try again!", {
                    //     timeout: 3000,
                    // })
                }
        },
        
    },
    persist : true
})