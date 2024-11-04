<template>
    <div>
        <Breadcrumb />
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="lg:col-span-12 col-span-12">
                <Card>
                    <div class="flex justify-between flex-wrap items-center">
                        <div class="md:mb-6 mb-4">
                            <Button @click="add" icon="iwwa:add" :text="'Add ' + role.moduleName" btnClass="btn-outline-light btn-sm" :isLoading="role.loading"/>
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
                            <TableSkeleton :count="5" v-if="role.loading" />
                            <vue-good-table v-if="!role.loading" :columns="columns"
                                :rows="role.roleList"
                                styleClass="vgt-table table-head v-middle striped lesspadding2" :sort-options="{
                                    enabled: false,
                                }" :pagination-options="{ enabled: true, perPage: perpage }"
                                :search-options="{ enabled: true, externalQuery: searchString }">
                                <template v-slot:table-row="props"> 
                                    <span v-if="props.column.field == 'action' && props.row.id != 1 ">
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

                                    <span v-if="props.column.field == 'dashboard'">
                                         <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span> 
                                    </span>

                                    <span v-if="props.column.field == 'warning'">
                                        <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span>
                                    </span>

                                    <span v-if="props.column.field == 'database'">
                                        <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span>
                                    </span>

                                    <span v-if="props.column.field == 'monitoring'">
                                        <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span>
                                    </span>

                                    <span v-if="props.column.field == 'sensor'">
                                        <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span>
                                    </span>

                                    <span v-if="props.column.field == 'station'">
                                        <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span>
                                    </span>

                                    <span v-if="props.column.field == 'maintenance_warning'">
                                        <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span>
                                    </span>

                                    <span v-if="props.column.field == 'notification'">
                                        <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span>
                                    </span>

                                    <span v-if="props.column.field == 'recipient'">
                                        <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span>
                                    </span>

                                    <span v-if="props.column.field == 'user'">
                                        <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span>
                                    </span>

                                    <span v-if="props.column.field == 'user_role'">
                                        <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span>
                                    </span>

                                    <span v-if="props.column.field == 'system'">
                                        <span class="text-green-600" v-if="props.row[props.column.field] == 1"><Icon icon="bx:check" /></span>
                                         <span class="text-red-600" v-if="props.row[props.column.field] == 0"><Icon icon="bx:x" /></span>
                                    </span>

                                </template>
                                <template #pagination-bottom="props">
                                    <div class="py-4 px-3 justify-center flex">
                                        <Pagination :total="role.roleList.length" :current="current"
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
        <addModal/>
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


import addModal from "./add-modal.vue";

import { useUserRoleStore } from "@/store/role";
import { useAuthStore } from "@/store/auth";

const auth = useAuthStore();
const role = useUserRoleStore();

const properties = getCurrentInstance().appContext.config.globalProperties
const current = ref(1);
const perpage = ref(10);
const pageRange = ref(10);
const searchString = ref("");

const columns = [ 
    {
        label: 'Name',
        field: 'name',
    },
    {
        label: 'Dashboard',
        field: 'dashboard',
    },
    {
        label: 'Warning',
        field: 'warning',
    },
    {
        label: 'Historical',
        field: 'database',
    },
    {
        label: 'Monitoring',
        field: 'monitoring',
    },
    {
        label: 'Sensor',
        field: 'sensor',
    },
    {
        label: 'Station',
        field: 'station',
    },
    {
        label: 'Maintenance Warning',
        field: 'maintenance_warning',
    },
    {
        label: 'Notification Content',
        field: 'notification',
    },
    {
        label: 'Recipient',
        field: 'recipient',
    },
    {
        label: 'User',
        field: 'user',
    },
    {
        label: 'User Role',
        field: 'user_role',
    },
    {
        label: 'System',
        field: 'system',
    },
    {
        label: "Action",
        field: "action",
    },
];

const add = () => {
    role.action = 'Add';
    role.resetForm();
    role.openModal();
}

const refresh = () => {
    role.load();
}

const del = (data)=>{
    // role.warningForm.id = data.id;
    // role.delete();
}

const edit = (data) => {

    role.action = 'Update';
    role.roleForm.id = data.id;
    role.roleForm.name = data.name;
    role.roleForm.dashboard = data.dashboard == 1 ? true : false;
    role.roleForm.warning = data.warning  == 1 ? true : false;
    role.roleForm.database = data.database  == 1 ? true : false;
    role.roleForm.monitoring = data.monitoring  == 1 ? true : false;
    role.roleForm.sensor = data.sensor  == 1 ? true : false;
    role.roleForm.station = data.station  == 1 ? true : false;
    role.roleForm.maintenance_warning = data.maintenance_warning  == 1 ? true : false;
    role.roleForm.recipient = data.recipient  == 1 ? true : false;
    role.roleForm.notification = data.notification  == 1 ? true : false;
    role.roleForm.user = data.user  == 1 ? true : false;
    role.roleForm.user_role = data.user_role  == 1 ? true : false;
    role.openModal();
}

onMounted(() => {
    console.log(auth.user.id)
    if (role.roleList.length <= 0) {
        role.load();
    }
    role.modal = false; 

    properties.rg_event.stopListening(".rg-event");
    properties.wl_event.stopListening(".wl-event");
    properties.single_event.stopListening(".single-chart-event");
    properties.incident_event.stopListening(".incident-event");
})

</script>
<style lang=""></style>
  