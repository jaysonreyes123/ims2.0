<template lang="">
    <div>
        <Breadcrum mode='view' />
        <Menu/>
        <div>
            <Comment v-if="this.$route.params.related_module == 'comments' " />
            <Relatedlist v-else/>
        </div>
    </div>
</template>
<script>
import Menu from '../view/menu.vue';
import Breadcrum from '../Breadcrum.vue';
import Relatedlist from './list.vue';
import Comment from "../comment/index.vue";
import { useAuthStore } from "@/store/auth";
const auth_store = useAuthStore();
export default {
    components:{
        Menu,
        Breadcrum,
        Relatedlist,
        Comment
    },
    computed:{
        modules_(){
            const current_module = this.$route.params.related_module;
            const module_info = auth_store.module.find(module__ => module__.name == current_module );
            return module_info;
        }
    },
}
</script>
<style lang="">
    
</style>