export const topMenu = [
    {
      isHeadr: true,
      title: "Menu",
    },
    {
      title: "Dashboard",
      icon: "carbon:dashboard",
      link: "/app/dashboard", 
      name : "dashboard"
    },
    {
      title: "Warning",
      icon: "ph:warning-light",
      link: "/app/warning", 
      name: "warning"
    },
    {
      title: "Historical",
      icon: "healthicons:database-outline",
      link: "/app/historical",
      name:"database" 
    },
    {
      title: "Monitoring",
      icon: "eos-icons:monitoring",
      link: "/app/monitoring", 
      name:"monitoring"
    }, 
    {
      title: "Sensors",
      icon: "ri:sensor-line",
      link: "/app/sensors", 
      name:"sensor"
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