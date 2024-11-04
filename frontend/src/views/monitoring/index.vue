<template>
    <div>
        <Breadcrumb />
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="lg:col-span-12 col-span-12">
                <Card>
                    <TabGroup @change="tabChange">
                        <TabList class="lg:space-x-8 md:space-x-4 space-x-0 rtl:space-x-reverse">
                            <Tab v-slot="{ selected }" as="template">
                                <button :class="[
                                    selected
                                        ? 'text-primary-500 before:w-full'
                                        : 'text-slate-500 before:w-0 dark:text-slate-300',
                                ]"
                                    class="text-sm font-medium mb-7 capitalize bg-white dark:bg-slate-800 ring-0 foucs:ring-0 focus:outline-none px-2 transition duration-150 before:transition-all before:duration-150 relative before:absolute before:left-1/2 before:bottom-[-6px] before:h-[1.5px] before:bg-primary-500 before:-translate-x-1/2">
                                    Rainfall Gauge
                                </button>
                            </Tab>

                            <Tab v-slot="{ selected }" as="template">
                                <button :class="[
                                    selected
                                        ? 'text-primary-500 before:w-full'
                                        : 'text-slate-500 before:w-0 dark:text-slate-300',
                                ]"
                                    class="text-sm font-medium mb-7 capitalize bg-white dark:bg-slate-800 ring-0 foucs:ring-0 focus:outline-none px-2 transition duration-150 before:transition-all before:duration-150 relative before:absolute before:left-1/2 before:bottom-[-6px] before:h-[1.5px] before:bg-primary-500 before:-translate-x-1/2">
                                    Water Level
                                </button>
                            </Tab>
                        </TabList>
                        <TabPanels>
                            <div class="flex justify-between flex-wrap items-center mb-4">
                                        <div>
                                            <flat-pickr @change="dateChange" v-model="monitoring.monitoringForm.date"  class="form-control" id="d1"
                                                placeholder="yyyy, dd M" />
                                        </div>
                                        <div
                                            class="flex sm:space-x-4 space-x-2 sm:justify-end items-center md:mb-6 mb-4 rtl:space-x-reverse">
                                            <Dropdown classMenuItems=" w-[180px] top-[38px] ">
                                        <div class="flex items-center">
                                        <div
                                            class="flex-none text-slate-600 dark:text-white text-sm font-normal items-center lg:flex hidden overflow-hidden text-ellipsis whitespace-nowrap">
                                            <span class="overflow-hidden text-ellipsis whitespace-nowrap w-[50px] block">Export</span>
                                            <span class="text-base inline-block ltr:ml-[10px] rtl:mr-[10px]">
                                            <Icon icon="heroicons-outline:chevron-down"></Icon>
                                            </span>
                                        </div>
                                        </div>
                                        <template #menus>
                                            <MenuItem v-slot="{ active }" v-for="(item, i) in ExportMenu" :key="i">
                                            <div type="button" :class="`${active
                                                ? 'bg-slate-100 dark:bg-slate-700 dark:bg-opacity-70 text-slate-900 dark:text-slate-300'
                                                : 'text-slate-600 dark:text-slate-300'
                                                } `"
                                                class="inline-flex items-center space-x-2 rtl:space-x-reverse w-full px-4 py-2 first:rounded-t last:rounded-b font-normal cursor-pointer"
                                                @click="item.link()">
                                                <div class="flex-none text-lg">
                                                </div>
                                                <div class="flex-1 text-sm">
                                                {{ item.label }}
                                                </div>
                                            </div>
                                            </MenuItem>
                                        </template>
                                    </Dropdown>
                                    </div>
                                </div>
                            <TabPanel> 
                                <div class="grid grid-cols-12 gap-5 mb-5">

                                    <div class="lg:col-span-8 col-span-12">
                                        <TableSkeleton :count="5" v-if="monitoring.loading" height="350" />
                                        <vue-good-table :row-style-class="rowStyleClassFn" v-if="!monitoring.loading" @row-click="rowClick" :row-click="rowClick"  :columns="monitoring.monitoringForm.column" :rows="monitoring.RgTableList1"
                                            styleClass="vgt-table table-head" :sort-options="{
                                                enabled: false,
                                            }" />
                                            <TableSkeleton :count="5" v-if="monitoring.loading3" height="350" />
                                            <apexchart v-if="!monitoring.loading3 && monitoring.RgchartList.hasOwnProperty('series')" class="mt-5" type="line" height="350" :options="monitoring.RgchartList.option" :series="monitoring.RgchartList.series"></apexchart>
                                    </div>

                                    <div class="lg:col-span-4 col-span-12">
                                        <TableSkeleton :count="5" v-if="monitoring.loading2" height="350" />
                                        <vue-good-table :fixed-header="true" v-if="!monitoring.loading2" max-height="670px" :columns="monitoring.monitoringForm.column2" :rows="monitoring.RgTableList2"
                                            styleClass="vgt-table table-head" :sort-options="{
                                                enabled: false,
                                            }" />
                                    </div>
                                </div>
                            </TabPanel>
                            <TabPanel>
                                <div class="grid grid-cols-12 gap-5 mb-5">

                                    <div class="lg:col-span-8 col-span-12">
                                        <TableSkeleton :count="5" v-if="monitoring.loading" height="350" />
                                        <vue-good-table :row-style-class="rowStyleClassFn" v-if="!monitoring.loading" @row-click="rowClick" :row-click="rowClick"  :columns="monitoring.monitoringForm.column" :rows="monitoring.WlTableList1"
                                            styleClass="vgt-table table-head" :sort-options="{
                                                enabled: false,
                                            }" >
                                                <template v-slot:table-row="props" >
                                                    <span v-if="props.column.field == 'critical'">
                                                        <span v-if="props.row.current >= props.row.critical " >
                                                            <span class="px-2 py-2 rounded text-white" :style="{'background': search_value(props.row.sensor_id,props.column.field) }">
                                                                {{ props.row.critical  }} 
                                                            </span>
                                                        </span>
                                                        <span v-else>
                                                            {{ props.row.critical}}
                                                        </span>
                                                    </span>
                                                    <span v-if="props.column.field == 'alarm'">
                                                        <span v-if="props.row.current >= props.row.alarm && props.row.current < props.row.critical " >
                                                            <span class="px-2 py-2 rounded text-white" :style="{'background': search_value(props.row.sensor_id,props.column.field) }">
                                                                {{ props.row.alarm  }}
                                                            </span>
                                                        </span>
                                                        <span v-else>
                                                            {{ props.row.alarm}}
                                                        </span>
                                                    </span>
                                                    <span v-if="props.column.field == 'alert'">
                                                        <span v-if="props.row.current >= props.row.alert && props.row.current < props.row.alarm " >
                                                            <span class="px-2 py-2 rounded text-white" :style="{'background': search_value(props.row.sensor_id,props.column.field) }">
                                                                {{ props.row.alert  }}
                                                            </span>
                                                        </span>
                                                        <span v-else>
                                                            {{ props.row.alert}}
                                                        </span>
                                                    </span>
                                                </template>
                                            </vue-good-table>
                                            <TableSkeleton :count="5" v-if="monitoring.loading4" height="350" />
                                            <apexchart v-if="!monitoring.loading4 && monitoring.WlchartList.hasOwnProperty('series')" class="mt-5" type="line" height="350" :options="monitoring.WlchartList.option" :series="monitoring.WlchartList.series"></apexchart>
                                    </div>

                                    <div class="lg:col-span-4 col-span-12">
                                        <TableSkeleton :count="5" v-if="monitoring.loading2" height="350" />
                                        <vue-good-table :fixed-header="true" v-if="!monitoring.loading2" max-height="670px" :columns="monitoring.monitoringForm.column2" :rows="monitoring.WlTableList2"
                                            styleClass="vgt-table table-head" :sort-options="{
                                                enabled: false,
                                            }" />
                                    </div>
                                </div>
                            </TabPanel>
                        </TabPanels>
                    </TabGroup>
                </Card>
            </div>
        </div>

    </div>
</template>
<script setup>
import { ref, computed,onMounted,getCurrentInstance } from "vue";
import Breadcrumb from "../../views/dashboard/component/breadcrumb";
import Icon from "@/components/Icon";
import Button from '@/components/Button';
import Dropdown from '@/components/Dropdown';
import { MenuItem } from "@headlessui/vue";
import Card from "@/components/Card";
import SelectMonth from "../../views/home/Analytics-Component/SelectMonth";
import Map from "../../views/home/Analytics-Component/Map";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import InputGroup from "@/components/InputGroup";
import TableSkeleton from "@/components/Skeleton/Table";
import { useMonitoringStore } from "@/store/monitoring";
import {useDashboardStore} from "@/store/dashboard";
const properties = getCurrentInstance().appContext.config.globalProperties

import {
    spalineArea,
    spalineAreaDark,
    ChartMinotiring
} from "../../constant/appex-chart.js";


const ExportMenu = [
  {
    label: "csv",
    link : ()=>{
        export_csv()
    }
  },

  {
    label: "xlsx",
    link : ()=>{
        export_excel()
    }
  },
];


const date = new Date();
const month = date.getMonth()+1 >= 10 ? date.getMonth()+1 : "0"+(date.getMonth()+1);
const day = date.getDate()+1 >= 10 ? date.getDate() : "0"+date.getDate();
const currentdate = `${date.getFullYear()}-${month}-${day}`;

function dateChange(){
    monitoring.getSelectedTab();
    // monitoring.loadTable2();   
    // monitoring.loadChart();
    monitoring.loadTable1();
}
const host = window.location.hostname;
const port = host == "localhost" ? "8000" : "8082";
function export_csv(){
    const id = monitoring.selectRow;
    const type = monitoring.monitoringForm.type;
    const date = monitoring.monitoringForm.date;
    location.href =  "http://"+host+":"+port+"/api/export/csv/"+id+"/"+type+"/"+date+"/csv";
}

function export_excel(){
    const id = monitoring.selectRow;
    const type = monitoring.monitoringForm.type;
    const date = monitoring.monitoringForm.date;
    location.href =  "http://"+host+":"+port+"/api/export/csv/"+id+"/"+type+"/"+date+"/csv";
}

const monitoring = useMonitoringStore();
const dashboard = useDashboardStore();
monitoring.series = ChartMinotiring.series;
monitoring.options = ChartMinotiring.chartOptions;

function tabChange(index){
    monitoring.loading3 = true;
    monitoring.loading2 = true;
    monitoring.loading4 = true;
    monitoring.selectedTab = index;
    monitoring.WlchartList = [];
    monitoring.RgchartList = [];
    monitoring.getSelectedTab();
   
    monitoring.loadTable1();

}

function rowClick(event){

    monitoring.selectRow = event.row.id;
    monitoring.loadTable2();   
    monitoring.loadChart();

    const current = document.querySelectorAll(".row-active");
    if(current !== null){
        for(var a = 0;a < current.length; a++){
            current[a].classList.remove('row-active');
        }
    }
    document.querySelector(".row-id"+event.row.id).classList.add('row-active');
}
function rowStyleClassFn(row){
    return 'row-id'+row.id;
}

function search_value(sensor_id,value){

    if( monitoring.warning_list[sensor_id] !== undefined ){
        for(var a = 0; a < monitoring.warning_list[sensor_id].length; a++){
        if(monitoring.warning_list[sensor_id][a].status == value ){
            return monitoring.warning_list[sensor_id][a].color;
        }
      }
    }
  
}
onMounted(()=>{
        dashboard.loadNotification();
        monitoring.loading3 = true;
        monitoring.loading2 = true;
        monitoring.selectedTab = 0;
        monitoring.monitoringForm.date = currentdate;
 
        monitoring.getSelectedTab();
        monitoring.loadWarningList();
        monitoring.loadTable1();

        
    
        properties.rg_event.stopListening(".rg-event");
        properties.wl_event.stopListening(".wl-event");
        properties.single_event.stopListening(".single-chart-event");
        properties.incident_event.stopListening(".incident-event");
        properties.incident_event.stopListening(".notification-event");

    //     properties.rg_event.listen(".rg-event",(e)=>{
    //     if(monitoring.selectedTab == 0){
    //         monitoring.loadTable1();
    //     }
        
    // });
    // properties.wl_event.listen(".wl-event",(e)=>{
    //     if(monitoring.selectedTab == 1){
    //         monitoring.loadTable1(); 
    //     }
    // });

    properties.notification_event.listen('.notification-event',(e)=>{
         dashboard.loadNotification();
       })

    // selected row station has a value of true then reload
    // window.single_event.listen('.single-chart-event',(e)=>{

    //     if(monitoring.selectedTab == 0){
    //         if(e.rg[monitoring.selectRow] == true){
    //             monitoring.loadTable2(); 
    //             monitoring.loadChart();
    //         }
    //     }
    //     else if(monitoring.selectedTab == 1){
    //         if(e.wl[monitoring.selectRow] == true){
    //             monitoring.loadTable2(); 
    //             monitoring.loadChart();
    //         }
    //     }
    // });
})



</script>
<style>
.row-active{
    background: #c0eef7b6 !important;
}
.dark table.vgt-table td{
    color: white !important;
}
</style>
  