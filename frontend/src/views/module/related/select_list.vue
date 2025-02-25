<template lang="">
    <div>
        <Loading v-model:active="related_store.loading"/>
        <Modal :title="`Select ${related_module}`" :activeModal="related_store.select_list_modal" @close="closeModal" sizeClass="max-w-7xl">
            <Table 
                @selectionChanged="selectionChanged" 
                :loading="related_store.loading" 
                :rows="related_store.list_data_remove_relation"
                :perPage="related_store.page.per_page"
                :total="related_store.page.total"
                :current="related_store.page.current"
                @changePage="changePage"
                @search="search"
                @clearsearch="clearsearch"
                :action="0"
                :clearbutton="clearbutton"
            />
            <footer class="mt-12">
                <div class="w-full flex justify-between mt-5">
                    <Button text="Close" btnClass="btn-dark" @click="closeModal()" />
                    <Button :text="`Save ${related_module}`" btnClass="btn-danger" @click="SaveSelect()" />
                </div>
            </footer>
        </Modal>
    </div>
</template>
<script>
import Table from "./table.vue";
import Modal from '@/components/Modal';
import Button from '@/components/Button';
import { useListStore } from "@/store/list";
import { useRelatedStore } from "@/store/related";
import { ref } from "vue";
const list_store = useListStore();
const related_store = useRelatedStore();
const selected_row = ref([]);
const clearbutton = ref(false);
export default {
    props:{
        module:String,
        related_module:String,
        module_id:{
            type:String,
            default:0
        }
    },
    components:{
        Modal,
        Button,
        Table
    },
    data(){
        return{
            list_store,
            related_store,
            clearbutton
        }
    },
    created(){
        this.$watch(
            ()=>related_store.select_list_modal,
            (modal) => {
                if(modal){
                    related_store.search = "";
                    related_store.page.current = 1;
                    related_store.list_data_remove_relation = [];
                    related_store.get_related_list(this.module_id,this.module,this.related_module,1);
                }
                else{   
                    if(related_store.search != ''){
                        related_store.search = "";
                        clearbutton.value = false;
                    }
                }
            }
        )
    },
    methods:{
        closeModal(){
            related_store.select_list_modal = false;
        },
        SaveSelect(){
            const form = {};
            form.selected_row = selected_row.value;
            form.module = this.module;
            form.related_module = this.related_module;
            form.id = this.module_id;
            related_store.save_selected_row(form);
        },
        selectionChanged(selectedrow){
            selected_row.value = selectedrow.map(row => row.id);
        },
        changePage(event){
            related_store.page.current = event;
            this.load_table();
        },
        search(){
            clearbutton.value = true;
            this.load_table();
        },
        clearsearch(value){
            if(!value){
                related_store.search = "";
                clearbutton.value = false;
                this.load_table();
            }
        },
        load_table(){
            related_store.get_related_list(this.module_id,this.module,this.related_module,1);
        }
    }
}
</script>