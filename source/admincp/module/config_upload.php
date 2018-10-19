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
            $('upopen').style.display='';
        }else if(type==2){
            $('upopen').style.display='none';
        }else if(type==3){
            $('remotedisk').style.display='';
            $('remoteftp').style.display='none';
        }else if(type==4){
            $('remotedisk').style.display='none';
            $('remoteftp').style.display='';
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
<script type="text/javascript">parent.document.title = 'MixMusic Board 管理中心 - 全局 - 上传信息';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='全局&nbsp;&raquo;&nbsp;上传信息';</script>
<form method="post" action="?iframe=config_upload&action=save">
<input type="hidden" name="hash" value="<?php echo $_COOKIE['in_adminpassword']; ?>" />
<div class="container">
<div class="floattop">
    <div class="itemtitle">
        <!-- <h3>上传信息</h3> -->
        <ul class="tab1">
<li><a href="?iframe=config"><span>站点信息</span></a></li>
<li><a href="?iframe=config_cache"><span>缓存信息</span></a></li>
<li class="current"><a href="?iframe=config_upload"><span>上传信息</span></a></li>
<li><a href="?iframe=config_pay"><span>支付信息</span></a></li>
<li><a href="?iframe=config_user"><span>会员信息</span></a></li>
</ul></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th colspan="15" class="partition">本地设置</th></tr>
<tr><td colspan="2" class="td27">上传开关:</td></tr>
<tr><td class="vtop rowform">
<ul>
<?php if(IN_UPOPEN==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_UPOPEN" value="1" onclick="change(1);"<?php if(IN_UPOPEN==1){echo " checked";} ?>>&nbsp;开启</li>
<?php if(IN_UPOPEN==0){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_UPOPEN" value="0" onclick="change(2);"<?php if(IN_UPOPEN==0){echo " checked";} ?>>&nbsp;关闭</li>
</ul>
</td><td class="vtop tips2">关闭后全站将自动切换到远程上传</td></tr>
<tbody class="sub" id="upopen"<?php if(IN_UPOPEN<>1){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">MP3音质下限:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_UPMP3KBPS; ?>" name="IN_UPMP3KBPS" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">单位：Kbps，0 为关闭该功能</td></tr>
<tr><td colspan="2" class="td27">音频允许的大小:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_UPMUSICSIZE; ?>" name="IN_UPMUSICSIZE" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">MB</td></tr>
<tr><td colspan="2" class="td27">音频允许的类型:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_UPMUSICEXT; ?>" name="IN_UPMUSICEXT"></td><td class="vtop tips2">多个类型时请用“;”隔开</td></tr>
<tr><td colspan="2" class="td27">视频允许的大小:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_UPVIDEOSIZE; ?>" name="IN_UPVIDEOSIZE" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">MB</td></tr>
<tr><td colspan="2" class="td27">视频允许的类型:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_UPVIDEOEXT; ?>" name="IN_UPVIDEOEXT"></td><td class="vtop tips2">多个类型时请用“;”隔开</td></tr>
</tbody>
</table>
<table class="tb tb2">
<tr><th colspan="15" class="partition">远程设置</th></tr>
<tr><td colspan="2" class="td27">上传类型:</td></tr>
<tr><td class="vtop">
<ul>
<?php if(IN_REMOTE==1){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_REMOTE" value="1" onclick="change(3);"<?php if(IN_REMOTE==1){echo " checked";} ?>>&nbsp;云存储</li>
<?php if(IN_REMOTE==2){echo "<li class=\"checked\">";}else{echo "<li>";} ?><input class="radio" type="radio" name="IN_REMOTE" value="2" onclick="change(4);"<?php if(IN_REMOTE==2){echo " checked";} ?>>&nbsp;FTP</li>
</ul>
</td><td class="vtop tips2">关闭本地上传时会自动切换到该类型</td></tr>
<tbody class="sub" id="remotedisk"<?php if(IN_REMOTE<>1){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">上传标识:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_REMOTEPK; ?>" name="IN_REMOTEPK"></td><td class="vtop tips2">云存储的扩展目录</td></tr>
<tr><td colspan="2" class="td27">外网域名:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_REMOTEDK; ?>" name="IN_REMOTEDK"></td><td class="vtop tips2">以“<em class="lightnum">http://</em>”开头、“<em class="lightnum">/</em>”结尾</td></tr>
<tr><td colspan="2" class="td27">Bucket:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_REMOTEBK; ?>" name="IN_REMOTEBK"></td><td class="vtop tips2">云存储的空间名称</td></tr>
<tr><td colspan="2" class="td27">AccessKey:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_REMOTEAK; ?>" name="IN_REMOTEAK"></td><td class="vtop tips2">云存储的通信密钥</td></tr>
<tr><td colspan="2" class="td27">SecretKey:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_REMOTESK; ?>" name="IN_REMOTESK"></td><td class="vtop tips2">云存储的通信密钥</td></tr>
</tbody>
<tbody class="sub" id="remoteftp"<?php if(IN_REMOTE<>2){echo " style=\"display:none;\"";} ?>>
<tr><td colspan="2" class="td27">FTP 服务器地址:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_REMOTEHOST; ?>" name="IN_REMOTEHOST"></td><td class="vtop tips2">可以是 FTP 服务器的 IP 地址或域名</td></tr>
<tr><td colspan="2" class="td27">FTP 服务器端口:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_REMOTEPORT; ?>" name="IN_REMOTEPORT" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">默认为 21</td></tr>
<tr><td colspan="2" class="td27">FTP 帐号:</td></tr>
<tr><td class="vtop"><input type="text" class="txt" value="<?php echo IN_REMOTEUSER; ?>" name="IN_REMOTEUSER"></td><td class="vtop tips2">该帐号必需具有以下权限：读取文件、写入文件、删除文件、创建目录、子目录继承</td></tr>
<tr><td colspan="2" class="td27">FTP 密码:</td></tr>
<tr><td class="vtop"><input type="password" class="txt" value="<?php echo IN_REMOTEPW; ?>" name="IN_REMOTEPW"></td><td class="vtop tips2">基于安全考虑，FTP 密码将被隐藏</td></tr>
<tr><td colspan="2" class="td27">被动模式(pasv)连接:</td></tr>
<tr><td class="vtop">
<select name="IN_REMOTEPASV">
<option value="0">否</option>
<option value="1"<?php if(IN_REMOTEPASV==1){echo " selected";} ?>>是</option>
</select>
</td><td class="vtop tips2">一般情况下非被动模式即可，如果存在上传失败问题，可尝试打开此设置</td></tr>
<tr><td colspan="2" class="td27">远程附件目录:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEDIR; ?>" name="IN_REMOTEDIR"></td><td class="vtop tips2">远程附件目录的绝对路径或相对于 FTP 主目录的相对路径，<em class="lightnum">前后不要加斜杠</em>“<em class="lightnum">/</em>”，“<em class="lightnum">.</em>”<em class="lightnum">表示 FTP 主目录</em></td></tr>
<tr><td colspan="2" class="td27">远程访问 URL:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEURL; ?>" name="IN_REMOTEURL"></td><td class="vtop tips2">支持 HTTP 和 FTP 协议，<em class="lightnum">结尾不要加斜杠</em>“<em class="lightnum">/</em>”；如果使用 FTP 协议，FTP 服务器必需支持 PASV 模式，为了安全起见，使用 FTP 连接的帐号勿设置可写权限和列表权限</td></tr>
<tr><td colspan="2" class="td27">FTP 传输超时时间:</td></tr>
<tr><td class="vtop rowform"><input type="text" class="txt" value="<?php echo IN_REMOTEOUT; ?>" name="IN_REMOTEOUT" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"></td><td class="vtop tips2">单位：秒，0 为服务器默认</td></tr>
</tbody>
<tr><td colspan="15"><div class="fixsel"><input type="submit" class="btn" value="提交" /></div></td></tr>
</table>
</div>
</form>
<?php }function save(){
if(!submitcheck('hash', 1)){ShowMessage("表单来路不明，无法提交！",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
$str=file_get_contents('source/system/config.inc.php');
$str=preg_replace("/'IN_UPOPEN', '(.*?)'/", "'IN_UPOPEN', '".SafeRequest("IN_UPOPEN","post")."'", $str);
$str=preg_replace("/'IN_UPMP3KBPS', '(.*?)'/", "'IN_UPMP3KBPS', '".SafeRequest("IN_UPMP3KBPS","post")."'", $str);
$str=preg_replace("/'IN_UPMUSICSIZE', '(.*?)'/", "'IN_UPMUSICSIZE', '".SafeRequest("IN_UPMUSICSIZE","post")."'", $str);
$str=preg_replace("/'IN_UPMUSICEXT', '(.*?)'/", "'IN_UPMUSICEXT', '".SafeRequest("IN_UPMUSICEXT","post")."'", $str);
$str=preg_replace("/'IN_UPVIDEOSIZE', '(.*?)'/", "'IN_UPVIDEOSIZE', '".SafeRequest("IN_UPVIDEOSIZE","post")."'", $str);
$str=preg_replace("/'IN_UPVIDEOEXT', '(.*?)'/", "'IN_UPVIDEOEXT', '".SafeRequest("IN_UPVIDEOEXT","post")."'", $str);
$str=preg_replace("/'IN_REMOTE', '(.*?)'/", "'IN_REMOTE', '".SafeRequest("IN_REMOTE","post")."'", $str);
$str=preg_replace("/'IN_REMOTEPK', '(.*?)'/", "'IN_REMOTEPK', '".SafeRequest("IN_REMOTEPK","post")."'", $str);
$str=preg_replace("/'IN_REMOTEDK', '(.*?)'/", "'IN_REMOTEDK', '".SafeRequest("IN_REMOTEDK","post")."'", $str);
$str=preg_replace("/'IN_REMOTEBK', '(.*?)'/", "'IN_REMOTEBK', '".SafeRequest("IN_REMOTEBK","post")."'", $str);
$str=preg_replace("/'IN_REMOTEAK', '(.*?)'/", "'IN_REMOTEAK', '".SafeRequest("IN_REMOTEAK","post")."'", $str);
$str=preg_replace("/'IN_REMOTESK', '(.*?)'/", "'IN_REMOTESK', '".SafeRequest("IN_REMOTESK","post")."'", $str);
$str=preg_replace("/'IN_REMOTEHOST', '(.*?)'/", "'IN_REMOTEHOST', '".SafeRequest("IN_REMOTEHOST","post")."'", $str);
$str=preg_replace("/'IN_REMOTEPORT', '(.*?)'/", "'IN_REMOTEPORT', '".SafeRequest("IN_REMOTEPORT","post")."'", $str);
$str=preg_replace("/'IN_REMOTEUSER', '(.*?)'/", "'IN_REMOTEUSER', '".SafeRequest("IN_REMOTEUSER","post")."'", $str);
$str=preg_replace("/'IN_REMOTEPW', '(.*?)'/", "'IN_REMOTEPW', '".SafeRequest("IN_REMOTEPW","post")."'", $str);
$str=preg_replace("/'IN_REMOTEPASV', '(.*?)'/", "'IN_REMOTEPASV', '".SafeRequest("IN_REMOTEPASV","post")."'", $str);
$str=preg_replace("/'IN_REMOTEDIR', '(.*?)'/", "'IN_REMOTEDIR', '".SafeRequest("IN_REMOTEDIR","post")."'", $str);
$str=preg_replace("/'IN_REMOTEURL', '(.*?)'/", "'IN_REMOTEURL', '".SafeRequest("IN_REMOTEURL","post")."'", $str);
$str=preg_replace("/'IN_REMOTEOUT', '(.*?)'/", "'IN_REMOTEOUT', '".SafeRequest("IN_REMOTEOUT","post")."'", $str);
if(!$fp = fopen('source/system/config.inc.php', 'w')){ShowMessage("保存失败，文件{source/system/config.inc.php}没有写入权限！",$_SERVER['HTTP_REFERER'],"infotitle3",3000,1);}
$ifile=new iFile('source/system/config.inc.php', 'w');
$ifile->WriteFile($str, 3);
ShowMessage("恭喜您，设置保存成功！",$_SERVER['HTTP_REFERER'],"infotitle2",1000,1);
}
?>