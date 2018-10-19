<?php
include '../../system/config.inc.php';
include 'class.ftp.php';
switch($_GET['type']){
	case 'music_audio':
		$ext = IN_UPMUSICEXT;
		break;
	case 'music_lyric':
		$ext = "*.lrc";
		break;
	case 'music_cover':
		$ext = "*.jpg;*.jpeg;*.gif;*.png";
		break;
	case 'special_cover':
		$ext = "*.jpg;*.jpeg;*.gif;*.png";
		break;
	case 'singer_cover':
		$ext = "*.jpg;*.jpeg;*.gif;*.png";
		break;
	case 'video_play':
		$ext = IN_UPVIDEOEXT;
		break;
	case 'video_cover':
		$ext = "*.jpg;*.jpeg;*.gif;*.png";
		break;
	case 'link_cover':
		$ext = "*.jpg;*.jpeg;*.gif;*.png";
		break;
}
$fileext = str_replace(array('*.', ';'), array('', '|'), $ext);
$filearray = preg_split('/\|/', $fileext);
$filepart = pathinfo($_FILES['Filedata']['name']);
if(!empty($_FILES) && in_array(strtolower($filepart['extension']), $filearray)){
        $src = IN_ROOT.'./data/tmp/ftp_'.date('YmdHis').rand(2,pow(2,24)).'_'.basename($_FILES['Filedata']['tmp_name']);
        move_uploaded_file($_FILES['Filedata']['tmp_name'], $src);
        $dst = $_SERVER['HTTP_HOST'].'/'.str_replace('_', '/', $_GET['type']);
        $dir = IN_REMOTEDIR == '.' ? $dst : IN_REMOTEDIR.'/'.$dst;
        $path = '/'.date('YmdHis').rand(2,pow(2,24)).'.'.strtolower(trim(substr(strrchr($_FILES['Filedata']['name'],'.'),1)));
        $ftp = new ftp(IN_REMOTEHOST, IN_REMOTEPORT, IN_REMOTEOUT, IN_REMOTEUSER, IN_REMOTEPW, IN_REMOTEPASV);
        $return = $ftp->f_put($src, $dir, $path);
        if($return){
                echo IN_REMOTEURL.'/'.$dst.$path;
        }else{
                echo '0';
        }
        @unlink($src);
        $ftp->c_lose();
}
?>