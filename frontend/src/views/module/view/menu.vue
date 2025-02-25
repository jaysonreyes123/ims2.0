<template lang="">
    <div>
        <Card>
            <span v-if="this.$route.params.module =='incidents'">
                <router-link
                v-for="(item,i) in summary_button"
                :key="i"
                :to="{name:'view',params:{action:item.name,id:this.$route.params.id}}"
                >
                <Button
                    :text="item.text"
                    btnClass="btn-default"
                    :class="item.name == this.$route.params.action ? 'bg-danger-500 text-white' : '' "
                />
                </router-link>
            </span>
            <router-link
                v-for="(item,i) in menu_button"
                :key="i"
                :to="{name:'view',params:{action:item.name,id:this.$route.params.id}}"
            >
            <Button
                :text="item.text"
                btnClass="btn-default"
                :class="item.name == this.$route.params.action ? 'bg-danger-500 text-white' : '' "
            />
            </router-link>
            <router-link
                v-for="(item,i) in related_store.related_menu"
                :key="i"
                :to="{name:'related_list',params:{module:this.$route.params.module,related_module:item.related_menus.name,id:this.$route.params.id}}"
            >
                <Button
                    :text="item.label"
                    btnClass="btn-default"
                     :class="item.related_menus.name == this.$route.params.related_module ? 'bg-danger-500 text-white' : '' "
                />
            </router-link>
        </Card>
    </div>
</template>
<script>
import Card from "@/components/Card";
import Button from "@/components/Button";
import { useRelatedStore } from "@/store/related";
import { useModuleStore } from "@/store/module";
const module_store = useModuleStore();
const related_store = useRelatedStore();
const menu_button = 
[
    {
        name:"detail",
        text:"Detail",
        icon:"heroicons-outline:newspaper"
    },
    {
        name:"update",
        text:"Update",
        icon:"heroicons-outline:newspaper"
    },
]
const summary_button = 
[
    {
        name:"Summary",
        text:"Summary",
        icon:"heroicons-outline:newspaper"
    },
]
export default {
    components:{
        Button,
        Card
    },
    data(){
        return{
            related_store,
            menu_button,
            summary_button
        }
    }
}
</script>
<style lang="">
    
</style>