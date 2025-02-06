<template lang="">
    <div>
        <Loading v-model:active="report.loading"/>
        <table class="w-full">
            <tr>
                <td style="text-align: left;"><img src="@/assets/images/logo/BAYAN911.jpg" style="width: 200px;display:block"></td>
                <td style="text-align: left;">
                    <span style="font-weight: bold;font-size: 25px;"> Incident Management System </span>
                </td>            
            </tr>
        </table>
        <br>
        <hr/>
        <br>
        <p class="text-center font-bold capitalize text-4xl">{{report.form.report_name}}</p>
        <br>
        <Card bodyClass="p-0">
        <vue-good-table
            :columns="report.columns"
            :rows="report.generate_report_list"
            styleClass=" vgt-table bordered"
            :sort-options="{
            enabled: false,
            }"
        />
        </Card>
    </div>
</template>
<script>
import Card from "@/components/Card";
import { useReportStore } from '@/store/report';
const report = useReportStore();
export default {
    components:{
        Card
    },
    data(){
        return{
            report
        }
    },
    mounted(){
        report.id = this.$route.params.id;
        report.get_report_column();
        report.get_single_data();

        this.$watch(
            ()=>report.loading,
            (loading) => {
              if(loading == false){
                setTimeout(()=>{
                    window.print();
                },500)
              }
            }
        )
    }   
}
</script>
<style lang="">
    
</style>