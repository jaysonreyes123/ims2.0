<template lang="">
    <div>
        <Card class="mt-4" :title="modules_.label" >
            <br>
            <div class="flex justify-end">
            <Button
                v-if="this.$route.params.related_module == 'media' "
                        icon="heroicons-outline:plus"
                        :text="`New ${this.$route.params.related_module}`"
                        btnClass="btn-danger mr-2 py-2"
                        @click="openMediaModal"
            />
            <Button
               v-else
                        icon="heroicons-outline:plus"
                        :text="`New ${this.$route.params.related_module}`"
                        btnClass="btn-danger mr-2 py-2"
                        @click="openSaveRelatedModal"
            />
            </div>
            <Modal :preview-content="preview_content_data"/>
            <RelatedModal :method="method" :title="modules_.label" />
            <br>
            <br>
            <vue-good-table :fixed-header="true" :isLoading.sync="related_store.loading" :columns="related_store.columns_header"
                styleClass=" vgt-table  lesspadding2 centered " :rows="related_store.list_data" :pagination-options="{
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
                    <span v-if="props.column.field == 'action'">
                        <div class="flex space-x-3 justify-center rtl:space-x-reverse">
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
                        <Pagination :total="related_store.page.total" :current="related_store.page.current" :per-page="related_store.page.per_page"
                            @page-changed="changePage" :perPageChanged="props.perPageChanged">
                        </Pagination>
                    </div>
                </template>
            </vue-good-table>
        </Card>
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
import Modal from "../media/modal.vue";
import { useMediaStore } from "@/store/media";
import { ref } from "vue";
import {useAuthStore} from "@/store/auth";
import RelatedModal from "./modal.vue";
import Swal from 'sweetalert2';
const auth_store = useAuthStore();
const related_store = useRelatedStore();
const media_store = useMediaStore();
const preview_content_data = ref("");
const method = ref("");
export default {
    components:{
        Card,
        InputGroup,
        Pagination,
        Tooltip,
        Button,
        Icon,
        Modal,
        RelatedModal
    },
    data(){
        return{
            related_store,
            preview_content_data,
            method
        }
    },
    created(){
        related_store.page.current = 1;
        related_store.modal = false;
        this.$watch(
            ()=>this.$route.params.related_module,
            (modules) => {
                const params = this.$route.params;
                related_store.get_column(params.id,params.module,params.related_module);
            }
        )
    },
    mounted(){
        const params = this.$route.params;
        related_store.get_column(params.id,params.module,params.related_module);
    },
    computed:{
        modules_(){
            const current_module = this.$route.params.related_module;
            const module_info = auth_store.module.find(module__ => module__.name == current_module );
            return module_info;
        }
    },
    methods:{
        openMediaModal(){
            media_store.title = 'Media';
            media_store.modal = true;
        },
        changePage(event){
            related_store.page.current = event;
            related_store.get_related_list(this.$route.params.id,this.$route.params.module,this.$route.params.related_module);
        },
        preview(name,data,type){
            preview_content_data.value = {name:name,preview:data,type:type};
            console.log(preview_content_data.value)
            media_store.title = "Preview";
            media_store.modal = true;
        },
        openSaveRelatedModal(){
            method.value = "edit";
            related_store.id = "";
            related_store.modal = true;
        },
        edit(id){
            method.value = "edit";
            related_store.id = id;
            related_store.loading = true;
            related_store.modal = true;
        },
        view(id){
            method.value = "view";
            related_store.id = id;
            related_store.related_module = this.$route.params.related_module;
            related_store.modal = true;
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
        }
    }
}
</script>
<style lang="">
    
</style>