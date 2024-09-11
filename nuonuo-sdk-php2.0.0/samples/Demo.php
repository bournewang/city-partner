<?php

require_once __DIR__ . "/../lib/Api.php";

/**
 * 
 * 调用例子
 * @author liqiao
 *
 */
class Demo
{
	/**
	 * 
	 * ISV 发票校验接口调用示例
	 */
	public function CheckEInvoice() 
	{
		$appKey 	= config("NUONUO_APP_KEY");
     	$appSecret 	= config("NUONUO_APP_SECRET");
    	$token   	= config("NUONUO_TOKEN");// please store the token and refresh it before expired
    	$taxnum  	= config("NUONUO_TAX_NUM");
    	$url = "https://sandbox.nuonuocs.cn/open/v1/services"; // change to online domain
    	$method = "nuonuo.electronInvoice.CheckEInvoice"; // change to your method
		$senid = uniqid(); // generate your meaningful senid
		$body = json_encode(
			array(
				"invoiceSerialNum" => array("your.voicecode")
			)
		);

		$res = Api::sendPostSyncRequest($url, $senid, $appKey, $appSecret, $token, $taxnum, $method, $body);
		return $res;
	}

	public function getMerchantToken() {
		$appKey = "your.appKey";
		$appSecret = "your.appSecret";
		$res = Api::getMerchantToken($appKey, $appSecret);
		return $res;
	}

	public function getISVToken() {
		$appKey = "your.appKey";
		$appSecret = "your.appSecret";
		$code = "your.code";
		$taxnum = "your.merchant.taxnum";
		$redirectUri = "your.redirectUri";
		$res = Api::getISVToken($appKey, $appSecret, $code, $taxnum, $redirectUri);
		return $res;
	}

	public function refreshISVToken() {
		$refreshToken = "your.token";
		$appSecret = "your.appSecret";
		$userId = "your.userId";
		$res = Api::refreshISVToken($refreshToken, $userId, $appSecret);
		return $res;
	}
}

$demo = new Demo();
$res = $demo->CheckEInvoice();
var_dump($res);

$res = $demo->getMerchantToken();
var_dump($res);

$res = $demo->getISVToken();
var_dump($res);

$res = $demo->refreshISVToken();
var_dump($res);