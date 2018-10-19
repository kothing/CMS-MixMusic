<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(7);
$action=SafeRequest("action","get");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>支付记录</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<link href="static/pack/asynctips/asynctips.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/asynctips/jquery.min.js"></script>
<script type="text/javascript" src="static/pack/asynctips/asyncbox.v1.4.5.js"></script>
<script type="text/javascript">
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
</script>
</head>
<body>
<?php
switch($action){
	case 'keyword':
		$key=SafeRequest("key","get");
		$sql="select * from ".tname('paylog')." where in_uname like '%".$key."%' or in_title like '%".$key."%' order by in_addtime desc";
		main($sql,20);
		break;
	default:
		$lock=SafeRequest("lock","get");
		if(!IsNum($lock)){
		        $sql="select * from ".tname('paylog')." order by in_addtime desc";
		}else{
		        $sql="select * from ".tname('paylog')." where in_lock=".intval($lock)." order by in_addtime desc";
		}
		main($sql,20);
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
<script type="text/javascript">parent.document.title = 'MixMusic Board 管理中心 - 系统 - 支付记录';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='系统&nbsp;&raquo;&nbsp;支付记录';</script>
<div class="floattop"><div class="itemtitle"><h3>支付记录</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">技巧提示</th></tr>
<tr><td class="tipsblock"><ul>
<li>可以输入支付会员、订单号等关键词进行搜索</li>
</ul></td></tr>
</table>
<table class="tb tb2">
<form name="btnsearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<tr><td>
<input type="hidden" name="iframe" value="paylog">
<input type="hidden" name="action" value="keyword">
关键词：<input class="txt" x-webkit-speech type="text" name="key" id="search" value="" />
<select onchange="location.href=this.options[this.selectedIndex].value;">
<option value="?iframe=paylog">不限状态</option>
<option value="?iframe=paylog&lock=0"<?php if(isset($_GET['lock']) && $_GET['lock']==0){echo " selected";} ?>>支付成功</option>
<option value="?iframe=paylog&lock=1"<?php if(isset($_GET['lock']) && $_GET['lock']==1){echo " selected";} ?>>支付失败</option>
</select>
<input type="button" value="搜索" class="btn" onclick="s()" />
</td></tr>
</form>
</table>
<table class="tb tb2">
<tr class="header">
<th>金币</th>
<th>订单号</th>
<th>金额</th>
<th>状态</th>
<th>支付会员</th>
<th>支付时间</th>
</tr>
<?php
if($count==0){
?>
<tr><td colspan="2" class="td27">没有支付记录</td></tr>
<?php
}
if($result){
while($row = $db->fetch_array($result)){
?>
<tr class="hover">
<td><?php echo $row['in_points']; ?></td>
<td><?php echo ReplaceStr($row['in_title'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></td>
<td><?php echo $row['in_money']; ?></td>
<td><?php if($row['in_lock']==0){echo "成功";}else{echo "<em class=\"lightnum\">失败</em>";} ?></td>
<td><a href="?iframe=paylog&action=keyword&key=<?php echo $row['in_uname']; ?>" class="act"><?php echo ReplaceStr($row['in_uname'],SafeRequest("key","get"),"<em class=\"lightnum\">".SafeRequest("key","get")."</em>"); ?></a></td>
<td><?php if(date('Y-m-d',strtotime($row['in_addtime']))==date('Y-m-d')){echo "<em class=\"lightnum\">".$row['in_addtime']."</em>";}else{echo $row['in_addtime'];} ?></td>
</tr>
<?php
}
}
?>
</table>
<table class="tb tb2">
<?php echo $Arr[0]; ?>
</table>
</div>
<?php } ?>