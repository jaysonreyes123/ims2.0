<template>
 
  <router-link :to="{ name: 'dashboard' }">
    <div class="flex" style="align-items:center">
    <img
      :src="authstore.fmslogo"
      alt=""
      v-if="!this.$store.themeSettingsStore.isDark"
      style="max-width: 150px;max-height: 50px;"
    />

    <img
      :src="authstore.fmslogo"
      alt=""
      v-if="this.$store.themeSettingsStore.isDark"
      style="max-width: 150px;max-height: 50px;"
    />
    <span class="font-bold ml-2">{{authstore.fmssite}}</span>
  </div>
  </router-link>
</template>
<script>
  import {useAuthStore} from "@/store/auth";
  const authstore = useAuthStore();

  export default{
    data(){
      return{
        authstore
      }
    }
  }
</script>
