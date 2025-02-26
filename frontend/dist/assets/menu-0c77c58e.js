import{o as m,m as L,y as B,h as j,F as $,c as K,u as U,l as D,V as y,t as w,p as V,R as N,a as b,v as _,M as A,D as O,O as H}from"./use-outside-click-40943b94.js";import{r as x,o as k,y as E,p as M,m as S,s as W,z as q,A as R,B as Q}from"./index-703ff788.js";function z(t){throw new Error("Unexpected object: "+t)}var g=(t=>(t[t.First=0]="First",t[t.Previous=1]="Previous",t[t.Next=2]="Next",t[t.Last=3]="Last",t[t.Specific=4]="Specific",t[t.Nothing=5]="Nothing",t))(g||{});function G(t,u){let r=u.resolveItems();if(r.length<=0)return null;let c=u.resolveActiveIndex(),e=c??-1,p=(()=>{switch(t.focus){case 0:return r.findIndex(n=>!u.resolveDisabled(n));case 1:{let n=r.slice().reverse().findIndex((i,v,I)=>e!==-1&&I.length-v-1>=e?!1:!u.resolveDisabled(i));return n===-1?n:r.length-1-n}case 2:return r.findIndex((n,i)=>i<=e?!1:!u.resolveDisabled(n));case 3:{let n=r.slice().reverse().findIndex(i=>!u.resolveDisabled(i));return n===-1?n:r.length-1-n}case 4:return r.findIndex(n=>u.resolveId(n)===t.id);case 5:return null;default:z(t)}})();return p===-1?c:p}function F(t,u){if(t)return t;let r=u??"button";if(typeof r=="string"&&r.toLowerCase()==="button")return"button"}function J(t,u){let r=x(F(t.value.type,t.value.as));return k(()=>{r.value=F(t.value.type,t.value.as)}),E(()=>{var c;r.value||!m(u)||m(u)instanceof HTMLButtonElement&&!((c=m(u))!=null&&c.hasAttribute("type"))&&(r.value="button")}),r}function X({container:t,accept:u,walk:r,enabled:c}){E(()=>{let e=t.value;if(!e||c!==void 0&&!c.value)return;let p=L(t);if(!p)return;let n=Object.assign(v=>u(v),{acceptNode:u}),i=p.createTreeWalker(e,NodeFilter.SHOW_ELEMENT,n,!1);for(;i.nextNode();)r(i.currentNode)})}var Y=(t=>(t[t.Open=0]="Open",t[t.Closed=1]="Closed",t))(Y||{}),Z=(t=>(t[t.Pointer=0]="Pointer",t[t.Other=1]="Other",t))(Z||{});function ee(t){requestAnimationFrame(()=>requestAnimationFrame(t))}let C=Symbol("MenuContext");function P(t){let u=Q(C,null);if(u===null){let r=new Error(`<${t} /> is missing a parent <Menu /> component.`);throw Error.captureStackTrace&&Error.captureStackTrace(r,P),r}return u}let ne=M({name:"Menu",props:{as:{type:[Object,String],default:"template"}},setup(t,{slots:u,attrs:r}){let c=x(1),e=x(null),p=x(null),n=x([]),i=x(""),v=x(null),I=x(1);function d(s=l=>l){let l=v.value!==null?n.value[v.value]:null,o=H(s(n.value.slice()),h=>m(h.dataRef.domRef)),f=l?o.indexOf(l):null;return f===-1&&(f=null),{items:o,activeItemIndex:f}}let a={menuState:c,buttonRef:e,itemsRef:p,items:n,searchQuery:i,activeItemIndex:v,activationTrigger:I,closeMenu:()=>{c.value=1,v.value=null},openMenu:()=>c.value=0,goToItem(s,l,o){let f=d(),h=G(s===g.Specific?{focus:g.Specific,id:l}:{focus:s},{resolveItems:()=>f.items,resolveActiveIndex:()=>f.activeItemIndex,resolveId:T=>T.id,resolveDisabled:T=>T.dataRef.disabled});i.value="",v.value=h,I.value=o??1,n.value=f.items},search(s){let l=i.value!==""?0:1;i.value+=s.toLowerCase();let o=(v.value!==null?n.value.slice(v.value+l).concat(n.value.slice(0,v.value+l)):n.value).find(h=>h.dataRef.textValue.startsWith(i.value)&&!h.dataRef.disabled),f=o?n.value.indexOf(o):-1;f===-1||f===v.value||(v.value=f,I.value=1)},clearSearch(){i.value=""},registerItem(s,l){let o=d(f=>[...f,{id:s,dataRef:l}]);n.value=o.items,v.value=o.activeItemIndex,I.value=1},unregisterItem(s){let l=d(o=>{let f=o.findIndex(h=>h.id===s);return f!==-1&&o.splice(f,1),o});n.value=l.items,v.value=l.activeItemIndex,I.value=1}};return B([e,p],(s,l)=>{var o;a.closeMenu(),j(l,$.Loose)||(s.preventDefault(),(o=m(e))==null||o.focus())},S(()=>c.value===0)),W(C,a),K(S(()=>U(c.value,{0:D.Open,1:D.Closed}))),()=>{let s={open:c.value===0};return y({ourProps:{},theirProps:t,slot:s,slots:u,attrs:r,name:"Menu"})}}}),le=M({name:"MenuButton",props:{disabled:{type:Boolean,default:!1},as:{type:[Object,String],default:"button"}},setup(t,{attrs:u,slots:r,expose:c}){let e=P("MenuButton"),p=`headlessui-menu-button-${w()}`;c({el:e.buttonRef,$el:e.buttonRef});function n(d){switch(d.key){case b.Space:case b.Enter:case b.ArrowDown:d.preventDefault(),d.stopPropagation(),e.openMenu(),R(()=>{var a;(a=m(e.itemsRef))==null||a.focus({preventScroll:!0}),e.goToItem(g.First)});break;case b.ArrowUp:d.preventDefault(),d.stopPropagation(),e.openMenu(),R(()=>{var a;(a=m(e.itemsRef))==null||a.focus({preventScroll:!0}),e.goToItem(g.Last)});break}}function i(d){switch(d.key){case b.Space:d.preventDefault();break}}function v(d){t.disabled||(e.menuState.value===0?(e.closeMenu(),R(()=>{var a;return(a=m(e.buttonRef))==null?void 0:a.focus({preventScroll:!0})})):(d.preventDefault(),e.openMenu(),ee(()=>{var a;return(a=m(e.itemsRef))==null?void 0:a.focus({preventScroll:!0})})))}let I=J(S(()=>({as:t.as,type:u.type})),e.buttonRef);return()=>{var d;let a={open:e.menuState.value===0},s={ref:e.buttonRef,id:p,type:I.value,"aria-haspopup":!0,"aria-controls":(d=m(e.itemsRef))==null?void 0:d.id,"aria-expanded":t.disabled?void 0:e.menuState.value===0,onKeydown:n,onKeyup:i,onClick:v};return y({ourProps:s,theirProps:t,slot:a,attrs:u,slots:r,name:"MenuButton"})}}}),ue=M({name:"MenuItems",props:{as:{type:[Object,String],default:"div"},static:{type:Boolean,default:!1},unmount:{type:Boolean,default:!0}},setup(t,{attrs:u,slots:r,expose:c}){let e=P("MenuItems"),p=`headlessui-menu-items-${w()}`,n=x(null);c({el:e.itemsRef,$el:e.itemsRef}),X({container:S(()=>m(e.itemsRef)),enabled:S(()=>e.menuState.value===0),accept(a){return a.getAttribute("role")==="menuitem"?NodeFilter.FILTER_REJECT:a.hasAttribute("role")?NodeFilter.FILTER_SKIP:NodeFilter.FILTER_ACCEPT},walk(a){a.setAttribute("role","none")}});function i(a){var s;switch(n.value&&clearTimeout(n.value),a.key){case b.Space:if(e.searchQuery.value!=="")return a.preventDefault(),a.stopPropagation(),e.search(a.key);case b.Enter:if(a.preventDefault(),a.stopPropagation(),e.activeItemIndex.value!==null){let l=e.items.value[e.activeItemIndex.value];(s=m(l.dataRef.domRef))==null||s.click()}e.closeMenu(),O(m(e.buttonRef));break;case b.ArrowDown:return a.preventDefault(),a.stopPropagation(),e.goToItem(g.Next);case b.ArrowUp:return a.preventDefault(),a.stopPropagation(),e.goToItem(g.Previous);case b.Home:case b.PageUp:return a.preventDefault(),a.stopPropagation(),e.goToItem(g.First);case b.End:case b.PageDown:return a.preventDefault(),a.stopPropagation(),e.goToItem(g.Last);case b.Escape:a.preventDefault(),a.stopPropagation(),e.closeMenu(),R(()=>{var l;return(l=m(e.buttonRef))==null?void 0:l.focus({preventScroll:!0})});break;case b.Tab:a.preventDefault(),a.stopPropagation(),e.closeMenu(),R(()=>_(m(e.buttonRef),a.shiftKey?A.Previous:A.Next));break;default:a.key.length===1&&(e.search(a.key),n.value=setTimeout(()=>e.clearSearch(),350));break}}function v(a){switch(a.key){case b.Space:a.preventDefault();break}}let I=V(),d=S(()=>I!==null?I.value===D.Open:e.menuState.value===0);return()=>{var a,s;let l={open:e.menuState.value===0},o={"aria-activedescendant":e.activeItemIndex.value===null||(a=e.items.value[e.activeItemIndex.value])==null?void 0:a.id,"aria-labelledby":(s=m(e.buttonRef))==null?void 0:s.id,id:p,onKeydown:i,onKeyup:v,role:"menu",tabIndex:0,ref:e.itemsRef};return y({ourProps:o,theirProps:t,slot:l,attrs:u,slots:r,features:N.RenderStrategy|N.Static,visible:d.value,name:"MenuItems"})}}}),re=M({name:"MenuItem",props:{as:{type:[Object,String],default:"template"},disabled:{type:Boolean,default:!1}},setup(t,{slots:u,attrs:r,expose:c}){let e=P("MenuItem"),p=`headlessui-menu-item-${w()}`,n=x(null);c({el:n,$el:n});let i=S(()=>e.activeItemIndex.value!==null?e.items.value[e.activeItemIndex.value].id===p:!1),v=S(()=>({disabled:t.disabled,textValue:"",domRef:n}));k(()=>{var l,o;let f=(o=(l=m(n))==null?void 0:l.textContent)==null?void 0:o.toLowerCase().trim();f!==void 0&&(v.value.textValue=f)}),k(()=>e.registerItem(p,v)),q(()=>e.unregisterItem(p)),E(()=>{e.menuState.value===0&&(!i.value||e.activationTrigger.value!==0&&R(()=>{var l,o;return(o=(l=m(n))==null?void 0:l.scrollIntoView)==null?void 0:o.call(l,{block:"nearest"})}))});function I(l){if(t.disabled)return l.preventDefault();e.closeMenu(),O(m(e.buttonRef))}function d(){if(t.disabled)return e.goToItem(g.Nothing);e.goToItem(g.Specific,p)}function a(){t.disabled||i.value||e.goToItem(g.Specific,p,0)}function s(){t.disabled||!i.value||e.goToItem(g.Nothing)}return()=>{let{disabled:l}=t,o={active:i.value,disabled:l};return y({ourProps:{id:p,ref:n,role:"menuitem",tabIndex:l===!0?void 0:-1,"aria-disabled":l===!0?!0:void 0,onClick:I,onFocus:d,onPointermove:a,onMousemove:a,onPointerleave:s,onMouseleave:s},theirProps:t,slot:o,attrs:r,slots:u,name:"MenuItem"})}}});export{le as I,re as S,g as a,J as b,ue as g,X as p,ne as v,G as x};
