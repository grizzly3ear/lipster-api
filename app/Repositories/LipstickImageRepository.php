<?php

namespace App\Repositories;

use App\Models\LipstickImage;

class LipstickImageRepository implements LipstickImageRepositoryInterface
{

    protected $lipstickImage;

    public function __construct(LipstickImage $lipstickImage){
        $this->lipstickImage = $lipstickImage;
    }

    public function findAll() {
        return LipstickImage::all();
    }

    public function findById($lipstickImage_id) {
        return LipstickImage::findOrFail($lipstickImage_id);
    }

    public function store(array $data) {
        return $this->lipstickImage->create($data);
    }

    public function update($lipstickImage_id, $data) {

    }

    public function deleteById($lipstickImage_id) {
        $lipstickImage = LipstickImage::findOrFail($lipstickImage_id);

        $lipstickImage->delete();

        return $lipstickImage->id;
    }

    public function getModel()
    {
        return $this->lipstickImage;
    }
}
