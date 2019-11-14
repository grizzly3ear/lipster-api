<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\StoreHasLipstickRepositoryInterface;
use App\Http\Resources\StoreHasLipstickResource;
use App\Repositories\StoreHasLipstickRepository;
use App\Models\StoreHasLipstick;

class StoreHasLipstickController extends Controller
{
    protected $storeHasLipstickRepository;

    public function __construct(StoreHasLipstick $storeHasLipstick) {
        $this->storeHasLipstickRepository = new StoreHasLipstickRepository($storeHasLipstick);
    }

    public function getAllStoreHasLipstick () {
        $storeHasLipsticks = $this->storeHasLipstickRepository->findAll();

        return StoreHasLipstickResource::collection($storeHasLipsticks);
    }

    public function getStoreHasLipstickById ($storeHasLipstick_id) {
        $storeHasLipstick = $this->storeHasLipstickRepository->findById($storeHasLipstick_id);

        return new StoreHasLipstickResource($storeHasLipstick);
    }

    public function createStoreHasLipstick (Request $request) {
        $this->validate($request, [
            'lipstick_color_id' => 'unique:store_has_lipstick,lipstick_color_id,NULL,id,store_address_id,' . $request->store_address_id,
            'store_address_id' => 'unique:lipstick_color,store_address_id,NULL,id,lipstick_color_id,' . $request->lipstick_color_id,
        ]);

        return $this->storeHasLipstickRepository->store($request->only($this->storeHasLipstickRepository->getModel()->fillable));
    }

    public function updateStoreHasLipstickById (Request $request, $storeHasLipstick_id) {
        $this->validate($request, [
            'lipstick_color_id' => 'required|Integer',
            'store_address_id' => 'required|Integer'
        ]);

        $storeHasLipstick = $this->storeHasLipstickRepository->update($storeHasLipstick_id, $request->input());

        return new StoreHasLipstickResource($storeHasLipstick);
    }

    public function deleteStoreHasLipstickById ($storeHasLipstick_id) {
        $storeHasLipstick_id = $this->storeHasLipstickRepository->deleteById($storeHasLipstick_id);

        return response()->json($storeHasLipstick_id, 200);
    }
}
