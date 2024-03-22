<?php

namespace App\Http\Controllers\API;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use App\Models\Store;
use App\Models\User;
use App\Models\Order;
use App\Models\Relation;
use App\Wechat;
use Log;

class WechatController extends ApiBaseController
{
    /**
     * Login api
     *
     * @OA\Post(
     *  path="/api/wxapp/login",
     *  tags={"Auth"},
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(property="code",description="code",type="string")
     *           )
     *       )
     *   ),
     *  @OA\Response(response=200,description="successful operation"),
     *  security={{ "api_key":{} }}
     * )
     */
    public function login(Request $request)
    {
        \Log::debug(__CLASS__.'->'.__FUNCTION__);
        \Log::debug($request->all());
        if (!$code = $request->input('code')) {
            throw new \Exception("no code");
        }
        // $mpp = \EasyWeChat::miniProgram();
        // $data = $mpp->auth->session($code);
        $data = Wechat::codeToSession($code);
        \Log::debug($data);
        \Cache::put("wx.session.".$data['session_key'], json_encode($data), 60*5);
        if ($openid = $data['openid'] ?? null) {
            if ($user = User::firstWhere('openid', $openid)) {
                \Auth::login($user);
            }else{
                $referer = null;
                if ($referer_id = $request->input('referer_id', null)) {
                    $referer = User::find($referer_id);
                }
                $info = [
                    // 'store_id'  => $store_id,
                    'openid'    => $openid,
                    // 'mobile'    => $phone_number,
                    // 'name'      => null,
                    'email'     => $openid."@wechat.com",
                    'password'  => bcrypt($openid),
                    'referer_id'=> $referer_id,
                    'challenge_type' => $referer->challenge_type ?? null,
                    // 'rewards_expires_at' => Carbon::today()->addDays($setting->level_0_rewards_days),
                    'level'     => 0
                ];
                \Log::debug("try to create user: " . json_encode($info));
                // $info['referer_id'] = $referer_id;
                $user = User::create($info);

                UserHelper::createQrCode($user);
            }

            $info = $user->info();
            $info['api_token'] = $user->createToken("api")->plainTextToken;
            return $this->sendResponse($info);
        }
        return $this->sendError('no openid', [
            'session_key' => $data['session_key']
        ]);
    }

    /**
     * Register api
     *
     * @OA\Post(
     *  path="/api/wxapp/register",
     *  tags={"Auth"},
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(property="session_key",description="session key from login api response",type="string"),
     *               @OA\Property(property="code",description="code for phone number",type="string"),
     *               @OA\Property(property="store_id",description="store id from init",type="integer"),
     *               @OA\Property(property="referer_id",description="referer id from init",type="integer"),
     *           )
     *       )
     *   ),
     *  @OA\Response(response=200,description="successful operation"),
     *  security={{ "api_key":{} }}
     * )
     */
    public function register(Request $request)
    {
        \Log::debug(__CLASS__.'->'.__FUNCTION__);
        \Log::debug($request->all());
        if (!$session_key = $request->input('session_key')) {
            // throw new ApiException("no code");
        }
        // $mpp = EasyWeChat::miniProgram();
        // $data = $mpp->phone_number->getUserPhoneNumber($request->input('code'));
        $data = Wechat::codeToPhoneNumber($request->input('code'));
        \Log::debug($data);
        if (!isset($data['errcode']) || $data['errcode'] != 0) {
            return $this->sendError("fetch phone number failed: ".$data['errmsg']);
        }
        $phone_number = ($data['phone_info']['purePhoneNumber'] ?? $data['phone_info']['phoneNumber']) ?? null;
        if (!$phone_number || strlen($phone_number) < 10) {
            return $this->sendError("请授权手机号码！");
        }

        if (!$string = \Cache::get("wx.session.".$session_key)) {
            return $this->sendError("no session found with key: $session_key");
        }
        $session = json_decode($string, 1);
        if (!$openid = ($session['openid'] ?? null)) {
            return $this->sendError("no openid in session data");
        }

        $store_id = intval($request->input('store_id', null));
        $store_id = $store_id > 0 ? $store_id : null;
        // $setting = Setting::first();
        $info = [
            // 'store_id'  => $store_id,
            'openid'    => $openid,
            'mobile'    => $phone_number,
            'email'     => $openid."@wechat.com",
            'password'  => bcrypt($openid),
            // 'rewards_expires_at' => Carbon::today()->addDays($setting->level_0_rewards_days),
            'level'     => 0
        ];
        $referer_id = $request->input('referer_id', null);
        if (!$user = User::withTrashed()->firstWhere('mobile', $phone_number)) {
            \Log::debug("try to create user: " . json_encode($info));
            $info['referer_id'] = $referer_id;
            $user = User::create($info);
        }else{
            if ($user->deleted_at) {
                \Log::debug("restore user $user->id");
                $user->restore();
            }
            \Log::debug("update user $user->id: ".json_encode($info));
            $user->update($info);
        }

        if ($referer = User::find($referer_id)) {
            Relation::create([
                'root_id' => $referer->root_id,
                'user_id' => $user->id,
                'path' => $referer->path.",".$referer->id
            ]);
        }

        \Auth::login($user);
        \Log::debug("user: $user->id");
        $data = $user->info();
        $data['api_token'] = $user->createToken("api")->plainTextToken;
        return $this->sendResponse($data);
    }

    public function notify(Request $request)
    {
        \Log::debug(__CLASS__.'->'.__FUNCTION__);
        $app = \EasyWeChat::payment();
        //  data:
        //  array (
        //   'appid' => 'wx561877352e872072',
        //   'bank_type' => 'OTHERS',
        //   'cash_fee' => '1',
        //   'fee_type' => 'CNY',
        //   'is_subscribe' => 'N',
        //   'mch_id' => '1484920352',
        //   'nonce_str' => '61d592e64368c',
        //   'openid' => 'oZO6h5ft4olVbJcLfU4OEkBqYdxc',
        //   'out_trade_no' => '891840',
        //   'result_code' => 'SUCCESS',
        //   'return_code' => 'SUCCESS',
        //   'sign' => '573C1A93A6AE80BA2B743A5BBA0D7639',
        //   'time_end' => '20220105204530',
        //   'total_fee' => '1',
        //   'trade_type' => 'JSAPI',
        //   'transaction_id' => '4200001310202201054219704874',
        // )
        $response = $app->handlePaidNotify(function ($data, $fail) {
            \Log::debug($data);
            if ($data['result_code'] == 'SUCCESS' &&
                $data['return_code'] == 'SUCCESS' &&
                ($order_no = $data['out_trade_no'])) {
                if ($order = Order::where('order_no', $order_no)->first()) {
                    $order->update(['status' => Order::PAID, 'paid_at' => Carbon::now()]);
                    // OrderHelper::profitSplit($order);
                    return true;
                }
            }
            // 或者错误消息
            $fail('Something going wrong.');
        });
        $response->send();
    }

    public function withdrawNotify(Request $request)
    {
        \Log::debug(__CLASS__.'->'.__FUNCTION__);
        \Log::debug($request->all());


    }
}
