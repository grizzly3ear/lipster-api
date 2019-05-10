<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LipstickColor;
use App\Http\Resources\LipstickColorResource;
use App\Models\LipstickDetail;
use App\Models\LipstickImage;

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
    
    // public function deleteLipstickId($id){
    //     $lipstick = LipstickColor::find($id);
    //     $lipstick->storeAddresses()->delete();
    // }

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

        $image = new LipstickImage();
        $image -> image = $request -> image;
        $image->lipstickColor()->associate($color);
        $image -> save();

        return $color;
    }
}
