<?php
/*
 * DESC : 用户信息
 * Author:gjp
 * Create TIme : 2014-05-15
 * Modify Time : 2014-05-15
*/

class Student_Api extends Base
{
	public function __construact(){
		parent::__construact();		
	}
	
	public function Index_Action()
	{
		$page = $this->post('page', 'trim', '');
		$limit = $this->post('limit', 'trim', '');
		$student_model = load_model('student');
		$result = $student_model ->field('id,name,nickname,gender,classes,absence,leave,create_time,parent_name,phone')
			->limit($limit,$page)
			->result();
		$count = $student_model ->field('id')
			->Count();

		if(!$result) throw new Exception("获取数据失败!");
		for($i = 0; $i < count($result); $i++)
		{	
			if($result[$i]['gender'] == 0) 
				$result[$i]['gender'] = '未知';
			else if($result[$i]['gender'] == 1) 
				$result[$i]['gender'] = '男';
			else if($result[$i]['gender'] == 2) 
				$result[$i]['gender'] = '女';  
			$result[$i]['create_time'] = gmdate('Y-m-d', $result[$i]['create_time']);
		}
		die(json_encode(array('state' => 1, 'message' =>  $count ,'result' => $result)));
	}
	public function Add_Action()
	{
		$this->Out(1, 'success');
	}

	public function Selectrow_Action()
	{
		$id  = $this -> post('id', 'trim','');
		$student_model = load_model('student');
		$result = $student_model ->field('id,name,nickname,gender,classes,absence,leave,create_time,parent_name,phone')
			->where($id)
			->Row();
		if($result['gender'] == 0) 
			$result['gender'] = '未知';
		else if($result['gender'] == 1) 
			$result['gender'] = '男';
		else if($result['gender'] == 2) 
			$result['gender'] = '女';  
		$result['create_time'] = gmdate('Y-m-d', $result['create_time']);
		die(json_encode(array('state' => 1, 'message' =>  'success' ,'result' => $result)));
	}

	public function Update_Action()
	{
		$this->Out(1, 'success');
	}

	public function Delete_Action()
	{
		$this->Out(1, 'success');	
	}

	public function Search_Action()
	{
		$key = $this -> post('key', 'trim','');
		$type = $this -> post('type', 'trim','');
		$result = load_model('student') ->field('id,name,nickname,gender,classes,absence,leave,create_time,parent_name,phone')
			->where($type , $key)
			->result();
		if(!$result) throw new Exception("查询数据失败!");
		for($i = 0; $i < count($result); $i++)
		{
			if($result[$i]['gender'] == 0) 
				$result[$i]['gender'] = '未知';
			else if($result[$i]['gender'] == 1) 
				$result[$i]['gender'] = '男';
			else if($result[$i]['gender'] == 2) 
				$result[$i]['gender'] = '女';  
			$result[$i]['create_time'] = gmdate('Y-m-d', $result[$i]['create_time']);
		}
		die(json_encode(array('state' => 1, 'message' =>  'success' ,'result' => $result)));
	}

	public function  Increase_Action()
	{
		$btime = date('Y-m-d'.'00:00:00',time());
		$btimestr = strtotime($btime);
		$etime = $btimestr + 3600 * 24;

		$page = $this->post('page', 'trim', '');
		$limit = $this->post('limit', 'trim', '');
		$student_model = load_model('student');
		$result = $student_model ->field('id,name,nickname,gender,classes,absence,leave,create_time,parent_name,phone')
			->where('create_time,>=', $btimestr)
			->where('create_time,<', $etime)
			->limit($limit,$page)
			->result();
		$count = $student_model ->field('id')
			->Count();

		if(!$result) throw new Exception("获取数据失败!");
		for($i = 0; $i < count($result); $i++)
		{	
			if($result[$i]['gender'] == 0) 
				$result[$i]['gender'] = '未知';
			else if($result[$i]['gender'] == 1) 
				$result[$i]['gender'] = '男';
			else if($result[$i]['gender'] == 2) 
				$result[$i]['gender'] = '女';  
			$result[$i]['create_time'] = gmdate('Y-m-d', $result[$i]['create_time']);
		}
		die(json_encode(array('state' => 1, 'message' =>  $count ,'result' => $result)));
	}

	public function Order_Action()
	{

	}

	public function Remark_Action()
	{

	}

}
?>