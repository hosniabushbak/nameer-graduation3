<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\ModelTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Http\Resources\Admin\HouseOwnerResource;
use App\Http\Resources\Admin\BusinessOwnerResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model implements HasMedia
{
    use HasFactory, ModelTrait, SoftDeletes, InteractsWithMedia;

    public $resource;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'id_number',
        'address',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('business_damages')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif']);

        $this->addMediaCollection('business_documents')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/pdf']);

        $this->addMediaCollection('business_licenses')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/pdf']);
    }

    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->where(function($query) use ($search) {
                $query->where('name', 'LIKE', $search)
                    ->orWhere('email', 'LIKE', $search)
                    ->orWhere('phone', 'LIKE', $search)
                    ->orWhere('id_number', 'LIKE', $search);
            });
        }
        return $query;
    }

    public function house()
    {
        return $this->hasOne(House::class);
    }

    public function business()
    {
        return $this->hasOne(Business::class);
    }

    public function scopeHouseOwners($query)
    {
        $this->resource = HouseOwnerResource::class;
        return $query->with('house')->whereHas('house');
    }

    public function scopeBusinessOwners($query)
    {
        $this->resource = BusinessOwnerResource::class;
        return $query->with('business')->whereHas('business');
    }

    public function getFullAddressAttribute()
    {
        return $this->address ?? '-';
    }

    public function getFullPhoneAttribute()
    {
        return $this->phone ?? '-';
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}