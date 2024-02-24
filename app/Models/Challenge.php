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
            self::SUCCESS       => __("Challenge Success"),
            self::CANCELED      => __(ucfirst(self::CANCELED)),
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function info()
    {
        $userInfo = $this->user->info();
        return [
            "referer.name" => $userInfo['referer.name'],
            "current_level" => $userInfo['level'],
            "current_level_label" => $userInfo['level_label'],
            "qrcode" => $userInfo['qrcode'],
            "level" => $this->level,
            "level_label" => User::levelOptions()[$this->level],
            "success_at" => $this->success_at,
            "status" => $this->status,
            "status_label" => self::statusOptions()[$this->status]
        ];
    }
}
