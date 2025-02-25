<template>
    <Card>
        <Loading v-model:active="report.loading"/>
        <div class="flex z-[5] items-center relative justify-center md:mx-8">
            <div class="relative z-[1] items-center item flex flex-start flex-1 last:flex-none group"
                v-for="(item, i) in steps" :key="i">
                <div :class="`   ${stepNumber >= i
                        ? 'bg-slate-900 text-white ring-slate-900 ring-offset-2 dark:ring-offset-slate-500 dark:bg-slate-900 dark:ring-slate-900'
                        : 'bg-white ring-slate-900 ring-opacity-70  text-slate-900 dark:text-slate-300 dark:bg-slate-600 dark:ring-slate-600 text-opacity-70'
                    }`" class="transition duration-150 icon-box md:h-12 md:w-12 h-7 w-7 rounded-full flex flex-col items-center justify-center relative z-[66] ring-1 md:text-lg text-base font-medium">
                    <span v-if="stepNumber <= i"> {{ i + 1 }}</span>
                    <span v-else class="text-3xl">
                        <Icon icon="bx:check-double" />
                    </span>
                </div>

                <div class="absolute top-1/2 h-[2px] w-full" :class="stepNumber >= i
                        ? 'bg-slate-900 dark:bg-slate-900'
                        : 'bg-[#E0EAFF] dark:bg-slate-700'
                    "></div>
                <div class="absolute top-full text-base md:leading-6 mt-3 transition duration-150 md:opacity-100 opacity-0 group-hover:opacity-100"
                    :class="stepNumber >= i
                            ? ' text-slate-900 dark:text-slate-300'
                            : 'text-slate-500 dark:text-slate-300 dark:text-opacity-40'
                        ">
                    <span class="w-max">{{ item.title }}</span>
                </div>
            </div>
        </div>

        <div class="conten-box mt-14 border-t border-slate-100 dark:border-slate-700 -mx-6 px-6 pt-6">
                <div v-if="stepNumber === 0" class="px-5">
                    <br>
                    <div class="grid lg:grid-cols-4 grid-cols-2 ">
                        <span>Report Name<span class="text-red-500">*</span></span>
                        <div>
                            <Textinput placeholder="Report Name" v-model="report.form.report_name"/>
                        </div>
                    </div>
                    <br>
                    <div class="grid lg:grid-cols-4 grid-cols-2">
                        <span>Module<span class="text-red-500">*</span></span>
                        <div>
                            <Select 
                                placeholder="Select an option" 
                                :options="dropdown_store.dropdownlist.modules" 
                                v-model="report.form.modules" 
                                @option:selected="SelectModule" 
                                :reduce="option => option.name"
                            />
                        </div>
                    </div>
                    <br>
                    <div class="grid lg:grid-cols-4 grid-cols-2">
                        <span>Relation Module (<i>Optional</i> )</span>
                        <div>
                            <Select 
                                placeholder="Select an option" 
                                :options="report.relation_module"
                                v-model="report.form.related_module"
                                :reduce="option => option.value"
                                :selectable="(option) => report.form.related_module.length < 2 "
                                multiple
                            />
                        </div>
                    </div>
                </div>
                <div v-if="stepNumber === 1" class="px-5">
                    <div class="fromGroup relative mt-5">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Select Columns(MAX 10)<span class="text-red-500">*</span></label>
                    <Select 
                        placeholder="Select an option" 
                        :options="report.fields_list" 
                        v-model="report.form.selected_column"
                        :closeOnSelect="false" 
                        multiple
                        :selectable="(option) => !report.form.selected_column.includes(option.value) && report.form.selected_column.length < 15 && !option.header "
                        :reduce="option => option.value"
                    >
                    <template #option="{ header,label }">
                        <h6 v-if="header" class="font-bold text-[18px] text-black">{{ label }}</h6>
                        <span v-else class="text-[12px]">{{ label }}</span>
                    </template>
                    </Select>
                    </div>
                </div>
                <div v-if="stepNumber === 2" class="px-5">
                    <Card title="Choose List conditions">
                        <br>
                        <label>All Conditions (All conditions must be met)</label>
                        <div class="grid grid-cols-9 gap-8 mt-4" v-for="(item,i) in report.form.filter" :key="i">
                            <div class="col-start-1 col-span-3">
                                <Select 
                                    @option:selected="filter_and_select_option($event,i)"
                                    placeholder="Select an option" 
                                    :options="report.fields_list" 
                                    v-model="report.form.filter[i].field"
                                    :reduce="option => option.value "
                                    :selectable="(option) => !option.header"
                                >
                                <template #option="{ header,label }">
                                    <h6 v-if="header" class="font-bold text-[18px] text-black">{{ label }}</h6>
                                    <span v-else class="text-[12px]">{{ label }}</span>
                                </template>
                                </Select>
                            </div>
                            <div class="col-start-4 col-span-2">
                                <Select 
                                    placeholder="Select an option" 
                                    :options="operator" 
                                    v-model="report.form.filter[i].operator"
                                    :reduce="option => option.value"
                                />
                            </div>
                            <div class="col-start-6 col-span-3">
                                <Textinput v-if="report.form.filter[i].type == 'text' " placeholder=""  v-model="report.form.filter[i].value" />
                                <Textarea v-else-if="report.form.filter[i].type == 'textarea' " v-model="report.form.filter[i].value" />
                                <flat-pickr
                                    v-else-if="report.form.filter[i].type == 'date' "
                                    class="form-control"
                                    placeholder="yyyy-mm-dd"
                                    :config="{ dateFormat:'Y-m-d' }"
                                    v-model="report.form.filter[i].value"
                                />
                                <flat-pickr
                                    v-else-if="report.form.filter[i].type == 'time' "
                                    class="form-control"
                                    placeholder="HH:mm:00"
                                    :config="{ enableTime: true, noCalendar: true, dateFormat: 'H:i:00',time_24hr:true,minuteIncrement:1 }"
                                    v-model="report.form.filter[i].value"
                                />
                                <Select placeholder="Select an option" 
                                    v-else-if="report.form.filter[i].type == 'dropdown' "
                                    :options="dropdown_store.dropdownlist_data" 
                                />
                                <Textinput v-else :type="report.form.filter[i].type" placeholder="" v-model="report.form.filter[i].value" />
                            </div>
                            <div class="flex justify-center ">
                                <button v-if="i !== 0" type="button"
                                    class="inline-flex items-center justify-center h-10 w-10 bg-danger-500 text-lg border rounded border-danger-500 text-white"
                                    @click="andRemoveCondition(i)">
                                    <Icon icon="heroicons-outline:trash" />
                                </button>
                            </div>
                        </div>
                        <Button 
                            icon="heroicons-outline:plus" 
                            text="Add Condition"
                            btnClass="btn-success mr-2 py-2 mt-3"
                            @click="andCondition" 
                        />
                    </Card>
                </div>
                <div class="mt-10" :class="stepNumber > 0 ? 'flex justify-between' : ' text-right'">
                    <Button @click.prevent="prev()" text="prev" btnClass="btn-dark" v-if="this.stepNumber !== 0" />
                    <Button @click="submit" :text="stepNumber !== this.steps.length - 1 ? 'next' : 'Save and Generate'" btnClass="btn-danger" />
                </div>
        </div>
    </Card>
</template>
<script>
import Button from "@/components/Button";
import Icon from "@/components/Icon";
import InputGroup from "@/components/InputGroup";
import Textarea from "@/components/Textarea";
import Textinput from "@/components/Textinput";
import Card from "@/components/Card";
import Select from "vue-select";
import { useDropdownStore } from "@/store/dropdown";
import { useReportStore } from "@/store/report";
import { ref } from "vue";
import Swal from 'sweetalert2';
const dropdown_store = useDropdownStore();
const report = useReportStore();
const modules = ref("");
const report_select_columns = ref([]);
const operator = [
    {
        label:"Equal",
        value:"="
    },
    {
        label:"Not Equal",
        value:"<>"
    }
]
let stepNumber = ref(0);
let steps = [
    {
        id: 1,
        title: "Report Details",
    },
    {
        id: 2,
        title: "Select Columns",
    },
    {
        id: 3,
        title: "Filters",
    },
];
export default {
    components: {
        Button,
        Icon,
        Textinput,
        InputGroup,
        Textarea,
        Card,
        Select
    },
    mounted(){
        this.clear2();
        stepNumber.value = 0;
        report.id = this.$route.params.id;
        report.form.type = 'list';
        dropdown_store.get_dropdown('modules');
        report.module_list = dropdown_store.dropdownlist.modules;
        if(report.id != "" && report.id !== undefined){
            report.get();
        }
       
    },
    data() {
        return {
            steps,
            stepNumber,
            dropdown_store,
            report,
            operator
        }
    },
    methods: {
        clear2(){
            report.loading = false;
            report.form.report_name = "";
            report.form.modules = "";
            report.form.selected_column = []
            report.relation_module = [];
            report.form.related_module = [];
            report.form.filter = 
                [
                    {
                        field: "",
                        operator: "",
                        type: "text",
                        value: ""
                    },
                ]
        },
        clear(){
            report.form.selected_column = []
            report.form.related_module = [];
            report.form.filter = 
                [
                    {
                        field: "",
                        operator: "",
                        type: "text",
                        value: ""
                    },
                ]
        },
        andRemoveCondition(index){
            report.form.filter.splice(index,1)
        },
        andCondition(){
            report.form.filter.push(
                {
                    field:"",
                    operator:"",
                    type:"text",
                    value:""
                }
            );
        },
        filter_and_select_option(event,i){
            report.form.filter[i].type = event.type;
            report.form.filter[i].operator = "=";
            if(event.type == 'dropdown'){
                dropdown_store.dropdownlist_data = [];
                dropdown_store.get_dropdown_list(event.value);
            }
        },
        SelectModule(event){
            this.clear();
            report.module = event.name;
            report.get_relation_module();
        },
        prev() {
            stepNumber.value--;
        },
        submit() {
           let error = "";
           if(stepNumber.value == 0){
                if(report.form.report_name == ""){
                    error+="<p class='text-red-500'>Report name is required</p>";
                }
                if(report.form.modules == ""){
                    error+="<p class='text-red-500'>Module is required</p>";
                }
                if(error == ""){
                    report.get_fields();
                }
           }
           else if(stepNumber.value == 1){
            if(report.form.selected_column.length == 0){
                error="<p class='text-red-500'>Column is required</p>";
            }
           }
           else if(stepNumber.value === 2){
            report.save();
            return false;
           }
           

           if(error != ""){
                Swal.fire({
                    icon: "error",
                    title: "Something wrong",
                    html: error,
                });
                return false;
           }
           
           stepNumber.value++;
        }
    }
};
</script>
<style lang="scss" scoped></style>