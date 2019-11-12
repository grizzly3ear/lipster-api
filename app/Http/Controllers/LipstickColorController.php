<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\LipstickColorResource;
use App\Repositories\LipstickColorRepositoryInterface;
use App\Repositories\LipstickColorRepository;
use App\Repositories\LogRepository;
use App\Models\LipstickColor;
use App\Models\Log;
use App\Http\Resources\UserReviewResource;
use App\Http\Resources\StoreAddressByLipstickResource;

class LipstickColorController extends Controller
{
    protected $lipstickColorRepository;
    protected $logRepository;

    public function __construct(LipstickColor $lipstickColor, Log $log) {
        $this->lipstickColorRepository = new LipstickColorRepository($lipstickColor);
        $this->logRepository = new LogRepository($log);
    }

    public function getAllLipstickColor () {
        $lipstickColors = $this->lipstickColorRepository->findAll();

        return LipstickColorResource::collection($lipstickColors);
    }

    public function getLipstickColorById ($lipstickColor_id) {
        $lipstickColor = $this->lipstickColorRepository->findById($lipstickColor_id);

        return new LipstickColorResource($lipstickColor);
    }

    public function createLipstickColor (Request $request) {
        $this->validate($request, [
            'color_name' => 'required|max:255|String',
            'rgb' => 'required|String',
            'color_code' => 'required|String',
            'lipstick_detail_id' => 'required|Integer'
        ]);


        return $this->lipstickColorRepository->store($request->only($this->lipstickColorRepository->getModel()->fillable));
    }

    public function updateLipstickColorById (Request $request, $lipstickColor_id) {

        $lipstickColor = $this->lipstickColorRepository->update($lipstickColor_id, $request->input());

        return new LipstickColorResource($lipstickColor);
    }

    public function deleteLipstickColorById (Request $request, $lipstickColor_id) {
        $lipstickColor_id = $this->lipstickColorRepository->deleteById($request->input(),$lipstickColor_id);

        return $lipstickColor_id;
    }

    public function getSimilarLipstickColor (Request $request, $hex) {
        $limit = $request->limit;
        $lipstickColors = $this->lipstickColorRepository->findSimilarColor($hex, $limit);

        return LipstickColorResource::collection($lipstickColors);
    }

    public function getUserReviews ($lipstickColor_id) {
        $userReviews = $this->lipstickColorRepository->getUserReviews($lipstickColor_id);

        return UserReviewResource::collection($userReviews);
    }

    public function getStoreAddresses ($lipstickColor_id) {
        $storeAddresses = $this->lipstickColorRepository->getStoreAddresses($lipstickColor_id);

        return StoreAddressByLipstickResource::collection($storeAddresses);
    }

    public function log (Request $request, $lipstick_color_id) {
            $lipstickColor = $this->lipstickColorRepository->findById($lipstick_color_id);
            $data = [
                'action' => $request->action,
            ];
            $log = $this->logRepository->store($request->user(), $data, $lipstickColor);

            return $log;
    }

    public function getAllLipstickColorRanking () {
        $lipstickColors = $this->lipstickColorRepository->ranking();

        return LipstickColorResource::collection($lipstickColors);
    }
}
