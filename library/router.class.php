<?php
class Router
{
	public static $app = 'index';
	public static $act = 'index';
	public static $appFile = '';
	public static $appPath = '';

	/*
	 * Url
	 * /controller?
	 * /controller/action?
	 * /action?
	 * /dir/../controller?
	 * /dir/controller/action?
	 * /dir/../action?
	 * 
	 * 寻址方式先找目录
	 * 
	*/

	public static function adapter($type = 'web')
	{
		if($type == 'api')
		{
			$code = Http::request('version', 'int', 0);
			self::$app = Http::request('app', 'string', 'index');
			self::$act = Http::request('act', 'string', 'index');
			if(!self::$app || !self::$act) show_error('Not Found');
			$cache_key = 'Api_' . self::$app . "_" . self::$act . "_" . $code;		
			$version = cache()->get($cache_key); // => V1、V2
			self::$appPath = APP_PATH;			
			if($version === false)
			{
				$version = load_model('api', array('prefix' => 'sys_'))
						->where('app', self::$app)
						->where('action', self::$act)
						->where('code', $code)
						->where('status', 1)
						->field('code')
						->limit(1)
						->order('code', 'Desc')
						->Column();				
				cache()->set($cache_key, $version); // 后台更新				
			}			
			if($version)
			{		
				self::$appPath .= "/v" . $version;				
				if(self::$app != 'index' && !is_file(self::$appPath . "/" . self::$app . ".php"))
				{
					self::$appPath .= "/index.php";
				}else
				{
					self::$appPath .= "/" . self::$app . ".php";
				}
			}else{
				self::rewrite();  // 默认到第一版接口
			}
		}else if($type == 'cli'){
			self::client();		
		}else{
			$uri = substr($_SERVER['REQUEST_URI'], 1);
			$arguments = parse_url($uri);
			self::$appPath = APP_PATH;
			self::fetch($argument);
			self::$appPath .= self::$app . ".php";
		}
	}

	private static function fetch($argument)
	{
		if(!$argument) return ;
		if(substr($argument, -1, 1) == '/') $argument = substr($argument, 0, strlen($argument)-1);
		if(is_dir(self::$appPath ."/". $argument)) // 目录优先 dir/app => 1、dir/app/index.php 2、dir/app.php 3、dir.php?act=app
		{
			self::$appPath .= "/" . $argument;
		}else{
			$pathArr = explode("/", $argument);
			$app = array_pop($pathArr);
			empty($pathArr) || self::$appPath .=  "/". join("/", $pathArr);
			if(is_file(self::$appPath ."/". $app . ".php")){
				self::$app = $app;
			}else{
				self::$act = $app;
			}
		}
	}

	private static client()
	{
		
	}

	private static function rewrite()
	{
		$post = Http::post();		
		$ch = curl_init();

		//
		$cookie_file = CONF ."/cookie.txt";

		$config = Config::get(Null, 'session');
		$session_name = $config['name'];
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$host = Config::get('apiHost', 'system');
		curl_setopt($ch, CURLOPT_URL, $host);
		$cookie = !empty($_COOKIE[$session_name]) ? $_COOKIE[$session_name] : "";
		// $header[]= 'User-Agent: ' . $_SERVER['HTTP_USER_AGENT'];
		$header = Array();
		isset($_SERVER['HTTP_DEVICE']) && $header[]= 'DEVICE: '. $_SERVER['HTTP_DEVICE'];
		
		// $header[]= 'Cookie: '. $session_name . "=" . $cookie;	

		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_COOKIE, $session_name . "=" . $cookie);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_COOKIESESSION, true);
		
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

		$res = curl_exec($ch);
		$curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
		curl_close($ch);
		if($curl_errno)
		{
			show_error('Not Found:' . $curl_error, 0);
		}
		die($res);
	}
}