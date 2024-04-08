<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
// use App\Models\CrowdFunding;
// use App\Helpers\UserHelper;
// use App\Wechat;

class CarController extends ApiBaseController
{
    public function query(Request $request)
    {
        if (!$mobile = $request->input('mobile')) {
            return $this->sendError("no mobile: $mobile");
        }

        if (!$user = User::firstWhere('mobile', $mobile)) {
            return $this->sendError("no user found with mobile: $mobile");
        }

        $data = null;
        if ($car = $user->car){
            $data = $car->info();
        }
        return $this->sendResponse($data);
    }
}
