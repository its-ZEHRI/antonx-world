<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'atn_number',
        'name',
        'email',
        'password',
        'contact',
        'current_address',
        'image_url',
        'gender',
        'job_type',
        'color',
        'joining_date',
        'date_of_birth',
        'created_by',
        'updated_by',
        'blood_group',
        'role_id',
        'designation_id',
        'isCheckin',
        'cafe_bill',
        'postal_address'
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
    ];


    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }
    public function designation()
    {
        return $this->belongsTo(UserDesignation::class, 'designation_id', 'id');
    }

    public function user_streak()
    {
        return $this->hasOne(Streak::class, 'user_id', 'id');
    }

    public function education()
    {
        return $this->hasMany(UserEducation::class, 'user_id', 'id');
    }

    public function user_social_links()
    {
        return $this->hasMany(UserLink::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->hasMany(UserCompany::class, 'user_id', 'id');
    }

    public function featured_user()
    {
        return $this->hasMany(FeaturedUser::class, 'user_id', 'id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id');
    }
    public function week_attendances()
    {
        $endDate = date('Y-m-d', strtotime('-7 days'));
        // show attendance statistic from now to last 30 days
        // $current_hours = Attendance::selectRaw('sum(total_hours_inSec) as seconds')
        //     ->whereDate('date', '>', $endDate)->whereDate('date', '<', get_date())
        //     ->whereColumn('user_id', 'users.id')->getQuery();
        return $this->hasMany(Attendance::class, 'user_id', 'id')->whereDate('date', '>', $endDate);
    }

    public function purchases()
    {
        return $this->hasMany(PurchaseCafeItemHistory::class, 'user_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
