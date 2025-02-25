<template lang="">
    <div class="md:w-1/2">
        <div class="fromGroup relative mt-4">
            <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Action Name<span class="text-red-500">*</span></label>
            <Textinput placeholder="Enter action name" />
        </div>
        <div class="fromGroup relative mt-4">
            <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Create a record in<span class="text-red-500">*</span></label>
            <Select @option:selected="moduleSelected" :options="dropdown_store.dropdownlist['modules']" />
        </div>
    </div>
        <div class="mt-6" v-if="!workflow_store.loading">
            <div>
                <Button
                    @click="addField"
                    text="Add Field"
                    btnClass="btn-outline-dark btn-sm"
                />
                <div class="grid grid-cols-3 gap-x-4 mt-2" v-for="(item,index) in workflow_store.form.action.actions" :key="index">
                    <Select 
                        :disabled="workflow_store.required_field.includes(workflow_store.form.action.actions[index].field)"
                        @option:selected="fieldSelected($event,index)" 
                        placeholder="Select an option" 
                        v-model="workflow_store.form.action.actions[index].field" 
                        :options="workflow_store.fields_list_action"
                        :reduce="option => option.value"
                        :selectable="(option) => !workflow_store.form.action.actions.find(action => action.field == option.value ) && !option.header "
                    >
                    <template #option="{ header,label }">
                        <h6 v-if="header" class="font-bold text-[18px] text-black">{{ label }}</h6>
                        <span v-else class="text-[12px]">{{ label }}</span>
                    </template>
                    </Select>
                    <div>
                        <Textinput v-if="workflow_store.form.action.actions[index].type == 'text' " placeholder=""  v-model="workflow_store.form.action.actions[index].value" />
                        <Textarea v-else-if="workflow_store.form.action.actions[index].type == 'textarea' " v-model="workflow_store.form.action.actions[i].value" />
                        <flat-pickr
                            v-else-if="workflow_store.form.action.actions[index].type == 'date' "
                            class="form-control"
                            placeholder="yyyy-mm-dd"
                            :config="{ dateFormat:'Y-m-d' }"
                            v-model="workflow_store.form.action.actions[index].value"
                        />
                        <flat-pickr
                            v-else-if="workflow_store.form.action.actions[index].type == 'time' "
                            class="form-control"
                            placeholder="HH:mm:00"
                            :config="{ enableTime: true, noCalendar: true, dateFormat: 'H:i:00',time_24hr:true,minuteIncrement:1 }"
                            v-model="workflow_store.form.action.actions[index].value"
                        />
                        <Select placeholder="Select an option" 
                            v-else-if="workflow_store.form.action.actions[index].type == 'dropdown' "
                            :options="dropdown_store.dropdownlist[workflow_store.form.action.actions[index].name]" 
                            :reduce="option => option.label"
                            v-model="workflow_store.form.action.actions[index].value"
                        />
                        <Textinput v-else :type="workflow_store.form.action.actions[index].type" placeholder="" v-model="workflow_store.form.action.actions[index].value" />
                    </div>
                    <Button
                        @click="RemoveField(index)"
                        btnClass="btn-danger btn-sm w-12"
                        icon="heroicons-outline:trash"
                        iconPosition="left"
                        iconClass="text-lg"
                        type="button"
                    />
                </div>
            </div>
        </div>
</template>
<script>
import Textinput from "@/components/Textinput"
import Select from "vue-select"
import Button from "@/components/Button";
import Textarea from "@/components/Textarea";
import { useDropdownStore } from "@/store/dropdown";
import { useModuleStore } from '@/store/module';
import { useReportStore } from "@/store/report";
import { useWorkflowStore } from "@/store/workflow";
const dropdown_store = useDropdownStore();
const report_store = useReportStore();
const workflow_store = useWorkflowStore();
export default {
    components:{
        Textinput,
        Select,
        Button,
        Textarea
    },
    data(){
        return{
            dropdown_store,
            report_store,
            workflow_store
        }
    },
    mounted(){
        workflow_store.form.action.actions = [];
        dropdown_store.get_dropdown('modules');
    },
    methods:{
        moduleSelected(value){
            workflow_store.form.action.actions = [];
            workflow_store.get_fields_action(value.name);
        },
        addField(){
            workflow_store.form.action.actions.push({
                type:"",
                name:"",
                field:"",
                value:""
            });
        },
        RemoveField(index){
            workflow_store.form.action.actions.splice(index,1);
        },
        fieldSelected(event,index){
            workflow_store.form.action.actions[index].type = event.type;
            workflow_store.form.action.actions[index].field = event.value;
        }
    }
}
</script>
<style lang="">
    
</style>