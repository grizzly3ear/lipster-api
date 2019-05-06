<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LipstickImage;
use App\Models\User;
use App\Models\LipstickColor;
use App\Models\LipstickDetail;
use App\Models\LipstickBrand;
use App\Http\Resources\LipstickBrandResource;
use App\Http\Resources\LipstickColorResource;
use App\Http\Resources\LipstickDetailResource;
use App\Http\Resources\LipstickByUserResource;
use App\Http\Resources\LipstickListBrandResource;
use App\Http\Resources\LipstickListDetailResource;
use App\Http\Resources\LipstickListColorResource;
use App\Http\Resources\LipstickListImageResource;


class LipstickBrandController extends Controller
{
    public function getAll() {
        return LipstickBrandResource::collection(LipstickBrand::all());
    }
    
    public function getLipstickByUser($user_id){
        // $user = User::find($user_id);
        // return LipstickListColorResource::collection(LipstickColor::all());
        // $user = User::where('id', '=', $user_id)
        //             ->('favouriteLipsticks')
        //             ->first();
        // return $user;
    }

    public function getLipstickById($id) {
        return new LipstickColorResource(LipstickColor::find($id));
    }

    public function getLipstickByBrand($brand_id){
        $brand = LipstickBrand::find($brand_id);
        return new LipstickBrandResource($brand);
    }

    public function getLipstickByDetail($detail_id){
        $detail = LipstickDetail::find($detail_id);
        return new LipstickDetailResource($detail);
    }

    // public function storeLipstick(Request $request){
    //     $lipstick = $this -> mapRequestToLipstickBrand($request);
    //     $lipstick -> save();

    //     return $lipstick;
    // }

    // public function mapRequestToLipstickBrand(Request $request){
    //     $lipstick = new LipstickBrand();
    //     $lipstick -> brand = $request -> brand;

    //     return $lipstick;
    // }

    public function storeLipstick(Request $request){
        $brand = new LipstickBrand();
        $brand -> name = $request -> name;
        $brand -> save();

        // $detail = new LipstickDetail();
        // $detail -> name = $request -> name;
        // $detail -> max_price = $request -> max_price;
        // $detail -> min_price = $request -> min_price;
        // $detail -> type = $request -> type;
        // $detail -> opacity = $request -> opacity;
        // $detail -> description = $request -> description;
        // $detail -> composition = $request -> composition;
        // $detail -> apply = $request -> apply;
        // $detail -> save();
        // $brand->lipstickDetail()->associated($detail);
        // // $detail -> lipstick_brand_id = $brand->id;

        // $color = new LipstickColor();
        // $color -> color_name = $request -> color_name;
        // $color -> rgb = $request -> rgb;
        // $color -> color_code = $request -> color_code;
        // $color -> lipstick_detail_id = $detail -> id;
        // $color -> save();

        // $image = new LipstickImage();
        // $image -> image = $request -> image;
        // $image -> lipstick_color_id = $color -> id;
        // $image -> save();

        return $brand;
    }

    public function editLipstickBrand(Request $request, $id){
        $lipstick = LipstickBrand::find($id);
        $lipstick->name = $request -> name;
        $lipstick -> save();

        return $lipstick;
    }

    public function editLipstickDetail(Request $request,$id){
        $lipstick = LipstickDetail::find($id);
        $lipstick -> name = $request -> name;
        $lipstick -> max_price = $request -> max_price;
        $lipstick -> min_price = $request -> min_price;
        $lipstick -> type = $request -> type;
        $lipstick -> opacity = $request -> opacity;
        $lipstick -> description = $request -> description;
        $lipstick -> composition = $request -> composition;
        $lipstick -> apply = $request -> apply;
        $lipstick -> lipstick_brand_id = $request -> lipstick_brand_id;
        $lipstick -> save();

        return $lipstick;
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
        $lipstick -> image = $request -> image;
        $lipstick -> lipstick_color_id = $request -> lipstick_color_id;
        $lipstick -> save();

        return $lipstick;
    }

    public function deleteLipstickId($id){
        $lipstick = LipstickColor::find($id);
        $lipstick -> delete();
    }

    public function deleteLipstickBrand($id){
        $lipstick = LipstickBrand::find($id);
        $lipstick -> delete();
    }

    public function deleteLipstickDetail($id){
        $lipstick = LipstickDetail::find($id);
        $lipstick -> delete();
    }

    public function deleteLipstickImage($id){
        $lipstick = LipstickImage::find($id);
        $lipstick -> delete();
    }
}
