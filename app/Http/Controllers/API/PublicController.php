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

    public function companyOptions()
    {
        $typeOptions = [];
        foreach (Challenge::typeOptions() as $value => $label) {
            $typeOptions[] = ["value" => $value, "label" => $label];
        }
        $roleOptions = [];
        foreach (Company::partnerRoleOptions() as $value => $label) {
            $roleOptions[] = ["value" => $value, "label" => $label];
        }
        $bankOptions = [];
        foreach (config("banks") as $code => $name) {
            $bankOptions[] = ["value" => $code, "label" => $name];
        }
        $data = [
            // "company_types" => $typeOptions,
            // "partner_roles" => $roleOptions,
            "fieldOptions"  => [
                // ["icon" => "app",           "name" => "company_type",     "label" =>  "公司类型",  "type" => "radio", "options" => $typeOptions,
                //                                                           "required" => true, "disabled" => true, "defaultValue" => ($this->user->challenge_type?? null)],
                ["icon" => "app",           "name" => "company_type_label",     "label" =>  "公司类型", "disabled" => true, "defaultValue" => ($this->user->challenge_type_label ?? null)],
                ["icon" => "gesture-click", "name" => "execute_partner",  "label" =>  "执行合伙人", "disabled" => true, "defaultValue" => "深圳市千百惠投资管理有限公司"],
                // ["icon" => "app",           "name" => "partner_role",     "label" =>  "合伙人身份", "required" => true, "type" => "checkbox", "options"=>$roleOptions, "defaultValue" => Company::COMMON_PARTNER],
                ["icon" => "star",          "name" => "partner_role_label",     "label" =>  "合伙人身份", "disabled" => true, "defaultValue" => Company::partnerRoleOptions()[Company::COMMON_PARTNER]],
                ["icon" => "info-circle",   "name" => "company_name",     "label" =>  "公司名称", "required" => true],
                ["icon" => "data-display",  "name" => "credit_code",      "label" =>  "信用代码"],
                ["icon" => "user-marked",   "name" => "legal_person_name","label" =>  "法人", "required" => true],
                ["icon" => "calendar-edit", "name" => "registered_at",    "label" =>  "注册日期"],
                ["icon" => "cooperate",     "name" => "partner_years",    "label" =>  "合伙年限"],
                ["icon" => "calendar-2",    "name" => "partner_start_at", "label" =>  "合伙开始日期"],
                ["icon" => "calendar-event", "name" => "partner_end_at",   "label" =>  "合伙结束日期"],
                ["icon" => "institution-checked", "name" => "bank",             "label" =>  "开户银行",
                    // "type" => "picker", "options" => $bankOptions
                ],
                ["icon" => "institution",   "name" => "sub_bank",         "label" =>  "支行（或其他银行）"],
                ["icon" => "verify",        "name" => "account_name",     "label" =>  "账户名称"],
                ["icon" => "data-display",  "name" => "account_no",     "label" =>  "账号"]
        ]];
        return $this->sendResponse($data);
    }

    public function carOptions()
    {
        $data = [
            "viewOptions" => [
                ["icon" => "data-display", "name" => "plate_no", "label" => "车牌号", "disabled" => true],
                ["icon" => "barcode-1", "name" => "vin", "label" => "车架号", "disabled" => true],
                ["icon" => "flag-1", "name" => "car_model_brand", "label" => "品牌", "disabled" => true],
                ["icon" => "vehicle", "name" => "car_model_name", "label" => "车型", "disabled" => true],
                ["icon" => "calendar-event", "name" => "car_model_yeartype", "label" => "年份", "disabled" => true],
                ["icon" => "undertake-environment-protection", "name" => "car_model_fuelgrade", "label" => "汽油型号", "disabled" => true],

            ],
            "formOptions" => [
                ["icon" => "vehicle", "name" => "plate_no", "label" => "车牌号", "required" => true],
                ["icon" => "vehicle", "name" => "vin", "label" => "车架号", "required" => true]
            ]
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
