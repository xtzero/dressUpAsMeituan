(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-106c27be"],{"48fb":function(e,t,r){"use strict";r("66f5");var n=r("4d65"),a=r("7fe4"),i=r("3a0f"),s="toString",o=/./[s],u=function(e){r("7f00")(RegExp.prototype,s,e,!0)};r("201d")(function(){return"/a/b"!=o.call({source:"a",flags:"b"})})?u(function(){var e=n(this);return"/".concat(e.source,"/","flags"in e?e.flags:!i&&e instanceof RegExp?a.call(e):void 0)}):o.name!=s&&u(function(){return o.call(this)})},"66f5":function(e,t,r){r("3a0f")&&"g"!=/./g.flags&&r("694f").f(RegExp.prototype,"flags",{configurable:!0,get:r("7fe4")})},7415:function(e,t,r){"use strict";var n=r("2d2c"),a=r("ea02")(5),i="find",s=!0;i in[]&&Array(1)[i](function(){s=!1}),n(n.P+n.F*s,"Array",{find:function(e){return a(this,e,arguments.length>1?arguments[1]:void 0)}}),r("68fb")(i)},a1f7:function(e,t,r){var n=r("d753"),a=r("54a3"),i=r("48ed").f;e.exports=function(e){return function(t){var r,s=a(t),o=n(s),u=o.length,d=0,c=[];while(u>d)i.call(s,r=o[d++])&&c.push(e?[r,s[r]]:s[r]);return c}}},bd70:function(e,t,r){var n=r("2d2c"),a=r("a1f7")(!0);n(n.S,"Object",{entries:function(e){return a(e)}})},bd76:function(e,t,r){"use strict";var n=[{id:0,name:"John Doe",registered:"2018/01/01",role:"Guest",status:"Pending"},{id:1,name:"Samppa Nori",registered:"2018/01/01",role:"Member",status:"Active"},{id:2,name:"Estavan Lykos",registered:"2018/02/01",role:"Staff",status:"Banned"},{id:3,name:"Chetan Mohamed",registered:"2018/02/01",role:"Admin",status:"Inactive"},{id:4,name:"Derick Maximinus",registered:"2018/03/01",role:"Member",status:"Pending"},{id:5,name:"Friderik Dávid",registered:"2018/01/21",role:"Staff",status:"Active"},{id:6,name:"Yiorgos Avraamu",registered:"2018/01/01",role:"Member",status:"Active"},{id:7,name:"Avram Tarasios",registered:"2018/02/01",role:"Staff",status:"Banned"},{id:8,name:"Quintin Ed",registered:"2018/02/01",role:"Admin",status:"Inactive"},{id:9,name:"Enéas Kwadwo",registered:"2018/03/01",role:"Member",status:"Pending"},{id:10,name:"Agapetus Tadeáš",registered:"2018/01/21",role:"Staff",status:"Active"},{id:11,name:"Carwyn Fachtna",registered:"2018/01/01",role:"Member",status:"Active"},{id:12,name:"Nehemiah Tatius",registered:"2018/02/01",role:"Staff",status:"Banned"},{id:13,name:"Ebbe Gemariah",registered:"2018/02/01",role:"Admin",status:"Inactive"},{id:14,name:"Eustorgios Amulius",registered:"2018/03/01",role:"Member",status:"Pending"},{id:15,name:"Leopold Gáspár",registered:"2018/01/21",role:"Staff",status:"Active"},{id:16,name:"Pompeius René",registered:"2018/01/01",role:"Member",status:"Active"},{id:17,name:"Paĉjo Jadon",registered:"2018/02/01",role:"Staff",status:"Banned"},{id:18,name:"Micheal Mercurius",registered:"2018/02/01",role:"Admin",status:"Inactive"},{id:19,name:"Ganesha Dubhghall",registered:"2018/03/01",role:"Member",status:"Pending"},{id:20,name:"Hiroto Šimun",registered:"2018/01/21",role:"Staff",status:"Active"},{id:21,name:"Vishnu Serghei",registered:"2018/01/01",role:"Member",status:"Active"},{id:22,name:"Zbyněk Phoibos",registered:"2018/02/01",role:"Staff",status:"Banned"},{id:23,name:"Einar Randall",registered:"2018/02/01",role:"Admin",status:"Inactive"},{id:24,name:"Félix Troels",registered:"2018/03/21",role:"Staff",status:"Active"},{id:25,name:"Aulus Agmundr",registered:"2018/01/01",role:"Member",status:"Pending"},{id:42,name:"Ford Prefex",registered:"2001/05/21",role:"Alien",status:"Don't panic!"}];t["a"]=n},ea02:function(e,t,r){var n=r("0709"),a=r("240e"),i=r("aa91"),s=r("33f2"),o=r("cecc");e.exports=function(e,t){var r=1==e,u=2==e,d=3==e,c=4==e,f=6==e,l=5==e||f,m=t||o;return function(t,o,g){for(var v,b,p=i(t),h=a(p),A=n(o,g,3),y=s(h.length),S=0,k=r?m(t,y):u?m(t,0):void 0;y>S;S++)if((l||S in h)&&(v=h[S],b=A(v,S,p),e))if(r)k[S]=b;else if(b)switch(e){case 3:return!0;case 5:return v;case 6:return S;case 2:k.push(v)}else if(c)return!1;return f?-1:d||c?c:k}}},eeca:function(e,t,r){"use strict";r.r(t);var n=function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("b-row",[r("b-col",{attrs:{cols:"12",lg:"6"}},[r("b-card",{attrs:{"no-header":""}},[r("template",{slot:"header"},[e._v("\n        User id:  "+e._s(e.$route.params.id)+"\n      ")]),r("b-table",{attrs:{striped:"",small:"",fixed:"",responsive:"sm",items:e.items(e.$route.params.id),fields:e.fields},scopedSlots:e._u([{key:"value",fn:function(t){return[r("strong",[e._v(e._s(t.item.value))])]}}])}),r("template",{slot:"footer"},[r("b-button",{on:{click:e.goBack}},[e._v("Back")])],1)],2)],1)],1)},a=[];function i(e){if(Array.isArray(e))return e}function s(e,t){var r=[],n=!0,a=!1,i=void 0;try{for(var s,o=e[Symbol.iterator]();!(n=(s=o.next()).done);n=!0)if(r.push(s.value),t&&r.length===t)break}catch(u){a=!0,i=u}finally{try{n||null==o["return"]||o["return"]()}finally{if(a)throw i}}return r}function o(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}function u(e,t){return i(e)||s(e,t)||o()}r("612f"),r("bd70"),r("48fb"),r("7415");var d=r("bd76"),c={name:"User",props:{caption:{type:String,default:"User id"}},data:function(){return{items:function(e){var t=d["a"].find(function(t){return t.id.toString()===e}),r=t?Object.entries(t):[["id","Not found"]];return r.map(function(e){var t=u(e,2),r=t[0],n=t[1];return{key:r,value:n}})},fields:[{key:"key"},{key:"value"}]}},methods:{goBack:function(){this.$router.go(-1)}}},f=c,l=r("17cc"),m=Object(l["a"])(f,n,a,!1,null,null,null);t["default"]=m.exports}}]);
//# sourceMappingURL=chunk-106c27be.a2adec7d.js.map