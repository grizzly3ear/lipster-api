<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __consturct__(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAllUser() {
        // $users = $this->userRepository->findAll();

        // return UserResource::collection($users);
    }

    public function getUserById($user_id) {
        // $user = $this->userRepository->findById($user_id);

        // return new UserResource($user);
    }

    public function createUser(Request $request) {
        // this method for validate the variable

        // $user = $this->userRepository->store(...);

        // return new UserResource($user);
    }
}
