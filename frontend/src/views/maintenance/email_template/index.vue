<template>
    <div>
        <Breadcrumb />
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="lg:col-span-12 col-span-12">
                <Card>
                    <div class="flex justify-between flex-wrap items-center">
                        <div class="md:mb-6 mb-4">
                            <Button @click="add" icon="iwwa:add" :text="'Add ' + email_template.moduleName" btnClass="btn-outline-light btn-sm" />
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
                            <TableSkeleton :count="5" v-if="email_template.loading" />
                            <vue-good-table v-if="!email_template.loading" :columns="columns"
                                :rows="email_template.emailTemplateList"
                                styleClass="vgt-table table-head v-middle striped lesspadding2" :sort-options="{
                                    enabled: false,
                                }" :pagination-options="{ enabled: true, perPage: perpage }"
                                :search-options="{ enabled: true, externalQuery: searchString }">
                                <template v-slot:table-row="props">
                                    <span v-if="props.column.field == 'coordinates'">
                                        <div class="flex items-center text-blue-500">
                                            <a :href="'https://www.google.com/maps/@' + props.row.coordinates + ',20z?entry=ttu'"
                                                target="_blank" class="mr-1">{{ props.row.coordinates }}</a>
                                            <Icon icon="solar:map-arrow-right-bold" />
                                        </div>
                                    </span>
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
                                        <Pagination :total="email_template.emailTemplateList.length" :current="current"
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
import Swal from 'sweetalert2';
import addModal from "./add-modal.vue";

import { useEmailTemplate } from "@/store/email_template";
const email_template = useEmailTemplate();
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
        label:"Action",
        field:"action"
    }
];

const add = () => {
    email_template.action = 'Add';
    email_template.resetForm();
    email_template.openModal();
}

const refresh = () => {
    email_template.load();
}

const edit = (data) => {
    email_template.action = 'Update';

    email_template.emailTemplateForm.id = data.id;
    email_template.emailTemplateForm.name = data.name;
    email_template.emailTemplateForm.content = data.content;

    email_template.openModal();
}

const del = (id) => {
    Swal.fire({
        title: "Do you want to delete this recipient?", 
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!", 
    }).then((result) => { 
        if (result.isConfirmed) {
            email_template.deleteRecipient(id);
        } 
    });

    
}

onMounted(() => {
    if (email_template.emailTemplateList.length <= 0) {
        email_template.load();
    }
    email_template.modal = false; 

    properties.rg_event.stopListening(".rg-event");
    properties.wl_event.stopListening(".wl-event");
    properties.single_event.stopListening(".single-chart-event");
    properties.incident_event.stopListening(".incident-event");
})

</script>
<style lang=""></style>
  