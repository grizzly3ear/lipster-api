<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
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
        $store = new store();
        if (!is_null($data['image'])){

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/store/' . $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $store->image = $url;
            $store->path = $file_path;
        }
        $store->name = $data['name'];
        $store->save();

        return $store;
    }

    public function update($store_id, $data) {
        $store = Store::findOrFail($store_id);
        if (!is_null($data['image'])){
            Storage::disk('s3')->delete($store->path);

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/store/' . $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $store->image = $url;
            $store->path = $file_path;
        }
        $store->name = $data['name'];
        $store->save();

        return $store;
    }

    public function deleteById($request, $store_id) {
        $store = Store::findOrFail($store_id);

        Storage::disk('s3')->delete($store->path);

        if(!is_null($request['force'])){
            if($request['force']){
                $store->delete();
                return 1;
            }else{
                if(count($store->storeAddresses)){
                    return 0;
                } else {
                    $store->delete();

                    return 1;
                }
            }
        }
    }

    public function getModel()
    {
        return $this->store;
    }
}
