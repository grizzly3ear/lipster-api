<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\LipstickColorRepositoryInterface;

class LipstickColorController extends Controller
{
    protected $lipstickColorRepository;

    public function __construct(LipstickColorRepositoryInterface $lipstickColorRepository) {
        $this->lipstickColorRepository = $lipstickColorRepository;
    }

    public function getAllLipstickColor () {
        $lipstickColors = $this->lipstickColorRepository->findAll();

        return $lipstickColors;
    }

    public function getLipstickColorById ($lipstickColor_id) {
        $lipstickColor = $this->lipstickColorRepository->findById($lipstickColor_id);

        return $lipstickColor;
    }

    public function createLipstickColor (Request $request) {
        $lipstickColor = $this->lipstickColorRepository->store($request->input());

        return $lipstickColor;
    }

    public function updateLipstickColorById (Request $request, $lipstickColor_id) {
        $lipstickColor = $this->lipstickColorRepository->update($lipstickColor_id, $request->input());

        return $lipstickColor;
    }

    public function deleteLipstickColorById ($lipstickColor_id) {
        $lipstickColor_id = $this->lipstickColorRepository->deleteById($lipstickColor_id);

        return $lipstickColor_id;
    }

    public function getSimilarLipstickColor ($hex) {
        $lipstickColors = $this->lipstickColorRepository->findSimilarColor($hex);

        return array('data' => $lipstickColors);
    }
}
