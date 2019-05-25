<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\LipstickColor;
use App\Models\LipstickDetail;
use App\Models\LipstickImage;
use App\Http\Resources\LipstickDetailReverseResource;
use App\Http\Resources\LipstickColorResource;

class LipstickColorController extends Controller
{
    public function getLipstickById($id) {
        return new LipstickColorResource(LipstickColor::find($id));
    }

    public function editLipstickColor(Request $request, $id){
        $lipstick = LipstickColor::find($id);
        $lipstick -> color_name = $request -> color_name;
        $lipstick -> rgb = $request -> rgb;
        $lipstick -> color_code = $request -> color_code;
        $lipstick -> lipstick_detail_id = $request -> lipstick_detail_id;
        $lipstick -> save();

        return $lipstick;
    }

    public function editLipstickImage(Request $request, $id){
        $lipstick = LipstickImage::find($id);
        $lipstick->image = $request->image;
        $lipstick->lipstick_color_id = $request->lipstick_color_id;
        $lipstick->save();

        return $lipstick;
    }

    public function deleteLipstickId($id){
        $lipstick = LipstickColor::find($id);
        $lipstick->delete();
    }

    public function deleteLipstickImage($id){
        $lipstick = LipstickImage::find($id);
        $lipstick->delete();
    }

    public function destroyMany(Request $request){
        $ids = $request->lipstick_ids;
        LipstickColor::destroy($ids);
    }

    public function storeLipstickColor(Request $request){

        $detail = LipstickDetail::find($request->lipstick_detail_id);

        $color = new LipstickColor();
        $color -> color_name = $request -> color_name;
        $color -> rgb = $request -> rgb;
        $color -> color_code = $request -> color_code;
        $color->lipstickDetail()->associate($detail);
        $color -> save();

        // $image = new LipstickImage();
        // $image -> image = $request -> image;
        // $image->lipstickColor()->associate($color);
        // $image -> save();

        return $color;
    }

    public function getSimilarColor($rgb1){
        $partR1 = str::limit($rgb1, 2,'');
        $r1 = hexdec($partR1);

        $cutG1 = Str::after($rgb1, $partR1);
        $partG1 = str::limit($cutG1, 2,'');
        $g1 = hexdec($partG1);

        $cutB1 = Str::after($rgb1, $partR1.$partG1);
        $partB1 = str::limit($cutB1, 2,'');
        $b1 = hexdec($partB1);

        $hsl1 = $this->rgb2hsl($r1, $g1, $b1);

        $colors = LipstickColor::all();
        $detail = LipstickDetail::all();


        $similarColorList = [];

        foreach($colors as $color){
            $rgb2 =  $color->rgb;

            $cutR2 = Str::after($rgb2, '#');
            $partR2 = str::limit($cutR2, 2,'');
            $r2 = hexdec($partR2);

            $cutG2 = Str::after($rgb2, $partR2);
            $partG2 = str::limit($cutG2, 2,'');
            $g2 = hexdec($partG2);

            $cutB2 = Str::after($rgb2, $partR2.$partG2);
            $partB2 = str::limit($cutB2, 2,'');
            $b2 = hexdec($partB2);

            $hsl2 = $this->rgb2hsl($r2, $g2, $b2);

            if ($hsl1["h"] == $hsl2["h"] && abs($hsl1["s"] - $hsl2["s"]) < 10 && abs($hsl1["l"] - $hsl2["l"]) < 10) {

                array_push($similarColorList, new LipstickColorResource($color));
            }

        }
        return $similarColorList;
    }

    public function rgb2hsl ($r, $g, $b) {
        $r /= 255;
        $g /= 255;
        $b /= 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $l = ($max + $min) / 2;
        if ($max == $min) {
            $h = $s = 0;
        } else {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
            switch ($max) {
                case $r:
                    $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = ($b - $r) / $d + 2;
                    break;
                case $b:
                    $h = ($r - $g) / $d + 4;
                    break;
            }
            $h /= 6;
        }
        $h = floor($h * 360);
        $s = floor($s * 100);
        $l = floor($l * 100);
        return ['h' => $h, 's' => $s, 'l' => $l];
    }
}

