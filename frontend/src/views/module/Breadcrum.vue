<template lang="">
    <div>
        <div class="mb-4 flex justify-between items-center">
            <div class="flex">
                <span class="capitalize font-bold">{{ modules_.label }}</span>
                <Icon class="mt-[5px] ml-1" icon="heroicons-outline:chevron-right"></Icon> 
                <span class="ml-1 mt-[1px]">All</span>
            </div>
            <div v-if="mode != 'list' ">
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
const auth_store = useAuthStore();
const module_ = ref("");
const id = ref(0);
export default {
    components:{
        Icon,
        Button,
    },
    data(){
        return{
           module_,id
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
        }
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