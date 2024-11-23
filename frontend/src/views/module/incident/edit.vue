<template>
    <div>
        <Loading v-model:active="IncidentStore.loading"/>
        <Block blockname="Incident Details">
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <Textinput label="Incident ID(auto generate)" name="id" placeholder="Incident ID(auto generate)" v-model="IncidentStore.form.incident_no" />
                <!-- <Textinput label="Incident Type" placeholder="Incident Type" v-model="IncidentStore.form.incident_type" /> -->
                <div class="fromGroup relative">
                    <label for="" class="inline-block input-label">Incident Type</label>
                    <Select :required="true" placeholder="Select an option" :options="IncidentStore.getIncidentType" :reduce="label => label.value"  v-model="IncidentStore.form.incident_type" >
                        <template #search="{attributes, events}">
                            <input
                            class="vs__search"
                            :required="!IncidentStore.form.incident_type"
                            v-bind="attributes"
                            v-on="events"
                            />
                        </template>
                    </Select>
                </div>
            </div>
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <!-- time -->
                <div class="fromGroup relative">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Time of Incident</label>
                    <!-- <VueDatePicker placeholder="Time of incident" v-model="IncidentStore.form.time_of_incident"  time-picker></VueDatePicker> -->
                    <flat-pickr
                        v-model="IncidentStore.form.time_of_incident"
                        class="form-control"
                        placeholder="HH:mm"
                        :config="{ enableTime: true, noCalendar: true, dateFormat: 'H:i:00',time_24hr:true,minuteIncrement:1 }"
                    />
                </div>
                <!-- date -->
                <div class="fromGroup relative">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Date of Incident</label>
                    <!-- <VueDatePicker placeholder="Date of incident" v-model="IncidentStore.form.date_of_incident" :enable-time-picker="false"></VueDatePicker> -->
                    <flat-pickr
                        v-model="IncidentStore.form.date_of_incident"
                        class="form-control"
                        placeholder="yyyy-mm-dd"
                        :config="{ dateFormat:'Y-m-d' }"
                    />
                </div>
            </div>
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <div class="fromGroup relative">
                    <label for="" class="inline-block input-label">Incident Status</label>
                    <Select placeholder="Incident Status" :options="IncidentStore.getIncidentStatus" :reduce="label => label.value"  v-model="IncidentStore.form.incident_status" />
                </div>
                <div class="fromGroup relative">
                    <label for="" class="inline-block input-label">Incident Priority</label>
                    <Select placeholder="Incident Priority" :options="IncidentStore.getIncidentPriority" :reduce="label => label.value"  v-model="IncidentStore.form.incident_priority" />
                </div>
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
                    <Map :set_coordinates="IncidentStore.form.coordinates" @updateCoordinate="updateCoordinates" />
                </div>
            </div>
        </Block>

        <Block blockname="Caller details">
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <Textinput label="First name" placeholder="First name" v-model="IncidentStore.form.caller_firstname" />
                <Textinput label="Last name" placeholder="Last name" v-model="IncidentStore.form.caller_lastname" />
            </div>
            <div class="lg:grid lg:grid-cols-1 gap-12">
                <Textinput @input="acceptNumber" maxlength="11" placeholder="Contact no." label="Contact no." v-model="IncidentStore.form.caller_contact" />
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
import { ref } from "vue";
const IncidentStore = useIncidentStore();
const status = ["Active","Inactive"]
const date = ref();
const time = ref();
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
            IncidentStore,
            date,
            time
        }    
    },
    mounted(){
        IncidentStore.get_incident_type();
        IncidentStore.get_incident_status();
        IncidentStore.get_incident_priority();
    },
    methods:{
        updateCoordinates(event){
            const {lng,lat} = event;
            IncidentStore.form.coordinates = lng+","+lat;
        },
        acceptNumber(event){
            IncidentStore.form.caller_contact = IncidentStore.form.caller_contact.replace(/[^\d]/g, "");
        },
        updateDateFormat(datevalue){
            date.value = datevalue;
            IncidentStore.form.date_of_incident = datevalue.toISOString().substring(0, 10);
        },
        updateTimeFormat(){

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