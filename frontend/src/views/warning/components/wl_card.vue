<template>
    <Card title="Water level Stations">
        <!-- <ul
            class="bg-slate-50 dark:bg-slate-900 rounded p-4 min-w-[184px]  flex justify-between flex-wrap items-center text-center">
            <li v-for="(item, i) in wl_stations" :key="i" class="text-sm text-slate-600 dark:text-slate-300">
                <span class="block space-x-2 rtl:space-x-reverse">
                    <span :class="item.cls"
                        class="inline-flex h-[6px] w-[6px] bg-primary-500 ring-opacity-25 rounded-full ring-4"></span>
                    <span>{{ item.title }}</span></span>
            </li>
        </ul> -->
        <Map  :wlmap_data="props.wlmap_data" />
    </Card>
</template>
<script setup>
import Card from "@/components/Card";
import Map from "../components/wl_map.vue";

const props = defineProps(['wlmap_data']);

const wl_stations = [
    {
        title: "Normal",
        cls: "bg-primary-500 ring-primary-500",
    },
    {
        title: "Alert",
        cls: "bg-waning-500 ring-waning-500",
    },
    {
        title: "Alarm",
        cls: "bg-info-500 ring-info-500",
    },
    {
        title: "Critical",
        cls: "bg-danger-500 ring-danger-500",
    },
];
</script>