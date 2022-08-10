<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class BookCategoryRelation extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'books_categories_relation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'book_id',
        'category_id',

    ];


    public function book()
    {
        return $this->hasMany(Book::class, 'id', 'book_id');
    }
    public function category_list()
    {
        return $this->belongsTo(BookCategory::class, 'category_id', 'id');
    }
}
