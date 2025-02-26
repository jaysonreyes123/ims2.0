<template lang="">
    <div>
        <Card class="shadow-lg">
        <div class="grid grid-cols-1 md:grid-cols-3">
            <div class="flex mb-4">
                <InputGroup v-model="related_store.search" class="w-full" type="text" placeholder="Search...">
                    <template v-slot:append>
                        <Button 
                            @click="searchBtn"
                            icon="heroicons-outline:search" 
                            btnClass="btn-outline-dark disabled:bg-slate-300 disabled:cursor-not-allowed" />
                    </template>
                </InputGroup>
                <Button
                    v-if="clearbutton"
                    icon="heroicons-outline:x-mark"
                    text="Clear Search"
                    btnClass="btn-outline-danger ml-2 py-2"
                    @click="clearSearch"
                />
            </div>
        </div>
        <vue-good-table :fixed-header="true" :isLoading.sync="loading" :columns="columns"
        v-on:selected-rows-change="selectionChanged"
                styleClass=" vgt-table  lesspadding2 " :rows="rows" :pagination-options="{
                enabled: true,
                perPage:15
            }"   max-height="600px" :select-options="{
                enabled: true,
                selectOnCheckboxOnly: true, // only select when checkbox is clicked instead of the row
                selectioninfoClass: 'custom-class',
                selectionText: 'rows selected',
                clearSelectionText: 'clear',
                disableSelectinfo: true, // disable the select info-500 panel on top
                selectAllByGroup: true, // when used in combination with a grouped table, add a checkbox in the header row to check/uncheck the entire group
            }">
            <template v-slot:table-row="props">
                <span v-if="props.column.field == 'action' && action == 1 ">
                    <div class="flex space-x-3 rtl:space-x-reverse">
                        <Tooltip placement="top" arrow theme="dark" v-if="props.row.view != '' && this.$route.params.related_module == 'media' ">
                            <template #button>
                                <a @click="preview(props.row.filename,props.row.path,props.row.filetype)">
                                    <div class="action-btn">
                                        <Icon icon="heroicons:photo" />
                                    </div>
                                </a>
                            </template>
                            <span>Preview</span>
                        </Tooltip>
                        <Tooltip placement="top" arrow theme="dark">
                            <template #button>
                                    <div class="action-btn" @click="view(props.row.id)">
                                        <Icon icon="heroicons:eye" />
                                    </div>
                            </template>
                            <span> View</span>
                        </Tooltip>
                        <Tooltip v-if="this.$route.params.related_module != 'media'" placement="top" arrow theme="dark">
                            <template #button>
                                    <div class="action-btn" @click="edit(props.row.id)">
                                        <Icon icon="heroicons:pencil-square" />
                                    </div>
                            </template>
                            <span> Edit</span>
                        </Tooltip>
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
    </Card>
    <RelatedModal :title="modules_.label" />
    <MediaModal :preview-content="preview_content_data"/>
    </div>
</template>
<script>
import InputGroup from "@/components/InputGroup";
import Card from "@/components/Card";
import Pagination from "@/components/Pagination";
import Tooltip from "@/components/Tooltip";
import Button from "@/components/Button";
import Icon from "@/components/Icon";
import { useRelatedStore } from '@/store/related';
import {useAuthStore} from "@/store/auth";
import { useMediaStore } from "@/store/media";
import { ref } from "vue";
import Swal from 'sweetalert2';
import RelatedModal from "./modal.vue";
import MediaModal from "../media/modal.vue";
const is_search = ref(false);
const search = ref("");
const related_store = useRelatedStore();
const auth_store = useAuthStore();
const media_store = useMediaStore();
const preview_content_data = ref("");
export default {
    props:{
        rows:Array,
        loading:{
            type:Boolean,
            default:false
        },
        perPage:{
            type:Number,
            default:1
        },
        current:{
            type:Number,
            default:1
        },
        total:{
            type:Number,
            default:0
        },
        action:{
            type:Number,
            default:1
        },
        clearbutton:Boolean

    },
    components:{
        Card,
        InputGroup,
        Pagination,
        Tooltip,
        Button,
        Icon,
        RelatedModal,
        MediaModal
    },
    data(){
        return{
            related_store,
            is_search,
            search,
            preview_content_data
        }
    },
    computed:{
        columns(){
            const columns_ = related_store.columns_header;
            return columns_;
        },
        modules_(){
            const current_module = this.$route.params.related_module;
            const module_info = auth_store.module.find(module__ => module__.name == current_module );
            return module_info;
        },
    },
    mounted(){
        search.value = "";
        is_search.value = false;
    },
    methods:{
        selectionChanged(event){
            this.$emit("selectionChanged",event.selectedRows);
        },
        changePage(event){
            this.$emit("changePage",event)
        },
        searchBtn(){
            if(related_store.search != ""){
                this.$emit("search")
            }
        },
        clearSearch(){
            search.value = "";
            is_search.value = false;
            this.$emit("clearsearch",is_search.value)
        },
        del(id,index){
            const module_ = this.modules_.label;
            Swal.fire({
            title: "Unlink "+module_+" ", 
            text: "Are you sure you want to unlink this "+module_+"? ",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            confirmButtonText: "Unlink",
            cancelButtonColor: "#3085d6",
            reverseButtons: true, 
            }).then((result) => { 
                if (result.isConfirmed) {
                    related_store.delete(this.$route.params.module,this.$route.params.related_module,this.$route.params.id,id,index);
                } 
            });
        },
        view(id){
            related_store.method = "view";
            related_store.id = id;
            related_store.related_module = this.$route.params.related_module;
            related_store.modal = true;
        },
        edit(id){
            related_store.method = "edit";
            related_store.id = id;
            related_store.loading = true;
            related_store.modal = true;
        },
        preview(name,data,type){
            preview_content_data.value = {name:name,preview:data,type:type};
            media_store.title = "Preview";
            media_store.modal = true;
        },
    }
}
</script>
<style lang="">
    
</style>