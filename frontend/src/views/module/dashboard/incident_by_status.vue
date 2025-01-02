<template lang="">
    <div>
        <Skeleton v-if="loading"/>
        <Card>
          <div class="legend-ring">
            <apexchart
            v-if="!loading"
              ref="dashboard_chart"
              type="bar"
              :options="columnCharthomeComputed.chartOptions"
              :series="columnCharthomeComputed.series"
            />
          </div>
        </Card>
    </div>
</template>
<script>
import Skeleton from "@/components/Skeleton/Table.vue";
import Card from "@/components/Card";
import { useDashboardStore } from "@/store/dashboard";
import axiosIns from "@/plugins/axios";
const dashboard = useDashboardStore();
export default {
    components:{
        Card,
        Skeleton
    },
    data(){
        return{
            loading:true
        }
    },
    created(){
        dashboard.incident_by_type();
    },
    methods:{
         incident_by_type(){
           axiosIns.get('dashboard/incident_by_status')
           .then((response)=>{
                const result = response.data.data;
                this.loading = false;
                setTimeout(()=>{
                    this.$refs.dashboard_chart.updateOptions({
                    series:[result.series],
                    xaxis:{
                        categories:result.categories
                    }
                });
                },100)
           })
        }
    },
    mounted(){
        this.incident_by_type();
    },
    computed:{
    columnCharthomeComputed() {
      return {
        series: [],
        chartOptions: {
          chart: {
            toolbar: {
              show: false,
            },
          },
          plotOptions: {
            bar: {
              borderRadius: 4,
              borderRadiusApplication: 'end',
              horizontal: true,
              endingShape: "rounded",
              columnWidth: "45%",
              dataLabels: {
                position: 'top'
              }
            },
          },
          legend: {
            show: true,
            position: "top",
            horizontalAlign: "right",
            fontSize: "12px",
            fontFamily: "Inter",
            offsetY: -30,
            markers: {
              width: 8,
              height: 8,
              offsetY: -1,
              offsetX: -5,
              radius: 12,
            },
            labels: {
              colors: "#475569",
            },
            itemMargin: {
              horizontal: 18,
              vertical: 0,
            },
          },
          title: {
            text: "Incident By Type (Incidents)",
            align: "left",
            offsetX: this.$store.themeSettingsStore.direction ? "0%" : 0,
            offsetY: 13,
            floating: false,
            style: {
              fontSize: "20px",
              fontWeight: "500",
              fontFamily: "Inter",
              color: "#0f172a",
            },
          },
          dataLabels: {
            enabled: true,
            offsetX: 30
          },
          stroke: {
            show: true,
            width: 2,
            colors: ["transparent"],
          },
          yaxis: {
            opposite: this.$store.themeSettingsStore.direction ? true : false,
            labels: {
              style: {
                colors:"#475569",
                fontFamily: "Inter",
              },
            },
          },
          xaxis: {
            categories: [],
            labels: {
              style: {
                colors:"#475569",
                fontFamily: "Inter",
              },
            },
            axisBorder: {
              show: false,
            },
            axisTicks: {
              show: false,
            },
          },

          fill: {
            opacity: 1,
          },
          tooltip: {
            y: {
              formatter: function (val) {
                return val;
              },
            },
          },
         // colors: ["#4669FA", "#0CE7FA", "#FA916B"],
          grid: {
            show: true,
            borderColor: "#E2E8F0",
            strokeDashArray: 10,
            position: "back",
          },
          responsive: [
            {
              breakpoint: 600,
              options: {
                legend: {
                  position: "bottom",
                  offsetY: 8,
                  horizontalAlign: "center",
                },
                plotOptions: {
                  bar: {
                    columnWidth: "80%",
                  },
                },
              },
            },
          ],
        },
      };
    },
    }
}
</script>
<style lang="">
    
</style>