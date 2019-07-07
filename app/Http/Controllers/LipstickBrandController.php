<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\LipstickBrandResource;
use App\Http\Resources\LipstickDetailResource;
use App\Repositories\LipstickBrandRepositoryInterface;
use App\Repositories\LipstickBrandRepository;
use App\Models\LipstickBrand;

class LipstickBrandController extends Controller
{
    protected $lipstickBrandRepository;

    public function __construct(LipstickBrand $lipstickBrand) {
        $this->lipstickBrandRepository = new LipstickBrandRepository($lipstickBrand);
    }

    public function getAllLipstickBrand () {
        $lipstickBrands = $this->lipstickBrandRepository->findAll();

        return LipstickBrandResource::collection($lipstickBrands);
    }

    public function getLipstickBrandById ($lipstickBrand_id) {
        $lipstickBrand = $this->lipstickBrandRepository->findById($lipstickBrand_id);

        return new LipstickBrandResource($lipstickBrand);
    }

    public function getLipstickDetailByLipstickBrandId ($lipstickBrand_id) {
        $lipstickBrand = $this->lipstickBrandRepository->findById($lipstickBrand_id);

        return LipstickDetailResource::collection($lipstickBrand->lipstickDetails);
    }

    public function createLipstickBrand (Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:lipstick_brand|max:255'
        ]);


        return $this->lipstickBrandRepository->store($request->only($this->lipstickBrandRepository->getModel()->fillable));
    }

    public function updateLipstickBrandById (Request $request, $lipstickBrand_id) {
        $this->validate($request, [
            'name' => 'required|unique:lipstick_brand|max:255'
        ]);

        $lipstickBrand = $this->lipstickBrandRepository->update($lipstickBrand_id, $request);

        return new LipstickBrandResource($lipstickBrand);
    }

    public function deleteLipstickBrandById ($lipstickBrand_id) {
        $lipstickBrand_id = $this->lipstickBrandRepository->deleteById($lipstickBrand_id);

        return $lipstickBrand_id;
    }

    public function destroyLipstickBrandByIds (Request $request) {
        $lipstickBrand_ids = $this->lipstickBrandRepository->destroy($request->ids);

        return $lipstickBrand_ids;
    }
}
