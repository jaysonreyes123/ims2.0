<template lang="">
    <div>
        <Loading v-model:active="module_store.loading"/>
        <div v-if="!module_store.loading">
            <div  v-for="(block,index) in module_store.data.blocks" :key="index">
                <Card :title='block.block' class='mt-4 shadow-sm' v-if="block.block == 'Location Details' ">
                <div class="lg:grid lg:grid-cols-2 gap-12 mt-4">
                    <div>
                        <div class="fromGroup relative" v-for="(field,i) in block.fields" :key="i">
                        <label for="">{{field.label}}</label>
                            <span>{{ module_store.form[field.name] }}</span>
                        </div>
                    </div>
                    <div>
                        <Map :set_coordinates="module_store.form.coordinates" />
                    </div>
                </div>
                </Card>
                <Card v-else :title="block.block" class="mt-4 shadow-sm">
                    <div class="lg:grid gap-x-12" style="grid-template-columns: 1fr 1fr;"> 
                        <div v-for="(field,i) in block.fields" :key="i" :class="`custom-grid-${i%2}`" class="mt-4">
                            <div class="fromGroup relative" v-if="field.type == 'checkbox' ">
                                <label>{{ field.label }}</label>
                                <Badge v-if="module_store.form[field.name]" label="Active" badgeClass="bg-success-500 text-white" />
                                <Badge v-if="!module_store.form[field.name]" label="Inactive" badgeClass="bg-danger-500 text-white" />
                            </div>
                            <div class="fromGroup relative" v-else-if="field.type == 'relation' ">
                                <label>{{ field.label }}</label>
                                <div v-if="field.related_fields">
                                    <a :title="module_store.relation_field[field.name]" :href="`/app/module/${moduleDetails(field.related_fields.related_module).name}/detail/${module_store.form[field.name]}`" 
                                    class="text-blue-600">
                                        {{module_store.relation_field[field.name]}}
                                    </a>
                                </div>
                            </div>
                            <div class="fromGroup relative" v-else>
                                <label>{{ field.label }}</label>
                                <span>{{ module_store.form[field.name] }}</span>
                            </div>
                        </div>
                    </div>
                </Card>
            </div>
            <Card title="System Generated" class="mt-4 shadow-sm">
                <div class="lg:grid lg:grid-cols-2 gap-12 mt-4">
                <div class="fromGroup relative">
                        <label for="" >Created time</label>
                        <span>{{ module_store.form.created_at }}</span>
                    </div>
                    <div class="fromGroup relative">
                        <label for="" >Created By</label>
                        <span>{{ module_store.form.created_by }}</span>
                    </div>
                </div>
                <div class="lg:grid lg:grid-cols-2 gap-12">
                    <div class="fromGroup relative">
                        <label for="" >Last updated</label>
                        <span>{{ module_store.form.updated_at }}</span>
                    </div> 
                    <div class="fromGroup relative">
                        <label for="" >Last updated by</label>
                        <span>{{ module_store.form.updated_by }}</span>
                    </div> 
                </div>
            </Card>
        </div>
    </div>
</template>
<script>
import Badge from "@/components/Badge";
import { useModuleStore } from '@/store/module';
import Card from "@/components/Card";
import { ref } from 'vue';
import Map from "../map/edit_map.vue"
import { useAuthStore } from "@/store/auth";
const auth_store = useAuthStore();
const module_store = useModuleStore();
const modules = ref("");
const module_id = ref("");
export default {
    name:'detail',
    props:{
        props_id:{
            type:String,
            default:"",
        },
        props_module:{
            type:String,
            default:""
        }
    },
    components:{
        Card,
        Map,
        Badge
    },
    data(){
        return{
            module_store
        }
    },
    created(){
        modules.value = this.props_module == "" ?  this.$route.params.module : this.props_module;
        module_id.value = this.props_id == "" ?  this.$route.params.id : this.props_id;
        this.$watch( 
            ()=>this.$route.params.id,
            (id) => {
                module_store.get_edit_form(id,'detail');
            }
        )
    },
    mounted(){
        module_store.module = modules.value;
        module_store.get_edit_form(module_id.value,'detail');
        //module_store.get(module_id.value);
    },
    methods:{
        moduleDetails(moduleid){
            const current_module = moduleid;
            const module_info = auth_store.module.find(module__ => module__.id == current_module );
            return module_info;
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