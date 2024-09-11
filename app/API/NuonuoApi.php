<?php
namespace App\API;
use Buqiu\Invoice\InvoiceSDK;

class NuonuoApi {
    private $sdk;
    private $token;
    public function __construct()
    {
        $this->sdk = new InvoiceSDK(config('invoice'));
        $this->token = env("NUONUO_TOKEN");
    }

    public function create($index, $goodsName, $price, $taxRate, $num = 1)
    {
        return $this->request("nuonuo.OpeMplatform.requestBillingNew", [
            "buyerName" => "Mr Wang",
            "orderNo" => date("Ymd").sprintf("%05d", $index),
            "invoiceDate" => now()->toDateTimeString(),
            "pushMode" => 1,
            "email" => "xiaopei0206@icloud.com",
            "invoiceType" => 1,
            "goodsName" => $goodsName,
            "price" => $price,
            "num" => 1,
            "taxRate" => $taxRate,
            "withTaxFlag" => 1
        ]);
    }

    public function query($serialNo)
    {
        return $this->request("nuonuo.OpeMplatform.queryInvoiceResult", [
            "serialNos" => $serialNo,
            "isOfferInvoiceDetail" => 1
        ]);
    }

    public function preorder($order_no, $goodsName, $goodsNum, $amount, $openId)
    {
        $data = [
            "amount" => $amount, // String	Y	0.01		支付金额支付金额必须不大于999999999.99且小数位数为两位
            "subject" => $goodsName, // String	Y	测试支付	100	交易商品名称
            "goodsListItem" => [
                ["amount" => $amount, "goodsName" => $goodsName, "goodsNum" => $goodsNum]
            ], // Array	Y			开票商品列表
            "deptId" => "1", // String	Y		50	部门id
            "userid" => $openId, // String	Y	2088702292854236	100	用户标识
            // timeExpire	String	N	5		订单有效时间（必须是1-120之间的整数）
            "sellerNote" => $goodsName, // String	Y	测试	255	商家备注
            "payType" => "WECHAT", // String	Y	ALIPAY		支付类型（只能是WECHAT/ALIPAY）
            "appid" => env('WECHAT_MINIAPP_ID'), // String	Y	wxd51f8fef5c0fc8d1	36	小程序appid
            "notifyUrl" => env('APP_URL').'api/wxapp/notify', // String	Y	http://www.baidu.com	255	支付完成异步通知地址
            "appKey" => config("invoice.app_key"), // String	Y	ASD125FAA	100	开放平台分配给应用的appKey
            "taxNo" => config("invoice.tax_num"), // String	Y	339901999999142	50	商户税号
            "customerOrderNo" => $order_no, // String	Y	20221114092116250017	64	商户订单号
            // "openid" => "oWCUh7R2lH6kNoWMoIDm5GpMFrsg"
        ];
        $body = json_encode($data);
        $sendid = md5($body);

        return $this->sdk->sendPostSyncRequest($sendid, $this->token, "nuonuo.AggregatePay.miniprogramsquery", $body);

        // return $this->request("nuonuo.AggregatePay.miniprogramsquery", $data);
    }

    private function request($method, $data)
    {
        $body = $this->sdk->getBody($data, $method); // 获取过滤参数
        // echo "body: {$body}";
        $sendid = md5($body);

        return $this->sdk->sendPostSyncRequest($sendid, $this->token, $method, $body);
    }
}
