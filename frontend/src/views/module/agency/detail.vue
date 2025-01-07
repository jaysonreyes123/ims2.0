<template>
  <div>
    <Loading v-model:active="ModuleStore.loading" />
    <div v-for="(block,index) in blocks" :key="index" >
            <Block :title="block.block_name" >
                <div class="lg:grid gap-x-12" style="grid-template-columns: 1fr 1fr;"> 
                    <div v-for="(field,i) in block.fields" :key="i" :class="`custom-grid-${i%2}`" class="mt-4">
                      <div class="fromGroup relative">
                          <label>{{ field.label }}</label>
                          <span v-if="field.type != 'picklist' ">{{ ModuleStore.form[field.name] }}</span>
                          <span v-else>
                            <span v-if="field.name == 'assigned_to_picklist' ">
                                {{ user_store.get_single_assigned_to_picklist(ModuleStore.form[field.name]) }}
                            </span>
                            <span v-else>{{ find_picklist_value(field.name,ModuleStore.form[field.name]) }}</span>
                          </span>
                      </div>
                    </div>
                </div>
            </Block>
        </div>
        <Block blockname="System Generated">
            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                      <label for="" >Created time</label>
                      <span>{{ ModuleStore.data.created_at }}</span>
                  </div>
                  <div class="fromGroup relative">
                      <label for="" >Created By</label>
                      <span>{{ ModuleStore.data.created_by }}</span>
                  </div>
            </div>
            <div class="lg:grid lg:grid-cols-2 gap-12">
                  <div class="fromGroup relative">
                      <label for="" >Last updated</label>
                      <span>{{ ModuleStore.data.updated_at }}</span>
                  </div> 
                  <div class="fromGroup relative">
                      <label for="" >Last updated by</label>
                      <span>{{ ModuleStore.data.updated_by }}</span>
                  </div> 
            </div>
          </Block>
  </div>
</template>
<script>
import Card from "@/components/Card";
import Block from "../../components/Block";
import Map from "../../components/Map"
import { useAgencyStore } from "@/store/agency";
import { agency_fields } from "../fields/agency";
const ModuleStore = useAgencyStore();

import { useUserStore } from "@/store/user";
const user_store = useUserStore();
export default {
  components:{
    Block,
    Map,
    Card,
  },
  mounted(){
    const id = this.$route.params.id;
    ModuleStore.id = id;
    ModuleStore.getItem();
  },
  methods:{
    find_picklist_value(name,value){
      var label = "";
      if(ModuleStore[name] !== undefined){
        const option = ModuleStore[name].find(item => item.id == value )
        if(option !== undefined){
          label = option.label;
        } 
      }
      return label;
    }
  },
  data(){
    return{
      ModuleStore,
      blocks:agency_fields,
      user_store
    }
  }
}
</script>

<style scoped>
label{
  font-weight: bold;
}
.fromGroup{
  margin-bottom: 15px;
  display: flex;

}
.custom-grid-0{
    grid-column:1
}
.custom-grid-1{
    grid-column:2
}
.fromGroup label{
  overflow-wrap:break-word;
  width: 200px;
  margin-bottom: 0.5rem;
  font-size: 0.875rem;
  line-height: 1.5rem;
  text-transform: capitalize;
}
.fromGroup span{
  font-size: 0.875rem;
}
</style>