<template>
  <div>
    <Loading v-model:active="ResourcesStore.loading" />
    <div>
      <Block blockname="Resources Information">

            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label for="">Resource Name</label>
                  <span>{{ ResourcesStore.form.resources_name }}</span>
              </div>
              <div class="fromGroup relative">
                  <label for="">Resource Type</label>
                  <span>{{ find_picklist_value('resources_types_picklist',ResourcesStore.form.resources_types_picklist) }}</span>
              </div>
            </div>

            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label for="">Quantity</label>
                  <span>{{ ResourcesStore.form.quantity }}</span>
              </div>
              <div class="fromGroup relative">
                  <label for="">Status</label>
                  <span>{{ find_picklist_value('resources_statuses_picklist',ResourcesStore.form.resources_statuses_picklist) }}</span>
              </div>
            </div>

            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label for="">Contact info</label>
                  <span>{{ ResourcesStore.form.contact_info }}</span>
              </div>
              <div class="fromGroup relative">
                  <label for="">Owner</label>
                  <span>{{ ResourcesStore.form.owner }}</span>
              </div>
            </div>

            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label for="">Date Acquired</label>
                  <span>{{ ResourcesStore.form.date_acquired }}</span>
              </div>
              <div class="fromGroup relative">
                  <label for="">Dispatch</label>
                  <span>{{ find_picklist_value('dispatchers_picklist',ResourcesStore.form.dispatchers_picklist) }}</span>
              </div>
            </div>

            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label for="">Remarks</label>
                  <span>{{ ResourcesStore.form.remarks }}</span>
              </div>
              <div class="fromGroup relative">
                  <label for="">Condition</label>
                  <span>{{ find_picklist_value('conditions_picklist',ResourcesStore.form.conditions_picklist) }}</span>
              </div>
            </div>

        </Block>
        <Block blockname="Location Details">
              <div class="lg:grid lg:grid-cols-2 gap-12">
                  <div>
                    <div class="fromGroup relative">
                      <label for="">Coordinates</label>
                      <span>{{ ResourcesStore.form.coordinates }}</span>
                    </div>
                  </div>
                  <div>
                      <Map :set_coordinates="ResourcesStore.form.coordinates" />
                  </div>
              </div>
          </Block>
      </div>
  </div>
</template>
<script>
import Card from "@/components/Card";
import Block from "../../components/Block";
import { useResourcesStore } from "@/store/resources";
import Map from "../../components/Map"
const ResourcesStore = useResourcesStore();
export default {
  components:{
    Block,
    Map,
    Card,
  },
  methods:{
    find_picklist_value(name,value){
      var label = "";
      if(ResourcesStore[name] !== undefined){
        const option = ResourcesStore[name].find(item => item.id == value )
        if(option !== undefined){
          label = option.label;
        } 
      }
      return label;
    }
  },
  mounted(){
    const id = this.$route.params.id;
    ResourcesStore.id = id;
    ResourcesStore.getItem();
  },
  data(){
    return{
      ResourcesStore,
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