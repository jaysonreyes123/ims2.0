<template>
    <Card title="RF Stations">
        <div class="md:flex items-center">
            <!-- <div class="flex-none">
                <ul class="bg-slate-50 dark:bg-slate-900 rounded p-4 min-w-[184px] space-y-5 mt-4">
                    <li v-for="(item, i) in rg_stations" :key="i"
                        class="flex justify-start items-center text-sm text-slate-600 dark:text-slate-300">
                        <Icon :icon="item.icon" />
                        <span> {{ item.title }} ~ {{ item.value }}</span>
                    </li>
                </ul>
            </div> -->
            <div class="flex-1">
                <Map :rgmap_data="props.rgmap_data" />
            </div>
        </div>
    </Card>
</template>
<script setup>
import Card from "@/components/Card";
import Map from "../components/rg_map.vue";


const props = defineProps(['rgmap_data']);



const rg_stations = [
    {
        title: "No Rain",
        icon: "fluent:weather-fog-20-regular",
        value: ''
    },
    {
        title: "RF 1Hr",
        icon: "fluent:weather-rain-20-regular",
        value: '0.1 - 7.5mm'
    },
    {
        title: "RF 1Hr",
        icon: "fluent:weather-rain-20-regular",
        value: '7.5 - 15mm'
    },
    {
        title: "RF 1Hr",
        icon: "fluent:weather-rain-20-regular",
        value: '15 - 30mm'
    },
    {
        title: "RF 1Hr",
        icon: "fluent:weather-rain-20-regular",
        value: '30mm over'
    },
];
</script>