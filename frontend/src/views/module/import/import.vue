<template>
    <div>
          <Loading v-model:active="import_store.loading"/>
      <Modal
        :activeModal="openModal"
        @close="closeModal"
        :title="`Import ${modules_.label}`"
        sizeClass="w-3/6"
        >
        <div class="flex z-[5] items-center relative justify-center md:mx-8">
          <div
            class="relative z-[1] items-center item flex flex-start flex-1 last:flex-none group"
            v-for="(item, i) in steps"
            :key="i"
          >
            <div
              :class="`   ${
                import_store.stepNumber >= i
                  ? 'bg-slate-900 text-white ring-slate-900 ring-offset-2 dark:ring-offset-slate-500 dark:bg-slate-900 dark:ring-slate-900'
                  : 'bg-white ring-slate-900 ring-opacity-70  text-slate-900 dark:text-slate-300 dark:bg-slate-600 dark:ring-slate-600 text-opacity-70'
              }`"
              class="transition duration-150 icon-box md:h-12 md:w-12 h-7 w-7 rounded-full flex flex-col items-center justify-center relative z-[66] ring-1 md:text-lg text-base font-medium"
            >
              <span v-if="import_store.stepNumber <= i"> {{ i + 1 }}</span>
              <span v-else class="text-3xl">
                <Icon icon="bx:check-double" />
              </span>
            </div>
  
            <div
              class="absolute top-1/2 h-[2px] w-full"
              :class="
                import_store.stepNumber >= i
                  ? 'bg-slate-900 dark:bg-slate-900'
                  : 'bg-[#E0EAFF] dark:bg-slate-700'
              "
            ></div>
            <div
              class="absolute top-full text-base md:leading-6 mt-3 transition duration-150 md:opacity-100 opacity-0 group-hover:opacity-100"
              :class="
                import_store.stepNumber >= i
                  ? ' text-slate-900 dark:text-slate-300'
                  : 'text-slate-500 dark:text-slate-300 dark:text-opacity-40'
              "
            >
              <span class="w-max">{{ item.title }}</span>
            </div>
          </div>
        </div>
  
        <div class="conten-box mt-14 border-t border-slate-100 dark:border-slate-700 -mx-6 px-6 pt-6">
            <div v-if="import_store.stepNumber == 0">
                <Step1 @uploadFile = "uploadFile" @hasHeader="hasHeader" />
            </div>
            <div v-if="import_store.stepNumber == 1">
                <Step2 
                  @duplicate_handling_option="duplicate_handling_option"
                  @duplicate_handling_field="duplicate_handling_field"
                />
            </div>
            <div v-if="import_store.stepNumber === 2">
                <Step3/>
            </div>
            <div v-if="import_store.stepNumber === 3">
                <Step4/>
            </div>
            <div class="mt-10" :class="import_store.stepNumber > 0 ? 'flex justify-end' : ' text-right'" >
                <!-- <Button
                  @click.prevent="prev()"
                  text="previous"
                  btnClass="btn-dark"
                  v-if="this.stepNumber !== 0"
                /> -->
                <Button
                  :text="import_store.stepNumber !== this.steps.length - 1 ? 'next' : 'Close'"
                  @click.prevent="next()"
                  btnClass="btn-dark"
                />
              </div>
        </div>
        </Modal>
    </div>
  
  </template>
  
<script>
import Swal from 'sweetalert2';
import Button from '@/components/Button';
import Modal from '@/components/Modal';
import VerticallyWizard from '@/views/forms/form-wizard/VerticallyWizard.vue';
import Step1 from './step1.vue';
import Step2 from './step2.vue';
import Step3 from './step3.vue';
import Step4 from "./step4.vue";
import Icon from "@/components/Icon";
import { useImportStore } from '@/store/import';
import { ref } from 'vue';
import { useListStore } from '@/store/list';
import { useAuthStore } from "@/store/auth";
const auth_store = useAuthStore();
const import_store = useImportStore();
const list_store = useListStore();
const files = ref();
const header = ref(false);
const duplicate_handling_field = ref([]);
export default {
  components: {
    Button,
    Modal,
    VerticallyWizard,
    Step1,
    Step2,
    Step3,
    Step4,
    Icon
  },
  props: {
    openModal: {
      type: Boolean,
      default: false
    },
  },
  data() {
    return {
      import_store,
      steps: [
        {
          id: 1,
          title: "Upload csv file",
        },
        {
          id: 2,
          title: "Duplicate handling",
        },
        {
          id: 3,
          title: "Field mapping",
        },
        {
          id: 4,
          title: "Result",
        },
      ]
    }
  },
  mounted(){
    import_store.loading = false;
    import_store.module = this.$route.params.module;
    import_store.get_fields();
  },
  computed:{
        modules_(){
            const current_module = this.$route.params.module;
            const module_info = auth_store.module.find(module__ => module__.name == current_module );
            return module_info;
        }
    },
  methods:{
    closeModal(){
        this.$emit('closeModal',false);
        files.value = undefined;
        setTimeout(()=>{
          import_store.stepNumber = 0;
          import_store.duplicate_handling_option = 1;
        },500)

        if(import_store.stepNumber == 3){
          list_store.module = this.$route.params.module;
          list_store.list_function();
        }
      },
      uploadFile(value){
        files.value = value;
      },
      hasHeader(value){
        header.value = value;
      },
      duplicate_handling_option(value){
          import_store.duplicate_handling_option = value;
      },
      duplicate_handling_field(value){
        duplicate_handling_field.value = value;
      },
      prev(){
        import_store.stepNumber++;
      },
      next(){
        if(import_store.stepNumber == 0 && files.value === undefined){
          Swal.fire({
            icon: "error",
            title: "Something wrong",
            text: "Select csv file to proceed in the next step",
          });
          return false;
        }
        else if(import_store.stepNumber == 1){
          const form = new FormData();
          form.append("files",files.value[0]);
          form.append("hasheader",header.value);
          import_store.getImport(form)
        }
        else if(import_store.stepNumber == 2){
          this.saveImport();
        }
        else if(import_store.stepNumber == 3){
          this.closeModal();
        } 
        else{
          import_store.stepNumber++;
        }
        
      },
      getFieldRequired(){
        const required_fields = [];
        const fields = [];
        import_store.import_fields.map(item=>{
          if(item.required){
            required_fields.push(item.name)
          }
          fields[item.name] = item;
        })
        return {required_fields:required_fields,fields:fields};
      },
      saveImport(){
          const select_crm_fields = document.getElementsByClassName('import-crm-fields');
          const select_value = [];
          const {required_fields,fields} = this.getFieldRequired();
          //get the duplicate crm field
          const selected_field = [];
          for(var a = 0; a < select_crm_fields.length;a++){
            if(select_crm_fields[a].value != ""){
              
              const value = select_crm_fields[a].value;
              const get_item = select_value[value] ;
              if(get_item === undefined){
                select_value[value] = 1;
              }
              else{
                var count = 0;
                count = get_item;
                count++;
                select_value[value] = count;
              }
              //set selected field and their position
              selected_field.push(
                {
                  fields:value,
                  position:a,
                  type:select_crm_fields[a].selectedOptions[0].getAttribute('data-type')
                }
              )
            }
          }
          var error = "";
          //check if more the 1 selected field
          const select_key = Object.keys(select_value);
          console.log(select_key)
          select_key.map(item=>{
            if(select_value[item] > 1){
              error+=`<p class="text-red-500">Field mapped more than once <b>${fields[item].label}</b></p>`;
            } 
          })
          //check required field
          const check_required_field = required_fields.filter(x => !select_key.includes(x));
          if(check_required_field.length > 0){
            check_required_field.map(item=>{
              error+=`<p class="text-red-500">Please map mandatory fields <b>${fields[item].label}</b> </p>`;
            })
          }
          if(error != ""){
            Swal.fire({
                icon: "error",
                title: "Something wrong",
                html: error,
              });
              return false;
          }
          const forms = new FormData();
          forms.append("files",files.value[0]);
          forms.append("fields",JSON.stringify(selected_field));
          forms.append("module",this.$route.params.module);
          forms.append("duplicate_fields",JSON.stringify(import_store.duplicate_handling_field));
          forms.append("duplicate_option",import_store.duplicate_handling_option);
          forms.append('hasheader',header.value);
          import_store.saveImport(forms);
      },
  }
}
</script>

  <style>
  .swal2-container {
    z-index: 999999 !important;
  }
  .vl-active{
    z-index: 999999 !important;
  }
  </style>