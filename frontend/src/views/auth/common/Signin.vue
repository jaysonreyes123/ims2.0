<template>
  <form @submit.prevent="auth.login(authForm)" class="space-y-4">
    <Textinput label="Email" type="email" placeholder="Type your email" name="emil" v-model="authForm.email"
      classInput="h-[48px]" />
    <Textinput label="Password" type="password" placeholder="Type your password" name="password"
      v-model="authForm.password" hasicon classInput="h-[48px]" autocomplete="on"/>

    <div class="flex justify-between">
      <label class="cursor-pointer flex items-start">
        <input type="checkbox" class="hidden" @change="() => (checkbox = !checkbox)" />
        <span class="h-4 w-4 border rounded flex-none inline-flex mr-3 relative top-1 transition-all duration-150" :class="checkbox
          ? 'ring-2 ring-black-500 dark:ring-offset-slate-600 dark:ring-slate-900  dark:bg-slate-900 ring-offset-2 bg-slate-900'
          : 'bg-slate-100 dark:bg-slate-600 border-slate-100 dark:border-slate-600 '
          ">
          <img src="@/assets/images/icon/ck-white.svg" alt="" class="h-[10px] w-[10px] block m-auto" v-if="checkbox" />
        </span>
        <span class="text-slate-500 dark:text-slate-400 text-sm leading-6">Keep me signed in</span>
      </label>
      <router-link to="/forgot-password" class="text-sm text-slate-800 dark:text-slate-400 leading-6 font-medium">Forgot
        Password?</router-link>
    </div>

    <Button text="Sign in" type="submit" btnClass="btn btn-dark block w-full text-center" :isLoading="auth.isLoading" />
  </form>
</template>
<script setup>
import { ref, onMounted } from "vue";
import Textinput from "@/components/Textinput";
import Button from "@/components/Button";
import { useField, useForm } from "vee-validate";
import * as yup from "yup"; 

import { useAuthStore } from "@/store/auth"; 

const auth = useAuthStore();

const checkbox = ref(false);
 
  
const authForm = {
  email: '',
  password: ''
}; 

onMounted(() => {
   
});


</script>
<style lang="scss"></style>
