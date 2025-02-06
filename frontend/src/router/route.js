import auth from "@/middleware/auth";
import guest from "@/middleware/guest";
const routes = [
  {
    path: "/",
    name: "login",
    component: () => import("@/views/auth/login/login3.vue"),
  }, 
  {
    path: "/forgot-password",
    name: "forgot-password",
    component: () => import("@/views/auth/forgot-password3.vue"),
  }, 
  {
    path: "/reset-password/:token",
    name: "reset-password",
    component: () => import("@/views/auth/reset-password3.vue"),
  }, 
  {
    path: "/app/module/:module/print/:id",
    name: "print",
    component: () => import("@/views/module/view/print.vue"),
  },
  {
    path: "/app/module/:module/generate/print/:id",
    name: "print-report",
    component: () => import("@/views/module/report/print.vue"),
  },
  {
    path: "/app",
    name: "home",
    redirect: "/app/home",
    component: () => import("@/Layout/index.vue"),
    meta: {
      middleware: [auth],
    },
    children: [ 
      {
        path: "dashboard",
        name: "dashboard",
        component: () => import("@/views/module/dashboard/index.vue"),
      },
      {
        path: "profile",
        name: "profile",
        component: () => import("@/views/module/profile/profile.vue"),
      }, 
      {
        path: "profile/edit",
        name: "profile-edit",
        component: () => import("@/views/module/profile/edit.vue"),
      },
      {
        path: "module/:module/edit/:id?",
        name: "edit",
        component: () => import("@/views/module/index_save.vue"),
      },
      {
        path: "module/:module/:action/:id?",
        name: "view",
        component: () => import("@/views/module/view.vue"),
      },
      {
        path: "module/related/list/:module/:related_module/:id",
        name: "related_list",
        component: () => import("@/views/module/related/view.vue"),
      },
      {
        path: "module/related/save/:module/:related_module/:id/:related_id?",
        name: "related_save",
        component: () => import("@/views/module/related/save.vue"),
      },
      {
        path: "module/save/:module/:type/:id?",
        name: "save_port",
        component: () => import("@/views/module/report/save_index.vue"),
      },
      {
        path: "module/:module",
        name: "list",
        component: () => import("@/views/module/list/index.vue"),
      },
      {
        path: "module/:module/generate/:id",
        name: "generate",
        component: () => import("@/views/module/report/view.vue"),
      },
      {
        path: "/map/:module",
        name: "Monitoring",
        component: () => import("@/views/module/map/index.vue"),
        meta: {
          hide: true,
        },
      },
    ],
  },
  {
    path: "/:catchAll(.*)",
    name: "404",
    component: () => import("@/views/404.vue"),
  },
  {
    path: "/coming-soon",
    name: "coming-soon",
    component: () => import("@/views/utility/comming-soon"),
  },
  {
    path: "/under-construction",
    name: "under-construction",
    component: () => import("@/views/utility/under-construction"),
  },
  {
    path: "/error",
    name: "error",
    component: () => import("@/views/error.vue"),
  },
];

export default routes;
