<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(2);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>">
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>全局配置</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">function $(obj) {return document.getElementById(obj);}</script>
</head>
<body>
<?php
switch($action){
	case 'save':
		save();
		break;
	default:
		main();
		break;
	}
?>
</body>
</html>
<?php function main(){ ?>
<script type="text/javascript">parent.document.title = 'MixMusic Board 管理中心 - 全局 - 支付信息';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='全局&nbsp;&raquo;&nbsp;支付信息';</script>
<form method="post" action="?iframe=config_pay&action=save">
<input type="hidden" name="hash" value="<?php echo $_COOKIE['in_adminpassword']; ?>" />
<div class="container">
<div class="floattop">
	<div class="itemtitle">
		<!-- <h3>支付信息</h3> -->
		<ul class="tab1">
<li><a href="?iframe=config"><span>站点信息</span></a></li>
<li><a href="?iframe=config_cache"><span>缓存信息</span></a></li>
<li><a href="?iframe=config_upload"><span>上传信息</span></a></li>
<li class="current"><a href="?iframe=config_pay"><span>支付信息</span></a></li>
<li><a href="?iframe=config_user"><span>会员信息</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">微信</th></tr>
<tr><td colspan="2" class="td27">商户号:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_WXMCHID; ?>" name="IN_WXMCHID"></td><td class="vtop tips2">微信支付商户号，微信审核通过邮件内获取</td></tr>
<tr><td colspan="2" class="td27">API 密钥:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_WXKEY; ?>" name="IN_WXKEY"></td><td class="vtop tips2">登录微信支付商户平台，帐户设置-密码安全-API安全</td></tr>
<tr><td colspan="2" class="td27">应用 ID:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_WXAPPID; ?>" name="IN_WXAPPID"></td><td class="vtop tips2">微信后台开发者中心，获取AppId</td></tr>
<tr><td colspan="2" class="td27">应用密钥:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_WXAPPSECRET; ?>" name="IN_WXAPPSECRET"></td><td class="vtop tips2">微信后台开发者中心，获取AppSecret</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">支付宝</th></tr>
<tr><td colspan="2" class="td27">合作身份者 ID:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ALIPAYID; ?>" name="IN_ALIPAYID"></td><td class="vtop tips2">以2088开头的16位纯数字</td></tr>
<tr><td colspan="2" class="td27">安全检验码:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ALIPAYKEY; ?>" name="IN_ALIPAYKEY"></td><td class="vtop tips2">以数字和字母组成的32位字符</td></tr>
<tr><td colspan="2" class="td27">支付宝账号:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ALIPAYUID; ?>" name="IN_ALIPAYUID"></td><td class="vtop tips2">签约支付宝账号或卖家支付宝帐户</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">增值业务</th></tr>
<tr><td colspan="2" class="td27">金币充值汇率换算:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_RMBPOINTS; ?>" name="IN_RMBPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币/每元</td></tr>
<tr><td colspan="2" class="td27">自助开通绿钻售价:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_VIPPOINTS; ?>" name="IN_VIPPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币/每月</td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="提交" /></div></td></tr>
</table>
</div>
</form>
<?php }function save(){
if(!submitcheck('hash', 1)){ShowMessage("表单来路不明，无法提交！",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
$str=file_get_contents('source/system/config.inc.php');
$str=preg_replace("/'IN_WXMCHID', '(.*?)'/", "'IN_WXMCHID', '".SafeRequest("IN_WXMCHID","post")."'", $str);
$str=preg_replace("/'IN_WXKEY', '(.*?)'/", "'IN_WXKEY', '".SafeRequest("IN_WXKEY","post")."'", $str);
$str=preg_replace("/'IN_WXAPPID', '(.*?)'/", "'IN_WXAPPID', '".SafeRequest("IN_WXAPPID","post")."'", $str);
$str=preg_replace("/'IN_WXAPPSECRET', '(.*?)'/", "'IN_WXAPPSECRET', '".SafeRequest("IN_WXAPPSECRET","post")."'", $str);
$str=preg_replace("/'IN_ALIPAYID', '(.*?)'/", "'IN_ALIPAYID', '".SafeRequest("IN_ALIPAYID","post")."'", $str);
$str=preg_replace("/'IN_ALIPAYKEY', '(.*?)'/", "'IN_ALIPAYKEY', '".SafeRequest("IN_ALIPAYKEY","post")."'", $str);
$str=preg_replace("/'IN_ALIPAYUID', '(.*?)'/", "'IN_ALIPAYUID', '".SafeRequest("IN_ALIPAYUID","post")."'", $str);
$str=preg_replace("/'IN_RMBPOINTS', '(.*?)'/", "'IN_RMBPOINTS', '".SafeRequest("IN_RMBPOINTS","post")."'", $str);
$str=preg_replace("/'IN_VIPPOINTS', '(.*?)'/", "'IN_VIPPOINTS', '".SafeRequest("IN_VIPPOINTS","post")."'", $str);
if(!$fp = fopen('source/system/config.inc.php', 'w')){ShowMessage("保存失败，文件{source/system/config.inc.php}没有写入权限！",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);}
$ifile=new iFile('source/system/config.inc.php', 'w');
$ifile->WriteFile($str, 3);
ShowMessage("恭喜您，设置保存成功！",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
}
?>