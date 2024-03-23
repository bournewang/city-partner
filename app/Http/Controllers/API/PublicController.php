<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Challenge;
use App\Models\CrowdFunding;
use App\Models\Company;
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
            "company_types" => $typeOptions,
            "partner_roles" => $roleOptions,
            "fieldOptions"  => [
                ["icon" => "app", "name" => "company_type",     "label" =>  "公司类型",  "required" => true,   "type" => "radio",  "options" => $typeOptions],
                ["icon" => "app", "name" => "execute_partner",  "label" =>  "执行合伙人", "disabled" => true, "value" => "深圳市千百惠投资管理有限公司"],
                ["icon" => "app", "name" => "partner_role",     "label" =>  "合伙人身份", "required" => true,   "type" => "checkbox", "options"=>$roleOptions],
                ["icon" => "app", "name" => "company_name",     "label" =>  "公司名称", "required" => true],
                ["icon" => "app", "name" => "credit_code",      "label" =>  "信用代码"],
                ["icon" => "app", "name" => "legal_person_name","label" =>  "法人", "required" => true],
                ["icon" => "app", "name" => "registered_at",    "label" =>  "注册日期"],
                ["icon" => "app", "name" => "partner_years",    "label" =>  "合伙年限"],
                ["icon" => "app", "name" => "partner_start_at", "label" =>  "合伙开始日期"],
                ["icon" => "app", "name" => "partner_end_at",   "label" =>  "合伙结束日期"],
                ["icon" => "app", "name" => "bank",             "label" =>  "银行",       "type" => "picker", "options" => $bankOptions],
                ["icon" => "app", "name" => "sub_bank",         "label" =>  "其他银行/支行"],
                ["icon" => "app", "name" => "account_name",     "label" =>  "账户名称"],
                ["icon" => "app", "name" => "account_no",     "label" =>  "账号"]
        ]];
        return $this->sendResponse($data);
    }
}
