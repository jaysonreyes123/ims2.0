import{C as c}from"./index-de911cd9.js";import{u as m}from"./report-4c7cd817.js";import{_}from"./BAYAN911-cab0d33c.js";import{_ as u,c as f,d as r,j as g,f as l,t as b,w as x,a as s,b as w}from"./index-703ff788.js";import"./dropdown-c7aa31e0.js";const o=m(),y={components:{Card:c},data(){return{report:o}},mounted(){o.id=this.$route.params.id,o.get_report_column(),o.get_single_data(),this.$watch(()=>o.loading,n=>{n==!1&&setTimeout(()=>{window.print()},500)})}},v={class:"text-center font-bold capitalize text-4xl"};function C(n,t,S,h,e,k){const a=s("Loading"),i=s("vue-good-table"),p=s("Card");return w(),f("div",null,[r(a,{active:e.report.loading,"onUpdate:active":t[0]||(t[0]=d=>e.report.loading=d)},null,8,["active"]),t[1]||(t[1]=g('<table class="w-full"><tr><td style="text-align:left;"><img src="'+_+'" style="width:200px;display:block;"></td><td style="text-align:left;"><span style="font-weight:bold;font-size:25px;"> Incident Management System </span></td></tr></table><br><hr><br>',4)),l("p",v,b(e.report.form.report_name),1),t[2]||(t[2]=l("br",null,null,-1)),r(p,{bodyClass:"p-0"},{default:x(()=>[r(i,{columns:e.report.columns,rows:e.report.generate_report_list,styleClass:" vgt-table bordered","sort-options":{enabled:!1}},null,8,["columns","rows"])]),_:1})])}const j=u(y,[["render",C]]);export{j as default};
