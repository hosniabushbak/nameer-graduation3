<?php

namespace App\Models;

use App\Http\Resources\Admin\StudentResource;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class HouseOwner extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens, ModelTrait;
    
    protected $guarded = [];
    protected $table = 'owners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'mac_id',
        'phone_code',
        'phone',
        'email',
        'email_verified_at',
        'username',
        'password',
        'remember_token',
        'status',
        'image',
        'otp',
        'otp_expired_at',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function scopeSearch($query, $request)
    {
        if (!empty($request->search['value'])) {
            $search = '%' . $request->search['value'] . '%';
            return $query->where(function($r) use ($search){
                    $r->where('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%');
            });
            // return $query->where('first_name', 'LIKE' , '%' . $search . '%');
        }
        return $query;
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses', 'student_id', 'course_id');
    }

    // get the details of this purchased course
    public function course($course_id)
    {
        return $this->belongsToMany(Course::class, 'student_courses', 'student_id', 'course_id')->where('course_id', $course_id)->withPivot('price')->first();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
 
    public function getDescriptionAttribute()
    {
        if (App::getLocale() === 'en') {
            return $this->description_en;
        } else {
            return $this->description_ar;
        }
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // get the details of selected course order
    public function order($course_id)
    {
        return $this->hasMany(Order::class)->where('course_id', $course_id)->first();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}
