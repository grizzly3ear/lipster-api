<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LipstickDetailResource extends JsonResource
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
            'max_price' => $this->max_price,
            'min_price' => $this->min_price,
            'type' => $this->type,
            'opacity' => $this->opacity,
            'description' => $this->description,
            'composition' => $this->composition,
            'apply' => $this->apply,
            'colors' => LipstickColorResource::collection($this->lipstickColors)
        ];
    }
}
