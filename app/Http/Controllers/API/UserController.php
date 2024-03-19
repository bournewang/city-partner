<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Challenge;
use App\Models\CrowdFunding;
use App\Helpers\UserHelper;
use App\Wechat;

class UserController extends ApiBaseController
{
    public function info(Request $request)
    {
        $data = $this->user->info();
        if ($request->input('include_images', false)) {
            foreach($this->user->getMedia('*') as $media) {
                $data[$media->collection_name] = [
                    'preview' => $media->getUrl('preview'),
                    'original' => $media->getUrl()
                ];
            }
        }
        return $this->sendResponse($data);
    }

    public function profile(Request $request)
    {
        $this->user->update($request->all());
        if ($this->user->name && $this->user->mobile && $this->user->level < 1) {
            $this->user->update(['level' => User::REGISTER_CONSUMER]);
        }
        \Log::debug("user ".$this->user->id." update ");
        \Log::debug($request->all());
        return $this->sendResponse($this->user->info());
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
                'level' => $this->user->level,
                'success_at' => null,
                'status' => Challenge::APPLYING,
            ]);
        }elseif($challenge->status == Challenge::SUCCESS){
            $challenge->update(['status' => Challenge::CHALLENGING]);
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
                \Log::debug("++++++ avatar exists!");
                $this->user->update(['avatar' => $media->getUrl('preview')]);
            }else{
                \Log::debug("------ avatar not exists!");
            }

        }

         return $this->sendResponse(true);
    }

    public function apply(Request $request)
    {
        // update profile
        $this->user->update($request->all());

        // apply challenge or CrowdFunding or consumer
        $apply_type = $request->input('apply_type');
        if ($apply_type == 'challenge'){
            // $challenge = null;
            if (!$challenge = $this->user->challenge) {
                $challenge = Challenge::create([
                    'user_id' => $this->user->id,
                    // 'index_no',
                    // 'type' => $request->input('type', null),
                    'level' => $this->user->level,
                    'success_at' => null,
                    'status' => Challenge::APPLYING,
                ]);
            }elseif($challenge->status == Challenge::SUCCESS){
                $challenge->update(['status' => Challenge::CHALLENGING]);
            }
            return $this->sendResponse($challenge->info());
        }elseif ($apply_type == "funding"){
            $crowdFunding = CrowdFunding::create([
                'user_id' => $this->user->id,
                'paid_deposit' => !!$this->user->getMedia('pay-receipt')->first(),
                // 'success_at' => null,
                // 'returned_at',
                'status' => CrowdFunding::APPLYING,
                // 'comment'
            ]);
            return $this->sendResponse($crowdFunding->info());
        }elseif ($apply_type == "consumer"){

        }
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
