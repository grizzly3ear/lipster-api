<?php

namespace App\Repositories;

use App\Models\Trend;

class TrendRepository implements TrendRepositoryInterface
{

    protected $trend;

    public function __construct(Trend $trend){
        $this->trend = $trend;
    }


    public function findAll() {
        return Trend::all();
    }

    public function findById($trend_id) {
        return Trend::findOrFail($trend_id);
    }

    public function store($data) {
        return $this->trend->create($data);
    }

    public function update($trend_id, $data) {
        $trend = Trend::findOrFail($trend_id);
        $trend->title = $data->title;
        $trend->year = $data->year;
        $trend->image = $data->image;
        $trend->skin_color = $data->skin_color;
        $trend->description = $data->description;
        $trend->lipstick_color_id = $data->lipstick_color_id;
        $trend->save();

        return $trend;
    }

    public function deleteById($trend_id) {
        $trend = Trend::findOrFail($trend_id);

        $trend->delete();

        return $trend->id;
    }

    public function getModel()
    {
        return $this->trend;
    }
}
