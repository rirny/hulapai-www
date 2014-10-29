<?php
Class Base Extends Controller
{
	protected $uid = 0;	

	public function __construct()
	{
		$this->verify();
		$this->_session_init();
		$this->appSource = $this->post('appStore', 'string', '');
	}

	public function _session_init()
	{
		$this->uid = Http::get_session(SESSION_PEFIX . 'UID');
		$this->name = Http::get_session(SESSION_PEFIX . 'NAME');
	}

	private function verify()
	{
		$tm = $this->post('tm', 'int', 0);
		$sign = $this->post('sign', 'trim', 0);
		return true;
	}

	// 验证登录
	public function is_login()
	{
		if(!$this->uid) return false;
		return true;
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
	

	protected function getError()
	{
		return $error_message;
	}
	
	
	protected function assign($key, $value)
	{
		$this->_smarty();
		$this->smarty->assign($key, $value);
	}

	protected function display($tpl, $tm=0)
	{	
		$this->_smarty();		
		$tpl = $tpl . ".html";
		if($this->smarty->templateExists($tpl))
		{
			$this->smarty->display($tpl);
		}else
		{
			throw new HLPException('模板文件不存在！<BR/>' . $tpl, 404);
		}
		exit;
	}

	protected function fetch($tpl, $tm)
	{
		$this->_smarty();
		return $this->smarty->fetch($tpl . ".html");
	}

	protected function cache($key, $value, $tm)
	{
	
	}

	private function _smarty()
	{	
		if($this->smarty == Null)
		{			
			require_once(LIB. '/Smarty/Smarty.class.php');			
			$this->smarty = new Smarty;
			$this->smarty->caching = SMARTY_CACHEING;
			$this->smarty->template_dir = SMARTY_TPL_DIR;
			$this->smarty->compile_dir = SMARTY_COMPILE_DIR;
			$this->smarty->cache_dir = SMARTY_CACHE_DIR;
			$this->smarty->left_delimiter = '<!--{';
			$this->smarty->right_delimiter = '}-->';

			$this->smarty->assign('ROOT', ROOT);
			$this->smarty->assign('STATIC_PATH', STATIC_PATH);
			$this->smarty->assign('JS', ROOT . "/static/js");
			$this->smarty->assign('IMG', ROOT . "/static/images");
			$this->smarty->assign('CSS', ROOT . "/static/css");			
			$this->smarty->assign('curl', Http::curl());		
		}
	}

	protected function jump($path = '/')
	{
		header("Location:" . $path);
	}
}