<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'movies';

    protected $fillable = [
        'title',
        'foto',
        'description',
        'release_date',
        'genre',
        'director',
        'rating',
    ];

    public function genres()
    {
        return $this->belongsToMany(Kategori::class, 'film_genre', 'film_id', 'genre_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'movie_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($film) {
            $film->reviews()->delete();
        });
    }
}
