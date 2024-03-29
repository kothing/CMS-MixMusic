var BROWSER = {};
var USERAGENT = navigator.userAgent.toLowerCase();
browserVersion({
    'ie': 'msie',
    'firefox': '',
    'chrome': '',
    'opera': '',
    'safari': '',
    'mozilla': '',
    'webkit': '',
    'maxthon': '',
    'qq': 'qqbrowser',
    'rv': 'rv'
});
if (BROWSER.safari || BROWSER.rv) {
    BROWSER.firefox = true;
}
BROWSER.opera = BROWSER.opera ? opera.version() : 0;
HTMLNODE = document.getElementsByTagName('head')[0].parentNode;
if (BROWSER.ie) {
    BROWSER.iemode = parseInt(typeof document.documentMode != 'undefined' ? document.documentMode : BROWSER.ie);
    HTMLNODE.className = 'ie_all ie' + BROWSER.iemode;
}
var CSSLOADED = [];
var JSLOADED = [];
var JSMENU = [];
JSMENU['active'] = [];
JSMENU['timer'] = [];
JSMENU['drag'] = [];
JSMENU['layer'] = 0;
JSMENU['zIndex'] = {
    'win': 200,
    'menu': 300,
    'dialog': 400,
    'prompt': 500
};
JSMENU['float'] = '';
var CURRENTSTYPE = null;
var discuz_uid = isUndefined(discuz_uid) ? 0 : discuz_uid;
var creditnotice = isUndefined(creditnotice) ? '' : creditnotice;
var cookiedomain = isUndefined(cookiedomain) ? '' : cookiedomain;
var cookiepath = isUndefined(cookiepath) ? '' : cookiepath;
var EXTRAFUNC = [],
    EXTRASTR = '';
EXTRAFUNC['showmenu'] = [];
var DISCUZCODE = [];
DISCUZCODE['num'] = '-1';
DISCUZCODE['html'] = [];
var USERABOUT_BOX = true;
var USERCARDST = null;
var CLIPBOARDSWFDATA = '';
var NOTICETITLE = [];
var NOTICECURTITLE = document.title;
if (BROWSER.firefox && window.HTMLElement) {
    HTMLElement.prototype.__defineGetter__("innerText", function () {
        var anyString = "";
        var childS = this.childNodes;
        for (var i = 0; i < childS.length; i++) {
            if (childS[i].nodeType == 1) {
                anyString += childS[i].tagName == "BR" ? '\n' : childS[i].innerText;
            } else if (childS[i].nodeType == 3) {
                anyString += childS[i].nodeValue;
            }
        }
        return anyString;
    });
    HTMLElement.prototype.__defineSetter__("innerText", function (sText) {
        this.textContent = sText;
    });
    HTMLElement.prototype.__defineSetter__('outerHTML', function (sHTML) {
        var r = this.ownerDocument.createRange();
        r.setStartBefore(this);
        var df = r.createContextualFragment(sHTML);
        this.parentNode.replaceChild(df, this);
        return sHTML;
    });
    HTMLElement.prototype.__defineGetter__('outerHTML', function () {
        var attr;
        var attrs = this.attributes;
        var str = '<' + this.tagName.toLowerCase();
        for (var i = 0; i < attrs.length; i++) {
            attr = attrs[i];
            if (attr.specified)
                str += ' ' + attr.name + '="' + attr.value + '"';
        }
        if (!this.canHaveChildren) {
            return str + '>';
        }
        return str + '>' + this.innerHTML + '</' + this.tagName.toLowerCase() + '>';
    });
    HTMLElement.prototype.__defineGetter__('canHaveChildren', function () {
        switch (this.tagName.toLowerCase()) {
            case 'area':
            case 'base':
            case 'basefont':
            case 'col':
            case 'frame':
            case 'hr':
            case 'img':
            case 'br':
            case 'input':
            case 'isindex':
            case 'link':
            case 'meta':
            case 'param':
                return false;
        }
        return true;
    });
}

function $(id) {
    return !id ? null : document.getElementById(id);
}

function $C(classname, ele, tag) {
    var returns = [];
    ele = ele || document;
    tag = tag || '*';
    if (ele.getElementsByClassName) {
        var eles = ele.getElementsByClassName(classname);
        if (tag != '*') {
            for (var i = 0, L = eles.length; i < L; i++) {
                if (eles[i].tagName.toLowerCase() == tag.toLowerCase()) {
                    returns.push(eles[i]);
                }
            }
        } else {
            returns = eles;
        }
    } else {
        eles = ele.getElementsByTagName(tag);
        var pattern = new RegExp("(^|\\s)" + classname + "(\\s|$)");
        for (i = 0, L = eles.length; i < L; i++) {
            if (pattern.test(eles[i].className)) {
                returns.push(eles[i]);
            }
        }
    }
    return returns;
}

function _attachEvent(obj, evt, func, eventobj) {
    eventobj = !eventobj ? obj : eventobj;
    if (obj.addEventListener) {
        obj.addEventListener(evt, func, false);
    } else if (eventobj.attachEvent) {
        obj.attachEvent('on' + evt, func);
    }
}

function _detachEvent(obj, evt, func, eventobj) {
    eventobj = !eventobj ? obj : eventobj;
    if (obj.removeEventListener) {
        obj.removeEventListener(evt, func, false);
    } else if (eventobj.detachEvent) {
        obj.detachEvent('on' + evt, func);
    }
}

function browserVersion(types) {
    var other = 1;
    for (i in types) {
        var v = types[i] ? types[i] : i;
        if (USERAGENT.indexOf(v) != -1) {
            var re = new RegExp(v + '(\\/|\\s|:)([\\d\\.]+)', 'ig');
            var matches = re.exec(USERAGENT);
            var ver = matches != null ? matches[2] : 0;
            other = ver !== 0 && v != 'mozilla' ? 0 : other;
        } else {
            var ver = 0;
        }
        eval('BROWSER.' + i + '= ver');
    }
    BROWSER.other = other;
}

function getEvent() {
    if (document.all) return window.event;
    func = getEvent.caller;
    while (func != null) {
        var arg0 = func.arguments[0];
        if (arg0) {
            if ((arg0.constructor == Event || arg0.constructor == MouseEvent) || (typeof (arg0) == "object" && arg0.preventDefault && arg0.stopPropagation)) {
                return arg0;
            }
        }
        func = func.caller;
    }
    return null;
}

function isUndefined(variable) {
    return typeof variable == 'undefined' ? true : false;
}

function in_array(needle, haystack) {
    if (typeof needle == 'string' || typeof needle == 'number') {
        for (var i in haystack) {
            if (haystack[i] == needle) {
                return true;
            }
        }
    }
    return false;
}

function trim(str) {
    return (str + '').replace(/(\s+)$/g, '').replace(/^\s+/g, '');
}

function strlen(str) {
    return (BROWSER.ie && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length : str.length;
}

function mb_strlen(str) {
    var len = 0;
    for (var i = 0; i < str.length; i++) {
        len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 3 : 2) : 1;
    }
    return len;
}

function mb_cutstr(str, maxlen, dot) {
    var len = 0;
    var ret = '';
    var dot = !dot ? '...' : dot;
    maxlen = maxlen - dot.length;
    for (var i = 0; i < str.length; i++) {
        len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 3 : 2) : 1;
        if (len > maxlen) {
            ret += dot;
            break;
        }
        ret += str.substr(i, 1);
    }
    return ret;
}

function preg_replace(search, replace, str, regswitch) {
    var regswitch = !regswitch ? 'ig' : regswitch;
    var len = search.length;
    for (var i = 0; i < len; i++) {
        re = new RegExp(search[i], regswitch);
        str = str.replace(re, typeof replace == 'string' ? replace : (replace[i] ? replace[i] : replace[0]));
    }
    return str;
}

function htmlspecialchars(str) {
    return preg_replace(['&', '<', '>', '"'], ['&amp;', '&lt;', '&gt;', '&quot;'], str);
}

function display(id) {
    var obj = $(id);
    if (obj.style.visibility) {
        obj.style.visibility = obj.style.visibility == 'visible' ? 'hidden' : 'visible';
    } else {
        obj.style.display = obj.style.display == '' ? 'none' : '';
    }
}

function checkall(form, prefix, checkall) {
    var checkall = checkall ? checkall : 'chkall';
    count = 0;
    for (var i = 0; i < form.elements.length; i++) {
        var e = form.elements[i];
        if (e.name && e.name != checkall && !e.disabled && (!prefix || (prefix && e.name.match(prefix)))) {
            e.checked = form.elements[checkall].checked;
            if (e.checked) {
                count++;
            }
        }
    }
    return count;
}

function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {
    if (cookieValue == '' || seconds < 0) {
        cookieValue = '';
        seconds = -2592000;
    }
    if (seconds) {
        var expires = new Date();
        expires.setTime(expires.getTime() + seconds * 1000);
    }
    domain = !domain ? cookiedomain : domain;
    path = !path ? cookiepath : path;
    document.cookie = escape(cookiepre + cookieName) + '=' + escape(cookieValue) +
        (expires ? '; expires=' + expires.toGMTString() : '') +
        (path ? '; path=' + path : '/') +
        (domain ? '; domain=' + domain : '') +
        (secure ? '; secure' : '');
}

function getcookie(name, nounescape) {
    name = cookiepre + name;
    var cookie_start = document.cookie.indexOf(name);
    var cookie_end = document.cookie.indexOf(";", cookie_start);
    if (cookie_start == -1) {
        return '';
    } else {
        var v = document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length));
        return !nounescape ? unescape(v) : v;
    }
}

function getHost(url) {
    var host = "null";
    if (typeof url == "undefined" || null == url) {
        url = location.href;
    }
    var regex = /^\w+\:\/\/([^\/]*).*/;
    var match = url.match(regex);
    if (typeof match != "undefined" && null != match) {
        host = match[1];
    }
    return host;
}

function newfunction(func) {
    var args = [];
    for (var i = 1; i < arguments.length; i++) args.push(arguments[i]);
    return function (event) {
        doane(event);
        window[func].apply(window, args);
        return false;
    }
}

function evalscript(s) {
    if (s.indexOf('<script') == -1) return s;
    var p = /<script[^\>]*?>([^\x00]*?)<\/script>/ig;
    var arr = [];
    while (arr = p.exec(s)) {
        var p1 = /<script[^\>]*?src=\"([^\>]*?)\"[^\>]*?(reload=\"1\")?(?:charset=\"([\w\-]+?)\")?><\/script>/i;
        var arr1 = [];
        arr1 = p1.exec(arr[0]);
        if (arr1) {
            appendscript(arr1[1], '', arr1[2], arr1[3]);
        } else {
            p1 = /<script(.*?)>([^\x00]+?)<\/script>/i;
            arr1 = p1.exec(arr[0]);
            appendscript('', arr1[2], arr1[1].indexOf('reload=') != -1);
        }
    }
    return s;
}
var safescripts = {},
    evalscripts = [];

function safescript(id, call, seconds, times, timeoutcall, endcall, index) {
    seconds = seconds || 1000;
    times = times || 0;
    var checked = true;
    try {
        if (typeof call == 'function') {
            call();
        } else {
            eval(call);
        }
    } catch (e) {
        checked = false;
    }
    if (!checked) {
        if (!safescripts[id] || !index) {
            safescripts[id] = safescripts[id] || [];
            safescripts[id].push({
                'times': 0,
                'si': setInterval(function () {
                    safescript(id, call, seconds, times, timeoutcall, endcall, safescripts[id].length);
                }, seconds)
            });
        } else {
            index = (index || 1) - 1;
            safescripts[id][index]['times']++;
            if (safescripts[id][index]['times'] >= times) {
                clearInterval(safescripts[id][index]['si']);
                if (typeof timeoutcall == 'function') {
                    timeoutcall();
                } else {
                    eval(timeoutcall);
                }
            }
        }
    } else {
        try {
            index = (index || 1) - 1;
            if (safescripts[id][index]['si']) {
                clearInterval(safescripts[id][index]['si']);
            }
            if (typeof endcall == 'function') {
                endcall();
            } else {
                eval(endcall);
            }
        } catch (e) {}
    }
}

function appendscript(src, text, reload, charset) {
    var id = hash(src + text);
    if (!reload && in_array(id, evalscripts)) return;
    if (reload && $(id)) {
        $(id).parentNode.removeChild($(id));
    }
    evalscripts.push(id);
    var scriptNode = document.createElement("script");
    scriptNode.type = "text/javascript";
    scriptNode.id = id;
    scriptNode.charset = charset ? charset : (BROWSER.firefox ? document.characterSet : document.charset);
    try {
        if (src) {
            scriptNode.src = src;
            scriptNode.onloadDone = false;
            scriptNode.onload = function () {
                scriptNode.onloadDone = true;
                JSLOADED[src] = 1;
            };
            scriptNode.onreadystatechange = function () {
                if ((scriptNode.readyState == 'loaded' || scriptNode.readyState == 'complete') && !scriptNode.onloadDone) {
                    scriptNode.onloadDone = true;
                    JSLOADED[src] = 1;
                }
            };
        } else if (text) {
            scriptNode.text = text;
        }
        document.getElementsByTagName('head')[0].appendChild(scriptNode);
    } catch (e) {}
}

function stripscript(s) {
    return s.replace(/<script.*?>.*?<\/script>/ig, '');
}

function ajaxmenu(ctrlObj, timeout, cache, duration, pos, recall, idclass, contentclass) {
    if (!ctrlObj.getAttribute('mid')) {
        var ctrlid = ctrlObj.id;
        if (!ctrlid) {
            ctrlObj.id = 'ajaxid_' + Math.random();
        }
    } else {
        var ctrlid = ctrlObj.getAttribute('mid');
        if (!ctrlObj.id) {
            ctrlObj.id = 'ajaxid_' + Math.random();
        }
    }
    var menuid = ctrlid + '_menu';
    var menu = $(menuid);
    if (isUndefined(timeout)) timeout = 3000;
    if (isUndefined(cache)) cache = 1;
    if (isUndefined(pos)) pos = '43';
    if (isUndefined(duration)) duration = timeout > 0 ? 0 : 3;
    if (isUndefined(idclass)) idclass = 'p_pop';
    if (isUndefined(contentclass)) contentclass = 'p_opt';
    var func = function () {
        showMenu({
            'ctrlid': ctrlObj.id,
            'menuid': menuid,
            'duration': duration,
            'timeout': timeout,
            'pos': pos,
            'cache': cache,
            'layer': 2
        });
        if (typeof recall == 'function') {
            recall();
        } else {
            eval(recall);
        }
    };
    if (menu) {
        if (menu.style.display == '') {
            hideMenu(menuid);
        } else {
            func();
        }
    } else {
        menu = document.createElement('div');
        menu.id = menuid;
        menu.style.display = 'none';
        menu.className = idclass;
        menu.innerHTML = '<div class="' + contentclass + '" id="' + menuid + '_content"></div>';
        $('append_parent').appendChild(menu);
        var url = (!isUndefined(ctrlObj.attributes['shref']) ? ctrlObj.attributes['shref'].value : (!isUndefined(ctrlObj.href) ? ctrlObj.href : ctrlObj.attributes['href'].value));
        url += (url.indexOf('?') != -1 ? '&' : '?') + 'ajaxmenu=1';
        ajaxget(url, menuid + '_content', 'ajaxwaitid', '', '', func);
    }
    doane();
}

function hash(string, length) {
    var length = length ? length : 32;
    var start = 0;
    var i = 0;
    var result = '';
    filllen = length - string.length % length;
    for (i = 0; i < filllen; i++) {
        string += "0";
    }
    while (start < string.length) {
        result = stringxor(result, string.substr(start, length));
        start += length;
    }
    return result;
}

function stringxor(s1, s2) {
    var s = '';
    var hash = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var max = Math.max(s1.length, s2.length);
    for (var i = 0; i < max; i++) {
        var k = s1.charCodeAt(i) ^ s2.charCodeAt(i);
        s += hash.charAt(k % 52);
    }
    return s;
}

function showPreview(val, id) {
    var showObj = $(id);
    if (showObj) {
        showObj.innerHTML = val.replace(/\n/ig, "<bupdateseccoder />");
    }
}

function doane(event, preventDefault, stopPropagation) {
    var preventDefault = isUndefined(preventDefault) ? 1 : preventDefault;
    var stopPropagation = isUndefined(stopPropagation) ? 1 : stopPropagation;
    e = event ? event : window.event;
    if (!e) {
        e = getEvent();
    }
    if (!e) {
        return null;
    }
    if (preventDefault) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }
    }
    if (stopPropagation) {
        if (e.stopPropagation) {
            e.stopPropagation();
        } else {
            e.cancelBubble = true;
        }
    }
    return e;
}

function showMenu(v) {
    var ctrlid = isUndefined(v['ctrlid']) ? v : v['ctrlid'];
    var showid = isUndefined(v['showid']) ? ctrlid : v['showid'];
    var menuid = isUndefined(v['menuid']) ? showid + '_menu' : v['menuid'];
    var ctrlObj = $(ctrlid);
    var menuObj = $(menuid);
    if (!menuObj) return;
    var mtype = isUndefined(v['mtype']) ? 'menu' : v['mtype'];
    var evt = isUndefined(v['evt']) ? 'mouseover' : v['evt'];
    var pos = isUndefined(v['pos']) ? '43' : v['pos'];
    var layer = isUndefined(v['layer']) ? 1 : v['layer'];
    var duration = isUndefined(v['duration']) ? 2 : v['duration'];
    var timeout = isUndefined(v['timeout']) ? 250 : v['timeout'];
    var maxh = isUndefined(v['maxh']) ? 600 : v['maxh'];
    var cache = isUndefined(v['cache']) ? 1 : v['cache'];
    var drag = isUndefined(v['drag']) ? '' : v['drag'];
    var dragobj = drag && $(drag) ? $(drag) : menuObj;
    var fade = isUndefined(v['fade']) ? 0 : v['fade'];
    var cover = isUndefined(v['cover']) ? 0 : v['cover'];
    var zindex = isUndefined(v['zindex']) ? JSMENU['zIndex']['menu'] : v['zindex'];
    var ctrlclass = isUndefined(v['ctrlclass']) ? '' : v['ctrlclass'];
    var winhandlekey = isUndefined(v['win']) ? '' : v['win'];
    if (winhandlekey && ctrlObj && !ctrlObj.getAttribute('fwin')) {
        ctrlObj.setAttribute('fwin', winhandlekey);
    }
    zindex = cover ? zindex + 500 : zindex;
    if (typeof JSMENU['active'][layer] == 'undefined') {
        JSMENU['active'][layer] = [];
    }
    for (i in EXTRAFUNC['showmenu']) {
        try {
            eval(EXTRAFUNC['showmenu'][i] + '()');
        } catch (e) {}
    }
    if (evt == 'click' && in_array(menuid, JSMENU['active'][layer]) && mtype != 'win') {
        hideMenu(menuid, mtype);
        return;
    }
    if (mtype == 'menu') {
        hideMenu(layer, mtype);
    }
    if (ctrlObj) {
        if (!ctrlObj.getAttribute('initialized')) {
            ctrlObj.setAttribute('initialized', true);
            ctrlObj.unselectable = true;
            ctrlObj.outfunc = typeof ctrlObj.onmouseout == 'function' ? ctrlObj.onmouseout : null;
            ctrlObj.onmouseout = function () {
                if (this.outfunc) this.outfunc();
                if (duration < 3 && !JSMENU['timer'][menuid]) {
                    JSMENU['timer'][menuid] = setTimeout(function () {
                        hideMenu(menuid, mtype);
                    }, timeout);
                }
            };
            ctrlObj.overfunc = typeof ctrlObj.onmouseover == 'function' ? ctrlObj.onmouseover : null;
            ctrlObj.onmouseover = function (e) {
                doane(e);
                if (this.overfunc) this.overfunc();
                if (evt == 'click') {
                    clearTimeout(JSMENU['timer'][menuid]);
                    JSMENU['timer'][menuid] = null;
                } else {
                    for (var i in JSMENU['timer']) {
                        if (JSMENU['timer'][i]) {
                            clearTimeout(JSMENU['timer'][i]);
                            JSMENU['timer'][i] = null;
                        }
                    }
                }
            };
        }
    }
    if (!menuObj.getAttribute('initialized')) {
        menuObj.setAttribute('initialized', true);
        menuObj.ctrlkey = ctrlid;
        menuObj.mtype = mtype;
        menuObj.layer = layer;
        menuObj.cover = cover;
        if (ctrlObj && ctrlObj.getAttribute('fwin')) {
            menuObj.scrolly = true;
        }
        menuObj.style.position = 'absolute';
        menuObj.style.zIndex = zindex + layer;
        menuObj.onclick = function (e) {
            return doane(e, 0, 1);
        };
        if (duration < 3) {
            if (duration > 1) {
                menuObj.onmouseover = function () {
                    clearTimeout(JSMENU['timer'][menuid]);
                    JSMENU['timer'][menuid] = null;
                };
            }
            if (duration != 1) {
                menuObj.onmouseout = function () {
                    JSMENU['timer'][menuid] = setTimeout(function () {
                        hideMenu(menuid, mtype);
                    }, timeout);
                };
            }
        }
        if (cover) {
            var coverObj = document.createElement('div');
            coverObj.id = menuid + '_cover';
            coverObj.style.position = 'absolute';
            coverObj.style.zIndex = menuObj.style.zIndex - 1;
            coverObj.style.left = coverObj.style.top = '0px';
            coverObj.style.width = '100%';
            coverObj.style.height = Math.max(document.documentElement.clientHeight, document.body.offsetHeight) + 'px';
            coverObj.style.backgroundColor = '#000';
            coverObj.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=50)';
            coverObj.style.opacity = 0.5;
            coverObj.onclick = function () {
                hideMenu();
            };
            $('append_parent').appendChild(coverObj);
            _attachEvent(window, 'load', function () {
                coverObj.style.height = Math.max(document.documentElement.clientHeight, document.body.offsetHeight) + 'px';
            }, document);
        }
    }
    if (drag) {
        dragobj.style.cursor = 'move';
        dragobj.onmousedown = function (event) {
            try {
                dragMenu(menuObj, event, 1);
            } catch (e) {}
        };
    }
    if (cover) $(menuid + '_cover').style.display = '';
    if (fade) {
        var O = 0;
        var fadeIn = function (O) {
            if (O > 100) {
                clearTimeout(fadeInTimer);
                return;
            }
            menuObj.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + O + ')';
            menuObj.style.opacity = O / 100;
            O += 20;
            var fadeInTimer = setTimeout(function () {
                fadeIn(O);
            }, 40);
        };
        fadeIn(O);
        menuObj.fade = true;
    } else {
        menuObj.fade = false;
    }
    menuObj.style.display = '';
    if (ctrlObj && ctrlclass) {
        ctrlObj.className += ' ' + ctrlclass;
        menuObj.setAttribute('ctrlid', ctrlid);
        menuObj.setAttribute('ctrlclass', ctrlclass);
    }
    if (pos != '*') {
        setMenuPosition(showid, menuid, pos);
    }
    if (BROWSER.ie && BROWSER.ie < 7 && winhandlekey && $('fwin_' + winhandlekey)) {
        $(menuid).style.left = (parseInt($(menuid).style.left) - parseInt($('fwin_' + winhandlekey).style.left)) + 'px';
        $(menuid).style.top = (parseInt($(menuid).style.top) - parseInt($('fwin_' + winhandlekey).style.top)) + 'px';
    }
    if (maxh && menuObj.scrollHeight > maxh) {
        menuObj.style.height = maxh + 'px';
        if (BROWSER.opera) {
            menuObj.style.overflow = 'auto';
        } else {
            menuObj.style.overflowY = 'auto';
        }
    }
    if (!duration) {
        setTimeout('hideMenu(\'' + menuid + '\', \'' + mtype + '\')', timeout);
    }
    if (!in_array(menuid, JSMENU['active'][layer])) JSMENU['active'][layer].push(menuid);
    menuObj.cache = cache;
    if (layer > JSMENU['layer']) {
        JSMENU['layer'] = layer;
    }
    var hasshow = function (ele) {
        while (ele.parentNode && ((typeof (ele['currentStyle']) === 'undefined') ? window.getComputedStyle(ele, null) : ele['currentStyle'])['display'] !== 'none') {
            ele = ele.parentNode;
        }
        if (ele === document) {
            return true;
        } else {
            return false;
        }
    };
    if (!menuObj.getAttribute('disautofocus')) {
        try {
            var focused = false;
            var tags = ['input', 'select', 'textarea', 'button', 'a'];
            for (var i = 0; i < tags.length; i++) {
                var _all = menuObj.getElementsByTagName(tags[i]);
                if (_all.length) {
                    for (j = 0; j < _all.length; j++) {
                        if ((!_all[j]['type'] || _all[j]['type'] != 'hidden') && hasshow(_all[j])) {
                            _all[j].className += ' hidefocus';
                            _all[j].focus();
                            focused = true;
                            var cobj = _all[j];
                            _attachEvent(_all[j], 'blur', function () {
                                cobj.className = trim(cobj.className.replace(' hidefocus', ''));
                            });
                            break;
                        }
                    }
                }
                if (focused) {
                    break;
                }
            }
        } catch (e) {}
    }
}
var delayShowST = null;

function delayShow(ctrlObj, call, time) {
    if (typeof ctrlObj == 'object') {
        var ctrlid = ctrlObj.id;
        call = call || function () {
            showMenu(ctrlid);
        };
    }
    var time = isUndefined(time) ? 500 : time;
    delayShowST = setTimeout(function () {
        if (typeof call == 'function') {
            call();
        } else {
            eval(call);
        }
    }, time);
    if (!ctrlObj.delayinit) {
        _attachEvent(ctrlObj, 'mouseout', function () {
            clearTimeout(delayShowST);
        });
        ctrlObj.delayinit = 1;
    }
}
var dragMenuDisabled = false;

function dragMenu(menuObj, e, op) {
    e = e ? e : window.event;
    if (op == 1) {
        if (dragMenuDisabled || in_array(e.target ? e.target.tagName : e.srcElement.tagName, ['TEXTAREA', 'INPUT', 'BUTTON', 'SELECT'])) {
            return;
        }
        JSMENU['drag'] = [e.clientX, e.clientY];
        JSMENU['drag'][2] = parseInt(menuObj.style.left);
        JSMENU['drag'][3] = parseInt(menuObj.style.top);
        document.onmousemove = function (e) {
            try {
                dragMenu(menuObj, e, 2);
            } catch (err) {}
        };
        document.onmouseup = function (e) {
            try {
                dragMenu(menuObj, e, 3);
            } catch (err) {}
        };
        doane(e);
    } else if (op == 2 && JSMENU['drag'][0]) {
        var menudragnow = [e.clientX, e.clientY];
        menuObj.style.left = (JSMENU['drag'][2] + menudragnow[0] - JSMENU['drag'][0]) + 'px';
        menuObj.style.top = (JSMENU['drag'][3] + menudragnow[1] - JSMENU['drag'][1]) + 'px';
        menuObj.removeAttribute('top_');
        menuObj.removeAttribute('left_');
        doane(e);
    } else if (op == 3) {
        JSMENU['drag'] = [];
        document.onmousemove = null;
        document.onmouseup = null;
    }
}

function setMenuPosition(showid, menuid, pos) {
    var showObj = $(showid);
    var menuObj = menuid ? $(menuid) : $(showid + '_menu');
    if (isUndefined(pos) || !pos) pos = '43';
    var basePoint = parseInt(pos.substr(0, 1));
    var direction = parseInt(pos.substr(1, 1));
    var important = pos.indexOf('!') != -1 ? 1 : 0;
    var sxy = 0,
        sx = 0,
        sy = 0,
        sw = 0,
        sh = 0,
        ml = 0,
        mt = 0,
        mw = 0,
        mcw = 0,
        mh = 0,
        mch = 0,
        bpl = 0,
        bpt = 0;
    if (!menuObj || (basePoint > 0 && !showObj)) return;
    if (showObj) {
        sxy = fetchOffset(showObj);
        sx = sxy['left'];
        sy = sxy['top'];
        sw = showObj.offsetWidth;
        sh = showObj.offsetHeight;
    }
    mw = menuObj.offsetWidth;
    mcw = menuObj.clientWidth;
    mh = menuObj.offsetHeight;
    mch = menuObj.clientHeight;
    switch (basePoint) {
        case 1:
            bpl = sx;
            bpt = sy;
            break;
        case 2:
            bpl = sx + sw;
            bpt = sy;
            break;
        case 3:
            bpl = sx + sw;
            bpt = sy + sh;
            break;
        case 4:
            bpl = sx;
            bpt = sy + sh;
            break;
    }
    switch (direction) {
        case 0:
            menuObj.style.left = (document.body.clientWidth - menuObj.clientWidth) / 2 + 'px';
            mt = (document.documentElement.clientHeight - menuObj.clientHeight) / 2;
            break;
        case 1:
            ml = bpl - mw;
            mt = bpt - mh;
            break;
        case 2:
            ml = bpl;
            mt = bpt - mh;
            break;
        case 3:
            ml = bpl;
            mt = bpt;
            break;
        case 4:
            ml = bpl - mw;
            mt = bpt;
            break;
    }
    var scrollTop = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
    var scrollLeft = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
    if (!important) {
        if (in_array(direction, [1, 4]) && ml < 0) {
            ml = bpl;
            if (in_array(basePoint, [1, 4])) ml += sw;
        } else if (ml + mw > scrollLeft + document.body.clientWidth && sx >= mw) {
            ml = bpl - mw;
            if (in_array(basePoint, [2, 3])) {
                ml -= sw;
            } else if (basePoint == 4) {
                ml += sw;
            }
        }
        if (in_array(direction, [1, 2]) && mt < 0) {
            mt = bpt;
            if (in_array(basePoint, [1, 2])) mt += sh;
        } else if (mt + mh > scrollTop + document.documentElement.clientHeight && sy >= mh) {
            mt = bpt - mh;
            if (in_array(basePoint, [3, 4])) mt -= sh;
        }
    }
    if (pos.substr(0, 3) == '210') {
        ml += 69 - sw / 2;
        mt -= 5;
        if (showObj.tagName == 'TEXTAREA') {
            ml -= sw / 2;
            mt += sh / 2;
        }
    }
    if (direction == 0 || menuObj.scrolly) {
        if (BROWSER.ie && BROWSER.ie < 7) {
            if (direction == 0) mt += scrollTop;
        } else {
            if (menuObj.scrolly) mt -= scrollTop;
            menuObj.style.position = 'fixed';
        }
    }
    if (ml) menuObj.style.left = ml + 'px';
    if (mt) menuObj.style.top = mt + 'px';
    if (direction == 0 && BROWSER.ie && !document.documentElement.clientHeight) {
        menuObj.style.position = 'absolute';
        menuObj.style.top = (document.body.clientHeight - menuObj.clientHeight) / 2 + 'px';
    }
    if (menuObj.style.clip && !BROWSER.opera) {
        menuObj.style.clip = 'rect(auto, auto, auto, auto)';
    }
}

function hideMenu(attr, mtype) {
    attr = isUndefined(attr) ? '' : attr;
    mtype = isUndefined(mtype) ? 'menu' : mtype;
    if (attr == '') {
        for (var i = 1; i <= JSMENU['layer']; i++) {
            hideMenu(i, mtype);
        }
        return;
    } else if (typeof attr == 'number') {
        for (var j in JSMENU['active'][attr]) {
            hideMenu(JSMENU['active'][attr][j], mtype);
        }
        return;
    } else if (typeof attr == 'string') {
        var menuObj = $(attr);
        if (!menuObj || (mtype && menuObj.mtype != mtype)) return;
        var ctrlObj = '',
            ctrlclass = '';
        if ((ctrlObj = $(menuObj.getAttribute('ctrlid'))) && (ctrlclass = menuObj.getAttribute('ctrlclass'))) {
            var reg = new RegExp(' ' + ctrlclass);
            ctrlObj.className = ctrlObj.className.replace(reg, '');
        }
        clearTimeout(JSMENU['timer'][attr]);
        var hide = function () {
            if (menuObj.cache) {
                if (menuObj.style.visibility != 'hidden') {
                    menuObj.style.display = 'none';
                    if (menuObj.cover) $(attr + '_cover').style.display = 'none';
                }
            } else {
                menuObj.parentNode.removeChild(menuObj);
                if (menuObj.cover) $(attr + '_cover').parentNode.removeChild($(attr + '_cover'));
            }
            var tmp = [];
            for (var k in JSMENU['active'][menuObj.layer]) {
                if (attr != JSMENU['active'][menuObj.layer][k]) tmp.push(JSMENU['active'][menuObj.layer][k]);
            }
            JSMENU['active'][menuObj.layer] = tmp;
        };
        if (menuObj.fade) {
            var O = 100;
            var fadeOut = function (O) {
                if (O == 0) {
                    clearTimeout(fadeOutTimer);
                    hide();
                    return;
                }
                menuObj.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + O + ')';
                menuObj.style.opacity = O / 100;
                O -= 20;
                var fadeOutTimer = setTimeout(function () {
                    fadeOut(O);
                }, 40);
            };
            fadeOut(O);
        } else {
            hide();
        }
    }
}

function getCurrentStyle(obj, cssproperty, csspropertyNS) {
    if (obj.style[cssproperty]) {
        return obj.style[cssproperty];
    }
    if (obj.currentStyle) {
        return obj.currentStyle[cssproperty];
    } else if (document.defaultView.getComputedStyle(obj, null)) {
        var currentStyle = document.defaultView.getComputedStyle(obj, null);
        var value = currentStyle.getPropertyValue(csspropertyNS);
        if (!value) {
            value = currentStyle[cssproperty];
        }
        return value;
    } else if (window.getComputedStyle) {
        var currentStyle = window.getComputedStyle(obj, "");
        return currentStyle.getPropertyValue(csspropertyNS);
    }
}

function fetchOffset(obj, mode) {
    var left_offset = 0,
        top_offset = 0,
        mode = !mode ? 0 : mode;
    if (obj.getBoundingClientRect && !mode) {
        var rect = obj.getBoundingClientRect();
        var scrollTop = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
        var scrollLeft = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
        if (document.documentElement.dir == 'rtl') {
            scrollLeft = scrollLeft + document.documentElement.clientWidth - document.documentElement.scrollWidth;
        }
        left_offset = rect.left + scrollLeft - document.documentElement.clientLeft;
        top_offset = rect.top + scrollTop - document.documentElement.clientTop;
    }
    if (left_offset <= 0 || top_offset <= 0) {
        left_offset = obj.offsetLeft;
        top_offset = obj.offsetTop;
        while ((obj = obj.offsetParent) != null) {
            position = getCurrentStyle(obj, 'position', 'position');
            if (position == 'relative') {
                continue;
            }
            left_offset += obj.offsetLeft;
            top_offset += obj.offsetTop;
        }
    }
    return {
        'left': left_offset,
        'top': top_offset
    };
}

function showTip(ctrlobj) {
    $F('_showTip', arguments);
}

function showPrompt(ctrlid, evt, msg, timeout, classname) {
    $F('_showPrompt', arguments);
}

function showCreditPrompt() {
    $F('_showCreditPrompt', []);
}

function hideWindow(k, all, clear) {
    all = isUndefined(all) ? 1 : all;
    clear = isUndefined(clear) ? 1 : clear;
    hideMenu('fwin_' + k, 'win');
    if (clear && $('fwin_' + k)) {
        $('append_parent').removeChild($('fwin_' + k));
    }
    if (all) {
        hideMenu();
    }
}

function AC_FL_RunContent() {
    var str = '';
    var ret = AC_GetArgs(arguments, "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000", "application/x-shockwave-flash");
    if (BROWSER.ie && !BROWSER.opera) {
        str += '<object ';
        for (var i in ret.objAttrs) {
            str += i + '="' + ret.objAttrs[i] + '" ';
        }
        str += '>';
        for (var i in ret.params) {
            str += '<param name="' + i + '" value="' + ret.params[i] + '" /> ';
        }
        str += '</object>';
    } else {
        str += '<embed ';
        for (var i in ret.embedAttrs) {
            str += i + '="' + ret.embedAttrs[i] + '" ';
        }
        str += '></embed>';
    }
    return str;
}

function AC_GetArgs(args, classid, mimeType) {
    var ret = new Object();
    ret.embedAttrs = new Object();
    ret.params = new Object();
    ret.objAttrs = new Object();
    for (var i = 0; i < args.length; i = i + 2) {
        var currArg = args[i].toLowerCase();
        switch (currArg) {
            case "classid":
                break;
            case "pluginspage":
                ret.embedAttrs[args[i]] = 'http://www.macromedia.com/go/getflashplayer';
                break;
            case "src":
                ret.embedAttrs[args[i]] = args[i + 1];
                ret.params["movie"] = args[i + 1];
                break;
            case "codebase":
                ret.objAttrs[args[i]] = 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0';
                break;
            case "onafterupdate":
            case "onbeforeupdate":
            case "onblur":
            case "oncellchange":
            case "onclick":
            case "ondblclick":
            case "ondrag":
            case "ondragend":
            case "ondragenter":
            case "ondragleave":
            case "ondragover":
            case "ondrop":
            case "onfinish":
            case "onfocus":
            case "onhelp":
            case "onmousedown":
            case "onmouseup":
            case "onmouseover":
            case "onmousemove":
            case "onmouseout":
            case "onkeypress":
            case "onkeydown":
            case "onkeyup":
            case "onload":
            case "onlosecapture":
            case "onpropertychange":
            case "onreadystatechange":
            case "onrowsdelete":
            case "onrowenter":
            case "onrowexit":
            case "onrowsinserted":
            case "onstart":
            case "onscroll":
            case "onbeforeeditfocus":
            case "onactivate":
            case "onbeforedeactivate":
            case "ondeactivate":
            case "type":
            case "id":
                ret.objAttrs[args[i]] = args[i + 1];
                break;
            case "width":
            case "height":
            case "align":
            case "vspace":
            case "hspace":
            case "class":
            case "title":
            case "accesskey":
            case "name":
            case "tabindex":
                ret.embedAttrs[args[i]] = ret.objAttrs[args[i]] = args[i + 1];
                break;
            default:
                ret.embedAttrs[args[i]] = ret.params[args[i]] = args[i + 1];
        }
    }
    ret.objAttrs["classid"] = classid;
    if (mimeType) {
        ret.embedAttrs["type"] = mimeType;
    }
    return ret;
}

function simulateSelect(selectId, widthvalue) {
    var selectObj = $(selectId);
    if (!selectObj) return;
    if (BROWSER.other) {
        if (selectObj.getAttribute('change')) {
            selectObj.onchange = function () {
                eval(selectObj.getAttribute('change'));
            }
        }
        return;
    }
    var widthvalue = widthvalue ? widthvalue : 70;
    var defaultopt = selectObj.options[0] ? selectObj.options[0].innerHTML : '';
    var defaultv = '';
    var menuObj = document.createElement('div');
    var ul = document.createElement('ul');
    var handleKeyDown = function (e) {
        e = BROWSER.ie ? event : e;
        if (e.keyCode == 40 || e.keyCode == 38) doane(e);
    };
    var selectwidth = (selectObj.getAttribute('width', i) ? selectObj.getAttribute('width', i) : widthvalue) + 'px';
    var tabindex = selectObj.getAttribute('tabindex', i) ? selectObj.getAttribute('tabindex', i) : 1;
    for (var i = 0; i < selectObj.options.length; i++) {
        var li = document.createElement('li');
        li.innerHTML = selectObj.options[i].innerHTML;
        li.k_id = i;
        li.k_value = selectObj.options[i].value;
        if (selectObj.options[i].selected) {
            defaultopt = selectObj.options[i].innerHTML;
            defaultv = selectObj.options[i].value;
            li.className = 'current';
            selectObj.setAttribute('selecti', i);
        }
        li.onclick = function () {
            if ($(selectId + '_ctrl').innerHTML != this.innerHTML) {
                var lis = menuObj.getElementsByTagName('li');
                lis[$(selectId).getAttribute('selecti')].className = '';
                this.className = 'current';
                $(selectId + '_ctrl').innerHTML = this.innerHTML;
                $(selectId).setAttribute('selecti', this.k_id);
                $(selectId).options.length = 0;
                $(selectId).options[0] = new Option('', this.k_value);
                eval(selectObj.getAttribute('change'));
            }
            hideMenu(menuObj.id);
            return false;
        };
        ul.appendChild(li);
    }
    selectObj.options.length = 0;
    selectObj.options[0] = new Option('', defaultv);
    selectObj.style.display = 'none';
    selectObj.outerHTML += '<a href="javascript:;" id="' + selectId + '_ctrl" style="width:' + selectwidth + '" tabindex="' + tabindex + '">' + defaultopt + '</a>';
    menuObj.id = selectId + '_ctrl_menu';
    menuObj.className = 'sltm';
    menuObj.style.display = 'none';
    menuObj.style.width = selectwidth;
    menuObj.appendChild(ul);
    $('append_parent').appendChild(menuObj);
    $(selectId + '_ctrl').onclick = function (e) {
        $(selectId + '_ctrl_menu').style.width = selectwidth;
        showMenu({
            'ctrlid': (selectId == 'loginfield' ? 'account' : selectId + '_ctrl'),
            'menuid': selectId + '_ctrl_menu',
            'evt': 'click',
            'pos': '43'
        });
        doane(e);
    };
    $(selectId + '_ctrl').onfocus = menuObj.onfocus = function () {
        _attachEvent(document.body, 'keydown', handleKeyDown);
    };
    $(selectId + '_ctrl').onblur = menuObj.onblur = function () {
        _detachEvent(document.body, 'keydown', handleKeyDown);
    };
    $(selectId + '_ctrl').onkeyup = function (e) {
        e = e ? e : window.event;
        value = e.keyCode;
        if (value == 40 || value == 38) {
            if (menuObj.style.display == 'none') {
                $(selectId + '_ctrl').onclick();
            } else {
                lis = menuObj.getElementsByTagName('li');
                selecti = selectObj.getAttribute('selecti');
                lis[selecti].className = '';
                if (value == 40) {
                    selecti = parseInt(selecti) + 1;
                } else if (value == 38) {
                    selecti = parseInt(selecti) - 1;
                }
                if (selecti < 0) {
                    selecti = lis.length - 1
                } else if (selecti > lis.length - 1) {
                    selecti = 0;
                }
                lis[selecti].className = 'current';
                selectObj.setAttribute('selecti', selecti);
                lis[selecti].parentNode.scrollTop = lis[selecti].offsetTop;
            }
        } else if (value == 13) {
            var lis = menuObj.getElementsByTagName('li');
            lis[selectObj.getAttribute('selecti')].onclick();
        } else if (value == 27) {
            hideMenu(menuObj.id);
        }
    };
}

function switchTab(prefix, current, total, activeclass) {
    $F('_switchTab', arguments);
}

function imageRotate(imgid, direct) {
    $F('_imageRotate', arguments);
}

function thumbImg(obj, method) {
    if (!obj) {
        return;
    }
    obj.onload = null;
    file = obj.src;
    zw = obj.offsetWidth;
    zh = obj.offsetHeight;
    if (zw < 2) {
        if (!obj.id) {
            obj.id = 'img_' + Math.random();
        }
        setTimeout("thumbImg($('" + obj.id + "'), " + method + ")", 100);
        return;
    }
    zr = zw / zh;
    method = !method ? 0 : 1;
    if (method) {
        fixw = obj.getAttribute('_width');
        fixh = obj.getAttribute('_height');
        if (zw > fixw) {
            zw = fixw;
            zh = zw / zr;
        }
        if (zh > fixh) {
            zh = fixh;
            zw = zh * zr;
        }
    } else {
        fixw = typeof imagemaxwidth == 'undefined' ? '600' : imagemaxwidth;
        if (zw > fixw) {
            zw = fixw;
            zh = zw / zr;
            obj.style.cursor = 'pointer';
            if (!obj.onclick) {
                obj.onclick = function () {
                    zoom(obj, obj.src);
                };
            }
        }
    }
    obj.width = zw;
    obj.height = zh;
}
var zoomstatus = 1;

function zoom(obj, zimg, nocover, pn, showexif) {
    $F('_zoom', arguments);
}

function showselect(obj, inpid, t, rettype) {
    $F('_showselect', arguments);
}

function showColorBox(ctrlid, layer, k, bgcolor) {
    $F('_showColorBox', arguments);
}

function ctrlEnter(event, btnId, onlyEnter) {
    if (isUndefined(onlyEnter)) onlyEnter = 0;
    if ((event.ctrlKey || onlyEnter) && event.keyCode == 13) {
        $(btnId).click();
        return false;
    }
    return true;
}

function parseurl(str, mode, parsecode) {
    if (isUndefined(parsecode)) parsecode = true;
    if (parsecode) str = str.replace(/\[code\]([\s\S]+?)\[\/code\]/ig, function ($1, $2) {
        return codetag($2, -1);
    });
    str = str.replace(/([^>=\]"'\/]|^)((((https?|ftp):\/\/)|www\.)([\w\-]+\.)*[\w\-\u4e00-\u9fa5]+\.([\.a-zA-Z0-9]+|\u4E2D\u56FD|\u7F51\u7EDC|\u516C\u53F8)((\?|\/|:)+[\w\.\/=\?%\-&~`@':+!]*)+\.(swf|flv))/ig, '$1[flash]$2[/flash]');
    str = str.replace(/([^>=\]"'\/]|^)((((https?|ftp):\/\/)|www\.)([\w\-]+\.)*[\w\-\u4e00-\u9fa5]+\.([\.a-zA-Z0-9]+|\u4E2D\u56FD|\u7F51\u7EDC|\u516C\u53F8)((\?|\/|:)+[\w\.\/=\?%\-&~`@':+!]*)+\.(mp3|wma))/ig, '$1[audio]$2[/audio]');
    str = str.replace(/([^>=\]"'\/@]|^)((((https?|ftp|gopher|news|telnet|rtsp|mms|callto|bctp|ed2k|thunder|qqdl|synacast):\/\/))([\w\-]+\.)*[:\.@\-\w\u4e00-\u9fa5]+\.([\.a-zA-Z0-9]+|\u4E2D\u56FD|\u7F51\u7EDC|\u516C\u53F8)((\?|\/|:)+[\w\.\/=\?%\-&;~`@':+!#]*)*)/ig, mode == 'html' ? '$1<a href="$2" target="_blank">$2</a>' : '$1[url]$2[/url]');
    str = str.replace(/([^\w>=\]"'\/@]|^)((www\.)([\w\-]+\.)*[:\.@\-\w\u4e00-\u9fa5]+\.([\.a-zA-Z0-9]+|\u4E2D\u56FD|\u7F51\u7EDC|\u516C\u53F8)((\?|\/|:)+[\w\.\/=\?%\-&;~`@':+!#]*)*)/ig, mode == 'html' ? '$1<a href="$2" target="_blank">$2</a>' : '$1[url]$2[/url]');
    str = str.replace(/([^\w->=\]:"'\.\/]|^)(([\-\.\w]+@[\.\-\w]+(\.\w+)+))/ig, mode == 'html' ? '$1<a href="mailto:$2">$2</a>' : '$1[email]$2[/email]');
    if (parsecode) {
        for (var i = 0; i <= DISCUZCODE['num']; i++) {
            str = str.replace("[\tDISCUZ_CODE_" + i + "\t]", DISCUZCODE['html'][i]);
        }
    }
    return str;
}

function codetag(text, br) {
    var br = !br ? 1 : br;
    DISCUZCODE['num']++;
    if (br > 0 && typeof wysiwyg != 'undefined' && wysiwyg) text = text.replace(/<br[^\>]*>/ig, '\n');
    text = text.replace(/\$/ig, '$$');
    DISCUZCODE['html'][DISCUZCODE['num']] = '[code]' + text + '[/code]';
    return '[\tDISCUZ_CODE_' + DISCUZCODE['num'] + '\t]';
}

function saveUserdata(name, data) {
    try {
        if (window.localStorage) {
            localStorage.setItem('Discuz_' + name, data);
        } else if (window.sessionStorage) {
            sessionStorage.setItem('Discuz_' + name, data);
        }
    } catch (e) {
        if (BROWSER.ie) {
            if (data.length < 54889) {
                with(document.documentElement) {
                    setAttribute("value", data);
                    save('Discuz_' + name);
                }
            }
        }
    }
    setcookie('clearUserdata', '', -1);
}

function loadUserdata(name) {
    if (window.localStorage) {
        return localStorage.getItem('Discuz_' + name);
    } else if (window.sessionStorage) {
        return sessionStorage.getItem('Discuz_' + name);
    } else if (BROWSER.ie) {
        with(document.documentElement) {
            load('Discuz_' + name);
            return getAttribute("value");
        }
    }
}

function initTab(frameId, type) {
    $F('_initTab', arguments);
}

function hasClass(elem, className) {
    return elem.className && (" " + elem.className + " ").indexOf(" " + className + " ") != -1;
}

function runslideshow() {
    $F('_runslideshow', []);
}

function toggle_collapse(objname, noimg, complex, lang) {
    $F('_toggle_collapse', arguments);
}

function updatestring(str1, str2, clear) {
    str2 = '_' + str2 + '_';
    return clear ? str1.replace(str2, '') : (str1.indexOf(str2) == -1 ? str1 + str2 : str1);
}

function getClipboardData() {
    window.document.clipboardswf.SetVariable('str', CLIPBOARDSWFDATA);
}

function setCopy(text, msg) {
    $F('_setCopy', arguments);
}

function copycode(obj) {
    $F('_copycode', arguments);
}

function showdistrict(container, elems, totallevel, changelevel, containertype) {
    $F('_showdistrict', arguments);
}

function setDoodle(fid, oid, url, tid, from) {
    $F('_setDoodle', arguments);
}

function extstyle(css) {
    $F('_extstyle', arguments);
}

function widthauto(obj) {
    $F('_widthauto', arguments);
}
var secST = new Array();

function updatesecqaa(idhash) {
    $F('_updatesecqaa', arguments);
}

function updateseccode(idhash) {
    $F('_updateseccode', arguments);
}

function checksec(type, idhash, showmsg, recall) {
    $F('_checksec', arguments);
}

function createPalette(colorid, id, func) {
    $F('_createPalette', arguments);
}

function showForummenu(fid) {
    $F('_showForummenu', arguments);
}

function showUserApp() {
    $F('_showUserApp', arguments);
}

function cardInit() {
    var cardShow = function (obj) {
        if (BROWSER.ie && BROWSER.ie < 7 && obj.href.indexOf('username') != -1) {
            return;
        }
        pos = obj.getAttribute('c') == '1' ? '43' : obj.getAttribute('c');
        USERCARDST = setTimeout(function () {
            ajaxmenu(obj, 500, 1, 2, pos, null, 'p_pop card');
        }, 250);
    };
    var cardids = {};
    var a = document.body.getElementsByTagName('a');
    for (var i = 0; i < a.length; i++) {
        if (a[i].getAttribute('c')) {
            var href = a[i].getAttribute('href', 1);
            if (typeof cardids[href] == 'undefined') {
                cardids[href] = Math.round(Math.random() * 10000);
            }
            a[i].setAttribute('mid', 'card_' + cardids[href]);
            a[i].onmouseover = function () {
                cardShow(this)
            };
            a[i].onmouseout = function () {
                clearTimeout(USERCARDST);
            };
        }
    }
}

function navShow(id) {
    var mnobj = $('snav_mn_' + id);
    if (!mnobj) {
        return;
    }
    var uls = $('mu').getElementsByTagName('ul');
    for (i = 0; i < uls.length; i++) {
        if (uls[i].className != 'cl current') {
            uls[i].style.display = 'none';
        }
    }
    if (mnobj.className != 'cl current') {
        showMenu({
            'ctrlid': 'mn_' + id,
            'menuid': 'snav_mn_' + id,
            'pos': '*'
        });
        mnobj.className = 'cl floatmu';
        mnobj.style.width = ($('nv').clientWidth) + 'px';
        mnobj.style.display = '';
    }
}

function strLenCalc(obj, checklen, maxlen) {
    var v = obj.value,
        charlen = 0,
        maxlen = !maxlen ? 200 : maxlen,
        curlen = maxlen,
        len = strlen(v);
    for (var i = 0; i < v.length; i++) {
        if (v.charCodeAt(i) < 0 || v.charCodeAt(i) > 255) {
            curlen -= charset == 'utf-8' ? 2 : 1;
        }
    }
    if (curlen >= len) {
        $(checklen).innerHTML = curlen - len;
    } else {
        obj.value = mb_cutstr(v, maxlen, 0);
    }
}

function relatedlinks(rlinkmsgid) {
    $F('_relatedlinks', arguments);
}

function con_handle_response(response) {
    return response;
}

function showTopLink() {
    var ft = $('ft');
    if (ft) {
        var scrolltop = $('scrolltop');
        var viewPortHeight = parseInt(document.documentElement.clientHeight);
        var scrollHeight = parseInt(document.body.getBoundingClientRect().top);
        var basew = parseInt(ft.clientWidth);
        var sw = scrolltop.clientWidth;
        if (basew < 1000) {
            var left = parseInt(fetchOffset(ft)['left']);
            left = left < sw ? left * 2 - sw : left;
            scrolltop.style.left = (basew + left) + 'px';
        } else {
            scrolltop.style.left = 'auto';
            scrolltop.style.right = 0;
        }
        if (BROWSER.ie && BROWSER.ie < 7) {
            scrolltop.style.top = viewPortHeight - scrollHeight - 150 + 'px';
        }
        if (scrollHeight < -100) {
            scrolltop.style.visibility = 'visible';
        } else {
            scrolltop.style.visibility = 'hidden';
        }
    }
}

function showCreditmenu() {
    $F('_showCreditmenu', []);
}

function showUpgradeinfo() {
    $F('_showUpgradeinfo', []);
}

function setShortcut() {
    var scrollTop = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
    if (!loadUserdata('setshortcut') && !scrollTop) {
        $F('_setShortcut', []);
    }
}

function smilies_show(id, smcols, seditorkey) {
    $F('_smilies_show', arguments, 'smilies');
}

function showfocus(ftype, autoshow) {
    var id = parseInt($('focuscur').innerHTML);
    if (ftype == 'prev') {
        id = (id - 1) < 1 ? focusnum : (id - 1);
        if (!autoshow) {
            window.clearInterval(focusautoshow);
        }
    } else if (ftype == 'next') {
        id = (id + 1) > focusnum ? 1 : (id + 1);
        if (!autoshow) {
            window.clearInterval(focusautoshow);
        }
    }
    $('focuscur').innerHTML = id;
    $('focus_con').innerHTML = $('focus_' + (id - 1)).innerHTML;
}

function rateStarHover(target, level) {
    if (level == 0) {
        $(target).style.width = '';
    } else {
        $(target).style.width = level * 16 + 'px';
    }
}

function rateStarSet(target, level, input) {
    $(input).value = level;
    $(target).className = 'star star' + level;
}

function img_onmouseoverfunc(obj) {
    if (typeof showsetcover == 'function') {
        showsetcover(obj);
    }
    return;
}

function getElementOffset(element) {
    var left = element.offsetLeft,
        top = element.offsetTop;
    while (element = element.offsetParent) {
        left += element.offsetLeft;
        top += element.offsetTop;
    }
    if ($('nv').style.position == 'fixed') {
        top -= parseInt($('nv').style.height);
    }
    return {
        'left': left,
        'top': top
    };
}

function mobileplayer() {
    var platform = navigator.platform;
    var ua = navigator.userAgent;
    var ios = /iPhone|iPad|iPod/.test(platform) && ua.indexOf("AppleWebKit") > -1;
    var andriod = ua.indexOf("Android") > -1;
    if (ios || andriod) {
        return true;
    } else {
        return false;
    }
}
if (BROWSER.ie) {
    document.documentElement.addBehavior("#default#userdata");
}