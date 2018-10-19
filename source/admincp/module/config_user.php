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
            $('qqopen').style.display='';
        }else if(type==2){
            $('qqopen').style.display='none';
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
<script type="text/javascript">parent.document.title = 'MixMusic Board 管理中心 - 全局 - 会员信息';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='全局&nbsp;&raquo;&nbsp;会员信息';</script>
<form method="post" action="?iframe=config_user&action=save">
<input type="hidden" name="hash" value="<?php echo $_COOKIE['in_adminpassword']; ?>" />
<div class="container">
<div class="floattop">
	<div class="itemtitle">
		<!-- <h3>会员信息</h3> -->
		<ul class="tab1">
<li><a href="?iframe=config"><span>站点信息</span></a></li>
<li><a href="?iframe=config_cache"><span>缓存信息</span></a></li>
<li><a href="?iframe=config_upload"><span>上传信息</span></a></li>
<li><a href="?iframe=config_pay"><span>支付信息</span></a></li>
<li class="current"><a href="?iframe=config_user"><span>会员信息</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">QQ登录</th></tr>
<tr><td colspan="2" class="td27">登录开关:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_QQOPEN==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_QQOPEN" value="1" onclick="change(1);"<?php if(IN_QQOPEN==1){echo " checked";} ?>>&nbsp;开启</li>
<?php if(IN_QQOPEN==0){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_QQOPEN" value="0" onclick="change(2);"<?php if(IN_QQOPEN==0){echo " checked";} ?>>&nbsp;关闭</li>
</ul>
</td><td class="vtop lightnum">回调地址：<?php echo "http://".$_SERVER['HTTP_HOST'].IN_PATH."source/pack/connect/redirect.php"; ?></td></tr>
<tbody class="sub" id="qqopen"<?php if(IN_QQOPEN<>1){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">APP ID:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_QQAPPID; ?>" name="IN_QQAPPID"></td><td class="vtop tips2">QQ互联的通信密钥</td></tr>
<tr><td colspan="2" class="td27">APP KEY:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_QQAPPKEY; ?>" name="IN_QQAPPKEY"></td><td class="vtop tips2">QQ互联的通信密钥</td></tr>
</tbody>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">功能设置</th></tr>
<tr><td colspan="2" class="td27">会员注册开关:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_REGOPEN">
<option value="0">关闭</option>
<option value="1"<?php if(IN_REGOPEN==1){echo " selected";} ?>>开放</option>
</select>
</td><td class="vtop tips2">关闭后前台将无法使用注册功能</td></tr>
<tr><td colspan="2" class="td27">会员投稿开关:</td></tr>
<tr><td class="vtop rowform">
<select name="IN_SHAREOPEN">
<option value="0">关闭</option>
<option value="1"<?php if(IN_SHAREOPEN==1){echo " selected";} ?>>开放</option>
</select>
</td><td class="vtop tips2">关闭后前台将无法使用投稿功能</td></tr>
<tr><td colspan="2" class="td27">用户在线保留秒数:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_ONLINEHOLD; ?>" name="IN_ONLINEHOLD" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">秒</td></tr>
<tr><td colspan="2" class="td27">动态记录保留天数:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_FEEDDAY; ?>" name="IN_FEEDDAY" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">天</td></tr>
<tr><td colspan="2" class="td27">访客记录保留天数:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_FOOTPRINTDAY; ?>" name="IN_FOOTPRINTDAY" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">天</td></tr>
<tr><td colspan="2" class="td27">消息记录保留天数:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MESSAGEDAY; ?>" name="IN_MESSAGEDAY" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">天</td></tr>
<tr><td colspan="2" class="td27">试听记录保留天数:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_LISTENDAY; ?>" name="IN_LISTENDAY" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">天</td></tr>
<tr><td colspan="2" class="td27">邮件记录保留天数:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAILDAY; ?>" name="IN_MAILDAY" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">天</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">奖励设置</th></tr>
<tr><td colspan="2" class="td27">注册会员初始:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REGPOINTS; ?>" name="IN_REGPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REGRANK; ?>" name="IN_REGRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
<tr><td colspan="2" class="td27">每日首次登录:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_LOGINDAYPOINTS; ?>" name="IN_LOGINDAYPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_LOGINDAYRANK; ?>" name="IN_LOGINDAYRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
<tr><td colspan="2" class="td27">每日打卡签到:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SIGNDAYPOINTS; ?>" name="IN_SIGNDAYPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币*连续签到天数</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SIGNDAYRANK; ?>" name="IN_SIGNDAYRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验*连续签到天数</td></tr>
<tr><td class="vtop rowform">
<select name="IN_SIGNVIPOPEN">
<option value="0">否</option>
<option value="1"<?php if(IN_SIGNVIPOPEN==1){echo " selected";} ?>>是</option>
</select>
</td><td class="vtop tips2">是否设立“月付绿钻”满勤奖</td></tr>
<tr><td colspan="2" class="td27">初次上传头像:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_AVATARPOINTS; ?>" name="IN_AVATARPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_AVATARRANK; ?>" name="IN_AVATARRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
<tr><td colspan="2" class="td27">初次验证邮箱:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAILPOINTS; ?>" name="IN_MAILPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MAILRANK; ?>" name="IN_MAILRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
<tr><td colspan="2" class="td27">审核音乐:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MUSICINPOINTS; ?>" name="IN_MUSICINPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MUSICINRANK; ?>" name="IN_MUSICINRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
<tr><td colspan="2" class="td27">审核专辑:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SPECIALINPOINTS; ?>" name="IN_SPECIALINPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SPECIALINRANK; ?>" name="IN_SPECIALINRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
<tr><td colspan="2" class="td27">审核歌手:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SINGERINPOINTS; ?>" name="IN_SINGERINPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SINGERINRANK; ?>" name="IN_SINGERINRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
<tr><td colspan="2" class="td27">审核视频:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_VIDEOINPOINTS; ?>" name="IN_VIDEOINPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_VIDEOINRANK; ?>" name="IN_VIDEOINRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">惩罚设置</th></tr>
<tr><td colspan="2" class="td27">删除音乐:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MUSICOUTPOINTS; ?>" name="IN_MUSICOUTPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_MUSICOUTRANK; ?>" name="IN_MUSICOUTRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
<tr><td colspan="2" class="td27">删除专辑:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SPECIALOUTPOINTS; ?>" name="IN_SPECIALOUTPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SPECIALOUTRANK; ?>" name="IN_SPECIALOUTRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
<tr><td colspan="2" class="td27">删除歌手:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SINGEROUTPOINTS; ?>" name="IN_SINGEROUTPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_SINGEROUTRANK; ?>" name="IN_SINGEROUTRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
<tr><td colspan="2" class="td27">删除视频:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_VIDEOOUTPOINTS; ?>" name="IN_VIDEOOUTPOINTS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">金币</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_VIDEOOUTRANK; ?>" name="IN_VIDEOOUTRANK" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">经验</td></tr>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="提交" /></div></td></tr>
</table>
</div>
</form>
<?php }function save(){
if(!submitcheck('hash', 1)){ShowMessage("表单来路不明，无法提交！",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
$str=file_get_contents('source/system/config.inc.php');
$str=preg_replace("/'IN_QQOPEN', '(.*?)'/", "'IN_QQOPEN', '".SafeRequest("IN_QQOPEN","post")."'", $str);
$str=preg_replace("/'IN_QQAPPID', '(.*?)'/", "'IN_QQAPPID', '".SafeRequest("IN_QQAPPID","post")."'", $str);
$str=preg_replace("/'IN_QQAPPKEY', '(.*?)'/", "'IN_QQAPPKEY', '".SafeRequest("IN_QQAPPKEY","post")."'", $str);
$str=preg_replace("/'IN_REGOPEN', '(.*?)'/", "'IN_REGOPEN', '".SafeRequest("IN_REGOPEN","post")."'", $str);
$str=preg_replace("/'IN_SHAREOPEN', '(.*?)'/", "'IN_SHAREOPEN', '".SafeRequest("IN_SHAREOPEN","post")."'", $str);
$str=preg_replace("/'IN_ONLINEHOLD', '(.*?)'/", "'IN_ONLINEHOLD', '".SafeRequest("IN_ONLINEHOLD","post")."'", $str);
$str=preg_replace("/'IN_FEEDDAY', '(.*?)'/", "'IN_FEEDDAY', '".SafeRequest("IN_FEEDDAY","post")."'", $str);
$str=preg_replace("/'IN_FOOTPRINTDAY', '(.*?)'/", "'IN_FOOTPRINTDAY', '".SafeRequest("IN_FOOTPRINTDAY","post")."'", $str);
$str=preg_replace("/'IN_MESSAGEDAY', '(.*?)'/", "'IN_MESSAGEDAY', '".SafeRequest("IN_MESSAGEDAY","post")."'", $str);
$str=preg_replace("/'IN_LISTENDAY', '(.*?)'/", "'IN_LISTENDAY', '".SafeRequest("IN_LISTENDAY","post")."'", $str);
$str=preg_replace("/'IN_MAILDAY', '(.*?)'/", "'IN_MAILDAY', '".SafeRequest("IN_MAILDAY","post")."'", $str);
$str=preg_replace("/'IN_REGPOINTS', '(.*?)'/", "'IN_REGPOINTS', '".SafeRequest("IN_REGPOINTS","post")."'", $str);
$str=preg_replace("/'IN_REGRANK', '(.*?)'/", "'IN_REGRANK', '".SafeRequest("IN_REGRANK","post")."'", $str);
$str=preg_replace("/'IN_LOGINDAYPOINTS', '(.*?)'/", "'IN_LOGINDAYPOINTS', '".SafeRequest("IN_LOGINDAYPOINTS","post")."'", $str);
$str=preg_replace("/'IN_LOGINDAYRANK', '(.*?)'/", "'IN_LOGINDAYRANK', '".SafeRequest("IN_LOGINDAYRANK","post")."'", $str);
$str=preg_replace("/'IN_SIGNDAYPOINTS', '(.*?)'/", "'IN_SIGNDAYPOINTS', '".SafeRequest("IN_SIGNDAYPOINTS","post")."'", $str);
$str=preg_replace("/'IN_SIGNDAYRANK', '(.*?)'/", "'IN_SIGNDAYRANK', '".SafeRequest("IN_SIGNDAYRANK","post")."'", $str);
$str=preg_replace("/'IN_SIGNVIPOPEN', '(.*?)'/", "'IN_SIGNVIPOPEN', '".SafeRequest("IN_SIGNVIPOPEN","post")."'", $str);
$str=preg_replace("/'IN_AVATARPOINTS', '(.*?)'/", "'IN_AVATARPOINTS', '".SafeRequest("IN_AVATARPOINTS","post")."'", $str);
$str=preg_replace("/'IN_AVATARRANK', '(.*?)'/", "'IN_AVATARRANK', '".SafeRequest("IN_AVATARRANK","post")."'", $str);
$str=preg_replace("/'IN_MAILPOINTS', '(.*?)'/", "'IN_MAILPOINTS', '".SafeRequest("IN_MAILPOINTS","post")."'", $str);
$str=preg_replace("/'IN_MAILRANK', '(.*?)'/", "'IN_MAILRANK', '".SafeRequest("IN_MAILRANK","post")."'", $str);
$str=preg_replace("/'IN_MUSICINPOINTS', '(.*?)'/", "'IN_MUSICINPOINTS', '".SafeRequest("IN_MUSICINPOINTS","post")."'", $str);
$str=preg_replace("/'IN_MUSICINRANK', '(.*?)'/", "'IN_MUSICINRANK', '".SafeRequest("IN_MUSICINRANK","post")."'", $str);
$str=preg_replace("/'IN_SPECIALINPOINTS', '(.*?)'/", "'IN_SPECIALINPOINTS', '".SafeRequest("IN_SPECIALINPOINTS","post")."'", $str);
$str=preg_replace("/'IN_SPECIALINRANK', '(.*?)'/", "'IN_SPECIALINRANK', '".SafeRequest("IN_SPECIALINRANK","post")."'", $str);
$str=preg_replace("/'IN_SINGERINPOINTS', '(.*?)'/", "'IN_SINGERINPOINTS', '".SafeRequest("IN_SINGERINPOINTS","post")."'", $str);
$str=preg_replace("/'IN_SINGERINRANK', '(.*?)'/", "'IN_SINGERINRANK', '".SafeRequest("IN_SINGERINRANK","post")."'", $str);
$str=preg_replace("/'IN_VIDEOINPOINTS', '(.*?)'/", "'IN_VIDEOINPOINTS', '".SafeRequest("IN_VIDEOINPOINTS","post")."'", $str);
$str=preg_replace("/'IN_VIDEOINRANK', '(.*?)'/", "'IN_VIDEOINRANK', '".SafeRequest("IN_VIDEOINRANK","post")."'", $str);
$str=preg_replace("/'IN_MUSICOUTPOINTS', '(.*?)'/", "'IN_MUSICOUTPOINTS', '".SafeRequest("IN_MUSICOUTPOINTS","post")."'", $str);
$str=preg_replace("/'IN_MUSICOUTRANK', '(.*?)'/", "'IN_MUSICOUTRANK', '".SafeRequest("IN_MUSICOUTRANK","post")."'", $str);
$str=preg_replace("/'IN_SPECIALOUTPOINTS', '(.*?)'/", "'IN_SPECIALOUTPOINTS', '".SafeRequest("IN_SPECIALOUTPOINTS","post")."'", $str);
$str=preg_replace("/'IN_SPECIALOUTRANK', '(.*?)'/", "'IN_SPECIALOUTRANK', '".SafeRequest("IN_SPECIALOUTRANK","post")."'", $str);
$str=preg_replace("/'IN_SINGEROUTPOINTS', '(.*?)'/", "'IN_SINGEROUTPOINTS', '".SafeRequest("IN_SINGEROUTPOINTS","post")."'", $str);
$str=preg_replace("/'IN_SINGEROUTRANK', '(.*?)'/", "'IN_SINGEROUTRANK', '".SafeRequest("IN_SINGEROUTRANK","post")."'", $str);
$str=preg_replace("/'IN_VIDEOOUTPOINTS', '(.*?)'/", "'IN_VIDEOOUTPOINTS', '".SafeRequest("IN_VIDEOOUTPOINTS","post")."'", $str);
$str=preg_replace("/'IN_VIDEOOUTRANK', '(.*?)'/", "'IN_VIDEOOUTRANK', '".SafeRequest("IN_VIDEOOUTRANK","post")."'", $str);
if(!$fp = fopen('source/system/config.inc.php', 'w')){ShowMessage("保存失败，文件{source/system/config.inc.php}没有写入权限！",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);}
$ifile=new iFile('source/system/config.inc.php', 'w');
$ifile->WriteFile($str, 3);
ShowMessage("恭喜您，设置保存成功！",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
}
?>