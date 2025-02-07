<template lang="">
    <div>
            <apexchart
                ref="chart_pie"
                type="pie"
                :height="height"
                :options="ChartConfiguration.chartOptions"
                :series="ChartConfiguration.series"
            ></apexchart>
    </div>
</template>
<script>
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
                const response = await this.$axios.get("reports/get_chart/"+this.report_id);
                const data = response.data;
                setTimeout(()=>{
                    if(this.$refs.chart_pie != null){
                        this.$refs.chart_pie.updateOptions({
                            series:data.count,
                            labels:data.label
                        });
                    }
                },100)
            } catch (error) {
                
            }
        }
    },
    computed:{
        ChartConfiguration(){
            return{
                series: [],
                chartOptions: {
                    labels: [],
                    dataLabels: {
                    formatter: function (val, opts) {
                        return opts.w.config.series[opts.seriesIndex]
                    },
                    enabled: true,
                    },
                    responsive: [
                    {
                        breakpoint: 480,
                        options: {
                        legend: {
                            position: "bottom",
                        },
                        },
                    },
                    ],
                },
            }   
        }
    }
}
</script>
<style lang="">
    
</style>