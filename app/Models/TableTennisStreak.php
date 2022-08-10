<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class TableTennisStreak extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'tabletennis_streak';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'streak',
        'user_1_id',
        'user_2_id',
        'user_1_wins',
        'user_2_wins',
    ];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user_1_id', 'id')->select('id','name','image_url');
    }
    public function user2()
    {
        return $this->belongsTo(User::class, 'user_2_id', 'id')->select('id','name','image_url');
    }
}
