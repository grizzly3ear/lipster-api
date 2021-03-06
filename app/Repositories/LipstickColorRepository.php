<?php

namespace App\Repositories;

use App\Models\LipstickColor;

class LipstickColorRepository implements LipstickColorRepositoryInterface
{
    protected $lipstickColor;

    public function __construct(LipstickColor $lipstickColor){
        $this->lipstickColor = $lipstickColor;
    }

    public function findAll() {
        return LipstickColor::all();
    }

    public function findAllAvailable($lipstick_detail_id, $store_address_id) {
        $allLipstickColors = LipstickColor::all()->where('lipstick_detail_id', $lipstick_detail_id);
        $available = collect([]);
        foreach ($allLipstickColors as $colors) {
            $count = ($colors->storeHasLipsticks->where('id', $store_address_id)->first());
                if(!$count) {
                    $available->push($colors);

                }
        }
        return $available;
    }

    public function findById($lipstickColor_id) {
        return LipstickColor::findOrFail($lipstickColor_id);
    }

    public function store($data) {
        return $this->lipstickColor->create($data);
    }

    public function update($lipstickColor_id, $data) {
        $lipstickColor = LipstickColor::findOrFail($lipstickColor_id);
        $lipstickColor->color_name = $data['color_name'];
        $lipstickColor->rgb = $data['rgb'];
        $lipstickColor->color_code = $data['color_code'];
        $lipstickColor->composition = $data['composition'];
        $lipstickColor->lipstick_detail_id = $data['lipstick_detail_id'];
        $lipstickColor->save();

        return $lipstickColor;
    }

    public function getModel()
    {
        return $this->lipstickColor;
    }

    public function deleteById($request, $lipstickColor_id) {
        $lipstickColor = LipstickColor::findOrFail($lipstickColor_id);
        if(!is_null($request['force'])){
            if($request['force']){
                $lipstickColor->delete();
                return 1;
            }else{
                if(count($lipstickColor->storeAddresses)){
                    return 0;
                } else {
                    $lipstickColor->delete();

                    return 1;
                }
            }
        }
    }

    public function findSimilarColor($hex, $expectedResult = 10) {
        $lipstickColors = $this->findAll();
        $hsl0 = $this->hexToHsl($hex);
        $similarColors = [];
        $similarDistance = 0;
        $distanceLimit = 15;
        do {
            $similarDistance += 5;
            $similarColors = $lipstickColors->filter(function ($lipstickColor) use ($hsl0, $similarDistance) {
                $hsl1 = $this->hexToHsl(str_after($lipstickColor->rgb, '#'));

                $result = $this->isHslSimilar($hsl0, $hsl1, $similarDistance);

                return $result;
            });
            if ($similarDistance >= $distanceLimit) {
                break;
            }
        } while (count($similarColors) <= $expectedResult);


        return $similarColors;
    }



    public function isHslSimilar($hsl0, $hsl1, $distance) {
        return abs($hsl0['h'] - $hsl1['h']) < 5 &&
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

    public function getUserReviews($lipstickColor_id) {
        $lipstickColors = LipstickColor::findOrFail($lipstickColor_id);

        return $lipstickColors->reviews;
    }

    public function getStoreAddresses($lipstickColor_id) {
        $lipstickColors = LipstickColor::findOrFail($lipstickColor_id);

        return $lipstickColors->storeHasLipsticks;
    }

    public function ranking() {
        $lipstickColors = LipstickColor::all();

        return $lipstickColors->sortByDesc(function ($color, $key) {
            return $color->logs()->groupBy('log_id')->sum('detail');
        });
    }
}
