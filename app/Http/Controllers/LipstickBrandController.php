<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\LipstickBrandResource;
use App\Repositories\LipstickBrandRepositoryInterface;

class LipstickBrandController extends Controller
{
    protected $lipstickBrandRepository;

    public function __construct(LipstickBrandRepositoryInterface $lipstickBrandRepository) {
        $this->lipstickBrandRepository = $lipstickBrandRepository;
    }

    public function getAllLipstickBrand () {
        $lipstickBrands = $this->lipstickBrandRepository->findAll();

        return $lipstickBrands;
    }

    public function getLipstickBrandById ($lipstickBrand_id) {
        $lipstickBrand = $this->lipstickBrandRepository->findById($lipstickBrand_id);

        return $lipstickBrand;
    }

    public function createLipstickBrand (Request $request) {
        $lipstickBrand = $this->lipstickBrandRepository->store($request->input());

        return $lipstickBrand;
    }

    public function updateLipstickBrandById (Request $request, $lipstickBrand_id) {
        $lipstickBrand = $this->lipstickBrandRepository->update($lipstickBrand_id, $request->input());

        return $lipstickBrand;
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
