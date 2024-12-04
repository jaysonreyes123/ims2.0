import{C as p}from"./index-77817f64.js";import{_ as f,a as n,b as c,C as g,w as h,c as u,g as b,D as k,d,Z as r,$ as s}from"./index-33b8ebb1.js";import{M as x,a as w,b as M}from"./mapbox-gl-geocoder-70aea43f.js";const q={components:{Card:p},props:{blockname:{type:String,default:""}}},C={key:0};function I(e,a,t,o,m,i){const l=n("Card");return c(),g(l,{title:t.blockname,class:"mb-4"},{default:h(()=>[t.blockname!=""?(c(),u("br",C)):b("",!0),k(e.$slots,"default")]),_:3},8,["title"])}const A=f(q,[["render",I]]),R={props:{set_coordinates:{type:String,default:""}},components:{MapboxMap:x,MapboxMarker:w,MapboxGeocoder:M,Card:p},data(){return{map:null,coordinates:[0,0]}},methods:{geolocate(e){const a=e.result.geometry.coordinates;this.coordinates=a,this.$emit("updateCoordinate",{lng:a[0],lat:a[1]})},clickMap(e){const{lng:a,lat:t}=e.lngLat;this.coordinates=[a,t],this.$emit("updateCoordinate",e.lngLat)},coordinates_(){return this.set_coordinates==""||this.set_coordinates==null?[0,0]:this.set_coordinates.split(",")}}},S={class:"shadow-lg"};function N(e,a,t,o,m,i){const l=n("MapboxMarker"),y=n("MapboxGeocoder"),_=n("MapboxMap");return c(),u("div",S,[d(_,{style:{height:"350px"},"access-token":"pk.eyJ1IjoiamF5c29ucmV5ZXMyNiIsImEiOiJjbGd1aDViYXUwZzM2M3BsamlpdWtjbzBsIn0.DmYf96Yhwg7vip5Qpzghnw","map-style":"mapbox://styles/mapbox/streets-v11",center:[122.4902841093123,12.573067659271082],zoom:4,onMbClick:i.clickMap},{default:h(()=>[d(l,{"lng-lat":i.coordinates_()},null,8,["lng-lat"]),d(y,{countries:"PH",onMbResult:i.geolocate,marker:!1},null,8,["onMbResult"])]),_:1},8,["onMbClick"])])}const O=f(R,[["render",N]]),P=[{block_name:"Basic Information",fields:[{label:"Agency Name",name:"agency_name",type:"text",default:"",required:!1,readonly:!1},{label:"Contact No. 1",name:"contact_no_1",type:"text",default:"",required:!1,readonly:!1},{label:"Contact No. 2",name:"contact_no_2",type:"text",default:"",required:!1,readonly:!1},{label:"Primary Email",name:"email",type:"text",default:"",required:!1,readonly:!1},{label:"Contact Persion",name:"contact_person",type:"text",default:"",required:!1,readonly:!1},{label:"Assigned To",name:"assigned_to_picklist",type:"picklist",default:"",required:!1,readonly:!1}]},{block_name:"Address Details",fields:[{label:"Municipality",name:"municipalities_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"Barangay",name:"barangays_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"Street Name",name:"street_name",type:"text",default:"",required:!1,readonly:!1}]}],L=[{block_name:"Basic Information",fields:[{label:"Responder Type",name:"responder_types_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"First Name",name:"firstname",type:"text",default:"",required:!1,readonly:!1},{label:"Last Name",name:"lastname",type:"text",default:"",required:!1,readonly:!1},{label:"Contact No",name:"contact_no",type:"text",default:"",required:!1,readonly:!1},{label:"Middle Name",name:"middlename",type:"text",default:"",required:!1,readonly:!1}]},{block_name:"Login information",fields:[{label:"Email Address",name:"email_address",type:"text",default:"",required:!1,readonly:!1},{label:"Password",name:"password",type:"text",default:"",required:!1,readonly:!1},{label:"Assigned To",name:"assigned_to_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"Status",name:"responder_statuses_picklist",type:"picklist",default:"",required:!1,readonly:!1}]}],v=[{block_name:"Incident Details",fields:[{label:"Pre Plan Name",name:"pre_plan_name",type:"text",default:"",required:!1,readonly:!1},{label:"Incident Type",name:"incident_type",type:"text",default:"",required:!1,readonly:!1},{label:"Classification",name:"pre_plan_classifications_picklist",type:"picklist",default:"",required:!1,readonly:!1}]},{block_name:"Response Procedure",fields:[{label:"Initial Assessment",name:"initial_assessment",type:"textarea",default:"",required:!1,readonly:!1},{label:"Response Action",name:"response_action",type:"textarea",default:"",required:!1,readonly:!1},{label:"Classification.",name:"classification",type:"textarea",default:"",required:!1,readonly:!1}]},{block_name:"Roles and Responsibilities",fields:[{label:"Incident Manager",name:"incident_manager",type:"text",default:"",required:!1,readonly:!1},{label:"Incident Responder",name:"incident_responder",type:"text",default:"",required:!1,readonly:!1},{label:"Support Staff",name:"support_staff",type:"text",default:"",required:!1,readonly:!1}]},{block_name:"Resource Allocation",fields:[{label:"Tools and Equipment",name:"tools_and_equipment",type:"textarea",default:"",required:!1,readonly:!1},{label:"Personnel",name:"personnel",type:"textarea",default:"",required:!1,readonly:!1}]}];r();const F=s("contacts",{state:()=>({loading:!1,id:"",caller_types_picklist:[],created_by_picklist:[],municipalities_picklist:[],barangays_picklist:[],form:{firstname:"",lastname:"",mobile:"",landline:"",email:"",date_of_birth:"",created_by:"",caller_types_picklist:"",created_by:"",municipalities_picklist:"",barangays_picklist:""}}),actions:{clearField(){this.loading=!0,Object.keys(this.form).map(a=>{this.form[a]=""}),this.id="",this.loading=!1},async list(){try{this.loading=!0;const e=await this.axios.get("contacts");this.ResourceList=e.data.data,this.loading=!1}catch{}},async getItem(){this.loading=!0;const e=await this.axios.get("contacts/"+this.id),a=Object.keys(this.form);e.data.data,a.map(t=>{this.form[t]=e.data.data[t]}),this.loading=!1},async save(){try{if(this.loading=!0,this.id==""){const e=await this.axios.post("contacts",this.form);this.id=e.data.data.id}else await this.axios.put("contacts/"+this.id,this.form);this.loading=!1,this.router.push({name:"detail",params:{id:this.id,module:"contacts"}})}catch{}},async del(e){try{this.loading=!0,(await this.axios.delete("contacts/"+e)).data.status==200&&this.list(),this.loading=!1}catch{}},async get_caller_types(){try{const e=await this.axios.get("caller_types");this.caller_types_picklist=e.data.data}catch{}},async get_municipalities(){try{const e=await this.axios.get("municipalities");this.municipalities_picklist=e.data.data}catch{}},async get_barangay(){try{const e=await this.axios.get("barangay");this.barangays_picklist=e.data.data}catch{}}},persist:!0});r();const T=s("agency",{state:()=>({loading:!1,id:"",municipalities_picklist:[],barangays_picklist:[],form:{agency_name:"",contact_no_1:"",contact_no_2:"",email:"",contact_person:"",assigned_to_picklist:"",municipalities_picklist:"",barangays_picklist:"",street_name:""}}),actions:{clearField(){this.loading=!0,Object.keys(this.form).map(a=>{this.form[a]=""}),this.id="",this.loading=!1},async list(){try{this.loading=!0;const e=await this.axios.get("agencies");this.ResourceList=e.data.data,this.loading=!1}catch{}},async getItem(){this.loading=!0;const e=await this.axios.get("agencies/"+this.id),a=Object.keys(this.form);e.data.data,a.map(t=>{this.form[t]=e.data.data[t]}),this.loading=!1},async save(){try{if(this.loading=!0,this.id==""){const e=await this.axios.post("agencies",this.form);this.id=e.data.data.id}else await this.axios.put("agencies/"+this.id,this.form);this.loading=!1,this.router.push({name:"detail",params:{id:this.id,module:"agencies"}})}catch{}},async del(e){try{this.loading=!0,(await this.axios.delete("agencies/"+e)).data.status==200&&this.list(),this.loading=!1}catch{}},async get_municipalities(){try{const e=await this.axios.get("municipalities");this.municipalities_picklist=e.data.data}catch{}},async get_barangay(){try{const e=await this.axios.get("barangay");this.barangays_picklist=e.data.data}catch{}}},persist:!0});r();const D=s("responder",{state:()=>({loading:!1,id:"",responder_types_picklist:[],responder_statuses_picklist:[],form:{responder_types_picklist:"",responder_statuses_picklist:"",assigned_to_picklist:"",firstname:"",lastname:"",contact_no:"",middlename:"",email_address:"",password:""}}),actions:{clearField(){this.loading=!0,Object.keys(this.form).map(a=>{this.form[a]=""}),this.id="",this.loading=!1},async list(){try{this.loading=!0;const e=await this.axios.get("responders");this.ResourceList=e.data.data,this.loading=!1}catch{}},async getItem(){this.loading=!0;const e=await this.axios.get("responders/"+this.id),a=Object.keys(this.form);e.data.data,a.map(t=>{this.form[t]=e.data.data[t]}),this.loading=!1},async save(){try{if(this.loading=!0,this.id==""){const e=await this.axios.post("responders",this.form);this.id=e.data.data.id}else await this.axios.put("responders/"+this.id,this.form);this.loading=!1,this.router.push({name:"detail",params:{id:this.id,module:"responders"}})}catch{}},async del(e){try{this.loading=!0,(await this.axios.delete("responders/"+e)).data.status==200&&this.list(),this.loading=!1}catch{}},async get_responder_type(){try{const e=await this.axios.get("responder_type");this.responder_types_picklist=e.data.data}catch{}}},persist:!0});r();const E=s("preplan",{state:()=>({loading:!1,id:"",pre_plan_classifications_picklist:[],form:{}}),actions:{clearField(){this.loading=!0,Object.keys(this.form).map(a=>{this.form[a]=""}),this.id="",this.loading=!1},async list(){try{this.loading=!0;const e=await this.axios.get("pre-plans");this.ResourceList=e.data.data,this.loading=!1}catch{}},async getItem(){this.loading=!0;const e=await this.axios.get("pre-plans/"+this.id),a=Object.keys(this.form);e.data.data,a.map(t=>{this.form[t]=e.data.data[t]}),this.loading=!1},async save(){try{if(this.loading=!0,this.id==""){const e=await this.axios.post("pre-plans",this.form);this.id=e.data.data.id}else await this.axios.put("pre-plans/"+this.id,this.form);this.loading=!1,this.router.push({name:"detail",params:{id:this.id,module:"pre-plans"}})}catch{}},async del(e){try{this.loading=!0,(await this.axios.delete("pre-plans/"+e)).data.status==200&&this.list(),this.loading=!1}catch{}},async get_preplan_classification(){try{const e=await this.axios.get("get_preplan_classification");this.pre_plan_classifications_picklist=e.data.data}catch{}}},persist:!0}),G=s("user",{state:()=>({assigned_to:[]}),getters:{assigned_to_picklist(e){return e.assigned_to.map(a=>({id:a.id,label:a.name}))},get_single_assigned_to_picklist:e=>a=>{if(a!=null)return e.assigned_to.find(o=>o.id==a).name}},actions:{async get_assigned_to(){try{const e=await this.axios.get("get_assigned_to");this.assigned_to=e.data.data}catch{}}},persist:!0});export{A as B,O as M,E as a,D as b,T as c,F as d,P as e,v as p,L as r,G as u};
