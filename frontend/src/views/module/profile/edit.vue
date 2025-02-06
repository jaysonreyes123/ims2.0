<template lang="">
    <div>
        <Loading v-model:active="module_store.loading"/>
        <form @submit.prevent="save" v-if="!module_store.loading">
            <Card 
                v-for="(block,block_index) in module_store.data.blocks" 
                :key="block_index"
                :title="block.block"
                class="mb-4"
                >
                <div>
                    <div class="lg:grid gap-x-12" style="grid-template-columns: 1fr 1fr;"> 
                        <div v-for="(field,i) in block.fields" :key="i" :class="`custom-grid-${i%2}`" class="mt-4">
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
                <Button class="w-full bg-emerald-500/100 hover:bg-emerald-600/100" text="Save Profile" />
            </Card>
        </form>
    </div>
</template>
<script>
import Card from "@/components/Card";
import Textinput from "@/components/Textinput";
import Button from "@/components/Button";
import Textarea from "@/components/Textarea"
import Switch from '@/components/Switch';
import Select from "vue-select";
import Swal from 'sweetalert2';
import { ref } from "vue";
import { useModuleStore } from '@/store/module';
import { useDropdownStore } from "@/store/dropdown";
import { useAuthStore } from "@/store/auth";
const auth_store = useAuthStore();
const module_store = useModuleStore();
const dropdown_store = useDropdownStore();
const modules = ref("");
export default {
    components:{
        Card,
        Textinput,
        Button,
        Textarea,
        Select,
        Switch
    },
    data(){
        return{
            module_store,
            dropdown_store,
            modules
        }
    },
    created(){
        modules.value = this.$route.params.module;
        module_store.related_module = "";
    },
    mounted(){
        const id = auth_store.user.id;
        module_store.id = id;
        module_store.module = 'users';
        module_store.get_edit_form();
        if(id != ""){
            module_store.get(id);
        }
        else{

        }
    },
    methods:{
        save(){
            var error = "";
            const required_keys = Object.keys(module_store.required_field)
            required_keys.map(item=>{
                console.log(module_store.form[item])
                if(module_store.form[item] == ""){
                    error+=`<span class="text-red-500"><b>${module_store.required_field[item]}</b> is required field</span><br>`;
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
           module_store.save_profile();
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