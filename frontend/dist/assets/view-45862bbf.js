import{d as Xe,M as He}from"./menu-237f29d7.js";import{B as Je}from"./Breadcrum-59af735a.js";import{I as Ze}from"./index-eb7a6264.js";import{C as et}from"./index-dbb5ef09.js";import{u as tt,M as Ee,P as nt,T as ot}from"./list-80ec5d71.js";import{B as ne}from"./index-42e3c688.js";import{I as me}from"./index-0a9d475e.js";import{u as oe}from"./related-f51ed3d3.js";import{S as rt,U as at,W as ce,X as lt,Y as it,_ as R,p as st,r as re,a as h,b as g,c as w,f as d,t as G,n as B,d as m,w as y,C as E,g as j,Q as H,F as je,h as Oe,V as we,D as ut,u as dt}from"./index-d3afc2d4.js";import{T as ct}from"./index-69b6ce26.js";import{C as ft,T as pt}from"./vue-select.es-d7734031.js";import{S as Be}from"./sweetalert2.all-bc059564.js";import{e as mt,d as vt,N as gt,_ as ht}from"./transition-30d69cdf.js";import{u as _t}from"./dropdown-9600ea7e.js";import yt from"./save-98074c39.js";import"./index-63adbb21.js";import"./module-836942b9.js";import"./edit_map-f18ce726.js";import"./mapbox-gl-geocoder-8e275a52.js";import"./index-ce4be336.js";function K(e,t,n,r){function o(a){return a instanceof n?a:new n(function(u){u(a)})}return new(n||(n=Promise))(function(a,u){function c(i){try{s(r.next(i))}catch(p){u(p)}}function v(i){try{s(r.throw(i))}catch(p){u(p)}}function s(i){i.done?a(i.value):o(i.value).then(c,v)}s((r=r.apply(e,t||[])).next())})}function W(e,t){var n={label:0,sent:function(){if(a[0]&1)throw a[1];return a[1]},trys:[],ops:[]},r,o,a,u;return u={next:c(0),throw:c(1),return:c(2)},typeof Symbol=="function"&&(u[Symbol.iterator]=function(){return this}),u;function c(s){return function(i){return v([s,i])}}function v(s){if(r)throw new TypeError("Generator is already executing.");for(;n;)try{if(r=1,o&&(a=s[0]&2?o.return:s[0]?o.throw||((a=o.return)&&a.call(o),0):o.next)&&!(a=a.call(o,s[1])).done)return a;switch(o=0,a&&(s=[s[0]&2,a.value]),s[0]){case 0:case 1:a=s;break;case 4:return n.label++,{value:s[1],done:!1};case 5:n.label++,o=s[1],s=[0];continue;case 7:s=n.ops.pop(),n.trys.pop();continue;default:if(a=n.trys,!(a=a.length>0&&a[a.length-1])&&(s[0]===6||s[0]===2)){n=0;continue}if(s[0]===3&&(!a||s[1]>a[0]&&s[1]<a[3])){n.label=s[1];break}if(s[0]===6&&n.label<a[1]){n.label=a[1],a=s;break}if(a&&n.label<a[2]){n.label=a[2],n.ops.push(s);break}a[2]&&n.ops.pop(),n.trys.pop();continue}s=t.call(e,n)}catch(i){s=[6,i],o=0}finally{r=a=0}if(s[0]&5)throw s[1];return{value:s[0]?s[1]:void 0,done:!0}}}function bt(e,t){var n=typeof Symbol=="function"&&e[Symbol.iterator];if(!n)return e;var r=n.call(e),o,a=[],u;try{for(;(t===void 0||t-- >0)&&!(o=r.next()).done;)a.push(o.value)}catch(c){u={error:c}}finally{try{o&&!o.done&&(n=r.return)&&n.call(r)}finally{if(u)throw u.error}}return a}function wt(){for(var e=[],t=0;t<arguments.length;t++)e=e.concat(bt(arguments[t]));return e}const xt=oe();tt();rt();const ae=at("media",{state:()=>({loading:!1,modal:!1,title:"",id:"",total:0,current:1,per_page:0,form:{filetitle:"",assigned_to:"",note:"",files:[]},mediaList:[]}),actions:{async save(e){try{this.loading=!0;const t=await this.axios.post("media",e,{headers:{"Content-Type":"multipart/form-data"}}),n=ce.currentRoute.value.params;xt.get_column(n.id,n.module,n.related_module),this.loading=!1,this.clearFile()}catch{}},async del(e){try{this.loading=!0,(await this.axios.delete("media/"+e)).data.status==200&&this.list()}catch{}},async download(e,t,n){try{this.loading=!0;const r=await this.axios.get("media",{params:{filename:e,extension:t,path:n},responseType:"blob"}),o=URL.createObjectURL(r.data),a=document.createElement("a");a.href=o,a.setAttribute("download",e+"."+t),document.body.appendChild(a),a.click(),document.body.removeChild(a),URL.revokeObjectURL(o),this.loading=!1}catch{}},clearFile(){this.form.files=[],this.form.assigned_to="",this.form.filetitle="",this.form.note="",this.modal=!1}}});var Ae={},kt=new Map([["avi","video/avi"],["gif","image/gif"],["ico","image/x-icon"],["jpeg","image/jpeg"],["jpg","image/jpeg"],["mkv","video/x-matroska"],["mov","video/quicktime"],["mp4","video/mp4"],["pdf","application/pdf"],["png","image/png"],["zip","application/zip"],["doc","application/msword"],["docx","application/vnd.openxmlformats-officedocument.wordprocessingml.document"]]);function le(e,t){var n=Ct(e);if(typeof n.path!="string"){var r=e.webkitRelativePath;Object.defineProperty(n,"path",{value:typeof t=="string"?t:typeof r=="string"&&r.length>0?r:e.name,writable:!1,configurable:!1,enumerable:!0})}return n}function Ct(e){var t=e.name,n=t&&t.lastIndexOf(".")!==-1;if(n&&!e.type){var r=t.split(".").pop().toLowerCase(),o=kt.get(r);o&&Object.defineProperty(e,"type",{value:o,writable:!1,configurable:!1,enumerable:!0})}return e}var Dt=[".DS_Store","Thumbs.db"];function Ft(e){return K(this,void 0,void 0,function(){return W(this,function(t){return[2,Mt(e)&&e.dataTransfer?Pt(e.dataTransfer,e.type):$t(e)]})})}function Mt(e){return!!e.dataTransfer}function $t(e){var t=St(e.target)?e.target.files?fe(e.target.files):[]:[];return t.map(function(n){return le(n)})}function St(e){return e!==null}function Pt(e,t){return K(this,void 0,void 0,function(){var n,r;return W(this,function(o){switch(o.label){case 0:return e.items?(n=fe(e.items).filter(function(a){return a.kind==="file"}),t!=="drop"?[2,n]:[4,Promise.all(n.map(Tt))]):[3,2];case 1:return r=o.sent(),[2,xe(Re(r))];case 2:return[2,xe(fe(e.files).map(function(a){return le(a)}))]}})})}function xe(e){return e.filter(function(t){return Dt.indexOf(t.name)===-1})}function fe(e){for(var t=[],n=0;n<e.length;n++){var r=e[n];t.push(r)}return t}function Tt(e){if(typeof e.webkitGetAsEntry!="function")return ke(e);var t=e.webkitGetAsEntry();return t&&t.isDirectory?ze(t):ke(e)}function Re(e){return e.reduce(function(t,n){return wt(t,Array.isArray(n)?Re(n):[n])},[])}function ke(e){var t=e.getAsFile();if(!t)return Promise.reject(e+" is not a File");var n=le(t);return Promise.resolve(n)}function Et(e){return K(this,void 0,void 0,function(){return W(this,function(t){return[2,e.isDirectory?ze(e):jt(e)]})})}function ze(e){var t=e.createReader();return new Promise(function(n,r){var o=[];function a(){var u=this;t.readEntries(function(c){return K(u,void 0,void 0,function(){var v,s,i;return W(this,function(p){switch(p.label){case 0:if(c.length)return[3,5];p.label=1;case 1:return p.trys.push([1,3,,4]),[4,Promise.all(o)];case 2:return v=p.sent(),n(v),[3,4];case 3:return s=p.sent(),r(s),[3,4];case 4:return[3,6];case 5:i=Promise.all(c.map(Et)),o.push(i),a(),p.label=6;case 6:return[2]}})})},function(c){r(c)})}a()})}function jt(e){return K(this,void 0,void 0,function(){return W(this,function(t){return[2,new Promise(function(n,r){e.file(function(o){var a=le(o,e.fullPath);n(a)},function(o){r(o)})})]})})}const Ot=Object.freeze(Object.defineProperty({__proto__:null,fromEvent:Ft},Symbol.toStringTag,{value:"Module"})),Bt=lt(Ot);var ve={};ve.__esModule=!0;ve.default=function(e,t){if(e&&t){var n=Array.isArray(t)?t:t.split(","),r=e.name||"",o=(e.type||"").toLowerCase(),a=o.replace(/\/.*$/,"");return n.some(function(u){var c=u.trim().toLowerCase();return c.charAt(0)==="."?r.toLowerCase().endsWith(c):c.endsWith("/*")?a===c.replace(/\/.*$/,""):o===c})}return!0};Object.defineProperty(Ae,"__esModule",{value:!0});var F=it,At=Bt;function Rt(e){return e&&typeof e=="object"&&"default"in e?e:{default:e}}var zt=Rt(ve),_=function(){return(_=Object.assign||function(e){for(var t,n=1,r=arguments.length;n<r;n++)for(var o in t=arguments[n])Object.prototype.hasOwnProperty.call(t,o)&&(e[o]=t[o]);return e}).apply(this,arguments)};function Ce(e,t){var n={};for(var r in e)Object.prototype.hasOwnProperty.call(e,r)&&t.indexOf(r)<0&&(n[r]=e[r]);if(e!=null&&typeof Object.getOwnPropertySymbols=="function"){var o=0;for(r=Object.getOwnPropertySymbols(e);o<r.length;o++)t.indexOf(r[o])<0&&Object.prototype.propertyIsEnumerable.call(e,r[o])&&(n[r[o]]=e[r[o]])}return n}function It(e,t,n,r){return new(n||(n=Promise))(function(o,a){function u(s){try{v(r.next(s))}catch(i){a(i)}}function c(s){try{v(r.throw(s))}catch(i){a(i)}}function v(s){var i;s.done?o(s.value):(i=s.value,i instanceof n?i:new n(function(p){p(i)})).then(u,c)}v((r=r.apply(e,t||[])).next())})}function Lt(e,t){var n,r,o,a,u={label:0,sent:function(){if(1&o[0])throw o[1];return o[1]},trys:[],ops:[]};return a={next:c(0),throw:c(1),return:c(2)},typeof Symbol=="function"&&(a[Symbol.iterator]=function(){return this}),a;function c(v){return function(s){return function(i){if(n)throw new TypeError("Generator is already executing.");for(;u;)try{if(n=1,r&&(o=2&i[0]?r.return:i[0]?r.throw||((o=r.return)&&o.call(r),0):r.next)&&!(o=o.call(r,i[1])).done)return o;switch(r=0,o&&(i=[2&i[0],o.value]),i[0]){case 0:case 1:o=i;break;case 4:return u.label++,{value:i[1],done:!1};case 5:u.label++,r=i[1],i=[0];continue;case 7:i=u.ops.pop(),u.trys.pop();continue;default:if(o=u.trys,!((o=o.length>0&&o[o.length-1])||i[0]!==6&&i[0]!==2)){u=0;continue}if(i[0]===3&&(!o||i[1]>o[0]&&i[1]<o[3])){u.label=i[1];break}if(i[0]===6&&u.label<o[1]){u.label=o[1],o=i;break}if(o&&u.label<o[2]){u.label=o[2],u.ops.push(i);break}o[2]&&u.ops.pop(),u.trys.pop();continue}i=t.call(e,u)}catch(p){i=[6,p],r=0}finally{n=o=0}if(5&i[0])throw i[1];return{value:i[0]?i[1]:void 0,done:!0}}([v,s])}}}function pe(e,t){for(var n=0,r=t.length,o=e.length;n<r;n++,o++)e[o]=t[n];return e}function De(e){e.preventDefault()}function J(e){return e.dataTransfer?Array.prototype.some.call(e.dataTransfer.types,function(t){return t==="Files"||t==="application/x-moz-file"}):!!e.target&&!!e.target.files}function te(e){return typeof e.isPropagationStopped=="function"?e.isPropagationStopped():e.cancelBubble!==void 0&&e.cancelBubble}var Nt={code:"too-many-files",message:"Too many files"},Ut=function(e){return e=Array.isArray(e)&&e.length===1?e[0]:e,{code:"file-invalid-type",message:"File type must be "+(Array.isArray(e)?"one of "+e.join(", "):e)}};function q(e){return e!=null}function Fe(e,t){var n=e.type==="application/x-moz-file"||zt.default(e,t);return[n,n?null:Ut(t)]}var Me=function(e){return{code:"file-too-large",message:"File is larger than "+e+" bytes"}},$e=function(e){return{code:"file-too-small",message:"File is smaller than "+e+" bytes"}};function Se(e,t,n){if(q(e.size)&&e.size)if(q(t)&&q(n)){if(e.size>n)return[!1,Me(n)];if(e.size<t)return[!1,$e(t)]}else{if(q(t)&&e.size<t)return[!1,$e(t)];if(q(n)&&e.size>n)return[!1,Me(n)]}return[!0,null]}function T(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];return function(n){for(var r=[],o=1;o<arguments.length;o++)r[o-1]=arguments[o];return e.some(function(a){return!te(n)&&a&&a.apply(void 0,pe([n],r)),te(n)})}}var Vt={disabled:!1,getFilesFromEvent:At.fromEvent,maxSize:1/0,minSize:0,multiple:!0,maxFiles:0,preventDropOnDocument:!0,noClick:!1,noKeyboard:!1,noDrag:!1,noDragEventsBubbling:!1};function qt(e,t){switch(t.type){case"focus":return _(_({},e),{isFocused:!0});case"blur":return _(_({},e),{isFocused:!1});case"openDialog":return _(_({},e),{isFileDialogActive:!0});case"closeDialog":return _(_({},e),{isFileDialogActive:!1});case"setDraggedFiles":var n=t.isDragActive,r=t.draggedFiles;return _(_({},e),{draggedFiles:r,isDragActive:n});case"setFiles":return _(_({},e),{acceptedFiles:t.acceptedFiles,fileRejections:t.fileRejections});case"reset":return _(_({},e),{isFileDialogActive:!1,isDragActive:!1,draggedFiles:[],acceptedFiles:[],fileRejections:[]});default:return e}}var Gt=Ae.useDropzone=function(e){e===void 0&&(e={});var t=F.ref(_(_({},Vt),e));F.watch(function(){return _({},e)},function(l){t.value=_(_({},t.value),l)});var n=F.ref(),r=F.ref(),o=function(l,f,b){var x=F.reactive(f),k=function($){var M=l(F.toRaw(x),$);Object.keys(M).forEach(function(P){x[P]=M[P]})};return b!=null&&k(b),[x,k]}(qt,{isFocused:!1,isFileDialogActive:!1,isDragActive:!1,isDragAccept:!1,isDragReject:!1,draggedFiles:[],acceptedFiles:[],fileRejections:[]}),a=o[0],u=o[1],c=function(){r.value&&(u({type:"openDialog"}),r.value.value="",r.value.click())},v=function(){var l=t.value.onFileDialogCancel;a.isFileDialogActive&&setTimeout(function(){if(r.value){var f=r.value.files;f&&!f.length&&(u({type:"closeDialog"}),typeof l=="function"&&l())}},300)};function s(l){n.value&&(n.value.$el||n.value).isEqualNode(l.target)&&(l.keyCode!==32&&l.keyCode!==13||(l.preventDefault(),c()))}function i(){u({type:"focus"})}function p(){u({type:"blur"})}function z(){var l;t.value.noClick||(l===void 0&&(l=window.navigator.userAgent),function(f){return f.includes("MSIE")||f.includes("Trident/")}(l)||function(f){return f.includes("Edge/")}(l)?setTimeout(c,0):c())}var S=F.ref([]),D=function(l){n.value&&((n.value.$el||n.value).contains(l.target)||(l.preventDefault(),S.value=[]))};function A(l){t.value.noDragEventsBubbling&&l.stopPropagation()}function Ie(l){return It(this,void 0,void 0,function(){var f,b,x,k,$;return Lt(this,function(M){switch(M.label){case 0:return f=t.value,b=f.getFilesFromEvent,x=f.noDragEventsBubbling,k=f.onDragEnter,l.preventDefault(),A(l),S.value=pe(pe([],S.value),[l.target]),J(l)?b?[4,b(l)]:[2]:[3,2];case 1:if(($=M.sent())||($=[]),te(l)&&!x)return[2];u({draggedFiles:$,isDragActive:!0,type:"setDraggedFiles"}),k&&k(l),M.label=2;case 2:return[2]}})})}function Le(l){var f=t.value.onDragOver;if(l.preventDefault(),A(l),l.dataTransfer)try{l.dataTransfer.dropEffect="copy"}catch{}return J(l)&&f&&f(l),!1}function Ne(l){l.preventDefault(),A(l);var f=S.value.filter(function(k){return!!n.value&&(n.value.$el||n.value).contains(k)}),b=f.indexOf(l.target);if(b!==-1&&f.splice(b,1),S.value=f,!(f.length>0)){u({isDragActive:!1,type:"setDraggedFiles",draggedFiles:[]});var x=t.value.onDragLeave;J(l)&&x&&x(l)}}function ge(l){l.preventDefault(),A(l),S.value=[];var f=t.value,b=f.getFilesFromEvent,x=f.noDragEventsBubbling,k=f.accept,$=f.minSize,M=f.maxSize,P=f.multiple,L=f.maxFiles,N=f.onDrop,Q=f.onDropRejected,X=f.onDropAccepted;if(J(l)){if(!b)return;Promise.resolve(b(l)).then(function(se){if(!te(l)||x){var O=[],U=[];se.forEach(function(V){var ye=Fe(V,k),qe=ye[0],Ge=ye[1],be=Se(V,$,M),Ke=be[0],We=be[1];if(qe&&Ke)O.push(V);else{var Ye=[Ge,We].filter(function(Qe){return Qe});U.push({file:V,errors:Ye})}}),(!P&&O.length>1||P&&L>=1&&O.length>L)&&(O.forEach(function(V){U.push({file:V,errors:[Nt]})}),O.splice(0)),u({acceptedFiles:O,fileRejections:U,type:"setFiles"}),N&&N(O,U,l),U.length>0&&Q&&Q(U,l),O.length>0&&X&&X(O,l)}})}u({type:"reset"})}F.onMounted(function(){window.addEventListener("focus",v,!1),t.value.preventDropOnDocument&&(document.addEventListener("dragover",De,!1),document.addEventListener("drop",D,!1))}),F.onUnmounted(function(){window.removeEventListener("focus",v,!1),t.value.preventDropOnDocument&&(document.removeEventListener("dragover",De),document.removeEventListener("drop",D))});var I=function(l){return t.value.disabled?void 0:l},ie=function(l){return t.value.noKeyboard?void 0:I(l)},Y=function(l){return t.value.noDrag?void 0:I(l)},Ue=function(l){l.stopPropagation()},he=F.computed(function(){return a.draggedFiles?a.draggedFiles.length:0}),_e=F.computed(function(){return he.value>0&&function(l){var f=l.files,b=l.accept,x=l.minSize,k=l.maxSize,$=l.multiple,M=l.maxFiles;return!(!$&&f.length>1||$&&M>=1&&f.length>M)&&f.every(function(P){var L=Fe(P,b)[0],N=Se(P,x,k)[0];return L&&N})}({files:a.draggedFiles,accept:t.value.accept,minSize:t.value.minSize,maxSize:t.value.maxSize,multiple:t.value.multiple,maxFiles:t.value.maxFiles})}),Ve=F.computed(function(){return he.value>0&&!_e.value});return _(_({},F.toRefs(a)),{isDragAccept:_e,isDragReject:Ve,isFocused:F.computed(function(){return a.isFocused&&!t.value.disabled}),getRootProps:function(l){l===void 0&&(l={});var f=l.onKeyDown,b=l.onFocus,x=l.onBlur,k=l.onClick,$=l.onDragEnter,M=l.onDragenter,P=l.onDragOver,L=l.onDragover,N=l.onDragLeave,Q=l.onDragleave,X=l.onDrop,se=Ce(l,["onKeyDown","onFocus","onBlur","onClick","onDragEnter","onDragenter","onDragOver","onDragover","onDragLeave","onDragleave","onDrop"]);return _(_({onKeyDown:ie(T(f,s)),onFocus:ie(T(b,i)),onBlur:ie(T(x,p)),onClick:I(T(k,z)),onDragenter:Y(T($,M,Ie)),onDragover:Y(T(P,L,Le)),onDragleave:Y(T(N,Q,Ne)),onDrop:Y(T(X,ge)),ref:n},t.value.disabled||t.value.noKeyboard?{}:{tabIndex:0}),se)},getInputProps:function(l){l===void 0&&(l={});var f=l.onChange,b=l.onClick,x=Ce(l,["onChange","onClick"]),k={accept:t.value.accept,multiple:t.value.multiple,style:"display: none",type:"file",onChange:I(T(f,ge)),onClick:I(T(b,Ue)),autoComplete:"off",tabIndex:-1,ref:r};return _(_({},k),x)},rootRef:n,inputRef:r,open:I(c)})};const Kt=st({components:{Icon:me,TransitionRoot:mt,TransitionChild:vt,Dialog:gt,DialogPanel:ht},props:{labelClass:{type:String,default:"btn-primary"},centered:{type:Boolean,default:!1},title:{type:String,default:"Basic Modal"},label:{type:String,default:"Basic Modal"},disableBackdrop:{type:Boolean,default:!1},noFade:{type:Boolean,default:!1},themeClass:{type:String,default:"bg-slate-900 dark:bg-slate-800 dark:border-b dark:border-slate-700"},sizeClass:{type:String,default:"max-w-xl"},scrollContent:{type:Boolean,default:!1},activeModal:{type:Boolean,default:!1}},setup(e){const t=re(e.activeModal);return{closeModal:()=>{t.value=!1},openModal:()=>{t.value=!t.value},isOpen:t}}}),Wt={class:"fixed inset-0 overflow-y-auto"},Yt={key:0,class:"capitalize leading-6 tracking-wider font-medium text-base text-white"},Qt={key:0,class:"px-4 py-3 flex justify-end space-x-3 border-t border-slate-100 dark:border-slate-700"},Xt={class:"fixed inset-0 overflow-y-auto"},Ht={key:0,class:"capitalize leading-6 tracking-wider font-medium text-base text-white"},Jt={key:0,class:"px-4 py-3 flex justify-end space-x-3 border-t border-slate-100 dark:border-slate-700"};function Zt(e,t,n,r,o,a){const u=h("TransitionChild"),c=h("Icon"),v=h("DialogPanel"),s=h("Dialog"),i=h("TransitionRoot");return g(),w(je,null,[d("button",{type:"button",onClick:t[0]||(t[0]=(...p)=>e.openModal&&e.openModal(...p)),class:B(["btn",e.labelClass])},G(e.label),3),m(i,{show:e.isOpen,as:"template"},{default:y(()=>[e.disableBackdrop===!1?(g(),E(s,{key:0,as:"div",onClose:e.closeModal,class:"relative z-[999]"},{default:y(()=>[m(u,{enter:e.noFade?"":"duration-300 ease-out","enter-from":e.noFade?"":"opacity-0","enter-to":e.noFade?"":"opacity-100",leave:e.noFade?"":"duration-300 ease-in","leave-from":e.noFade?"":"opacity-100","leave-to":e.noFade?"":"opacity-0"},{default:y(()=>t[3]||(t[3]=[d("div",{class:"fixed inset-0 bg-slate-900/50 backdrop-filter backdrop-blur-sm"},null,-1)])),_:1},8,["enter","enter-from","enter-to","leave","leave-from","leave-to"]),d("div",Wt,[d("div",{class:B(["flex min-h-full justify-center text-center p-6",e.centered?"items-center":"items-start "])},[m(u,{as:"template",enter:e.noFade?"":"duration-300  ease-out","enter-from":e.noFade?"":"opacity-0 scale-95","enter-to":e.noFade?"":"opacity-100 scale-100",leave:e.noFade?"":"duration-200 ease-in","leave-from":e.noFade?"":"opacity-100 scale-100","leave-to":e.noFade?"":"opacity-0 scale-95"},{default:y(()=>[m(v,{class:B(["w-full transform overflow-hidden rounded-md bg-white dark:bg-slate-800 text-left align-middle shadow-xl transition-all",e.sizeClass])},{default:y(()=>[d("div",{class:B(["relative overflow-hidden py-4 px-5 text-white flex justify-between",e.themeClass])},[e.title?(g(),w("h2",Yt,G(e.title),1)):j("",!0),d("button",{onClick:t[1]||(t[1]=(...p)=>e.closeModal&&e.closeModal(...p)),class:"text-[22px]"},[m(c,{icon:"heroicons-outline:x"})])],2),d("div",{class:B(["px-6 py-8",e.scrollContent?"overflow-y-auto max-h-[400px]":""])},[H(e.$slots,"default")],2),e.$slots.footer?(g(),w("div",Qt,[H(e.$slots,"footer")])):j("",!0)]),_:3},8,["class"])]),_:3},8,["enter","enter-from","enter-to","leave","leave-from","leave-to"])],2)])]),_:3},8,["onClose"])):(g(),E(s,{key:1,as:"div",class:"relative z-[999]"},{default:y(()=>[d("div",Xt,[d("div",{class:B(["flex min-h-full justify-center text-center p-6",e.centered?"items-center":"items-start "])},[m(u,{as:"template",enter:e.noFade?"":"duration-300  ease-out","enter-from":e.noFade?"":"opacity-0 scale-95","enter-to":e.noFade?"":"opacity-100 scale-100",leave:e.noFade?"":"duration-200 ease-in","leave-from":e.noFade?"":"opacity-100 scale-100","leave-to":e.noFade?"":"opacity-0 scale-95"},{default:y(()=>[m(v,{class:B(["w-full transform overflow-hidden rounded-md bg-white dark:bg-slate-800 text-left align-middle shadow-xl transition-all",e.sizeClass])},{default:y(()=>[d("div",{class:B(["relative overflow-hidden py-4 px-5 text-white flex justify-between",e.themeClass])},[e.title?(g(),w("h2",Ht,G(e.title),1)):j("",!0),d("button",{onClick:t[2]||(t[2]=(...p)=>e.closeModal&&e.closeModal(...p)),class:"text-[22px]"},[m(c,{icon:"heroicons-outline:x"})])],2),d("div",{class:B(["px-6 py-8",e.scrollContent?"overflow-y-auto max-h-[400px]":""])},[H(e.$slots,"default")],2),e.$slots.footer?(g(),w("div",Jt,[H(e.$slots,"footer")])):j("",!0)]),_:3},8,["class"])]),_:3},8,["enter","enter-from","enter-to","leave","leave-from","leave-to"])],2)])]),_:3}))]),_:3},8,["show"])],64)}const en=R(Kt,[["render",Zt]]),Pe=_t(),tn={props:["assigned_to"],emits:["update:assigned_to"],components:{Select:ft},data(){return{dropdown_store:Pe}},mounted(){Pe.get_assigned_to()},methods:{selected_assigned(e){this.$emit("update:assigned_to",e.value)}}},nn={class:"fromGroup relative"};function on(e,t,n,r,o,a){const u=h("Select");return g(),w("div",null,[d("div",nn,[t[0]||(t[0]=d("label",{class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"},[Oe(" Assigned To "),d("span",{class:"text-red-500"},"*")],-1)),m(u,{placeholder:"Select an option","onOption:selected":a.selected_assigned,reduce:c=>c.id,options:o.dropdown_store.assigned_to},null,8,["onOption:selected","reduce","options"])])])}const rn=R(tn,[["render",on]]),an="/assets/upload-7ea9ffeb.svg",ln=oe(),sn={setup(){const e=ae();function t(s){s.map(i=>{e.form.files.push(i)})}function n(){e.form.files=[],e.modal=!1}function r(s){e.form.files.splice(s,1)}function o(s){console.log(s.target.files[0])}const a=()=>{var s="";if(e.form.files.length==0&&(s+='<span class="text-red-500"><b>File Upload</b> is required field</span><br>'),e.form.filetitle==""&&(s+='<span class="text-red-500"><b>File Title</b> is required field</span><br>'),e.form.assigned_to==""&&(s+='<span class="text-red-500"><b>Assgined To</b> is required field</span><br>'),s!="")return Be.fire({icon:"error",title:"Fill up the Required field",html:s}),!1;if(s==""){ln.loading=!0;const p=ce.currentRoute.value.params.id,z=ce.currentRoute.value.params.module;var i=new FormData;e.id=p,i.append("id",p),i.append("module",z),i.append("filetitle",e.form.filetitle),i.append("note",e.form.note),i.append("assigned_to",e.form.assigned_to),e.form.files.map(S=>{i.append("files[]",S)}),e.save(i)}n()},{getRootProps:u,getInputProps:c,...v}=Gt({onDrop:t});return{getRootProps:u,getInputProps:c,closeModal:n,removeFile:r,SaveMedia:a,changeFile:o,...v,media:e}},components:{Modal:en,Icon:me,Button:ne,Textarea:pt,Textinput:ct,assigned_to:rn}},un={class:"lg:grid lg:grid-cols-2 gap-4 mb-4"},dn={class:"fromGroup relative"},cn={class:"mb-4"},fn={class:"fromGroup relative"},pn={key:0,class:"text-sm text-slate-500 dark:text-slate-300 font-light"},mn={key:1,class:"text-sm text-slate-500 dark:text-slate-300 font-light"},vn={class:"list-item space-y-3 h-full overflow-x-auto mt-5"},gn={class:"text-start overflow-hidden text-ellipsis whitespace-nowrap max-w-[63%]"},hn={class:"text-sm text-slate-600 dark:text-slate-300 overflow-hidden text-ellipsis whitespace-nowrap"},_n={class:"flex-1 ltr:text-right rtl:text-left"},yn={class:"text-sm font-light text-slate-400 dark:text-slate-400"},bn={class:"w-full flex justify-between mt-5"};function wn(e,t,n,r,o,a){const u=h("Textinput"),c=h("assigned_to"),v=h("Textarea"),s=h("Button");return g(),w("div",null,[d("div",un,[d("div",dn,[t[5]||(t[5]=d("label",{class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"},[Oe(" File Title "),d("span",{class:"text-red-500"},"*")],-1)),m(u,{modelValue:r.media.form.filetitle,"onUpdate:modelValue":t[0]||(t[0]=i=>r.media.form.filetitle=i)},null,8,["modelValue"])]),m(c,{assigned_to:r.media.form.assigned_to,"onUpdate:assigned_to":t[1]||(t[1]=i=>r.media.form.assigned_to=i)},null,8,["assigned_to"])]),d("div",cn,[d("div",fn,[t[6]||(t[6]=d("label",{class:"flex-0 mr-6 break-words ltr:inline-block rtl:block input-label"}," Note ",-1)),m(v,{modelValue:r.media.form.note,"onUpdate:modelValue":t[2]||(t[2]=i=>r.media.form.note=i)},null,8,["modelValue"])])]),t[8]||(t[8]=d("br",null,null,-1)),d("div",we(r.getRootProps(),{class:"w-full text-center border-dashed border border-secondary-500 rounded-md py-[52px] flex flex-col justify-center items-center"}),[d("div",null,[d("input",we(r.getInputProps(),{class:"hidden"}),null,16),t[7]||(t[7]=d("img",{src:an,alt:"",class:"mx-auto mb-4"},null,-1)),e.isDragActive?(g(),w("p",pn," Drop the files here ... ")):(g(),w("p",mn," Drop files here or click to upload. "))])],16),d("ul",vn,[(g(!0),w(je,null,ut(r.media.form.files,(i,p)=>(g(),w("li",{class:"flex items-center space-x-3 rtl:space-x-reverse border-b border-slate-100 dark:border-slate-700 last:border-b-0 pb-3 last:pb-0",key:p},[d("div",gn,[d("div",hn,G(p+1)+". "+G(i.name),1)]),d("div",_n,[d("div",yn,[m(s,{icon:"heroicons-outline:trash",btnClass:"inline-flex items-center justify-center h-10 w-10 bg-danger-500 text-lg border rounded border-danger-500 text-white",onClick:z=>r.removeFile(p)},null,8,["onClick"])])])]))),128))]),d("div",bn,[m(s,{text:"Close",btnClass:"btn-dark",onClick:t[3]||(t[3]=i=>r.closeModal())}),m(s,{text:"Save Media",btnClass:"btn-danger",onClick:t[4]||(t[4]=i=>r.SaveMedia())})])])}const xn=R(sn,[["render",wn]]);ae();const kn={props:{previewContent:{type:String,default:""}}},Cn=["src"],Dn=["src"];function Fn(e,t,n,r,o,a){return g(),w("div",null,[n.previewContent.type=="image/png"||n.previewContent.type=="image/jpg"||n.previewContent.type=="image/svg+xml"?(g(),w("img",{key:0,src:n.previewContent.preview,style:{"max-height":"500px",width:"100%"}},null,8,Cn)):(g(),w("iframe",{key:1,src:n.previewContent.preview,style:{width:"100%","min-height":"500px"},frameborder:"0"},null,8,Dn))])}const Mn=R(kn,[["render",Fn]]);const ue=ae();re("Media");const $n={props:{previewContent:{default:"",type:String}},components:{Modal:Ee,Button:ne,Media:xn,Preview:Mn},data(){return{media:ue}},methods:{closeModal(){ue.form.files=[],ue.modal=!1}}};function Sn(e,t,n,r,o,a){const u=h("Media"),c=h("Preview"),v=h("Modal",!0);return g(),w("div",null,[m(v,{title:o.media.title,activeModal:o.media.modal,onClose:a.closeModal,sizeClass:"max-w-5xl"},{default:y(()=>[o.media.title=="Media"?(g(),E(u,{key:0})):j("",!0),o.media.title=="Preview"?(g(),E(c,{key:1,"preview-content":n.previewContent},null,8,["preview-content"])):j("",!0)]),_:1},8,["title","activeModal","onClose"])])}const Pn=R($n,[["render",Sn]]);const Te=oe(),Tn={props:{title:{type:String,default:""},method:{type:String,default:"edit"}},components:{Modal:Ee,Button:ne,save:yt,detail:Xe},data(){return{related_store:Te}},methods:{closeModal(){Te.modal=!1}}};function En(e,t,n,r,o,a){const u=h("save"),c=h("detail"),v=h("Modal",!0);return g(),w("div",null,[m(v,{title:n.title,activeModal:o.related_store.modal,onClose:a.closeModal,sizeClass:"max-w-9xl"},{default:y(()=>[n.method=="edit"?(g(),E(u,{key:0,props_module:this.$route.params.module,props_related_module:this.$route.params.related_module},null,8,["props_module","props_related_module"])):n.method=="view"?(g(),E(c,{key:1,props_module:o.related_store.related_module,props_id:o.related_store.id},null,8,["props_module","props_id"])):j("",!0)]),_:1},8,["title","activeModal","onClose"])])}const jn=R(Tn,[["render",En]]),On=dt(),C=oe(),Z=ae(),de=re(""),ee=re(""),Bn={components:{Card:et,InputGroup:Ze,Pagination:nt,Tooltip:ot,Button:ne,Icon:me,Modal:Pn,RelatedModal:jn},data(){return{related_store:C,preview_content_data:de,method:ee}},created(){C.page.current=1,C.modal=!1,this.$watch(()=>this.$route.params.related_module,e=>{const t=this.$route.params;C.get_column(t.id,t.module,t.related_module)})},mounted(){const e=this.$route.params;C.get_column(e.id,e.module,e.related_module)},computed:{modules_(){const e=this.$route.params.related_module;return On.module.find(n=>n.name==e)}},methods:{openMediaModal(){Z.title="Media",Z.modal=!0},changePage(e){C.page.current=e,C.get_related_list(this.$route.params.id,this.$route.params.module,this.$route.params.related_module)},preview(e,t,n){de.value={name:e,preview:t,type:n},console.log(de.value),Z.title="Preview",Z.modal=!0},openSaveRelatedModal(){ee.value="edit",C.id="",C.modal=!0},edit(e){ee.value="edit",C.id=e,C.loading=!0,C.modal=!0},view(e){ee.value="view",C.id=e,C.related_module=this.$route.params.related_module,C.modal=!0},del(e,t){const n=this.modules_.label;Be.fire({title:"Unlink "+n+" ",text:"Are you sure you want to unlink this "+n+"? ",showCancelButton:!0,confirmButtonColor:"#d33",confirmButtonText:"Unlink",cancelButtonColor:"#3085d6",reverseButtons:!0}).then(r=>{r.isConfirmed&&C.delete(this.$route.params.module,this.$route.params.related_module,this.$route.params.id,e,t)})}}},An={class:"flex justify-end"},Rn={key:0},zn={class:"flex space-x-3 justify-center rtl:space-x-reverse"},In=["onClick"],Ln={class:"action-btn"},Nn=["onClick"],Un=["onClick"],Vn=["onClick"],qn={class:"py-4 px-3 flex justify-center"};function Gn(e,t,n,r,o,a){const u=h("Button"),c=h("Modal"),v=h("RelatedModal"),s=h("Icon"),i=h("Tooltip"),p=h("Pagination"),z=h("vue-good-table"),S=h("Card");return g(),w("div",null,[m(S,{class:"mt-4",title:a.modules_.label},{default:y(()=>[t[4]||(t[4]=d("br",null,null,-1)),d("div",An,[this.$route.params.related_module=="media"?(g(),E(u,{key:0,icon:"heroicons-outline:plus",text:`New ${this.$route.params.related_module}`,btnClass:"btn-danger mr-2 py-2",onClick:a.openMediaModal},null,8,["text","onClick"])):(g(),E(u,{key:1,icon:"heroicons-outline:plus",text:`New ${this.$route.params.related_module}`,btnClass:"btn-danger mr-2 py-2",onClick:a.openSaveRelatedModal},null,8,["text","onClick"]))]),m(c,{"preview-content":o.preview_content_data},null,8,["preview-content"]),m(v,{method:o.method,title:a.modules_.label},null,8,["method","title"]),t[5]||(t[5]=d("br",null,null,-1)),t[6]||(t[6]=d("br",null,null,-1)),m(z,{"fixed-header":!0,isLoading:o.related_store.loading,columns:o.related_store.columns_header,styleClass:" vgt-table  lesspadding2 centered ",rows:o.related_store.list_data,"pagination-options":{enabled:!0,perPage:15},"max-height":"600px","select-options":{enabled:!0,selectOnCheckboxOnly:!0,selectioninfoClass:"custom-class",selectionText:"rows selected",clearSelectionText:"clear",disableSelectinfo:!0,selectAllByGroup:!0}},{"table-row":y(D=>[D.column.field=="action"?(g(),w("span",Rn,[d("div",zn,[D.row.view!=""&&this.$route.params.related_module=="media"?(g(),E(i,{key:0,placement:"top",arrow:"",theme:"dark"},{button:y(()=>[d("a",{onClick:A=>a.preview(D.row.filename,D.row.path,D.row.filetype)},[d("div",Ln,[m(s,{icon:"heroicons:photo"})])],8,In)]),default:y(()=>[t[0]||(t[0]=d("span",null,"Preview",-1))]),_:2},1024)):j("",!0),m(i,{placement:"top",arrow:"",theme:"dark"},{button:y(()=>[d("div",{class:"action-btn",onClick:A=>a.view(D.row.id)},[m(s,{icon:"heroicons:eye"})],8,Nn)]),default:y(()=>[t[1]||(t[1]=d("span",null," View",-1))]),_:2},1024),this.$route.params.related_module!="media"?(g(),E(i,{key:1,placement:"top",arrow:"",theme:"dark"},{button:y(()=>[d("div",{class:"action-btn",onClick:A=>a.edit(D.row.id)},[m(s,{icon:"heroicons:pencil-square"})],8,Un)]),default:y(()=>[t[2]||(t[2]=d("span",null," Edit",-1))]),_:2},1024)):j("",!0),m(i,{placement:"top",arrow:"",theme:"danger-500"},{button:y(()=>[d("div",{class:"action-btn text-red-500",onClick:A=>a.del(D.row.id,D.row.originalIndex)},[m(s,{icon:"heroicons:trash"})],8,Vn)]),default:y(()=>[t[3]||(t[3]=d("span",null,"Delete",-1))]),_:2},1024)])])):j("",!0)]),"pagination-bottom":y(D=>[d("div",qn,[m(p,{total:o.related_store.page.total,current:o.related_store.page.current,"per-page":o.related_store.page.per_page,onPageChanged:a.changePage,perPageChanged:D.perPageChanged},null,8,["total","current","per-page","onPageChanged","perPageChanged"])])]),_:1},8,["isLoading","columns","rows"])]),_:1},8,["title"])])}const Kn=R(Bn,[["render",Gn]]),Wn={components:{Menu:He,Breadcrum:Je,Relatedlist:Kn}};function Yn(e,t,n,r,o,a){const u=h("Breadcrum"),c=h("Menu"),v=h("Relatedlist");return g(),w("div",null,[m(u,{mode:"view"}),m(c),m(v)])}const go=R(Wn,[["render",Yn]]);export{go as default};
