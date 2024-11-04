<template>
    <div>
        <Modal :activeModal="store.modal" @close="store.closeModal" :title="store.action + ' ' + store.moduleName">
            <form @submit.prevent="save" class="space-y-4">
                <!-- <VueSelect label="Station" v-model="store.warningForm.station_id" :options="storeStation.getDropdown"/>  -->
                <!-- <VueSelect label="Sensor" v-model="store.warningForm.sensor_id"  :options="sensor.getSensorDropDown"/>  -->
                <!-- <Select label="Station" @change="onChange($event)" name="station_id" v-model="store.warningForm.station_id" :options="storeStation.getDropdown"></Select>
                <Select label="Sensor" name="sensor_id" v-model="store.warningForm.sensor_id" :options="sensor.getSensorDropDown"></Select> -->
                <label for="" class="inline-block input-label">Station</label>
                <vSelect class="dark:bg-slate-400" placeholder="Select Station" :on-change="onChange()" :reduce="label => label.value" v-model="store.warningForm.station_id" :options="storeStation.getDropdown" />
                <!-- <label for="" class="inline-block input-label">Sensor</label> -->
                <Select class="dark:bg-slate-400" placeholder="Select Sensor" value="value" @change="getWarningStatus" :reduce="label => label.value" label="Sensor" v-model="store.warningForm.sensor_id" :options="sensor.getSensorDropDown"/> 
                    <label for="" class="inline-block input-label">Status</label>
                <vSelect class="dark:bg-slate-400" placeholder="Select Status" :reduce="label => label.value" v-model="store.warningForm.status"  :options="store.getWarningStatusList" />
                    <!-- <Textinput label="Status" v-model="store.warningForm.status" type="text" placeholder="Status" /> -->
                <!-- <Checkbox  :checked="store.warningForm.is_check" v-model="store.warningForm.is_check" /> -->
                <Textinput label="Sensor Threshold" v-model="store.warningForm.sensor_thresholds" type="number" placeholder="Sensor Threshold" name="sensor_threshold"/>
                
                <Select class="dark:bg-slate-400" label="Select Color" @change="color_change" :options="color_list" />
                <!-- <label for="" class="inline-block input-label">Select Color</label><br> -->
                <!-- <color-input format="hex" aria-disabled="true"  enable-alpha position="right top" v-model="store.warningForm.color" />  -->
                <div v-if="color_visible" class="mt-5">
                    <span class="text-xs">Sample: <span  class="badge text-white rounded p-1" :style="{'background-color':store.warningForm.color}" >{{ store.warningForm.status }}</span></span>
                </div>
                <div class="text-right">
                    <Button type="submit" :text="store.action" btnClass="btn-success" :isLoading="store.loading" />
                </div>
            </form>
        </Modal>
    </div>
</template>
<script setup> 
import Button from "@/components/Button";
import Modal from "@/components/Modal"; 

import Textinput from "@/components/Textinput";

import vSelect from "vue-select";
import Select from "@/components/Select/index"

import { useWarningStore } from "@/store/warning";
import { useStationStore } from "@/store/station";
import { useSensorStore } from "@/store/sensor";
import Checkbox from "@/components/Checkbox";
import { ref } from "vue";
const color_visible = ref(false);
const color_list = [
    {
        label:"Light gray",
        value:"#d3d3d3"
    },
    {
        label:"Yellow",
        value:"#FFD700"
    },
    {
        label:"Orange",
        value:"#FFA500"
    },
    {
        label:"Red",
        value:"#ff0000"
    },
    {
        label:"Green",
        value:"#57ad68"
    },
    {
        label:"Blue",
        value:"#0000ff"
    },
];

let store = useWarningStore();
let storeStation = useStationStore();
let sensor = useSensorStore();
const save = () => {
     if(store.warningForm.status == "normal"){
        store.warningForm.is_check = 0;
     }
     else{
        store.warningForm.is_check = 1;
     }
     store.save();
   // console.log(store.warningForm.is_check)
     store.warningStatusList = [];
     color_visible.value = false;
};
function onChange(){

    sensor.station_id = store.warningForm.station_id;
}

const getWarningStatus = ()=>{
    if(store.warningForm.sensor_id != null){
        store.loadWarningSensorStatus();
    }
    
}
const color_change = (event) =>{
    color_visible.value = true;
    store.warningForm.color = event.target.value;
}
</script>
<style  >
.z-\[99999\] {
    z-index: 1001;
} 
.v-select{
     margin-top: 0px !important;

}
</style>
    