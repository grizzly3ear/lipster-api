<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\TrendGroupRepository;
use App\Http\Resources\TrendGroupResource;
use App\Models\TrendGroup;

class TrendGroupController extends Controller
{
    protected $trendGroupRepository;

    public function __construct(TrendGroup $trendGroup) {
        $this->trendGroupRepository = new TrendGroupRepository($trendGroup);
    }

    public function getAllTrendGroup () {
        $trendGroups = $this->trendGroupRepository->findAll();

        return TrendGroupResource::collection($trendGroups);
    }

    public function getTrendGroupById ($trend_group_id) {
        $trendGroup = $this->trendGroupRepository->findById($trend_group_id);

        return new TrendGroupResource($trendGroup);
    }

    public function createTrendGroup (Request $request) {
        $this->validate($request, [
            'name' => 'string|required',
        ]);

        return $this->trendGroupRepository->store($request->only($this->trendGroupRepository->getModel()->fillable));
    }

    public function updateTrendGroupById (Request $request, $trend_group_id) {
        $this->validate($request, [
            'name' => 'string|required',
        ]);

        $trendGroup = $this->trendGroupRepository->update($trend_group_id, $request->input());

        return new TrendGroupResource($trendGroup);
    }

    public function deleteTrendGroupById ($trend_group_id) {
        $trend_group_id = $this->trendGroupRepository->deleteById($trend_group_id);

        return $trend_group_id;
    }
}
