<?php
/*
 * 渠道
 * 渠道积分每定时统计
*/
class App_App extends Base
{
	public function __construct()
	{
		parent::__construct();
	}	

	public function Index_Action()
	{
		$channel = $this->get('ch', 1,'intval');		
		$ip = IP;
		$agent = Http::agent();
		Http::set_session('channel', $channel);
		extract($agent);		
		$time = date('Y-m-d H:i');
		$data =  compact('channel', 'brand', 'os', 'model', 'ip', 'time');

		$redis = redis();
		//if($brand && $os)
		//{
			$key = md5($brand . $os . $model . $ip);
			if(!$redis()->hExists('channel', $key))
			{
				$redis()->hSet('channel', $key, json_encode($data)); // 渠道记录
			}
		//}
		$redis = redis();
		$redis()->zAdd('channel_click_' . date('Ym'), TIMESTAMP, json_encode($data));	// 点击记录		

		$url = ROOT;
		if(!empty($src))
		{
			$data['type'] = $src;
			$_Version = load_model('version')->order('id', 'Desc');
			if($src == 'ios'){ // Ios
				$url = Config::get('apple', 'download');
				$_Version->where('source', 2);
				$version = $_Version->Row();				
			}else // Android
			{
				$_Version->where('source', 1);
				$version = $_Version->Row();
				$from = strpos($_SERVER['HTTP_USER_AGENT'], "micromessenger") ? 'winxin' : '';
				if($from == 'winxin')
				{
					$url = Config::get('android', 'download');
				}else{					
					$url = $version['url'];
				}
			}
		}
		if($version)
		{
			$redis = redis(1); 	// 下载记录
			$data['version'] = $version['version'];			
			$redis()->zAdd('download_' . date('Ym'), TIMESTAMP, json_encode($data));
		}
		header('Location:' . $url);
		exit;		
	}
}