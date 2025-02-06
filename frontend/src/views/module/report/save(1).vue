<template lang="">
    <div>
        <Loading v-model:active="report.loading"/>
            <Card title="Report Details">
                <div class="fromGroup relative mt-5">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Report Name<span class="text-red-500">*</span></label>
                    <Textinput placeholder="Report Name" v-model="report.form.report_name" />
                </div>
                <div class="fromGroup relative mt-5">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Module<span class="text-red-500">*</span></label>
                    <Select 
                        placeholder="Select an option" 
                        :options="dropdown_store.dropdownlist.modules" 
                        v-model="report.form.modules" 
                        @option:selected="SelectModule" 
                        :reduce="option => option.name"
                    />
                </div>
            </Card>
            <br>
            <Card title="Select Columns">
                <div class="fromGroup relative mt-5">
                    <label class="flex-0 mr-6 break-words ltr:inline-block rtl:block input-label">Select Columns(MAX 10)<span class="text-red-500">*</span></label>
                    <Select 
                        placeholder="Select an option" 
                        :options="report.fields_list" 
                        v-model="report.form.selected_column"
                        :closeOnSelect="false" 
                        multiple
                        :selectable="(option) => !report.form.selected_column.includes(option.value) && report.form.selected_column.length < 15 "
                        :reduce="option => option.value"
                    />
                </div>
            </Card>

            <br>
            <Card title="Filters">
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
                        />
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
            <br>
            <Card>
                <Button class="w-full bg-emerald-500/100 hover:bg-emerald-600/100" @click="save" :text="`Save ${modules}`" />
            </Card>
    </div>
</template>
<script>
import Card from "@/components/Card";
import Textinput from "@/components/Textinput";
import Button from "@/components/Button";
import Textarea from "@/components/Textarea"
import Select from "vue-select";
import Icon from "@/components/Icon"
import Swal from 'sweetalert2';
import { ref } from "vue";
import { useModuleStore } from '@/store/module';
import { useDropdownStore } from "@/store/dropdown";
import { useReportStore } from "@/store/report";
const report = useReportStore();
const module_store = useModuleStore();
const dropdown_store = useDropdownStore();
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
export default {
    components:{
        Card,
        Textinput,
        Button,
        Textarea,
        Select,
        Icon
    },
    data(){
        return{
            module_store,
            dropdown_store,
            modules,
            report,
            report_select_columns,
            operator
        }
    },
    created(){
        modules.value = this.$route.params.module;
    },
    mounted(){
            report.loading = false;
            report.id = this.$route.params.id;
            report.module = this.$route.params.module;
            dropdown_store.get_dropdown('modules');
            report.get_fields(); 
            //report.get();  
    },
    methods:{
        clear(){
            report.form.selected_column = []
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
            report.get_fields();    
        },
        save(){
            report.save();
        },
    },
    
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