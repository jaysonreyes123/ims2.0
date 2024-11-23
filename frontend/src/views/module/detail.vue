<template>
    <div>
      <Breadcrumb mode='view'/>
      <TabGroup :defaultIndex="0">
        <Card class="mb-4">
          <TabList class="lg:space-x-8 md:space-x-4 space-x-0 rtl:space-x-reverse">
            <Tab
              v-slot="{ selected }"
              as="template"
              v-for="(item, i) in buttons"
              :key="i"
            >
            <button
                :class="[
                  selected
                    ? 'text-primary-500 before:w-full'
                    : 'text-slate-500 before:w-0 dark:text-slate-300',
                ]"
                class="inline-flex items-start text-sm font-medium capitalize bg-white dark:bg-slate-800 ring-0 foucs:ring-0 focus:outline-none px-2 transition duration-150 before:transition-all before:duration-150 relative before:absolute before:left-1/2 before:bottom-[-6px] before:h-[1.5px] before:bg-primary-500 before:-translate-x-1/2"
              >
                <span class="text-base relative top-[1px] ltr:mr-1 rtl:ml-1"
                  ><Icon :icon="item.icon" /></span
                >{{ item.title }}
              </button>
            </Tab>
          </TabList>
        </Card>
      <TabPanels>
        <TabPanel :unmount="true" v-for="(item,i) in buttons" :key="i">
            <component v-if="item.title == 'Details' " :is="Details()"></component>
        </TabPanel>
      </TabPanels>
  </TabGroup>
    </div>
</template>

<script>
import Incident from "./incident/detail.vue"
import Resource from "./resources/detail.vue";
import Breadcrumb from "../components/Breadcrumb.vue";
import Card from "@/components/Card";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import Icon from "@/components/Icon";
import { ref } from "vue";
const modules_page = ref();
const buttons = [
  {
    title: "Details",
    icon: "heroicons-outline:view-columns",
  },
  {
    title: "Updates",
    icon: "heroicons-outline:queue-list",
  },
];
export default {
    components:{
        Incident,
        Breadcrumb,
        Card,
        TabGroup,
        TabList,
        Tab,
        TabPanel,
        TabPanels,
        Icon,
        Resource
    },

    methods:{
      Details(){
            const modules = this.$route.params.module;
            var modules_ = "";
            switch (modules) {
                case 'incidents':
                  modules_ = Incident;
                    break;
                case 'resources':
                  modules_ = Resource;
                    break;
                default:
                    break;
            }
            return modules_;
        }
    },
    computed:{
      
    }, 
    data(){
        return{
            buttons
        }
    }
}
</script>

<style>

</style>