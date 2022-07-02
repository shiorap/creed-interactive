<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\GenrePodcast;
use App\Models\Podcast;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class PodcastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = json_decode(File::get(base_path('database/data/podcasts-by-genre.json')));

        // let's create all the genre first.
        // we can only import the genre's that we have data,
        // the rest we can drop
        foreach($content as $genreRaw) {
            Genre::firstOrCreate([
                'id' => $genreRaw->id,
                'name' => $genreRaw->name,
                'listennotes_url' => $genreRaw->listennotes_url
            ]);
        }

        // now that we know we have all the genres,
        // let's import the podcasts
        foreach($content as $genreRaw) {
            foreach($genreRaw->podcasts as $podcastRaw) {
                $podcast = Podcast::find($podcastRaw->id);

                if(!$podcast) {
                    // let's map and sanitize our data
                    $data = json_decode(json_encode($podcastRaw), true);
                    unset($data['genre_ids']);

                    $podcast = Podcast::create($data);
                }

                foreach($podcastRaw->genre_ids as $genre_id) {
                    if($genre = Genre::find($genre_id)) {
                        $podcast->genres()->syncWithoutDetaching($genre);
                    }
                }
            }
        }
    }
}
