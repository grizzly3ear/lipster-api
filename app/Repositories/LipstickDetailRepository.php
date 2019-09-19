<?php

namespace App\Repositories;

use App\Models\LipstickDetail;

class LipstickDetailRepository implements LipstickDetailRepositoryInterface
{
    protected $lipstickDetail;

    public function __construct(LipstickDetail $lipstickDetail){
        $this->lipstickDetail = $lipstickDetail;
    }

    public function findAll() {
        return LipstickDetail::all();
    }

    public function findById($lipstickDetail_id) {
        return LipstickDetail::findOrFail($lipstickDetail_id);
    }

    public function store($data) {
        return $this->lipstickDetail->create($data);
    }

    public function update($lipstickDetail_id, $data) {
        $lipstickDetail = LipstickDetail::findOrFail($lipstickDetail_id);
        $lipstickDetail->name = $data['name'];
        $lipstickDetail->max_price = $data['max_price'];
        $lipstickDetail->min_price = $data['min_price'];
        $lipstickDetail->type = $data['type'];
        $lipstickDetail->opacity = $data['opacity'];
        $lipstickDetail->description = $data['description'];
        $lipstickDetail->apply = $data['apply'];
        $lipstickDetail->lipstick_brand_id = $data['lipstick_brand_id'];
        $lipstickDetail->save();

        return $lipstickDetail;
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

    public function getModel()
    {
        return $this->lipstickDetail;
    }
}
