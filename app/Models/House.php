<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'owner_id',
        'ownership_type',
        'land_area',
        'building_area',
        'floors_count',
        'rooms_count',
        'building_age',
        'damage_level',
        'damage_description',
        'damage_photos',
        'estimated_cost',
        'ownership_document',
        'inspection_report',
        'pre_disaster_address'
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

}