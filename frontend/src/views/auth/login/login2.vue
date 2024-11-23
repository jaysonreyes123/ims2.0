<template>
  <div class="loginwrapper">
    <div class="lg-inner-column">
      <div class="right-column relative">
        <div
          class="inner-content h-full flex flex-col bg-white dark:bg-slate-800"
        >
          <div class="auth-box h-full flex flex-col justify-center">
            <div class="mobile-logo text-center mb-6 lg:hidden block">
              <router-link to="/"
                ><img
                  :src="logo"
                  alt=""
                  class="mx-auto"
              /></router-link>
            </div>
            <div class="text-center 2xl:mb-10 mb-4">
              <h4 class="font-medium">Sign in</h4>
              <div class="text-slate-500 dark:text-slate-400 text-base">
                Sign in to your account to start using FMS
              </div>
            </div>
            <Signin />
            <!-- <div
              className=" relative border-b-[#9AA2AF] border-opacity-[16%] border-b pt-6"
            >
              <div
                className=" absolute inline-block  bg-white dark:bg-slate-800 left-1/2 top-1/2 transform -translate-x-1/2 px-4 min-w-max text-sm  text-slate-500  dark:text-slate-400font-normal "
              >
                Or continue with
              </div>
            </div> -->
            <!-- <div class="max-w-[242px] mx-auto mt-8 w-full">
              <Social />
            </div> -->
            <!-- <div
              class="md:max-w-[345px] mt-6 mx-auto font-normal text-slate-500 dark:text-slate-400mt-12 uppercase text-sm"
            >
              Don’t have an account? Sign up
              <router-link
                to="/"
                class="text-slate-900 dark:text-white font-medium hover:underline"
              >
                Sign up</router-link
              >
            </div> -->
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
</template>
<script>
import Signin from "../common/Signin";
import Social from "../common/Social";
// Image Import
import loginBg from "@/assets/images/all-img/istockphoto-520773327-612x612.jpg"
import logoWhite from "@/assets/images/logo/fmslogo-white.png"
import logo from "@/assets/images/logo/logo.svg"

export default {
  data () {
    return {
      logoWhite,logo,loginBg
    }
  },
  components: {
    Social,
    Signin,
  },
  created(){
           this.rg_event.stopListening(".rg-event");
           this.wl_event.stopListening(".wl-event");
           this.single_event.stopListening(".single-chart-event");
           this.incident_event.stopListening(".incident-event");
  }
};
</script>
<style lang="scss"></style>
