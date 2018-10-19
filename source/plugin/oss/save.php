<?php
include '../../system/config.inc.php';
require_once 'samples/Common.php';
use OSS\OssClient;
use OSS\Core\OssException;
$bucket = Common::getBucketName();
$ossClient = Common::getOssClient();
$data = empty($GLOBALS['HTTP_RAW_POST_DATA']) ? file_get_contents('php://input') : $GLOBALS['HTTP_RAW_POST_DATA'];
if($data){
	$src = IN_ROOT.'./data/tmp/oss_'.date('YmdHis').rand(2,pow(2,24)).'_record.mp3';
        $file = @fopen($src, 'w');
	@fwrite($file, $data);
        @fclose($file);
	$dst = $_SERVER['HTTP_HOST'].'/music/audio';
	$object = $dst.'/'.date('YmdHis').rand(2,pow(2,24)).'.mp3';
	$ossClient->uploadFile($bucket, $object, $src);
        @unlink($src);
        echo IN_REMOTEDK.$object;
}else{
        echo 'error';
}
?>