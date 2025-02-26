
import { defineStore } from "pinia"; 
import { useToast } from "vue-toastification";

const toast = useToast();
export const useDashboardStore = defineStore('dashboard', {
    state: () => {
        return {
            loading:false,
            widgets:[],
            chart:[],
            logs:[],
            logs_page:{
                current:1,
                total:0,
                last:false
            }
        }
    },
    getters: {
    },
    actions: {
        async system_logs(){
            try {
                this.loading = true;
                const response = await this.axios.get("dashboard/systemlogs?page="+this.logs_page.current);
                this.logs.push(...response.data.data);
                this.logs_page.current = response.data.meta.current_page;
                if(response.data.meta.current_page == response.data.meta.last_page){
                    this.logs_page.last = true;
                }
                this.loading = false;
            } catch (error) {
                
            }
        },
        async get_dashboard_report_chart(){
            try {
                this.loading = true;
                const response = await this.axios.get("dashboard/get_report_charts");
                this.chart = response.data.data;
                this.loading = false;
                
            } catch (error) {
                
            }
        },
        async get_widget(module,title,index,field = null,operator = null,value = null){
            try {
                this.widgets[index] = {loading:true};
                let url = "";
                if(field == null && operator == null && value == null){
                    url = "dashboard/widget/"+module;
                }
                else{
                    url = "dashboard/widget/"+module+"/"+field+"/"+operator+"/"+value;
                }
                const response = await this.axios.get(url);
                this.widgets[index] = {title:title,count:response.data.data}
                this.widgets[index].loading = false;
                
            } catch (error) {
                
            }
        }
    },
    persist: true,
})