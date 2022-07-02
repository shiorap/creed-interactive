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
        'explicit_content',
        'description',
        'itunes_id',
        'rss',
        'language',
        'country',
        'website',
        'is_claimed',
        'type'
    ];

    protected $perPage = 5;

    protected $hidden = ['unique_id', 'pivot', 'created_at', 'updated_at'];

    protected $appends = [
        'genre_ids'
    ];

    protected $casts = [
        'explicit_content' => 'boolean',
        'is_claimed' => 'boolean'
    ];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_podcasts', 'podcast_unique_id', 'genre_id');
    }

    public function getGenreIdsAttribute()
    {
        return GenrePodcast::wherePodcastId($this->id)->pluck('genre_id');
    }

    public function getIdAttribute()
    {
        return $this->unique_id;
    }
}
