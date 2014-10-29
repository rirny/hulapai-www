<?php
header("Content-type: text/html; charset=utf-8");
header("cache-control:no-cache,must-revalidate");
date_default_timezone_set('Asia/Shanghai');
define('ROOT_PATH', getcwd());
define('SYS', ROOT_PATH);
define('LIB', SYS . "/library");
define('MODEL', SYS . "/model");
define('CONF', ROOT_PATH . "/conf");
define('LOG_PATH', ROOT_PATH . "/logs");
define('TABLE_PREFIX', 't_');

// DB 事务
require(LIB.'/exception.class.php');
require(LIB.'/http.class.php');

require(SYS.'/comm/comm.php');
require(LIB.'/config.class.php');
try
{		
	$domain = Http::domain();
	define('DOMAIN', $domain);
	
	define('ROOT', 'http://' . $_SERVER['HTTP_HOST']);
	$config = Config::get($domain, 'domain');
	empty($config) && $config = Config::get('www', 'domain');
	if(!$config) show_error('Not Found');
	extract($config);
	empty($app) && $app = 'www';
	define('APP_PATH', ROOT_PATH . '/app/' . $app);
	empty($model) && $model =  "model";
	define('APP_MODEL', APP_PATH .  $model);
	empty($library) && $library = "library";
	define('APP_LIB', APP_PATH .  $library);
	empty($tpl) && $tpl = $app . "tpl";
	define('APP_TPL', APP_PATH .  $tpl);
	empty($cache) && $cache = "cache";
	define('APP_CACHE_PATH', APP_PATH . $cache);
	$type || $type = 'api';
	_session_start('memcache');	
	import('router');
	Router::adapter($type);	
	$appname = $application = Router::$app;	
	define('APP', $application);
	$action = Router::$act;
	define('ACTION', $action);
	$appPath = Router::$appPath;

	if($type == 'api')
	{		
		define('TYPE', 'API');
	}else{		
		define('TYPE', 'WEB');
	}

	$application .= "_App";
	$action .= "_Action";

	init_define(); // 初始常量
	import('controller'); // 控制器基类
	require_once(APP_PATH . "/abstract.class.php"); // 基类	

	if(!file_exists($appPath)) show_error('App Not Found');
	
	require_once($appPath);
	$class = ucfirst($application);
	$Module = new $class;
	$Module->app = APP;
	$Module->act = ACTION;
	if(!method_exists($Module, $action))
	{		
		show_error('Action Not Found');
	}
	$Module->$action();	
	if(class_exists('Db')){db()->commit();}

	$Module->response();
}catch(WEBException $e)
{
	if(class_exists('Db')) db()->rollback();
	$smarty = smarty();
	$errorPage = ErrorPage($e->getCode());
	$smarty->assign('webResult', $t = array(
		'code' => $e->getCode(),
		'message' => $e->getMessage()
	));	
	$smarty->display($errorPage . ".html"); // 404,505 加载不同的页面
}catch(PDOException $e)
{	
	$message = 'Database Error' . $e->getMessage();
	if(class_exists('Db')) db()->rollback();
	die(json_encode(array(
		'state' => 0,
		'message' => $message
	)));
}catch(Exception $e)
{
	$code = $e->getCode();
	$message = $e->getMessage();
	if(class_exists('Db')) db()->rollback();
	die(json_encode(array(
		'state' => 0,
		'message' => $e->getMessage()
	)));
}
if(class_exists('Db')) Db::close();
?>
