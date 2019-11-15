<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\TrendGroupRepository;
use App\Repositories\NotificationRepository;
use App\Http\Resources\TrendGroupResource;
use App\Models\TrendGroup;
use App\Models\Notification;
use App\Models\User;

class TrendGroupController extends Controller
{
    protected $trendGroupRepository;
    protected $notificationRepository;

    public function __construct(TrendGroup $trendGroup, Notification $notification) {
        $this->trendGroupRepository = new TrendGroupRepository($trendGroup);
        $this->notificationRepository = new NotificationRepository($notification);
    }

    public function getAllTrendGroup () {
        $trendGroups = $this->trendGroupRepository->findAll();

        return TrendGroupResource::collection($trendGroups);
    }

    public function getTrendGroupById ($trend_group_id) {
        $trendGroup = $this->trendGroupRepository->findById($trend_group_id);

        return new TrendGroupResource($trendGroup);
    }

    public function createTrendGroup (Request $request) {
        $trend_group = $this->trendGroupRepository->store($request->only($this->trendGroupRepository->getModel()->fillable));        return $trend_group;
    }

    public function updateTrendGroupById (Request $request, $trend_group_id) {
        $this->validate($request, [
            'name' => 'string|required',
        ]);

        $trendGroup = $this->trendGroupRepository->update($trend_group_id, $request->input());

        return new TrendGroupResource($trendGroup);
    }

    public function deleteTrendGroupById (Request $request, $trend_group_id) {
        $trend_group_id = $this->trendGroupRepository->deleteById($request->input(), $trend_group_id);

        return $trend_group_id;
    }

    public function release (Request $request, $trend_group_id) {
        if($request->release) {
            $trend_group = $this->trendGroupRepository->findById($trend_group_id);
            //for non login user
            $result = $this->notificationRepository->pushAllNotification("non_login", $request->title, $request->body, "trend_group");
            $notifications = $this->notificationRepository->pushToUsers(User::all(), $request->title, $request->body, $trend_group, "trend_group");
            $trendGroupData = [
                'name' => $trend_group->name,
                'description' => $trend_group->description,
                'image' => $trend_group->image,
                'release_date' => $notifications->created_at
            ];
            $this->trendGroupRepository->update($trend_group_id, $trendGroupData);
            return $notifications;
        }else{
            return "Can not release notification";
        }
    }
}
