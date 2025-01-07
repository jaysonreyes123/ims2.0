<template>
    <div class="loginwrapper">
      <div class="lg-inner-column">
        <div class="right-column relative">
          <div
            class="inner-content h-full flex flex-col bg-white dark:bg-slate-800"
          >
            <div class="auth-box2 flex flex-col justify-center h-full">
              <div class="mobile-logo text-center mb-6 lg:hidden block">
                <router-link to="/"
                  ><img
                    :src="logo"
                    alt=""
                    class="mx-auto"
                /></router-link>
              </div>
              <div class="text-center 2xl:mb-10 mb-5">
                <h4 class="font-medium mb-4">Reset Your Password</h4>
              </div>
              <ForgotPass />
              <div
                class="md:max-w-[345px] mx-auto font-normal text-slate-500 dark:text-slate-400 2xl:mt-12 mt-8 uppercase text-sm"
              >
                Forget It,
                <router-link
                  to="/"
                  class="text-slate-900 dark:text-white font-medium hover:underline"
                >
                  Send me Back
                </router-link>
                to The Sign In
              </div>
            </div>
            <div class="auth-footer text-center">
              Copyright 2023, FMS v1.0.0 - All Rights Reserved.
            </div>
          </div>
        </div>
        <div
        class="left-column bg-cover bg-no-repeat bg-center"
          :style="{
            backgroundImage:
              'url(' + loginBg + ')',
          }"
        >
          <div class="flex flex-col h-full justify-center">
            <div class="flex flex-col h-full justify-center"> 
            <div>
              <div
                class="black-500-title max-w-[525px] mx-auto pb-20 text-center"
              >
                <span class="font-bold">FLOOD MONITORING SYSTEM</span>
                <br>
                <small class="text-sm">by Microbiz One Inc</small> 
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  <script>
  import ForgotPass from "./common/resetPassword";
  // Image Import
  import pageBg from "@/assets/images/all-img/bg3.png"
  import logoWhite from "@/assets/images/logo/logo-white.svg"
  import logo from "@/assets/images/logo/logo.svg"
  import loginBg from "@/assets/images/all-img/istockphoto-520773327-612x612.jpg"
  export default {
    data () {
      return {
        logoWhite,logo,pageBg,loginBg
      }
    },
    components: {
      ForgotPass,
    },
  };
  </script>
  <style lang="scss"></style>
  