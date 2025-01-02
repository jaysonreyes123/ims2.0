<template>
    <div>
        <Card>
            <vue-good-table
            :isLoading.sync="listStore.loading"
            :columns="columns"
            styleClass=" vgt-table  lesspadding2 centered "
            :rows="listStore.list"
            :pagination-options="{
                enabled: true,
                perPage:15
            }"
            v-on:cell-click="onRowClick"
            :row-style-class="rowStyleClassFn"
            max-height="600px"
            :select-options="{
                enabled: true,
                selectOnCheckboxOnly: true, // only select when checkbox is clicked instead of the row
                selectioninfoClass: 'custom-class',
                selectionText: 'rows selected',
                clearSelectionText: 'clear',
                disableSelectinfo: true, // disable the select info-500 panel on top
                selectAllByGroup: true, // when used in combination with a grouped table, add a checkbox in the header row to check/uncheck the entire group
            }"
            >
            <template v-slot:table-row="props">
                <span v-if="props.column.field == 'action'">
                <div class="flex space-x-3 justify-center rtl:space-x-reverse">
                <Tooltip placement="top" arrow theme="dark">
                    <template #button>
                    <router-link :to="`${this.$route.params.module}/detail/${props.row.id}`">
                        <div class="action-btn">
                        <Icon icon="heroicons:eye" />
                        </div>
                    </router-link>
                    </template>
                    <span> View</span>
                </Tooltip>
                <Tooltip placement="top" arrow theme="dark">
                    <template #button>
                    <router-link :to="`${this.$route.params.module}/edit/${props.row.id}`">
                    <div class="action-btn">
                        <Icon icon="heroicons:pencil-square" />
                    </div>
                    </router-link>
                    </template>
                    <span> Edit</span>
                </Tooltip>
                <Tooltip placement="top" arrow theme="danger-500">
                    <template #button>
                    <div class="action-btn text-red-500" @click="del(props.row.id)">
                        <Icon  icon="heroicons:trash" />
                    </div>
                    </template>
                    <span>Delete</span>
                </Tooltip>
                </div>
            </span>
            </template>
            <template #pagination-bottom="props">
                <div class="py-4 px-3 flex justify-center">
                <Pagination
                    :total="listStore.total"
                    :current="listStore.current"
                    :per-page="listStore.per_page"
                     @page-changed="changePage"
                    :perPageChanged="props.perPageChanged"
                    >
                </Pagination>
                </div>
            </template>
            </vue-good-table>
        </Card>
    </div>
</template>
<script>
import Card from "@/components/Card";
import Pagination from "@/components/Pagination";
import Tooltip from "@/components/Tooltip";
import Swal from 'sweetalert2';
import Icon from "@/components/Icon";
import { useListStore } from "@/store/list";
import { 
    columns
} 
from "../column";

const listStore = useListStore();
export default {
    components:{
        Card,
        Pagination,
        Swal,
        Tooltip,
        Icon
    },
    created(){
        this.$watch(
            ()=>this.$route.params.module,
            (modules) => {
                listStore.filter_data = [];
                listStore.List(modules);
                this.Columns(modules);
            }
        )
    },  
    mounted(){
        listStore.List(this.$route.params.module);
        this.Columns(this.$route.params.module);
    },
    data(){
        return{
            modules:"",
            listStore,
            columns:[],
        }
    },
    methods:{
        rowStyleClassFn(row){
            return 'VGT-row';
        },
        onRowClick(row) {
            if(row.column.field != 'action'){
                const id = row.row.id;
                this.$router.push({name:'detail',params:{id:id}});
            }
        },
        changePage(event){
            listStore.current = event;
            listStore.List(this.$route.params.module);
        },
        Columns(modules){
            this.columns = columns[modules];
            // switch (modules) {
            //     case 'incidents':
            //         this.columns = incident_column;
            //         break;
            //     case 'resources':
            //         this.columns = resources_column;
            //         break;
            //     case 'contacts':
            //         this.columns = contacts_column;
            //         break;
            //     case 'agencies':
            //         this.columns = agencies_column;
            //         break;
            //     case 'responders':
            //         this.columns = responder_column;
            //         break;
            //     case 'preplans':
            //         this.columns = preplan_column;
            //         break;
            //     case 'call_logs':
            //         this.columns = call_logs_column;
            //         break;
            //     case 'users':
            //         this.columns = user_column;
            //         break;
            //     default:
            //         break;
            // }
        },
        del(id){
        Swal.fire({
          title: "Do you want to delete this "+this.$route.params.module+" ?", 
          text: "You won't be able to revert this!",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#3085d6",
          confirmButtonText: "Yes, delete it!", 
        }).then((result) => { 
            if (result.isConfirmed) {
                listStore.Delete(this.$route.params.module,id);
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