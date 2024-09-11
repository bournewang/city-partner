<?php
namespace App\API;
use App\Request;

class Token{
    static public function getToken()
    {
        $url = "https://digi.aisino.com";
        $taxpayerId = "91440300MADGN5FA1C";
        $authCode = "M25M75GF6X";
        $regCode = "37645355";
        debug("auth code: $authCode, register code: $regCode");
        $authorizationCode = strtoupper(hash_hmac("sha256", $authCode, $regCode));
        debug("authorizationCode: $authorizationCode");
        $data = [
            "userName"      => "DJTL0001",
            "taxpayerId"    =>  $taxpayerId,
            "terminalId"    => 0,
            "signtype"      => "HMacSHA256",
            "authorizationCode" => $authorizationCode,
            "timestamp"     => now()->format('YmdHis'),
            // "signature": "签名值"
        ];
        $plain = implode('', array_values($data));
        $sign = strtoupper(hash_hmac("sha256", $plain, $regCode));
        debug("plain: $plain");
        debug("signature: $sign");
        $data['signature'] = $sign;

        $api = new Request($url);
        debug("post {$url}/accessToken/v1.0/get");
        debug(json_encode($data));
        $res = $api->post("/accessToken/v1.0/get", $data, "json");
        debug($res);
        if (($res['code'] ?? null) == 1000) {
            return $res['access_token'] ?? null;
        }
        return null;
    }
}
