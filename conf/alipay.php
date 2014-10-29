<?php
$config['alipay'] = array(
	'partner' => '', // 合作身份者id，以2088开头的16位纯数字
	'key' => '', //安全检验码，以数字和字母组成的32位字符
	'sign_type' => 'MD5',	//签名方式 不需修改
	'input_charset' => 'utf-8',//字符编码格式 目前支持 gbk 或 utf-8
	'cacert' => ROOT . '/static/cacert.pem', // ca证书路径地址，用于curl中ssl校验(可访问的路径) 请保证cacert.pem文件在当前文件夹目录中
	'transport' => 'http' //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
	'notify_url' => ROOT . "/?app=pay&act=notify"
);