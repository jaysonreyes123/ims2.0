import {defineStore} from "pinia"; 
import { ref } from "vue";
import { useToast } from "vue-toastification"; 
import moment from 'moment'
const toast = useToast(); 
const today = moment().format('YYYY-MM-DD');
export const useDatabaseStore = defineStore("database",{
    state:()=>{
        return{
            databaseForm:{
                station:"",
                date1:"",
                date2:"",
            },
            loading:false,
            rg_list:[],
            wl_list:[],
            rg_series:[],
            wl_series:[],
            rg_option:[],
            wl_option:[]
        }
    },
    getters:{},
    actions:{
        async loadTable(){
            try {
                this.loading = true;
                let response = await this.axios.post("/table/historical_table",this.databaseForm);
                this.rg_list = response.data.data.rg;
                this.wl_list = response.data.data.wl;
                this.rg_series = response.data.data.rg_series;
                this.rg_option = response.data.data.rg_option;

                this.wl_series = response.data.data.wl_series;
                this.wl_option = response.data.data.wl_option;
                this.loading = false;
                this.historicalChart('rgchart',response.data.data.rg_series,response.data.data.rg_option,['#008ffb'])
                this.historicalChart('wlchart',response.data.data.wl_option.series,response.data.data.wl_option.categories,response.data.data.wl_option.colors)
                
            } catch (error) {
                
            }
        },
        historicalChart(chartid,series,categories,colors){
            if(categories.length > 0){
                ApexCharts.exec(chartid,"updateOptions",{
                    series:series,
                    colors:colors,
                    xaxis: {
                        categories:categories
                    }
                })
            }
            else{
                ApexCharts.exec(chartid,"updateOptions",{
                    series:[],
                    colors:colors,
                    xaxis: {
                        categories:[today]
                    }
                })
            }
        }
    },
    persist:true
})