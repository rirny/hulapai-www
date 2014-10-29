<?php
/*
 * DESC : 机构信息
 * Author:fxd
 * Create TIme : 2014-05-15
 * Modify Time : 2014-05-15
*/

class School_Api extends Base
{
	public function __construact(){
		parent::__construact();		
	}
	
	public function Index_Action()
	{
		$page = $this->post('page', 'trim', '');
		$limit = $this->post('limit', 'trim', '');
		$school_model = load_model('school');
		$result = $school_model ->field('id,name,type,address,contact,phone,web,students,teachers,description,create_time')
			->limit($limit,$page)
			->result();
		$count = $school_model ->field('id')
			-> Count();
		if(!$result) throw new Exception("获取数据失败!");
		for($i = 0; $i < count($result); $i++)
		{
			$result[$i]['create_time'] = gmdate('Y-m-d', $result[$i]['create_time']);

			if($result[$i]['type'] == 1)
				$result[$i]['type'] = '私人机构';
			else if($result[$i]['type'] == 2)
				$result[$i]['type'] = '连锁机构';
			else
				$result[$i]['type'] = '网点';
		}
		die(json_encode(array('state' => 1, 'message' =>  $count ,'result' => $result)));
	}

	public function Add_Action()
	{
		$id			 =	 $this->post('id', 'trim', '');
		$code       = $this->post('id', 'trim', '');
		$name     =	$this->post('type', 'trim', '');
		$type       =	$this->post('type', 'trim', '');
		$address = $this->post('address', 'trim', '');
		$contact = $this->post('contact', 'trim', '');
		$phone   = $this->post('phone1', 'trim', '');
		$phone2   = $this->post('phone2', 'trim', '');
		$web   = $this->post('web', 'trim', '');
		$create_time = TIMESTAMP;
		$description = $this->post('description', 'trim', '');
		$students = $this->post('students', 'trim', '');
		$teachers = $this->post('teachers', 'trim', '');
		
		$id = load_model('school')
			->insert(compact(
			'name', 'code', 'type','address','contact','phone','web','description','create_time','students','teachers'	
		));	
		if(!$id) throw new Exception("添加数据失败!");
		$this->Out(1, 'success');
	}

	public function Update_Action()
	{
		$id			 =	$this->post('id', 'trim', '');
		$name     =	$this->post('type', 'trim', '');
		$type       =	$this->post('type', 'trim', '');
		$address = $this->post('address', 'trim', '');
		$contact = $this->post('contact', 'trim', '');
		$phone   = $this->post('phone', 'trim', '');
		$web   = $this->post('web', 'trim', '');
		$modify_time = TIMESTAMP;
		$description = $this->post('description', 'trim', '');
		$students = $this->post('students', 'trim', '');
		$teachers = $this->post('teachers', 'trim', '');

		$result = load_model('school')
			->where($id)
			->update(compact(
			'name','type','address','contact','phone','web','description','modify_time','students','teachers'	
		));

		if(!$result) throw new Exception("修改数据失败!");
		$this->Out(1, 'success', $result);
	}

	public function Delete_Action()
	{
		$id = $this->post('id', 'trim', '');
		if(!$id) $this->Out(0, 'failed');
		$result = load_model('school')
			->where($id)
			->delete();
		if(!$result) throw new Exception("删除数据失败!");
		$this->Out(1, 'success');	
	}

	public function Selectrow_Action()
	{
		$id  = $this -> post('id', 'trim','');
		$result = load_model('school')
			->field('id,code,name,type,address,contact,phone,web,students,teachers,description,create_time')
			->where($id)
			->Row();
		if(!$result) throw new Exception("获取数据失败!");

			if($result['type'] == 1)
				$result['type'] = '私人机构';
			else if($result['type'] == 2)
				$result['type'] = '连锁机构';
			else
				$result['type'] = '网点';
		$this->Out(1, 'success', $result);
	}

	public function Search_Action()
	{
		$key = $this -> post('key', 'trim','');
		$type = $this -> post('type', 'trim','');
		$result = load_model('school')
			->field('id,name,type,address,contact,phone,web,students,teachers,description,create_time')
			->where($type , $key)
			->result();
		if(!$result) throw new Exception("查询数据失败!");
		for($i = 0; $i < count($result); $i++)
		{
			$result[$i]['create_time'] = gmdate('Y-m-d', $result[$i]['create_time']);

			if($result[$i]['type'] == 1)
				$result[$i]['type'] = '私人机构';
			else if($result[$i]['type'] == 2)
				$result[$i]['type'] = '连锁机构';
			else
				$result[$i]['type'] = '网点';
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
		$school_model = load_model('school');
		$result = $school_model ->field('id,name,type,address,contact,phone,web,students,teachers,description,create_time')
			->where('create_time,>=', $btimestr)
			->where('create_time,<', $etime)
			->limit($limit,$page)
			->result();
		$count = $school_model ->field('id')
			-> Count();
		//if(!$result) throw new Exception("获取数据失败!");
		for($i = 0; $i < count($result); $i++)
		{
			$result[$i]['create_time'] = gmdate('Y-m-d', $result[$i]['create_time']);

			if($result[$i]['type'] == 1)
				$result[$i]['type'] = '私人机构';
			else if($result[$i]['type'] == 2)
				$result[$i]['type'] = '连锁机构';
			else
				$result[$i]['type'] = '网点';
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