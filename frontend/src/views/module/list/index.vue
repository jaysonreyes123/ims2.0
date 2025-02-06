<template lang="">
    <div>
        <Breadcrum mode='list' />
        <div class="lg:grid lg:grid-cols-2 mb-2">
            <div class="flex">
                    <!-- <InputGroup class="w-3/5" type="text" placeholder="Search" appendIcon="heroicons-outline:search" /> -->
                    <InputGroup class="w-3/5" type="text" v-model="list_store.search" placeholder="Search...">
                    <template v-slot:append>
                        <Button :disabled="list_store.filter_data.length > 0 ? true : false" @click="searchBtn" icon="heroicons-outline:search" 
                            btnClass="btn-outline-dark disabled:bg-slate-300 disabled:cursor-not-allowed" />
                    </template>
                    </InputGroup>
                    <div>
                        <Button
                        :disabled="is_search ? true : false "
                        icon="heroicons-outline:adjustments-horizontal"
                        text="Filters"
                        btnClass="btn-outline-dark ml-2 py-2 disabled:bg-slate-300 disabled:cursor-not-allowed"
                        @click="filterModalBtn"
                    />
                    <Button
                        v-if="list_store.filter_data.length > 0"
                        icon="heroicons-outline:x-mark"
                        text="Clear Filter"
                        btnClass="btn-outline-danger ml-2 py-2"
                        @click="clearFilter"
                    />
                    <Button
                        v-if="is_search"
                        icon="heroicons-outline:x-mark"
                        text="Clear Search"
                        btnClass="btn-outline-danger ml-2 py-2"
                        @click="clearSearch"
                    />
                    </div>
            </div>
            <div>
                <div class="lg:float-right">
                    <Dropdown v-if="this.$route.params.module == 'reports' " :items="dropdown_item" classMenuItems="left-0 top-[110%] ">
                            <Button
                                :text="`New ${this.$route.params.module}`"
                                btnClass="btn-danger mr-2 py-2"
                                icon="heroicons-outline:plus"
                                iconPosition="left"
                                iconClass="text-lg"
                            />
                    </Dropdown>
                    <router-link v-else :to="{name:'edit',params:{module:this.$route.params.module}}">
                        <Button
                        icon="heroicons-outline:plus"
                        :text="`New ${modules_.label}`"
                        btnClass="btn-danger mr-2 py-2"
                        />
                    </router-link>
                    <Button
                    v-if="this.$route.params.module != 'reports'"
                    icon="heroicons-outline:arrow-down-tray"
                    text="Import"
                    btnClass="btn-outline-danger py-2"
                    @click="importModalbtn"
                    />
                </div>
            </div>
        </div>
        <SkeletonTable v-if="list_store.loading"/>
        <Card v-if="!list_store.loading">
            <vue-good-table :fixed-header="true" :isLoading.sync="list_store.loading" :columns="list_store.columns_header"
                styleClass=" vgt-table  lesspadding2 centered " :rows="list_store.list_data" :pagination-options="{
                enabled: true,
                perPage:15
            }" v-on:cell-click="onRowClick" :row-style-class="rowStyleClassFn" max-height="600px" :select-options="{
                enabled: true,
                selectOnCheckboxOnly: true, // only select when checkbox is clicked instead of the row
                selectioninfoClass: 'custom-class',
                selectionText: 'rows selected',
                clearSelectionText: 'clear',
                disableSelectinfo: true, // disable the select info-500 panel on top
                selectAllByGroup: true, // when used in combination with a grouped table, add a checkbox in the header row to check/uncheck the entire group
            }">
                <template v-slot:table-row="props">
                    <span v-if="props.column.name == 'incident_statuses' ">
                        <span class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25"
                        :style="{ 'background': incident_status_color[props.row[props.column.name]]+`25`,
                            'color':incident_status_color[props.row[props.column.name]] }"
                        >
                            {{ props.row[props.column.name] }}
                       </span>
                    </span>
                    <span v-if="props.column.field == 'action'">
                        <div class="flex space-x-3 justify-center rtl:space-x-reverse">
                            <Tooltip placement="top" arrow theme="dark" v-if="this.$route.params.module == 'reports' ">
                                <template #button>
                                    <router-link :to="`${this.$route.params.module}/generate/${props.row.id}`">
                                        <div class="action-btn">
                                            <Icon icon="heroicons:eye" />
                                        </div>
                                    </router-link>
                                </template>
                                <span> View</span>
                            </Tooltip>
                            <Tooltip placement="top" arrow theme="dark" v-else>
                                <template #button>
                                    <router-link :to="`${this.$route.params.module}/detail/${props.row.id}`">
                                        <div class="action-btn">
                                            <Icon icon="heroicons:eye" />
                                        </div>
                                    </router-link>
                                </template>
                                <span> View</span>
                            </Tooltip>
                            <!-- edit -->
                            <Tooltip v-if="this.$route.params.module == 'reports' " placement="top" arrow theme="dark">
                                <template #button>
                                    <router-link :to="`save/${this.$route.params.module}/${props.row.type}/${props.row.id}`">
                                        <div class="action-btn">
                                            <Icon icon="heroicons:pencil-square" />
                                        </div>
                                    </router-link>
                                </template>
                                <span> Edit</span>
                            </Tooltip>
                            <Tooltip v-else>
                                <template #button>
                                    <router-link :to="`${this.$route.params.module}/edit/${props.row.id}`">
                                        <div class="action-btn">
                                            <Icon icon="heroicons:pencil-square" />
                                        </div>
                                    </router-link>
                                </template>
                                <span> Edit</span>
                            </Tooltip>
                            <!-- end edit -->
                            <Tooltip placement="top" arrow theme="danger-500">
                                <template #button>
                                    <div class="action-btn text-red-500" @click="del(props.row.id,props.row.originalIndex)">
                                        <Icon icon="heroicons:trash" />
                                    </div>
                                </template>
                                <span>Delete</span>
                            </Tooltip>
                        </div>
                    </span>
                </template>
                <template #pagination-bottom="props">
                    <div class="py-4 px-3 flex justify-center">
                        <Pagination :total="list_store.page.total" :current="list_store.page.current" :per-page="list_store.page.per_page"
                            @page-changed="changePage" :perPageChanged="props.perPageChanged">
                        </Pagination>
                    </div>
                </template>
            </vue-good-table>
        </Card>
        <modal :openFilterModal="openFilterModal" @closeFilterModal="closeFilterModal" />
        <Import :openModal="openModal" @closeModal="closeModal" />
    </div>
</template>
<script>
import SkeletonTable from "@/components/Skeleton/Table";
import Dropdown from '@/components/Dropdown';
import InputGroup from "@/components/InputGroup";
import Card from "@/components/Card";
import Pagination from "@/components/Pagination";
import Tooltip from "@/components/Tooltip";
import Button from "@/components/Button";
import Swal from 'sweetalert2';
import Icon from "@/components/Icon";
import { useListStore } from '@/store/list';
import Import from "../import/import.vue";
import modal from "./modal.vue";
import { ref } from 'vue';
import Breadcrum from "../Breadcrum.vue";
import { useAuthStore } from '@/store/auth';
const auth_store = useAuthStore();
const list_store = useListStore();
const modules = ref("");
const table_column = ref([]);
const is_search = ref(false);
const incident_status_color = 
{
    'New':'#007bff',
    'Open':'#20c997',
    'In Progress':'#fd7e14',
    'On Hold':'#ffc107',
    'Resolved':'#28a745',
    'Closed':'#6c757d',
    'Cancelled':'#dc3545'
}
const dropdown_item = [
    {
        label:"List",
        link:"/app/module/save/reports/list"
    },
    {
        label:"Chart",
        link:"/app/module/save/reports/chart"
    }
]
export default {
    components:{
        Card,
        Pagination,
        Tooltip,
        Icon,
        InputGroup,
        Button,
        modal,
        Import,
        Breadcrum,
        Dropdown,
        SkeletonTable
    },
    data(){
        return{
            list_store,
            table_column,
            openModal:false,
            openFilterModal:false,
            is_search,
            incident_status_color,
            dropdown_item
        }
    },
    created(){  
        modules.value = this.$route.params.module;
        this.$watch(
            ()=>this.$route.params.module,
            (modules) => {
                list_store.page.current = 1;
                list_store.module = modules;
                list_store.clear();
                list_store.get_column();
            }
        )
    },
    mounted(){
        list_store.module = modules.value;
        list_store.clear();
        list_store.get_column();
    },
    computed:{
        modules_(){
            const current_module = this.$route.params.module;
            const module_info = auth_store.module.find(module__ => module__.name == current_module );
            return module_info;
        }
    },
    methods:{
        rowStyleClassFn(row){
            return 'VGT-row';
        },
        onRowClick(row) {
            if(row.column.field != 'action'){
                const id = row.row.id;
                this.$router.push({name:'view',params:{id:id,action:'detail'}});
            }
        },
        changePage(event){
            list_store.page.current = event;
            list_store.list_function(list_store.module);
        },
        filterModalBtn(){
            console.log("test");
            this.openFilterModal = true;
        },
        closeFilterModal(value){
            this.openFilterModal = value;
        },
        clearFilter(){
            list_store.filter_data = [];
            list_store.list_function();
        },
        clearSearch(){
            list_store.search = "";
            is_search.value = false;
            list_store.list_function();
        },
        searchBtn(){
            if(list_store.search != ""){
                is_search.value = true;
                list_store.list_function();
            }
        },
        importModalbtn(){
            this.openModal = true;
        },
        closeModal(value){
            this.openModal = value;
        },
        del(id,index){
            const module_ = this.modules_.label;
            Swal.fire({
            title: "Delete "+module_+" ", 
            text: "Are you sure you want to delete this "+module_+"? ",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            confirmButtonText: "Delete",
            cancelButtonColor: "#3085d6",
            reverseButtons: true, 
            }).then((result) => { 
                if (result.isConfirmed) {
                    list_store.delete(this.$route.params.module,id,index);
                } 
            });
      }
    }
}
</script>
<style lang="scss" scoped>
  .action-btn {
    @apply h-6 w-6 flex flex-col items-center justify-center border border-slate-200 dark:border-slate-700 rounded;
  }
</style>
<style>
  .VGT-row:hover{
    background: rgb(241, 241, 241);
    cursor: pointer;
  }
</style>