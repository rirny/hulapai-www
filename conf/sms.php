<?php
$config['sms'] = array(	
	'url' => 'http://sdkhttp.eucp.b2m.cn/sdk/SDKService?wsdl',
	'serialNumber' => '3SDK-EMY-0130-QCTOT',
	'password' => '017678',
	'sessionKey' => 'FaHByLwKdw',
	'timeout' => 2,
	'response_timeout' => 10,
	'proxyhost' => false,
	'proxyport' => false,
	'proxyusername' => false,
	'proxypassword' => false,
	'outgoingEncoding' => 'UTF8'
);

$config['notice'] = array(
	'register' => '您的验证码为：{code}，您可以进行下一步，完成注册啦！我们仅以此确认您的身份。退订回复TD。【呼啦派】',
	'forget' => '您的验证码为：{code}，您可以通过下一步验证找回您的呼啦派账号。退订回复TD。【呼啦派】',
	'welcome'=> '亲爱的{user}用户，欢迎您注册呼啦派，您可以完善您的资料，并创建老师档案或学生档案以便于更好地使用本系统。'
);