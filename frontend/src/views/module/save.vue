<template>
    <div>
        <Breadcrumb mode='edit' />
        <Loading v-model:active="ModuleStore.loading"/>
      <form @submit.prevent="saveForm">
        <div v-for="(block,index) in fields_computed" :key="index" >
            <Block v-if="block.block_name == 'Location Details'" :title="block.block_name"  >
                <div class="lg:grid lg:grid-cols-2 gap-12">
                    <div>
                        <Textinput :isReadonly="field.readonly" class="mt-4" v-for="(field,i) in block.fields" :key="i" v-model="form[field.name]" :label="field.label" :placeholder="`Enter ${field.label}`" />
                    </div>
                    <div>
                        <Map :set_coordinates="form['coordinates']" @updateCoordinate="updateCoordinates"  />
                    </div>
                </div>
            </Block>
            <Block :title="block.block_name" v-else>
                <div class="lg:grid gap-x-12" style="grid-template-columns: 1fr 1fr;"> 
                    <div v-for="(field,i) in block.fields" :key="i" :class="`custom-grid-${i%2}`" class="mt-4">
                        <div v-if="field.type == 'time' ">
                            <div class="fromGroup relative">
                                <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span> </label>
                                <flat-pickr
                                    v-model="form[field.name]"
                                    class="form-control"
                                    placeholder="HH:mm"
                                    :config="{ enableTime: true, noCalendar: true, dateFormat: 'H:i:00',time_24hr:true,minuteIncrement:1 }"
                                />
                            </div>
                        </div>
                        <div v-else-if="field.type == 'date' ">
                            <div class="fromGroup relative">
                                <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                <flat-pickr
                                    v-model="form[field.name]"
                                    class="form-control"
                                    placeholder="yyyy-mm-dd"
                                    :config="{ dateFormat:'Y-m-d' }"
                                />
                            </div>
                        </div>
                        <div v-else-if="field.type == 'picklist' ">
                            <div class="fromGroup relative" v-if="field.name == 'assigned_to_picklist' ">
                                <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                <Select placeholder="Select an option" :reduce="(option) => option.id" :options="user_store[field.name]" v-model="form[field.name]"/>
                            </div>
                            <div class="fromGroup relative" v-else>
                                <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                <Select placeholder="Select an option" :reduce="(option) => option.id" :options="ModuleStore[field.name]" v-model="form[field.name]"/>
                            </div>
                        </div>
                        <div v-else-if="field.type == 'textarea'">
                            <div class="fromGroup relative">
                                <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                <Textarea :placeholder="`Enter ${field.label}`" v-model="form[field.name]" />
                            </div>
                        </div>
                        <div v-else-if="field.type == 'checkbox'">
                            <Switch :label="field.label" v-model="form[field.name]" :active="form[field.name]" class="mb-5" />
                        </div>
                        <div v-else>
                            <div class="fromGroup relative">
                                <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                <Textinput :isReadonly="field.readonly" :type="field.type" :name="form[field.name]" v-model="form[field.name]" :placeholder="`Enter ${field.label}` " />
                            </div>
                        </div>
                    </div>
                </div>
            </Block>
        </div>
        <Block>
            <Button class="w-full bg-emerald-500/100 hover:bg-emerald-600/100" :text="saveBtn" />
        </Block>
       </form>
    </div>
  </template>
  <script>
  import Swal from 'sweetalert2';
  import Block from "../components/Block";
  import Textinput from "@/components/Textinput"
  import Button from "@/components/Button";
  import Select from "vue-select";
  import Map from "../components/Map";
  import Textarea from "@/components/Textarea"
  import Breadcrumb from "../components/Breadcrumb.vue";
  import Switch from '@/components/Switch';

  import { contacts_field } from "./fields/contacts";
  import { incidents_field } from "./fields/incidents";
  import { resources_field } from "./fields/resources";
  import { agency_fields } from './fields/agency';
  import { responder_fields } from './fields/responder';
  import { preplan_fields } from './fields/preplan';
  import { user_fields } from './fields/user';

  import { useIncidentStore } from "@/store/incident";
  import { useResourcesStore } from "@/store/resources";
  import { useContactsStore } from "@/store/contact";
  import { useAgencyStore } from '@/store/agency';
  import { useResponderStore } from '@/store/responder';
  import { usePreplanStore } from '@/store/preplan';

  import { useUserStore } from '@/store/user';
  const user_store = useUserStore();
  export default {
      components:{
          Block,
          Textinput,
          Button,
          Select,
          Textarea,
          Map,
          Breadcrumb,
          Switch
      },
      data(){
          return{
            saveBtn:"Save "+this.$route.params.module,
              contacts_field,
              incidents_field,
              form:{},
              loading:false,
              user_store
          }
      },
      created(){
        this.form = this.ModuleStore.form;
        if(this.$route.params.id != "" && this.$route.params.id != undefined ){
            //get data for editing
            this.ModuleStore.id = this.$route.params.id;
            this.ModuleStore.getItem();
        }
        else{
            //this.ModuleStore.clearField();
            this.clearField();
        }
      },
      mounted(){
        //auto generate incident no
        if(this.form.id === undefined && this.$route.params.module == 'incidents'){
            useIncidentStore().generate_id(this.$route.params.module);
        }
        this.load_picklist();
      },
      methods:{
        clearField(){
            this.fields_computed.map(item=>{
                item.fields.map(item2=>{
                    this.ModuleStore.form[item2.name] = item2.default;
                })
            });
        },
        saveForm(){
           this.ModuleStore.form = this.form;
           var error = "";
           this.RequiredField.map(item=>{
                if(this.ModuleStore.form[item.name] == ""){
                    error+=`<span class="text-red-500"><b>${item.label}</b> is required field</span><br>`;
                }
           })
           if(error != ""){
            Swal.fire({
                icon: "error",
                title: "Something wrong",
                html:error,
            });
            return false;
           }
           console.log(this.ModuleStore.form)
           //this.ModuleStore.save();
        },
        updateCoordinates(event){
            const {lng,lat} = event;
            this.ModuleStore.form.coordinates = lng+","+lat;
        },
        load_picklist(){
            const modules = this.$route.params.module;
            //load assigned to
            if(user_store.assigned_to.length == 0){
                user_store.get_assigned_to();
            }

            if(modules == 'incidents'){
                if(this.ModuleStore.incident_statuses_picklist.length == 0){
                    this.ModuleStore.get_incident_status();
                }
                if(this.ModuleStore.incident_types_picklist.length == 0){
                    this.ModuleStore.get_incident_type();
                }
                if(this.ModuleStore.incident_priorities_picklist.length == 0){
                    this.ModuleStore.get_incident_priority();
                } 
            }
            else if(modules == 'resources'){
                if(this.ModuleStore.resources_types_picklist.length == 0){
                    this.ModuleStore.get_resources_type();
                }
                if(this.ModuleStore.resources_statuses_picklist.length == 0){
                    this.ModuleStore.get_resources_status();
                }
                if(this.ModuleStore.conditions_picklist.length == 0){
                    this.ModuleStore.get_resources_condition();
                }
                if(this.ModuleStore.dispatchers_picklist.length == 0){
                    this.ModuleStore.get_resources_dispatch();
                }

            }
            else if(modules == 'contacts'){
                if(this.ModuleStore.caller_types_picklist.length == 0){
                    this.ModuleStore.get_caller_types();
                } 
                if(this.ModuleStore.municipalities_picklist.length == 0){
                    this.ModuleStore.get_municipalities();
                } 
                if(this.ModuleStore.barangays_picklist.length == 0){
                    this.ModuleStore.get_barangay();
                } 
            }
            else if(modules == 'agencies'){
                if(this.ModuleStore.municipalities_picklist.length == 0){
                    this.ModuleStore.get_municipalities();
                } 
                if(this.ModuleStore.barangays_picklist.length == 0){
                    this.ModuleStore.get_barangay();
                } 
            }
            else if(modules == 'responders'){
                if(this.ModuleStore.responder_types_picklist.length == 0){
                    this.ModuleStore.get_responder_type();
                } 
            }

            else if(modules == 'pre-plans'){
                if(this.ModuleStore.pre_plan_classifications_picklist.length == 0){
                    this.ModuleStore.get_preplan_classification();
                } 
            }
        },
      },
      computed:{
        fields_computed(){
            let fields__;
            const modules__ = this.$route.params.module;
            switch (modules__) {
                case 'incidents':
                    fields__ = incidents_field;
                    break;
                case 'resources':
                    fields__ = resources_field;
                    break;
                case 'contacts':
                    fields__ = contacts_field;
                    break;
                case 'agencies':
                    fields__ = agency_fields;
                    break;
                case 'responders':
                    fields__ = responder_fields;
                    break;
                case 'pre-plans':
                    fields__ = preplan_fields;
                    break;
                case 'users':
                    fields__ = user_fields;
                    break;
                default:
                    break;
            }
        return fields__;
        },
        RequiredField(){
            const required_field = [];
            this.fields_computed.map(item=>{
                item.fields.map(item2=>{
                    if(item2.required){
                        required_field.push(item2)
                    }
                })
            });
           return required_field;
        },
        ModuleStore(){
            const module_  = this.$route.params.module;
            let module_store;
            switch (module_) {
                case 'incidents':
                    module_store = useIncidentStore();
                    break;
                case 'resources':
                    module_store = useResourcesStore();
                    break;
                case 'contacts':
                    module_store = useContactsStore();
                    break;
                case 'agencies':
                    module_store = useAgencyStore();
                    break;
                case 'responders':
                    module_store = useResponderStore();
                    break;
                case 'pre-plans':
                    module_store = usePreplanStore();
                    break;
                case 'users':
                    module_store = user_store;
                    break;
                default:
                    break;
            }
            return module_store;
        },
      }
  }
  </script>
  
  <style>
  .vs__dropdown-toggle{
    height: 40px;
  }
  .custom-grid-0{
      grid-column:1
  }
  .custom-grid-1{
      grid-column:2
  }
  input:read-only{
    background-color: transparent !important;
    color:rgb(15 23 42) !important; 
  }
  </style>