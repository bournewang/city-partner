<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Challenge;
use App\Helpers\UserHelper;
use App\Wechat;

class CarManagerController extends ApiBaseController
{
    public function fundingStas(Request $req)
    {
        return $this->sendResponse([
            ['label' => __('Mutual Community People'),   'value' => User::count()],
            ['label' => __('Mutual Funding People'),    'value' => User::whereNotNull('certified_at')->count()],
            ['label' => __('Get Funding People'),          'value' => Challenge::where('status', Challenge::CHALLENGING)->count()],
            ['label' => __('Return Funding People'),'value' => Challenge::where('status', Challenge::SUCCESS)->count()]
        ]);
    }

}
