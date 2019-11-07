<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
use App\Models\LipstickBrand;

class LipstickBrandRepository implements LipstickBrandRepositoryInterface
{
    protected $lipstickBrand;

    public function __construct(LipstickBrand $lipstickBrand){
        $this->lipstickBrand = $lipstickBrand;
    }
    public function findAll() {
        $lipstickBrand = LipstickBrand::all();
        $sorted = $lipstickBrand->sortBy('name');
        $sorted->values()->all();

        return $sorted;
    }

    public function findById($lipstickBrand_id) {
        $lipstickBrand = LipstickBrand::findOrFail($lipstickBrand_id);

        return $lipstickBrand;
    }

    public function store(array $data) {
        $lipstickBrand = new LipstickBrand();
        if (!is_null($data['image'])){

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/brand/' . $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $lipstickBrand->image = $url;
            $lipstickBrand->path = $file_path;
        }
        $lipstickBrand->name = $data['name'];
        $lipstickBrand->save();

        return $lipstickBrand;
    }

    public function update($lipstickBrand_id, $data) {
        $lipstickBrand = LipstickBrand::findOrFail($lipstickBrand_id);
        if (!is_null($data['image'])){
            Storage::disk('s3')->delete($lipstickBrand->path);

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/brand/' . $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $lipstickBrand->image = $url;
            $lipstickBrand->path = $file_path;
        }
        $lipstickBrand->name = $data['name'];
        $lipstickBrand->save();

        return $lipstickBrand;
    }

    public function deleteById($request, $lipstickBrand_id) {
        $lipstickBrand = LipstickBrand::findOrFail($lipstickBrand_id);

        Storage::disk('s3')->delete($lipstickBrand->path);

        if(!is_null($request['force'])){
            if($request['force']){
                $lipstickBrand->delete();
                return 1;
            }else{
                if(count($lipstickBrand->lipstickDetails)){
                    return 0;
                } else {
                    $lipstickBrand->delete();

                    return 1;
                }
            }
        }
    }

    public function destroy($lipstickBrand_ids) {
        // sak yang tee pen logic
    }

    public function getModel()
    {
        return $this->lipstickBrand;
    }
}
