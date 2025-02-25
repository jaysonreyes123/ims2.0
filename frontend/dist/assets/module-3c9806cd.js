import{S as d,U as l}from"./index-d9888335.js";import{u as n}from"./dropdown-387ba376.js";import{S as o}from"./sweetalert2.all-cbba3559.js";const m=n();d();const c=l("module",{state:()=>({loading:!1,module:"",entityname_field:"",entityname:"",id:"",data:[],required_field:{},form:{},summary:0,blocks:[]}),actions:{clear(){this.form={},this.data=[],this.required_field={}},async generate(t){try{this.loading=!0;const s=await this.axios.get("module/generate/"+this.module);this.form[t]=s.data,this.loading=!1}catch{}},set_form(t){this.required_field=[],this.form=Object.assign(this.form,{module:this.module,id:"",created_at:"",updated_at:"",created_by:"",updated_by:""}),t.map(s=>{s.fields.map(e=>{const a={};if(a[e.name]=e.default_value==null?"":e.default_value,this.form=Object.assign(this.form,a),e.type=="dropdown"?m.get_dropdown(e.name):e.type=="generate"&&(this.id==""||this.id===void 0)&&this.generate(e.name),e.required==1){const r={};r[e.name]=e.label,this.get_required_field(r)}})})},view_set_form(t){this.required_field=[],this.form=Object.assign(this.form,{module:this.module,id:"",created_at:"",updated_at:"",created_by:"",updated_by:""}),t.map(s=>{s.fields.map(e=>{const a={};a[e.name]=e.default_value==null?"":e.default_value,this.form=Object.assign(this.form,a)})})},get_required_field(t){this.required_field=Object.assign(this.required_field,t)},async get_edit_form(t,s="save"){try{this.clear(),this.loading=!0;const e=await this.axios.get("module/edit/form/"+this.module+"/"+s),a=e.data.data;this.blocks=a.blocks,this.id=t,this.data=e.data.data,this.entityname_field=e.data.data.entityname,s=="save"?this.set_form(a.blocks):(s=="detail"||s=="summary")&&this.view_set_form(a.blocks),t!=""&&t!==void 0?this.get(t):this.loading=!1}catch{}},async get(t){try{this.loading=!0;let s;s=await this.axios.get("module/"+t,{params:{module:this.module}});const e=s.data.data;Object.keys(this.form).map(i=>{i!="module"&&(this.form[i]=e[i])}),this.entityname="",this.entityname_field.split(",").map(i=>{this.entityname+=e[i]+" "}),this.loading=!1}catch{}},async get_summary(){try{this.summary=0;const t=await this.axios.get("module/get_summary/"+this.module);this.summary=t.data.data}catch{}},async save(){try{if(this.loading=!0,this.form.id==""){const s=await this.axios.post("module",this.form);this.form.id=s.data.data}else{const s=await this.axios.put("module/"+this.form.id,this.form)}this.router.push({name:"view",params:{id:this.form.id,module:this.form.module,action:"detail"}}),this.loading=!1}catch(s){const e=s.response;if(e.status==422){const a=Object.values(e.data.errors);var t="";a.map((r,i)=>{t=`<p class="text-red-500">${r[i]}</p>`}),o.fire({icon:"error",title:"Something wrong",html:t})}else e.status==500&&o.fire({icon:"error",title:"Something wrong",html:e.data.message});console.log(e),this.loading=!1}},async save_profile(){try{if(this.loading=!0,this.id==""){const s=await this.axios.post("module",this.form)}else await this.axios.put("module/"+this.form.id,this.form);this.router.push({name:"profile"}),this.loading=!1}catch(s){const e=s.response;if(e.status==422){const a=Object.values(e.data.errors);var t="";a.map((r,i)=>{t=`<p class="text-red-500">${r[i]}</p>`}),o.fire({icon:"error",title:"Something wrong",html:t})}else e.status==500&&o.fire({icon:"error",title:"Something wrong",html:e.data.message});console.log(e),this.loading=!1}}},persist:!0});export{c as u};
