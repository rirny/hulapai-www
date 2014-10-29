<?php
class User_App extends BASE
{
	public function __construact(){		
		parent::__construact();		
	}
	
	public function index_Action()
	{
		$this->display('manage/user/index');
	}

	public function new_Action()
	{
		$this->display('manage/user/new');
	}
}