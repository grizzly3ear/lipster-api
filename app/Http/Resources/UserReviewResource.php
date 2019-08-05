<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserReviewResource extends JsonResource
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
            'user' => $this->firstname . ' ' . $this->lastname,
            'comment' => $this->pivot->comment,
            'skin_color' => $this->pivot->skin_color,
            'rating' => $this->pivot->rating,
            'created_at' => $this->pivot->created_at
        ];
    }
}
