<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public $fillable = [
        'id',
        'name',
        'listennotes_url'
    ];

    public function podcasts()
    {
        return $this->belongsToMany(Podcast::class, 'genre_podcasts', 'genre_id', 'podcast_id');
    }
}
