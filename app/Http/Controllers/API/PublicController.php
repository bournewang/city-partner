<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Challenge;
use App\Models\CrowdFunding;
use App\Helpers\UserHelper;
use App\Helpers\ChallengeHelper;
use App\Wechat;

class PublicController extends ApiBaseController
{
    public function areaData(Request $req)
    {
         return $this->sendResponse(json_decode(file_get_contents(database_path("areadata.json"))));
    }

    public function privacy()
    {
        return $this->sendResponse(file_get_contents(database_path("privacy.txt")));
    }

    // combine index page data in one api
    public function index()
    {
        $data = [
            'challengeStats' => ChallengeHelper::stats(),
            'challengeLevels' => array_slice(config('challenge.levels'), 3),
            'fundingStats' => [
                ['label' => __('Mutual Community People'),  'value' => User::count()],
                ['label' => __('Mutual Funding People'),    'value' => User::whereNotNull('certified_at')->count()],
                ['label' => __('Get Funding People'),       'value' =>
                                CrowdFunding::whereIn('status', [CrowdFunding::USING, CrowdFunding::COMPLETED])->count()],
                ['label' => __('Return Funding People'),    'value' => CrowdFunding::where('status', CrowdFunding::COMPLETED)->count()]
            ],
            'fundingConfig' => config("car-manager.funding")
        ];
        return $this->sendResponse($data);
    }
}
