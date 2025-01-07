<template>
    <div>
      <Breadcrumb mode='view'/>
      <TabGroup :defaultIndex="0">
        <Card class="mb-4">
          <TabList class="lg:space-x-8 md:space-x-4 space-x-0 rtl:space-x-reverse">
            <Tab
              v-slot="{ selected }"
              as="template"
              v-for="(item, i) in button_module"
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
                <span class="text-ba  se relative top-[1px] ltr:mr-1 rtl:ml-1"
                  ><Icon :icon="item.icon" /></span
                >{{ item.title }}
              </button>
            </Tab>
          </TabList>
        </Card>
        <TabPanels>
          <TabPanel v-for="(item,i) in button_module" :key="i">
              <component :is="item.component"></component>
              <!-- <component v-if="item.title == 'Updates' " :is="Updates()"></component> -->
          </TabPanel>
        </TabPanels>
    </TabGroup>
    </div>
</template>

<script>
import Incident from "./incident/detail.vue"
import Resource from "./resources/detail.vue";
import Contact from "./contacts/detail.vue";
import Agency from "./agency/detail.vue";
import Responder from "./responder/detail.vue";
import PrePlan from "./preplan/detail.vue";
import CallLog from "./call_logs/detail.vue";
import User from "./users/detail.vue";
import Breadcrumb from "../components/Breadcrumb.vue";
import Update from "./update.vue";
import IncidentMedia from "./incident/media/media.vue"
import Card from "@/components/Card";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import { menu_button } from "./menu_button";
import Icon from "@/components/Icon";
export default {
    components:{
        Breadcrumb,
        Card,
        TabGroup,
        TabList,
        Tab,
        TabPanel,
        TabPanels,
        Icon,
        Resource,
        Incident,
        Update,
        Contact,
        Agency,
        Responder,
        PrePlan,
        User,
        CallLog,
        IncidentMedia
    },
    computed:{
        button_module(){
          return menu_button[this.$route.params.module];
        }
    }, 
}
</script>

<style>

</style>