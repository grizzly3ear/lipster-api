<?php

namespace App\Repositories;

use App\Models\LipstickBrand;

class LipstickBrandRepository implements LipstickBrandRepositoryInterface
{
    public function findAll() {
        return LipstickBrand::all();
    }

    public function findById($lipstickBrand_id) {
        return LipstickBrand::findOrFail($lipstickBrand_id);
    }

    public function store($data) {
        // some create logic
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
}
