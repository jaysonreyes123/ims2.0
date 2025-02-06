<template lang="">
    <div>
        <Loading v-model:active="media.loading" />
        <Card title="Media">
            <div class="grid lg:grid-cols-2 mt-4 mb-4">
                <div class="flex">
                    <InputGroup type="text" class="w-3/5" v-model="list.search" placeholder="Search...">
                        <template v-slot:append>
                            <Button :disabled="list.filter_data.length > 0 ? true : false" @click="searchBtn" icon="heroicons-outline:search" 
                                btnClass="btn-outline-dark disabled:bg-slate-300 disabled:cursor-not-allowed" />
                        </template>
                    </InputGroup>
                    <Button
                            v-if="is_search"
                            icon="heroicons-outline:x-mark"
                            text="Clear Search"
                            btnClass="btn-outline-danger ml-2 py-2"
                            @click="clearSearch"
                    />
                </div>
                <div class="flex justify-end">
                    <Button
                        icon="heroicons-outline:plus"
                        text="Add Media"
                        btnClass="btn-danger mr-2 py-2"
                        @click="openModal"
                    />
                </div>
            </div>
            <vue-good-table :isLoading.sync="list.loading" :columns="columns"
                styleClass=" vgt-table  lesspadding2 centered " :rows="list.list_relation" :pagination-options="{
                enabled: true,
                perPage:15
            }"  max-height="600px" :select-options="{
                enabled: false,
                selectOnCheckboxOnly: true, // only select when checkbox is clicked instead of the row
                selectioninfoClass: 'custom-class',
                selectionText: 'rows selected',
                clearSelectionText: 'clear',
                disableSelectinfo: true, // disable the select info-500 panel on top
                selectAllByGroup: true, // when used in combination with a grouped table, add a checkbox in the header row to check/uncheck the entire group
            }">
                <template v-slot:table-row="props">
                    <span v-if="props.column.field == 'action'">
                        <div class="flex space-x-3 justify-center rtl:space-x-reverse">
                            <Tooltip placement="top" arrow theme="dark" v-if="props.row.view != '' ">
                                <template #button>
                                    <a @click="preview(props.row.filename,props.row.view,props.row.filetype)">
                                        <div class="action-btn">
                                            <Icon icon="heroicons:eye" />
                                        </div>
                                    </a>
                                </template>
                                <span>Preview</span>
                            </Tooltip>
                            <Tooltip placement="top" arrow theme="dark" v-else ">
                                <template #button>
                                    <a>
                                        <div class="action-btn text-red-500 cursor-no-drop">
                                            <Icon icon="heroicons:eye-slash" />
                                        </div>
                                    </a>
                                </template>
                                <span>No Preview</span>
                            </Tooltip>
                            <Tooltip placement="top" arrow theme="dark">
                                <template #button>
                                    <div class="action-btn text-blue-500" @click="download(props.row.filename,props.row.extension,props.row.path)">
                                        <Icon icon="heroicons:document-arrow-down" />
                                    </div>
                                </template>
                                <span>Download</span>
                            </Tooltip>
                            <Tooltip placement="top" arrow theme="danger-500">
                                <template #button>
                                    <div class="action-btn text-red-500" @click="del(props.row.id,props.row.filename,props.row.extension)">
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
                        <Pagination :total="list.total" :current="list.current" :per-page="list.per_page"
                            @page-changed="changePage" :perPageChanged="props.perPageChanged">
                        </Pagination>
                    </div>
                </template>
            </vue-good-table>
        </Card>
        <modal :preview-content="preview_content_data" />
    </div>
</template>
<script>
import Card from "@/components/Card";
import Icon from "@/components/Icon";
import Tooltip from "@/components/Tooltip";
import Pagination from "@/components/Pagination";
import { useMediaStore } from "@/store/media";
import Swal from 'sweetalert2';
// import add_media from "./add_media.vue";
import InputGroup from "@/components/InputGroup";
import modal from "./modal.vue";
import Button from '@/components/Button';
import { ref } from "vue";
import { useListStore } from "@/store/list";
const list = useListStore();
const is_search = ref(false);
const media = useMediaStore();
const current = ref(15);
const per_page = ref(15);
const preview_content_data = ref("");
const columns=[
    {
        label: "File Name",
        field: "filename",
    },
    {
        label: "Extionsion",
        field: "extension",
    },
    {
        label: "Action",
        field: "action",
    },
]
export default {
    components:{
        Card,
        Icon,
        Tooltip,
        Button,
        modal,
        Pagination,
        Swal,
        InputGroup

    },
    data(){
        return{
            media,
            columns,
            current,
            per_page,
            preview_content_data,
            list,
            is_search
        }
    },
    mounted(){
        list.List_Relation('media',this.$route.params.id);
    },
    methods:{
        openModal(){
            media.title = "Media";
            media.modal = true;
        },
        preview(name,data,type){
            preview_content_data.value = {name:name,preview:data,type:type};
            media.title = "Preview";
            media.modal = true;
        },
        changePage(event){
            list.current = event;
            list.List_Relation('media',this.$route.params.id);
        },
        searchBtn(){
            if(list.search != ""){
                is_search.value = true;
                list.List_Relation("media",this.$route.params.id);
            }
        },
        clearSearch(){
            list.search = "";
            is_search.value = false;
            list.List_Relation('media',this.$route.params.id);
        },
        download(filename,extension,path){
            media.download(filename,extension,path);
        },
        del(id,name,extension){
            const filename = name+"."+extension;
            Swal.fire({
            title: "Do you want to delete this "+filename+" ?", 
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!", 
            }).then((result) => { 
                if (result.isConfirmed) {
                    list.Delete_Relation("media",this.$route.params.id,id);
                } 
            });
        }
    }
}
</script>
<style lang="">
    
</style>