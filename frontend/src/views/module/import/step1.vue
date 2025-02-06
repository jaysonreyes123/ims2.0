<template>
    <div>
      <Card title="Import from csv file" class="shadow">
          <br>
          <div class="lg:grid lg:grid-cols-1">
              <div class="fromGroup relative">
                  <label for="" class="inline-block input-label">Select csv file</label>
                  <Fileinput accept=".csv" placeholder="Choose a file here..." @change="uploadFile" />
              </div>
              <br>
              <Checkbox v-model="hasheader" @change="hasheaderevent" label="Has header"/>
          </div>
      </Card>
    </div>
  </template>
  
  <script>
  import Card from "@/components/Card";
  import Fileinput from "@/components/Fileinput";
  import Checkbox from "@/components/Checkbox";
  export default {
      components:{
          Card,
          Fileinput,
          Checkbox
      },
      data(){
          return{
              hasheader:0
          }
      },
      methods:{
        next(){
        if(ImportStore.stepNumber == 0 && files.value === undefined){
          Swal.fire({
            icon: "error",
            title: "Something wrong",
            text: "Select csv file to proceed in the next step",
          });
          return false;
        }
        else if(ImportStore.stepNumber == 1){
          const form = new FormData();
          form.append("files",files.value[0]);
          form.append("hasheader",header.value);
          ImportStore.getImport(form)
        }
        else if(ImportStore.stepNumber == 2){
          this.saveImport();
        }
        else if(ImportStore.stepNumber == 3){
          this.closeModal();
        } 
        else{
          ImportStore.stepNumber++;
        }
        
      },
          uploadFile(event){
              this.$emit("uploadFile",event.target.files);
          },
          hasheaderevent(event){
              this.$emit("hasHeader",this.hasheader);
          }
      }
  }
  </script>
  
  <style>
  
  </style>