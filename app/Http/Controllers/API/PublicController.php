<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Challenge;
use App\Models\CrowdFunding;
use App\Helpers\UserHelper;
use App\Wechat;

class PublicController extends ApiBaseController
{
    public function areaData(Request $req)
    {
         return $this->sendResponse(json_decode(file_get_contents(database_path("areadata.json"))));
    }

    // combine index page data in one api
    public function index()
    {
        $data = [
            'challengeStats' => [
                ['label' => __('Register Consumers'),   'value' => User::count()],
                ['label' => __('Partner Consumers'),    'value' => User::whereNotNull('certified_at')->count()],
                ['label' => __('Challengers'),          'value' => Challenge::where('status', Challenge::CHALLENGING)->count()],
                ['label' => __('Successed Challengers'),'value' => Challenge::where('status', Challenge::SUCCESS)->count()]
            ],
            'challengeLevels' => array_slice(config('challenge'), 3),
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
