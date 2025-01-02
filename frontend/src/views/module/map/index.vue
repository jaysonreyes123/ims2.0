<template lang="">
    <div>
        <component :is="MapView()"></component>
    </div>
</template>
<script>
import incident_map from './incident_map.vue';
import heat_map from './heat_map.vue';
export default {
    components:{
        incident_map,
        heat_map
    },
    methods:{
        MapView(){
            const modules = this.$route.params.module;
            return modules;
        }
    }
}
</script>
<style lang="">
    
</style>