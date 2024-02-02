<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

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
}
