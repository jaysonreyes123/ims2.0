<template>
    <div>
        <Breadcrumb />
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="lg:col-span-12 col-span-12">
                <Card>
                         <div class="grid grid-cols-12 gap-5 mb-5">

                                    <div class="lg:col-span-6 col-span-12">
                                        <TableSkeleton :count="5" v-if="warning.loading3" />
                                        <Map v-if="!warning.loading3" :map_="warning.map" />
                                        <!-- <RgStationCard :key="warning.warningRgMap" :rgmap_data="warning.warningRgMap" v-if="!warning.loading3"/> -->
                                    </div>

                                    <div class="lg:col-span-6 col-span-12">
                                        <Card bodyClass="p-0">
    
                                            <TableSkeleton :count="5" v-if="warning.loading2" />
                                            <vue-good-table v-if="!warning.loading2" :columns="columns" :rows="warning.getWarningListTable"
                                                styleClass="vgt-table table-head" :sort-options="{
                                                    enabled: false,
                                                }" >
                                                <template v-slot:table-row="props">
                                                    <span v-if="props.column.field == 'rg_status' ">
                                                        <Badge  :label="props.row.rg_status" :style="{background:props.row.color_1}" badgeClass="text-white" />
                                                        <!-- <span v-else>{{ props.row.rg_status }}</span> -->
                                                    </span>
                                                    <span v-if="props.column.field == 'wl_status'">
                                                            <Badge  :label="props.row.wl_status" :style="{background:props.row.color_2}" badgeClass="text-white" />
                                                            <!-- <span v-else>{{ props.row.wl_status }}</span> -->
                                                    </span>
                                                </template>
                                            </vue-good-table>
                                        </Card>
                                    </div>
                                </div>

                                <!-- <div class="grid grid-cols-12 gap-5"> 
                                    <div class="lg:col-span-6 col-span-12">
                                        <TableSkeleton :count="5" v-if="warning.loading4" />
                                        <WlStationCard :key="warning.warningWlMap" v-if="!warning.loading4" :wlmap_data="warning.warningWlMap" />
                                    </div> 
                                </div> -->
                     </Card>
            </div>
        </div>

    </div>
</template>
<script setup>

import { ref, computed,onMounted,getCurrentInstance } from "vue";
import Breadcrumb from "../../views/dashboard/component/breadcrumb";
import Card from "@/components/Card";
import TableSkeleton from "@/components/Skeleton/Table";
import Badge from "@/components/Badge";
import RgStationCard from "./components/rg_card.vue"
import WlStationCard from "./components/wl_card.vue"
import Map from "@/views/dashboard/component/mapboxComponent.vue";

import {useWarningStore} from "@/store/warning";

import { useDashboardStore } from "@/store/dashboard";

const warning = useWarningStore();
const dashboard = useDashboardStore();
const properties = getCurrentInstance().appContext.config.globalProperties
onMounted(()=>{
       // dashboard.loadNotification();
        warning.loadWarningTable();
   
   
        // warning.loadRgMap();

 
        // warning.loadWlMap();
        warning.loadMap();
    
        properties.rg_event.stopListening(".rg-event");
        properties.wl_event.stopListening(".wl-event");
        properties.single_event.stopListening(".single-chart-event");
        properties.incident_event.stopListening(".incident-event");
        properties.rgwl_event.stopListening(".rgwl-event");
       // properties.incident_event.stopListening(".notification-event");


    //     properties.incident_event.listen(".incident-event",(e)=>{
    //     warning.loadWarningTable();
    // })

   

    properties.notification_event.listen('.notification-event',(e)=>{
       // dashboard.loadNotification();
   })
   properties.rgwl_event.listen('.rgwl-event',(e)=>{
        warning.loadMap();
        warning.loadWarningTable();
   })
})

 // properties.rg_event.listen(".rg-event",(e)=>{
    //     warning.loadRgMap();
    // });
    // properties.wl_event.listen(".wl-event",(e)=>{
    //     warning.loadWlMap();
    // });


const columns = [
    {
        label: 'STATION ID',
        field: 'station_id',
    },
    {
        label: 'STATION NAME',
        field: 'station_name',
    },
    {
        label: 'Rainfall Status',
        field: 'rg_status',
    },
    {
        label: 'Water level Status',
        field: 'wl_status',
    },
];

// const newtable = computed(() => {
//     return basiTableData.value.filter(item => Boolean(item.id < 8));
// });
</script>
<style>
.marker{
    border: 2px solid white ;
    border-radius: 360px;
    
}
.table-popup, .table-popup td, .table-popup tr{
    border:1px solid #ccc;
    padding: 10px;
}
</style>
  