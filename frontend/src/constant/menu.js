export const topMenu = [
    {
      isHeadr: true,
      title: "menu",
    },
    {
      title: "Dashboard",
      icon: "carbon:dashboard",
      link: "/app/dashboard", 
      name : "dashboard",
      breadcrum:false
    },
    {
      title: "Incident",
      icon: "carbon:dashboard",
      link: "/app/module/incidents", 
      name : "incidents",
      breadcrum:true
    },
    {
      title: "Resources",
      icon: "carbon:dashboard",
      link: "/app/module/resources", 
      name : "resources",
      breadcrum:true
    },
    {
      title: "Pre Plan",
      icon: "carbon:dashboard",
      link: "/app/module/pre-plans", 
      name : "pre-plans",
      breadcrum:true
    },
    {
      title:"Contacts",
      icon: "ic:baseline-people",
      link: "#",
      name:"contacts",
      child:[
        {
          childtitle: "Contacts",
          childlink: "/app/module/contacts",
          childicon: "solar:station-bold-duotone",
          name:"contacts"
        },
        {
          childtitle: "Agencies",
          childlink: "/app/module/agencies",
          childicon: "solar:station-bold-duotone",
          name:"agencies"
        },
        {
          childtitle: "Responder",
          childlink: "/app/module/responders",
          childicon: "solar:station-bold-duotone",
          name:"responders"
        },
      ]
    },
    {
      title:"Monitoring",
      icon: "heroicons:computer-desktop",
      link: "#",
      name:"monitoring",
      child:[
        {
          childtitle: "Incident map",
          childlink: "/map/incident_map",
          childicon: "solar:station-bold-duotone",
          name:"incident map"
        },
      ]
    },
    {
      title:"Settings",
      icon: "fluent:settings-32-regular",
      link: "#",
      name:"monitoring",
      child:[
        {
          childtitle: "Users",
          childlink: "/app/module/users",
          childicon: "solar:station-bold-duotone",
          name:"users"
        },
      ]
    }
 
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