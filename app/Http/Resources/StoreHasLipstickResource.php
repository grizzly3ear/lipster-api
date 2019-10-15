<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreHasLipstickResource extends JsonResource
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
            'store_address_id' => $this->store_address_id,
            'lipstick_color_id' => $this->lipstick_color_id,
            'price' => $this->price,

        ];
    }
}
