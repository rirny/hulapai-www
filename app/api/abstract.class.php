<?php

define('SESS_UID', 'H_uid');
define('SESS_NAME', 'H_account');

Class Base Extends Controller
{
	protected $uid = 0;	
	protected $test = false;
	
	public $state = 1;
	public $message = 'success';
	public $result = '';

	public function __construct()
	{
		$this->verify();		
		$this->_session_init();
		$this->appSource = $this->post('appStore', 'string', '');
		$this->test = $this->post('test', 'int', 0);
	}

	public function _session_init()
	{
		$this->uid = Http::get_session(SESS_UID);
		$this->name = Http::get_session(SESS_NAME);
	}

	private function verify()
	{
		$tm = $this->post('tm', 'int', 0);
		$sign = $this->post('sign', 'trim', 0);
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
		if(TYPE == 'API' || Http::Ajax())
		{
			$result = array(
				'state' => $this->state,
				'message' => $this->message
			);
			empty($this->result) || $result['result'] = $this->result;
			die(json_encode($result));
		}else{
			$this->display($this->tpl);
		}
	}
}