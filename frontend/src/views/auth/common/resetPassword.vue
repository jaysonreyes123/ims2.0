<template>
    <form @submit.prevent="auth.resetPassword(resetForm)" class="space-y-4">
        <Textinput
        label="Password"
        type="password"
        placeholder="password"
        v-model="resetForm.password"
        classInput="h-[48px]"
      />
      <Textinput
        label="Confirm Password"
        type="password"
        placeholder="confirm passowrd"
        v-model="resetForm.confirm_password"
        classInput="h-[48px]"
      />
  
      <Button text="Reset Password" type="submit" btnClass="btn btn-dark block w-full text-center" :isLoading="auth.isLoadingResetPassword" />
    </form>

    
  </template>
  <script setup>

  import Textinput from "@/components/Textinput";
  import { useAuthStore } from "@/store/auth";
  import Button from "@/components/Button";
  import { useRoute } from 'vue-router'

  const route = useRoute();
  const auth = useAuthStore();

  auth.isLoadingResetPassword = false;
  const resetForm ={
    password: '',
    confirm_password:'',
    token:route.params.token
  }
  </script>
  <style lang="scss"></style>
  