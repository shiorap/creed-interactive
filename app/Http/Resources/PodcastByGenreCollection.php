<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PodcastByGenreCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $hasPrevious = ($this->currentPage() > 1);
        $hasNext = ($this->currentPage() < $this->lastPage());

        return [
            'podcasts' => $this->collection,
            'total'=> $this->total(),
            'has_next'=> $hasNext,
            'has_previous'=> $hasPrevious,
            'page_number'=> $this->currentPage(),
            'previous_page_number'=> ($hasPrevious) ? $this->currentPage() - 1 : $this->currentPage(),
            'next_page_number' => ($hasNext) ? $this->currentPage() + 1 : $this->currentPage(),
        ];
    }
}
