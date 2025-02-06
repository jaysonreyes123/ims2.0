<template lang="">
    <div>
        <div class="flex mb-8">
            <span class="capitalize font-bold text-2xl">dashboard</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div v-for="(item,index) in dashboard_store.chart">
                <chart height="200px" :title="item.report_name" :report_id="item.id" :chart_type="item.report_charts.chart" />
            </div>
        </div>
    </div>
</template>
<script>
import { useDashboardStore } from '@/store/dashboard';
import chart from '../report/chart/chart.vue';
const dashboard_store = useDashboardStore();
export default {
    components:{
        chart
    },
    mounted(){
        dashboard_store.get_dashboard_report_chart();
    },
    data(){
        return{
            dashboard_store
        }
    }
}
</script>
<style lang="">
    
</style>