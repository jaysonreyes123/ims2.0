<template>
    <div>
        <Modal :activeModal="openFilterModal" @close="closeModal" title="Filter" sizeClass="max-w-5xl"
            style="overflow: none">
            <div class="text-base text-slate-600 dark:text-slate-300">
                <div v-for="(item,i) in fields" :key="i"
                    class="lg:grid-cols-2 md:grid-cols-2 grid-cols-1 grid gap-5 mb-5 last:mb-0">
                    <div class="fromGroup relative">
                        <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Select
                            Field</label>
                        <Select @option:selected="picklist_event($event,i)" :reduce="(option) => option.value" placeholder="Select an option" class="p-1"
                            :options="picklist_fields" v-model="item.field" />
                    </div>
                    <div class="flex justify-between items-end space-x-5">
                        <div class="flex-1">
                            <Textinput v-if="
                                field_type[i] == 'text' || 
                                field_type[i] == 'number' " v-model="item.value" :type="field_type" placeholder=""
                                class="flex-1" />
                            <Select v-if="field_type[i] == 'picklist'" :options="picklist_option[i]" :reduce="(option) => option.id" v-model="item.value"
                                placeholder="Select an option" class="p-1" />
                            <flat-pickr v-if="field_type[i] == 'time'" v-model="item.value" class="form-control" placeholder="HH:mm"
                                :config="{ enableTime: true, noCalendar: true, dateFormat: 'H:i:00', time_24hr: true, minuteIncrement: 1 }" />
                            <flat-pickr v-if="field_type[i] == 'date' " v-model="item.value" class="form-control"
                                placeholder="yyyy-mm-dd" :config="{ dateFormat: 'Y-m-d' }" />
                        </div>
                        <div class="flex-none relative w-14">
                            <button v-if="i !== 0" type="button"
                                class="inline-flex items-center justify-center h-10 w-10 bg-danger-500 text-lg border rounded border-danger-500 text-white"
                                @click="removeCondition(i)">
                                <Icon icon="heroicons-outline:trash" />
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <Button icon="heroicons-outline:plus" text="Add Condition"
                        btnClass="btn-outline-light btn-sm bg-secondary text-slate-900 shadow-base2"
                        @click="addCondition" />
                </div>
            </div>
            <template class="" v-slot:footer>
                <div class="w-full px-3 flex justify-between">
                    <Button text="Close" btnClass="btn-dark" @click="closeModal()" />
                    <Button text="Save Filter" btnClass="btn-danger" @click="SaveFilter()" />
                </div>
            </template>
        </Modal>
    </div>
</template>

<script>
import Button from '@/components/Button';
import Modal from '@/components/Modal';
import InputGroup from "@/components/InputGroup";
import Textinput from "@/components/Textinput"
import Icon from "@/components/Icon";
import { ref } from 'vue';
import { columns } from '../column';
import Select from "vue-select";

import { contacts_field } from "../fields/contacts";
import { incidents_field } from "../fields/incidents";
import { resources_field } from "../fields/resources";
import { agency_fields } from '../fields/agency';
import { responder_fields } from '../fields/responder';
import { preplan_fields } from '../fields/preplan';
import { user_fields } from '../fields/user';
import { call_logs_field } from '../fields/call_logs';

import { useIncidentStore } from "@/store/incident";
import { useResourcesStore } from "@/store/resources";
import { useContactsStore } from "@/store/contact";
import { useAgencyStore } from '@/store/agency';
import { useResponderStore } from '@/store/responder';
import { usePreplanStore } from '@/store/preplan';
import { useCallLogsStore } from '@/store/call_logs';
import { useUserStore } from '@/store/user';
import { useListStore } from '@/store/list';
const list_store = useListStore();
const user_store = useUserStore();

const fields = ref([
    {
        field:"",
        value:""
    },
]);
const field_type = ref(["text"]);
const picklist_option = ref([]);
export default {
    components:{
        Modal,
        Button,
        InputGroup,
        Textinput,
        Icon,
        Select,
    },  
    data(){
        return{
            fields,
            field_type,
            picklist_option
        }
    },
    props:{
        openFilterModal:{
            type:Boolean,
            default:false
        }
    },
    mounted(){
        this.load_picklist();
    },
    created(){
        this.$watch(
            ()=>this.$route.params.module,
            (modules) => {
                this.ClearFilter();
            }
        )
    },
    methods:{
        picklist_event(event,position){
           const name = event.value;
           console.log(this.picklist_fields)
           fields.value[position].value = "";
           const selected_field = this.fields_computed.find(item => item.name == name);
           field_type.value[position] = selected_field.type;
           //if picklist was selected
            if(selected_field.type == 'picklist') {
                picklist_option.value[position] = this.ModuleStore[event.value];
            }

        },
        closeModal(){
            this.$emit('closeFilterModal',false);
        },
        addCondition(){
            if(fields.value.length < 3){
                field_type.value.push("text")
                fields.value.push(
                    {
                        field:"",
                        value:""
                    }
                );
            }
        },
        removeCondition(index){
            fields.value.splice(index,1)
        },
        ClearFilter(){
            fields.value = ([{field:"",value:""}])
            field_type.value = (['text'])
            //list_store.filter_data = [];
            //list_store.List(this.$route.params.module)
           // this.$emit('closeFilterModal',false);
        },
        SaveFilter(){
            
            list_store.filter_data = fields.value;
            list_store.List(this.$route.params.module)
            this.ClearFilter();
            this.$emit('closeFilterModal',false);
        },
        load_picklist(){
            const modules = this.$route.params.module;
            //load assigned to
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

            else if(modules == 'preplans'){
                if(this.ModuleStore.pre_plan_classifications_picklist.length == 0){
                    this.ModuleStore.get_preplan_classification();
                } 
                if(this.ModuleStore.incident_types_picklist.length == 0){
                    this.ModuleStore.get_incident_type();
                }
            }

            else if(modules == 'users'){
                if(this.ModuleStore.roles_picklist.length == 0){
                    this.ModuleStore.get_role();
                } 
            }

            if(user_store.assigned_to.length == 0){
                    user_store.get_assigned_to();
            }
    
        },
    },
    computed:{
        picklist_fields(){
            let picklist_fields_ = [];
            console.log(columns[this.$route.params.module])
            columns[this.$route.params.module].map(item=>{
                if(item.field != 'action'){
                    let sub_picklist = {};
                    sub_picklist["label"] = item.label;
                    sub_picklist["value"] = item.name;
                    picklist_fields_.push(sub_picklist);
                }
   
            })
            return picklist_fields_;
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
                case 'preplans':
                    module_store = usePreplanStore();
                    break;
                case 'call_logs':
                    module_store = useCallLogsStore();
                    break;
                case 'users':
                    module_store = user_store;
                    break;
                default:
                    break;
            }
            return module_store;
        },
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
                case 'preplans':
                    fields__ = preplan_fields;
                    break;
                case 'call_logs':
                    fields__ = call_logs_field;
                    break;
                case 'users':
                    fields__ = user_fields;
                    break;
                default:
                    break;
            }
            const fields = [];
            fields__.map(item=>{
                item.fields.map(item2=>{
                    columns[modules__].filter(item_=> {
                        if(item2.name == item_.name){
                            fields.push(item2)
                        }
                    } );
                })
            });
            return fields;
        },
    }
}
</script>

<style>
#headlessui-dialog-panel-9{
    overflow: unset !important;
}
</style>