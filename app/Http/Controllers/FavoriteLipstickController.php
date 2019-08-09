<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\FavoriteLipstickRepositoryInterface;
use App\Http\Resources\FavoriteLipstickResource;
use App\Repositories\FavoriteLipstickRepository;
use App\Models\FavoriteLipstick;

class FavoriteLipstickController extends Controller
{
    protected $favoriteLipstickRepository;

    public function __construct(FavoriteLipstick $favoriteLipstick) {
        $this->favoriteLipstickRepository = new FavoriteLipstickRepository($favoriteLipstick);
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
        $this->validate($request, [
            'lipstick_color_id' => 'required|Integer',
        ]);

        return $this->favoriteLipstickRepository->store($request->user(), $request->only($this->favoriteLipstickRepository->getModel()->fillable));
    }

    public function deleteFavoriteLipstickById ($lipstick_color_id, Request $request) {
        $favoriteLipstick_id = $this->favoriteLipstickRepository->deleteById($lipstick_color_id, $request->user());

        return $favoriteLipstick_id;
    }
}
