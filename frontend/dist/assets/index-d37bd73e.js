import{I as k}from"./index-39bd4386.js";import{_ as w,a as y,b as e,c as n,V as C,n as a,d as c,g as l,t as u,F as r,f as o,h as f,Q as m,C as x,w as v}from"./index-d9888335.js";const h={components:{Icon:k},name:"Button",props:{text:{type:String,default:""},isDisabled:{type:Boolean,default:!1},isLoading:{type:Boolean,default:!1},btnClass:{type:String,default:"bg-primary-500 text-white"},icon:{type:String,default:""},iconPosition:{type:String,default:"left"},iconClass:{type:String,default:"text-[20px]"},loadingClass:{type:String,default:""},link:{type:String,default:""},div:{type:Boolean,default:!1}}},b=["disabled"],L={key:0,class:"flex items-center"},B={key:1},_={key:2},S={key:0,class:"flex items-center"},P={key:1},V={key:2},z={key:0,class:"flex items-center"},D={key:1},I={key:2};function N(s,i,t,j,A,H){const d=y("Icon"),g=y("router-link");return e(),n(r,null,[!t.link&&!t.div?(e(),n("button",C({key:0,disabled:t.isDisabled,class:["btn inline-flex justify-center",`
    ${t.isLoading?" pointer-events-none":""}
    ${t.isDisabled?" opacity-40 cursor-not-allowed":""}
    ${t.btnClass}
    `]},s.$attrs),[!t.isLoading&&!s.$slots.default?(e(),n("span",L,[t.icon?(e(),n("span",{key:0,class:a(`
          ${t.iconPosition==="right"?"order-1 ltr:ml-2 rtl:mr-2":" "}
          ${t.text&&t.iconPosition==="left"?"ltr:mr-2 rtl:ml-2":""}
          
          ${t.iconClass}
          
          `)},[c(d,{icon:t.icon},null,8,["icon"])],2)):l("",!0),t.text?(e(),n("span",B,u(t.text),1)):l("",!0)])):l("",!0),t.isLoading?(e(),n(r,{key:1},[(e(),n("svg",{class:a(["animate-spin ltr:-ml-1 ltr:mr-3 rtl:-mr-1 rtl:ml-3 h-5 w-5",t.loadingClass]),xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24"},i[0]||(i[0]=[o("circle",{class:"opacity-25",cx:"12",cy:"12",r:"10",stroke:"currentColor","stroke-width":"4"},null,-1),o("path",{class:"opacity-75",fill:"currentColor",d:"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"},null,-1)]),2)),i[1]||(i[1]=f(" Loading ... "))],64)):l("",!0),s.$slots.default&&!t.isLoading?(e(),n("div",_,[m(s.$slots,"default")])):l("",!0)],16,b)):l("",!0),t.link&&!t.div?(e(),x(g,{key:1,to:t.link,class:a(["btn inline-flex justify-center",`
    ${t.isLoading?" pointer-events-none":""}
    ${t.isDisabled?" opacity-40 cursor-not-allowed":""}
    ${t.btnClass}
    `])},{default:v(()=>[!t.isLoading&&!s.$slots.default?(e(),n("span",S,[t.icon?(e(),n("span",{key:0,class:a(`
          ${t.iconPosition==="right"?"order-1 ltr:ml-2 rtl:mr-2":" "}
          ${t.text&&t.iconPosition==="left"?"ltr:mr-2 rtl:ml-2":""}
          
          ${t.iconClass}
          
          `)},[c(d,{icon:t.icon},null,8,["icon"])],2)):l("",!0),t.text?(e(),n("span",P,u(t.text),1)):l("",!0)])):l("",!0),t.isLoading?(e(),n(r,{key:1},[(e(),n("svg",{class:a(["animate-spin -ml-1 mr-3 h-5 w-5",t.loadingClass]),xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24"},i[2]||(i[2]=[o("circle",{class:"opacity-25",cx:"12",cy:"12",r:"10",stroke:"currentColor","stroke-width":"4"},null,-1),o("path",{class:"opacity-75",fill:"currentColor",d:"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"},null,-1)]),2)),i[3]||(i[3]=f(" Loading ... "))],64)):l("",!0),s.$slots.default&&!t.isLoading?(e(),n("div",V,[m(s.$slots,"default")])):l("",!0)]),_:3},8,["to","class"])):l("",!0),t.div&&!t.link?(e(),n("div",{key:2,class:a(["btn inline-flex justify-center",`
    ${t.isLoading?" pointer-events-none":""}
    ${t.isDisabled?" opacity-40 cursor-not-allowed":""}
    ${t.btnClass}
    `])},[!t.isLoading&&!s.$slots.default?(e(),n("span",z,[t.icon?(e(),n("span",{key:0,class:a(`
          ${t.iconPosition==="right"?"order-1 ltr:ml-2 rtl:mr-2":" "}
          ${t.text&&t.iconPosition==="left"?"ltr:mr-2 rtl:ml-2":""}
          
          ${t.iconClass}
          
          `)},[c(d,{icon:t.icon},null,8,["icon"])],2)):l("",!0),t.text?(e(),n("span",D,u(t.text),1)):l("",!0)])):l("",!0),t.isLoading?(e(),n(r,{key:1},[(e(),n("svg",{class:a(["animate-spin -ml-1 mr-3 h-5 w-5",t.loadingClass]),xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24"},i[4]||(i[4]=[o("circle",{class:"opacity-25",cx:"12",cy:"12",r:"10",stroke:"currentColor","stroke-width":"4"},null,-1),o("path",{class:"opacity-75",fill:"currentColor",d:"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"},null,-1)]),2)),i[5]||(i[5]=f(" Loading ... "))],64)):l("",!0),s.$slots.default&&!t.isLoading?(e(),n("div",I,[m(s.$slots,"default")])):l("",!0)],2)):l("",!0)],64)}const E=w(h,[["render",N]]);export{E as B};
