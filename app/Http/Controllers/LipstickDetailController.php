<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        return $lipstickDetails;
    }

    public function getLipstickDetailById ($lipstickDetail_id) {
        $lipstickDetail = $this->lipstickDetailRepository->findById($lipstickDetail_id);

        return $lipstickDetail;
    }

    public function createLipstickDetail (Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'max_price' => 'required|numeric',
            'min_price' => 'required|numeric',
            'min_price' => 'required|numeric',
            'opacity' => 'required|numeric'
        ]);


        return $this->lipstickDetailRepository->store($request->only($this->lipstickDetailRepository->getModel()->fillable));
    }

    public function updateLipstickDetailById (Request $request, $lipstickDetail_id) {
        $lipstickDetail = $this->lipstickDetailRepository->update($lipstickDetail_id, $request->input());

        return $lipstickDetail;
    }

    public function deleteLipstickDetailById ($lipstickDetail_id) {
        $lipstickDetail_id = $this->lipstickDetailRepository->deleteById($lipstickDetail_id);

        return $lipstickDetail_id;
    }

    public function getLipstickDetailType () {
        $type = $this->lipstickDetailRepository->findDistinctColumnValue('type');

        return array('data' => $type);
    }
}
