import{I as x}from"./index-85f3daf5.js";import{Z as b,$ as g,_ as q,a as c,b as s,c as l,f as u,t as f,d as o,w as m,h as w,n as N,C as h,g as r}from"./index-33b8ebb1.js";import{B as I}from"./index-cad29c44.js";b();const C=g("incident",{state:()=>({incidentList:[],incident_types_picklist:[],incident_statuses_picklist:[],incident_priorities_picklist:[],id:0,loading:!0,form:{incident_no:"",incident_types_picklist:"",incident_statuses_picklist:"",incident_priorities_picklist:"",time_of_incident:null,date_of_incident:null,remarks:"",location:"",street_name:"",nearest_landmark:"",coordinates:"",assigned_team:[],response_team:"",assigned_by:"",caller_contact:"",caller_firstname:"",caller_lastname:""}}),actions:{clearField(){this.loading=!0,Object.keys(this.form).map(t=>{this.form[t]=""}),this.id="",this.loading=!1},async list(){try{this.loading=!0;const e=await this.axios.get("incidents");this.incidentList=e.data.data,this.loading=!1}catch{}},async getItem(){this.loading=!0;const e=await this.axios.get("incidents/"+this.id),t=Object.keys(this.form),a=e.data.data;t.map(i=>{i=="assigned_team"?this.form[i]=JSON.parse(a[i]):this.form[i]=e.data.data[i]}),this.loading=!1},async save(){try{if(this.loading=!0,this.id==""){const e=await this.axios.post("incidents",this.form);this.id=e.data.data.id}else await this.axios.put("incidents/"+this.id,this.form);this.loading=!1,this.router.push({name:"detail",params:{id:this.id,module:"incidents"}})}catch{}},async del(e){try{this.loading=!0,(await this.axios.delete("incidents/"+e)).data.status==200&&this.list(),this.loading=!1}catch{}},async get_incident_type(){try{const e=await this.axios.get("incident_type");this.incident_types_picklist=e.data.data}catch{}},async get_incident_status(){try{const e=await this.axios.get("incident_status");this.incident_statuses_picklist=e.data.data}catch{}},async get_incident_priority(){try{const e=await this.axios.get("incident_priority");this.incident_priorities_picklist=e.data.data}catch{}},async generate_id(e){try{this.loading=!0;const t=await this.axios.get("generate/id/"+e);this.form.incident_no=t.data,this.loading=!1}catch{}}},persist:!0});b();const B=g("resources",{state:()=>({loading:!1,ResourceList:[],resources_types_picklist:[],conditions_picklist:[],dispatchers_picklist:[],resources_statuses_picklist:[],id:"",form:{resources_name:"",resources_types_picklist:"",resources_statuses_picklist:"",coordinates:"",dispatchers_picklist:"",conditions_picklist:"",quantity:1,contact_info:"",date_acquired:"",remarks:""}}),actions:{clearField(){this.loading=!0,Object.keys(this.form).map(t=>{t=="quantity"?this.form[t]=1:this.form[t]=""}),this.id="",this.loading=!1},async list(){try{this.loading=!0;const e=await this.axios.get("resources");this.ResourceList=e.data.data,this.loading=!1}catch{}},async getItem(){this.loading=!0;const e=await this.axios.get("resources/"+this.id),t=Object.keys(this.form);e.data.data,t.map(a=>{this.form[a]=e.data.data[a]}),this.loading=!1},async save(){try{if(this.loading=!0,this.id==""){const e=await this.axios.post("resources",this.form);this.id=e.data.data.id}else await this.axios.put("resources/"+this.id,this.form);this.loading=!1,this.router.push({name:"detail",params:{id:this.id,module:"resources"}})}catch{}},async del(e){try{this.loading=!0,(await this.axios.delete("resources/"+e)).data.status==200&&this.list(),this.loading=!1}catch{}},async get_resources_type(){try{const e=await this.axios.get("resources_type");this.resources_types_picklist=e.data.data}catch{}},async get_resources_status(){try{const e=await this.axios.get("resources_status");this.resources_statuses_picklist=e.data.data}catch{}},async get_resources_condition(){try{const e=await this.axios.get("resources_condition");this.conditions_picklist=e.data.data}catch{}},async get_resources_dispatch(){try{const e=await this.axios.get("resources_dispatch");this.dispatchers_picklist=e.data.data}catch{}}},persist:!0}),v=C(),R=B(),k={incidents:"incident_no",resources:"resources_name"},S={components:{Icon:x,Button:I},data(){return{modules:this.$route.params.module,id:this.$route.params.id}},props:{mode:{type:String,default:"list"}},computed:{getName(){const e=this.$route.params.module;var t="";switch(e){case"incidents":t=v.form[k[e]];break;case"resources":t=R.form[k[e]];break}return t},editName(){var e="";return this.$route.params.id==""&&(e="Creating new "+this.$route.params.module),e}}},D={class:"mb-4 flex justify-between items-center"},L={key:0,class:"flex"},T={class:"capitalize font-bold"},A={key:1},O={key:1},j={class:"font-bold"},P={key:0};function F(e,t,a,i,n,p){const _=c("Icon"),d=c("router-link"),y=c("Button");return s(),l("div",D,[u("div",null,[a.mode=="list"||a.mode=="view"?(s(),l("div",L,[u("span",T,f(this.$route.params.module),1),o(_,{class:"mt-1",icon:"heroicons-outline:chevron-right"}),o(d,{class:N([a.mode!="list"?"font-bold":""]),to:`/app/module/${this.$route.params.module}`},{default:m(()=>t[0]||(t[0]=[w("All ")])),_:1},8,["class","to"]),a.mode!="list"?(s(),h(_,{key:0,class:"mt-1",icon:"heroicons-outline:chevron-right"})):r("",!0),a.mode!="list"?(s(),l("span",A,f(p.getName),1)):r("",!0)])):r("",!0),a.mode=="edit"?(s(),l("div",O,[u("span",j,f(p.editName),1)])):r("",!0)]),a.mode=="view"?(s(),l("div",P,[o(d,{to:{name:"edit",params:{module:n.modules,id:n.id}}},{default:m(()=>[o(y,{icon:"heroicons-outline:pencil-square",text:"Edit",btnClass:"btn-danger shadow-base2",iconPosition:"left"})]),_:1},8,["to"]),n.modules=="incidents"?(s(),h(d,{key:0,class:"ml-3",to:{name:"edit",params:{module:n.modules,id:n.id}}},{default:m(()=>[o(y,{icon:"heroicons-outline:printer",text:"Print",btnClass:"btn-danger shadow-base2",iconPosition:"left"})]),_:1},8,["to"])):r("",!0)])):r("",!0)])}const M=q(S,[["render",F]]),G=[{block_name:"Incident Details",fields:[{label:"Incident ID(Auto Generate)",name:"incident_no",type:"text",default:"",required:!1,readonly:!0},{label:"Incident Type",name:"incident_types_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"Time of Incident",name:"time_of_incident",type:"time",default:"",required:!1,readonly:!1},{label:"Date of Incident",name:"date_of_incident",type:"date",default:"",required:!1,readonly:!1},{label:"Incident Status",name:"incident_statuses_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"Incident Priority",name:"incident_priorities_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"Notes/Remarks",name:"remarks",type:"textarea",default:"",required:!1,readonly:!1}]},{block_name:"Location Details",fields:[{label:"Location",name:"location",type:"text",default:"",required:!1,readonly:!1,duplicate_handling:!0},{label:"Street Name",name:"street_name",type:"text",default:"",required:!1,readonly:!1},{label:"Nearest Landmark",name:"nearest_landmark",type:"text",default:"",required:!1,readonly:!1},{label:"Coordinates",name:"coordinates",type:"text",default:"",required:!1,readonly:!0}]},{block_name:"Caller Details",fields:[{label:"First Name",name:"caller_firstname",type:"text",default:"",required:!1,readonly:!1},{label:"Last Name",name:"caller_lastname",type:"text",default:"",required:!1,readonly:!1},{label:"Contact No",name:"caller_contact",type:"text",default:"",required:!1,readonly:!1}]},{block_name:"Responder",fields:[{label:"Responder Team",name:"assigned_team",type:"picklist",default:"",required:!1,readonly:!1},{label:"Assigned By",name:"response_team",type:"picklist",default:"",required:!1,readonly:!1},{label:"Assigned Team",name:"assigned_team",type:"picklist",default:"",required:!1,readonly:!1}]}],J=[{block_name:"Resources Information",fields:[{label:"Resource Name",name:"resources_name",type:"text",default:"",required:!1,readonly:!1},{label:"Resource Type",name:"resources_types_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"Quantity",name:"quantity",type:"number",default:1,required:!1,readonly:!1},{label:"Resource Status",name:"resources_statuses_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"Contact Info",name:"contact_info",type:"text",default:"",required:!1,readonly:!1},{label:"Owner",name:"owner",type:"text",default:"",required:!1,readonly:!1},{label:"Date Acquired",name:"date_acquired",type:"date",default:"",required:!1,readonly:!1},{label:"Dispatch",name:"dispatchers_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"Remarks",name:"remarks",type:"textarea",default:"",required:!1,readonly:!1},{label:"Condition",name:"conditions_picklist",type:"picklist",default:"",required:!1,readonly:!1}]},{block_name:"Location Details",fields:[{label:"Coordinates",name:"coordinates",type:"text",default:"",required:!1,readonly:!0}]}],Q=[{block_name:"Basic information",fields:[{label:"First Name",name:"firstname",type:"text",default:"",required:!1,readonly:!1},{label:"Last Name",name:"lastname",type:"text",default:"",required:!1,readonly:!1},{label:"Mobile No",name:"mobile",type:"text",default:"",required:!1,readonly:!1},{label:"Landline No",name:"landline",type:"text",default:"",required:!1,readonly:!1},{label:"Primary Email",name:"email",type:"text",default:"",required:!1,readonly:!1},{label:"Date of Birth",name:"date_of_birth",type:"date",default:"",required:!1,readonly:!1},{label:"Created By",name:"created_by",type:"picklist",default:"",required:!1,readonly:!1},{label:"Caller Type",name:"caller_types_picklist",type:"picklist",default:"",required:!1,readonly:!1}]},{block_name:"Address Details",fields:[{label:"Municipality",name:"municipalities_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"Barangay",name:"barangays_picklist",type:"picklist",default:"",required:!1,readonly:!1},{label:"Street Name",name:"street_name",type:"text",default:"",required:!1,readonly:!1}]}];export{M as B,B as a,Q as c,G as i,J as r,C as u};
