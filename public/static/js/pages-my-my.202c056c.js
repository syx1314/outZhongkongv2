(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["pages-my-my"],{"0cac":function(t,e,i){"use strict";var a=i("f1ad"),n=i.n(a);n.a},"0f52":function(t,e,i){"use strict";var a;i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return a}));var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticClass:"botif"},[i("v-uni-view",{staticClass:"copyrg"},[i("div",{staticClass:"richbox",domProps:{innerHTML:t._s(t.tsdoc.body)}})])],1)},o=[]},"0f79":function(t,e,i){var a=i("f627");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("2e60f08e",a,!0,{sourceMap:!1,shadowMode:!1})},1561:function(t,e,i){"use strict";(function(e){var a=i("4ea4");i("c975");var n=a(i("40ae")),o=a(i("e5ab")),c=a(i("e8ab")),s=a(i("f1b6")),r=function(){if(!o.default.isWeixinH5())return e.log("非微信H5端不获取配置"),!1;var t=window.location.href,i=t.substring(0,t.indexOf("#"));c.default.request.post("Weixin/create_js_config",{data:{url:i,shareurl:document.location.protocol+"//"+window.location.hostname+"/#/"}}).then((function(t){if(0==t.data.errno){var e=t.data.data.config,i=t.data.data.share;n.default.config({debug:!1,appId:e.appid,timestamp:e.timestamp,nonceStr:e.noncestr,signature:e.signature,jsApiList:["updateAppMessageShareData","updateTimelineShareData","onMenuShareAppMessage","onMenuShareTimeline"]}),n.default.ready((function(){var t=uni.getStorageSync("userinfo")?JSON.parse(uni.getStorageSync("userinfo")):{},e={};e["appid"]=o.default.getAppid(),t&&(e["vi"]=t.id);var a="?"+s.default.stringify(e);n.default.updateAppMessageShareData({title:i.title,desc:i.desc,link:i.link+a,imgUrl:i.imgUrl,success:function(){}}),n.default.onMenuShareAppMessage({title:i.title,desc:i.desc,link:i.link+a,imgUrl:i.imgUrl,type:"link",dataUrl:"",success:function(){}}),n.default.onMenuShareTimeline({title:i.title,link:i.link+a,imgUrl:i.imgUrl,success:function(){}}),n.default.updateTimelineShareData({title:i.title,link:i.link+a,imgUrl:i.imgUrl,success:function(){}})}))}else uni.showToast({title:t.data.errmsg,icon:"none",duration:2e3})})).catch((function(t){e.error("error:",t)}))};t.exports={init:r}}).call(this,i("5a52")["default"])},"28ac":function(t,e,i){"use strict";i.r(e);var a=i("0f52"),n=i("7357");for(var o in n)"default"!==o&&function(t){i.d(e,t,(function(){return n[t]}))}(o);i("cfc1");var c,s=i("f0c5"),r=Object(s["a"])(n["default"],a["b"],a["c"],!1,null,"5f4016aa",null,!1,a["a"],c);e["default"]=r.exports},3575:function(t,e,i){"use strict";var a=i("0f79"),n=i.n(a);n.a},4181:function(t,e,i){"use strict";(function(t){i("a9e3"),Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var a={data:function(){return{info:{}}},props:{docid:{type:Number},btntxt:{type:String,default:"知道了"}},mounted:function(){},onShow:function(){},methods:{openPop:function(t){this.getDoc(),this.$refs.popref.open()},closePop:function(){this.$refs.popref.close()},getDoc:function(e){var i=this;uni.showLoading({title:"请稍后"}),this.$request.post("open/get_doc",{data:{id:this.docid}}).then((function(t){uni.hideLoading(),0==t.data.errno?i.info=t.data.data:(i.toast("内容未找到"),i.$refs.popref.close())})).catch((function(e){t.error("error:",e)}))}}};e.default=a}).call(this,i("5a52")["default"])},4816:function(t,e,i){var a=i("579e");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("7270446d",a,!0,{sourceMap:!1,shadowMode:!1})},5159:function(t,e,i){"use strict";(function(t){Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var i={components:{},data:function(){return{tsdoc:{}}},mounted:function(){this.getDoc()},methods:{getDoc:function(){var e=this;this.$request.post("open/get_doc",{data:{id:5}}).then((function(t){0==t.data.errno&&(e.tsdoc=t.data.data)})).catch((function(e){t.error("error:",e)}))}}};e.default=i}).call(this,i("5a52")["default"])},"579e":function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,".botif[data-v-5f4016aa]{margin-top:%?20?%;width:%?750?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:start;-webkit-justify-content:flex-start;justify-content:flex-start;padding-top:%?20?%;padding-bottom:%?40?%}.botif .copyrg[data-v-5f4016aa]{width:%?710?%}",""]),t.exports=e},6840:function(t,e,i){"use strict";i.r(e);var a=i("c2cb"),n=i("79c4");for(var o in n)"default"!==o&&function(t){i.d(e,t,(function(){return n[t]}))}(o);i("0cac");var c,s=i("f0c5"),r=Object(s["a"])(n["default"],a["b"],a["c"],!1,null,"740cd10d",null,!1,a["a"],c);e["default"]=r.exports},"6e9a":function(t,e,i){"use strict";i.r(e);var a=i("b888"),n=i("d79a");for(var o in n)"default"!==o&&function(t){i.d(e,t,(function(){return n[t]}))}(o);i("3575");var c,s=i("f0c5"),r=Object(s["a"])(n["default"],a["b"],a["c"],!1,null,"4c2429c9",null,!1,a["a"],c);e["default"]=r.exports},7357:function(t,e,i){"use strict";i.r(e);var a=i("5159"),n=i.n(a);for(var o in a)"default"!==o&&function(t){i.d(e,t,(function(){return a[t]}))}(o);e["default"]=n.a},"79c4":function(t,e,i){"use strict";i.r(e);var a=i("4181"),n=i.n(a);for(var o in a)"default"!==o&&function(t){i.d(e,t,(function(){return a[t]}))}(o);e["default"]=n.a},b888:function(t,e,i){"use strict";var a;i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return a}));var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-uni-view",{staticStyle:{"background-color":"#f8f7f9"}},[i("v-uni-view",{staticClass:"header-box"},[i("v-uni-view",{staticClass:"l"},[i("v-uni-image",{staticClass:"head-img",attrs:{src:t.user.headimg}})],1),i("v-uni-view",{staticClass:"c"},[i("v-uni-view",{staticClass:"username"},[t._v(t._s(t.user.username))]),i("v-uni-view",{staticClass:"id"},[t._v("ID："+t._s(t.user.id))]),i("v-uni-view",{staticClass:"grade"},[t._v("等级："+t._s(t.user.grade_name))])],1)],1),t.user.id?i("v-uni-view",{staticClass:"kuai",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.navigateTo("/pages/index/record")}}},[i("v-uni-view",{staticClass:"kuai-title"},[i("v-uni-text",{staticClass:"title"},[t._v("充值订单")]),i("v-uni-text",{staticClass:"desc"},[t._v("您充值的订单都在这里哦")]),i("v-uni-image",{staticClass:"next-iocn",attrs:{src:"/static/arrowR.png"}})],1),i("v-uni-view",{staticClass:"xiang"},[i("v-uni-view",{staticClass:"item"},[i("v-uni-view",{staticClass:"value"},[t._v(t._s(t.moneyFloat(t.user.chongzhi_money)))]),i("v-uni-view",{staticClass:"name"},[t._v("消费金额")])],1),i("v-uni-view",{staticClass:"item"},[i("v-uni-view",{staticClass:"value"},[t._v(t._s(t.user.chongzhi_num||"0"))]),i("v-uni-view",{staticClass:"name"},[t._v("充值次数")])],1)],1)],1):t._e(),2==t.user.grade_id?i("v-uni-view",{staticClass:"kuai",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.navigateTo("/pages/agent/index")}}},[i("v-uni-view",{staticClass:"kuai-title"},[i("v-uni-text",{staticClass:"title"},[t._v("代理中心")]),i("v-uni-text",{staticClass:"desc"},[t._v("点击这里进入代理中心")]),i("v-uni-image",{staticClass:"next-iocn",attrs:{src:"/static/arrowR.png"}})],1),i("v-uni-view",{staticClass:"xiang"},[i("v-uni-view",{staticClass:"item"},[i("v-uni-view",{staticClass:"value"},[t._v(t._s(t.user.renshu))]),i("v-uni-view",{staticClass:"name"},[t._v("累计邀请")])],1),i("v-uni-view",{staticClass:"item"},[i("v-uni-view",{staticClass:"value"},[t._v(t._s(t.moneyFloat(t.user.earnings)))]),i("v-uni-view",{staticClass:"name"},[t._v("累计收益")])],1),i("v-uni-view",{staticClass:"item",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.navigateTo("yaoqinlog")}}},[i("v-uni-view",{staticClass:"value"},[t._v(t._s(t.moneyFloat(t.user.balance)))]),i("v-uni-view",{staticClass:"name"},[t._v("可提现")])],1)],1)],1):t._e(),i("v-uni-view",{staticClass:"list-row"},[1==t.user.grade_id?i("v-uni-view",{staticClass:"row",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.navigateTo("/pages/my/apply")}}},[i("v-uni-view",{staticClass:"row-left"},[i("v-uni-image",{staticClass:"icon",attrs:{src:"/static/my/up.png",mode:""}})],1),i("v-uni-view",{staticClass:"row-title"},[i("v-uni-text",{staticClass:"name"},[t._v("付费开店")]),i("v-uni-view",{staticClass:"desc"}),i("v-uni-image",{staticClass:"next-iocn",attrs:{src:"/static/arrowR.png",mode:""}})],1)],1):t._e(),1==t.user.grade_id?i("v-uni-view",{staticClass:"row",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.navigateTo("/pages/other/doc?id=1")}}},[i("v-uni-view",{staticClass:"row-left"},[i("v-uni-image",{staticClass:"icon",attrs:{src:"/static/my/zhin.png",mode:""}})],1),i("v-uni-view",{staticClass:"row-title"},[i("v-uni-text",{staticClass:"name"},[t._v("开店指南")]),i("v-uni-view",{staticClass:"desc"}),i("v-uni-image",{staticClass:"next-iocn",attrs:{src:"/static/arrowR.png",mode:""}})],1)],1):t._e(),i("v-uni-view",{staticClass:"row",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.navigateTo("/pages/other/helps")}}},[i("v-uni-view",{staticClass:"row-left"},[i("v-uni-image",{staticClass:"icon",attrs:{src:"/static/my/kefu.png",mode:""}})],1),i("v-uni-view",{staticClass:"row-title"},[i("v-uni-text",{staticClass:"name"},[t._v("客服帮助")]),i("v-uni-view",{staticClass:"desc"}),i("v-uni-image",{staticClass:"next-iocn",attrs:{src:"/static/arrowR.png",mode:""}})],1)],1),i("v-uni-view",{staticClass:"row",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.openAbout.apply(void 0,arguments)}}},[i("v-uni-view",{staticClass:"row-left"},[i("v-uni-image",{staticClass:"icon",attrs:{src:"/static/my/about.png",mode:""}})],1),i("v-uni-view",{staticClass:"row-title"},[i("v-uni-text",{staticClass:"name"},[t._v("关于我们")]),i("v-uni-view",{staticClass:"desc"}),i("v-uni-image",{staticClass:"next-iocn",attrs:{src:"/static/arrowR.png",mode:""}})],1)],1)],1),i("doc-box",{ref:"docbox",attrs:{docid:7}}),i("copy-right")],1)},o=[]},c2cb:function(t,e,i){"use strict";i.d(e,"b",(function(){return n})),i.d(e,"c",(function(){return o})),i.d(e,"a",(function(){return a}));var a={uniPopup:i("2fd6").default},n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("uni-popup",{ref:"popref",attrs:{type:"center"}},[i("v-uni-view",{staticClass:"boxs"},[t.info.litpic?[i("v-uni-image",{staticClass:"close_ico",attrs:{src:"/static/close_w.png"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.closePop.apply(void 0,arguments)}}}),i("v-uni-image",{staticClass:"topbg",attrs:{src:t.info.litpic,mode:"aspectFill"}})]:[i("v-uni-image",{staticClass:"close_ico",attrs:{src:"/static/close_g.png"},on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.closePop.apply(void 0,arguments)}}}),i("v-uni-view",{staticClass:"title"},[t._v(t._s(t.info.title))])],i("v-uni-scroll-view",{staticClass:"content",attrs:{"scroll-y":"true"}},[i("div",{staticClass:"richbox",domProps:{innerHTML:t._s(t.info.body)}})]),t.btntxt?i("v-uni-view",{staticClass:"btns"},[i("v-uni-view",{staticClass:"btn",on:{click:function(e){arguments[0]=e=t.$handleEvent(e),t.closePop.apply(void 0,arguments)}}},[t._v(t._s(t.btntxt))])],1):t._e()],2)],1)},o=[]},cfc1:function(t,e,i){"use strict";var a=i("4816"),n=i.n(a);n.a},d79a:function(t,e,i){"use strict";i.r(e);var a=i("e715"),n=i.n(a);for(var o in a)"default"!==o&&function(t){i.d(e,t,(function(){return a[t]}))}(o);e["default"]=n.a},e715:function(t,e,i){"use strict";(function(t){var a=i("4ea4");Object.defineProperty(e,"__esModule",{value:!0}),e.default=void 0;var n=a(i("1561")),o=a(i("28ac")),c=a(i("6840")),s={components:{CopyRight:o.default,DocBox:c.default},data:function(){return{user:{},agentinfo:{}}},onLoad:function(){},mounted:function(){},onShow:function(){this.user=this.getUserinfo(),this.initInfo(),n.default.init()},onShareAppMessage:function(t){return client.getShareAppMessage()},onShareTimeline:function(){return client.getShareTimeline()},methods:{initInfo:function(){var e=this;this.$request.post("Customer/info",{data:{}}).then((function(t){0==t.data.errno&&(e.user=t.data.data,e.setUserinfo(t.data.data))})).catch((function(e){t.error("error:",e)}))},openAbout:function(){this.$refs.docbox.openPop()}}};e.default=s}).call(this,i("5a52")["default"])},f1ad:function(t,e,i){var a=i("f44d");"string"===typeof a&&(a=[[t.i,a,""]]),a.locals&&(t.exports=a.locals);var n=i("4f06").default;n("3fcc04cc",a,!0,{sourceMap:!1,shadowMode:!1})},f44d:function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,".boxs[data-v-740cd10d]{width:%?650?%;background-color:#fff;border-radius:%?24?%;min-height:%?20?%;padding-bottom:%?30?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:start;-webkit-justify-content:flex-start;justify-content:flex-start;position:relative;box-sizing:border-box}.title[data-v-740cd10d]{line-height:%?100?%;font-size:%?34?%;font-weight:600}.topbg[data-v-740cd10d]{width:100%;border-radius:%?24?% %?24?% 0 0;height:%?200?%}.close_ico[data-v-740cd10d]{position:absolute;right:10px;top:10px;width:%?30?%;height:%?30?%;z-index:999}.content[data-v-740cd10d]{max-height:60vh;min-height:%?300?%;width:%?610?%;overflow-y:scroll;margin-top:%?20?%}.btns[data-v-740cd10d]{width:%?610?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;flex-direction:row;-webkit-justify-content:space-around;justify-content:space-around;-webkit-box-align:center;-webkit-align-items:center;align-items:center;margin-top:%?40?%}.btns .btn[data-v-740cd10d]{background-color:#0d8eea;color:#fff;height:%?80?%;line-height:%?80?%;text-align:center;padding-left:%?90?%;padding-right:%?90?%;border-radius:%?40?%;font-size:%?30?%}",""]),t.exports=e},f627:function(t,e,i){var a=i("24fb");e=a(!1),e.push([t.i,'uni-page-body[data-v-4c2429c9]{background-color:#f8f7f9}.header-box[data-v-4c2429c9]{width:%?750?%;height:%?220?%;position:relative;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;flex-direction:row;-webkit-box-align:center;-webkit-align-items:center;align-items:center}.header-box .l[data-v-4c2429c9]{width:%?150?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;flex-direction:row;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center}.header-box .l .head-img[data-v-4c2429c9]{width:%?100?%;height:%?100?%;border-radius:50%}.header-box .c[data-v-4c2429c9]{width:%?550?%;height:%?100?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center}.header-box .username[data-v-4c2429c9]{font-size:%?32?%;color:#333;font-weight:600}.header-box .id[data-v-4c2429c9]{font-size:%?24?%;color:#666;line-height:%?40?%}.header-box .grade[data-v-4c2429c9]{font-size:%?24?%;color:#666}.kuai[data-v-4c2429c9]{background-color:#fff;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;margin-bottom:%?20?%}.kuai .kuai-title[data-v-4c2429c9]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;flex-direction:row;-webkit-box-align:end;-webkit-align-items:flex-end;align-items:flex-end;padding:%?30?% %?30?% %?0?% %?40?%}.kuai .kuai-title .title[data-v-4c2429c9]{font-size:%?30?%;font-weight:600;-webkit-box-flex:1;-webkit-flex-grow:1;flex-grow:1}.kuai .kuai-title .desc[data-v-4c2429c9]{font-size:%?24?%;-webkit-box-flex:3;-webkit-flex-grow:3;flex-grow:3;text-align:right;padding-right:%?20?%;color:#666}.kuai .xiang[data-v-4c2429c9]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;flex-direction:row;-webkit-justify-content:space-around;justify-content:space-around;-webkit-box-align:center;-webkit-align-items:center;align-items:center;height:%?160?%}.kuai .xiang .item[data-v-4c2429c9]{-webkit-box-flex:1;-webkit-flex-grow:1;flex-grow:1;text-align:center;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;align-items:center}.kuai .xiang .item .value[data-v-4c2429c9]{font-weight:600;font-size:%?36?%;line-height:%?60?%}.kuai .xiang .item .name[data-v-4c2429c9]{font-size:%?24?%;color:#666}.list-row[data-v-4c2429c9]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;background-color:#fff}.list-row .row[data-v-4c2429c9]{height:%?100?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;flex-wrap:nowrap}.list-row .row .row-left[data-v-4c2429c9]{width:%?80?%;text-align:center;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center}.list-row .row .row-left .icon[data-v-4c2429c9]{width:%?40?%;height:%?40?%}.list-row .row .row-title[data-v-4c2429c9]{border-bottom:1px solid #f9f9f9;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:horizontal;-webkit-box-direction:normal;-webkit-flex-direction:row;flex-direction:row;-webkit-box-align:center;-webkit-align-items:center;align-items:center;-webkit-box-flex:1;-webkit-flex-grow:1;flex-grow:1;padding-right:%?30?%}.list-row .row .row-title .name[data-v-4c2429c9]{font-size:%?32?%;-webkit-box-flex:1;-webkit-flex-grow:1;flex-grow:1}.list-row .row .row-title .desc[data-v-4c2429c9]{font-size:%?24?%;-webkit-box-flex:3;-webkit-flex-grow:3;flex-grow:3;text-align:right;padding-right:%?15?%;color:#666}.next-iocn[data-v-4c2429c9]{width:%?30?%;height:%?30?%}.uls[data-v-4c2429c9]{width:100%;height:%?210?%;border:0;border-radius:0;padding:0;color:#fff;position:relative}.words-fee[data-v-4c2429c9]{width:%?190?%;height:%?70?%;border-radius:0;background-color:#fd5f56;color:#fff;font-size:%?26?%;line-height:%?70?%;border-bottom-left-radius:%?35?%;border-top-left-radius:%?35?%;text-align:center;padding:0;margin:0;position:absolute;right:%?0?%;top:%?70?%}.bottom-box[data-v-4c2429c9]{position:absolute;width:%?680?%;height:%?170?%;left:%?35?%;bottom:%?-60?%;background-color:#fff;border-radius:%?30?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:justify;-webkit-justify-content:space-between;justify-content:space-between;-webkit-box-align:center;-webkit-align-items:center;align-items:center;box-shadow:0 0 10px 0 #ccc;clear:both}.bottom-box .lls[data-v-4c2429c9]{width:50%;height:100%;position:relative}.bottom-box .lls>uni-text[data-v-4c2429c9]{display:block;text-align:center}.bottom-box .lls>uni-text[data-v-4c2429c9]:nth-child(1){font-size:%?40?%;color:#000;margin-top:%?30?%\n\t/* font-weight: 600; */}.bottom-box .lls>uni-text[data-v-4c2429c9]:nth-child(2){font-size:%?36?%;color:#4168d6;margin-top:%?0?%}.llis[data-v-4c2429c9]:after{content:"";position:absolute;right:0;width:1px;height:%?70?%;background-color:#4168d6;top:50%;margin-top:%?-35?%}.zhanwei[data-v-4c2429c9]{height:%?80?%}.add-logo[data-v-4c2429c9]{width:%?640?%;height:%?190?%;margin:%?30?% auto 0}.add-logo uni-image[data-v-4c2429c9]{display:block;width:100%;height:100%}.gugebox[data-v-4c2429c9]{margin-top:%?30?%}.lul[data-v-4c2429c9]{padding:0 %?30?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:justify;-webkit-justify-content:space-between;justify-content:space-between;-webkit-box-align:center;-webkit-align-items:center;align-items:center}.lul .lil[data-v-4c2429c9]{width:50%;height:%?140?%;display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-webkit-flex-direction:column;flex-direction:column;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;align-items:center;background-color:#fff;border:0;border-radius:0}.lul .lil[data-v-4c2429c9]:after{border:0}.lil>uni-image[data-v-4c2429c9]{display:block;width:%?60?%;height:%?60?%}.lil .ji[data-v-4c2429c9]{font-size:%?34?%;line-height:%?70?%;\n\t/* font-weight: 600; */color:#000;\n\t/* margin-left: 20rpx; */\n\t/* width: 230rpx; */\n\t/* text-align: left; */white-space:nowrap;overflow:hidden}.ulil[data-v-4c2429c9]{position:relative}.ulil[data-v-4c2429c9]:after{content:"";position:absolute;right:0;width:1px;height:%?40?%;background-color:#000;top:50%;margin-top:%?-20?%}.promote[data-v-4c2429c9]{display:-webkit-box;display:-webkit-flex;display:flex;-webkit-box-pack:center;-webkit-justify-content:center;justify-content:center;-webkit-box-align:center;-webkit-align-items:center;align-items:center;height:%?40?%;margin-top:%?150?%;padding:0;color:#fff;background-color:hsla(0,0%,100%,0)}.promote[data-v-4c2429c9]:after{border:0}.promote>uni-image[data-v-4c2429c9]{display:block;width:%?40?%;height:%?40?%}.promote .te[data-v-4c2429c9]{font-size:%?25?%;margin-left:%?10?%;color:#e06151}body.?%PAGE?%[data-v-4c2429c9]{background-color:#f8f7f9}',""]),t.exports=e}}]);