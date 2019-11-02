<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\NotificationRepositoryInterface;
use App\Http\Resources\NotificationResource;
use App\Repositories\NotificationRepository;
use App\Models\Notification;


class NotificationController extends Controller
{
    protected $notificationRepository;

    public function __construct(Notification $notification) {
        $this->notificationRepository = new NotificationRepository($notification);
    }

    public function getAllNotification () {

        $notifications = $this->notificationRepository->findAll();

        return NotificationResource::collection($notifications);
    }

    public function getNotificationById ($notification_id) {
        $notification = $this->notificationRepository->findById($notification_id);

        return new NotificationResource($notification);
    }

    public function createNotification (Request $request) {
        $notification = $this->notificationRepository->store($request->input());

        return $this->notificationRepository->store($request->only($this->notificationRepository->getModel()->fillable));
    }

    public function updateNotificationById (Request $request, $notification_id) {
        $notification = $this->notificationRepository->update($notification_id, $request->input());

        return new NotificationResource($notification);
    }

    public function deleteNotificationById ($notification_id) {
        $notification_id = $this->notificationRepository->deleteById($notification_id);

        return  $notification_id;
    }
}
