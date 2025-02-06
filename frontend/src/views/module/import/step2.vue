<template>
    <div>
      <Card title="Duplicate record handling" class="shadow">
          <div class="fromGroup relative mt-5">
              <label for="" class="inline-block input-label">Select how duplicate records should be handled</label>
              <Select placeholder="Select an option" v-model="ImportStore.duplicate_handling_option" @change="duplicate_handling_event" :options="options" />
          </div>
          <div class="fromGroup relative" v-if="ImportStore.duplicate_handling_option != 1">
              <p class="mt-5">Select the matching fields to find duplicate records</p>
              <label for="" class="inline-block input-label">Available fields</label>
              <!-- <select @change="duplicate_handling_field_event" v-model="duplicate_handling_field" class="text-sm" multiple style="width: 100%;border: 1px solid #ccc;height: 200px;">
                  <option value="" selected disabled>Select an option</option>
                  <option :value="item.value" v-for="(item,index) in select" :key="index" >
                      {{ item.label }}
                  </option>
              </select> -->
              <VSelect multiple v-model="ImportStore.duplicate_handling_field" :reduce="option => option.value " :options="import_dropdown" />
          </div>
      </Card> 
    </div>
  </template>
  
  <script>
  import Card from "@/components/Card";
  import Select from "@/components/Select";
  import { useImportStore } from "@/store/import";
  import VSelect from "vue-select";
  const ImportStore = useImportStore();
  const options = [
      {
          value:1,
          label:"Skip this step"
      },
      {
          value:2,
          label:"Skip"
      },
      {
          value:3,
          label:"Update"
      }
  ];
  export default {
      components:{
          Card,
          Select,
          VSelect
      },
      data(){
          return{
              options,
              duplicate_handling_field:[],
              select:[],
              ImportStore
          }
      },
      created(){
        console.log(ImportStore.import_fields)
          this.formSelect(ImportStore.import_fields);
      },
      methods:{
          formSelect(data){
              data.map(item=>{
                  if(item.duplicate_handling){
                      this.select.push(
                          {
                              label:item.label,
                              value:item.name
                          }
                      );
                  }
              })
              return  this.select;
          },
          duplicate_handling_event(){
              this.$emit("duplicate_handling_option",ImportStore.duplicate_handling_option);
          },
          duplicate_handling_field_event(){
              this.$emit("duplicate_handling_field",this.duplicate_handling_field);
          }
      },
      computed:{
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
      }
  
  }
  </script>
  
  <style>
  
  </style>