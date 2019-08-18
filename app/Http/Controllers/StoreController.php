<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\StoreRepositoryInterface;
use App\Http\Resources\StoreResource;
use App\Repositories\StoreRepository;
use App\Models\Store;

class StoreController extends Controller
{
    protected $storeRepository;

    public function __construct(Store $store) {
        $this->storeRepository = new StoreRepository($store);
    }

    public function getAllStore () {
        $stores = $this->storeRepository->findAll();

        return StoreResource::collection($stores);
    }

    public function getStoreById ($store_id) {
        $store = $this->storeRepository->findById($store_id);

        return new StoreResource($store);
    }

    public function createStore (Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:store|max:255'
        ]);


        return $this->storeRepository->store($request->only($this->storeRepository->getModel()->fillable));
    }

    public function updateStoreById (Request $request, $store_id) {

        $store = $this->storeRepository->update($store_id, $request->input());

        return new StoreResource($store);
    }

    public function deleteStoreById ($store_id) {
        $store_id = $this->storeRepository->deleteById($store_id);

        return $store_id;
    }
}
