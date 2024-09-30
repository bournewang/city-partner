<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tx;
use Carbon\Carbon;

class TxController extends ApiBaseController
{
    public function get($id, Request $request)
    {
        $tx = Tx::find($id);
        // if (!$tx || $tx->_id != $this->)
        return $this->sendResponse($tx->info());
    }

    // topup confirm
    public function audit($id, Request $request)
    {
        // check permission
        $tx = Tx::find($id);
        $company_id = $this->user->company->id ?? null;
        if (!$company_id) {
            return $this->sendError("你没有合伙公司！");
        }
        // only allow confirm topups from current user's company
        if ($tx->to_company_id != $company_id) {
            return $this->sendError("没有权限！");
        }

        $tx->update(['status' => Tx::PAID]);

        // update paid amount in partner company assets
        $user = User::find($this->user->id);
        $user->partnerCompanies()->updateExistingPivot($company_id, 
            [
                'paid_amount' => $user->topups($company_id),
                'balance' => $user->balanceIn($company_id)
        ]);

        return $this->sendResponse($tx->info());
    }

    public function cancel($id, Request $request)
    {
        // check permission
        $tx = Tx::find($id);
        $company_id = $this->user->company->id ?? null;
        if (!$company_id) {
            return $this->sendError("你没有合伙公司！");
        }
        // only allow confirm topups from current user's company
        if ($tx->to_company_id != $company_id) {
            return $this->sendError("没有权限！");
        }

        $tx->update(['status' => Tx::CANCELED]);

        return $this->sendResponse($tx->info());
    }    

}