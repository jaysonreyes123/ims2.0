<template lang="">
    <div>
        <Loading v-model:active="related_store.loading"/>
        <form @submit.prevent="save" v-if="!related_store.loading">
            <Card 
                v-for="(block,block_index) in related_store.data.blocks" 
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
                                v-model="related_store.form[field.name]" 
                                :label="field.label" 
                                :placeholder="`Enter ${field.label}`" />
                        </div>
                        <div>
                            <Map :set_coordinates="related_store.form.coordinates" @updateCoordinate="updateCoordinates"  />
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="lg:grid gap-x-12" style="grid-template-columns: 1fr 1fr;"> 
                        <div v-for="(field,i) in block.fields" :key="i" :class="`custom-grid-${i%2}`" class="mt-4">
                            <div v-if="field.type == 'time' ">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span> </label>
                                    <flat-pickr
                                        v-model="related_store.form[field.name]"
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
                                        v-model="related_store.form[field.name]"
                                        class="form-control"
                                        placeholder="yyyy-mm-dd"
                                        :config="{ dateFormat:'Y-m-d' }"
                                    />
                                </div>
                            </div>
                            <div v-else-if="field.type == 'textarea'">
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Textarea :isReadonly="field.readonly == 1 ? true :false " :placeholder="`Enter ${field.label}`" v-model="related_store.form[field.name]" />
                                </div>
                            </div>
                            <div class="fromGroup relative" v-else-if="field.type == 'dropdown' ">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{ field.label }} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Select :disabled="field.readonly == 1 ? true :false" placeholder="Select an option" :reduce="(option) => option.label" :options="dropdown_store.dropdownlist[field.name]" v-model="related_store.form[field.name]"/>
                                </div>
                            <div v-else>
                                <div class="fromGroup relative">
                                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">{{field.label}} <span class="text-red-500" v-if="field.required">*</span></label>
                                    <Textinput :isReadonly="field.readonly == 1 ? true :false " v-model="related_store.form[field.name]" :placeholder="`Enter ${field.label}`" />
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
</template>
<script>
import Card from "@/components/Card";
import Textinput from "@/components/Textinput";
import Button from "@/components/Button";
import Textarea from "@/components/Textarea"
import Select from "vue-select";
import Swal from 'sweetalert2';
import { ref } from "vue";
import { useDropdownStore } from "@/store/dropdown";
import Map from "../map/edit_map.vue";
import { useAuthStore } from "@/store/auth";
import { useRelatedStore } from "@/store/related";
const related_store = useRelatedStore();
const auth_store = useAuthStore();
const dropdown_store = useDropdownStore();
const modules = ref("");
const related_module = ref("");
export default {
    props:{
        props_related_module:String,
        props_module:String,
    },
    components:{
        Card,
        Textinput,
        Button,
        Textarea,
        Select,
        Map,
    },
    data(){
        return{
            dropdown_store,
            modules,
            related_store
        }
    },
    created(){
        modules.value = this.props_module
        related_module.value = this.props_related_module
        related_store.module = modules.value;
        related_store.related_module = related_module.value;
    },
    mounted(){
        related_store.get_edit_form(this.$route.params.id,related_store.id);
        related_store.form.id = this.$route.params.id;
        // if(related_store.id != ""){
        //     related_store.form.related_id = related_module.id;
        //     related_store.get(this.$route.params.id,related_store.id);
        // }
    },
    computed:{
        modules_(){
            const current_module = related_module.value;
            const module_info = auth_store.module.find(module__ => module__.name == current_module );
            return module_info;
        }
    },
    methods:{
        save(){
            var error = "";
            const required_keys = Object.keys(related_store.required_field)
            required_keys.map(item=>{
                if(related_store.form[item] == ""){
                    error+=`<span class="text-red-500"><b>${related_store.required_field[item]}</b> is required field</span><br>`;
                }
            })
            if(error != ""){
                Swal.fire({
                    icon: "error",
                    title: "Fill up the Required field",
                    html:error,
                });
                return false;
           }
           related_store.form.id = this.$route.params.id;
           related_store.save();
        },
        updateCoordinates(event){
            const {lng,lat} = event;
            related_store.form.coordinates = lng+","+lat;
        },
    }
}
</script>
<style scoped>
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