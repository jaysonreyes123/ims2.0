<template>
    <div>
        <Breadcrumb />
        <div class="grid grid-cols-12 gap-3 mb-5">
            <div class="lg:col-span-12 col-span-12">
                <Card>
                    <TabGroup
                            @change="tabChange" 
                    >
                        <TabList class="lg:space-x-8 md:space-x-4 space-x-0 rtl:space-x-reverse">
                            <Tab v-slot="{ selected }" as="template" v-for="tab in tabs" :key="tab">
                                <button :class="[
                                    selected
                                        ? 'text-primary-500 before:w-full'
                                        : 'text-slate-500 before:w-0 dark:text-slate-300',
                                ]"
                                    class="text-sm font-medium mb-7 capitalize bg-white dark:bg-slate-800 ring-0 foucs:ring-0 focus:outline-none px-2 transition duration-150 before:transition-all before:duration-150 relative before:absolute before:left-1/2 before:bottom-[-6px] before:h-[1.5px] before:bg-primary-500 before:-translate-x-1/2">
                                    {{ tab }}
                                </button>
                            </Tab>  
                        </TabList>
                        <TabPanels>
                            <TabPanel>
                                <listSensor/>
                            </TabPanel>
                            <TabPanel>
                                <listSensor/>
                            </TabPanel>
                            <TabPanel>
                                <listSensor/>
                            </TabPanel>
                        </TabPanels>
                    </TabGroup>
                </Card>
            </div>
        </div>

        <addSensor />
    </div>
</template>
<script setup>
import { ref, onMounted,getCurrentInstance } from "vue";
import Breadcrumb from "../../views/dashboard/component/breadcrumb";
import Icon from "@/components/Icon";
import Button from '@/components/Button';
import Dropdown from '@/components/Dropdown'; 
import Card from "@/components/Card";
import { TabGroup, TabList, Tab, TabPanels, TabPanel, MenuItem } from "@headlessui/vue";

import addSensor from "./add-sensor.vue";
import listSensor from "./list-sensor.vue";

import { useSensorStore } from "@/store/sensor";
const sensorStore = useSensorStore();
const properties = getCurrentInstance().appContext.config.globalProperties
const tabs = ['Rainfall Gauge', 'Water Level', 'External Power Supply'];
 
const actions = [
    {
        sensor_type: 'RG',
        label: 'Add Rainfail Gauge',
        doit: (data) => {
            sensorStore.openSensorAddModal(data);
        },
    },
    {
        sensor_type: 'WL',
        label: 'Add Water Level',
        doit: (data) => {
            sensorStore.openSensorAddModal(data);
        },
    }, 
];
  

const tabChange = (index) => {
    sensorStore.setTabSelected(index);
};

onMounted(() => {  
  
   
    sensorStore.loadSensorList();
    
    sensorStore.selectedTab = 0;
    sensorStore.titleModal = 'Add Rainfail Gauge';

    properties.rg_event.stopListening(".rg-event");
    properties.wl_event.stopListening(".wl-event");
    properties.single_event.stopListening(".single-chart-event");
    properties.incident_event.stopListening(".incident-event");
})

</script>
<style lang=""></style>
  