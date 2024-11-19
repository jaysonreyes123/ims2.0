export const topMenu = [
    {
      isHeadr: true,
      title: "menu",
    },
    {
      title: "Dashboard",
      icon: "carbon:dashboard",
      link: "/app/dashboard", 
      name : "dashboard"
    },
    {
      title: "Incident",
      icon: "carbon:dashboard",
      link: "/app/incidents", 
      name : "incidents"
    },
 
    {
      title: "Maintenance",
      icon: "fluent:settings-32-regular",
      link: "#",
      child: [
        {
          childtitle: "Stations",
          childlink: "stations",
          childicon: "solar:station-bold-duotone",
          name:"station"
        },
        {
          childtitle: "Warnings",
          childlink: "warnings",
          childicon: "ph:warning-diamond",
          name:"maintenance_warning"
        },
        {
          childtitle: "Notification Content",
          childlink: "notification_content",
          childicon: "solar:notification-unread-lines-broken",
          name:"notification"
        },
        {
          childtitle: "Recipients",
          childlink: "recipients",
          childicon: "material-symbols:person-check-outline",
          name: "recipient"
        },
        {
          childtitle: "Users",
          childlink: "users",
          childicon: "la:users-cog",
          name: "user"
        },
        {
          childtitle: "User Role",
          childlink: "role",
          childicon: "la:users-cog",
          name : "user_role"
        },
        {
          childtitle: "Email Templete",
          childlink: "email-template",
          childicon: "la:envelope",
          name : "email_template"
        },
        {
          childtitle: "System",
          childlink: "system",
          childicon: "la:cog",
          name : "system"
        },
      ],
    },
  ];