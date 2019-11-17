<?php

namespace App\Repositories;

interface NotificationRepositoryInterface
{
    public function findAll();
    public function findById($notification_id);
    public function store($data, $user);
    public function update($notification_id, $data);
    public function deleteById($notification_id);
    public function findByUser($user);
    public function pushAllNotification($topicGroup, $title, $body, $name, $model);
    public function pushToUsers($users, $title, $body, $model, $name);
    public function setBadge($user);
    public function changeNotificationState($notification_id, $state = 1);
}
