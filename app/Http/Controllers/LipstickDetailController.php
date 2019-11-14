<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\LipstickDetailResource;
use App\Http\Resources\LipstickColorResource;
use App\Repositories\LipstickDetailRepositoryInterface;
use App\Repositories\LipstickDetailRepository;
use App\Models\LipstickDetail;

class LipstickDetailController extends Controller
{
    protected $lipstickDetailRepository;

    public function __construct(LipstickDetail $lipstickDetail) {
        $this->lipstickDetailRepository = new LipstickDetailRepository($lipstickDetail);
    }

    public function getAllLipstickDetail () {
        $lipstickDetails = $this->lipstickDetailRepository->findAll();

        return LipstickDetailResource::collection($lipstickDetails);
    }

    public function getLipstickDetailById ($lipstickDetail_id) {
        $lipstickDetail = $this->lipstickDetailRepository->findById($lipstickDetail_id);

        return new LipstickDetailResource($lipstickDetail);
    }

    public function createLipstickDetail (Request $request) {
        $this->validate($request, [
            'name' => 'unique:lipstick_detail,name,NULL,id,lipstick_brand_id,' . $request->lipstick_brand_id,
            'lipstick_brand_id' => 'unique:lipstick_detail,lipstick_brand_id,NULL,id,name,' . $request->name,
        ]);

        return $this->lipstickDetailRepository->store($request->only($this->lipstickDetailRepository->getModel()->fillable));
    }

    public function updateLipstickDetailById (Request $request, $lipstickDetail_id) {

        $lipstickDetail = $this->lipstickDetailRepository->update($lipstickDetail_id, $request->input());

        return new LipstickDetailResource($lipstickDetail);
    }

    public function deleteLipstickDetailById (Request $request, $lipstickDetail_id) {
        $lipstickDetail_id = $this->lipstickDetailRepository->deleteById($request->input(), $lipstickDetail_id);

        return $lipstickDetail_id;
    }

    public function getLipstickDetailType () {
        $type = $this->lipstickDetailRepository->findDistinctColumnValue('type');

        return array('data' => $type);
    }
}
