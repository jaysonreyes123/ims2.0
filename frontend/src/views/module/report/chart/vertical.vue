<template lang="">
    <div>
        <apexchart
            ref="chart"
            type="bar"
            :height="height"
            :options="ChartConfiguration.chartOptions"
            :series="ChartConfiguration.series"
        ></apexchart>
    </div>
</template>
<script>
import { basicBar } from '@/constant/appex-chart';
import { useReportStore } from '@/store/report';
const report = useReportStore();
export default {
    props:{
        report_id:{
            type:Number,
            default:0
        },
        height:String   
    },
    data(){
        return{
            basicBar,
            report
        }
    },
    mounted(){
        report.id = this.$route.params.id;
        this.get_chart();
    },
    methods:{
        async get_chart(){
            try {
                report.loading = true;
                const response = await this.$axios.get("reports/get_chart/"+this.report_id);
                const data = response.data;
                setTimeout(()=>{
                    this.$refs.chart.updateOptions({
                    series:[{data:data.count}],
                    xaxis:{
                        categories:data.label
                    }
                });
                },1000)
                report.loading = false;

            } catch (error) {
                
            }
        }
    },
    computed:{
        ChartConfiguration(){
            return{
                series: [
                    {
                        data: [],
                    },
                ],
                chartOptions: {
                    chart: {
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },

                    xaxis: {
                        categories: [],
                    },
                    colors: ["#4669FA"],
                },
            }
        }
    }
}
</script>
<style lang="">
    
</style>