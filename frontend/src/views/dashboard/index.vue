<template>
    <div>
        <Breadcrumb />
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="lg:col-span-12 col-span-12">
                <div class="grid xl:grid-cols-6 lg:grid-cols-2 col-span-1 gap-3" >
                    <div v-for="(item,index) in getWidgetList " v-bind:key="index">
                        <Widget :title="item.title" :count="item.count" :date="item.date" :widget_id="index" />
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-7">
            <div class="lg:col-span-1 col-span-3">
                <TableSkeleton :count="5" v-if="loading" />
                <Card  v-if="!loading">
                    <!-- <p class="mb-5 mt-5 text-xs text-slate-900 dark:text-white  font-bold">Selected:  {{ station_name }}</p> -->
                    <vue-good-table  max-height="610px" :row-style-class="rowStyleClassFn"   @row-click="rowClick" :row-click="rowClick" v-if="!loading" :columns="columns" :rows="station"
                                                styleClass="vgt-table table-header" :sort-options="{
                                                    enabled: false,
                                                }" :pagination-options="{
                                                 enabled: true,
                                                perPage: perpage, }" >
                            <template #pagination-bottom="props">
                                <div class="py-4 px-3 justify-center flex">
                                    <Pagination :total="station.length" :current="current" :per-page="perpage"
                                        :pageRange="pageRange" @page-changed="current = $event" :pageChanged="props.pageChanged"
                                        :perPageChanged="props.perPageChanged" />
                                    </div>
                            </template>    
                    </vue-good-table>
                </Card>
            </div>
            <div class="lg:col-span-2 col-span-3">
                <TableSkeleton :count="5" v-if="loading2" />
                    <div class="flex-wrap" v-if="!loading2">
                        <div class="flex-1 mb-5">
                            <Card title="Rain Fall Last 24 hrs [mm]" :subtitle="station_name">
                                <apexchart  type="line"  height="290"  :options="rg_option" :series="series" />
                            </Card>
                        </div>
                        <div class="flex">
                            <div class="flex-1">
                            <Card title="Water Level Last 24 hrs [m]" :subtitle="station_name">
                                <apexchart ref="wlchart" type="line"  height="290"  :options="wl_option" :series="series"   />
                            </Card>
                        </div>
                        </div>
                    </div>
            </div>
            <div class="lg:col-span-3 col-span-3">
                <TableSkeleton :count="5" v-if="loadingMap" />
                <Map v-if="!loadingMap" :map_data="map" />
                <!-- <Map v-if="!dashboard.loading3" :key="dashboard.map" :map_data="dashboard.map" /> -->
            </div>
            <!-- <div class="lg:col-span-1 col-span-3">
                <TableSkeleton :count="5" v-if="loadingIncident" />
                <Card title="Latest Alarms" v-if="!loadingIncident" style="height: 820px;">
                    <div v-if="notification.length > 0">
                        <div class="block overflow-y-auto" style="max-height: 740px;">
                                <div class="divide-y divide-slate-100 dark:divide-slate-700 ">
                                    <div class="block w-full p-2" v-for="(item,i) in notification" :key="i">
                                        <div class="flex" >
                                        <div class="flex space-x-3 mr-3 justify-center items-center" style="height: 30px;background: white;border-radius: 50%;">
                                            <embed v-if="item.sensor_type == 1" width="32px" type="image/svg+xml"  :src="rainfall" />
                                            <embed v-if="item.sensor_type == 2" width="32px" type="image/svg+xml" :src="waterlevel" />
                                            </div>
                                            <div>
                                                <span class="block text-slate-800 dark:text-slate-300 text-sm font-medium mb-[2px]">
                                                {{ item.station_name }}
                                            </span>
                                            <span class="block text-slate-500 text-xs ">
                                                <p>Status : <Badge
                                                    :label="item.status"
                                                    badgeClass="bg-opacity-[0.12] text-white"
                                                    :style="{'background':item.color}"
                                                    />
                                                </p>
                                            </span>
                                            <span class="block text-slate-500 text-xs ">
                                                Value : {{ item.value }} <span v-if="item.sensor_type == 1">mm</span> <span v-else-if="item.sensor_type==2">m</span> 
                                            </span>
                                            <span class="block text-slate-500 text-xs ">
                                                As of {{ item.time }}
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <span class="block text-slate-800 dark:text-slate-300 text-lg font-medium mb-[2px] mt-5 text-center">
                                <div class="divide-y divide-slate-100 dark:divide-slate-700">
                                <div class="flex p-5" >
                                        <div class="flex space-x-3 justify-center items-center">
                                            <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1.3em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify iconify--heroicons-outline mr-2 text-[25px] mr-2"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z"></path></svg>
                                        </div>
                                            <div class="text-left">
                                                <span class="block text-slate-800 dark:text-slate-300 text-lg font-medium mb-[2px]">
                                                    No Data
                                            </span>
                                            </div>
                                    </div> 
                            
                                    </div> 
                            </span>
                        </div>
                </Card>
            </div> -->
        </div>
    </div>
</template>
<script>
import Breadcrumb from "./component/breadcrumb"; 
import axiosIns from "@/plugins/axios";
import Widget from "./component/widget.vue";
import TableSkeleton from "@/components/Skeleton/Table";
import Card from "@/components/Card/index";
import Pagination from "@/components/Pagination";
import Badge from "@/components/Badge";
// import mapboxComponentVue from './component/mapboxComponent.vue';
import Map from './component/map.vue';
import rainfall from "@/assets/images/svg/rainfall.svg";
import waterlevel from "@/assets/images/svg/waterlevel.svg";
import Swal from 'sweetalert2';
const columns=[{label: 'Station',field: 'name'}]
const type = ["REG20000","REG20001"];
const current = 1;
const perpage = 10;
const pageRange = 10;
const series = [{name:"no data",data:[0]}]
const wl_option = {
    "colors": [
        "#09b350"
    ],
    "chart": {
        id:"wlchart",
        "toolbar": {
            "show": false
        }
    },
    "dataLabels": {
        "enabled": false
    },
    "stroke": {
        "curve": "smooth",
        "width": [
            2
        ]
    },
    "yaxis": {
        "min": 0,
        "tickAmount": "5.0",
        "max": 50,
        "labels": {
            "style": {
                "colors": "#727372",
                "fontFamily": "Inter",
                "fontSize": "14px"
            }
        }
    },
    "grid": {
        "show": true,
        "borderColor": "#334155",
        "strokeDashArray": 10,
        "position": "back"
    },
    "xaxis": {
        "type": "datetime",
        "categories": [],
        "labels": {
            "style": {
                "colors": "#727372",
                "fontFamily": "Inter",
                "fontSize": "14px"
            },
            "datetimeUTC": false,
            "datetimeFormatter": {
                "year": "yyyy",
                "month": "yyyy-MM",
                "day": "MM-dd",
                "hour": "H:mm",
                "minute": "H:mm"
            }
        },
        "axisBorder": {
            "show": false
        },
        "axisTicks": {
            "show": false
        }
    },
    "legend": {
        "labels": {
            "colors": "#CBD5E1"
        },
        "fontFamily": "Inter"
    },
    "tooltip": {
        "x": {
            "format": "yyyy-dd-MM HH:mm:00"
        },
        "shared": true
    }
};
const rg_option = {
    "colors": [
        "#09b350",
        "#008ffb"
    ],
    "chart": {
        id:"rgchart",
        "toolbar": {
            "show": false
        }
    },
    "dataLabels": {
        "enabled": false
    },
    "stroke": {
        "curve": "smooth",
        "width": [
            2
        ]
    },
    "yaxis": {
        "min": 0,
        "tickAmount": "10.0",
        "max": 600,
        "labels": {
            "style": {
                "colors": "#727372",
                "fontFamily": "Inter",
                "fontSize": "14px"
            }
        }
    },
    "grid": {
        "show": true,
        "borderColor": "#334155",
        "strokeDashArray": 10,
        "position": "back"
    },
    "xaxis": {
        "type": "datetime",
        "categories": [],
        "labels": {
            "style": {
                "colors": "#727372",
                "fontFamily": "Inter",
                "fontSize": "14px"
            },
            "datetimeUTC": false,
            "datetimeFormatter": {
                "year": "yyyy",
                "month": "yyyy-MM",
                "day": "MM-dd",
            }
        },
        "axisBorder": {
            "show": false
        },
        "axisTicks": {
            "show": false
        }
    },
    "legend": {
        "labels": {
            "colors": "#CBD5E1"
        },
        "fontFamily": "Inter"
    },
    "tooltip": {
        "x": {
            "format": "yyyy-dd-MM HH:mm:00"
        },
        "shared": true
    }
};
   export default{
    components:{
        Breadcrumb,
        Widget,
        TableSkeleton,
        Card,
        Pagination,
        Badge,
        // mapboxComponentVue,
        Map

    },
    data(){
        return{
            id:1,
            loading:true,
            loading2:true,
            loadingIncident:true,
            loadingMap:true,
            station_name:"",
            current,
            perpage,
            pageRange,
            columns,
            wl_option,
            rg_option,
            series,
            getWidgetList:[],
            station:[],
            wlChartList2:[],
            incident:[],
            notification:[],
            map:[],
            rainfall,
            waterlevel
        }
    },
    methods:{
        loadWidget(){
            axiosIns.get("/widget")
            .then(response => this.getWidgetList= response.data.data)
        },
        loadStation(){
            axiosIns.get('/station')
            .then(response => {
                this.station_name = response.data.data[0].name;
                this.id = response.data.data[0].id;
                this.station = response.data.data;
                this.loading = false;
                setTimeout(() => {
                    document.querySelector(".row-id"+this.id).classList.add('row-active') 
                }, 1000);
            })
            .catch(error => {
            //    const err =  error.response.data;
            //     if(err.status == 400 && err.message == 'Unauthorized.'){
            //         Swal.fire({
            //             title: 'You have been logged out',
            //             text: 'Your account has been logged in another device. Please click okay to login again.',
            //             icon: 'error',
            //             confirmButtonText: 'Okay',
            //             allowOutsideClick: false
            //         })
            //         .then(()=>{
            //             location.href="/";
            //         })
            //     }
                
            })
        },
        loadApexChart(type_id){
            axiosIns.post("/chart/get_single_chart",{"type":type[type_id],id:this.id,minute:5,unit:"minute",date:"last24"})
            .then((response) => {
                this.wlChartList2 = response.data.data;
                var series_ = response.data.data.series;
                var option_ = response.data.data.option;
                console.log(option_)
                var chart_id = type_id == 0 ? 'rgchart' : 'wlchart';
                this.loading2 = false;
                this.chartUpdate(chart_id,series_,option_)
            })
        },
        loadIncident(){
            axiosIns.get("/incident")
            .then((response) => {
                this.incident = response.data.data;
                this.loadingIncident = false;
            })
        },
        loadNotification(){
            axiosIns.get("/alert_notification")
            .then((response) => {
                this.notification = response.data.data;
            })
        },
        loadMap(){
            axiosIns.get("/map")
            .then((response) => {
                this.map = response.data.data;
                this.loadingMap = false;
            })
        },
        chartUpdate(chart_id,series_,option_){

            window.setTimeout(function(){
                ApexCharts.exec(chart_id,"updateOptions",{
                series:series_,
                colors:option_.colors,
                yaxis:{
                    tickAmount:option_.yaxis.tickAmount,
                    max:option_.yaxis.max
                },
                xaxis: {
                    categories:option_.xaxis.categories
                }
            },false, true);
            },1000)
        },
        rowClick(event){  
            const current = document.querySelectorAll(".row-active");
            if(current !== null){
                for(var a = 0;a < current.length; a++){
                    current[a].classList.remove('row-active');
                }
            }
            document.querySelector(".row-id"+event.row.id).classList.add('row-active');
           this.station_name = event.row.name;
           this.id = event.row.id;
           this.loadApexChart(0);
           this.loadApexChart(1);
        },
        rowStyleClassFn(row){
            return 'row-id'+row.id;
        }
    },
    beforeMount(){
        this.notification_event.stopListening('.notification-event');
        this.rg_event.stopListening('.rg-event');
        this.wl_event.stopListening('.wl-event');
        this.single_event.stopListening('.single-chart-event');
        this.incident_event.stopListening('.incident-event');
        this.rgwl_event.stopListening('.rgwl-event')
    },
    mounted() {
        
      this.loadApexChart(0);
      this.loadApexChart(1);
      this.loadWidget();
      this.loadStation();  
    //   this.loadIncident();   
    //   this.loadNotification();
      this.loadMap();
      this.single_event.listen(".single-chart-event",(e)=>{
        if(e.wl !== undefined){
            if(e.wl[this.id] == true){
                this.loadApexChart(1);
            }
        }
        if(e.rg !== undefined){
            if(e.rg[this.id] == true){
                this.loadApexChart(0);
            }
        }
      })

    //   this.notification_event.listen('.notification-event',(e)=>{
    //     this.loadNotification();
    //   })

    //   this.incident_event.listen(".incident-event",(e)=>{
    //     this.incident = e[0];
    //     document.getElementById("widget1").innerHTML = e.length >= 0 ? e[0].length : 0 ;
    //     document.getElementById("date1").innerHTML = e.length >= 0 ? `as of ${e[1]}` : 'a' ;
    //   })


    },
   }
</script>
<style>
    /* #vgt-table > thead{
        display: none !important;
    } */
    .table-header  thead  th  span{
        font-size: 25px !important;
     }
    .row-active{
    background: #c0eef7b6 !important;
}
</style>