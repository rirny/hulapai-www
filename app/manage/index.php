<?php
class Index_App extends BASE
{
	public function __construact(){		
		parent::__construact();		
	}
	
	public function index_Action()
	{
		$this->display('manage/index');
	}

	public function login_Action()
	{
		if($this->uid)
		{
			// show_error('已登录！', 500);
			$this->jump();
		}
		if(!Http::is_post())
		{
			$this->display('manage/login');
		}else{
			$username = $this->post('username', 'trim', '');
			$password = $this->post('password', 'trim', '');
			if(!$username) show_error('请输入用户名', 600);
			if(!$password) show_error('请输入密码', 600);
			$_USER = load_model('user');
			$User = $_USER->where(array('account' => $username, 'priv' => 1))->Row();		
			if($User['password'] != md5(md5($password) . $User['salt'])) show_error('密码错误！', 600);
			if(!$_USER->login($User)) show_error('登录失败', 600);
			$this->jump('/');
		}
	}
}