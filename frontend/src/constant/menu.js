export const topMenu = [
  {
    title: "Dashboard",
    icon: "carbon:dashboard",
    link: "/app/dashboard", 
    name : "dashboard",
    breadcrum:false,
    custom:true
  },
  {
    title: "Incident",
    icon: "heroicons:exclamation-triangle",
    link: "/app/module/incidents", 
    name : "incidents",
    breadcrum:true,

  },
  {
    title: "Resources",
    icon: "heroicons:clipboard-document-check",
    link: "/app/module/resources", 
    name : "resources",
    breadcrum:true,

  },
  {
    title: "Pre Plan",
    icon: "heroicons:document",
    link: "/app/module/preplans", 
    name : "preplans",
    breadcrum:true,

  },
  {
    title:"Contacts",
    icon: "heroicons:users",
    link: "#",
    name:"contacts",
    custom:true,
    child:[
      {
        childtitle: "Contacts",
        childlink: "/app/module/contacts",
        childicon: "solar:station-bold-duotone",
        name:"contacts",
      },
      {
        childtitle: "Agencies",
        childlink: "/app/module/agencies",
        childicon: "solar:station-bold-duotone",
        name:"agencies",
      },
      {
        childtitle: "Responder",
        childlink: "/app/module/responders",
        childicon: "solar:station-bold-duotone",
        name:"responders",
  

      },
    ]
  },
  {
    title:"Monitoring",
    icon: "heroicons:computer-desktop",
    link: "#",
    name:"monitoring",
    custom:true,
    child:[
      {
        childtitle: "Incident Map",
        childlink: "/app/map/incident_map",
        childicon: "solar:station-bold-duotone",
        name:"incident_map",
        custom_child:true

      },
      {
        childtitle: "Heat Map",
        childlink: "/app/map/heat_map",
        childicon: "solar:station-bold-duotone",
        name:"heat_map",
        custom_child:true

      },
      {
        childtitle: "Call Logs",
        childlink: "/app/module/call_logs",
        childicon: "solar:station-bold-duotone",
        name:"call_logs",
      },
    ]
  },
  {
    title: "Report",
    icon: "heroicons:chart-pie",
    link: "/app/module/reports", 
    name : "reports",
    breadcrum:true,

  },
  {
    title:"Settings",
    icon: "fluent:settings-32-regular",
    link: "#",
    name:"settings",
    child:[
      {
        childtitle: "Users",
        childlink: "/app/module/users",
        childicon: "solar:station-bold-duotone",
        name:"users",
        admin:true,
      },
      // {
      //   childtitle: "Workflow",
      //   childlink: "/app/setting/workflow",
      //   childicon: "solar:station-bold-duotone",
      //   name:"workflow",
      //   admin:true,
      // },
    ]
  },

  // {
  //   title: "Maintenance",
  //   icon: "fluent:settings-32-regular",
  //   link: "#",
  //   child: [
  //     {
  //       childtitle: "Stations",
  //       childlink: "stations",
  //       childicon: "solar:station-bold-duotone",
  //       name:"station"
  //     },
  //     {
  //       childtitle: "Warnings",
  //       childlink: "warnings",
  //       childicon: "ph:warning-diamond",
  //       name:"maintenance_warning"
  //     },
  //     {
  //       childtitle: "Notification Content",
  //       childlink: "notification_content",
  //       childicon: "solar:notification-unread-lines-broken",
  //       name:"notification"
  //     },
  //     {
  //       childtitle: "Recipients",
  //       childlink: "recipients",
  //       childicon: "material-symbols:person-check-outline",
  //       name: "recipient"
  //     },
  //     {
  //       childtitle: "Users",
  //       childlink: "users",
  //       childicon: "la:users-cog",
  //       name: "user"
  //     },
  //     {
  //       childtitle: "User Role",
  //       childlink: "role",
  //       childicon: "la:users-cog",
  //       name : "user_role"
  //     },
  //     {
  //       childtitle: "Email Templete",
  //       childlink: "email-template",
  //       childicon: "la:envelope",
  //       name : "email_template"
  //     },
  //     {
  //       childtitle: "System",
  //       childlink: "system",
  //       childicon: "la:cog",
  //       name : "system"
  //     },
  //   ],
  // },
];