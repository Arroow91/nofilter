/*! lazysizes - v4.0.2 */
!function(a,b){var c=b(a,a.document);a.lazySizes=c,"object"==typeof module&&module.exports&&(module.exports=c)}(window,function(a,b){"use strict";if(b.getElementsByClassName){var c,d,e=b.documentElement,f=a.Date,g=a.HTMLPictureElement,h="addEventListener",i="getAttribute",j=a[h],k=a.setTimeout,l=a.requestAnimationFrame||k,m=a.requestIdleCallback,n=/^picture$/i,o=["load","error","lazyincluded","_lazyloaded"],p={},q=Array.prototype.forEach,r=function(a,b){return p[b]||(p[b]=new RegExp("(\\s|^)"+b+"(\\s|$)")),p[b].test(a[i]("class")||"")&&p[b]},s=function(a,b){r(a,b)||a.setAttribute("class",(a[i]("class")||"").trim()+" "+b)},t=function(a,b){var c;(c=r(a,b))&&a.setAttribute("class",(a[i]("class")||"").replace(c," "))},u=function(a,b,c){var d=c?h:"removeEventListener";c&&u(a,b),o.forEach(function(c){a[d](c,b)})},v=function(a,d,e,f,g){var h=b.createEvent("CustomEvent");return e||(e={}),e.instance=c,h.initCustomEvent(d,!f,!g,e),a.dispatchEvent(h),h},w=function(b,c){var e;!g&&(e=a.picturefill||d.pf)?e({reevaluate:!0,elements:[b]}):c&&c.src&&(b.src=c.src)},x=function(a,b){return(getComputedStyle(a,null)||{})[b]},y=function(a,b,c){for(c=c||a.offsetWidth;c<d.minSize&&b&&!a._lazysizesWidth;)c=b.offsetWidth,b=b.parentNode;return c},z=function(){var a,c,d=[],e=[],f=d,g=function(){var b=f;for(f=d.length?e:d,a=!0,c=!1;b.length;)b.shift()();a=!1},h=function(d,e){a&&!e?d.apply(this,arguments):(f.push(d),c||(c=!0,(b.hidden?k:l)(g)))};return h._lsFlush=g,h}(),A=function(a,b){return b?function(){z(a)}:function(){var b=this,c=arguments;z(function(){a.apply(b,c)})}},B=function(a){var b,c=0,e=d.throttleDelay,g=d.ricTimeout,h=function(){b=!1,c=f.now(),a()},i=m&&g>49?function(){m(h,{timeout:g}),g!==d.ricTimeout&&(g=d.ricTimeout)}:A(function(){k(h)},!0);return function(a){var d;(a=a===!0)&&(g=33),b||(b=!0,d=e-(f.now()-c),0>d&&(d=0),a||9>d?i():k(i,d))}},C=function(a){var b,c,d=99,e=function(){b=null,a()},g=function(){var a=f.now()-c;d>a?k(g,d-a):(m||e)(e)};return function(){c=f.now(),b||(b=k(g,d))}};!function(){var b,c={lazyClass:"lazyload",loadedClass:"lazyloaded",loadingClass:"lazyloading",preloadClass:"lazypreload",errorClass:"lazyerror",autosizesClass:"lazyautosizes",srcAttr:"data-src",srcsetAttr:"data-srcset",sizesAttr:"data-sizes",minSize:40,customMedia:{},init:!0,expFactor:1.5,hFac:.8,loadMode:2,loadHidden:!0,ricTimeout:0,throttleDelay:125};d=a.lazySizesConfig||a.lazysizesConfig||{};for(b in c)b in d||(d[b]=c[b]);a.lazySizesConfig=d,k(function(){d.init&&F()})}();var D=function(){var g,l,m,o,p,y,D,F,G,H,I,J,K,L,M=/^img$/i,N=/^iframe$/i,O="onscroll"in a&&!/glebot/.test(navigator.userAgent),P=0,Q=0,R=0,S=-1,T=function(a){R--,a&&a.target&&u(a.target,T),(!a||0>R||!a.target)&&(R=0)},U=function(a,c){var d,f=a,g="hidden"==x(b.body,"visibility")||"hidden"!=x(a,"visibility");for(F-=c,I+=c,G-=c,H+=c;g&&(f=f.offsetParent)&&f!=b.body&&f!=e;)g=(x(f,"opacity")||1)>0,g&&"visible"!=x(f,"overflow")&&(d=f.getBoundingClientRect(),g=H>d.left&&G<d.right&&I>d.top-1&&F<d.bottom+1);return g},V=function(){var a,f,h,j,k,m,n,p,q,r=c.elements;if((o=d.loadMode)&&8>R&&(a=r.length)){f=0,S++,null==K&&("expand"in d||(d.expand=e.clientHeight>500&&e.clientWidth>500?500:370),J=d.expand,K=J*d.expFactor),K>Q&&1>R&&S>2&&o>2&&!b.hidden?(Q=K,S=0):Q=o>1&&S>1&&6>R?J:P;for(;a>f;f++)if(r[f]&&!r[f]._lazyRace)if(O)if((p=r[f][i]("data-expand"))&&(m=1*p)||(m=Q),q!==m&&(y=innerWidth+m*L,D=innerHeight+m,n=-1*m,q=m),h=r[f].getBoundingClientRect(),(I=h.bottom)>=n&&(F=h.top)<=D&&(H=h.right)>=n*L&&(G=h.left)<=y&&(I||H||G||F)&&(d.loadHidden||"hidden"!=x(r[f],"visibility"))&&(l&&3>R&&!p&&(3>o||4>S)||U(r[f],m))){if(ba(r[f]),k=!0,R>9)break}else!k&&l&&!j&&4>R&&4>S&&o>2&&(g[0]||d.preloadAfterLoad)&&(g[0]||!p&&(I||H||G||F||"auto"!=r[f][i](d.sizesAttr)))&&(j=g[0]||r[f]);else ba(r[f]);j&&!k&&ba(j)}},W=B(V),X=function(a){s(a.target,d.loadedClass),t(a.target,d.loadingClass),u(a.target,Z),v(a.target,"lazyloaded")},Y=A(X),Z=function(a){Y({target:a.target})},$=function(a,b){try{a.contentWindow.location.replace(b)}catch(c){a.src=b}},_=function(a){var b,c=a[i](d.srcsetAttr);(b=d.customMedia[a[i]("data-media")||a[i]("media")])&&a.setAttribute("media",b),c&&a.setAttribute("srcset",c)},aa=A(function(a,b,c,e,f){var g,h,j,l,o,p;(o=v(a,"lazybeforeunveil",b)).defaultPrevented||(e&&(c?s(a,d.autosizesClass):a.setAttribute("sizes",e)),h=a[i](d.srcsetAttr),g=a[i](d.srcAttr),f&&(j=a.parentNode,l=j&&n.test(j.nodeName||"")),p=b.firesLoad||"src"in a&&(h||g||l),o={target:a},p&&(u(a,T,!0),clearTimeout(m),m=k(T,2500),s(a,d.loadingClass),u(a,Z,!0)),l&&q.call(j.getElementsByTagName("source"),_),h?a.setAttribute("srcset",h):g&&!l&&(N.test(a.nodeName)?$(a,g):a.src=g),f&&(h||l)&&w(a,{src:g})),a._lazyRace&&delete a._lazyRace,t(a,d.lazyClass),z(function(){(!p||a.complete&&a.naturalWidth>1)&&(p?T(o):R--,X(o))},!0)}),ba=function(a){var b,c=M.test(a.nodeName),e=c&&(a[i](d.sizesAttr)||a[i]("sizes")),f="auto"==e;(!f&&l||!c||!a[i]("src")&&!a.srcset||a.complete||r(a,d.errorClass)||!r(a,d.lazyClass))&&(b=v(a,"lazyunveilread").detail,f&&E.updateElem(a,!0,a.offsetWidth),a._lazyRace=!0,R++,aa(a,b,f,e,c))},ca=function(){if(!l){if(f.now()-p<999)return void k(ca,999);var a=C(function(){d.loadMode=3,W()});l=!0,d.loadMode=3,W(),j("scroll",function(){3==d.loadMode&&(d.loadMode=2),a()},!0)}};return{_:function(){p=f.now(),c.elements=b.getElementsByClassName(d.lazyClass),g=b.getElementsByClassName(d.lazyClass+" "+d.preloadClass),L=d.hFac,j("scroll",W,!0),j("resize",W,!0),a.MutationObserver?new MutationObserver(W).observe(e,{childList:!0,subtree:!0,attributes:!0}):(e[h]("DOMNodeInserted",W,!0),e[h]("DOMAttrModified",W,!0),setInterval(W,999)),j("hashchange",W,!0),["focus","mouseover","click","load","transitionend","animationend","webkitAnimationEnd"].forEach(function(a){b[h](a,W,!0)}),/d$|^c/.test(b.readyState)?ca():(j("load",ca),b[h]("DOMContentLoaded",W),k(ca,2e4)),c.elements.length?(V(),z._lsFlush()):W()},checkElems:W,unveil:ba}}(),E=function(){var a,c=A(function(a,b,c,d){var e,f,g;if(a._lazysizesWidth=d,d+="px",a.setAttribute("sizes",d),n.test(b.nodeName||""))for(e=b.getElementsByTagName("source"),f=0,g=e.length;g>f;f++)e[f].setAttribute("sizes",d);c.detail.dataAttr||w(a,c.detail)}),e=function(a,b,d){var e,f=a.parentNode;f&&(d=y(a,f,d),e=v(a,"lazybeforesizes",{width:d,dataAttr:!!b}),e.defaultPrevented||(d=e.detail.width,d&&d!==a._lazysizesWidth&&c(a,f,e,d)))},f=function(){var b,c=a.length;if(c)for(b=0;c>b;b++)e(a[b])},g=C(f);return{_:function(){a=b.getElementsByClassName(d.autosizesClass),j("resize",g)},checkElems:g,updateElem:e}}(),F=function(){F.i||(F.i=!0,E._(),D._())};return c={cfg:d,autoSizer:E,loader:D,init:F,uP:w,aC:s,rC:t,hC:r,fire:v,gW:y,rAF:z}}});
/*! easyPieChart */
!function(e,t){"function"==typeof define&&define.amd?define(["jquery"],function(e){return t(e)}):"object"==typeof exports?module.exports=t(require("jquery")):t(jQuery)}(this,function(e){var t=function(e,t){var n,a=document.createElement("canvas");e.appendChild(a),"object"==typeof G_vmlCanvasManager&&G_vmlCanvasManager.initElement(a);var i=a.getContext("2d");a.width=a.height=t.size;var r=1;window.devicePixelRatio>1&&(r=window.devicePixelRatio,a.style.width=a.style.height=[t.size,"px"].join(""),a.width=a.height=t.size*r,i.scale(r,r)),i.translate(t.size/2,t.size/2),i.rotate((-.5+t.rotate/180)*Math.PI);var o=(t.size-t.lineWidth)/2;t.scaleColor&&t.scaleLength&&(o-=t.scaleLength+2),Date.now=Date.now||function(){return+new Date};var s=function(e,t,n){n=Math.min(Math.max(-1,n||0),1);var a=0>=n?!0:!1;i.beginPath(),i.arc(0,0,o,0,2*Math.PI*n,a),i.strokeStyle=e,i.lineWidth=t,i.stroke()},d=function(){var e,n;i.lineWidth=1,i.fillStyle=t.scaleColor,i.save();for(var a=24;a>0;--a)a%6===0?(n=t.scaleLength,e=0):(n=.6*t.scaleLength,e=t.scaleLength-n),i.fillRect(-t.size/2+e,0,n,1),i.rotate(Math.PI/12);i.restore()},h=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(e){window.setTimeout(e,1e3/60)}}(),u=function(){t.scaleColor&&d(),t.trackColor&&s(t.trackColor,t.trackWidth||t.lineWidth,1)};this.getCanvas=function(){return a},this.getCtx=function(){return i},this.clear=function(){i.clearRect(t.size/-2,t.size/-2,t.size,t.size)},this.draw=function(e){t.scaleColor||t.trackColor?i.getImageData&&i.putImageData?n?i.putImageData(n,0,0):(u(),n=i.getImageData(0,0,t.size*r,t.size*r)):(this.clear(),u()):this.clear(),i.lineCap=t.lineCap;var a;a="function"==typeof t.barColor?t.barColor(e):t.barColor,s(a,t.lineWidth,e/100)}.bind(this),this.animate=function(e,n){var a=Date.now();t.onStart(e,n);var i=function(){var r=Math.min(Date.now()-a,t.animate.duration),o=t.easing(this,r,e,n-e,t.animate.duration);this.draw(o),t.onStep(e,n,o),r>=t.animate.duration?t.onStop(e,n):h(i)}.bind(this);h(i)}.bind(this)},n=function(e,n){var a={barColor:"#ef1e25",trackColor:"#f9f9f9",scaleColor:"#dfe0e0",scaleLength:5,lineCap:"round",lineWidth:3,trackWidth:void 0,size:110,rotate:0,animate:{duration:1e3,enabled:!0},easing:function(e,t,n,a,i){return t/=i/2,1>t?a/2*t*t+n:-a/2*(--t*(t-2)-1)+n},onStart:function(e,t){},onStep:function(e,t,n){},onStop:function(e,t){}};if("undefined"!=typeof t)a.renderer=t;else{if("undefined"==typeof SVGRenderer)throw new Error("Please load either the SVG- or the CanvasRenderer");a.renderer=SVGRenderer}var i={},r=0,o=function(){this.el=e,this.options=i;for(var t in a)a.hasOwnProperty(t)&&(i[t]=n&&"undefined"!=typeof n[t]?n[t]:a[t],"function"==typeof i[t]&&(i[t]=i[t].bind(this)));"string"==typeof i.easing&&"undefined"!=typeof jQuery&&jQuery.isFunction(jQuery.easing[i.easing])?i.easing=jQuery.easing[i.easing]:i.easing=a.easing,"number"==typeof i.animate&&(i.animate={duration:i.animate,enabled:!0}),"boolean"!=typeof i.animate||i.animate||(i.animate={duration:1e3,enabled:i.animate}),this.renderer=new i.renderer(e,i),this.renderer.draw(r),e.dataset&&e.dataset.percent?this.update(parseFloat(e.dataset.percent)):e.getAttribute&&e.getAttribute("data-percent")&&this.update(parseFloat(e.getAttribute("data-percent")))}.bind(this);this.update=function(e){return e=parseFloat(e),i.animate.enabled?this.renderer.animate(r,e):this.renderer.draw(e),r=e,this}.bind(this),this.disableAnimation=function(){return i.animate.enabled=!1,this},this.enableAnimation=function(){return i.animate.enabled=!0,this},o()};e.fn.easyPieChart=function(t){return this.each(function(){var a;e.data(this,"easyPieChart")||(a=e.extend({},t,e(this).data()),e.data(this,"easyPieChart",new n(this,a)))})}});
/*!
 * Bootstrap v3.3.7 (http://getbootstrap.com)
 * Copyright 2011-2017 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */

/*!
 * Generated using the Bootstrap Customizer (http://getbootstrap.com/customize/?id=34a66cab5021c4a9c9dc053d9f6fa2c8)
 * Config saved to config.json and https://gist.github.com/34a66cab5021c4a9c9dc053d9f6fa2c8
 */
if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery"); + function(t) {
    "use strict";
    var e = t.fn.jquery.split(" ")[0].split(".");
    if (e[0] < 2 && e[1] < 9 || 1 == e[0] && 9 == e[1] && e[2] < 1 || e[0] > 3) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4")
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var o = t(this),
                n = o.data("bs.tooltip"),
                s = "object" == typeof e && e;
            !n && /destroy|hide/.test(e) || (n || o.data("bs.tooltip", n = new i(this, s)), "string" == typeof e && n[e]())
        })
    }
    var i = function(t, e) {
        this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.inState = null, this.init("tooltip", t, e)
    };
    i.VERSION = "3.3.7", i.TRANSITION_DURATION = 150, i.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1,
        viewport: {
            selector: "body",
            padding: 0
        }
    }, i.prototype.init = function(e, i, o) {
        if (this.enabled = !0, this.type = e, this.$element = t(i), this.options = this.getOptions(o), this.$viewport = this.options.viewport && t(t.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : this.options.viewport.selector || this.options.viewport), this.inState = {
                click: !1,
                hover: !1,
                focus: !1
            }, this.$element[0] instanceof document.constructor && !this.options.selector) throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
        for (var n = this.options.trigger.split(" "), s = n.length; s--;) {
            var a = n[s];
            if ("click" == a) this.$element.on("click." + this.type, this.options.selector, t.proxy(this.toggle, this));
            else if ("manual" != a) {
                var r = "hover" == a ? "mouseenter" : "focusin",
                    l = "hover" == a ? "mouseleave" : "focusout";
                this.$element.on(r + "." + this.type, this.options.selector, t.proxy(this.enter, this)), this.$element.on(l + "." + this.type, this.options.selector, t.proxy(this.leave, this))
            }
        }
        this.options.selector ? this._options = t.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle()
    }, i.prototype.getDefaults = function() {
        return i.DEFAULTS
    }, i.prototype.getOptions = function(e) {
        return e = t.extend({}, this.getDefaults(), this.$element.data(), e), e.delay && "number" == typeof e.delay && (e.delay = {
            show: e.delay,
            hide: e.delay
        }), e
    }, i.prototype.getDelegateOptions = function() {
        var e = {},
            i = this.getDefaults();
        return this._options && t.each(this._options, function(t, o) {
            i[t] != o && (e[t] = o)
        }), e
    }, i.prototype.enter = function(e) {
        var i = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
        return i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i)), e instanceof t.Event && (i.inState["focusin" == e.type ? "focus" : "hover"] = !0), i.tip().hasClass("in") || "in" == i.hoverState ? void(i.hoverState = "in") : (clearTimeout(i.timeout), i.hoverState = "in", i.options.delay && i.options.delay.show ? void(i.timeout = setTimeout(function() {
            "in" == i.hoverState && i.show()
        }, i.options.delay.show)) : i.show())
    }, i.prototype.isInStateTrue = function() {
        for (var t in this.inState)
            if (this.inState[t]) return !0;
        return !1
    }, i.prototype.leave = function(e) {
        var i = e instanceof this.constructor ? e : t(e.currentTarget).data("bs." + this.type);
        return i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i)), e instanceof t.Event && (i.inState["focusout" == e.type ? "focus" : "hover"] = !1), i.isInStateTrue() ? void 0 : (clearTimeout(i.timeout), i.hoverState = "out", i.options.delay && i.options.delay.hide ? void(i.timeout = setTimeout(function() {
            "out" == i.hoverState && i.hide()
        }, i.options.delay.hide)) : i.hide())
    }, i.prototype.show = function() {
        var e = t.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            this.$element.trigger(e);
            var o = t.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
            if (e.isDefaultPrevented() || !o) return;
            var n = this,
                s = this.tip(),
                a = this.getUID(this.type);
            this.setContent(), s.attr("id", a), this.$element.attr("aria-describedby", a), this.options.animation && s.addClass("fade");
            var r = "function" == typeof this.options.placement ? this.options.placement.call(this, s[0], this.$element[0]) : this.options.placement,
                l = /\s?auto?\s?/i,
                p = l.test(r);
            p && (r = r.replace(l, "") || "top"), s.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(r).data("bs." + this.type, this), this.options.container ? s.appendTo(this.options.container) : s.insertAfter(this.$element), this.$element.trigger("inserted.bs." + this.type);
            var h = this.getPosition(),
                d = s[0].offsetWidth,
                c = s[0].offsetHeight;
            if (p) {
                var f = r,
                    u = this.getPosition(this.$viewport);
                r = "bottom" == r && h.bottom + c > u.bottom ? "top" : "top" == r && h.top - c < u.top ? "bottom" : "right" == r && h.right + d > u.width ? "left" : "left" == r && h.left - d < u.left ? "right" : r, s.removeClass(f).addClass(r)
            }
            var g = this.getCalculatedOffset(r, h, d, c);
            this.applyPlacement(g, r);
            var v = function() {
                var t = n.hoverState;
                n.$element.trigger("shown.bs." + n.type), n.hoverState = null, "out" == t && n.leave(n)
            };
            t.support.transition && this.$tip.hasClass("fade") ? s.one("bsTransitionEnd", v).emulateTransitionEnd(i.TRANSITION_DURATION) : v()
        }
    }, i.prototype.applyPlacement = function(e, i) {
        var o = this.tip(),
            n = o[0].offsetWidth,
            s = o[0].offsetHeight,
            a = parseInt(o.css("margin-top"), 10),
            r = parseInt(o.css("margin-left"), 10);
        isNaN(a) && (a = 0), isNaN(r) && (r = 0), e.top += a, e.left += r, t.offset.setOffset(o[0], t.extend({
            using: function(t) {
                o.css({
                    top: Math.round(t.top),
                    left: Math.round(t.left)
                })
            }
        }, e), 0), o.addClass("in");
        var l = o[0].offsetWidth,
            p = o[0].offsetHeight;
        "top" == i && p != s && (e.top = e.top + s - p);
        var h = this.getViewportAdjustedDelta(i, e, l, p);
        h.left ? e.left += h.left : e.top += h.top;
        var d = /top|bottom/.test(i),
            c = d ? 2 * h.left - n + l : 2 * h.top - s + p,
            f = d ? "offsetWidth" : "offsetHeight";
        o.offset(e), this.replaceArrow(c, o[0][f], d)
    }, i.prototype.replaceArrow = function(t, e, i) {
        this.arrow().css(i ? "left" : "top", 50 * (1 - t / e) + "%").css(i ? "top" : "left", "")
    }, i.prototype.setContent = function() {
        var t = this.tip(),
            e = this.getTitle();
        t.find(".tooltip-inner")[this.options.html ? "html" : "text"](e), t.removeClass("fade in top bottom left right")
    }, i.prototype.hide = function(e) {
        function o() {
            "in" != n.hoverState && s.detach(), n.$element && n.$element.removeAttr("aria-describedby").trigger("hidden.bs." + n.type), e && e()
        }
        var n = this,
            s = t(this.$tip),
            a = t.Event("hide.bs." + this.type);
        return this.$element.trigger(a), a.isDefaultPrevented() ? void 0 : (s.removeClass("in"), t.support.transition && s.hasClass("fade") ? s.one("bsTransitionEnd", o).emulateTransitionEnd(i.TRANSITION_DURATION) : o(), this.hoverState = null, this)
    }, i.prototype.fixTitle = function() {
        var t = this.$element;
        (t.attr("title") || "string" != typeof t.attr("data-original-title")) && t.attr("data-original-title", t.attr("title") || "").attr("title", "")
    }, i.prototype.hasContent = function() {
        return this.getTitle()
    }, i.prototype.getPosition = function(e) {
        e = e || this.$element;
        var i = e[0],
            o = "BODY" == i.tagName,
            n = i.getBoundingClientRect();
        null == n.width && (n = t.extend({}, n, {
            width: n.right - n.left,
            height: n.bottom - n.top
        }));
        var s = window.SVGElement && i instanceof window.SVGElement,
            a = o ? {
                top: 0,
                left: 0
            } : s ? null : e.offset(),
            r = {
                scroll: o ? document.documentElement.scrollTop || document.body.scrollTop : e.scrollTop()
            },
            l = o ? {
                width: t(window).width(),
                height: t(window).height()
            } : null;
        return t.extend({}, n, r, l, a)
    }, i.prototype.getCalculatedOffset = function(t, e, i, o) {
        return "bottom" == t ? {
            top: e.top + e.height,
            left: e.left + e.width / 2 - i / 2
        } : "top" == t ? {
            top: e.top - o,
            left: e.left + e.width / 2 - i / 2
        } : "left" == t ? {
            top: e.top + e.height / 2 - o / 2,
            left: e.left - i
        } : {
            top: e.top + e.height / 2 - o / 2,
            left: e.left + e.width
        }
    }, i.prototype.getViewportAdjustedDelta = function(t, e, i, o) {
        var n = {
            top: 0,
            left: 0
        };
        if (!this.$viewport) return n;
        var s = this.options.viewport && this.options.viewport.padding || 0,
            a = this.getPosition(this.$viewport);
        if (/right|left/.test(t)) {
            var r = e.top - s - a.scroll,
                l = e.top + s - a.scroll + o;
            r < a.top ? n.top = a.top - r : l > a.top + a.height && (n.top = a.top + a.height - l)
        } else {
            var p = e.left - s,
                h = e.left + s + i;
            p < a.left ? n.left = a.left - p : h > a.right && (n.left = a.left + a.width - h)
        }
        return n
    }, i.prototype.getTitle = function() {
        var t, e = this.$element,
            i = this.options;
        return t = e.attr("data-original-title") || ("function" == typeof i.title ? i.title.call(e[0]) : i.title)
    }, i.prototype.getUID = function(t) {
        do t += ~~(1e6 * Math.random()); while (document.getElementById(t));
        return t
    }, i.prototype.tip = function() {
        if (!this.$tip && (this.$tip = t(this.options.template), 1 != this.$tip.length)) throw new Error(this.type + " `template` option must consist of exactly 1 top-level element!");
        return this.$tip
    }, i.prototype.arrow = function() {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    }, i.prototype.enable = function() {
        this.enabled = !0
    }, i.prototype.disable = function() {
        this.enabled = !1
    }, i.prototype.toggleEnabled = function() {
        this.enabled = !this.enabled
    }, i.prototype.toggle = function(e) {
        var i = this;
        e && (i = t(e.currentTarget).data("bs." + this.type), i || (i = new this.constructor(e.currentTarget, this.getDelegateOptions()), t(e.currentTarget).data("bs." + this.type, i))), e ? (i.inState.click = !i.inState.click, i.isInStateTrue() ? i.enter(i) : i.leave(i)) : i.tip().hasClass("in") ? i.leave(i) : i.enter(i)
    }, i.prototype.destroy = function() {
        var t = this;
        clearTimeout(this.timeout), this.hide(function() {
            t.$element.off("." + t.type).removeData("bs." + t.type), t.$tip && t.$tip.detach(), t.$tip = null, t.$arrow = null, t.$viewport = null, t.$element = null
        })
    };
    var o = t.fn.tooltip;
    t.fn.tooltip = e, t.fn.tooltip.Constructor = i, t.fn.tooltip.noConflict = function() {
        return t.fn.tooltip = o, this
    }
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        return this.each(function() {
            var o = t(this),
                n = o.data("bs.tab");
            n || o.data("bs.tab", n = new i(this)), "string" == typeof e && n[e]()
        })
    }
    var i = function(e) {
        this.element = t(e)
    };
    i.VERSION = "3.3.7", i.TRANSITION_DURATION = 150, i.prototype.show = function() {
        var e = this.element,
            i = e.closest("ul:not(.dropdown-menu)"),
            o = e.data("target");
        if (o || (o = e.attr("href"), o = o && o.replace(/.*(?=#[^\s]*$)/, "")), !e.parent("li").hasClass("active")) {
            var n = i.find(".active:last a"),
                s = t.Event("hide.bs.tab", {
                    relatedTarget: e[0]
                }),
                a = t.Event("show.bs.tab", {
                    relatedTarget: n[0]
                });
            if (n.trigger(s), e.trigger(a), !a.isDefaultPrevented() && !s.isDefaultPrevented()) {
                var r = t(o);
                this.activate(e.closest("li"), i), this.activate(r, r.parent(), function() {
                    n.trigger({
                        type: "hidden.bs.tab",
                        relatedTarget: e[0]
                    }), e.trigger({
                        type: "shown.bs.tab",
                        relatedTarget: n[0]
                    })
                })
            }
        }
    }, i.prototype.activate = function(e, o, n) {
        function s() {
            a.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), e.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), r ? (e[0].offsetWidth, e.addClass("in")) : e.removeClass("fade"), e.parent(".dropdown-menu").length && e.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), n && n()
        }
        var a = o.find("> .active"),
            r = n && t.support.transition && (a.length && a.hasClass("fade") || !!o.find("> .fade").length);
        a.length && r ? a.one("bsTransitionEnd", s).emulateTransitionEnd(i.TRANSITION_DURATION) : s(), a.removeClass("in")
    };
    var o = t.fn.tab;
    t.fn.tab = e, t.fn.tab.Constructor = i, t.fn.tab.noConflict = function() {
        return t.fn.tab = o, this
    };
    var n = function(i) {
        i.preventDefault(), e.call(t(this), "show")
    };
    t(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', n).on("click.bs.tab.data-api", '[data-toggle="pill"]', n)
}(jQuery), + function(t) {
    "use strict";

    function e(e) {
        var i, o = e.attr("data-target") || (i = e.attr("href")) && i.replace(/.*(?=#[^\s]+$)/, "");
        return t(o)
    }

    function i(e) {
        return this.each(function() {
            var i = t(this),
                n = i.data("bs.collapse"),
                s = t.extend({}, o.DEFAULTS, i.data(), "object" == typeof e && e);
            !n && s.toggle && /show|hide/.test(e) && (s.toggle = !1), n || i.data("bs.collapse", n = new o(this, s)), "string" == typeof e && n[e]()
        })
    }
    var o = function(e, i) {
        this.$element = t(e), this.options = t.extend({}, o.DEFAULTS, i), this.$trigger = t('[data-toggle="collapse"][href="#' + e.id + '"],[data-toggle="collapse"][data-target="#' + e.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
    };
    o.VERSION = "3.3.7", o.TRANSITION_DURATION = 350, o.DEFAULTS = {
        toggle: !0
    }, o.prototype.dimension = function() {
        var t = this.$element.hasClass("width");
        return t ? "width" : "height"
    }, o.prototype.show = function() {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var e, n = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
            if (!(n && n.length && (e = n.data("bs.collapse"), e && e.transitioning))) {
                var s = t.Event("show.bs.collapse");
                if (this.$element.trigger(s), !s.isDefaultPrevented()) {
                    n && n.length && (i.call(n, "hide"), e || n.data("bs.collapse", null));
                    var a = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[a](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                    var r = function() {
                        this.$element.removeClass("collapsing").addClass("collapse in")[a](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                    };
                    if (!t.support.transition) return r.call(this);
                    var l = t.camelCase(["scroll", a].join("-"));
                    this.$element.one("bsTransitionEnd", t.proxy(r, this)).emulateTransitionEnd(o.TRANSITION_DURATION)[a](this.$element[0][l])
                }
            }
        }
    }, o.prototype.hide = function() {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var e = t.Event("hide.bs.collapse");
            if (this.$element.trigger(e), !e.isDefaultPrevented()) {
                var i = this.dimension();
                this.$element[i](this.$element[i]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                var n = function() {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
                };
                return t.support.transition ? void this.$element[i](0).one("bsTransitionEnd", t.proxy(n, this)).emulateTransitionEnd(o.TRANSITION_DURATION) : n.call(this)
            }
        }
    }, o.prototype.toggle = function() {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, o.prototype.getParent = function() {
        return t(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(t.proxy(function(i, o) {
            var n = t(o);
            this.addAriaAndCollapsedClass(e(n), n)
        }, this)).end()
    }, o.prototype.addAriaAndCollapsedClass = function(t, e) {
        var i = t.hasClass("in");
        t.attr("aria-expanded", i), e.toggleClass("collapsed", !i).attr("aria-expanded", i)
    };
    var n = t.fn.collapse;
    t.fn.collapse = i, t.fn.collapse.Constructor = o, t.fn.collapse.noConflict = function() {
        return t.fn.collapse = n, this
    }, t(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function(o) {
        var n = t(this);
        n.attr("data-target") || o.preventDefault();
        var s = e(n),
            a = s.data("bs.collapse"),
            r = a ? "toggle" : n.data();
        i.call(s, r)
    })
}(jQuery), + function(t) {
    "use strict";

    function e() {
        var t = document.createElement("bootstrap"),
            e = {
                WebkitTransition: "webkitTransitionEnd",
                MozTransition: "transitionend",
                OTransition: "oTransitionEnd otransitionend",
                transition: "transitionend"
            };
        for (var i in e)
            if (void 0 !== t.style[i]) return {
                end: e[i]
            };
        return !1
    }
    t.fn.emulateTransitionEnd = function(e) {
        var i = !1,
            o = this;
        t(this).one("bsTransitionEnd", function() {
            i = !0
        });
        var n = function() {
            i || t(o).trigger(t.support.transition.end)
        };
        return setTimeout(n, e), this
    }, t(function() {
        t.support.transition = e(), t.support.transition && (t.event.special.bsTransitionEnd = {
            bindType: t.support.transition.end,
            delegateType: t.support.transition.end,
            handle: function(e) {
                return t(e.target).is(this) ? e.handleObj.handler.apply(this, arguments) : void 0
            }
        })
    })
}(jQuery);
/*easing */
jQuery.easing["jswing"] = jQuery.easing["swing"];
jQuery.extend(jQuery.easing, {
        def: "easeOutQuad",
        swing: function(e, t, n, r, i) {
            return jQuery.easing[jQuery.easing.def](e, t, n, r, i)
        },
        easeInQuad: function(e, t, n, r, i) {
            return r * (t /= i) * t + n
        },
        easeOutQuad: function(e, t, n, r, i) {
            return -r * (t /= i) * (t - 2) + n
        },
        easeInOutQuad: function(e, t, n, r, i) {
            if ((t /= i / 2) < 1) return r / 2 * t * t + n;
            return -r / 2 * (--t * (t - 2) - 1) + n
        },
        easeInCubic: function(e, t, n, r, i) {
            return r * (t /= i) * t * t + n
        },
        easeOutCubic: function(e, t, n, r, i) {
            return r * ((t = t / i - 1) * t * t + 1) + n
        },
        easeInOutCubic: function(e, t, n, r, i) {
            if ((t /= i / 2) < 1) return r / 2 * t * t * t + n;
            return r / 2 * ((t -= 2) * t * t + 2) + n
        },
        easeInQuart: function(e, t, n, r, i) {
            return r * (t /= i) * t * t * t + n
        },
        easeOutQuart: function(e, t, n, r, i) {
            return -r * ((t = t / i - 1) * t * t * t - 1) + n
        },
        easeInOutQuart: function(e, t, n, r, i) {
            if ((t /= i / 2) < 1) return r / 2 * t * t * t * t + n;
            return -r / 2 * ((t -= 2) * t * t * t - 2) + n
        },
        easeInQuint: function(e, t, n, r, i) {
            return r * (t /= i) * t * t * t * t + n
        },
        easeOutQuint: function(e, t, n, r, i) {
            return r * ((t = t / i - 1) * t * t * t * t + 1) + n
        },
        easeInOutQuint: function(e, t, n, r, i) {
            if ((t /= i / 2) < 1) return r / 2 * t * t * t * t * t + n;
            return r / 2 * ((t -= 2) * t * t * t * t + 2) + n
        },
        easeInSine: function(e, t, n, r, i) {
            return -r * Math.cos(t / i * (Math.PI / 2)) + r + n
        },
        easeOutSine: function(e, t, n, r, i) {
            return r * Math.sin(t / i * (Math.PI / 2)) + n
        },
        easeInOutSine: function(e, t, n, r, i) {
            return -r / 2 * (Math.cos(Math.PI * t / i) - 1) + n
        },
        easeInExpo: function(e, t, n, r, i) {
            return t == 0 ? n : r * Math.pow(2, 10 * (t / i - 1)) + n
        },
        easeOutExpo: function(e, t, n, r, i) {
            return t == i ? n + r : r * (-Math.pow(2, -10 * t / i) + 1) + n
        },
        easeInOutExpo: function(e, t, n, r, i) {
            if (t == 0) return n;
            if (t == i) return n + r;
            if ((t /= i / 2) < 1) return r / 2 * Math.pow(2, 10 * (t - 1)) + n;
            return r / 2 * (-Math.pow(2, -10 * --t) + 2) + n
        },
        easeInCirc: function(e, t, n, r, i) {
            return -r * (Math.sqrt(1 - (t /= i) * t) - 1) + n
        },
        easeOutCirc: function(e, t, n, r, i) {
            return r * Math.sqrt(1 - (t = t / i - 1) * t) + n
        },
        easeInOutCirc: function(e, t, n, r, i) {
            if ((t /= i / 2) < 1) return -r / 2 * (Math.sqrt(1 - t * t) - 1) + n;
            return r / 2 * (Math.sqrt(1 - (t -= 2) * t) + 1) + n
        },
        easeInElastic: function(e, t, n, r, i) {
            var s = 1.70158;
            var o = 0;
            var u = r;
            if (t == 0) return n;
            if ((t /= i) == 1) return n + r;
            if (!o) o = i * .3;
            if (u < Math.abs(r)) {
                u = r;
                var s = o / 4
            } else var s = o / (2 * Math.PI) * Math.asin(r / u);
            return -(u * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * i - s) * 2 * Math.PI / o)) + n
        },
        easeOutElastic: function(e, t, n, r, i) {
            var s = 1.70158;
            var o = 0;
            var u = r;
            if (t == 0) return n;
            if ((t /= i) == 1) return n + r;
            if (!o) o = i * .3;
            if (u < Math.abs(r)) {
                u = r;
                var s = o / 4
            } else var s = o / (2 * Math.PI) * Math.asin(r / u);
            return u * Math.pow(2, -10 * t) * Math.sin((t * i - s) * 2 * Math.PI / o) + r + n
        },
        easeInOutElastic: function(e, t, n, r, i) {
            var s = 1.70158;
            var o = 0;
            var u = r;
            if (t == 0) return n;
            if ((t /= i / 2) == 2) return n + r;
            if (!o) o = i * .3 * 1.5;
            if (u < Math.abs(r)) {
                u = r;
                var s = o / 4
            } else var s = o / (2 * Math.PI) * Math.asin(r / u);
            if (t < 1) return -.5 * u * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * i - s) * 2 * Math.PI / o) + n;
            return u * Math.pow(2, -10 * (t -= 1)) * Math.sin((t * i - s) * 2 * Math.PI / o) * .5 + r + n
        },
        easeInBack: function(e, t, n, r, i, s) {
            if (s == undefined) s = 1.70158;
            return r * (t /= i) * t * ((s + 1) * t - s) + n
        },
        easeOutBack: function(e, t, n, r, i, s) {
            if (s == undefined) s = 1.70158;
            return r * ((t = t / i - 1) * t * ((s + 1) * t + s) + 1) + n
        },
        easeInOutBack: function(e, t, n, r, i, s) {
            if (s == undefined) s = 1.70158;
            if ((t /= i / 2) < 1) return r / 2 * t * t * (((s *= 1.525) + 1) * t - s) + n;
            return r / 2 * ((t -= 2) * t * (((s *= 1.525) + 1) * t + s) + 2) + n
        },
        easeInBounce: function(e, t, n, r, i) {
            return r - jQuery.easing.easeOutBounce(e, i - t, 0, r, i) + n
        },
        easeOutBounce: function(e, t, n, r, i) {
            if ((t /= i) < 1 / 2.75) {
                return r * 7.5625 * t * t + n
            } else if (t < 2 / 2.75) {
                return r * (7.5625 * (t -= 1.5 / 2.75) * t + .75) + n
            } else if (t < 2.5 / 2.75) {
                return r * (7.5625 * (t -= 2.25 / 2.75) * t + .9375) + n
            } else {
                return r * (7.5625 * (t -= 2.625 / 2.75) * t + .984375) + n
            }
        },
        easeInOutBounce: function(e, t, n, r, i) {
            if (t < i / 2) return jQuery.easing.easeInBounce(e, t * 2, 0, r, i) * .5 + n;
            return jQuery.easing.easeOutBounce(e, t * 2 - i, 0, r, i) * .5 + r * .5 + n
        }
    })
/*!
 * justifiedGallery - v3.7.0
 * http://miromannino.github.io/Justified-Gallery/
 * Copyright (c) 2018 Miro Mannino
 * Licensed under the MIT license.
 */
!(function (factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['jquery'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // Node/CommonJS
    module.exports = function( root, jQuery ) {
      if ( jQuery === undefined ) {
        // require('jQuery') returns a factory that requires window to
        // build a jQuery instance, we normalize how we use modules
        // that require this pattern but the window provided is a noop
        // if it's defined (how jquery works)
        if ( typeof window !== 'undefined' ) {
          jQuery = require('jquery');
        }
        else {
          jQuery = require('jquery')(root);
        }
      }
      factory(jQuery);
      return jQuery;
    };
  } else {
    // Browser globals
    factory(jQuery);
  }
}(function ($) {

  /**
   * Justified Gallery controller constructor
   *
   * @param $gallery the gallery to build
   * @param settings the settings (the defaults are in JustifiedGallery.defaults)
   * @constructor
   */
  var JustifiedGallery = function ($gallery, settings) {
  
    this.settings = settings;
    this.checkSettings();
  
    this.imgAnalyzerTimeout = null;
    this.entries = null;
    this.buildingRow = {
      entriesBuff : [],
      width : 0,
      height : 0,
      aspectRatio : 0
    };
    this.lastFetchedEntry = null;
    this.lastAnalyzedIndex = -1;
    this.yield = {
      every : 2, // do a flush every n flushes (must be greater than 1)
      flushed : 0 // flushed rows without a yield
    };
    this.border = settings.border >= 0 ? settings.border : settings.margins;
    this.maxRowHeight = this.retrieveMaxRowHeight();
    this.suffixRanges = this.retrieveSuffixRanges();
    this.offY = this.border;
    this.rows = 0;
    this.spinner = {
      phase : 0,
      timeSlot : 150,
      $el : $('<div class="spinner"><span></span><span></span><span></span></div>'),
      intervalId : null
    };
    this.scrollBarOn = false;
    this.checkWidthIntervalId = null;
    this.galleryWidth = $gallery.width();
    this.$gallery = $gallery;
  
  };
  
  /** @returns {String} the best suffix given the width and the height */
  JustifiedGallery.prototype.getSuffix = function (width, height) {
    var longestSide, i;
    longestSide = (width > height) ? width : height;
    for (i = 0; i < this.suffixRanges.length; i++) {
      if (longestSide <= this.suffixRanges[i]) {
        return this.settings.sizeRangeSuffixes[this.suffixRanges[i]];
      }
    }
    return this.settings.sizeRangeSuffixes[this.suffixRanges[i - 1]];
  };
  
  /**
   * Remove the suffix from the string
   *
   * @returns {string} a new string without the suffix
   */
  JustifiedGallery.prototype.removeSuffix = function (str, suffix) {
    return str.substring(0, str.length - suffix.length);
  };
  
  /**
   * @returns {boolean} a boolean to say if the suffix is contained in the str or not
   */
  JustifiedGallery.prototype.endsWith = function (str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
  };
  
  /**
   * Get the used suffix of a particular url
   *
   * @param str
   * @returns {String} return the used suffix
   */
  JustifiedGallery.prototype.getUsedSuffix = function (str) {
    for (var si in this.settings.sizeRangeSuffixes) {
      if (this.settings.sizeRangeSuffixes.hasOwnProperty(si)) {
        if (this.settings.sizeRangeSuffixes[si].length === 0) continue;
        if (this.endsWith(str, this.settings.sizeRangeSuffixes[si])) return this.settings.sizeRangeSuffixes[si];
      }
    }
    return '';
  };
  
  /**
   * Given an image src, with the width and the height, returns the new image src with the
   * best suffix to show the best quality thumbnail.
   *
   * @returns {String} the suffix to use
   */
  JustifiedGallery.prototype.newSrc = function (imageSrc, imgWidth, imgHeight, image) {
    var newImageSrc;
  
    if (this.settings.thumbnailPath) {
      newImageSrc = this.settings.thumbnailPath(imageSrc, imgWidth, imgHeight, image);
    } else {
      var matchRes = imageSrc.match(this.settings.extension);
      var ext = (matchRes !== null) ? matchRes[0] : '';
      newImageSrc = imageSrc.replace(this.settings.extension, '');
      newImageSrc = this.removeSuffix(newImageSrc, this.getUsedSuffix(newImageSrc));
      newImageSrc += this.getSuffix(imgWidth, imgHeight) + ext;
    }
  
    return newImageSrc;
  };
  
  /**
   * Shows the images that is in the given entry
   *
   * @param $entry the entry
   * @param callback the callback that is called when the show animation is finished
   */
  JustifiedGallery.prototype.showImg = function ($entry, callback) {
    if (this.settings.cssAnimation) {
      $entry.addClass('entry-visible');
      if (callback) callback();
    } else {
      $entry.stop().fadeTo(this.settings.imagesAnimationDuration, 1.0, callback);
      $entry.find(this.settings.imgSelector).stop().fadeTo(this.settings.imagesAnimationDuration, 1.0, callback);
    }
  };
  
  /**
   * Extract the image src form the image, looking from the 'safe-src', and if it can't be found, from the
   * 'src' attribute. It saves in the image data the 'jg.originalSrc' field, with the extracted src.
   *
   * @param $image the image to analyze
   * @returns {String} the extracted src
   */
  JustifiedGallery.prototype.extractImgSrcFromImage = function ($image) {
    var imageSrc = (typeof $image.data('safe-src') !== 'undefined') ? $image.data('safe-src') : $image.attr('src');
    $image.data('jg.originalSrc', imageSrc);
    return imageSrc;
  };
  
  /** @returns {jQuery} the image in the given entry */
  JustifiedGallery.prototype.imgFromEntry = function ($entry) {
    var $img = $entry.find(this.settings.imgSelector);
    return $img.length === 0 ? null : $img;
  };
  
  /** @returns {jQuery} the caption in the given entry */
  JustifiedGallery.prototype.captionFromEntry = function ($entry) {
    var $caption = $entry.find('> .caption');
    return $caption.length === 0 ? null : $caption;
  };
  
  /**
   * Display the entry
   *
   * @param {jQuery} $entry the entry to display
   * @param {int} x the x position where the entry must be positioned
   * @param y the y position where the entry must be positioned
   * @param imgWidth the image width
   * @param imgHeight the image height
   * @param rowHeight the row height of the row that owns the entry
   */
  JustifiedGallery.prototype.displayEntry = function ($entry, x, y, imgWidth, imgHeight, rowHeight) {
    $entry.width(imgWidth);
    $entry.height(rowHeight);
    $entry.css('top', y);
    $entry.css('left', x);
  
    var $image = this.imgFromEntry($entry);
    if ($image !== null) {
      $image.css('width', imgWidth);
      $image.css('height', imgHeight);
      $image.css('margin-left', - imgWidth / 2);
      $image.css('margin-top', - imgHeight / 2);
  
      // Image reloading for an high quality of thumbnails
      var imageSrc = $image.attr('src');
      var newImageSrc = this.newSrc(imageSrc, imgWidth, imgHeight, $image[0]);
  
      $image.one('error', function () {
        $image.attr('src', $image.data('jg.originalSrc')); //revert to the original thumbnail, we got it.
      });
  
      var loadNewImage = function () {
        if (imageSrc !== newImageSrc) { //load the new image after the fadeIn
          $image.attr('src', newImageSrc);
        }
      };
  
      if ($entry.data('jg.loaded') === 'skipped') {
        this.onImageEvent(imageSrc, $.proxy(function() {
          this.showImg($entry, loadNewImage);
          $entry.data('jg.loaded', true);
        }, this));
      } else {
        this.showImg($entry, loadNewImage);
      }
  
    } else {
      this.showImg($entry);
    }
  
    this.displayEntryCaption($entry);
  };
  
  /**
   * Display the entry caption. If the caption element doesn't exists, it creates the caption using the 'alt'
   * or the 'title' attributes.
   *
   * @param {jQuery} $entry the entry to process
   */
  JustifiedGallery.prototype.displayEntryCaption = function ($entry) {
    var $image = this.imgFromEntry($entry);
    if ($image !== null && this.settings.captions) {
      var $imgCaption = this.captionFromEntry($entry);
  
      // Create it if it doesn't exists
      if ($imgCaption === null) {
        var caption = $image.attr('alt');
        if (!this.isValidCaption(caption)) caption = $entry.attr('title');
        if (this.isValidCaption(caption)) { // Create only we found something
          $imgCaption = $('<div class="caption">' + caption + '</div>');
          $entry.append($imgCaption);
          $entry.data('jg.createdCaption', true);
        }
      }
  
      // Create events (we check again the $imgCaption because it can be still inexistent)
      if ($imgCaption !== null) {
        if (!this.settings.cssAnimation) $imgCaption.stop().fadeTo(0, this.settings.captionSettings.nonVisibleOpacity);
        this.addCaptionEventsHandlers($entry);
      }
    } else {
      this.removeCaptionEventsHandlers($entry);
    }
  };
  
  /**
   * Validates the caption
   *
   * @param caption The caption that should be validated
   * @return {boolean} Validation result
   */
  JustifiedGallery.prototype.isValidCaption = function (caption) {
    return (typeof caption !== 'undefined' && caption.length > 0);
  };
  
  /**
   * The callback for the event 'mouseenter'. It assumes that the event currentTarget is an entry.
   * It shows the caption using jQuery (or using CSS if it is configured so)
   *
   * @param {Event} eventObject the event object
   */
  JustifiedGallery.prototype.onEntryMouseEnterForCaption = function (eventObject) {
    var $caption = this.captionFromEntry($(eventObject.currentTarget));
    if (this.settings.cssAnimation) {
      $caption.addClass('caption-visible').removeClass('caption-hidden');
    } else {
      $caption.stop().fadeTo(this.settings.captionSettings.animationDuration,
          this.settings.captionSettings.visibleOpacity);
    }
  };
  
  /**
   * The callback for the event 'mouseleave'. It assumes that the event currentTarget is an entry.
   * It hides the caption using jQuery (or using CSS if it is configured so)
   *
   * @param {Event} eventObject the event object
   */
  JustifiedGallery.prototype.onEntryMouseLeaveForCaption = function (eventObject) {
    var $caption = this.captionFromEntry($(eventObject.currentTarget));
    if (this.settings.cssAnimation) {
      $caption.removeClass('caption-visible').removeClass('caption-hidden');
    } else {
      $caption.stop().fadeTo(this.settings.captionSettings.animationDuration,
          this.settings.captionSettings.nonVisibleOpacity);
    }
  };
  
  /**
   * Add the handlers of the entry for the caption
   *
   * @param $entry the entry to modify
   */
  JustifiedGallery.prototype.addCaptionEventsHandlers = function ($entry) {
    var captionMouseEvents = $entry.data('jg.captionMouseEvents');
    if (typeof captionMouseEvents === 'undefined') {
      captionMouseEvents = {
        mouseenter: $.proxy(this.onEntryMouseEnterForCaption, this),
        mouseleave: $.proxy(this.onEntryMouseLeaveForCaption, this)
      };
      $entry.on('mouseenter', undefined, undefined, captionMouseEvents.mouseenter);
      $entry.on('mouseleave', undefined, undefined, captionMouseEvents.mouseleave);
      $entry.data('jg.captionMouseEvents', captionMouseEvents);
    }
  };
  
  /**
   * Remove the handlers of the entry for the caption
   *
   * @param $entry the entry to modify
   */
  JustifiedGallery.prototype.removeCaptionEventsHandlers = function ($entry) {
    var captionMouseEvents = $entry.data('jg.captionMouseEvents');
    if (typeof captionMouseEvents !== 'undefined') {
      $entry.off('mouseenter', undefined, captionMouseEvents.mouseenter);
      $entry.off('mouseleave', undefined, captionMouseEvents.mouseleave);
      $entry.removeData('jg.captionMouseEvents');
    }
  };
  
  /**
   * Clear the building row data to be used for a new row
   */
  JustifiedGallery.prototype.clearBuildingRow = function () {
    this.buildingRow.entriesBuff = [];
    this.buildingRow.aspectRatio = 0;
    this.buildingRow.width = 0;
  };
  
  /**
   * Justify the building row, preparing it to
   *
   * @param isLastRow
   * @returns a boolean to know if the row has been justified or not
   */
  JustifiedGallery.prototype.prepareBuildingRow = function (isLastRow) {
    var i, $entry, imgAspectRatio, newImgW, newImgH, justify = true;
    var minHeight = 0;
    var availableWidth = this.galleryWidth - 2 * this.border - (
        (this.buildingRow.entriesBuff.length - 1) * this.settings.margins);
    var rowHeight = availableWidth / this.buildingRow.aspectRatio;
    var defaultRowHeight = this.settings.rowHeight;
    var justifiable = this.buildingRow.width / availableWidth > this.settings.justifyThreshold;
  
    //Skip the last row if we can't justify it and the lastRow == 'hide'
    if (isLastRow && this.settings.lastRow === 'hide' && !justifiable) {
      for (i = 0; i < this.buildingRow.entriesBuff.length; i++) {
        $entry = this.buildingRow.entriesBuff[i];
        if (this.settings.cssAnimation)
          $entry.removeClass('entry-visible');
        else {
          $entry.stop().fadeTo(0, 0.1);
          $entry.find('> img, > a > img').fadeTo(0, 0);
        }
      }
      return -1;
    }

	
  
    // With lastRow = nojustify, justify if is justificable (the images will not become too big)
    if (isLastRow && !justifiable && this.settings.lastRow !== 'justify' && this.settings.lastRow !== 'hide') {
      justify = false;
  
      if (this.rows > 0) {
        defaultRowHeight = (this.offY - this.border - this.settings.margins * this.rows) / this.rows;
        justify = defaultRowHeight * this.buildingRow.aspectRatio / availableWidth > this.settings.justifyThreshold;
      }
    }
  
    for (i = 0; i < this.buildingRow.entriesBuff.length; i++) {
      $entry = this.buildingRow.entriesBuff[i];
      imgAspectRatio = $entry.data('jg.width') / $entry.data('jg.height');
  
      if (justify) {
        newImgW = (i === this.buildingRow.entriesBuff.length - 1) ? availableWidth : rowHeight * imgAspectRatio;
        newImgH = rowHeight;
      } else {
        newImgW = defaultRowHeight * imgAspectRatio;
        newImgH = defaultRowHeight;
      }
  
      availableWidth -= Math.round(newImgW);
      $entry.data('jg.jwidth', Math.round(newImgW));
      $entry.data('jg.jheight', Math.ceil(newImgH));
      if (i === 0 || minHeight > newImgH) minHeight = newImgH;
    }
  
    this.buildingRow.height = minHeight;
    return justify;
  };
  
  /**
   * Flush a row: justify it, modify the gallery height accordingly to the row height
   *
   * @param isLastRow
   */
  JustifiedGallery.prototype.flushRow = function (isLastRow) {
    var settings = this.settings;
    var $entry, buildingRowRes, offX = this.border, i;
  
    buildingRowRes = this.prepareBuildingRow(isLastRow);
    if (isLastRow && settings.lastRow === 'hide' && buildingRowRes === -1) {
      this.clearBuildingRow();
      return;
    }
  
    if(this.maxRowHeight) {
      if(this.maxRowHeight < this.buildingRow.height)  this.buildingRow.height = this.maxRowHeight;
    }
  
    //Align last (unjustified) row
    if (isLastRow && (settings.lastRow === 'center' || settings.lastRow === 'right')) {
      var availableWidth = this.galleryWidth - 2 * this.border - (this.buildingRow.entriesBuff.length - 1) * settings.margins;
  
      for (i = 0; i < this.buildingRow.entriesBuff.length; i++) {
        $entry = this.buildingRow.entriesBuff[i];
        availableWidth -= $entry.data('jg.jwidth');
      }
  
      if (settings.lastRow === 'center')
        offX += availableWidth / 2;
      else if (settings.lastRow === 'right')
        offX += availableWidth;
    }
  
    var lastEntryIdx = this.buildingRow.entriesBuff.length - 1;
    for (i = 0; i <= lastEntryIdx; i++) {
      $entry = this.buildingRow.entriesBuff[ this.settings.rtl ? lastEntryIdx - i : i ];
      this.displayEntry($entry, offX, this.offY, $entry.data('jg.jwidth'), $entry.data('jg.jheight'), this.buildingRow.height);
      offX += $entry.data('jg.jwidth') + settings.margins;
    }
  
    //Gallery Height
    this.galleryHeightToSet = this.offY + this.buildingRow.height + this.border;
    this.setGalleryTempHeight(this.galleryHeightToSet + this.getSpinnerHeight());
  
    if (!isLastRow || (this.buildingRow.height <= settings.rowHeight && buildingRowRes)) {
      //Ready for a new row
      this.offY += this.buildingRow.height + settings.margins;
      this.rows += 1;
      this.clearBuildingRow();
      this.settings.triggerEvent.call(this, 'jg.rowflush');
    }
  };
  
  
  // Scroll position not restoring: https://github.com/miromannino/Justified-Gallery/issues/221
  var galleryPrevStaticHeight = 0;
  
  JustifiedGallery.prototype.rememberGalleryHeight = function () {
    galleryPrevStaticHeight = this.$gallery.height();
    this.$gallery.height(galleryPrevStaticHeight);
  };
  
  // grow only
  JustifiedGallery.prototype.setGalleryTempHeight = function (height) {
    galleryPrevStaticHeight = Math.max(height, galleryPrevStaticHeight);
    this.$gallery.height(galleryPrevStaticHeight);
  };
  
  JustifiedGallery.prototype.setGalleryFinalHeight = function (height) {
    galleryPrevStaticHeight = height;
    this.$gallery.height(height);
  };
  
  /**
   * @returns {boolean} a boolean saying if the scrollbar is active or not
   */
  function hasScrollBar() {
    return $("body").height() > $(window).height();
  }
  
  /**
   * Checks the width of the gallery container, to know if a new justification is needed
   */
  JustifiedGallery.prototype.checkWidth = function () {
    this.checkWidthIntervalId = setInterval($.proxy(function () {
  
      // if the gallery is not currently visible, abort.
      if (!this.$gallery.is(":visible")) return;
  
      var galleryWidth = parseFloat(this.$gallery.width());
      if (hasScrollBar() === this.scrollBarOn) {
        if (Math.abs(galleryWidth - this.galleryWidth) > this.settings.refreshSensitivity) {
          this.galleryWidth = galleryWidth;
          this.rewind();
  
          this.rememberGalleryHeight();
  
          // Restart to analyze
          this.startImgAnalyzer(true);
        }
      } else {
        this.scrollBarOn = hasScrollBar();
        this.galleryWidth = galleryWidth;
      }
    }, this), this.settings.refreshTime);
  };
  
  /**
   * @returns {boolean} a boolean saying if the spinner is active or not
   */
  JustifiedGallery.prototype.isSpinnerActive = function () {
    return this.spinner.intervalId !== null;
  };
  
  /**
   * @returns {int} the spinner height
   */
  JustifiedGallery.prototype.getSpinnerHeight = function () {
    return this.spinner.$el.innerHeight();
  };
  
  /**
   * Stops the spinner animation and modify the gallery height to exclude the spinner
   */
  JustifiedGallery.prototype.stopLoadingSpinnerAnimation = function () {
    clearInterval(this.spinner.intervalId);
    this.spinner.intervalId = null;
    this.setGalleryTempHeight(this.$gallery.height() - this.getSpinnerHeight());
    this.spinner.$el.detach();
  };
  
  /**
   * Starts the spinner animation
   */
  JustifiedGallery.prototype.startLoadingSpinnerAnimation = function () {
    var spinnerContext = this.spinner;
    var $spinnerPoints = spinnerContext.$el.find('span');
    clearInterval(spinnerContext.intervalId);
    this.$gallery.append(spinnerContext.$el);
    this.setGalleryTempHeight(this.offY + this.buildingRow.height + this.getSpinnerHeight());
    spinnerContext.intervalId = setInterval(function () {
      if (spinnerContext.phase < $spinnerPoints.length) {
        $spinnerPoints.eq(spinnerContext.phase).fadeTo(spinnerContext.timeSlot, 1);
      } else {
        $spinnerPoints.eq(spinnerContext.phase - $spinnerPoints.length).fadeTo(spinnerContext.timeSlot, 0);
      }
      spinnerContext.phase = (spinnerContext.phase + 1) % ($spinnerPoints.length * 2);
    }, spinnerContext.timeSlot);
  };
  
  /**
   * Rewind the image analysis to start from the first entry.
   */
  JustifiedGallery.prototype.rewind = function () {
    this.lastFetchedEntry = null;
    this.lastAnalyzedIndex = -1;
    this.offY = this.border;
    this.rows = 0;
    this.clearBuildingRow();
  };
  
  /**
   * Update the entries searching it from the justified gallery HTML element
   *
   * @param norewind if norewind only the new entries will be changed (i.e. randomized, sorted or filtered)
   * @returns {boolean} true if some entries has been founded
   */
  JustifiedGallery.prototype.updateEntries = function (norewind) {
    var newEntries;
  
    if (norewind && this.lastFetchedEntry != null) {
      newEntries = $(this.lastFetchedEntry).nextAll(this.settings.selector).toArray();
    } else {
      this.entries = [];
      newEntries = this.$gallery.children(this.settings.selector).toArray();
    }
  
    if (newEntries.length > 0) {
  
      // Sort or randomize
      if ($.isFunction(this.settings.sort)) {
        newEntries = this.sortArray(newEntries);
      } else if (this.settings.randomize) {
        newEntries = this.shuffleArray(newEntries);
      }
      this.lastFetchedEntry = newEntries[newEntries.length - 1];
  
      // Filter
      if (this.settings.filter) {
        newEntries = this.filterArray(newEntries);
      } else {
        this.resetFilters(newEntries);
      }
  
    }
  
    this.entries = this.entries.concat(newEntries);
    return true;
  };
  
  /**
   * Apply the entries order to the DOM, iterating the entries and appending the images
   *
   * @param entries the entries that has been modified and that must be re-ordered in the DOM
   */
  JustifiedGallery.prototype.insertToGallery = function (entries) {
    var that = this;
    $.each(entries, function () {
      $(this).appendTo(that.$gallery);
    });
  };
  
  /**
   * Shuffle the array using the Fisher-Yates shuffle algorithm
   *
   * @param a the array to shuffle
   * @return the shuffled array
   */
  JustifiedGallery.prototype.shuffleArray = function (a) {
    var i, j, temp;
    for (i = a.length - 1; i > 0; i--) {
      j = Math.floor(Math.random() * (i + 1));
      temp = a[i];
      a[i] = a[j];
      a[j] = temp;
    }
    this.insertToGallery(a);
    return a;
  };
  
  /**
   * Sort the array using settings.comparator as comparator
   *
   * @param a the array to sort (it is sorted)
   * @return the sorted array
   */
  JustifiedGallery.prototype.sortArray = function (a) {
    a.sort(this.settings.sort);
    this.insertToGallery(a);
    return a;
  };
  
  /**
   * Reset the filters removing the 'jg-filtered' class from all the entries
   *
   * @param a the array to reset
   */
  JustifiedGallery.prototype.resetFilters = function (a) {
    for (var i = 0; i < a.length; i++) $(a[i]).removeClass('jg-filtered');
  };
  
  /**
   * Filter the entries considering theirs classes (if a string has been passed) or using a function for filtering.
   *
   * @param a the array to filter
   * @return the filtered array
   */
  JustifiedGallery.prototype.filterArray = function (a) {
    var settings = this.settings;
    if ($.type(settings.filter) === 'string') {
      // Filter only keeping the entries passed in the string
      return a.filter(function (el) {
        var $el = $(el);
        if ($el.is(settings.filter)) {
          $el.removeClass('jg-filtered');
          return true;
        } else {
          $el.addClass('jg-filtered').removeClass('jg-visible');
          return false;
        }
      });
    } else if ($.isFunction(settings.filter)) {
      // Filter using the passed function
      var filteredArr = a.filter(settings.filter);
      for (var i = 0; i < a.length; i++) {
        if (filteredArr.indexOf(a[i]) === -1) {
          $(a[i]).addClass('jg-filtered').removeClass('jg-visible');
        } else {
          $(a[i]).removeClass('jg-filtered');
        }
      }
      return filteredArr;
    }
  };
  
  /**
   * Destroy the Justified Gallery instance.
   *
   * It clears all the css properties added in the style attributes. We doesn't backup the original
   * values for those css attributes, because it costs (performance) and because in general one
   * shouldn't use the style attribute for an uniform set of images (where we suppose the use of
   * classes). Creating a backup is also difficult because JG could be called multiple times and
   * with different style attributes.
   */
  JustifiedGallery.prototype.destroy = function () {
    clearInterval(this.checkWidthIntervalId);
  
    $.each(this.entries, $.proxy(function(_, entry) {
      var $entry = $(entry);
  
      // Reset entry style
      $entry.css('width', '');
      $entry.css('height', '');
      $entry.css('top', '');
      $entry.css('left', '');
      $entry.data('jg.loaded', undefined);
      $entry.removeClass('jg-entry');
  
      // Reset image style
      var $img = this.imgFromEntry($entry);
      $img.css('width', '');
      $img.css('height', '');
      $img.css('margin-left', '');
      $img.css('margin-top', '');
      $img.attr('src', $img.data('jg.originalSrc'));
      $img.data('jg.originalSrc', undefined);
  
      // Remove caption
      this.removeCaptionEventsHandlers($entry);
      var $caption = this.captionFromEntry($entry);
      if ($entry.data('jg.createdCaption')) {
        // remove also the caption element (if created by jg)
        $entry.data('jg.createdCaption', undefined);
        if ($caption !== null) $caption.remove();
      } else {
        if ($caption !== null) $caption.fadeTo(0, 1);
      }
  
    }, this));
  
    this.$gallery.css('height', '');
    this.$gallery.removeClass('justified-gallery');
    this.$gallery.data('jg.controller', undefined);
  };
  
  /**
   * Analyze the images and builds the rows. It returns if it found an image that is not loaded.
   *
   * @param isForResize if the image analyzer is called for resizing or not, to call a different callback at the end
   */
  JustifiedGallery.prototype.analyzeImages = function (isForResize) {
    for (var i = this.lastAnalyzedIndex + 1; i < this.entries.length; i++) {
      var $entry = $(this.entries[i]);
      if ($entry.data('jg.loaded') === true || $entry.data('jg.loaded') === 'skipped') {
        var availableWidth = this.galleryWidth - 2 * this.border - (
            (this.buildingRow.entriesBuff.length - 1) * this.settings.margins);
        var imgAspectRatio = $entry.data('jg.width') / $entry.data('jg.height');
        if (availableWidth / (this.buildingRow.aspectRatio + imgAspectRatio) < this.settings.rowHeight) {
          this.flushRow(false);
  
          if(++this.yield.flushed >= this.yield.every) {
            this.startImgAnalyzer(isForResize);
            return;
          }
        }
  
        this.buildingRow.entriesBuff.push($entry);
        this.buildingRow.aspectRatio += imgAspectRatio;
        this.buildingRow.width += imgAspectRatio * this.settings.rowHeight;
        this.lastAnalyzedIndex = i;
  
      } else if ($entry.data('jg.loaded') !== 'error') {
        return;
      }
    }
  
    // Last row flush (the row is not full)
    if (this.buildingRow.entriesBuff.length > 0) this.flushRow(true);
  
    if (this.isSpinnerActive()) {
      this.stopLoadingSpinnerAnimation();
    }
  
    /* Stop, if there is, the timeout to start the analyzeImages.
     This is because an image can be set loaded, and the timeout can be set,
     but this image can be analyzed yet.
     */
    this.stopImgAnalyzerStarter();
  
    //On complete callback
    this.settings.triggerEvent.call(this, isForResize ? 'jg.resize' : 'jg.complete');
    this.setGalleryFinalHeight(this.galleryHeightToSet);
  };
  
  /**
   * Stops any ImgAnalyzer starter (that has an assigned timeout)
   */
  JustifiedGallery.prototype.stopImgAnalyzerStarter = function () {
    this.yield.flushed = 0;
    if (this.imgAnalyzerTimeout !== null) {
      clearTimeout(this.imgAnalyzerTimeout);
      this.imgAnalyzerTimeout = null;
    }
  };
  
  /**
   * Starts the image analyzer. It is not immediately called to let the browser to update the view
   *
   * @param isForResize specifies if the image analyzer must be called for resizing or not
   */
  JustifiedGallery.prototype.startImgAnalyzer = function (isForResize) {
    var that = this;
    this.stopImgAnalyzerStarter();
    this.imgAnalyzerTimeout = setTimeout(function () {
      that.analyzeImages(isForResize);
    }, 0.001); // we can't start it immediately due to a IE different behaviour
  };
  
  /**
   * Checks if the image is loaded or not using another image object. We cannot use the 'complete' image property,
   * because some browsers, with a 404 set complete = true.
   *
   * @param imageSrc the image src to load
   * @param onLoad callback that is called when the image has been loaded
   * @param onError callback that is called in case of an error
   */
  JustifiedGallery.prototype.onImageEvent = function (imageSrc, onLoad, onError) {
    if (!onLoad && !onError) return;
  
    var memImage = new Image();
    var $memImage = $(memImage);
    if (onLoad) {
      $memImage.one('load', function () {
        $memImage.off('load error');
        onLoad(memImage);
      });
    }
    if (onError) {
      $memImage.one('error', function() {
        $memImage.off('load error');
        onError(memImage);
      });
    }
    memImage.src = imageSrc;
  };
  
  /**
   * Init of Justified Gallery controlled
   * It analyzes all the entries starting theirs loading and calling the image analyzer (that works with loaded images)
   */
  JustifiedGallery.prototype.init = function () {
    var imagesToLoad = false, skippedImages = false, that = this;
    $.each(this.entries, function (index, entry) {
      var $entry = $(entry);
      var $image = that.imgFromEntry($entry);
  
      $entry.addClass('jg-entry');
  
      if ($entry.data('jg.loaded') !== true && $entry.data('jg.loaded') !== 'skipped') {
  
        // Link Rel global overwrite
        if (that.settings.rel !== null) $entry.attr('rel', that.settings.rel);
  
        // Link Target global overwrite
        if (that.settings.target !== null) $entry.attr('target', that.settings.target);
  
        if ($image !== null) {
  
          // Image src
          var imageSrc = that.extractImgSrcFromImage($image);
          $image.attr('src', imageSrc);
  
          /* If we have the height and the width, we don't wait that the image is loaded, but we start directly
           * with the justification */
          if (that.settings.waitThumbnailsLoad === false) {
            var width = parseFloat($image.prop('width'));
            var height = parseFloat($image.prop('height'));
            if (!isNaN(width) && !isNaN(height)) {
              $entry.data('jg.width', width);
              $entry.data('jg.height', height);
              $entry.data('jg.loaded', 'skipped');
              skippedImages = true;
              that.startImgAnalyzer(false);
              return true; // continue
            }
          }
  
          $entry.data('jg.loaded', false);
          imagesToLoad = true;
  
          // Spinner start
          if (!that.isSpinnerActive()) that.startLoadingSpinnerAnimation();
  
          that.onImageEvent(imageSrc, function (loadImg) { // image loaded
            $entry.data('jg.width', loadImg.width);
            $entry.data('jg.height', loadImg.height);
            $entry.data('jg.loaded', true);
            that.startImgAnalyzer(false);
          }, function () { // image load error
            $entry.data('jg.loaded', 'error');
            that.startImgAnalyzer(false);
          });
  
        } else {
          $entry.data('jg.loaded', true);
          $entry.data('jg.width', $entry.width() | parseFloat($entry.css('width')) | 1);
          $entry.data('jg.height', $entry.height() | parseFloat($entry.css('height')) | 1);
        }
  
      }
  
    });
  
    if (!imagesToLoad && !skippedImages) this.startImgAnalyzer(false);
    this.checkWidth();
  };
  
  /**
   * Checks that it is a valid number. If a string is passed it is converted to a number
   *
   * @param settingContainer the object that contains the setting (to allow the conversion)
   * @param settingName the setting name
   */
  JustifiedGallery.prototype.checkOrConvertNumber = function (settingContainer, settingName) {
    if ($.type(settingContainer[settingName]) === 'string') {
      settingContainer[settingName] = parseFloat(settingContainer[settingName]);
    }
  
    if ($.type(settingContainer[settingName]) === 'number') {
      if (isNaN(settingContainer[settingName])) throw 'invalid number for ' + settingName;
    } else {
      throw settingName + ' must be a number';
    }
  };
  
  /**
   * Checks the sizeRangeSuffixes and, if necessary, converts
   * its keys from string (e.g. old settings with 'lt100') to int.
   */
  JustifiedGallery.prototype.checkSizeRangesSuffixes = function () {
    if ($.type(this.settings.sizeRangeSuffixes) !== 'object') {
      throw 'sizeRangeSuffixes must be defined and must be an object';
    }
  
    var suffixRanges = [];
    for (var rangeIdx in this.settings.sizeRangeSuffixes) {
      if (this.settings.sizeRangeSuffixes.hasOwnProperty(rangeIdx)) suffixRanges.push(rangeIdx);
    }
  
    var newSizeRngSuffixes = {0: ''};
    for (var i = 0; i < suffixRanges.length; i++) {
      if ($.type(suffixRanges[i]) === 'string') {
        try {
          var numIdx = parseInt(suffixRanges[i].replace(/^[a-z]+/, ''), 10);
          newSizeRngSuffixes[numIdx] = this.settings.sizeRangeSuffixes[suffixRanges[i]];
        } catch (e) {
          throw 'sizeRangeSuffixes keys must contains correct numbers (' + e + ')';
        }
      } else {
        newSizeRngSuffixes[suffixRanges[i]] = this.settings.sizeRangeSuffixes[suffixRanges[i]];
      }
    }
  
    this.settings.sizeRangeSuffixes = newSizeRngSuffixes;
  };
  
  /**
   * check and convert the maxRowHeight setting
   * requires rowHeight to be already set
   * TODO: should be always called when only rowHeight is changed
   * @return number or null
   */
  JustifiedGallery.prototype.retrieveMaxRowHeight = function () {
    var newMaxRowHeight = null;
    var rowHeight = this.settings.rowHeight;
  
    if ($.type(this.settings.maxRowHeight) === 'string') {
      if (this.settings.maxRowHeight.match(/^[0-9]+%$/)) {
        newMaxRowHeight = rowHeight * parseFloat(this.settings.maxRowHeight.match(/^([0-9]+)%$/)[1]) / 100;
      } else {
        newMaxRowHeight = parseFloat(this.settings.maxRowHeight);
      }
    } else if ($.type(this.settings.maxRowHeight) === 'number') {
      newMaxRowHeight = this.settings.maxRowHeight;
    } else if (this.settings.maxRowHeight === false || this.settings.maxRowHeight == null) {
      return null;
    } else {
      throw 'maxRowHeight must be a number or a percentage';
    }
  
    // check if the converted value is not a number
    if (isNaN(newMaxRowHeight)) throw 'invalid number for maxRowHeight';
  
    // check values, maxRowHeight must be >= rowHeight
    if (newMaxRowHeight < rowHeight) newMaxRowHeight = rowHeight;
  
    return newMaxRowHeight;
  };
  
  /**
   * Checks the settings
   */
  JustifiedGallery.prototype.checkSettings = function () {
    this.checkSizeRangesSuffixes();
  
    this.checkOrConvertNumber(this.settings, 'rowHeight');
    this.checkOrConvertNumber(this.settings, 'margins');
    this.checkOrConvertNumber(this.settings, 'border');
  
    var lastRowModes = [
      'justify',
      'nojustify',
      'left',
      'center',
      'right',
      'hide'
    ];
    if (lastRowModes.indexOf(this.settings.lastRow) === -1) {
      throw 'lastRow must be one of: ' + lastRowModes.join(', ');
    }
  
    this.checkOrConvertNumber(this.settings, 'justifyThreshold');
    if (this.settings.justifyThreshold < 0 || this.settings.justifyThreshold > 1) {
      throw 'justifyThreshold must be in the interval [0,1]';
    }
    if ($.type(this.settings.cssAnimation) !== 'boolean') {
      throw 'cssAnimation must be a boolean';
    }
  
    if ($.type(this.settings.captions) !== 'boolean') throw 'captions must be a boolean';
    this.checkOrConvertNumber(this.settings.captionSettings, 'animationDuration');
  
    this.checkOrConvertNumber(this.settings.captionSettings, 'visibleOpacity');
    if (this.settings.captionSettings.visibleOpacity < 0 ||
        this.settings.captionSettings.visibleOpacity > 1) {
      throw 'captionSettings.visibleOpacity must be in the interval [0, 1]';
    }
  
    this.checkOrConvertNumber(this.settings.captionSettings, 'nonVisibleOpacity');
    if (this.settings.captionSettings.nonVisibleOpacity < 0 ||
        this.settings.captionSettings.nonVisibleOpacity > 1) {
      throw 'captionSettings.nonVisibleOpacity must be in the interval [0, 1]';
    }
  
    this.checkOrConvertNumber(this.settings, 'imagesAnimationDuration');
    this.checkOrConvertNumber(this.settings, 'refreshTime');
    this.checkOrConvertNumber(this.settings, 'refreshSensitivity');
    if ($.type(this.settings.randomize) !== 'boolean') throw 'randomize must be a boolean';
    if ($.type(this.settings.selector) !== 'string') throw 'selector must be a string';
  
    if (this.settings.sort !== false && !$.isFunction(this.settings.sort)) {
      throw 'sort must be false or a comparison function';
    }
  
    if (this.settings.filter !== false && !$.isFunction(this.settings.filter) &&
        $.type(this.settings.filter) !== 'string') {
      throw 'filter must be false, a string or a filter function';
    }
  };
  
  /**
   * It brings all the indexes from the sizeRangeSuffixes and it orders them. They are then sorted and returned.
   * @returns {Array} sorted suffix ranges
   */
  JustifiedGallery.prototype.retrieveSuffixRanges = function () {
    var suffixRanges = [];
    for (var rangeIdx in this.settings.sizeRangeSuffixes) {
      if (this.settings.sizeRangeSuffixes.hasOwnProperty(rangeIdx)) suffixRanges.push(parseInt(rangeIdx, 10));
    }
    suffixRanges.sort(function (a, b) { return a > b ? 1 : a < b ? -1 : 0; });
    return suffixRanges;
  };
  
  /**
   * Update the existing settings only changing some of them
   *
   * @param newSettings the new settings (or a subgroup of them)
   */
  JustifiedGallery.prototype.updateSettings = function (newSettings) {
    // In this case Justified Gallery has been called again changing only some options
    this.settings = $.extend({}, this.settings, newSettings);
    this.checkSettings();
  
    // As reported in the settings: negative value = same as margins, 0 = disabled
    this.border = this.settings.border >= 0 ? this.settings.border : this.settings.margins;
  
    this.maxRowHeight = this.retrieveMaxRowHeight();
    this.suffixRanges = this.retrieveSuffixRanges();
  };
  
  JustifiedGallery.prototype.defaults = {
    sizeRangeSuffixes: { }, /* e.g. Flickr configuration
        {
          100: '_t',  // used when longest is less than 100px
          240: '_m',  // used when longest is between 101px and 240px
          320: '_n',  // ...
          500: '',
          640: '_z',
          1024: '_b'  // used as else case because it is the last
        }
    */
    thumbnailPath: undefined, /* If defined, sizeRangeSuffixes is not used, and this function is used to determine the
    path relative to a specific thumbnail size. The function should accept respectively three arguments:
    current path, width and height */
    rowHeight: 120, // required? required to be > 0?
    maxRowHeight: false, // false or negative value to deactivate. Positive number to express the value in pixels,
                         // A string '[0-9]+%' to express in percentage (e.g. 300% means that the row height
                         // can't exceed 3 * rowHeight)
    margins: 1,
    border: -1, // negative value = same as margins, 0 = disabled, any other value to set the border
  
    lastRow: 'nojustify', // … which is the same as 'left', or can be 'justify', 'center', 'right' or 'hide'
  
    justifyThreshold: 0.90, /* if row width / available space > 0.90 it will be always justified
                             * (i.e. lastRow setting is not considered) */
    waitThumbnailsLoad: true,
    captions: true,
    cssAnimation: true,
    imagesAnimationDuration: 500, // ignored with css animations
    captionSettings: { // ignored with css animations
      animationDuration: 500,
      visibleOpacity: 0.7,
      nonVisibleOpacity: 0.0
    },
    rel: null, // rewrite the rel of each analyzed links
    target: null, // rewrite the target of all links
    extension: /\.[^.\\/]+$/, // regexp to capture the extension of an image
    refreshTime: 200, // time interval (in ms) to check if the page changes its width
    refreshSensitivity: 0, // change in width allowed (in px) without re-building the gallery
    randomize: false,
    rtl: false, // right-to-left mode
    sort: false, /*
      - false: to do not sort
      - function: to sort them using the function as comparator (see Array.prototype.sort())
    */
    filter: false, /*
      - false, null or undefined: for a disabled filter
      - a string: an entry is kept if entry.is(filter string) returns true
                  see jQuery's .is() function for further information
      - a function: invoked with arguments (entry, index, array). Return true to keep the entry, false otherwise.
                    It follows the specifications of the Array.prototype.filter() function of JavaScript.
    */
    selector: 'a, div:not(.spinner)', // The selector that is used to know what are the entries of the gallery
    imgSelector: '> img, > a > img', // The selector that is used to know what are the images of each entry
    triggerEvent: function (event) { // This is called to trigger events, the default behavior is to call $.trigger
      this.$gallery.trigger(event);  // Consider that 'this' is this set to the JustifiedGallery object, so it can
    }                                // access to fields such as $gallery, useful to trigger events with jQuery.
  };

  /**
   * Justified Gallery plugin for jQuery
   *
   * Events
   *  - jg.complete : called when all the gallery has been created
   *  - jg.resize : called when the gallery has been resized
   *  - jg.rowflush : when a new row appears
   *
   * @param arg the action (or the settings) passed when the plugin is called
   * @returns {*} the object itself
   */
  $.fn.justifiedGallery = function (arg) {
    return this.each(function (index, gallery) {

      var $gallery = $(gallery);
      $gallery.addClass('justified-gallery');

      var controller = $gallery.data('jg.controller');
      if (typeof controller === 'undefined') {
        // Create controller and assign it to the object data
        if (typeof arg !== 'undefined' && arg !== null && $.type(arg) !== 'object') {
          if (arg === 'destroy') return; // Just a call to an unexisting object
          throw 'The argument must be an object';
        }
        controller = new JustifiedGallery($gallery, $.extend({}, JustifiedGallery.prototype.defaults, arg));
        $gallery.data('jg.controller', controller);
      } else if (arg === 'norewind') {
        // In this case we don't rewind: we analyze only the latest images (e.g. to complete the last unfinished row
        // ... left to be more readable
      } else if (arg === 'destroy') {
        controller.destroy();
        return;
      } else {
        // In this case Justified Gallery has been called again changing only some options
        controller.updateSettings(arg);
        controller.rewind();
      }

      // Update the entries list
      if (!controller.updateEntries(arg === 'norewind')) return;

      // Init justified gallery
      controller.init();

    });
  };

}));
	
/*! Magnific Popup - v1.1.0 - 2016-02-20
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2016 Dmitry Semenov; */
;(function (factory) { 
if (typeof define === 'function' && define.amd) { 
 // AMD. Register as an anonymous module. 
 define(['jquery'], factory); 
 } else if (typeof exports === 'object') { 
 // Node/CommonJS 
 factory(require('jquery')); 
 } else { 
 // Browser globals 
 factory(window.jQuery || window.Zepto); 
 } 
 }(function($) { 

/*>>core*/
/**
 * 
 * Magnific Popup Core JS file
 * 
 */


/**
 * Private static constants
 */
var CLOSE_EVENT = 'Close',
	BEFORE_CLOSE_EVENT = 'BeforeClose',
	AFTER_CLOSE_EVENT = 'AfterClose',
	BEFORE_APPEND_EVENT = 'BeforeAppend',
	MARKUP_PARSE_EVENT = 'MarkupParse',
	OPEN_EVENT = 'Open',
	CHANGE_EVENT = 'Change',
	NS = 'mfp',
	EVENT_NS = '.' + NS,
	READY_CLASS = 'mfp-ready',
	REMOVING_CLASS = 'mfp-removing',
	PREVENT_CLOSE_CLASS = 'mfp-prevent-close';


/**
 * Private vars 
 */
/*jshint -W079 */
var mfp, // As we have only one instance of MagnificPopup object, we define it locally to not to use 'this'
	MagnificPopup = function(){},
	_isJQ = !!(window.jQuery),
	_prevStatus,
	_window = $(window),
	_document,
	_prevContentType,
	_wrapClasses,
	_currPopupType;


/**
 * Private functions
 */
var _mfpOn = function(name, f) {
		mfp.ev.on(NS + name + EVENT_NS, f);
	},
	_getEl = function(className, appendTo, html, raw) {
		var el = document.createElement('div');
		el.className = 'mfp-'+className;
		if(html) {
			el.innerHTML = html;
		}
		if(!raw) {
			el = $(el);
			if(appendTo) {
				el.appendTo(appendTo);
			}
		} else if(appendTo) {
			appendTo.appendChild(el);
		}
		return el;
	},
	_mfpTrigger = function(e, data) {
		mfp.ev.triggerHandler(NS + e, data);

		if(mfp.st.callbacks) {
			// converts "mfpEventName" to "eventName" callback and triggers it if it's present
			e = e.charAt(0).toLowerCase() + e.slice(1);
			if(mfp.st.callbacks[e]) {
				mfp.st.callbacks[e].apply(mfp, $.isArray(data) ? data : [data]);
			}
		}
	},
	_getCloseBtn = function(type) {
		if(type !== _currPopupType || !mfp.currTemplate.closeBtn) {
			mfp.currTemplate.closeBtn = $( mfp.st.closeMarkup.replace('%title%', mfp.st.tClose ) );
			_currPopupType = type;
		}
		return mfp.currTemplate.closeBtn;
	},
	// Initialize Magnific Popup only when called at least once
	_checkInstance = function() {
		if(!$.magnificPopup.instance) {
			/*jshint -W020 */
			mfp = new MagnificPopup();
			mfp.init();
			$.magnificPopup.instance = mfp;
		}
	},
	// CSS transition detection, http://stackoverflow.com/questions/7264899/detect-css-transitions-using-javascript-and-without-modernizr
	supportsTransitions = function() {
		var s = document.createElement('p').style, // 's' for style. better to create an element if body yet to exist
			v = ['ms','O','Moz','Webkit']; // 'v' for vendor

		if( s['transition'] !== undefined ) {
			return true; 
		}
			
		while( v.length ) {
			if( v.pop() + 'Transition' in s ) {
				return true;
			}
		}
				
		return false;
	};



/**
 * Public functions
 */
MagnificPopup.prototype = {

	constructor: MagnificPopup,

	/**
	 * Initializes Magnific Popup plugin. 
	 * This function is triggered only once when $.fn.magnificPopup or $.magnificPopup is executed
	 */
	init: function() {
		var appVersion = navigator.appVersion;
		mfp.isLowIE = mfp.isIE8 = document.all && !document.addEventListener;
		mfp.isAndroid = (/android/gi).test(appVersion);
		mfp.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
		mfp.supportsTransition = supportsTransitions();

		// We disable fixed positioned lightbox on devices that don't handle it nicely.
		// If you know a better way of detecting this - let me know.
		mfp.probablyMobile = (mfp.isAndroid || mfp.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent) );
		_document = $(document);

		mfp.popupsCache = {};
	},

	/**
	 * Opens popup
	 * @param  data [description]
	 */
	open: function(data) {

		var i;

		if(data.isObj === false) { 
			// convert jQuery collection to array to avoid conflicts later
			mfp.items = data.items.toArray();

			mfp.index = 0;
			var items = data.items,
				item;
			for(i = 0; i < items.length; i++) {
				item = items[i];
				if(item.parsed) {
					item = item.el[0];
				}
				if(item === data.el[0]) {
					mfp.index = i;
					break;
				}
			}
		} else {
			mfp.items = $.isArray(data.items) ? data.items : [data.items];
			mfp.index = data.index || 0;
		}

		// if popup is already opened - we just update the content
		if(mfp.isOpen) {
			mfp.updateItemHTML();
			return;
		}
		
		mfp.types = []; 
		_wrapClasses = '';
		if(data.mainEl && data.mainEl.length) {
			mfp.ev = data.mainEl.eq(0);
		} else {
			mfp.ev = _document;
		}

		if(data.key) {
			if(!mfp.popupsCache[data.key]) {
				mfp.popupsCache[data.key] = {};
			}
			mfp.currTemplate = mfp.popupsCache[data.key];
		} else {
			mfp.currTemplate = {};
		}



		mfp.st = $.extend(true, {}, $.magnificPopup.defaults, data ); 
		mfp.fixedContentPos = mfp.st.fixedContentPos === 'auto' ? !mfp.probablyMobile : mfp.st.fixedContentPos;

		if(mfp.st.modal) {
			mfp.st.closeOnContentClick = false;
			mfp.st.closeOnBgClick = false;
			mfp.st.showCloseBtn = false;
			mfp.st.enableEscapeKey = false;
		}
		

		// Building markup
		// main containers are created only once
		if(!mfp.bgOverlay) {

			// Dark overlay
			mfp.bgOverlay = _getEl('bg').on('click'+EVENT_NS, function() {
				mfp.close();
			});

			mfp.wrap = _getEl('wrap').attr('tabindex', -1).on('click'+EVENT_NS, function(e) {
				if(mfp._checkIfClose(e.target)) {
					mfp.close();
				}
			});

			mfp.container = _getEl('container', mfp.wrap);
		}

		mfp.contentContainer = _getEl('content');
		if(mfp.st.preloader) {
			mfp.preloader = _getEl('preloader', mfp.container, mfp.st.tLoading);
		}


		// Initializing modules
		var modules = $.magnificPopup.modules;
		for(i = 0; i < modules.length; i++) {
			var n = modules[i];
			n = n.charAt(0).toUpperCase() + n.slice(1);
			mfp['init'+n].call(mfp);
		}
		_mfpTrigger('BeforeOpen');


		if(mfp.st.showCloseBtn) {
			// Close button
			if(!mfp.st.closeBtnInside) {
				mfp.wrap.append( _getCloseBtn() );
			} else {
				_mfpOn(MARKUP_PARSE_EVENT, function(e, template, values, item) {
					values.close_replaceWith = _getCloseBtn(item.type);
				});
				_wrapClasses += ' mfp-close-btn-in';
			}
		}

		if(mfp.st.alignTop) {
			_wrapClasses += ' mfp-align-top';
		}

	

		if(mfp.fixedContentPos) {
			mfp.wrap.css({
				overflow: mfp.st.overflowY,
				overflowX: 'hidden',
				overflowY: mfp.st.overflowY
			});
		} else {
			mfp.wrap.css({ 
				top: _window.scrollTop(),
				position: 'absolute'
			});
		}
		if( mfp.st.fixedBgPos === false || (mfp.st.fixedBgPos === 'auto' && !mfp.fixedContentPos) ) {
			mfp.bgOverlay.css({
				height: _document.height(),
				position: 'absolute'
			});
		}

		

		if(mfp.st.enableEscapeKey) {
			// Close on ESC key
			_document.on('keyup' + EVENT_NS, function(e) {
				if(e.keyCode === 27) {
					mfp.close();
				}
			});
		}

		_window.on('resize' + EVENT_NS, function() {
			mfp.updateSize();
		});


		if(!mfp.st.closeOnContentClick) {
			_wrapClasses += ' mfp-auto-cursor';
		}
		
		if(_wrapClasses)
			mfp.wrap.addClass(_wrapClasses);


		// this triggers recalculation of layout, so we get it once to not to trigger twice
		var windowHeight = mfp.wH = _window.height();

		
		var windowStyles = {};

		if( mfp.fixedContentPos ) {
            if(mfp._hasScrollBar(windowHeight)){
                var s = mfp._getScrollbarSize();
                if(s) {
                    windowStyles.marginRight = s;
                }
            }
        }

		if(mfp.fixedContentPos) {
			if(!mfp.isIE7) {
				windowStyles.overflow = 'hidden';
			} else {
				// ie7 double-scroll bug
				$('body, html').css('overflow', 'hidden');
			}
		}

		
		
		var classesToadd = mfp.st.mainClass;
		if(mfp.isIE7) {
			classesToadd += ' mfp-ie7';
		}
		if(classesToadd) {
			mfp._addClassToMFP( classesToadd );
		}

		// add content
		mfp.updateItemHTML();

		_mfpTrigger('BuildControls');

		// remove scrollbar, add margin e.t.c
		$('html').css(windowStyles);
		
		// add everything to DOM
		mfp.bgOverlay.add(mfp.wrap).prependTo( mfp.st.prependTo || $(document.body) );

		// Save last focused element
		mfp._lastFocusedEl = document.activeElement;
		
		// Wait for next cycle to allow CSS transition
		setTimeout(function() {
			
			if(mfp.content) {
				mfp._addClassToMFP(READY_CLASS);
				mfp._setFocus();
			} else {
				// if content is not defined (not loaded e.t.c) we add class only for BG
				mfp.bgOverlay.addClass(READY_CLASS);
			}
			
			// Trap the focus in popup
			_document.on('focusin' + EVENT_NS, mfp._onFocusIn);

		}, 16);

		mfp.isOpen = true;
		mfp.updateSize(windowHeight);
		_mfpTrigger(OPEN_EVENT);

		return data;
	},

	/**
	 * Closes the popup
	 */
	close: function() {
		if(!mfp.isOpen) return;
		_mfpTrigger(BEFORE_CLOSE_EVENT);

		mfp.isOpen = false;
		// for CSS3 animation
		if(mfp.st.removalDelay && !mfp.isLowIE && mfp.supportsTransition )  {
			mfp._addClassToMFP(REMOVING_CLASS);
			setTimeout(function() {
				mfp._close();
			}, mfp.st.removalDelay);
		} else {
			mfp._close();
		}
	},

	/**
	 * Helper for close() function
	 */
	_close: function() {
		_mfpTrigger(CLOSE_EVENT);

		var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';

		mfp.bgOverlay.detach();
		mfp.wrap.detach();
		mfp.container.empty();

		if(mfp.st.mainClass) {
			classesToRemove += mfp.st.mainClass + ' ';
		}

		mfp._removeClassFromMFP(classesToRemove);

		if(mfp.fixedContentPos) {
			var windowStyles = {marginRight: ''};
			if(mfp.isIE7) {
				$('body, html').css('overflow', '');
			} else {
				windowStyles.overflow = '';
			}
			$('html').css(windowStyles);
		}
		
		_document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
		mfp.ev.off(EVENT_NS);

		// clean up DOM elements that aren't removed
		mfp.wrap.attr('class', 'mfp-wrap').removeAttr('style');
		mfp.bgOverlay.attr('class', 'mfp-bg');
		mfp.container.attr('class', 'mfp-container');

		// remove close button from target element
		if(mfp.st.showCloseBtn &&
		(!mfp.st.closeBtnInside || mfp.currTemplate[mfp.currItem.type] === true)) {
			if(mfp.currTemplate.closeBtn)
				mfp.currTemplate.closeBtn.detach();
		}


		if(mfp.st.autoFocusLast && mfp._lastFocusedEl) {
			$(mfp._lastFocusedEl).focus(); // put tab focus back
		}
		mfp.currItem = null;	
		mfp.content = null;
		mfp.currTemplate = null;
		mfp.prevHeight = 0;

		_mfpTrigger(AFTER_CLOSE_EVENT);
	},
	
	updateSize: function(winHeight) {

		if(mfp.isIOS) {
			// fixes iOS nav bars https://github.com/dimsemenov/Magnific-Popup/issues/2
			var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
			var height = window.innerHeight * zoomLevel;
			mfp.wrap.css('height', height);
			mfp.wH = height;
		} else {
			mfp.wH = winHeight || _window.height();
		}
		// Fixes #84: popup incorrectly positioned with position:relative on body
		if(!mfp.fixedContentPos) {
			mfp.wrap.css('height', mfp.wH);
		}

		_mfpTrigger('Resize');

	},

	/**
	 * Set content of popup based on current index
	 */
	updateItemHTML: function() {
		var item = mfp.items[mfp.index];

		// Detach and perform modifications
		mfp.contentContainer.detach();

		if(mfp.content)
			mfp.content.detach();

		if(!item.parsed) {
			item = mfp.parseEl( mfp.index );
		}

		var type = item.type;

		_mfpTrigger('BeforeChange', [mfp.currItem ? mfp.currItem.type : '', type]);
		// BeforeChange event works like so:
		// _mfpOn('BeforeChange', function(e, prevType, newType) { });

		mfp.currItem = item;

		if(!mfp.currTemplate[type]) {
			var markup = mfp.st[type] ? mfp.st[type].markup : false;

			// allows to modify markup
			_mfpTrigger('FirstMarkupParse', markup);

			if(markup) {
				mfp.currTemplate[type] = $(markup);
			} else {
				// if there is no markup found we just define that template is parsed
				mfp.currTemplate[type] = true;
			}
		}

		if(_prevContentType && _prevContentType !== item.type) {
			mfp.container.removeClass('mfp-'+_prevContentType+'-holder');
		}

		var newContent = mfp['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, mfp.currTemplate[type]);
		mfp.appendContent(newContent, type);

		item.preloaded = true;

		_mfpTrigger(CHANGE_EVENT, item);
		_prevContentType = item.type;

		// Append container back after its content changed
		mfp.container.prepend(mfp.contentContainer);

		_mfpTrigger('AfterChange');
	},


	/**
	 * Set HTML content of popup
	 */
	appendContent: function(newContent, type) {
		mfp.content = newContent;

		if(newContent) {
			if(mfp.st.showCloseBtn && mfp.st.closeBtnInside &&
				mfp.currTemplate[type] === true) {
				// if there is no markup, we just append close button element inside
				if(!mfp.content.find('.mfp-close').length) {
					mfp.content.append(_getCloseBtn());
				}
			} else {
				mfp.content = newContent;
			}
		} else {
			mfp.content = '';
		}

		_mfpTrigger(BEFORE_APPEND_EVENT);
		mfp.container.addClass('mfp-'+type+'-holder');

		mfp.contentContainer.append(mfp.content);
	},


	/**
	 * Creates Magnific Popup data object based on given data
	 * @param  {int} index Index of item to parse
	 */
	parseEl: function(index) {
		var item = mfp.items[index],
			type;

		if(item.tagName) {
			item = { el: $(item) };
		} else {
			type = item.type;
			item = { data: item, src: item.src };
		}

		if(item.el) {
			var types = mfp.types;

			// check for 'mfp-TYPE' class
			for(var i = 0; i < types.length; i++) {
				if( item.el.hasClass('mfp-'+types[i]) ) {
					type = types[i];
					break;
				}
			}

			item.src = item.el.attr('data-mfp-src');
			if(!item.src) {
				item.src = item.el.attr('href');
			}
		}

		item.type = type || mfp.st.type || 'inline';
		item.index = index;
		item.parsed = true;
		mfp.items[index] = item;
		_mfpTrigger('ElementParse', item);

		return mfp.items[index];
	},


	/**
	 * Initializes single popup or a group of popups
	 */
	addGroup: function(el, options) {
		var eHandler = function(e) {
			e.mfpEl = this;
			mfp._openClick(e, el, options);
		};

		if(!options) {
			options = {};
		}

		var eName = 'click.magnificPopup';
		options.mainEl = el;

		if(options.items) {
			options.isObj = true;
			el.off(eName).on(eName, eHandler);
		} else {
			options.isObj = false;
			if(options.delegate) {
				el.off(eName).on(eName, options.delegate , eHandler);
			} else {
				options.items = el;
				el.off(eName).on(eName, eHandler);
			}
		}
	},
	_openClick: function(e, el, options) {
		var midClick = options.midClick !== undefined ? options.midClick : $.magnificPopup.defaults.midClick;


		if(!midClick && ( e.which === 2 || e.ctrlKey || e.metaKey || e.altKey || e.shiftKey ) ) {
			return;
		}

		var disableOn = options.disableOn !== undefined ? options.disableOn : $.magnificPopup.defaults.disableOn;

		if(disableOn) {
			if($.isFunction(disableOn)) {
				if( !disableOn.call(mfp) ) {
					return true;
				}
			} else { // else it's number
				if( _window.width() < disableOn ) {
					return true;
				}
			}
		}

		if(e.type) {
			e.preventDefault();

			// This will prevent popup from closing if element is inside and popup is already opened
			if(mfp.isOpen) {
				e.stopPropagation();
			}
		}

		options.el = $(e.mfpEl);
		if(options.delegate) {
			options.items = el.find(options.delegate);
		}
		mfp.open(options);
	},


	/**
	 * Updates text on preloader
	 */
	updateStatus: function(status, text) {

		if(mfp.preloader) {
			if(_prevStatus !== status) {
				mfp.container.removeClass('mfp-s-'+_prevStatus);
			}

			if(!text && status === 'loading') {
				text = mfp.st.tLoading;
			}

			var data = {
				status: status,
				text: text
			};
			// allows to modify status
			_mfpTrigger('UpdateStatus', data);

			status = data.status;
			text = data.text;

			mfp.preloader.html(text);

			mfp.preloader.find('a').on('click', function(e) {
				e.stopImmediatePropagation();
			});

			mfp.container.addClass('mfp-s-'+status);
			_prevStatus = status;
		}
	},


	/*
		"Private" helpers that aren't private at all
	 */
	// Check to close popup or not
	// "target" is an element that was clicked
	_checkIfClose: function(target) {

		if($(target).hasClass(PREVENT_CLOSE_CLASS)) {
			return;
		}

		var closeOnContent = mfp.st.closeOnContentClick;
		var closeOnBg = mfp.st.closeOnBgClick;

		if(closeOnContent && closeOnBg) {
			return true;
		} else {

			// We close the popup if click is on close button or on preloader. Or if there is no content.
			if(!mfp.content || $(target).hasClass('mfp-close') || (mfp.preloader && target === mfp.preloader[0]) ) {
				return true;
			}

			// if click is outside the content
			if(  (target !== mfp.content[0] && !$.contains(mfp.content[0], target))  ) {
				if(closeOnBg) {
					// last check, if the clicked element is in DOM, (in case it's removed onclick)
					if( $.contains(document, target) ) {
						return true;
					}
				}
			} else if(closeOnContent) {
				return true;
			}

		}
		return false;
	},
	_addClassToMFP: function(cName) {
		mfp.bgOverlay.addClass(cName);
		mfp.wrap.addClass(cName);
	},
	_removeClassFromMFP: function(cName) {
		this.bgOverlay.removeClass(cName);
		mfp.wrap.removeClass(cName);
	},
	_hasScrollBar: function(winHeight) {
		return (  (mfp.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height()) );
	},
	_setFocus: function() {
		(mfp.st.focus ? mfp.content.find(mfp.st.focus).eq(0) : mfp.wrap).focus();
	},
	_onFocusIn: function(e) {
		if( e.target !== mfp.wrap[0] && !$.contains(mfp.wrap[0], e.target) ) {
			mfp._setFocus();
			return false;
		}
	},
	_parseMarkup: function(template, values, item) {
		var arr;
		if(item.data) {
			values = $.extend(item.data, values);
		}
		_mfpTrigger(MARKUP_PARSE_EVENT, [template, values, item] );

		$.each(values, function(key, value) {
			if(value === undefined || value === false) {
				return true;
			}
			arr = key.split('_');
			if(arr.length > 1) {
				var el = template.find(EVENT_NS + '-'+arr[0]);

				if(el.length > 0) {
					var attr = arr[1];
					if(attr === 'replaceWith') {
						if(el[0] !== value[0]) {
							el.replaceWith(value);
						}
					} else if(attr === 'img') {
						if(el.is('img')) {
							el.attr('src', value);
						} else {
							el.replaceWith( $('<img>').attr('src', value).attr('class', el.attr('class')) );
						}
					} else {
						el.attr(arr[1], value);
					}
				}

			} else {
				template.find(EVENT_NS + '-'+key).html(value);
			}
		});
	},

	_getScrollbarSize: function() {
		// thx David
		if(mfp.scrollbarSize === undefined) {
			var scrollDiv = document.createElement("div");
			scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
			document.body.appendChild(scrollDiv);
			mfp.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
			document.body.removeChild(scrollDiv);
		}
		return mfp.scrollbarSize;
	}

}; /* MagnificPopup core prototype end */




/**
 * Public static functions
 */
$.magnificPopup = {
	instance: null,
	proto: MagnificPopup.prototype,
	modules: [],

	open: function(options, index) {
		_checkInstance();

		if(!options) {
			options = {};
		} else {
			options = $.extend(true, {}, options);
		}

		options.isObj = true;
		options.index = index || 0;
		return this.instance.open(options);
	},

	close: function() {
		return $.magnificPopup.instance && $.magnificPopup.instance.close();
	},

	registerModule: function(name, module) {
		if(module.options) {
			$.magnificPopup.defaults[name] = module.options;
		}
		$.extend(this.proto, module.proto);
		this.modules.push(name);
	},

	defaults: {

		// Info about options is in docs:
		// http://dimsemenov.com/plugins/magnific-popup/documentation.html#options

		disableOn: 0,

		key: null,

		midClick: false,

		mainClass: '',

		preloader: true,

		focus: '', // CSS selector of input to focus after popup is opened

		closeOnContentClick: false,

		closeOnBgClick: true,

		closeBtnInside: true,

		showCloseBtn: true,

		enableEscapeKey: true,

		modal: false,

		alignTop: false,

		removalDelay: 0,

		prependTo: null,

		fixedContentPos: 'auto',

		fixedBgPos: 'auto',

		overflowY: 'auto',

		closeMarkup: '<button title="%title%" type="button" class="mfp-close">&#215;</button>',

		tClose: 'Close (Esc)',

		tLoading: 'Loading...',

		autoFocusLast: true

	}
};



$.fn.magnificPopup = function(options) {
	_checkInstance();

	var jqEl = $(this);

	// We call some API method of first param is a string
	if (typeof options === "string" ) {

		if(options === 'open') {
			var items,
				itemOpts = _isJQ ? jqEl.data('magnificPopup') : jqEl[0].magnificPopup,
				index = parseInt(arguments[1], 10) || 0;

			if(itemOpts.items) {
				items = itemOpts.items[index];
			} else {
				items = jqEl;
				if(itemOpts.delegate) {
					items = items.find(itemOpts.delegate);
				}
				items = items.eq( index );
			}
			mfp._openClick({mfpEl:items}, jqEl, itemOpts);
		} else {
			if(mfp.isOpen)
				mfp[options].apply(mfp, Array.prototype.slice.call(arguments, 1));
		}

	} else {
		// clone options obj
		options = $.extend(true, {}, options);

		/*
		 * As Zepto doesn't support .data() method for objects
		 * and it works only in normal browsers
		 * we assign "options" object directly to the DOM element. FTW!
		 */
		if(_isJQ) {
			jqEl.data('magnificPopup', options);
		} else {
			jqEl[0].magnificPopup = options;
		}

		mfp.addGroup(jqEl, options);

	}
	return jqEl;
};

/*>>core*/

/*>>inline*/

var INLINE_NS = 'inline',
	_hiddenClass,
	_inlinePlaceholder,
	_lastInlineElement,
	_putInlineElementsBack = function() {
		if(_lastInlineElement) {
			_inlinePlaceholder.after( _lastInlineElement.addClass(_hiddenClass) ).detach();
			_lastInlineElement = null;
		}
	};

$.magnificPopup.registerModule(INLINE_NS, {
	options: {
		hiddenClass: 'hide', // will be appended with `mfp-` prefix
		markup: '',
		tNotFound: 'Content not found'
	},
	proto: {

		initInline: function() {
			mfp.types.push(INLINE_NS);

			_mfpOn(CLOSE_EVENT+'.'+INLINE_NS, function() {
				_putInlineElementsBack();
			});
		},

		getInline: function(item, template) {

			_putInlineElementsBack();

			if(item.src) {
				var inlineSt = mfp.st.inline,
					el = $(item.src);

				if(el.length) {

					// If target element has parent - we replace it with placeholder and put it back after popup is closed
					var parent = el[0].parentNode;
					if(parent && parent.tagName) {
						if(!_inlinePlaceholder) {
							_hiddenClass = inlineSt.hiddenClass;
							_inlinePlaceholder = _getEl(_hiddenClass);
							_hiddenClass = 'mfp-'+_hiddenClass;
						}
						// replace target inline element with placeholder
						_lastInlineElement = el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass);
					}

					mfp.updateStatus('ready');
				} else {
					mfp.updateStatus('error', inlineSt.tNotFound);
					el = $('<div>');
				}

				item.inlineElement = el;
				return el;
			}

			mfp.updateStatus('ready');
			mfp._parseMarkup(template, {}, item);
			return template;
		}
	}
});

/*>>inline*/

/*>>ajax*/
var AJAX_NS = 'ajax',
	_ajaxCur,
	_removeAjaxCursor = function() {
		if(_ajaxCur) {
			$(document.body).removeClass(_ajaxCur);
		}
	},
	_destroyAjaxRequest = function() {
		_removeAjaxCursor();
		if(mfp.req) {
			mfp.req.abort();
		}
	};

$.magnificPopup.registerModule(AJAX_NS, {

	options: {
		settings: null,
		cursor: 'mfp-ajax-cur',
		tError: '<a href="%url%">The content</a> could not be loaded.'
	},

	proto: {
		initAjax: function() {
			mfp.types.push(AJAX_NS);
			_ajaxCur = mfp.st.ajax.cursor;

			_mfpOn(CLOSE_EVENT+'.'+AJAX_NS, _destroyAjaxRequest);
			_mfpOn('BeforeChange.' + AJAX_NS, _destroyAjaxRequest);
		},
		getAjax: function(item) {

			if(_ajaxCur) {
				$(document.body).addClass(_ajaxCur);
			}

			mfp.updateStatus('loading');

			var opts = $.extend({
				url: item.src,
				success: function(data, textStatus, jqXHR) {
					var temp = {
						data:data,
						xhr:jqXHR
					};

					_mfpTrigger('ParseAjax', temp);

					mfp.appendContent( $(temp.data), AJAX_NS );

					item.finished = true;

					_removeAjaxCursor();

					mfp._setFocus();

					setTimeout(function() {
						mfp.wrap.addClass(READY_CLASS);
					}, 16);

					mfp.updateStatus('ready');

					_mfpTrigger('AjaxContentAdded');
				},
				error: function() {
					_removeAjaxCursor();
					item.finished = item.loadError = true;
					mfp.updateStatus('error', mfp.st.ajax.tError.replace('%url%', item.src));
				}
			}, mfp.st.ajax.settings);

			mfp.req = $.ajax(opts);

			return '';
		}
	}
});

/*>>ajax*/

/*>>image*/
var _imgInterval,
	_getTitle = function(item) {
		if(item.data && item.data.title !== undefined)
			return item.data.title;

		var src = mfp.st.image.titleSrc;

		if(src) {
			if($.isFunction(src)) {
				return src.call(mfp, item);
			} else if(item.el) {
				return item.el.attr(src) || '';
			}
		}
		return '';
	};

$.magnificPopup.registerModule('image', {

	options: {
		markup: '<div class="mfp-figure">'+
					'<div class="mfp-close"></div>'+
					'<figure>'+
						'<div class="mfp-img"></div>'+
						'<figcaption>'+
							'<div class="mfp-bottom-bar">'+
								'<div class="mfp-title"></div>'+
								'<div class="mfp-counter"></div>'+
							'</div>'+
						'</figcaption>'+
					'</figure>'+
				'</div>',
		cursor: 'mfp-zoom-out-cur',
		titleSrc: 'title',
		verticalFit: true,
		tError: '<a href="%url%">The image</a> could not be loaded.'
	},

	proto: {
		initImage: function() {
			var imgSt = mfp.st.image,
				ns = '.image';

			mfp.types.push('image');

			_mfpOn(OPEN_EVENT+ns, function() {
				if(mfp.currItem.type === 'image' && imgSt.cursor) {
					$(document.body).addClass(imgSt.cursor);
				}
			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(imgSt.cursor) {
					$(document.body).removeClass(imgSt.cursor);
				}
				_window.off('resize' + EVENT_NS);
			});

			_mfpOn('Resize'+ns, mfp.resizeImage);
			if(mfp.isLowIE) {
				_mfpOn('AfterChange', mfp.resizeImage);
			}
		},
		resizeImage: function() {
			var item = mfp.currItem;
			if(!item || !item.img) return;

			if(mfp.st.image.verticalFit) {
				var decr = 0;
				// fix box-sizing in ie7/8
				if(mfp.isLowIE) {
					decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'),10);
				}
				item.img.css('max-height', mfp.wH-decr);
			}
		},
		_onImageHasSize: function(item) {
			if(item.img) {

				item.hasSize = true;

				if(_imgInterval) {
					clearInterval(_imgInterval);
				}

				item.isCheckingImgSize = false;

				_mfpTrigger('ImageHasSize', item);

				if(item.imgHidden) {
					if(mfp.content)
						mfp.content.removeClass('mfp-loading');

					item.imgHidden = false;
				}

			}
		},

		/**
		 * Function that loops until the image has size to display elements that rely on it asap
		 */
		findImageSize: function(item) {

			var counter = 0,
				img = item.img[0],
				mfpSetInterval = function(delay) {

					if(_imgInterval) {
						clearInterval(_imgInterval);
					}
					// decelerating interval that checks for size of an image
					_imgInterval = setInterval(function() {
						if(img.naturalWidth > 0) {
							mfp._onImageHasSize(item);
							return;
						}

						if(counter > 200) {
							clearInterval(_imgInterval);
						}

						counter++;
						if(counter === 3) {
							mfpSetInterval(10);
						} else if(counter === 40) {
							mfpSetInterval(50);
						} else if(counter === 100) {
							mfpSetInterval(500);
						}
					}, delay);
				};

			mfpSetInterval(1);
		},

		getImage: function(item, template) {

			var guard = 0,

				// image load complete handler
				onLoadComplete = function() {
					if(item) {
						if (item.img[0].complete) {
							item.img.off('.mfploader');

							if(item === mfp.currItem){
								mfp._onImageHasSize(item);

								mfp.updateStatus('ready');
							}

							item.hasSize = true;
							item.loaded = true;

							_mfpTrigger('ImageLoadComplete');

						}
						else {
							// if image complete check fails 200 times (20 sec), we assume that there was an error.
							guard++;
							if(guard < 200) {
								setTimeout(onLoadComplete,100);
							} else {
								onLoadError();
							}
						}
					}
				},

				// image error handler
				onLoadError = function() {
					if(item) {
						item.img.off('.mfploader');
						if(item === mfp.currItem){
							mfp._onImageHasSize(item);
							mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
						}

						item.hasSize = true;
						item.loaded = true;
						item.loadError = true;
					}
				},
				imgSt = mfp.st.image;


			var el = template.find('.mfp-img');
			if(el.length) {
				var img = document.createElement('img');
				img.className = 'mfp-img';
				if(item.el && item.el.find('img').length) {
					img.alt = item.el.find('img').attr('alt');
				}
				item.img = $(img).on('load.mfploader', onLoadComplete).on('error.mfploader', onLoadError);
				img.src = item.src;

				// without clone() "error" event is not firing when IMG is replaced by new IMG
				// TODO: find a way to avoid such cloning
				if(el.is('img')) {
					item.img = item.img.clone();
				}

				img = item.img[0];
				if(img.naturalWidth > 0) {
					item.hasSize = true;
				} else if(!img.width) {
					item.hasSize = false;
				}
			}

			mfp._parseMarkup(template, {
				title: _getTitle(item),
				img_replaceWith: item.img
			}, item);

			mfp.resizeImage();

			if(item.hasSize) {
				if(_imgInterval) clearInterval(_imgInterval);

				if(item.loadError) {
					template.addClass('mfp-loading');
					mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
				} else {
					template.removeClass('mfp-loading');
					mfp.updateStatus('ready');
				}
				return template;
			}

			mfp.updateStatus('loading');
			item.loading = true;

			if(!item.hasSize) {
				item.imgHidden = true;
				template.addClass('mfp-loading');
				mfp.findImageSize(item);
			}

			return template;
		}
	}
});

/*>>image*/

/*>>zoom*/
var hasMozTransform,
	getHasMozTransform = function() {
		if(hasMozTransform === undefined) {
			hasMozTransform = document.createElement('p').style.MozTransform !== undefined;
		}
		return hasMozTransform;
	};

$.magnificPopup.registerModule('zoom', {

	options: {
		enabled: false,
		easing: 'ease-in-out',
		duration: 300,
		opener: function(element) {
			return element.is('img') ? element : element.find('img');
		}
	},

	proto: {

		initZoom: function() {
			var zoomSt = mfp.st.zoom,
				ns = '.zoom',
				image;

			if(!zoomSt.enabled || !mfp.supportsTransition) {
				return;
			}

			var duration = zoomSt.duration,
				getElToAnimate = function(image) {
					var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),
						transition = 'all '+(zoomSt.duration/1000)+'s ' + zoomSt.easing,
						cssObj = {
							position: 'fixed',
							zIndex: 9999,
							left: 0,
							top: 0,
							'-webkit-backface-visibility': 'hidden'
						},
						t = 'transition';

					cssObj['-webkit-'+t] = cssObj['-moz-'+t] = cssObj['-o-'+t] = cssObj[t] = transition;

					newImg.css(cssObj);
					return newImg;
				},
				showMainContent = function() {
					mfp.content.css('visibility', 'visible');
				},
				openTimeout,
				animatedImg;

			_mfpOn('BuildControls'+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);
					mfp.content.css('visibility', 'hidden');

					// Basically, all code below does is clones existing image, puts in on top of the current one and animated it

					image = mfp._getItemToZoom();

					if(!image) {
						showMainContent();
						return;
					}

					animatedImg = getElToAnimate(image);

					animatedImg.css( mfp._getOffset() );

					mfp.wrap.append(animatedImg);

					openTimeout = setTimeout(function() {
						animatedImg.css( mfp._getOffset( true ) );
						openTimeout = setTimeout(function() {

							showMainContent();

							setTimeout(function() {
								animatedImg.remove();
								image = animatedImg = null;
								_mfpTrigger('ZoomAnimationEnded');
							}, 16); // avoid blink when switching images

						}, duration); // this timeout equals animation duration

					}, 16); // by adding this timeout we avoid short glitch at the beginning of animation


					// Lots of timeouts...
				}
			});
			_mfpOn(BEFORE_CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);

					mfp.st.removalDelay = duration;

					if(!image) {
						image = mfp._getItemToZoom();
						if(!image) {
							return;
						}
						animatedImg = getElToAnimate(image);
					}

					animatedImg.css( mfp._getOffset(true) );
					mfp.wrap.append(animatedImg);
					mfp.content.css('visibility', 'hidden');

					setTimeout(function() {
						animatedImg.css( mfp._getOffset() );
					}, 16);
				}

			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {
					showMainContent();
					if(animatedImg) {
						animatedImg.remove();
					}
					image = null;
				}
			});
		},

		_allowZoom: function() {
			return mfp.currItem.type === 'image';
		},

		_getItemToZoom: function() {
			if(mfp.currItem.hasSize) {
				return mfp.currItem.img;
			} else {
				return false;
			}
		},

		// Get element postion relative to viewport
		_getOffset: function(isLarge) {
			var el;
			if(isLarge) {
				el = mfp.currItem.img;
			} else {
				el = mfp.st.zoom.opener(mfp.currItem.el || mfp.currItem);
			}

			var offset = el.offset();
			var paddingTop = parseInt(el.css('padding-top'),10);
			var paddingBottom = parseInt(el.css('padding-bottom'),10);
			offset.top -= ( $(window).scrollTop() - paddingTop );


			/*

			Animating left + top + width/height looks glitchy in Firefox, but perfect in Chrome. And vice-versa.

			 */
			var obj = {
				width: el.width(),
				// fix Zepto height+padding issue
				height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop
			};

			// I hate to do this, but there is no another option
			if( getHasMozTransform() ) {
				obj['-moz-transform'] = obj['transform'] = 'translate(' + offset.left + 'px,' + offset.top + 'px)';
			} else {
				obj.left = offset.left;
				obj.top = offset.top;
			}
			return obj;
		}

	}
});



/*>>zoom*/

/*>>iframe*/

var IFRAME_NS = 'iframe',
	_emptyPage = '//about:blank',

	_fixIframeBugs = function(isShowing) {
		if(mfp.currTemplate[IFRAME_NS]) {
			var el = mfp.currTemplate[IFRAME_NS].find('iframe');
			if(el.length) {
				// reset src after the popup is closed to avoid "video keeps playing after popup is closed" bug
				if(!isShowing) {
					el[0].src = _emptyPage;
				}

				// IE8 black screen bug fix
				if(mfp.isIE8) {
					el.css('display', isShowing ? 'block' : 'none');
				}
			}
		}
	};

$.magnificPopup.registerModule(IFRAME_NS, {

	options: {
		markup: '<div class="mfp-iframe-scaler">'+
					'<div class="mfp-close"></div>'+
					'<iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>'+
				'</div>',

		srcAction: 'iframe_src',

		// we don't care and support only one default type of URL by default
		patterns: {
			youtube: {
				index: 'youtube.com',
				id: 'v=',
				src: '//www.youtube.com/embed/%id%?autoplay=1'
			},
			vimeo: {
				index: 'vimeo.com/',
				id: '/',
				src: '//player.vimeo.com/video/%id%?autoplay=1'
			},
			gmaps: {
				index: '//maps.google.',
				src: '%id%&output=embed'
			}
		}
	},

	proto: {
		initIframe: function() {
			mfp.types.push(IFRAME_NS);

			_mfpOn('BeforeChange', function(e, prevType, newType) {
				if(prevType !== newType) {
					if(prevType === IFRAME_NS) {
						_fixIframeBugs(); // iframe if removed
					} else if(newType === IFRAME_NS) {
						_fixIframeBugs(true); // iframe is showing
					}
				}// else {
					// iframe source is switched, don't do anything
				//}
			});

			_mfpOn(CLOSE_EVENT + '.' + IFRAME_NS, function() {
				_fixIframeBugs();
			});
		},

		getIframe: function(item, template) {
			var embedSrc = item.src;
			var iframeSt = mfp.st.iframe;

			$.each(iframeSt.patterns, function() {
				if(embedSrc.indexOf( this.index ) > -1) {
					if(this.id) {
						if(typeof this.id === 'string') {
							embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id)+this.id.length, embedSrc.length);
						} else {
							embedSrc = this.id.call( this, embedSrc );
						}
					}
					embedSrc = this.src.replace('%id%', embedSrc );
					return false; // break;
				}
			});

			var dataObj = {};
			if(iframeSt.srcAction) {
				dataObj[iframeSt.srcAction] = embedSrc;
			}
			mfp._parseMarkup(template, dataObj, item);

			mfp.updateStatus('ready');

			return template;
		}
	}
});



/*>>iframe*/

/*>>gallery*/
/**
 * Get looped index depending on number of slides
 */
var _getLoopedId = function(index) {
		var numSlides = mfp.items.length;
		if(index > numSlides - 1) {
			return index - numSlides;
		} else  if(index < 0) {
			return numSlides + index;
		}
		return index;
	},
	_replaceCurrTotal = function(text, curr, total) {
		return text.replace(/%curr%/gi, curr + 1).replace(/%total%/gi, total);
	};

$.magnificPopup.registerModule('gallery', {

	options: {
		enabled: false,
		arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
		preload: [0,2],
		navigateByImgClick: true,
		arrows: true,

		tPrev: 'Previous (Left arrow key)',
		tNext: 'Next (Right arrow key)',
		tCounter: '%curr% of %total%'
	},

	proto: {
		initGallery: function() {

			var gSt = mfp.st.gallery,
				ns = '.mfp-gallery';

			mfp.direction = true; // true - next, false - prev

			if(!gSt || !gSt.enabled ) return false;

			_wrapClasses += ' mfp-gallery';

			_mfpOn(OPEN_EVENT+ns, function() {

				if(gSt.navigateByImgClick) {
					mfp.wrap.on('click'+ns, '.mfp-img', function() {
						if(mfp.items.length > 1) {
							mfp.next();
							return false;
						}
					});
				}

				_document.on('keydown'+ns, function(e) {
					if (e.keyCode === 37) {
						mfp.prev();
					} else if (e.keyCode === 39) {
						mfp.next();
					}
				});
			});

			_mfpOn('UpdateStatus'+ns, function(e, data) {
				if(data.text) {
					data.text = _replaceCurrTotal(data.text, mfp.currItem.index, mfp.items.length);
				}
			});

			_mfpOn(MARKUP_PARSE_EVENT+ns, function(e, element, values, item) {
				var l = mfp.items.length;
				values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : '';
			});

			_mfpOn('BuildControls' + ns, function() {
				if(mfp.items.length > 1 && gSt.arrows && !mfp.arrowLeft) {
					var markup = gSt.arrowMarkup,
						arrowLeft = mfp.arrowLeft = $( markup.replace(/%title%/gi, gSt.tPrev).replace(/%dir%/gi, 'left') ).addClass(PREVENT_CLOSE_CLASS),
						arrowRight = mfp.arrowRight = $( markup.replace(/%title%/gi, gSt.tNext).replace(/%dir%/gi, 'right') ).addClass(PREVENT_CLOSE_CLASS);

					arrowLeft.click(function() {
						mfp.prev();
					});
					arrowRight.click(function() {
						mfp.next();
					});

					mfp.container.append(arrowLeft.add(arrowRight));
				}
			});

			_mfpOn(CHANGE_EVENT+ns, function() {
				if(mfp._preloadTimeout) clearTimeout(mfp._preloadTimeout);

				mfp._preloadTimeout = setTimeout(function() {
					mfp.preloadNearbyImages();
					mfp._preloadTimeout = null;
				}, 16);
			});


			_mfpOn(CLOSE_EVENT+ns, function() {
				_document.off(ns);
				mfp.wrap.off('click'+ns);
				mfp.arrowRight = mfp.arrowLeft = null;
			});

		},
		next: function() {
			mfp.direction = true;
			mfp.index = _getLoopedId(mfp.index + 1);
			mfp.updateItemHTML();
		},
		prev: function() {
			mfp.direction = false;
			mfp.index = _getLoopedId(mfp.index - 1);
			mfp.updateItemHTML();
		},
		goTo: function(newIndex) {
			mfp.direction = (newIndex >= mfp.index);
			mfp.index = newIndex;
			mfp.updateItemHTML();
		},
		preloadNearbyImages: function() {
			var p = mfp.st.gallery.preload,
				preloadBefore = Math.min(p[0], mfp.items.length),
				preloadAfter = Math.min(p[1], mfp.items.length),
				i;

			for(i = 1; i <= (mfp.direction ? preloadAfter : preloadBefore); i++) {
				mfp._preloadItem(mfp.index+i);
			}
			for(i = 1; i <= (mfp.direction ? preloadBefore : preloadAfter); i++) {
				mfp._preloadItem(mfp.index-i);
			}
		},
		_preloadItem: function(index) {
			index = _getLoopedId(index);

			if(mfp.items[index].preloaded) {
				return;
			}

			var item = mfp.items[index];
			if(!item.parsed) {
				item = mfp.parseEl( index );
			}

			_mfpTrigger('LazyLoad', item);

			if(item.type === 'image') {
				item.img = $('<img class="mfp-img" />').on('load.mfploader', function() {
					item.hasSize = true;
				}).on('error.mfploader', function() {
					item.hasSize = true;
					item.loadError = true;
					_mfpTrigger('LazyLoadError', item);
				}).attr('src', item.src);
			}


			item.preloaded = true;
		}
	}
});

/*>>gallery*/


 _checkInstance(); }));
/**
 * Owl Carousel v2.3.3
 * Copyright 2013-2018 David Deutsch
 * Licensed under: SEE LICENSE IN https://github.com/OwlCarousel2/OwlCarousel2/blob/master/LICENSE
 */
!function(a,b,c,d){function e(b,c){this.settings=null,this.options=a.extend({},e.Defaults,c),this.$element=a(b),this._handlers={},this._plugins={},this._supress={},this._current=null,this._speed=null,this._coordinates=[],this._breakpoint=null,this._width=null,this._items=[],this._clones=[],this._mergers=[],this._widths=[],this._invalidated={},this._pipe=[],this._drag={time:null,target:null,pointer:null,stage:{start:null,current:null},direction:null},this._states={current:{},tags:{initializing:["busy"],animating:["busy"],dragging:["interacting"]}},a.each(["onResize","onThrottledResize"],a.proxy(function(b,c){this._handlers[c]=a.proxy(this[c],this)},this)),a.each(e.Plugins,a.proxy(function(a,b){this._plugins[a.charAt(0).toLowerCase()+a.slice(1)]=new b(this)},this)),a.each(e.Workers,a.proxy(function(b,c){this._pipe.push({filter:c.filter,run:a.proxy(c.run,this)})},this)),this.setup(),this.initialize()}e.Defaults={items:3,loop:!1,center:!1,rewind:!1,checkVisibility:!0,mouseDrag:!0,touchDrag:!0,pullDrag:!0,freeDrag:!1,margin:0,stagePadding:0,merge:!1,mergeFit:!0,autoWidth:!1,startPosition:0,rtl:!1,smartSpeed:250,fluidSpeed:!1,dragEndSpeed:!1,responsive:{},responsiveRefreshRate:200,responsiveBaseElement:b,fallbackEasing:"swing",info:!1,nestedItemSelector:!1,itemElement:"div",stageElement:"div",refreshClass:"owl-refresh",loadedClass:"owl-loaded",loadingClass:"owl-loading",rtlClass:"owl-rtl",responsiveClass:"owl-responsive",dragClass:"owl-drag",itemClass:"owl-item",stageClass:"owl-stage",stageOuterClass:"owl-stage-outer",grabClass:"owl-grab"},e.Width={Default:"default",Inner:"inner",Outer:"outer"},e.Type={Event:"event",State:"state"},e.Plugins={},e.Workers=[{filter:["width","settings"],run:function(){this._width=this.$element.width()}},{filter:["width","items","settings"],run:function(a){a.current=this._items&&this._items[this.relative(this._current)]}},{filter:["items","settings"],run:function(){this.$stage.children(".cloned").remove()}},{filter:["width","items","settings"],run:function(a){var b=this.settings.margin||"",c=!this.settings.autoWidth,d=this.settings.rtl,e={width:"auto","margin-left":d?b:"","margin-right":d?"":b};!c&&this.$stage.children().css(e),a.css=e}},{filter:["width","items","settings"],run:function(a){var b=(this.width()/this.settings.items).toFixed(3)-this.settings.margin,c=null,d=this._items.length,e=!this.settings.autoWidth,f=[];for(a.items={merge:!1,width:b};d--;)c=this._mergers[d],c=this.settings.mergeFit&&Math.min(c,this.settings.items)||c,a.items.merge=c>1||a.items.merge,f[d]=e?b*c:this._items[d].width();this._widths=f}},{filter:["items","settings"],run:function(){var b=[],c=this._items,d=this.settings,e=Math.max(2*d.items,4),f=2*Math.ceil(c.length/2),g=d.loop&&c.length?d.rewind?e:Math.max(e,f):0,h="",i="";for(g/=2;g>0;)b.push(this.normalize(b.length/2,!0)),h+=c[b[b.length-1]][0].outerHTML,b.push(this.normalize(c.length-1-(b.length-1)/2,!0)),i=c[b[b.length-1]][0].outerHTML+i,g-=1;this._clones=b,a(h).addClass("cloned").appendTo(this.$stage),a(i).addClass("cloned").prependTo(this.$stage)}},{filter:["width","items","settings"],run:function(){for(var a=this.settings.rtl?1:-1,b=this._clones.length+this._items.length,c=-1,d=0,e=0,f=[];++c<b;)d=f[c-1]||0,e=this._widths[this.relative(c)]+this.settings.margin,f.push(d+e*a);this._coordinates=f}},{filter:["width","items","settings"],run:function(){var a=this.settings.stagePadding,b=this._coordinates,c={width:Math.ceil(Math.abs(b[b.length-1]))+2*a,"padding-left":a||"","padding-right":a||""};this.$stage.css(c)}},{filter:["width","items","settings"],run:function(a){var b=this._coordinates.length,c=!this.settings.autoWidth,d=this.$stage.children();if(c&&a.items.merge)for(;b--;)a.css.width=this._widths[this.relative(b)],d.eq(b).css(a.css);else c&&(a.css.width=a.items.width,d.css(a.css))}},{filter:["items"],run:function(){this._coordinates.length<1&&this.$stage.removeAttr("style")}},{filter:["width","items","settings"],run:function(a){a.current=a.current?this.$stage.children().index(a.current):0,a.current=Math.max(this.minimum(),Math.min(this.maximum(),a.current)),this.reset(a.current)}},{filter:["position"],run:function(){this.animate(this.coordinates(this._current))}},{filter:["width","position","items","settings"],run:function(){var a,b,c,d,e=this.settings.rtl?1:-1,f=2*this.settings.stagePadding,g=this.coordinates(this.current())+f,h=g+this.width()*e,i=[];for(c=0,d=this._coordinates.length;c<d;c++)a=this._coordinates[c-1]||0,b=Math.abs(this._coordinates[c])+f*e,(this.op(a,"<=",g)&&this.op(a,">",h)||this.op(b,"<",g)&&this.op(b,">",h))&&i.push(c);this.$stage.children(".active").removeClass("active"),this.$stage.children(":eq("+i.join("), :eq(")+")").addClass("active"),this.$stage.children(".center").removeClass("center"),this.settings.center&&this.$stage.children().eq(this.current()).addClass("center")}}],e.prototype.initializeStage=function(){this.$stage=this.$element.find("."+this.settings.stageClass),this.$stage.length||(this.$element.addClass(this.options.loadingClass),this.$stage=a("<"+this.settings.stageElement+' class="'+this.settings.stageClass+'"/>').wrap('<div class="'+this.settings.stageOuterClass+'"/>'),this.$element.append(this.$stage.parent()))},e.prototype.initializeItems=function(){var b=this.$element.find(".owl-item");if(b.length)return this._items=b.get().map(function(b){return a(b)}),this._mergers=this._items.map(function(){return 1}),void this.refresh();this.replace(this.$element.children().not(this.$stage.parent())),this.isVisible()?this.refresh():this.invalidate("width"),this.$element.removeClass(this.options.loadingClass).addClass(this.options.loadedClass)},e.prototype.initialize=function(){if(this.enter("initializing"),this.trigger("initialize"),this.$element.toggleClass(this.settings.rtlClass,this.settings.rtl),this.settings.autoWidth&&!this.is("pre-loading")){var a,b,c;a=this.$element.find("img"),b=this.settings.nestedItemSelector?"."+this.settings.nestedItemSelector:d,c=this.$element.children(b).width(),a.length&&c<=0&&this.preloadAutoWidthImages(a)}this.initializeStage(),this.initializeItems(),this.registerEventHandlers(),this.leave("initializing"),this.trigger("initialized")},e.prototype.isVisible=function(){return!this.settings.checkVisibility||this.$element.is(":visible")},e.prototype.setup=function(){var b=this.viewport(),c=this.options.responsive,d=-1,e=null;c?(a.each(c,function(a){a<=b&&a>d&&(d=Number(a))}),e=a.extend({},this.options,c[d]),"function"==typeof e.stagePadding&&(e.stagePadding=e.stagePadding()),delete e.responsive,e.responsiveClass&&this.$element.attr("class",this.$element.attr("class").replace(new RegExp("("+this.options.responsiveClass+"-)\\S+\\s","g"),"$1"+d))):e=a.extend({},this.options),this.trigger("change",{property:{name:"settings",value:e}}),this._breakpoint=d,this.settings=e,this.invalidate("settings"),this.trigger("changed",{property:{name:"settings",value:this.settings}})},e.prototype.optionsLogic=function(){this.settings.autoWidth&&(this.settings.stagePadding=!1,this.settings.merge=!1)},e.prototype.prepare=function(b){var c=this.trigger("prepare",{content:b});return c.data||(c.data=a("<"+this.settings.itemElement+"/>").addClass(this.options.itemClass).append(b)),this.trigger("prepared",{content:c.data}),c.data},e.prototype.update=function(){for(var b=0,c=this._pipe.length,d=a.proxy(function(a){return this[a]},this._invalidated),e={};b<c;)(this._invalidated.all||a.grep(this._pipe[b].filter,d).length>0)&&this._pipe[b].run(e),b++;this._invalidated={},!this.is("valid")&&this.enter("valid")},e.prototype.width=function(a){switch(a=a||e.Width.Default){case e.Width.Inner:case e.Width.Outer:return this._width;default:return this._width-2*this.settings.stagePadding+this.settings.margin}},e.prototype.refresh=function(){this.enter("refreshing"),this.trigger("refresh"),this.setup(),this.optionsLogic(),this.$element.addClass(this.options.refreshClass),this.update(),this.$element.removeClass(this.options.refreshClass),this.leave("refreshing"),this.trigger("refreshed")},e.prototype.onThrottledResize=function(){b.clearTimeout(this.resizeTimer),this.resizeTimer=b.setTimeout(this._handlers.onResize,this.settings.responsiveRefreshRate)},e.prototype.onResize=function(){return!!this._items.length&&(this._width!==this.$element.width()&&(!!this.isVisible()&&(this.enter("resizing"),this.trigger("resize").isDefaultPrevented()?(this.leave("resizing"),!1):(this.invalidate("width"),this.refresh(),this.leave("resizing"),void this.trigger("resized")))))},e.prototype.registerEventHandlers=function(){a.support.transition&&this.$stage.on(a.support.transition.end+".owl.core",a.proxy(this.onTransitionEnd,this)),!1!==this.settings.responsive&&this.on(b,"resize",this._handlers.onThrottledResize),this.settings.mouseDrag&&(this.$element.addClass(this.options.dragClass),this.$stage.on("mousedown.owl.core",a.proxy(this.onDragStart,this)),this.$stage.on("dragstart.owl.core selectstart.owl.core",function(){return!1})),this.settings.touchDrag&&(this.$stage.on("touchstart.owl.core",a.proxy(this.onDragStart,this)),this.$stage.on("touchcancel.owl.core",a.proxy(this.onDragEnd,this)))},e.prototype.onDragStart=function(b){var d=null;3!==b.which&&(a.support.transform?(d=this.$stage.css("transform").replace(/.*\(|\)| /g,"").split(","),d={x:d[16===d.length?12:4],y:d[16===d.length?13:5]}):(d=this.$stage.position(),d={x:this.settings.rtl?d.left+this.$stage.width()-this.width()+this.settings.margin:d.left,y:d.top}),this.is("animating")&&(a.support.transform?this.animate(d.x):this.$stage.stop(),this.invalidate("position")),this.$element.toggleClass(this.options.grabClass,"mousedown"===b.type),this.speed(0),this._drag.time=(new Date).getTime(),this._drag.target=a(b.target),this._drag.stage.start=d,this._drag.stage.current=d,this._drag.pointer=this.pointer(b),a(c).on("mouseup.owl.core touchend.owl.core",a.proxy(this.onDragEnd,this)),a(c).one("mousemove.owl.core touchmove.owl.core",a.proxy(function(b){var d=this.difference(this._drag.pointer,this.pointer(b));a(c).on("mousemove.owl.core touchmove.owl.core",a.proxy(this.onDragMove,this)),Math.abs(d.x)<Math.abs(d.y)&&this.is("valid")||(b.preventDefault(),this.enter("dragging"),this.trigger("drag"))},this)))},e.prototype.onDragMove=function(a){var b=null,c=null,d=null,e=this.difference(this._drag.pointer,this.pointer(a)),f=this.difference(this._drag.stage.start,e);this.is("dragging")&&(a.preventDefault(),this.settings.loop?(b=this.coordinates(this.minimum()),c=this.coordinates(this.maximum()+1)-b,f.x=((f.x-b)%c+c)%c+b):(b=this.settings.rtl?this.coordinates(this.maximum()):this.coordinates(this.minimum()),c=this.settings.rtl?this.coordinates(this.minimum()):this.coordinates(this.maximum()),d=this.settings.pullDrag?-1*e.x/5:0,f.x=Math.max(Math.min(f.x,b+d),c+d)),this._drag.stage.current=f,this.animate(f.x))},e.prototype.onDragEnd=function(b){var d=this.difference(this._drag.pointer,this.pointer(b)),e=this._drag.stage.current,f=d.x>0^this.settings.rtl?"left":"right";a(c).off(".owl.core"),this.$element.removeClass(this.options.grabClass),(0!==d.x&&this.is("dragging")||!this.is("valid"))&&(this.speed(this.settings.dragEndSpeed||this.settings.smartSpeed),this.current(this.closest(e.x,0!==d.x?f:this._drag.direction)),this.invalidate("position"),this.update(),this._drag.direction=f,(Math.abs(d.x)>3||(new Date).getTime()-this._drag.time>300)&&this._drag.target.one("click.owl.core",function(){return!1})),this.is("dragging")&&(this.leave("dragging"),this.trigger("dragged"))},e.prototype.closest=function(b,c){var e=-1,f=30,g=this.width(),h=this.coordinates();return this.settings.freeDrag||a.each(h,a.proxy(function(a,i){return"left"===c&&b>i-f&&b<i+f?e=a:"right"===c&&b>i-g-f&&b<i-g+f?e=a+1:this.op(b,"<",i)&&this.op(b,">",h[a+1]!==d?h[a+1]:i-g)&&(e="left"===c?a+1:a),-1===e},this)),this.settings.loop||(this.op(b,">",h[this.minimum()])?e=b=this.minimum():this.op(b,"<",h[this.maximum()])&&(e=b=this.maximum())),e},e.prototype.animate=function(b){var c=this.speed()>0;this.is("animating")&&this.onTransitionEnd(),c&&(this.enter("animating"),this.trigger("translate")),a.support.transform3d&&a.support.transition?this.$stage.css({transform:"translate3d("+b+"px,0px,0px)",transition:this.speed()/1e3+"s"}):c?this.$stage.animate({left:b+"px"},this.speed(),this.settings.fallbackEasing,a.proxy(this.onTransitionEnd,this)):this.$stage.css({left:b+"px"})},e.prototype.is=function(a){return this._states.current[a]&&this._states.current[a]>0},e.prototype.current=function(a){if(a===d)return this._current;if(0===this._items.length)return d;if(a=this.normalize(a),this._current!==a){var b=this.trigger("change",{property:{name:"position",value:a}});b.data!==d&&(a=this.normalize(b.data)),this._current=a,this.invalidate("position"),this.trigger("changed",{property:{name:"position",value:this._current}})}return this._current},e.prototype.invalidate=function(b){return"string"===a.type(b)&&(this._invalidated[b]=!0,this.is("valid")&&this.leave("valid")),a.map(this._invalidated,function(a,b){return b})},e.prototype.reset=function(a){(a=this.normalize(a))!==d&&(this._speed=0,this._current=a,this.suppress(["translate","translated"]),this.animate(this.coordinates(a)),this.release(["translate","translated"]))},e.prototype.normalize=function(a,b){var c=this._items.length,e=b?0:this._clones.length;return!this.isNumeric(a)||c<1?a=d:(a<0||a>=c+e)&&(a=((a-e/2)%c+c)%c+e/2),a},e.prototype.relative=function(a){return a-=this._clones.length/2,this.normalize(a,!0)},e.prototype.maximum=function(a){var b,c,d,e=this.settings,f=this._coordinates.length;if(e.loop)f=this._clones.length/2+this._items.length-1;else if(e.autoWidth||e.merge){if(b=this._items.length)for(c=this._items[--b].width(),d=this.$element.width();b--&&!((c+=this._items[b].width()+this.settings.margin)>d););f=b+1}else f=e.center?this._items.length-1:this._items.length-e.items;return a&&(f-=this._clones.length/2),Math.max(f,0)},e.prototype.minimum=function(a){return a?0:this._clones.length/2},e.prototype.items=function(a){return a===d?this._items.slice():(a=this.normalize(a,!0),this._items[a])},e.prototype.mergers=function(a){return a===d?this._mergers.slice():(a=this.normalize(a,!0),this._mergers[a])},e.prototype.clones=function(b){var c=this._clones.length/2,e=c+this._items.length,f=function(a){return a%2==0?e+a/2:c-(a+1)/2};return b===d?a.map(this._clones,function(a,b){return f(b)}):a.map(this._clones,function(a,c){return a===b?f(c):null})},e.prototype.speed=function(a){return a!==d&&(this._speed=a),this._speed},e.prototype.coordinates=function(b){var c,e=1,f=b-1;return b===d?a.map(this._coordinates,a.proxy(function(a,b){return this.coordinates(b)},this)):(this.settings.center?(this.settings.rtl&&(e=-1,f=b+1),c=this._coordinates[b],c+=(this.width()-c+(this._coordinates[f]||0))/2*e):c=this._coordinates[f]||0,c=Math.ceil(c))},e.prototype.duration=function(a,b,c){return 0===c?0:Math.min(Math.max(Math.abs(b-a),1),6)*Math.abs(c||this.settings.smartSpeed)},e.prototype.to=function(a,b){var c=this.current(),d=null,e=a-this.relative(c),f=(e>0)-(e<0),g=this._items.length,h=this.minimum(),i=this.maximum();this.settings.loop?(!this.settings.rewind&&Math.abs(e)>g/2&&(e+=-1*f*g),a=c+e,(d=((a-h)%g+g)%g+h)!==a&&d-e<=i&&d-e>0&&(c=d-e,a=d,this.reset(c))):this.settings.rewind?(i+=1,a=(a%i+i)%i):a=Math.max(h,Math.min(i,a)),this.speed(this.duration(c,a,b)),this.current(a),this.isVisible()&&this.update()},e.prototype.next=function(a){a=a||!1,this.to(this.relative(this.current())+1,a)},e.prototype.prev=function(a){a=a||!1,this.to(this.relative(this.current())-1,a)},e.prototype.onTransitionEnd=function(a){if(a!==d&&(a.stopPropagation(),(a.target||a.srcElement||a.originalTarget)!==this.$stage.get(0)))return!1;this.leave("animating"),this.trigger("translated")},e.prototype.viewport=function(){var d;return this.options.responsiveBaseElement!==b?d=a(this.options.responsiveBaseElement).width():b.innerWidth?d=b.innerWidth:c.documentElement&&c.documentElement.clientWidth?d=c.documentElement.clientWidth:console.warn("Can not detect viewport width."),d},e.prototype.replace=function(b){this.$stage.empty(),this._items=[],b&&(b=b instanceof jQuery?b:a(b)),this.settings.nestedItemSelector&&(b=b.find("."+this.settings.nestedItemSelector)),b.filter(function(){return 1===this.nodeType}).each(a.proxy(function(a,b){b=this.prepare(b),this.$stage.append(b),this._items.push(b),this._mergers.push(1*b.find("[data-merge]").addBack("[data-merge]").attr("data-merge")||1)},this)),this.reset(this.isNumeric(this.settings.startPosition)?this.settings.startPosition:0),this.invalidate("items")},e.prototype.add=function(b,c){var e=this.relative(this._current);c=c===d?this._items.length:this.normalize(c,!0),b=b instanceof jQuery?b:a(b),this.trigger("add",{content:b,position:c}),b=this.prepare(b),0===this._items.length||c===this._items.length?(0===this._items.length&&this.$stage.append(b),0!==this._items.length&&this._items[c-1].after(b),this._items.push(b),this._mergers.push(1*b.find("[data-merge]").addBack("[data-merge]").attr("data-merge")||1)):(this._items[c].before(b),this._items.splice(c,0,b),this._mergers.splice(c,0,1*b.find("[data-merge]").addBack("[data-merge]").attr("data-merge")||1)),this._items[e]&&this.reset(this._items[e].index()),this.invalidate("items"),this.trigger("added",{content:b,position:c})},e.prototype.remove=function(a){(a=this.normalize(a,!0))!==d&&(this.trigger("remove",{content:this._items[a],position:a}),this._items[a].remove(),this._items.splice(a,1),this._mergers.splice(a,1),this.invalidate("items"),this.trigger("removed",{content:null,position:a}))},e.prototype.preloadAutoWidthImages=function(b){b.each(a.proxy(function(b,c){this.enter("pre-loading"),c=a(c),a(new Image).one("load",a.proxy(function(a){c.attr("src",a.target.src),c.css("opacity",1),this.leave("pre-loading"),!this.is("pre-loading")&&!this.is("initializing")&&this.refresh()},this)).attr("src",c.attr("src")||c.attr("data-src")||c.attr("data-src-retina"))},this))},e.prototype.destroy=function(){this.$element.off(".owl.core"),this.$stage.off(".owl.core"),a(c).off(".owl.core"),!1!==this.settings.responsive&&(b.clearTimeout(this.resizeTimer),this.off(b,"resize",this._handlers.onThrottledResize));for(var d in this._plugins)this._plugins[d].destroy();this.$stage.children(".cloned").remove(),this.$stage.unwrap(),this.$stage.children().contents().unwrap(),this.$stage.children().unwrap(),this.$stage.remove(),this.$element.removeClass(this.options.refreshClass).removeClass(this.options.loadingClass).removeClass(this.options.loadedClass).removeClass(this.options.rtlClass).removeClass(this.options.dragClass).removeClass(this.options.grabClass).attr("class",this.$element.attr("class").replace(new RegExp(this.options.responsiveClass+"-\\S+\\s","g"),"")).removeData("owl.carousel")},e.prototype.op=function(a,b,c){var d=this.settings.rtl;switch(b){case"<":return d?a>c:a<c;case">":return d?a<c:a>c;case">=":return d?a<=c:a>=c;case"<=":return d?a>=c:a<=c}},e.prototype.on=function(a,b,c,d){a.addEventListener?a.addEventListener(b,c,d):a.attachEvent&&a.attachEvent("on"+b,c)},e.prototype.off=function(a,b,c,d){a.removeEventListener?a.removeEventListener(b,c,d):a.detachEvent&&a.detachEvent("on"+b,c)},e.prototype.trigger=function(b,c,d,f,g){var h={item:{count:this._items.length,index:this.current()}},i=a.camelCase(a.grep(["on",b,d],function(a){return a}).join("-").toLowerCase()),j=a.Event([b,"owl",d||"carousel"].join(".").toLowerCase(),a.extend({relatedTarget:this},h,c));return this._supress[b]||(a.each(this._plugins,function(a,b){b.onTrigger&&b.onTrigger(j)}),this.register({type:e.Type.Event,name:b}),this.$element.trigger(j),this.settings&&"function"==typeof this.settings[i]&&this.settings[i].call(this,j)),j},e.prototype.enter=function(b){a.each([b].concat(this._states.tags[b]||[]),a.proxy(function(a,b){this._states.current[b]===d&&(this._states.current[b]=0),this._states.current[b]++},this))},e.prototype.leave=function(b){a.each([b].concat(this._states.tags[b]||[]),a.proxy(function(a,b){this._states.current[b]--},this))},e.prototype.register=function(b){if(b.type===e.Type.Event){if(a.event.special[b.name]||(a.event.special[b.name]={}),!a.event.special[b.name].owl){var c=a.event.special[b.name]._default;a.event.special[b.name]._default=function(a){return!c||!c.apply||a.namespace&&-1!==a.namespace.indexOf("owl")?a.namespace&&a.namespace.indexOf("owl")>-1:c.apply(this,arguments)},a.event.special[b.name].owl=!0}}else b.type===e.Type.State&&(this._states.tags[b.name]?this._states.tags[b.name]=this._states.tags[b.name].concat(b.tags):this._states.tags[b.name]=b.tags,this._states.tags[b.name]=a.grep(this._states.tags[b.name],a.proxy(function(c,d){return a.inArray(c,this._states.tags[b.name])===d},this)))},e.prototype.suppress=function(b){a.each(b,a.proxy(function(a,b){this._supress[b]=!0},this))},e.prototype.release=function(b){a.each(b,a.proxy(function(a,b){delete this._supress[b]},this))},e.prototype.pointer=function(a){var c={x:null,y:null};return a=a.originalEvent||a||b.event,a=a.touches&&a.touches.length?a.touches[0]:a.changedTouches&&a.changedTouches.length?a.changedTouches[0]:a,a.pageX?(c.x=a.pageX,c.y=a.pageY):(c.x=a.clientX,c.y=a.clientY),c},e.prototype.isNumeric=function(a){return!isNaN(parseFloat(a))},e.prototype.difference=function(a,b){return{x:a.x-b.x,y:a.y-b.y}},a.fn.owlCarousel=function(b){var c=Array.prototype.slice.call(arguments,1);return this.each(function(){var d=a(this),f=d.data("owl.carousel");f||(f=new e(this,"object"==typeof b&&b),d.data("owl.carousel",f),a.each(["next","prev","to","destroy","refresh","replace","add","remove"],function(b,c){f.register({type:e.Type.Event,name:c}),f.$element.on(c+".owl.carousel.core",a.proxy(function(a){a.namespace&&a.relatedTarget!==this&&(this.suppress([c]),f[c].apply(this,[].slice.call(arguments,1)),this.release([c]))},f))})),"string"==typeof b&&"_"!==b.charAt(0)&&f[b].apply(f,c)})},a.fn.owlCarousel.Constructor=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(b){this._core=b,this._interval=null,this._visible=null,this._handlers={"initialized.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.autoRefresh&&this.watch()},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this._core.$element.on(this._handlers)};e.Defaults={autoRefresh:!0,autoRefreshInterval:500},e.prototype.watch=function(){this._interval||(this._visible=this._core.isVisible(),this._interval=b.setInterval(a.proxy(this.refresh,this),this._core.settings.autoRefreshInterval))},e.prototype.refresh=function(){this._core.isVisible()!==this._visible&&(this._visible=!this._visible,this._core.$element.toggleClass("owl-hidden",!this._visible),this._visible&&this._core.invalidate("width")&&this._core.refresh())},e.prototype.destroy=function(){var a,c;b.clearInterval(this._interval);for(a in this._handlers)this._core.$element.off(a,this._handlers[a]);for(c in Object.getOwnPropertyNames(this))"function"!=typeof this[c]&&(this[c]=null)},a.fn.owlCarousel.Constructor.Plugins.AutoRefresh=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(b){this._core=b,this._loaded=[],this._handlers={"initialized.owl.carousel change.owl.carousel resized.owl.carousel":a.proxy(function(b){if(b.namespace&&this._core.settings&&this._core.settings.lazyLoad&&(b.property&&"position"==b.property.name||"initialized"==b.type))for(var c=this._core.settings,e=c.center&&Math.ceil(c.items/2)||c.items,f=c.center&&-1*e||0,g=(b.property&&b.property.value!==d?b.property.value:this._core.current())+f,h=this._core.clones().length,i=a.proxy(function(a,b){this.load(b)},this);f++<e;)this.load(h/2+this._core.relative(g)),h&&a.each(this._core.clones(this._core.relative(g)),i),g++},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this._core.$element.on(this._handlers)};e.Defaults={lazyLoad:!1},e.prototype.load=function(c){var d=this._core.$stage.children().eq(c),e=d&&d.find(".owl-lazy");!e||a.inArray(d.get(0),this._loaded)>-1||(e.each(a.proxy(function(c,d){var e,f=a(d),g=b.devicePixelRatio>1&&f.attr("data-src-retina")||f.attr("data-src")||f.attr("data-srcset");this._core.trigger("load",{element:f,url:g},"lazy"),f.is("img")?f.one("load.owl.lazy",a.proxy(function(){f.css("opacity",1),this._core.trigger("loaded",{element:f,url:g},"lazy")},this)).attr("src",g):f.is("source")?f.one("load.owl.lazy",a.proxy(function(){this._core.trigger("loaded",{element:f,url:g},"lazy")},this)).attr("srcset",g):(e=new Image,e.onload=a.proxy(function(){f.css({"background-image":'url("'+g+'")',opacity:"1"}),this._core.trigger("loaded",{element:f,url:g},"lazy")},this),e.src=g)},this)),this._loaded.push(d.get(0)))},e.prototype.destroy=function(){var a,b;for(a in this.handlers)this._core.$element.off(a,this.handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.owlCarousel.Constructor.Plugins.Lazy=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(c){this._core=c,this._handlers={"initialized.owl.carousel refreshed.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.autoHeight&&this.update()},this),"changed.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.autoHeight&&"position"===a.property.name&&(console.log("update called"),this.update())},this),"loaded.owl.lazy":a.proxy(function(a){a.namespace&&this._core.settings.autoHeight&&a.element.closest("."+this._core.settings.itemClass).index()===this._core.current()&&this.update()},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this._core.$element.on(this._handlers),this._intervalId=null;var d=this;a(b).on("load",function(){d._core.settings.autoHeight&&d.update()}),a(b).resize(function(){d._core.settings.autoHeight&&(null!=d._intervalId&&clearTimeout(d._intervalId),d._intervalId=setTimeout(function(){d.update()},250))})};e.Defaults={autoHeight:!1,autoHeightClass:"owl-height"},e.prototype.update=function(){var b=this._core._current,c=b+this._core.settings.items,d=this._core.$stage.children().toArray().slice(b,c),e=[],f=0;a.each(d,function(b,c){e.push(a(c).height())}),f=Math.max.apply(null,e),this._core.$stage.parent().height(f).addClass(this._core.settings.autoHeightClass)},e.prototype.destroy=function(){var a,b;for(a in this._handlers)this._core.$element.off(a,this._handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.owlCarousel.Constructor.Plugins.AutoHeight=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(b){this._core=b,this._videos={},this._playing=null,this._handlers={"initialized.owl.carousel":a.proxy(function(a){a.namespace&&this._core.register({type:"state",name:"playing",tags:["interacting"]})},this),"resize.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.video&&this.isInFullScreen()&&a.preventDefault()},this),"refreshed.owl.carousel":a.proxy(function(a){a.namespace&&this._core.is("resizing")&&this._core.$stage.find(".cloned .owl-video-frame").remove()},this),"changed.owl.carousel":a.proxy(function(a){a.namespace&&"position"===a.property.name&&this._playing&&this.stop()},this),"prepared.owl.carousel":a.proxy(function(b){if(b.namespace){var c=a(b.content).find(".owl-video");c.length&&(c.css("display","none"),this.fetch(c,a(b.content)))}},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this._core.$element.on(this._handlers),this._core.$element.on("click.owl.video",".owl-video-play-icon",a.proxy(function(a){this.play(a)},this))};e.Defaults={video:!1,videoHeight:!1,videoWidth:!1},e.prototype.fetch=function(a,b){var c=function(){return a.attr("data-vimeo-id")?"vimeo":a.attr("data-vzaar-id")?"vzaar":"youtube"}(),d=a.attr("data-vimeo-id")||a.attr("data-youtube-id")||a.attr("data-vzaar-id"),e=a.attr("data-width")||this._core.settings.videoWidth,f=a.attr("data-height")||this._core.settings.videoHeight,g=a.attr("href");if(!g)throw new Error("Missing video URL.");if(d=g.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com|be\-nocookie\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/),d[3].indexOf("youtu")>-1)c="youtube";else if(d[3].indexOf("vimeo")>-1)c="vimeo";else{if(!(d[3].indexOf("vzaar")>-1))throw new Error("Video URL not supported.");c="vzaar"}d=d[6],this._videos[g]={type:c,id:d,width:e,height:f},b.attr("data-video",g),this.thumbnail(a,this._videos[g])},e.prototype.thumbnail=function(b,c){var d,e,f,g=c.width&&c.height?'style="width:'+c.width+"px;height:"+c.height+'px;"':"",h=b.find("img"),i="src",j="",k=this._core.settings,l=function(a){e='<div class="owl-video-play-icon"></div>',d=k.lazyLoad?'<div class="owl-video-tn '+j+'" '+i+'="'+a+'"></div>':'<div class="owl-video-tn" style="opacity:1;background-image:url('+a+')"></div>',b.after(d),b.after(e)};if(b.wrap('<div class="owl-video-wrapper"'+g+"></div>"),this._core.settings.lazyLoad&&(i="data-src",j="owl-lazy"),h.length)return l(h.attr(i)),h.remove(),!1;"youtube"===c.type?(f="//img.youtube.com/vi/"+c.id+"/hqdefault.jpg",l(f)):"vimeo"===c.type?a.ajax({type:"GET",url:"//vimeo.com/api/v2/video/"+c.id+".json",jsonp:"callback",dataType:"jsonp",success:function(a){f=a[0].thumbnail_large,l(f)}}):"vzaar"===c.type&&a.ajax({type:"GET",url:"//vzaar.com/api/videos/"+c.id+".json",jsonp:"callback",dataType:"jsonp",success:function(a){f=a.framegrab_url,l(f)}})},e.prototype.stop=function(){this._core.trigger("stop",null,"video"),this._playing.find(".owl-video-frame").remove(),this._playing.removeClass("owl-video-playing"),this._playing=null,this._core.leave("playing"),this._core.trigger("stopped",null,"video")},e.prototype.play=function(b){var c,d=a(b.target),e=d.closest("."+this._core.settings.itemClass),f=this._videos[e.attr("data-video")],g=f.width||"100%",h=f.height||this._core.$stage.height();this._playing||(this._core.enter("playing"),this._core.trigger("play",null,"video"),e=this._core.items(this._core.relative(e.index())),this._core.reset(e.index()),"youtube"===f.type?c='<iframe width="'+g+'" height="'+h+'" src="//www.youtube.com/embed/'+f.id+"?autoplay=1&rel=0&v="+f.id+'" frameborder="0" allowfullscreen></iframe>':"vimeo"===f.type?c='<iframe src="//player.vimeo.com/video/'+f.id+'?autoplay=1" width="'+g+'" height="'+h+'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>':"vzaar"===f.type&&(c='<iframe frameborder="0"height="'+h+'"width="'+g+'" allowfullscreen mozallowfullscreen webkitAllowFullScreen src="//view.vzaar.com/'+f.id+'/player?autoplay=true"></iframe>'),a('<div class="owl-video-frame">'+c+"</div>").insertAfter(e.find(".owl-video")),this._playing=e.addClass("owl-video-playing"))},e.prototype.isInFullScreen=function(){var b=c.fullscreenElement||c.mozFullScreenElement||c.webkitFullscreenElement;return b&&a(b).parent().hasClass("owl-video-frame")},e.prototype.destroy=function(){var a,b;this._core.$element.off("click.owl.video");for(a in this._handlers)this._core.$element.off(a,this._handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.owlCarousel.Constructor.Plugins.Video=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(b){this.core=b,this.core.options=a.extend({},e.Defaults,this.core.options),this.swapping=!0,this.previous=d,this.next=d,this.handlers={"change.owl.carousel":a.proxy(function(a){a.namespace&&"position"==a.property.name&&(this.previous=this.core.current(),this.next=a.property.value)},this),"drag.owl.carousel dragged.owl.carousel translated.owl.carousel":a.proxy(function(a){a.namespace&&(this.swapping="translated"==a.type)},this),"translate.owl.carousel":a.proxy(function(a){a.namespace&&this.swapping&&(this.core.options.animateOut||this.core.options.animateIn)&&this.swap()},this)},this.core.$element.on(this.handlers)};e.Defaults={animateOut:!1,animateIn:!1},e.prototype.swap=function(){
if(1===this.core.settings.items&&a.support.animation&&a.support.transition){this.core.speed(0);var b,c=a.proxy(this.clear,this),d=this.core.$stage.children().eq(this.previous),e=this.core.$stage.children().eq(this.next),f=this.core.settings.animateIn,g=this.core.settings.animateOut;this.core.current()!==this.previous&&(g&&(b=this.core.coordinates(this.previous)-this.core.coordinates(this.next),d.one(a.support.animation.end,c).css({left:b+"px"}).addClass("animated owl-animated-out").addClass(g)),f&&e.one(a.support.animation.end,c).addClass("animated owl-animated-in").addClass(f))}},e.prototype.clear=function(b){a(b.target).css({left:""}).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut),this.core.onTransitionEnd()},e.prototype.destroy=function(){var a,b;for(a in this.handlers)this.core.$element.off(a,this.handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.owlCarousel.Constructor.Plugins.Animate=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){var e=function(b){this._core=b,this._call=null,this._time=0,this._timeout=0,this._paused=!0,this._handlers={"changed.owl.carousel":a.proxy(function(a){a.namespace&&"settings"===a.property.name?this._core.settings.autoplay?this.play():this.stop():a.namespace&&"position"===a.property.name&&this._paused&&(this._time=0)},this),"initialized.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.autoplay&&this.play()},this),"play.owl.autoplay":a.proxy(function(a,b,c){a.namespace&&this.play(b,c)},this),"stop.owl.autoplay":a.proxy(function(a){a.namespace&&this.stop()},this),"mouseover.owl.autoplay":a.proxy(function(){this._core.settings.autoplayHoverPause&&this._core.is("rotating")&&this.pause()},this),"mouseleave.owl.autoplay":a.proxy(function(){this._core.settings.autoplayHoverPause&&this._core.is("rotating")&&this.play()},this),"touchstart.owl.core":a.proxy(function(){this._core.settings.autoplayHoverPause&&this._core.is("rotating")&&this.pause()},this),"touchend.owl.core":a.proxy(function(){this._core.settings.autoplayHoverPause&&this.play()},this)},this._core.$element.on(this._handlers),this._core.options=a.extend({},e.Defaults,this._core.options)};e.Defaults={autoplay:!1,autoplayTimeout:5e3,autoplayHoverPause:!1,autoplaySpeed:!1},e.prototype._next=function(d){this._call=b.setTimeout(a.proxy(this._next,this,d),this._timeout*(Math.round(this.read()/this._timeout)+1)-this.read()),this._core.is("interacting")||c.hidden||this._core.next(d||this._core.settings.autoplaySpeed)},e.prototype.read=function(){return(new Date).getTime()-this._time},e.prototype.play=function(c,d){var e;this._core.is("rotating")||this._core.enter("rotating"),c=c||this._core.settings.autoplayTimeout,e=Math.min(this._time%(this._timeout||c),c),this._paused?(this._time=this.read(),this._paused=!1):b.clearTimeout(this._call),this._time+=this.read()%c-e,this._timeout=c,this._call=b.setTimeout(a.proxy(this._next,this,d),c-e)},e.prototype.stop=function(){this._core.is("rotating")&&(this._time=0,this._paused=!0,b.clearTimeout(this._call),this._core.leave("rotating"))},e.prototype.pause=function(){this._core.is("rotating")&&!this._paused&&(this._time=this.read(),this._paused=!0,b.clearTimeout(this._call))},e.prototype.destroy=function(){var a,b;this.stop();for(a in this._handlers)this._core.$element.off(a,this._handlers[a]);for(b in Object.getOwnPropertyNames(this))"function"!=typeof this[b]&&(this[b]=null)},a.fn.owlCarousel.Constructor.Plugins.autoplay=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){"use strict";var e=function(b){this._core=b,this._initialized=!1,this._pages=[],this._controls={},this._templates=[],this.$element=this._core.$element,this._overrides={next:this._core.next,prev:this._core.prev,to:this._core.to},this._handlers={"prepared.owl.carousel":a.proxy(function(b){b.namespace&&this._core.settings.dotsData&&this._templates.push('<div class="'+this._core.settings.dotClass+'">'+a(b.content).find("[data-dot]").addBack("[data-dot]").attr("data-dot")+"</div>")},this),"added.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.dotsData&&this._templates.splice(a.position,0,this._templates.pop())},this),"remove.owl.carousel":a.proxy(function(a){a.namespace&&this._core.settings.dotsData&&this._templates.splice(a.position,1)},this),"changed.owl.carousel":a.proxy(function(a){a.namespace&&"position"==a.property.name&&this.draw()},this),"initialized.owl.carousel":a.proxy(function(a){a.namespace&&!this._initialized&&(this._core.trigger("initialize",null,"navigation"),this.initialize(),this.update(),this.draw(),this._initialized=!0,this._core.trigger("initialized",null,"navigation"))},this),"refreshed.owl.carousel":a.proxy(function(a){a.namespace&&this._initialized&&(this._core.trigger("refresh",null,"navigation"),this.update(),this.draw(),this._core.trigger("refreshed",null,"navigation"))},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this.$element.on(this._handlers)};e.Defaults={nav:!1,navText:['<span aria-label="Previous">&#x2039;</span>','<span aria-label="Next">&#x203a;</span>'],navSpeed:!1,navElement:'button type="button" role="presentation"',navContainer:!1,navContainerClass:"owl-nav",navClass:["owl-prev","owl-next"],slideBy:1,dotClass:"owl-dot",dotsClass:"owl-dots",dots:!0,dotsEach:!1,dotsData:!1,dotsSpeed:!1,dotsContainer:!1},e.prototype.initialize=function(){var b,c=this._core.settings;this._controls.$relative=(c.navContainer?a(c.navContainer):a("<div>").addClass(c.navContainerClass).appendTo(this.$element)).addClass("disabled"),this._controls.$previous=a("<"+c.navElement+">").addClass(c.navClass[0]).html(c.navText[0]).prependTo(this._controls.$relative).on("click",a.proxy(function(a){this.prev(c.navSpeed)},this)),this._controls.$next=a("<"+c.navElement+">").addClass(c.navClass[1]).html(c.navText[1]).appendTo(this._controls.$relative).on("click",a.proxy(function(a){this.next(c.navSpeed)},this)),c.dotsData||(this._templates=[a('<button role="button">').addClass(c.dotClass).append(a("<span>")).prop("outerHTML")]),this._controls.$absolute=(c.dotsContainer?a(c.dotsContainer):a("<div>").addClass(c.dotsClass).appendTo(this.$element)).addClass("disabled"),this._controls.$absolute.on("click","button",a.proxy(function(b){var d=a(b.target).parent().is(this._controls.$absolute)?a(b.target).index():a(b.target).parent().index();b.preventDefault(),this.to(d,c.dotsSpeed)},this));for(b in this._overrides)this._core[b]=a.proxy(this[b],this)},e.prototype.destroy=function(){var a,b,c,d,e;e=this._core.settings;for(a in this._handlers)this.$element.off(a,this._handlers[a]);for(b in this._controls)"$relative"===b&&e.navContainer?this._controls[b].html(""):this._controls[b].remove();for(d in this.overides)this._core[d]=this._overrides[d];for(c in Object.getOwnPropertyNames(this))"function"!=typeof this[c]&&(this[c]=null)},e.prototype.update=function(){var a,b,c,d=this._core.clones().length/2,e=d+this._core.items().length,f=this._core.maximum(!0),g=this._core.settings,h=g.center||g.autoWidth||g.dotsData?1:g.dotsEach||g.items;if("page"!==g.slideBy&&(g.slideBy=Math.min(g.slideBy,g.items)),g.dots||"page"==g.slideBy)for(this._pages=[],a=d,b=0,c=0;a<e;a++){if(b>=h||0===b){if(this._pages.push({start:Math.min(f,a-d),end:a-d+h-1}),Math.min(f,a-d)===f)break;b=0,++c}b+=this._core.mergers(this._core.relative(a))}},e.prototype.draw=function(){var b,c=this._core.settings,d=this._core.items().length<=c.items,e=this._core.relative(this._core.current()),f=c.loop||c.rewind;this._controls.$relative.toggleClass("disabled",!c.nav||d),c.nav&&(this._controls.$previous.toggleClass("disabled",!f&&e<=this._core.minimum(!0)),this._controls.$next.toggleClass("disabled",!f&&e>=this._core.maximum(!0))),this._controls.$absolute.toggleClass("disabled",!c.dots||d),c.dots&&(b=this._pages.length-this._controls.$absolute.children().length,c.dotsData&&0!==b?this._controls.$absolute.html(this._templates.join("")):b>0?this._controls.$absolute.append(new Array(b+1).join(this._templates[0])):b<0&&this._controls.$absolute.children().slice(b).remove(),this._controls.$absolute.find(".active").removeClass("active"),this._controls.$absolute.children().eq(a.inArray(this.current(),this._pages)).addClass("active"))},e.prototype.onTrigger=function(b){var c=this._core.settings;b.page={index:a.inArray(this.current(),this._pages),count:this._pages.length,size:c&&(c.center||c.autoWidth||c.dotsData?1:c.dotsEach||c.items)}},e.prototype.current=function(){var b=this._core.relative(this._core.current());return a.grep(this._pages,a.proxy(function(a,c){return a.start<=b&&a.end>=b},this)).pop()},e.prototype.getPosition=function(b){var c,d,e=this._core.settings;return"page"==e.slideBy?(c=a.inArray(this.current(),this._pages),d=this._pages.length,b?++c:--c,c=this._pages[(c%d+d)%d].start):(c=this._core.relative(this._core.current()),d=this._core.items().length,b?c+=e.slideBy:c-=e.slideBy),c},e.prototype.next=function(b){a.proxy(this._overrides.to,this._core)(this.getPosition(!0),b)},e.prototype.prev=function(b){a.proxy(this._overrides.to,this._core)(this.getPosition(!1),b)},e.prototype.to=function(b,c,d){var e;!d&&this._pages.length?(e=this._pages.length,a.proxy(this._overrides.to,this._core)(this._pages[(b%e+e)%e].start,c)):a.proxy(this._overrides.to,this._core)(b,c)},a.fn.owlCarousel.Constructor.Plugins.Navigation=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){"use strict";var e=function(c){this._core=c,this._hashes={},this.$element=this._core.$element,this._handlers={"initialized.owl.carousel":a.proxy(function(c){c.namespace&&"URLHash"===this._core.settings.startPosition&&a(b).trigger("hashchange.owl.navigation")},this),"prepared.owl.carousel":a.proxy(function(b){if(b.namespace){var c=a(b.content).find("[data-hash]").addBack("[data-hash]").attr("data-hash");if(!c)return;this._hashes[c]=b.content}},this),"changed.owl.carousel":a.proxy(function(c){if(c.namespace&&"position"===c.property.name){var d=this._core.items(this._core.relative(this._core.current())),e=a.map(this._hashes,function(a,b){return a===d?b:null}).join();if(!e||b.location.hash.slice(1)===e)return;b.location.hash=e}},this)},this._core.options=a.extend({},e.Defaults,this._core.options),this.$element.on(this._handlers),a(b).on("hashchange.owl.navigation",a.proxy(function(a){var c=b.location.hash.substring(1),e=this._core.$stage.children(),f=this._hashes[c]&&e.index(this._hashes[c]);f!==d&&f!==this._core.current()&&this._core.to(this._core.relative(f),!1,!0)},this))};e.Defaults={URLhashListener:!1},e.prototype.destroy=function(){var c,d;a(b).off("hashchange.owl.navigation");for(c in this._handlers)this._core.$element.off(c,this._handlers[c]);for(d in Object.getOwnPropertyNames(this))"function"!=typeof this[d]&&(this[d]=null)},a.fn.owlCarousel.Constructor.Plugins.Hash=e}(window.Zepto||window.jQuery,window,document),function(a,b,c,d){function e(b,c){var e=!1,f=b.charAt(0).toUpperCase()+b.slice(1);return a.each((b+" "+h.join(f+" ")+f).split(" "),function(a,b){if(g[b]!==d)return e=!c||b,!1}),e}function f(a){return e(a,!0)}var g=a("<support>").get(0).style,h="Webkit Moz O ms".split(" "),i={transition:{end:{WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd",transition:"transitionend"}},animation:{end:{WebkitAnimation:"webkitAnimationEnd",MozAnimation:"animationend",OAnimation:"oAnimationEnd",animation:"animationend"}}},j={csstransforms:function(){return!!e("transform")},csstransforms3d:function(){return!!e("perspective")},csstransitions:function(){return!!e("transition")},cssanimations:function(){return!!e("animation")}};j.csstransitions()&&(a.support.transition=new String(f("transition")),a.support.transition.end=i.transition.end[a.support.transition]),j.cssanimations()&&(a.support.animation=new String(f("animation")),a.support.animation.end=i.animation.end[a.support.animation]),j.csstransforms()&&(a.support.transform=new String(f("transform")),a.support.transform3d=j.csstransforms3d())}(window.Zepto||window.jQuery,window,document),
function(a, b, c, d) {
    var e = function(b) {
        this._core = b, this._interval = null, this._visible = null, this._handlers = {
            "initialized.owl.carousel": a.proxy(function(a) {
                a.namespace && this._core.settings.autoRefresh && this.watch()
            }, this)
        }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers)
    };
    e.Defaults = {
        autoRefresh: !0,
        autoRefreshInterval: 500
    }, e.prototype.watch = function() {
        this._interval || (this._visible = this._core.$element.is(":visible"), this._interval = b.setInterval(a.proxy(this.refresh, this), this._core.settings.autoRefreshInterval))
    }, e.prototype.refresh = function() {
        this._core.$element.is(":visible") !== this._visible && (this._visible = !this._visible, this._core.$element.toggleClass("owl-hidden", !this._visible), this._visible && this._core.invalidate("width") && this._core.refresh())
    }, e.prototype.destroy = function() {
        var a, c;
        b.clearInterval(this._interval);
        for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
        for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] && (this[c] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.AutoRefresh = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
    var e = function(b) {
        this._core = b, this._loaded = [], this._handlers = {
            "initialized.owl.carousel change.owl.carousel resized.owl.carousel": a.proxy(function(b) {
                if (b.namespace && this._core.settings && this._core.settings.lazyLoad && (b.property && "position" == b.property.name || "initialized" == b.type))
                    for (var c = this._core.settings, e = c.center && Math.ceil(c.items / 2) || c.items, f = c.center && -1 * e || 0, g = (b.property && b.property.value !== d ? b.property.value : this._core.current()) + f, h = this._core.clones().length, i = a.proxy(function(a, b) {
                            this.load(b)
                        }, this); f++ < e;) this.load(h / 2 + this._core.relative(g)), h && a.each(this._core.clones(this._core.relative(g)), i), g++
            }, this)
        }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers)
    };
    e.Defaults = {
        lazyLoad: !1
    }, e.prototype.load = function(c) {
        var d = this._core.$stage.children().eq(c),
            e = d && d.find(".owl-lazy");
        !e || a.inArray(d.get(0), this._loaded) > -1 || (e.each(a.proxy(function(c, d) {
            var e, f = a(d),
                g = b.devicePixelRatio > 1 && f.attr("data-src-retina") || f.attr("data-src");
            this._core.trigger("load", {
                element: f,
                url: g
            }, "lazy"), f.is("img") ? f.one("load.owl.lazy", a.proxy(function() {
                f.css("opacity", 1), this._core.trigger("loaded", {
                    element: f,
                    url: g
                }, "lazy")
            }, this)).attr("src", g) : (e = new Image, e.onload = a.proxy(function() {
                f.css({
                    "background-image": "url(" + g + ")",
                    opacity: "1"
                }), this._core.trigger("loaded", {
                    element: f,
                    url: g
                }, "lazy")
            }, this), e.src = g)
        }, this)), this._loaded.push(d.get(0)))
    }, e.prototype.destroy = function() {
        var a, b;
        for (a in this.handlers) this._core.$element.off(a, this.handlers[a]);
        for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.Lazy = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
    var e = function(b) {
        this._core = b, this._handlers = {
            "initialized.owl.carousel refreshed.owl.carousel": a.proxy(function(a) {
                a.namespace && this._core.settings.autoHeight && this.update()
            }, this),
            "changed.owl.carousel": a.proxy(function(a) {
                a.namespace && this._core.settings.autoHeight && "position" == a.property.name && this.update()
            }, this),
            "loaded.owl.lazy": a.proxy(function(a) {
                a.namespace && this._core.settings.autoHeight && a.element.closest("." + this._core.settings.itemClass).index() === this._core.current() && this.update()
            }, this)
        }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers)
    };
    e.Defaults = {
        autoHeight: !1,
        autoHeightClass: "owl-height"
    }, e.prototype.update = function() {
        var b = this._core._current,
            c = b + this._core.settings.items,
            d = this._core.$stage.children().toArray().slice(b, c),
            e = [],
            f = 0;
        a.each(d, function(b, c) {
            e.push(a(c).height())
        }), f = Math.max.apply(null, e), this._core.$stage.parent().height(f).addClass(this._core.settings.autoHeightClass)
    }, e.prototype.destroy = function() {
        var a, b;
        for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
        for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.AutoHeight = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
    var e = function(b) {
        this._core = b, this._videos = {}, this._playing = null, this._handlers = {
            "initialized.owl.carousel": a.proxy(function(a) {
                a.namespace && this._core.register({
                    type: "state",
                    name: "playing",
                    tags: ["interacting"]
                })
            }, this),
            "resize.owl.carousel": a.proxy(function(a) {
                a.namespace && this._core.settings.video && this.isInFullScreen() && a.preventDefault()
            }, this),
            "refreshed.owl.carousel": a.proxy(function(a) {
                a.namespace && this._core.is("resizing") && this._core.$stage.find(".cloned .owl-video-frame").remove()
            }, this),
            "changed.owl.carousel": a.proxy(function(a) {
                a.namespace && "position" === a.property.name && this._playing && this.stop()
            }, this),
            "prepared.owl.carousel": a.proxy(function(b) {
                if (b.namespace) {
                    var c = a(b.content).find(".owl-video");
                    c.length && (c.css("display", "none"), this.fetch(c, a(b.content)))
                }
            }, this)
        }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers), this._core.$element.on("click.owl.video", ".owl-video-play-icon", a.proxy(function(a) {
            this.play(a)
        }, this))
    };
    e.Defaults = {
        video: !1,
        videoHeight: !1,
        videoWidth: !1
    }, e.prototype.fetch = function(a, b) {
        var c = function() {
                return a.attr("data-vimeo-id") ? "vimeo" : a.attr("data-vzaar-id") ? "vzaar" : "youtube"
            }(),
            d = a.attr("data-vimeo-id") || a.attr("data-youtube-id") || a.attr("data-vzaar-id"),
            e = a.attr("data-width") || this._core.settings.videoWidth,
            f = a.attr("data-height") || this._core.settings.videoHeight,
            g = a.attr("href");
        if (!g) throw new Error("Missing video URL.");
        if (d = g.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/), d[3].indexOf("youtu") > -1) c = "youtube";
        else if (d[3].indexOf("vimeo") > -1) c = "vimeo";
        else {
            if (!(d[3].indexOf("vzaar") > -1)) throw new Error("Video URL not supported.");
            c = "vzaar"
        }
        d = d[6], this._videos[g] = {
            type: c,
            id: d,
            width: e,
            height: f
        }, b.attr("data-video", g), this.thumbnail(a, this._videos[g])
    }, e.prototype.thumbnail = function(b, c) {
        var d, e, f, g = c.width && c.height ? 'style="width:' + c.width + "px;height:" + c.height + 'px;"' : "",
            h = b.find("img"),
            i = "src",
            j = "",
            k = this._core.settings,
            l = function(a) {
                e = '<div class="owl-video-play-icon"></div>', d = k.lazyLoad ? '<div class="owl-video-tn ' + j + '" ' + i + '="' + a + '"></div>' : '<div class="owl-video-tn" style="opacity:1;background-image:url(' + a + ')"></div>', b.after(d), b.after(e)
            };
        return b.wrap('<div class="owl-video-wrapper"' + g + "></div>"), this._core.settings.lazyLoad && (i = "data-src", j = "owl-lazy"), h.length ? (l(h.attr(i)), h.remove(), !1) : void("youtube" === c.type ? (f = "//img.youtube.com/vi/" + c.id + "/hqdefault.jpg", l(f)) : "vimeo" === c.type ? a.ajax({
            type: "GET",
            url: "//vimeo.com/api/v2/video/" + c.id + ".json",
            jsonp: "callback",
            dataType: "jsonp",
            success: function(a) {
                f = a[0].thumbnail_large, l(f)
            }
        }) : "vzaar" === c.type && a.ajax({
            type: "GET",
            url: "//vzaar.com/api/videos/" + c.id + ".json",
            jsonp: "callback",
            dataType: "jsonp",
            success: function(a) {
                f = a.framegrab_url, l(f)
            }
        }))
    }, e.prototype.stop = function() {
        this._core.trigger("stop", null, "video"), this._playing.find(".owl-video-frame").remove(), this._playing.removeClass("owl-video-playing"), this._playing = null, this._core.leave("playing"), this._core.trigger("stopped", null, "video")
    }, e.prototype.play = function(b) {
        var c, d = a(b.target),
            e = d.closest("." + this._core.settings.itemClass),
            f = this._videos[e.attr("data-video")],
            g = f.width || "100%",
            h = f.height || this._core.$stage.height();
        this._playing || (this._core.enter("playing"), this._core.trigger("play", null, "video"), e = this._core.items(this._core.relative(e.index())), this._core.reset(e.index()), "youtube" === f.type ? c = '<iframe width="' + g + '" height="' + h + '" src="//www.youtube.com/embed/' + f.id + "?autoplay=1&v=" + f.id + '" frameborder="0" allowfullscreen></iframe>' : "vimeo" === f.type ? c = '<iframe src="//player.vimeo.com/video/' + f.id + '?autoplay=1" width="' + g + '" height="' + h + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' : "vzaar" === f.type && (c = '<iframe frameborder="0"height="' + h + '"width="' + g + '" allowfullscreen mozallowfullscreen webkitAllowFullScreen src="//view.vzaar.com/' + f.id + '/player?autoplay=true"></iframe>'), a('<div class="owl-video-frame">' + c + "</div>").insertAfter(e.find(".owl-video")), this._playing = e.addClass("owl-video-playing"))
    }, e.prototype.isInFullScreen = function() {
        var b = c.fullscreenElement || c.mozFullScreenElement || c.webkitFullscreenElement;
        return b && a(b).parent().hasClass("owl-video-frame")
    }, e.prototype.destroy = function() {
        var a, b;
        this._core.$element.off("click.owl.video");
        for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
        for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.Video = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
    var e = function(b) {
        this.core = b, this.core.options = a.extend({}, e.Defaults, this.core.options), this.swapping = !0, this.previous = d, this.next = d, this.handlers = {
            "change.owl.carousel": a.proxy(function(a) {
                a.namespace && "position" == a.property.name && (this.previous = this.core.current(), this.next = a.property.value)
            }, this),
            "drag.owl.carousel dragged.owl.carousel translated.owl.carousel": a.proxy(function(a) {
                a.namespace && (this.swapping = "translated" == a.type)
            }, this),
            "translate.owl.carousel": a.proxy(function(a) {
                a.namespace && this.swapping && (this.core.options.animateOut || this.core.options.animateIn) && this.swap()
            }, this)
        }, this.core.$element.on(this.handlers)
    };
    e.Defaults = {
        animateOut: !1,
        animateIn: !1
    }, e.prototype.swap = function() {
        if (1 === this.core.settings.items && a.support.animation && a.support.transition) {
            this.core.speed(0);
            var b, c = a.proxy(this.clear, this),
                d = this.core.$stage.children().eq(this.previous),
                e = this.core.$stage.children().eq(this.next),
                f = this.core.settings.animateIn,
                g = this.core.settings.animateOut;
            this.core.current() !== this.previous && (g && (b = this.core.coordinates(this.previous) - this.core.coordinates(this.next), d.one(a.support.animation.end, c).css({
                left: b + "px"
            }).addClass("animated owl-animated-out").addClass(g)), f && e.one(a.support.animation.end, c).addClass("animated owl-animated-in").addClass(f))
        }
    }, e.prototype.clear = function(b) {
        a(b.target).css({
            left: ""
        }).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut), this.core.onTransitionEnd()
    }, e.prototype.destroy = function() {
        var a, b;
        for (a in this.handlers) this.core.$element.off(a, this.handlers[a]);
        for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.Animate = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
    var e = function(b) {
        this._core = b, this._timeout = null, this._paused = !1, this._handlers = {
            "changed.owl.carousel": a.proxy(function(a) {
                a.namespace && "settings" === a.property.name ? this._core.settings.autoplay ? this.play() : this.stop() : a.namespace && "position" === a.property.name && this._core.settings.autoplay && this._setAutoPlayInterval()
            }, this),
            "initialized.owl.carousel": a.proxy(function(a) {
                a.namespace && this._core.settings.autoplay && this.play()
            }, this),
            "play.owl.autoplay": a.proxy(function(a, b, c) {
                a.namespace && this.play(b, c)
            }, this),
            "stop.owl.autoplay": a.proxy(function(a) {
                a.namespace && this.stop()
            }, this),
            "mouseover.owl.autoplay": a.proxy(function() {
                this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause()
            }, this),
            "mouseleave.owl.autoplay": a.proxy(function() {
                this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.play()
            }, this),
            "touchstart.owl.core": a.proxy(function() {
                this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause()
            }, this),
            "touchend.owl.core": a.proxy(function() {
                this._core.settings.autoplayHoverPause && this.play()
            }, this)
        }, this._core.$element.on(this._handlers), this._core.options = a.extend({}, e.Defaults, this._core.options)
    };
    e.Defaults = {
        autoplay: !1,
        autoplayTimeout: 5e3,
        autoplayHoverPause: !1,
        autoplaySpeed: !1
    }, e.prototype.play = function(a, b) {
        this._paused = !1, this._core.is("rotating") || (this._core.enter("rotating"), this._setAutoPlayInterval())
    }, e.prototype._getNextTimeout = function(d, e) {
        return this._timeout && b.clearTimeout(this._timeout), b.setTimeout(a.proxy(function() {
            this._paused || this._core.is("busy") || this._core.is("interacting") || c.hidden || this._core.next(e || this._core.settings.autoplaySpeed)
        }, this), d || this._core.settings.autoplayTimeout)
    }, e.prototype._setAutoPlayInterval = function() {
        this._timeout = this._getNextTimeout()
    }, e.prototype.stop = function() {
        this._core.is("rotating") && (b.clearTimeout(this._timeout), this._core.leave("rotating"))
    }, e.prototype.pause = function() {
        this._core.is("rotating") && (this._paused = !0)
    }, e.prototype.destroy = function() {
        var a, b;
        this.stop();
        for (a in this._handlers) this._core.$element.off(a, this._handlers[a]);
        for (b in Object.getOwnPropertyNames(this)) "function" != typeof this[b] && (this[b] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.autoplay = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
    "use strict";
    var e = function(b) {
        this._core = b, this._initialized = !1, this._pages = [], this._controls = {}, this._templates = [], this.$element = this._core.$element, this._overrides = {
            next: this._core.next,
            prev: this._core.prev,
            to: this._core.to
        }, this._handlers = {
            "prepared.owl.carousel": a.proxy(function(b) {
                b.namespace && this._core.settings.dotsData && this._templates.push('<div class="' + this._core.settings.dotClass + '">' + a(b.content).find("[data-dot]").addBack("[data-dot]").attr("data-dot") + "</div>")
            }, this),
            "added.owl.carousel": a.proxy(function(a) {
                a.namespace && this._core.settings.dotsData && this._templates.splice(a.position, 0, this._templates.pop())
            }, this),
            "remove.owl.carousel": a.proxy(function(a) {
                a.namespace && this._core.settings.dotsData && this._templates.splice(a.position, 1)
            }, this),
            "changed.owl.carousel": a.proxy(function(a) {
                a.namespace && "position" == a.property.name && this.draw()
            }, this),
            "initialized.owl.carousel": a.proxy(function(a) {
                a.namespace && !this._initialized && (this._core.trigger("initialize", null, "navigation"), this.initialize(), this.update(), this.draw(), this._initialized = !0, this._core.trigger("initialized", null, "navigation"))
            }, this),
            "refreshed.owl.carousel": a.proxy(function(a) {
                a.namespace && this._initialized && (this._core.trigger("refresh", null, "navigation"), this.update(), this.draw(), this._core.trigger("refreshed", null, "navigation"))
            }, this)
        }, this._core.options = a.extend({}, e.Defaults, this._core.options), this.$element.on(this._handlers)
    };
    e.Defaults = {
        nav: !1,
        navText: ["prev", "next"],
        navSpeed: !1,
        navElement: "div",
        navContainer: !1,
        navContainerClass: "owl-nav",
        navClass: ["owl-prev", "owl-next"],
        slideBy: 1,
        dotClass: "owl-dot",
        dotsClass: "owl-dots",
        dots: !0,
        dotsEach: !1,
        dotsData: !1,
        dotsSpeed: !1,
        dotsContainer: !1
    }, e.prototype.initialize = function() {
        var b, c = this._core.settings;
        this._controls.$relative = (c.navContainer ? a(c.navContainer) : a("<div>").addClass(c.navContainerClass).appendTo(this.$element)).addClass("disabled"), this._controls.$previous = a("<" + c.navElement + ">").addClass(c.navClass[0]).html(c.navText[0]).prependTo(this._controls.$relative).on("click", a.proxy(function(a) {
            this.prev(c.navSpeed)
        }, this)), this._controls.$next = a("<" + c.navElement + ">").addClass(c.navClass[1]).html(c.navText[1]).appendTo(this._controls.$relative).on("click", a.proxy(function(a) {
            this.next(c.navSpeed)
        }, this)), c.dotsData || (this._templates = [a("<div>").addClass(c.dotClass).append(a("<span>")).prop("outerHTML")]), this._controls.$absolute = (c.dotsContainer ? a(c.dotsContainer) : a("<div>").addClass(c.dotsClass).appendTo(this.$element)).addClass("disabled"), this._controls.$absolute.on("click", "div", a.proxy(function(b) {
            var d = a(b.target).parent().is(this._controls.$absolute) ? a(b.target).index() : a(b.target).parent().index();
            b.preventDefault(), this.to(d, c.dotsSpeed)
        }, this));
        for (b in this._overrides) this._core[b] = a.proxy(this[b], this)
    }, e.prototype.destroy = function() {
        var a, b, c, d;
        for (a in this._handlers) this.$element.off(a, this._handlers[a]);
        for (b in this._controls) this._controls[b].remove();
        for (d in this.overides) this._core[d] = this._overrides[d];
        for (c in Object.getOwnPropertyNames(this)) "function" != typeof this[c] && (this[c] = null)
    }, e.prototype.update = function() {
        var a, b, c, d = this._core.clones().length / 2,
            e = d + this._core.items().length,
            f = this._core.maximum(!0),
            g = this._core.settings,
            h = g.center || g.autoWidth || g.dotsData ? 1 : g.dotsEach || g.items;
        if ("page" !== g.slideBy && (g.slideBy = Math.min(g.slideBy, g.items)), g.dots || "page" == g.slideBy)
            for (this._pages = [], a = d, b = 0, c = 0; e > a; a++) {
                if (b >= h || 0 === b) {
                    if (this._pages.push({
                            start: Math.min(f, a - d),
                            end: a - d + h - 1
                        }), Math.min(f, a - d) === f) break;
                    b = 0, ++c
                }
                b += this._core.mergers(this._core.relative(a))
            }
    }, e.prototype.draw = function() {
        var b, c = this._core.settings,
            d = this._core.items().length <= c.items,
            e = this._core.relative(this._core.current()),
            f = c.loop || c.rewind;
        this._controls.$relative.toggleClass("disabled", !c.nav || d), c.nav && (this._controls.$previous.toggleClass("disabled", !f && e <= this._core.minimum(!0)), this._controls.$next.toggleClass("disabled", !f && e >= this._core.maximum(!0))), this._controls.$absolute.toggleClass("disabled", !c.dots || d), c.dots && (b = this._pages.length - this._controls.$absolute.children().length, c.dotsData && 0 !== b ? this._controls.$absolute.html(this._templates.join("")) : b > 0 ? this._controls.$absolute.append(new Array(b + 1).join(this._templates[0])) : 0 > b && this._controls.$absolute.children().slice(b).remove(), this._controls.$absolute.find(".active").removeClass("active"), this._controls.$absolute.children().eq(a.inArray(this.current(), this._pages)).addClass("active"))
    }, e.prototype.onTrigger = function(b) {
        var c = this._core.settings;
        b.page = {
            index: a.inArray(this.current(), this._pages),
            count: this._pages.length,
            size: c && (c.center || c.autoWidth || c.dotsData ? 1 : c.dotsEach || c.items)
        }
    }, e.prototype.current = function() {
        var b = this._core.relative(this._core.current());
        return a.grep(this._pages, a.proxy(function(a, c) {
            return a.start <= b && a.end >= b
        }, this)).pop()
    }, e.prototype.getPosition = function(b) {
        var c, d, e = this._core.settings;
        return "page" == e.slideBy ? (c = a.inArray(this.current(), this._pages), d = this._pages.length, b ? ++c : --c, c = this._pages[(c % d + d) % d].start) : (c = this._core.relative(this._core.current()), d = this._core.items().length, b ? c += e.slideBy : c -= e.slideBy), c
    }, e.prototype.next = function(b) {
        a.proxy(this._overrides.to, this._core)(this.getPosition(!0), b)
    }, e.prototype.prev = function(b) {
        a.proxy(this._overrides.to, this._core)(this.getPosition(!1), b)
    }, e.prototype.to = function(b, c, d) {
        var e;
        !d && this._pages.length ? (e = this._pages.length, a.proxy(this._overrides.to, this._core)(this._pages[(b % e + e) % e].start, c)) : a.proxy(this._overrides.to, this._core)(b, c)
    }, a.fn.owlCarousel.Constructor.Plugins.Navigation = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
    "use strict";
    var e = function(c) {
        this._core = c, this._hashes = {}, this.$element = this._core.$element, this._handlers = {
            "initialized.owl.carousel": a.proxy(function(c) {
                c.namespace && "URLHash" === this._core.settings.startPosition && a(b).trigger("hashchange.owl.navigation")
            }, this),
            "prepared.owl.carousel": a.proxy(function(b) {
                if (b.namespace) {
                    var c = a(b.content).find("[data-hash]").addBack("[data-hash]").attr("data-hash");
                    if (!c) return;
                    this._hashes[c] = b.content
                }
            }, this),
            "changed.owl.carousel": a.proxy(function(c) {
                if (c.namespace && "position" === c.property.name) {
                    var d = this._core.items(this._core.relative(this._core.current())),
                        e = a.map(this._hashes, function(a, b) {
                            return a === d ? b : null
                        }).join();
                    if (!e || b.location.hash.slice(1) === e) return;
                    b.location.hash = e
                }
            }, this)
        }, this._core.options = a.extend({}, e.Defaults, this._core.options), this.$element.on(this._handlers), a(b).on("hashchange.owl.navigation", a.proxy(function(a) {
            var c = b.location.hash.substring(1),
                e = this._core.$stage.children(),
                f = this._hashes[c] && e.index(this._hashes[c]);
            f !== d && f !== this._core.current() && this._core.to(this._core.relative(f), !1, !0)
        }, this))
    };
    e.Defaults = {
        URLhashListener: !1
    }, e.prototype.destroy = function() {
        var c, d;
        a(b).off("hashchange.owl.navigation");
        for (c in this._handlers) this._core.$element.off(c, this._handlers[c]);
        for (d in Object.getOwnPropertyNames(this)) "function" != typeof this[d] && (this[d] = null)
    }, a.fn.owlCarousel.Constructor.Plugins.Hash = e
}(window.Zepto || window.jQuery, window, document),
function(a, b, c, d) {
    function e(b, c) {
        var e = !1,
            f = b.charAt(0).toUpperCase() + b.slice(1);
        return a.each((b + " " + h.join(f + " ") + f).split(" "), function(a, b) {
            return g[b] !== d ? (e = c ? b : !0, !1) : void 0
        }), e
    }

    function f(a) {
        return e(a, !0)
    }
    var g = a("<support>").get(0).style,
        h = "Webkit Moz O ms".split(" "),
        i = {
            transition: {
                end: {
                    WebkitTransition: "webkitTransitionEnd",
                    MozTransition: "transitionend",
                    OTransition: "oTransitionEnd",
                    transition: "transitionend"
                }
            },
            animation: {
                end: {
                    WebkitAnimation: "webkitAnimationEnd",
                    MozAnimation: "animationend",
                    OAnimation: "oAnimationEnd",
                    animation: "animationend"
                }
            }
        },
        j = {
            csstransforms: function() {
                return !!e("transform")
            },
            csstransforms3d: function() {
                return !!e("perspective")
            },
            csstransitions: function() {
                return !!e("transition")
            },
            cssanimations: function() {
                return !!e("animation")
            }
        };
    j.csstransitions() && (a.support.transition = new String(f("transition")), a.support.transition.end = i.transition.end[a.support.transition]), j.cssanimations() && (a.support.animation = new String(f("animation")), a.support.animation.end = i.animation.end[a.support.animation]), j.csstransforms() && (a.support.transform = new String(f("transform")), a.support.transform3d = j.csstransforms3d())
}(window.Zepto || window.jQuery, window, document);


/***********************************
Nav Accordion Plugin v1.1.2
************************************/
(function($) {
    $.fn.navAccordion = function(options, callback) {
        this.each(function() {
            var settings = $.extend({
                expandButtonText: "+",
                collapseButtonText: "-",
                selectedExpand: "true",
                selectedClass: "selected",
                multipleLevels: "true",
                buttonWidth: "20%",
                buttonPosition: "right",
                slideSpeed: "fast",
                parentElement: "li",
                childElement: "ul",
                headersOnly: false,
                headersOnlyCheck: false,
                delayLink: false,
                delayAmount: null
            }, options);
            var container = this,
                multi = settings.multipleLevels ? '' : ' > ' + settings.childElement + ' > ';
            $(container).addClass('accordion-nav');
            $(multi + settings.parentElement, container).each(function() {
                if (($(this).contents(settings.childElement).length > 0 && settings.headersOnlyCheck == false) || (!($('> a', this).attr('href')) && settings.headersOnlyCheck == true)) {
                    $(this).addClass('has-subnav').css('position', 'relative').find('>a').css('margin-' + settings.buttonPosition, settings.buttonWidth);
                    $(' > ' + settings.childElement, this).before('<span class="accordion-btn-wrap"><span class="accordion-btn accordion-collapsed">' + settings.expandButtonText + '</span><span class="accordion-btn accordion-expanded">' + settings.collapseButtonText + '</span></span>');
                    $('.accordion-btn-wrap', this).css({
                        'width': settings.buttonWidth,
                        'position': 'absolute',
                        'top': 0,
                        'text-align': 'center',
                        'cursor': 'pointer',
                        'display': 'inline-block'
                    }).css(settings.buttonPosition, 0);
                    $('.accordion-btn ', this).css({
                        'display': 'inline-block',
                        'width': '100%'
                    });
                    $('.accordion-expanded', this).css('display', 'none');
                }
                if (!($('> a', this).attr('href')) || settings.headersOnly) {
                    $(this).addClass('accordion-header-only').find('.accordion-btn-wrap').css({
                        'width': '100%',
                        'text-align': settings.buttonPosition
                    }).find('.accordion-btn ').css({
                        'width': settings.buttonWidth,
                        'text-align': 'center'
                    });
                }
                if (settings.delayLink && !settings.headersOnly) {
                    var currentThis = this,
                        speed = settings.delayAmount != null ? settings.delayAmount : settings.slideSpeed;
                    if (speed == "fast") {
                        speed = 200;
                    } else if (speed == "slow") {
                        speed = 600;
                    }
                    $('> a', currentThis).on('click', function(e) {
                        if (!$('> .accordion-btn-wrap', currentThis).hasClass("accordion-active")) {
                            e.preventDefault();
                            var href = $(this).attr('href');
                            clickToggle($('> .accordion-btn-wrap', currentThis));
                            setTimeout(function() {
                                window.location = href;
                            }, speed)
                        }
                    })
                }
            });
            var selectedNavAccordion = $(settings.parentElement + '.' + settings.selectedClass + ' > .accordion-btn-wrap', container);
            var buttonheightResize = debounce(function() {
                buttonheight();
                expandSelected();
            }, 250);
            $(window).on('resize', buttonheightResize);
            buttonheight();
            expandSelected();
            $(container).on('click', '.accordion-btn-wrap', function(e) {
                e.preventDefault();
                clickToggle(this);
            });
            if (typeof callback == "function") {
                callback();
            }

            function clickToggle(element) {
                var nextChild = $(element).next(settings.childElement),
                    currentExpandBtn = $('.accordion-expanded', element),
                    currentCollapseBtn = $('.accordion-collapsed', element),
                    parentObj = $(element).closest(settings.parentElement);
                if (nextChild.is(':visible')) {
                    nextChild.slideUp(settings.slideSpeed);
                    $(element).removeClass('accordion-active');
                    currentExpandBtn.css('display', 'none');
                    currentCollapseBtn.css('display', 'inline-block');
                    parentObj.add(parentObj.siblings('.active')).add(parentObj.find('.active')).removeClass('active');
                } else {
                    $(element).closest(settings.childElement).find('.accordion-active').removeClass('accordion-active').next(settings.childElement).slideUp(settings.slideSpeed).prev().find('.accordion-expanded').css('display', 'none').parent().find('.accordion-collapsed').css('display', 'inline-block');
                    parentObj.add(parentObj.siblings('.active')).add(parentObj.find('.active')).removeClass('active');
                    $(element).addClass('accordion-active');
                    nextChild.slideToggle(settings.slideSpeed);
                    currentExpandBtn.css('display', 'inline-block');
                    currentCollapseBtn.css('display', 'none');
                    parentObj.addClass('active');
                }
            }

            function expandSelected() {
                if (settings.selectedExpand) {
                    if (!settings.headersOnlyCheck) {
                        selectedNavAccordion.find('.accordion-expanded').css('display', 'inline-block');
                        selectedNavAccordion.find('.accordion-collapsed').css('display', 'none');
                        selectedNavAccordion.addClass('accordion-active').next(settings.childElement).css('display', 'block');
                        selectedNavAccordion.closest(settings.parentElement).addClass('active');
                    } else {
                        $(settings.parentElement + '.' + settings.selectedClass + ' > ' + settings.childElement, container).css('display', 'block');
                        $(settings.parentElement + '.' + settings.selectedClass).addClass('active');
                    }
                }
            }

            function buttonheight() {
                $('.accordion-btn', container).each(function() {
                    $(settings.parentElement + '.has-subnav > ' + settings.childElement, container).css('display', 'block');
                    var parentItem = $(this).closest(settings.parentElement),
                        lineheight = $('> a', parentItem).innerHeight();
                    $(this).css({
                        'line-height': lineheight + 'px',
                        'height': lineheight
                    });
                    $(settings.parentElement + ((settings.headersOnlyCheck) ? ' ' : '.has-subnav > ') + settings.childElement, container).css('display', 'none');
                    $('.accordion-expanded').css('display', 'none');
                    $('.accordion-collapsed').css('display', 'inline-block');
                })
            }

            function debounce(func, wait, immediate) {
                var timeout;
                return function() {
                    var context = this,
                        args = arguments;
                    var later = function() {
                        timeout = null;
                        if (!immediate) func.apply(context, args);
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) func.apply(context, args);
                };
            };
        });
    }
})(jQuery);
/***********************************
DOUBLE TAP to GO
************************************/
! function(t, n, o) {
    "use strict";
    t.fn.doubleTouchToGo = function() {
        return "ontouchstart" in n || navigator.msMaxTouchPoints || navigator.userAgent.toLowerCase().match(/windows phone os 7/i) ? (this.each(function() {
            var n = !1;
            t(this).on("click", function(o) {
                var i = t(this);
                i[0] != n[0] && (o.preventDefault(), n = i)
            }), t(o).on("click touchstart MSPointerDown", function(o) {
                for (var i = !0, e = t(o.target).parents(), r = 0; r < e.length; r++) e[r] == n[0] && (i = !1);
                i && (n = !1)
            })
        }), this) : !1
    }
}(jQuery, window, document);
/***********************************
AUDIO PLAYER
************************************/
! function(a, b, c, d) {
    var e = "ontouchstart" in b,
        f = e ? "touchstart" : "mousedown",
        g = e ? "touchmove" : "mousemove",
        i = e ? "touchcancel" : "mouseup",
        j = function(a) {
            var b = Math.floor(a / 3600),
                c = Math.floor(a % 3600 / 60),
                d = Math.ceil(a % 3600 % 60);
            return (0 == b ? "" : b > 0 && b.toString().length < 2 ? "0" + b + ":" : b + ":") + (c.toString().length < 2 ? "0" + c : c) + ":" + (d.toString().length < 2 ? "0" + d : d)
        },
        k = function(a) {
            var b = c.createElement("audio");
            return !(!b.canPlayType || !b.canPlayType("audio/" + a.split(".").pop().toLowerCase() + ";").replace(/no/, ""))
        };
    a.fn.audioPlayer = function(b) {
        var b = a.extend({
                classPrefix: "audioplayer",
                strPlay: "Play",
                strPause: "Pause",
                strVolume: "Volume"
            }, b),
            c = {},
            d = {
                playPause: "playpause",
                playing: "playing",
                time: "time",
                timeCurrent: "time-current",
                timeDuration: "time-duration",
                bar: "bar",
                barLoaded: "bar-loaded",
                barPlayed: "bar-played",
                volume: "volume",
                volumeButton: "volume-button",
                volumeAdjust: "volume-adjust",
                noVolume: "novolume",
                mute: "mute",
                mini: "mini"
            };
        for (var h in d) c[h] = b.classPrefix + "-" + d[h];
        return this.each(function() {
            if ("audio" != a(this).prop("tagName").toLowerCase()) return !1;
            var d = a(this),
                h = d.attr("src"),
                l = d.get(0).getAttribute("autoplay"),
                l = "" === l || "autoplay" === l,
                m = d.get(0).getAttribute("loop"),
                m = "" === m || "loop" === m,
                n = !1;
            "undefined" == typeof h ? d.find("source").each(function() {
                if (h = a(this).attr("src"), "undefined" != typeof h && k(h)) return n = !0, !1
            }) : k(h) && (n = !0);
            var o = a('<div class="' + b.classPrefix + '">' + (n ? a("<div>").append(d.eq(0).clone()).html() : '<embed src="' + h + '" width="0" height="0" volume="100" autostart="' + l.toString() + '" loop="' + m.toString() + '" />') + '<div class="' + c.playPause + '" title="' + b.strPlay + '"><a href="#">' + b.strPlay + "</a></div></div>"),
                p = n ? o.find("audio") : o.find("embed"),
                p = p.get(0);
            if (n) {
                o.find("audio").css({
                    width: 0,
                    height: 0,
                    visibility: "hidden"
                }), o.append('<div class="' + c.time + " " + c.timeCurrent + '"></div><div class="' + c.bar + '"><div class="' + c.barLoaded + '"></div><div class="' + c.barPlayed + '"></div></div><div class="' + c.time + " " + c.timeDuration + '"></div><div class="' + c.volume + '"><div class="' + c.volumeButton + '" title="' + b.strVolume + '"><a href="#">' + b.strVolume + '</a></div><div class="' + c.volumeAdjust + '"><div><div></div></div></div></div>');
                var q = o.find("." + c.bar),
                    r = o.find("." + c.barPlayed),
                    t = (o.find("." + c.barLoaded), o.find("." + c.timeCurrent)),
                    u = o.find("." + c.timeDuration),
                    v = o.find("." + c.volumeButton),
                    w = o.find("." + c.volumeAdjust + " > div"),
                    x = 0,
                    y = function(a) {
                        theRealEvent = e ? a.originalEvent.touches[0] : a, p.currentTime = Math.round(p.duration * (theRealEvent.pageX - q.offset().left) / q.width())
                    },
                    z = function(a) {
                        theRealEvent = e ? a.originalEvent.touches[0] : a, p.volume = Math.abs((theRealEvent.pageY - (w.offset().top + w.height())) / w.height())
                    },
                    B = (setInterval(function() {}, 100), p.volume),
                    C = p.volume = .111;
                Math.round(1e3 * p.volume) / 1e3 == C ? p.volume = B : o.addClass(c.noVolume), u.html("…"), t.text(j(0)), p.addEventListener("loadeddata", function() {
                    u.text(j(p.duration)), w.find("div").height(100 * p.volume + "%"), x = p.volume
                }), p.addEventListener("timeupdate", function() {
                    t.text(j(p.currentTime)), r.width(p.currentTime / p.duration * 100 + "%")
                }), p.addEventListener("volumechange", function() {
                    w.find("div").height(100 * p.volume + "%"), p.volume > 0 && o.hasClass(c.mute) && o.removeClass(c.mute), p.volume <= 0 && !o.hasClass(c.mute) && o.addClass(c.mute)
                }), p.addEventListener("ended", function() {
                    o.removeClass(c.playing)
                }), q.on(f, function(a) {
                    y(a), q.on(g, function(a) {
                        y(a)
                    })
                }).on(i, function() {
                    q.unbind(g)
                }), v.on("click", function() {
                    return o.hasClass(c.mute) ? (o.removeClass(c.mute), p.volume = x) : (o.addClass(c.mute), x = p.volume, p.volume = 0), !1
                }), w.on(f, function(a) {
                    z(a), w.on(g, function(a) {
                        z(a)
                    })
                }).on(i, function() {
                    w.unbind(g)
                })
            } else o.addClass(c.mini);
            l && o.addClass(c.playing), o.find("." + c.playPause).on("click", function() {
                return o.hasClass(c.playing) ? (a(this).attr("title", b.strPlay).find("a").html(b.strPlay), o.removeClass(c.playing), n ? p.pause() : p.Stop()) : (a(this).attr("title", b.strPause).find("a").html(b.strPause), o.addClass(c.playing), n ? p.play() : p.Play()), !1
            }), d.replaceWith(o)
        }), this
    }
}(jQuery, window, document);
/**
 * Infinite Ajax Scroll
 */
! function(a) {
    "use strict";
    var b = -1,
        c = function(c, e) {
            return this.itemsContainerSelector = e.container, this.itemSelector = e.item, this.nextSelector = e.next, this.paginationSelector = e.pagination, this.$scrollContainer = c, this.$container = window === c.get(0) ? a(document) : c, this.defaultDelay = e.delay, this.negativeMargin = e.negativeMargin, this.nextUrl = null, this.isBound = !1, this.isPaused = !1, this.isInitialized = !1, this.jsXhr = !1, this.listeners = {
                next: new d(a),
                load: new d(a),
                loaded: new d(a),
                render: new d(a),
                rendered: new d(a),
                scroll: new d(a),
                noneLeft: new d(a),
                ready: new d(a)
            }, this.extensions = [], this.scrollHandler = function() {
                if (this.isBound && !this.isPaused) {
                    var a = this.getCurrentScrollOffset(this.$scrollContainer),
                        c = this.getScrollThreshold();
                    b != c && (this.fire("scroll", [a, c]), a >= c && this.next())
                }
            }, this.getItemsContainer = function() {
                return a(this.itemsContainerSelector, this.$container)
            }, this.getLastItem = function() {
                return a(this.itemSelector, this.getItemsContainer().get(0)).last()
            }, this.getFirstItem = function() {
                return a(this.itemSelector, this.getItemsContainer().get(0)).first()
            }, this.getScrollThreshold = function(a) {
                var c;
                return a = a || this.negativeMargin, a = a >= 0 ? a * -1 : a, c = this.getLastItem(), 0 === c.length ? b : c.offset().top + c.height() + a
            }, this.getCurrentScrollOffset = function(a) {
                var b = 0,
                    c = a.height();
                return b = window === a.get(0) ? a.scrollTop() : a.offset().top, navigator.platform.indexOf("iPhone") == -1 && navigator.platform.indexOf("iPod") == -1 || (c += 80), b + c
            }, this.getNextUrl = function(b) {
                return b = b || this.$container, a(this.nextSelector, b).last().attr("href")
            }, this.load = function(b, c, d) {
                var f, i, e = this,
                    g = [],
                    h = +new Date;
                d = d || this.defaultDelay;
                var j = {
                    url: b
                };
                return e.fire("load", [j]), this.jsXhr = a.get(j.url, null, a.proxy(function(b) {
                    f = a(this.itemsContainerSelector, b).eq(0), 0 === f.length && (f = a(b).filter(this.itemsContainerSelector).eq(0)), f && f.find(this.itemSelector).each(function() {
                        g.push(this)
                    }), e.fire("loaded", [b, g]), c && (i = +new Date - h, i < d ? setTimeout(function() {
                        c.call(e, b, g)
                    }, d - i) : c.call(e, b, g))
                }, e), "html"), this.jsXhr
            }, this.render = function(b, c) {
                var d = this,
                    e = this.getLastItem(),
                    f = 0,
                    g = this.fire("render", [b]);
                g.done(function() {
                    a(b).hide(), e.after(b), a(b).fadeIn(400, function() {
                        ++f < b.length || (d.fire("rendered", [b]), c && c())
                    })
                }), g.fail(function() {
                    c && c()
                })
            }, this.hidePagination = function() {
                this.paginationSelector && a(this.paginationSelector, this.$container).hide()
            }, this.restorePagination = function() {
                this.paginationSelector && a(this.paginationSelector, this.$container).show()
            }, this.throttle = function(b, c) {
                var e, f, d = 0;
                return e = function() {
                    function h() {
                        d = +new Date, b.apply(a, e)
                    }
                    var a = this,
                        e = arguments,
                        g = +new Date - d;
                    f ? clearTimeout(f) : h(), g > c ? h() : f = setTimeout(h, c)
                }, a.guid && (e.guid = b.guid = b.guid || a.guid++), e
            }, this.fire = function(a, b) {
                return this.listeners[a].fireWith(this, b)
            }, this.pause = function() {
                this.isPaused = !0
            }, this.resume = function() {
                this.isPaused = !1
            }, this
        };
    c.prototype.initialize = function() {
        if (this.isInitialized) return !1;
        var a = !!("onscroll" in this.$scrollContainer.get(0)),
            b = this.getCurrentScrollOffset(this.$scrollContainer),
            c = this.getScrollThreshold();
        return !!a && (this.hidePagination(), this.bind(), this.fire("ready"), this.nextUrl = this.getNextUrl(), b >= c ? (this.next(), this.one("rendered", function() {
            this.isInitialized = !0
        })) : this.isInitialized = !0, this)
    }, c.prototype.reinitialize = function() {
        this.isInitialized = !1, this.unbind(), this.initialize()
    }, c.prototype.bind = function() {
        if (!this.isBound) {
            this.$scrollContainer.on("scroll", a.proxy(this.throttle(this.scrollHandler, 150), this));
            for (var b = 0, c = this.extensions.length; b < c; b++) this.extensions[b].bind(this);
            this.isBound = !0, this.resume()
        }
    }, c.prototype.unbind = function() {
        if (this.isBound) {
            this.$scrollContainer.off("scroll", this.scrollHandler);
            for (var a = 0, b = this.extensions.length; a < b; a++) "undefined" != typeof this.extensions[a].unbind && this.extensions[a].unbind(this);
            this.isBound = !1
        }
    }, c.prototype.destroy = function() {
        try {
            this.jsXhr.abort()
        } catch (a) {}
        this.unbind(), this.$scrollContainer.data("hrs", null)
    }, c.prototype.on = function(b, c, d) {
        if ("undefined" == typeof this.listeners[b]) throw new Error('There is no event called "' + b + '"');
        return d = d || 0, this.listeners[b].add(a.proxy(c, this), d), this
    }, c.prototype.one = function(a, b) {
        var c = this,
            d = function() {
                c.off(a, b), c.off(a, d)
            };
        return this.on(a, b), this.on(a, d), this
    }, c.prototype.off = function(a, b) {
        if ("undefined" == typeof this.listeners[a]) throw new Error('There is no event called "' + a + '"');
        return this.listeners[a].remove(b), this
    }, c.prototype.next = function() {
        var a = this.nextUrl,
            b = this;
        if (this.pause(), !a) return this.fire("noneLeft", [this.getLastItem()]), this.listeners.noneLeft.disable(), b.resume(), !1;
        var c = this.fire("next", [a]);
        return c.done(function() {
            b.load(a, function(a, c) {
                b.render(c, function() {
                    b.nextUrl = b.getNextUrl(a), b.resume()
                })
            })
        }), c.fail(function() {
            b.resume()
        }), !0
    }, c.prototype.extension = function(a) {
        if ("undefined" == typeof a.bind) throw new Error('Extension doesn\'t have required method "bind"');
        return "undefined" != typeof a.initialize && a.initialize(this), this.extensions.push(a), this.isInitialized && this.reinitialize(), this
    }, a.hrs = function(b) {
        var c = a(window);
        return c.hrs.apply(c, arguments)
    }, a.fn.hrs = function(b) {
        var d = Array.prototype.slice.call(arguments),
            e = this;
        return this.each(function() {
            var f = a(this),
                g = f.data("hrs"),
                h = a.extend({}, a.fn.hrs.defaults, f.data(), "object" == typeof b && b);
            if (g || (f.data("hrs", g = new c(f, h)), a(document).ready(a.proxy(g.initialize, g))), "string" == typeof b) {
                if ("function" != typeof g[b]) throw new Error('There is no method called "' + b + '"');
                d.shift(), g[b].apply(g, d)
            }
            e = g
        }), e
    }, a.fn.hrs.defaults = {
        item: ".item",
        container: ".listing",
        next: ".next",
        pagination: !1,
        delay: 100,
        negativeMargin: 10
    };
    var d = function(a) {
        return this.list = [], this.fireStack = [], this.isFiring = !1, this.isDisabled = !1, this.fire = function(a) {
            var b = a[0],
                c = a[1],
                d = a[2];
            this.isFiring = !0;
            for (var e = 0, f = this.list.length; e < f; e++)
                if (void 0 != this.list[e] && !1 === this.list[e].fn.apply(b, d)) {
                    c.reject();
                    break
                }
            this.isFiring = !1, c.resolve(), this.fireStack.length && this.fire(this.fireStack.shift())
        }, this.inList = function(a, b) {
            b = b || 0;
            for (var c = b, d = this.list.length; c < d; c++)
                if (this.list[c].fn === a || a.guid && this.list[c].fn.guid && a.guid === this.list[c].fn.guid) return c;
            return -1
        }, this
    };
    d.prototype = {
        add: function(a, b) {
            var c = {
                fn: a,
                priority: b
            };
            b = b || 0;
            for (var d = 0, e = this.list.length; d < e; d++)
                if (b > this.list[d].priority) return this.list.splice(d, 0, c), this;
            return this.list.push(c), this
        },
        remove: function(a) {
            for (var b = 0;
                (b = this.inList(a, b)) > -1;) this.list.splice(b, 1);
            return this
        },
        has: function(a) {
            return this.inList(a) > -1
        },
        fireWith: function(b, c) {
            var d = a.Deferred();
            return this.isDisabled ? d.reject() : (c = c || [], c = [b, d, c.slice ? c.slice() : c], this.isFiring ? this.fireStack.push(c) : this.fire(c), d)
        },
        disable: function() {
            this.isDisabled = !0
        },
        enable: function() {
            this.isDisabled = !1
        }
    }
}(jQuery);
var HRSSpinnerExtension = function(a) {
    return a = jQuery.extend({}, this.defaults, a), this.hrs = null, this.uid = (new Date).getTime(), this.src = a.src, this.html = a.html.replace("{src}", this.src), this.showSpinner = function() {
        var a = this.getSpinner() || this.createSpinner(),
            b = this.hrs.getItemsContainer();
        b.after(a), a.fadeIn()
    }, this.showSpinnerBefore = function() {
        var a = this.getSpinner() || this.createSpinner(),
            b = this.hrs.getFirstItem();
        b.before(a), a.fadeIn()
    }, this.removeSpinner = function() {
        this.hasSpinner() && this.getSpinner().remove()
    }, this.getSpinner = function() {
        var a = jQuery("#hrs_spinner_" + this.uid);
        return a.length > 0 && a
    }, this.hasSpinner = function() {
        var a = jQuery("#hrs_spinner_" + this.uid);
        return a.length > 0
    }, this.createSpinner = function() {
        var a = jQuery(this.html).attr("id", "hrs_spinner_" + this.uid);
        return a.hide(), a
    }, this
};
HRSSpinnerExtension.prototype.bind = function(a) {
    this.hrs = a, a.on("next", jQuery.proxy(this.showSpinner, this)), a.on("render", jQuery.proxy(this.removeSpinner, this));
    try {
        a.on("prev", jQuery.proxy(this.showSpinnerBefore, this))
    } catch (a) {}
}, HRSSpinnerExtension.prototype.unbind = function(a) {
    a.off("next", this.showSpinner), a.off("render", this.removeSpinner);
    try {
        a.off("prev", this.showSpinnerBefore)
    } catch (a) {}
}, HRSSpinnerExtension.prototype.defaults = {
    src: "data:image/gif;base64,R0lGODlhEAAQAPQAAP///wAAAPDw8IqKiuDg4EZGRnp6egAAAFhYWCQkJKysrL6+vhQUFJycnAQEBDY2NmhoaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAAFdyAgAgIJIeWoAkRCCMdBkKtIHIngyMKsErPBYbADpkSCwhDmQCBethRB6Vj4kFCkQPG4IlWDgrNRIwnO4UKBXDufzQvDMaoSDBgFb886MiQadgNABAokfCwzBA8LCg0Egl8jAggGAA1kBIA1BAYzlyILczULC2UhACH5BAkKAAAALAAAAAAQABAAAAV2ICACAmlAZTmOREEIyUEQjLKKxPHADhEvqxlgcGgkGI1DYSVAIAWMx+lwSKkICJ0QsHi9RgKBwnVTiRQQgwF4I4UFDQQEwi6/3YSGWRRmjhEETAJfIgMFCnAKM0KDV4EEEAQLiF18TAYNXDaSe3x6mjidN1s3IQAh+QQJCgAAACwAAAAAEAAQAAAFeCAgAgLZDGU5jgRECEUiCI+yioSDwDJyLKsXoHFQxBSHAoAAFBhqtMJg8DgQBgfrEsJAEAg4YhZIEiwgKtHiMBgtpg3wbUZXGO7kOb1MUKRFMysCChAoggJCIg0GC2aNe4gqQldfL4l/Ag1AXySJgn5LcoE3QXI3IQAh+QQJCgAAACwAAAAAEAAQAAAFdiAgAgLZNGU5joQhCEjxIssqEo8bC9BRjy9Ag7GILQ4QEoE0gBAEBcOpcBA0DoxSK/e8LRIHn+i1cK0IyKdg0VAoljYIg+GgnRrwVS/8IAkICyosBIQpBAMoKy9dImxPhS+GKkFrkX+TigtLlIyKXUF+NjagNiEAIfkECQoAAAAsAAAAABAAEAAABWwgIAICaRhlOY4EIgjH8R7LKhKHGwsMvb4AAy3WODBIBBKCsYA9TjuhDNDKEVSERezQEL0WrhXucRUQGuik7bFlngzqVW9LMl9XWvLdjFaJtDFqZ1cEZUB0dUgvL3dgP4WJZn4jkomWNpSTIyEAIfkECQoAAAAsAAAAABAAEAAABX4gIAICuSxlOY6CIgiD8RrEKgqGOwxwUrMlAoSwIzAGpJpgoSDAGifDY5kopBYDlEpAQBwevxfBtRIUGi8xwWkDNBCIwmC9Vq0aiQQDQuK+VgQPDXV9hCJjBwcFYU5pLwwHXQcMKSmNLQcIAExlbH8JBwttaX0ABAcNbWVbKyEAIfkECQoAAAAsAAAAABAAEAAABXkgIAICSRBlOY7CIghN8zbEKsKoIjdFzZaEgUBHKChMJtRwcWpAWoWnifm6ESAMhO8lQK0EEAV3rFopIBCEcGwDKAqPh4HUrY4ICHH1dSoTFgcHUiZjBhAJB2AHDykpKAwHAwdzf19KkASIPl9cDgcnDkdtNwiMJCshACH5BAkKAAAALAAAAAAQABAAAAV3ICACAkkQZTmOAiosiyAoxCq+KPxCNVsSMRgBsiClWrLTSWFoIQZHl6pleBh6suxKMIhlvzbAwkBWfFWrBQTxNLq2RG2yhSUkDs2b63AYDAoJXAcFRwADeAkJDX0AQCsEfAQMDAIPBz0rCgcxky0JRWE1AmwpKyEAIfkECQoAAAAsAAAAABAAEAAABXkgIAICKZzkqJ4nQZxLqZKv4NqNLKK2/Q4Ek4lFXChsg5ypJjs1II3gEDUSRInEGYAw6B6zM4JhrDAtEosVkLUtHA7RHaHAGJQEjsODcEg0FBAFVgkQJQ1pAwcDDw8KcFtSInwJAowCCA6RIwqZAgkPNgVpWndjdyohACH5BAkKAAAALAAAAAAQABAAAAV5ICACAimc5KieLEuUKvm2xAKLqDCfC2GaO9eL0LABWTiBYmA06W6kHgvCqEJiAIJiu3gcvgUsscHUERm+kaCxyxa+zRPk0SgJEgfIvbAdIAQLCAYlCj4DBw0IBQsMCjIqBAcPAooCBg9pKgsJLwUFOhCZKyQDA3YqIQAh+QQJCgAAACwAAAAAEAAQAAAFdSAgAgIpnOSonmxbqiThCrJKEHFbo8JxDDOZYFFb+A41E4H4OhkOipXwBElYITDAckFEOBgMQ3arkMkUBdxIUGZpEb7kaQBRlASPg0FQQHAbEEMGDSVEAA1QBhAED1E0NgwFAooCDWljaQIQCE5qMHcNhCkjIQAh+QQJCgAAACwAAAAAEAAQAAAFeSAgAgIpnOSoLgxxvqgKLEcCC65KEAByKK8cSpA4DAiHQ/DkKhGKh4ZCtCyZGo6F6iYYPAqFgYy02xkSaLEMV34tELyRYNEsCQyHlvWkGCzsPgMCEAY7Cg04Uk48LAsDhRA8MVQPEF0GAgqYYwSRlycNcWskCkApIyEAOwAAAAAAAAAAAA==",
    html: '<div class="hrs-spinner" style="text-align: center;"><img src="{src}"/></div>'
};
var HRSTriggerExtension = function(a) {
    return a = jQuery.extend({}, this.defaults, a), this.hrs = null, this.html = a.html.replace("{text}", a.text), this.htmlPrev = a.htmlPrev.replace("{text}", a.textPrev), this.enabled = !0, this.count = 0, this.offset = a.offset, this.$triggerNext = null, this.$triggerPrev = null, this.showTriggerNext = function() {
        if (!this.enabled) return !0;
        if (!1 === this.offset || ++this.count < this.offset) return !0;
        var a = this.$triggerNext || (this.$triggerNext = this.createTrigger(this.next, this.html)),
            b = this.hrs.getItemsContainer();
        return b.after(a), a.fadeIn(), !1
    }, this.showTriggerPrev = function() {
        if (!this.enabled) return !0;
        var a = this.$triggerPrev || (this.$triggerPrev = this.createTrigger(this.prev, this.htmlPrev)),
            b = this.hrs.getFirstItem();
        return b.before(a), a.fadeIn(), !1
    }, this.onRendered = function() {
        this.enabled = !0
    }, this.createTrigger = function(a, b) {
        var d, c = (new Date).getTime();
        return b = b || this.html, d = jQuery(b).attr("id", "hrs_trigger_" + c), d.hide(), d.on("click", jQuery.proxy(a, this)), d
    }, this
};
HRSTriggerExtension.prototype.bind = function(a) {
    this.hrs = a, a.on("next", jQuery.proxy(this.showTriggerNext, this), this.priority), a.on("rendered", jQuery.proxy(this.onRendered, this), this.priority);
    try {
        a.on("prev", jQuery.proxy(this.showTriggerPrev, this), this.priority)
    } catch (a) {}
}, HRSTriggerExtension.prototype.unbind = function(a) {
    a.off("next", this.showTriggerNext), a.off("rendered", this.onRendered);
    try {
        a.off("prev", this.showTriggerPrev)
    } catch (a) {}
}, HRSTriggerExtension.prototype.next = function() {
    this.enabled = !1, this.hrs.pause(), this.$triggerNext && (this.$triggerNext.remove(), this.$triggerNext = null), this.hrs.next()
}, HRSTriggerExtension.prototype.prev = function() {
    this.enabled = !1, this.hrs.pause(), this.$triggerPrev && (this.$triggerPrev.remove(), this.$triggerPrev = null), this.hrs.prev()
}, HRSTriggerExtension.prototype.defaults = {
    text: "Load more items",
    html: '<div class="hrs-trigger hrs-trigger-next" style="text-align: center; cursor: pointer;"><a>{text}</a></div>',
    textPrev: "Load previous items",
    htmlPrev: '<div class="hrs-trigger hrs-trigger-prev" style="text-align: center; cursor: pointer;"><a>{text}</a></div>',
    offset: 0
}, HRSTriggerExtension.prototype.priority = 1e3;
var HRSNoneLeftExtension = function(a) {
    return a = jQuery.extend({}, this.defaults, a), this.hrs = null, this.uid = (new Date).getTime(), this.html = a.html.replace("{text}", a.text), this.showNoneLeft = function() {
        var a = jQuery(this.html).attr("id", "hrs_noneleft_" + this.uid),
            b = this.hrs.getItemsContainer();
        b.after(a), a.fadeIn().delay(1400).animate({
            opacity: 0
        });
    }, this
};
HRSNoneLeftExtension.prototype.bind = function(a) {
    this.hrs = a, a.on("noneLeft", jQuery.proxy(this.showNoneLeft, this))
}, HRSNoneLeftExtension.prototype.unbind = function(a) {
    a.off("noneLeft", this.showNoneLeft)
}, HRSNoneLeftExtension.prototype.defaults = {
    text: "You reached the end.",
    html: '<div class="hrs-noneleft" style="text-align: center;">{text}</div>'
};
/***********************************
APPEAR
************************************/
(function(e) {
    e.fn.disappear = function(t, n) {
        var r = e.extend({
            data: undefined
        }, n);
        this.each(function() {
            var n = e(this);
            n.bind("disappear", t, r.data);
            if (!t) {
                n.trigger("disappear", r.data);
                return
            }
        })
    };
    e.fn.appear = function(t, n) {
        var r = e.extend({
            data: undefined,
            one: true
        }, n);
        return this.each(function() {
            var n = e(this);
            n.appeared = false;
            if (!t) {
                n.trigger("appear", r.data);
                return
            }
            var i = e(window);
            var s = function() {
                if (!n.is(":visible")) {
                    n.appeared = false;
                    return
                }
                var e = i.scrollLeft();
                var t = i.scrollTop();
                var s = n.offset();
                var o = s.left;
                var u = s.top;
                if (u + n.height() >= t && u <= t + i.height() && o + n.width() >= e && o <= e + i.width()) {
                    if (!n.appeared) n.trigger("appear", r.data)
                } else {
                    if (n.appeared) n.trigger("disappear", r.data);
                    n.appeared = false
                }
            };
            var o = function() {
                n.appeared = true;
                if (r.one) {
                    i.unbind("scroll", s);
                    var o = e.inArray(s, e.fn.appear.checks);
                    if (o >= 0) e.fn.appear.checks.splice(o, 1)
                }
                t.apply(this, arguments)
            };
            if (r.one) n.one("appear", r.data, o);
            else n.bind("appear", r.data, o);
            i.scroll(s);
            e.fn.appear.checks.push(s);
            s()
        })
    };
    e.extend(e.fn.appear, {
        checks: [],
        timeout: null,
        checkAll: function() {
            var t = e.fn.appear.checks.length;
            if (t > 0)
                while (t--) e.fn.appear.checks[t]()
        },
        run: function() {
            if (e.fn.appear.timeout) clearTimeout(e.fn.appear.timeout);
            e.fn.appear.timeout = setTimeout(e.fn.appear.checkAll, 20)
        }
    });
    e.each(["append", "prepend", "after", "before", "attr", "removeAttr", "addClass", "removeClass", "toggleClass", "remove", "css", "show", "hide"], function(t, n) {
        var r = e.fn[n];
        if (r) {
            e.fn[n] = function() {
                var t = r.apply(this, arguments);
                e.fn.appear.run();
                return t
            }
        }
    })
})(jQuery)

/*!
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

! function(s) {
    "use strict";

    function e(s) {
        return new RegExp("(^|\\s+)" + s + "(\\s+|$)")
    }

    function n(s, e) {
        var n = a(s, e) ? c : t;
        n(s, e)
    }
    var a, t, c;
    "classList" in document.documentElement ? (a = function(s, e) {
        return s.classList.contains(e)
    }, t = function(s, e) {
        s.classList.add(e)
    }, c = function(s, e) {
        s.classList.remove(e)
    }) : (a = function(s, n) {
        return e(n).test(s.className)
    }, t = function(s, e) {
        a(s, e) || (s.className = s.className + " " + e)
    }, c = function(s, n) {
        s.className = s.className.replace(e(n), " ")
    });
    var i = {
        hasClass: a,
        addClass: t,
        removeClass: c,
        toggleClass: n,
        has: a,
        add: t,
        remove: c,
        toggle: n
    };
    "function" == typeof define && define.amd ? define(i) : s.classie = i
}(window);
/*!
 * Theia Sticky Sidebar v1.7.0
 * https://github.com/WeCodePixels/theia-sticky-sidebar
 *
 * Glues your website's sidebars, making them permanently visible while scrolling.
 *
 * Copyright 2013-2016 WeCodePixels and other contributors
 * Released under the MIT license
 */

!(function ($) {
    $.fn.theiaStickySidebar = function (options) {
        var defaults = {
            'containerSelector': '',
            'additionalMarginTop': 0,
            'additionalMarginBottom': 0,
            'updateSidebarHeight': true,
            'minWidth': 0,
            'disableOnResponsiveLayouts': true,
            'sidebarBehavior': 'modern',
            'defaultPosition': 'relative',
            'namespace': 'TSS'
        };
        options = $.extend(defaults, options);

        // Validate options
        options.additionalMarginTop = parseInt(options.additionalMarginTop) || 0;
        options.additionalMarginBottom = parseInt(options.additionalMarginBottom) || 0;

        tryInitOrHookIntoEvents(options, this);

        // Try doing init, otherwise hook into window.resize and document.scroll and try again then.
        function tryInitOrHookIntoEvents(options, $that) {
            var success = tryInit(options, $that);

            if (!success) {
                console.log('TSS: Body width smaller than options.minWidth. Init is delayed.');

                $(document).on('scroll.' + options.namespace, function (options, $that) {
                    return function (evt) {
                        var success = tryInit(options, $that);

                        if (success) {
                            $(this).unbind(evt);
                        }
                    };
                }(options, $that));
                $(window).on('resize.' + options.namespace, function (options, $that) {
                    return function (evt) {
                        var success = tryInit(options, $that);

                        if (success) {
                            $(this).unbind(evt);
                        }
                    };
                }(options, $that))
            }
        }

        // Try doing init if proper conditions are met.
        function tryInit(options, $that) {
            if (options.initialized === true) {
                return true;
            }

            if ($('body').width() < options.minWidth) {
                return false;
            }

            init(options, $that);

            return true;
        }

        // Init the sticky sidebar(s).
        function init(options, $that) {
            options.initialized = true;

            // Add CSS
            var existingStylesheet = $('#theia-sticky-sidebar-stylesheet-' + options.namespace);
            if (existingStylesheet.length === 0) {
                $('head').append($('<style id="theia-sticky-sidebar-stylesheet-' + options.namespace + '">.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>'));
            }

            $that.each(function () {
                var o = {};

                o.sidebar = $(this);

                // Save options
                o.options = options || {};

                // Get container
                o.container = $(o.options.containerSelector);
                if (o.container.length == 0) {
                    o.container = o.sidebar.parent();
                }

                // Create sticky sidebar
                o.sidebar.parents().css('-webkit-transform', 'none'); // Fix for WebKit bug - https://code.google.com/p/chromium/issues/detail?id=20574
                o.sidebar.css({
                    'position': o.options.defaultPosition,
                    'overflow': 'visible',
                    // The "box-sizing" must be set to "content-box" because we set a fixed height to this element when the sticky sidebar has a fixed position.
                    '-webkit-box-sizing': 'border-box',
                    '-moz-box-sizing': 'border-box',
                    'box-sizing': 'border-box'
                });

                // Get the sticky sidebar element. If none has been found, then create one.
                o.stickySidebar = o.sidebar.find('.theiaStickySidebar');
                if (o.stickySidebar.length == 0) {
                    // Remove <script> tags, otherwise they will be run again when added to the stickySidebar.
                    var javaScriptMIMETypes = /(?:text|application)\/(?:x-)?(?:javascript|ecmascript)/i;
                    o.sidebar.find('script').filter(function (index, script) {
                        return script.type.length === 0 || script.type.match(javaScriptMIMETypes);
                    }).remove();

                    o.stickySidebar = $('<div>').addClass('theiaStickySidebar').append(o.sidebar.children());
                    o.sidebar.append(o.stickySidebar);
                }

                // Get existing top and bottom margins and paddings
                o.marginBottom = parseInt(o.sidebar.css('margin-bottom'));
                o.paddingTop = parseInt(o.sidebar.css('padding-top'));
                o.paddingBottom = parseInt(o.sidebar.css('padding-bottom'));

                // Add a temporary padding rule to check for collapsable margins.
                var collapsedTopHeight = o.stickySidebar.offset().top;
                var collapsedBottomHeight = o.stickySidebar.outerHeight();
                o.stickySidebar.css('padding-top', 1);
                o.stickySidebar.css('padding-bottom', 1);
                collapsedTopHeight -= o.stickySidebar.offset().top;
                collapsedBottomHeight = o.stickySidebar.outerHeight() - collapsedBottomHeight - collapsedTopHeight;
                if (collapsedTopHeight == 0) {
                    o.stickySidebar.css('padding-top', 0);
                    o.stickySidebarPaddingTop = 0;
                }
                else {
                    o.stickySidebarPaddingTop = 1;
                }

                if (collapsedBottomHeight == 0) {
                    o.stickySidebar.css('padding-bottom', 0);
                    o.stickySidebarPaddingBottom = 0;
                }
                else {
                    o.stickySidebarPaddingBottom = 1;
                }

                // We use this to know whether the user is scrolling up or down.
                o.previousScrollTop = null;

                // Scroll top (value) when the sidebar has fixed position.
                o.fixedScrollTop = 0;

                // Set sidebar to default values.
                resetSidebar();

                o.onScroll = function (o) {
                    // Stop if the sidebar isn't visible.
                    if (!o.stickySidebar.is(":visible")) {
                        return;
                    }

                    // Stop if the window is too small.
                    if ($('body').width() < o.options.minWidth) {
                        resetSidebar();
                        return;
                    }

                    // Stop if the sidebar width is larger than the container width (e.g. the theme is responsive and the sidebar is now below the content)
                    if (o.options.disableOnResponsiveLayouts) {
                        var sidebarWidth = o.sidebar.outerWidth(o.sidebar.css('float') == 'none');

                        if (sidebarWidth + 50 > o.container.width()) {
                            resetSidebar();
                            return;
                        }
                    }

                    var scrollTop = $(document).scrollTop();
                    var position = 'static';

                    // If the user has scrolled down enough for the sidebar to be clipped at the top, then we can consider changing its position.
                    if (scrollTop >= o.sidebar.offset().top + (o.paddingTop - o.options.additionalMarginTop)) {
                        // The top and bottom offsets, used in various calculations.
                        var offsetTop = o.paddingTop + options.additionalMarginTop;
                        var offsetBottom = o.paddingBottom + o.marginBottom + options.additionalMarginBottom;

                        // All top and bottom positions are relative to the window, not to the parent elemnts.
                        var containerTop = o.sidebar.offset().top;
                        var containerBottom = o.sidebar.offset().top + getClearedHeight(o.container);

                        // The top and bottom offsets relative to the window screen top (zero) and bottom (window height).
                        var windowOffsetTop = 0 + options.additionalMarginTop;
                        var windowOffsetBottom;

                        var sidebarSmallerThanWindow = (o.stickySidebar.outerHeight() + offsetTop + offsetBottom) < $(window).height();
                        if (sidebarSmallerThanWindow) {
                            windowOffsetBottom = windowOffsetTop + o.stickySidebar.outerHeight();
                        }
                        else {
                            windowOffsetBottom = $(window).height() - o.marginBottom - o.paddingBottom - options.additionalMarginBottom;
                        }

                        var staticLimitTop = containerTop - scrollTop + o.paddingTop;
                        var staticLimitBottom = containerBottom - scrollTop - o.paddingBottom - o.marginBottom;

                        var top = o.stickySidebar.offset().top - scrollTop;
                        var scrollTopDiff = o.previousScrollTop - scrollTop;

                        // If the sidebar position is fixed, then it won't move up or down by itself. So, we manually adjust the top coordinate.
                        if (o.stickySidebar.css('position') == 'fixed') {
                            if (o.options.sidebarBehavior == 'modern') {
                                top += scrollTopDiff;
                            }
                        }

                        if (o.options.sidebarBehavior == 'stick-to-top') {
                            top = options.additionalMarginTop;
                        }

                        if (o.options.sidebarBehavior == 'stick-to-bottom') {
                            top = windowOffsetBottom - o.stickySidebar.outerHeight();
                        }

                        if (scrollTopDiff > 0) { // If the user is scrolling up.
                            top = Math.min(top, windowOffsetTop);
                        }
                        else { // If the user is scrolling down.
                            top = Math.max(top, windowOffsetBottom - o.stickySidebar.outerHeight());
                        }

                        top = Math.max(top, staticLimitTop);

                        top = Math.min(top, staticLimitBottom - o.stickySidebar.outerHeight());

                        // If the sidebar is the same height as the container, we won't use fixed positioning.
                        var sidebarSameHeightAsContainer = o.container.height() == o.stickySidebar.outerHeight();

                        if (!sidebarSameHeightAsContainer && top == windowOffsetTop) {
                            position = 'fixed';
                        }
                        else if (!sidebarSameHeightAsContainer && top == windowOffsetBottom - o.stickySidebar.outerHeight()) {
                            position = 'fixed';
                        }
                        else if (scrollTop + top - o.sidebar.offset().top - o.paddingTop <= options.additionalMarginTop) {
                            // Stuck to the top of the page. No special behavior.
                            position = 'static';
                        }
                        else {
                            // Stuck to the bottom of the page.
                            position = 'absolute';
                        }
                    }

                    /*
                     * Performance notice: It's OK to set these CSS values at each resize/scroll, even if they don't change.
                     * It's way slower to first check if the values have changed.
                     */
                    if (position == 'fixed') {
                        var scrollLeft = $(document).scrollLeft();

                        o.stickySidebar.css({
                            'position': 'fixed',
                            'width': getWidthForObject(o.stickySidebar) + 'px',
                            'transform': 'translateY(' + top + 'px)',
                            'left': (o.sidebar.offset().left + parseInt(o.sidebar.css('padding-left')) - scrollLeft) + 'px',
                            'top': '0px'
                        });
                    }
                    else if (position == 'absolute') {
                        var css = {};

                        if (o.stickySidebar.css('position') != 'absolute') {
                            css.position = 'absolute';
                            css.transform = 'translateY(' + (scrollTop + top - o.sidebar.offset().top - o.stickySidebarPaddingTop - o.stickySidebarPaddingBottom) + 'px)';
                            css.top = '0px';
                        }

                        css.width = getWidthForObject(o.stickySidebar) + 'px';
                        css.left = '';

                        o.stickySidebar.css(css);
                    }
                    else if (position == 'static') {
                        resetSidebar();
                    }

                    if (position != 'static') {
                        if (o.options.updateSidebarHeight == true) {
                            o.sidebar.css({
                                'min-height': o.stickySidebar.outerHeight() + o.stickySidebar.offset().top - o.sidebar.offset().top + o.paddingBottom
                            });
                        }
                    }

                    o.previousScrollTop = scrollTop;
                };

                // Initialize the sidebar's position.
                o.onScroll(o);

                // Recalculate the sidebar's position on every scroll and resize.
                $(document).on('scroll.' + o.options.namespace, function (o) {
                    return function () {
                        o.onScroll(o);
                    };
                }(o));
                $(window).on('resize.' + o.options.namespace, function (o) {
                    return function () {
                        o.stickySidebar.css({'position': 'static'});
                        o.onScroll(o);
                    };
                }(o));

                // Recalculate the sidebar's position every time the sidebar changes its size.
                if (typeof ResizeSensor !== 'undefined') {
                    new ResizeSensor(o.stickySidebar[0], function (o) {
                        return function () {
                            o.onScroll(o);
                        };
                    }(o));
                }

                // Reset the sidebar to its default state
                function resetSidebar() {
                    o.fixedScrollTop = 0;
                    o.sidebar.css({
                        'min-height': '1px'
                    });
                    o.stickySidebar.css({
                        'position': 'static',
                        'width': '',
                        'transform': 'none'
                    });
                }

                // Get the height of a div as if its floated children were cleared. Note that this function fails if the floats are more than one level deep.
                function getClearedHeight(e) {
                    var height = e.height();

                    e.children().each(function () {
                        height = Math.max(height, $(this).height());
                    });

                    return height;
                }
            });
        }

        function getWidthForObject(object) {
            var width;

            try {
                width = object[0].getBoundingClientRect().width;
            }
            catch (err) {
            }

            if (typeof width === "undefined") {
                width = object.width();
            }

            return width;
        }

        return this;
    }
})(jQuery);



/*!
 * Name    : Just Another Parallax [Jarallax]
 * Version : 1.10.6
 * Author  : nK <https://nkdev.info>
 * GitHub  : https://github.com/nk-o/jarallax
 */
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = function (callback) {

	if (document.readyState === 'complete' || document.readyState === 'interactive') {
		// Already ready or interactive, execute callback
		callback.call();
	} else if (document.attachEvent) {
		// Old browsers
		document.attachEvent('onreadystatechange', function () {
			if (document.readyState === 'interactive') callback.call();
		});
	} else if (document.addEventListener) {
		// Modern browsers
		document.addEventListener('DOMContentLoaded', callback);
	}
};

/***/ }),
/* 3 */,
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(global) {

var win;

if (typeof window !== "undefined") {
    win = window;
} else if (typeof global !== "undefined") {
    win = global;
} else if (typeof self !== "undefined") {
    win = self;
} else {
    win = {};
}

module.exports = win;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(5)))

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var g;

// This works in non-strict mode
g = function () {
	return this;
}();

try {
	// This works if eval is allowed (see CSP)
	g = g || Function("return this")() || (1, eval)("this");
} catch (e) {
	// This works if the window reference is available
	if ((typeof window === "undefined" ? "undefined" : _typeof(window)) === "object") g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;

/***/ }),
/* 6 */,
/* 7 */,
/* 8 */,
/* 9 */,
/* 10 */,
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(12);


/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var _liteReady = __webpack_require__(2);

var _liteReady2 = _interopRequireDefault(_liteReady);

var _global = __webpack_require__(4);

var _jarallax = __webpack_require__(13);

var _jarallax2 = _interopRequireDefault(_jarallax);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// no conflict
var oldPlugin = _global.window.jarallax;
_global.window.jarallax = _jarallax2.default;
_global.window.jarallax.noConflict = function () {
    _global.window.jarallax = oldPlugin;
    return this;
};

// jQuery support
if (typeof _global.jQuery !== 'undefined') {
    var jQueryPlugin = function jQueryPlugin() {
        var args = arguments || [];
        Array.prototype.unshift.call(args, this);
        var res = _jarallax2.default.apply(_global.window, args);
        return (typeof res === 'undefined' ? 'undefined' : _typeof(res)) !== 'object' ? res : this;
    };
    jQueryPlugin.constructor = _jarallax2.default.constructor;

    // no conflict
    var oldJqPlugin = _global.jQuery.fn.jarallax;
    _global.jQuery.fn.jarallax = jQueryPlugin;
    _global.jQuery.fn.jarallax.noConflict = function () {
        _global.jQuery.fn.jarallax = oldJqPlugin;
        return this;
    };
}

// data-jarallax initialization
(0, _liteReady2.default)(function () {
    (0, _jarallax2.default)(document.querySelectorAll('[data-jarallax]'));
});

/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(global) {

Object.defineProperty(exports, "__esModule", {
    value: true
});

var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var _liteReady = __webpack_require__(2);

var _liteReady2 = _interopRequireDefault(_liteReady);

var _rafl = __webpack_require__(14);

var _rafl2 = _interopRequireDefault(_rafl);

var _global = __webpack_require__(4);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var isIE = navigator.userAgent.indexOf('MSIE ') > -1 || navigator.userAgent.indexOf('Trident/') > -1 || navigator.userAgent.indexOf('Edge/') > -1;

var supportTransform = function () {
    var prefixes = 'transform WebkitTransform MozTransform'.split(' ');
    var div = document.createElement('div');
    for (var i = 0; i < prefixes.length; i++) {
        if (div && div.style[prefixes[i]] !== undefined) {
            return prefixes[i];
        }
    }
    return false;
}();

// Window data
var wndW = void 0;
var wndH = void 0;
var wndY = void 0;
var forceResizeParallax = false;
var forceScrollParallax = false;
function updateWndVars(e) {
    wndW = _global.window.innerWidth || document.documentElement.clientWidth;
    wndH = _global.window.innerHeight || document.documentElement.clientHeight;
    if ((typeof e === 'undefined' ? 'undefined' : _typeof(e)) === 'object' && (e.type === 'load' || e.type === 'dom-loaded')) {
        forceResizeParallax = true;
    }
}
updateWndVars();
_global.window.addEventListener('resize', updateWndVars);
_global.window.addEventListener('orientationchange', updateWndVars);
_global.window.addEventListener('load', updateWndVars);
(0, _liteReady2.default)(function () {
    updateWndVars({
        type: 'dom-loaded'
    });
});

// list with all jarallax instances
// need to render all in one scroll/resize event
var jarallaxList = [];

// Animate if changed window size or scrolled page
var oldPageData = false;
function updateParallax() {
    if (!jarallaxList.length) {
        return;
    }

    if (_global.window.pageYOffset !== undefined) {
        wndY = _global.window.pageYOffset;
    } else {
        wndY = (document.documentElement || document.body.parentNode || document.body).scrollTop;
    }

    var isResized = forceResizeParallax || !oldPageData || oldPageData.width !== wndW || oldPageData.height !== wndH;
    var isScrolled = forceScrollParallax || isResized || !oldPageData || oldPageData.y !== wndY;

    forceResizeParallax = false;
    forceScrollParallax = false;

    if (isResized || isScrolled) {
        jarallaxList.forEach(function (item) {
            if (isResized) {
                item.onResize();
            }
            if (isScrolled) {
                item.onScroll();
            }
        });

        oldPageData = {
            width: wndW,
            height: wndH,
            y: wndY
        };
    }

    (0, _rafl2.default)(updateParallax);
}

// ResizeObserver
var resizeObserver = global.ResizeObserver ? new global.ResizeObserver(function (entry) {
    if (entry && entry.length) {
        (0, _rafl2.default)(function () {
            entry.forEach(function (item) {
                if (item.target && item.target.jarallax) {
                    if (!forceResizeParallax) {
                        item.target.jarallax.onResize();
                    }
                    forceScrollParallax = true;
                }
            });
        });
    }
}) : false;

var instanceID = 0;

// Jarallax class

var Jarallax = function () {
    function Jarallax(item, userOptions) {
        _classCallCheck(this, Jarallax);

        var self = this;

        self.instanceID = instanceID++;

        self.$item = item;

        self.defaults = {
            type: 'scroll', // type of parallax: scroll, scale, opacity, scale-opacity, scroll-opacity
            speed: 0.5, // supported value from -1 to 2
            imgSrc: null,
            imgElement: '.jarallax-img',
            imgSize: 'cover',
            imgPosition: '50% 50%',
            imgRepeat: 'no-repeat', // supported only for background, not for <img> tag
            keepImg: false, // keep <img> tag in it's default place
            elementInViewport: null,
            zIndex: -100,
            disableParallax: false,
            disableVideo: false,
            automaticResize: true, // use ResizeObserver to recalculate position and size of parallax image

            // video
            videoSrc: null,
            videoStartTime: 0,
            videoEndTime: 0,
            videoVolume: 0,
            videoPlayOnlyVisible: true,

            // events
            onScroll: null, // function(calculations) {}
            onInit: null, // function() {}
            onDestroy: null, // function() {}
            onCoverImage: null // function() {}
        };

        // DEPRECATED: old data-options
        var deprecatedDataAttribute = self.$item.getAttribute('data-jarallax');
        var oldDataOptions = JSON.parse(deprecatedDataAttribute || '{}');
        if (deprecatedDataAttribute) {
            // eslint-disable-next-line no-console
            console.warn('Detected usage of deprecated data-jarallax JSON options, you should use pure data-attribute options. See info here - https://github.com/nk-o/jarallax/issues/53');
        }

        // prepare data-options
        var dataOptions = self.$item.dataset || {};
        var pureDataOptions = {};
        Object.keys(dataOptions).forEach(function (key) {
            var loweCaseOption = key.substr(0, 1).toLowerCase() + key.substr(1);
            if (loweCaseOption && typeof self.defaults[loweCaseOption] !== 'undefined') {
                pureDataOptions[loweCaseOption] = dataOptions[key];
            }
        });

        self.options = self.extend({}, self.defaults, oldDataOptions, pureDataOptions, userOptions);
        self.pureOptions = self.extend({}, self.options);

        // prepare 'true' and 'false' strings to boolean
        Object.keys(self.options).forEach(function (key) {
            if (self.options[key] === 'true') {
                self.options[key] = true;
            } else if (self.options[key] === 'false') {
                self.options[key] = false;
            }
        });

        // fix speed option [-1.0, 2.0]
        self.options.speed = Math.min(2, Math.max(-1, parseFloat(self.options.speed)));

        // deprecated noAndroid and noIos options
        if (self.options.noAndroid || self.options.noIos) {
            // eslint-disable-next-line no-console
            console.warn('Detected usage of deprecated noAndroid or noIos options, you should use disableParallax option. See info here - https://github.com/nk-o/jarallax/#disable-on-mobile-devices');

            // prepare fallback if disableParallax option is not used
            if (!self.options.disableParallax) {
                if (self.options.noIos && self.options.noAndroid) {
                    self.options.disableParallax = /iPad|iPhone|iPod|Android/;
                } else if (self.options.noIos) {
                    self.options.disableParallax = /iPad|iPhone|iPod/;
                } else if (self.options.noAndroid) {
                    self.options.disableParallax = /Android/;
                }
            }
        }

        // prepare disableParallax callback
        if (typeof self.options.disableParallax === 'string') {
            self.options.disableParallax = new RegExp(self.options.disableParallax);
        }
        if (self.options.disableParallax instanceof RegExp) {
            var disableParallaxRegexp = self.options.disableParallax;
            self.options.disableParallax = function () {
                return disableParallaxRegexp.test(navigator.userAgent);
            };
        }
        if (typeof self.options.disableParallax !== 'function') {
            self.options.disableParallax = function () {
                return false;
            };
        }

        // prepare disableVideo callback
        if (typeof self.options.disableVideo === 'string') {
            self.options.disableVideo = new RegExp(self.options.disableVideo);
        }
        if (self.options.disableVideo instanceof RegExp) {
            var disableVideoRegexp = self.options.disableVideo;
            self.options.disableVideo = function () {
                return disableVideoRegexp.test(navigator.userAgent);
            };
        }
        if (typeof self.options.disableVideo !== 'function') {
            self.options.disableVideo = function () {
                return false;
            };
        }

        // custom element to check if parallax in viewport
        var elementInVP = self.options.elementInViewport;
        // get first item from array
        if (elementInVP && (typeof elementInVP === 'undefined' ? 'undefined' : _typeof(elementInVP)) === 'object' && typeof elementInVP.length !== 'undefined') {
            var _elementInVP = elementInVP;

            var _elementInVP2 = _slicedToArray(_elementInVP, 1);

            elementInVP = _elementInVP2[0];
        }
        // check if dom element
        if (!(elementInVP instanceof Element)) {
            elementInVP = null;
        }
        self.options.elementInViewport = elementInVP;

        self.image = {
            src: self.options.imgSrc || null,
            $container: null,
            useImgTag: false,

            // position fixed is needed for the most of browsers because absolute position have glitches
            // on MacOS with smooth scroll there is a huge lags with absolute position - https://github.com/nk-o/jarallax/issues/75
            // on mobile devices better scrolled with absolute position
            position: /iPad|iPhone|iPod|Android/.test(navigator.userAgent) ? 'absolute' : 'fixed'
        };

        if (self.initImg() && self.canInitParallax()) {
            self.init();
        }
    }

    // add styles to element


    _createClass(Jarallax, [{
        key: 'css',
        value: function css(el, styles) {
            if (typeof styles === 'string') {
                return _global.window.getComputedStyle(el).getPropertyValue(styles);
            }

            // add transform property with vendor prefix
            if (styles.transform && supportTransform) {
                styles[supportTransform] = styles.transform;
            }

            Object.keys(styles).forEach(function (key) {
                el.style[key] = styles[key];
            });
            return el;
        }

        // Extend like jQuery.extend

    }, {
        key: 'extend',
        value: function extend(out) {
            var _arguments = arguments;

            out = out || {};
            Object.keys(arguments).forEach(function (i) {
                if (!_arguments[i]) {
                    return;
                }
                Object.keys(_arguments[i]).forEach(function (key) {
                    out[key] = _arguments[i][key];
                });
            });
            return out;
        }

        // get window size and scroll position. Useful for extensions

    }, {
        key: 'getWindowData',
        value: function getWindowData() {
            return {
                width: wndW,
                height: wndH,
                y: wndY
            };
        }

        // Jarallax functions

    }, {
        key: 'initImg',
        value: function initImg() {
            var self = this;

            // find image element
            var $imgElement = self.options.imgElement;
            if ($imgElement && typeof $imgElement === 'string') {
                $imgElement = self.$item.querySelector($imgElement);
            }
            // check if dom element
            if (!($imgElement instanceof Element)) {
                $imgElement = null;
            }

            if ($imgElement) {
                if (self.options.keepImg) {
                    self.image.$item = $imgElement.cloneNode(true);
                } else {
                    self.image.$item = $imgElement;
                    self.image.$itemParent = $imgElement.parentNode;
                }
                self.image.useImgTag = true;
            }

            // true if there is img tag
            if (self.image.$item) {
                return true;
            }

            // get image src
            if (self.image.src === null) {
                self.image.src = self.css(self.$item, 'background-image').replace(/^url\(['"]?/g, '').replace(/['"]?\)$/g, '');
            }
            return !(!self.image.src || self.image.src === 'none');
        }
    }, {
        key: 'canInitParallax',
        value: function canInitParallax() {
            return supportTransform && !this.options.disableParallax();
        }
    }, {
        key: 'init',
        value: function init() {
            var self = this;
            var containerStyles = {
                position: 'absolute',
                top: 0,
                left: 0,
                width: '100%',
                height: '100%',
                overflow: 'hidden',
                pointerEvents: 'none'
            };
            var imageStyles = {};

            if (!self.options.keepImg) {
                // save default user styles
                var curStyle = self.$item.getAttribute('style');
                if (curStyle) {
                    self.$item.setAttribute('data-jarallax-original-styles', curStyle);
                }
                if (self.image.useImgTag) {
                    var curImgStyle = self.image.$item.getAttribute('style');
                    if (curImgStyle) {
                        self.image.$item.setAttribute('data-jarallax-original-styles', curImgStyle);
                    }
                }
            }

            // set relative position and z-index to the parent
            if (self.css(self.$item, 'position') === 'static') {
                self.css(self.$item, {
                    position: 'relative'
                });
            }
            if (self.css(self.$item, 'z-index') === 'auto') {
                self.css(self.$item, {
                    zIndex: 0
                });
            }

            // container for parallax image
            self.image.$container = document.createElement('div');
            self.css(self.image.$container, containerStyles);
            self.css(self.image.$container, {
                'z-index': self.options.zIndex
            });

            // fix for IE https://github.com/nk-o/jarallax/issues/110
            if (isIE) {
                self.css(self.image.$container, {
                    opacity: 0.9999
                });
            }

            self.image.$container.setAttribute('id', 'jarallax-container-' + self.instanceID);
            self.$item.appendChild(self.image.$container);

            // use img tag
            if (self.image.useImgTag) {
                imageStyles = self.extend({
                    'object-fit': self.options.imgSize,
                    'object-position': self.options.imgPosition,
                    // support for plugin https://github.com/bfred-it/object-fit-images
                    'font-family': 'object-fit: ' + self.options.imgSize + '; object-position: ' + self.options.imgPosition + ';',
                    'max-width': 'none'
                }, containerStyles, imageStyles);

                // use div with background image
            } else {
                self.image.$item = document.createElement('div');
                if (self.image.src) {
                    imageStyles = self.extend({
                        'background-position': self.options.imgPosition,
                        'background-size': self.options.imgSize,
                        'background-repeat': self.options.imgRepeat,
                        'background-image': 'url("' + self.image.src + '")'
                    }, containerStyles, imageStyles);
                }
            }

            if (self.options.type === 'opacity' || self.options.type === 'scale' || self.options.type === 'scale-opacity' || self.options.speed === 1) {
                self.image.position = 'absolute';
            }

            // check if one of parents have transform style (without this check, scroll transform will be inverted if used parallax with position fixed)
            // discussion - https://github.com/nk-o/jarallax/issues/9
            if (self.image.position === 'fixed') {
                var parentWithTransform = 0;
                var $itemParents = self.$item;
                while ($itemParents !== null && $itemParents !== document && parentWithTransform === 0) {
                    var parentTransform = self.css($itemParents, '-webkit-transform') || self.css($itemParents, '-moz-transform') || self.css($itemParents, 'transform');
                    if (parentTransform && parentTransform !== 'none') {
                        parentWithTransform = 1;
                        self.image.position = 'absolute';
                    }
                    $itemParents = $itemParents.parentNode;
                }
            }

            // add position to parallax block
            imageStyles.position = self.image.position;

            // insert parallax image
            self.css(self.image.$item, imageStyles);
            self.image.$container.appendChild(self.image.$item);

            // set initial position and size
            self.onResize();
            self.onScroll(true);

            // ResizeObserver
            if (self.options.automaticResize && resizeObserver) {
                resizeObserver.observe(self.$item);
            }

            // call onInit event
            if (self.options.onInit) {
                self.options.onInit.call(self);
            }

            // remove default user background
            if (self.css(self.$item, 'background-image') !== 'none') {
                self.css(self.$item, {
                    'background-image': 'none'
                });
            }

            self.addToParallaxList();
        }

        // add to parallax instances list

    }, {
        key: 'addToParallaxList',
        value: function addToParallaxList() {
            jarallaxList.push(this);

            if (jarallaxList.length === 1) {
                updateParallax();
            }
        }

        // remove from parallax instances list

    }, {
        key: 'removeFromParallaxList',
        value: function removeFromParallaxList() {
            var self = this;

            jarallaxList.forEach(function (item, key) {
                if (item.instanceID === self.instanceID) {
                    jarallaxList.splice(key, 1);
                }
            });
        }
    }, {
        key: 'destroy',
        value: function destroy() {
            var self = this;

            self.removeFromParallaxList();

            // return styles on container as before jarallax init
            var originalStylesTag = self.$item.getAttribute('data-jarallax-original-styles');
            self.$item.removeAttribute('data-jarallax-original-styles');
            // null occurs if there is no style tag before jarallax init
            if (!originalStylesTag) {
                self.$item.removeAttribute('style');
            } else {
                self.$item.setAttribute('style', originalStylesTag);
            }

            if (self.image.useImgTag) {
                // return styles on img tag as before jarallax init
                var originalStylesImgTag = self.image.$item.getAttribute('data-jarallax-original-styles');
                self.image.$item.removeAttribute('data-jarallax-original-styles');
                // null occurs if there is no style tag before jarallax init
                if (!originalStylesImgTag) {
                    self.image.$item.removeAttribute('style');
                } else {
                    self.image.$item.setAttribute('style', originalStylesTag);
                }

                // move img tag to its default position
                if (self.image.$itemParent) {
                    self.image.$itemParent.appendChild(self.image.$item);
                }
            }

            // remove additional dom elements
            if (self.$clipStyles) {
                self.$clipStyles.parentNode.removeChild(self.$clipStyles);
            }
            if (self.image.$container) {
                self.image.$container.parentNode.removeChild(self.image.$container);
            }

            // call onDestroy event
            if (self.options.onDestroy) {
                self.options.onDestroy.call(self);
            }

            // delete jarallax from item
            delete self.$item.jarallax;
        }

        // it will remove some image overlapping
        // overlapping occur due to an image position fixed inside absolute position element

    }, {
        key: 'clipContainer',
        value: function clipContainer() {
            // needed only when background in fixed position
            if (this.image.position !== 'fixed') {
                return;
            }

            var self = this;
            var rect = self.image.$container.getBoundingClientRect();
            var width = rect.width,
                height = rect.height;


            if (!self.$clipStyles) {
                self.$clipStyles = document.createElement('style');
                self.$clipStyles.setAttribute('type', 'text/css');
                self.$clipStyles.setAttribute('id', 'jarallax-clip-' + self.instanceID);
                var head = document.head || document.getElementsByTagName('head')[0];
                head.appendChild(self.$clipStyles);
            }

            var styles = '#jarallax-container-' + self.instanceID + ' {\n           clip: rect(0 ' + width + 'px ' + height + 'px 0);\n           clip: rect(0, ' + width + 'px, ' + height + 'px, 0);\n        }';

            // add clip styles inline (this method need for support IE8 and less browsers)
            if (self.$clipStyles.styleSheet) {
                self.$clipStyles.styleSheet.cssText = styles;
            } else {
                self.$clipStyles.innerHTML = styles;
            }
        }
    }, {
        key: 'coverImage',
        value: function coverImage() {
            var self = this;

            var rect = self.image.$container.getBoundingClientRect();
            var contH = rect.height;
            var speed = self.options.speed;

            var isScroll = self.options.type === 'scroll' || self.options.type === 'scroll-opacity';
            var scrollDist = 0;
            var resultH = contH;
            var resultMT = 0;

            // scroll parallax
            if (isScroll) {
                // scroll distance and height for image
                if (speed < 0) {
                    scrollDist = speed * Math.max(contH, wndH);

                    if (wndH < contH) {
                        scrollDist -= speed * (contH - wndH);
                    }
                } else {
                    scrollDist = speed * (contH + wndH);
                }

                // size for scroll parallax
                if (speed > 1) {
                    resultH = Math.abs(scrollDist - wndH);
                } else if (speed < 0) {
                    resultH = scrollDist / speed + Math.abs(scrollDist);
                } else {
                    resultH += (wndH - contH) * (1 - speed);
                }

                scrollDist /= 2;
            }

            // store scroll distance
            self.parallaxScrollDistance = scrollDist;

            // vertical center
            if (isScroll) {
                resultMT = (wndH - resultH) / 2;
            } else {
                resultMT = (contH - resultH) / 2;
            }

            // apply result to item
            self.css(self.image.$item, {
                height: resultH + 'px',
                marginTop: resultMT + 'px',
                left: self.image.position === 'fixed' ? rect.left + 'px' : '0',
                width: rect.width + 'px'
            });

            // call onCoverImage event
            if (self.options.onCoverImage) {
                self.options.onCoverImage.call(self);
            }

            // return some useful data. Used in the video cover function
            return {
                image: {
                    height: resultH,
                    marginTop: resultMT
                },
                container: rect
            };
        }
    }, {
        key: 'isVisible',
        value: function isVisible() {
            return this.isElementInViewport || false;
        }
    }, {
        key: 'onScroll',
        value: function onScroll(force) {
            var self = this;

            var rect = self.$item.getBoundingClientRect();
            var contT = rect.top;
            var contH = rect.height;
            var styles = {};

            // check if in viewport
            var viewportRect = rect;
            if (self.options.elementInViewport) {
                viewportRect = self.options.elementInViewport.getBoundingClientRect();
            }
            self.isElementInViewport = viewportRect.bottom >= 0 && viewportRect.right >= 0 && viewportRect.top <= wndH && viewportRect.left <= wndW;

            // stop calculations if item is not in viewport
            if (force ? false : !self.isElementInViewport) {
                return;
            }

            // calculate parallax helping variables
            var beforeTop = Math.max(0, contT);
            var beforeTopEnd = Math.max(0, contH + contT);
            var afterTop = Math.max(0, -contT);
            var beforeBottom = Math.max(0, contT + contH - wndH);
            var beforeBottomEnd = Math.max(0, contH - (contT + contH - wndH));
            var afterBottom = Math.max(0, -contT + wndH - contH);
            var fromViewportCenter = 1 - 2 * (wndH - contT) / (wndH + contH);

            // calculate on how percent of section is visible
            var visiblePercent = 1;
            if (contH < wndH) {
                visiblePercent = 1 - (afterTop || beforeBottom) / contH;
            } else if (beforeTopEnd <= wndH) {
                visiblePercent = beforeTopEnd / wndH;
            } else if (beforeBottomEnd <= wndH) {
                visiblePercent = beforeBottomEnd / wndH;
            }

            // opacity
            if (self.options.type === 'opacity' || self.options.type === 'scale-opacity' || self.options.type === 'scroll-opacity') {
                styles.transform = 'translate3d(0,0,0)';
                styles.opacity = visiblePercent;
            }

            // scale
            if (self.options.type === 'scale' || self.options.type === 'scale-opacity') {
                var scale = 1;
                if (self.options.speed < 0) {
                    scale -= self.options.speed * visiblePercent;
                } else {
                    scale += self.options.speed * (1 - visiblePercent);
                }
                styles.transform = 'scale(' + scale + ') translate3d(0,0,0)';
            }

            // scroll
            if (self.options.type === 'scroll' || self.options.type === 'scroll-opacity') {
                var positionY = self.parallaxScrollDistance * fromViewportCenter;

                // fix if parallax block in absolute position
                if (self.image.position === 'absolute') {
                    positionY -= contT;
                }

                styles.transform = 'translate3d(0,' + positionY + 'px,0)';
            }

            self.css(self.image.$item, styles);

            // call onScroll event
            if (self.options.onScroll) {
                self.options.onScroll.call(self, {
                    section: rect,

                    beforeTop: beforeTop,
                    beforeTopEnd: beforeTopEnd,
                    afterTop: afterTop,
                    beforeBottom: beforeBottom,
                    beforeBottomEnd: beforeBottomEnd,
                    afterBottom: afterBottom,

                    visiblePercent: visiblePercent,
                    fromViewportCenter: fromViewportCenter
                });
            }
        }
    }, {
        key: 'onResize',
        value: function onResize() {
            this.coverImage();
            this.clipContainer();
        }
    }]);

    return Jarallax;
}();

// global definition


var plugin = function plugin(items) {
    // check for dom element
    // thanks: http://stackoverflow.com/questions/384286/javascript-isdom-how-do-you-check-if-a-javascript-object-is-a-dom-object
    if ((typeof HTMLElement === 'undefined' ? 'undefined' : _typeof(HTMLElement)) === 'object' ? items instanceof HTMLElement : items && (typeof items === 'undefined' ? 'undefined' : _typeof(items)) === 'object' && items !== null && items.nodeType === 1 && typeof items.nodeName === 'string') {
        items = [items];
    }

    var options = arguments[1];
    var args = Array.prototype.slice.call(arguments, 2);
    var len = items.length;
    var k = 0;
    var ret = void 0;

    for (k; k < len; k++) {
        if ((typeof options === 'undefined' ? 'undefined' : _typeof(options)) === 'object' || typeof options === 'undefined') {
            if (!items[k].jarallax) {
                items[k].jarallax = new Jarallax(items[k], options);
            }
        } else if (items[k].jarallax) {
            // eslint-disable-next-line prefer-spread
            ret = items[k].jarallax[options].apply(items[k].jarallax, args);
        }
        if (typeof ret !== 'undefined') {
            return ret;
        }
    }

    return items;
};
plugin.constructor = Jarallax;

exports.default = plugin;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(5)))

/***/ }),
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var global = __webpack_require__(4);

/**
 * `requestAnimationFrame()`
 */

var request = global.requestAnimationFrame || global.webkitRequestAnimationFrame || global.mozRequestAnimationFrame || fallback;

var prev = +new Date();
function fallback(fn) {
  var curr = +new Date();
  var ms = Math.max(0, 16 - (curr - prev));
  var req = setTimeout(fn, ms);
  return prev = curr, req;
}

/**
 * `cancelAnimationFrame()`
 */

var cancel = global.cancelAnimationFrame || global.webkitCancelAnimationFrame || global.mozCancelAnimationFrame || clearTimeout;

if (Function.prototype.bind) {
  request = request.bind(global);
  cancel = cancel.bind(global);
}

exports = module.exports = request;
exports.cancel = cancel;

/***/ })
/******/ ]);

/*!
 * Name    : Elements Extension for Jarallax
 * Version : 1.0.0
 * Author  : nK <https://nkdev.info>
 * GitHub  : https://github.com/nk-o/jarallax
 */
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(1);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _liteReady = __webpack_require__(2);

var _liteReady2 = _interopRequireDefault(_liteReady);

var _jarallaxElement = __webpack_require__(3);

var _jarallaxElement2 = _interopRequireDefault(_jarallaxElement);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

(0, _jarallaxElement2.default)();

// data-jarallax-element initialization
(0, _liteReady2.default)(function () {
    if (typeof jarallax !== 'undefined') {
        jarallax(document.querySelectorAll('[data-jarallax-element]'));
    }
});

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = function (callback) {

	if (document.readyState === 'complete' || document.readyState === 'interactive') {
		// Already ready or interactive, execute callback
		callback.call();
	} else if (document.attachEvent) {
		// Old browsers
		document.attachEvent('onreadystatechange', function () {
			if (document.readyState === 'interactive') callback.call();
		});
	} else if (document.addEventListener) {
		// Modern browsers
		document.addEventListener('DOMContentLoaded', callback);
	}
};

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = jarallaxElement;

var _global = __webpack_require__(4);

var _global2 = _interopRequireDefault(_global);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function jarallaxElement() {
    var jarallax = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : _global2.default.jarallax;

    if (typeof jarallax === 'undefined') {
        return;
    }

    var Jarallax = jarallax.constructor;

    // redefine default methods
    ['initImg', 'canInitParallax', 'init', 'destroy', 'clipContainer', 'coverImage', 'isVisible', 'onScroll', 'onResize'].forEach(function (key) {
        var def = Jarallax.prototype[key];
        Jarallax.prototype[key] = function () {
            var self = this;
            var args = arguments || [];

            if (key === 'initImg' && self.$item.getAttribute('data-jarallax-element') !== null) {
                self.options.type = 'element';
                self.pureOptions.speed = self.$item.getAttribute('data-jarallax-element') || self.pureOptions.speed;
            }
            if (self.options.type !== 'element') {
                return def.apply(self, args);
            }

            self.pureOptions.threshold = self.$item.getAttribute('data-threshold') || '';

            switch (key) {
                case 'init':
                    var speedArr = self.pureOptions.speed.split(' ');
                    self.options.speed = self.pureOptions.speed || 0;
                    self.options.speedY = speedArr[0] ? parseFloat(speedArr[0]) : 0;
                    self.options.speedX = speedArr[1] ? parseFloat(speedArr[1]) : 0;

                    var thresholdArr = self.pureOptions.threshold.split(' ');
                    self.options.thresholdY = thresholdArr[0] ? parseFloat(thresholdArr[0]) : null;
                    self.options.thresholdX = thresholdArr[1] ? parseFloat(thresholdArr[1]) : null;
                    break;
                case 'onResize':
                    var defTransform = self.css(self.$item, 'transform');
                    self.css(self.$item, { transform: '' });
                    var rect = self.$item.getBoundingClientRect();
                    self.itemData = {
                        width: rect.width,
                        height: rect.height,
                        y: rect.top + self.getWindowData().y,
                        x: rect.left
                    };
                    self.css(self.$item, { transform: defTransform });
                    break;
                case 'onScroll':
                    var wnd = self.getWindowData();
                    var centerPercent = (wnd.y + wnd.height / 2 - self.itemData.y - self.itemData.height / 2) / (wnd.height / 2);
                    var moveY = centerPercent * self.options.speedY;
                    var moveX = centerPercent * self.options.speedX;
                    var my = moveY;
                    var mx = moveX;
                    if (self.options.thresholdY !== null && moveY > self.options.thresholdY) my = 0;
                    if (self.options.thresholdX !== null && moveX > self.options.thresholdX) mx = 0;
                    self.css(self.$item, { transform: 'translate3d(' + mx + 'px,' + my + 'px,0)' });
                    break;
                case 'initImg':
                case 'isVisible':
                case 'clipContainer':
                case 'coverImage':
                    return true;
                // no default
            }
            return def.apply(self, args);
        };
    });
} /* eslint no-case-declarations: "off" */

/***/ }),
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(global) {

var win;

if (typeof window !== "undefined") {
    win = window;
} else if (typeof global !== "undefined") {
    win = global;
} else if (typeof self !== "undefined") {
    win = self;
} else {
    win = {};
}

module.exports = win;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(5)))

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var g;

// This works in non-strict mode
g = function () {
	return this;
}();

try {
	// This works if eval is allowed (see CSP)
	g = g || Function("return this")() || (1, eval)("this");
} catch (e) {
	// This works if the window reference is available
	if ((typeof window === "undefined" ? "undefined" : _typeof(window)) === "object") g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;

/***/ })
/******/ ]);

/*!
 * Name    : Video Background Extension for Jarallax
 * Version : 1.0.1
 * Author  : nK <https://nkdev.info>
 * GitHub  : https://github.com/nk-o/jarallax
 */
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = function (callback) {

	if (document.readyState === 'complete' || document.readyState === 'interactive') {
		// Already ready or interactive, execute callback
		callback.call();
	} else if (document.attachEvent) {
		// Old browsers
		document.attachEvent('onreadystatechange', function () {
			if (document.readyState === 'interactive') callback.call();
		});
	} else if (document.addEventListener) {
		// Modern browsers
		document.addEventListener('DOMContentLoaded', callback);
	}
};

/***/ }),
/* 3 */,
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
/* WEBPACK VAR INJECTION */(function(global) {

var win;

if (typeof window !== "undefined") {
    win = window;
} else if (typeof global !== "undefined") {
    win = global;
} else if (typeof self !== "undefined") {
    win = self;
} else {
    win = {};
}

module.exports = win;
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(5)))

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var g;

// This works in non-strict mode
g = function () {
	return this;
}();

try {
	// This works if eval is allowed (see CSP)
	g = g || Function("return this")() || (1, eval)("this");
} catch (e) {
	// This works if the window reference is available
	if ((typeof window === "undefined" ? "undefined" : _typeof(window)) === "object") g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(7);


/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _videoWorker = __webpack_require__(8);

var _videoWorker2 = _interopRequireDefault(_videoWorker);

var _global = __webpack_require__(4);

var _global2 = _interopRequireDefault(_global);

var _liteReady = __webpack_require__(2);

var _liteReady2 = _interopRequireDefault(_liteReady);

var _jarallaxVideo = __webpack_require__(10);

var _jarallaxVideo2 = _interopRequireDefault(_jarallaxVideo);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// add video worker globally to fallback jarallax < 1.10 versions
_global2.default.VideoWorker = _global2.default.VideoWorker || _videoWorker2.default;

(0, _jarallaxVideo2.default)();

// data-jarallax-video initialization
(0, _liteReady2.default)(function () {
    if (typeof jarallax !== 'undefined') {
        jarallax(document.querySelectorAll('[data-jarallax-video]'));
    }
});

/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


module.exports = __webpack_require__(9);

/***/ }),
/* 9 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});

var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// Deferred
// thanks http://stackoverflow.com/questions/18096715/implement-deferred-object-without-using-jquery
function Deferred() {
    this._done = [];
    this._fail = [];
}
Deferred.prototype = {
    execute: function execute(list, args) {
        var i = list.length;
        args = Array.prototype.slice.call(args);
        while (i--) {
            list[i].apply(null, args);
        }
    },
    resolve: function resolve() {
        this.execute(this._done, arguments);
    },
    reject: function reject() {
        this.execute(this._fail, arguments);
    },
    done: function done(callback) {
        this._done.push(callback);
    },
    fail: function fail(callback) {
        this._fail.push(callback);
    }
};

var ID = 0;
var YoutubeAPIadded = 0;
var VimeoAPIadded = 0;
var loadingYoutubePlayer = 0;
var loadingVimeoPlayer = 0;
var loadingYoutubeDefer = new Deferred();
var loadingVimeoDefer = new Deferred();

var VideoWorker = function () {
    function VideoWorker(url, options) {
        _classCallCheck(this, VideoWorker);

        var self = this;

        self.url = url;

        self.options_default = {
            autoplay: false,
            loop: false,
            mute: false,
            volume: 100,
            showContols: true,

            // start / end video time in seconds
            startTime: 0,
            endTime: 0
        };

        self.options = self.extend({}, self.options_default, options);

        // check URL
        self.videoID = self.parseURL(url);

        // init
        if (self.videoID) {
            self.ID = ID++;
            self.loadAPI();
            self.init();
        }
    }

    // Extend like jQuery.extend


    _createClass(VideoWorker, [{
        key: 'extend',
        value: function extend(out) {
            var _arguments = arguments;

            out = out || {};
            Object.keys(arguments).forEach(function (i) {
                if (!_arguments[i]) {
                    return;
                }
                Object.keys(_arguments[i]).forEach(function (key) {
                    out[key] = _arguments[i][key];
                });
            });
            return out;
        }
    }, {
        key: 'parseURL',
        value: function parseURL(url) {
            // parse youtube ID
            function getYoutubeID(ytUrl) {
                // eslint-disable-next-line no-useless-escape
                var regExp = /.*(?:youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/;
                var match = ytUrl.match(regExp);
                return match && match[1].length === 11 ? match[1] : false;
            }

            // parse vimeo ID
            function getVimeoID(vmUrl) {
                // eslint-disable-next-line no-useless-escape
                var regExp = /https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/;
                var match = vmUrl.match(regExp);
                return match && match[3] ? match[3] : false;
            }

            // parse local string
            function getLocalVideos(locUrl) {
                // eslint-disable-next-line no-useless-escape
                var videoFormats = locUrl.split(/,(?=mp4\:|webm\:|ogv\:|ogg\:)/);
                var result = {};
                var ready = 0;
                videoFormats.forEach(function (val) {
                    // eslint-disable-next-line no-useless-escape
                    var match = val.match(/^(mp4|webm|ogv|ogg)\:(.*)/);
                    if (match && match[1] && match[2]) {
                        // eslint-disable-next-line prefer-destructuring
                        result[match[1] === 'ogv' ? 'ogg' : match[1]] = match[2];
                        ready = 1;
                    }
                });
                return ready ? result : false;
            }

            var Youtube = getYoutubeID(url);
            var Vimeo = getVimeoID(url);
            var Local = getLocalVideos(url);

            if (Youtube) {
                this.type = 'youtube';
                return Youtube;
            } else if (Vimeo) {
                this.type = 'vimeo';
                return Vimeo;
            } else if (Local) {
                this.type = 'local';
                return Local;
            }

            return false;
        }
    }, {
        key: 'isValid',
        value: function isValid() {
            return !!this.videoID;
        }

        // events

    }, {
        key: 'on',
        value: function on(name, callback) {
            this.userEventsList = this.userEventsList || [];

            // add new callback in events list
            (this.userEventsList[name] || (this.userEventsList[name] = [])).push(callback);
        }
    }, {
        key: 'off',
        value: function off(name, callback) {
            var _this = this;

            if (!this.userEventsList || !this.userEventsList[name]) {
                return;
            }

            if (!callback) {
                delete this.userEventsList[name];
            } else {
                this.userEventsList[name].forEach(function (val, key) {
                    if (val === callback) {
                        _this.userEventsList[name][key] = false;
                    }
                });
            }
        }
    }, {
        key: 'fire',
        value: function fire(name) {
            var _this2 = this;

            var args = [].slice.call(arguments, 1);
            if (this.userEventsList && typeof this.userEventsList[name] !== 'undefined') {
                this.userEventsList[name].forEach(function (val) {
                    // call with all arguments
                    if (val) {
                        val.apply(_this2, args);
                    }
                });
            }
        }
    }, {
        key: 'play',
        value: function play(start) {
            var self = this;
            if (!self.player) {
                return;
            }

            if (self.type === 'youtube' && self.player.playVideo) {
                if (typeof start !== 'undefined') {
                    self.player.seekTo(start || 0);
                }
                if (YT.PlayerState.PLAYING !== self.player.getPlayerState()) {
                    self.player.playVideo();
                }
            }

            if (self.type === 'vimeo') {
                if (typeof start !== 'undefined') {
                    self.player.setCurrentTime(start);
                }
                self.player.getPaused().then(function (paused) {
                    if (paused) {
                        self.player.play();
                    }
                });
            }

            if (self.type === 'local') {
                if (typeof start !== 'undefined') {
                    self.player.currentTime = start;
                }
                if (self.player.paused) {
                    self.player.play();
                }
            }
        }
    }, {
        key: 'pause',
        value: function pause() {
            var self = this;
            if (!self.player) {
                return;
            }

            if (self.type === 'youtube' && self.player.pauseVideo) {
                if (YT.PlayerState.PLAYING === self.player.getPlayerState()) {
                    self.player.pauseVideo();
                }
            }

            if (self.type === 'vimeo') {
                self.player.getPaused().then(function (paused) {
                    if (!paused) {
                        self.player.pause();
                    }
                });
            }

            if (self.type === 'local') {
                if (!self.player.paused) {
                    self.player.pause();
                }
            }
        }
    }, {
        key: 'mute',
        value: function mute() {
            var self = this;
            if (!self.player) {
                return;
            }

            if (self.type === 'youtube' && self.player.mute) {
                self.player.mute();
            }

            if (self.type === 'vimeo' && self.player.setVolume) {
                self.player.setVolume(0);
            }

            if (self.type === 'local') {
                self.$video.muted = true;
            }
        }
    }, {
        key: 'unmute',
        value: function unmute() {
            var self = this;
            if (!self.player) {
                return;
            }

            if (self.type === 'youtube' && self.player.mute) {
                self.player.unMute();
            }

            if (self.type === 'vimeo' && self.player.setVolume) {
                self.player.setVolume(self.options.volume);
            }

            if (self.type === 'local') {
                self.$video.muted = false;
            }
        }
    }, {
        key: 'setVolume',
        value: function setVolume() {
            var volume = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;

            var self = this;
            if (!self.player || !volume) {
                return;
            }

            if (self.type === 'youtube' && self.player.setVolume) {
                self.player.setVolume(volume);
            }

            if (self.type === 'vimeo' && self.player.setVolume) {
                self.player.setVolume(volume);
            }

            if (self.type === 'local') {
                self.$video.volume = volume / 100;
            }
        }
    }, {
        key: 'getVolume',
        value: function getVolume(callback) {
            var self = this;
            if (!self.player) {
                callback(false);
                return;
            }

            if (self.type === 'youtube' && self.player.getVolume) {
                callback(self.player.getVolume());
            }

            if (self.type === 'vimeo' && self.player.getVolume) {
                self.player.getVolume().then(function (volume) {
                    callback(volume);
                });
            }

            if (self.type === 'local') {
                callback(self.$video.volume * 100);
            }
        }
    }, {
        key: 'getMuted',
        value: function getMuted(callback) {
            var self = this;
            if (!self.player) {
                callback(null);
                return;
            }

            if (self.type === 'youtube' && self.player.isMuted) {
                callback(self.player.isMuted());
            }

            if (self.type === 'vimeo' && self.player.getVolume) {
                self.player.getVolume().then(function (volume) {
                    callback(!!volume);
                });
            }

            if (self.type === 'local') {
                callback(self.$video.muted);
            }
        }
    }, {
        key: 'getImageURL',
        value: function getImageURL(callback) {
            var self = this;

            if (self.videoImage) {
                callback(self.videoImage);
                return;
            }

            if (self.type === 'youtube') {
                var availableSizes = ['maxresdefault', 'sddefault', 'hqdefault', '0'];
                var step = 0;

                var tempImg = new Image();
                tempImg.onload = function () {
                    // if no thumbnail, youtube add their own image with width = 120px
                    if ((this.naturalWidth || this.width) !== 120 || step === availableSizes.length - 1) {
                        // ok
                        self.videoImage = 'https://img.youtube.com/vi/' + self.videoID + '/' + availableSizes[step] + '.jpg';
                        callback(self.videoImage);
                    } else {
                        // try another size
                        step++;
                        this.src = 'https://img.youtube.com/vi/' + self.videoID + '/' + availableSizes[step] + '.jpg';
                    }
                };
                tempImg.src = 'https://img.youtube.com/vi/' + self.videoID + '/' + availableSizes[step] + '.jpg';
            }

            if (self.type === 'vimeo') {
                var request = new XMLHttpRequest();
                request.open('GET', 'https://vimeo.com/api/v2/video/' + self.videoID + '.json', true);
                request.onreadystatechange = function () {
                    if (this.readyState === 4) {
                        if (this.status >= 200 && this.status < 400) {
                            // Success!
                            var response = JSON.parse(this.responseText);
                            self.videoImage = response[0].thumbnail_large;
                            callback(self.videoImage);
                        } else {
                            // Error :(
                        }
                    }
                };
                request.send();
                request = null;
            }
        }

        // fallback to the old version.

    }, {
        key: 'getIframe',
        value: function getIframe(callback) {
            this.getVideo(callback);
        }
    }, {
        key: 'getVideo',
        value: function getVideo(callback) {
            var self = this;

            // return generated video block
            if (self.$video) {
                callback(self.$video);
                return;
            }

            // generate new video block
            self.onAPIready(function () {
                var hiddenDiv = void 0;
                if (!self.$video) {
                    hiddenDiv = document.createElement('div');
                    hiddenDiv.style.display = 'none';
                }

                // Youtube
                if (self.type === 'youtube') {
                    self.playerOptions = {};
                    self.playerOptions.videoId = self.videoID;
                    self.playerOptions.playerVars = {
                        autohide: 1,
                        rel: 0,
                        autoplay: 0,
                        // autoplay enable on mobile devices
                        playsinline: 1
                    };

                    // hide controls
                    if (!self.options.showContols) {
                        self.playerOptions.playerVars.iv_load_policy = 3;
                        self.playerOptions.playerVars.modestbranding = 1;
                        self.playerOptions.playerVars.controls = 0;
                        self.playerOptions.playerVars.showinfo = 0;
                        self.playerOptions.playerVars.disablekb = 1;
                    }

                    // events
                    var ytStarted = void 0;
                    var ytProgressInterval = void 0;
                    self.playerOptions.events = {
                        onReady: function onReady(e) {
                            // mute
                            if (self.options.mute) {
                                e.target.mute();
                            } else if (self.options.volume) {
                                e.target.setVolume(self.options.volume);
                            }

                            // autoplay
                            if (self.options.autoplay) {
                                self.play(self.options.startTime);
                            }
                            self.fire('ready', e);

                            // volumechange
                            setInterval(function () {
                                self.getVolume(function (volume) {
                                    if (self.options.volume !== volume) {
                                        self.options.volume = volume;
                                        self.fire('volumechange', e);
                                    }
                                });
                            }, 150);
                        },
                        onStateChange: function onStateChange(e) {
                            // loop
                            if (self.options.loop && e.data === YT.PlayerState.ENDED) {
                                self.play(self.options.startTime);
                            }
                            if (!ytStarted && e.data === YT.PlayerState.PLAYING) {
                                ytStarted = 1;
                                self.fire('started', e);
                            }
                            if (e.data === YT.PlayerState.PLAYING) {
                                self.fire('play', e);
                            }
                            if (e.data === YT.PlayerState.PAUSED) {
                                self.fire('pause', e);
                            }
                            if (e.data === YT.PlayerState.ENDED) {
                                self.fire('ended', e);
                            }

                            // progress check
                            if (e.data === YT.PlayerState.PLAYING) {
                                ytProgressInterval = setInterval(function () {
                                    self.fire('timeupdate', e);

                                    // check for end of video and play again or stop
                                    if (self.options.endTime && self.player.getCurrentTime() >= self.options.endTime) {
                                        if (self.options.loop) {
                                            self.play(self.options.startTime);
                                        } else {
                                            self.pause();
                                        }
                                    }
                                }, 150);
                            } else {
                                clearInterval(ytProgressInterval);
                            }
                        }
                    };

                    var firstInit = !self.$video;
                    if (firstInit) {
                        var div = document.createElement('div');
                        div.setAttribute('id', self.playerID);
                        hiddenDiv.appendChild(div);
                        document.body.appendChild(hiddenDiv);
                    }
                    self.player = self.player || new window.YT.Player(self.playerID, self.playerOptions);
                    if (firstInit) {
                        self.$video = document.getElementById(self.playerID);

                        // get video width and height
                        self.videoWidth = parseInt(self.$video.getAttribute('width'), 10) || 1280;
                        self.videoHeight = parseInt(self.$video.getAttribute('height'), 10) || 720;
                    }
                }

                // Vimeo
                if (self.type === 'vimeo') {
                    self.playerOptions = {
                        id: self.videoID,
                        autopause: 0,
                        transparent: 0,
                        autoplay: self.options.autoplay ? 1 : 0,
                        loop: self.options.loop ? 1 : 0,
                        muted: self.options.mute ? 1 : 0
                    };

                    if (self.options.volume) {
                        self.playerOptions.volume = self.options.volume;
                    }

                    // hide controls
                    if (!self.options.showContols) {
                        self.playerOptions.badge = 0;
                        self.playerOptions.byline = 0;
                        self.playerOptions.portrait = 0;
                        self.playerOptions.title = 0;
                    }

                    if (!self.$video) {
                        var playerOptionsString = '';
                        Object.keys(self.playerOptions).forEach(function (key) {
                            if (playerOptionsString !== '') {
                                playerOptionsString += '&';
                            }
                            playerOptionsString += key + '=' + encodeURIComponent(self.playerOptions[key]);
                        });

                        // we need to create iframe manually because when we create it using API
                        // js events won't triggers after iframe moved to another place
                        self.$video = document.createElement('iframe');
                        self.$video.setAttribute('id', self.playerID);
                        self.$video.setAttribute('src', 'https://player.vimeo.com/video/' + self.videoID + '?' + playerOptionsString);
                        self.$video.setAttribute('frameborder', '0');
                        self.$video.setAttribute('mozallowfullscreen', '');
                        self.$video.setAttribute('allowfullscreen', '');

                        hiddenDiv.appendChild(self.$video);
                        document.body.appendChild(hiddenDiv);
                    }
                    self.player = self.player || new Vimeo.Player(self.$video, self.playerOptions);

                    // set current time for autoplay
                    if (self.options.startTime && self.options.autoplay) {
                        self.player.setCurrentTime(self.options.startTime);
                    }

                    // get video width and height
                    self.player.getVideoWidth().then(function (width) {
                        self.videoWidth = width || 1280;
                    });
                    self.player.getVideoHeight().then(function (height) {
                        self.videoHeight = height || 720;
                    });

                    // events
                    var vmStarted = void 0;
                    self.player.on('timeupdate', function (e) {
                        if (!vmStarted) {
                            self.fire('started', e);
                            vmStarted = 1;
                        }

                        self.fire('timeupdate', e);

                        // check for end of video and play again or stop
                        if (self.options.endTime) {
                            if (self.options.endTime && e.seconds >= self.options.endTime) {
                                if (self.options.loop) {
                                    self.play(self.options.startTime);
                                } else {
                                    self.pause();
                                }
                            }
                        }
                    });
                    self.player.on('play', function (e) {
                        self.fire('play', e);

                        // check for the start time and start with it
                        if (self.options.startTime && e.seconds === 0) {
                            self.play(self.options.startTime);
                        }
                    });
                    self.player.on('pause', function (e) {
                        self.fire('pause', e);
                    });
                    self.player.on('ended', function (e) {
                        self.fire('ended', e);
                    });
                    self.player.on('loaded', function (e) {
                        self.fire('ready', e);
                    });
                    self.player.on('volumechange', function (e) {
                        self.fire('volumechange', e);
                    });
                }

                // Local
                function addSourceToLocal(element, src, type) {
                    var source = document.createElement('source');
                    source.src = src;
                    source.type = type;
                    element.appendChild(source);
                }
                if (self.type === 'local') {
                    if (!self.$video) {
                        self.$video = document.createElement('video');

                        // show controls
                        if (self.options.showContols) {
                            self.$video.controls = true;
                        }

                        // mute
                        if (self.options.mute) {
                            self.$video.muted = true;
                        } else if (self.$video.volume) {
                            self.$video.volume = self.options.volume / 100;
                        }

                        // loop
                        if (self.options.loop) {
                            self.$video.loop = true;
                        }

                        // autoplay enable on mobile devices
                        self.$video.setAttribute('playsinline', '');
                        self.$video.setAttribute('webkit-playsinline', '');

                        self.$video.setAttribute('id', self.playerID);
                        hiddenDiv.appendChild(self.$video);
                        document.body.appendChild(hiddenDiv);

                        Object.keys(self.videoID).forEach(function (key) {
                            addSourceToLocal(self.$video, self.videoID[key], 'video/' + key);
                        });
                    }

                    self.player = self.player || self.$video;

                    var locStarted = void 0;
                    self.player.addEventListener('playing', function (e) {
                        if (!locStarted) {
                            self.fire('started', e);
                        }
                        locStarted = 1;
                    });
                    self.player.addEventListener('timeupdate', function (e) {
                        self.fire('timeupdate', e);

                        // check for end of video and play again or stop
                        if (self.options.endTime) {
                            if (self.options.endTime && this.currentTime >= self.options.endTime) {
                                if (self.options.loop) {
                                    self.play(self.options.startTime);
                                } else {
                                    self.pause();
                                }
                            }
                        }
                    });
                    self.player.addEventListener('play', function (e) {
                        self.fire('play', e);
                    });
                    self.player.addEventListener('pause', function (e) {
                        self.fire('pause', e);
                    });
                    self.player.addEventListener('ended', function (e) {
                        self.fire('ended', e);
                    });
                    self.player.addEventListener('loadedmetadata', function () {
                        // get video width and height
                        self.videoWidth = this.videoWidth || 1280;
                        self.videoHeight = this.videoHeight || 720;

                        self.fire('ready');

                        // autoplay
                        if (self.options.autoplay) {
                            self.play(self.options.startTime);
                        }
                    });
                    self.player.addEventListener('volumechange', function (e) {
                        self.getVolume(function (volume) {
                            self.options.volume = volume;
                        });
                        self.fire('volumechange', e);
                    });
                }
                callback(self.$video);
            });
        }
    }, {
        key: 'init',
        value: function init() {
            var self = this;

            self.playerID = 'VideoWorker-' + self.ID;
        }
    }, {
        key: 'loadAPI',
        value: function loadAPI() {
            var self = this;

            if (YoutubeAPIadded && VimeoAPIadded) {
                return;
            }

            var src = '';

            // load Youtube API
            if (self.type === 'youtube' && !YoutubeAPIadded) {
                YoutubeAPIadded = 1;
                src = 'https://www.youtube.com/iframe_api';
            }

            // load Vimeo API
            if (self.type === 'vimeo' && !VimeoAPIadded) {
                VimeoAPIadded = 1;
                src = 'https://player.vimeo.com/api/player.js';
            }

            if (!src) {
                return;
            }

            // add script in head section
            var tag = document.createElement('script');
            var head = document.getElementsByTagName('head')[0];
            tag.src = src;

            head.appendChild(tag);

            head = null;
            tag = null;
        }
    }, {
        key: 'onAPIready',
        value: function onAPIready(callback) {
            var self = this;

            // Youtube
            if (self.type === 'youtube') {
                // Listen for global YT player callback
                if ((typeof YT === 'undefined' || YT.loaded === 0) && !loadingYoutubePlayer) {
                    // Prevents Ready event from being called twice
                    loadingYoutubePlayer = 1;

                    // Creates deferred so, other players know when to wait.
                    window.onYouTubeIframeAPIReady = function () {
                        window.onYouTubeIframeAPIReady = null;
                        loadingYoutubeDefer.resolve('done');
                        callback();
                    };
                } else if ((typeof YT === 'undefined' ? 'undefined' : _typeof(YT)) === 'object' && YT.loaded === 1) {
                    callback();
                } else {
                    loadingYoutubeDefer.done(function () {
                        callback();
                    });
                }
            }

            // Vimeo
            if (self.type === 'vimeo') {
                if (typeof Vimeo === 'undefined' && !loadingVimeoPlayer) {
                    loadingVimeoPlayer = 1;
                    var vimeoInterval = setInterval(function () {
                        if (typeof Vimeo !== 'undefined') {
                            clearInterval(vimeoInterval);
                            loadingVimeoDefer.resolve('done');
                            callback();
                        }
                    }, 20);
                } else if (typeof Vimeo !== 'undefined') {
                    callback();
                } else {
                    loadingVimeoDefer.done(function () {
                        callback();
                    });
                }
            }

            // Local
            if (self.type === 'local') {
                callback();
            }
        }
    }]);

    return VideoWorker;
}();

exports.default = VideoWorker;

/***/ }),
/* 10 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = jarallaxVideo;

var _videoWorker = __webpack_require__(8);

var _videoWorker2 = _interopRequireDefault(_videoWorker);

var _global = __webpack_require__(4);

var _global2 = _interopRequireDefault(_global);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function jarallaxVideo() {
    var jarallax = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : _global2.default.jarallax;

    if (typeof jarallax === 'undefined') {
        return;
    }

    var Jarallax = jarallax.constructor;

    // append video after init Jarallax
    var defInit = Jarallax.prototype.init;
    Jarallax.prototype.init = function () {
        var self = this;

        defInit.apply(self);

        if (self.video && !self.options.disableVideo()) {
            self.video.getVideo(function (video) {
                var $parent = video.parentNode;
                self.css(video, {
                    position: self.image.position,
                    top: '0px',
                    left: '0px',
                    right: '0px',
                    bottom: '0px',
                    width: '100%',
                    height: '100%',
                    maxWidth: 'none',
                    maxHeight: 'none',
                    margin: 0,
                    zIndex: -1
                });
                self.$video = video;
                self.image.$container.appendChild(video);

                // remove parent video element (created by VideoWorker)
                $parent.parentNode.removeChild($parent);
            });
        }
    };

    // cover video
    var defCoverImage = Jarallax.prototype.coverImage;
    Jarallax.prototype.coverImage = function () {
        var self = this;
        var imageData = defCoverImage.apply(self);
        var node = self.image.$item ? self.image.$item.nodeName : false;

        if (imageData && self.video && node && (node === 'IFRAME' || node === 'VIDEO')) {
            var h = imageData.image.height;
            var w = h * self.image.width / self.image.height;
            var ml = (imageData.container.width - w) / 2;
            var mt = imageData.image.marginTop;

            if (imageData.container.width > w) {
                w = imageData.container.width;
                h = w * self.image.height / self.image.width;
                ml = 0;
                mt += (imageData.image.height - h) / 2;
            }

            // add video height over than need to hide controls
            if (node === 'IFRAME') {
                h += 400;
                mt -= 200;
            }

            self.css(self.$video, {
                width: w + 'px',
                marginLeft: ml + 'px',
                height: h + 'px',
                marginTop: mt + 'px'
            });
        }

        return imageData;
    };

    // init video
    var defInitImg = Jarallax.prototype.initImg;
    Jarallax.prototype.initImg = function () {
        var self = this;
        var defaultResult = defInitImg.apply(self);

        if (!self.options.videoSrc) {
            self.options.videoSrc = self.$item.getAttribute('data-jarallax-video') || null;
        }

        if (self.options.videoSrc) {
            self.defaultInitImgResult = defaultResult;
            return true;
        }

        return defaultResult;
    };

    var defCanInitParallax = Jarallax.prototype.canInitParallax;
    Jarallax.prototype.canInitParallax = function () {
        var self = this;
        var defaultResult = defCanInitParallax.apply(self);

        if (!self.options.videoSrc) {
            return defaultResult;
        }

        var video = new _videoWorker2.default(self.options.videoSrc, {
            autoplay: true,
            loop: true,
            showContols: false,
            startTime: self.options.videoStartTime || 0,
            endTime: self.options.videoEndTime || 0,
            mute: self.options.videoVolume ? 0 : 1,
            volume: self.options.videoVolume || 0
        });

        if (video.isValid()) {
            // if parallax will not be inited, we can add thumbnail on background.
            if (!defaultResult) {
                if (!self.defaultInitImgResult) {
                    video.getImageURL(function (url) {
                        // save default user styles
                        var curStyle = self.$item.getAttribute('style');
                        if (curStyle) {
                            self.$item.setAttribute('data-jarallax-original-styles', curStyle);
                        }

                        // set new background
                        self.css(self.$item, {
                            'background-image': 'url("' + url + '")',
                            'background-position': 'center',
                            'background-size': 'cover'
                        });
                    });
                }

                // init video
            } else {
                video.on('ready', function () {
                    if (self.options.videoPlayOnlyVisible) {
                        var oldOnScroll = self.onScroll;
                        self.onScroll = function () {
                            oldOnScroll.apply(self);
                            if (self.isVisible()) {
                                video.play();
                            } else {
                                video.pause();
                            }
                        };
                    } else {
                        video.play();
                    }
                });

                video.on('started', function () {
                    self.image.$default_item = self.image.$item;
                    self.image.$item = self.$video;

                    // set video width and height
                    self.image.width = self.video.videoWidth || 1280;
                    self.image.height = self.video.videoHeight || 720;
                    self.options.imgWidth = self.image.width;
                    self.options.imgHeight = self.image.height;
                    self.coverImage();
                    self.clipContainer();
                    self.onScroll();

                    // hide image
                    if (self.image.$default_item) {
                        self.image.$default_item.style.display = 'none';
                    }
                });

                self.video = video;

                // set image if not exists
                if (!self.defaultInitImgResult) {
                    if (video.type !== 'local') {
                        video.getImageURL(function (url) {
                            self.image.src = url;
                            self.init();
                        });

                        return false;
                    }

                    // set empty image on local video if not defined
                    self.image.src = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
                    return true;
                }
            }
        }

        return defaultResult;
    };

    // Destroy video parallax
    var defDestroy = Jarallax.prototype.destroy;
    Jarallax.prototype.destroy = function () {
        var self = this;

        if (self.image.$default_item) {
            self.image.$item = self.image.$default_item;
            delete self.image.$default_item;
        }

        defDestroy.apply(self);
    };
}

/***/ })
/******/ ]);


(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 100);
      };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');


/**
 * Parallax
 */

( function( $ ){

	$.fn.herculesDesignParallax = function( options ){

		var $$ = $(this);

		if( options === 'refreshParallax' ) {
			return $$.trigger( 'refreshParallax' );
		}
 
		options = $.extend( {
			// We need to know the background image URL to use
			backgroundUrl: null,
			// And the exact size of that image
			backgroundSize: null,
			// We can work out the aspect ratio from the size
			backgroundAspectRatio: null,
			// How we want to handle sizing of the background image
			backgroundSizing: 'scaled',
			// Should we limit the amount of motion in the background image
			// The number of pixels the background image can move for every pixel of scrolling
			limitMotion: 'auto',
		}, options );

		if( options.backgroundAspectRatio === null ) {
			options.backgroundAspectRatio = options.backgroundSize[0] / options.backgroundSize[1];
		}

		var setupParallax = function( ){
		
			try {
				var wrapperSize = [
					$$.outerWidth(),
					$$.outerHeight()
				];

				var bounding = $$[0].getBoundingClientRect();
				var windowHeight =  $( window ).outerHeight();

				if( $$.data('herculesdesign-parallax-init') === undefined ) {
					// Do the initial setup
					$$.css( {
						'background-image' : 'url(' + options.backgroundUrl + ')'
					} );
				}

				var limitMotion;
				if( options.limitMotion === 'auto' ) {
					if( windowHeight < 720 ) {
						limitMotion = 0.55;
					} else if( windowHeight > 1300 ) {
						limitMotion = 0.45;
					} else {
						limitMotion = (-0.00017 * ( windowHeight - 720 ) ) + 0.55;
					}
				} else {
					limitMotion = parseFloat( options.limitMotion );
				}

				// What percent is this through a screen cycle
				// -1 is when the bottom of the wrapper is at the top of the screen
				// 1 is when the top of the wrapper is at the bottom of the screen
				var position = ( bounding.bottom + ( bounding.top - windowHeight ) ) / ( windowHeight + bounding.height );
				var percent = ( position - 1 ) / - 2;
				var topPosition = 0;
				var limitScale = 1;
				var backgroundSize = options.backgroundSize;

				// Do the setup for every time something changes
				if( options.backgroundSizing === 'scaled' ) {
					// This is the required Y height to create a parallax effect
					var finalY = wrapperSize[1] / ( limitMotion ? limitMotion : 1 );
					var scaleBG = wrapperSize[0] / backgroundSize[0]; // The initial scaling is based on container width

					if( finalY > backgroundSize[1] * scaleBG ) {
						// This image wouldn't be tall enough to give a decent parallax effect, so we'll scale it up
						scaleBG = finalY / backgroundSize[1];
						limitMotion = false;
					}

					$$.css(
						'background-size',
						( backgroundSize[0] * scaleBG ) + 'px ' +
						( backgroundSize[1] * scaleBG ) + 'px'
					);

					// Work out the top position
					if( bounding.top > - wrapperSize[1] && bounding.bottom - windowHeight < wrapperSize[1] ) {
						// This is the scaled background height
						var backgroundHeight = backgroundSize[1] * scaleBG;

						// Check if we need to limit the amount of motion in the background image
						if( limitMotion && backgroundHeight > windowHeight * limitMotion ) {
							// Work out how much to scale percent position based on how much motion we want.
							limitScale = ( windowHeight * limitMotion ) / ( backgroundHeight );
							// Percent is scaled so that the midpoint is still 0.5
							percent = ( percent * limitScale ) + ( ( 1 - limitScale ) / 2 );
						}
						// console.log( percent );

						topPosition = - ( backgroundHeight - wrapperSize[1] ) * percent;
					}

					$$.css( 'background-position', '50% ' + topPosition + 'px' );

				} else if( options.backgroundSizing === 'original' ) {
					// See scaled version or explanation of this code.
					if( limitMotion && backgroundSize[1] > windowHeight * limitMotion ) {
						limitScale = ( windowHeight * limitMotion ) / ( backgroundSize[1] );
						percent = (percent * limitScale) + ( ( 1 - limitScale ) / 2 );
					}

					// In this case, the background height is always the background size
					topPosition = - ( backgroundSize[1] - wrapperSize[1] ) * percent;

					// This is a version with no scaling
					$$.css( 'background-size', 'auto' );
					$$.css( 'background-position', '50% ' + topPosition + 'px' );
				}
			}
			catch( err ) {
				console.log( err.message );
				$$.css( {
					'background-size': options.backgroundSizing === 'scaled' ? 'cover' : 'auto',
					'background-position': '50% 50%'
				} );
			}
		};
		setupParallax();

		// All the events where we'll need to change the parallax
		$( window ).on( 'scroll', setupParallax );
		$( window ).on( 'resize', setupParallax );
		$$.on( 'refreshParallax', setupParallax );
		// Ensure that the parallax has run on inital load.
		setTimeout( function () {
			setupParallax();
		}, 100 );
	};

}( jQuery ) );


jQuery( function( $ ){
	$('[data-herculesdesign-parallax]' ).each( function(){
		$( this ).herculesDesignParallax( $( this ).data('herculesdesign-parallax') );
	} );
} );