<?php
return [
    'app_id'            => env('ALIPAY_APP_ID'),
    'private_key'       => env('ALIPAY_PRIVATE_KEY'),
    // 密钥模式
    // 'alipay_public_key' => env('ALIPAY_PUBLIC_KEY'), 
    // 证书模式
    'app_cert_path'     => env('ALIPAY_APP_CERT_PATH'),
    'public_cert_path'  => env('ALIPAY_PUBLIC_CERT_PATH'),
    'root_cert_path'    => env('ALIPAY_ROOT_CERT_PATH'),
    'encrypt_key'       => env('ALIPAY_ENCRYPT_KEY'),
];