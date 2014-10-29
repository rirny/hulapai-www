<?php
class Download_App extends Base
{
	public function __construct()
	{
		parent::__construct();
	}
	
	/*
	 * @src	ios|android
	 * @hd	true|flase 平板
	 * @os	系统区别
	*/
	public function Index_Action()
	{	
		$agent = Http::agent();		
		$src = $this->get('src', 'trim', 'android'); // ios iphone ipad android androidpad
		$hd = $this->get('hd', 'int', 0); // 0|1
		$v = $this->get('v', 'trim', ''); // 0|1
		$_Version = load_model('version')->order('id', 'Desc');
		empty($agent['src']) || $src = $agent['src']; // 手机访问		
		$channel = Http::get_session('channel', 0);
		$url = '';
		if($src == 'android')
		{
			$_Version->where('source', 1);
			if(strpos($_SERVER['HTTP_USER_AGENT'], "micromessenger"))
			{
				$url = Config::get($agent['src'], 'android');
			}			
		}else{
			$_Version->where('source', 2);
			$url = Config::get($agent['src'], 'ios');
		}
		$version = $_Version->Row();
		($version && $url == '') && $url = $version['url'];
		if($url == '')	show_error('Not Found!');
		
		// logs
		$redis = redis(1);
		$data = array_merge($agent, array(
			'channel' => 'web',
			'version' => $version['version'],
			'ip' => IP,
			'type' => $src,
			'tm' => date('Y-m-d H:i')
		));
		$redis()->zAdd('download_' . date('Ym'), time(), json_encode($data));
		if(!$url) show_error('操作错误！');			
		header("Location:".$url); 
		exit;
	}
}