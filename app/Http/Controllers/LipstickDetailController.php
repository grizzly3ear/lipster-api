<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\LipstickDetailRepositoryInterface;

class LipstickDetailController extends Controller
{
    protected $lipstickDetailRepository;

    public function __construct(LipstickDetailRepositoryInterface $lipstickDetailRepository) {
        $this->lipstickDetailRepository = $lipstickDetailRepository;
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
        $lipstickDetail = $this->lipstickDetailRepository->store($request->input());

        return $lipstickDetail;
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
