<?php

namespace App\Repositories;

use App\Models\Notification;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

use LaravelFCM\Message\Topics;

use App\Models\User;

class NotificationRepository implements NotificationRepositoryInterface
{
    protected $notification;

    public function __construct(Notification $notification){
        $this->notification = $notification;
    }

    public function findAll() {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder('my title');
        $notificationBuilder->setBody('Hello world')
                            ->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = "fhxcTOC15Vs:APA91bGvGDm06l-ZxWQQvL89VEShLX_NtqdoJJW_ACTfEBZSUOVscY7tjHIT_8s9ST6dvS0CNw9uw54G3Pr6NftW08fiXckOOUbShZwq2nrmhByZOdCtj-oIKRA5HSPknNTqidNi71-D";

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        $downstreamResponse->numberSuccess();

        return Notification::all();
    }

    public function findById($notification_id) {
        return Notification::findOrFail($notification_id);
    }

    public function findByUserId($user_id) {
        $notifications = Notification::where('user_id', $user_id)->get();
        return $notifications;
    }

    public function store($data, $user) {
        $notification = new Notification();
        $notification->name = $data['name'];
        $notification->title = $data['title'];
        $notification->body = $data['body'];
        $notification->user_id = $user->id;

        return $notification;

    }

    public function pushAllNotification($topicGroup, $title, $body, $name) {
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                            ->setSound('default')
                            ->setClickAction($name);

        $notification = $notificationBuilder->build();

        $topic = new Topics();
        $topic->topic($topicGroup);

        $topicResponse = FCM::sendToTopic($topic, null, $notification, null);

        return $topicResponse->isSuccess();
    }

    public function pushToUser($users, $title, $body, $model, $name) {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                            ->setSound('default')
                            ->setClickAction($name);


        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData([$name."_data" => $model->id]);

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $tokens = $users->pluck('notification_token')->toArray();

        $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);

        $result;

        foreach ($users as $user) {
            $notificationData = [
                'title' => $title,
                'body' => $body,
                'name' => $name,
                'user_id' => $user->id
            ];
            // $notification = $this->store($notificationData, $userRender);
            $result = $model->notifications()->create($notificationData);
        }

        return $result;
    }

    public function update($notification_id, $data) {
        $notification = LipstickBrand::findOrFail($notification_id);
        $notification->name = $data['name'];
        $notification->title = $data['title'];
        $notification->body = $data['body'];
        $notification->save();

        return $notification;
    }

    public function deleteById($notification_id) {
        $notification = Notification::findOrFail($notification_id);

        $notification->delete();

        return $notification->id;
    }

    public function getModel()
    {
        return $this->notification;
    }
}
