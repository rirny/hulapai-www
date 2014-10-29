<?php

define('SESS_UID', 'uid');
define('SESS_NAME', 'name');
define('SESS_ACCOUNT', 'account');
define('SESS_HLAID', 'hlaid');

Class Base Extends Controller
{
	protected $uid = 0;	
	protected $test = false;
	
	public $state = 0;
	public $message = '';
	public $result = '';

	public $cache = false;

	public function __construct()
	{
		$this->_session_init();
		// $this->appSource = $this->post('appStore', 'string', '');
		// $this->logs();

		$tm = $this->get('tm', 'int', 0);
		if($tm) $this->cache = true;
	}

	public function _session_init()
	{		
		$this->uid = Http::get_session(SESS_UID);
		$this->name = Http::get_session(SESS_NAME);

		foreach(Http::agent() as $key => $item)
		{
			$this->$key = $item;
		}
	}

	private function verify()
	{
		$tm = $this->post('tm', 'int', 0);
		$sign = $this->post('sign', 'trim', 0);
	}

	private function logs()
	{
		$redis = redis();
		$key = 'logs_' . date('YM'); // 访问日志 <list>
		$post = $this->post();
		$get = $this->get();
		unset($post['version'], $post['timestamp']);
		unset($get['version'], $get['timestamp']);
		$redis()->RPUSH($key, array(
			'domain' => DOMAIN,
			'app' => APP,
			'action' => ACTION,
			'post' => $this->post(),
			'get' => $this->get(),
			'version' => $this->post('version', 'trim', ''),
			'time' => TIMESTAMP
		));
		return true;
	}

	// 验证登录
	public function is_login()
	{		
		if(!$this->uid) return false;
		return true;
	}
	

	public function Out($state=1, $message='', $result = Array())
	{
		$source = Http::getSource() == 'ios' ? 1 : 0;
		if($result && is_array($result) && $source)
		{
			$result = iosFormat($result);
		}
		$this->state = $state;
		$this->message = $message;
		$this->result = $result;
	}

	public function response()
	{
		if(TYPE == 'API' || Http::is_Ajax())
		{
			die(json_encode(array(
				'state' => $this->state,
				'message' => $this->message,
				'result' => $this->result
			)));
		}else{
			$this->display($this->tpl);
		}
	}
}