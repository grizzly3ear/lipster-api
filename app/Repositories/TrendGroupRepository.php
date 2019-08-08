<?php

namespace App\Repositories;

use App\Models\TrendGroup;

class TrendGroupRepository implements TrendGroupRepositoryInterface
{

    protected $trendGroup;

    public function __construct(TrendGroup $trendGroup){
        $this->trendGroup = $trendGroup;
    }

    public function findAll() {
        return TrendGroup::all();
    }

    public function findById($trend_group_id) {
        return TrendGroup::findOrFail($trend_group_id);
    }

    public function store($data) {
        return $this->trendGroup->create($data);
    }

    public function update($trend_group_id, $data) {
        $trendGroup = $this->findById($trend_group_id);

        $trendGroup->save();

        return $trendGroup;
    }

    public function deleteById($trend_group_id) {
        $trendGroup = $this->findById($trend_group_id);

        $trendGroup->delete();

        return $trendGroup->id;
    }

    public function getModel()
    {
        return $this->trendGroup;
    }
}
