<?php

namespace Database\Seeders;

use App\Models\Genre;
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

        foreach($content as $genreRaw) {
            $genre = Genre::firstOrCreate([
                'id' => $genreRaw->id,
                'name' => $genreRaw->name,
                'listennotes_url' => $genreRaw->listennotes_url
            ]);

            foreach($genreRaw->podcasts as $podcastRaw) {
                $podcast = Podcast::whereUniqueId($podcastRaw->id)->first();

                if(!$podcast) {
                    // let's map and sanitize our data
                    $data = json_decode(json_encode($podcastRaw), true);
                    $data['unique_id'] = $data['id'];
                    unset($data['id']);
                    unset($data['genre_ids']);

                    $podcast = Podcast::create($data);
                    print_r($data);
                }

                $podcast->genres()->sync($genre);
            }
        }
    }
}
