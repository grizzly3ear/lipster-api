<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trend;
use App\Http\Resources\TrendResource;

class TrendController extends Controller{

    public function getAll() {
        $trend = Trend::all();
        return TrendResource::collection(Trend::all());
    }

    public function getTrendById($id) {
        return new TrendResource(Trend::find($id));
    }

    public function storeTrend(Request $request){
        $trend = new Trend();
        $trend-> title = $request -> title;
        $trend-> year = $request -> year;
        $trend-> image = $request -> image;
        $trend -> skin_color = $request -> skin_color;
        $trend-> lipstick_color_id = $request -> lipstick_color_id;
        $trend -> save();

        return new TrendResource($trend);
    }

    public function editTrend(Request $request, $id){
        $trend = Trend::find($id);
        $trend-> title = $request -> title;
        $trend-> year = $request -> year;
        $trend-> image = $request -> image;
        $trend -> skin_color = $request -> skin_color;
        $trend-> lipstick_color_id = $request -> lipstick_color_id;
        $trend -> save();

        return $trend;
    }

    public function deleteTrend($id){
        $trend = Trend::find($id);
        $trend -> delete();
    }

}