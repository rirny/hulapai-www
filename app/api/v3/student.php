<?php
/*
 * DESC : 学生
 * Author:lyl
 * Create TIme : 2014/6/11
 * Modify Time : 2014/6/11
*/
class Student_App Extends Base
{
	public function __construct()
	{
		parent::__construct();		
	}	

	/* 说明: 学生点评记录(对学生的点评+课堂点评)
	 * @event 课程(具体的一节课)
	 * @student 查看当前学生的课堂点评
	*/
	public function Comment_Action()
	{
		if(!$this->is_login())  show_error('Not Login!');
		$student = $this->post('student', 'int', 0);
		if(!$student) show_error('学生不存在！');
		$_page = (int) Http::post('page', 'int', 0);
		$perpage = Http::post('per', 'int', 20);
		$_page || $_page = 1;
		$_Comment = load_model('comment')
			->where('student', $student, true)
			->where('pid', 0)			
			->where('character', 'teacher');
		$page = $_Comment->limit($perpage, $_page)->Page();
		$data = $_Comment->field('id,creator,event,teacher,student,content,attach,create_time,character,flower')
			->order('create_time', 'desc')
			->limit($perpage, $_page)
			->Result();
		$this->result = compact('page', $data);
	}
}