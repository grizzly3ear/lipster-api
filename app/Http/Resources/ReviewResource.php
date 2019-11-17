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
            'id' => $this->pivot->id,
            'comment' => $this->pivot->comment,
            'skin_color' => $this->pivot->skin_color,
            'rating' => $this->pivot->rating,
            'created_at' => $this->pivot->created_at,
            'updated_at' => $this->pivot->updated_at,
            'lipstick_color' => new LipstickColorForReviewResource($this),

        ];
    }
}
