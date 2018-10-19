<?php
    if(!defined('IN_ROOT')){
        exit('Access denied');
    }
    Administrator(1);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
		<title>Ear Music 管理中心</title>
		<link rel="shortcut icon" href="static/admincp/images/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="static/admincp/css/main.css" type="text/css" media="all" />
		<script src="static/admincp/js/common.js"></script>
		<script src="static/admincp/js/ajax.js"></script>
	</head>
<body scroll="no">
	<table id="frametable" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="2" height="90">
			<div class="mainhd">
				<a href="?iframe=index" class="logo">Ear Music Administrator's Control Panel</a>
				<div class="uinfo" id="frameuinfo">
					<span>您好, <em><?php echo $_COOKIE['in_adminname']; ?></em> [<a href="?action=logout">退出</a>]</span>
					<span class="btnlink"><a href="index.php" target="_blank">站点首页</a></span>
				</div>
				<div class="nav">
					<ul id="topmenu">
						<li><em><a href="?iframe=body" id="header_index" hidefocus="true" onmouseover="previewheader('index')" onmouseout="previewheader()" onclick="toggleMenu('index', '?iframe=body');doane(event);">首页</a></em></li>
						<li><em><a href="?iframe=config" id="header_global" hidefocus="true" onmouseover="previewheader('global')" onmouseout="previewheader()" onclick="toggleMenu('global', '?iframe=config');doane(event);">全局</a></em></li>
						<li><em><a href="?iframe=music" id="header_content" hidefocus="true" onmouseover="previewheader('content')" onmouseout="previewheader()" onclick="toggleMenu('content', '?iframe=music');doane(event);">内容</a></em></li>
						<li><em><a href="?iframe=skin" id="header_style" hidefocus="true" onmouseover="previewheader('style')" onmouseout="previewheader()" onclick="toggleMenu('style', '?iframe=skin');doane(event);">主题</a></em></li>
						<li><em><a href="?iframe=user" id="header_user" hidefocus="true" onmouseover="previewheader('user')" onmouseout="previewheader()" onclick="toggleMenu('user', '?iframe=user');doane(event);">用户</a></em></li>
						<li><em><a href="?iframe=backup" id="header_plugin" hidefocus="true" onmouseover="previewheader('plugin')" onmouseout="previewheader()" onclick="toggleMenu('plugin', '?iframe=backup');doane(event);">工具</a></em></li>
						<li><em><a href="?iframe=admin" id="header_system" hidefocus="true" onmouseover="previewheader('system')" onmouseout="previewheader()" onclick="toggleMenu('system', '?iframe=admin');doane(event);">系统</a></em></li>
						<li><em><a href="?iframe=module" id="header_app" hidefocus="true" onmouseover="previewheader('app')" onmouseout="previewheader()" onclick="toggleMenu('app', '?iframe=module');doane(event);">扩展</a></em></li>
						<li><em><a href="?iframe=ucenter" id="header_uc" hidefocus="true" onmouseover="previewheader('uc')" onmouseout="previewheader()" onclick="toggleMenu('uc', '?iframe=ucenter');doane(event);">UCenter</a></em></li>
					</ul>
					<div class="currentloca">
						<p id="admincpnav"></p>
					</div>
					<div class="navbd"></div>
					<div class="sitemapbtn">
						<a href="javascript:void(0)" id="cpmap" onclick="showMap();return false;"><img src="static/admincp/images/btn_map.png" title="管理中心导航(ESC键)" width="18" height="18" /></a>
					</div>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td valign="top" width="160" class="menutd">
			<div id="leftmenu" class="menu">
				<ul id="menu_index" style="display: none">
					<li><a href="?iframe=body" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>管理中心首页</a></li>
				</ul>
				<ul id="menu_global" style="display: none">
					<li><a href="?iframe=config" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>站点信息</a></li>
					<li><a href="?iframe=config_cache" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>缓存信息</a></li>
					<li><a href="?iframe=config_upload" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>上传信息</a></li>
					<li><a href="?iframe=config_pay" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>支付信息</a></li>
					<li><a href="?iframe=config_user" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>会员信息</a></li>
				</ul>
				<ul id="menu_style" style="display: none">
					<li><a href="?iframe=skin" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>模板方案</a></li>
					<li><a href="?iframe=label" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>模板标签</a></li>
				</ul>
				<ul id="menu_content" style="display: none">
					<li class="s">
						<div class="lsub desc" subid="M11fe1b9c">
							<div onclick="lsub('M11fe1b9c', this.parentNode)">音乐</div>
							<ol style="display:" id="M11fe1b9c">
                            <li><a href="?iframe=music" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>音乐管理</a></li>
                                <li><a href="?iframe=class" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>音乐栏目</a></li>
                                <li><a href="?iframe=tag" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>音乐标签</a></li>
								<li class="sp"></li>
							</ol>
						</div>
					</li>
					<li class="s">
						<div class="lsub" subid="M34a79c04">
							<div onclick="lsub('M34a79c04', this.parentNode)">专辑</div>
							<ol style="display: none" id="M34a79c04">
								<li><a href="?iframe=special" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>所有专辑</a></li>
								<li><a href="?iframe=special&action=add" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>新增专辑</a></li>
								<li><a href="?iframe=special&action=pass" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>待审专辑</a></li>
								<li><a href="?iframe=special&action=class" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>专辑栏目</a></li>
								<li class="sp"></li>
							</ol>
						</div>
					</li>
					<li class="s">
						<div class="lsub" subid="M3b496078">
						<div onclick="lsub('M3b496078', this.parentNode)">歌手</div>
							<ol style="display: none" id="M3b496078">
								<li><a href="?iframe=singer" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>所有歌手</a></li>
								<li><a href="?iframe=singer&action=add" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>新增歌手</a></li>
								<li><a href="?iframe=singer&action=pass" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>待审歌手</a></li>
								<li><a href="?iframe=singer&action=class" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>歌手栏目</a></li>
								<li class="sp"></li>
							</ol>
						</div>
					</li>
					<li class="s">
						<div class="lsub" subid="M9570187e">
							<div onclick="lsub('M9570187e', this.parentNode)">视频</div>
							<ol style="display: none" id="M9570187e">
								<li><a href="?iframe=video" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>所有视频</a></li>
								<li><a href="?iframe=video&action=add" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>新增视频</a></li>
								<li><a href="?iframe=video&action=pass" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>待审视频</a></li>
								<li><a href="?iframe=video&action=class" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>视频栏目</a></li>
								<li class="sp"></li>
							</ol>
						</div>
					</li>
				</ul>
				<ul id="menu_user" style="display: none">
					<li><a href="?iframe=user" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>所有用户</a></li>
					<li><a href="?iframe=comment" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>所有评论</a></li>
					<li><a href="?iframe=feed" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>所有说说</a></li>
					<li><a href="?iframe=wall" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>所有留言</a></li>
					<li><a href="?iframe=blog" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>所有日志</a></li>
					<li><a href="?iframe=photo" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>所有照片</a></li>
				</ul>
				<ul id="menu_plugin" style="display: none">
					<li><a href="?iframe=backup" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>站点备份</a></li>
					<li><a href="?iframe=sql" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>执行语句</a></li>
					<li><a href="?iframe=cache" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>更新缓存</a></li>
					<li><a href="?iframe=html" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>静态生成</a></li>
				</ul>
				<ul id="menu_system" style="display: none">
					<li><a href="?iframe=admin" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>系统用户</a></li>
					<li><a href="?iframe=link" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>友情链接</a></li>
					<li><a href="?iframe=uplog" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>上传记录</a></li>
					<li><a href="?iframe=paylog" hidefocus="true" target="main"><em onclick="menuNewwin(this)" title="新窗口打开"></em>支付记录</a></li>
				</ul>
				<ul id="menu_app" style="display: none">
					<?php echo Menu_App(); ?>
				</ul>
				<ul id="menu_uc" style="display: none"></ul>
			</div>
		</td>
		<td valign="top" width="100%" class="mask">
			<iframe src="?iframe=body" id="main" name="main" width="100%" height="100%" frameborder="0" scrolling="yes" style="overflow: visible"></iframe>
		</td>
	</tr>
	</table>
	<div id="scrolllink" style="display: none">
		<span onclick="menuScroll(1)"><img src="static/admincp/images/scrollu.gif" /></span><span onclick="menuScroll(2)"><img src="static/admincp/images/scrolld.gif" /></span>
	</div>
    <div class="copyright">
        <p><a href="http://www.missra.com/" target="_blank">MixMusic <?php echo IN_VERSION; ?></a></p>
    </div>
	<div id="cpmap_menu" class="custom" style="display: none">
		<div class="cmain" id="cmain"></div>
		<div class="cfixbd"></div>
	</div>
	<script type="text/javascript">
        var cookiepre = '3KLp_2132_',
            cookiedomain = '',
            cookiepath = '/';
        var headers = new Array('index', 'global', 'style', 'content', 'user', 'plugin', 'system', 'app', 'uc'),
            admincpfilename = '',
            menukey = '';

        function switchheader(key) {
            if (!key || !$('header_' + key)) {
                return;
            }
            for (var k in top.headers) {
                if ($('menu_' + headers[k])) {
                    $('menu_' + headers[k]).style.display = headers[k] == key ? '' : 'none';
                }
            }
            var lis = $('topmenu').getElementsByTagName('li');
            for (var i = 0; i < lis.length; i++) {
                if (lis[i].className == 'navon') lis[i].className = '';
            }
            $('header_' + key).parentNode.parentNode.className = 'navon';
        }
        var headerST = null;

        function previewheader(key) {
            if (key) {
                headerST = setTimeout(function () {
                    for (var k in top.headers) {
                        if ($('menu_' + headers[k])) {
                            $('menu_' + headers[k]).style.display = headers[k] == key ? '' : 'none';
                        }
                    }
                    var hrefs = $('menu_' + key).getElementsByTagName('a');
                    for (var j = 0; j < hrefs.length; j++) {
                        hrefs[j].className = '';
                    }
                }, 1000);
            } else {
                clearTimeout(headerST);
            }
        }

        function toggleMenu(key, url) {
            menukey = key;
            switchheader(key);
            if (url) {
                parent.main.location = admincpfilename + url;
                var hrefs = $('menu_' + key).getElementsByTagName('a');
                /*
                for (var j = 0; j < hrefs.length; j++) {
                    hrefs[j].className = j == (key == 'content' ? 2 : 0 || key == 'app' ? 1 : 0) ? 'tabon' : '';
                }
                */
                if(hrefs[0]) {
					hrefs[0].className = 'tabon';
				}
            }
            setMenuScroll();
        }

        function setMenuScroll() {
            $('frametable').style.width = document.body.offsetWidth < 1000 ? '1000px' : '100%';
            var obj = $('menu_' + menukey);
            if (!obj) {
                return;
            }
            var scrollh = document.body.offsetHeight - 160;
            obj.style.overflow = 'visible';
            obj.style.height = '';
            $('scrolllink').style.display = 'none';
            if (obj.offsetHeight + 150 > document.body.offsetHeight && scrollh > 0) {
                obj.style.overflow = 'hidden';
                obj.style.height = scrollh + 'px';
                $('scrolllink').style.display = '';
            }
        }

        function resizeHeadermenu() {
            var lis = $('topmenu').getElementsByTagName('li');
            var maxsize = $('frameuinfo').offsetLeft - 160,
                widths = 0,
                moi = -1,
                mof = '';
            if ($('menu_mof')) {
                $('topmenu').removeChild($('menu_mof'));
            }
            if ($('menu_mof_menu')) {
                $('append_parent').removeChild($('menu_mof_menu'));
            }
            for (var i = 0; i < lis.length; i++) {
                widths += lis[i].offsetWidth;
                if (widths > maxsize) {
                    lis[i].style.visibility = 'hidden';
                    var sobj = lis[i].childNodes[0].childNodes[0];
                    if (sobj) {
                        mof += '<a href="' + sobj.getAttribute('href') + '" onclick="$(\'' + sobj.id + '\').onclick()">&rsaquo; ' + sobj.innerHTML + '</a><br style="clear:both" />';
                    }
                } else {
                    lis[i].style.visibility = 'visible';
                }
            }
            if (mof) {
                for (var i = 0; i < lis.length; i++) {
                    if (lis[i].style.visibility == 'hidden') {
                        moi = i;
                        break;
                    }
                }
                mofli = document.createElement('li');
                mofli.innerHTML = '<em><a href="javascript:;">&raquo;</a></em>';
                mofli.onmouseover = function () {
                    showMenu({
                        'ctrlid': 'menu_mof',
                        'pos': '43'
                    });
                }
                mofli.id = 'menu_mof';
                $('topmenu').insertBefore(mofli, lis[moi]);
                mofmli = document.createElement('li');
                mofmli.className = 'popupmenu_popup';
                mofmli.style.width = '150px';
                mofmli.innerHTML = mof;
                mofmli.id = 'menu_mof_menu';
                mofmli.style.display = 'none';
                $('append_parent').appendChild(mofmli);
            }
        }

        function menuScroll(op, e) {
            var obj = $('menu_' + menukey);
            var scrollh = document.body.offsetHeight - 160;
            if (op == 1) {
                obj.scrollTop = obj.scrollTop - scrollh;
            } else if (op == 2) {
                obj.scrollTop = obj.scrollTop + scrollh;
            } else if (op == 3) {
                if (!e) e = window.event;
                if (e.wheelDelta <= 0 || e.detail > 0) {
                    obj.scrollTop = obj.scrollTop + 20;
                } else {
                    obj.scrollTop = obj.scrollTop - 20;
                }
            }
        }

        function menuNewwin(obj) {
            var href = obj.parentNode.href;
            if (obj.parentNode.href.indexOf(admincpfilename + '?') != -1) {
                href += '';
            }
            window.open(href);
            doane();
        }

        function initCpMenus(menuContainerid) {
            var key = '',
                lasttabon1 = null,
                lasttabon2 = null,
                hrefs = $(menuContainerid).getElementsByTagName('a');
            for (var i = 0; i < hrefs.length; i++) {
                if (menuContainerid == 'leftmenu' && 'action=index'.indexOf(hrefs[i].href.substr(hrefs[i].href.indexOf(admincpfilename + '?') + admincpfilename.length + 1)) != -1) {
                    if (lasttabon1) {
                        lasttabon1.className = '';
                    }
                    if (hrefs[i].parentNode.parentNode.tagName == 'OL') {
                        hrefs[i].parentNode.parentNode.style.display = '';
                        hrefs[i].parentNode.parentNode.parentNode.className = 'lsub desc';
                        key = hrefs[i].parentNode.parentNode.parentNode.parentNode.parentNode.id.substr(5);
                    } else {
                        key = hrefs[i].parentNode.parentNode.id.substr(5);
                    }
                    hrefs[i].className = 'tabon';
                    lasttabon1 = hrefs[i];
                }
                if (!hrefs[i].getAttribute('ajaxtarget')) hrefs[i].onclick = function () {
                    if (menuContainerid != 'custommenu') {
                        var lis = $(menuContainerid).getElementsByTagName('li');
                        for (var k = 0; k < lis.length; k++) {
                            if (lis[k].firstChild && lis[k].firstChild.className != 'menulink') {
                                if (lis[k].firstChild.tagName != 'DIV') {
                                    lis[k].firstChild.className = '';
                                } else {
                                    var subid = lis[k].firstChild.getAttribute('sid');
                                    if (subid) {
                                        var sublis = $(subid).getElementsByTagName('li');
                                        for (var ki = 0; ki < sublis.length; ki++) {
                                            if (sublis[ki].firstChild && sublis[ki].firstChild.className != 'menulink') {
                                                sublis[ki].firstChild.className = '';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if (this.className == '') this.className = menuContainerid == 'leftmenu' ? 'tabon' : '';
                    }
                    if (menuContainerid != 'leftmenu') {
                        var hk, currentkey;
                        var leftmenus = $('leftmenu').getElementsByTagName('a');
                        for (var j = 0; j < leftmenus.length; j++) {
                            if (leftmenus[j].parentNode.parentNode.tagName == 'OL') {
                                hk = leftmenus[j].parentNode.parentNode.parentNode.parentNode.parentNode.id.substr(5);
                            } else {
                                hk = leftmenus[j].parentNode.parentNode.id.substr(5);
                            }
                            if (this.href.indexOf(leftmenus[j].href) != -1) {
                                if (lasttabon2) {
                                    lasttabon2.className = '';
                                }
                                leftmenus[j].className = 'tabon';
                                if (leftmenus[j].parentNode.parentNode.tagName == 'OL') {
                                    leftmenus[j].parentNode.parentNode.style.display = '';
                                    leftmenus[j].parentNode.parentNode.parentNode.className = 'lsub desc';
                                }
                                lasttabon2 = leftmenus[j];
                                if (hk != 'index') currentkey = hk;
                            } else {
                                leftmenus[j].className = '';
                            }
                        }
                        if (currentkey) toggleMenu(currentkey);
                        hideMenu();
                    }
                }
            }
            return key;
        }

        function lsub(id, obj) {
            display(id);
            obj.className = obj.className != 'lsub' ? 'lsub' : 'lsub desc';
            if (obj.className != 'lsub') {
                setcookie('cpmenu_' + id, '');
            } else {
                setcookie('cpmenu_' + id, 1, 31536000);
            }
            setMenuScroll();
        }
        var header_key = initCpMenus('leftmenu');
        toggleMenu(header_key ? header_key : 'index');

        function initCpMap() {
            var ul, hrefs, s = '',
                count = 0;
            for (var k in headers) {
                if (headers[k] != 'index' && headers[k] != 'app' && headers[k] != 'uc' && $('header_' + headers[k])) {
                    s += '<tr><td valign="top"><h4>' + $('header_' + headers[k]).innerHTML + '</h4></td><td valign="top">';
                    ul = $('menu_' + headers[k]);
                    if (!ul) {
                        continue;
                    }
                    hrefs = ul.getElementsByTagName('a');
                    for (var i = 0; i < hrefs.length; i++) {
                        s += '<a href="' + hrefs[i].href + '" target="' + hrefs[i].target + '" k="' + headers[k] + '">' + hrefs[i].innerHTML + '</a>';
                    }
                    s += '</td></tr>';
                    count++;
                }
            }
            var width = 720;
            s = '<div class="cnote" style="width:' + width + 'px"><span class="right"><a href="javascript:void(0)" class="flbc" onclick="hideMenu();return false;"></a></span><h3>管理中心导航</h3></div>' + '<div class="cmlist" style="width:' + width + 'px;height: 410px"><table id="mapmenu" cellspacing="0" cellpadding="0">' + s + '</table></div>';
            $('cmain').innerHTML = s;
            $('cmain').style.width = (width > 1000 ? 1000 : width) + 'px';
        }
        initCpMap();
        initCpMenus('mapmenu');
        var cmcache = false;

        function showMap() {
            showMenu({
                'ctrlid': 'cpmap',
                'evt': 'click',
                'duration': 3,
                'pos': '00'
            });
        }

        function resetEscAndF5(e) {
            e = e ? e : window.event;
            actualCode = e.keyCode ? e.keyCode : e.charCode;
            if (actualCode == 27) {
                if ($('cpmap_menu').style.display == 'none') {
                    showMap();
                } else {
                    hideMenu();
                }
            }
            if (actualCode == 116 && parent.main) {
                parent.main.location.reload();
                if (document.all) {
                    e.keyCode = 0;
                    e.returnValue = false;
                } else {
                    e.cancelBubble = true;
                    e.preventDefault();
                }
            }
        }
        _attachEvent(document.documentElement, 'keydown', resetEscAndF5);
        _attachEvent(window, 'resize', setMenuScroll, document);
        _attachEvent(window, 'resize', resizeHeadermenu, document);
        if (BROWSER.ie) {
            $('leftmenu').onmousewheel = function (e) {
                menuScroll(3, e)
            };
        } else {
            $('leftmenu').addEventListener("DOMMouseScroll", function (e) {
                menuScroll(3, e)
            }, false);
        }
        resizeHeadermenu();
	</script>
</body>
</html>