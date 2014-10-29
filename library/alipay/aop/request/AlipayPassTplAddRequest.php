<?php
/**
 * ALIPAY API: alipay.pass.tpl.add request
 *
 * @author auto create
 * @since 1.0, 2014-05-12 19:27:40
 */
class AlipayPassTplAddRequest
{
	/** 
	 * 支付宝pass模版内容【JSON格式】
具体格式可参考https://alipass.alipay.com中文档中心-格式说明
	 **/
	private $tplContent;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	
	public function setTplContent($tplContent)
	{
		$this->tplContent = $tplContent;
		$this->apiParas["tpl_content"] = $tplContent;
	}

	public function getTplContent()
	{
		return $this->tplContent;
	}

	public function getApiMethodName()
	{
		return "alipay.pass.tpl.add";
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}

	public function getTerminalType()
	{
		return $this->terminalType;
	}

	public function setTerminalType($terminalType)
	{
		$this->terminalType = $terminalType;
	}

	public function getTerminalInfo()
	{
		return $this->terminalInfo;
	}

	public function setTerminalInfo($terminalInfo)
	{
		$this->terminalInfo = $terminalInfo;
	}

	public function getProdCode()
	{
		return $this->prodCode;
	}

	public function setProdCode($prodCode)
	{
		$this->prodCode = $prodCode;
	}
}
