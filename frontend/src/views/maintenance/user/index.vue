<template>
    <div>
        <Breadcrumb />
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="lg:col-span-12 col-span-12">
                <Card>
                    <div class="flex justify-between flex-wrap items-center">
                        <div class="md:mb-6 mb-4">
                            <Button @click="add" icon="iwwa:add" :text="'Add ' + user.moduleName" btnClass="btn-outline-light btn-sm" :isLoading="user.loading"/>
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
                            <TableSkeleton :count="5" v-if="user.loading" />
                            <vue-good-table v-if="!user.loading" :columns="columns"
                                :rows="user.userListData"
                                styleClass="vgt-table table-head v-middle striped lesspadding2" :sort-options="{
                                    enabled: false,
                                }" :pagination-options="{ enabled: true, perPage: perpage }"
                                :search-options="{ enabled: true, externalQuery: searchString }">
                                <template v-slot:table-row="props"> 
                                    <span v-if="props.column.field == 'action'">
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
                                                    <div class="action-btn" @click="del(props.row.id)">
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
                                        <Pagination :total="user.userListData.length" :current="current"
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
import Swal from 'sweetalert2';


import addModal from "./add-modal.vue";

import { useUserStore } from "@/store/user";
import { useAuthStore } from "@/store/auth";
import { useUserRoleStore } from "@/store/role";

const role = useUserRoleStore();
const auth = useAuthStore();
const user = useUserStore();
const properties = getCurrentInstance().appContext.config.globalProperties
const current = ref(1);
const perpage = ref(10);
const pageRange = ref(10);

const searchString = ref("");

const columns = [ 
    {
        label: 'ID',
        field: 'id',
    },
    {
        label: 'Name',
        field: 'name',
    },
    {
        label: 'Role',
        field: 'roles_.name'
    },
    {
        label: 'Email',
        field: 'email',
    },
    {
        label: "Action",
        field: "action",
    },
];

const add = () => {
    user.action = 'Add';
    user.resetForm();
    user.openModal();
}

const refresh = () => {
    user.load();
}

const del = (id) => {
    Swal.fire({
        title: "Do you want to delete this user?", 
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!", 
    }).then((result) => { 
        if (result.isConfirmed) {
            user.deleteUser(id);
        } 
    });

    
}

const edit = (data) => {
    user.action = 'Update';
    user.userForm.name = data.name;
    user.userForm.email = data.email
    user.userForm.id = data.id;
    user.userForm.role = data.role;
    user.openModal();
}

onMounted(() => {
 
    if (role.roleList.length <= 0) {
        role.load();
    }

    if (user.userListData.length <= 0) {
        user.load();
    }
    user.modal = false; 

    properties.rg_event.stopListening(".rg-event");
    properties.wl_event.stopListening(".wl-event");
    properties.single_event.stopListening(".single-chart-event");
    properties.incident_event.stopListening(".incident-event");
})

</script>
<style lang=""></style>
  