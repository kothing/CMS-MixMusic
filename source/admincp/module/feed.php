<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(5);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>说说管理</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/lib.js"></script>
<script type="text/javascript">
function CheckAll(form) {
	for (var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if (e.name != 'chkall') {
			e.checked = form.chkall.checked;
		}
	}
        all_save(form);
}
function s(){
        var k=document.getElementById("search").value;
        if(k==""){
                asyncbox.tips("请输入要查询的关键词！", "wait", 1000);
                document.getElementById("search").focus();
                return false;
        }else{
                document.btnsearch.submit();
        }
}
function all_save(form){
        if(form.chkall.checked){
		layer.tips('删除说说不可逆，请谨慎操作！', '#chkall', {
			tips: 3
		});
        }
}
</script>
</head>
<body>
<?php
switch($action){
	case 'alldel':
		alldel();
		break;
	case 'keyword':
		$key=SafeRequest("key","get");
		main("select * from ".tname('feed')." where in_type=0 and in_content like '%".$key."%' or in_type=0 and in_uname like '%".$key."%' order by in_addtime desc",20);
		break;
	default:
		main("select * from ".tname('feed')." where in_type=0 order by in_addtime desc",20);
		break;
	}
?>
</body>
</html>
<?php
function main($sql,$size){
	global $db;
	$Arr=getpagerow($sql,$size);
	$result=$Arr[1];
	$count=$Arr[2];
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'MixMusic Board 管理中心 - 用户管理 - 所有说说';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='用户管理&nbsp;&raquo;&nbsp;所有说说';</script>
<div class="floattop"><div class="itemtitle"><h3>所有说说</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">技巧提示</th></tr>
<tr><td class="tipsblock"><ul>
<li>可以输入说说内容、所属会员等关键词进行搜索</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="iframe" value="feed">
<input type="hidden" name="action" value="keyword">
关键词：<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<input type="button" value="搜索" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<form name="form" method="post" action="?iframe=feed&action=alldel">
<table class="tb tb2">
<tr class="header">
<th>编号</th>
<th>说说内容</th>
<th>所属会员</th>
<th>发表时间</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">没有说说</td></tr>
<?php
}
if($result){
while($row = $db->fetch_array($result)){
$content = preg_replace('/\[em:(\d+)]/is', '<img src="static/user/images/face/\1.gif" class="face">', $row['in_content']);
$content = str_replace('class="face"', '/', $content);
?>
<tr class="hover">
<td class="td25"><input class="checkbox" type="checkbox" name="in_id[]" id="in_id" value="<?php echo $row['in_id']; ?>"><?php echo $row['in_id']; ?></td>
<td><?php echo $content; ?></td>
<td><a href="<?php echo getlink($row['in_uid']); ?>" target="_blank" class="act"><?php echo ReplaceStr($row['in_uname'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td><?php if(date("Y-m-d",strtotime($row['in_addtime']))==date('Y-m-d')){echo "<em class=\"lightnum\">".$row['in_addtime']."</em>";}else{echo $row['in_addtime'];} ?></td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<tr><td><input type="checkbox" id="chkall" class="checkbox" onclick="CheckAll(this.form);" /><label for="chkall">全选</label> &nbsp;&nbsp; <input type="submit" name="alldel" class="btn" value="批量删除" /></td></tr>
<?php echo $Arr[0]; ?>
</table>
</form>
</div>



<?php
}
	//批量删除
	function alldel(){
		global $db;
		if(!submitcheck('alldel')){ShowMessage("表单验证不符，无法提交！",$_SERVER['PHP_SELF'],"infotitle3",3000,1);}
		$in_id = RequestBox("in_id");
		if($in_id==0){
			ShowMessage("批量删除失败，请先勾选要删除的说说！","?iframe=feed","infotitle3",3000,1);
		}else{
			$db->query("delete from ".tname('reply')." where in_fid in ($in_id)");
			$db->query("delete from ".tname('feed')." where in_id in ($in_id)");
			ShowMessage("恭喜您，说说批量删除成功！","?iframe=feed","infotitle2",3000,1);
		}
	}
?>