<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrendGroupResource extends JsonResource
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
            'part' => preg_replace('(trendGroup)', ',', $request->query('part'))
        ]);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'trends' => $this->when(in_array('trend', $query), TrendResource::collection($this->trends))
        ];
    }
}
