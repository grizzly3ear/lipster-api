<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\TrendRepository;
use App\Http\Resources\TrendResource;
use App\Models\Trend;

class TrendController extends Controller
{
    protected $trendRepository;

    public function __construct(Trend $trend) {
        $this->trendRepository = new TrendRepository($trend);
    }

    public function getAllTrend () {
        $trends = $this->trendRepository->findAll();

        return TrendResource::collection($trends);
    }

    public function getTrendById ($trend_id) {
        $trend = $this->trendRepository->findById($trend_id);

        return new TrendResource($trend);
    }

    public function createTrend (Request $request) {
        $this->validate($request, [
            'title' => 'required|max:255',
            'image' => 'required|String',
            'skin_color' => 'required|String',
            'description' => 'required|String',
            'lipstick_color' => 'required|String'
        ]);


        return $this->trendRepository->store($request->only($this->trendRepository->getModel()->fillable));
    }

    public function updateTrendById (Request $request, $trend_id) {

        $trend = $this->trendRepository->update($trend_id, $request->input());

        return new TrendResource($trend);
    }

    public function deleteTrendById ($trend_id) {
        $trend_id = $this->trendRepository->deleteById($trend_id);

        return $trend_id;
    }

    public function getSimilarLipstickColor ($hex) {
        $trends = $this->trendRepository->findSimilarColor($hex);

        return TrendResource::collection($trends);
    }
}
