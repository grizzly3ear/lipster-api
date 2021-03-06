<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreAddressForLipstickColorResource extends JsonResource
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
            'name' => $this->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address_detail' => $this->address_detail,
            'period' => $this->period,
            'tel' => $this->tel,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
