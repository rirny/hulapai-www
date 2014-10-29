<?php
/*
 * DESC : 老师
 * Author:lyl
 * Create TIme : 2014/7/15
 * Modify Time : 2014/7/15
*/
class Teacher_App Extends Base
{
	public function __construct()
	{
		parent::__construct();		
	}

	// 老师主页
	public function Index_Action()
	{
		if(!$this->is_login())  show_error('Not Login!');
		$user = load_model('user')->where('id', $this->uid)->Row();
		if(!$user) show_error('没有此用户！');
		$teacher = load_model('teacher')->where('user', $this->uid)->Row();
		if(!$teacher) show_error('没有此老师！');
		$flower = load_model('comment')->field('sum(flower)')
			->where('teacher', $this->uid)
			->where('character', 'student')
			->where('pid,>', 0)
			->where('create_time,>=', date('Y-m-d', time()-(3600*24*400)) . " 00:00:00")->limit(1)
			->Column();

		$this->result = array(
			'id' => $this->uid,
			'account' => $user['account'],
			'name' => $user['firstname'] . $user['lastname'],
			'flower' => $teacher['flower'],
			'today' => $flower
		);
	}	

	// 评价 记录
	public function Appraise_Action()
	{
		$teacher = $this->post('teacher', 'int', 0);
		if(!$teacher) show_error('老师不存在！');
		$_page = (int) Http::post('page', 'int', 0);
		$perpage = Http::post('per', 'int', 20);		
		$_page || $_page = 1;
		$_Comment = load_model('comment')
			->where('teacher', $teacher, true)
			->where('pid', 0)
			->where('event', 0)
			->where('character', 'student');
		$page = $_Comment->limit($perpage, $_page)->Page();
		$data = $_Comment->field('id,creator,event,teacher,student,content,attach,create_time,character')
			->order('create_time', 'desc')
			->limit($perpage, $_page)
			->Result();		
		$this->result = compact('page', 'data');
	}
	
	// 点评回复记录
	public function Reply_Action()
	{
		if(!$this->is_login())  show_error('Not Login!');		
		$_page = (int) Http::post('page', 'int', 0);
		$perpage = Http::post('per', 'int', 20);		
		$_page || $_page = 1;

		$_Comment = load_model('comment')
			->where('teacher', $this->uid, true)
			->where('pid,>', 0)
			->where('character', 'student');
		$page = $_Comment->limit($perpage, $_page)->Page();

		$data = $_Comment->field('id,pid,creator,event,teacher,student,content,attach,create_time,character,flower')
			->order('create_time', 'desc')
			->limit($perpage, $_page)
			->Result();

		$this->result = compact('page', 'data');
	}

	public function Feedback_Action()
	{
		if(!$this->is_login())  show_error('Not Login!');		
		$_page = (int) Http::post('page', 'int', 0);
		$perpage = Http::post('per', 'int', 20);		
		$_page || $_page = 1;
		$_Feedback = load_model('feedback')
			->where('to', $this->uid, true)
			->where('type', 2);
		$page = $_Feedback->limit($perpage, $_page)->Page();
		$data = $_Feedback->field('id,from,student,content,create_time,anonymous')
			->order('create_time', 'desc')
			->limit($perpage, $_page)
			->Result();

		array_walk($data, function(&$val){			
			$val['anonymous'] || $val['from'] = load_model('user')->field('id,account,firstname,lastname,avatar')->where('id', $val['from'], true)->Row();
		});
		$this->result = compact('page', 'data');
	}
}