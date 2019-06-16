<?php

namespace App\Repositories;

use App\Models\LipstickBrand;
use App\Http\Resources\LipstickBrandResource;

class LipstickBrandRepository implements LipstickBrandRepositoryInterface
{
    protected $lipstickBrand;

    public function __construct(LipstickBrand $lipstickBrand){
        $this->lipstickBrand = $lipstickBrand;
    }
    public function findAll() {
        $lipstickBrands = LipstickBrand::all();
        return LipstickBrandResource::collection($lipstickBrands);
    }

    public function findById($lipstickBrand_id) {
        $lipstickBrands =  LipstickBrand::findOrFail($lipstickBrand_id);
        return new LipstickBrandResource($lipstickBrands);
    }

    public function store(array $data) {
        return $this->lipstickBrand->create($data);
    }

    public function update($lipstickBrand_id, $data) {

    }

    public function deleteById($lipstickBrand_id) {
        $lipstickBrand = LipstickBrand::findOrFail($lipstickBrand_id);

        $lipstickBrand->delete();

        return $lipstickBrand->id;
    }

    public function destroy($lipstickBrand_ids) {
        // sak yang tee pen logic
    }

    public function getModel()
    {
        return $this->lipstickBrand;
    }
}
