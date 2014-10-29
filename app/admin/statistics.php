<?php
/*
 * DESC : 数据统计
 * Author:fxd
 * Create TIme : 2014-05-27
 * Modify Time : 2014-05-27
*/

class Statistics_Api extends Base
{
	public function __construact(){
		parent::__construact();		
	}

	public function index_Action(){
		$btime = date('Y-m-d'.'00:00:00',time());
		$btimestr = strtotime($btime);
		$oneday = 3600 * 24;
		$etime = $btimestr + $oneday;
		$data = array();

		$sql = 'select count(id) from report_'.date('Ym' ,time()).'.'.'log_'.date('Ymd' ,time()).';';
		$db = db();
		$result_arr  = $db -> fetchRow($sql);
		$data['login_count'] = $result_arr['count(id)'];
		
		$user = load_model('user');
		$result = $user ->Count();
		$data['user_count']  = $result;
		$result = $user->field('create_time')
			->Count();
		$data['register_count'] = $result;

		$result = $user->field('create_time')
			->where('create_time,>=', $btimestr)
			->where('create_time,<', $etime)
			->Count();
		$data['new_register_count'] = $result;
		
		$teacher = load_model('teacher');
		$result = $teacher ->Count();
		$data['teacher_count'] = $result;

		$result = $teacher ->field('create_time')
			->where('create_time,>=', $btimestr)
			->where('create_time,<', $etime)
			->Count();
		$data['new_teacher_count'] = $result;

		$school = load_model('school');
		$result = $school ->Count();
		$data['school_count'] = $result;

		$result = $school ->field('create_time')
			->where('create_time,>=', $btimestr)
			->where('create_time,<', $etime)
			->Count();
		$data['new_school_count'] = $result;

 		$student = load_model('student');
		$result = $student ->Count();
		$data['student_count'] = $result;

		$result = $student ->field('create_time')
			->where('create_time,>=', $btimestr)
			->where('create_time,<', $etime)
			->Count();
		$data['new_student_count'] = $result;

		$fetime = 	date('Y-m-d'.'00:00:00',strtotime('+1 day'));
		$comment = load_model('comment');
		$result = $comment ->Count();
		$data['comment_count'] = $result;

		$result = $comment->field('create_time')
			->where('create_time,>=', $btime)
			->where('create_time,<', $etime)
			->Count();
		$data['new_comment_count'] = $result;
		
		$course = load_model('course');
		$result = $course ->Count();
		$data['course_count'] = $result;

		$result = $course ->field('create_time')
			->where('create_time,>=', $btimestr)
			->where('create_time,<', $etime)
			->Count();

		$data['new_course_count'] = $result;

		if(!$data) throw new Exception("修改数据失败!");
		$this->Out(1, 'success', $data);
	}

	public function charts_Action(){
		echo 'charts';
	}

	public function login_Action(){
		$fetime = 	date('Ym',strtotime('-1 month'));
		$db = db();
		$arr = explode(' ' , $btime);
		$arr = explode('-' , $arr[0]);
		$sql = 'select count(id) from report_'.date('Ym' ,time()).'.'.'log_'.date('Ymd' ,time()).';';
		$result_arr  = $db -> fetchRow($sql);
	}

	public function register_Action(){
		$test = date('Y-m-d H:i:s' ,time());
		//echo $test;
		$jjtime = strtotime('-2 month');
		$btime = date('Y-m-d 00:00:00',time());
		$arr = array();
		$arr = explode(' ' , $btime);
		$arr = explode('-' , $arr[0]);
		$btimestr = strtotime($btime);
		$sendArr = array();
		$etime = $btimestr + 3600 * 24;
		$webNum = $iosNum =  $andriodNum  = 0; 
		for($i=$arr[2]; $i>0; $i--)
		{
			$webNum = $iosNum =  $andriodNum = 0;
			$user_model = load_model('user');
			$result = $user_model->field('id,agent')
				->where('create_time,>=', $jjtime)
				->where('create_time,<', $etime)
				->result();
			for($i = 0; $i < count($result); $i++)
			{
				if($result[$i]['agent'] == 0) $webNum++;
				if($result[$i]['agent'] == 2) $iosNum++;
				if($result[$i]['agent'] == 3) $andriodNum++;
			}
			$etime = $btimestr;
			$btimestr -= 3600 * 24;
			$data = [$i ,$webNum,$iosNum,$andriodNum];
			array_unshift($sendArr,$data);
		}
		//var_dump($sendArr);
		die(json_encode(array('state' => 1, 'message' =>  'success' ,'result' => $sendArr)));
	}
}
