<template>
  <div>
    <Loading v-model:active="ResourcesStore.loading" />
    <div>
      <Block blockname="Resources Information">

            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Resource Name :</label>
                  {{ ResourcesStore.form.resources_name }}
              </div>
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Resource Type :</label>
                  {{ getResourceType }}
              </div>
            </div>

            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Quantity :</label>
                  {{ ResourcesStore.form.quantity }}
              </div>
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Status :</label>
                  {{ getResourceStatus }}
              </div>
            </div>

            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Contact info :</label>
                  {{ ResourcesStore.form.contact_info }}
              </div>
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Owner :</label>
                  {{ ResourcesStore.form.owner }}
              </div>
            </div>

            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Date Acquired :</label>
                  {{ ResourcesStore.form.date_acquired }}
              </div>
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Dispatch :</label>
                  {{ getResourceDispatch }}
              </div>
            </div>

            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Remarks :</label>
                  {{ ResourcesStore.form.remarks }}
              </div>
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Condition :</label>
                  {{ getResourceCondition }}
              </div>
            </div>

        </Block>
        <Block blockname="Location Details">
              <div class="lg:grid lg:grid-cols-2 gap-12">
                  <div>
                    <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Coordinates :</label>
                      {{ ResourcesStore.form.coordinates }}
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
  computed:{
    getResourceType(){
        const type  = ResourcesStore.getSingleResourceType;
        const type_ = type(ResourcesStore.form.resources_type_picklist);
        return type_ === undefined ?  "" : type_.name;
    },
    getResourceStatus(){
        const status  = ResourcesStore.getSingleResourceStatus;
        const status_ = status(ResourcesStore.form.resources_status_picklist);
        return status_ === undefined ?  "" : status_.name;
    },
    getResourceDispatch(){
        const dispatch  = ResourcesStore.getSingleResourceDispatch;
        const dispatch_ = dispatch(ResourcesStore.form.dispatch_picklist);
        return dispatch_ === undefined ?  "" : dispatch_.name;
    },
    getResourceCondition(){
        const condition  = ResourcesStore.getSingleResourceCondition;
        const condition_ = condition(ResourcesStore.form.condition_picklist);
        return condition_ === undefined ?  "" : condition.name;
    },
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
  margin-bottom: 20px;
}
</style>