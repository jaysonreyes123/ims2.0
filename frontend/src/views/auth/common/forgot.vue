<template>
  <form @submit.prevent="auth.forgotPassword(forgotForm.email)" class="space-y-4">
    <Textinput
      label="Email"
      type="email"
      placeholder="Type your email"
      name="emil"
      v-model="forgotForm.email"
      classInput="h-[48px]"
    />

    <Button text="Send recovery email" type="submit" btnClass="btn btn-dark block w-full text-center" :isLoading="auth.isLoadingForgotPassword" />
  </form>
</template>
<script setup>
import Textinput from "@/components/Textinput";
import { useAuthStore } from "@/store/auth";
import Button from "@/components/Button";
const auth = useAuthStore();
auth.isLoadingForgotPassword = false;
const forgotForm ={
  email: ''
}

</script>
<style lang="scss"></style>
