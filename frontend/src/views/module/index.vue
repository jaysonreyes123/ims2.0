<template>
    <div>
        <Breadcrumb/>
        <div class="lg:grid lg:grid-cols-2 mb-2">
            <div class="flex">
                    <InputGroup class="w-4/5" type="text" placeholder="Search" prependIcon="heroicons-outline:search" merged />
                    <Button
                        icon="heroicons-outline:adjustments-horizontal"
                        text="Filters"
                        btnClass="btn-outline-dark ml-2 py-2"
                    />
             
            </div>
            <div>
                <div class="lg:float-right">
                    <router-link :to="`${this.$route.params.module}/edit`">
                        <Button
                        icon="heroicons-outline:plus"
                        :text="`Add new ${this.$route.params.module}`"
                        btnClass="btn-danger mr-2 py-2"
                        />
                    </router-link>
                    <Button
                    icon="heroicons-outline:arrow-down-tray"
                    text="Import"
                    btnClass="btn-outline-danger py-2"
                    />
                </div>
            </div>
        </div>
        <component :is="Modules"></component>
    </div>
</template>
<script>
import InputGroup from "@/components/InputGroup";
import Breadcrumb from "../components/Breadcrumb.vue";
import Incident from "./incident/index.vue";
import Resources from "./resources/index.vue"
import Textinput from "@/components/Textinput";
import Button from '@/components/Button';
import Icon from "@/components/Icon";
export default {
    components:{
        Breadcrumb,
        Textinput,
        Button,
        Icon,
        InputGroup,
        Incident,
        Resources
    },
    data(){
        return{
            modules:""
        }
    },
    computed:{
        Modules(){
            const module_  = this.$route.params.module;
            switch (module_) {
                case 'incidents':
                    this.modules = 'Incident';
                    break;
                case 'resources':
                    this.modules = 'Resources';
                    break;
            
                default:
                    break;
            }
            return this.modules;
        }
    },
    methods:{
        changePage(data){
            console.log(data)
        }
    }
}
</script>

<style>

</style>