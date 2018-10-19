<?php if(!defined('IN_ROOT')){exit('Access denied');} ?>
<?php global $userlogined,$missra_in_qqopen; ?>
<?php if(!$userlogined){header("location:".rewrite_mode('user.php/people/login/'));exit();} ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>帐号绑定 - <?php echo IN_NAME; ?></title>
<meta name="Keywords" content="<?php echo IN_KEYWORDS; ?>" />
<meta name="Description" content="<?php echo IN_DESCRIPTION; ?>" />
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/pack/layer/confirm-html.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/lib.js"></script>
<script type="text/javascript" src="<?php echo IN_PATH; ?>static/user/js/profile.js"></script>
<script type="text/javascript">
var in_path = '<?php echo IN_PATH; ?>';
var pop = {
	up: function(scrolling, text, url, width, height, top) {
		layer.open({
			type: 2,
			maxmin: true,
			title: text,
			content: [url, scrolling],
			area: [width, height],
			offset: top,
			shade: false
		});
	},
	connect: function(type) {
		if (type == 1) {
			pop.up('no', 'QQ登录', in_path + 'source/pack/connect/login.php', '700px', '430px', '100px');
		} else {
			$.flayer({
				shade: [0],
				area: ['auto', 'auto'],
				dialog: {
					msg: '将解绑腾讯QQ，确认继续？',
					btns: 2,
					type: 4,
					btn: ['确认', '取消'],
					yes: function() {
						unconnect();
					},
					no: function() {
						flayer.msg('已取消解绑', 1, 0);
					}
				}
			});
		}
	}
}
function qzone_return(type){
        layer.closeAll();
        if(type==1){
            uc_syn('login');
            location.href = '<?php echo rewrite_mode('user.php/people/home/'); ?>';
        }else{
            location.href = '<?php echo rewrite_mode('user.php/people/connect/'); ?>';
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
<li><a href="<?php echo rewrite_mode('user.php/profile/avatar/'); ?>"><span>我的头像</span></a></li>
<li><a href="<?php echo rewrite_mode('user.php/profile/credit/'); ?>"><span>积分账户</span></a></li>
<li class="active"><a href="<?php echo rewrite_mode('user.php/profile/oauth/'); ?>"><span>帐号绑定</span></a></li>
</ul>
</div>
<div class="c_form">
<table cellspacing="0" cellpadding="0" class="formtable">
<caption><h2>绑定腾讯QQ</h2>
<p>设置你的腾讯QQ帐号</p>
</caption>
<?php if(empty($missra_in_qqopen)){ ?>
<tr><td>你还未绑定QQ</td></tr>
<tr><td><input type="button" value="立即绑定" onclick="pop.connect(1);" class="submit" /></td></tr>
<?php }else{ ?>
<tr><td>你已经绑定QQ</td></tr>
<tr><td><input type="button" value="解除绑定" onclick="pop.connect(0);" class="button" /></td></tr>
<?php } ?>
</table>
</div>
</div>
<div id="bottom"></div>
</div>
<?php include 'source/user/people/bottom.php'; ?>
</body>
</html>