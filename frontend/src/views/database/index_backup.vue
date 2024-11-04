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
                            <TabPanel>
                                <div class="flex justify-end flex-wrap items-center mb-3">
                                    <!-- <div>
                                        <button @click="export_csv" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded mr-2">
                                            Csv
                                        </button>
                                    </div>
                                    <div>
                                        <button @click="export_excel" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded">
                                            Excel
                                        </button>
                                    </div> -->
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
                                <div class="flex justify-between flex-wrap items-center">
                                        <div>
                                            <flat-pickr @change="dateChange" v-model="database.databaseForm.date" class="form-control" id="d1"
                                                placeholder="yyyy, dd M" />
                                        </div>
                                        <div
                                            class="flex sm:space-x-4 space-x-2 sm:justify-end items-center md:mb-6 mb-4 rtl:space-x-reverse">
                                            <InputGroup type="text" appendIcon="heroicons-outline:search" />
                                        </div>
                                    </div>
                                <div class="grid grid-cols-12 gap-5 mb-5">
                                    
                                    <div class="lg:col-span-8 col-span-12">
                                        <TableSkeleton :count="5" v-if="database.loading" />
                                        <vue-good-table :row-style-class="rowStyleClassFn" @row-click="rowClick" :row-click="rowClick" v-if="!database.loading" :columns="database.databaseForm.column" :rows="database.RgTableList1"
                                                styleClass="vgt-table table-head" :sort-options="{
                                                    enabled: false,
                                                }" :pagination-options="{
                                                    enabled: true,
                                                    perPage: perpage,
                                                }" >
                                                   <template #pagination-bottom="props">
                                                        <div class="py-4 px-3 justify-center flex">
                                                            <Pagination :total="database.RgTableList1.length" :current="current" :per-page="perpage"
                                                                :pageRange="pageRange" @page-changed="current = $event" :pageChanged="props.pageChanged"
                                                                :perPageChanged="props.perPageChanged" />
                                                        </div>
                                                    </template>    
                                        </vue-good-table>
                                    </div>

                                    <div class="lg:col-span-4 col-span-12">
                                        <TableSkeleton :count="5" v-if="database.loading2" />
                                        <vue-good-table :fixed-header="true" max-height="670px" v-if="!database.loading2" :columns="database.databaseForm.column2" :rows="database.RgTableList2"
                                                styleClass="vgt-table table-head" :sort-options="{
                                                    enabled: false,
                                                }" />
                                    </div>
                                </div> 
                            </TabPanel>
                            <TabPanel>
                                <div class="flex justify-end flex-wrap items-center mb-3">
                                    <!-- <div>
                                        <button @click="export_csv" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded mr-2">
                                            Csv
                                        </button>
                                    </div>
                                    <div>
                                        <button @click="export_excel" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded">
                                            Excel
                                        </button>
                                    </div> -->
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
                                <div class="flex justify-between flex-wrap items-center">
                                        <div>
                                            <flat-pickr v-model="database.databaseForm.date" @change="dateChange" class="form-control" id="d1"
                                                placeholder="yyyy, dd M" />
                                        </div>
                                        <div
                                            class="flex sm:space-x-4 space-x-2 sm:justify-end items-center md:mb-6 mb-4 rtl:space-x-reverse">
                                            <InputGroup type="text" appendIcon="heroicons-outline:search" />
                                        </div>
                                    </div>
                                <div class="grid grid-cols-12 gap-5 mb-5">
                                    
                                    <div class="lg:col-span-8 col-span-12">
                                        <TableSkeleton :count="5" v-if="database.loading" />
                                        <vue-good-table :row-style-class="rowStyleClassFn" @row-click="rowClick" :row-click="rowClick" v-if="!database.loading" :columns="database.databaseForm.column" :rows="database.WlTableList1"
                                                styleClass="vgt-table table-head"  :sort-options="{
                                                    enabled: false,
                                                }" />
                                    </div>

                                    <div class="lg:col-span-4 col-span-12">
                                        <TableSkeleton :count="5" v-if="database.loading2" />
                                        <vue-good-table :fixed-header="true" max-height="670px" v-if="!database.loading2" :columns="database.databaseForm.column2" :rows="database.WlTableList2"
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
import Card from "@/components/Card";
import SelectMonth from "../../views/home/Analytics-Component/SelectMonth";
import Map from "../../views/home/Analytics-Component/Map";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import InputGroup from "@/components/InputGroup";
import TableSkeleton from "@/components/Skeleton/Table";
import Pagination from "@/components/Pagination";
import { MenuItem } from "@headlessui/vue";

const current = ref(1);
const perpage = ref(10);
const pageRange = ref(10);
const properties = getCurrentInstance().appContext.config.globalProperties
import { useDatabaseStore } from "@/store/database";
import {useDashboardStore} from "@/store/dashboard";

const date = new Date();
const month = date.getMonth()+1 >= 10 ? date.getMonth()+1 : "0"+(date.getMonth()+1);
const day = date.getDate()+1 >= 10 ? date.getDate() : "0"+date.getDate();
const currentdate = `${date.getFullYear()}-${month}-${day}`;



const database = useDatabaseStore();
const dashboard = useDashboardStore();


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
function tabChange(index){
    database.selectedTab = index;
    database.loading2 = true;
    database.getSelectedTab();
    
    database.loadTable1();
   // database.loadTable2();
    
}

function rowClick(event){
    database.selectRow = event.row.id;
    database.loadTable2();

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

function dateChange(){
    database.getSelectedTab();
    database.loading2 = true;
    database.loadTable1();
    //database.loadTable2();
    // database.RgTableList2 = [];
    // database.WlTableList2 = [];
}

onMounted(()=>{
        dashboard.loadNotification();
        database.databaseForm.date = currentdate;
        database.selectedTab = 0;
        database.getSelectedTab();
        database.loading2 = true;
        database.loadTable1();

       // database.loadTable2();

       properties.rg_event.stopListening(".rg-event");
       properties.wl_event.stopListening(".wl-event");
       properties.single_event.stopListening(".single-chart-event");
       properties.incident_event.stopListening(".incident-event");
       properties.notification_event.stopListening(".notification-event");

       properties.notification_event.listen('.notification-event',(e)=>{
         dashboard.loadNotification();
       })
    
})


function export_csv(){
    const id = database.selectRow;
    const type = database.databaseForm.type;
    const date = database.databaseForm.date;
    location.href = import.meta.env.VITE_MY_ENV_BASEURL+"/api/export/csv/"+id+"/"+type+"/"+date+"/csv";
}

function export_excel(){
    const id = database.selectRow;
    const type = database.databaseForm.type;
    const date = database.databaseForm.date;
    location.href = import.meta.env.VITE_MY_ENV_BASEURL+"/api/export/csv/"+id+"/"+type+"/"+date+"/xlsx";
}

</script>
<style>
.row-active{
    background: #c0eef7b6 !important;
}
.dark table.vgt-table td{
    color: white !important;
}
</style>