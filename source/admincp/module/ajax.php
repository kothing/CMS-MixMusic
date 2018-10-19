<?php
if(!defined('IN_ROOT')){exit('Access denied');}
Administrator(1);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: text/html;charset=".IN_CHARSET);
global $db,$update_api;
$ac=SafeRequest("ac","get");
if($ac == 'best'){
	$level=intval(SafeRequest("level","get"));
	$id=intval(SafeRequest("id","get"));
	$sql="update ".tname('music')." set in_best=".$level." where in_id=".$id;
	if($db->query($sql)){
		echo '1';
	}
}elseif($ac == 'build'){
	$file='data/tmp/build.xml';
	if(empty($_COOKIE['in_build'])){
		setcookie("in_build","have",time()+1800);
		fwrite(fopen($file, 'w+'), @file_get_contents($update_api.'?auth=build'));
	}
	if($xml = @simplexml_load_file($file)){
		$build=intval(trim($xml->item['build']));
		if($build > IN_BUILD){
			echo $build;
		}
	}
}elseif($ac == 'app'){
	$type=SafeRequest("type","get");
	$id=intval(SafeRequest("id","get"));
	$cookie='in_'.$type.'_'.$id;
	$file='data/tmp/'.$type.'-'.$id.'.xml';
	$row=$db->getrow("select * from ".tname($type == 'template' ? 'template' : 'plugin')." where in_id=".$id);
	$date=intval(strtotime($row['in_addtime']));
	if($type == 'template'){
		$path=substr($row['in_path'], 0, strrpos(str_replace('//', '', $row['in_path'].'/'), '/'));
		$dir=str_replace('template/', '', $path);
		if(empty($_COOKIE[$cookie])){
			setcookie($cookie,"have",time()+1800);
			fwrite(fopen($file, 'w+'), @file_get_contents($update_api.'?auth=app&charset='.IN_CHARSET.'&type=template&dir='.$dir));
		}
		if($xml = @simplexml_load_file($file)){
			$zip=pack('H*', trim($xml->item['zip']));
			$time=intval(trim($xml->item['time']));
			if($date < $time){
				echo '?iframe=develop&step=s&zip='.auth_codes($zip, 'en', $_SERVER['HTTP_HOST']).'&dir='.$dir;
			}
		}
	}else{
		if(empty($_COOKIE[$cookie])){
			setcookie($cookie,"have",time()+1800);
			fwrite(fopen($file, 'w+'), @file_get_contents($update_api.'?auth=app&charset='.IN_CHARSET.'&type=plugin&dir='.$row['in_dir']));
		}
		if($xml = @simplexml_load_file($file)){
			$zip=pack('H*', trim($xml->item['zip']));
			$time=intval(trim($xml->item['time']));
			if($date < $time){
				echo '?iframe=develop&step=p&zip='.auth_codes($zip, 'en', $_SERVER['HTTP_HOST']).'&dir='.$row['in_dir'];
			}
		}
	}
}
?>