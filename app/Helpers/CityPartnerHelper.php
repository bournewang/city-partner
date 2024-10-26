<?php

namespace App\Helpers;
use App\Models\Company;
use App\Models\Challenge;
use App\Models\Tx;
use App\API\AlipayTransfer;
use Alipay\OpenAPISDK\ApiException;

class CityPartnerHelper
{
    // data format: [
    // 'amount'
    // 'remark'
    // 'shop_account_no',
    // 'shop_account_name',
    // 'developer_account_no',
    // 'developer_account_name',
    // 'county_agent_account_no',
    // 'county_agent_account_name',
    // 'city_agent_account_no',
    // 'city_agent_account_name',
    // ]
    static public function transferOrder($order, $data)
    {
        $user = $order->user;
        $company = $user->referer->company;
        $splits = self::splitProfit($user, $company, $data);
        \Log::debug($splits);

        $transfer = new AlipayTransfer();
        $transfer->init($company->id);

        foreach ($splits as $item) {
            \Log::debug("create tx for " . $item['type']);
            // create tx
            
            $tx = Tx::create([
                'user_id'           => $user->id,
                'from_company_id'   => $company->id,
                'to_company_id'     => $item['type'] == 'company' ? $company->id : null,
                'to_account_no'     => $item['account_no'],
                'to_account_name'   => $item['account_name'],
                'order_id'          => $order->id,
                'type'              => Tx::PROFIT,
                'amount'            => $item['amount'],
                'original_amount'   => $data['amount'],
                'profit_percent'    => $item['percent'],
                'profit_level'      => $item['type'],
                'status'            => $item['type'] == 'company' ? Tx::PAID : Tx::CREATED,
            ]);
            \Log::debug("tx: " .$tx->id);
            try{    
                if ($item['type'] != 'company') {
                    $success = $transfer->transfer([
                        'order_no' => $tx->id, 
                        'amount' => $item['amount'], 
                        'order_title' => $data['remark'], 
                        'payee_account_no' => $item['account_no'], 
                        'payee_account_name' => $item['account_name'],
                        'remark' => $item['type'] != 'shop' ? '分润' : ''
                    ]);
                    if ($success) {
                        $tx->update(['status' => Tx::PAID]);
                    }
                }
            } catch(ApiException $e) {
                \Log::debug($e->getMessage());
            }
        }
    }

    static public function splitProfit($user, $company, $data)
    {
        $array = [];
        $config = config('city-partner'); //['profit_split'];
        // $user->referer
        $amount = $data['amount'];
        
        // if ($config['alipay_account_no']) {
        $percent = $config['profit_split']['shop'];
        $array[] = [
            'type'          => 'shop',
            'account_no'    => $data['shop_account_no'],
            'account_name'  => $data['shop_account_name'],
            'percent'       => $percent,
            'amount'        => round($amount * $percent / 100, 2)
        ];

        if ($config['alipay_account_no'] && $config['alipay_account_name']) {
            $array[] = [
                'type'          => 'consumer_platform',
                'account_no'    => $config['alipay_account_no'],
                'account_name'  => $config['alipay_account_name'],
                'percent'       => $config['profit_split']['consumer_platform'],
                'amount'        => round($amount * $config['profit_split']['consumer_platform'] / 100, 2)
            ];
        }
        if ($user->referer->alipay_account_no) {
            $array[] = [
                'type'          => 'consumer_manager',
                'account_no'    => $user->referer->alipay_account_no,
                'account_name'  => $user->referer->name,
                'percent'       => $config['profit_split']['consumer_manager'],
                'amount'        => round($amount * $config['profit_split']['consumer_manager'] / 100, 2)
            ];
        }

        foreach (['developer', 'county_agent', 'city_agent'] as $agent) {
            if (!($data[$agent . '_account_no'] ?? null) || 
                !($data[$agent . '_account_name'] ?? null)) 
                continue;
            $percent = $config['profit_split'][$agent];
            $array[] = [
                'type'  => $agent,
                'account_no' => $data[$agent . '_account_no'],
                'account_name' => $data[$agent . '_account_name'],
                'percent' => $percent,
                'amount' => round($amount * $percent / 100, 2)
            ];
        }

        $totalAmount = array_sum(array_column($array, 'amount'));
        $percent = $config['profit_split']['company'];
        $array[] = [
            'type'          => 'company',
            'account_no'    => $company->alipay_account_no,
            'account_name'  => $company->alipay_account_name,
            'percent'       => $percent,
            'amount'        => round($amount - $totalAmount, 2)
        ];

        return $array;
    }

}