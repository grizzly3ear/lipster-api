<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteLipstickResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->firstname . ' ' . $this->lastname,
            'favorite_colors' => LipstickColorResource::collection($this->favoriteLipsticks),
        ];;
    }
}
