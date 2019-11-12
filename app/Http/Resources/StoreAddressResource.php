<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreAddressResource extends JsonResource
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
            'part' => preg_replace('(address)', ',', $request->query('part'))
        ]);

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
            'lipsticks' => LipstickColorResource::collection($this->lipstickColors),
        ];
    }
}
