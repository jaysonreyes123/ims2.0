<template>
    <div>
        <IncidentModule v-if="this.$route.params.module == 'incident'" />
    </div>
</template>
<script>
import IncidentModule from "../incident/edit.vue";
export default{
    components:{
        IncidentModule
    }
}
</script>