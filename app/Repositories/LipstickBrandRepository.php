<?php

namespace App\Repositories;

use App\Models\LipstickBrand;

class LipstickBrandRepository implements LipstickBrandRepositoryInterface
{
    protected $lipstickBrand;

    public function __construct(LipstickBrand $lipstickBrand){
        $this->lipstickBrand = $lipstickBrand;
    }
    public function findAll() {
        return LipstickBrand::all();
    }

    public function findById($lipstickBrand_id) {
        return LipstickBrand::findOrFail($lipstickBrand_id);
    }

    public function store(array $data) {
        return $this->lipstickBrand->create($data);
    }

    public function update($lipstickBrand_id, $data) {
        $lipstickBrand = LipstickBrand::findOrFail($lipstickBrand_id);
        $lipstickBrand->name = $data->name;
        $lipstickBrand->image = $data->image;
        $lipstickBrand->save();

        return $lipstickBrand;
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
