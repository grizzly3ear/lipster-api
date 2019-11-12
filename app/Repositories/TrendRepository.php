<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Storage;
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
        $trend = new Trend();
        if (!is_null($data['image'])){

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/trend/' . $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $trend->image = $url;
            $trend->path = $file_path;
        }
        $trend->title = $data['title'];
        $trend->skin_color = $data['skin_color'];
        $trend->description = $data['description'];
        $trend->lipstick_color = $data['lipstick_color'];
        $trend->trend_group_id = $data['trend_group_id'];
        $trend->save();

        return $trend;

    }

    public function update($trend_id, $data) {
        $trend = Trend::findOrFail($trend_id);
        if (!is_null($data['image'])){
            Storage::disk('s3')->delete($trend->path);

            $image = $data['image'];
            $imageName = rand(111111111, 999999999) . '.png';
            $file_path = 'file/trend/' . $imageName;

            Storage::disk('s3')->put($file_path, base64_decode($image), 'public');
            $url = Storage::disk('s3')->url($file_path);

            $trend->image = $url;
            $trend->path = $file_path;
        }

        $trend->title = $data['title'];
        $trend->skin_color = $data['skin_color'];
        $trend->description = $data['description'];
        $trend->lipstick_color = $data['lipstick_color'];
        $trend->trend_group_id = $data['trend_group_id'];
        $trend->save();

        return $trend;
    }

    public function deleteById($trend_id) {
        $trend = Trend::findOrFail($trend_id);

        Storage::disk('s3')->delete($trend->path);

        $trend->delete();

        return $trend->id;
    }

    public function getModel()
    {
        return $this->trend;
    }

    public function findSimilarColor($hex) {
        $trends = $this->findAll();
        $hsl0 = $this->hexToHsl($hex);

        $similarColors = $trends->filter(function ($trend) use ($hsl0) {
            $hsl1 = $this->hexToHsl(str_after($trend->lipstick_color, '#'));

            return $this->isHslSimilar($hsl0, $hsl1, 10);
        });

        return $similarColors;
    }

    public function isHslSimilar($hsl0, $hsl1, $distance) {
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

    public function ranking() {
        $trends = Trend::all();

        return $trends->sortByDesc(function ($trend, $key) {
            return $trend->logs()->groupBy('log_id')->sum('detail');
        });
    }
}
