<?php
/*
 * 系统常用函数
 * Author@RIRNY 
 * TIME:2012/4/14
*/

if(!function_exists('show_error'))
{
	function show_error($message, $code=0)
	{
		if((defined('TYPE') && TYPE == 'API') || Http::is_ajax())
		{
			throw new Exception($message, $code);
		}else{
			throw new WEBException($message, $code);
		}
	}
}
/* 引入类
 * @name 类文件名或带路径文件名
 * @perfix 后缀
*/
if(!function_exists('import'))
{
    function import($name, $perfix = true)
    {
		static $static_class = array();
		$perfix = $perfix === false ? '' : '.class';
		$key = md5($name . (empty($param) ? '' : "_" . json_encode($param)) . $perfix);		
		if(!isset($static_class[$key]))
		{
			$class = strpos($name, "/") ? basename($name) : $name;
			$class = ucfirst($class);
			$class_path = '';
			if(defined('APP_LIB'))
			{
				$class_path = APP_LIB . '/' . $name . $perfix . '.php';
			}
			if($class_path && class_exists($class_path))
			{
				$class = APP . "_" . $class; 
			}else{
				$class_path = LIB . '/' . $name . $perfix . '.php';
			}
			if(!is_file($class_path)) show_error('Error', 404);
			@require_once $class_path;
			if(!class_exists($class)) show_error('Error');
			$static_class[$key] = $class;
		}
		return $static_class[$key];
    }
}

/* 加载类
 * @name 类文件名或带路径文件名
 * @perfix 后缀
 * @param 实例参数
*/
if(!function_exists('load'))
{
    function load($name, $param = array(), $perfix = 'class')
    {
		static $static_object = array();		
		$perfix === false ? '' : '.class';
		$key = md5($name . (empty($param) ? '' : "_" . json_encode($param)) . $perfix);
		if(!isset($static_object[$key]))
		{
			$class = import($name, $perfix);
			if($param)
			{
				$handle = new $class($param);
			}else{
				$handle = new $class;
			}
			$static_object[$key] = $handle;
		}
		return $static_object[$key];
    }
}

if(!function_exists('load_model'))
{
    function &load_model($name, $param=Null)
    {		
		static $modules = array();
		$key = md5($name . (empty($param) ? '' : "_" . json_encode($param)));
		if(isset($modules[$key])) return $modules[$key];

		if(!class_exists('Model')) @require_once LIB . '/model.class.php';
		$name = strtolower($name);
		$path = MODEL;
		$class = $name;
		if(strpos($name, "/")) // 仅支持一级 user/teacher <==> user.teacher => User_Teacher
		{				
			list($dir, $name) = preg_split('/[.\/]/', $name, 2);
			$path .= "/" . $dir;
			/*
			$abstaract = $path . "/abstract.class.php";
			if(file_exists($abstaract))
			{
				@require_once $abstaract;
			}else{
				eval('class ' . Ucfirst($dir) . '_Base extends Model { public function __construct(){parent::__construct();}}'); 
			}
			$class = $dir. "_". $name;			
			*/
		}		
		
		//$name = preg_replace('/[^A-Za-z0-9\-]/', '', $name); // 过滤	
		//echo $name;
		$param['table'] = $name;
		$class = ucfirst($class) . "_Model";
		$class_path = $path . '/' . $name . '.model.class.php';
		if(file_exists($class_path)){			
			require_once $class_path;
		}else{
			isset($param['table']) || $param['table'] = $name;
			eval('class ' . $class . ' extends Model { public function __construct($param=null){parent::__construct($param);}}'); 
		}		
		$modules[$key] = new $class($param);		
        return $modules[$key];
    }
}

if(!function_exists('_mkdir'))
{
    function _mkdir($path, $mode = 0777){
		if(!file_exists($path)){
			_mkdir(dirname($path), $mode);
			mkdir($path, $mode);
			//fclose(fopen($path . '/index.htm', 'w'));
		}
		return true;
	}
}

if(!function_exists('_session_start'))
{
    function &_session_start($method = '')
    {		
		static $handle = null;
		if($handle == null)
		{			
			if($method == 'memcache')
			{
				if(!class_exists('Session_handle')) require_once LIB . '/session.class.php';		
				$cache = cache('memcache');
				$handle = new Session_handle($cache);
			}else{
				$config = Config::get(Null, 'session');				
				ini_set('session.name', $config['name']);
				ini_set('session.cookie_domain', $config['domain']);
				ini_set('session.cookie_path', $config['path']);
				ini_set('session.cookie_lifetime', $config['lifetime']);
				session_start();
				$handle = true;
			}
		}
		return $handle;
    }
}

if(!function_exists('datetime'))
{
    function datetime($format='', $time)
    {
		$format || $format = 'Y-m-d H:i:s';
		$time || $time = time();
		return date($format, $time);
    }
}

if(!function_exists('cache'))
{
    function &cache($type = 'memcache')
    {
		static $cache = null;
		if($cache == null)
		{
			$class = ucfirst($type) . "_handle";
			$class_file = LIB . '/' . $type . '.class.php';
			if(!class_exists($class)) @require_once LIB . '/' . $type . '.class.php';
			if(!file_exists($class_file)) return false; // Out(0, '功能文件不存在！');		
			$cache = new $class();
		}
		return $cache;
    }
}

if(!function_exists('redis'))
{
    function &redis($db = 0)
    {
		static $redis = Array();	
		if(!isset($redis[$db]) || $redis[$db] == null)
		{
			$class_file = LIB . '/redis.class.php';
			if(!class_exists('Redis_handle')) @require_once $class_file;
			if(!file_exists($class_file)) Out(0, '功能文件不存在！');
			$config = Config::get(null, 'redis');
			$config['db'] = $db;
			$redis[$db] = new Redis_handle($config);		
		}
		return $redis[$db];
    }
}

if(!function_exists('push'))
{
    function &push($handle = 'redis')
    {
		static $push = array();
		if(!isset($push[$handle]))
		{
			import('push');
			$push[$handle] = Push::get_instance($handle);
		}
		return $push[$handle];
    }
}

if(!function_exists('db'))
{
    function &db($database='')
    {
		static $db = array();
		$database || $database = 'default';
		$result = Null;
		if(!isset($db[$database]))
		{			
			$class_file = LIB . '/db.class.php';
			if(!class_exists('Db')) @require_once $class_file;
			if(!file_exists($class_file)) Out(0, '功能文件不存在！');
			$config = Config::get($database, 'database');
			if(!empty($config))
			{
				$result = new Db($config);
				$db[$database] = $result;
			}
		}else{
			$result = $db[$database];
		}
		return $result;
    }
}

if(!function_exists('smarty'))
{
    function &smarty() // 不同的项目目录问题
    {
		static $smarty = Null;		
		if($smarty !== Null) return $smarty;
		$config = Config::get(Null, 'smarty');		
		if($config)
		{
			import('smarty/smarty');
			$smarty = new Smarty;
			foreach($config as $key => $item)
			{
				$smarty->$key = $item;
			}			
		}		
		return $smarty;
    }
}

if(!function_exists('logs'))
{
    function &logs($handle='')
    {
		static $logs = array();		
		$handle || $handle = 'db';		
		if(!isset($logs[$handle]))
		{
			$logs_class =  LIB . "/logs.class.php";
			if(!class_exists($logs_class)) @require_once $logs_class;
			$logs[$handle] = new Logs($handle);
		}
		return $logs[$handle];
    }
}

if(!function_exists('error'))
{
    function error($msg, $out=false)
    {		
		if($out) Out(0, $msg);
		throw new Exception($msg);
    }
}

if(!function_exists('iosFormat'))
{
	function iosFormat(array $data = array())
	{		
		if(empty($data)) return $data;
		foreach ($data as $key => & $value)
		{			
			if(is_array($value) && isset($value['id']))
			{
				$value = iosFormat($value);
			}else{
				if($key == 'id') 
				{
					$data['_id'] = $value;				
					unset($data['id']);
				}
			}
		}
		return $data;
	}
}

function ErrorPage($code)
{	
	if($code >=400 And $code < 499)
	{
		return 404;	
	}else if($code >=500 And $code < 599)
	{
		return 500;
	}else if($code >=600 And $code < 699) // 用户操作错误
	{
		return 'error';
	}else{
		return 'error';
	}
}

// 常用变量
function init_define()
{
	if(!defined('TIMESTAMP'))	define('TIMESTAMP', time());
	if(!defined('DAY'))	define('DAY', date('Y-m-d'));
	if(!defined('DATE_TIME'))	define('DATE_TIME', date('Y-m-d H:i:s'));	
	if(!defined('IP'))	define('IP', Http::ip());
	$agent = Http::agent();
	if(!defined('EMT'))	define('EMT', isset($agent['src']) ? $agent['src'] : NULL); // 设备
	if(!defined('SN'))	define('SN', isset($agent['sn']) ? $agent['sn'] : NULL); // 串码
	$perfix = ucwords(Config::get('perfix', 'session', '', false));

	$config = Config::get(Null, 'system');
	foreach($config as $key => $item)
	{
		$key = 'SYS_' . strtoupper($key);
		if(!defined($key))	define($key, $item);
	}
}


function guid() {
	$charid = strtoupper(md5(uniqid(mt_rand(), true)));
	$hyphen = chr(45);// "-"
	$uuid = chr(123)
	.substr($charid, 0, 8).$hyphen
	.substr($charid, 8, 4).$hyphen
	.substr($charid,12, 4).$hyphen
	.substr($charid,16, 4).$hyphen
	.substr($charid,20,12)
	.chr(125);
	return str_replace(array('{', '}'), '', $uuid);
}

if(!function_exists('week_day'))
{
    function week_day($date='0000-00-00', $stamp = true)
    {	
		$date || $date = DAY;
		$time = strtotime($date);
		$w = date('w', $time);
		$first = $time - $w * 18600;
		$last = $first + 7 * 18600;
		if($stamp)
		{
			$first = date('Y-m-d', $first);
			$last = date('Y-m-d', $last);
		}
		Return compact('first', 'last');
    }
}

if (!function_exists('cal_days_in_month')) 
{ 
    function cal_days_in_month() 
    { 
		$args = func_num_args();		
		if($args == 3)
		{
			$month = func_get_arg(1);
			$year = func_get_arg(2);
			$calendar = func_get_arg(0);
		}else{
			$month = func_get_arg(0);
			$year = func_get_arg(1);
		}
        return date('t', mktime(0, 0, 0, $month, 1, $year));
    } 
} 