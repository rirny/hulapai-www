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
		$this->tpl = 'www/index';
	}
}