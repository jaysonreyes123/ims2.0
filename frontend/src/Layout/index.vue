<template>
  <main class="app-wrapper">
    <Header :class="window.width > 1280 ? switchHeaderClass() : ''" />
    <!-- end header -->

    <Sidebar
      v-if="
        $store.themeSettingsStore.menuLayout === 'vertical' &&
        $store.themeSettingsStore.sidebarHidden === false &&
        window.width > 1280
      "
    />
    <!-- main sidebar end -->
    <Transition name="mobilemenu">
      <mobile-sidebar
        v-if="this.window.width < 1280 && $store.themeSettingsStore.mobielSidebar"
      />
    </Transition>
    <Transition name="overlay-fade">
      <div
        v-if="window.width < 1280 && $store.themeSettingsStore.mobielSidebar"
        class="overlay bg-slate-900 bg-opacity-70 backdrop-filter backdrop-blur-[3px] backdrop-brightness-10 fixed inset-0 z-[999]"
        @click="$store.themeSettingsStore.mobielSidebar = false"
      ></div>
    </Transition>
    <!-- mobile sidebar -->
    

    <div
      class="content-wrapper transition-all duration-150"
      :class="window.width > 1280 ? switchHeaderClass() : ''"
    >
      <div
        class="page-content"
        :class="$route.meta.appheight ? 'h-full' : 'page-min-height'"
      >
        <div
          :class="` transition-all duration-150 ${
            $store.themeSettingsStore.cWidth === 'boxed'
              ? 'container mx-auto'
              : 'container-fluid'
          }`"
        >
          <Breadcrumbs v-if="!$route.meta.hide" />
          <router-view v-slot="{ Component }">
            <transition name="router-animation" mode="out-in" appear>
              <component :is="Component"></component>
            </transition>
          </router-view>
        </div>
      </div>
    </div>
    
    <!-- end page content -->
    <FooterMenu v-if="window.width < 768" />
    <Footer
      :class="window.width > 1280 ? switchHeaderClass() : ''"
      v-if="window.width > 768"
    />
     <alert_toast v-if="notifications_.length > 0" :key="notifications_.length" :data="notifications_" />
  </main>
</template>
<script setup>
import axiosIns from "@/plugins/axios";
import alert_toast from "@/views/dashboard/component/toast.vue";
import {useDashboardStore} from "@/store/dashboard";
import { onMounted, ref,getCurrentInstance } from "vue";
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2';
const properties = getCurrentInstance().appContext.config.globalProperties
var notifications_ = ref([]);
const router = useRouter();
function loadNotifications(){
            axiosIns.get("/alert_notification")
            .then((response) => {
              notifications_.value = response.data.data;
            })
            .catch(error => {
              const err = error.response.data;
              if(err.status == 400 && err.message == 'Unauthorized.'){
                    Swal.fire({
                        title: 'You have been logged out',
                        text: 'Your account has been logged in another device. Please click okay to login again.',
                        icon: 'error',
                        confirmButtonText: 'Okay',
                        allowOutsideClick: false
                    })
                    .then(()=>{
                        location.href="/";
                    })
                }
            })
}
onMounted(()=>{
  loadNotifications();
  properties.notification_event.listen('.notification-event',(e)=>{
     loadNotifications();
  })
})
// const dashboard = useDashboardStore();
// console.log(dashboard.notification)
// const notification_event = getCurrentInstance().appContext.config.globalProperties.notification_event;

      const alarm = [
    {
        name:"station1",
        color:"#85eddf"
    },
    {
        name:"station2",
        color:"#e1fc2b"
    }
]
// onMounted(()=>{
//  const current_route = router.currentRoute._value.name;
//  if(current_route != "dashboard"){
//   dashboard.loadNotification();
//     notification_event.listen('.notification-event',(e)=>{
//     dashboard.loadNotification();
//   })
//  }
//  else{
//   dashboard.notification = [];
//  }
// })

</script>
<script>
import Breadcrumbs from "@/components/Breadcrumbs";
import Footer from "../components/Footer";
import Header from "../components/Header";
import Settings from "../components/Settings";
import Sidebar from "../components/Sidebar/";
import window from "@/mixins/window";
import MobileSidebar from "@/components/Sidebar/MobileSidebar.vue";
import FooterMenu from "@/components/Footer/FooterMenu.vue";
import { onMounted } from 'vue';

export default {
  mixins: [window],
  components: {
    Header,
    Footer,
    Sidebar,
    Settings,
    Breadcrumbs,
    FooterMenu,
    MobileSidebar,
  },
  methods: {
    switchHeaderClass() {
      if (
        $store.themeSettingsStore.menuLayout === "horizontal" ||
        $store.themeSettingsStore.sidebarHidden
      ) {
        return "ltr:ml-0 rtl:mr-0";
      } else if ($store.themeSettingsStore.sidebarCollasp) {
        return "ltr:ml-[72px] rtl:mr-[72px]";
      } else {
        return "ltr:ml-[248px] rtl:mr-[248px]";
      }
    },
  },
};
</script>
<style lang="scss">
.router-animation-enter-active {
  animation: coming 0.2s;
  animation-delay: 0.1s;
  opacity: 0;
}
.router-animation-leave-active {
  animation: going 0.2s;
}

@keyframes going {
  from {
    transform: translate3d(0, 0, 0) scale(1);
  }
  to {
    transform: translate3d(0, 4%, 0) scale(0.93);
    opacity: 0;
  }
}
@keyframes coming {
  from {
    transform: translate3d(0, 4%, 0) scale(0.93);
    opacity: 0;
  }
  to {
    transform: translate3d(0, 0, 0) scale(1);
    opacity: 1;
  }
}
@keyframes slideLeftTransition {
  0% {
    opacity: 0;
    transform: translateX(-20px);
  }
  100% {
    opacity: 1;
    transform: translateX(0px);
  }
}
.mobilemenu-enter-active {
  animation: slideLeftTransition 0.24s;
}

.mobilemenu-leave-active {
  animation: slideLeftTransition 0.24s reverse;
}

.page-content {
  @apply md:pt-6 md:pb-[37px] md:px-6 pt-[15px] px-[15px] pb-24;
}
.page-min-height {
  min-height: calc(var(--vh, 1vh) * 100 - 132px);
}
</style>
