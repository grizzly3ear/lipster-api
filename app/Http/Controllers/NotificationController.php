<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\NotificationRepositoryInterface;
use App\Http\Resources\NotificationResource;
use App\Repositories\NotificationRepository;
use App\Models\Notification;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class NotificationController extends Controller
{
    protected $notificationRepository;

    public function __construct(Notification $notification) {
        $this->notificationRepository = new NotificationRepository($notification);
    }

    public function getAllNotification () {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('Hi');
        $notificationBuilder->setBody('Bank!!!')
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "fhxcTOC15Vs:APA91bGvGDm06l-ZxWQQvL89VEShLX_NtqdoJJW_ACTfEBZSUOVscY7tjHIT_8s9ST6dvS0CNw9uw54G3Pr6NftW08fiXckOOUbShZwq2nrmhByZOdCtj-oIKRA5HSPknNTqidNi71-D";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();

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
