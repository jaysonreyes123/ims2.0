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
                            <Textinput 
                                :isReadonly="field.readonly == 1 ? true :false" class="mt-4" 
                                v-for="(field,i) in block.fields" :key="i" 
                                v-model="module_store.form[field.name]" 
                                :label="field.label" 
                                :placeholder="`Enter ${field.label}`" />
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
                                        placeholder="HH:mm:00"
                                        :config="{ enableTime: true, noCalendar: true, dateFormat: 'H:i:00',time_24hr:true,minuteIncrement:1 }"
                                    />
                                </div>
                            </div>
                            <div v-else-if="field.type == 'date' ">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <flat-pickr
                                        v-model="module_store.form[field.name]"
                                        class="form-control"
                                        placeholder="yyyy-mm-dd"
                                        :config="{ dateFormat:'Y-m-d' }"
                                    />
                                </div>
                            </div>
                            <div v-else-if="field.type == 'phone'">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{field.label}} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Textinput @input="phonevalidation(field.name)" :isReadonly="field.readonly == 1 ? true :false " v-model="module_store.form[field.name]" :placeholder="`Enter ${field.label}`" />
                                </div>
                            </div>
                            <div v-else-if="field.type == 'email'">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{field.label}} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Textinput @input="emailvalidation(field.name,field.label)" :isReadonly="field.readonly == 1 ? true :false " v-model="module_store.form[field.name]" :placeholder="`Enter ${field.label}`" />
                                    <!-- <label class="text-xs text-red-500 d-none" :id="`${field.name}-validation`"></label> -->
                                </div>
                            </div>
                            <div v-else-if="field.type == 'textarea'">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Textarea :isReadonly="field.readonly == 1 ? true :false " :placeholder="`Enter ${field.label}`" v-model="module_store.form[field.name]" />
                                </div>
                            </div>
                            <div class="fromGroup relative" v-else-if="field.type == 'dropdown' ">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Select :disabled="field.readonly == 1 ? true :false" placeholder="Select an option" :reduce="(option) => option.label" :options="dropdown_store.dropdownlist[field.name]" v-model="module_store.form[field.name]"/>
                            </div>
                            <div class="fromGroup relative" v-else-if="field.type == 'checkbox' ">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Switch v-if="module_store.form[field.name] == 1" v-model="module_store.form[field.name]" :active="true" class="mb-5" />
                                    <Switch v-if="module_store.form[field.name] == 0" v-model="module_store.form[field.name]" :active="false" class="mb-5" />
                            </div>
                            <div class="fromGroup relative" v-else-if="field.type == 'relation' ">
                                
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <InputGroup  type="text" isReadonly :modelValue="module_store.relation_field[field.name]" placeholder="">
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
                                    <Textinput :isReadonly="field.readonly == 1 ? true :false " v-model="module_store.form[field.name]" :placeholder="`Enter ${field.label}`" />
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
        emailvalidation(field,label){
            var email = module_store.form[field].match(/^\S+@\S+\.\S+$/);
            if(email){
                errors.value = errors.value.filter(v => !Object.keys(v).includes(label));
            }
            else{
                if(errors.value.find(v => v[label]) === undefined){
                    let sub_array = {};
                    sub_array[label] = "Must be valid email";
                    errors.value.push(sub_array)   
                }
            }
        },
        phonevalidation(field){
            module_store.form[field] = module_store.form[field].replace(/[^0-9+]/g, '');
            let maxlength = 0;
            if(module_store.form[field].length >= 4){
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
                    module_store.form[field] = "";
                }


                if(maxlength != 0){
                    module_store.form[field] = module_store.form[field].slice(0,maxlength);
                }
            }
            

            // if(x[0].length == 2){
            //     if(x[0] == "09"){
            //         if(module_store.form[field].length < 12){
            //             module_store.form[field] = x.input;
            //         }
            //         else{
            //             module_store.form[field] = module_store.form[field].slice(0,11);
            //         }
            //     }
            //     if(x[0] == "+63" || x[0] == "63"){
            //         if(module_store.form[field].length < 14){
            //             module_store.form[field] = x.input;
            //         }
            //         else{
            //             module_store.form[field] = module_store.form[field].slice(0,13);
            //         }
            //     }
            //     else{
            //         module_store.form[field] = "";
            //     }
            // }
            // else{
            //     module_store.form[field] = x.input;  
            // }
        },
        moduleDetails(moduleid){
            const current_module = moduleid;
            const module_info = auth_store.module.find(module__ => module__.id == current_module );
            return module_info;
        },
        save(){
            var error = "";
            const required_keys = Object.keys(module_store.required_field)
            required_keys.map(item=>{
                if(module_store.form[item] == ""){
                    error+=`<span class="text-red-500"><b>${module_store.required_field[item]}</b> is required field</span><br>`;
                }
            })
            errors.value.map(item=>{
                error+=`<span class="text-red-500"><b>${Object.keys(item)}</b> ${Object.values(item)}<br>`;
            })
            if(error != ""){
            Swal.fire({
                icon: "error",
                title: "Something Wrong",
                html:error,
            });
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
</style>