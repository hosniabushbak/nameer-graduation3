<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use HasFactory, SoftDeletes;

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
        'licenses' => 'array',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }
}