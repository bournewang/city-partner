<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Challenge;
use App\Helpers\UserHelper;
use App\Wechat;

class UserController extends ApiBaseController
{
    /**
     * 获取用户信息
     *
     * @OA\Get(
     *  path="/api/user/info",
     *  tags={"User"},
     *  @OA\Response(response=200,description="successful operation"),
     *  security={{ "api_key":{} }}
     * )
     */
    public function info()
    {
        return $this->sendResponse($this->user->info());
    }

    /**
     * 修改用户信息
     *
     * @OA\Post(
     *  path="/api/user/info",
     *  tags={"User"},
     *   @OA\RequestBody(
     *       required=false,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(property="nickname",description="nickname",type="string"),
     *               @OA\Property(property="avarar",description="avarar",type="url"),
     *               @OA\Property(property="gender",description="1:male, 2:female",type="integer"),
     *           )
     *       )
     *   ),
     *  @OA\Response(response=200,description="successful operation"),
     *  security={{ "api_key":{} }}
     * )
     */
    public function profile(Request $request)
    {
        $this->user->update($request->all());
        \Log::debug("user ".$this->user->id." update ");
        \Log::debug($request->all());
        return $this->sendResponse([]);
    }

    // start challenge
    // post
    public function startChallenge()
    {
        // $challenge = null;
        if (!$challenge = $this->user->challenge) {
            $challenge = Challenge::create([
                'user_id' => $this->user->id,
                // 'index_no',
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

    /**
     * 获取用户二维码
     *
     * @OA\Get(
     *  path="/api/user/qrcode",
     *  tags={"User"},
     *  @OA\Response(response=200,description="successful operation"),
     *  security={{ "api_key":{} }}
     * )
     */
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
