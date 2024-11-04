<template>
    <div>
        <Breadcrumb />
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="lg:col-span-12 col-span-12">
                <Card>
                    <div class="flex justify-between flex-wrap items-center">
                        <div class="md:mb-6 mb-4">
                            <Button @click="add" icon="iwwa:add" :text="'Add ' + warningStore.moduleName" btnClass="btn-outline-light btn-sm" :isLoading="warningStore.loading"/>
                        </div>
                        <div
                            class="flex sm:space-x-4 space-x-2 sm:justify-end items-center md:mb-6 mb-4 rtl:space-x-reverse">
                            <InputGroup type="text" prependIcon="heroicons-outline:search" merged v-model="searchString" />
                            <Tooltip placement="top" arrow theme="primary-500">
                                <template #button>
                                    <Button @click="refresh" icon="teenyicons:refresh-solid"
                                        btnClass="p-0 h-12 w-12 flex items-center justify-center rounded-full" />
                                </template>
                                <span>Refresh</span>
                            </Tooltip>

                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-5 mb-5">
                        <div class="lg:col-span-12 col-span-12">
                            <TableSkeleton :count="5" v-if="warningStore.loading" />
                            <vue-good-table v-if="!warningStore.loading" :columns="columns"
                                :rows="warningStore.getWarningList"
                                styleClass="vgt-table table-head v-middle striped lesspadding2" :sort-options="{
                                    enabled: false,
                                }" :pagination-options="{ enabled: true, perPage: perpage }"
                                :search-options="{ enabled: true, externalQuery: searchString }">
                                <template v-slot:table-row="props"> 
                                    <span v-if="props.column.field == 'action'">
                                        {{ props.pageChanged }}
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                            <Tooltip placement="top" arrow theme="dark">
                                                <template #button>
                                                    <div class="action-btn" @click="edit(props.row)">
                                                        <Icon icon="bx:edit" />
                                                    </div>
                                                </template>
                                                <span> Edit</span>
                                            </Tooltip>
                                            <Tooltip placement="top" arrow theme="danger-500">
                                                <template #button>
                                                    <div class="action-btn" @click="del(props.row)">
                                                        <Icon icon="bx:trash" />
                                                    </div>
                                                </template>
                                                <span>Delete</span>
                                            </Tooltip>
                                        </div>
                                      
                                    </span>
                                </template>
                                <template #pagination-bottom="props">
                                    <div class="py-4 px-3 justify-center flex">
                                        <Pagination :total="warningStore.getWarningList.length" :current="current"
                                            :per-page="perpage" :pageRange="pageRange" @page-changed="current = $event"
                                            :pageChanged="props.pageChanged" :perPageChanged="props.perPageChanged" />
                                    </div>
                                </template>
                            </vue-good-table>
                        </div>
                    </div>
                </Card>
            </div>
        </div>
        <addModal />
    </div>
</template>
<script setup>
import { ref, onMounted,getCurrentInstance } from "vue";

import Breadcrumb from "@/components/Breadcrumb";
import Icon from "@/components/Icon";
import Button from '@/components/Button';
import Card from "@/components/Card";
import InputGroup from "@/components/InputGroup";
import Tooltip from "@/components/Tooltip";
import TableSkeleton from "@/components/Skeleton/Table";
import Pagination from "@/components/Pagination";

import addModal from './add-modal.vue'

import { useWarningStore } from "@/store/warning";
import { useSensorStore } from "@/store/sensor";
import {useStationStore} from "@/store/station";
const warningStore = useWarningStore();
const sensor = useSensorStore();
const station = useStationStore();
const properties = getCurrentInstance().appContext.config.globalProperties
const current = ref(1);
const perpage = ref(10);
const pageRange = ref(10);

const searchString = ref("");

const columns = [ 
    {
        label: 'Station Name',
        field: 'station_name',
    },
    {
        label: 'Sensor',
        field: 'sensor_description',
    },
    {
        label: 'Sensor Thresholds',
        field: 'sensor_thresholds',
    },
    {
        label: 'Status',
        field: 'status',
    },
    {
        label: 'Color',
        field: 'color',
    },
    {
        label: "Action",
        field: "action",
    },
];

const add = () => {
    warningStore.action = 'Add';
    sensor.station_id = null;
    warningStore.resetForm();
    warningStore.openModal();
}

const refresh = () => {
    warningStore.load();
}

const del = (data)=>{
    warningStore.warningForm.id = data.id;
    warningStore.delete();
}

const edit = (data) => {
 
    warningStore.action = 'Update';

    warningStore.warningForm.id = data.id;
    warningStore.warningForm.station_id = data.station_id;
    warningStore.warningForm.sensor_id = data.sensor_id;
    warningStore.warningForm.sensor_thresholds = data.sensor_thresholds;
    warningStore.warningForm.color = data.color;
    warningStore.warningForm.status = data.status;
    warningStore.warningForm.is_check = data.is_check;

   

    sensor.station_id = data.station_id;

    warningStore.openModal();
}

onMounted(() => {
    if (warningStore.warningListData.length <= 0) {
        warningStore.load();
    }
    if(station.stationListData.length <= 0){
        station.load();
    }
    if(sensor.sensorList.length <= 0){
        sensor.loadSensorList();
    }

    warningStore.modal = false; 

    properties.rg_event.stopListening(".rg-event");
    properties.wl_event.stopListening(".wl-event");
    properties.single_event.stopListening(".single-chart-event");
    properties.incident_event.stopListening(".incident-event");
})

</script>
<style lang=""></style>
  