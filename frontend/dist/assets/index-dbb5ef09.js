import{_ as u,b as l,c as a,n as t,f as d,t as r,g as s,Q as o,k as c}from"./index-d3afc2d4.js";const n={name:"Card",props:{className:{type:String,default:""},title:{type:String,default:""},titleClass:{type:String,default:""},subtitle:{type:String,default:""},subtitleClass:{type:String,default:""},img:{type:String,default:""},imaClass:{type:String,default:""},imgTop:{type:Boolean,default:!1},imgBottom:{type:Boolean,default:!1},gapNull:{type:Boolean,default:!1},overlay:{type:Boolean,default:!1},noborder:{type:Boolean,default:!1},bodyClass:{type:String,default:"p-6"}}},b={class:"flex-1"},f={key:0,class:"flex-0"},m=["src"],g={class:"mb-5"},y={class:"card-text h-full"};function _(i,v,e,h,k,x){return l(),a("div",null,[e.overlay?s("",!0):(l(),a("div",{key:0,class:t(`card rounded-md bg-white dark:bg-slate-800 lg:h-full  ${this.$store.themeSettingsStore.skin==="bordered"?" border border-gray-5002 dark:border-slate-700":"shadow-base"}
   
    ${e.className}
    
    `)},[d("div",{class:t(["card-body flex flex-col",e.bodyClass])},[e.title||e.subtitle?(l(),a("header",{key:0,class:t(["flex items-center",`
      ${e.imgTop?"order-1":""}
      ${e.noborder?"":"border-b border-slate-100 dark:border-slate-700 pb-5  -mx-6 px-6"}
      
      `])},[d("div",b,[e.title?(l(),a("div",{key:0,class:t(["card-title text-slate-900 dark:text-white",e.titleClass])},r(e.title),3)):s("",!0),e.subtitle?(l(),a("div",{key:1,class:t(["card-subtitle",e.subtitleClass])},r(e.subtitle),3)):s("",!0)]),i.$slots.header?(l(),a("div",f,[o(i.$slots,"header",{},void 0,!0)])):s("",!0)],2)):s("",!0),e.img?(l(),a("div",{key:1,class:t(["image-box",`
        ${e.imgTop?"order-0":""}
        ${e.gapNull?"-mx-6 ":""}
        ${e.gapNull&&e.imgTop?"-mt-6 ":""}
        ${e.gapNull&&e.imgBottom?"-mb-6 ":""}
        
        ${e.imgBottom?"order-3 mt-6":" mb-6"}
        
        
        `])},[d("img",{src:e.img,alt:"",class:t(["block w-full h-full object-cover",e.imaClass])},null,10,m)],2)):s("",!0),d("div",{class:t([e.imgTop?"order-2":"","card-text h-full"])},[o(i.$slots,"default",{},void 0,!0)],2)],2)],2)),e.overlay?(l(),a("div",{key:1,class:t(["rounded-md overlay bg-no-repeat bg-center bg-cover card",e.className]),style:c({backgroundImage:`url(${e.img})`})},[d("div",{class:t(["card-body h-full flex flex-col justify-center",e.bodyClass])},[d("header",g,[e.title?(l(),a("div",{key:0,class:t(["card-title text-slate-900 dark:text-white",e.titleClass])},r(e.title),3)):s("",!0),e.subtitle?(l(),a("div",{key:1,class:t(["card-subtitle",e.subtitleClass])},r(e.subtitle),3)):s("",!0)]),d("div",y,[o(i.$slots,"default",{},void 0,!0)])],2)],6)):s("",!0)])}const S=u(n,[["render",_],["__scopeId","data-v-58bb30e6"]]);export{S as C};
