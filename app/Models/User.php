<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'openid',
        'platform_openid',
        'name',
        'nickname',
        'avatar',
        'gender',
        'mobile',
        'qrcode',
        'id_no',
        'balance',
        'referer_id',
        'email',
        'password',
        'certified_at',
        'status',
        'level',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'referer_id' => 'integer'
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->email == env("ADMIN_EMAIL");
    }

    public function referer()
    {
        return $this->belongsTo(User::class, 'referer_id');
    }

    public function recommands()
    {
        return $this->hasMany(User::class, 'referer_id');
    }

    public function challenge()
    {
        return $this->hasOne(Challenge::class);
    }

    const LEVEL_0 = "consumer";
    const LEVEL_1 = "station_manager";
    const LEVEL_2 = "center_director";
    const LEVEL_3 = "county_manager";
    const LEVEL_4 = "area_president";
    const LEVEL_5 = "province_management";

    static public function levelOptions()
    {
        return [
            __(self::LEVEL_0),
            __(self::LEVEL_1),
            __(self::LEVEL_2),
            __(self::LEVEL_3),
            __(self::LEVEL_4),
            __(self::LEVEL_5),
        ];
    }

    public function levelLabel()
    {
        return self::levelOptions()[$this->level];
    }
}
