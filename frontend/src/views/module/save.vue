<template lang="">
    <div>
        <Breadcrum mode='save' />
        <Loading v-model:active="module_store.loading"/>
        <form @submit.prevent="save" v-if="!module_store.loading">
            <Card 
                v-for="(block,block_index) in module_store.data.blocks" 
                :key="block_index"
                :title="block.block"
                class="mb-4"
                >
                <div v-if="block.block == 'Location Details' ">
                    <div class="lg:grid lg:grid-cols-2 gap-12"> 
                        <div>
                            <div v-for="(field,i) in block.fields" :key="i" class="mt-4">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{field.label}} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Textinput :classInput="module_store.errors[field.name] == '' ? '' : 'border border-red-500'" :isReadonly="field.readonly == 1 ? true :false " v-model="module_store.form[field.name]" :placeholder="`Enter ${field.label}`" />
                                    <label class="validation-label" v-if="module_store.errors[field.name] !=''" >{{module_store.errors[field.name]}}</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <Map :set_coordinates="module_store.form.coordinates" @updateCoordinate="updateCoordinates"  />
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="lg:grid gap-x-12" style="grid-template-columns: 1fr 1fr;"> 
                        <div v-for="(field,i) in block.fields.filter(field_ => field_.display_type == 1)" :key="i" :class="`custom-grid-${i%2}`" class="mt-4">
                            <div v-if="field.type == 'time' ">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span> </label>
                                    <flat-pickr
                                        v-model="module_store.form[field.name]"
                                        class="form-control"
                                        :class="module_store.errors[field.name] == '' ? '' : 'border border-red-500' "
                                        placeholder="HH:mm:00"
                                        :config="{ enableTime: true, noCalendar: true, dateFormat: 'H:i:00',time_24hr:true,minuteIncrement:1 }"
                                    />
                                    <label class="validation-label" v-if="module_store.errors[field.name] !=''" >{{module_store.errors[field.name]}}</label>
                                </div>
                            </div>
                            <div v-else-if="field.type == 'date' ">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <flat-pickr
                                        v-model="module_store.form[field.name]"
                                        class="form-control"
                                        :class="module_store.errors[field.name] == '' ? '' : 'border border-red-500' "
                                        placeholder="yyyy-mm-dd"
                                        :config="{ dateFormat:'Y-m-d' }"
                                    />
                                    <label class="validation-label" v-if="module_store.errors[field.name] !=''" >{{module_store.errors[field.name]}}</label>
                                </div>
                            </div>
                            <div v-else-if="field.type == 'phone'">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{field.label}} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Textinput :classInput="module_store.errors[field.name] == '' ? '' : 'border border-red-500'" @input="phonevalidation(field.name,field.label)" :isReadonly="field.readonly == 1 ? true :false " v-model="module_store.form[field.name]" :placeholder="`Enter ${field.label}`" />
                                    <label class="validation-label" v-if="module_store.errors[field.name] !=''" >{{module_store.errors[field.name]}}</label>
                                </div>
                            </div>
                            <div v-else-if="field.type == 'email'">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{field.label}} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Textinput :classInput="module_store.errors[field.name] == '' ? '' : 'border border-red-500'" @input="emailvalidation(field.name,field.label)" :isReadonly="field.readonly == 1 ? true :false " v-model="module_store.form[field.name]" :placeholder="`Enter ${field.label}`" />
                                    <label class="validation-label" v-if="module_store.errors[field.name] !=''" >{{module_store.errors[field.name]}}</label>
                                </div>
                            </div>
                            <div v-else-if="field.type == 'number'">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{field.label}} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Textinput :classInput="module_store.errors[field.name] == '' ? '' : 'border border-red-500'" @input="numbervalidation(field.name,field.label)" :isReadonly="field.readonly == 1 ? true :false " v-model="module_store.form[field.name]" :placeholder="`Enter ${field.label}`" />
                                    <label class="validation-label" v-if="module_store.errors[field.name] !=''" >{{module_store.errors[field.name]}}</label>
                                </div>
                            </div>
                            <div v-else-if="field.type == 'textarea'">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Textarea :classInput="module_store.errors[field.name] == '' ? '' : 'border border-red-500'" :isReadonly="field.readonly == 1 ? true :false " :placeholder="`Enter ${field.label}`" v-model="module_store.form[field.name]" />
                                    <label class="validation-label" v-if="module_store.errors[field.name] !=''" >{{module_store.errors[field.name]}}</label>
                                </div>
                            </div>
                            <div class="fromGroup relative" v-else-if="field.type == 'dropdown' ">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Select :loading="dropdown_store.dropdownloading[field.name]" :class="module_store.errors[field.name] == '' ? '' : 'border border-red-500'":disabled="field.readonly == 1 ? true :false" placeholder="Select an option" :reduce="(option) => option.label" :options="dropdown_store.dropdownlist[field.name]" v-model="module_store.form[field.name]"/>
                                    <label class="validation-label" v-if="module_store.errors[field.name] !='' ">{{module_store.errors[field.name]}}</label>    
                            </div>
                            <div class="fromGroup relative" v-else-if="field.type == 'checkbox' ">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Switch v-if="module_store.form[field.name] == 1" v-model="module_store.form[field.name]" :active="true" class="mb-5" />
                                    <Switch v-if="module_store.form[field.name] == 0" v-model="module_store.form[field.name]" :active="false" class="mb-5" />
                                    
                            </div>
                            <div class="fromGroup relative" v-else-if="field.type == 'relation' ">
                                
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <InputGroup :error="module_store.errors[field.name] == '' ? '' : module_store.errors[field.name] "  type="text" isReadonly :modelValue="module_store.relation_field[field.name]" :placeholder="`Enter ${field.label}`">
                                        <template v-slot:append>
                                            <Button 
                                                v-if="field.related_fields"
                                                @click="popupListModal(field.name,field.related_fields.related_module)"
                                                :isDisabled="false"
                                                type="button"
                                                icon="heroicons-outline:plus" 
                                                btnClass="btn-outline-dark disabled:bg-slate-300 disabled:cursor-not-allowed"
                                            />
                                            <Button 
                                                v-else
                                                :isDisabled="true"
                                                type="button"
                                                icon="heroicons-outline:plus" 
                                                btnClass="btn-outline-dark disabled:bg-slate-300 disabled:cursor-not-allowed"
                                            />
                                        </template>
                                    </InputGroup>
                                    <input type="hidden" v-model="module_store.form[field.name]" />
                            </div>
                            <div v-else>
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{field.label}} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Textinput :classInput="module_store.errors[field.name] == '' ? '' : 'border border-red-500'" :isReadonly="field.readonly == 1 ? true :false " v-model="module_store.form[field.name]" :placeholder="`Enter ${field.label}`" />
                                    <label class="validation-label" v-if="module_store.errors[field.name] !=''" >{{module_store.errors[field.name]}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Card>
            <Card>
                <Button class="w-full bg-emerald-500/100 hover:bg-emerald-600/100" :text="`Save ${modules_.label}`" />
            </Card>
        </form>
    </div>
    <popupList v-if="related_module_active != '' " @related_selected_row="related_selected_row" :module_="related_module_active" />
</template>
<script>
import popupList from "./list/popupList.vue";
import InputGroup from "@/components/InputGroup";
import Breadcrum from "./Breadcrum.vue";
import Card from "@/components/Card";
import Textinput from "@/components/Textinput";
import Button from "@/components/Button";
import Textarea from "@/components/Textarea"
import Switch from '@/components/Switch';
import Select from "vue-select";
import Swal from 'sweetalert2';
import Map from "../module/map/edit_map.vue";
import { ref } from "vue";
import { useModuleStore } from '@/store/module';
import { useDropdownStore } from "@/store/dropdown";
import { useListStore } from "@/store/list";
import { useAuthStore } from "@/store/auth";
const auth_store = useAuthStore();
const module_store = useModuleStore();
const dropdown_store = useDropdownStore();
const list_store = useListStore();
const modules = ref("");
const relation_field_active = ref("");
const related_module_active = ref("");
const errors = ref([]);
export default {
    components:{
        Card,
        Textinput,
        Button,
        Textarea,
        Select,
        Map,
        Switch,
        Breadcrum,
        InputGroup,
        popupList
    },
    data(){
        return{
            module_store,
            dropdown_store,
            modules,
            related_module_active
        }
    },
    created(){
        list_store.modal = false;
        modules.value = this.$route.params.module;
    },
    mounted(){
        const id = this.$route.params.id;
        errors.value = [];
        module_store.errors = [];
        module_store.module = modules.value;
        module_store.get_edit_form(id);
        module_store.id = id;
        if(id != "" && id !== undefined){
            //module_store.get(id);
        }
        else{
            //module_store.generate();
        }
    },
    computed:{
        modules_(){
            const current_module = this.$route.params.module;
            const module_info = auth_store.module.find(module__ => module__.name == current_module );
            return module_info;
        }
    },
    methods:{
        assign_error_object(field,message){
            let sub_array = {};
            sub_array[field] = message;
            return Object.assign(errors.value,sub_array);
        },
        numbervalidation(field,label){
            module_store.form[field] = module_store.form[field].replace(/\D/g,"");
        },
        emailvalidation(field,label){
            var email = module_store.form[field].match(/^\S+@\S+\.\S+$/);
            if(email){
                errors.value[field] = "";
            }
            else{
                const message = label+" must be valid email";
                errors.value = this.assign_error_object(field,message);
            }
        },
        phonevalidation(field,label){
            module_store.form[field] = module_store.form[field].replace(/[^0-9+]/g, '');
            let maxlength = 0;
            if(module_store.form[field][0] == 0 && module_store.form[field][1] == 9){
                maxlength = 11;
            }
            else if(module_store.form[field][0] == 6 && module_store.form[field][1] == 3 && module_store.form[field][2] == 9){
                maxlength = 12;
            }
            else if(module_store.form[field][0] == "+" && module_store.form[field][1] == 6 && module_store.form[field][2] == 3 && module_store.form[field][3] == 9){
                maxlength = 13;
            }
            else{
                maxlength = 0
                const message = label+" must be valid phone";
                errors.value = this.assign_error_object(field,message)
            }
            if(maxlength != 0){
                console.log(module_store.form[field].length,maxlength)
                if(module_store.form[field].length >= maxlength){
                    module_store.form[field] = module_store.form[field].slice(0,maxlength);
                    errors.value[field] = ""; 
                }
                else{
                    const message = label+" must be valid phone";
                    errors.value = this.assign_error_object(field,message)
                }   
            }
        },
        moduleDetails(moduleid){
            const current_module = moduleid;
            const module_info = auth_store.module.find(module__ => module__.id == current_module );
            return module_info;
        },
        save(){
            var error = false;
            const required_keys = Object.keys(module_store.required_field)
            const validation_keys = Object.keys(errors.value);
            const errors_keys = Object.keys(module_store.errors);
            required_keys.map(item=>{
                if(module_store.form[item] == ""){
                    module_store.errors[item] = module_store.required_field[item] + " is required field";
                }
                else{
                    module_store.errors[item] = "";
                }
            })
            validation_keys.map(item=>{
                module_store.errors[item] = errors.value[item];
            })
            //check if there's an error message
            errors_keys.map(item =>{
                if(module_store.errors[item] != ""){
                    error = true;
                }
            })
            if(error){
                window.scrollTo(0,0);
                return false;
           }
           module_store.save();
        },
        updateCoordinates(event){
            const {lng,lat} = event;
            module_store.form.coordinates = lng+","+lat;
        },
        popupListModal(field,related_module){

            list_store.modal = true;
            const module_detials = this.moduleDetails(related_module);
            related_module_active.value = module_detials.name;
            relation_field_active.value = field;
        },
        related_selected_row(related_selected_row_module,related_selected_row_id){
            module_store.get_single_item(related_selected_row_module,related_selected_row_id,relation_field_active.value);
            related_module_active.value = "";
            relation_field_active.value = "";
        }
    }
}
</script>
<style>
.custom-grid-0{
      grid-column:1
  }
.custom-grid-1{
      grid-column:2
  }
.input-control[readonly],.input-group-control[readonly]{
   /* background-color: rgb(226 232 240) !important; */
   background-color: #ffffff !important;
    color:black !important; 
}
.validation-label{
    @apply text-danger-500 block text-sm mt-2
}
</style>