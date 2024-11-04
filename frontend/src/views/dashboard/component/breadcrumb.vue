<template>
  <div class="flex justify-between flex-wrap items-center">
    <Breadcrumb />
    <div class="flex text-xl sm:space-x-4 space-x-2 sm:justify-end items-center md:mb-6 mb-4 rtl:space-x-reverse dark:text-white"> 
      {{ currentTime.toLocaleDateString('default', { month: 'long' ,day:'2-digit',year:'numeric'}) }} | 
      {{ currentTime.toLocaleTimeString() }}   
    </div>
  </div>
</template>
<script setup>
import Breadcrumb from "@/components/Breadcrumbs";
import { ref, onBeforeUnmount } from "vue";

const currentTime = ref(new Date());

const updateCurrentTime = () => {
  currentTime.value = new Date();
};

const updateTimeInterval = setInterval(updateCurrentTime, 1000);

onBeforeUnmount(() => {
    clearInterval(updateTimeInterval);
});

</script>
<style lang="scss"> 
</style>
  