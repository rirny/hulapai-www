<?php
/*
 * DESC : 预约信息
 * Author:fxd
 * Create TIme : 2014-06-03
 * Modify Time : 2014-06-03
*/

class Reservation_Api extends Base
{
	public function __construact(){
		parent::__construact();		
	}
	
	public function Index_Action()
	{
		$page = $this->post('page', 'trim', '');
		$limit = $this->post('limit', 'trim', '');
		$student_resourse_model = load_model('student_resource');
		$result = $student_resourse_model ->field('creator,name,school,parents,create_time,desc,ext')
			->where('status' , '4')
			->where('ext,<>' , '')
			->limit($limit,$page)
			->result();
		$count = $student_resourse_model ->field('id')
			-> Count();
		if(!$result) throw new Exception("获取数据失败!");
		$school_model = load_model('school');
		$course_model = load_model('course');
		for($i = 0; $i < count($result); $i++)
		{
			$result[$i]['create_time'] = datetime('', $result[$i]['create_time']);
			$school_result = $school_model -> field('name,province,city,area,address,contact,phone')
				->where('id', $result[$i]['school'], true)
				->Row();
			$course_result = $course_model -> field('title')
				->where('id', $result[$i]['ext'], true)
				->Row();
			$parent = json_decode($result[$i]['parents']);
		
			$relation = $parent[0] -> relation;
			if($relation == 1) 
				$result[$i]['relation'] = '本人';
			else if($relation == 2) 
				$result[$i]['relation'] = '爸爸';
			else if($relation == 3) 
				$result[$i]['relation'] = '妈妈';
			else if($relation == 4) 
				$result[$i]['relation'] = '其他';
			$result[$i]['record_name'] = $parent[0] -> name;
			$result[$i]['student_phone'] = $parent[0] -> phone;
			$result[$i]['course_name']  = $course_result['title'];
			$result[$i]['school_name'] = $school_result['name'];
			$result[$i]['area'] = getaddr($school_result['province']). getaddr($school_result['city']). getaddr($school_result['area']);
			$result[$i]['address']   = $school_result['address'];
			$result[$i]['contact']   = $school_result['contact'];
			$result[$i]['phone']     = $school_result['phone'];
		}
		die(json_encode(array('state' => 1, 'message' =>  $count ,'result' => $result)));
	}

	public function Add_Action()
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
		$result = load_model('student_resource')
			->field('creator,name,school,parents,create_time,desc,ext')
			->where($type , $key)
			->result();
		if(!$result) throw new Exception("查询数据失败!");
		for($i = 0; $i < count($result); $i++)
		{
			$result[$i]['create_time'] = datetime('', $result[$i]['create_time']);
			$school_result = $school_model -> field('name,province,city,area,address,contact,phone')
				->where('id', $result[$i]['school'], true)
				->Row();
			$course_result = $course_model -> field('title')
				->where('id', $result[$i]['ext'], true)
				->Row();
			$parent = json_decode($result[$i]['parents']);
		
			$relation = $parent[0] -> relation;
			if($relation == 1) 
				$result[$i]['relation'] = '本人';
			else if($relation == 2) 
				$result[$i]['relation'] = '爸爸';
			else if($relation == 3) 
				$result[$i]['relation'] = '妈妈';
			else if($relation == 4) 
				$result[$i]['relation'] = '其他';
			$result[$i]['record_name'] = $parent[0] -> name;
			$result[$i]['student_phone'] = $parent[0] -> phone;
			$result[$i]['course_name']  = $course_result['title'];
			$result[$i]['school_name'] = $school_result['name'];
			$result[$i]['area'] = getaddr($school_result['province']). getaddr($school_result['city']). getaddr($school_result['area']);
			$result[$i]['address']   = $school_result['address'];
			$result[$i]['contact']   = $school_result['contact'];
			$result[$i]['phone']     = $school_result['phone'];
		}
		die(json_encode(array('state' => 1, 'message' =>  'success' ,'result' => $result)));
	}

	public function Order_Action()
	{
		$this->Out(1, 'success');
	}
}
