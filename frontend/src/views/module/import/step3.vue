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
                  <option  v-for="(item,index) in ImportStore.import_fields" :key="index" :value="item.name" :data-required="item.required" :data-type="item.type">
                      {{ item.label }}<span class="text-red-500" v-if="item.required">*</span>
                  </option>
              </select>
              <!-- <Select :options="import_dropdown" /> -->
          </div>
        </template>
        </vue-good-table>
      </Card>
  </template>
  
  <script>
  import Card from '@/components/Card';
  import Select from "vue-select";
  import { useImportStore } from '@/store/import';
  const ImportStore = useImportStore();
  export default {
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
          import_dropdown(){
            const import_dropdown_ = [];
            ImportStore.import_fields.map(item=>{
                const sub_import_data = {};
                sub_import_data["label"] = item.label;
                sub_import_data["value"] = item.name;
                import_dropdown_.push(sub_import_data);
            })
            return import_dropdown_;
          }
      },
  }
  </script>
  
  <style>
  
  </style>