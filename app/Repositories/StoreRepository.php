<?php

namespace App\Repositories;

use App\Models\Store;

class StoreRepository implements StoreRepositoryInterface
{

    protected $store;

    public function __construct(Store $store){
        $this->store = $store;
    }

    public function findAll() {
        return Store::all();
    }

    public function findById($store_id) {
        return Store::findOrFail($store_id);
    }

    public function store($data) {
        return $this->store->create($data);
    }

    public function update($store_id, $data) {
        $store = Store::findOrFail($store_id);
        $store->name = $data->name;
        $store->save();

        return $store;
    }

    public function deleteById($store_id) {
        $store = Store::findOrFail($store_id);

        $store->delete();

        return $store->id;
    }

    public function getModel()
    {
        return $this->store;
    }
}
