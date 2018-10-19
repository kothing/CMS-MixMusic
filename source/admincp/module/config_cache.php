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
<script type="text/javascript">
function $(obj) {return document.getElementById(obj);}
function change(type){
        if(type==1){
            $('cacheopen').style.display='';
        }else if(type==2){
            $('cacheopen').style.display='none';
        }
}
</script>
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
<script type="text/javascript">parent.document.title = 'MixMusic Board 管理中心 - 全局 - 缓存信息';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='全局&nbsp;&raquo;&nbsp;缓存信息';</script>
<form method="post" action="?iframe=config_cache&action=save">
<input type="hidden" name="hash" value="<?php echo $_COOKIE['in_adminpassword']; ?>" />
<div class="container">
<div class="floattop">
	<div class="itemtitle">
		<!-- <h3>缓存信息</h3> -->
	<ul class="tab1">
<li><a href="?iframe=config"><span>站点信息</span></a></li>
<li class="current"><a href="?iframe=config_cache"><span>缓存信息</span></a></li>
<li><a href="?iframe=config_upload"><span>上传信息</span></a></li>
<li><a href="?iframe=config_pay"><span>支付信息</span></a></li>
<li><a href="?iframe=config_user"><span>会员信息</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">模板缓存</th></tr>
<tr><td colspan="2" class="td27">缓存开关:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_CACHEOPEN==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_CACHEOPEN" value="1" onclick="change(1);"<?php if(IN_CACHEOPEN==1){echo " checked";} ?>>&nbsp;开启</li>
<?php if(IN_CACHEOPEN==0){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_CACHEOPEN" value="0" onclick="change(2);"<?php if(IN_CACHEOPEN==0){echo " checked";} ?>>&nbsp;关闭</li>
</ul>
</td><td class="vtop tips2">开启缓存能提高模板的运行效率</td></tr>
<tbody class="sub" id="cacheopen"<?php if(IN_CACHEOPEN<>1){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">缓存时间:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_CACHETIME; ?>" name="IN_CACHETIME" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">秒</td></tr>
</tbody>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">运行模式</th></tr>
<tr><td colspan="2" class="td27">伪静态开关:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_REWRITEOPEN">
<option value="0">动态</option>
<option value="1"<?php if(IN_REWRITEOPEN==1){echo " selected";} ?>>伪静态</option>
<option value="2"<?php if(IN_REWRITEOPEN==2){echo " selected";} ?>>静态</option>
</select>
</td><td class="vtop tips2">如果您的服务器不支持 Rewrite，请选择“动态”</td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="提交" /></div></td></tr>
</table>
</div>
</form>
<?php }function save(){
if(!submitcheck('hash', 1)){ShowMessage("表单来路不明，无法提交！",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
$str=file_get_contents('source/system/config.inc.php');
$str=preg_replace("/'IN_CACHEOPEN', '(.*?)'/", "'IN_CACHEOPEN', '".SafeRequest("IN_CACHEOPEN","post")."'", $str);
$str=preg_replace("/'IN_CACHETIME', '(.*?)'/", "'IN_CACHETIME', '".SafeRequest("IN_CACHETIME","post")."'", $str);
$str=preg_replace("/'IN_REWRITEOPEN', '(.*?)'/", "'IN_REWRITEOPEN', '".SafeRequest("IN_REWRITEOPEN","post")."'", $str);
if(!$fp = fopen('source/system/config.inc.php', 'w')){ShowMessage("保存失败，文件{source/system/config.inc.php}没有写入权限！",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);}
$ifile=new iFile('source/system/config.inc.php', 'w');
$ifile->WriteFile($str, 3);
ShowMessage("恭喜您，设置保存成功！",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
}
?>