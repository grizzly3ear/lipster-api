<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->firstname . ' ' . $this->lastname,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'image' => $this->image,
            'gender' => $this->gender,
            'skin_color' => $this->skin_color,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'reviews' => ReviewResource::collection($this->reviews),

        ];
    }
}
