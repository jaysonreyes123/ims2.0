import{u as d}from"./incident-b2a094f0.js";import{_ as u}from"./BAYAN911-cab0d33c.js";import{_ as p,c as _,j as m,f as t,t as e,b as f}from"./index-a7d1dc36.js";const b="/assets/navy-e35ca07a.png";const a=d(),g={data(){return{header_logo:b,incident_store:a}},mounted(){setTimeout(()=>{this.print()},500)},methods:{print(){window.print()},get_label(i,n){const r=i.find(l=>l.id==n);let s="";return r!==void 0&&(s=r.label),s}},computed:{current_datetime(){return new Date().toLocaleString()}}},y={style:{width:"100%"},class:"reportdata"},T={style:{width:"100%"}},E={style:{"text-align":"right"}};function N(i,n,r,s,l,o){return f(),_("div",null,[n[11]||(n[11]=m('<table class="w-full"><tr><td style="text-align:left;"><img src="'+u+'" style="width:200px;display:block;"></td><td style="text-align:left;"><span style="font-weight:bold;font-size:25px;"> Incident Management System </span></td></tr></table><br><div style="border-top:3px solid #032e61;"></div><h2 style="text-align:center;font-weight:bold;font-size:20px;margin-bottom:10px;margin-top:10px;">INCIDENT REPORT</h2>',4)),t("div",null,[t("table",y,[t("tr",null,[n[0]||(n[0]=t("td",null,[t("b",null,"INCIDENT NO:")],-1)),t("td",null,e(l.incident_store.form.incident_no),1)]),t("tr",null,[n[1]||(n[1]=t("td",null,[t("b",null,"INCIDENT TYPE:")],-1)),t("td",null,e(o.get_label(l.incident_store.incident_types_picklist,l.incident_store.form.incident_types_picklist)),1)]),t("tr",null,[n[2]||(n[2]=t("td",null,[t("b",null,"LOCATION:")],-1)),t("td",null,e(l.incident_store.form.street_name),1)]),t("tr",null,[n[3]||(n[3]=t("td",null,[t("b",null,"NEAREST LANDMARK:")],-1)),t("td",null,e(l.incident_store.form.nearest_landmark),1)]),t("tr",null,[n[4]||(n[4]=t("td",null,[t("b",null,"CONTACT NO:")],-1)),t("td",null,e(l.incident_store.form.caller_contact),1)]),t("tr",null,[n[5]||(n[5]=t("td",null,[t("b",null,"DATE AND TIME:")],-1)),t("td",null,e(l.incident_store.form.date_of_incident)+" "+e(l.incident_store.form.time_of_incident),1)]),t("tr",null,[n[6]||(n[6]=t("td",null,[t("b",null,"RELAYED TO:")],-1)),t("td",null,e(l.incident_store.form.response_team),1)]),t("tr",null,[n[7]||(n[7]=t("td",null,[t("b",null,"STATUS:")],-1)),t("td",null,e(o.get_label(l.incident_store.incident_statuses_picklist,l.incident_store.form.incident_statuses_picklist)),1)])]),n[9]||(n[9]=t("br",null,null,-1)),n[10]||(n[10]=t("br",null,null,-1)),t("table",T,[t("tr",null,[n[8]||(n[8]=t("td",{style:{"text-align":"left"}},"PREPARED BY:",-1)),t("td",E,"DATE PRINTED: "+e(o.current_datetime),1)])])])])}const A=p(g,[["render",N]]);export{A as default};
