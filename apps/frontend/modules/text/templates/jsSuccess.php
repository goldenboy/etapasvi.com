<?php include_component('text', 'js') ?>

// main
var ap_stopAll=function(){};var audioplayer=false;var offer_tr_clone="";var rotate_quotes_interval=15000;var last_quote_index=-1;var window_size_hide_el=1000;$(document).ready(function(){var d=false;if(top!==self){$("body").addClass("embedded");d=true}var c=window.location.hash;if(c.substring(1)=="print_version"){$("body").addClass("print_version");d=true}if(d){var a=window.location+"";a=a.replace(/([^#?]+)[#?]?.*/g,"$1");$("#content").append('<p class="small"><?php echo __("Source") ?>: <br/><a href="'+a+'">'+a+"</a></p>");return}onWindowResize();if(quote_list){showQuotes()}if(audio_list){var b=Math.floor(Math.random()*(audio_list.length));if(audio_list[b]){$("#mp3").attr("title",audio_title_list[b]);$("#mp3 span").html(audio_list[b])}}$("#mp3").jmp3({filepath:"http://k002.kiwi6.com/uploads/hotlink/",width:24});$("span.lang_selector").colorbox({inline:true,href:"#lang_box",opacity:"0.5",transition:"none"});$("#offer_tr_ctr").insertAfter("#content h1:eq(0)");$("#revhistory").insertAfter("#offer_tr_ctr");$("#revhistory_trigger").insertAfter("#offer_tr_trigger");$("#embed").insertAfter("#offer_tr_ctr");$("#print_version_trigger").insertAfter("#offer_tr_trigger").show();$("#embed_trigger").insertAfter("#offer_tr_trigger");if(footer_text){$("#lang_plain").after(footer_text)}$(window).resize(function(){onWindowResize()})});function onWindowResize(){if($(window).width()<window_size_hide_el){$("#wrapper").css("margin","0 auto 0 70px")}else{$("#wrapper").css("margin","0 auto")}}function hideQuotes(){$("#quote_p_cont").fadeOut(600);setTimeout(showQuotes,700)}function showQuotes(){if($(window).width()>window_size_hide_el){var b=$("#bubble_quote p:first");var a=Math.floor(Math.random()*(quote_list.length));if(a==last_quote_index){if(a>1){a=a-1}else{a=quote_list.length-1}}last_quote_index=a;if(quote_list[a]){b.html(quote_list[a])}$("#quote_p_cont").fadeIn(600)}setTimeout(hideQuotes,rotate_quotes_interval)}function showOriginal(){if($("#elOriginal").is(":hidden")){$("#elOriginal").slideDown("slow")}else{$("#elOriginal").slideUp("slow")}}function showAudioBody(b){var a="#elAudioBody"+b;if($(a).is(":hidden")){$(a).slideDown("slow")}else{$(a).slideUp("slow")}}function preparePhotoContent(){$(document).ready(function(){var a;$("#photo_content a.photo_content_link").each(function(b){a=$(this).attr("href");a="javascript: loadPhotoContent('"+a+"'); void(0)";$(this).attr("href",a)})})}var global_photo_href;function loadPhotoContent(c,b,d){if(!c||$("#photo_loader").is("visible")){return}if(!d){d=c.replace(/http:\/\/([^\/]+).*/,"$1")}if(!d){return}c=c.replace(/http:\/\/[^\/]+\//,"");if(b){$("#photo_content .photofull").html('<p id="photo_loader" class="hidden center_text" ><img src="/i/loader.gif" /></p>');$("#disqus_thread").hide();$("#photo_content div.social").remove();$("#photo_content .dsq-brlink").remove()}global_photo_href="http://"+d+"/"+c;var a="/"+c.replace(/\/photo\//,"/photo/content/");$("#photo_loader").show();$("#offer_tr").hide();offer_tr_clone=$("#offer_tr_ctr").clone();$("#photo_content").load(a,function(g,e,h){if(e=="error"){$("#photo_loader").hide();if(global_photo_href){window.location=global_photo_href;return}}else{offer_tr_clone.insertAfter("#content h1:eq(0)");setUrl(global_photo_href,c);var f=$("#photo_content_title").text()+" - eTapasvi.com";if(f){document.title=f}$("#offer_tr_uri").val(global_photo_href);$("#offer_tr_id").val(getElementIdFromUrl(global_photo_href))}})}function getElementIdFromUrl(b){var a=b.match(/^[^\d]+(\d+).*$/);return a[1]}function loadPhotoContentFromHash(b){var a=$.address.value();if(a&&a.substr(0,2)=="/!"){loadPhotoContent(a.substr(2,a.length),true,b)}}function setUrl(a,b){try{if(history&&history.pushState){history.pushState({isMine:true},"title",a)}else{$.address.value("/!"+b)}setUrlMobile(a);setUrlLangList(a)}catch(c){}}function setUrlMobile(a){var b=a.replace("www.","m.");$("#m_link a").each(function(d,c){$(c).attr("href",b)});$("#m_link img").each(function(e,d){var c=$(d).attr("src");$(d).attr("src",c.replace(/(.*&d=).*/,"$1")+b)})}function setUrlLangList(a){cur_href_no_culture=a.replace(/http:\/\/[^\/]+\//,"").replace(/[^\/]+\//,"");$("#lang_list a").each(function(b){culture_href=$(this).attr("href").replace(/(http:\/\/[^\/]+\/[^\/]+\/).*/,"$1"+cur_href_no_culture);$(this).attr("href",culture_href)})}function switchOfferTr(b,a){if(!$("#offer_tr_fields").is(":empty")){if($("#offer_tr").is(":hidden")){pageToolsTriggerShow("offer_tr");if(!$("#offer_tr_success").is(":hidden")){$("#offer_tr_fields textarea").val("")}$("#offer_tr_success").hide()}else{pageToolsTriggerHide("offer_tr")}}else{$("#offer_tr_loader").show();pageToolsTriggerShow("offer_tr");$.ajax({url:b,dataType:"html",success:function(c){$("#offer_tr_fields").html(c);$("#offer_tr_loader").hide();$("#offer_tr").show()},error:function(c){$("#offer_tr_loader").hide()}})}}function offerTrSubmit(){$("#offer_tr_success").show();$("#offer_tr").hide();return true}function showOfferTrMethod(a){$(".offer_tr_method").hide();$("#"+$(a).val()).show()}function switchRevhistory(){if($("#revhistory").is(":hidden")){pageToolsTriggerShow("revhistory")}else{pageToolsTriggerHide("revhistory")}}function switchEmbed(){if($("#embed").is(":hidden")){pageToolsTriggerShow("embed")}else{pageToolsTriggerHide("embed")}}function pageToolsTriggerShow(b){$(".page_tools").each(function(c){pageToolsTriggerHide($(this).attr("id"))});$("#"+b).show();var a=$("#"+b+"_trigger");a.css("text-decoration","none")}function pageToolsTriggerHide(b){if(!$("#"+b).is(":hidden")){$("#"+b).hide();var a=$("#"+b+"_trigger");a.css("text-decoration","underline")}};

// jmp3
jQuery.fn.jmp3=function(passedOptions){var playerpath="/swf/";var options={"filepath":"","backcolor":"","forecolor":"ffffff","width":"25","repeat":"no","volume":"50","autoplay":"false","showdownload":"true","showfilename":"true"};if(passedOptions){jQuery.extend(options,passedOptions)}return this.each(function(){var filename=options.filepath+jQuery(this).children().html();var mp3html='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';mp3html+='width="'+options.width+'" height="20" ';mp3html+='codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">';mp3html+='<param name="movie" value="'+playerpath+'singlemp3player.swf?';mp3html+='showDownload='+options.showdownload+'&file='+filename+'&autoStart='+options.autoplay;mp3html+='&backColor='+options.backcolor+'&frontColor='+options.forecolor;mp3html+='&repeatPlay='+options.repeat+'&songVolume='+options.volume+'" />';mp3html+='<param name="wmode" value="transparent" />';mp3html+='<embed wmode="transparent" width="'+options.width+'" height="20" ';mp3html+='src="'+playerpath+'singlemp3player.swf?';mp3html+='showDownload='+options.showdownload+'&file='+filename+'&autoStart='+options.autoplay;mp3html+='&backColor='+options.backcolor+'&frontColor='+options.forecolor;mp3html+='&repeatPlay='+options.repeat+'&songVolume='+options.volume+'" ';mp3html+='type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />';mp3html+='</object>';if(options.showfilename=="false"){jQuery(this).html("")}jQuery(this).prepend(mp3html+"&nbsp;");if(jQuery.browser.msie){this.outerHTML=this.outerHTML}})};


// jQuery Address Plugin v1.4
(function(c){c.address=function(){var v=function(a){c(c.address).trigger(c.extend(c.Event(a),function(){for(var b={},e=c.address.parameterNames(),f=0,p=e.length;f<p;f++)b[e[f]]=c.address.parameter(e[f]);return{value:c.address.value(),path:c.address.path(),pathNames:c.address.pathNames(),parameterNames:e,parameters:b,queryString:c.address.queryString()}}.call(c.address)))},w=function(){c().bind.apply(c(c.address),Array.prototype.slice.call(arguments));return c.address},r=function(){return M.pushState&&
d.state!==k},s=function(){return("/"+g.pathname.replace(new RegExp(d.state),"")+g.search+(D()?"#"+D():"")).replace(U,"/")},D=function(){var a=g.href.indexOf("#");return a!=-1?B(g.href.substr(a+1),l):""},u=function(){return r()?s():D()},ha=function(){return"javascript"},N=function(a){a=a.toString();return(d.strict&&a.substr(0,1)!="/"?"/":"")+a},B=function(a,b){if(d.crawlable&&b)return(a!==""?"!":"")+a;return a.replace(/^\!/,"")},x=function(a,b){return parseInt(a.css(b),10)},V=function(a){for(var b,
e,f=0,p=a.childNodes.length;f<p;f++){try{if("src"in a.childNodes[f]&&a.childNodes[f].src)b=String(a.childNodes[f].src)}catch(J){}if(e=V(a.childNodes[f]))b=e}return b},F=function(){if(!K){var a=u();if(h!=a)if(y&&q<7)g.reload();else{y&&q<8&&d.history&&t(O,50);h=a;E(l)}}},E=function(a){v(W);v(a?X:Y);t(Z,10)},Z=function(){if(d.tracker!=="null"&&d.tracker!==null){var a=c.isFunction(d.tracker)?d.tracker:j[d.tracker],b=(g.pathname+g.search+(c.address&&!r()?c.address.value():"")).replace(/\/\//,"/").replace(/^\/$/,
"");if(c.isFunction(a))a(b);else if(c.isFunction(j.urchinTracker))j.urchinTracker(b);else if(j.pageTracker!==k&&c.isFunction(j.pageTracker._trackPageview))j.pageTracker._trackPageview(b);else j._gaq!==k&&c.isFunction(j._gaq.push)&&j._gaq.push(["_trackPageview",decodeURI(b)])}},O=function(){var a=ha()+":"+l+";document.open();document.writeln('<html><head><title>"+n.title.replace("'","\\'")+"</title><script>var "+C+' = "'+encodeURIComponent(u())+(n.domain!=g.hostname?'";document.domain="'+n.domain:
"")+"\";<\/script></head></html>');document.close();";if(q<7)m.src=a;else m.contentWindow.location.replace(a)},aa=function(){if(G&&$!=-1){var a,b=G.substr($+1).split("&");for(i=0;i<b.length;i++){a=b[i].split("=");if(/^(autoUpdate|crawlable|history|strict|wrap)$/.test(a[0]))d[a[0]]=isNaN(a[1])?/^(true|yes)$/i.test(a[1]):parseInt(a[1],10)!==0;if(/^(state|tracker)$/.test(a[0]))d[a[0]]=a[1]}G=null}h=u()},ca=function(){if(!ba){ba=o;aa();var a=function(){ia.call(this);ja.call(this)},b=c("body").ajaxComplete(a);
a();if(d.wrap){c("body > *").wrapAll('<div style="padding:'+(x(b,"marginTop")+x(b,"paddingTop"))+"px "+(x(b,"marginRight")+x(b,"paddingRight"))+"px "+(x(b,"marginBottom")+x(b,"paddingBottom"))+"px "+(x(b,"marginLeft")+x(b,"paddingLeft"))+'px;" />').parent().wrap('<div id="'+C+'" style="height:100%;overflow:auto;position:relative;'+(H&&!window.statusbar.visible?"resize:both;":"")+'" />');c("html, body").css({height:"100%",margin:0,padding:0,overflow:"hidden"});H&&c('<style type="text/css" />').appendTo("head").text("#"+
C+"::-webkit-resizer { background-color: #fff; }")}if(y&&q<8){a=n.getElementsByTagName("frameset")[0];m=n.createElement((a?"":"i")+"frame");if(a){a.insertAdjacentElement("beforeEnd",m);a[a.cols?"cols":"rows"]+=",0";m.noResize=o;m.frameBorder=m.frameSpacing=0}else{m.style.display="none";m.style.width=m.style.height=0;m.tabIndex=-1;n.body.insertAdjacentElement("afterBegin",m)}t(function(){c(m).bind("load",function(){var e=m.contentWindow;h=e[C]!==k?e[C]:"";if(h!=u()){E(l);g.hash=B(h,o)}});m.contentWindow[C]===
k&&O()},50)}t(function(){v("init");E(l)},1);if(!r())if(y&&q>7||!y&&"on"+I in j)if(j.addEventListener)j.addEventListener(I,F,l);else j.attachEvent&&j.attachEvent("on"+I,F);else ka(F,50)}},ia=function(){var a,b=c("a"),e=b.size(),f=-1,p=function(){if(++f!=e){a=c(b.get(f));a.is('[rel*="address:"]')&&a.address();t(p,1)}};t(p,1)},la=function(){if(h!=u()){h=u();E(l)}},ma=function(){if(j.removeEventListener)j.removeEventListener(I,F,l);else j.detachEvent&&j.detachEvent("on"+I,F)},ja=function(){if(d.crawlable){var a=
g.pathname.replace(/\/$/,"");c("body").html().indexOf("_escaped_fragment_")!=-1&&c('a[href]:not([href^=http]), a[href*="'+document.domain+'"]').each(function(){var b=c(this).attr("href").replace(/^http:/,"").replace(new RegExp(a+"/?$"),"");if(b===""||b.indexOf("_escaped_fragment_")!=-1)c(this).attr("href","#"+b.replace(/\/(.*)\?_escaped_fragment_=(.*)$/,"!$2"))})}},k,C="jQueryAddress",I="hashchange",W="change",X="internalChange",Y="externalChange",o=true,l=false,d={autoUpdate:o,crawlable:l,history:o,
strict:o,wrap:l},z=c.browser,q=parseFloat(c.browser.version),da=z.mozilla,y=z.msie,ea=z.opera,H=z.webkit||z.safari,P=l,j=function(){try{return top.document!==k?top:window}catch(a){return window}}(),n=j.document,M=j.history,g=j.location,ka=setInterval,t=setTimeout,U=/\/{2,9}/g;z=navigator.userAgent;var m,G=V(document),$=G?G.indexOf("?"):-1,Q=n.title,K=l,ba=l,R=o,fa=o,L=l,h=u();if(y){q=parseFloat(z.substr(z.indexOf("MSIE")+4));if(n.documentMode&&n.documentMode!=q)q=n.documentMode!=8?7:8;var ga=n.onpropertychange;
n.onpropertychange=function(){ga&&ga.call(n);if(n.title!=Q&&n.title.indexOf("#"+u())!=-1)n.title=Q}}if(P=da&&q>=1||y&&q>=6||ea&&q>=9.5||H&&q>=523){if(ea)history.navigationMode="compatible";if(document.readyState=="complete")var na=setInterval(function(){if(c.address){ca();clearInterval(na)}},50);else{aa();c(ca)}c(window).bind("popstate",la).bind("unload",ma)}else!P&&D()!==""?g.replace(g.href.substr(0,g.href.indexOf("#"))):Z();return{bind:function(a,b,e){return w(a,b,e)},init:function(a){return w("init",
a)},change:function(a){return w(W,a)},internalChange:function(a){return w(X,a)},externalChange:function(a){return w(Y,a)},baseURL:function(){var a=g.href;if(a.indexOf("#")!=-1)a=a.substr(0,a.indexOf("#"));if(/\/$/.test(a))a=a.substr(0,a.length-1);return a},autoUpdate:function(a){if(a!==k){d.autoUpdate=a;return this}return d.autoUpdate},crawlable:function(a){if(a!==k){d.crawlable=a;return this}return d.crawlable},history:function(a){if(a!==k){d.history=a;return this}return d.history},state:function(a){if(a!==
k){d.state=a;var b=s();if(d.state!==k)if(M.pushState)b.substr(0,3)=="/#/"&&g.replace(d.state.replace(/^\/$/,"")+b.substr(2));else b!="/"&&b.replace(/^\/#/,"")!=D()&&t(function(){g.replace(d.state.replace(/^\/$/,"")+"/#"+b)},1);return this}return d.state},strict:function(a){if(a!==k){d.strict=a;return this}return d.strict},tracker:function(a){if(a!==k){d.tracker=a;return this}return d.tracker},wrap:function(a){if(a!==k){d.wrap=a;return this}return d.wrap},update:function(){L=o;this.value(h);L=l;return this},
title:function(a){if(a!==k){t(function(){Q=n.title=a;if(fa&&m&&m.contentWindow&&m.contentWindow.document){m.contentWindow.document.title=a;fa=l}if(!R&&da)g.replace(g.href.indexOf("#")!=-1?g.href:g.href+"#");R=l},50);return this}return n.title},value:function(a){if(a!==k){a=N(a);if(a=="/")a="";if(h==a&&!L)return;R=o;h=a;if(d.autoUpdate||L){E(o);if(r())M[d.history?"pushState":"replaceState"]({},"",d.state.replace(/\/$/,"")+(h===""?"/":h));else{K=o;if(H)if(d.history)g.hash="#"+B(h,o);else g.replace("#"+
B(h,o));else if(h!=u())if(d.history)g.hash="#"+B(h,o);else g.replace("#"+B(h,o));y&&q<8&&d.history&&t(O,50);if(H)t(function(){K=l},1);else K=l}}return this}if(!P)return null;return N(h)},path:function(a){if(a!==k){var b=this.queryString(),e=this.hash();this.value(a+(b?"?"+b:"")+(e?"#"+e:""));return this}return N(h).split("#")[0].split("?")[0]},pathNames:function(){var a=this.path(),b=a.replace(U,"/").split("/");if(a.substr(0,1)=="/"||a.length===0)b.splice(0,1);a.substr(a.length-1,1)=="/"&&b.splice(b.length-
1,1);return b},queryString:function(a){if(a!==k){var b=this.hash();this.value(this.path()+(a?"?"+a:"")+(b?"#"+b:""));return this}a=h.split("?");return a.slice(1,a.length).join("?").split("#")[0]},parameter:function(a,b,e){var f,p;if(b!==k){var J=this.parameterNames();p=[];b=b?b.toString():"";for(f=0;f<J.length;f++){var S=J[f],A=this.parameter(S);if(typeof A=="string")A=[A];if(S==a)A=b===null||b===""?[]:e?A.concat([b]):[b];for(var T=0;T<A.length;T++)p.push(S+"="+A[T])}c.inArray(a,J)==-1&&b!==null&&
b!==""&&p.push(a+"="+b);this.queryString(p.join("&"));return this}if(b=this.queryString()){e=[];p=b.split("&");for(f=0;f<p.length;f++){b=p[f].split("=");b[0]==a&&e.push(b.slice(1).join("="))}if(e.length!==0)return e.length!=1?e:e[0]}},parameterNames:function(){var a=this.queryString(),b=[];if(a&&a.indexOf("=")!=-1){a=a.split("&");for(var e=0;e<a.length;e++){var f=a[e].split("=")[0];c.inArray(f,b)==-1&&b.push(f)}}return b},hash:function(a){if(a!==k){this.value(h.split("#")[0]+(a?"#"+a:""));return this}a=
h.split("#");return a.slice(1,a.length).join("#")}}}();c.fn.address=function(v){if(!c(this).attr("address")){var w=function(r){if(r.shiftKey||r.ctrlKey||r.metaKey)return true;if(c(this).is("a")){var s=v?v.call(this):/address:/.test(c(this).attr("rel"))?c(this).attr("rel").split("address:")[1].split(" ")[0]:c.address.state()!==undefined&&c.address.state()!="/"?c(this).attr("href").replace(new RegExp("^(.*"+c.address.state()+"|\\.)"),""):c(this).attr("href").replace(/^(#\!?|\.)/,"");c.address.value(s);
r.preventDefault()}};c(this).click(w).live("click",w).live("submit",function(r){if(c(this).is("form")){var s=c(this).attr("action");s=v?v.call(this):(s.indexOf("?")!=-1?s.replace(/&$/,""):s+"?")+c(this).serialize();c.address.value(s);r.preventDefault()}}).attr("address",true)}return this}})(jQuery);

// ColorBox v1.3.18 - a full featured, light-weight, customizable lightbox based on jQuery 1.3+
// Copyright (c) 2011 Jack Moore - jack@colorpowered.com
// Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
(function(a,b,c){function Y(c,d,e){var g=b.createElement(c);return d&&(g.id=f+d),e&&(g.style.cssText=e),a(g)}function Z(a){var b=y.length,c=(Q+a)%b;return c<0?b+c:c}function $(a,b){return Math.round((/%/.test(a)?(b==="x"?z.width():z.height())/100:1)*parseInt(a,10))}function _(a){return K.photo||/\.(gif|png|jpe?g|bmp|ico)((#|\?).*)?$/i.test(a)}function ba(){var b;K=a.extend({},a.data(P,e));for(b in K)a.isFunction(K[b])&&b.slice(0,2)!=="on"&&(K[b]=K[b].call(P));K.rel=K.rel||P.rel||"nofollow",K.href=K.href||a(P).attr("href"),K.title=K.title||P.title,typeof K.href=="string"&&(K.href=a.trim(K.href))}function bb(b,c){a.event.trigger(b),c&&c.call(P)}function bc(){var a,b=f+"Slideshow_",c="click."+f,d,e,g;K.slideshow&&y[1]?(d=function(){F.text(K.slideshowStop).unbind(c).bind(j,function(){if(Q<y.length-1||K.loop)a=setTimeout(W.next,K.slideshowSpeed)}).bind(i,function(){clearTimeout(a)}).one(c+" "+k,e),r.removeClass(b+"off").addClass(b+"on"),a=setTimeout(W.next,K.slideshowSpeed)},e=function(){clearTimeout(a),F.text(K.slideshowStart).unbind([j,i,k,c].join(" ")).one(c,function(){W.next(),d()}),r.removeClass(b+"on").addClass(b+"off")},K.slideshowAuto?d():e()):r.removeClass(b+"off "+b+"on")}function bd(b){if(!U){P=b,ba(),y=a(P),Q=0,K.rel!=="nofollow"&&(y=a("."+g).filter(function(){var b=a.data(this,e).rel||this.rel;return b===K.rel}),Q=y.index(P),Q===-1&&(y=y.add(P),Q=y.length-1));if(!S){S=T=!0,r.show();if(K.returnFocus)try{P.blur(),a(P).one(l,function(){try{this.focus()}catch(a){}})}catch(c){}q.css({opacity:+K.opacity,cursor:K.overlayClose?"pointer":"auto"}).show(),K.w=$(K.initialWidth,"x"),K.h=$(K.initialHeight,"y"),W.position(),o&&z.bind("resize."+p+" scroll."+p,function(){q.css({width:z.width(),height:z.height(),top:z.scrollTop(),left:z.scrollLeft()})}).trigger("resize."+p),bb(h,K.onOpen),J.add(D).hide(),I.html(K.close).show()}W.load(!0)}}var d={transition:"elastic",speed:300,width:!1,initialWidth:"600",innerWidth:!1,maxWidth:!1,height:!1,initialHeight:"450",innerHeight:!1,maxHeight:!1,scalePhotos:!0,scrolling:!0,inline:!1,html:!1,iframe:!1,fastIframe:!0,photo:!1,href:!1,title:!1,rel:!1,opacity:.9,preloading:!0,current:"image {current} of {total}",previous:"previous",next:"next",close:"X",open:!1,returnFocus:!0,loop:!0,slideshow:!1,slideshowAuto:!0,slideshowSpeed:2500,slideshowStart:"start slideshow",slideshowStop:"stop slideshow",onOpen:!1,onLoad:!1,onComplete:!1,onCleanup:!1,onClosed:!1,overlayClose:!0,escKey:!0,arrowKey:!0,top:!1,bottom:!1,left:!1,right:!1,fixed:!1,data:undefined},e="colorbox",f="cbox",g=f+"Element",h=f+"_open",i=f+"_load",j=f+"_complete",k=f+"_cleanup",l=f+"_closed",m=f+"_purge",n=a.browser.msie&&!a.support.opacity,o=n&&a.browser.version<7,p=f+"_IE6",q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X="div";W=a.fn[e]=a[e]=function(b,c){var f=this;b=b||{},W.init();if(!f[0]){if(f.selector)return f;f=a("<a/>"),b.open=!0}return c&&(b.onComplete=c),f.each(function(){a.data(this,e,a.extend({},a.data(this,e)||d,b)),a(this).addClass(g)}),(a.isFunction(b.open)&&b.open.call(f)||b.open)&&bd(f[0]),f},W.init=function(){if(!r){if(!a("body")[0]){a(W.init);return}z=a(c),r=Y(X).attr({id:e,"class":n?f+(o?"IE6":"IE"):""}),q=Y(X,"Overlay",o?"position:absolute":"").hide(),s=Y(X,"Wrapper"),t=Y(X,"Content").append(A=Y(X,"LoadedContent","width:0; height:0; overflow:hidden"),C=Y(X,"LoadingOverlay").add(Y(X,"LoadingGraphic")),D=Y(X,"Title"),E=Y(X,"Current"),G=Y(X,"Next"),H=Y(X,"Previous"),F=Y(X,"Slideshow").bind(h,bc),I=Y(X,"Close")),s.append(Y(X).append(Y(X,"TopLeft"),u=Y(X,"TopCenter"),Y(X,"TopRight")),Y(X,!1,"clear:left").append(v=Y(X,"MiddleLeft"),t,w=Y(X,"MiddleRight")),Y(X,!1,"clear:left").append(Y(X,"BottomLeft"),x=Y(X,"BottomCenter"),Y(X,"BottomRight"))).find("div div").css({"float":"left"}),B=Y(X,!1,"position:absolute; width:9999px; visibility:hidden; display:none"),a("body").prepend(q,r.append(s,B)),L=u.height()+x.height()+t.outerHeight(!0)-t.height(),M=v.width()+w.width()+t.outerWidth(!0)-t.width(),N=A.outerHeight(!0),O=A.outerWidth(!0),r.css({"padding-bottom":L,"padding-right":M}).hide(),G.click(function(){W.next()}),H.click(function(){W.prev()}),I.click(function(){W.close()}),J=G.add(H).add(E).add(F),q.click(function(){K.overlayClose&&W.close()}),a(b).bind("keydown."+f,function(a){var b=a.keyCode;S&&K.escKey&&b===27&&(a.preventDefault(),W.close()),S&&K.arrowKey&&y[1]&&(b===37?(a.preventDefault(),H.click()):b===39&&(a.preventDefault(),G.click()))})}},W.remove=function(){r.add(q).remove(),r=null,a("."+g).removeData(e).removeClass(g)},W.position=function(a,b){function g(a){u[0].style.width=x[0].style.width=t[0].style.width=a.style.width,C[0].style.height=C[1].style.height=t[0].style.height=v[0].style.height=w[0].style.height=a.style.height}var c=0,d=0,e=r.offset();z.unbind("resize."+f),r.css({top:-99999,left:-99999}),K.fixed&&!o?r.css({position:"fixed"}):(c=z.scrollTop(),d=z.scrollLeft(),r.css({position:"absolute"})),K.right!==!1?d+=Math.max(z.width()-K.w-O-M-$(K.right,"x"),0):K.left!==!1?d+=$(K.left,"x"):d+=Math.round(Math.max(z.width()-K.w-O-M,0)/2),K.bottom!==!1?c+=Math.max(z.height()-K.h-N-L-$(K.bottom,"y"),0):K.top!==!1?c+=$(K.top,"y"):c+=Math.round(Math.max(z.height()-K.h-N-L,0)/2),r.css({top:e.top,left:e.left}),a=r.width()===K.w+O&&r.height()===K.h+N?0:a||0,s[0].style.width=s[0].style.height="9999px",r.dequeue().animate({width:K.w+O,height:K.h+N,top:c,left:d},{duration:a,complete:function(){g(this),T=!1,s[0].style.width=K.w+O+M+"px",s[0].style.height=K.h+N+L+"px",b&&b(),setTimeout(function(){z.bind("resize."+f,W.position)},1)},step:function(){g(this)}})},W.resize=function(a){S&&(a=a||{},a.width&&(K.w=$(a.width,"x")-O-M),a.innerWidth&&(K.w=$(a.innerWidth,"x")),A.css({width:K.w}),a.height&&(K.h=$(a.height,"y")-N-L),a.innerHeight&&(K.h=$(a.innerHeight,"y")),!a.innerHeight&&!a.height&&(A.css({height:"auto"}),K.h=A.height()),A.css({height:K.h}),W.position(K.transition==="none"?0:K.speed))},W.prep=function(b){function g(){return K.w=K.w||A.width(),K.w=K.mw&&K.mw<K.w?K.mw:K.w,K.w}function h(){return K.h=K.h||A.height(),K.h=K.mh&&K.mh<K.h?K.mh:K.h,K.h}if(!S)return;var c,d=K.transition==="none"?0:K.speed;A.remove(),A=Y(X,"LoadedContent").append(b),A.hide().appendTo(B.show()).css({width:g(),overflow:K.scrolling?"auto":"hidden"}).css({height:h()}).prependTo(t),B.hide(),a(R).css({"float":"none"}),o&&a("select").not(r.find("select")).filter(function(){return this.style.visibility!=="hidden"}).css({visibility:"hidden"}).one(k,function(){this.style.visibility="inherit"}),c=function(){function q(){n&&r[0].style.removeAttribute("filter")}var b,c,g=y.length,h,i="frameBorder",k="allowTransparency",l,o,p;if(!S)return;l=function(){clearTimeout(V),C.hide(),bb(j,K.onComplete)},n&&R&&A.fadeIn(100),D.html(K.title).add(A).show();if(g>1){typeof K.current=="string"&&E.html(K.current.replace("{current}",Q+1).replace("{total}",g)).show(),G[K.loop||Q<g-1?"show":"hide"]().html(K.next),H[K.loop||Q?"show":"hide"]().html(K.previous),K.slideshow&&F.show();if(K.preloading){b=[Z(-1),Z(1)];while(c=y[b.pop()])o=a.data(c,e).href||c.href,a.isFunction(o)&&(o=o.call(c)),_(o)&&(p=new Image,p.src=o)}}else J.hide();K.iframe?(h=Y("iframe")[0],i in h&&(h[i]=0),k in h&&(h[k]="true"),h.name=f+ +(new Date),K.fastIframe?l():a(h).one("load",l),h.src=K.href,K.scrolling||(h.scrolling="no"),a(h).addClass(f+"Iframe").appendTo(A).one(m,function(){h.src="//about:blank"})):l(),K.transition==="fade"?r.fadeTo(d,1,q):q()},K.transition==="fade"?r.fadeTo(d,0,function(){W.position(0,c)}):W.position(d,c)},W.load=function(b){var c,d,e=W.prep;T=!0,R=!1,P=y[Q],b||ba(),bb(m),bb(i,K.onLoad),K.h=K.height?$(K.height,"y")-N-L:K.innerHeight&&$(K.innerHeight,"y"),K.w=K.width?$(K.width,"x")-O-M:K.innerWidth&&$(K.innerWidth,"x"),K.mw=K.w,K.mh=K.h,K.maxWidth&&(K.mw=$(K.maxWidth,"x")-O-M,K.mw=K.w&&K.w<K.mw?K.w:K.mw),K.maxHeight&&(K.mh=$(K.maxHeight,"y")-N-L,K.mh=K.h&&K.h<K.mh?K.h:K.mh),c=K.href,V=setTimeout(function(){C.show()},100),K.inline?(Y(X).hide().insertBefore(a(c)[0]).one(m,function(){a(this).replaceWith(A.children())}),e(a(c))):K.iframe?e(" "):K.html?e(K.html):_(c)?(a(R=new Image).addClass(f+"Photo").error(function(){K.title=!1,e(Y(X,"Error").text("This image could not be loaded"))}).load(function(){var a;R.onload=null,K.scalePhotos&&(d=function(){R.height-=R.height*a,R.width-=R.width*a},K.mw&&R.width>K.mw&&(a=(R.width-K.mw)/R.width,d()),K.mh&&R.height>K.mh&&(a=(R.height-K.mh)/R.height,d())),K.h&&(R.style.marginTop=Math.max(K.h-R.height,0)/2+"px"),y[1]&&(Q<y.length-1||K.loop)&&(R.style.cursor="pointer",R.onclick=function(){W.next()}),n&&(R.style.msInterpolationMode="bicubic"),setTimeout(function(){e(R)},1)}),setTimeout(function(){R.src=c},1)):c&&B.load(c,K.data,function(b,c,d){e(c==="error"?Y(X,"Error").text("Request unsuccessful: "+d.statusText):a(this).contents())})},W.next=function(){!T&&y[1]&&(Q<y.length-1||K.loop)&&(Q=Z(1),W.load())},W.prev=function(){!T&&y[1]&&(Q||K.loop)&&(Q=Z(-1),W.load())},W.close=function(){S&&!U&&(U=!0,S=!1,bb(k,K.onCleanup),z.unbind("."+f+" ."+p),q.fadeTo(200,0),r.stop().fadeTo(300,0,function(){r.add(q).css({opacity:1,cursor:"auto"}).hide(),bb(m),A.remove(),setTimeout(function(){U=!1,bb(l,K.onClosed)},1)}))},W.element=function(){return a(P)},W.settings=d,a("."+g,b).live("click",function(a){a.which>1||a.shiftKey||a.altKey||a.metaKey||(a.preventDefault(),bd(this))}),W.init()})(jQuery,document,this);