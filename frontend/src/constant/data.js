import userImg from "@/assets/images/all-img/user.png";
import user2Img from "@/assets/images/all-img/user2.png";
import user3Img from "@/assets/images/all-img/user3.png";
import user4Img from "@/assets/images/all-img/user4.png";

export const menuItems = [
  {
    isHeadr: true,
    title: "menu",
  },

  {
    title: "Dashboard",
    icon: "heroicons-outline:home", 
  },
  
  {
    title: "changelog",
    icon: "heroicons:arrow-trending-up",
    link: "changelog",
    badge: "2.0.1",
  },
  {
    isHeadr: true,
    title: "apps",
  },

  {
    title: "Chat",
    icon: "heroicons-outline:chat",
    link: "chat",
  },

  {
    title: "Email",
    icon: "heroicons-outline:mail",
    link: "email",
  },

  {
    title: "Kanban",
    icon: "heroicons-outline:view-boards",
    link: "kanban",
  },
  {
    title: "Calender",
    icon: "heroicons-outline:calendar",
    link: "calender",
  },

  {
    title: "Todo",
    icon: "heroicons-outline:clipboard-check",
    link: "todo",
  },

  {
    title: "Projects",
    icon: "heroicons-outline:document",
    link: "#",
    child: [
      {
        childtitle: "Projects",
        childlink: "projects",
      },
      {
        childtitle: "Project Details",
        childlink: "project-details",
      },
    ],
  },
  {
    isHeadr: true,
    title: "Pages",
  },
  {
    title: "Authentication",
    icon: "heroicons-outline:lock-closed",
    link: "#",
    child: [
      {
        childtitle: "Signin One",
        childlink: "/",
      },
      {
        childtitle: "Signin Two",
        childlink: "/login2",
      },
      {
        childtitle: "Signin Three",
        childlink: "/login3",
      },
      {
        childtitle: "Signup One",
        childlink: "/register",
      },
      {
        childtitle: "Signup Two",
        childlink: "/register2",
      },
      {
        childtitle: "Signup Three",
        childlink: "/register3",
      },
      {
        childtitle: "Forget Password One",
        childlink: "/forgot-password",
      },
      {
        childtitle: "Forget Password Two",
        childlink: "/forgot-password2",
      },
      {
        childtitle: "Forget Password Three",
        childlink: "/forgot-password3",
      },
      {
        childtitle: "Lock Screen One",
        childlink: "/lock-screen",
      },
      {
        childtitle: "Lock Screen Two",
        childlink: "/lock-screen2",
      },
      {
        childtitle: "Lock Screen Three",
        childlink: "/lock-screen3",
      },
    ],
  },
  {
    title: "Utility",
    icon: "heroicons-outline:view-boards",
    link: "#",
    child: [
      {
        childtitle: "Invoice",
        childlink: "invoice",
      },
      {
        childtitle: "Pricing",
        childlink: "pricing",
      },
      {
        childtitle: "Testimonial",
        childlink: "testimonial",
      },
      {
        childtitle: "FAQ",
        childlink: "faq",
      },
      {
        childtitle: "Blog",
        childlink: "blog",
      },

      {
        childtitle: "Blank Page",
        childlink: "blank-page",
      },
      {
        childtitle: "Profile",
        childlink: "profile",
      },
      {
        childtitle: "Settings",
        childlink: "settings",
      },
      {
        childtitle: "404 page",
        childlink: "/404",
      },
      {
        childtitle: "Coming Soon",
        childlink: "/coming-soon",
      },
      {
        childtitle: "Under Maintanance page",
        childlink: "/under-construction",
      },
    ],
  },

  {
    isHeadr: true,
    title: "Elements",
  },
  {
    title: "Widgets",
    icon: "heroicons-outline:view-grid-add",
    link: "#",
    child: [
      {
        childtitle: "Basic",
        childlink: "basic",
      },
      {
        childtitle: "Statistic",
        childlink: "statistic",
      },
    ],
  },
  {
    title: "Components",
    icon: "heroicons-outline:collection",
    link: "#",
    child: [
      {
        childtitle: "Typography",
        childlink: "typography",
      },
      {
        childtitle: "Colors",
        childlink: "colors",
      },
      {
        childtitle: "Alert",
        childlink: "alert",
      },
      {
        childtitle: "Button",
        childlink: "button",
      },
      {
        childtitle: "Card",
        childlink: "/app/card",
      },
      {
        childtitle: "Carousel",
        childlink: "carousel",
      },
      {
        childtitle: "Dropdown",
        childlink: "dropdown",
      },
      {
        childtitle: "Image",
        childlink: "image",
      },
      {
        childtitle: "Modal",
        childlink: "modal",
      },
      {
        childtitle: "Progress bar",
        childlink: "progress-bar",
      },
      {
        childtitle: "Placeholder",
        childlink: "placeholder",
      },
      {
        childtitle: "Tab & Accordion",
        childlink: "tab-accordion",
      },
      {
        childtitle: "Badge",
        childlink: "badges",
      },
      {
        childtitle: "Pagination",
        childlink: "Pagination",
      },
      {
        childtitle: "Video",
        childlink: "video",
      },
      {
        childtitle: "Tooltip & Popover",
        childlink: "tooltip-popover",
      },
    ],
  },
  {
    title: "Forms",
    icon: "heroicons-outline:clipboard-list",
    link: "#",
    child: [
      {
        childtitle: "Input",
        childlink: "input",
      },
      {
        childtitle: "Input group",
        childlink: "input-group",
      },
      {
        childtitle: "Input layout",
        childlink: "input-layout",
      },
      {
        childtitle: "Form validation",
        childlink: "form-validation",
      },
      {
        childtitle: "Wizard",
        childlink: "form-wizard",
      },
      {
        childtitle: "Input mask",
        childlink: "input-mask",
      },
      {
        childtitle: "File input",
        childlink: "file-input",
      },
      {
        childtitle: "Form repeater",
        childlink: "form-repeater",
      },
      {
        childtitle: "Textarea",
        childlink: "textarea",
      },
      {
        childtitle: "Checkbox",
        childlink: "checkbox",
      },
      {
        childtitle: "Radio button",
        childlink: "radio-button",
      },
      {
        childtitle: "Switch",
        childlink: "switch",
      },
      {
        childtitle: "Select & Vue select",
        childlink: "select",
      },
      {
        childtitle: "Date time picker",
        childlink: "date-time-picker",
      },
    ],
  },
  {
    title: "Tables",
    icon: "heroicons-outline:table",
    link: "#",
    child: [
      {
        childtitle: "Basic Table",
        childlink: "table-basic",
      },
      {
        childtitle: "Advanced table",
        childlink: "table-advanced",
      },
    ],
  },
  {
    title: "Chart",
    icon: "heroicons-outline:chart-bar",
    link: "#",
    child: [
      {
        childtitle: "Apex chart",
        childlink: "appex-chart",
      },
      {
        childtitle: "Chart js",
        childlink: "chartjs",
      },
    ],
  },
  {
    title: "Map",
    icon: "heroicons-outline:map",
    link: "map",
  },

  {
    title: "Icons",
    icon: "heroicons-outline:emoji-happy",
    link: "icons",
  },
];

// menuseetins

export const ProfileMenu = [
  {
    label: "Profile",
    icon: "heroicons-outline:user",
    link: "#",
  }, 
  {
    label: "Logout",
    icon: "heroicons-outline:login",
    link: "/",
  },
];

export const notifications = [
  {
    title: "Alert1",
    desc: "Amet minim mollit non deser unt ullamco est sit aliqua.",
    icon: "line-md:alert-twotone",
    link: "#",
  }, 
];

export const message = [
  {
    title: "Wade Warren",
    desc: "Hi! How are you doing?.....",
    active: true,
    hasnotifaction: true,
    notification_count: 1,
    image: userImg,
    link: "#",
  },
  {
    title: "Savannah Nguyen",
    desc: "Hi! How are you doing?.....",
    active: false,
    hasnotifaction: false,
    image: user2Img,
    link: "#",
  },
  {
    title: "Ralph Edwards",
    desc: "Hi! How are you doing?.....",
    active: false,
    hasnotifaction: true,
    notification_count: 8,
    image: user3Img,
    link: "#",
  },
  {
    title: "Cody Fisher",
    desc: "Hi! How are you doing?.....",
    active: true,
    hasnotifaction: false,
    image: user4Img,
    link: "#",
  },
  {
    title: "Savannah Nguyen",
    desc: "Hi! How are you doing?.....",
    active: false,
    hasnotifaction: false,
    image: user2Img,
    link: "#",
  },
  {
    title: "Ralph Edwards",
    desc: "Hi! How are you doing?.....",
    active: false,
    hasnotifaction: true,
    notification_count: 8,
    image: user3Img,
    link: "#",
  },
  {
    title: "Cody Fisher",
    desc: "Hi! How are you doing?.....",
    active: true,
    hasnotifaction: false,
    image: user4Img,
    link: "#",
  },
];

export const topMenu = [
  {
    isHeadr: true,
    title: "DASHBOARD",
  },
  {
    title: "Dashboard",
    icon: "carbon:dashboard",
    link: "/app/dashboard", 
  },
  {
    title: "Warning",
    icon: "ph:warning-light",
    link: "/app/warning", 
  },
  {
    title: "Database",
    icon: "healthicons:database-outline",
    link: "/app/database", 
  },
  {
    title: "Sensors",
    icon: "ri:sensor-line",
    link: "/app/sensors", 
  },
  {
    title: "Monitoring",
    icon: "eos-icons:monitoring",
    link: "/app/monitoring", 
  }, 
  {
    title: "Mairtenance",
    icon: "fluent:settings-32-regular",
    link: "#",
    child: [
      {
        childtitle: "Stations",
        childlink: "stations",
        childicon: "solar:station-bold-duotone"
      },
      {
        childtitle: "Warnings",
        childlink: "warnings",
        childicon: "ph:warning-diamond"
      },
      {
        childtitle: "Notification Content",
        childlink: "notification_content",
        childicon: "solar:notification-unread-lines-broken"
      },
      {
        childtitle: "Recipients",
        childlink: "recipients",
        childicon: "material-symbols:person-check-outline"
      },
      {
        childtitle: "Users",
        childlink: "users",
        childicon: "la:users-cog"
      },
    ],
  },
];

export const alertType = [
  {
    type: "dark",
  },
  {
    type: "primary",
  },

  {
    type: "secondary",
  },
  {
    type: "success",
  },
  {
    type: "info",
  },
  {
    type: "danger",
  },
  {
    type: "warning",
  },
];

export const alertType2 = [
  {
    type: "dark-light",
  },
  {
    type: "primary-light",
  },

  {
    type: "secondary-light",
  },
  {
    type: "success-light",
  },
  {
    type: "info-light",
  },
  {
    type: "danger-light",
  },
  {
    type: "warning-light",
  },
];

export const alertType3 = [
  {
    type: "dark",
    icon: "fluent:target-20-regular",
  },
  {
    type: "primary",
    icon: "fluent:target-20-regular",
  },

  {
    type: "secondary",
    icon: "heroicons-outline:support",
  },
  {
    type: "success",
    icon: "akar-icons:double-check",
  },
  {
    type: "t-info",
    icon: "heroicons-outline:information-circle",
  },
  {
    type: "danger",
    icon: "heroicons-outline:exclamation",
  },
  {
    type: "warning",
    icon: "heroicons-outline:ban",
  },
];
export const alertType4 = [
  {
    type: "dark-light",
    icon: "fluent:target-20-regular",
  },
  {
    type: "primary-light",
    icon: "fluent:target-20-regular",
  },

  {
    type: "secondary-light",
    icon: "heroicons-outline:support",
  },
  {
    type: "success-light",
    icon: "akar-icons:double-check",
  },
  {
    type: "info-light",
    icon: "heroicons-outline:information-circle",
  },
  {
    type: "danger-light",
    icon: "heroicons-outline:exclamation",
  },
  {
    type: "warning-light",
    icon: "heroicons-outline:ban",
  },
];
export const alertType5 = [
  {
    type: "dark-outline",
  },
  {
    type: "primary-outline",
  },

  {
    type: "secondary-outline",
  },
  {
    type: "success-outline",
  },
  {
    type: "info-outline",
  },
  {
    type: "danger-outline",
  },
  {
    type: "warning-outline",
  },
];
export const alertType6 = [
  {
    type: "dark-outline",
    icon: "fluent:target-20-regular",
  },
  {
    type: "primary-outline",
    icon: "fluent:target-20-regular",
  },

  {
    type: "secondary-outline",
    icon: "heroicons-outline:support",
  },
  {
    type: "success-outline",
    icon: "akar-icons:double-check",
  },
  {
    type: "info-outline",
    icon: "heroicons-outline:information-circle",
  },
  {
    type: "danger-outline",
    icon: "heroicons-outline:exclamation",
  },
  {
    type: "warning-outline",
    icon: "heroicons-outline:ban",
  },
];

export const trackingParcel = [
  {
    title: "Project start date",
    desc: "This parcel is paid for by the customer. Please contact the customer for any further information.",
    date: "Sep 20, 2021 ",
    time: "12:32 AM",
    status: "ok",
  },
  {
    title: "Project start date",
    date: "Sep 20, 2021 ",
    desc: "This parcel is paid for by the customer. Please contact the customer for any further information.",
    time: "12:32 AM",
    status: "ok",
  },
  {
    title: "Project start date",
    date: "Sep 20, 2021 ",
    desc: "This parcel is paid for by the customer. Please contact the customer for any further information.",
    time: "12:32 AM",
    status: "ok",
  },
  {
    title: "Project start date",
    date: "Sep 20, 2021 ",
    desc: "This parcel is paid for by the customer. Please contact the customer for any further information.",
    time: "12:32 AM",
  },
  {
    title: "Project start date",
    date: "Sep 20, 2021 ",
    desc: "This parcel is paid for by the customer. Please contact the customer for any further information.",
    time: "12:32 AM",
  },
  {
    title: "Project start date",
    date: "Sep 20, 2021 ",
    desc: "This parcel is paid for by the customer. Please contact the customer for any further information.",
    time: "12:32 AM",
  },
  {
    title: "Project start date",
    date: "Sep 20, 2021 ",
    desc: "This parcel is paid for by the customer. Please contact the customer for any further information.",
    time: "12:32 AM",
  },
];

export const TodoList = [
  {
    id: 1,
    image: userImg,
    title: "Amet minim mollit non deserunt ullam.",
    isDone: false,
  },
  {
    id: 2,
    image: user2Img,
    title: "Amet minim mollit non deserunt ullam.",
    isDone: false,
  },
  {
    id: 3,
    image: user3Img,
    title: "Amet minim mollit non deserunt ullam.",
    isDone: false,
  },
  {
    id: 4,
    image: user4Img,
    title: "Amet minim mollit non deserunt ullam.",
    isDone: false,
  },
  {
    id: 5,
    image: user2Img,
    title: "Amet minim mollit non deserunt ullam.",
    isDone: false,
  },
  {
    id: 6,
    image: user3Img,
    title: "Amet minim mollit non deserunt ullam.",
    isDone: false,
  },
];

//  todo fillter
export const fillters = [
  {
    value: "all",
    name: "My Task",
    icon: "uil:image-v",
  },
  {
    value: "fav",
    name: "Starred",
    icon: "heroicons:star",
  },
  {
    value: "done",
    name: "Completed",
    icon: "heroicons:document-check",
  },
  {
    value: "trash",
    name: "Trash",
    icon: "heroicons:trash",
  },
  {
    name: "Team",
    icon: "heroicons:users",
    value: "team",
  },
  {
    name: "low",
    icon: "heroicons:flag",
    value: "low",
  },
  {
    name: "medium",
    icon: "heroicons:flag",
    value: "medium",
  },
  {
    name: "high",
    icon: "heroicons:flag",
    value: "high",
  },
  {
    name: "update",
    icon: "heroicons:refresh",
    value: "update",
  },
];

export const editCatagory = [
  {
    value: "team",
    label: "team",
  },
  {
    value: "low",
    label: "low",
  },
  {
    value: "medium",
    label: "medium",
  },
  {
    value: "high",
    label: "high",
  },
];

export const projectCatagory = [
  {
    value: "team",
    label: "team",
  },
  {
    value: "low",
    label: "low",
  },
  {
    value: "medium",
    label: "medium",
  },
  {
    value: "high",
    label: "high",
  },
];

import avatar1 from "@/assets/images/avatar/av-1.svg";
import avatar2 from "@/assets/images/avatar/av-2.svg";
import avatar3 from "@/assets/images/avatar/av-3.svg";
import avatar4 from "@/assets/images/avatar/av-4.svg";
import avatar5 from "@/assets/images/avatar/av-5.svg";
import avatar6 from "@/assets/images/avatar/av-6.svg";
export const assignOption = [
  {
    title: "Mahedi Amin",
    image: avatar1,
  },
  {
    title: "Sovo Haldar",
    image: avatar2,
  },
  {
    title: "Rakibul Islam",
    image: avatar3,
  },
  {
    title: "Moni Haldar",
    image: avatar4,
  },
  {
    title: "Pritom Miha",
    image: avatar5,
  },
  {
    title: "Simanta Kika",
    image: avatar6,
  },
];
