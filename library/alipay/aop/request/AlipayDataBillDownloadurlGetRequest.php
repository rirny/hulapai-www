<?php
/**
 * ALIPAY API: alipay.data.bill.downloadurl.get request
 *
 * @author auto create
 * @since 1.0, 2013-04-27 20:19:20
 */
class AlipayDataBillDownloadurlGetRequest
{
	/** 
	 * 账单时间：日账单格式为yyyy-MM-dd,月账单格式为yyyy-MM
	 **/
	private $billDate;
	
	/** 
	 * 账单类型，目前支持的类型有：air
	 **/
	private $billType;

	private $apiParas = array();
	private $terminalType;
	private $terminalInfo;
	private $prodCode;
	
	public function setBillDate($billDate)
	{
		$this->billDate = $billDate;
		$this->apiParas["bill_date"] = $billDate;
	}

	public function getBillDate()
	{
		return $this->billDate;
	}

	public function setBillType($billType)
	{
		$this->billType = $billType;
		$this->apiParas["bill_type"] = $billType;
	}

	public function getBillType()
	{
		return $this->billType;
	}

	public function getApiMethodName()
	{
		return "alipay.data.bill.downloadurl.get";
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
