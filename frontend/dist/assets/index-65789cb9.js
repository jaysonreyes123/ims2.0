import{S as h,U as _,_ as g,c as e,d as n,f as s,F as u,D as m,a as i,b as d}from"./index-d3afc2d4.js";import{C as b}from"./chart-39c215c6.js";import"./index-dbb5ef09.js";import"./report-165e833f.js";import"./dropdown-9600ea7e.js";import"./appex-chart-2e5bc126.js";h();const f=_("dashboard",{state:()=>({loading:!1,chart:[]}),getters:{},actions:{async get_dashboard_report_chart(){try{this.loading=!0;const a=await this.axios.get("dashboard/get_report_charts");this.chart=a.data.data,this.loading=!1}catch{}}},persist:!0}),c=f(),x={components:{chart:b},mounted(){c.get_dashboard_report_chart()},data(){return{dashboard_store:c}}},v={class:"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"};function y(a,r,B,C,o,L){const l=i("Loading"),p=i("chart");return d(),e("div",null,[n(l,{active:o.dashboard_store.loading,"onUpdate:active":r[0]||(r[0]=t=>o.dashboard_store.loading=t)},null,8,["active"]),r[1]||(r[1]=s("div",{class:"flex mb-8"},[s("span",{class:"capitalize font-bold text-2xl"},"dashboard")],-1)),s("div",v,[(d(!0),e(u,null,m(o.dashboard_store.chart,(t,S)=>(d(),e("div",null,[n(p,{height:"200px",title:t.report_name,report_id:t.id,chart_type:t.report_charts.chart},null,8,["title","report_id","chart_type"])]))),256))])])}const w=g(x,[["render",y]]);export{w as default};
