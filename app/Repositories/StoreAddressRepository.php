<?php

namespace App\Repositories;

use App\Models\StoreAddress;

class StoreAddressRepository implements StoreAddressRepositoryInterface
{
    protected $storeAddress;

    public function __construct(StoreAddress $storeAddress){
        $this->storeAddress = $storeAddress;
    }

    public function findAll() {
        return StoreAddress::all();
    }

    public function findById($storeAddress_id) {
        return StoreAddress::findOrFail($storeAddress_id);
    }

    public function store($data) {
        return $this->storeAddress->create($data);
    }

    public function update($storeAddress_id, $data) {
        $storeAddress = StoreAddress::findOrFail($storeAddress_id);
        $storeAddress->latitude = $data->latitude;
        $storeAddress->longtitude = $data->longtitude;
        $storeAddress->address_detail = $data->address_detail;
        $storeAddress->store_id = $data->store_id;
        $storeAddress->save();

        return $storeAddress;
    }

    public function deleteById($storeAddress_id) {
        $storeAddress = StoreAddress::findOrFail($storeAddress_id);

        $storeAddress->delete();

        return $storeAddress->id;
    }

    public function getModel()
    {
        return $this->storeAddress;
    }
}
