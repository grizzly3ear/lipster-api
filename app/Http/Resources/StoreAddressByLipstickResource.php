<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreAddressByLipstickResource extends JsonResource
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
            'part' => preg_replace('(store)', ',', $request->query('part'))
        ]);

        return [
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address_detail' => $this->address_detail,
            'tel' => $this->tel,
            'price' => $this->pivot->price,
            'store' => $this->when(in_array('store', $query), new StoreResource($this->store)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
