import{S as o,U as r}from"./index-703ff788.js";import{u as n}from"./module-ee2e983e.js";n();o();const h=r("system",{state:()=>({loading:!1,current_page:1,last_page:0,is_last_page:!1,notification_current_page:1,logs:[],notifications:[],login_history:{logs:[],current:1,total:0,perpage:0,last:!1}}),getters:{},actions:{async login_history_logs(){try{this.loading=!0;const t=(await this.axios.get("system/login_history?page="+this.login_history.current)).data;this.login_history.logs=t.data,this.login_history.current=t.meta.current_page,this.login_history.total=t.meta.total,this.login_history.perpage=t.meta.per_page,t.meta.total>=t.meta.current_page&&(this.login_history.last=!0),this.loading=!1}catch{}},async activity_logs(a,t){try{this.loading=!0;const s=await this.axios.get("activity_logs/"+a+"/"+t+"?page="+this.current_page);this.logs.push(...s.data.data),this.last_page=s.data.meta.last_page,this.current_page<this.last_page?this.is_last_page=!1:this.is_last_page=!0,this.loading=!1}catch{}},async notification(){try{this.loading=!0;const a=await this.axios.get("module/notification/get?page="+this.notification_current_page);this.notifications=a.data.data,this.loading=!1}catch{}},async notification_read(a,t,s,i){if(i==1){const e=await this.axios.get("module/notification/read/"+a);this.notifications=e.data.data}this.router.push({name:"view",params:{module:s,id:t,action:"detail"}})}},persist:!0});export{h as u};
