<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'name' => $this->name,
            'addresses' => $this->when(in_array('address', $query), StoreAddressResource::collection($this->storeAddresses))
        ];
    }
}
