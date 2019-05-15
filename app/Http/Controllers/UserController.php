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

    public function getAllUser () {
        $users = $this->$userRepository->findAll();

        return $users;
    }

    public function getUserById ($user_id) {
        $user = $this->$userRepository->findById($user_id);

        return $user;
    }

    public function createUser (Request $request) {
        $user = $this->$userRepository->store($request->input());

        return $user;
    }

    public function updateUserById (Request $request, $user_id) {
        $user = $this->$userRepository->update($user_id, $request->input());

        return $user;
    }

    public function deleteUserById ($user_id) {
        $user_id = $this->$userRepository->deleteById($user_id);

        return $user_id;
    }
}
