<template>
  <div>
    <Modal :activeModal="sensorStore.addmodal" @close="sensorStore.closeSensorAddModal" :title="sensorStore.titleModal">
      <form @submit.prevent="saveSensor" class="space-y-4"> 
        <Textinput label="Sensor" type="text" placeholder="Sensor Name" name="name" v-model.trim="sensorForm.name" />
        <Textinput label="Location" type="text" placeholder="Location" name="location" v-model.trim="sensorForm.location" />
        <div class="text-right">          
          <Button type="submit" text="Add" btnClass="btn-dark" :isLoading="sensorStore.loading" />
        </div>
      </form>
    </Modal>
  </div>
</template>
<script setup>
import { onMounted } from "vue";
import Button from "@/components/Button";
import Modal from "@/components/Modal";
import Textinput from "@/components/Textinput"; 
import { useSensorStore } from "@/store/sensor"; 

let sensorStore = useSensorStore();
  
const sensorForm = {
  name: "",
  location: "",
  sensor_type: "", 
};

const saveSensor = () => {
  sensorForm.sensor_type = sensorStore.getSelectedSensorType;
  sensorStore.saveSensor(sensorForm);
};

</script>
<style lang=""></style>
  