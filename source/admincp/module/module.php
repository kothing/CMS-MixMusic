<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(8);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>所有应用</title>
<link href="static/admincp/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/pack/layer/jquery.js"></script>
<script type="text/javascript" src="static/pack/layer/confirm-lib.js"></script>
<script type="text/javascript" src="static/admincp/js/ajax.js"></script>
<script type="text/javascript">
    function del_msg(href) {
        $.layer({
            shade: [0],
            area: ['auto', 'auto'],
            dialog: {
                msg: '卸载操作不可逆，确认继续？',
                btns: 2,
                type: 4,
                btn: ['确认', '取消'],
                yes: function() {
                    location.href = href;
                },
                no: function() {
                    layer.msg('已取消卸载', 1, 0);
                }
            }
        });
    }
</script>
</head>
<body>
<?php
$action=SafeRequest("ac","get");
if($action=="uninst"){del_plugin($_GET['id'],$_GET['dir']);}elseif($action=="status"){cut_plugin($_GET['id'],$_GET['is']);}
?>
<div class="container">
<script type="text/javascript">parent.document.title = 'MixMusic Board 管理中心 - 云平台';if(parent.$('admincpnav')) parent.$('admincpnav').innerHTML='云平台';</script>
<div class="floattop"><div class="itemtitle"><h3>所有应用</h3></div></div><div class="floattopempty"></div>
<table class="tb tb2">
<tr><th class="partition">插件列表</th></tr>
</table>
<table class="tb tb2">
<?php
    global $db,$develop_auth;
    $sql = "select * from ".tname('plugin')." where in_type<3 order by in_addtime desc";
    $query = $db->query($sql);
    $count = $db->num_rows($db->query(str_replace('*', 'count(*)', $sql)));
    if($count==0){
            echo "<tr><td colspan=\"2\" class=\"td27\">暂无插件</td></tr>";
    }else{
        $num = 0;
        while($row = $db->fetch_array($query)){
            $num = $num + 1;
            $in_isindex = NULL;
            if($row['in_type']==2 && $row['in_isindex']==1){
                    $in_isindex="<img src=\"static/admincp/images/show_yes.gif\" style=\"cursor:pointer\" onclick=\"location.href='?iframe=module&ac=status&id=".$row['in_id']."&is=0';\" title=\"前台隐藏\" />&nbsp;&nbsp;";
            }elseif($row['in_type']==2 && $row['in_isindex']==0){
                    $in_isindex="<img src=\"static/admincp/images/show_no.gif\" style=\"cursor:pointer\" onclick=\"location.href='?iframe=module&ac=status&id=".$row['in_id']."&is=1';\" title=\"前台显示\" />&nbsp;&nbsp;";
            }
            echo "<tr class=\"hover hover\">";
            echo "<td valign=\"top\" style=\"width:45px\"><img src=\"source/plugin/".$row['in_dir']."/preview.jpg\" onerror=\"this.src='static/admincp/images/preview.png'\" style=\"cursor:pointer\" onclick=\"location.href='plugin.php/".$row['in_dir']."/".$row['in_file']."/';\" width=\"40\" height=\"40\" align=\"left\" /></td>";
            echo "<td class=\"light\" valign=\"top\" style=\"width:200px\">".$row['in_name']."<br /><span class=\"sml\">".$row['in_dir']."</span><br /></td>";
            echo "<td valign=\"bottom\"><span class=\"light\">作者: ".$row['in_author']."</span><div class=\"psetting\"><a href=\"".$row['in_address']."\" target=\"_blank\">查看</a></div></td>";
            echo "<td align=\"right\" valign=\"bottom\" style=\"width:160px\"><span id=\"app".$row['in_id']."\">".(date("Y-m-d",strtotime($row['in_addtime']))==date('Y-m-d') ? '<em class="lightnum">'.date("Y-m-d",strtotime($row['in_addtime'])).'</em>' : date("Y-m-d",strtotime($row['in_addtime'])))."</span><br /><br />".$in_isindex."<a style=\"cursor:pointer\" onclick=\"del_msg('?iframe=module&ac=uninst&id=".$row['in_id']."&dir=".$row['in_dir']."');\">卸载</a>&nbsp;&nbsp;</td>";
            echo "</tr>";
        }
    }
?>
</table>
<table class="tb tb2">
<tr><th class="partition">扩展列表</th></tr>
</table>
<table class="tb tb2">
<?php
    $sql = "select * from ".tname('plugin')." where in_type>2 order by in_addtime desc";
    $query = $db->query($sql);
    $count = $db->num_rows($db->query(str_replace('*', 'count(*)', $sql)));
    if($count==0){
            echo "<tr><td colspan=\"2\" class=\"td27\">暂无扩展</td></tr>";
    }else{
        $num = $db->num_rows($db->query("select count(*) from ".tname('plugin')." where in_type<3"));
        while($row = $db->fetch_array($query)){
            $num = $num + 1;
            echo "<tr class=\"hover hover\">";
            echo "<td valign=\"top\" style=\"width:45px\"><img src=\"source/plugin/".$row['in_dir']."/preview.jpg\" onerror=\"this.src='static/admincp/images/preview.png'\" width=\"40\" height=\"40\" align=\"left\" /></td>";
            echo "<td class=\"light\" valign=\"top\" style=\"width:200px\">".$row['in_name']."<br /><span class=\"sml\">".$row['in_dir']."</span><br /></td>";
            echo "<td valign=\"bottom\"><span class=\"light\">作者: ".$row['in_author']."</span><div class=\"psetting\"><a href=\"".$row['in_address']."\" target=\"_blank\">查看</a></div></td>";
            echo "<td align=\"right\" valign=\"bottom\" style=\"width:160px\"><span id=\"app".$row['in_id']."\">".(date("Y-m-d",strtotime($row['in_addtime']))==date('Y-m-d') ? '<em class="lightnum">'.date("Y-m-d",strtotime($row['in_addtime'])).'</em>' : date("Y-m-d",strtotime($row['in_addtime'])))."</span><br /><br /><a style=\"cursor:pointer\" onclick=\"del_msg('?iframe=module&ac=uninst&id=".$row['in_id']."&dir=".$row['in_dir']."');\">卸载</a>&nbsp;&nbsp;</td>";
            echo "</tr>";
        }
    }
?>
</table>
</div>
</body>
</html>
<?php
function del_plugin($id,$dir){
	global $db;
        if(@include_once('source/plugin/'.$dir.'/function.php')){
		plugin_uninstall();
        }
	$sql="delete from ".tname('plugin')." where in_id=".intval($id);
	if($db->query($sql)){
		echo "<script type=\"text/javascript\">parent.$('menu_app').innerHTML='".Menu_App()."';</script>";
		destroyDir('source/plugin/'.$dir.'/');
		ShowMessage("恭喜您，应用卸载成功！","?iframe=module","infotitle2",3000,1);
	}
}
function cut_plugin($id,$is){
	global $db;
	$sql="update ".tname('plugin')." set in_isindex=".intval($is)." where in_id=".intval($id);
	if($db->query($sql)){
		ShowMessage("恭喜您，状态切换成功！","?iframe=module","infotitle2",1000,1);
	}
}
?>