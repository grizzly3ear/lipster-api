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
        $query = explode(',', $request->query('part'));

        $request->merge([
            'part' => preg_replace('(favoriteLipstick)', ',', $request->query('part'))
        ]);

        return [
            'id' => $this->id,
            'user' => $this->firstname . ' ' . $this->lastname,
            'favorite_colors' => $this->when(in_array('color', $query), LipstickColorResource::collection($this->favoriteLipsticks))
        ];
    }
}
