<?php
$config['domain'] = array(
	'api' => array(
		'sitename' => '呼啦派API',
		'type' => 'api',
		'app' => 'api',
		'session_hander' => 'memcache'
	),
	'admin' => array(
		'sitename' => '呼啦派系统管理后台',
		'type' => 'api',
		'app' => 'admin',
		'session_hander' => 'memcache'
	),
	'manage' => array(
		'sitename' => '呼啦派管理系统',
		'type' => 'web',
		'app' => 'manage',
		'model' => 'manage/model/',
		'library' => 'manage/library/',
		'session_hander' => 'memcache'
	),
	'www' => array(
		'sitename' => '呼啦派',
		'type' => 'web',
		'app' => 'www',
		'model' => 'www/model/',
		'library' => 'www/library/',
		'session_hander' => 'memcache'
	)
);

$config['system'] = array(
	'static' => "http://static.hulapai.com",
	'apiHost'=> "http://client.hulapai.com"
);

$config['download'] = array(
	'ios' => 'http://itunes.apple.com/cn/app/id664444914',
	'android'=> 'http://fusion.qq.com/app_download?appid=1101122090&platform=qzone&via=QZ.MOBILEDETAIL.QRCODE'
);

$config['database'] = array(
	'default' => array(		
		'master' => array(
			'host' => '192.168.0.200',
			'charset' => 'utf8',
			'dbname' => 'huladb',
			'username' => 'root',
			'password' => 'zaDUvXzYwfQd3czS',
		),
		'slave' => array(
			'host' => '192.168.0.200',
			'charset' => 'utf8',
			'dbname' => 'huladb',
			'username' => 'root',
			'password' => 'zaDUvXzYwfQd3czS',
		)		
	),
	'cms' => array(		
		'master' => array(
			'host' => '192.168.0.200',
			'charset' => 'utf8',
			'dbname' => 'phpcms',
			'username' => 'root',
			'password' => 'zaDUvXzYwfQd3czS',
		),
		'slave' => array(
			'host' => '192.168.0.200',
			'charset' => 'utf8',
			'dbname' => 'phpcms',
			'username' => 'root',
			'password' => 'zaDUvXzYwfQd3czS',
		)		
	)
);

$config['session'] = array(	
	'name' => 'HLPSESS',
	'perfix' => 'SESS_',
	'lifetime' => 3600,
	'handle' => 'memcache',
	'domain' => '.hulapai.com',
	'path' => '/'
);

$config['memcache'] = array(
	'host' => '192.168.0.200',
	'port'  => 11211,
	'exprie' => 1200,
	'compression' => false
);

$config['redis'] = array(
	'host' => '192.168.0.200',
	'port' => '6379'
);

$config['errors'] = array(
	404 => 'Not Found',
	405 => 'Lib Not Found',
	406 => 'App Not Found',
	407 => 'Action Not Found',
	501 => 'Server Error',
	502 => 'Server Error'
);

$config['smarty'] = array(
	'caching' => false,
	'template_dir' => ROOT_PATH . '/tpl',
	'compile_dir' => ROOT_PATH . '/cache/compile',
	'cache_dir' => ROOT_PATH . '/cache/cache',
	'left_delimiter' => '<!--{',
	'right_delimiter' => '}-->',
);