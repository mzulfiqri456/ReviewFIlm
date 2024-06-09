<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'movie_id',
        'user_id',
        'comment',
        'rating',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class, 'movie_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
