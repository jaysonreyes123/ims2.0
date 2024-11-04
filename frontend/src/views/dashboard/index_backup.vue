<template>
    <div>
        <Breadcrumb />
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="lg:col-span-12 col-span-12">
                <div class="grid xl:grid-cols-4 lg:grid-cols-2 col-span-1 gap-3" >
                    <div v-for="(item,index) in dashboard.getWidgetList " v-bind:key="index">
                        <Widget :title="item.title" :count="item.count" :date="item.date" :widget_id="index" />
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-6 gap-7">
            <div class="lg:col-span-1 col-span-3">
                <TableSkeleton :count="5" v-if="dashboard.loading" />
                <Card title="Station" v-if="!dashboard.loading">
                    <p class="mb-5 mt-5 text-xs text-slate-900 dark:text-white  font-bold">Selected:  {{ dashboard.station_name }}</p>
                    <vue-good-table max-height="610px"  @row-click="rowClick" :row-click="rowClick" v-if="!dashboard.loading" :columns="columns" :rows="dashboard.station"
                                                styleClass="vgt-table table-head" :sort-options="{
                                                    enabled: false,
                                                }" :pagination-options="{
                                                 enabled: true,
                                                perPage: perpage, }" >
                            <template #pagination-bottom="props">
                                <div class="py-4 px-3 justify-center flex">
                                    <Pagination :total="dashboard.station.length" :current="current" :per-page="perpage"
                                        :pageRange="pageRange" @page-changed="current = $event" :pageChanged="props.pageChanged"
                                        :perPageChanged="props.perPageChanged" />
                                    </div>
                            </template>    
                    </vue-good-table>
                </Card>
            </div>
            <div class="lg:col-span-2 col-span-3">
                <TableSkeleton :count="5" v-if="dashboard.loading2" />
                    <div class="flex-wrap" v-if="!dashboard.loading2">
                        <div class="flex-1 mb-5">
                            <Card title="Rain Fall Last 24 hrs [mm]">
                                <apexchart v-if="dashboard.rgChartList2.hasOwnProperty('series')" :key="rgmap2" type="area"  height="290"  :options="dashboard.rgChartList2.option" :series="dashboard.rgChartList2.series" />
                            </Card>
                        </div>
                        <div class="flex">
                            <div class="flex-1">
                            <Card title="Water Level Last 24 hrs [m]">
                                <apexchart v-if="dashboard.wlChartList2.hasOwnProperty('series')" :key="wlmap2" type="line"  height="290"  :options="dashboard.wlChartList2.option" :series="dashboard.wlChartList2.series" />
                            </Card>
                        </div>
                        </div>
                    </div>
            </div>
            <div class="lg:col-span-2 col-span-3">
                <TableSkeleton :count="5" v-if="dashboard.loading3" />
                <Map v-if="!dashboard.loading3" :key="dashboard.map" :map_data="dashboard.map" />
            </div>
            <div class="lg:col-span-1 col-span-3">
                <TableSkeleton :count="5" v-if="dashboard.loading4" />
                <Card title="Latest Alarms" v-if="!dashboard.loading4" style="height: 820px;">
                    <div v-if="dashboard.incident.length > 0">
                        <div class="block overflow-y-auto" style="max-height: 740px;">
                                <div class="divide-y divide-slate-100 dark:divide-slate-700 ">
                                    <div class="block w-full p-2" v-for="(item,i) in dashboard.incident" :key="i">
                                        <div class="flex" >
                                        <div class="flex space-x-3 mr-3 justify-center items-center" style="height: 30px;background: white;border-radius: 50%;">
                                            <!-- <svg  :style="{color:item.color}" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1.3em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify iconify--heroicons-outline mr-2 text-[20px] mr-2"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z"></path></svg>
                                            -->
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
            </div>
        </div>
    </div>
</template>
<script setup>

const rgmap1 = ref('rgmap1');
const rgmap2 = ref('rgmap2');
const wlmap1 = ref('wlmap1');
const wlmap2 = ref('wlmap2');

const station_name = ref();

const columns = [
    {
        label: 'Station',
        field: 'name',
    },
];

const current = ref(1);
const perpage = ref(10);
const pageRange = ref(10);

import TableSkeleton from "@/components/Skeleton/Table";
import Pagination from "@/components/Pagination";
import Card from "@/components/Card/index";
import rgStationCard from "./component/rg-station-card.vue";
import wlStationCard from "./component/wl-station-card.vue";
import Map from "./component/map.vue";
import Badge from "@/components/Badge";
import Widget from "./component/widget.vue";
import Breadcrumb from "./component/breadcrumb"; 

import vSelect from "@/components/Select/index";
import Icon from "@/components/Icon";
import "vue-select/dist/vue-select.css";
import {useDashboardStore} from "@/store/dashboard";
import {useStationStore} from "@/store/station";

import rainfall from "@/assets/images/svg/rainfall.svg";
import waterlevel from "@/assets/images/svg/waterlevel.svg";
const dashboard = useDashboardStore();
const properties = getCurrentInstance().appContext.config.globalProperties

import { onMounted, ref,getCurrentInstance } from "vue";


let rgchangeChart2 = ()=>{

    dashboard.loadChart2(0);
}

let wlchangeChart2 = ()=>{

dashboard.loadChart2(1);
}

function rowClick(event){   
        dashboard.id = event.row.id;
        dashboard.id2 = event.row.id;
        dashboard.wlChartList2 = [];
        dashboard.rgChartList2 = [];
        console.log(event.row.name)
        dashboard.station_name = event.row.name;
        dashboard.loadChart2(0);
        dashboard.loadChart2(1);
}

onMounted(()=>{

        //24 hour
        dashboard.id =1;
        dashboard.id2 =1;

        dashboard.loadNotification();
            dashboard.loadStation();

            dashboard.loadChart2(0);
        
        
            dashboard.loadChart2(1);

            dashboard.loadMap();
        
            dashboard.loadIncident();
            
            dashboard.loadWidget();
});




properties.rg_event.stopListening(".rg-event");
properties.wl_event.stopListening(".wl-event");
properties.single_event.stopListening(".single-chart-event");
properties.incident_event.stopListening(".incident-event");
properties.notification_event.stopListening(".notification-event");
properties.rgwl_event.stopListening(".rgwl-event");



properties.single_event.listen('.single-chart-event',(e)=>{
            console.log(e)
                if(e.rg[dashboard.id] == true){
                        dashboard.loadChart2(0);
                }
                if(e.wl[dashboard.id2] == true){
                        dashboard.loadChart2(1);
                }
});

properties.incident_event.listen(".incident-event",(e)=>{

    dashboard.incident = e[0];
    document.getElementById("widget1").innerHTML = e.length >= 0 ? e[0].length : 0 ;
    document.getElementById("date1").innerHTML = e.length >= 0 ? `as of ${e[1]}` : 'a' ;
})

properties.notification_event.listen('.notification-event',(e)=>{
        dashboard.loadNotification();
})
properties.rgwl_event.listen('.rgwl-event',(e)=>{
        dashboard.loadMap();
})


// properties.rg_event.listen('.rg-event',(e)=>{
//            load_rg();
//            console.log("load rg")
// });

// properties.wl_event.listen('.wl-event',(e)=>{
//             load_wl();
//            console.log("load wl")
// });
// function load_rg(){
//     dashboard.loadChart1(0);
//     dashboard.loadMap(0);
// }
// function load_wl(){
//     dashboard.loadChart1(1);
//     dashboard.loadMap(1);
// }

</script>
<style>
.marker{
    border: 2px solid white;
    border-radius: 360px;
}
.table-popup, .table-popup td, .table-popup tr{
    border:1px solid #ccc;
    padding: 10px;
}
</style>
  