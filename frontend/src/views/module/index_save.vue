<template lang="">
    <div>
        <ReportSave  v-if="modules == 'reports'" />
        <Save v-else/>
    </div>
</template>
<script>
import Save from './save.vue';
import ReportSave from "./report/save.vue"
import {ref} from "vue";
const modules = ref();
export default {
    components:{
        Save,
        ReportSave
    },
    created(){
        modules.value = this.$route.params.module;
    },
    data(){
        return{
            modules
        }
    }
}
</script>
<style lang="">
    
</style>