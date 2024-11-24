<template>
    <div>
        <Breadcrumb mode='edit' />
        <!-- <Loading v-model:active="loading"/> -->
        <form @submit.prevent="saveForm">
          <component :is="Modules()"></component>
         <Block>
            <Button class="w-full bg-emerald-500/100 hover:bg-emerald-600/100" :text="saveBtn" />
        </Block>
        </form>
    </div>
</template>
<script>
import Breadcrumb from "../components/Breadcrumb.vue";
import Block from "../components/Block";
import Button from "@/components/Button";
import {ref} from "vue";

import Incident from "./incident/edit.vue";
import Resources from "./resources/edit.vue";

import { useIncidentStore } from "@/store/incident";
import { useResourcesStore } from "@/store/resources";

const IncidentStore = useIncidentStore();
const ResourceStore = useResourcesStore();

const modules = ref();
const module_use_store = ref();
export default {
    components:{
        Breadcrumb,
        Block,
        Button,
        Incident,
        Resources
    },
    data(){
        return{
            saveBtn:"Save "+this.$route.params.module,
            modules,
            module_use_store,
            view:'Incident'
        }    
    },
    created(){
        if(this.$route.params.id != ""){
            this.getData();
        }
        else{
            this.ModuleUseStore.clearField();
        }
        console.log(this.ModuleUseStore)
    },
    computed:{
        
        ModuleUseStore(){
            const modules__ = this.$route.params.module;
            switch (modules__) {
                case 'incidents':
                    this.module_use_store = IncidentStore;
                    break;
                case 'resources':
                    this.module_use_store = ResourceStore;
                    break;
                default:
                    break;
            }
            return this.module_use_store;
        }
    },
    methods:{
        Modules(){
            const module_  = this.$route.params.module;
            var modules__ = "";
            switch (module_) {
                case 'incidents':
                    modules__ = "Incident";
                    break;
                case 'resources':
                    modules__ = "Resources";
                    break;
            
                default:
                    break;
            }
            return modules__;
        },
        saveForm(){
            this.ModuleUseStore.save(); 
        },
        getData(){
            this.ModuleUseStore.id = this.$route.params.id;
            this.ModuleUseStore.getItem();
        },
    }
}
</script>

<style>

</style>