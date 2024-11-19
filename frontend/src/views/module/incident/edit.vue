<template>
    <div>
        <Block blockname="Incident Details">
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <Textinput label="Incident ID(auto generate)" name="incident_id" placeholder="Incident ID(auto generate)" v-model="IncidentStore.form.incident_id" />
                <Textinput label="Incident Type" placeholder="Incident Type" v-model="IncidentStore.form.incident_type" />
            </div>
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <!-- time -->
                <div class="fromGroup relative">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Time of Incident</label>
                    <VueDatePicker v-model="IncidentStore.form.time_of_incident"  time-picker></VueDatePicker>
                </div>
                <!-- date -->
                <div class="fromGroup relative">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Date of Incident</label>
                    <VueDatePicker name="test" v-model="IncidentStore.form.date_of_incident"  :enable-time-picker="false"></VueDatePicker>
                </div>
            </div>
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <Textinput label="Incident Status" placeholder="Incident Status" v-model="IncidentStore.form.incident_status" />
                <Textinput label="Incident Priority" placeholder="Incident Priority" v-model="IncidentStore.form.incident_priority" />
            </div>
            <div class="lg:grid lg:grid-cols-1 gap-12">
                <Textarea label="Notes/Remarks" placeholder="Notes/Remarks" v-model="IncidentStore.form.remarks" />
            </div>
        </Block>

        <Block blockname="Location Details">
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <div>
                    <Textinput label="Location" placeholder="Location" v-model="IncidentStore.form.location" />
                    <Textinput label="Street name" placeholder="Street name" v-model="IncidentStore.form.street_name" />
                    <Textinput label="Nearest Landmark" placeholder="Nearest Landmark" v-model="IncidentStore.form.nearest_landmark" />
                    <Textinput label="Coordinates" :isReadonly="true" placeholder="Coordinates" v-model="IncidentStore.form.coordinates" />
                </div>
                <div>
                    <Map @updateCoordinate="updateCoordinates" />
                </div>
            </div>
        </Block>

        <Block blockname="Caller details">
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <Textinput label="First name" placeholder="First name" />
                <Textinput label="Last name" placeholder="Last name" />
            </div>
            <div class="lg:grid lg:grid-cols-1 gap-12">
                <Textinput @input="acceptNumber" maxlength="11" placeholder="Contact no." label="Contact no." v-model="IncidentStore.form.phone" />
            </div>
        </Block>

        <Block blockname="Responder">
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <div class="fromGroup relative">
                    <label for="" class="inline-block input-label">Response Team</label>
                    <Select :options="status"  v-model="IncidentStore.form.response_team" />
                </div>
                <div class="fromGroup relative">
                    <label for="" class="inline-block input-label">Assigned By</label>
                    <Select :options="status"  v-model="IncidentStore.form.assigned_by" />
                </div>
            </div>
            <div class="lg:grid lg:grid-cols-1 gap-12">
                <div class="fromGroup relative">
                    <label for="" class="inline-block input-label">Assigned Team</label>
                    <Select :options="status" multiple name="test2"  v-model="IncidentStore.form.assigned_team" />
                </div>
            </div>
        </Block>
    </div>
</template>
<script>
import Textinput from "@/components/Textinput"
import Textarea from "@/components/Textarea"
import Block from "../../components/Block";
import Button from "@/components/Button";
import Map from "../../components/Map"
import PicklistForm from "../../components/PicklistForm";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { useIncidentStore } from "@/store/incident";
import Select from "vue-select";
const IncidentStore = useIncidentStore();
const status = ["Active","Inactive"]

export default{
    components:{
        Block,
        Textinput,
        Textarea,
        Map,
        Button,
        PicklistForm,
        VueDatePicker,
        Select,
    },
    data(){
        return{
            status,
            IncidentStore
        }    
    },
    methods:{
        updateCoordinates(event){
            const {lng,lat} = event;
            IncidentStore.form.coordinates = lng+","+lat;
        },
        acceptNumber(event){
            IncidentStore.form.phone = IncidentStore.form.phone.replace(/[^\d]/g, "");
        }
    }
}
</script>
<style scoped>
.fromGroup{
    margin-bottom: 20px;
}
</style>
<style>
input:read-only{
    background-color: transparent !important;
    color:#000 !important; 
}
</style>