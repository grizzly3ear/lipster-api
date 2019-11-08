<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\FavoriteLipstickRepositoryInterface;
use App\Http\Resources\FavoriteLipstickResource;
use App\Repositories\FavoriteLipstickRepository;
use App\Repositories\UserRepository;
use App\Models\FavoriteLipstick;
use App\Models\User;

class FavoriteLipstickController extends Controller
{
    protected $favoriteLipstickRepository;
    protected $userRepository;

    public function __construct(FavoriteLipstick $favoriteLipstick, User $user) {
        $this->favoriteLipstickRepository = new FavoriteLipstickRepository($favoriteLipstick);
        $this->userRepository = new UserRepository($user);
    }

    public function getAllFavoriteLipstick () {
        $favoriteLipsticks = $this->favoriteLipstickRepository->findAll();

        return $favoriteLipsticks;
    }

    public function getFavoriteLipstickById ($favoriteLipstick_id) {
        $favoriteLipstick = $this->favoriteLipstickRepository->findById($favoriteLipstick_id);

        return $favoriteLipstick;
    }

    public function createFavoriteLipstick (Request $request) {
        $user = $this->userRepository->findById($request->user()->id);

        return $this->favoriteLipstickRepository->store($user, $request->only($this->favoriteLipstickRepository->getModel()->fillable));
    }

    public function deleteFavoriteLipstickById ($lipstick_color_id, Request $request) {
        $favoriteLipstick_id = $this->favoriteLipstickRepository->deleteById($lipstick_color_id, $request->user());

        return $favoriteLipstick_id;
    }
}
