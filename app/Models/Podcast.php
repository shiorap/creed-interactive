<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    public $fillable = [
        'unique_id',
        'title',
        'publisher',
        'image',
        'thumbnail',
        'listennotes_url',
        'total_episodes',
        'description',
        'itunes_id',
        'rss',
        'language',
        'country',
        'website',
        'is_claimed',
        'type'
    ];

    public function genres()
    {
        return $this->belongsToMany(GenrePodcast::class, 'genre_podcasts', 'podcast_id', 'genre_id');
    }
}
