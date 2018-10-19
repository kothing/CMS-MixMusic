<?php
include '../../system/db.class.php';
include 'class.ftp.php';
class AvatarUploader{
	private function uploadAvatar($uid){
		if(empty($_FILES['Filedata'])){
			return -3;
		}elseif($_FILES['Filedata']['size'] > 2097152){
			return 'File can not be more than 2097152 bytes!';
		}
		$tmpPath = IN_ROOT."data/tmp/{$uid}_200x200.jpg";
		$dir = dirname($tmpPath);
		if(!file_exists($dir)){
			@mkdir($dir, 0777, true);
		}
		if(file_exists($tmpPath)){
			@unlink($tmpPath);
		}
		if(@copy($_FILES['Filedata']['tmp_name'], $tmpPath) || @move_uploaded_file($_FILES['Filedata']['tmp_name'], $tmpPath)){
			@unlink($_FILES['Filedata']['tmp_name']);
			list($width, $height, $type, $attr) = getimagesize($tmpPath);
			if($width < 10 || $height < 10 || $width > 3000 || $height > 3000 || $type == 4){
				@unlink($tmpPath);
				return -2;
			}
		}else{
			@unlink($_FILES['Filedata']['tmp_name']);
			return -4;
		}
		$tmpUrl = "http://".$_SERVER['HTTP_HOST'].IN_PATH."data/tmp/{$uid}_200x200.jpg";
		return $tmpUrl;
	}
	private function flashdata_decode($s){
		$r = '';
		$l = strlen($s);
		for($i = 0; $i < $l; $i = $i + 2){
			$k1 = ord($s[$i]) - 48;
			$k1 -= $k1 > 9 ? 7 : 0;
			$k2 = ord($s[$i + 1]) - 48;
			$k2 -= $k2 > 9 ? 7 : 0;
			$r .= chr($k1 << 4 | $k2);
		}
		return $r;
	}
	private function rectAvatar($uid){
		$avatar = $this->flashdata_decode($_POST['avatar1']);
		if(!$avatar){
			return '<root><message type="error" value="-2" /></root>';
		}
		$avatarfile = IN_ROOT."data/attachment/avatar/{$uid}.jpg";
		$success = 1;
		$fp = @fopen($avatarfile, 'wb');
		@fwrite($fp, $avatar);
		@fclose($fp);
		$info = @getimagesize($avatarfile);
		if(!$info || $info[2] == 4){
			file_exists($avatarfile) && unlink($avatarfile);
			$success = 0;
		}
		if($uid){
			$dst = $_SERVER['HTTP_HOST'].'/avatar';
			$dir = IN_REMOTEDIR == '.' ? $dst : IN_REMOTEDIR.'/'.$dst;
			$path = '/'.$uid.'.jpg';
			$ftp = new ftp(IN_REMOTEHOST, IN_REMOTEPORT, IN_REMOTEOUT, IN_REMOTEUSER, IN_REMOTEPW, IN_REMOTEPASV);
			$return = $ftp->f_put($avatarfile, $dir, $path);
			if($return){
			        global $db;
			        $row = $db->getrow("select * from ".tname('user')." where in_userid=".$uid);
			        if(empty($row['in_avatar'])){
			                $db->query("update ".tname('user')." set in_points=in_points+".IN_AVATARPOINTS.",in_rank=in_rank+".IN_AVATARRANK." where in_userid=".$uid);
			                $setarrs = array(
			                        'in_uid' => 0,
			                        'in_uname' => '系统用户',
			                        'in_uids' => $row['in_userid'],
			                        'in_unames' => $row['in_username'],
			                        'in_content' => '初次上传头像：[金币+'.IN_AVATARPOINTS.'][经验+'.IN_AVATARRANK.']',
			                        'in_isread' => 0,
			                        'in_addtime' => date('Y-m-d H:i:s')
			                );
			                inserttable('message', $setarrs, 1);
			        }
			        $db->query("update ".tname('user')." set in_avatar='".IN_REMOTEURL."/".$dst.$path."' where in_userid=".$uid);
			}
			$ftp->c_lose();
		}
		$tmpPath = IN_ROOT."data/tmp/{$uid}_200x200.jpg";
		@unlink($tmpPath);
		@unlink($avatarfile);
		return '<?xml version="1.0" ?><root><face success="'.$success.'" /></root>';
	}
	public function processRequest(){
		global $db;
		$arr = array();
		if(isset($_GET['input'])){
			parse_str($_GET['input'], $arr);
		}
		if(isset($arr['uid'])){
			$avatar = explode(':', $arr['uid']);
			if($db->getone("select in_userid from ".tname('user')." where in_islock=0 and in_userid=".intval($avatar[0])." and in_userpassword='".SafeSql($avatar[1])."'")){
			        $uid = intval($avatar[0]);
			}else{
			        $uid = 0;
			}
		}
		if(isset($_GET['a']) && $_GET['a'] == 'uploadavatar'){
			echo $this->uploadAvatar($uid);
			return true;
		}elseif(isset($_GET['a']) && $_GET['a'] == 'rectavatar'){
			echo $this->rectAvatar($uid);
			return true;
		}
		return false;
	}
}
header("Expires: 0");
header("Cache-Control: private, post-check=0, pre-check=0, max-age=0", FALSE);
header("Pragma: no-cache");
header("Cache-Control:no-cache");
$au = new AvatarUploader();
if($au->processRequest()){
	exit();
}
?>