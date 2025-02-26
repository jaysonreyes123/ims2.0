import{L as G}from"./save-9a6ba75c.js";import{B as M}from"./index-a82eb94e.js";import{I as j}from"./index-96abb035.js";import{I as q}from"./index-4dd669d9.js";import{T as D,C as E}from"./vue-select.es-b48464d0.js";import{T as O}from"./index-299ec2c2.js";import{C as A}from"./index-de911cd9.js";import{u as H}from"./dropdown-c7aa31e0.js";import{u as P}from"./report-4c7cd817.js";import{r as U,_ as L,a as u,b as n,C as m,w as y,d,f as o,c as p,D as T,n as k,t as x,F,h as _,g as v,i as Y}from"./index-703ff788.js";import{S as J}from"./sweetalert2.all-43cb5b43.js";const g=H(),s=P();U("");U([]);const K=[{label:"Equal",value:"="},{label:"Not Equal",value:"<>"}];let b=U(0),Q=[{id:1,title:"Report Details"},{id:2,title:"Filters"},{id:3,title:"Select Chart"}];const W=[{value:"pie",label:"Pie Chart"},{value:"vertical",label:"Vertical Bar Chart"},{value:"horizontal",label:"Horizontal Bar Chart"},{value:"line",label:"Line Chart"}],X=[{value:"count",label:"Record Count"}],Z={components:{Button:M,Icon:j,Textinput:O,InputGroup:q,Textarea:D,Card:A,Select:E},mounted(){this.clear2(),b.value=0,s.id=this.$route.params.id,s.form.type="chart",g.get_dropdown("modules"),s.module_list=g.dropdownlist.modules,s.id!=""&&s.id!==void 0&&s.get()},data(){return{steps:Q,stepNumber:b,dropdown_store:g,report:s,operator:K,chart_type:W,data_fields:X}},methods:{clear2(){s.loading=!1,s.form.report_name="",s.form.modules="",s.form.selected_column=[],s.relation_module=[],s.form.related_module=[],s.form.chart.type="",s.form.chart.dataset=[],s.form.chart.group_by="",s.form.filter=[{field:"",operator:"",type:"text",value:""}]},clear(){s.form.selected_column=[],s.form.related_module=[],s.form.filter=[{field:"",operator:"",type:"text",value:""}]},andRemoveCondition(i){s.form.filter.splice(i,1)},andCondition(){s.form.filter.push({field:"",operator:"",type:"text",value:""})},filter_and_select_option(i,t){s.form.filter[t].type=i.type,s.form.filter[t].operator="=",i.type=="dropdown"&&(g.dropdownlist_data=[],g.get_dropdown_list(i.value))},SelectModule(i){this.clear(),s.module=i.name,s.get_relation_module()},prev(){b.value--},submit(){let i="";const t=this.$route.params.type;if(b.value==0)s.form.report_name==""&&(i+="<p class='text-red-500'>Report name is required</p>"),s.form.modules==""&&(i+="<p class='text-red-500'>Module is required</p>"),i==""&&s.get_fields();else if(b.value==1)s.form.selected_column.length==0&&t=="list"&&(i="<p class='text-red-500'>Column is required</p>");else if(b.value===2)return s.save(),!1;if(i!="")return J.fire({icon:"error",title:"Something wrong",html:i}),!1;b.value++}}},$={class:"flex z-[5] items-center relative justify-center md:mx-8"},ee={key:0},te={key:1,class:"text-3xl"},oe={class:"w-max"},le={class:"conten-box mt-14 border-t border-slate-100 dark:border-slate-700 -mx-6 px-6 pt-6"},re={key:0,class:"px-5"},se={class:"grid lg:grid-cols-4 grid-cols-2"},ne={class:"grid lg:grid-cols-4 grid-cols-2"},ae={class:"grid lg:grid-cols-4 grid-cols-2"},ie={key:1,class:"px-5"},de={class:"col-start-1 col-span-3"},pe={key:0,class:"font-bold text-[18px] text-black"},ue={key:1,class:"text-[12px]"},me={class:"col-start-4 col-span-2"},ce={class:"col-start-6 col-span-3"},fe={class:"flex justify-center"},_e=["onClick"],be={key:2,class:"px-5"},xe={class:"fromGroup relative mt-5"},ve={class:"fromGroup relative mt-5"},ye={class:"fromGroup relative mt-5"},ge={key:0,class:"font-bold text-[18px] text-black"},he={key:1,class:"text-[12px]"};function ke(i,t,R,I,e,f){const V=u("Loading"),h=u("Icon"),C=u("Textinput"),c=u("Select"),z=u("Textarea"),N=u("flat-pickr"),w=u("Button"),S=u("Card");return n(),m(S,null,{default:y(()=>[d(V,{active:e.report.loading,"onUpdate:active":t[0]||(t[0]=r=>e.report.loading=r)},null,8,["active"]),o("div",$,[(n(!0),p(F,null,T(e.steps,(r,l)=>(n(),p("div",{class:"relative z-[1] items-center item flex flex-start flex-1 last:flex-none group",key:l},[o("div",{class:k([`   ${e.stepNumber>=l?"bg-slate-900 text-white ring-slate-900 ring-offset-2 dark:ring-offset-slate-500 dark:bg-slate-900 dark:ring-slate-900":"bg-white ring-slate-900 ring-opacity-70  text-slate-900 dark:text-slate-300 dark:bg-slate-600 dark:ring-slate-600 text-opacity-70"}`,"transition duration-150 icon-box md:h-12 md:w-12 h-7 w-7 rounded-full flex flex-col items-center justify-center relative z-[66] ring-1 md:text-lg text-base font-medium"])},[e.stepNumber<=l?(n(),p("span",ee,x(l+1),1)):(n(),p("span",te,[d(h,{icon:"bx:check-double"})]))],2),o("div",{class:k(["absolute top-1/2 h-[2px] w-full",e.stepNumber>=l?"bg-slate-900 dark:bg-slate-900":"bg-[#E0EAFF] dark:bg-slate-700"])},null,2),o("div",{class:k(["absolute top-full text-base md:leading-6 mt-3 transition duration-150 md:opacity-100 opacity-0 group-hover:opacity-100",e.stepNumber>=l?" text-slate-900 dark:text-slate-300":"text-slate-500 dark:text-slate-300 dark:text-opacity-40"])},[o("span",oe,x(r.title),1)],2)]))),128))]),o("div",le,[e.stepNumber===0?(n(),p("div",re,[t[11]||(t[11]=o("br",null,null,-1)),o("div",se,[t[8]||(t[8]=o("span",null,[_("Report Name"),o("span",{class:"text-red-500"},"*")],-1)),o("div",null,[d(C,{placeholder:"Report Name",modelValue:e.report.form.report_name,"onUpdate:modelValue":t[1]||(t[1]=r=>e.report.form.report_name=r)},null,8,["modelValue"])])]),t[12]||(t[12]=o("br",null,null,-1)),o("div",ne,[t[9]||(t[9]=o("span",null,[_("Module"),o("span",{class:"text-red-500"},"*")],-1)),o("div",null,[d(c,{placeholder:"Select an option",options:e.dropdown_store.dropdownlist.modules,modelValue:e.report.form.modules,"onUpdate:modelValue":t[2]||(t[2]=r=>e.report.form.modules=r),"onOption:selected":f.SelectModule,reduce:r=>r.name},null,8,["options","modelValue","onOption:selected","reduce"])])]),t[13]||(t[13]=o("br",null,null,-1)),o("div",ae,[t[10]||(t[10]=o("span",null,[_("Relation Module ("),o("i",null,"Optional"),_(" )")],-1)),o("div",null,[d(c,{placeholder:"Select an option",options:e.report.relation_module,modelValue:e.report.form.related_module,"onUpdate:modelValue":t[3]||(t[3]=r=>e.report.form.related_module=r),reduce:r=>r.value,selectable:r=>e.report.form.related_module.length<2,multiple:""},null,8,["options","modelValue","reduce","selectable"])])])])):v("",!0),e.stepNumber===1?(n(),p("div",ie,[d(S,{title:"Choose List conditions"},{default:y(()=>[t[14]||(t[14]=o("br",null,null,-1)),t[15]||(t[15]=o("label",null,"All Conditions (All conditions must be met)",-1)),(n(!0),p(F,null,T(e.report.form.filter,(r,l)=>(n(),p("div",{class:"grid grid-cols-9 gap-8 mt-4",key:l},[o("div",de,[d(c,{"onOption:selected":a=>f.filter_and_select_option(a,l),placeholder:"Select an option",options:e.report.fields_list,modelValue:e.report.form.filter[l].field,"onUpdate:modelValue":a=>e.report.form.filter[l].field=a,reduce:a=>a.value,selectable:a=>!a.header},{option:y(({header:a,label:B})=>[a?(n(),p("h6",pe,x(B),1)):(n(),p("span",ue,x(B),1))]),_:2},1032,["onOption:selected","options","modelValue","onUpdate:modelValue","reduce","selectable"])]),o("div",me,[d(c,{placeholder:"Select an option",options:e.operator,modelValue:e.report.form.filter[l].operator,"onUpdate:modelValue":a=>e.report.form.filter[l].operator=a,reduce:a=>a.value},null,8,["options","modelValue","onUpdate:modelValue","reduce"])]),o("div",ce,[e.report.form.filter[l].type=="text"?(n(),m(C,{key:0,placeholder:"",modelValue:e.report.form.filter[l].value,"onUpdate:modelValue":a=>e.report.form.filter[l].value=a},null,8,["modelValue","onUpdate:modelValue"])):e.report.form.filter[l].type=="textarea"?(n(),m(z,{key:1,modelValue:e.report.form.filter[l].value,"onUpdate:modelValue":a=>e.report.form.filter[l].value=a},null,8,["modelValue","onUpdate:modelValue"])):e.report.form.filter[l].type=="date"?(n(),m(N,{key:2,class:"form-control",placeholder:"yyyy-mm-dd",config:{dateFormat:"Y-m-d"},modelValue:e.report.form.filter[l].value,"onUpdate:modelValue":a=>e.report.form.filter[l].value=a},null,8,["modelValue","onUpdate:modelValue"])):e.report.form.filter[l].type=="time"?(n(),m(N,{key:3,class:"form-control",placeholder:"HH:mm:00",config:{enableTime:!0,noCalendar:!0,dateFormat:"H:i:00",time_24hr:!0,minuteIncrement:1},modelValue:e.report.form.filter[l].value,"onUpdate:modelValue":a=>e.report.form.filter[l].value=a},null,8,["modelValue","onUpdate:modelValue"])):e.report.form.filter[l].type=="dropdown"?(n(),m(c,{key:4,placeholder:"Select an option",options:e.dropdown_store.dropdownlist_data},null,8,["options"])):(n(),m(C,{key:5,type:e.report.form.filter[l].type,placeholder:"",modelValue:e.report.form.filter[l].value,"onUpdate:modelValue":a=>e.report.form.filter[l].value=a},null,8,["type","modelValue","onUpdate:modelValue"]))]),o("div",fe,[l!==0?(n(),p("button",{key:0,type:"button",class:"inline-flex items-center justify-center h-10 w-10 bg-danger-500 text-lg border rounded border-danger-500 text-white",onClick:a=>f.andRemoveCondition(l)},[d(h,{icon:"heroicons-outline:trash"})],8,_e)):v("",!0)])]))),128)),d(w,{icon:"heroicons-outline:plus",text:"Add Condition",btnClass:"btn-success mr-2 py-2 mt-3",onClick:f.andCondition},null,8,["onClick"])]),_:1})])):v("",!0),e.stepNumber===2?(n(),p("div",be,[d(S,{title:"Select chart type"},{default:y(()=>[o("div",xe,[t[16]||(t[16]=o("label",{class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"},[_("Chart type"),o("span",{class:"text-red-500"},"*")],-1)),d(c,{placeholder:"Select an option",options:e.chart_type,modelValue:e.report.form.chart.type,"onUpdate:modelValue":t[4]||(t[4]=r=>e.report.form.chart.type=r),reduce:r=>r.value},null,8,["options","modelValue","reduce"])]),o("div",ve,[t[17]||(t[17]=o("label",{class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"},[_(" Select Data Fields "),o("span",{class:"text-red-500"},"*")],-1)),d(c,{placeholder:"Select an option",options:e.data_fields,multiple:"",modelValue:e.report.form.chart.dataset,"onUpdate:modelValue":t[5]||(t[5]=r=>e.report.form.chart.dataset=r),reduce:r=>r.value},null,8,["options","modelValue","reduce"])]),o("div",ye,[t[18]||(t[18]=o("label",{class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"},[_(" Select Groupby Field "),o("span",{class:"text-red-500"},"*")],-1)),d(c,{placeholder:"Select an option",options:e.report.fields_list,modelValue:e.report.form.chart.group_by,"onUpdate:modelValue":t[6]||(t[6]=r=>e.report.form.chart.group_by=r),reduce:r=>r.value,selectable:r=>!r.header},{option:y(({header:r,label:l})=>[r?(n(),p("h6",ge,x(l),1)):(n(),p("span",he,x(l),1))]),_:1},8,["options","modelValue","reduce","selectable"])])]),_:1})])):v("",!0),o("div",{class:k(["mt-10",e.stepNumber>0?"flex justify-between":" text-right"])},[this.stepNumber!==0?(n(),m(w,{key:0,onClick:t[7]||(t[7]=Y(r=>f.prev(),["prevent"])),text:"prev",btnClass:"btn-dark"})):v("",!0),d(w,{onClick:f.submit,text:e.stepNumber!==this.steps.length-1?"next":"Save and Generate",btnClass:"btn-dark"},null,8,["onClick","text"])],2)])]),_:1})}const Ve=L(Z,[["render",ke]]),Ce={components:{List:G,Chart:Ve}};function we(i,t,R,I,e,f){const V=u("List"),h=u("Chart");return n(),p("div",null,[this.$route.params.type=="list"?(n(),m(V,{key:0})):this.$route.params.type=="chart"?(n(),m(h,{key:1})):v("",!0)])}const Me=L(Ce,[["render",we]]);export{Me as default};
