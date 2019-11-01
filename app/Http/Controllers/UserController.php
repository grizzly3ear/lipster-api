<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use App\Http\Resources\FavoriteLipstickResource;
use App\Repositories\UserRepository;
use App\Models\User;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(User $user) {
        $this->userRepository = new UserRepository($user);
    }

    public function getAllUser () {
        $users = $this->userRepository->findAll();

        return UserResource::collection($users);
    }

    public function getUserById ($user_id) {
        $user = $this->userRepository->findById($user_id);

        return new UserResource($user);
    }

    public function getFavoriteLipstickByUserId ($user_id) {
        $user = $this->userRepository->findById($user_id);

        return  new FavoriteLipstickResource($user);
    }

    public function createUser (Request $request) {
        $this->validate($request, [
            'firstname' => 'required|max:255|String',
            'lastname' => 'required|max:255|String',
            'gender' => 'required|max:255|String',
            'skin_color' => 'required|String',
            'email' => 'required|unique:user|String',
            'password' => 'required|min:8|String'
        ]);


        return $this->userRepository->store($request->only($this->userRepository->getModel()->fillable));
    }

    public function updateUserById (Request $request, $user_id) {
        $this->validate($request, [
            'firstname' => 'required|max:255|String',
            'lastname' => 'required|max:255|String',
            'gender' => 'required|max:255|String',
            'skin_color' => 'required|String',
            'email' => 'required|unique:user|String',
            'password' => 'required|min:8|String'
        ]);


        $user = $this->userRepository->update($user_id, $request->input());

        return new UserResource($user);
    }

    public function deleteUserById ($user_id) {
        $user_id = $this->userRepository->deleteById($user_id);

        return  $user_id;
    }

    public function setNotificationToken(Request $request) {
        $this->validate($request, [
            'user' => 'required'
        ]);

        $notification_token = $this->userRepository->setNotificationToken($request->user()->id, $request->notification_token);

        return $notification_token;
    }
}
