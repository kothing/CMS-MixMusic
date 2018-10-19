<?php
include '../../system/db.class.php';
require_once 'WxPay.Api.php';
require_once 'WxPay.NativePay.php';
global $db;
$get_in_title = SafeSql($_GET['in_title']);
$out_trade_no = $get_in_title.'-'.rand(2, pow(2, 24));
$row = $db->getrow("select * from ".tname('paylog')." where in_title='$get_in_title'");
$input = new WxPayUnifiedOrder();
$input->SetBody($_SERVER['HTTP_HOST'].' / '.$row['in_points']);
$input->SetOut_trade_no($out_trade_no);
$input->SetTotal_fee($row['in_money'] * 100);
$input->SetTime_start(date('YmdHis'));
$input->SetTime_expire(date('YmdHis', time() +600));
$input->SetNotify_url('http://'.$_SERVER['HTTP_HOST'].IN_PATH.'source/pack/weixin/notify.php');
$input->SetTrade_type('NATIVE');
$input->SetProduct_id($row['in_id']);
$notify = new NativePay();
$result = $notify->GetPayUrl($input);
$code_url = $result['code_url'];
$db->query("update ".tname('paylog')." set in_title='$out_trade_no' where in_title='$get_in_title'");
?>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo IN_CHARSET; ?>" />
<table style="text-align:center;border:1px solid #09C;width:350px">
<tr>
	<th style="border:1px solid #09C">付款站点</th>
	<td style="border:1px solid #09C"><?php echo $_SERVER['HTTP_HOST']; ?></td>
</tr>
<tr>
	<th style="border:1px solid #09C">支付金额</th>
	<td style="border:1px solid #09C"><strong style="color:#09C"><?php echo $row['in_money'].'.00'; ?></strong>￥</td>
</tr>
<tr>
	<th style="border:1px solid #09C">交易订单</th>
	<td style="border:1px solid #09C"><?php echo $get_in_title; ?></td>
</tr>
<tr>
	<th style="border:1px solid #09C">充值金币</th>
	<td style="border:1px solid #09C"><?php echo $row['in_points']; ?></td>
</tr>
<tr>
	<th style="border:1px solid #09C">扫码支付</th>
	<td style="border:1px solid #09C"><img src="qrcode.php?link=<?php echo urlencode($code_url); ?>"></td>
</tr>
</table>