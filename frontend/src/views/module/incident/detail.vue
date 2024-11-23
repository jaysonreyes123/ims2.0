<template>
  <div>
    <Loading v-model:active="IncidentStore.loading" />
    <div>
        <Block blockname="Incident Details">
          <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Incident No :</label>
                  {{ IncidentStore.form.incident_no }}
              </div>
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Incident Type :</label>
                  {{ getSingleIncidentTypes }}
              </div>
            </div>
            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Time of Incident :</label>
                      <span class="ml-1" v-if="IncidentStore.form.time_of_incident != ''">
                        {{ IncidentStore.form.time_of_incident }}
                      </span>
              </div>
              <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Date of Incident :</label>
                      {{ IncidentStore.form.date_of_incident }}
              </div>
            </div>
            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Incident Status :</label>
                      {{ IncidentStore.form.incident_status }}
                  </div>
                  <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Incident Priority :</label>
                      {{ IncidentStore.form.incident_priority }}
                  </div>
            </div>
            <div class="lg:grid lg:grid-cols-1 gap-12">
              <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Notes/Remarks :</label>
                      {{ IncidentStore.form.remarks }}
              </div>
            </div>
        </Block>
        <Block blockname="Location Details">
              <div class="lg:grid lg:grid-cols-2 gap-12">
                  <div>
                    <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Location :</label>
                      {{ IncidentStore.form.location }}
                    </div>
                    <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Street name :</label>
                      {{ IncidentStore.form.street_name }}
                    </div>

                    <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Nearest landmark :</label>
                      {{ IncidentStore.form.nearest_landmark }}
                    </div>

                    <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Coordinates :</label>
                      {{ IncidentStore.form.coordinates }}
                    </div>
                  </div>
                  <div>
                      <Map :set_coordinates="IncidentStore.form.coordinates" />
                  </div>
              </div>
          </Block>

          <Block blockname="Caller Details">
            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">First Name :</label>
                      {{ IncidentStore.form.caller_firstname }}
                  </div>
                  <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Last Name :</label>
                      {{ IncidentStore.form.caller_lastname }}
                  </div>
            </div>
            <div class="lg:grid lg:grid-cols-1 gap-12">
                <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Contact no. :</label>
                      {{ IncidentStore.form.caller_contact }}
                  </div> 
            </div>
          </Block>

          <Block blockname="Responder Details">
            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Responder Team :</label>
                      {{ IncidentStore.form.response_team }}
                  </div>
                  <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Assigned By :</label>
                      {{ IncidentStore.form.assigned_by }}
                  </div>
            </div>
            <div class="lg:grid lg:grid-cols-1 gap-12">
                <div class="fromGroup relative">
                      <label for="" class="inline-block input-label">Assigned Team :</label>
                      {{ IncidentStore.form.assigned_team }}
                  </div> 
            </div>
          </Block>
      </div>
  </div>
</template>

<script>
import Card from "@/components/Card";
import Block from "../../components/Block";
import { useIncidentStore } from "@/store/incident";
import Map from "../../components/Map"
const IncidentStore = useIncidentStore();
export default {
  components:{
    Block,
    Map,
    Card,
  },
  mounted(){
    const id = this.$route.params.id;
    IncidentStore.id = id;
    IncidentStore.getItem();
  },
  computed:{
    getSingleIncidentTypes(){
        var incident_type = IncidentStore.getSingleIncidentType;
        var incident_type_ = incident_type(IncidentStore.form.incident_type);
        return incident_type_ === undefined ?  "" : incident_type_.name;
    }
  },  
  data(){
    return{
      IncidentStore,
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