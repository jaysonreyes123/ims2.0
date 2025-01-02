<template lang="">
    <div>
        <div class="grid grid-cols-2 grid-rows-2 gap-4">
            <div>
                <incident_by_type/>
            </div>
            <div class="row-span-2">
                <Map/>
            </div>
            <div>
                <incident_by_status/>
            </div>
        </div>
    </div>
</template>
<script>
import Map from "./map.vue"
import incident_by_type from './incident_by_type.vue';
import incident_by_status from './incident_by_status.vue';
export default {
    components:{
        Map,
        incident_by_type,
        incident_by_status
    } 
}
</script>
<style>

</style>