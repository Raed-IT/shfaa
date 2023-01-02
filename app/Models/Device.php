<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Device
 *
 * @property int $id
 * @property string $name
 * @property string $SN
 * @property int $hospital_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Hospital|null $hospital
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereSN($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Device extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'SN',
        "hospital_id",
        "is_active"
    ];

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }

    public function fixSheets():hasMany
    {
        return $this->hasMany(FixSheet::class);
    }

    public function scopeCountDeviceBerLateMonths($query,): array
    {
        $count_device = [];
        //set first index 0 f
        for ($i = 0; $i < 12; $i++) {
            //get count device added in month for last 7 month
            array_push($count_device,
                Device::whereBetween('created_at', [
                    Carbon::now()->subMonth($i + 1)->format('Y-m-d'),
                    Carbon::now()->subMonth(($i))->format('Y-m-d')
                ])->count());
        }
        return $count_device;
    }

    public function scopeCountDeviceStatuesBerLateMonths($query, $vale): array
    {
        $count_device = [];
        //set first index 0 f
        for ($i = 0; $i < 12; $i++) {
            //get count device added in month for last 7 month
            array_push($count_device,
                Device::whereBetween('created_at', [
                    Carbon::now()->subMonth($i + 1)->format('Y-m-d'),
                    Carbon::now()->subMonth(($i))->format('Y-m-d')
                ])->where("is_active", '=', $vale)->count());
        }
        return $count_device;
    }
}
