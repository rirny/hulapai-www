<?php
/*
 * DESC : 用户信息
 * Author:fxd
 * Create TIme : 2014-05-15
 * Modify Time : 2014-05-15
*/

class Teacher_Api extends Base
{
	public function __construact(){
		parent::__construact();		
	}
	
	public function Index_Action()
	{
		$page = $this->post('page', 'trim', '');
		$limit = $this->post('limit', 'trim', '');
		$teacher_model = load_model('teacher');
		$user_model = load_model('user');

		$result = $teacher_model -> field('id,user,background,mind,classes,comments,create_time')
			->limit($limit,$page)
			->result();
		$count = $teacher_model ->field('id')
			-> Count();
		
		if(!$result) throw new Exception("获取数据失败!");
		for($i = 0; $i < count($result); $i++)
		{
			$user_res = $user_model  ->  field('name,mobile')
				->where('id', $result[$i]['user'], true)
				->Row();
			$result[$i]['name'] = $user_res['name'];
			$result[$i]['mobile'] = $user_res['mobile'];
			$result[$i]['create_time'] = gmdate('Y-m-d', $result[$i]['create_time']);
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
		$result = load_model('teacher')
			->where($id)
			->delete();
		if(!$result) throw new Exception("删除数据失败!");
		$this->Out(1, 'success', $result);	
	}

	public function Search_Action()
	{
		$key = $this -> post('key', 'trim','');
		$type = $this -> post('type', 'trim','');
		
		$user_model = load_model('user');
		$teacher_model = load_model('teacher');
		$result	= $user_model  ->field('id,name,mobile')
			->where($type , $key)
			->result();

		for($i = 0; $i < count($result); $i++)
		{	
			$tc_res = $teacher_model ->field('id,background,mind,classes,comments,create_time')
				->where('user' , $result[$i]['id'], true)
				->Row();
			$result[$i]['id'] = $tc_res['id'];
			$result[$i]['background'] = $tc_res['background'];
			$result[$i]['mind'] = $tc_res['mind'];
			$result[$i]['classes'] = $tc_res['classes'];
			$result[$i]['comments'] = $tc_res['comments'];
			$result[$i]['create_time'] = gmdate('Y-m-d', $tc_res['create_time']);
		}
		if(!$result) throw new Exception("查询数据失败!");
		die(json_encode(array('state' => 1, 'message' =>  'success' ,'result' => $result))); 
	}

	public function Selectrow_Action()
	{
		$id = $this -> post('id', 'trim','');
		$user_model = load_model('user');
		$course_model = load_model('course_teacher');
		$result = load_model('teacher')
			->field('id,user,background,mind,classes,comments,create_time')
			->where($id)
			->Row();
		$ct_res = $course_model -> field('remark')
			-> where('teacher',$result['user'])
			->Row();

		$user_res = $user_model  ->  field('name,mobile')
			->where($result['user'])
			->Row();
		$result['course'] = $ct_res['remark'];
		$result['name'] = $user_res['name'];
		$result['mobile'] = $user_res['mobile'];
		$result['create_time'] = gmdate('Y-m-d', $result['create_time']);
		if(!$result) throw new Exception("查询数据失败!");
		$this->Out(1, 'success', $result);	
	}

	public function  Increase_Action()
	{
		$btime = date('Y-m-d'.'00:00:00',time());
		$btimestr = strtotime($btime);
		$etime = $btimestr + 3600 * 24;

		$page = $this->post('page', 'trim', '');
		$limit = $this->post('limit', 'trim', '');
		$teacher_model = load_model('teacher');
		$user_model = load_model('user');

		$result = $teacher_model -> field('id,user,background,mind,classes,comments,create_time')
			->where('create_time,>=', $btimestr)
			->where('create_time,<', $etime)
			->limit($limit,$page)
			->result();
		$count = $teacher_model ->field('id')
			-> Count();
		
		if(!$result) throw new Exception("获取数据失败!");
		for($i = 0; $i < count($result); $i++)
		{
			$user_res = $user_model  ->  field('name,mobile')
				->where('id', $result[$i]['user'], true)
				->Row();
			$result[$i]['name'] = $user_res['name'];
			$result[$i]['mobile'] = $user_res['mobile'];
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
