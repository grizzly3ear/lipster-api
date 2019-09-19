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
        $query = explode(',', $request->query('part'));

        $request->merge([
            'part' => preg_replace('(detail)', ',', $request->query('part'))
        ]);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'min_price' => $this->min_price,
            'max_price' => $this->max_price,
            'type' => $this->type,
            'opacity' => $this->opacity,
            'description' => $this->description,
            'apply' => $this->apply,
            'colors' => $this->when(in_array('color', $query), LipstickColorResource::collection($this->lipstickColors)),
            'brand' => $this->when(in_array('brand', $query), new LipstickBrandResource($this->lipstickBrand))
        ];
    }
}
