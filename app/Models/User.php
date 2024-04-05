<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use InteractsWithMedia;

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
        $this
            ->addMediaConversion('thumb')
            ->fit(Fit::Contain, 100, 100)
            ->nonQueued();
    }
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
        "province_code",
        "province_name",
        "city_code",
        "city_name",
        "county_code",
        "county_name",
        "street",
        "challenge_id",
        "crowd_funding_id",
        "challenge_type",
        "challenge_type_label"
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

    public function recommends()
    {
        return $this->hasMany(User::class, 'referer_id');
    }

    public function challenge()
    {
        return $this->hasOne(Challenge::class);
    }

    public function crowdFunding()
    {
        return $this->hasOne(CrowdFunding::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'legal_person_id');
    }

    public function agent()
    {
        return $this->hasOne(Agent::class);
    }

    public function car()
    {
        return $this->hasOne(Car::class);
    }

    const NONE_REGISTER     = 0; //"none_register";
    const REGISTER_CONSUMER = 1; //"register_consumer";
    const PARTNER_CONSUMER  = 2; //"partner_consumer";
    const CONSUMER_MERCHANT = 11;
    const COMMUNITY_STATION = 12;
    const RUN_CENTER_DIRECTOR = 13;
    const COUNTY_MANAGER    = 14;
    const AREA_PRESIDENT    = 15;
    const PROVINCE_CEO      = 16;

    static public function levelOptions()
    {
        $options = [];
        foreach (config('challenge.levels') as $level => $data){
            $options[$level] = $data['label'];
        }
        return $options;
    }

    public function levelLabel()
    {
        return self::levelOptions()[$this->level];
    }

    public function root()
    {
        return $this->belongsTo(User::class);
    }

    public function relation()
    {
        return $this->hasOne(Relation::class);
    }

    public function info()
    {
        $data = $this->toArray();
        $data['created_at'] = $this->created_at->toDateTimeString();
        $data['level_label'] = $this->levelLabel();
        // $data['referer_id'] = $this->referer_id ?? 0;
        $data['referer_name'] = $this->referer->name ?? $this->referer->nickname ?? $this->referer->mobile ?? null;
        $data['qrcode'] = $this->qrcode ? url($this->qrcode) : null;
        $data['display_name'] = $this->displayName();
        $data['display_area'] = $this->displayArea();
        $data['agent_id'] = $this->agent->id ?? null;
        return $data;
    }

    public function displayName()
    {
        return $this->name ?? $this->nickname ?? $this->mobile ?? __("User").$this->id;
    }

    public function displayArea()
    {
        return $this->province_name . ($this->city_name ?? '') . $this->county_name;
    }

    public function displayAddress()
    {
        return $this->displayArea() . $this->street;
    }
}
