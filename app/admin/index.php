<?php
/*
 * DESC : 首页
 * Author:lyl
 * Create TIme : 2014/6/11
 * Modify Time : 2014/6/11
*/
class Index_App Extends Base
{
	public function __construct()
	{
		parent::__construct();		
	}

	// 
	public function Index_Action()
	{
		$this->tpl = 'admin/index';
	}

	public function Login_Action()
	{
		if(Http::is_post())
		{

		}else{

			$this->tpl = 'admin/login';
		}
	}

	public function Logout_Action()
	{
		load_model('user')->logout();
	}
}