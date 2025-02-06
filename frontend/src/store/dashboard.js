
import { defineStore } from "pinia"; 
import { useToast } from "vue-toastification";

const toast = useToast();
export const useDashboardStore = defineStore('dashboard', {
    state: () => {
        return {
            loading:false,
            chart:[]
        }
    },
    getters: {
    },
    actions: {
        async get_dashboard_report_chart(){
            try {
                this.loading = true;
                const response = await this.axios.get("dashboard/get_report_charts");
                this.chart = response.data.data;
                this.loading = false;
                
            } catch (error) {
                
            }
        }
    },
    persist: true,
})