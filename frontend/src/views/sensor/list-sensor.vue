<template>
    <div>
        <div class="flex justify-between flex-wrap items-center">
            <div>

            </div>
            <div class="flex sm:space-x-4 space-x-2 sm:justify-end items-center md:mb-6 mb-4 rtl:space-x-reverse">
                <InputGroup type="text" appendIcon="heroicons-outline:search" />
                <Button @click="refreshSensors" icon="teenyicons:refresh-solid"
                    btnClass="p-0 h-12 w-12 flex items-center justify-center rounded-full" />
            </div>
        </div>
        <div class="grid grid-cols-12 gap-5 mb-5">
            <div class="lg:col-span-12 col-span-12">
                <TableSkeleton :count="5" v-if="sensorStore.loading" />
                <vue-good-table v-if="!sensorStore.loading" :columns="columns" :rows="sensorStore.getSensorList"
                    styleClass="vgt-table table-head v-middle striped lesspadding2" :sort-options="{
                        enabled: false,
                    }" :pagination-options="{
    enabled: true,
    perPage: perpage,
}">
                    <template v-slot:table-row="props">
                        <span v-if="props.column.field == 'status'">
                         
                            <span v-if="props.row.status == 'Inactive' " class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">
                                Inactive
                            </span>
                            <span v-else class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">
                                Active
                            </span>
                        </span>
                        <span v-if="props.column.field == 'action'">
                            <div class="flex space-x-3 rtl:space-x-reverse">
                                <Tooltip placement="top" arrow theme="dark">
                                    <template #button>
                                        <div class="action-btn" @click="editSensor(props.row.id)">
                                            <Icon icon="bx:edit" />
                                        </div>
                                    </template>
                                    <span> Edit</span>
                                </Tooltip>
                                <Tooltip placement="top" arrow theme="danger-500">
                                    <template #button>
                                        <div class="action-btn">
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
                            <Pagination :total="sensorStore.getSensorList.length" :current="current" :per-page="perpage"
                                :pageRange="pageRange" @page-changed="current = $event" :pageChanged="props.pageChanged"
                                :perPageChanged="props.perPageChanged" />
                        </div>
                    </template>
                </vue-good-table>
            </div>
        </div>
    </div>
</template>
<script setup>
import TableSkeleton from "@/components/Skeleton/Table";
import Icon from "@/components/Icon";
import InputGroup from "@/components/InputGroup";
import Button from '@/components/Button';
import Dropdown from '@/components/Dropdown';
import Tooltip from "@/components/Tooltip";
import Pagination from "@/components/Pagination";
import { MenuItem } from "@headlessui/vue";
import { useSensorStore } from "@/store/sensor";
const sensorStore = useSensorStore();

const columns = [
    {
        label: 'Sensor',
        field: 'id',
    }, 
    {
        label: 'Sensor Type',
        field: 'sensor_description',
    },
    {
        label: 'Station Name',
        field: 'station_name',
    },
    // {
    //     label: 'Location',
    //     field: 'location',
    // },
    {
        label: 'Status',
        field: 'status',
    },
    {
        label: 'Last Scanned',
        field: 'last_scan',
    }, 
];

const actions = [
    {
        name: "edit",
        icon: "heroicons:pencil-square",
        doit: (data) => {
           sensorStore.getSensorDetail(data)
        },
    },
    {
        name: "delete",
        icon: "heroicons-outline:trash",
        doit: (data) => {
            //this.removeProject(data)
        },
    },
];

const editSensor = (id) => {
    sensorStore.getSensorDetail(id);
}


const refreshSensors = () => {
    console.log(sensorStore.getSensorList);
    sensorStore.loadSensorList();
};

</script>
<style lang="scss"></style>