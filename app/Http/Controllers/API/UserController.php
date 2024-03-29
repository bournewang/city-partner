<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Challenge;
use App\Models\CrowdFunding;
use App\Models\Agent;
use App\Helpers\UserHelper;
use App\Wechat;

class UserController extends ApiBaseController
{
    public function info(Request $request)
    {
        if (!$this->user->qrcode) {
            UserHelper::createQrCode($this->user);
        }
        $data = $this->user->info();
        if ($request->input('include_images', false)) {
            foreach($this->user->getMedia('*') as $media) {
                $data[$media->collection_name] = [
                    'thumb' => $media->getUrl('thumb'),
                    'preview' => $media->getUrl('preview'),
                    'original' => $media->getUrl()
                ];
            }
        }
        return $this->sendResponse($data);
    }

    public function profile(Request $request)
    {
        $input = $request->all();
        $user = $this->user;
        if (($input['name'] ?? $user->name) && ($input['mobile'] ?? $user->mobile) && $user->level < User::REGISTER_CONSUMER) {
            \Log::debug("name & mobile exists & level < 1, update level to User::REGISTER_CONSUMER");
            $input['level'] = User::REGISTER_CONSUMER;
        }
        $user->update(array_filter($input));

        return $this->sendResponse($user->refresh()->info());
    }

    // start challenge
    // post
    public function startChallenge(Request $request)
    {
        // $challenge = null;
        if (!$challenge = $this->user->challenge) {
            $challenge = Challenge::create([
                'user_id' => $this->user->id,
                // 'index_no',
                'type' => $request->input('type', null),
                'level' => UserHelper::nextLevel($this->user),
                'success_at' => null,
                'status' => Challenge::APPLYING,
            ]);
        }elseif($challenge->status == Challenge::SUCCESS){
            $challenge->update([
                'status' => Challenge::CHALLENGING,
                'level' => UserHelper::nextLevel($this->user)
            ]);
        }
        return $this->sendResponse($challenge->info());
    }

    // get my challenge
    public function challenge()
    {
        if ($challenge = $this->user->challenge) {
            return $this->sendResponse($challenge->info());
        }
        return $this->sendResponse(null);
    }

    public function crowdFunding()
    {
        if ($crowdFunding = $this->user->crowdFunding) {
            return $this->sendResponse($crowdFunding->info());
        }
        return $this->sendResponse(null);
    }

    public function company()
    {
        if ($company = $this->user->company) {
            return $this->sendResponse($company->info());
        }
        return $this->sendResponse(null);
    }

    public function agent()
    {
        if ($agent = $this->user->agent) {
            return $this->sendResponse($agent->info());
        }
        return $this->sendResponse(null);
    }
    
    public function images(Request $request)
    {
        $collection = $request->input('collection', 'default');
        foreach($this->user->getMedia($collection) as $media) {
            $media->delete();
        }
        $this->user
            ->addMedia($request->file('img'))
            ->toMediaCollection($collection);

        if ($collection == "head-img") {
            if ($media = $this->user->refresh()->getMedia($collection)->first()) {
                $this->user->update(['avatar' => $media->getUrl('thumb')]);
            }else{
                \Log::debug("------ avatar not exists!");
            }

        }

         return $this->sendResponse(true);
    }

    public function apply(Request $request)
    {
        // update profile
        $input = $request->all();
        if ($input['challenge_type'] ?? null) {
            $input['challenge_type_label'] = Challenge::typeOptions()[$input['challenge_type']];
        }

        // apply challenge or CrowdFunding or consumer
        $apply_type = $request->input('apply_type');
        $data = null;
        if ($apply_type == 'challenge'){
            // $challenge = null;
            if (!$challenge = $this->user->challenge) {
                $challenge = Challenge::create([
                    'user_id' => $this->user->id,
                    // 'index_no',
                    'type' => $request->input('challenge_type', null),
                    'partner_role' => $input['partner_role'] ?? null,
                    'level' => User::CONSUMER_MERCHANT,
                    'success_at' => null,
                    'status' => Challenge::APPLYING,
                ]);
            }elseif($challenge->status == Challenge::SUCCESS){
                $challenge->update(['status' => Challenge::CHALLENGING]);
            }
            $input['challenge_id'] = $challenge->id;
            // $data = $challenge->info();
            // return $this->sendResponse();
        }elseif ($apply_type == "funding"){
            $crowdFunding = CrowdFunding::create([
                'user_id' => $this->user->id,
                'partner_role' => $input['partner_role'] ?? null,
                'paid_deposit' => !!$this->user->getMedia('pay_receipt_funding')->first(),
                // 'success_at' => null,
                // 'returned_at',
                'status' => CrowdFunding::APPLYING,
                // 'comment'
            ]);
            $input['crowd_funding_id'] = $crowdFunding->id;
            // $data = $crowdFunding->info();
        }elseif ($apply_type == "agent") {
            // $input['user_id'] = $this->user->id;
            $agent = Agent::create([
                "user_id" => $this->user->id,
                "province_code" => $input['agent_province_code'] ?? null,
                "province_name" => $input['agent_province_name'] ?? null,
                "city_code"     => $input['agent_city_code'] ?? null,
                "city_name"     => $input['agent_city_name'] ?? null,
                "county_code"   => $input['agent_county_code'] ?? null,
                "county_name"   => $input['agent_county_name'] ?? null,
                "status"        => Agent::APPLYING
            ]);
        }elseif ($apply_type == "consumer"){
            if ($this->user->level < User::PARTNER_CONSUMER) {
                $input['level'] = User::PARTNER_CONSUMER;
            }
        }

        $this->user->update($input);
        $data = $this->user->refresh()->info();
        return $this->sendResponse($data);
    }

    public function recommends()
    {
        $data = [];
        foreach ($this->user->recommends as $user) {
            $data[] = $user->info();
        }
        return $this->sendResponse($data);
    }

    public function qrcode()
    {
        if ($this->user->qrcode){
            return $this->sendResponse(url($this->user->qrcode));
        }
        try {
            return $this->sendResponse(url($this->user->qrcode));
        } catch (\Throwable $e) {
            // 失败
            // echo $e->getMessage();
            return $this->sendError("获取二维码失败: ".$e->getMessage());
        }
    }

    /**
     * 获取用户分销网体
     *
     * @OA\Get(
     *  path="/api/user/team-overview",
     *  tags={"User"},
     *  @OA\Response(response=200,description="successful operation"),
     *  security={{ "api_key":{} }}
     * )
     */
    public function teamOverview()
    {
        return $this->sendResponse(UserHelper::teamOverview($this->user));
    }

    /**
     * 获取直推用户网体数据
     *
     * @OA\Get(
     *  path="/api/user/team-detail",
     *  tags={"User"},
     *  @OA\Response(response=200,description="successful operation"),
     *  security={{ "api_key":{} }}
     * )
     */
    public function teamDetail()
    {
        return $this->sendResponse(UserHelper::teamDetail($this->user));
    }
}
