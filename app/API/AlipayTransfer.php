<?php
namespace App\API;

use Alipay\OpenAPISDK\Api\AlipayFundTransUniApi;
use Alipay\OpenAPISDK\Util\AlipayConfigUtil;
use Alipay\OpenAPISDK\Util\Model\AlipayConfig;
use Alipay\OpenAPISDK\Util\Model\CustomizedParams;
use GuzzleHttp\Client;
use Alipay\OpenAPISDK\ApiException;
use Alipay\OpenAPISDK\Model\AlipayFundTransUniTransferDefaultResponse;
use Alipay\OpenAPISDK\Model\AlipayFundTransUniTransferModel;
use Alipay\OpenAPISDK\Model\AlipayFundTransUniTransferResponseModel;
use Alipay\OpenAPISDK\Model\SignData;
use Alipay\OpenAPISDK\Model\Participant;


class AlipayTransfer
{
    protected $apiInstance;
    public function init($company_id)
    {
        // 初始化SDK
        $alipayConfigUtil = new AlipayConfigUtil(self::getAlipayConfig($company_id));
        
        // 构造请求参数以调用接口
        $apiInstance = new AlipayFundTransUniApi(new Client());
        // 设置AlipayConfigUtil
        $apiInstance->setAlipayConfigUtil($alipayConfigUtil);
        $this->apiInstance = $apiInstance;
    }
    // data format: [
    //  order_no, amount, order_title, payee_account_no, payee_account_name, remark
    // ]
    public function transfer($pay_data)
    {    
        $data = new AlipayFundTransUniTransferModel();
        
        // 设置商家侧唯一订单号
        $data->setOutBizNo($pay_data['order_no']);
        
        // 设置订单总金额
        $data->setTransAmount($pay_data['amount']);
        
        // 设置描述特定的业务场景
        $data->setBizScene("DIRECT_TRANSFER");
        
        // 设置业务产品码
        $data->setProductCode("TRANS_ACCOUNT_NO_PWD");
        
        // 设置转账业务的标题
        $data->setOrderTitle($pay_data['order_title']);
        
        // 设置原支付宝业务单号
        // $data->setOriginalOrderId("20190620110075000006640000063056");
        
        // 设置收款方信息
        $payeeInfo = new Participant();
        // $payeeInfo->setCertType("IDENTITY_CARD");
        // $payeeInfo->setCertNo("1201152******72917");
        $payeeInfo->setIdentity($pay_data['payee_account_no']);
        $payeeInfo->setName($pay_data['payee_account_name']);
        $payeeInfo->setIdentityType("ALIPAY_LOGON_ID");
        $data->setPayeeInfo($payeeInfo);
        
        // 设置业务备注
        $data->setRemark($pay_data['remark']);
        
        // 设置转账业务请求的扩展参数
        // $data->setBusinessParams("{\"payer_show_name_use_alias\":\"true\"}");
        
        // try {
            $result = $this->apiInstance->transfer($data);
            if ($result['status'] == 'SUCCESS') {
                return true;
            } else {
                throw new Exception("transfer failed");
            }
        // } catch (ApiException $e) {
        //     \Log::debug($e->getMessage());
        //     \Log::debug($e->getResponseBody());
        // }
    }

    static private function getAlipayConfig($company_id)
    {
        $alipayConfig = new AlipayConfig();
        $alipayConfig->setServerUrl('https://openapi.alipay.com');

        $appid = trim(file_get_contents(base_path("cert/{$company_id}/appid")));
        $private_key = trim(file_get_contents(base_path("cert/{$company_id}/appCertPrivateKey.crt")));
        $alipayConfig->setAppId($appid);
        $alipayConfig->setPrivateKey($private_key);
        // 密钥模式
        // $alipayConfig->setAlipayPublicKey('alipay_public_key');
        // 证书模式
        $alipayConfig->setAppCertPath(base_path("cert/{$company_id}/appCertPublicKey.crt"));
        $alipayConfig->setAlipayPublicCertPath(base_path("cert/{$company_id}/alipayCertPublicKey_RSA2.crt"));
        $alipayConfig->setRootCertPath(base_path("cert/{$company_id}/alipayRootCert.crt"));
        // $alipayConfig->setEncryptKey('CuEbdrQRg1Yc7CILCqBtmA==');

        return $alipayConfig;
    }

}