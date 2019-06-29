<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LipstickColorResource extends JsonResource
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
            'color_name' => $this->color_name,
            'rgb' => $this->rgb,
            'color_code' => $this->color_code,
            'lipstick_detail_id' => $this->lipstick_detail_id,
            'images' => LipstickImageResource::collection($this->whenLoaded('lipstickImages')),
            'detail' => $this->lipstickDetail->description,
            'brand' => $this->lipstickDetail->lipstickBrand
        ];
    }
}



