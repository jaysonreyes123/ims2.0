<template>
    <div>
        <Modal :activeModal="notification.modal" @close="notification.closeModal"
            :title="notification.action + ' ' + notification.moduleName">
            <form @submit.prevent="save" class="space-y-4">
                
                <label for="" class="inline-block input-label">Recipient</label>
                <vSelect class="dark:bg-slate-400" placeholder="Select Recipient" multiple :reduce="label => label.value"  v-model="notification.notificationForm.recipient" :options=recipient.getDropdown />

                <label for="" class="inline-block input-label">Sensor</label>
                <vSelect class="dark:bg-slate-400" placeholder="Select Sensor" :reduce="label => label.value"   v-model="notification.notificationForm.sensor_id"  :options="sensor.getSensorDropDown2"/>
                <Textinput  v-model="notification.notificationForm.name" type="text" placeholder="Subject" label="Subject" />
                <Select label="Email Template (optional)" :options="emailtemplate.getDropdown" @change="emailTemplateChange" v-model="emailtemplate.email_template_id" :reduce="label => label.value"  />
                <Textarea  v-model="notification.notificationForm.body" label="Message" placeholder="Message" />
                <div class="text-right">
                    <Button type="submit" :text="notification.action" btnClass="btn-success"
                        :isLoading="notification.loading" />
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
import Select from "@/components/Select/index"
import vSelect from "vue-select"

import { useNoficationStore } from "@/store/notification";
import { useRecipientStore } from "@/store/recipient"
import { useSensorStore } from "@/store/sensor";
import { useEmailTemplate } from "@/store/email_template";

let recipient = useRecipientStore();
let notification = useNoficationStore();
let sensor = useSensorStore();
let emailtemplate = useEmailTemplate();

const save = () => {  
    console.log(notification.notificationForm)
    notification.save();
};

const emailTemplateChange = (event) =>{
    notification.notificationForm.body = emailtemplate.getSingleEmailTemplate.content;
}
</script>
<style>
.v-select{
    margin-top: 0px !important;
}
</style>
    