<template>
    <div>
        <Loading v-model:active="ResourceStore.loading"/>
        <Block blockname="Resources Information">
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <Textinput label="Resource Name" placeholder="Reource Name" v-model="ResourceStore.form.resources_name" />
                <div class="fromGroup relative">
                    <label for="" class="inline-block input-label">Resource Type</label>
                    <Select placeholder="Select an option" :options="ResourceStore.getResourceType" :reduce="label => label.value"  v-model="ResourceStore.form.resources_type_picklist" />
                </div>
                <!-- <Textinput label="Resource Type" placeholder="Resource Type" v-model="ResourceStore.form.resources_type" /> -->
            </div>

            <div class="lg:grid lg:grid-cols-2 gap-12">
                <Textinput label="Quantity" placeholder="Quantity" v-model="ResourceStore.form.quantity" />
                <div class="fromGroup relative">
                    <label for="" class="inline-block input-label">Resource Status</label>
                    <Select placeholder="Select an option" :options="ResourceStore.getResourceStatus" :reduce="label => label.value"  v-model="ResourceStore.form.resources_status_picklist" />
                </div>
            </div>

            <div class="lg:grid lg:grid-cols-2 gap-12">
                <Textinput label="Contact info" placeholder="Contact info" v-model="ResourceStore.form.contact_info" />
                <Textinput label="Owner" placeholder="Owner" v-model="ResourceStore.form.owner" />
            </div>

            <div class="lg:grid lg:grid-cols-2 gap-12">
                <!-- date -->
                <div class="fromGroup relative">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Date Acquired</label>
                    <!-- <VueDatePicker placeholder="Date Acquired" v-model="ResourceStore.form.date_acquired" :enable-time-picker="false"></VueDatePicker> -->
                    <flat-pickr
                        v-model="ResourceStore.form.date_acquired"
                        class="form-control"
                        placeholder="yyyy-mm-dd"
                        :config="{dateFormat: 'Y-m-d' }"
                    />
                </div>
                <div class="fromGroup relative">
                    <label for="" class="inline-block input-label">Dispatch</label>
                    <Select placeholder="Select an option" :options="ResourceStore.getResourceDispatch" :reduce="label => label.value"  v-model="ResourceStore.form.dispatch_picklist" />
                </div>
            </div>


            <div class="lg:grid lg:grid-cols-2 gap-12">
                <Textarea label="Remarks" placeholder="Remarks" v-model="ResourceStore.form.remarks" />
                <div class="fromGroup relative">
                    <label for="" class="inline-block input-label">Condition</label>
                    <Select placeholder="Select an option" :options="ResourceStore.getResourceCondition" :reduce="label => label.value"  v-model="ResourceStore.form.condition_picklist" />
                </div>
            </div>
        </Block>

        <Block blockname="Location Details">
            <div class="lg:grid lg:grid-cols-2 gap-12">
                <div>
                    <Textinput label="Coordinates" :isReadonly="true" placeholder="Coordinates" v-model="ResourceStore.form.coordinates" />
                </div>
                <div>
                    <Map :set_coordinates="ResourceStore.form.coordinates" @updateCoordinate="updateCoordinates" />
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
import { useResourcesStore } from "@/store/resources";
import Select from "vue-select";
import { ref } from "vue";
const ResourceStore = useResourcesStore();
const date = ref();
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
            ResourceStore,
            date,
        }    
    },
    mounted(){
        ResourceStore.get_resources_condition();
        ResourceStore.get_resources_dispatch();
        ResourceStore.get_resources_status();
        ResourceStore.get_resources_type();
    },
    methods:{
        updateCoordinates(event){
            const {lng,lat} = event;
            ResourceStore.form.coordinates = lng+","+lat;
        },
        updateDateFormat(datevalue){
            date.value = datevalue;
            ResourceStore.form.date_acquired = datevalue.toISOString().substring(0, 10);
        },
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