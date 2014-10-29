<?php
Class Base Extends Controller
{
	protected $uid = 0;	

	public function __construct()
	{
		$this->verify();
		$this->_session_init();
		$this->appSource = $this->post('appStore', 'string', '');
		$this->test = $this->post('test', 'int', 0);	
				// throw new Exception('promise', 501);
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
	

	public function Out($state=1, $message='sucess', $result = Array())
	{
		$source = Http::getSource() == 'ios' ? 1 : 0;
		if($result && is_array($result) && $source)
		{
			$result = iosFormat($result);
		}
		die(json_encode(array(
			'state' => $state,
			'message' => $message,
			'result' => $result
		)));
	}

	// 0 json 1、web
	public function _json_out()
	{		
		$source = Http::getSource() == 'ios' ? 1 : 0;
		if($this->result && is_array($this->reuslt) && $source)
		{
			$this->result = iosFormate($this->result);
		}
		die(json_encode(array(
			'state' => $this->code,
			'message' => $this->message,
			'result' => $this->result
		)));
	}
}