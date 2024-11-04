import {defineStore} from "pinia"; 
import { ref } from "vue";
import { useToast } from "vue-toastification"; 
const toast = useToast(); 

export const useDatabaseStorebackup = defineStore("databasebackup",{
    state : ()=>{
        return {
           
            selectedTab:0,
            selectRow:0,
            loading:false,
            loading2:false,
            RgTableList1:[],
            WlTableList1:[],
            RgTableList2:[],
            WlTableList2:[],
            databaseForm:{
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
                this.databaseForm.column = [
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
                    {
                        label: 'Action',
                        field: 'action',
                    },
                ];

                this.databaseForm.column2 = [
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
                this.databaseForm.type = this.type[this.selectedTab];
            }
            else{
                this.databaseForm.column = [
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
                this.databaseForm.column2 = [
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
                ]
                this.databaseForm.type = this.type[this.selectedTab];
            }
       },
        async loadTable1(){
            try {
               this.loading = true;
               let response = await this.axios.post("/table/get_table_data",this.databaseForm);
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
               let response = await this.axios.post("/table/get_table_interval",{id:this.selectRow,type:this.databaseForm.type,column:this.databaseForm.column2,date:this.databaseForm.date});
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
        }
        
    },
    persist : true
})