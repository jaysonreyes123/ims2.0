<template>
  <Card bodyClass="p-0 shadow-md">
      <header class="px-4 pt-4 pb-3 mb-3">
        <h5 class="card-title mb-0">Map the columns to CRM fields</h5>
      </header>
      <vue-good-table
        max-height="450px"
        :columns="columns"
        :rows="get_single_data"
        :fixed-header="true"
        styleClass=" vgt-table table-head"
        :sort-options="{
          enabled: false,
        }"
      >
      <template v-slot:table-row="props">
        <div v-if="props.column.field == 'crm_fields' ">
            <select class="w-full import-crm-fields" style="border:1px solid #ccc;padding: 5px;border-radius: 5px;outline: none">
                <option value="" disabled selected>Select an option</option>
                <option  v-for="(item,index) in crm_fields" :key="index" :value="item.value" :data-required="item.required" :data-type="item.type">
                    {{ item.label }}<span class="text-red-500" v-if="item.required">*</span>
                </option>
            </select>
        </div>
      </template>
      </vue-good-table>
    </Card>
</template>

<script>
import Card from '@/components/Card';
import { useImportStore } from '@/store/import';
import Select from "vue-select";
const ImportStore = useImportStore();
export default {
    props:{
        modulefields:{
            type:Array
        }
    },
    components:{
        Card,
        Select
    },
    data(){
        return{
            ImportStore,
            test:"",
            columns: [
                {
                    label: 'Row 1',
                    field: 'row_1',
                },

                {
                    label: 'Crm fields',
                    field: 'crm_fields',
                },
            ],
        }
    },
    computed:{
        get_single_data(){
            const get_single_data = [];
            ImportStore.get_single_row.map((item)=>{
                get_single_data.push(
                    {
                        row_1:item,
                    }
                )
            })
            return get_single_data;
        },
        crm_fields(){
            const fields_ = [];
            this.modulefields.map((item)=>{
                fields_.push({
                    label:item.label,
                    value:item.name,
                    required:item.required,
                    type:item.type
                })
            })
            console.log(fields_)
            return fields_;
        }
    },
    methods:{
        get_crm_fields_value:function(){
            console.log("test")
        }
    }
}
</script>

<style>

</style>