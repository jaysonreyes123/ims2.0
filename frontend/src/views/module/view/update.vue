<template>
    <div>
      <Loading v-model:active="SystemStore.loading" />
      <Card title="Updates" class="mt-4" v-if="!SystemStore.loading">
            <ul class="relative ltr:pl-2 rtl:pr-2">
              <li
                v-for="(item, i) in SystemStore.logs"
                :key="i"
                class="mt-5 flex"
              >
              <div class="w-[250px] text-xs">{{ item.created_at }}</div>
              <div class="w-[100px] ltr:border-l-2 rtl:border-r-2 border-slate-100 dark:border-slate-700 pb-4 last:border-none ltr:pl-[22px] rtl:pr-[22px] relative before:absolute ltr:before:left-[-8px] rtl:before:-right-2 before:top-[0px] before:rounded-full before:w-4 before:h-4 before:bg-slate-900 dark:before:bg-slate-600 before:leading-[2px] before:content-[url('@/assets/images/all-img/ck.svg')]">
  
              </div>
                <div>
                  <h2
                    class="text-sm font-medium dark:text-slate-400-900 mb-1 text-slate-600"
                  >
                    <span class="font-bold">{{ item.users_.name }}</span> - {{item.action}}
                  </h2>
                  <p class="text-xs dark:text-slate-400" v-html="item.description.replace('agency_name ','test')"></p>
                </div>
              </li>
            </ul>
      </Card>
    </div>
  </template>
  
  <script>
  import Card from "@/components/Card";
  
  import { useSystemStore } from '@/store/system';
  const SystemStore = useSystemStore();
  export default {
      components:{
          Card
      },
      data(){
          return{
              modules:this.$route.params.module,
              module_id:this.$route.params.id,
              SystemStore,
          }
      },
      mounted(){
          SystemStore.activity_logs(this.modules,this.module_id);
      },
      computed:{
          fields_computed(){
              let fields__;
              const modules__ = this.$route.params.module;
              switch (modules__) {
                  case 'incidents':
                      fields__ = incidents_field;
                      break;
                  case 'resources':
                      fields__ = resources_field;
                      break;
                  case 'contacts':
                      fields__ = contacts_field;
                      break;
                  case 'agencies':
                      fields__ = agency_fields;
                      break;
                  default:
                      break;
              }
          return fields__;
          },
          fields(){
            const fields_ = [];
              this.fields_computed.map(item=>{
                  item.fields.map(item2=>{
                    fields_[item2.name] = item2.label;
                  })
              });
             return fields_;
          }
        }
  }
  </script>
  
  <style>
  
  </style>