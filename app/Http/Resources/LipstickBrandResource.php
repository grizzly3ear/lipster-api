<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LipstickBrandResource extends JsonResource
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
            'part' => preg_replace('(brand)', ',', $request->query('part'))
        ]);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'details' => LipstickDetailResource::collection($this->lipstickDetails),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
