<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\User;
use App\Models\Order;
use App\Models\Tx;
use App\Helpers\CityPartnerHelper;
use App\Jobs\PaymentTransfer;
use Illuminate\Support\Facades\DB;
// use App\Models\CrowdFunding;
// use App\Helpers\UserHelper;
// use App\Wechat;

class WalletController extends AppBaseController
{
    protected $user;
    const mobileRules = [
        'mobile'    => 'required|string|size:11',
    ];
    const consumeRules = [
        'mobile'    => 'required|string|size:11',
        'order_no'  => 'required|string',
        'amount'    => 'required|numeric',
        'remark'    => 'required|string|min:2|max:64',
        'shop_account_no'   => 'required|string|max:64',
        'shop_account_name' => 'required|string|max:128',
    ];
    private function _getUser($mobile)
    {
        if (!$user = User::firstWhere('mobile', $mobile)) {
            $user = User::create([
                'mobile' => $mobile,
                'email' => $mobile."@xiaofeice.com",
                'password' => \bcrypt($mobile)
            ]);
        }
        $this->user = $user;
    }


    /**
     * 获取钱包余额
     *
     * @OA\Get(
     *  path="/api/wallet",
     *  tags={"Wallet"},
     *  @OA\Parameter(name="mobile",  in="query",required=true,explode=true,@OA\Schema(type="string"),description="用户手机号"),
     *  @OA\Response(response=200,description="successful operation"),
     *  security={{ "api_key":{} }}
     * )
     */
    public function get(Request $request)
    {
        $validator = Validator::make($request->all(), self::mobileRules);
        if ($validator->fails()) {
            return $this->sendError(implode(', ', array_map(fn($k): string => $k[0], $validator->errors()->toArray()))); // Combined messages
        }
        $this->_getUser($request->input('mobile'));
        $company = $this->user->partnerCompanies()->first();
        $balance = $this->user->balanceIn($company);
        return $this->sendResponse([
            'balance' => $balance
        ]);
    }

    /**
     * 使用钱包余额消费
     *
     * @OA\Post(
     *  path="/api/wallet/consume",
     *  tags={"Wallet"},
     *  @OA\RequestBody(
     *       required=false,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(property="mobile",description="用户手机号",type="string"),
     *               @OA\Property(property="order_no",description="订单号码",type="string"),
     *               @OA\Property(property="amount",description="",type="消费金额"),
     *               @OA\Property(property="remark",description="",type="消费描述，如：猪脚饭"),
     *               @OA\Property(property="shop_account_no",description="",type="商户账号"),
     *               @OA\Property(property="shop_account_name",description="",type="商户开户名称"),
     *               @OA\Property(property="developer_account_no",description="",type="开发商账号"),
     *               @OA\Property(property="developer_account_name",description="",type="开发商名称"),
     *               @OA\Property(property="county_agent_account_no",description="",type="县级代理账号"),
     *               @OA\Property(property="county_agent_account_name",description="",type="县级代理名称"),
     *               @OA\Property(property="city_agent_account_no",description="",type="地级代理账号"),
     *               @OA\Property(property="city_agent_account_name",description="",type="地级代理名称"),
     * 
     *           )
     *       )
     *   ),
     *  @OA\Response(response=200,description="successful operation"),
     *  security={{ "api_key":{} }}
     * )
     */
    public function consume(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, self::consumeRules);
        // validate mobile
        if ($validator->fails()) {
            return $this->sendError(implode(', ', array_map(fn($k): string => $k[0], $validator->errors()->toArray()))); // Combined messages
        }

        // check repeat submit
        if (Order::firstWhere('order_no', $data['order_no'])){
            return $this->sendError('勿重复提交,可返回刷新');
        }
        // validate user
        $this->_getUser($data['mobile']);
        $company = $this->user->partnerCompanies()->first();
        $balance = $this->user->balanceIn($company);

        // check balance
        if ($balance < $data['amount']) {
            return $this->sendError(__("Balance is not enough", ['balance' => $balance]));
        }

        // create order
        $data['user_id'] = $this->user->id;
        $data['status'] = Order::CREATED;
        $data['type'] = Order::CONSUME;
        DB::beginTransaction();
        $order = Order::create($data);

        $tx = Tx::create([
            'user_id'           => $this->user->id,
            'from_company_id'   => $company->id,
            // 'to_company_id'     => $item['type'] == 'company' ? $company->id : null,
            // 'to_account_no'     => $data['shop_account_no'],
            // 'to_account_name'   => $data['shop_account_name'],
            'order_id'          => $order->id,
            'type'              => Tx::CONSUME,
            'amount'            => $data['amount'],
            'original_amount'   => $data['amount'],
            // 'profit_percent'    => $item['percent'],
            // 'profit_level'      => $item['type'],
            'status'            => Tx::PAID
        ]);
        DB::commit();

        try {
            PaymentTransfer::dispatch($order->id, $data);
        }catch(Exception $e){
            return $this->sendError($e->getMessaage());
        }

        return $this->sendResponse("Transfer success");
    }    
}
