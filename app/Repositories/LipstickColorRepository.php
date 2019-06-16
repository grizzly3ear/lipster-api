<?php

namespace App\Repositories;

use App\Models\LipstickColor;
use App\Http\Resources\LipstickColorResource;

class LipstickColorRepository implements LipstickColorRepositoryInterface
{
    protected $lipstickColor;

    public function __construct(LipstickColor $lipstickColor){
        $this->lipstickColor = $lipstickColor;
    }

    public function findAll() {
        $lipstickColors = LipstickColor::all();
        return LipstickColorResource::collection($lipstickColors);
    }

    public function findById($lipstickColor_id) {
        $lipstickColors =  LipstickColor::findOrFail($lipstickColor_id);
        return new LipstickColorResource($lipstickColors);
    }

    public function store($data) {
        return $this->lipstickColor->create($data);
    }

    public function update($lipstickColor_id, $data) {

    }

    public function getModel()
    {
        return $this->lipstickColor;
    }

    public function deleteById($lipstickColor_id) {
        $lipstickColor = LipstickColor::findOrFail($lipstickColor_id);

        $lipstickColor->delete();

        return $lipstickColor->id;
    }

    public function findSimilarColor($hex) {
        $lipstickColors = $this->findAll();
        $hsl0 = $this->hexToHsl($hex);
        // dd($lipstickColors->toArray());
        $similarColors = array_filter($lipstickColors->toArray(), function ($lipstickColor) use ($hsl0) {
            // dd($lipstickColor["rgb"]);
            $hsl1 = $this->hexToHsl(str_after($lipstickColor["rgb"], '#'));
            // dd($hsl1, $lipstickColor["rgb"]);
            // dd($this->isHslSimilar($hsl0, $hsl1, 10));
            return $this->isHslSimilar($hsl0, $hsl1, 10);
        });

        return collect($similarColors);
    }

    public function isHslSimilar($hsl0, $hsl1, $distance) {
        // dd($hsl0['h'], $hsl1['h'], $hsl0['s'], $hsl1['s'], $hsl0['l'], $hsl1['l']);


        return abs($hsl0['h'] - $hsl1['h']) < 1 &&
               abs($hsl0['s'] - $hsl1['s']) <= $distance &&
               abs($hsl0['l'] - $hsl1['l']) <= $distance;
    }

    public function hexToHsl($hex) {
        $hex = array($hex[0].$hex[1], $hex[2].$hex[3], $hex[4].$hex[5]);
        $rgb = array_map(function($part) {
            return hexdec($part) / 255;
        }, $hex);

        $max = max($rgb);
        $min = min($rgb);

        $l = ($max + $min) / 2;

        if ($max == $min) {
            $h = $s = 0;
        } else {
            $diff = $max - $min;
            $s = $l > 0.5 ? $diff / (2 - $max - $min) : $diff / ($max + $min);

            switch($max) {
                case $rgb[0]:
                    $h = ($rgb[1] - $rgb[2]) / $diff + ($rgb[1] < $rgb[2] ? 6 : 0);
                    break;
                case $rgb[1]:
                    $h = ($rgb[2] - $rgb[0]) / $diff + 2;
                    break;
                case $rgb[2]:
                    $h = ($rgb[0] - $rgb[1]) / $diff + 4;
                    break;
            }

            $h /= 6;
        }

        return array('h' => $h * 360.0, 's' => $s * 100.0, 'l' => $l * 100.0);
    }
}
