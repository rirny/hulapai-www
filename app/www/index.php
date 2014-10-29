<?php
class Index_App extends Base
{
	public function __construct()
	{
		parent::__construct();
	}

	public function Index_Action()
	{
		$agent = Http::agent();
		if(!empty($agent['src']))
		{
			$this->tpl = 'www/wap/index'; 
		}else{
			$this->tpl = 'www/index';
		}
	}

	public function Wap_Action()
	{
		$this->assign('agent', Http::agent());
		$this->tpl = 'wap/index';
	}

	public function Company_Action()
	{
		$this->tpl = 'www/company';
	}

	public function Contact_Action()
	{
		$this->tpl = 'www/contact';
	}

	public function Guide_Action()
	{		
		$this->assign('result', $this->_help());
		$this->tpl = 'www/guide';
	}

	private function _help()
	{
		$key = "help";
		$result = cache()->get($key);
		if($result === false || $this->cache == false)
		{
			$db = db('cms');
			$sql = "select v.*,c.content from v9_hulapai v left join v9_hulapai_data c on v.id=c.id where catid=16";
			$result = $db->fetchAll($sql);
			$result && cache()->set($key, $result, 86400);
		}
		return $result;
	}

	public function Guide_video_Action()
	{			
		$source = Array(
			Array(
				'name' => '登录注册',
				'poster' => SYS_STATIC . '/video/school/login.jpg',
				'source' => SYS_STATIC .'/video/school/login.flv'
			),
			Array(
				'name' => '基本信息',
				'poster' => SYS_STATIC .'/video/school/base.jpg',
				'source' => SYS_STATIC .'/video/school/base.flv'
			),
			Array(
				'name' => '教师管理',
				'poster' => SYS_STATIC .'/video/school/teacher.jpg',
				'source' => SYS_STATIC .'/video/school/teacher.flv'
			),
			Array(
				'name' => '教学工具',
				'poster' => SYS_STATIC .'/video/school/tool.jpg',
				'source' => SYS_STATIC .'/video/school/tool.flv'
			),
			Array(
				'name' => '教学管理',
				'poster' => SYS_STATIC .'/video/school/edu.jpg',
				'source' => SYS_STATIC .'/video/school/edu.flv'
			),
			Array(
				'name' => '权限管理',
				'poster' => SYS_STATIC .'/video/school/priv.jpg',
				'source' => SYS_STATIC .'/video/school/priv.flv'
			),
			Array(
				'name' => '学生管理',
				'poster' => SYS_STATIC .'/video/school/student.jpg',
				'source' => SYS_STATIC .'/video/school/student.flv'
			)
		);
		$this->assign('result', $this->_help());
		$this->assign('source', $source);
		$this->assign('sourceObj', json_encode($source));
		$this->tpl = 'www/guide.video';
	}
}