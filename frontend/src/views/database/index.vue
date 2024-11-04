<template>
   <div>
    <Breadcrumb />
    <div class="grid grid-cols-12 gap-3 mb-5">
        <div class="lg:col-span-12 col-span-12">
            <Card>
                <div class="grid grid-cols-2">
                    <div class="col-span-1">
                        <div class="flex flex-wrap gap-4">
                            <div>
                                <Select class="dark:bg-slate-400 w-64" @change="onChange" placeholder="Select Station" :reduce="label => label.value"  v-model="station" :options="storeStation.getDropdown" />
                            </div>
                            <div>
                                <Datepicker :preset-dates="presetDates" input-class-name="width"  @closed="search" v-model="date" class="w-64"   :enable-time-picker="false" multi-calendars :range="{ maxRange: 6 }" >
                                    <template #preset-date-range-button="{ label, value, presetDate }">
                                        <span 
                                            role="button"
                                            :tabindex="0"
                                            @click="presetDate(value)"
                                            @keyup.enter.prevent="presetDate(value)"
                                            @keyup.space.prevent="presetDate(value)">
                                            {{ label }}
                                        </span>
                                    </template>
                                    </Datepicker>
                                <!-- <Datepicker input-class-name="width" v-model="date" class="w-64"   :enable-time-picker="false" :range="{ maxRange: 7 }"  /> -->
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-span-1">
                        <div class="flex justify-end">
                            <Button text="Search" class="py-2" @click="search" btnClass="btn-primary" />
                        </div>
                    </div> -->
                </div>
                <div class="grid grid-cols-2 gap-4 mt-5">
                    <div class="col-span-1" >
                        <h6>Rain Fall {{ daterange }}</h6>
                        <br>
                        <apexchart  type="line"  height="350"  :options="rg_option" :series="series" />
                        <TableSkeleton :count="5" v-if="storeDatabase.loading" />
                        <div v-if="!storeDatabase.loading">
                        <vue-good-table  
                                :columns="rg_column" :rows="storeDatabase.rg_list"
                                styleClass="vgt-table table-head" :sort-options="{
                                    enabled: false,
                                }" :pagination-options="{
                                    enabled: true,
                                    perPage: perpage,
                                }" >
                                <template #pagination-bottom="props">
                                    <div class="py-4 px-3 justify-center flex">
                                        <Pagination :total="storeDatabase.rg_list.length" :current="current" :per-page="perpage"
                                        :pageRange="pageRange" @page-changed="current = $event" :pageChanged="props.pageChanged"
                                        :perPageChanged="props.perPageChanged" />
                                    </div>
                                </template>    
                        </vue-good-table>
                        </div>
                        
                    </div>
                    <div class="col-span-1">
                        <h6>Water Level {{ daterange }}</h6>
                        <br>
                        <apexchart  type="line"  height="350"  :options="wl_option" :series="series" />
                        <TableSkeleton :count="5" v-if="storeDatabase.loading" />
                        <div v-if="!storeDatabase.loading">
                        <vue-good-table  
                                :columns="wl_column" :rows="storeDatabase.wl_list"
                                styleClass="vgt-table table-head" :sort-options="{
                                    enabled: false,
                                }" :pagination-options="{
                                    enabled: true,
                                    perPage: perpage,
                                }" >
                                <template #pagination-bottom="props">
                                    <div class="py-4 px-3 justify-center flex">
                                        <Pagination :total="storeDatabase.rg_list.length" :current="current" :per-page="perpage"
                                        :pageRange="pageRange" @page-changed="current = $event" :pageChanged="props.pageChanged"
                                        :perPageChanged="props.perPageChanged" />
                                    </div>
                                </template>    
                        </vue-good-table>
                        </div>
                        
                    </div>
                </div>
            </Card>
        </div>
    </div>
   </div>    
</template>

<script setup>
import { onMounted, ref } from 'vue';
import Breadcrumb from "../../views/dashboard/component/breadcrumb";
import TableSkeleton from "@/components/Skeleton/Table";
import Card from "@/components/Card";
import Select from "@/components/Select/index"
import Button from "@/components/Button";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { useStationStore } from "@/store/station";
import { useDatabaseStore } from '@/store/databse';
import { useToast } from "vue-toastification"; 
const toast = useToast(); 
import moment from 'moment'
let storeStation = useStationStore();
let storeDatabase = useDatabaseStore();
// storeDatabase.rg_list = [{
//     "name" : "no data",
//     "24_hrs" : "no data"
// }]
if(storeStation.stationListData.length == 0){
    storeStation.load();
}
storeDatabase.rg_list = [];
storeDatabase.wl_list = [];
storeDatabase.rg_series = [];
storeDatabase.rg_option=[];
storeDatabase.wl_series=[];
storeDatabase.wl_option=[];
storeDatabase.loading = false;
const date = ref();
const daterange = ref("");
const station = ref(1);
const current = ref(1);
const perpage = ref(10);
const pageRange = ref(10);
const today = moment().format('YYYY-MM-DD');
import { endOfMonth, endOfYear, startOfMonth, startOfYear, subMonths } from 'date-fns';
const presetDates = ref([
  { label: 'Today', value: [new Date(), new Date()] },
  { label:"Yesterday",value:[new Date(new Date().setDate(new Date().getDate() - 1)), new Date(new Date().setDate(new Date().getDate() - 1))]},
  { label:"Last 7 Days",value:[new Date(new Date().setDate(new Date().getDate() - 6)),new Date(new Date())]},
]);
const rg_column =[
                    {
                        label: 'Date',
                        field: 'date',
                    },
                    {
                        label: 'Accumulated RF 24HRS [mm]',
                        field: '24_hrs',
                    },
];
const wl_column =[
                    {
                        label: 'Date',
                        field: 'date',
                    },
                    {
                        label: 'Min WL [m]',
                        field: 'min',
                    },
                    {
                        label: 'Max WL [m]',
                        field: 'max',
                    },
                    {
                        label: 'Avg WL [m]',
                        field: 'ave',
                    },
];
const series = [{name:"no data",data:[0]}]
const rg_option = {
    "colors": [
        "#09b350",
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
            3
        ]
    },
    "yaxis": {
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
        "categories": [today],
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

const wl_option = {
    "colors": [
        "#09b350",
        "#008ffb"
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
            3,3,3,3
        ]
    },
    "yaxis": {
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
        "categories": [today],
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
function onChange(){
    search();
}

const search = () =>{
    console.log(date.value)
    if(station.value === undefined){
        toast.error("Select Station", {
            timeout: 3000,
        });
        return false;
    }
  
    if( date.value == null || date.value === undefined || date.value[1] == null ){
        toast.error("Invalid Selected Date", {
            timeout: 3000,
        });
        return false;
    }

   
    
    storeDatabase.rg_series = [];
    storeDatabase.wl_series = [];
    storeDatabase.rg_list = [];
    storeDatabase.wl_list = [];
    storeDatabase.historicalChart('rgchart',[],[],['#008ffb'])
    storeDatabase.historicalChart('wlchart',[],[],['#008ffb'])
    const date1 = moment(date.value[0]).format('YYYY-MM-DD');
    const date2 = moment(date.value[1]).format('YYYY-MM-DD');
    const date1_ = moment(date.value[0]).format('LL');
    const date2_ = moment(date.value[1]).format('LL');
    daterange.value = "from "+date1_+" to "+date2_;
    const station_id = station.value;
    storeDatabase.databaseForm.station = station_id;
    storeDatabase.databaseForm.date1 = date1;
    storeDatabase.databaseForm.date2 = date2;
    storeDatabase.loadTable();
}
//new Date(new Date().setDate(startDate.getDate() - 6));
onMounted(()=>{
    const date_ = new Date();
    const startDate = new Date(new Date().setDate(date_.getDate() - 6));
    const endDate = date_;
    date.value = [startDate,endDate];
    setTimeout(() => {
        search();
    }, 1000);
})
</script>

<style  lang="scss">
.width{
    width: 250px;
}
</style>