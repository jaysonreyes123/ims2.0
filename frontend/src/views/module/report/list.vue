<template lang="">
    <div>
        <Loading v-model:active="report.loading"/>
        <div class="flex justify-end mb-4">
            <router-link target="_blank" :to="{name:'print-report',params:{module:this.$route.params.module,id:this.$route.params.id}}">
                <Button
                    icon="heroicons-outline:pencil-square"
                    text="Print"
                    btnClass="btn-danger shadow-base2"
                    iconPosition="left"
                    class="mr-4"
                />
            </router-link>
            <Button
                icon="heroicons-outline:pencil-square"
                text="Csv"
                btnClass="btn-danger shadow-base2"
                iconPosition="left"
                class="mr-4"
                @click="report_export('csv')"
            />
                <Button
                    icon="heroicons-outline:pencil-square"
                    text="Excel"
                    btnClass="btn-danger shadow-base2"
                    iconPosition="left"
                    class="mr-4"
                     @click="report_export('xlsx')"
                />
        </div>
        <Card :title="report.form.report_name">
            <vue-good-table :columns="report.columns"
                styleClass=" vgt-table  lesspadding2 centered " :rows="report.generate_report_list" :pagination-options="{
                enabled: false,
                perPage:15
            }">
            </vue-good-table>
        </Card>
    </div>
</template>
<script>
import Card from "@/components/Card"
import Icon from "@/components/Icon";
import Button from "@/components/Button";
import { useReportStore } from "@/store/report";
const report = useReportStore();
export default {
    components:{
        Card,
        Button,
        Icon
    },
    data(){
        return{
            report
        }
    },
    mounted(){
        report.id = this.$route.params.id;
        report.get_report_column();

    },
    methods:{
        report_export(type){
            report.report_export(type);
        }
    }
}
</script>
<style lang="">
    
</style>