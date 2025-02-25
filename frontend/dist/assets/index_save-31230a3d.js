import{B as N}from"./Breadcrum-b7890c5f.js";import{C as H}from"./index-2412a5d3.js";import{T as j}from"./index-94653a48.js";import{B as z}from"./index-d37bd73e.js";import{T as I,C as O}from"./vue-select.es-a487208f.js";import{S as Y}from"./index-ff25317f.js";import{S as A}from"./sweetalert2.all-cbba3559.js";import{M as J}from"./edit_map-1ba6d2c2.js";import{r as R,_ as T,a,b as t,c as r,d as m,i as K,F as V,D as x,C as v,w as q,f as s,n as P,h as p,t as b,g as d}from"./index-d9888335.js";import{u as Q}from"./module-3c9806cd.js";import{u as W}from"./dropdown-387ba376.js";import{L as X}from"./save-b3df36fd.js";import"./index-39bd4386.js";import"./mapbox-gl-geocoder-ebca00b9.js";import"./index-eef0ab71.js";import"./index-9e73ef5b.js";import"./report-b0bd9a72.js";const u=Q(),Z=W(),g=R(""),$={components:{Card:H,Textinput:j,Button:z,Textarea:I,Select:O,Map:J,Switch:Y,Breadcrum:N},data(){return{module_store:u,dropdown_store:Z,modules:g}},created(){g.value=this.$route.params.module},mounted(){const n=this.$route.params.id;u.module=g.value,u.get_edit_form(n),u.id=n},methods:{save(){var n="";if(Object.keys(u.required_field).map(_=>{u.form[_]==""&&(n+=`<span class="text-red-500"><b>${u.required_field[_]}</b> is required field</span><br>`)}),n!="")return A.fire({icon:"error",title:"Fill up the Required field",html:n}),!1;u.save()},updateCoordinates(n){const{lng:c,lat:_}=n;u.form.coordinates=c+","+_}}},ee={key:0},oe={class:"lg:grid lg:grid-cols-2 gap-12"},te={key:1},re={class:"lg:grid gap-x-12",style:{"grid-template-columns":"1fr 1fr"}},le={key:0},se={class:"fromGroup relative"},ae={class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"},ne={key:0,class:"text-red-500"},me={key:1},de={class:"fromGroup relative"},ue={class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"},ce={key:0,class:"text-red-500"},ie={key:2},_e={class:"fromGroup relative"},pe={class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"},be={key:0,class:"text-red-500"},ve={key:3,class:"fromGroup relative"},ye={class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"},ke={key:0,class:"text-red-500"},he={key:4,class:"fromGroup relative"},fe={class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"},Ve={key:0,class:"text-red-500"},xe={key:5},ge={class:"fromGroup relative"},Se={class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"},we={key:0,class:"text-red-500"};function Ue(n,c,_,G,o,y){const h=a("Breadcrum"),f=a("Loading"),S=a("Textinput"),L=a("Map"),w=a("flat-pickr"),M=a("Textarea"),F=a("Select"),U=a("Switch"),C=a("Card"),D=a("Button");return t(),r("div",null,[m(h,{mode:"save"}),m(f,{active:o.module_store.loading,"onUpdate:active":c[0]||(c[0]=i=>o.module_store.loading=i)},null,8,["active"]),o.module_store.loading?d("",!0):(t(),r("form",{key:0,onSubmit:c[1]||(c[1]=K((...i)=>y.save&&y.save(...i),["prevent"]))},[(t(!0),r(V,null,x(o.module_store.data.blocks,(i,E)=>(t(),v(C,{key:E,title:i.block,class:"mb-4"},{default:q(()=>[i.block=="Location Details"?(t(),r("div",ee,[s("div",oe,[s("div",null,[(t(!0),r(V,null,x(i.fields,(e,k)=>(t(),v(S,{isReadonly:e.readonly==1,class:"mt-4",key:k,modelValue:o.module_store.form[e.name],"onUpdate:modelValue":l=>o.module_store.form[e.name]=l,label:e.label,placeholder:`Enter ${e.label}`},null,8,["isReadonly","modelValue","onUpdate:modelValue","label","placeholder"]))),128))]),s("div",null,[m(L,{set_coordinates:o.module_store.form.coordinates,onUpdateCoordinate:y.updateCoordinates},null,8,["set_coordinates","onUpdateCoordinate"])])])])):(t(),r("div",te,[s("div",re,[(t(!0),r(V,null,x(i.fields.filter(e=>e.display_type==1),(e,k)=>(t(),r("div",{key:k,class:P([`custom-grid-${k%2}`,"mt-4"])},[e.type=="time"?(t(),r("div",le,[s("div",se,[s("label",ae,[p(b(e.label)+" ",1),e.required?(t(),r("span",ne,"*")):d("",!0)]),m(w,{modelValue:o.module_store.form[e.name],"onUpdate:modelValue":l=>o.module_store.form[e.name]=l,class:"form-control",placeholder:"HH:mm:00",config:{enableTime:!0,noCalendar:!0,dateFormat:"H:i:00",time_24hr:!0,minuteIncrement:1}},null,8,["modelValue","onUpdate:modelValue"])])])):e.type=="date"?(t(),r("div",me,[s("div",de,[s("label",ue,[p(b(e.label)+" ",1),e.required?(t(),r("span",ce,"*")):d("",!0)]),m(w,{modelValue:o.module_store.form[e.name],"onUpdate:modelValue":l=>o.module_store.form[e.name]=l,class:"form-control",placeholder:"yyyy-mm-dd",config:{dateFormat:"Y-m-d"}},null,8,["modelValue","onUpdate:modelValue"])])])):e.type=="textarea"?(t(),r("div",ie,[s("div",_e,[s("label",pe,[p(b(e.label)+" ",1),e.required?(t(),r("span",be,"*")):d("",!0)]),m(M,{isReadonly:e.readonly==1,placeholder:`Enter ${e.label}`,modelValue:o.module_store.form[e.name],"onUpdate:modelValue":l=>o.module_store.form[e.name]=l},null,8,["isReadonly","placeholder","modelValue","onUpdate:modelValue"])])])):e.type=="dropdown"?(t(),r("div",ve,[s("label",ye,[p(b(e.label)+" ",1),e.required?(t(),r("span",ke,"*")):d("",!0)]),m(F,{disabled:e.readonly==1,placeholder:"Select an option",reduce:l=>l.label,options:o.dropdown_store.dropdownlist[e.name],modelValue:o.module_store.form[e.name],"onUpdate:modelValue":l=>o.module_store.form[e.name]=l},null,8,["disabled","reduce","options","modelValue","onUpdate:modelValue"])])):e.type=="checkbox"?(t(),r("div",he,[s("label",fe,[p(b(e.label)+" ",1),e.required?(t(),r("span",Ve,"*")):d("",!0)]),o.module_store.form[e.name]==1?(t(),v(U,{key:0,modelValue:o.module_store.form[e.name],"onUpdate:modelValue":l=>o.module_store.form[e.name]=l,active:!0,class:"mb-5"},null,8,["modelValue","onUpdate:modelValue"])):d("",!0),o.module_store.form[e.name]==0?(t(),v(U,{key:1,modelValue:o.module_store.form[e.name],"onUpdate:modelValue":l=>o.module_store.form[e.name]=l,active:!1,class:"mb-5"},null,8,["modelValue","onUpdate:modelValue"])):d("",!0)])):(t(),r("div",xe,[s("div",ge,[s("label",Se,[p(b(e.label)+" ",1),e.required?(t(),r("span",we,"*")):d("",!0)]),m(S,{isReadonly:e.readonly==1,modelValue:o.module_store.form[e.name],"onUpdate:modelValue":l=>o.module_store.form[e.name]=l,placeholder:`Enter ${e.label}`},null,8,["isReadonly","modelValue","onUpdate:modelValue","placeholder"])])]))],2))),128))])]))]),_:2},1032,["title"]))),128)),m(C,null,{default:q(()=>[m(D,{class:"w-full bg-emerald-500/100 hover:bg-emerald-600/100",text:`Save ${o.modules}`},null,8,["text"])]),_:1})],32))])}const Ce=T($,[["render",Ue]]),B=R(),qe={components:{Save:Ce,ReportSave:X},created(){B.value=this.$route.params.module},data(){return{modules:B}}};function Be(n,c,_,G,o,y){const h=a("ReportSave"),f=a("Save");return t(),r("div",null,[o.modules=="reports"?(t(),v(h,{key:0})):(t(),v(f,{key:1}))])}const Ke=T(qe,[["render",Be]]);export{Ke as default};
