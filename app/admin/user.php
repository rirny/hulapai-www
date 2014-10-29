<?php
/*
 * DESC : 用户信息
 * Author:fxd
 * Create TIme : 2014-05-12
 * Modify Time : 2014-05-12
*/

class User_Api extends Base
{
	public function __construact(){
		parent::__construact();		
	}
	
	public function Index_Action()
	{
		$page = $this->post('page', 'trim', '');
		$limit = $this->post('limit', 'trim', '');
		$user_model = load_model('user');
		$result = $user_model->field('id,account,name,nickname,create_time,last_login_time,login_times')
			->where('id>2')
			->limit($limit,$page)
			->result();

		$count = $user_model ->field('id')
					->	Count();

		if(!$result) throw new Exception("获取数据失败!");
		$student_model = load_model('user_student');
		$teacher_model = load_model('teacher');
		$school_model = load_model('school');
		for($i = 0; $i < count($result); $i++)
		{
			$result[$i]['create_time'] = gmdate('Y-m-d', $result[$i]['create_time']);
			$result[$i]['last_login_time'] = gmdate('Y-m-d', $result[$i]['last_login_time']);
 
			$tc_res = $teacher_model ->field('id')
						->where('user',$result[$i]['id'],true)
						->Row();
			if($tc_res) $result[$i]['is_teacher'] = '是'; 
			else $result[$i]['is_teacher'] = '否';

			$s_res = $student_model ->field('user')
						->where('user',$result[$i]['id'],true)
						->Row();
			if($s_res) $result[$i]['is_student'] = '是'; 
			else $result[$i]['is_student'] = '否';

			$sc_res	= $school_model ->field('id')
						->where('creator',$result[$i]['id'],true)
						->Row();
			if($sc_res) $result[$i]['is_school'] = '是';
			else $result[$i]['is_school'] = '否';
		}
		die(json_encode(array('state' => 1, 'message' =>  $count ,'result' => $result)));
	}

	public function Add_Action()
	{
		//$data = $this->post('data', 'trim', '');
		//if(!$data) $this->Out(0, 'failed');
		$data = array('nickname' => 'fxd', 'password' => '222222');
		var_dump($data);
		$nickname = $data['nickname'];
		$password =  md5($data['password']);
		$create_time  = TIMESTAMP;
		$last_login_time = TIMESTAMP;
		$login_times = 1;
		$status = 1;

		$id = load_model('user')
			->insert(compact(
			'nickname', 'password', 'create_time', 'last_login_time', 'login_times'			
		));	
		if(!$id) throw new Exception("添加数据失败!");
		$this->Out(1, 'success');
	}

	public function Update_Action()
	{
		$account     =	$this->post('account', 'trim', '');
		$name			 =	 $this->post('name', 'trim', '');
		$nickname  =  $this->post('nickname', 'trim', '');
		$password   =  $this->post('password', 'trim', '');
		$id				 =  $this->post('id', 'trim', '');
		if(!$id	) $this->Out(0, 'failed');
		$result = load_model('user')
			->where($id)
			->update(compact(
			'nickname', 'password', 'account', 'name'			
		));
		if(!$result) throw new Exception("修改数据失败!");
		$this->Out(1, 'success', $result);
	}

	public function Delete_Action()
	{
		$id = $this->post('id', 'trim', '');
		if(!$id) $this->Out(0, 'failed');
		$result = load_model('user')
			->where($id)
			->delete();
		if(!$result) throw new Exception("删除数据失败!");
		$this->Out(1, 'success', $result);	
	}

	public function Search_Action()
	{
		$key = $this -> post('key', 'trim','');
		$type = $this -> post('type', 'trim','');
		$result = load_model('user')
			->where($type , $key)
			->result();
		//if(!$result) throw new Exception("查询数据失败!");
		$student_model = load_model('user_student');
		$teacher_model = load_model('teacher');
		$school_model = load_model('school');
		for($i = 0; $i < count($result); $i++)
		{
			$result[$i]['create_time'] = gmdate('Y-m-d', $result[$i]['create_time']);
			$result[$i]['last_login_time'] = gmdate('Y-m-d', $result[$i]['last_login_time']);
 
			$tc_res = $teacher_model ->field('id')
						->where('user',$result[$i]['id'],true)
						->Row();
			if($tc_res) $result[$i]['is_teacher'] = '是'; 
			else $result[$i]['is_teacher'] = '否';

			$s_res = $student_model ->field('user')
						->where('user',$result[$i]['id'],true)
						->Row();
			if($s_res) $result[$i]['is_student'] = '是'; 
			else $result[$i]['is_student'] = '否';

			$sc_res	= $school_model ->field('id')
						->where('creator',$result[$i]['id'],true)
						->Row();
			if($sc_res) $result[$i]['is_school'] = '是';
			else $result[$i]['is_school'] = '否';
		}
		die(json_encode(array('state' => 1, 'message' =>  'success' ,'result' => $result)));
	}

	public function Selectrow_Action()
	{
		$id  = $this -> post('id', 'trim','');
		$result = load_model('user')
			->field('id,nickname,account,firstname,lastname,hulaid,gender,email,birthday,city,area,province,address,agent,create_time,last_login_time,login_times')
			->where($id)
			->Row();
		if(!$result) throw new Exception("获取数据失败!");

		$student_model = load_model('student');
		$teacher_model = load_model('teacher');
		$school_model = load_model('school');
		$student_record_model = load_model('user_student');
		//$teacher_record_model = load_model('user_student');
		$school_record_model = load_model('course_teacher');
		$result['province'] = getaddr($result['province']);
		$result['city'] = getaddr($result['city']);
		$result['area'] = getaddr($result['area']);
		
		$result['create_time'] = gmdate('Y-m-d', $result['create_time']);
		$result['last_login_time'] = gmdate('Y-m-d', $result['last_login_time']);
		if($result['gender'] == 0) 
			$result['gender'] = '未知';
		else if($result['gender'] == 1) 
			$result['gender'] = '男';
		else if($result['gender'] == 2) 
			$result['gender'] = '女';  

		if($result['agent'] == 0) 
			$result['agent'] = '网站';
		else if($result['agent'] == 1) 
			$result['agent'] = '手机网页';
		else if($result['agent'] == 2) 
			$result['agent'] = 'android';
		else if($result['agent'] == 3) 
			$result['agent'] = 'ios';

		$rec_res = $student_record_model -> field('student,relation')
					-> where('user',$result['id'])
					->result();

		if($rec_res)
		{
			for($i = 0; $i < count($rec_res); $i++)
			{
				$stu_record =  $student_model -> where($rec_res[$i]['student'])
							-> Row();
				$result['stu_record'][$i]['name'] = $stu_record['name'];
				if($rec_res[$i]['relation'] == 1) 
					$result['stu_record'][$i]['relation'] = '本人';
				else if($rec_res[$i]['relation'] == 2) 
					$result['stu_record'][$i]['relation'] = '爸爸';
				else if($rec_res[$i]['relation'] == 3) 
					$result['stu_record'][$i]['relation'] = '妈妈';
				else if($rec_res[$i]['relation'] == 4) 
					$result['stu_record'][$i]['relation'] = '其他';
				$result['stu_record'][$i]['classes'] = $stu_record['classes'];
				$result['stu_record'][$i]['absence'] = $stu_record['absence'];
				$result['stu_record'][$i]['leave'] = $stu_record['leave'];
				$result['stu_record'][$i]['parent_name'] = $stu_record['parent_name'];
				$result['stu_record'][$i]['phone'] = $stu_record['phone'];
			}
		}
		
		$tc_res = $teacher_model ->where('user',$result['id'],true)
					->Row();
		$sr_res = $school_record_model -> field('remark')
					-> where('teacher',$result['id'])
					->Row();
		if($tc_res)
		{
			$result['is_teacher'] = '1'; 
			$result['teacher_background'] = $tc_res['background'];
			$result['teacher_mind']			 = $tc_res['mind'];
			$result['teacher_classes']			 = $tc_res['classes'];
			$result['teacher_comments']    = $tc_res['comments'];
			if($sr_res) 
				$result['teacher_record']		 = $sr_res['remark'];
		}

		$s_res = $student_record_model -> field('user')
					->where('user',$result['id'],true)
					->Row();
		if($s_res) 
		{	
			$result['is_student'] = '1'; 
			$stm  = $student_model ->where('creator',$result['id'],true)
				-> Row();
			if($stm)
			{
				$result['student_name']	  = $stm['name'];
				$result['student_classes']	  = $stm['classes'];
				$result['student_absence'] = $stm['absence'];
				$result['student_leave']	  = $stm['leave'];
				$result['parent_name']		  = $stm['parent_name'];
				$result['student_phone']	  = $stm['phone'];
			}
		}

		$sc_res	= $school_model->where('creator',$result['id'],true)
					->result();
		if($sc_res) 
		{	
			for($i = 0; $i < count($sc_res); $i++)
			{
				$result['is_school'] = '1'; 
				$result['school'][$i]['name']						= $sc_res[$i]['name'];
				$result['school'][$i]['code']						= $sc_res[$i]['code'];
				$result['school'][$i]['pid']							= $sc_res[$i]['pid'];
				if($sc_res[$i]['type'] == 1)		  $result['school'][$i]['type']		= '私人机构';
				else if($sc_res[$i]['type'] == 2)  $result['school'][$i]['type']		= '连锁机构';
				else if($sc_res[$i]['type'] == 3)  $result['school'][$i]['type']		= '网点';
				$result['school'][$i]['contact']					= $sc_res[$i]['contact'];
				$result['school'][$i]['phone']					= $sc_res[$i]['phone'];
				$result['school'][$i]['phone2']					= $sc_res[$i]['phone2'];
				$result['school'][$i]['students']				= $sc_res[$i]['students'];
				$result['school'][$i]['teachers']				= $sc_res[$i]['teachers'];
				$result['school'][$i]['web']						= $sc_res[$i]['web'];
			}
		}

		$this->Out(1, 'success', $result);
	}

	public function Increase_Action()
	{
		$btime = date('Y-m-d'.'00:00:00',time());
		$btimestr = strtotime($btime);
		$etime = $btimestr + 3600 * 24;

		$page = $this->post('page', 'trim', '');
		$limit = $this->post('limit', 'trim', '');
		$user_model = load_model('user');
		$result = $user_model->field('id,account,name,nickname,create_time,last_login_time,login_times')
			->where('create_time,>=', $btimestr)
			->where('create_time,<', $etime)
			->limit($limit,$page)
			->result();

		$count = $user_model ->field('id')
					->	Count();

		//if(!$result) throw new Exception("获取数据失败!");
		$student_model = load_model('user_student');
		$teacher_model = load_model('teacher');
		$school_model = load_model('school');
		for($i = 0; $i < count($result); $i++)
		{
			$result[$i]['create_time'] = gmdate('Y-m-d', $result[$i]['create_time']);
			$result[$i]['last_login_time'] = gmdate('Y-m-d', $result[$i]['last_login_time']);
 
			$tc_res = $teacher_model ->field('id')
						->where('user',$result[$i]['id'],true)
						->Row();
			if($tc_res) $result[$i]['is_teacher'] = '是'; 
			else $result[$i]['is_teacher'] = '否';

			$s_res = $student_model ->field('user')
						->where('user',$result[$i]['id'],true)
						->Row();
			if($s_res) $result[$i]['is_student'] = '是'; 
			else $result[$i]['is_student'] = '否';

			$sc_res	= $school_model ->field('id')
						->where('creator',$result[$i]['id'],true)
						->Row();
			if($sc_res) $result[$i]['is_school'] = '是';
			else $result[$i]['is_school'] = '否';
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
