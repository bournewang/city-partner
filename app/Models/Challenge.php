<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'index_no',
        'level',
        'success_at',
        'status',
    ];

    protected $casts = [
    ];

    const APPLYING = 'applying';
    const CHALLENGING = 'challenging';
    const SUCCESS = 'success';
    const CANCELED = 'canceled';

    static public function statusOptions()
    {
        return [
            self::APPLYING      => __(ucfirst(self::APPLYING)),
            self::CHALLENGING   => __(ucfirst(self::CHALLENGING)),
            self::SUCCESS       => __(ucfirst(self::SUCCESS)),
            self::CANCELED      => __(ucfirst(self::CANCELED)),
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
