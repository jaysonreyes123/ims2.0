<template lang="">
    <div>
        <Loading v-model:active="report.loading"/>
        <div  v-if="report.form.type == 'list' ">
            <List/>
        </div>
        <div v-else>
            <div class="flex justify-end mb-4">
                <Button
                    v-if="pin_ == 0"
                    icon="solar:pin-bold"
                    text="Pin"
                    btnClass="btn-danger shadow-base2"
                    iconPosition="left"
                    class="mr-4"
                    @click="pin(1)"
                />
                <Button
                    v-else
                    icon="solar:pin-outline"
                    text="Unpin"
                    btnClass="btn-danger shadow-base2"
                    iconPosition="left"
                    class="mr-4"
                    @click="pin(0)"
                />
            </div>
                <Chart
                    v-if="report.data.report_charts"
                    :title="report.data.report_name" 
                    :report_id="report.data.id" 
                    :chart_type="report.data.report_charts.chart" 
                />
        </div>
    </div>
</template>
<script>
import { useReportStore } from '@/store/report';
import List from "./list.vue";
import Button from "@/components/Button";
import Icon from "@/components/Icon";
import Chart from "./chart/chart.vue";
import { ref } from 'vue';
const report = useReportStore();
const pin_ = ref();
export default {
    components:{
        List,
        Chart,
        Button,
        Icon
    },
    data(){
        return{
            report,
            pin_
        }
    },
    mounted(){
        report.id = this.$route.params.id;
        report.get_single_data();
        pin_.value = report.form.pin;
    },
    methods:{
        async pin(value){
            try {
                report.loading = true;
                await this.$axios.get("reports/pin/"+report.id+"/"+value);   
                pin_.value = value;
                report.loading = false;
            } catch (error) {
                
            }
        }
    }
}
</script>
<style lang="">
    
</style>