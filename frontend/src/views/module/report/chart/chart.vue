<template lang="">
        <div>
            <Card :title="title" bodyClass="min-h-[300px] p-6">
                <pie 
                    :title="title"
                    :report_id="report_id" 
                    :height="height"
                    v-if="chart_type == 'pie'" 
                />
                <horizontal 
                    :title="title"
                    :report_id="report_id" 
                    :height="height"
                    v-else-if="chart_type == 'horizontal'"
                />
                <vertical 
                    :title="title"
                    :report_id="report_id"
                    :height="height" 
                    v-else-if="chart_type == 'vertical'"
                />
                <Line 
                    :title="title"
                    :report_id="report_id"
                    :height="height" 
                    v-else-if="chart_type == 'line'"
                />
            </Card>
        </div>
</template>
<script>
import Card from "@/components/Card";
import pie from './pie.vue';
import horizontal from './horizontal.vue';
import vertical from './vertical.vue';
import Line from './line.vue';
import { useReportStore } from '@/store/report';
const report = useReportStore();
export default {
    props:{
        chart_type:{
            type:String,
            default:"pie"
        },
        report_id:{
            type:Number,
            default:0
        },
        title:{
            type:String,
            default:""
        },
        height:{
            type:String,
            default:"350px"
        }
    },
    components:{
        pie,
        horizontal,
        vertical,
        Line,
        Card
    },
    data(){
        return{
            report
        }
    }
}
</script>
<style lang="">
    
</style>