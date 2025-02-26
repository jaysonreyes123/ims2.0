<template>
  <div>
  <Loading v-model:active="user_store.loading"/>
  <div class="space-y-5 profile-page" v-if="!user_store.loading">
    <div
      class="profiel-wrap px-[35px] pb-10  rounded-lg bg-white dark:bg-slate-800 lg:flex lg:space-y-0 space-y-6 justify-between items-end relative z-[1]"
    >
      <div class="profile-box flex-none md:text-start text-center">
        <br><br>
        <div class="md:flex items-end md:space-x-6 rtl:space-x-reverse">
          <!-- <div class="flex-none">
            <div
              class="md:h-[186px] md:w-[186px] h-[140px] w-[140px] md:ml-0 md:mr-0 ml-auto mr-auto md:mb-0 mb-4 rounded-full ring-4 ring-slate-100 relative"
            >
              <img
                src="@/assets/images/users/user-1.jpg"
                alt=""
                class="w-full h-full object-cover rounded-full"
              />
              <router-link
                to="/app/profile-setting"
                class="absolute right-2 h-8 w-8 bg-slate-50 text-slate-600 rounded-full shadow-sm flex flex-col items-center justify-center md:top-[140px] top-[100px]"
                ><Icon icon="heroicons:pencil-square" />
              </router-link>
            </div>
          </div> -->
          <div class="flex-1">
            <div
              class="text-2xl font-medium text-slate-900 dark:text-slate-200 mb-[3px]"
            >
              {{ user_store.data.name }}
            </div>
            <div class="text-sm font-light text-slate-600 dark:text-slate-400">
           
            </div>
          </div>
        </div>
      </div>
      <!-- end profile box -->
      <div
        class="profile-info-500 md:flex md:text-start  text-center flex-2 max-w-[516px] md:space-y-0 space-y-4"
      >
        <!-- <div class="flex-1">
          <div
            class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1"
          >
            $32,400
          </div>
          <div class="text-sm text-slate-600 font-light dark:text-slate-300">
            Total Balance
          </div>
        </div>
        <div class="flex-1">
          <div
            class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1"
          >
            200
          </div>
          <div class="text-sm text-slate-600 font-light dark:text-slate-300">
            Board Card
          </div>
        </div> -->
        <div class="flex-1">
          <div
            class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1"
          >
          <router-link :to="{name:'profile-edit'}">
              <Button
                  icon="heroicons-outline:pencil-square"
                  text="Edit"
                  btnClass="btn-danger shadow-base2"
                  iconPosition="left"
                />
            </router-link>
          </div>
          <!-- <div class="text-sm text-slate-600 font-light dark:text-slate-300">
            Calender Events
          </div> -->
        </div>
      </div>
      <!-- profile info-500 -->
    </div>
    <div class="grid grid-cols-12 gap-6">
      <div class="lg:col-span-4 col-span-12">
        <Card title="Info">
          <br>
          <ul class="list space-y-8">
            <li class="flex space-x-3 rtl:space-x-reverse">
              <div
                class="flex-none text-2xl text-slate-600 dark:text-slate-300"
              >
                <Icon icon="heroicons:user" />
              </div>
              <div class="flex-1">
                <div
                  class="uppercase text-xs text-slate-500 dark:text-slate-300 mb-1 leading-[12px]"
                >
                  NAME
                </div>
                <a
                  href="mailto:someone@example.com"
                  class="text-base text-slate-600 dark:text-slate-50"
                >
                {{ user_store.data.name }}
                </a>
              </div>
            </li>
            <li class="flex space-x-3 rtl:space-x-reverse">
              <div
                class="flex-none text-2xl text-slate-600 dark:text-slate-300"
              >
                <Icon icon="heroicons:envelope" />
              </div>
              <div class="flex-1">
                <div
                  class="uppercase text-xs text-slate-500 dark:text-slate-300 mb-1 leading-[12px]"
                >
                  EMAIL
                </div>
                <a
                  href="mailto:someone@example.com"
                  class="text-base text-slate-600 dark:text-slate-50"
                >
                {{ user_store.data.email }}
                </a>
              </div>
            </li>
            <!-- end single list -->
            <li class="flex space-x-3 rtl:space-x-reverse">
              <div
                class="flex-none text-2xl text-slate-600 dark:text-slate-300"
              >
                <Icon icon="heroicons:user-group" />
              </div>
              <div class="flex-1">
                <div
                  class="uppercase text-xs text-slate-500 dark:text-slate-300 mb-1 leading-[12px]"
                >
                  ROLE
                </div>
                <a
                  href="tel:0189749676767"
                  class="text-base text-slate-600 dark:text-slate-50"
                >
                {{ user_store.data.user_roles }}
                </a>
              </div>
            </li>
          </ul>
        </Card>
      </div>
      <div class="lg:col-span-8 col-span-12">
        <Card title="Module">
          <div class="lg:grid gap-x-12" style="grid-template-columns: 1fr 1fr;">
              <div v-for="(field,i) in auth.module" :key="i" :class="`custom-grid-${i%2}`" class="mt-4">
                <div class="fromGroup relative" v-if="field.presence == 1 || field.presence == 3">
                    <label>{{ field.label }}</label>
                    <Badge v-if="user_store.data.user_privileges[field.name] == 1" label="Active" badgeClass="bg-success-500 text-white" />
                    <Badge v-if="user_store.data.user_privileges[field.name] == 0" label="Inactive" badgeClass="bg-danger-500 text-white" />
                  </div>
              </div>
          </div>
        </Card>
      </div>
    </div>
  </div>
</div>
</template>
<script>
import Card from "@/components/Card";
import Icon from "@/components/Icon";
import Badge from "@/components/Badge";
import { basicArea, basicAreaDark } from "@/constant/appex-chart.js";
import { useAuthStore } from "@/store/auth";
import Button from "@/components/Button";
import { useUserStore } from "@/store/user";
const auth = useAuthStore();
const user_store = useUserStore();
const module_list = [
  {
    label:"Incident",
    name:"incidents"
  },
  {
    label:"Resource",
    name:"resources"
  }
];
export default {
  components: {
    Card,
    Icon,
    Badge,
    Button
  },
  created(){
    user_store.id = auth.user.id;
    user_store.get_data();
  },
  methods:{

  },
  data() {
    return {
      user_store,
      module_list,
      auth
    };
  },
};
</script>
<style scoped>
label{
  font-weight: bold;
}
.fromGroup{
  margin-bottom: 15px;
  display: flex;

}
.custom-grid-0{
    grid-column:1
}
.custom-grid-1{
    grid-column:2
}
.fromGroup label{
  overflow-wrap:break-word;
  width: 200px;
  margin-bottom: 0.5rem;
  font-size: 0.875rem;
  line-height: 1.5rem;
  text-transform: capitalize;
}
.fromGroup span{
  font-size: 0.875rem;
}
</style>
