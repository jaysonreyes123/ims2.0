import{C as B}from"./index-de911cd9.js";import{B as F}from"./index-a82eb94e.js";import{d as I,M as R}from"./menu-1c87f43f.js";import{u as T}from"./system-323fa053.js";import{_ as G,a as i,b as s,c as r,d as u,w as C,f as e,F as h,D as x,t as a,h as v,g as f,r as L,n as U,C as S,R as j}from"./index-703ff788.js";import{B as z}from"./index-3d0758cf.js";import{u as H}from"./module-ee2e983e.js";import{M as A}from"./edit_map-3cc67126.js";import{B as E}from"./Breadcrum-347cba3e.js";import{u as Y}from"./related-9d401967.js";import"./index-96abb035.js";import"./dropdown-c7aa31e0.js";import"./sweetalert2.all-43cb5b43.js";import"./list-108db02a.js";import"./mapbox-gl-6cf0b8b4.js";import"./index-3fa781ec.js";const d=T(),q={components:{Card:B,Button:F},data(){return{modules:this.$route.params.module,module_id:this.$route.params.id,SystemStore:d}},created(){},mounted(){d.loading=!1,d.is_last_page=!1,d.current_page=1,d.logs=[],d.activity_logs(this.modules,this.module_id)},methods:{scroll_paginate(){const l=window.scrollY+document.body.clientHeight,t=document.body.scrollHeight;l==t&&d.current_page<d.last_page&&(d.current_page++,d.activity_logs(this.modules,this.module_id))},load_more(){d.current_page++,d.activity_logs(this.modules,this.module_id)}},computed:{fields_computed(){let l;switch(this.$route.params.module){case"incidents":l=incidents_field;break;case"resources":l=resources_field;break;case"contacts":l=contacts_field;break;case"agencies":l=agency_fields;break}return l},fields(){const l=[];return this.fields_computed.map(t=>{t.fields.map(g=>{l[g.name]=g.label})}),l}}},J={class:"relative ltr:pl-2 rtl:pr-2"},K={class:"w-[250px] text-xs"},O={class:"text-sm font-medium dark:text-slate-400-900 mb-1 text-slate-600"},P={class:"font-bold text-sky-500"},Q={key:0},W={class:"text-xs text-slate-600"},X={class:"text-xs text-slate-600"},Z={class:"text-xs text-slate-600"},ee={key:1},te={class:"text-xs"},se={key:0,class:"w-full mt-4 flex justify-center"};function oe(l,t,g,M,o,y){const b=i("Button"),m=i("Card");return s(),r("div",null,[u(m,{title:"Updates",class:"mt-4"},{default:C(()=>[e("ul",J,[(s(!0),r(h,null,x(o.SystemStore.logs,(n,c)=>(s(),r("li",{key:c,class:"mt-5 flex"},[e("div",K,a(n.created_at),1),t[5]||(t[5]=e("div",{class:"w-[100px] ltr:border-l-2 rtl:border-r-2 border-slate-100 dark:border-slate-700 pb-4 last:border-none ltr:pl-[22px] rtl:pr-[22px] relative before:absolute ltr:before:left-[-8px] rtl:before:-right-2 before:top-[0px] before:rounded-full before:w-4 before:h-4 before:bg-slate-900 dark:before:bg-slate-600 before:leading-[2px] before:content-[url('@/assets/images/all-img/ck.svg')]"},null,-1)),e("div",null,[e("h2",O,[e("span",P,a(n.whodid),1),v(" - "+a(n.action),1)]),n.status==2?(s(),r("div",Q,[t[3]||(t[3]=e("p",{class:"text-xs dark:text-slate-400"},null,-1)),(s(!0),r(h,null,x(n.fields,_=>(s(),r("div",{key:_.id,class:"mb-2"},[e("p",W,[e("b",null,a(_.label),1),t[0]||(t[0]=v(" changed"))]),e("p",X,[t[1]||(t[1]=e("b",null,"From",-1)),v(": "+a(_.oldvalue),1)]),e("p",Z,[t[2]||(t[2]=e("b",null,"To",-1)),v(": "+a(_.newvalue),1)])]))),128))])):n.status==4||n.status==5?(s(),r("div",ee,[t[4]||(t[4]=e("p",{class:"text-xs dark:text-slate-400"},null,-1)),e("div",null,[e("p",te,[e("b",null,a(n.fields.module),1),v(" - "+a(n.fields.entityname),1)])])])):f("",!0)])]))),128))]),o.SystemStore.is_last_page?f("",!0):(s(),r("div",se,[u(b,{text:"load more",onClick:y.load_more,isLoading:o.SystemStore.loading,btnClass:"btn-sm btn-outline-white"},null,8,["onClick","isLoading"])]))]),_:1})])}const re=G(q,[["render",oe]]);const k=H(),V=L(""),D=L(""),le={name:"Summary",props:{props_id:{type:String,default:""},props_module:{type:String,default:""}},components:{Card:B,Map:A,Badge:z},data(){return{module_store:k}},created(){V.value=this.props_module==""?this.$route.params.module:this.props_module,D.value=this.props_id==""?this.$route.params.id:this.props_id},mounted(){k.module=V.value,k.get_edit_form(D.value,"summary")}},ae={key:0},ne={class:"lg:grid gap-x-12",style:{"grid-template-columns":"1fr 1fr"}},de={key:0,class:"fromGroup relative"},ie={key:1,class:"fromGroup relative"},ue={class:"lg:grid lg:grid-cols-2 gap-12 mt-4"},me={class:"fromGroup relative"},ce={class:"fromGroup relative"},_e={class:"lg:grid lg:grid-cols-2 gap-12"},pe={class:"fromGroup relative"},fe={class:"fromGroup relative"};function ge(l,t,g,M,o,y){const b=i("Loading"),m=i("Badge"),n=i("Card");return s(),r("div",null,[u(b,{active:o.module_store.loading,"onUpdate:active":t[0]||(t[0]=c=>o.module_store.loading=c)},null,8,["active"]),o.module_store.loading?f("",!0):(s(),r("div",ae,[(s(!0),r(h,null,x(o.module_store.blocks,(c,_)=>(s(),r("div",{key:_},[u(n,{title:c.block,class:"mt-4 shadow-sm"},{default:C(()=>[e("div",ne,[(s(!0),r(h,null,x(c.fields,(p,N)=>(s(),r("div",{key:N,class:U([`custom-grid-${N%2}`,"mt-4"])},[p.type=="checkbox"?(s(),r("div",de,[e("label",null,a(p.label),1),o.module_store.form[p.name]?(s(),S(m,{key:0,label:"Active",badgeClass:"bg-success-500 text-white"})):f("",!0),o.module_store.form[p.name]?f("",!0):(s(),S(m,{key:1,label:"Inactive",badgeClass:"bg-danger-500 text-white"}))])):(s(),r("div",ie,[e("label",null,a(p.label),1),e("span",null,a(o.module_store.form[p.name]),1)]))],2))),128))])]),_:2},1032,["title"])]))),128)),u(n,{title:"System Generated",class:"mt-4 shadow-sm"},{default:C(()=>[e("div",ue,[e("div",me,[t[1]||(t[1]=e("label",{for:""},"Created time",-1)),e("span",null,a(o.module_store.form.created_at),1)]),e("div",ce,[t[2]||(t[2]=e("label",{for:""},"Created By",-1)),e("span",null,a(o.module_store.form.created_by),1)])]),e("div",_e,[e("div",pe,[t[3]||(t[3]=e("label",{for:""},"Last updated",-1)),e("span",null,a(o.module_store.form.updated_at),1)]),e("div",fe,[t[4]||(t[4]=e("label",{for:""},"Last updated by",-1)),e("span",null,a(o.module_store.form.updated_by),1)])])]),_:1})]))])}const be=G(le,[["render",ge],["__scopeId","data-v-061d0183"]]),ve=H(),$=Y(),w=L(""),he={components:{Card:B,Button:F,Summary:be,detail:I,update:re,Breadcrum:E,Menu:R},created(){$.related_menu=[],ve.entityname="",this.$watch(()=>this.$route.params.action,l=>{w.value=l})},mounted(){w.value=this.$route.params.action,$.get_related_menu(this.$route.params.module)},data(){return{action_module:w,related_store:$}},methods:{}};function xe(l,t,g,M,o,y){const b=i("Breadcrum"),m=i("Menu");return s(),r("div",null,[u(b,{mode:"view"}),u(m),o.action_module!=""?(s(),S(j(o.action_module),{key:0})):f("",!0)])}const Re=G(he,[["render",xe]]);export{Re as default};
