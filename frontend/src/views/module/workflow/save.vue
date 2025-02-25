<template lang="">
    <div>
        <Loading v-model:active="workflow_store.loading"/>
        <form @submit.prevent="save()">
            <Card title="Basic Information">
                <div class="fromGroup relative mt-4">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Target Module<span class="text-red-500">*</span></label>
                    <Select 
                        :options="dropdown_store.dropdownlist.modules" 
                        :reduce="option => option.name"
                        @option:selected="SelectModule" 
                        v-model="workflow_store.form.module">
                    </Select>
                </div>
                <div class="fromGroup relative mt-4">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Workflow Name<span class="text-red-500">*</span></label>
                    <Textinput v-model="workflow_store.form.name" :placeholder="`Enter workflow name`" />
                </div>
                <div class="fromGroup relative mt-4">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Description</label>
                    <Textarea v-model="workflow_store.form.description" :placeholder="`Enter Description`" />
                </div>
                <div class="fromGroup relative mt-4">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Status</label>
                    <div class="flex space-x-rb flex-wrap">
                        <Radio v-model="workflow_store.form.status" :value="1" class="mr-5" label="Active"/>
                        <Radio v-model="workflow_store.form.status" :value="0" label="InActive"/>
                    </div>
                </div>
            </Card>
            <Card title="Workflow Trigger" class="mt-4">
                <div class="fromGroup relative mt-4">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Trigger Workflow On</label>
                    <div class="flex space-x-rb flex-wrap flex-col">
                        <Radio v-model="workflow_store.form.trigger" :value="1" label="Creation"/>
                        <Radio v-model="workflow_store.form.trigger" :value="0" label="Updated (Includes Creation)"/>
                    </div>
                </div>

                <div class="fromGroup relative mt-4">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Recurrence</label>
                    <div class="flex space-x-rb flex-wrap flex-col">
                        <Radio v-model="workflow_store.form.recurrence" :value="1" label="Only first time conditions are met"/>
                        <Radio v-model="workflow_store.form.recurrence" :value="0" label="Every time conditions met"/>
                    </div>
                </div>
            </Card>
            <Card title="Workflow Condition" class="mt-4">
                <div class="fromGroup relative mt-4">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">All Conditions (All conditions must be met)</label>
                    <div class="flex space-x-rb flex-wrap flex-col">
                        <div class="grid items-center grid-cols-4 gap-x-4" v-for="(condition,index) in workflow_store.form.condition" :key="index">
                            <div>
                                <Select 
                                    @option:selected="filter_and_select_option($event,index)"
                                    placeholder="Select an option" 
                                    :options="workflow_store.fields_list" 
                                    v-model="workflow_store.form.condition[index].field"
                                    :reduce="option => option.value "
                                    :selectable="(option) => !option.header"
                                >
                                <template #option="{ header,label }">
                                    <h6 v-if="header" class="font-bold text-[18px] text-black">{{ label }}</h6>
                                    <span v-else class="text-[12px]">{{ label }}</span>
                                </template>
                                </Select>
                            </div>
                            <div>
                                <Select 
                                    :options="operator" 
                                    :reduce="option => option.value" 
                                    v-model="workflow_store.form.condition[index].operator" 
                                    @option:selected="operator_option($event,index)"
                                />
                            </div>
                            <div>
                                <Textinput v-if="workflow_store.form.condition[index].type == 'text' " placeholder=""  v-model="workflow_store.form.condition[index].value" />
                                <Textarea v-else-if="workflow_store.form.condition[index].type == 'textarea' " v-model="workflow_store.form.condition[i].value" />
                                <flat-pickr
                                    v-else-if="workflow_store.form.condition[index].type == 'date' "
                                    class="form-control"
                                    placeholder="yyyy-mm-dd"
                                    :config="{ dateFormat:'Y-m-d' }"
                                    v-model="workflow_store.form.condition[index].value"
                                />
                                <flat-pickr
                                    v-else-if="workflow_store.form.condition[index].type == 'time' "
                                    class="form-control"
                                    placeholder="HH:mm:00"
                                    :config="{ enableTime: true, noCalendar: true, dateFormat: 'H:i:00',time_24hr:true,minuteIncrement:1 }"
                                    v-model="workflow_store.form.condition[index].value"
                                />
                                <Select placeholder="Select an option" 
                                    v-else-if="workflow_store.form.condition[index].type == 'dropdown' "
                                    :options="dropdown_store.dropdownlist_data" 
                                    :reduce="option => option.label"
                                    v-model="workflow_store.form.condition[index].value"
                                />
                                <Textinput v-else :type="workflow_store.form.condition[index].type" placeholder="" v-model="workflow_store.form.condition[index].value" />
                            </div>
                            <div>
                                <Button
                                    @click="removeCondition(index)"
                                    btnClass="btn-danger btn-sm"
                                    icon="heroicons-outline:trash"
                                    iconPosition="left"
                                    iconClass="text-lg"
                                    type="button"
                                />
                            </div>
                        </div>
                    </div>
                    <div>
                        <Button
                            type="button"
                            @click="addCondition"
                            text="Add Condition"
                            btnClass="btn-sm btn-secondary"
                        />
                    </div>
                </div>
            </Card>
            <Card title="Workflow Action" class="mt-4">
                <br>
                <Dropdown @clickMenu="clickMenu" :items="dropdown_item" classMenuItems="left-0 w-[220px] top-[110%]">
                    <Button
                        text="Add Action"
                        btnClass="btn-light shadow-md btn-sm"
                        icon="heroicons-outline:chevron-down"
                        iconPosition="right"
                        div
                        iconClass="text-lg"
                    />
                    </Dropdown>
                <br><br>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ACTION TITLE
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    ACTION TYPE
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Apple MacBook Pro 17"
                                </th>
                                <td class="px-6 py-4">
                                    Silver
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </Card>
            <Card class="mt-4">
                <Button class="w-full bg-emerald-500/100 hover:bg-emerald-600/100" :text="`Save workflow`" />
            </Card>
        </form>
        <Modal :action="workflow_action" />
    </div>
</template>
<script lang="ts">
import Card from "@/components/Card/index.vue";
import Textinput from "@/components/Textinput/index.vue";
import Textarea from "@/components/Textarea/index.vue";
import Radio from "@/components/Radio/index.vue";
import Swal from "sweetalert2";
import Button from "@/components/Button/index.vue";
import Select from "vue-select";
import Dropdown from './dropdown.vue';
import Modal from "./modal.vue";
import { useWorkflowStore } from "@/store/workflow";
import { useFilterStore } from "@/store/filter";
import { useDropdownStore } from "@/store/dropdown";
import { useReportStore } from "@/store/report";
import { defineComponent,ref } from 'vue';
const workflow_store = useWorkflowStore();
const filter_store = useFilterStore();
const dropdown_store = useDropdownStore();
const report_store = useReportStore();
const workflow_action = ref("");
type OperatorType = {
    [key:string] : string,
}
const dropdown_item:OperatorType[] = [
    {
        label:"Create Record",
        action:"create"
    },
    {
        label:"Update Fields",
        action:"update"
    }
]
const operator:OperatorType[] = [
    {
        label:"Equal",
        value:"=",
        type:""
    },
    {
        label:"Not Equal",
        value:"<>",
        type:""
    },
    {
        label:"Contains",
        value:"%",
        type:""
    },
]
export default defineComponent({
    components:{
        Card,
        Textinput,
        Textarea,
        Select,
        Radio,
        Button,
        Dropdown,
        Modal
    },
    data(){
        return{
            workflow_store,
            filter_store,
            dropdown_store,
            report_store,
            operator,
            dropdown_item,
            workflow_action
        }
    },
    mounted(){
        workflow_store.form.status = 1;
        workflow_store.form.trigger = 1;
        workflow_store.form.recurrence = 1;
        workflow_store.form.module = "";
        workflow_store.form.name = "";
        workflow_store.form.description = "";
        workflow_store.form.condition = [];
        workflow_store.form.action.actions = [];
        workflow_store.modal = false;
        dropdown_store.get_dropdown('modules');
        if(this.$route.params.id == "" || this.$route.params.id === undefined){
            workflow_store.form.id = "";
        }
        else{
            workflow_store.form.id = this.$route.params.id;
            workflow_store.get();
        }
    },
    methods:{
        save(){
            let error:string = "";
            if(workflow_store.form.module == ""){
                error+="<p class='text-red-500'>Module is required</p>";
            }
            if(workflow_store.form.name == ""){
                error+="<p class='text-red-500'>Workflow name is required</p>";
            }
            if(error != ""){
                Swal.fire({
                    icon: "error",
                    title: "Something wrong",
                    html: error,
                });   
                return false;
            }
            workflow_store.save();
        },
        addCondition(){
            workflow_store.form.condition.push({
                field:"",
                operator:"",
                value:"",
                type:""
            })
        },
        removeCondition(index:number){
            workflow_store.form.condition.splice(index,1);
        },
        SelectModule(event:any){
            workflow_store.form.condition = [];
            workflow_store.form.module = event.name;
            workflow_store.get_fields();
        },
        filter_and_select_option(event:any,i:number){
            workflow_store.form.condition[i].value = "";
            workflow_store.form.condition[i].type = event.type;
            workflow_store.form.condition[i].operator = "=";
            if(event.type == 'dropdown'){
                const dropdown_name = event.value.split(".");
                dropdown_store.dropdownlist_data = [];
                dropdown_store.get_dropdown_list(dropdown_name[1]);
            }
        },
        operator_option(event:any,index:number){
            workflow_store.form.condition[index].type = event.value;
        },
        clickMenu(action:string){
            workflow_action.value = action;
            workflow_store.modal = true;
        }
    }
})
</script>
<style lang="">
    
</style>