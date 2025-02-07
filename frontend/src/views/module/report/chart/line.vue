<template lang="">
    <div>
      <apexchart
        ref="chart_line"
        type="line"
        :height="height"
        :options="chartConfiguration.chartOptions"
        :series="chartConfiguration.series"
      ></apexchart>
    </div>
</template>
<script>
import { stepLine } from "@/constant/appex-chart";
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
            report,
            stepLine
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
                    if(this.$refs.chart_line != null){
                        this.$refs.chart_line.updateOptions({
                            series:[{data:data.count}],
                            xaxis:{
                                categories:data.label
                            }
                        });
                    }
                },100)
                report.loading = false;

            } catch (error) {
                
            }
        }
    },
    computed:{
        chartConfiguration(){
            return {
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
                    stroke: {
                        curve: "stepline",
                    },
                    dataLabels: {
                        enabled: false,
                    },

                    markers: {
                        hover: {
                            sizeOffset: 4,
                        },
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