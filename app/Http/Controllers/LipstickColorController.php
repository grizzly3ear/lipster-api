<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\LipstickColorRepositoryInterface;
use App\Repositories\LipstickColorRepository;
use App\Models\LipstickColor;

class LipstickColorController extends Controller
{
    protected $lipstickColorRepository;

    public function __construct(LipstickColor $lipstickColor) {
        $this->lipstickColorRepository = new LipstickColorRepository($lipstickColor);
    }

    public function getAllLipstickColor () {
        $lipstickColors = $this->lipstickColorRepository->findAll();

        return response()->json($lipstickColors, 200);
    }

    public function getLipstickColorById ($lipstickColor_id) {
        $lipstickColor = $this->lipstickColorRepository->findById($lipstickColor_id);

        return response()->json($lipstickColor, 200);
    }

    public function createLipstickColor (Request $request) {
        $this->validate($request, [
            'color_name' => 'required|max:255',
            'rgb' => 'required',
            'color_code' => 'required'
        ]);


        return $this->lipstickColorRepository->store($request->only($this->lipstickColorRepository->getModel()->fillable));
    }

    public function updateLipstickColorById (Request $request, $lipstickColor_id) {
        $lipstickColor = $this->lipstickColorRepository->update($lipstickColor_id, $request->input());

        return response()->json($lipstickColor, 200);
    }

    public function deleteLipstickColorById ($lipstickColor_id) {
        $lipstickColor_id = $this->lipstickColorRepository->deleteById($lipstickColor_id);

        return response()->json($lipstickColor_id, 200);
    }

    public function getSimilarLipstickColor ($hex) {
        $lipstickColors = $this->lipstickColorRepository->findSimilarColor($hex);

        return response()->json($lipstickColors, 200);
    }
}
