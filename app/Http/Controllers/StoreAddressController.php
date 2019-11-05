<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\StoreAddressRepositoryInterface;
use App\Http\Resources\StoreAddressResource;
use App\Http\Resources\LipstickColorByStoreAddressResource;
use App\Repositories\StoreAddressRepository;
use App\Models\StoreAddress;

class StoreAddressController extends Controller
{
    protected $storeAddressRepository;

    public function __construct(StoreAddress $storeAddress) {
        $this->storeAddressRepository = new StoreAddressRepository($storeAddress);
    }

    public function getAllStoreAddress () {
        $storeAddresses = $this->storeAddressRepository->findAll();

        return StoreAddressResource::collection($storeAddresses);
    }

    public function getStoreAddressById ($storeAddress_id) {
        $storeAddress = $this->storeAddressRepository->findById($storeAddress_id);

        return new StoreAddressResource($storeAddress);
    }

    public function createStoreAddress (Request $request) {
        $this->validate($request, [
            'latitude' => 'required',
            'longitude' => 'required',
            'address_detail' => 'required|String',
            'store_id' => 'required|Integer',
        ]);


        return $this->storeAddressRepository->store($request->only($this->storeAddressRepository->getModel()->fillable));
    }

    public function updateStoreAddressById (Request $request, $storeAddress_id) {
        $this->validate($request, [
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'address_detail' => 'required|String',
            'store_id' => 'required|Integer',
        ]);

        $storeAddress = $this->storeAddressRepository->update($storeAddress_id, $request->input());

        return new StoreAddressResource($storeAddress);
    }

    public function deleteStoreAddressById (Request $request, $storeAddress_id) {
        $storeAddress_id = $this->storeAddressRepository->deleteById($request->input(), $storeAddress_id);

        return $storeAddress_id;
    }

    public function getLipstickColors ($storeAddress_id) {
        $lipstickColors = $this->storeAddressRepository->getLipstickColors($storeAddress_id);

        return LipstickColorByStoreAddressResource::collection($lipstickColors);
    }
}
