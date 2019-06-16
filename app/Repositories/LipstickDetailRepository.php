<?php

namespace App\Repositories;

use App\Models\LipstickDetail;
use App\Http\Resources\LipstickDetailResource;

class LipstickDetailRepository implements LipstickDetailRepositoryInterface
{
    protected $lipstickDetail;

    public function __construct(LipstickDetail $lipstickDetail){
        $this->lipstickDetail = $lipstickDetail;
    }

    public function findAll() {
        $lipstickDetails = LipstickDetail::all();
        return LipstickDetailResource::collection($lipstickDetails);
    }

    public function findById($lipstickDetail_id) {
        $lipstickDetails = LipstickDetail::findOrFail($lipstickDetail_id);
        return new LipstickDetailResource($lipstickDetails);
    }

    public function store($data) {
        return $this->lipstickDetail->create($data);
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

    public function getModel()
    {
        return $this->lipstickDetail;
    }
}
