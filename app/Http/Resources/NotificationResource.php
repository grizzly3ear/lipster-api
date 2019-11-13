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
        $all_notification = 0;
        $unread_notification = 0;
        if (!is_null($request->user())) {
            $all_notification = count($request->user()->notifications);
            $unread_notification = count($request->user()->notifications->where('read', '0'));
        }
        return [
            'id' => $this->id,
            'notification_id' => $this->notification_id,
            'name' => $this->name,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'trend_group' => $this->when(in_array('trend_group', $query), new TrendGroupResource($this->notification)),
            'read' => $this->read,
            'unread_notification' => $this->when(!is_null($request->user()), $unread_notification),
            'all_notification' => $this->when(!is_null($request->user()), $all_notification)
        ];
    }
}
