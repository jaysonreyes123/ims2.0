<template lang="">
    <div>
        <table class="w-full">
            <tr>
                <td style="text-align: left;"><img src="@/assets/images/logo/navy.png" style="width: 110px;display:block"></td>
                <td style="text-align: left;">
                    <span style="font-weight: bold;font-size: 25px;"> Incident Management System </span>
                </td>            
            </tr>
        </table>
        <br>
        <div style="border-top: 3px solid #032e61;"></div>
        <h2  style="text-align:center; font-weight:bold; font-size: 20px; margin-bottom: 10px; margin-top: 10px;">INCIDENT REPORT</h2>
        <div>
            <table style="width: 100%;" class="reportdata">
                <tr>
                    <td><b>INCIDENT NO:</b></td>                
                    <td>{{ incident_store.form.incident_no }}</td>
                </tr>
                <tr>
                    <td><b>INCIDENT TYPE:</b></td>                
                    <td>{{ get_label(incident_store.incident_types_picklist,incident_store.form.incident_types_picklist) }}</td>
                </tr>
                <tr>
                    <td><b>LOCATION:</b></td>                
                    <td>{{ incident_store.form.street_name }}</td>
                </tr>
                <tr>
                    <td><b>NEAREST LANDMARK:</b></td>                
                    <td>{{ incident_store.form.nearest_landmark }}</td>
                </tr>
                <tr>
                    <td><b>CONTACT NO:</b></td>                
                    <td>{{ incident_store.form.caller_contact }} </td>
                </tr>
                <tr>
                    <td><b>DATE AND TIME:</b></td>                
                    <td>{{ incident_store.form.date_of_incident }} {{ incident_store.form.time_of_incident }} </td>
                </tr>
                <tr>
                    <td><b>RELAYED TO:</b></td>                
                    <td>{{ incident_store.form.response_team }}</td>
                </tr>
                <tr>
                    <td><b>STATUS:</b></td>                
                    <td>{{ get_label(incident_store.incident_statuses_picklist,incident_store.form.incident_statuses_picklist) }}</td>
                </tr>
            </table>
            <br>
		    <br>
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: left;">PREPARED BY:</td>
                    <td style="text-align: right;">DATE PRINTED: {{current_datetime}}</td>				
                </tr>
		    </table>
        </div>
    </div>
</template>
<script>
import header_logo from "@/assets/images/logo/navy.png";
import { useIncidentStore } from "@/store/incident";
const incident_store = useIncidentStore();
export default {
    data(){
        return{
            header_logo,
            incident_store,
        }
    },
    mounted(){
        setTimeout(() => {
            this.print();  
        }, 500); 
    },
    methods: {
        print(){
            window.print();
        },
        get_label(picklist,value){
            const picklist_data = picklist.find(item => item.id == value );
            let label = "";
            if(picklist_data !== undefined){
                label = picklist_data.label;
            }
            return label;
        }
    },   
    computed:{
        current_datetime(){
            const datetime = new Date();
            return datetime.toLocaleString();
        }
    }
}
</script>
<style>
.reportdata {
            border-collapse: collapse;
            width: 100%;
            padding-top: 10px;
        }

        .reportdata td, .reportdata th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .reportdata th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #032e61;
            color: black;
        }
</style>