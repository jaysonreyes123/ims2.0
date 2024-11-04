<template>
    <div>
        <Breadcrumb />
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="lg:col-span-12 col-span-12">
                <Card>
                    <div class="flex justify-between flex-wrap items-center">
                        <div class="md:mb-6 mb-4">
                            
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
                            <TableSkeleton :count="5" v-if="authStore.activityLogsLoading" />
                            <vue-good-table v-if="!authStore.activityLogsLoading" :columns="columns"
                                :rows="authStore.activityLogs"
                                styleClass="vgt-table table-head v-middle striped lesspadding2"
                                 :sort-options="{
                                    enabled: false,
                                }" :pagination-options="{ enabled: true, perPage: perpage }"
                                :search-options="{ enabled: true, externalQuery: searchString }">
                                
                                <template #pagination-bottom="props">
                                    <div class="py-4 px-3 justify-center flex">
                                        <Pagination :total="authStore.activityLogs.length" :current="current"
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
    </div>
</template>
<script setup>
import { ref, onMounted, getCurrentInstance } from "vue";

import Breadcrumb from "@/components/Breadcrumb";
import Icon from "@/components/Icon";
import Button from '@/components/Button';
import Card from "@/components/Card";
import InputGroup from "@/components/InputGroup";
import Tooltip from "@/components/Tooltip";
import TableSkeleton from "@/components/Skeleton/Table";
import Pagination from "@/components/Pagination"; 
 
import { useAuthStore } from "@/store/auth";
const authStore = useAuthStore(); 

const current = ref(1);
const perpage = ref(10);
const pageRange = ref(10);
const rows = ref([]);
const searchString = ref("");

const columns = [ 
    {
        label: 'Date & Time',
        field: 'created_at', 
    },
    {
        label: 'User',
        field: 'user.name',
    },
    {
        label: 'Action',
        field: 'method',
    }, 
    {
        label: "Notes",
        field: "descriptions",
    },
];

const refresh = () => {
    authStore.getActivityLogs();
}

onMounted(() => {
    if (authStore.activityLogs.length <= 0) { 
        authStore.getActivityLogs(); 
    } 
})
 

</script> 
  