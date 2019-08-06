<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'user' => $this->user->firstname . ' ' . $this->user->lastname,
            'comment' => $this->comment,
            'skin_color' => $this->skin_color,
            'rating' => $this->rating,
            'created_at' => $this->created_at,

        ];
    }
}
