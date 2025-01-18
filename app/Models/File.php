<?php

namespace App\Models;

use App\Http\Resources\Admin\ReviewResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'display_name',
        'file_name',
        'mime_type',
        'size',
        'owner_id',
        'owner_type',
    ];
}