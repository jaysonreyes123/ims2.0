import{I as h}from"./index-1a133b7f.js";import{C as b}from"./vue-cleave.min-776623f5.js";import{_ as k,a as m,b as t,c as l,n,t as d,g as a,f,C as r,d as x}from"./index-a7d1dc36.js";const v={components:{Icon:h,Cleave:b},props:{placeholder:{type:String,default:"Search"},maxlength:{type:String},label:{type:String},classLabel:{type:String,default:" "},classInput:{type:String,default:"classinput"},type:{type:String,default:"text"},name:{type:String},modelValue:{type:String,default:""},error:{type:String},hasicon:{type:Boolean,default:!1},isReadonly:{type:Boolean,default:!1},disabled:{type:Boolean,default:!1},horizontal:{type:Boolean,default:!1},validate:{type:String},msgTooltip:{type:Boolean,default:!1},description:{type:String},isMask:{type:Boolean,default:!1},options:{type:Object,default:()=>({creditCard:!0,delimiter:"-"})}},data(){return{types:this.type}},methods:{toggleType(){this.types=this.types==="text"?"password":"text"}}},_=["for"],p=["maxlength","type","name","placeholder","value","error","id","readonly","disabled","validate"],S={class:"flex text-xl absolute ltr:right-[14px] rtl:left-[14px] top-1/2 -translate-y-1/2"},B={key:1,class:"text-danger-500"},V={key:2,class:"text-success-500"},w={key:3,class:"block text-secondary-500 font-light leading-4 text-xs mt-2"};function I(c,o,e,C,u,y){const g=m("cleave"),s=m("Icon");return t(),l("div",{class:n(["fromGroup relative",`${e.error?"has-error":""}  ${e.horizontal?"flex":""}  ${e.validate?"is-valid":""} `])},[e.label?(t(),l("label",{key:0,class:n(`${e.classLabel} ${e.horizontal?"flex-0 mr-6 md:w-[100px] w-[60px] break-words":""}  ltr:inline-block rtl:block input-label `),for:e.name},d(e.label),11,_)):a("",!0),f("div",{class:n(["relative",e.horizontal?"flex-1":""])},[e.isMask?a("",!0):(t(),l("input",{key:0,maxlength:e.maxlength,step:".1",type:u.types,name:e.name,placeholder:e.placeholder,class:n(`${e.classInput} input-control w-full block focus:outline-none h-[40px] ${e.hasicon?"ltr:pr-10 rtl:pl-10":""} `),value:e.modelValue,onInput:o[0]||(o[0]=i=>c.$emit("update:modelValue",i.target.value)),error:e.error,id:e.name,readonly:e.isReadonly,disabled:e.disabled,validate:e.validate},null,42,p)),e.isMask?(t(),r(g,{key:1,class:n(`${e.classInput} cleave input-control block w-full focus:outline-none h-[40px] `),name:e.name,placeholder:e.placeholder,value:e.modelValue,onInput:o[1]||(o[1]=i=>c.$emit("update:modelValue",i.target.value)),error:e.error,id:e.name,readonly:e.isReadonly,disabled:e.disabled,validate:e.validate,options:e.options,modelValue:"modelValue"},null,8,["class","name","placeholder","value","error","id","readonly","disabled","validate","options"])):a("",!0),f("div",S,[e.hasicon?(t(),l("span",{key:0,onClick:o[2]||(o[2]=(...i)=>y.toggleType&&y.toggleType(...i)),class:"cursor-pointer text-secondary-500"},[u.types==="password"?(t(),r(s,{key:0,icon:"heroicons-outline:eye"})):(t(),r(s,{key:1,icon:"heroicons-outline:eye-off"}))])):a("",!0),e.error?(t(),l("span",B,[x(s,{icon:"heroicons-outline:information-circle"})])):a("",!0),e.validate?(t(),l("span",V,[x(s,{icon:"bi:check-lg"})])):a("",!0)])],2),e.error?(t(),l("span",{key:1,class:n(["mt-2",e.msgTooltip?" inline-block bg-danger-500 text-white text-[10px] px-2 py-1 rounded":" text-danger-500 block text-sm"])},d(e.error),3)):a("",!0),e.validate?(t(),l("span",{key:2,class:n(["mt-2",e.msgTooltip?" inline-block bg-success-500 text-white text-[10px] px-2 py-1 rounded":" text-success-500 block text-sm"])},d(e.validate),3)):a("",!0),e.description?(t(),l("span",w,d(e.description),1)):a("",!0)],2)}const N=k(v,[["render",I]]);export{N as T};
