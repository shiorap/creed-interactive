<?php

namespace App\Http\Controllers;

use App\Http\Resources\PodcastByGenreCollection;
use App\Models\Genre;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PodcastController extends Controller
{
    /**
     * Display a list of podcast by genre
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $genre = Genre::findOrFail($request->get('genre_id'));
        $podcasts = $genre->podcasts()->paginate(5);

        $hasPrevious = ($podcasts->currentPage() > 1);
        $hasNext = ($podcasts->currentPage() < $podcasts->lastPage());

        return response()->json([
            'id' => $genre->id,
            'name' => $genre->name,
            'podcasts' => $podcasts->getCollection(),
            'total'=> $podcasts->total(),
            'has_next'=> $hasNext,
            'has_previous'=> $hasPrevious,
            'page_number'=> $podcasts->currentPage(),
            'previous_page_number'=> ($hasPrevious) ? $podcasts->currentPage() - 1 : $podcasts->currentPage(),
            'next_page_number' => ($hasNext) ? $podcasts->currentPage() + 1 : $podcasts->currentPage(),
        ]);

        // could have used api resource for cleaner result set
        // but it will add additional meta/links that is unnecessary
        // and we don't want to override the whole framework yet for
        // a simple task
        /*return (new PodcastByGenreCollection($podcast))
            ->additional(['data' => [
                'id' => $genre->id,
                'name' => $genre->name,
                'listennotes_url' => $genre->listennotes_url
            ]]);*/
    }
}
