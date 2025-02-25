<template lang="">
    <div>
        <div  v-for="blocks in related_store.blocks" :key="blocks.id" class="mt-4">
            <Card :title="blocks.blocks[0].block">
                <div class="lg:grid gap-x-12" style="grid-template-columns: 1fr 1fr;"> 
                    <div v-for="(field,i) in blocks.blocks[0].fields" :key="i" :class="`custom-grid-${i%2}`" class="mt-4">
                        <div class="fromGroup relative" v-if="field.type == 'checkbox' ">
                            <label>{{ field.label }}</label>
                            <Badge v-if="module_store.form[field.name]" label="Active" badgeClass="bg-success-500 text-white" />
                            <Badge v-if="!module_store.form[field.name]" label="Inactive" badgeClass="bg-danger-500 text-white" />
                        </div>
                        <div class="fromGroup relative" v-else>
                            <label>{{ field.label }}</label>
                            <span>{{ module_store.form[field.name] }}</span>
                        </div>
                    </div>
                </div>
            </Card>
        </div>
        <Card class="mt-4" :title="modules_.label" >
            <br>
            <div class="flex justify-end">
                <div v-for="item in get_related_menu_action" :key="item">
                    <Button
                        v-if="item == 'add'"
                        icon="heroicons-outline:plus"
                        :text="`New ${modules_.label}`"
                        btnClass="btn-danger mr-2 py-2"
                        @click="this.$route.params.related_module == 'media' ? openMediaModal() : openSaveRelatedModal()"
                    />
                    <Button
                        v-if="item == 'select'"
                        icon="heroicons-outline:plus"
                        :text="`Select ${modules_.label}`"
                        btnClass="btn-danger mr-2 py-2"
                        @click="openSelectRelatedModal"
                    />
                </div>
            </div>
            <SelectListModal :module_id="parseInt(this.$route.params.id)" :module="this.$route.params.module" :related_module="this.$route.params.related_module" />
            <br>
            <Table 
                :loading="related_store.loading" 
                :rows="related_store.list_data" 
                :perPage="related_store.page.per_page"
                :total="related_store.page.total"
                :current="related_store.page.current"
                @changePage="changePage"
                @search="search"
                @clearsearch="clearsearch"
                :clearbutton="clearbutton"
            />
        </Card>
    </div>
</template>
<script>
import Badge from "@/components/Badge";
import Table from "./table.vue";
import InputGroup from "@/components/InputGroup";
import Card from "@/components/Card";
import Pagination from "@/components/Pagination";
import Tooltip from "@/components/Tooltip";
import Button from "@/components/Button";
import Icon from "@/components/Icon";
import { useRelatedStore } from '@/store/related';
import Modal from "../media/modal.vue";
import SelectListModal from "./select_list.vue";
import { useMediaStore } from "@/store/media";
import { ref } from "vue";
import {useAuthStore} from "@/store/auth";
import RelatedModal from "./modal.vue";
import { useListStore } from "@/store/list";
import { useModuleStore } from "@/store/module";
const list_store = useListStore();
const auth_store = useAuthStore();
const related_store = useRelatedStore();
const method = ref("");
const clearbutton = ref(false);
const media_store = useMediaStore();
const module_store = useModuleStore();
export default {
    components:{
        Card,
        InputGroup,
        Pagination,
        Tooltip,
        Button,
        Icon,
        Modal,
        RelatedModal,
        Table,
        SelectListModal,
        Badge
    },
    data(){
        return{
            related_store,
            method,
            clearbutton,
            module_store
        }
    },
    created(){
        this.clear();
        this.$watch(
            ()=>this.$route.params.related_module,
            (modules) => {
                this.set_initial();
                this.clear();
            }
        )
    },
    mounted(){
        this.set_initial();
    },
    computed:{
        modules_(){
            const current_module = this.$route.params.related_module;
            const module_info = auth_store.module.find(module__ => module__.name == current_module );
            return module_info;
        },
        get_related_menu_action(){
            const related_id = this.modules_.id;
            const menu_option = related_store.related_menu.find(menu => menu.related_module == related_id);
            return menu_option.action.split(",");
        }
    },
    methods:{
        clear(){
            related_store.page.current = 1;
            related_store.page.total = 0;
            related_store.modal = false;
            related_store.select_list_modal = false;
            related_store.search = "";
            related_store.blocks = [];
            clearbutton.value = false;
        },
        set_initial(){
            const params = this.$route.params;
            related_store.module = this.$route.params.module;
            related_store.related_module = this.$route.params.related_module;
            related_store.get_column(params.id,params.module,params.related_module);
            related_store.get_related_block();
        },
        openMediaModal(){
            media_store.title = 'Media';
            media_store.modal = true;
        },
        changePage(event){
            related_store.page.current = event;
            related_store.get_related_list(this.$route.params.id,this.$route.params.module,this.$route.params.related_module);
        },
        search(value){
            clearbutton.value = true;
            related_store.get_related_list(this.$route.params.id,this.$route.params.module,this.$route.params.related_module);
        },
        clearsearch(value){
            if(!value){
                related_store.search = "";
                clearbutton.value = false;
                related_store.get_related_list(this.$route.params.id,this.$route.params.module,this.$route.params.related_module);
            }
        },
        openSaveRelatedModal(){
            related_store.method = "edit";
            related_store.id = "";
            related_store.modal = true;
        },
        openSelectRelatedModal(){
            list_store.columns = [];
            list_store.list_data = [];
            related_store.select_list_modal = true;
        },
    }
}
</script>
<style scoped>
label{
  font-weight: bold;
}
.fromGroup{
  margin-bottom: 15px;
  display: flex;

}
.custom-grid-0{
    grid-column:1
}
.custom-grid-1{
    grid-column:2
}
.fromGroup label{
  overflow-wrap:break-word;
  width: 200px;
  margin-bottom: 0.5rem;
  font-size: 0.875rem;
  line-height: 1.5rem;
  text-transform: capitalize;
}
.fromGroup span{
  font-size: 0.875rem;
}
</style>