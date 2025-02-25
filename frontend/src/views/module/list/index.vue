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
        <Card>
            <div class="flex justify-end">
                <Button
                    :isDisabled="!is_deleteall"
                    @click="deleteAll"
                    class="mb-3"
                    btnClass="btn-danger btn-sm"
                    icon="heroicons-outline:trash"
                    iconPosition="left"
                    iconClass="text-lg"
                />
            </div>
            <Table 
                :checkbox="true"
                :loading="list_store.loading"
                :key="modules"
                :rows="list_store.list_data"
                :columns="list_store.columns_header"
                :total="list_store.page.total"
                :perPage="list_store.page.per_page"
                :current="list_store.page.current"
                @selecte_row_change="selectAll"
                @delete="del"
                @pageChange="pageChange"
            />
        </Card>
        <modal :openFilterModal="openFilterModal" @closeFilterModal="closeFilterModal" />
        <Import :openModal="openModal" @closeModal="closeModal" />
    </div>
</template>
<script>
import Table from "./table.vue"; 
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
import Dropdown from "@/components/Dropdown"
const auth_store = useAuthStore();
const list_store = useListStore();
const modules = ref("");
const table_column = ref([]);
const is_search = ref(false);
const is_deleteall = ref(false);
const selected_all_row = ref([]);
const dropdown_item = [
    {
        label:"List",
        link:"/app/module/save/reports/list"
    },
    // {
    //     label:"Chart",
    //     link:"/app/module/save/reports/chart"
    // }
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
        Table
    },
    data(){
        return{
            list_store,
            table_column,
            openModal:false,
            openFilterModal:false,
            is_search,
            dropdown_item,
            is_deleteall,
            modules
        }
    },
    created(){  
        modules.value = this.$route.params.module;
        selected_all_row.value = [];
        is_deleteall.value = false;
        this.$watch(
            ()=>this.$route.params.module,
            (current_module) => {
                modules.value = current_module;
                list_store.page.current = 1;
                list_store.page.total = 0;
                list_store.list_data = [];
                list_store.module = current_module;
                list_store.clear();
                list_store.get_column();
            }
        )
    },
    mounted(){
        modules.value = this.$route.params.module;
        list_store.module = modules.value;
        list_store.clear();
        list_store.get_column();
    },
    computed:{
        modules_(){
            const current_module = this.$route.params.module;
            const module_info = auth_store.module.find(module__ => module__.name == current_module );
            return module_info;
        },
    },
    methods:{
        
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
        selectAll(row){
            if(row.selectedRows.length > 0){
                is_deleteall.value = true;
                selected_all_row.value = row.selectedRows;
            }
            else{
                is_deleteall.value = false;
            }
        },
        deleteAll(){
            const module_ = this.modules_.label;
            const all_id = selected_all_row.value.map(row => row.id);
            const all_index = selected_all_row.value.map(row => row.originalIndex);
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
                        list_store.deleteAll(this.$route.params.module,all_id,all_index);
                        is_deleteall.value = false;
                    } 
            });
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
                    list_store.delete(this.$route.params.module,[id],[index]);
                } 
            });
      },
      pageChange(page){
        list_store.page.current = page;
        list_store.list_function(list_store.module);
      } 
    }
}
</script>
<style lang="scss" scoped>
  .action-btn {
    @apply h-6 w-6 flex flex-col items-center justify-center border border-slate-200 dark:border-slate-700 rounded;
  }
</style>