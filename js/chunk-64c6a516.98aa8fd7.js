(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-64c6a516"],{"1f7f":function(t,e,r){"use strict";r.r(e);var n=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"animated fadeIn"},[r("b-row",[r("b-col",[r("c-table",{attrs:{"table-data":t.items,fields:t.fields,caption:"订单列表"}})],1)],1)],1)},a=[],o=(r("8992"),function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("b-card",{attrs:{header:t.caption}},[r("b-table",{attrs:{dark:t.dark,hover:t.hover,striped:t.striped,bordered:t.bordered,small:t.small,fixed:t.fixed,responsive:"sm",items:t.items,fields:t.captions,"current-page":t.currentPage,"per-page":t.perPage},scopedSlots:t._u([{key:"status",fn:function(e){return[r("b-badge",{attrs:{variant:t.getBadge(e.item.status)}},[t._v(t._s(e.item.status))])]}}])})],1)}),i=[],c=(r("b06f"),{name:"c-table",inheritAttrs:!1,props:{caption:{type:String,default:""},hover:{type:Boolean,default:!1},striped:{type:Boolean,default:!1},bordered:{type:Boolean,default:!1},small:{type:Boolean,default:!1},fixed:{type:Boolean,default:!1},tableData:{type:[Array,Function],default:function(){return[]}},fields:{type:[Array,Object],default:function(){return[]}},perPage:{type:Number,default:5},dark:{type:Boolean,default:!1}},data:function(){return{currentPage:1}},computed:{items:function(){var t=this.tableData;return Array.isArray(t)?t:t()},totalRows:function(){return this.getRowCount()},captions:function(){return this.fields}},methods:{getBadge:function(t){return"Active"===t?"success":"Inactive"===t?"secondary":"Pending"===t?"warning":"Banned"===t?"danger":"primary"},getRowCount:function(){return this.items.length}}}),u=c,f=r("17cc"),s=Object(f["a"])(u,o,i,!1,null,null,null),l=s.exports,d=function(){return[{orderId:"afghryhewqwrty4jrnebrsf",oneGood:"大胖娘们臭豆腐",name:"王大根",addr:"兴工街大桥洞子",phone:"18345678901"}]},p={name:"tables",components:{cTable:l},data:function(){return{items:d,itemsArray:d(),fields:[{key:"orderId",label:"订单id"},{key:"oneGood",label:"物品"},{key:"name",label:"收货人"},{key:"addr",label:"收货地址"},{key:"phone",label:"收货电话"}]}}},b=p,y=Object(f["a"])(b,n,a,!1,null,null,null);e["default"]=y.exports},"62af":function(t,e,r){var n=r("7cbd"),a=r("2ba0").concat("length","prototype");e.f=Object.getOwnPropertyNames||function(t){return n(t,a)}},"78de":function(t,e,r){var n=r("48ed"),a=r("b915"),o=r("54a3"),i=r("1f51"),c=r("3301"),u=r("8003"),f=Object.getOwnPropertyDescriptor;e.f=r("3a0f")?f:function(t,e){if(t=o(t),e=i(e,!0),u)try{return f(t,e)}catch(r){}if(c(t,e))return a(!n.f.call(t,e),t[e])}},8992:function(t,e,r){"use strict";function n(t,e){return Math.floor(Math.random()*(e-t+1)+t)}r.d(e,"a",function(){return n}),r.d(e,"b",function(){return a});var a=function(t){for(var e=t.length-1;e>0;e--){var r=Math.floor(Math.random()*(e+1)),n=t[e];t[e]=t[r],t[r]=n}return t}},b06f:function(t,e,r){"use strict";var n=r("4839"),a=r("3301"),o=r("9b6d"),i=r("d62f"),c=r("1f51"),u=r("201d"),f=r("62af").f,s=r("78de").f,l=r("694f").f,d=r("3b80").trim,p="Number",b=n[p],y=b,h=b.prototype,g=o(r("04ac")(h))==p,m="trim"in String.prototype,v=function(t){var e=c(t,!1);if("string"==typeof e&&e.length>2){e=m?e.trim():d(e,3);var r,n,a,o=e.charCodeAt(0);if(43===o||45===o){if(r=e.charCodeAt(2),88===r||120===r)return NaN}else if(48===o){switch(e.charCodeAt(1)){case 66:case 98:n=2,a=49;break;case 79:case 111:n=8,a=55;break;default:return+e}for(var i,u=e.slice(2),f=0,s=u.length;f<s;f++)if(i=u.charCodeAt(f),i<48||i>a)return NaN;return parseInt(u,n)}}return+e};if(!b(" 0o1")||!b("0b1")||b("+0x1")){b=function(t){var e=arguments.length<1?0:t,r=this;return r instanceof b&&(g?u(function(){h.valueOf.call(r)}):o(r)!=p)?i(new y(v(e)),r,b):v(e)};for(var _,I=r("3a0f")?f(y):"MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,EPSILON,isFinite,isInteger,isNaN,isSafeInteger,MAX_SAFE_INTEGER,MIN_SAFE_INTEGER,parseFloat,parseInt,isInteger".split(","),N=0;I.length>N;N++)a(y,_=I[N])&&!a(b,_)&&l(b,_,s(y,_));b.prototype=h,h.constructor=b,r("7f00")(n,p,b)}},d62f:function(t,e,r){var n=r("b429"),a=r("d772").set;t.exports=function(t,e,r){var o,i=e.constructor;return i!==r&&"function"==typeof i&&(o=i.prototype)!==r.prototype&&n(o)&&a&&a(t,o),t}},d772:function(t,e,r){var n=r("b429"),a=r("4d65"),o=function(t,e){if(a(t),!n(e)&&null!==e)throw TypeError(e+": can't set as prototype!")};t.exports={set:Object.setPrototypeOf||("__proto__"in{}?function(t,e,n){try{n=r("0709")(Function.call,r("78de").f(Object.prototype,"__proto__").set,2),n(t,[]),e=!(t instanceof Array)}catch(a){e=!0}return function(t,r){return o(t,r),e?t.__proto__=r:n(t,r),t}}({},!1):void 0),check:o}}}]);
//# sourceMappingURL=chunk-64c6a516.98aa8fd7.js.map