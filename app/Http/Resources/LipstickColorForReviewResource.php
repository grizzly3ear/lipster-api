<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LipstickColorForReviewResource extends JsonResource
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
            'composition' => $this->composition,
            'images' => LipstickImageResource::collection($this->lipstickImages),
            'detail' => new LipstickDetailForReviewResource($this->lipstickDetail),
            'brand' => new LipstickBrandForReviewResource($this->lipstickDetail->lipstickBrand),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
