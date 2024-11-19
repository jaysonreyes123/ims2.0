<template>
  <div class="mb-4 flex">
    <span class="capitalize font-bold">{{ this.$route.params.module }}</span>
    <Icon class="mt-1" icon="heroicons-outline:chevron-right"></Icon> 
    All {{ this.$route.params.module }}
  </div>
</template>

<script>
import Icon from "@/components/Icon";
export default {
  components:{
    Icon
  }
}
</script>

<style>

</style>