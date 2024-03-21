<?php

namespace App\Http\Controllers\API;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\User;
use App\Helpers\ChallengeHelper;
use Log;

class ChallengeController extends ApiBaseController
{
    public function success(Request $request)
    {
        $list = Challenge::whereNotNull('success_at')->orderBy('success_at', 'desc')->limit(20)->get();
        $data = [];
        foreach ($list as $item){
            // $data[] = "$item->success_at ".$item->user->name ."挑战".$item->user->levelLabel()."成功！";
            $data[] = [ "success_at" => $item->success_at, "content" => $item->user->name ."挑战".$item->user->levelLabel()."成功！"];
        }

        return $this->sendResponse($data);
    }

    public function stats(Request $request)
    {
        $data = ['stats' => ChallengeHelper::stats()];
        if ($request->input('activity', false)) {
            $list = Challenge::orderBy('id', 'desc')->limit(20)->get();
            $statusOptions = Challenge::statusOptions();
            $activity = [];
            foreach ($list as $item){
                // $data[] = "$item->success_at ".$item->user->name ."挑战".$item->user->levelLabel()."成功！";
                $activity[] = [
                    "updated_at" => $item->updated_at ? $item->updated_at->toDateTimeString() : null,
                    "content" => $item->user->displayName() . $statusOptions[$item->status]."!",
                    "avatar" => $item->user->avatar
                ];
            }
            $data['activity'] =$activity;
        }
        return $this->sendResponse($data);
    }

    public function levels()
    {
        return $this->sendResponse(array_slice(config('challenge.levels'), 3));
    }

    public function types()
    {
        return $this->sendResponse(Challenge::typeOptions());
    }

    /**
     * 获取直推排行榜
     *
     * @OA\Get(
     *  path="/api/challenge/range",
     *  tags={"User"},
     *  @OA\Response(response=200,description="successful operation"),
     *  security={{ "api_key":{} }}
     * )
     */
    public function range()
    {
        return $this->sendResponse(ChallengeHelper::range());
    }
}
