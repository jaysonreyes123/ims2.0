<template>
  <Dropdown classMenuItems=" w-[180px] top-[58px] ">
    <div class="flex items-center">
      <div class="flex-1 ltr:mr-[10px] rtl:ml-[10px]">
        <div class="lg:h-8 lg:w-8 h-7 w-7 rounded-full">
          <img src="https://t4.ftcdn.net/jpg/03/49/49/79/360_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg" alt="" class="block w-full h-full object-cover rounded-full" />
        </div>
      </div>
      <div
        class="flex-none text-slate-600 dark:text-white text-sm font-normal items-center lg:flex hidden overflow-hidden text-ellipsis whitespace-nowrap">
        <span class="overflow-hidden text-ellipsis whitespace-nowrap w-[85px] block">{{ authStore.user.name }}</span>
        <span class="text-base inline-block ltr:ml-[10px] rtl:mr-[10px]">
          <Icon icon="heroicons-outline:chevron-down"></Icon>
        </span>
      </div>
    </div>
    <template #menus>
      <MenuItem >
      <div type="button" @click="$router.push('/app/profile')" class="inline-flex items-center space-x-2 rtl:space-x-reverse w-full px-4 py-2 first:rounded-t last:rounded-b font-normal cursor-pointer hover:bg-slate-100">
        <div class="flex-none text-lg">
          <Icon icon="heroicons-outline:user" />
        </div>
        <div class="flex-1 text-sm">
          Profile
        </div>
      </div>
      </MenuItem>
      <MenuItem v-if="authStore.user.user_roles == 'Admin' ">
      <div type="button" @click="$router.push('/app/login-history')" class="inline-flex items-center space-x-2 rtl:space-x-reverse w-full px-4 py-2 first:rounded-t last:rounded-b font-normal cursor-pointer hover:bg-slate-100">
        <div class="flex-none text-lg">
          <Icon icon="heroicons-outline:list-bullet" />
        </div>
        <div class="flex-1 text-sm">
          Login History
        </div>
      </div>
      </MenuItem>

      <MenuItem >
      <div type="button" @click="authStore.logout()" class="inline-flex items-center space-x-2 rtl:space-x-reverse w-full px-4 py-2 first:rounded-t last:rounded-b font-normal cursor-pointer hover:bg-slate-100">
        <div class="flex-none text-lg">
          <Icon icon="heroicons-outline:login" />
        </div>
        <div class="flex-1 text-sm">
          Logout
        </div>
      </div>
      </MenuItem>
       
    </template>
  </Dropdown>
</template>
<script setup>

import { MenuItem } from "@headlessui/vue";
import Dropdown from "@/components/Dropdown";
import Icon from "@/components/Icon";
import profileImg from "@/assets/images/all-img/user.png"
import { useAuthStore } from "@/store/auth";

const authStore = useAuthStore();
 

</script>
<style lang=""></style>
