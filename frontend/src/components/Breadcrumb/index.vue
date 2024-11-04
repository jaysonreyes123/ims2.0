<template>
  <div class="flex justify-between flex-wrap items-center">
    <div class="md:mb-6 mb-4 flex space-x-3 rtl:space-x-reverse">
      <h4 v-if="$route.name && !$route.meta.groupParent" :class="$route.meta.groupParent
          ? 'lg:border-r lg:border-secondary-500'
          : ''
        " class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4">
        {{ $route.name.replace("-", " ") }}
      </h4>
    </div>
    <div class="flex text-xl sm:space-x-4 space-x-2 sm:justify-end items-center md:mb-6 mb-4 rtl:space-x-reverse dark:text-white">
      {{ currentTime.toLocaleDateString('default', { month: 'long' ,day:'2-digit',year:'numeric'}) }} | 
      {{ currentTime.toLocaleTimeString() }} 
    </div>
  </div>
</template>
<script setup> 
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
<style lang="scss"></style>
  