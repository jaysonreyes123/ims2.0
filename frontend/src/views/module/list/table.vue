<template lang="">
    <div class="shadow-md">
        <SkeletonTable v-if="loading" />
        <vue-good-table 
            v-if="!loading"
            :fixed-header="true" 
            :columns="columns"
            :rows="rows" 
            :isLoading.sync="list_store.loading" 
            v-on:selected-rows-change="selected_row_change"
            styleClass=" vgt-table  lesspadding2" 
            v-on:cell-click="onRowClick" 
            :row-style-class="rowStyleClassFn" 
            max-height="600px" 
            :pagination-options="{
                enabled: true,
                perPage:15
            }"
            :select-options="{
                enabled: checkbox,
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
                    <Pagination :total="total" :current="current" :per-page="perPage"
                        @page-changed="changePage" :perPageChanged="props.perPageChanged">
                    </Pagination>
                </div>
            </template>
        </vue-good-table>
    </div>
</template>
<script>
import SkeletonTable from "@/components/Skeleton/Table";
import Pagination from "@/components/Pagination";
import Tooltip from "@/components/Tooltip";
import Button from "@/components/Button";
import Icon from "@/components/Icon";
import { useListStore } from "@/store/list";
const list_store = useListStore();
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
export default {
    props:{
        rows:{
            type:Array,
            default:[]
        },
        columns:{
            type:Array,
            default:[]
        },
        checkbox:{
            type:Boolean,
            default:false
        },
        actionHeader:{
            type:Boolean,
            default:true
        },
        loading:{
            type:Boolean,
            default:false
        },
        select_row:{
            type:Boolean,
            default:false
        },
        total:{
            type:Number,
            default:1
        },
        current:{
            type:Number,
            default:1
        },
        perPage:{
            type:Number,
            default:15   
        }
    },
    components:{
        Pagination,
        Tooltip,
        Button,
        Icon,
        SkeletonTable,
    },
    data(){
        return{
            list_store,
            incident_status_color
        }
    },
    computed:{

    },
    methods:{
        rowStyleClassFn(row){
            return 'VGT-row';
        },
        onRowClick(row) {
            if(row.column.field != 'action'){
                const id = row.row.id;
                if(!this.select_row){
                    if(this.$route.params.module == 'workflow'){
                        this.$router.push({name:'save_workflow',params:{id:id,module:'workflow'}});
                    }
                    else{
                        this.$router.push({name:'view',params:{id:id,action:'detail'}});
                    }
                }
                else{
                    this.$emit('related_selected_row',this.modules,id);
                }
            }
        },
        changePage(event){
            this.$emit("pageChange",event)
        },
        selected_row_change(row){
            this.$emit("selecte_row_change",row)
        },
        del(id,index){
            this.$emit("delete",id,index);
        }
    }
}
</script>
<style>
  .VGT-row:hover{
    background: rgb(241, 241, 241);
    cursor: pointer;
  }
</style>