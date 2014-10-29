<?php
Class Controller
{
	
	protected $db = Null;
	protected $message = '';
	protected $result = Null;
	protected $code = 0; // 正常
	protected $tpl = '';
	protected $ttl = '';

	public function __construct()
	{
		$this->_init();
	}

	public function __set($key, $value){
		if(isset($this->$key))
			$this->$key = $value;
	}

	public function __get($key){
		if(isset($this->$key))
			return $this->$key;
	}

	public function _init()
	{
		
	}

	// post
	public function post($key='', $filter='', $default=null)
	{
		if(!$key) return $default;
		return Http::post($key, $filter, $default);
	}

	// post
	public function request($key='', $filter='', $default=null)
	{
		if(!$key) return $default;
		return Http::request($key, $filter, $default);
	}

	// post
	public function get($key='', $filter='', $default=null)
	{
		if(!$key) return $default;
		return Http::get($key, $filter, $default);
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

	public function display($tpl, $ttl=0)
	{
		if(!$tpl) show_error('Tpl Not Found');
		$smarty = smarty();
		$config = Config::get(Null, 'system');
		$smarty->assign('root', ROOT);
		foreach($config as $key => $item)
		{
			$smarty->assign($key, $item);
		}
		$smarty->display($tpl . ".html", $ttl);
	}

	public function assign($key, $val=Null)
	{
		if(!$key || $val == Null) show_error('Params Assign Error!');
		$smarty = smarty();
		$smarty->assign($key, $val);
	}

	public function fetch($tpl)
	{
		if(!$tpl) show_error('Tpl Not Found');
		$smarty = smarty();
		$smarty->fetch($tpl . ".html");
	}

	public function response()
	{
		$result = array(
			'state' => $this->state,
			'message' => $this->message,
			'result' => $this->result
		);
		if(TYPE == 'API' || Http::Ajax())
		{
			die(json_encode($result));
		}else{
			$this->assign('webResult', $result);
			$this->display($this->tpl, $this->ttl=0);
		}
	}
}