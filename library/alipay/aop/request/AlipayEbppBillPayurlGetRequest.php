<?php
/**
 * ALIPAY API: alipay.ebpp.bill.payurl.get request
 *
 * @author auto create
 * @since 1.0, 2013-07-24 21:36:59
 */
class AlipayEbppBillPayurlGetRequest
{
	/** 
	 * 支付宝的业务订单号，具有唯一性。
	 **/
	private $alipayOrderNo;
	
	/** 
	 * 回调系统url
	 **/
	private $callbackUrl;
	
	/** 
	 * 输出机构的业务流水号，需要保证唯一性。
	 **/
	private $merchantOrderNo;
	
	/** 
	 * 支付宝订单类型。公共事业缴纳JF,信用卡还款HK。
	 **/
	private $orderType;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	
	public function setAlipayOrderNo($alipayOrderNo)
	{
		$this->alipayOrderNo = $alipayOrderNo;
		$this->apiParas["alipay_order_no"] = $alipayOrderNo;
	}

	public function getAlipayOrderNo()
	{
		return $this->alipayOrderNo;
	}

	public function setCallbackUrl($callbackUrl)
	{
		$this->callbackUrl = $callbackUrl;
		$this->apiParas["callback_url"] = $callbackUrl;
	}

	public function getCallbackUrl()
	{
		return $this->callbackUrl;
	}

	public function setMerchantOrderNo($merchantOrderNo)
	{
		$this->merchantOrderNo = $merchantOrderNo;
		$this->apiParas["merchant_order_no"] = $merchantOrderNo;
	}

	public function getMerchantOrderNo()
	{
		return $this->merchantOrderNo;
	}

	public function setOrderType($orderType)
	{
		$this->orderType = $orderType;
		$this->apiParas["order_type"] = $orderType;
	}

	public function getOrderType()
	{
		return $this->orderType;
	}

	public function getApiMethodName()
	{
		return "alipay.ebpp.bill.payurl.get";
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
