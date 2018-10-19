<?php

require_once '../../system/config.inc.php';
require_once 'samples/Common.php';
use OSS\OssClient;
use OSS\Core\OssException;
$bucket = Common::getBucketName();
$ossClient = Common::getOssClient();
is_null($ossClient) and exit('0');
if(!empty($_FILES)){
        $dst = $_SERVER['HTTP_HOST'].'/'.str_replace('_', '/', $_GET['type']);
        $object = $dst.'/'.date('YmdHis').rand(2,pow(2,24)).'.'.strtolower(trim(substr(strrchr($_FILES['Filedata']['name'],'.'),1)));
        try{
                $ossClient->uploadFile($bucket, $object, $_FILES['Filedata']['tmp_name']);
        }catch(OssException $e){
                exit(__FUNCTION__.': FAILED');
                exit($e->getMessage());
        }
        echo IN_REMOTEDK.$object;
}
?>