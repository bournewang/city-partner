<?php

return [
    "execute_partner" => "深圳市千百惠投资管理有限公司",
    "bank_account" => [
        "name" => "广西东家通路消费侧发展有限公司深圳分公司",
        "account_no" => "4102 11000 4004 1710",
        "bank" => "中国农业银行股份有限公司深圳东塘支行"
    ],
    "receive_qrcode" => env('APP_URL').("/images/receive-qrcode.jpg"),
    "profit_split" => [
        // in percent %
        'shop'              => 85,
        'company'           => 10,
        'consumer_manager'  => 1,
        'consumer_platform' => 2,
        'developer'         => 0.5,
        'county_agent'      => 1,
        'city_agent'        => 0.5
    ],
    'alipay_account_no' => env('ALIPAY_ACCOUNT_NO'),
    'alipay_account_name' => env('ALIPAY_ACCOUNT_NAME'),
];
