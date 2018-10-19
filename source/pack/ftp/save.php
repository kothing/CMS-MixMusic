<?php
include '../../system/config.inc.php';
include 'class.ftp.php';
$data = empty($GLOBALS['HTTP_RAW_POST_DATA']) ? file_get_contents('php://input') : $GLOBALS['HTTP_RAW_POST_DATA'];
if($data){
        $src = IN_ROOT.'./data/tmp/ftp_'.date('YmdHis').rand(2,pow(2,24)).'_record.mp3';
        $file = @fopen($src, 'w');
	@fwrite($file, $data);
        @fclose($file);
        $dst = $_SERVER['HTTP_HOST'].'/music/audio';
        $dir = IN_REMOTEDIR == '.' ? $dst : IN_REMOTEDIR.'/'.$dst;
        $path = '/'.date('YmdHis').rand(2,pow(2,24)).'.mp3';
        $ftp = new ftp(IN_REMOTEHOST, IN_REMOTEPORT, IN_REMOTEOUT, IN_REMOTEUSER, IN_REMOTEPW, IN_REMOTEPASV);
        $return = $ftp->f_put($src, $dir, $path);
        if($return){
                echo IN_REMOTEURL.'/'.$dst.$path;
        }else{
                echo 'error';
        }
        @unlink($src);
        $ftp->c_lose();
}else{
        echo 'error';
}
?>