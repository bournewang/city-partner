<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Challenge;
use App\Models\CrowdFunding;
use App\Models\Company;
use App\Models\Banner;
use App\Models\App;
use App\Helpers\UserHelper;
use App\Helpers\ChallengeHelper;
use App\Helpers\FormHelper;
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
        $img_url = url("/storage/mpp/");
        $total = User::where('level', '>', 0)->count();
        $today_new = User::where('level', '>', 0)->where('created_at', '>', today()->toDateString())->count();
        $notice = str_replace(["{total}", "{today_new}"], [$total, $today_new], "当前共注册{total}人，今天新注册{today_new}人！");
        $data = [
            'challengeStats' => ChallengeHelper::stats(),
            'challengeLevels' => array_slice(config('challenge.levels'), 3),
            'carOwnerStats' => [
                ['label' => __("Develop General Manager"),  'value' => 125],
                ['label' => __("General Manager Team"),     'value' => 100],
                ['label' => __("Car Owner"),                'value' => 50],
                ['label' => __("CCER Carbon Reduce Vehicle"), 'value' => 12],
            ],
            'fundingStats' => [
                ['label' => __('Mutual Community People'),  'value' => User::count()],
                ['label' => __('Mutual Funding People'),    'value' => User::whereNotNull('certified_at')->count()],
                ['label' => __('Get Funding People'),       'value' =>
                                CrowdFunding::whereIn('status', [CrowdFunding::USING, CrowdFunding::COMPLETED])->count()],
                ['label' => __('Return Funding People'),    'value' => CrowdFunding::where('status', CrowdFunding::COMPLETED)->count()]
            ],
            'fundingConfig' => config("car-manager.funding"),
            "images" => [
                "apply" => [
                    "car_manager"   => $img_url."/apply-car-manager-1.jpg",
                    "car_owner"     => $img_url."/apply-car-owner-1.jpg",
                    "consumer"      => $img_url."/apply-consumer-1.jpg",
                ],
                "partner" => [
                    "car_manager"   => $img_url."/partner-car-manager.jpg",
                    "car_owner"     => $img_url."/partner-car-owner.jpg",
                    "consumer"      => $img_url."/partner-consumer.jpg",
                ]
            ],
            "welcome" => config("challenge.welcome"),
            "notice" => $notice
        ];
        return $this->sendResponse($data);
    }

    public function formOptions()
    {
        $data = [
            "partnerAssetFields"=> FormHelper::partnerAssetFields($this->user->challenge_type),
            "companyOptions"    => FormHelper::companyFields($this->user),
            "carViewFields"     => FormHelper::carViewFields(),
            "carFormFields"     => FormHelper::carFormFields(),
            "consumerFields"    => FormHelper::consumerFields(),
        ];
        return $this->sendResponse($data);
    }

    public function apps()
    {
        $apps = \App\Models\App::where('status', 1)->get();
        $data = [];
        foreach ($apps as $app) {
            $data[] = $app->info();
        }
        return $this->sendResponse($data);
    }

    public function banners()
    {
        $apps = Banner::where('status', 1)->where("category", Banner::BANNER)->get();
        $data = [];
        foreach ($apps as $app) {
            $data[] = $app->info();
        }
        return $this->sendResponse($data);
    }

    public function ads()
    {
        $apps = Banner::where('status', 1)->where("category", Banner::AD)->get();
        $data = [];
        foreach ($apps as $app) {
            $data[] = $app->info();
        }
        return $this->sendResponse($data);
    }

    public function market()
    {
        $banners = Banner::where('status', 1)->orderBy("sort")->get();
        $data = [
            Banner::BANNER => [],
            Banner::AD => [],
            App::APP => [],
            App::TOOL => []
        ];
        foreach ($banners as $banner) {
            $data[$banner->category][] = $banner->info();
        }

        $apps = \App\Models\App::where('status', 1)->orderBy("sort")->get();
        foreach ($apps as $app) {
            $data[$app->category][] = $app->info();
        }

        return $this->sendResponse($data);
    }

    public function rules()
    {
        return $this->sendResponse(config("rules"));
    }
}
