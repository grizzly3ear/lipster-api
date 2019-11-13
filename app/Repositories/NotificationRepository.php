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

    public function findByUser($user) {
        $notifications = $user->notifications;
        $this->setBadge($user);
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

    public function setBadge($user)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(2419200);

        $unread_notification = count($user->notifications->where('read', 0));
        $notificationBuilder = new PayloadNotificationBuilder('');
        $notificationBuilder->setBody('')
                            ->setClickAction('setBadge')
                            ->setBadge($unread_notification);

        $dataBuilder = new PayloadDataBuilder();

        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = $user->notification_token;

        FCM::sendTo($token, $option, $notification, $data);

        return $token;
    }

    public function pushToUsers($users, $title, $body, $model, $name) {
        
        $result;
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60*20);
        
        foreach ($users as $user) {
            $notificationData = [
                'title' => $title,
                'body' => $body,
                'name' => $name,
                'user_id' => $user->id
            ];

            $result = $model->notifications()->create($notificationData);

            $unread_notification = count($user->notifications->where('read', 0));

            $notificationBuilder = new PayloadNotificationBuilder($title);
            $notificationBuilder->setBody($body)
                                ->setSound('default')
                                ->setClickAction($name)
                                ->setBadge($unread_notification);

            $dataBuilder = new PayloadDataBuilder();
            $dataBuilder->addData(["data" => $model->id]);
    
            $option = $optionBuilder->build();
            $notification = $notificationBuilder->build();
            $data = $dataBuilder->build();
    
            // $tokens = $users->pluck('notification_token')->toArray();
            // $token = "fL57GR6wt_s:APA91bFfvXZgwxrQHswcBmH4_qM2I0exQHOmgI6_lK6PLDiBZVqm6jwp9M81YwjOVrY3kbylVoqUdyYZ6jvta9RLfZ-uVg-Er-Df2LWpjronfaHL7hK-7zzKw3botuagHCl4VtuWER3A";
            $token = $user->notification_token;
            // dd($token);
            if (!is_null($token)) {
                $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
            }
        }
        
        return $result;
    }

    public function changeNotificationState($notification_id, $state = 1)
    {
        $notification = $this->findById($notification_id);
        $notification->read = $state;
        $notification->save();

        return $notification;
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
