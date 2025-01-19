<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Business extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'owner_id',
        'business_name',
        'commercial_registration',
        'pre_disaster_address',
        'business_type',
        'land_area',
        'building_area',
        'employees_count',
        'building_age',
        'damage_level',
        'equipment_losses',
        'inventory_losses',
        'damage_photos',
        'estimated_cost',
        'ownership_document',
        'licenses',
        'inspection_report'
    ];

    protected $casts = [
        'damage_photos' => 'array',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('damage_photos')->useDisk('public');
    }

    public function getDamagePhotosUrlsAttribute()
    {
        $damagePhotos = $this->getMedia('damage_photos');
        return $damagePhotos->map(function($media) {
            return $media->getUrl();
        })->toArray();
    }
}