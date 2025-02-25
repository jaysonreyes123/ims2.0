<template lang="">
    <div>
        <div class="mb-4 flex justify-between items-center">
            <div class="flex">
                <router-link :to=" {name:'list',params:{module:module_}} ">
                        <span class="capitalize font-bold">{{ modules_.label }}</span>
                </router-link>
                <Icon class="mt-[4px] ml-1" icon="heroicons-outline:chevron-right"></Icon> 
                
                <span class='flex ml-1 mt-[1px]' v-if="mode == 'view'">
                    <router-link :to=" {name:'list',params:{module:module_}} ">
                        <span class="ml-1 mt-[1px] font-bold">All</span>
                    </router-link>
                    <Icon class="mt-[5px] ml-1" icon="heroicons-outline:chevron-right"></Icon> 
                    <span class="ml-1 mt-[1px]">{{module_store.entityname}}</span>
                </span>
                <span class='flex ml-1 mt-[1px]' v-else-if="mode == 'save'">
                    <router-link :to=" {name:'list',params:{module:module_}} ">
                        <span class="ml-1 mt-[1px] font-bold">All</span>
                    </router-link>
                    <span class="flex" v-if="id == '' || id == undefined ">
                        <Icon class="mt-[5px] ml-1" icon="heroicons-outline:chevron-right"></Icon> 
                        <span class="ml-1 mt-[1px]">Adding new</span>
                    </span>
                    <span class="flex" v-else>
                        <Icon class="mt-[3px] ml-1" icon="heroicons-outline:chevron-right"></Icon> 
                        <span class="ml-1 mt-[0px]">Editing : {{module_store.entityname}}</span>
                    </span>
                </span>
                <span v-else class="ml-1 mt-[1px]">
                    <span >All</span>
                </span>
                
            </div>
            <div v-if="mode == 'view' ">
                <router-link :to=" {name:'edit',params:{module:module_,id:id}} ">
                    <Button
                        icon="heroicons-outline:pencil-square"
                        text="Edit"
                        btnClass="btn-danger shadow-base2"
                        iconPosition="left"
                    />
                </router-link>
                <router-link target="_blank" class="ml-3" :to=" {name:'print',params:{module:module_,id:id}} " v-if="module_ == 'incidents' ">
                    <Button
                        icon="heroicons-outline:printer"
                        text="Print"
                        btnClass="btn-danger shadow-base2"
                        iconPosition="left"
                    />
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
import Icon from "@/components/Icon";
import Button from "@/components/Button";
import { ref } from "vue";
import { useAuthStore } from "@/store/auth";
import {useModuleStore} from "@/store/module";
const auth_store = useAuthStore();
const module_store = useModuleStore();
const module_ = ref("");
const id = ref(0);
export default {
    components:{
        Icon,
        Button,
    },
    data(){
        return{
           module_,id,module_store
        }
    },
    created(){
        this.$watch(
            ()=>this.$route.params.module,
            (modules) => {
                module_.value = modules;
            }
        )
        module_.value = this.$route.params.module;
        id.value = this.$route.params.id;
    },
    mounted(){
        
    },
    computed:{
        modules_(){
            const current_module = this.$route.params.module;
            const module_info = auth_store.module.find(module__ => module__.name == current_module );
            return module_info;
        },
    },
    props:{
        mode:{
            type:String,
            default:"list"
        }
    }
}
</script>
<style lang="">
    
</style>