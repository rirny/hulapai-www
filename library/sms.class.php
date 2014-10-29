<?php
/**
 * (说明)
 * @abstract
 * @access public
 */
class SMS
{
	private $host = 'http://115.29.170.211:8085/sms.aspx';

	public function __construct()
	{
		$config = Config::get(Null, 'sms');	
		$this->host = $config['host'];
		$this->param = $config['param'];
	}

	public function send($phone, $message)
	{
		if(!$phone || !$message) Return false;
		$config = Config::get('send', 'sms');
		$config['mobile'] = $phone;
		$config['content'] = $message;	
		$param = array_merge($this->param, $config);
		$response = $this->_request($param);
		if($response && $response['returnstatus'] == 'Success')
		{
			Return true;
		}
		Return false;
	}

	private function _request($param)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->host);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);		
		if($output = curl_exec($ch))
		{
			Return (array)simplexml_load_string($output);
		}
		curl_close($ch);
		return false;
	}
}