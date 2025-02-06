<template lang="">
    <div>
        <List v-if="this.$route.params.type == 'list' " />
        <Chart v-else-if="this.$route.params.type == 'chart' " />
    </div>
</template>
<script>
import List from "./save.vue";
import Chart from "./save_chart.vue";
export default {
    components:{
        List,
        Chart
    }
}
</script>
<style lang="">
    
</style>