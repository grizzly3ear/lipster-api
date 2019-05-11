<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LipstickDetailReverseResource extends JsonResource
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
            'brand' =>  $this->lipstickBrand->name,
            'id' => $this-> id,
            'name' => $this-> name,
            'max_price' => $this-> max_price,
            'min_price' => $this-> min_price,
            'type' => $this-> type,
            'opacity' => $this-> opacity,
            'description' => $this-> description, 
            'composition' => $this-> composition, 
            'apply' => $this-> apply, 
            'lipstick_brand_id' => $this->lipstick_brand_id
        ];
    }
}
