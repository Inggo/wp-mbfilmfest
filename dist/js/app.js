(function(t){function e(e){for(var n,o,l=e[0],c=e[1],a=e[2],d=0,m=[];d<l.length;d++)o=l[d],Object.prototype.hasOwnProperty.call(s,o)&&s[o]&&m.push(s[o][0]),s[o]=0;for(n in c)Object.prototype.hasOwnProperty.call(c,n)&&(t[n]=c[n]);u&&u(e);while(m.length)m.shift()();return r.push.apply(r,a||[]),i()}function i(){for(var t,e=0;e<r.length;e++){for(var i=r[e],n=!0,l=1;l<i.length;l++){var c=i[l];0!==s[c]&&(n=!1)}n&&(r.splice(e--,1),t=o(o.s=i[0]))}return t}var n={},s={app:0},r=[];function o(e){if(n[e])return n[e].exports;var i=n[e]={i:e,l:!1,exports:{}};return t[e].call(i.exports,i,i.exports,o),i.l=!0,i.exports}o.m=t,o.c=n,o.d=function(t,e,i){o.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:i})},o.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},o.t=function(t,e){if(1&e&&(t=o(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var i=Object.create(null);if(o.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)o.d(i,n,function(e){return t[e]}.bind(null,n));return i},o.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return o.d(e,"a",e),e},o.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},o.p="/";var l=window["webpackJsonp"]=window["webpackJsonp"]||[],c=l.push.bind(l);l.push=e,l=l.slice();for(var a=0;a<l.length;a++)e(l[a]);var u=c;r.push([0,"chunk-vendors"]),i()})({0:function(t,e,i){t.exports=i("56d7")},"034f":function(t,e,i){"use strict";i("85ec")},1774:function(t,e,i){"use strict";i("7a42")},"4bc4":function(t,e,i){"use strict";i("bc13")},"56d7":function(t,e,i){"use strict";i.r(e);i("e260"),i("e6cf"),i("cca6"),i("a79d");var n=i("2b0e"),s=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"mbfilmfest_container"},[i("MBFFBanners",{attrs:{banners:t.contents.primaryBanners}}),i("MBFFContents",{attrs:{films:t.contents.films}}),i("MBFFBanners",{attrs:{banners:t.contents.secondaryBanners}}),i("MBFFLinks",{attrs:{links:t.primaryLinks,title:t.settings.primaryLinksTitle,description:t.settings.primaryLinksDescription,background:t.settings.primaryLinksBackground,layout:t.settings.primaryLinksFormat,showNames:t.settings.showPrimaryLinkNames}}),i("MBFFLinks",{attrs:{links:t.secondaryLinks,title:t.settings.secondaryLinksTitle,description:t.settings.secondaryLinksDescription,background:t.settings.secondaryLinksBackground,layout:t.settings.secondaryLinksFormat,showNames:t.settings.showSecondaryLinkNames}})],1)},r=[],o=(i("4de4"),i("caad"),i("2532"),function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("header",{staticClass:"mbfilmfest_banners",attrs:{id:"mbfilmfest_banners"}},[i("VueAgile",{directives:[{name:"show",rawName:"v-show",value:t.windowLoaded,expression:"windowLoaded"}],ref:"carousel",class:{mbfilmfest_banner_carousel:this.banners.length>1},style:{height:t.currentSlideHeight},attrs:{autoplay:t.isCarousel},on:{"before-change":function(e){return t.setContainerDimensions(e)}}},t._l(t.banners,(function(e,n){return i("div",{key:e.id,ref:"slides",refInFor:!0,class:{mbfilmfest_banner:!0,"has-link":e.link},style:{backgroundColor:e.background}},[i("img",{ref:"bannerImages",refInFor:!0,style:t.slideDimensions[n],attrs:{src:e.image},on:{click:function(i){return t.goToLink(e.link,e.newWindow)}}})])})),0)],1)}),l=[],c=i("f7ab"),a={name:"MBFFBanners",components:{VueAgile:c["a"]},props:{banners:Array},data:function(){return{windowLoaded:!1,currentSlideWidth:0,currentSlideHeight:0,sliderOptions:{autoplaySpeed:6e3,centerMode:!0,responsive:[{breakpoint:600,settings:{navButtons:this.banners.length>1,dots:!1}},{breakpoint:900,settings:{navButtons:this.banners.length>1,dots:this.banners.length>1}}]},slideDimensions:[]}},computed:{isCarousel:function(){return this.banners.length>1}},methods:{setSlideDimensions:function(){for(var t=[],e=0;e<this.banners.length;e++){var i=this.banners[e];i.width<=document.documentElement.clientWidth&&i.height<=document.documentElement.clientHeight?t.push({width:i.width+"px",height:i.height+"px"}):i.height<=document.documentElement.clientHeight?t.push({width:document.documentElement.clientWidth+"px",height:i.height/(i.width/document.documentElement.clientWidth)+"px"}):i.width<=document.documentElement.clientWidth?t.push({width:i.width/(i.height/document.documentElement.clientHeight)+"px",height:document.documentElement.clientHeight+"px"}):t.push({width:document.documentElement.clientWidth+"px",height:i.height/(i.width/document.documentElement.clientWidth)+"px"})}this.slideDimensions=t},setContainerDimensions:function(t){this.currentSlideWidth=this.slideDimensions[t.nextSlide].width,this.currentSlideHeight=this.slideDimensions[t.nextSlide].height},goToLink:function(t){t&&""!=t&&window.open(t)}},mounted:function(){var t=this;this.$nextTick((function(){window.addEventListener("load",(function(){t.windowLoaded=!0,t.setSlideDimensions(),t.$nextTick((function(){t.$refs.carousel.goTo(0),t.currentSlideWidth=t.slideDimensions[0].width,t.currentSlideHeight=t.slideDimensions[0].height,t.$refs.carousel.reload()})),window.addEventListener("resize",(function(){t.setSlideDimensions(),t.$nextTick((function(){t.$refs.carousel.reload()}))}))}))}))}},u=a,d=(i("1774"),i("2877")),m=Object(d["a"])(u,o,l,!1,null,null,null),f=m.exports,h=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("main",{staticClass:"mbfilmfest_body",attrs:{id:"mbfilmfest_body"}},[i("MBFFFilmList",{attrs:{title:"Feature Films",layout:"featured",films:t.featuredFilms}}),i("MBFFFilmList",{attrs:{title:"Short Films",films:t.shortFilms}})],1)},p=[],g=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("section",{class:["mbfilmfest_films","featured"==t.layout?"mbfilmfest_featurefilms":"mbfilmfest_shortfilms"]},[i("h3",[t._v(t._s(t.title))]),i("ul",t._l(t.films,(function(e){return i("li",{key:e.id,ref:"films",refInFor:!0,class:{mbfilmfest_focused_film:t.focusedOnFilm==e.id,mbfilmfest_film_preload:!t.filmLoaded.includes(e.id),mbfilmfest_film_loaded:t.filmLoaded.includes(e.id)},on:{mouseenter:function(i){!t.isMobile&&t.setFocusFilm(e)},mouseleave:function(i){!t.isMobile&&t.unfocusFilm(e)}}},[i("div",{staticClass:"mbfilmfest_filmcover_container",style:{height:t.filmcoverHeight+"px"},on:{click:function(i){return t.selectFilm(e)}}},[i("div",{staticClass:"mbfilmfest_filmcover",style:{backgroundImage:"url("+e.image+")"}})]),i("div",{staticClass:"mbfilmfest_description_container",on:{click:function(i){return t.selectFilm(e)}}},[i("h4",[t._v(t._s(e.title))]),e.screening_time?i("p",{staticClass:"mbfilmfest_description_screentime"},[t._v(t._s(e.screening_time))]):t._e(),i("p",{domProps:{innerHTML:t._s(e.description)}}),i("p",{staticClass:"mbfilmfest_watch_now"},[i("a",{attrs:{href:"#"},on:{click:function(i){return i.preventDefault(),t.playFocusedFilm(e)}}},[t._v("Watch Now")])])]),i("div",{staticClass:"mbfilmfest_play_button",style:{backgroundImage:"url("+t.baseUrl+"play.svg)",height:t.filmcoverHeight+"px"},on:{click:function(i){return i.stopPropagation(),t.playFocusedFilm(e)}}})])})),0),i("transition",{attrs:{name:"fade"}},[i("div",{directives:[{name:"show",rawName:"v-show",value:t.playing,expression:"playing"}],staticClass:"mbfilmfest_player"},[i("div",{staticClass:"mbfilmfest_player_viewport"},[i("button",{staticClass:"mbfilmfest_close_player",on:{click:t.stopFilm}},[t._v("×")]),i("div",{staticClass:"mbfilmfest_embed",domProps:{innerHTML:t._s(t.currentEmbed)}})])])])],1)},b=[],y=(i("159b"),i("8df8")),_={props:{title:String,films:Array,layout:{type:String,default:"basic"}},data:function(){return{focusedOnFilm:!1,playing:!1,currentEmbed:"",filmLoaded:[],filmHeights:[],filmcoverHeight:0,baseUrl:window.mbfilmfest.baseUrl+"src/assets/"}},computed:{defaultHeight:function(){var t=document.documentElement.clientWidth<1366?105:118;return this.filmcoverHeight+t+"px"},isMobile:function(){return y()}},methods:{calculateFilmcoverHeight:function(){var t=0;t=document.documentElement.clientWidth<500?"featured"==this.layout?1.44385*document.documentElement.clientWidth:document.documentElement.clientWidth/1.777776:document.documentElement.clientWidth<800?"featured"==this.layout?1.44385*document.documentElement.clientWidth/2:document.documentElement.clientWidth/1.777776/2:"featured"==this.layout?540:191,this.filmcoverHeight=t},playFocusedFilm:function(t){if(this.focusedOnFilm==t.id)return this.playFilm(t.embed)},setFocusFilm:function(t){this.focusedOnFilm=t.id,this.$refs.films[this.filmLoaded.indexOf(t.id)].style.height=this.filmHeights[this.filmLoaded.indexOf(t.id)]+"px"},unfocusFilm:function(t){this.focusedOnFilm=!1,this.$refs.films[this.filmLoaded.indexOf(t.id)].style.height=this.defaultHeight},selectFilm:function(t){return this.isMobile?this.focusedOnFilm==t.id?this.unfocusFilm(t):this.setFocusFilm(t):this.playFilm(t.embed)},playFilm:function(t){document.body.classList.add("mbfilmfest_film_playing"),this.currentEmbed=t,this.playing=!0},stopFilm:function(){document.body.classList.remove("mbfilmfest_film_playing"),this.currentEmbed=null,this.playing=!1}},mounted:function(){var t=this;this.$nextTick((function(){t.calculateFilmcoverHeight(),t.$nextTick((function(){t.films.forEach((function(e,i){t.filmHeights.push(t.$refs.films[i].clientHeight)})),t.$nextTick((function(){t.films.forEach((function(e,i){t.$refs.films[i].style.height=t.defaultHeight,t.filmLoaded.push(e.id)}))}))}))}))}},F=_,v=(i("4bc4"),Object(d["a"])(F,g,b,!1,null,null,null)),k=v.exports,w={name:"MBFFContents",props:{films:Array},components:{MBFFFilmList:k},computed:{featuredFilms:function(){return this.films?this.films.filter((function(t){return t.tags.includes("Feature Films")})):[]},shortFilms:function(){return this.films?this.films.filter((function(t){return t.tags.includes("Short Films")})):[]}}},L=w,x=(i("d9eb"),Object(d["a"])(L,h,p,!1,null,null,null)),E=x.exports,M=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"mbfilmfest_links_container",style:{backgroundColor:t.background}},[i("section",{staticClass:"mbfilmfest_links",class:"instax"==t.layout?"mbfilmfest_links_instax":null},[i("div",{staticClass:"mbfilmfest_links_description"},[t.title?i("h3",[t._v(t._s(t.title))]):t._e(),t.description?i("div",{domProps:{innerHTML:t._s(t.description)}}):t._e()]),i("div",{staticClass:"mbfilmfest_links_contents"},[i("ul",t._l(t.links,(function(e){return i("li",{key:e.id,ref:e.id,refInFor:!0,style:"instax"==t.layout?t.randomRot():null,on:{click:function(i){return t.goToLink(e.link)}}},[i("img",{attrs:{src:e.image,alt:e.name}}),t.showNames?i("h4",[t._v(t._s(e.name))]):t._e()])})),0)])])])},S=[],C={props:{showNames:{type:Boolean,default:!0},title:String,description:String,links:Array,background:{type:String,default:"#FFF"},layout:String},methods:{goToLink:function(t){window.open(t)},randomRot:function(){return"transform: "+this.randomRotValue()},randomRotValue:function(){return"rotate("+5*Math.random()*(Math.random()<.5?1:-1)+"deg)"}}},O=C,H=(i("9db0"),Object(d["a"])(O,M,S,!1,null,null,null)),B=H.exports,T={name:"App",components:{MBFFBanners:f,MBFFContents:E,MBFFLinks:B},data:function(){return window.mbfilmfest},computed:{primaryLinks:function(){var t=this;return this.settings.primaryLinksFilter?this.contents.links.filter((function(e){return e.tags.includes(t.settings.primaryLinksFilter)})):this.contents.links},secondaryLinks:function(){var t=this;return this.settings.secondaryLinksFilter?this.contents.links.filter((function(e){return e.tags.includes(t.settings.secondaryLinksFilter)})):this.contents.links}}},$=T,W=(i("034f"),Object(d["a"])($,s,r,!1,null,null,null)),D=W.exports;n["a"].config.productionTip=!1,new n["a"]({render:function(t){return t(D)}}).$mount("#mbfilmfest_view")},"7a42":function(t,e,i){},"85ec":function(t,e,i){},"9db0":function(t,e,i){"use strict";i("c072")},ae57:function(t,e,i){},bc13:function(t,e,i){},c072:function(t,e,i){},d9eb:function(t,e,i){"use strict";i("ae57")}});
//# sourceMappingURL=app.js.map