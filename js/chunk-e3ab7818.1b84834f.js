(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-e3ab7818"],{2346:function(t,a,o){},"3a23":function(t,a,o){var e=o("694f").f,n=Function.prototype,i=/^\s*function ([^ (]*)/,s="name";s in n||o("3a0f")&&e(n,s,{configurable:!0,get:function(){try{return(""+this).match(i)[1]}catch(t){return""}}})},"76f0":function(t,a,o){"use strict";var e=function(){var t=this,a=t.$createElement,o=t._self._c||a;return o("b-button",{attrs:{variant:"primary"},on:{click:t.click}},[t._v(t._s(t.text))])},n=[],i={name:"standard-buttons",data:function(){return{togglePress:!1}},props:["text"],methods:{click:function(){this.$emit("click")}}},s=i,r=(o("c8ca"),o("17cc")),d=Object(r["a"])(s,e,n,!1,null,"52cabcfb",null);a["a"]=d.exports},aa9a:function(t,a,o){},b866:function(t,a,o){"use strict";var e=o("aa9a"),n=o.n(e);n.a},c8ca:function(t,a,o){"use strict";var e=o("2346"),n=o.n(e);n.a},e8e2:function(t,a,o){"use strict";o.r(a);var e=function(){var t=this,a=t.$createElement,o=t._self._c||a;return o("div",{staticClass:"animated fadeIn"},[o("b-row",[o("b-button",{staticClass:"menu-btn",attrs:{variant:"primary"},on:{click:function(a){t.displayAddShop=!t.displayAddShop}}},[t.displayAddShop?o("i",{staticClass:"icon-arrow-up icons font-2xl d-block mt-4 displayAddShopIcon"}):o("i",{staticClass:"icon-arrow-down icons font-2xl d-block mt-4 displayAddShopIcon"}),t._v("\n      添加物品\n    ")])],1),o("b-card",{directives:[{name:"show",rawName:"v-show",value:t.displayAddShop,expression:"displayAddShop"}]},[o("div",{attrs:{slot:"header"},slot:"header"},[o("strong",[t._v("添加")]),t._v(" 物品\n    ")]),o("b-form",[o("b-form-group",{attrs:{validated:"",label:"物品名称"}},[o("b-form-input",{attrs:{id:"shopName",type:"text"},model:{value:t.addShopData.name,callback:function(a){t.$set(t.addShopData,"name",a)},expression:"addShopData.name"}})],1),o("b-form-group",{attrs:{validated:"",label:"物品描述"}},[o("b-form-input",{attrs:{id:"shopNotice",type:"text"},model:{value:t.addShopData.describe,callback:function(a){t.$set(t.addShopData,"describe",a)},expression:"addShopData.describe"}})],1),o("b-form-group",{attrs:{validated:"",label:"价格"}},[o("b-form-input",{attrs:{id:"shopNotice",type:"text"},model:{value:t.addShopData.price,callback:function(a){t.$set(t.addShopData,"price",a)},expression:"addShopData.price"}})],1),o("b-form-group",{attrs:{validated:"",label:"所属店铺"}},[o("select",{directives:[{name:"model",rawName:"v-model",value:t.addShopData.shopId,expression:"addShopData.shopId"}],staticClass:"shopSelect",attrs:{name:"shopSelect"},on:{change:function(a){var o=Array.prototype.filter.call(a.target.options,function(t){return t.selected}).map(function(t){var a="_value"in t?t._value:t.value;return a});t.$set(t.addShopData,"shopId",a.target.multiple?o:o[0])}}},t._l(t.shopList,function(a,e){return o("option",{domProps:{value:a.id}},[t._v(t._s(a.id)+":"+t._s(a.name))])}),0)]),o("div",{attrs:{slot:"footer"},slot:"footer"},[o("b-button",{attrs:{type:"button",size:"sm",variant:"primary"},on:{click:t.addShop}},[o("i",{staticClass:"fa fa-dot-circle-o"}),t._v(" 添加")]),t._v("\n         \n        "),o("b-button",{attrs:{type:"button",size:"sm",variant:"danger"},on:{click:function(a){t.displayAddShop=!t.displayAddShop}}},[o("i",{staticClass:"fa fa-ban"}),t._v(" 取消")])],1)],1)],1),o("b-row",[o("b-col",[o("table",{staticClass:"cTable",attrs:{border:"0"}},[o("tr",{staticClass:"table-line1"},[o("th",[t._v("物品id")]),o("th",[t._v("物品名称")]),o("th",[t._v("物品描述")]),o("th",[t._v("店铺名称")]),o("th",[t._v("原价")]),o("th",[t._v("现价")]),o("th",[t._v("价格控制")]),o("th",[t._v("操作")])]),t._l(t.list,function(a,e){return o("tr",[o("td",[t._v(t._s(a.id))]),o("td",[t._v(t._s(a.name))]),o("td",[t._v(t._s(a.describe))]),o("td",[t._v(t._s(a.shopname))]),o("td",[t._v(t._s(a.price))]),o("td",[t._v(t._s(a.newPrice?a.newPrice:a.price))]),o("td",[a.newPrice?o("div",[t._v("\n              从"+t._s(a.priceChangeBeginAt)+"到"+t._s(a.priceChangeEndAt)+"，\n              "+t._s(1==a.priceChangeIncOrDec?"降价":"涨价")+"，\n              "+t._s(1==a.priceChangeType?"增减":2==a.priceChangeType?"打折":"直接改价")+"，\n              数值："+t._s(a.priceChangePrice)+"\n               \n              "),o("i",{staticClass:"icon-trash icons font-2xl d-block mt-4",on:{click:function(o){return t.delPriceControl(a)}}})]):o("div",[t._v("\n              增加一个优惠/涨价机制\n              "),o("i",{staticClass:"icon-plus icons font-2xl d-block mt-4",on:{click:function(o){return t.addPriceControl(a)}}})])]),o("td",[o("b-button",{staticClass:"td-btn",attrs:{variant:"primary"},on:{click:function(o){return t.delShop(a)}}},[t._v("删除物品")])],1)])})],2)])],1)],1)},n=[],i=(o("3a23"),o("76f0")),s={name:"tables",components:{normalBtn:i["a"]},data:function(){return{list:[],displayAddShop:!1,addShopData:{name:"",describe:"",shopId:0,price:0},shopList:[]}},methods:{changeValue:function(t,a){this[t]=a},listShop:function(){var t=this;this.$ajax("goods",{method:"listAllGoods",token:window.localStorage.getItem("token")},function(a){if(console.log(a),0==a.code)for(var o in t.list=[],a.data)t.list.push(a.data[o]);else alert(a.msg)})},addShop:function(){var t=this;console.log(this.addShopData),confirm("确定要添加"+this.addShopData.name+"吗？")&&this.$ajax("goods",{method:"addGoods",name:this.addShopData.name,describe:this.addShopData.describe,token:window.localStorage.getItem("token"),price:this.addShopData.price,shopId:this.addShopData.shopId},function(a){console.log(a),0==a.code?(alert("添加成功"),t.listShop()):alert(a.msg)})},delShop:function(t){var a=this;confirm("确定要删除以下物品吗？\n\n"+t.name)&&this.$ajax("goods",{method:"deleteGoods",token:window.localStorage.getItem("token"),goodId:t.id},function(t){0==t.code?(alert("删除成功"),a.listShop()):alert(t.msg)})},delPriceControl:function(t){alert("将要删除改价机制："+JSON.stringify(t)),alert("暂未开放此功能")},addPriceControl:function(t){alert("将要增加改价机制："+JSON.stringify(t)),alert("暂未开放此功能")},getShopList:function(){var t=this;this.$ajax("shop",{method:"listShop",token:window.localStorage.getItem("token")},function(a){if(console.log(a),0==a.code)for(var o in t.shopList=[],a.data)t.shopList.push(a.data[o]);else alert(a.msg)})}},created:function(){this.listShop(),this.getShopList()}},r=s,d=(o("b866"),o("17cc")),c=Object(d["a"])(r,e,n,!1,null,null,null);a["default"]=c.exports}}]);
//# sourceMappingURL=chunk-e3ab7818.1b84834f.js.map