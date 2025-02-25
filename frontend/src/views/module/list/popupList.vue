<template lang="">
    <div>
        <Modal :title="`Select ${modules_.label}`" :activeModal="list_store.modal" @close="closeModal" sizeClass="max-w-7xl">
            <Table 
                :checkbox="false"
                :actionHeader="false"
                :select_row="true"
                :loading="list_store.loading"
                :rows="list_store.list_data"
                :columns="columns_"
                :total="list_store.page.total"
                :perPage="list_store.page.per_page"
                :current="list_store.page.current"
                @related_selected_row="related_selected_row"
                @pageChange="pageChange"
            />
        </Modal>
    </div>
</template>
<script>
import Table from "./table.vue";
import Modal from '@/components/Modal';
import Button from '@/components/Button';
import { useListStore } from "@/store/list";
import { useAuthStore } from "@/store/auth";
const auth_store = useAuthStore();
const list_store = useListStore();
export default {
    props:{
        module_:{
            type:String,
            default:""
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
        }
    },
    computed:{
        modules_(){
            const current_module = this.module_;
            const module_info = auth_store.module.find(module__ => module__.name == current_module );
            return module_info;
        },
        columns_(){
            return list_store.columns_header.filter(column => column.field !='action' );
        }
    },
    mounted(){
        console.log("Test")
        list_store.module = this.module_;
        list_store.clear();
        list_store.get_column();
    },
    methods:{
        closeModal(){
            list_store.modal = false;
            if(list_store.page.current != 1){
                this.pageChange(1);
            }
        },
        related_selected_row(module,id){
            this.$emit('related_selected_row',this.module_,id);
        },
        pageChange(page){
        list_store.page.current = page;
        list_store.list_function(list_store.module);
      } 
    }
}
</script>