<?php
/**
 * ALIPAY API: alipay.pass.code.verify request
 *
 * @author auto create
 * @since 1.0, 2013-10-30 17:12:23
 */
class AlipayPassCodeVerifyRequest
{
	/** 
	 * 商户核销操作扩展信息
	 **/
	private $extInfo;
	
	/** 
	 * 操作员id
如果operator_type为1，则此id代表核销人员id
如果operator_type为2，则此id代表核销机具id
	 **/
	private $operatorId;
	
	/** 
	 * 操作员类型
1 核销人员
2 核销机具
	 **/
	private $operatorType;
	
	/** 
	 * Alipass对应的核销码串
	 **/
	private $verifyCode;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	
	public function setExtInfo($extInfo)
	{
		$this->extInfo = $extInfo;
		$this->apiParas["ext_info"] = $extInfo;
	}

	public function getExtInfo()
	{
		return $this->extInfo;
	}

	public function setOperatorId($operatorId)
	{
		$this->operatorId = $operatorId;
		$this->apiParas["operator_id"] = $operatorId;
	}

	public function getOperatorId()
	{
		return $this->operatorId;
	}

	public function setOperatorType($operatorType)
	{
		$this->operatorType = $operatorType;
		$this->apiParas["operator_type"] = $operatorType;
	}

	public function getOperatorType()
	{
		return $this->operatorType;
	}

	public function setVerifyCode($verifyCode)
	{
		$this->verifyCode = $verifyCode;
		$this->apiParas["verify_code"] = $verifyCode;
	}

	public function getVerifyCode()
	{
		return $this->verifyCode;
	}

	public function getApiMethodName()
	{
		return "alipay.pass.code.verify";
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
