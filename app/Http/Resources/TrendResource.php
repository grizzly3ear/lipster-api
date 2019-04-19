<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrendResource extends JsonResource{

    public function toArray($request)
    {
        return [
            'id' => $this-> id,
            'title' => $this-> title,
            'year' =>  $this-> image,
            'skin_color' => $this-> skin_color,
            'color' => new LipstickColorResource($this -> lipstickColors),
        ];
    }
}