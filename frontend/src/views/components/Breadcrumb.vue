<template>
  <div class="mb-4 flex">
    <div v-if="mode == 'list' || mode == 'view' " class="flex">
      <span class="capitalize font-bold">{{ this.$route.params.module }}</span>
      <Icon class="mt-1" icon="heroicons-outline:chevron-right"></Icon> 
      <router-link :class="[mode != 'list' ? 'font-bold' : '' ]" :to="`/app/module/${this.$route.params.module}`">All </router-link>
      <Icon v-if="mode != 'list' " class="mt-1" icon="heroicons-outline:chevron-right"></Icon> 
      <span v-if="mode != 'list' ">{{  getName  }}</span>
    </div>
    <div v-if="mode == 'edit' ">
         <span class="font-bold">{{ editName }}</span> 
    </div>
  </div>
</template>

<script>
import Icon from "@/components/Icon";
import { useIncidentStore } from "@/store/incident";
import { useResourcesStore } from "@/store/resources";
const IncidentStore = useIncidentStore();
const ResourceStore = useResourcesStore();
const pre_name = {
  'incidents' : 'incident_no',
  'resources' : 'resources_name'
};
export default {
  components:{
    Icon
  },
  props:{
    mode:{
      type:String,
      default:"list"
    }
  },
  computed:{
      getName(){
        const modules = this.$route.params.module;
        var name = "";
        switch (modules) {
          case 'incidents':
            name = IncidentStore.form[pre_name[modules]]
            break;
          case 'resources':
            name = ResourceStore.form[pre_name[modules]]
            break;
          default:
            break;
        }
        return name;
      },
      editName(){
        var edit_name = "";
        if(this.$route.params.id == ""){
          edit_name = "Creating new "+this.$route.params.module; 
        }
        return edit_name;
      }
  }
}
</script>

<style>

</style>