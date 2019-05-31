<?php

namespace App\Repositories;

use App\Models\LipstickDetail;

class LipstickDetailRepository implements LipstickDetailRepositoryInterface
{
    public function findAll() {
        return LipstickDetail::all();
    }

    public function findById($lipstickDetail_id) {
        return LipstickDetail::findOrFail($lipstickDetail_id);
    }

    public function store($data) {
        // some create logic
    }

    public function update($lipstickDetail_id, $data) {

    }

    public function deleteById($lipstickDetail_id) {
        $lipstickDetail = LipstickDetail::findOrFail($lipstickDetail_id);

        $lipstickDetail->delete();

        return $lipstickDetail->id;
    }

    public function findDistinctColumnValue($column) {
        $lipstickDetailTypes = LipstickDetail::select($column)->groupBy($column)->get();

        return $lipstickDetailTypes;
    }
}
