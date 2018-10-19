<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $userlogined,$missra_in_userid,$missra_in_username,$missra_in_userpassword,$missra_in_ucid; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>我的头像 - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/profile.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var updateavatar = function() {
	location.reload();
}
var pop = {
	ucenter: function() {
		$.layer({
			shade: [0],
			area: ['auto', 'auto'],
			dialog: {
				msg: '确认要解除 UCenter 用户身份吗？',
				btns: 2,
				type: 4,
				btn: ['确认', '取消'],
				yes: function() {
					unucenter();
				},
				no: function() {
					layer.msg('已取消解除', 1, 0);
				}
			}
		});
	}
}
</script>
<style type="text/css">
@import url(<?php echo IN_PATH; ?>static/user/css/style.css);
</style>
</head>
<body>
<?php include 'source/user/people/top.php'; ?>
<div id="main">
<?php include 'source/user/people/left.php'; ?>
<div id="mainarea">
<h2 class="title"><img src="<?php echo IN_PATH; ?>static/user/images/icon/profile.gif">个人设置</h2>
<div class="tabs_header">
<ul class="tabs">
<li><a href="<?php echo rewrite_mode('user.php/profile/index/'); ?>"><span>个人资料</span></a></li>
<li class="active"><a href="<?php echo rewrite_mode('user.php/profile/avatar/'); ?>"><span>我的头像</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/profile/credit/'); ?>"><span>积分账户</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/profile/oauth/'); ?>"><span>帐号绑定</span></a></li>
</ul>
</div>
<div class="c_form">
<table cellspacing="0" cellpadding="0" class="formtable">
<caption><h2>当前我的头像</h2><p>如果您还没有设置自己的头像，系统会显示为默认头像，您需要自己上传一张新照片来作为自己的个人头像。</p></caption>
<tr><td><img src="<?php echo getavatar($missra_in_userid, 'big'); ?>"></td></tr>
</table>
<table cellspacing="0" cellpadding="0" class="formtable">
<caption><h2>设置我的新头像</h2><p>请选择一个新照片进行上传编辑。</p></caption><tr><td>
<?php
if(IN_UPOPEN == 1){
        $script = 'http://'.$_SERVER['HTTP_HOST'].IN_PATH.'source/pack/upload/avatar.php';
}elseif(IN_REMOTE == 1){
        $script = 'http://'.$_SERVER['HTTP_HOST'].IN_PATH.'source/plugin/'.IN_REMOTEPK.'/avatar.php';
        if(!is_file(str_replace('http://'.$_SERVER['HTTP_HOST'].IN_PATH, IN_ROOT, $script))){
                $script = 'http://'.$_SERVER['HTTP_HOST'].IN_PATH.'source/pack/upload/avatar.php';
        }
}else{
        $script = 'http://'.$_SERVER['HTTP_HOST'].IN_PATH.'source/pack/ftp/avatar.php';
}
$script = is_ssl() ? str_replace('http://', 'https://', $script) : $script;
$avatar = '<embed src="'.IN_PATH.'static/pack/upload/camera.swf?ucapi='.urlencode($script.'?').'&input='.urlencode('uid=').$missra_in_userid.':'.$missra_in_userpassword.'" width="450" height="253" wmode="transparent" type="application/x-shockwave-flash"></embed>';
if(IN_UCOPEN == 1){
	if($missra_in_ucid > 0){
		require_once IN_ROOT.'./client/ucenter.php';
		require_once IN_ROOT.'./client/client.php';
		$ucid = @uc_get_user($missra_in_username);
		if($missra_in_ucid == $ucid[0]){
			echo @uc_avatar($ucid[0]);
		}else{
			echo '<p style="color:#F60">UCenter 通讯故障或您的用户名在其数据库中已不存在，您可以刷新重试或解除其身份来上传头像。</p><br /><p><input type="button" value="解除 UCenter 用户身份" onclick="pop.ucenter();" class="button" /></p><br />';
		}
	}else{
		echo $avatar;
	}
}else{
	echo $avatar;
}
?>
</td></tr><tr><td>提示：头像保存后，您可能需要刷新一下本页面(按F5键)，才能查看最新的头像效果。</td></tr></table></div>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>