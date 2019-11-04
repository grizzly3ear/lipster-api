<?php

namespace App\Repositories;

interface NotificationRepositoryInterface
{
    public function findAll();
    public function findById($notification_id);
    public function store($data, $user);
    public function update($notification_id, $data);
    public function deleteById($notification_id);
    public function findByUserId($user_id);
    public function pushAllNotification($topic, $title, $body, $name);
    public function pushToUser($users, $title, $body, $model, $name);
}
