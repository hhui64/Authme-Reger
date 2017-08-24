<?php

// 初始化session
session_start();

// 引入外部 PHP 以供调用.
include 'modules/config.inc.php';
include 'modules/api.php';

// 设置 date() 时区为中国 RPC 时区
// 解决比系统时间差 6 小时的问题.
date_default_timezone_set('PRC');

// 判断是否为禁止访问地区
$ipAddress = GetIpLookup(getIP());
if($ban_mode == '0'){
	if($ipAddress['city'] == $ban_city){
		die();
	}
} elseif($ban_mode == '1'){
	if($ipAddress['province'] == $ban_province){
		die();
	}
} else {
	die();
}

// session初始化 & 设置
$code = mt_rand(0,1000000); 
$_SESSION['code'] = $code;

// 输出注册页面html模版
include 'template/reg.html';

?>