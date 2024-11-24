<template>
  <Dropdown classMenuItems="md:w-[300px] top-[58px]" classItem="px-4 py-2">
    <span
      class="relative lg:h-[32px] lg:w-[32px] lg:bg-gray-500-f7 bg-slate-50 text-slate-900 lg:dark:bg-slate-900 dark:text-white cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center"
      ><Icon icon="heroicons-outline:bell" class="animate-tada" />
      <span
      class="absolute lg:right-0 lg:top-0 -top-2 -right-2 h-4 w-4 bg-red-500 text-[8px] font-semibold flex flex-col items-center justify-center rounded-full text-white z-[99]"
        >0</span
      >
    </span>
    <template v-slot:menus>
      <div
        class="flex justify-between px-4 py-4 border-b border-slate-100 dark:border-slate-600"
      >
        <div
          class="text-sm text-slate-800 dark:text-slate-200 font-medium leading-6"
        >
          Notifications
        </div>
        <!-- <div class="text-slate-800 dark:text-slate-200 text-xs md:text-right">
          <router-link :to="{ name: 'dashboard' }" class="underline"
            >View all</router-link
          >
        </div> -->
      </div>
      <div class="divide-y divide-slate-100 dark:divide-slate-800 overflow-y-auto h-96">
        <MenuItem
          v-slot="{ active }"
          v-for="(item, i) in dashboard.incident"
          :key="i"
        >
          <div
            :class="`${
              active
                ? 'bg-slate-100 dark:bg-slate-700 dark:bg-opacity-70 text-slate-800'
                : 'text-slate-600 dark:text-slate-300'
            } block w-full px-4 py-2 text-sm  cursor-pointer`"
          >
            <div class="flex ltr:text-left rtl:text-right">
              <div class="flex-none ltr:mr-3 rtl:ml-3">
                <div class="h-8 w-8 bg-white rounded-full">
                  
                  <embed v-if="item.sensor_type == 1" width="32px" type="image/svg+xml" :src="rainfall" />
                  <embed v-if="item.sensor_type == 2" width="32px" type="image/svg+xml" :src="waterlevel" />
                </div>
              </div>
              <div class="flex-1">
                <div
                  :class="`${
                    active
                      ? 'text-slate-600 dark:text-slate-300'
                      : ' text-slate-600 dark:text-slate-300'
                  } text-sm`"
                >
                {{ item.station_name }}
                </div>
                <div
                  :class="`${
                    active
                      ? 'text-slate-500 dark:text-slate-200'
                      : ' text-slate-600 dark:text-slate-300'
                  } text-xs leading-4`"
                >
                <span class="block text-slate-500 text-xs ">
                                                <p>Status : <Badge
                                                    :label="item.status"
                                                    badgeClass="bg-opacity-[0.12] text-white"
                                                    :style="{'background':item.color}"
                                                    />
                                                </p>
                                            </span>
                <span class="block text-slate-500 text-xs ">
                    Value : {{ item.value }} <span v-if="item.sensor_type == 1 && item.notification_type =='warning' ">mm</span> 
                    <span v-else-if="item.sensor_type==2 && item.notification_type =='warning' ">m</span> 
                </span>
                </div>
                <div class="text-slate-400 dark:text-slate-400 text-xs mt-1">
                  As of {{ item.time }}
                </div>
              </div>
              <div class="flex-0" v-if="item.unread">
                <span
                  class="h-[10px] w-[10px] bg-danger-500 border border-white dark:border-slate-400 rounded-full inline-block"
                >
                </span>
              </div>
            </div>
          </div>
        </MenuItem>
      </div>
    </template>
  </Dropdown>
</template>



<script setup>

import Dropdown from "@/components/Dropdown";
import Icon from "@/components/Icon";
import { MenuItem } from "@headlessui/vue";
import { notifications } from "../../../constant/data";
import Badge from "@/components/Badge";

</script>
<style lang=""></style>
