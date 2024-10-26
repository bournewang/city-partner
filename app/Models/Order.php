<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_no',
        'amount',
        'status',
        'type',
        'paid_at',
        'refund_at',
        'remark',
        'shop_account_no',
        'shop_account_name',
        'developer_account_no',
        'developer_account_name',
        'county_agent_account_no',
        'county_agent_account_name',
        'city_agent_account_no',
        'city_agent_account_name',
        'invoice_serial_num'
    ];

    protected $casts = [
    ];

    // type options
    const CONSUME = 'consume';

    const CREATED = 'unpaid';
    const PAID = 'paid';
    const CANCELED = 'canceled';
    const REFUNDED = 'refunded';

    static public function statusOptions()
    {
        return [
            self::CREATED   => __(ucfirst(self::CREATED)),
            self::PAID      => __(ucfirst(self::PAID)),
            self::CANCELED  => __(ucfirst(self::CANCELED)),
            self::REFUNDED  => __(ucfirst(self::REFUNDED)),
        ];
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
