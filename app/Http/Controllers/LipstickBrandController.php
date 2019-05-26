<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LipstickBrand;
use App\Http\Resources\LipstickBrandResource;

class LipstickBrandController extends Controller
{
    public function getAll() {
        return LipstickBrandResource::collection(LipstickBrand::all());
    }

    public function getBrandById($brand_id){
        $brand = LipstickBrand::find($brand_id);

        return new LipstickBrandResource($brand);
    }

    public function storeLipstickBrand(Request $request){
        $brand = new LipstickBrand();
        $brand->name = $request->name;
        $brand->image = $request->image;
        $brand->save();

        return $brand;
    }

    public function editLipstickBrand(Request $request, $id){
        $lipstick = LipstickBrand::find($id);
        $lipstick->name = $request->name;
        $brand->image = $request->image;
        $lipstick -> save();

        return $lipstick;
    }

    public function deleteLipstickBrand($id){
        $lipstick = LipstickBrand::find($id);
        $lipstick->delete();

        return $lipstick->id;
    }

    public function destroyMany(Request $request){
        $ids = $request->lipstick_ids;
        LipstickBrand::destroy($ids);

        return $ids;
    }
}
