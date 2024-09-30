<?php

namespace App\Http\Controllers\API;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use App\Models\Store;
use App\Models\User;
use App\Models\Order;
use App\Models\Relation;
use App\Helpers\UserHelper;
use App\Wechat;
use App\API\NuonuoApi;
use EasyWeChat\Pay\Application as EasyWeChatApp;
use Log;

class WechatController extends ApiBaseController
{
    public function login(Request $request)
    {
        debug(__CLASS__.'->'.__FUNCTION__);
        debug($request->all());
        if (!$code = $request->input('code')) {
            throw new \Exception("no code");
        }
        // $mpp = \EasyWeChat::miniProgram();
        // $data = $mpp->auth->session($code);
        $data = Wechat::codeToSession($code);
        debug($data);
        \Cache::put("wx.session.".$data['session_key'], json_encode($data), 60*5);
        if (!$openid = $data['openid'] ?? null) {
            return $this->sendError('no openid', [
                'session_key' => $data['session_key']
            ]);
        }
        $referer = null;
        $referer_id = $request->input('referer_id', null);
        if ($referer_id && $referer = User::find($referer_id)) {
            debug("referer {$referer->id}: " . json_encode([
                'leve' => $referer->level,
                'challenge_type' => $referer->challenge_type,
                // 'challenge_type_label' => $referer->challenge_type_label,
            ]));
        }
        if ($user = User::firstWhere('openid', $openid)) {
            debug("user {$user->id} found with openid: $openid");

            // if user's previous referer is not a challenger,
            // user can be re-assign to new referer
            if ($user->referer){
                debug("previous referer {$user->referer_id} : " . json_encode([
                    'leve' => $user->referer->level,
                    'challenge_type' => $user->referer->challenge_type,
                    // 'challenge_type_label' => $user->referer->challenge_type_label,
                ]));
            }
            if (
                $referer
                && $referer->id != $user->referer_id                        // referer changes
                && ($user->referer->level ?? 0) < User::CONSUMER_MERCHANT   // not a challenger
                && ($user->referer->level ?? 0) < $referer->level           // new referer's level greater than previous referer's level
            ) {
                debug("referer changes AND referer level greater than previous, update");
                $user->update([
                    'referer_id'            => $referer->id,
                    'challenge_type'        => $referer->challenge_type ?? null,
                    'challenge_type_label'  => $referer->challenge_type_label ?? null,
                ]);
                if ($user->relation) {
                    $user->relation->update(['path' => $referer->path.",".$referer->id]);
                }else{
                    Relation::create([
                        'root_id' => $referer->root_id ?? null,
                        'user_id' => $user->id,
                        'path' => $referer->path.",".$referer->id
                    ]);
                }
            }
        }else{
            debug("user not found with openid: $openid");
            $mobile = $request->input('mobile', null);
            $info = [
                // 'store_id'  => $store_id,
                'openid'    => $openid,
                'mobile'    => $mobile,
                'name'      => $request->input('name', null),
                'nickname'  => $request->input('nickname', null),
                'avatar'    => $request->input('avatar', null),
                'email'     => $openid."@xiaofeice.com",
                'password'  => bcrypt($mobile || $openid),
                'referer_id'=> $referer_id,
                'challenge_type'        => $referer->challenge_type ?? null,
                'challenge_type_label'  => $referer->challenge_type_label ?? null,
                'level'     => 0
            ];

            if ($mobile && $user = User::firstWhere('mobile', $mobile)) {
                debug("get user with mobile, update user ".$user->id);
                debug($info);
                $user->update($info);
            }else{
                debug("try to create user: " . json_encode($info));
                $user = User::create($info);
                if ($referer) {
                    Relation::create([
                        'root_id' => $referer->root_id ?? null,
                        'user_id' => $user->id,
                        'path' => $referer->path.",".$referer->id
                    ]);
                }
            }
            UserHelper::createQrCode($user);
        }

        $info = $user->info();
        $info['api_token'] = $user->createToken("api")->plainTextToken;
        return $this->sendResponse($info);
    }

    public function register(Request $request)
    {
        debug(__CLASS__.'->'.__FUNCTION__);
        debug($request->all());
        if (!$session_key = $request->input('session_key')) {
            // throw new ApiException("no code");
        }
        // $mpp = EasyWeChat::miniProgram();
        // $data = $mpp->phone_number->getUserPhoneNumber($request->input('code'));
        $data = Wechat::codeToPhoneNumber($request->input('code'));
        debug($data);
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
            debug("try to create user: " . json_encode($info));
            $info['referer_id'] = $referer_id;
            $user = User::create($info);
        }else{
            if ($user->deleted_at) {
                debug("restore user $user->id");
                $user->restore();
            }
            debug("update user $user->id: ".json_encode($info));
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
        debug("user: $user->id");
        $data = $user->info();
        $data['api_token'] = $user->createToken("api")->plainTextToken;
        return $this->sendResponse($data);
    }

    public function notify(Request $request)
    {
        debug(__CLASS__.'->'.__FUNCTION__);
        debug($request->getContent());
        // Decrypt the message
        $encryptedMessage = $request->input('param'); // Assuming the encrypted message is sent in the request
        $key = env('NUONUO_APP_SECRET'); // Replace with your actual key
        $iv = ''; // ECB mode does not use an IV
        $decryptedMessage = openssl_decrypt(base64_decode($encryptedMessage), 'AES-128-ECB', $key, OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING);
        $decryptedMessage = rtrim($decryptedMessage, "\0"); // Remove padding
        debug("Decrypted message: " . $decryptedMessage);

        $res = json_decode($decryptedMessage);
        echo "order no " .$res->customerOrderNo.";";
        echo "pay statue: " .$res->payStatus;
        // 0 waiting, 1 success, 2 fail, 3 closed, 4 refunding, 5 refund success, 6 refund fail
        if ($res->payStatus == 1) {
            echo "payment success";
            $orderNo  = $res->customerOrderNo;
            if ($order = Order::firstWhere('order_no', )){
                $order->update(['status' => Order::PAID]);

                // set user level
                if ($order->type == 'register-consumer') {
                    $user = User::find($order->user_id);
                    if ($user->level < User::REGISTER_CONSUMER)
                        $user->update(['level' => User::REGISTER_CONSUMER]);
                }
                // create invoice
                // $sdk = new NuonuoApi('invoice');
                // $res = $sdk->createInvoice($orderNo, $order->user->name, $res->subject, $order->amount, 0.01, 1);
                // if ($res->code == 'E0000') {
                //     $order->update(['invoice_serial_num' => $res->result->invoiceSerialNum]);
                // }
            }
        }
    }

    public function withdrawNotify(Request $request)
    {
        debug(__CLASS__.'->'.__FUNCTION__);
        debug($request->all());


    }
}
