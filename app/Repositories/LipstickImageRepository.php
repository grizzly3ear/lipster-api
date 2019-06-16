<?php

namespace App\Repositories;

use App\Models\LipstickImage;

class LipstickImageRepository implements LipstickImageRepositoryInterface
{
    public function findAll() {
        return LipstickImage::all();
    }

    public function findById($lipstickImage_id) {
        return LipstickImage::findOrFail($lipstickImage_id);
    }

    public function store($data) {
        // some create logic
    }

    public function update($lipstickImage_id, $data) {

    }

    public function deleteById($lipstickImage_id) {
        $lipstickImage = LipstickImage::findOrFail($lipstickImage_id);

        $lipstickImage->delete();

        return $lipstickImage->id;
    }
}
