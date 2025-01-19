<?php

namespace App\Models;

use App\Http\Resources\Admin\FaqResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Faq extends Model
{
    public $resource = FaqResource::class;


    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question',
        'answer',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->where(function($query) use ($search) {
                $query->where('question', 'LIKE', $search)
                    ->orWhere('answer', 'LIKE', $search);
            });
        }
        return $query;
    }
}