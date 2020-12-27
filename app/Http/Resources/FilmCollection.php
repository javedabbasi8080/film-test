<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;


class FilmCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'description'  => $this->description,
            'release_date' => $this->release_date,
            'description'  => $this->description,
            'ticket_price' => $this->ticket_price,
            'country'      => $this->country,
            'slugs'        => $this->slugs,
            'image'        => !empty($this->gallery) ? url($this->gallery->path):Null,
            'genres'       => !empty($this->genre) ? $this->genre:Null,
        ];
    }
}
