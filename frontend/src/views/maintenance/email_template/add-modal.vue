<template>
    <div>
        <Modal :activeModal="email_template.modal" @close="email_template.closeModal"
            :title="email_template.action + ' ' + email_template.moduleName">
            <form @submit.prevent="save" class="space-y-4">
                <Textinput v-model.trim="email_template.emailTemplateForm.name" type="text" placeholder="name" label="Name" name="name" />
                <!-- <Textinput taggable v-model.trim="email_template.emailTemplateForm.emails" type="text" placeholder="email" label="Email" name="emails" /> -->
                 <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-6">
                        <Select label="Module" :options="module_option" @change="module_change" />
                    </div>
                    <div class="col-span-6">
                        <Select label="Column" :options="field_option" @change="field_change" />
                    </div>
                 </div>
                <Textarea  v-model="email_template.emailTemplateForm.content" label="Content" placeholder="Content" />
                <div class="text-right">
                    <Button type="submit" :text="email_template.action" btnClass="btn-success"
                        :isLoading="email_template.loading" />
                </div>
            </form>
        </Modal>
    </div>
</template>
<script setup>
import Button from "@/components/Button";
import Modal from "@/components/Modal";
import Textinput from "@/components/Textinput";
import Textarea from "@/components/Textarea";
import Select from "@/components/Select/index";
import {ref} from "vue";
import vSelect from "vue-select";

import { useEmailTemplate } from "@/store/email_template";
import { useStationStore } from "@/store/station";
import { useSensorStore } from "@/store/sensor";
const email_template = useEmailTemplate();
const stations_store = useStationStore();
const sensor_store = useSensorStore();
const save = () => {
    email_template.save();
};

const module_option = [
    {
        label:"Station",
        value:"stations",
    },
    {
        label:"Sensor",
        value:"sensor_types",
    },
    {
        label:"Warning",
        value:"warnings",
    },
];
var field_option = ref([]);
const fields = {
    stations:{
        fields:["name","coordinates","location"]
    },
    sensor_types:{
        fields:["type","name"]
    },
    warnings:{
        fields:["sensor_thresholds","status","color"]
    },
};
const module_change = (event) =>{
    const value = event.target.value;
    field_option.value = [];
    fields[value].fields.map((item)=>{
        var subdata = [];              
        subdata["label"] = item;
        subdata["value"] = "$"+value+"-"+item+"$";
        field_option.value.push(subdata)
    })
}
const field_change = (event)=>{
    console.log(sensor_store.sensorList);
    const value = event.target.value;
    const new_content = email_template.emailTemplateForm.content+" "+value;
    email_template.emailTemplateForm.content = new_content;
}

</script>
<style>
.v-select{
     margin-top: 0px !important;
}
</style>
    