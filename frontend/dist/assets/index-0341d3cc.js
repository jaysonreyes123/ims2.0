import{I as g}from"./index-96abb035.js";import{_ as h,a as t,b as i,C as k,w as a,d as o,c as r,g as c,f as l,n as d,t as p,Q as u}from"./index-703ff788.js";import{b as w,o as C,N as B,_ as F}from"./transition-a22e345f.js";const D={components:{Icon:g,TransitionRoot:w,TransitionChild:C,Dialog:B,DialogPanel:F},props:{centered:{type:Boolean,default:!1},title:{type:String,default:"Basic Modal"},label:{type:String,default:"Basic Modal"},disableBackdrop:{type:Boolean,default:!1},noFade:{type:Boolean,default:!1},themeClass:{type:String,default:"bg-slate-900 dark:bg-slate-800 dark:border-b dark:border-slate-700"},sizeClass:{type:String,default:"max-w-xl"},scrollContent:{type:Boolean,default:!1},activeModal:{type:Boolean,default:!1}},setup(n,{emit:s}){return{close:()=>{s("close")}}}},M={key:0,class:"fixed inset-0 bg-slate-900/50 backdrop-filter backdrop-blur-sm"},S={class:"fixed inset-0 overflow-y-auto"},T={key:0,class:"capitalize leading-6 tracking-wider font-medium text-base text-white"},z={key:0,class:"px-4 py-3 flex justify-end space-x-3 border-t border-slate-100 dark:border-slate-700"};function N(n,s,e,f,I,j){const m=t("TransitionChild"),y=t("Icon"),_=t("DialogPanel"),v=t("Dialog"),x=t("TransitionRoot");return i(),k(x,{show:e.activeModal,as:"template"},{default:a(()=>[o(v,{as:"div",class:"relative z-[999]"},{default:a(()=>[o(m,{enter:e.noFade?"":"duration-300 ease-out","enter-from":e.noFade?"":"opacity-0","enter-to":e.noFade?"":"opacity-100",leave:e.noFade?"":"duration-200 ease-in","leave-from":e.noFade?"":"opacity-100","leave-to":e.noFade?"":"opacity-0"},{default:a(()=>[e.disableBackdrop===!1?(i(),r("div",M)):c("",!0)]),_:1},8,["enter","enter-from","enter-to","leave","leave-from","leave-to"]),l("div",S,[l("div",{class:d(["flex min-h-full justify-center text-center p-6",e.centered?"items-center":"items-start "])},[o(m,{as:"template",enter:e.noFade?"":"duration-300  ease-out","enter-from":e.noFade?"":"opacity-0 scale-95","enter-to":e.noFade?"":"opacity-100 scale-100",leave:e.noFade?"":"duration-200 ease-in","leave-from":e.noFade?"":"opacity-100 scale-100","leave-to":e.noFade?"":"opacity-0 scale-95"},{default:a(()=>[o(_,{class:d(["w-full transform rounded-md bg-white dark:bg-slate-800 text-left align-middle shadow-xl transition-all",e.sizeClass])},{default:a(()=>[l("div",{class:d(["relative overflow-hidden py-4 px-5 text-white flex justify-between",e.themeClass])},[e.title?(i(),r("h2",T,p(e.title),1)):c("",!0),l("button",{onClick:s[0]||(s[0]=(...b)=>f.close&&f.close(...b)),class:"text-[22px]"},[o(y,{icon:"heroicons-outline:x"})])],2),l("div",{class:d(["px-6 py-8",e.scrollContent?"overflow-y-auto max-h-[400px]":""])},[u(n.$slots,"default")],2),n.$slots.footer?(i(),r("div",z,[u(n.$slots,"footer")])):c("",!0)]),_:3},8,["class"])]),_:3},8,["enter","enter-from","enter-to","leave","leave-from","leave-to"])],2)])]),_:3})]),_:3},8,["show"])}const E=h(D,[["render",N]]);export{E as M};
