<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'part' => preg_replace('(notification)', ',', $request->query('part'))
        ]);

        return [
            'id' => $this->id,
            'notification_id' => $this->notification_id,
            'name' => $this->name,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'trend_group' => $this->when(in_array('trend_group', $query), new TrendGroupResource($this->notification)),
        ];
    }
}
