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
        $query = explode(',', $request->query('part'));

        $request->merge([
            'part' => preg_replace('(color)', ',', $request->query('part'))
        ]);

        return [
            'id' => $this->id,
            'color_name' => $this->color_name,
            'rgb' => $this->rgb,
            'color_code' => $this->color_code,
            'images' => LipstickImageResource::collection($this->lipstickImages),
            'detail' => $this->when(in_array('detail', $query), new LipstickDetailResource($this->lipstickDetail)),
            'brand' => $this->when(in_array('brand', $query), new LipstickBrandResource($this->lipstickDetail->lipstickBrand))
        ];
    }
}



