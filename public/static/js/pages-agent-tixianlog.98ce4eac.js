(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-agent-tixianlog"],{1841:function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,"uni-page-body[data-v-5038805e]{background-color:#fff}.jllist[data-v-5038805e]{width:%?750?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column}.jllist .item[data-v-5038805e]{width:%?750?%;height:%?120?%;border-bottom:1px solid #dfdfdf;position:relative}.jllist .item .icon[data-v-5038805e]{width:%?60?%;height:%?60?%;position:absolute;left:%?30?%;top:%?30?%}.jllist .item .jl[data-v-5038805e]{position:absolute;left:%?120?%;top:%?25?%;font-size:%?35?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:justify;-webkit-justify-content:space-between;justify-content:space-between;width:%?590?%}.jllist .item .time[data-v-5038805e]{position:absolute;left:%?120?%;top:%?75?%;color:#666;font-size:%?25?%}body.?%PAGE?%[data-v-5038805e]{background-color:#fff}",""]),t.exports=e},"4b95":function(t,e,i){"use strict";var a=i("4ea4");Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var o=a(i("3cc2")),n={components:{sPullScroll:o.default},data:function(){return{lists:[],status:["","审核中","提现成功","审核失败"]}},onLoad:function(){this.refresh()},mounted:function(){},methods:{refresh:function(){var t=this;this.$nextTick((function(){t.$refs.pullScroll.refresh()}))},pullDown:function(t){var e=this;setTimeout((function(){e.loadData(t)}),200)},loadData:function(t){var e=this;1==t.page&&(this.lists=[]),this.$request.post("customer/tixian_log?page="+t.page,{data:{}}).then((function(i){if(0==i.data.errno&&i.data.data.data.length>0){t.success();for(var a=0;a<i.data.data.data.length;a++)e.lists.push(i.data.data.data[a])}else 1==t.page?t.empty():t.finish()})).catch((function(t){console.error("error:",t)}))}}};e.default=n},"520b":function(t,e,i){"use strict";var a=i("dcf9"),o=i.n(a);o.a},"751c":function(t,e,i){"use strict";var a;i.d(e,"b",(function(){return o})),i.d(e,"c",(function(){return n})),i.d(e,"a",(function(){return a}));var o=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("s-pull-scroll",{ref:"pullScroll",attrs:{pullDown:t.pullDown,pullUp:t.loadData,top:0,emptyText:"还没有提现记录"}},[i("v-uni-view",{staticClass:"jllist"},t._l(t.lists,(function(e,a){return i("v-uni-view",{key:a,staticClass:"item"},[i("v-uni-image",{staticClass:"icon",attrs:{src:"/static/shouyiicon.png"}}),i("v-uni-view",{staticClass:"jl"},[i("v-uni-text",{staticStyle:{color:"#444"}},[t._v(t._s(t.status[e.status]))]),i("v-uni-text",{staticStyle:{color:"#f00"}},[t._v("￥"+t._s(t.moneyFloat(e.money)))])],1),i("v-uni-view",{staticClass:"time"},[t._v(t._s(t.timeFormat(e.create_time)))])],1)})),1)],1)},n=[]},"82d0":function(t,e,i){"use strict";i.r(e);var a=i("4b95"),o=i.n(a);for(var n in a)"default"!==n&&function(t){i.d(e,t,(function(){return a[t]}))}(n);e["default"]=o.a},"90d6":function(t,e,i){"use strict";i.r(e);var a=i("751c"),o=i("82d0");for(var n in o)"default"!==n&&function(t){i.d(e,t,(function(){return o[t]}))}(n);i("520b");var s,l=i("f0c5"),r=Object(l["a"])(o["default"],a["b"],a["c"],!1,null,"5038805e",null,!1,a["a"],s);e["default"]=r.exports},dcf9:function(t,e,i){var a=i("1841");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var o=i("4f06").default;o("c1383ad8",a,!0,{sourceMap:!1,shadowMode:!1})}}]);