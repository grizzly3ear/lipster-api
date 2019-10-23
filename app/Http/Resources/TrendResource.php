<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrendResource extends JsonResource{

    public function toArray($request)
    {
        $query = explode(',', $request->query('part'));

        $request->merge([
            'part' => preg_replace('(trend)', ',', $request->query('part'))
        ]);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
            'skin_color' => $this->skin_color,
            'description' => $this->description,
            'lipstick_color' => $this->lipstick_color,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
