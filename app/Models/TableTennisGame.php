<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class TableTennisGame extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'table_tennis_games';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_1_id',
        'user_1_score',
        'user_2_id',
        'user_2_score',
        'win_margin',
    ];

    public function user1()
    {
        return $this->hasOne(User::class, 'id', 'user_1_id')->select(['id', 'name', 'image_url']);
    }
    public function user2()
    {
        return $this->hasOne(User::class, 'id', 'user_2_id')->select(['id', 'name', 'image_url']);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'id', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'id', 'updated_by');
    }
}
