import auth from "@/middleware/auth";
import guest from "@/middleware/guest";

const routes = [
  {
    path: "/",
    name: "login",
    component: () => import("@/views/auth/login/login2.vue"),
  }, 
  {
    path: "/forgot-password",
    name: "forgot-password",
    component: () => import("@/views/auth/forgot-password2.vue"),
  }, 
  {
    path: "/reset-password/:token",
    name: "/reset-password",
    component: () => import("@/views/auth/reset-password.vue"),
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
        component: () => import("@/views/dashboard/index.vue"),
        meta: {
          hide: true,
        },
      },

      {
        path: "warning",
        name: "warning",
        component: () => import("@/views/warning/index.vue"),
        meta: {
          hide: true,
        },
      },

      {
        path: "historical",
        name: "historical",
        component: () => import("@/views/database/index.vue"),
        meta: {
          hide: true,
        },
      },
 
      {
        path: "sensors",
        name: "sensors",
        component: () => import("@/views/sensor/index.vue"),
        meta: {
          hide: true,
        },
      },

      {
        path: "monitoring",
        name: "monitoring",
        component: () => import("@/views/monitoring/index.vue"),
        meta: {
          hide: true,
        },
      },
//maintenance
      {
        path: "stations",
        name: "stations",
        component: () => import("@/views/maintenance/station/index.vue"),
        meta: {
          hide: true,
        },
      },
      {
        path: "recipients",
        name: "recipients",
        component: () => import("@/views/maintenance/recipient/index.vue"),
        meta: {
          hide: true,
        },
      },

      {
        path: "warnings",
        name: "warnings",
        component: () => import("@/views/maintenance/warning/index.vue"),
        meta: {
          hide: true,
        },
      },
      {
        path: "notification_content",
        name: "notification content",
        component: () => import("@/views/maintenance/notification/index.vue"),
        meta: {
          hide: true,
        },
      },
      {
        path: "users",
        name: "users",
        component: () => import("@/views/maintenance/user/index.vue"),
        meta: {
          hide: true,
        },
      },

      {
        path: "role",
        name: "user role",
        component: () => import("@/views/maintenance/role/index.vue"),
        meta: {
          hide: true,
        },
      },
      {
        path: "system",
        name: "System",
        component: () => import("@/views/maintenance/system/index.vue"),
        meta: {
          hide: true,
        },
      },

      {
        path: "email-template",
        name: "Email Template",
        component: () => import("@/views/maintenance/email_template/index.vue"),
        meta: {
          hide: true,
        },
      },
      
      {
        path: "profile",
        name: "profile",
        component: () => import("@/views/profile/profile-details.vue"),
        meta: {
          hide: true,
        },
      },

      {
        path: "activity-logs",
        name: "activity logs",
        component: () => import("@/views/profile/activity-logs.vue"),
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
