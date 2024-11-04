<template>
    <div>
        <Modal :activeModal="recipient.modal" @close="recipient.closeModal"
            :title="recipient.action + ' ' + recipient.moduleName">
            <div class="space-y-2">
                <Textinput v-model.trim="recipient.recipientForm.name" type="text" placeholder="name" label="Name"
                    name="name" /> 

                <label for="" class="input-label inline-block">Email</label>
                <div v-for="(input, index) in recipient.inputsEmail" :key="index">
                    <InputGroup type="email" placeholder="Email" v-model="input.value" >
                        <template v-slot:append>
                            <Button v-if="index === 0" text="+" btnClass="btn-outline-primary " @click="addInputEmail"/>
                            <Button v-else text="-" btnClass="btn-outline-secondary " @click="removeInputEmail"/>
                        </template>
                    </InputGroup>
                </div> 

                <label for="" class="input-label inline-block">Mobile No.</label>
                <!-- <vSelect class="dark:bg-slate-400" multiple taggable v-model="recipient.recipientForm.mobile_nos"  /> -->
                <div v-for="(input, index) in recipient.inputsMobile" :key="index">
                    <InputGroup type="phone" placeholder="Mobile No" v-model="input.value" >
                        <template v-slot:append>
                            <Button v-if="index === 0" text="+" btnClass="btn-outline-primary " @click="addInputMobile"/>
                            <Button v-else text="-" btnClass="btn-outline-secondary " @click="removeInputMobile"/>
                        </template>
                    </InputGroup>
                </div>  

                <!-- <label for="" class="input-label inline-block">Notify</label>
                <vSelect class="dark:bg-slate-400" placeholder="Select Notify" v-model="recipient.recipientForm.notify"
                    multiple :reduce="label => label.value" :options="recipient.getNotifyList" /> -->
                <div class="text-right">
                    <Button type="button" @click="save" :text="recipient.action" btnClass="btn-success"
                        :isLoading="recipient.loading" />
                </div>
            </div>
        </Modal>
    </div>
</template>
<script setup>
import Button from "@/components/Button";
import Modal from "@/components/Modal";
import Textinput from "@/components/Textinput"; 
import InputGroup from "@/components/InputGroup";
import vSelect from "vue-select";
import { useRecipientStore } from "@/store/recipient";
import { ref } from "vue";
 

let recipient = useRecipientStore();
 
const addInputEmail = () => {
    recipient.inputsEmail.push({ value: '' });
};

const removeInputEmail = (index) => {
    recipient.inputsEmail.splice(index, 1);
};

const addInputMobile = () => {
    recipient.inputsMobile.push({ value: '' });
};

const removeInputMobile = (index) => {
    recipient.inputsMobile.splice(index, 1);
};

const save = () => {  
    recipient.recipientForm.emails = recipient.inputsEmail.filter(item => item.value !== '').map(item => item.value);  
    recipient.recipientForm.mobile_nos = recipient.inputsMobile.filter(item => item.value !== '').map(item => item.value); 
    recipient.save();
    recipient.inputsEmail = [{ value: '' }];
    recipient.inputsMobile = [{ value: '' }];
};
 

</script>
<style>
.v-select {
    margin-top: 0px !important;
}
</style>