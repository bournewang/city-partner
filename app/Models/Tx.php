<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\Fit;

class Tx extends Model implements HasMedia
{
    use HasFactory;
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

    protected $fillable = [
        'user_id',
        'from_company_id',
        'to_company_id',
        'type',
        'amount',
        'status',
    ];

    protected $casts = [
    ];

    const TOPUP = 'topup';
    const CONSUME = 'consume';
    const PROFIT = 'profit';

    static public function typeOptions()
    {
        return [
            self::TOPUP => __(ucfirst(self::TOPUP)),
            self::CONSUME => __(ucfirst(self::CONSUME)),
            self::PROFIT => __(ucfirst(self::PROFIT)),
        ];
    }

    const CREATED = 'created';
    const PAID = 'paid';
    const CANCELED = 'canceled';

    static public function statusOptions()
    {
        return [
            self::CREATED   => __(ucfirst(self::CREATED)),
            self::PAID      => __(ucfirst(self::PAID)),
            self::CANCELED  => __(ucfirst(self::CANCELED)),
        ];
    }    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function txes()
    {
        return $this->hasMany(Tx::class);
    }

    public function info()
    {
        $info = $this->toArray();
        // $info['from_company_label'] = 
        $info['user_avatar'] = $this->user->avatar;
        $info['user_label'] = $this->user->displayName();
        $info['created_date'] = $this->created_at->toDateString();
        $info['created_at'] = $this->created_at->toDateTimeString();
        $info["status_label"] = self::statusOptions()[$this->status];

        if ($media = $this->getMedia('topup_evidence')->first()){
            $info['topup_evidence'] = [
                'thumb' => $media->getUrl('thumb'),
                'preview' => $media->getUrl('preview'),
                'original' => $media->getUrl()
            ];
        }

        return $info;
    }

    public function balanceIn(Company $company)
    {
        $topups = $this->txes()
            ->where('to_company_id', $company->id)
            ->where('status', Tx::PAID)
            ->where('type', Tx::TOPUP)
            ->sum('amount');
        $consumes = $this->txes()
            ->where('from_company_id', $company->id)
            ->where('status', Tx::PAID)
            ->where('type', Tx::CONSUME)
            ->sum('amount');
        return round($topups - $consumes, 2);
    }
}