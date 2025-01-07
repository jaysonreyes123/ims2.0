<template>
    <div
      class="loginwrapper bg-cover bg-no-repeat"
      :style="{
        backgroundImage:
          'url(' + pageBg+ ')',
      }"
    >
      <div class="lg-inner-column">
        <div class="left-columns lg:w-1/2 lg:block hidden">
          <!-- <div class="logo-box-3">
            <router-link to="/" class="">
              <img
                :src="logoWhite"
                alt=""
                class="mb-10"
              />
            </router-link>
          </div> -->
        </div>
        <div class="lg:w-1/2 w-full flex flex-col items-center justify-center">
          <div class="auth-box-3">
            <div class="mobile-logo text-center mb-6 lg:hidden block">
              <router-link to="/"
                ><img :src="logo" alt="" class="mx-auto"
              /></router-link>
            </div>
            <div class="text-center 2xl:mb-10 mb-5">
              <h4 class="font-medium mb-4">Reset Password?</h4>
              <div class="text-slate-500 dark:text-slate-400 text-base">
                Reset Password with IMS.
              </div>
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
        </div>
        <!-- <div class="auth-footer3 text-white py-5 px-5 text-xl w-full">
          Unlock your Project performance
        </div> -->
      </div>
    </div>
  </template>
  <script>
  import ForgotPass from "./common/resetPassword";
  
  // Image Import
  import pageBg from "@/assets/images/all-img/bg3.png"
  import logoWhite from "@/assets/images/logo/logo-white.svg"
  import logo from "@/assets/images/logo/logo.svg"
  
  export default {
    data () {
      return {
        logoWhite,logo,pageBg
      }
    },
    components: {
      ForgotPass,
    },
  };
  </script>
  <style lang="scss"></style>
  