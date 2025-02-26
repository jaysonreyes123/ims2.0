<template>
    <div>
      <Card title="Updates" class="mt-4">
        <div v-if="SystemStore.logs.length > 0">
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
                    <span class="font-bold text-sky-500">{{ item.whodid }}</span> - {{item.action}}
                  </h2>
                  <div v-if="item.status == 2">
                        <p class="text-xs dark:text-slate-400"></p>
                        <div v-for="field in item.fields" :key="field.id" class="mb-2">
                          <p class="text-xs text-slate-600"><b>{{ field.label }}</b> changed</p>
                          <p class="text-xs text-slate-600"><b>From</b>: {{ field.oldvalue }}</p>
                          <p class="text-xs text-slate-600"><b>To</b>: {{ field.newvalue }}</p>
                        </div>
                  </div>
                  <div v-else-if="item.status == 4 || item.status == 5 ">
                        <p class="text-xs dark:text-slate-400"></p>
                        <div>
                          <p class="text-xs"><b>{{ item.fields.module }}</b> - {{ item.fields.entityname }}</p>
                        </div>
                  </div>
                </div>
              </li>
            </ul>
            <div class="w-full mt-4 flex justify-center" v-if="!SystemStore.is_last_page">
              <Button text="load more" @click="load_more" :isLoading="SystemStore.loading" btnClass="btn-sm btn-outline-white"/>
            </div>
        </div>
        <div v-else>
          <div class="p-4 mt-4 border border-slate-400 rounded text-center">
            <span>No Updates</span>
          </div>
        </div>
      </Card>
    </div>
  </template>
  
  <script>
  import Button from "@/components/Button";
  import Card from "@/components/Card";
  import { useSystemStore } from '@/store/system';
  const SystemStore = useSystemStore();
  export default {
      components:{
          Card,
          Button
      },
      data(){
          return{
              modules:this.$route.params.module,
              module_id:this.$route.params.id,
              SystemStore,
          }
      },
      created(){
          //window.addEventListener("scroll",this.scroll_paginate)
      },
      mounted(){
          SystemStore.loading = false;
          SystemStore.is_last_page = false;
          SystemStore.current_page = 1;  
          SystemStore.logs = [];
          SystemStore.activity_logs(this.modules,this.module_id);
      },
      methods:{
        scroll_paginate(){
          const current_scrollheight = window.scrollY + document.body.clientHeight;
          const total_scrollheight = document.body.scrollHeight;
          if(current_scrollheight == total_scrollheight){
              if(SystemStore.current_page < SystemStore.last_page){
                SystemStore.current_page++;
                SystemStore.activity_logs(this.modules,this.module_id);
              }
          }
        },
        load_more(){
            SystemStore.current_page++;
            SystemStore.activity_logs(this.modules,this.module_id);
        }
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