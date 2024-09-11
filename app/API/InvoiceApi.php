<?php
namespace App\API;
use App\Request;

class InvoiceApi {
    private $apiUrl = 'https://h5pay.51fapiao.cn/shanxi/apis/'; // 请替换为你的API URL
    // 演示环境联调地址：https://h5pay.51fapiao.cn/shanxi/apis/
    // 生产环境联调地址：https://yunying.51fapiao.cn/shanxi/apis/

    private $privateKey; 
    // private $publicKey = 'your_public_key'; // 请替换为你的公钥
    // private $regCode = ""
    private $regCode = "37645355";
    private $zipCode = 0;
    private $encryptCode = 2;
    private $accessToken = "d968fb2474df7078f7033004dac02bdd2d3ba3381f7b86203929c4aa72ef2042";
    private $api;

    public function __construct()
    {
        $this->api = new Request($this->apiUrl);
        $this->privateKey = file_get_contents(base_path("51YFP001.cer"));
    }
    // 查询入网地区编码
    public function queryAreaCode() {
        return $this->sendRequest("access/merchant/accessAreaList", 'h5.pay.merchant.areacode', []);
    }

    // 经营地址地区编码查询
    public function queryAddressCode($province, $city) {
        $interfaceCode = 'h5.pay.merchant.address';
        $zipCode = '0'; // 不压缩
        $encryptCode = '2'; // CA加密

        $data = array(
            'merchantProvince' => $province,
            'merchantCity' => $city
        );
        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // 银行编码查询
    public function queryBankCode() {
        $interfaceCode = 'h5.pay.merchant.bankcode';
        $zipCode = '0'; // 不压缩
        $encryptCode = '2'; // CA加密

        $data = array(); // 不需要请求参数
        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // 入网产品信息查询
    public function queryProductInfo($licenceNo, $merchantProvince, $businessRole, $parentMerchantNo) {
        $interfaceCode = 'h5.pay.merchant.getproductinfo';
        $zipCode = '0'; // 不压缩
        $encryptCode = '2'; // CA加密

        $data = array(
            'licenceNo' => $licenceNo,
            'merchantProvince' => $merchantProvince,
            'businessRole' => $businessRole,
            'parentMerchantNo' => $parentMerchantNo
        );
        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // 商户入网
    public function merchantAccess($data) {
        $interfaceCode = 'h5.pay.merchant.access';
        $zipCode = '0'; // 不压缩
        $encryptCode = '2'; // CA加密

        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // 入网进度查询
    public function queryAccessProgress($data) {
        $interfaceCode = 'h5.pay.merchant.access.query';
        $zipCode = '0'; // 不压缩
        $encryptCode = '2'; // CA加密

        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // 入网回调通知
    public function accessCallbackNotify($data) {
        $interfaceCode = 'h5.pay.merchant.access.notify';
        $zipCode = '0'; // 不压缩
        $encryptCode = '2'; // CA加密

        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // 图片上传
    public function uploadImage($data) {
        $interfaceCode = 'h5.pay.merchant.upload.image';
        $zipCode = '0'; // 不压缩
        $encryptCode = '2'; // CA加密

        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // 商户信息查询接口
    public function merchantInfoQuery($data) {
        $interfaceCode = 'h5.pay.merchant.settled.query';
        $zipCode = '0';
        $encryptCode = '2';
        $accessToken = 'your_access_token';
        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // 入网成功商户信息查询接口
    public function successfulMerchantInfoQuery($data) {
        $interfaceCode = 'h5.pay.merchant.completed.query';
        $zipCode = '0';
        $encryptCode = '2';
        $accessToken = 'your_access_token';
        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // 授权免登录接口
    public function authFreeLogin($data) {
        $interfaceCode = 'h5.pay.accessToken.get';
        $zipCode = '0';
        $encryptCode = '2';
        $accessToken = 'your_access_token';
        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // 聚合支付统一下单接口
    public function unifiedOrder($data) {
        $interfaceCode = 'your_interface_code'; // replace with your actual interface code
        $zipCode = '0';
        $encryptCode = '2';
        $accessToken = 'your_access_token';
        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // $response = $api->queryOrder([
    //     'parentMerchantNo' => 'your_parent_merchant_no',
    //     'merchantNo' => 'your_merchant_no',
    //     'orderId' => 'your_order_id',
    // ]);
    public function queryOrder($data) {
        $interfaceCode = 'h5.pay.trade.order.query';
        $zipCode = '0';
        $encryptCode = '2';
        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }


    /*
    public function handlePaymentCallback() {
        $data = file_get_contents('php://input');
        $data = json_decode($data, true);
        if (!empty($data)) {
            // 判断支付状态
            if ($data['status'] === 'SUCCESS') {
                // 处理支付成功的逻辑
                // 这可以包括更新订单状态、发送支付确认邮件等
            } else {
                // 处理支付失败的逻辑
                // 这可以包括发送支付失败通知、记录失败原因等
            }
            // 返回成功响应
            $response = array(
                'code' => 1000,
            );
            echo json_encode($response);
        } else {
            // 处理接收到的数据为空的情况
            // 这可以包括记录错误、发送错误通知等
        }
    }
    */

    // $response = $api->applyRefund([
    //     'parentMerchantNo' => 'your_parent_merchant_no',
    //     'merchantNo' => 'your_merchant_no',
    //     'orderId' => 'your_order_id',
    //     'refundRequestId' => 'your_refund_request_id',
    //     'refundAmount' => 'your_refund_amount',
    // ]);
    public function applyRefund($data) {
        $interfaceCode = 'h5.pay.trade.refund';
        $zipCode = '0';
        $encryptCode = '2';
        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }


    // $response = $api->endRefund([
    //     'parentMerchantNo' => 'your_parent_merchant_no',
    //     'merchantNo' => 'your_merchant_no',
    //     'orderId' => 'your_order_id',
    //     'refundRequestId' => 'your_refund_request_id',
    // ]);
    public function endRefund($data) {
        $interfaceCode = 'h5.pay.trade.refund.end';
        $zipCode = '0';
        $encryptCode = '2';
        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    // $response = $api->queryRefund([
    //     'parentMerchantNo' => 'your_parent_merchant_no',
    //     'merchantNo' => 'your_merchant_no',
    //     'orderId' => 'your_order_id',
    //     'refundRequestId' => 'your_refund_request_id',
    // ]);
    public function queryRefund($data) {
        $interfaceCode = 'h5.pay.trade.refund.query';
        $zipCode = '0';
        $encryptCode = '2';
        return $this->sendRequest($interfaceCode, $zipCode, $encryptCode, $data);
    }

    public function sendRequest($interfaceUrl, $interfaceCode, $data) {
        $encryptData = $this->encryptData($data);
        debug("encrypt data: {$encryptData}");
        $signature = $this->generateSignature($interfaceCode, $data);
        debug("signature: {$signature}");
        $request = json_encode(array(
            "interfaceCode" => $interfaceCode,
            "zipCode" => $this->zipCode,
            "encryptCode" => $this->encryptCode,
            "access_token" => $this->accessToken,
            "datagram" => $encryptData,
            "signtype" => 'HMacSHA256',
            "signature" => $signature
        ));
        debug("post ".$this->apiUrl . $interfaceUrl);
        debug($request);
        return $this->api->post($interfaceUrl, $request, "json");
        //
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $this->apiUrl . $interfaceUrl);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
        // $output = curl_exec($ch);
        // curl_close($ch);
        // return json_decode($output);
    }

    private function encryptData($data) {
        if ($this->encryptCode != "2") {
            throw new Exception("Unsupported encryption code: $encryptCode");
        }
        $encrypted = openssl_encrypt(json_encode($data), 'RSA', $this->privateKey);
        // $encrypted = openssl_encrypt(json_encode($data), 'AES-256-CBC', $this->privateKey, OPENSSL_CIPHER_AES_256_CBC);
        debug("encrypt: {$encrypted}");
        if ($this->zipCode == "1") {
            return base64_encode(gzcompress($encrypted));
        } elseif ($this->zipCode == "2") {
            return base64_encode(openssl_encrypt(base64_encode(gzcompress(json_encode($data))), 'RSA', $this->privateKey, OPENSSL_PKCS1_PADDING));
        } else {
            return base64_encode($encrypted);
        }
    }

    private function generateSignature($interfaceCode, $data) {
        $message = $interfaceCode . $this->zipCode . $this->encryptCode . $this->accessToken . json_encode($data);
        return hash_hmac('sha256', $message, $this->regCode);
    }

    private function encrypt7sign($cer, $pfx, $password, $plaintext, $path)
    {
        
    }
}
