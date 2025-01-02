<template>
  <div>
    <Loading v-model:active="ModuleStore.loading" />
    <div v-for="(block,index) in blocks" :key="index" >
            <Block :title="block.block_name" >
                <div class="lg:grid gap-x-12" style="grid-template-columns: 1fr 1fr;"> 
                    <div v-for="(field,i) in block.fields" :key="i" :class="`custom-grid-${i%2}`" class="mt-4">
                      <div class="fromGroup relative">
                          <label>{{ field.label }}</label>
                          <span v-if="field.type != 'picklist' ">
                            <span v-if="field.type == 'checkbox' ">
                              <Badge v-if="ModuleStore.form.user_privileges[split_name(field.name)]" label="Active" badgeClass="bg-success-500 text-white" />
                              <Badge v-if="!ModuleStore.form.user_privileges[split_name(field.name)]" label="Inactive" badgeClass="bg-danger-500 text-white" />
                            </span>
                            <span v-else>
                              {{ ModuleStore.form[field.name] }}
                            </span>
                          </span>
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
  </div>
</template>
<script>
import Badge from "@/components/Badge";
import Card from "@/components/Card";
import Block from "../../components/Block";
import Map from "../../components/Map"
import { user_fields } from "../fields/user";
import { useUserStore } from "@/store/user";
const ModuleStore = useUserStore();
export default {
  components:{
    Block,
    Map,
    Card,
    Badge
  },
  mounted(){
    const id = this.$route.params.id;
    ModuleStore.id = id;
    ModuleStore.getItem();
    console.log(ModuleStore.form)
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
    },
    split_name(name){
            const split_name = name.split(".");
            return split_name[1];
    },
  },
  data(){
    return{
      ModuleStore,
      blocks:user_fields,
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