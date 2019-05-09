<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LipstickDetail;
use App\Http\Resources\LipstickDetailResource;
use App\Models\LipstickBrand;

class LipstickDetailController extends Controller
{
    public function getLipstickByDetail($detail_id){
        $detail = LipstickDetail::find($detail_id);
        return new LipstickDetailResource($detail);
    }

    public function editLipstickDetail(Request $request,$id){
        $lipstick = LipstickDetail::find($id);
        $lipstick->name = $request->name;
        $lipstick->max_price = $request->max_price;
        $lipstick->min_price = $request->min_price;
        $lipstick->type = $request->type;
        $lipstick->opacity = $request->opacity;
        $lipstick->description = $request->description;
        $lipstick->composition = $request->composition;
        $lipstick->apply = $request->apply;
        $lipstick->lipstick_brand_id = $request->lipstick_brand_id;
        $lipstick->save();

        return $lipstick;
    }

    public function deleteLipstickDetail($id){
        $lipstick = LipstickDetail::find($id);
        $lipstick-> delete();
    }

    // public function storeLipstickDetail(Request $request){
    //     // $brand = new LipstickBrand();
    //     $brand = LipstickBrand::find($request->lipstick_brand_id);

    //     $detail = new LipstickDetail();
    //     $detail->name = $request->name;
    //     $detail->max_price = $request->max_price;
    //     $detail->min_price = $request->min_price;
    //     $detail->type = $request->type;
    //     $detail->opacity = $request->opacity;
    //     $detail->description = $request->description;
    //     $detail->composition = $request->composition;
    //     $detail->apply = $request->apply;
    //     $detail->lipstickBrand()->associated($brand);
    //     $detail->save();
    //     // $detail -> lipstick_brand_id = $brand->id;

    //     return $detail;
    // }
}
