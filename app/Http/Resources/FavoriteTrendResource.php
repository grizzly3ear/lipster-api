<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteTrendResource extends JsonResource
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
            'part' => preg_replace('(favoriteTrend)', ',', $request->query('part'))
        ]);


        return [
            'id' => $this->id,
            'user' => $this->firstname . ' ' . $this->lastname,
            'favorite_trends' => $this->when(in_array('trend', $query), TrendResource::collection($this->favoriteTrends))
        ];
    }
}
