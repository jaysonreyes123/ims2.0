<template>
  <router-view  />
</template>

<script>
import { useThemeSettingsStore } from "@/store/themeSettings";

export default {
  mounted() {
    this.$store.themeSettingsStore = useThemeSettingsStore()
  }
}
</script>

<style>
.router-link-exact-active .items-center{
  background: #5f758c;
  color:white;
  padding: 0px 10px;
  border-radius: 10px;
}
.router-link-exact-active .items-center span{
  background: #5f758c;
  color:white;
}
</style>
