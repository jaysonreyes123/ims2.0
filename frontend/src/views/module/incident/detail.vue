<template>
  <div>
    <Loading v-model:active="IncidentStore.loading" />
    <div>
        <Block blockname="Incident Details">
          <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                  <label>Incident No</label>
                  <span>{{ IncidentStore.form.incident_no }}</span>
              </div>
              <div class="fromGroup relative">
                  <!-- <label for="" class="inline-block input-label">Incident Type :</label> -->
                  <label>Incident Type</label>
                  <span>  {{ find_picklist_value('incident_types_picklist',IncidentStore.form.incident_types_picklist) }} </span>
              </div>
            </div>
            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                      <!-- <label for="" class="inline-block input-label">Time of Incident :</label> -->
                      <label>Time of Incident</label>
                        <span v-if="IncidentStore.form.time_of_incident != ''">
                          {{ IncidentStore.form.time_of_incident }}
                        </span>
              </div>
              <div class="fromGroup relative">
                      <label>Date of Incident</label>
                      <span>{{ IncidentStore.form.date_of_incident }}</span>
              </div>
            </div>
            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                      <label>Incident Status</label>
                      <span>{{ find_picklist_value('incident_statuses_picklist',IncidentStore.form.incident_statuses_picklist) }}</span>
                  </div>
                  <div class="fromGroup relative">
                      <label>Incident Priority</label>
                      <span>{{ find_picklist_value('incident_priorities_picklist',IncidentStore.form.incident_priorities_picklist) }}</span>
                  </div>
            </div>
            <div class="lg:grid lg:grid-cols-1 gap-12">
              <div class="fromGroup relative">
                      <label for="">Notes/Remarks</label>
                      <span>{{ IncidentStore.form.remarks }}</span>
              </div>
            </div>
        </Block>
        <Block blockname="Location Details">
              <div class="lg:grid lg:grid-cols-2 gap-12">
                  <div>
                    <div class="fromGroup relative">
                      <label for="">Location</label>
                        <span>{{ IncidentStore.form.location }}</span>
                    </div>
                    <div class="fromGroup relative">
                      <label for="">Street name</label>
                        <span>{{ IncidentStore.form.street_name }}</span>
                    </div>

                    <div class="fromGroup relative">
                      <label for="">Nearest landmark</label>
                        <span>{{ IncidentStore.form.nearest_landmark }}</span>
                    </div>

                    <div class="fromGroup relative">
                      <label for="">Coordinates</label>
                        <span>{{ IncidentStore.form.coordinates }}</span>
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
                      <label for="">First Name</label>
                      <span>{{ IncidentStore.form.caller_firstname }}</span>
                  </div>
                  <div class="fromGroup relative">
                      <label for="">Last Name</label>
                      <span>{{ IncidentStore.form.caller_lastname }}</span>
                  </div>
            </div>
            <div class="lg:grid lg:grid-cols-1 gap-12">
                <div class="fromGroup relative">
                      <label for="">Contact no</label>
                      <span>{{ IncidentStore.form.caller_contact }}</span>
                  </div> 
            </div>
          </Block>

          <Block blockname="Responder Details">
            <div class="lg:grid lg:grid-cols-2 gap-12">
              <div class="fromGroup relative">
                      <label for="" >Responder Team</label>
                      <span>{{ IncidentStore.form.response_team }}</span>
                  </div>
                  <div class="fromGroup relative">
                      <label for="" >Assigned By</label>
                      <span>{{ IncidentStore.form.assigned_by }}</span>
                  </div>
            </div>
            <div class="lg:grid lg:grid-cols-1 gap-12">
                <div class="fromGroup relative">
                      <label for="" >Assigned Team</label>
                      <span>{{ IncidentStore.form.assigned_team }}</span>
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
  methods:{
    find_picklist_value(name,value){
      var label = "";
      if(IncidentStore[name] !== undefined){
        const option = IncidentStore[name].find(item => item.id == value )
        if(option !== undefined){
          label = option.label;
        } 
      }
      return label;
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