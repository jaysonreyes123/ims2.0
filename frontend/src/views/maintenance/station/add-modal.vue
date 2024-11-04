<template>
    <div>
        <Modal :activeModal="stationStore.modal" @close="stationStore.closeModal"
            :title="stationStore.action + ' ' + stationStore.moduleName">
            <form @submit.prevent="save" class="space-y-4">
                <Textinput label="Station" type="text" placeholder="Code" name="code"
                    v-model.trim="stationStore.stationForm.code" />

                <Textinput label="Station" type="text" placeholder="Station Name" name="name"
                    v-model.trim="stationStore.stationForm.name" />
                <Textinput label="Coordinates" type="text" placeholder="Coordinates" name="coordinates"
                    v-model.trim="stationStore.stationForm.coordinates" />

                <Textinput label="Sensor Distance to River Bed" type="number"  placeholder="Sensor Distance to River Bed"
                    v-model.trim="stationStore.stationForm.river_bed" />

                <Textinput label="Sensor Distance to Water Surface" type="number"  placeholder="Sensor Distance to Water Surface"
                    v-model.trim="stationStore.stationForm.water_surface" />

                <Textarea label="Location" placeholder="Location" v-model="stationStore.stationForm.location"  />
                
                <label for="" class="inline-block input-label">Status</label>
                <vSelect :reduce="label => label.value" v-model="stationStore.stationForm.status" :options="status"/>

                <div class="text-right">
                    <Button type="submit" :text="stationStore.action" btnClass="btn-success"
                        :isLoading="stationStore.loading" />
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
import vSelect from "vue-select";
import { useStationStore } from "@/store/station";
let stationStore = useStationStore();

const status = [
    {
        label:'Active',
        value:1
    },
    {
        label:'Inactive',
        value:0
    },
]

const save = () => {
    console.log(stationStore.stationForm.status)
    stationStore.save();
};

</script>
<style lang=""></style>
    