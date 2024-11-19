import{I as g}from"./index-d46c1607.js";import{_ as n,a as y,b as a,d as l,h as d,v as i,e as _,j as h,n as t,i as s,t as r,m as v}from"./index-b5a420e8.js";const x={components:{Icon:g}},k={class:"mb-4 flex"},C={class:"capitalize font-bold"};function B(o,c,e,u,m,f){const b=y("Icon");return a(),l("div",k,[d("span",C,i(this.$route.params.module),1),_(b,{class:"mt-1",icon:"heroicons-outline:chevron-right"}),h(" All "+i(this.$route.params.module),1)])}const D=n(x,[["render",B]]);const S={name:"Card",props:{className:{type:String,default:""},title:{type:String,default:""},titleClass:{type:String,default:""},subtitle:{type:String,default:""},subtitleClass:{type:String,default:""},img:{type:String,default:""},imaClass:{type:String,default:""},imgTop:{type:Boolean,default:!1},imgBottom:{type:Boolean,default:!1},gapNull:{type:Boolean,default:!1},overlay:{type:Boolean,default:!1},noborder:{type:Boolean,default:!1},bodyClass:{type:String,default:"p-6"}}},N={class:"flex-1"},I={key:0,class:"flex-0"},T=["src"],w={class:"mb-5"},V={class:"card-text h-full"};function j(o,c,e,u,m,f){return a(),l("div",null,[e.overlay?s("",!0):(a(),l("div",{key:0,class:t(`card rounded-md bg-white dark:bg-slate-800 lg:h-full  ${this.$store.themeSettingsStore.skin==="bordered"?" border border-gray-5002 dark:border-slate-700":"shadow-base"}
   
    ${e.className}
    
    `)},[d("div",{class:t(["card-body flex flex-col",e.bodyClass])},[e.title||e.subtitle?(a(),l("header",{key:0,class:t(["flex items-center",`
      ${e.imgTop?"order-1":""}
      ${e.noborder?"":"border-b border-slate-100 dark:border-slate-700 pb-5  -mx-6 px-6"}
      
      `])},[d("div",N,[e.title?(a(),l("div",{key:0,class:t(["card-title text-slate-900 dark:text-white",e.titleClass])},i(e.title),3)):s("",!0),e.subtitle?(a(),l("div",{key:1,class:t(["card-subtitle",e.subtitleClass])},i(e.subtitle),3)):s("",!0)]),o.$slots.header?(a(),l("div",I,[r(o.$slots,"header",{},void 0,!0)])):s("",!0)],2)):s("",!0),e.img?(a(),l("div",{key:1,class:t(["image-box",`
        ${e.imgTop?"order-0":""}
        ${e.gapNull?"-mx-6 ":""}
        ${e.gapNull&&e.imgTop?"-mt-6 ":""}
        ${e.gapNull&&e.imgBottom?"-mb-6 ":""}
        
        ${e.imgBottom?"order-3 mt-6":" mb-6"}
        
        
        `])},[d("img",{src:e.img,alt:"",class:t(["block w-full h-full object-cover",e.imaClass])},null,10,T)],2)):s("",!0),d("div",{class:t([e.imgTop?"order-2":"","card-text h-full"])},[r(o.$slots,"default",{},void 0,!0)],2)],2)],2)),e.overlay?(a(),l("div",{key:1,class:t(["rounded-md overlay bg-no-repeat bg-center bg-cover card",e.className]),style:v({backgroundImage:`url(${e.img})`})},[d("div",{class:t(["card-body h-full flex flex-col justify-center",e.bodyClass])},[d("header",w,[e.title?(a(),l("div",{key:0,class:t(["card-title text-slate-900 dark:text-white",e.titleClass])},i(e.title),3)):s("",!0),e.subtitle?(a(),l("div",{key:1,class:t(["card-subtitle",e.subtitleClass])},i(e.subtitle),3)):s("",!0)]),d("div",V,[r(o.$slots,"default",{},void 0,!0)])],2)],6)):s("",!0)])}const E=n(S,[["render",j],["__scopeId","data-v-79b94265"]]);export{D as B,E as C};
