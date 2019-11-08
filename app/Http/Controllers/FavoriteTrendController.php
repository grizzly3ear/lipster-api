<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\FavoriteTrendRepositoryInterface;
use App\Http\Resources\FavoriteTrendResource;
use App\Repositories\FavoriteTrendRepository;
use App\Repositories\UserRepository;
use App\Models\FavoriteTrend;
use App\Models\User;

class FavoriteTrendController extends Controller
{
    protected $favoriteTrendRepository;
    protected $userRepository;

    public function __construct(FavoriteTrend $favoriteTrend, User $user) {
        $this->favoriteTrendRepository = new FavoriteTrendRepository($favoriteTrend);
        $this->userRepository = new UserRepository($user);
    }

    public function getAllFavoriteTrend () {
        $favoriteTrends = $this->favoriteTrendRepository->findAll();

        return $favoriteTrends;
    }

    public function getFavoriteTrendById ($favoriteTrend_id) {
        $favoriteTrend = $this->favoriteTrendRepository->findById($favoriteTrend_id);

        return $favoriteTrends;
    }

    public function createFavoriteTrend (Request $request) {
        $user = $this->userRepository->findById($request->user()->id);

        return $this->favoriteTrendRepository->store($user, $request->only($this->favoriteTrendRepository->getModel()->fillable));
    }

    public function deleteFavoriteTrendById ($favoriteTrend_id) {
        $favoriteTrend_id = $this->favoriteTrendRepository->deleteById($favoriteTrend_id);

        return response()->json($favoriteTrend_id, 200);
    }
}
