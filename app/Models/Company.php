<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        "company_type",
        "execute_partner",
        "partner_role",
        "company_name",
        "credit_code",
        "legal_person_id",
        "registered_at",
        "partner_years",
        "partner_start_at",
        "partner_end_at",
        "bank",
        "sub_bank",
        "account_name",
        "account_no",
    ];

    public function legalPerson()
    {
        return $this->belongsTo(User::class, "legal_person_id");
    }

    const COMMON_PARTNER = 'common_partner';
    const COMPANY_LAUNCHER = 'company_launcher';

    static public function partnerRoleOptions()
    {
        return [
            self::COMMON_PARTNER => ___(self::COMMON_PARTNER),
            self::COMPANY_LAUNCHER => ___(self::COMPANY_LAUNCHER)
        ];
    }

    public function info()
    {
        $data = $this->toArray();
        if ($this->legalPerson) {
            $data['legal_person_name'] = $this->legalPerson->name;
        }
        return $data;
    }
}
