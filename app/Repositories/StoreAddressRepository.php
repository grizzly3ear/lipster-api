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
        $storeAddress->name = $data['name'];
        $storeAddress->latitude = $data['latitude'];
        $storeAddress->longitude = $data['longitude'];
        $storeAddress->address_detail = $data['address_detail'];
        $storeAddress->store_id = $data['store_id'];
        $storeAddress->period = $data['period'];
        $storeAddress->tel = $data['tel'];
        $storeAddress->save();

        return $storeAddress;
    }

    public function deleteById($request, $storeAddress_id) {
        $storeAddress = StoreAddress::findOrFail($storeAddress_id);

        if(!is_null($request['force'])){
            if($request['force']){
                $storeAddress->delete();
                return 1;
            }else{
                if(count($storeAddress->lipstickColors)){
                    return 0;
                } else {
                    $storeAddress->delete();

                    return 1;
                }
            }
        }

        return $storeAddress->id;
    }

    public function getModel()
    {
        return $this->storeAddress;
    }

    public function getLipstickColors($storeAddress_id) {
        $storeAddresses = StoreAddress::findOrFail($storeAddress_id);

        return $storeAddresses->storeHasLipsticks;
    }
}
