<template>
    <div class="layout max-h-full overflow-y-auto">
        <Alert class="mt-2 w-96 shadow-lg border-gray-300 border text-xs" :style="{'border-left':'4px solid '+item.color}"  v-for="(item,i) in data" :key="i" :id="`notification-${item.id}`" >
            <span class="float-right text-xl font-bold cursor-pointer" @click="remove(item.id)">X</span>
            <p class="font-bold uppercase text-sm flex items-start space-x-3 rtl:space-x-reverse">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="1.3em" height="1.5em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify iconify--heroicons-outline mr-2"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z">

                </path></svg>
                {{ item.station_name }}
            </p>
            <p>Value : {{ item.value }} <span v-if="item.sensor_type == 1">mm</span> <span v-else-if="item.sensor_type==2">m</span> </p>
            <p>Status : <Badge
          :label="item.status"
          badgeClass="bg-opacity-[0.12] text-white"
          :style="{'background':item.color}"
        /></p>
            <p class="text-xs text-gray-400">As of {{ item.time }}</p>
        </Alert>
    </div>
</template>
<script setup>
import {useDashboardStore} from "@/store/dashboard";
const dashboard = useDashboardStore();
function remove(id){
    document.getElementById("notification-"+id).style.display = 'none';
    // dashboard.incident_id = id;
    // dashboard.updateIncident();
}
</script>
<script>
import Alert from "@/components/Alert";
import Badge from "@/components/Badge";
export default {
    props:{
        data:{
            type: Array
        }
    },  
    components:{
        Alert,
        Badge
    }
}
</script>

<style>
.layout{
    position: fixed;
    top: 0;
    right: 0;
    z-index: 99999;

}
</style>