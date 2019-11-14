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
<<<<<<< Updated upstream


        return [
            'id' => $this->pivot->id,
            'comment' => $this->pivot->comment,
            'skin_color' => $this->pivot->skin_color,
            'rating' => $this->pivot->rating,
            'created_at' => $this->pivot->created_at,
            'updated_at' => $this->pivot->updated_at,
            'lipstick_color' => new LipstickColorResource($this),

=======
        return [
            'id' => $this->id,
            'skin_color' => $this->skin_color,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'user_id' => $this->user_id,
            'lipstick_color_id' => $this->lipstick_color_id
>>>>>>> Stashed changes
        ];
    }
}
