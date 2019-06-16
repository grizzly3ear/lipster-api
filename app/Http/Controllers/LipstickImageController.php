<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\LipstickImageRepositoryInterface;

class LipstickImageController extends Controller
{
    protected $lipstickImageRepository;

    public function __construct(LipstickImageRepositoryInterface $lipstickImageRepository) {
        $this->lipstickImageRepository = $lipstickImageRepository;
    }

    public function getAllLipstickImage () {
        $lipstickImages = $this->lipstickImageRepository->findAll();

        return response()->json($lipstickImages, 200);
    }

    public function getLipstickImageById ($lipstickImage_id) {
        $lipstickImage = $this->lipstickImageRepository->findById($lipstickImage_id);

        return response()->json($lipstickImage, 200);
    }

    public function createLipstickImage (Request $request) {
        $lipstickImage = $this->lipstickImageRepository->store($request->input());

        return response()->json($lipstickImage, 201);
    }

    public function updateLipstickImageById (Request $request, $lipstickImage_id) {
        $lipstickImage = $this->lipstickImageRepository->update($lipstickImage_id, $request->input());

        return response()->json($lipstickImage, 200);
    }

    public function deleteLipstickImageById ($lipstickImage_id) {
        $lipstickImage_id = $this->lipstickImageRepository->deleteById($lipstickImage_id);

        return response()->json($lipstickImage_id, 200);
    }
}
