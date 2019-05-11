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
        $lipstick->storeAddresses()->delete();
    }

    public function deleteLipstickImage($id){
        $lipstick = LipstickImage::find($id);
        $lipstick->delete();
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

            $result = sqrt(pow($r1 - $r2, 2) + pow($g1 - $g2, 2) + pow($b1 - $b2, 2));
            
            if ($result < 85){                

                $similarColorList[] = [
                    'detail' => new LipstickDetailReverseResource(LipstickDetail::find($color->lipstickDetail->id)),
                    'color' => new LipstickColorResource(LipstickColor::find($color->id)) 
                ];
            }
           
        }
        return $similarColorList;
    }
}

