import{u}from"./module-ee2e983e.js";import{_ as m}from"./BAYAN911-cab0d33c.js";import{_ as p,c as a,d as f,j as _,f as t,t as n,a as g,b}from"./index-703ff788.js";import"./dropdown-c7aa31e0.js";import"./sweetalert2.all-43cb5b43.js";import"./list-108db02a.js";const T="/assets/navy-e35ca07a.png";const r=u(),y={data(){return{header_logo:T,module_store:r}},mounted(){r.get(this.$route.params.id),this.$watch(()=>r.loading,o=>{o==!1&&setTimeout(()=>{this.print()},500)})},watch:{loading(o){console.log("Test")}},methods:{print(){window.print()}},computed:{current_datetime(){return new Date().toLocaleString()}}},N={style:{width:"100%"},class:"reportdata"},E={style:{width:"100%"}},x={style:{"text-align":"right"}};function v(o,l,w,D,e,s){const i=g("Loading");return b(),a("div",null,[f(i,{active:e.module_store.loading,"onUpdate:active":l[0]||(l[0]=d=>e.module_store.loading=d)},null,8,["active"]),l[12]||(l[12]=_('<table class="w-full"><tr><td style="text-align:left;"><img src="'+m+'" style="width:200px;display:block;"></td><td style="text-align:left;"><span style="font-weight:bold;font-size:25px;"> Incident Management System </span></td></tr></table><br><div style="border-top:3px solid #032e61;"></div><h2 style="text-align:center;font-weight:bold;font-size:20px;margin-bottom:10px;margin-top:10px;">INCIDENT REPORT</h2>',4)),t("div",null,[t("table",N,[t("tr",null,[l[1]||(l[1]=t("td",null,[t("b",null,"INCIDENT NO:")],-1)),t("td",null,n(e.module_store.form.incident_no),1)]),t("tr",null,[l[2]||(l[2]=t("td",null,[t("b",null,"INCIDENT TYPE:")],-1)),t("td",null,n(e.module_store.form.incident_types),1)]),t("tr",null,[l[3]||(l[3]=t("td",null,[t("b",null,"LOCATION:")],-1)),t("td",null,n(e.module_store.form.street_name),1)]),t("tr",null,[l[4]||(l[4]=t("td",null,[t("b",null,"NEAREST LANDMARK:")],-1)),t("td",null,n(e.module_store.form.nearest_landmark),1)]),t("tr",null,[l[5]||(l[5]=t("td",null,[t("b",null,"CONTACT NO:")],-1)),t("td",null,n(e.module_store.form.caller_contact),1)]),t("tr",null,[l[6]||(l[6]=t("td",null,[t("b",null,"DATE AND TIME:")],-1)),t("td",null,n(e.module_store.form.date_of_incident)+" "+n(e.module_store.form.time_of_incident),1)]),t("tr",null,[l[7]||(l[7]=t("td",null,[t("b",null,"RELAYED TO:")],-1)),t("td",null,n(e.module_store.form.response_team),1)]),t("tr",null,[l[8]||(l[8]=t("td",null,[t("b",null,"STATUS:")],-1)),t("td",null,n(e.module_store.form.incident_statuses),1)])]),l[10]||(l[10]=t("br",null,null,-1)),l[11]||(l[11]=t("br",null,null,-1)),t("table",E,[t("tr",null,[l[9]||(l[9]=t("td",{style:{"text-align":"left"}},"PREPARED BY:",-1)),t("td",x,"DATE PRINTED: "+n(s.current_datetime),1)])])])])}const L=p(y,[["render",v]]);export{L as default};
