!function(t){null==t.isNumeric&&(t.isNumeric=function(t){return null!=t&&t.constructor===Number}),null==t.isFunction&&(t.isFunction=function(t){return null!=t&&t instanceof Function});var e=t(window),i=t(document),n={defaultConfig:{animate:!1,cellW:100,cellH:100,delay:0,engine:"giot",fixSize:null,gutterX:15,gutterY:15,keepOrder:!1,selector:"> div",draggable:!1,cacheSize:!0,rightToLeft:!1,bottomToTop:!1,onGapFound:function(){},onComplete:function(){},onResize:function(){},onBlockDrag:function(){},onBlockMove:function(){},onBlockDrop:function(){},onBlockReady:function(){},onBlockFinish:function(){},onBlockActive:function(){},onBlockResize:function(){}},plugin:{},totalGrid:1,transition:!1,loadBlock:function(e,i){var n=i.runtime,a=n.gutterX,o=n.gutterY,l=n.cellH,r=n.cellW,h=null,d=t(e),s=d.data("active"),c=d.attr("data-position"),u=parseInt(d.attr("data-fixSize")),f=n.lastId++ +"-"+n.totalGrid;if(!d.hasClass("fw-float")){d.attr({id:f,"data-delay":e.index}),i.animate&&this.transition&&this.setTransition(e,""),isNaN(u)&&(u=null),null==u&&(u=i.fixSize);var g=u>=1?"ceil":"round";null==d.attr("data-height")&&d.attr("data-height",d.height()),null==d.attr("data-width")&&d.attr("data-width",d.width());var m=1*d.attr("data-height"),w=1*d.attr("data-width");i.cacheSize||(e.style.width="",w=d.width(),e.style.height="",m=d.height());var v=w?Math[g]((w+a)/r):0,p=m?Math[g]((m+o)/l):0;if(u||"auto"!=i.cellH||(d.width(r*v-a),e.style.height="",m=d.height(),p=m?Math.round((m+o)/l):0),u||"auto"!=i.cellW||(d.height(l*p-o),e.style.width="",w=d.width(),v=w?Math.round((w+a)/r):0),null!=u&&(v>n.limitCol||p>n.limitRow))h=null;else if(p&&p<n.minHoB&&(n.minHoB=p),v&&v<n.minWoB&&(n.minWoB=v),p>n.maxHoB&&(n.maxHoB=p),v>n.maxWoB&&(n.maxWoB=v),0==w&&(v=0),0==m&&(p=0),h={resize:!1,id:f,width:v,height:p,fixSize:u},c){c=c.split("-"),h.y=1*c[0],h.x=1*c[1],h.width=null!=u?v:Math.min(v,n.limitCol-h.x),h.height=null!=u?p:Math.min(p,n.limitRow-h.y);var x=h.y+"-"+h.x+"-"+h.width+"-"+h.height;s?(n.holes[x]={id:h.id,top:h.y,left:h.x,width:h.width,height:h.height},this.setBlock(h,i)):delete n.holes[x]}return null==d.attr("data-state")?d.attr("data-state","init"):d.attr("data-state","move"),i.onBlockReady.call(e,h,i),c&&s?null:h}},setBlock:function(t,e){var i=e.runtime,n=i.gutterX,a=i.gutterY,o=t.height,l=t.width,r=i.cellH,h=i.cellW,d=t.x,s=t.y;e.rightToLeft&&(d=i.limitCol-d-l),e.bottomToTop&&(s=i.limitRow-s-o);var c={fixSize:t.fixSize,resize:t.resize,top:s*r,left:d*h,width:h*l-n,height:r*o-a};return c.top=1*c.top.toFixed(2),c.left=1*c.left.toFixed(2),c.width=1*c.width.toFixed(2),c.height=1*c.height.toFixed(2),t.id&&(i.blocks[t.id]=c),c},showBlock:function(e,i){function n(){if(d&&r.attr("data-state","start"),i.animate&&h.transition&&h.setTransition(e,s),l)l.fixSize&&(l.height=1*r.attr("data-height"),l.width=1*r.attr("data-width")),r.css({opacity:1,width:l.width,height:l.height}),r[o]({top:l.top,left:l.left}),null!=r.attr("data-nested")&&h.nestedGrid(e,i);else{var t=parseInt(e.style.height)||0,n=parseInt(e.style.width)||0,c=parseInt(e.style.left)||0,u=parseInt(e.style.top)||0;r[o]({left:c+n/2,top:u+t/2,width:0,height:0,opacity:0})}a.length-=1,i.onBlockFinish.call(e,l,i),0==a.length&&i.onComplete.call(e,l,i)}var a=i.runtime,o=i.animate&&!this.transition?"animate":"css",l=a.blocks[e.id],r=t(e),h=this,d="move"!=r.attr("data-state"),s=d?"width 0.5s, height 0.5s":"top 0.5s, left 0.5s, width 0.5s, height 0.5s, opacity 0.5s";e.delay&&clearTimeout(e.delay),r.hasClass("fw-float")||(h.setTransition(e,""),e.style.position="absolute",i.onBlockActive.call(e,l,i),l&&l.resize&&i.onBlockResize.call(e,l,i),i.delay>0?e.delay=setTimeout(n,i.delay*r.attr("data-delay")):n())},nestedGrid:function(e,i){var n,a=t(e),o=i.runtime,l=a.attr("data-gutterX")||i.gutterX,r=a.attr("data-gutterY")||i.gutterY,h=a.attr("data-method")||"fitZone",d=a.attr("data-nested")||"> div",s=a.attr("data-cellH")||i.cellH,c=a.attr("data-cellW")||i.cellW,u=o.blocks[e.id];if(u)switch(n=new freewall(a),n.reset({cellH:s,cellW:c,gutterX:1*l,gutterY:1*r,selector:d,cacheSize:!1}),h){case"fitHeight":n[h](u.height);break;case"fitWidth":n[h](u.width);break;case"fitZone":n[h](u.width,u.height)}},adjustBlock:function(e,i){var n=i.runtime,a=n.gutterX,o=n.gutterY,l=t("#"+e.id),r=n.cellH,h=n.cellW;"auto"==i.cellH&&(l.width(e.width*h-a),l[0].style.height="",e.height=Math.round((l.height()+o)/r))},adjustUnit:function(e,i,n){var a=n.gutterX,o=n.gutterY,l=n.runtime,r=n.cellW,h=n.cellH;if(t.isFunction(r)&&(r=r(e)),r=1*r,!t.isNumeric(r)&&(r=1),t.isFunction(h)&&(h=h(i)),h=1*h,!t.isNumeric(h)&&(h=1),t.isNumeric(e)){1>r&&(r*=e);var d=Math.max(1,Math.floor(e/r));t.isNumeric(a)||(a=(e-d*r)/Math.max(1,d-1),a=Math.max(0,a)),d=Math.floor((e+a)/r),l.cellW=(e+a)/Math.max(d,1),l.cellS=l.cellW/r,l.gutterX=a,l.limitCol=d}if(t.isNumeric(i)){1>h&&(h*=i);var s=Math.max(1,Math.floor(i/h));t.isNumeric(o)||(o=(i-s*h)/Math.max(1,s-1),o=Math.max(0,o)),s=Math.floor((i+o)/h),l.cellH=(i+o)/Math.max(s,1),l.cellS=l.cellH/h,l.gutterY=o,l.limitRow=s}t.isNumeric(e)||(1>r&&(r=l.cellH),l.cellW=1!=r?r*l.cellS:1,l.gutterX=a,l.limitCol=666666),t.isNumeric(i)||(1>h&&(h=l.cellW),l.cellH=1!=h?h*l.cellS:1,l.gutterY=o,l.limitRow=666666)},resetGrid:function(t){t.blocks={},t.length=0,t.cellH=0,t.cellW=0,t.lastId=1,t.matrix={},t.totalCol=0,t.totalRow=0},setDraggable:function(e,n){var a=!1,o={startX:0,startY:0,top:0,left:0,handle:null,onDrop:function(){},onDrag:function(){},onStart:function(){}};t(e).each(function(){function e(t){return t.stopPropagation(),t=t.originalEvent,t.touches&&(a=!0,t=t.changedTouches[0]),2!=t.button&&3!=t.which&&(h.onStart.call(s,t),h.startX=t.clientX,h.startY=t.clientY,h.top=parseInt(c.css("top"))||0,h.left=parseInt(c.css("left"))||0,i.bind("mouseup touchend",r),i.bind("mousemove touchmove",l)),!1}function l(t){t=t.originalEvent,a&&(t=t.changedTouches[0]),c.css({top:h.top-(h.startY-t.clientY),left:h.left-(h.startX-t.clientX)}),h.onDrag.call(s,t)}function r(t){t=t.originalEvent,a&&(t=t.changedTouches[0]),h.onDrop.call(s,t),i.unbind("mouseup touchend",r),i.unbind("mousemove touchmove",l)}var h=t.extend({},o,n),d=h.handle||this,s=this,c=t(s),u=t(d),f=c.css("position");"absolute"!=f&&c.css("position","relative"),c.find("iframe, form, input, textarea, .ignore-drag").each(function(){t(this).on("touchstart mousedown",function(t){t.stopPropagation()})}),i.unbind("mouseup touchend",r),i.unbind("mousemove touchmove",l),u.unbind("mousedown touchstart").bind("mousedown touchstart",e)})},setTransition:function(e,i){var n=e.style,a=t(e);!this.transition&&a.stop?a.stop():null!=n.webkitTransition?n.webkitTransition=i:null!=n.MozTransition?n.MozTransition=i:null!=n.msTransition?n.msTransition=i:null!=n.OTransition?n.OTransition=i:n.transition=i},getFreeArea:function(t,e,i){for(var n=Math.min(t+i.maxHoB,i.limitRow),a=Math.min(e+i.maxWoB,i.limitCol),o=a,l=n,r=i.matrix,h=t;l>h;++h)for(var d=e;a>d;++d)r[h+"-"+d]&&d>e&&o>d&&(o=d);for(var h=t;n>h;++h)for(var d=e;o>d;++d)r[h+"-"+d]&&h>t&&l>h&&(l=h);return{top:t,left:e,width:o-e,height:l-t}},setWallSize:function(t,e){var i=t.totalRow,n=t.totalCol,a=t.gutterY,o=t.gutterX,l=t.cellH,r=t.cellW,h=Math.max(0,r*n-o),d=Math.max(0,l*i-a);e.attr({"data-total-col":n,"data-total-row":i,"data-wall-width":Math.ceil(h),"data-wall-height":Math.ceil(d)}),t.limitCol<t.limitRow&&!e.attr("data-height")&&e.height(Math.ceil(d))}},a={giot:function(t,e){function i(t,e,i,n,a){for(var o=e;e+a>o;){for(var l=i;i+n>l;)g[o+"-"+l]=t,++l>d&&(d=l);++o>s&&(s=o)}}var a=e.runtime,o=a.limitRow,l=a.limitCol,r=0,h=0,d=a.totalCol,s=a.totalRow,c={},u=a.holes,f=null,g=a.matrix,m=Math.max(l,o),w=null,v=null,p=o>l?1:0,x=null,M=Math.min(l,o);for(var k in u)u.hasOwnProperty(k)&&i(u[k].id||!0,u[k].top,u[k].left,u[k].width,u[k].height);for(var B=0;m>B&&t.length;++B){p?h=B:r=B,x=null;for(var b=0;M>b&&t.length;++b)if(f=null,p?r=b:h=b,!a.matrix[h+"-"+r]){if(w=n.getFreeArea(h,r,a),null==e.fixSize){if(x&&!p&&a.minHoB>w.height){x.height+=w.height,x.resize=!0,i(x.id,x.y,x.x,x.width,x.height),n.setBlock(x,e);continue}if(x&&p&&a.minWoB>w.width){x.width+=w.width,x.resize=!0,i(x.id,x.y,x.x,x.width,x.height),n.setBlock(x,e);continue}}if(e.keepOrder)f=t.shift(),f.resize=!0;else{for(var k=0;k<t.length;++k)if(!(t[k].height>w.height||t[k].width>w.width)){f=t.splice(k,1)[0];break}if(null==f&&null==e.fixSize)for(var k=0;k<t.length;++k)if(null==t[k].fixSize){f=t.splice(k,1)[0],f.resize=!0;break}}if(null!=f)f.resize&&(p?(f.width=w.width,"auto"==e.cellH&&n.adjustBlock(f,e),f.height=Math.min(f.height,w.height)):(f.height=w.height,f.width=Math.min(f.width,w.width))),c[f.id]={id:f.id,x:r,y:h,width:f.width,height:f.height,resize:f.resize,fixSize:f.fixSize},x=c[f.id],i(x.id,x.y,x.x,x.width,x.height),n.setBlock(x,e);else{var v={x:r,y:h,fixSize:0};if(p){v.width=w.width,v.height=0;for(var y=r-1,z=h;g[z+"-"+y];)g[z+"-"+r]=!0,v.height+=1,z+=1}else{v.height=w.height,v.width=0;for(var z=h-1,y=r;g[z+"-"+y];)g[h+"-"+y]=!0,v.width+=1,y+=1}e.onGapFound(n.setBlock(v,e),e)}}}a.matrix=g,a.totalRow=s,a.totalCol=d}};window.freewall=function(i){function o(e){var i=(s.gutterX,s.gutterY,s.cellH),a=s.cellW,o=t(e),l=o.find(o.attr("data-handle"));n.setDraggable(e,{handle:l[0],onStart:function(t){d.animate&&n.transition&&n.setTransition(this,""),o.css("z-index",9999).addClass("fw-float"),d.onBlockDrag.call(e,t)},onDrag:function(t,n){var l=o.position(),r=Math.round(l.top/i),c=Math.round(l.left/a),u=Math.round(o.width()/a),f=Math.round(o.height()/i);r=Math.min(Math.max(0,r),s.limitRow-f),c=Math.min(Math.max(0,c),s.limitCol-u),h.setHoles({top:r,left:c,width:u,height:f}),h.refresh(),d.onBlockMove.call(e,t)},onDrop:function(n){var l=o.position(),r=Math.round(l.top/i),c=Math.round(l.left/a),u=Math.round(o.width()/a),f=Math.round(o.height()/i);r=Math.min(Math.max(0,r),s.limitRow-f),c=Math.min(Math.max(0,c),s.limitCol-u),o.removeClass("fw-float"),o.css({zIndex:"auto",top:r*i,left:c*a});var g,m,w,v;for(m=0;f>m;++m)for(g=0;u>g;++g)w=m+r+"-"+(g+c),v=s.matrix[w],v&&1!=v&&t("#"+v).removeAttr("data-position");s.holes={},o.attr({"data-width":o.width(),"data-height":o.height(),"data-position":r+"-"+c}),h.refresh(),d.onBlockDrop.call(e,n)}})}var l=t(i);"static"==l.css("position")&&l.css("position","relative");var r=Number.MAX_VALUE,h=this;n.totalGrid+=1;var d=t.extend({},n.defaultConfig),s={blocks:{},events:{},matrix:{},holes:{},cellW:0,cellH:0,cellS:1,filter:"",lastId:0,length:0,maxWoB:0,maxHoB:0,minWoB:r,minHoB:r,running:0,gutterX:15,gutterY:15,totalCol:0,totalRow:0,limitCol:666666,limitRow:666666,currentMethod:null,currentArguments:[]};d.runtime=s,s.totalGrid=n.totalGrid;var c=document.body.style;n.transition||(null!=c.webkitTransition||null!=c.MozTransition||null!=c.msTransition||null!=c.OTransition||null!=c.transition)&&(n.transition=!0),t.extend(h,{addCustomEvent:function(t,e){var i=s.events;return t=t.toLowerCase(),!i[t]&&(i[t]=[]),e.eid=i[t].length,i[t].push(e),this},appendBlock:function(e){var i=t(e).appendTo(l),r=null,h=[];s.currentMethod&&(i.each(function(t,e){e.index=++t,r=n.loadBlock(e,d),r&&h.push(r)}),a[d.engine](h,d),n.setWallSize(s,l),s.length=i.length,i.each(function(t,e){n.showBlock(e,d),(d.draggable||e.getAttribute("data-draggable"))&&o(e)}))},appendHoles:function(t){var e,i=[].concat(t),n={};for(e=0;e<i.length;++e)n=i[e],s.holes[n.top+"-"+n.left+"-"+n.width+"-"+n.height]=n;return this},container:l,destroy:function(){var e=l.find(d.selector).removeAttr("id");e.each(function(e,i){$item=t(i);var n=1*$item.attr("data-width")||"",a=1*$item.attr("data-height")||"";$item.width(n).height(a).css({position:"static"})})},fillHoles:function(t){if(0==arguments.length)s.holes={};else{var e,i=[].concat(t),n={};for(e=0;e<i.length;++e)n=i[e],delete s.holes[n.top+"-"+n.left+"-"+n.width+"-"+n.height]}return this},filter:function(t){return s.filter=t,s.currentMethod&&this.refresh(),this},fireEvent:function(t,e,i){var n=s.events;if(t=t.toLowerCase(),n[t]&&n[t].length)for(var a=0;a<n[t].length;++a)n[t][a].call(this,e,i);return this},fitHeight:function(i){var r=l.find(d.selector).removeAttr("id"),c=null,u=[];i=i?i:l.height()||e.height(),s.currentMethod=arguments.callee,s.currentArguments=arguments,n.resetGrid(s),n.adjustUnit("auto",i,d),s.filter?(r.data("active",0),r.filter(s.filter).data("active",1)):r.data("active",1),r.each(function(e,i){var a=t(i);i.index=++e,c=n.loadBlock(i,d),c&&a.data("active")&&u.push(c)}),h.fireEvent("onGridReady",l,d),a[d.engine](u,d),n.setWallSize(s,l),h.fireEvent("onGridArrange",l,d),s.length=r.length,r.each(function(t,e){n.showBlock(e,d),(d.draggable||e.getAttribute("data-draggable"))&&o(e)})},fitWidth:function(i){var r=l.find(d.selector).removeAttr("id"),c=null,u=[];i=i?i:l.width()||e.width(),s.currentMethod=arguments.callee,s.currentArguments=arguments,n.resetGrid(s),n.adjustUnit(i,"auto",d),s.filter?(r.data("active",0),r.filter(s.filter).data("active",1)):r.data("active",1),r.each(function(e,i){var a=t(i);i.index=++e,c=n.loadBlock(i,d),c&&a.data("active")&&u.push(c)}),h.fireEvent("onGridReady",l,d),a[d.engine](u,d),n.setWallSize(s,l),h.fireEvent("onGridArrange",l,d),s.length=r.length,r.each(function(t,e){n.showBlock(e,d),(d.draggable||e.getAttribute("data-draggable"))&&o(e)})},fitZone:function(i,r){var c=l.find(d.selector).removeAttr("id"),u=null,f=[];r=r?r:l.height()||e.height(),i=i?i:l.width()||e.width(),s.currentMethod=arguments.callee,s.currentArguments=arguments,n.resetGrid(s),n.adjustUnit(i,r,d),s.filter?(c.data("active",0),c.filter(s.filter).data("active",1)):c.data("active",1),c.each(function(e,i){var a=t(i);i.index=++e,u=n.loadBlock(i,d),u&&a.data("active")&&f.push(u)}),h.fireEvent("onGridReady",l,d),a[d.engine](f,d),n.setWallSize(s,l),h.fireEvent("onGridArrange",l,d),s.length=c.length,c.each(function(t,e){n.showBlock(e,d),(d.draggable||e.getAttribute("data-draggable"))&&o(e)})},fixPos:function(e){return t(e.block).attr({"data-position":e.top+"-"+e.left}),this},fixSize:function(e){return null!=e.height&&t(e.block).attr({"data-height":e.height}),null!=e.width&&t(e.block).attr({"data-width":e.width}),this},prepend:function(t){return l.prepend(t),s.currentMethod&&this.refresh(),this},refresh:function(){var t=arguments.length?arguments:s.currentArguments;return null==s.currentMethod&&(s.currentMethod=this.fitWidth),s.currentMethod.apply(this,Array.prototype.slice.call(t,0)),this},reset:function(e){return t.extend(d,e),this},setHoles:function(t){var e,i=[].concat(t),n={};for(s.holes={},e=0;e<i.length;++e)n=i[e],s.holes[n.top+"-"+n.left+"-"+n.width+"-"+n.height]=n;return this},unFilter:function(){return delete s.filter,this.refresh(),this}}),l.attr("data-min-width",80*Math.floor(e.width()/80));for(var u in n.plugin)n.plugin.hasOwnProperty(u)&&n.plugin[u].call(h,d,l);e.resize(function(){s.running||(s.running=1,setTimeout(function(){s.running=0,d.onResize.call(h,l)},122),l.attr("data-min-width",80*Math.floor(e.width()/80)))})},freewall.addConfig=function(e){t.extend(n.defaultConfig,e)},freewall.createEngine=function(e){t.extend(a,e)},freewall.createPlugin=function(e){t.extend(n.plugin,e)},freewall.getMethod=function(t){return n[t]}}(window.Zepto||window.jQuery);
//# sourceMappingURL=freewall.js.map
