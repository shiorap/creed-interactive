<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenrePodcast extends Model
{
    public $timestamps = false;

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
