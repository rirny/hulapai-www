<?php
/*
 * DESC : 电话管理
 * Author:fxd
 * Create TIme : 2014-06-05
 * Modify Time : 2014-06-05
*/

class Phone_Api extends Base
{
	public function __construact(){
		parent::__construact();		
	}
	
	public function Index_Action()
	{
		$page = $this->post('page', 'trim', '');
		$limit = $this->post('limit', 'trim', '');
		$phone_model = load_model('phone_record');
		$result = $phone_model -> field('user,school,phone,from,create_time')
			->limit($limit,$page)
			->result();
		
		$count = $phone_model -> field('id')
			->Count();
		$school_model = load_model('school');
		$user_model = load_model('user');
		if(!$result) throw new Exception("获取数据失败!");
		for($i = 0; $i < count($result); $i++)
		{
			$result[$i]['create_time'] = datetime('',$result[$i]['create_time']);
			$school_result = $school_model -> field('name,province,city,area,address,contact')
				->where('phone',$result[$i]['phone'],true)
				->Row();
			$result[$i]['school_name'] =   $school_result['name'];
			$result[$i]['province']		  =	getaddr($school_result['province']);
			$result[$i]['area']				  =	getaddr($school_result['area']);
			$result[$i]['city']				  =	getaddr($school_result['city']);
			$result[$i]['address']          =    $school_result['address'];
			$result[$i]['contact']           =   $school_result['contact'];
			$user_result = $user_model -> field('firstname, lastname')
				->where('id' ,$result[$i]['user'], true)
				->Row();
			$result[$i]['user_name'] =  $user_result['firstname'].$user_result['lastname'];
		}
		die(json_encode(array('state' => 1, 'message' =>  $count ,'result' => $result)));
	}

	public function Add_Action()
	{
		$this->Out(1, 'success');
	}

	public function Update_Action()
	{
		$this->Out(1, 'success');
	}

	public function Delete_Action()
	{
		$id = $this->post('id', 'trim', '');
		if(!$id) $this->Out(0, 'failed');
		$result = load_model('phone_record')
			->where($id)
			->delete();
		if(!$result) throw new Exception("删除数据失败!");
		$this->Out(1, 'success', $result);	
	}

	public function Search_Action()
	{
		$key = $this -> post('key', 'trim','');
		$type = $this -> post('type', 'trim','');
		$result = load_model('phone_record')
			->field('user,school,phone,from,create_time')
			->where($type , $key)
			->result();
		if(!$result) throw new Exception("查询数据失败!");
		for($i = 0; $i < count($result); $i++)
		{
			$result[$i]['create_time'] = datetime('',$result[$i]['create_time']);
			$school_result = $school_model -> field('name,province,city,area,address,contact')
				->where('phone',$result[$i]['phone'],true)
				->Row();
			$result[$i]['school_name'] =   $school_result['name'];
			$result[$i]['province']		  =	getaddr($school_result['province']);
			$result[$i]['area']				  =	getaddr($school_result['area']);
			$result[$i]['city']				  =	getaddr($school_result['city']);
			$result[$i]['address']          =    $school_result['address'];
			$result[$i]['contact']           =   $school_result['contact'];
			$user_result = $user_model -> field('firstname, lastname')
				->where('id' ,$result[$i]['user'], true)
				->Row();
			$result[$i]['user_name'] =  $user_result['firstname'].$user_result['lastname'];
		}
		die(json_encode(array('state' => 1, 'message' =>  'success' ,'result' => $result)));
	}

	public function Order_Action()
	{

	}

	public function Remark_Action()
	{

	}

}